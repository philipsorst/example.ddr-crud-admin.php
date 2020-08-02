<?php

namespace App\Entity;

interface CreatedInterface
{
    public function getCreated(): ?int;

    public function setCreated(int $created);
}
