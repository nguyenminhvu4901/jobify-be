<?php

namespace App\Commands\CompanySeries\CompanyProfile\GetDetailProfileCompanyCurrentUser;

use App\Commands\CommandInterface;
use Illuminate\Foundation\Http\FormRequest;

readonly class GetDetailProfileCompanyCurrentUserCommand implements CommandInterface
{
    public function __construct()
    {
    }

    public static function withForm(FormRequest $request): CommandInterface
    {
        return new self(

        );
    }
}
