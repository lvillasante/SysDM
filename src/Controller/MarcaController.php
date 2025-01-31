<?php

namespace App\Controller;

use App\Entity\Marca;
use App\Form\MarcaType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/marca")
 */
class MarcaController extends AbstractController
{
    /**
     * @Route("/", name="marca_index", methods={"GET"})
     */
    public function index(): Response
    {
        $marcas = $this->getDoctrine()
            ->getRepository(Marca::class)
            ->findAll();

        return $this->render('marca/index.html.twig', [
            'marcas' => $marcas,
        ]);
    }

    /**
     * @Route("/new", name="marca_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $marca = new Marca();
        $form = $this->createForm(MarcaType::class, $marca);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($marca);
            $entityManager->flush();

            return $this->redirectToRoute('marca_index');
        }

        return $this->render('marca/new.html.twig', [
            'marca' => $marca,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="marca_show", methods={"GET"})
     */
    public function show(Marca $marca): Response
    {
        return $this->render('marca/show.html.twig', [
            'marca' => $marca,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="marca_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Marca $marca): Response
    {
        $form = $this->createForm(MarcaType::class, $marca);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('marca_index');
        }

        return $this->render('marca/edit.html.twig', [
            'marca' => $marca,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="marca_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Marca $marca): Response
    {
        if ($this->isCsrfTokenValid('delete'.$marca->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($marca);
            $entityManager->flush();
        }

        return $this->redirectToRoute('marca_index');
    }
}
