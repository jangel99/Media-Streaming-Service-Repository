<?php

namespace App\MovieRepo\Domain\UseCases\DeleteComment;

use App\MovieRepo\Domain\UseCases\UseCaseRequest;
use App\Repository\ComentsRepository;

class DeleteComment extends \App\MovieRepo\Domain\UseCases\UseCase
{
    private ComentsRepository $comentsRepository;

    public  function __construct(ComentsRepository $comentsRepository)
    {
        $this->comentsRepository = $comentsRepository;
    }

    public function execute(UseCaseRequest $useCaseRequest)
    {
        $this->comentsRepository->deleteComment($useCaseRequest->getCommentId());
    }
}