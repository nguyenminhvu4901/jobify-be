<?php

namespace App\DataTransferObjects;

interface DataTransferObjectInterface
{
    public static function fromArray(array $data): static;
}
