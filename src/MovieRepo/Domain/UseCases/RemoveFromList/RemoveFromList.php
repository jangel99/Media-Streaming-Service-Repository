<?php

namespace App\MovieRepo\Domain\UseCases\RemoveFromList;

use App\MovieRepo\Domain\UseCases\UseCaseRequest;
use App\Repository\MovieListRepository;

class RemoveFromList extends \App\MovieRepo\Domain\UseCases\UseCase
{

    private MovieListRepository $movieListRepository;

    public function __construct($movieListRepository) {
        $this->movieListRepository = $movieListRepository;
    }

    public function execute(UseCaseRequest $useCaseRequest)
    {
        $this->movieListRepository->removeMovieFromList($useCaseRequest->getMovieId(), $useCaseRequest->getUserId());
    }
}