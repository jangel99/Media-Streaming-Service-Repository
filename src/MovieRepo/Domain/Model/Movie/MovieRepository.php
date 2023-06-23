<?php

namespace App\MovieRepo\Domain\Model\Movie;

interface MovieRepository
{
    public function getMovieByName($name);

    public function persistMovie($locations, $title, $description, $project, $duration, $year, $rating, $imdbID, $country, $img, $genre, $director, $actors);

    public function getMostRatedMovies();

    public function getMovieByCountryAndId($project, $id);

    public function getMovieByLocation($location);

    public function getListMovieByIdUser($idUser);

    public function getMovieByImdbId($imdbId);
}