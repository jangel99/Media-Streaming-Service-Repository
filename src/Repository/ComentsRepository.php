<?php

namespace App\Repository;

use App\Entity\Coments;
use App\MovieRepo\Domain\Model\Comment\CommentRepository;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Coments>
 *
 * @method Coments|null find($id, $lockMode = null, $lockVersion = null)
 * @method Coments|null findOneBy(array $criteria, array $orderBy = null)
 * @method Coments[]    findAll()
 * @method Coments[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ComentsRepository extends ServiceEntityRepository implements CommentRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Coments::class);
    }

    public function save(Coments $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(Coments $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

//    /**
//     * @return Coments[] Returns an array of Coments objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('c')
//            ->andWhere('c.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('c.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Coments
//    {
//        return $this->createQueryBuilder('c')
//            ->andWhere('c.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
    public function insertComment($comment, $movieID, $userID, $userName)
    {
        $conn = $this->getEntityManager()->getConnection();
        $sql = 'INSERT INTO comments (comment, movieID, userID, userName) VALUES 
                                            (:comment, :movieId, :userId, :userName)';
        $stmt = $conn->prepare($sql);
        $stmt->executeQuery(['comment' => $comment,
            'movieId' => $movieID,
            'userId' => $userID,
            'userName' => $userName
        ]);
    }

    public function getComments($movieID)
    {
        $conn = $this->getEntityManager()->getConnection();
        $sql = 'SELECT * FROM comments WHERE movieID = :movieID';
        $stmt = $conn->prepare($sql);
        $resultSet = $stmt->executeQuery([
            'movieID' => $movieID
        ]);
        $result = $resultSet->fetchAllAssociative();
        return $result;
    }

    public function deleteComment($commentId)
    {
        $conn = $this->getEntityManager()->getConnection();
        $sql = 'DELETE FROM comments WHERE id ='.$commentId;
        $stmt = $conn->prepare($sql);
        $stmt->executeQuery();
    }
}
