<?php

namespace App\Controller;

use App\Entity\Marca;
use App\Entity\Sintoma;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Security;

class DefaultController extends AbstractController
{

    private $security;

    public function __construct(Security $security)
    //public function __construct(UserProviderInterface $user)
    {
        $this->security = $security;
    }

    /**
     * @Route("/", name="homepage")
     */
    public function index(Request $request)
    {
        if (\in_array("ROLE_ESTUDIANTE", $this->security->getUser()->getRoles())) {
            return $this->forward('App\Controller\DefaultController::reportesView');
        }
        if (\in_array("ROLE_MEDICO", $this->security->getUser()->getRoles())) {
            return $this->forward('App\Controller\DefaultController::reportesView');
        }
        return $this->redirectToRoute('usuario_index');
    }
    public function sidebar($request)
    {
        $routeName = $request->get('_route');
        return $this->render('default/sidebar.html.twig', ['name_route' => $routeName]);
    }

    public function salir()
    {
        return $this->redirectToRoute('app_login');
    }
    /**
     * @Route("/ajaxdatatable/", name="ajaxdatatable", methods={"GET","POST"})
     */
    public function ajaxdata(Request $request, \Symfony\Component\Asset\Packages $assetsManager): Response
    {
        $em = $this->getDoctrine()->getManager();
        $conn = $em->getConnection();
        $elementos =  filter_input_array(INPUT_POST);
        $sqlQuery = '';
        $aData = [];
        $where = "1=1";

        if ($elementos) {
            if ($elementos['searchText'] != 0) {
                $_searchText = $elementos['searchText'];
                $where = " t1.sintoma like '%" . $_searchText . "%' OR 
                            t1.rubro like '%" . $_searchText . "%' OR
                            t1.subrubro like '%" . $_searchText . "%' OR 
                            t1.modalidad like '%" . $_searchText . "%'";
            }
        }
        $total = "select count(*) as count from sintoma t1 ";
        $sqlQuery = "select
                    t1.*,
                    ms.marcas,
                    ms.marcasTitulos
                from
                    sintoma t1
                left join (select
                    ms.sintoma_id ,
                    GROUP_CONCAT(CONCAT(m.nombre,' ',m.signo,'|',m.color) SEPARATOR ';') as marcas,
                    GROUP_CONCAT(CONCAT(m.nombre,'@',m.signo,'|',m.color) SEPARATOR ';') as marcasTitulos
                from
                    marcas_sintomas ms
                inner join marca m on ms.marca_id =m.id
                group by
                    ms.sintoma_id ) ms  on
                    t1.id = ms.sintoma_id
    
                    where " . $where . ";";
        $columns = [
            ["name" => "relacion"],
            ["name" => "sintoma"],
            ["name" => "rubro"],
            ["name" => "subrubro"],
            ["name" => "modalidad"],
            ["name" => "marcas"],
            ["name" => "action"],
            ["name" => "id"],
            ["name" => "marcasTitulos"],
        ];

        //ejecutar SET SESSION group_concat_max_len = 1000000;

        $stringLength = 'SET SESSION group_concat_max_len = 1000000;';
        $stmt1 = $conn->prepare($stringLength);
        $stmt1->execute();

        $stmt2 = $conn->prepare($sqlQuery);
        $rows = $stmt2->execute();
        $result = $rows->fetchAll();

        $stmt3 = $conn->prepare($total);
        $rows = $stmt3->execute();
        $count = $rows->fetchAll();
        /*dump($result);
        dump($count);
        exit;*/
        foreach ($result as $key => $val) {
            foreach ($columns as $key2 => $val2) {
                switch ($val2['name']) {
                    case 'action':
                        $edit_button = ' <a href="#" onclick="agregarTabla(' . $val['id'] . ');return false;" class="btn btn-info btn-xs" data-toggle="tooltip" data-placement="top" title="" ><i class="fa fa-check-circle"></i> Seleccionar </a>';
                        $aData[$key][] = $edit_button;
                        break;
                    case 'marcas':
                        $marcasValue = explode(";", $val['marcas']);
                        $marcasTitulos = [];
                        $row = [];
                        foreach ($marcasValue as $keyVal  => $marcaVal) {
                            if ($marcaVal) {
                                $earchRow = explode("|", $marcaVal);
                                $colorRow = "";
                                if ($earchRow[1] == "VERDE") {
                                    $colorRow = '<div class="progress">
                                        <div class="progress-bar bg-verde" role="progressbar" style="width: 100%" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>';
                                }
                                if ($earchRow[1] == "ROJO") {
                                    $colorRow = '<div class="progress">
                                        <div class="progress-bar bg-rojo" role="progressbar" data-transitiongoal="100" style="width: 100%;" aria-valuenow="100"></div>
                                    </div>';
                                }
                                if ($earchRow[1] == "AZUL") {
                                    $colorRow = '<div class="progress">
                                        <div class="progress-bar bg-azul" role="progressbar" data-transitiongoal="100" style="width: 100%;" aria-valuenow="100"></div>
                                    </div>';
                                }
                                if ($earchRow[1] == "NEGRO") {
                                    $colorRow = '<div class="progress">
                                        <div class="progress-bar bg-negro" role="progressbar" data-transitiongoal="100" style="width: 100%;" aria-valuenow="100"></div>
                                    </div>';
                                }
                                $earchRow[0] = str_replace("<","&lt;", $earchRow[0]);
                                $earchRow[0] = str_replace(">","&gt;", $earchRow[0]);
                                array_push($row, $earchRow[0] . "<br>" . $colorRow);
                                array_push($marcasTitulos, $earchRow[0]);
                            } else {
                                array_push($row, "");
                                array_push($marcasTitulos, "");
                            }
                        }
                        $aData[$key][] = join("<br>", $row);
                        break;
                    default:
                        $aData[$key][] = $val[$val2['name']];
                        break;
                }
            }
        }
        $respuesta = [
            "recordsTotal" => intval($count[0]['count']),
            "data" => $aData,
        ];
        $response = new Response(json_encode($respuesta));
        $response->headers->set('Content-Type', 'application/json');

        return $response;
    }

