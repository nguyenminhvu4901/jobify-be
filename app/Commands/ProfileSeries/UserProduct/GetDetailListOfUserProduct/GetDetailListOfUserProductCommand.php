<?php

namespace App\Commands\ProfileSeries\UserProduct\GetDetailListOfUserProduct;

use App\Commands\CommandInterface;
use Illuminate\Foundation\Http\FormRequest;

readonly class GetDetailListOfUserProductCommand implements CommandInterface
{
    public function __construct(
        public int|string $userProductId
    )
    {
    }

    public static function withForm(FormRequest $request): CommandInterface
    {
        return new self(
            userProductId: $request->get('user_product_id')
        );
    }
}
