<?php

namespace App\Traits;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Response;
use Illuminate\Validation\ValidationException;

trait ValidationTrait
{
    /**
     * Handle a failed validation attempt.
     *
     * @param Validator $validator
     * @throws ValidationException
     */
    protected function failedValidation(Validator $validator)
    {
        $errors = $validator->getMessageBag()->toArray();

        $response = new Response([
            'status_code' => Response::HTTP_UNPROCESSABLE_ENTITY,
            'message' => $errors
        ], Response::HTTP_UNPROCESSABLE_ENTITY);

        throw new ValidationException($validator, $response);
    }
}
