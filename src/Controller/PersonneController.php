<?php
namespace App\Controller;

use App\Entity\Personne;
use App\Form\PersonneType;
use App\Repository\PersonneRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Form\Extension\Core\Type\TextType;

/**
 * @Route("/personne")
 */
class PersonneController extends AbstractController
{
    /**
     * @Route("/", name="personne_index", methods={"GET"})
     */
    public function index(PersonneRepository $personneRepository): Response
    {
        return $this->render('personne/index.html.twig', [
            'personnes' => $personneRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="personne_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $personne = new Personne();
        $form = $this->createFormBuilder($personne)
            ->add('nom_p',TextType::class, array('attr' => array('maxlength' => 22)))
            ->add('prenom_p',TextType::class, array('attr' => array('maxlength' => 22)))
            ->getForm();
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($personne);
            $entityManager->flush();

            return $this->redirectToRoute('personne_index');
        }

        return $this->render('personne/new.html.twig', [
            'personne' => $personne,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{idp}", name="personne_show", methods={"GET"}
     * ,requirements={"idp": "\d+"})
     */
    public function show(PersonneRepository $personneRepository, int $idp): Response
    {
    	$personne = $personneRepository->find($idp);

        return $this->render('personne/show.html.twig', [
            'personne' => $personne,
        ]);
    }

    /**
     * @Route("/{idp}/edit", name="personne_edit", methods={"GET","POST"}
     * ,requirements={"idp": "\d+"})
     */
    public function edit(Request $request, PersonneRepository $personneRepository, int $idp): Response
    {
        $personne = $personneRepository->find($idp);
        $form = $this->createFormBuilder($personne)
            ->add('nom_p',TextType::class, array('attr' => array('maxlength' => 22)))
            ->add('prenom_p',TextType::class, array('attr' => array('maxlength' => 22)))
            ->getForm();
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('personne_index');
        }

        return $this->render('personne/edit.html.twig', [
            'personne' => $personne,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{idp}", name="personne_delete", methods={"DELETE"}
     * ,requirements={"idp": "\d+"})
     */
    public function delete(Request $request, PersonneRepository $personneRepository, int $idp): Response
    {
    	$personne = $personneRepository->find($idp);

        if ($this->isCsrfTokenValid('delete'.$idp, $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();

            foreach ($personne->getGagners() as $gagner)
                if($gagner->getIdp() == $personne)
                    $entityManager->remove($gagner);

            $entityManager->remove($personne);
            $entityManager->flush();
        }

        return $this->redirectToRoute('personne_index');
    }
}
?>
