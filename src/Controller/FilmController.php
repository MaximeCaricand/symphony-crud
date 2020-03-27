<?php

namespace App\Controller;

use App\Entity\Film;
use App\Form\FilmType;
use App\Repository\FilmRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\DateType;

/**
 * @Route("/film")
 */
class FilmController extends AbstractController
{
    /**
     * @Route("/", name="film_index", methods={"GET"})
     */
    public function index(FilmRepository $filmRepository): Response
    {
        return $this->render('film/index.html.twig', [
            'films' => $filmRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="film_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $film = new Film();
        
        $form = $this->createFormBuilder($film)
            ->add('nom_f',TextType::class, array('attr' => array('maxlength' => 30)))
            ->add('date_sortie',DateType::class, array('years' => range(1980,2030), 'data' => new \DateTime('now')))
            ->getForm();

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($film);
            $entityManager->flush();

            return $this->redirectToRoute('film_index');
        }

        return $this->render('film/new.html.twig', [
            'film' => $film,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{idf}", name="film_show", methods={"GET"}
     * ,requirements={"idf": "\d+"})
     */
    public function show(FilmRepository $filmRepository, int $idf): Response
    {
        $film = $filmRepository->find($idf);

        return $this->render('film/show.html.twig', [
            'film' => $film,
        ]);
    }

    /**
     * @Route("/{idf}/edit", name="film_edit", methods={"GET","POST"}
     * ,requirements={"idf": "\d+"})
     */
    public function edit(Request $request,FilmRepository $filmRepository, int $idf): Response
    {
        $film = $filmRepository->find($idf);
        
        $form = $this->createFormBuilder($film)
            ->add('nom_f',TextType::class, array('attr' => array('maxlength' => 30), 'empty_data' => $film->getNomF()))
            ->add('date_sortie',DateType::class, array('years' => range(1990,2030), 'data' => $film->getDateSortie()))
            ->getForm();

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('film_index');
        }

        return $this->render('film/edit.html.twig', [
            'film' => $film,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{idf}", name="film_delete", methods={"DELETE"}
     * ,requirements={"idf": "\d+"})
     */
    public function delete(Request $request, FilmRepository $filmRepository, int $idf): Response
    {
        $film = $filmRepository->find($idf);

        if ($this->isCsrfTokenValid('delete'.$idf, $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();

            foreach ($film->getGagners() as $gagner)
                if($gagner->getIdf() == $film)
                    $entityManager->remove($gagner);

            $entityManager->remove($film);
            $entityManager->flush();
        }

        return $this->redirectToRoute('film_index');
    }
}
