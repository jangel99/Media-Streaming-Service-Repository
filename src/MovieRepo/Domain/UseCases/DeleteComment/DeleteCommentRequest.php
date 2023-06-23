<?php

namespace App\MovieRepo\Domain\UseCases\DeleteComment;

class DeleteCommentRequest extends \App\MovieRepo\Domain\UseCases\UseCaseRequest
{

    private $commentId;

    public function __construct($commentId) {
        $this->commentId = $commentId;
    }

    /**
     * @return mixed
     */
    public function getCommentId()
    {
        return $this->commentId;
    }

    /**
     * @param mixed $commentId
     */
    public function setCommentId($commentId): void
    {
        $this->commentId = $commentId;
    }
}