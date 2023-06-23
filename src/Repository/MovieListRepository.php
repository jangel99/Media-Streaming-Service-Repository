<?php

namespace App\Repository;

use App\Entity\MovieList;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<MovieList>
 *
 * @method MovieList|null find($id, $lockMode = null, $lockVersion = null)
 * @method MovieList|null findOneBy(array $criteria, array $orderBy = null)
 * @method MovieList[]    findAll()
 * @method MovieList[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class MovieListRepository extends ServiceEntityRepository implements \App\MovieRepo\Domain\Model\MovieList\MovieListRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, MovieList::class);
    }

    public function save(MovieList $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(MovieList $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

//    /**
//     * @return MovieList[] Returns an array of MovieList objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('m')
//            ->andWhere('m.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('m.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?MovieList
//    {
//        return $this->createQueryBuilder('m')
//            ->andWhere('m.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
    public function addMovieToList($movieId, $userId)
    {
        $conn = $this->getEntityManager()->getConnection();
        $sql = 'INSERT INTO list (idMovie, idUser) VALUES 
                                            (:idMovie, :idUser)';
        $stmt = $conn->prepare($sql);
        $stmt->executeQuery([
            'idMovie' => $movieId,
            'idUser' => $userId
        ]);
    }

    public function removeMovieFromList($movieId, $userId)
    {
        $conn = $this->getEntityManager()->getConnection();
        $sql = 'DELETE FROM list WHERE idMovie = :idMovie AND idUser = :idUser ';
        $stmt = $conn->prepare($sql);
        $stmt->executeQuery([
            'idMovie' => $movieId,
            'idUser' => $userId
        ]);
    }

    public function hasList($movieId, $userId) {
        $conn = $this->getEntityManager()->getConnection();
        $sql = 'SELECT * FROM list WHERE idMovie = :idMovie AND idUser = :idUser';
        $stmt = $conn->prepare($sql);
        $result = $stmt->executeQuery([
            'idMovie' => $movieId,
            'idUser' => $userId
        ]);
        return $result->fetchAllAssociative();
    }

}
