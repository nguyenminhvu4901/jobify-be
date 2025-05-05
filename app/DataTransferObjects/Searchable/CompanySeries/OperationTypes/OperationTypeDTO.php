<?php

namespace App\DataTransferObjects\Searchable\CompanySeries\OperationTypes;

readonly class OperationTypeDTO
{
    public static function formatOperationType($operationType): array
    {
        return [
            'id' => $operationType->id,
            'name' => $operationType->name,
            'description' => $operationType->description
        ];
    }
}
