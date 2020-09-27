<?php

namespace App\Repository;

use App\Entity\Property;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\QueryBuilder;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Property|null find($id, $lockMode = null, $lockVersion = null)
 * @method Property|null findOneBy(array $criteria, array $orderBy = null)
 * @method Property[]    findAll()
 * @method Property[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PropertyRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Property::class);
    }

    /**
     * @Return Property[]
     */
    public function findAllVisible(): array
    {
        return $this->findVisibleQuery()
            ->getQuery()
            ->getResult();

    }

    // renvoyer un tableau qui contiendra l'ense des propriétés:
    /**
     * @Return Property[]
     */
    public function findLatest() : array
    {
        return $this->findVisibleQuery()
            ->getQuery()
            ->getResult();

    }

    // methode privée car 2 query identiques (findAllVisible / findLatest )

    private function findVisibleQuery () : QueryBuilder
    {
        return $this->createQueryBuilder('p')
            ->Where('p.sold = false');
    }

    // ----------------------------------------------------
/* Aide Memoire

// Creation query builder :

    public function FindAllVisible()
    {
        return $this->createQueryBuilder('p') //donne un alias
            ->andWhere('p.exampleField = :val') // donner des conditions
            ->setParameter('val', $value) // rajouter des parametres
            ->orderBy('p.id', 'ASC') // order by
            ->setMaxResults(10) // limite
            ->getQuery() // pour recuperer la requete
            ->getResult() // pour recuperer le resultat

    }
    */
 // --------------------------------------------------------------------

    // /**
    //  * @return Property[] Returns an array of Property objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('p.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Property
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */


}
