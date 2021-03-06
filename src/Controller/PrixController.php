<?php

namespace App\Controller;

use App\Entity\Prix;
use App\Entity\Ceremonie;
use App\Form\PrixType;
use App\Repository\PrixRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

/**
 * @Route("/prix")
 */
class PrixController extends AbstractController
{
    /**
     * @Route("/", name="prix_index", methods={"GET"})
     */
    public function index(PrixRepository $prixRepository): Response
    {
        return $this->render('prix/index.html.twig', [
            'prixs' => $prixRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="prix_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $prix = new Prix();
        
        $form = $this->createFormBuilder($prix)
            ->add('categorie_prix',TextType::class, array('attr' => array('maxlength' => 30)))
            ->add('idc',EntityType::class, array('class' => Ceremonie::class, 'choice_label' => 'nom_ceremonie'))
            ->getForm();

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($prix);
            $entityManager->flush();

            return $this->redirectToRoute('prix_index');
        }

        return $this->render('prix/new.html.twig', [
            'prix' => $prix,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{idprix}", name="prix_show", methods={"GET"}
     * ,requirements={"idprix": "\d+"})
     */
    public function show(PrixRepository $prixRepository, int $idprix): Response
    {
        $prix = $prixRepository->find($idprix);

        return $this->render('prix/show.html.twig', [
            'prix' => $prix,
        ]);
    }

    /**
     * @Route("/{idprix}/edit", name="prix_edit", methods={"GET","POST"}
     * ,requirements={"idp": "\d+"})
     */
    public function edit(Request $request, PrixRepository $prixRepository, int $idprix): Response
    {
        $prix = $prixRepository->find($idprix);

        $form = $this->createFormBuilder($prix)
            ->add('categorie_prix',TextType::class, array('attr' => array('maxlength' => 30), 'empty_data' => $prix->getCategoriePrix()))
            ->add('idc',EntityType::class, array('class' => Ceremonie::class, 'choice_label' => 'nom_ceremonie', 'empty_data' => $prix->getIdc()))
            ->getForm();

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('prix_index');
        }

        return $this->render('prix/edit.html.twig', [
            'prix' => $prix,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{idprix}", name="prix_delete", methods={"DELETE"}
     * ,requirements={"idp": "\d+"})
     */
    public function delete(Request $request, PrixRepository $prixRepository, int $idprix): Response
    {
        $prix = $prixRepository->find($idprix);

        if ($this->isCsrfTokenValid('delete'.$idprix, $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();

            foreach ($prix->getGagners() as $gagner)
                if($gagner->getIdprix() == $prix)
                    $entityManager->remove($gagner);

            $entityManager->remove($prix);
            $entityManager->flush();
        }

        return $this->redirectToRoute('prix_index');
    }
}
