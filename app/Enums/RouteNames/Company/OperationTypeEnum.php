<?php

namespace App\Enums\RouteNames\Company;

enum OperationTypeEnum: string
{
    case PREFIX = 'company.operationType.';

    case TAG_NAME = 'operationTypes';

    case TABLE = 'operation_types';

    case LIST_ALL_OPERATION_TYPE = 'listAllOperationType';
}
