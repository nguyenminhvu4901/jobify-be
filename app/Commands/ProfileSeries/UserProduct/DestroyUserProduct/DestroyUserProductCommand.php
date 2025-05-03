<?php

namespace App\Commands\ProfileSeries\UserProduct\DestroyUserProduct;

use App\Commands\CommandInterface;
use Illuminate\Foundation\Http\FormRequest;

readonly class DestroyUserProductCommand implements CommandInterface
{
    public function __construct(
        public string $userSlug,
        public int $userProductId,
    ) {
    }

    public static function withForm(FormRequest $request): CommandInterface
    {
        return new self(
            userSlug: $request->get('user_slug'),
            userProductId: $request->get('user_product_id')
        );
    }
}
