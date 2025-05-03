<?php

namespace App\Commands\JobSeries\Position\GetListSecondaryPosition;

use App\Commands\CommandInterface;
use Illuminate\Foundation\Http\FormRequest;

readonly class GetListSecondaryPositionCommand implements CommandInterface
{
    public function __construct(
        public int $mainPositionId
    ) {
    }

    public static function withForm(FormRequest $request): CommandInterface
    {
        return new self(
            mainPositionId: $request->input('main_position_id')
        );
    }
}
