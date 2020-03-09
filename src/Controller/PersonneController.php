namespace AppBundle\Controller;

use AppBundle\Entity\Personne;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PersonneController extends DefaultController {

	/**
     * @Route("personne/create/{nom_p}/{prenom_p}")
     */
    public function createAction($nom_p,$prenom_p) {
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
    public function showAction($idp)
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
    public function showAllAction()
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
    public function updateAction($idp, $nom_p, $prenom_p)
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
    public function deleteAction($idp)
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
    public function selectAction($nom_p)
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
     * @Route("personne/select/{prenom_p}")
     */
    public function selectAction($prenom_p)
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

