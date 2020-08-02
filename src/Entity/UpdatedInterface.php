<?php

namespace App\Entity;

interface UpdatedInterface
{
    public function getUpdated(): ?int;

    public function setUpdated(int $updated);
}
