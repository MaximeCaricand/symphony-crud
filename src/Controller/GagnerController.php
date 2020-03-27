<?php

namespace App\Controller;

use App\Entity\Gagner;
use App\Entity\Personne;
use App\Entity\Prix;
use App\Entity\Film;
use App\Form\GagnerType;
use App\Repository\GagnerRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

/**
 * @Route("/gagner")
 */
class GagnerController extends AbstractController
{
    /**
     * @Route("/", name="gagner_index", methods={"GET"})
     */
    public function index(GagnerRepository $gagnerRepository): Response
    {
        return $this->render('gagner/index.html.twig', [
            'gagners' => $gagnerRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="gagner_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $gagner = new Gagner();

        $form = $this->createFormBuilder($gagner)
            ->add('idp',EntityType::class, array('class' => Personne::class))
            ->add('idf',EntityType::class, array('class' => Film::class, 'choice_label' => 'nom_f'))
            ->add('idprix',EntityType::class, array('class' => Prix::class, 'choice_label' => 'categorie_prix'))
            ->add('annee_prix',IntegerType::class, array('attr' => array('min' => 1980, 'max' => 2030)))
            ->getForm();

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($gagner);
            $entityManager->flush();

            return $this->redirectToRoute('gagner_index');
        }

        return $this->render('gagner/new.html.twig', [
            'gagner' => $gagner,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{idp}/{idf}/{idprix}",
     * name="gagner_show", methods={"GET"}),
     * requirements={"idp": "\d+"}),
     * requirements={"idf": "\d+"}),
     * requirements={"idprix": "\d+"})
     */
    public function show(GagnerRepository $gagnerRepository, int $idp, int $idf, int $idprix): Response
    {
        //$gagnerRepository = $this->getDoctrine()->getManager();
        $gagner = $gagnerRepository->findBy(
            array(
                'idp' => $idp,
                'idf' => $idf,
                'idprix' => $idprix
            )
        );
        return $this->render('gagner/show.html.twig', [
            'gagner' => $gagner,
        ]);
    }

    /**
     * @Route("/{idp}/{idf}/{idprix}/edit",
     * name="gagner_edit", methods={"GET","POST"}),
     * requirements={"idp": "\d+"}),
     * requirements={"idf": "\d+"}),
     * requirements={"idprix": "\d+"})
     */
    public function edit(Request $request, GagnerRepository $gagnerRepository, int $idp, int $idf, int $idprix): Response
    {
        $gagner = $gagnerRepository->findBy(
            array(
                'idp' => $idp,
                'idf' => $idf,
                'idprix' => $idprix
            )
        );
        $form = $this->createFormBuilder($gagner[0])
            ->add('idp',EntityType::class, array('class' => Personne::class, 'empty_data' => $gagner[0]->getIdp()))
            ->add('idf',EntityType::class, array('class' => Film::class, 'choice_label' => 'nom_f', 'empty_data' => $gagner[0]->getIdf()))
            ->add('idprix',EntityType::class, array('class' => Prix::class, 'choice_label' => 'categorie_prix', 'empty_data' => $gagner[0]->getIdprix()))
            ->add('annee_prix',IntegerType::class, array('empty_data' => $gagner[0]->getAnneePrix(), 'attr' => array('min' => 1980, 'max' => 2030)))
            ->getForm();

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('gagner_index');
        }

        return $this->render('gagner/edit.html.twig', [
            'gagner' => $gagner,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{idp}/{idf}/{idprix}",
     * name="gagner_delete", methods={"DELETE"}),
     * requirements={"idp": "\d+"}),
     * requirements={"idf": "\d+"}),
     * requirements={"idprix": "\d+"})
     */
    public function delete(Request $request, GagnerRepository $gagnerRepository, int $idp, int $idf, int $idprix): Response
    {
        $gagner = $gagnerRepository->findBy(
            array(
                'idp' => $idp,
                'idf' => $idf,
                'idprix' => $idprix
            )
        );
        if ($this->isCsrfTokenValid(
            'delete'.$idp*$idf*$idprix,
        $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($gagner[0]);
            $entityManager->flush();
        }

        return $this->redirectToRoute('gagner_index');
    }
}
