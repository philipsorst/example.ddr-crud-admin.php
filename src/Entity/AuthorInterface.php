<?php

namespace App\Entity;

interface AuthorInterface
{
    public function getAuthor(): ?User;

    public function setAuthor(User $user);
}
