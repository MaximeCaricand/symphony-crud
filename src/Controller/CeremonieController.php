<?php

namespace App\Controller;

use App\Entity\Ceremonie;
use App\Form\CeremonieType;
use App\Repository\CeremonieRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/ceremonie")
 */
class CeremonieController extends AbstractController
{
    /**
     * @Route("/", name="ceremonie_index", methods={"GET"})
     */
    public function index(CeremonieRepository $ceremonieRepository): Response
    {
        return $this->render('ceremonie/index.html.twig', [
            'ceremonies' => $ceremonieRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="ceremonie_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $ceremonie = new Ceremonie();
        $form = $this->createForm(CeremonieType::class, $ceremonie);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($ceremonie);
            $entityManager->flush();

            return $this->redirectToRoute('ceremonie_index');
        }

        return $this->render('ceremonie/new.html.twig', [
            'ceremonie' => $ceremonie,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="ceremonie_show", methods={"GET"})
     */
    public function show(Ceremonie $ceremonie): Response
    {
        return $this->render('ceremonie/show.html.twig', [
            'ceremonie' => $ceremonie,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="ceremonie_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Ceremonie $ceremonie): Response
    {
        $form = $this->createForm(CeremonieType::class, $ceremonie);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('ceremonie_index');
        }

        return $this->render('ceremonie/edit.html.twig', [
            'ceremonie' => $ceremonie,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="ceremonie_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Ceremonie $ceremonie): Response
    {
        if ($this->isCsrfTokenValid('delete'.$ceremonie->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();

            foreach ($ceremonie->getPrixes() as $prix) {
                if($prix->getIdc() == $ceremonie) {

                    foreach ($prix->getGagners() as $gagner)
                        if($gagner->getIdprix() == $prix)
                            $entityManager->remove($gagner);

                    $entityManager->remove($prix);
                }
            }

            $entityManager->remove($ceremonie);
            $entityManager->flush();
        }

        return $this->redirectToRoute('ceremonie_index');
    }
}
