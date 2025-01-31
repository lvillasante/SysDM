<?php

namespace App\Controller;

use App\Entity\Usuario;
use App\Form\UsuarioType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use App\Service\MailNotifier;
use Symfony\Component\Security\Core\Security;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;

/**
 * @Route("/usuario")
 * @IsGranted("ROLE_ADMIN" , statusCode=404, message="No access! ")
 */
class UsuarioController extends AbstractController
{

    private $security;

    public function __constructor(Security $security)
    {
        $this->security = $security;
    }

    /**
     * @Route("/", name="usuario_index", methods={"GET"})
     */
    public function index(): Response
    {
        $usuarios = $this->getDoctrine()
            ->getRepository(Usuario::class)
            ->findAll();

        return $this->render('usuario/index.html.twig', [
            'usuarios' => $usuarios,
        ]);
    }

    /**
     * @Route("/new", name="usuario_new", methods={"GET","POST"})
     */
    public function new(Request $request, UserPasswordEncoderInterface $passwordEncoder): Response
    {
        $role_options = ['ROLE_USER'];
        $isValidEmail = true;
        $usuario = new Usuario();
        $form = $this->createForm(UsuarioType::class, $usuario);
        $form->handleRequest($request);
        $usuarios = $this->getDoctrine()
            ->getRepository(Usuario::class)
            ->findBy(["email" => $form["email"]->getData()]);
        if (count($usuarios) > 0) {
            $isValidEmail = false;
            $this->get('session')->getFlashBag()->add('notice', array('type' => 'danger', 'title' => 'ERROR al crear nuevo usuario !', 'message' => "El correo ya existe!"));
        }

        if ($form->isSubmitted() && $form->isValid() && $isValidEmail) {
            $entityManager = $this->getDoctrine()->getManager();
            $randomNumber = mt_rand(100000, 999999);
            $usuario->setPassword($passwordEncoder->encodePassword($usuario, $randomNumber));

            $role_options = [$form['role_option']->getData()];
            $usuario->setRoles(\serialize($role_options));
            $entityManager->persist($usuario);
            $entityManager->flush();
            $this->get('session')->getFlashBag()->add('notice', array('type' => 'success', 'title' => 'Nuevo usuario creado !', 'email' => $usuario->getEmail(), 'password' => $randomNumber));
            return $this->redirectToRoute('usuario_index');
        }

        return $this->render('usuario/new.html.twig', [
            'usuario' => $usuario,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}/regeneratePassword", name="usuario_regenerate_password", methods={"POST"})
     */
    public function regeneratePassword(Usuario $usuario, UserPasswordEncoderInterface $passwordEncoder): Response
    {

        $randomNumber = mt_rand(100000, 999999);
            $usuario->setPassword($passwordEncoder->encodePassword($usuario, $randomNumber));
            $this->getDoctrine()->getManager()->flush();
            $this->get('session')->getFlashBag()->add('notice', array('type' => 'success', 'title' => 'Contraseña cambiada !', 'email' => $usuario->getEmail(), 'password' => $randomNumber));
            return $this->redirectToRoute('usuario_index');
    }

    /**
     * @Route("/{id}", name="usuario_show", methods={"GET"})
     */
    public function show(Usuario $usuario): Response
    {
        return $this->render('usuario/show.html.twig', [
            'usuario' => $usuario,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="usuario_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Usuario $usuario): Response
    {

        $form = $this->createForm(UsuarioType::class, $usuario);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('usuario_index');
        }

        return $this->render('usuario/edit.html.twig', [
            'usuario' => $usuario,
            'form' => $form->createView(),
            'roles' => $usuario->getRoles() ? $usuario->getRoles()[0] : ""
        ]);
    }

    /**
     * @Route("/{id}", name="usuario_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Usuario $usuario): Response
    {
        if ($this->isCsrfTokenValid('delete' . $usuario->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($usuario);
            $entityManager->flush();
        }

        return $this->redirectToRoute('usuario_index');
    }
}
