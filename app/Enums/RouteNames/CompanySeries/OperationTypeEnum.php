<?php

namespace App\Enums\RouteNames\CompanySeries;

enum OperationTypeEnum: string
{
    case PREFIX = 'company.operationType.';

    case TAG_NAME = 'operationTypes';

    case TABLE = 'operation_types';

    case LIST_ALL_OPERATION_TYPE = 'listAllOperationType';
}
