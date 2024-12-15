<?php

namespace App\Commands\Auth\SendForgotPassword;

use Illuminate\Contracts\Translation\Translator;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Password;

class SendForgotPasswordHandler
{
    /**
     * @param SendForgotPasswordCommand $command
     * @return Application|array|string|Translator|null
     */
    public function handle(SendForgotPasswordCommand $command): Application|array|string|Translator|null
    {
        $status = Password::sendResetLink([
            'email' => $command->email
        ]);

        return $status === Password::RESET_LINK_SENT
            ? __($status)
            : null;
    }
}
