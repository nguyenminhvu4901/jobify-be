<?php

namespace App\Rules\Resource;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Support\Facades\DB;
use Illuminate\Translation\PotentiallyTranslatedString;

readonly class ExistsInResourceRelation implements ValidationRule
{
    public function __construct(
        protected string|int|null $foreignValue,
        protected string $foreignTable,
        protected string $localTable,
        protected ?string $foreignKey = 'user_example_id',
        protected ?string $localKey = 'id'
    ) {
    }

    /**
     * Run the validation rule.
     *
     * @param  Closure(string, ?string=): PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        if (empty($this->foreignValue)) {
            return;
        }

        $exists = DB::table($this->localTable)
            ->where($this->localKey, $value)
            ->where($this->foreignKey, $this->foreignValue)
            ->exists();

        if (! $exists) {
            $fail(__('validation.custom.invalid_attachment'));
        }
    }
}
