<?php

namespace App\Repository;

use App\Entity\Movie;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Movie>
 *
 * @method Movie|null find($id, $lockMode = null, $lockVersion = null)
 * @method Movie|null findOneBy(array $criteria, array $orderBy = null)
 * @method Movie[]    findAll()
 * @method Movie[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class MovieRepository extends ServiceEntityRepository implements \App\MovieRepo\Domain\Model\Movie\MovieRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Movie::class);
    }

    public function save(Movie $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(Movie $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }


//    /**
//     * @return Movie[] Returns an array of Movie objects
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

//    public function findOneBySomeField($value): ?Movie
//    {
//        return $this->createQueryBuilder('m')
//            ->andWhere('m.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
    public function getMovieByName($name)
    {
        $conn = $this->getEntityManager()->getConnection();
        $sql = "SELECT * FROM movie WHERE name LIKE :name";
        $stmt = $conn->prepare($sql);
        $resultSet = $stmt->executeQuery(["name" => $name]);
        return $resultSet->fetchAllAssociative();
    }

    public function getMovieByImdbId($imdbId) {
        $conn = $this->getEntityManager()->getConnection();
        $sql = 'SELECT * FROM movie WHERE imdb_id = :imdbId';
        $stmt = $conn->prepare($sql);
        $resultSet = $stmt->executeQuery([
            'imdbId' => $imdbId
        ]);
        $result = $resultSet->fetchAllAssociative();
        return $result;
    }

    public function persistMovie($locations, $title, $description, $project, $duration, $year, $rating, $imdbID, $country, $img, $genre, $director, $actors)
    {
        $conn = $this->getEntityManager()->getConnection();
        $sql = 'INSERT INTO movie (name, location, project, rating, imdb_id, duration, description, year, img, genre, director, actors) VALUES 
                                            (:name, :location, :project, :rating, :imdbID, :duration, :description, :year, :img, :genre, :director, :actors)';
        $stmt = $conn->prepare($sql);
        $stmt->executeQuery(['name' => $title,
            'location' => $locations,
            'project' => $project,
            'rating' => $rating,
            'imdbID' => $imdbID,
            'duration' => $duration,
            'description' => $description,
            'year' => $year,
            'img' => $img,
            'genre' => $genre,
            'director' => $director,
            'actors' => $actors
        ]);
    }

    public function getMostRatedMovies()
    {
        $conn = $this->getEntityManager()->getConnection();
        $sql = 'SELECT * FROM movie ORDER BY rating DESC LIMIT 15';
        $stmt = $conn->prepare($sql);
        $resultSet = $stmt->executeQuery();
        $result = $resultSet->fetchAllAssociative();
        return $result;
    }

    public function getMovieByCountryAndId($project, $id)
    {
        $conn = $this->getEntityManager()->getConnection();
        $sql = 'SELECT * FROM movie WHERE id = :id AND project = :project';
        $stmt = $conn->prepare($sql);
        $resultSet = $stmt->executeQuery([
            'id' => $id,
            'project' => $project
        ]);
        $result = $resultSet->fetchAllAssociative();
        return $result;
    }

    public function getMovieByLocation($location)
    {
        $conn = $this->getEntityManager()->getConnection();
        if($location == "Other") {
            $sql = "SELECT * FROM movie WHERE location NOT LIKE '%Disney+%'";

        } else {
            $sql = "SELECT * FROM movie WHERE location LIKE '%".$location."%'";
        }
        $stmt = $conn->prepare($sql);
        $resultSet = $stmt->executeQuery();
        $result = $resultSet->fetchAllAssociative();
        return $result;
    }

    public function getListMovieByIdUser($idUser)
    {
        $conn = $this->getEntityManager()->getConnection();
        $sql = "SELECT movie.id, movie.name, movie.project, movie.img FROM movie, list WHERE movie.id = list.idMovie AND list.idUser =".$idUser;
        $stmt = $conn->prepare($sql);
        $resultSet = $stmt->executeQuery();
        $result = $resultSet->fetchAllAssociative();
        return $result;
    }
}
