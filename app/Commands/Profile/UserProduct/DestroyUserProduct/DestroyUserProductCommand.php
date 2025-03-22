<?php

namespace App\Commands\Profile\UserProduct\DestroyUserProduct;

use App\Commands\CommandInterface;
use Illuminate\Foundation\Http\FormRequest;

readonly class DestroyUserProductCommand implements CommandInterface
{
    /**
     * @param string $userSlug
     * @param int $userProductId
     */
    public function __construct(
        public string $userSlug,
        public int    $userProductId,
    )
    {
    }

    /**
     * @param FormRequest $request
     * @return CommandInterface
     */
    public static function withForm(FormRequest $request): CommandInterface
    {
        return new self(
            userSlug: $request->get('user_slug'),
            userProductId: $request->get('user_product_id')
        );
    }
}
