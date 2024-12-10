<?php

namespace App\Commands\Auth\JobSeekerRegister;

use App\Commands\Base\BaseRegister\BaseRegisterCommand;
use Illuminate\Foundation\Http\FormRequest;

class JobSeekerRegisterCommand extends BaseRegisterCommand
{
    public static function withForm(FormRequest $request): JobSeekerRegisterCommand
    {
        $data = parent::fromBaseRequest($request);

        return new self(
            fullName: $data['fullName'],
            email: $data['email'],
            password: $data['password'],
            phoneNumber: $data['phoneNumber']
        );
    }
}
