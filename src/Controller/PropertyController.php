<?php


namespace App\Controller;

use App\Entity\Property;
use App\Repository\PropertyRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ObjectManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PropertyController extends AbstractController
{

    /**
     * @var PropertyRepository
     */
    private $repository;

    /**
     * @var ObjectManager
     */
    private $em;

    public function __construct(PropertyRepository $repository, EntityManagerInterface $em)
    {
     $this->repository = $repository;
     $this->em = $em;
    }
    // Mettre a jour : object manager initialisation dans le construct et flush en bdd sur la fonction souhaitée (index)
    // Avantage : tte les entitées récup par le repo sont trackées par l'objectManager,
    // si modif le flush detecté et apparto modif en BDD


    /**
     * @Route("/biens", name="property.index")
     * @return Response
     */
    public function index() : Response
    {
        /*
        $propertiy = new Property();
        $propertiy->setTitle('mon premier bien')
            ->setPrice(200000)
            ->setRooms(4)
            ->setBedrooms(3)
            ->setDescription('Une petite description')
            ->setSurface(60)
            ->setFloor(4)
            ->setHeat(1)
            ->setCity('Lille')
            ->setAddress('bd Gambetta')
            ->setPostalCode('59000');

        //envoi bdd
        //persist et je l'envoi
        $em = $this->getDoctrine()->getManager();
        $em->persist($propertiy);
        $em->flush();
*/
// -----------------------------------------------------------
 // Aide Memoire:

        // Récupérer un bien en l'initialisant par le biai de doctrine :
/*
        $repository = $this->getDoctrine()->getRepository(Property::class);
*/

        // Méthode pour récupérer un bien :

/*        $property = $this->repository->find(1);
        dump($property);
        // champs automatiquement remplis // 1er et unique car par id
*/
/*        $property = $this->repository->findAll();
         dump($property);
        // renvoi un tableau contenant l'ensemble de mes biens
*/
/*         $property = $this->repository->findOneBy(['floor' => 4 ]);
         dump($property);
         // passer en para un tableau de critéres ex tout ceux qui sont au 4eme étages
*/
// ---------------------------------------------------------------------

        return $this->render('property/index.html.twig', [
            'current_menu' => 'properties'
        ]);
    }

    /**
     * @Route ("/biens/{slug}-{id}", name="property.show" , requirements={"slug": "[a-z0-9\-]*" })
     * @param Property $property
     * @param $slug
     * @param $id
     * @return Response
     */
    public function show(Property $property, $slug, $id) : Response
    {
        if ( $property->getSlug() !== $slug) {
            return $this->redirectToRoute('property.show', [
                'id' => $property->getId(),
                'slug' => $property->getSlug(),
            ], 301 );
        }

        // 301 = redirection permanente
        // slug important pour référencement

        $property = $this->repository->find($id);
        return $this->render('property/show.html.twig', [
            'property' => $property,
            'current_menu' => 'properties'
        ]);
    }
}
