
<?php

namespace App\Controller;

use App\Entity\Personne;
use App\Form\PersonneType;
use App\Repository\PersonneRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

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
        $form = $this->createForm(PersonneType::class, $personne);
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
     * @Route("/{id}", name="personne_show", methods={"GET"})
     */
    public function show(Personne $personne): Response
    {
        return $this->render('personne/show.html.twig', [
            'personne' => $personne,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="personne_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Personne $personne): Response
    {
        $form = $this->createForm(PersonneType::class, $personne);
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
     * @Route("/{id}", name="personne_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Personne $personne): Response
    {
        if ($this->isCsrfTokenValid('delete'.$personne->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($personne);
            $entityManager->flush();
        }

        return $this->redirectToRoute('personne_index');
    }
}
/*
namespace AppBundle\Controller;

use AppBundle\Entity\Personne;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PersonneController /*extends DefaultController {

	/**
     * @Route("personne/create/{nom_p}/{prenom_p}")
     */
    /*public function createAction($nom_p,$prenom_p) {
        // you can fetch the EntityManager via $this->getDoctrine()
        // or you can add an argument to your action: createAction(EntityManagerInterface $em)
        $entityManager = $this->getDoctrine()->getManager();

        $personne = new Personne();
        $personne->setNomP($nom_p);
        $personne->setPrenomP($prenom_p);

        // tells Doctrine you want to (eventually) save the Product (no queries yet)
        $entityManager->persist($personne);

        // actually executes the queries (i.e. the INSERT query)
        $entityManager->flush();

        return new Response('Saved new personne with idp '.$personne->getId());
    }

    /**
     * @Route("personne/{idp}")
     */
    /*public function showAction($idp)
    {
        $personne = $this->getDoctrine()
            ->getRepository(Personne::class)
            ->find($idp);

        if (!$personne) {
            throw $this->createNotFoundException(
                'Aucune personne trouvée pour l'id '.$idp
            );
        }
        else {
            return $this->render('personne.html.twig', array(
                'idp' => $personne->idp(), 'nom_p' => $personne->getNomP(), 'prenom_p' => $personne->getPrenomP(),
                 ));
        }
    }

    /**
     * @Route("personne", name = "accueil")
     */
    /*public function showAllAction()
    {
        $personnes = $this->getDoctrine()
            ->getRepository(Personne::class)
            ->findAll();

        return $this->render('personnes.html.twig', array(
            'personnes' => $personnes
            ));

    }

    /**
     * @Route("personne/update/{idp}/{nom_p}/{prenom_p}")
     */
    /*public function updateAction($idp, $nom_p, $prenom_p)
    {
        $entityManager = $this->getDoctrine()->getManager();
        $personne = $entityManager->getRepository(Personne::class)->find($idp);

        if (!$personne) {
            throw $this->createNotFoundException(
                'Aucune personne trouvée pour l'id '.$idp
            );
        }
        $personne->setNomP($nom_p);
        $personne->setPrenomP($prenom_p);
        $entityManager->flush();

        return $this->redirectToRoute('accueil');
    }

    /**
     * @Route("personne/delete/{idp}")
     */
    /*public function deleteAction($idp)
    {
        $entityManager = $this->getDoctrine()->getManager();
        $personne = $entityManager->getRepository(Personne::class)->find($idp);

        if (!$personne) {
            throw $this->createNotFoundException(
                'Aucune personne trouvée pour l'id '.$idp
            );
            }
        else {
            $entityManager->remove($idp);
            $entityManager->flush();
        }
        return $this->redirectToRoute('accueil');
    }

    /**
     * @Route("personne/select/{nom_p}")
     */
    /*public function selectAction($nom_p)
    {
        $entityManager = $this->getDoctrine()->getManager();
        $personne = $entityManager->getRepository(Personne::class)->findOneBy(array('nom_p' => $nom_p));

        if (!$personne) {
            throw $this->createNotFoundException(
                'Aucune personne trouvée pour le nom '.$nom_p
            );
        }
        else {
            return $this->render('personne.html.twig', array(
                'idp' => $personne->getId(),
                'nom_p' => $personne->getNomP(), 
                'prenom_p' => $personne->getPrenomP()
            ));
        }
    }

     /**
     * @Route("personne/select2/{prenom_p}")
     */
    /*public function selectAction($prenom_p)
    {
        $entityManager = $this->getDoctrine()->getManager();
        $personne = $entityManager->getRepository(Personne::class)->findOneBy(array('prenom_p' => $prenom_p));

        if (!$personne) {
            throw $this->createNotFoundException(
                'Aucune personne trouvée pour le prenom '.$prenom_p
            );
        }
        else {
            return $this->render('personne.html.twig', array(
                'idp' => $personne->getId(),
                'nom_p' => $personne->getNomP(), 
                'prenom_p' => $personne->getPrenomP()
            ));
        }
    }
}
*/
?>
