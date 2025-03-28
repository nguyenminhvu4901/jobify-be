<?php

namespace App\Http\Controllers\API\Company;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Http\FormRequest;
use Joselfonseca\LaravelTactician\CommandBusInterface;

class CompanyController extends Controller
{
    public function __construct(
        protected CommandBusInterface $bus
    )
    {
    }

    public function getDetailProfileCompanyCurrentUser(FormRequest $request)
    {

    }
}
