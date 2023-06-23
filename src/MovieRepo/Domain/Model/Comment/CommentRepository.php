<?php

namespace App\MovieRepo\Domain\Model\Comment;

interface CommentRepository
{
    public function insertComment($comment, $movieID, $userID, $userName);

    public function getComments($movieID);

    public function deleteComment($commentId);

}