    /**
     * @Route("/reportes", name="reportes", methods={"GET"})
     */
    public function reportesView(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $conn = $em->getConnection();
        $sqlQuery = "select *
        FROM configuracion";
        $stmt2 = $conn->prepare($sqlQuery);
        $rows = $stmt2->execute();
        $result = $rows->fetchAll();
        $nroReportes = $result[0]["nroReportes"];
        $marcas = $this->getDoctrine()
            ->getRepository(Marca::class)
            ->findAll();
        $sintomas = $this->getDoctrine()
            ->getRepository(Sintoma::class)
            ->findAll();

        return $this->render('reportes/index.html.twig', ['marcasLength' => count($marcas), 'sintomasLength' => count($sintomas), 'nroReportes' => $nroReportes]);
    }

    /**
     * @Route("/reporteTemplate", name="reporteTemplate", methods={"GET"})
     */
    public function reportesTemplateView(Request $request){
        return $this->render('reportes/template.html.twig', []);

    }

    /**
     * @Route("/registrarReportes", name="registrarReportes", methods={"POST"})
     */
    public function registrarReporte(Request $request): Response
    {
        $em = $this->getDoctrine()->getManager();
        $conn = $em->getConnection();
        $sqlQuery = "select *
        FROM configuracion";
        $stmt2 = $conn->prepare($sqlQuery);
        $rows = $stmt2->execute();
        $result = $rows->fetchAll();
        $nroReportes = $result[0]["nroReportes"];
        $nroReportes = $nroReportes + 1;

        $sqlQuery = "update configuracion set nroReportes=" . $nroReportes . " where id=1;";
        $stmt2 = $conn->prepare($sqlQuery);
        $rows = $stmt2->execute();
        $respuesta = [
            "count" => $nroReportes
        ];
        $response = new Response(json_encode($respuesta));
        $response->headers->set('Content-Type', 'application/json');

        return $response;
    }
}