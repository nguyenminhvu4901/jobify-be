<?php

namespace App\Enums\RouteNames\Company;

enum OperationType: string
{
    case PREFIX = 'company.operationType.';

    case TAG_NAME = 'operationTypes';

    case LIST_ALL_OPERATION_TYPE = 'listAllOperationType';
}
