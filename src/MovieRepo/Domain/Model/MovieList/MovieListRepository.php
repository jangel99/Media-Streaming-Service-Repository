<?php

namespace App\MovieRepo\Domain\Model\MovieList;

interface MovieListRepository
{

    public function addMovieToList($movieId, $userId);

    public function removeMovieFromList($movieId, $userId);
}