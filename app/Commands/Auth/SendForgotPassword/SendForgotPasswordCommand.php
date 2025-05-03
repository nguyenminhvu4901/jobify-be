<?php

namespace App\Commands\Auth\SendForgotPassword;

use App\Commands\CommandInterface;
use Illuminate\Foundation\Http\FormRequest;

readonly class SendForgotPasswordCommand implements CommandInterface
{
    /**
     * @param string $email
     */
    public function __construct(
        public string $email
    )
    {}

    /**
     * @param FormRequest $request
     * @return CommandInterface
     */
    public static function withForm(FormRequest $request): CommandInterface
    {
        return new self(
            email: $request->get('email')
        );
    }
}
