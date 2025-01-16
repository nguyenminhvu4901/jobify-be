<?php

namespace App\Traits\CustomDate;

use Carbon\Carbon;

trait NormalizeDateTrait
{
    /**
     * Normalize the date fields in the request.
     *
     * @param array $fields
     * @return void
     */
    protected function normalizeDateFields(array $fields): void
    {
        foreach ($fields as $field) {
            if ($this->has($field)) {
                $this->merge([
                    $field => $this->normalizeDate($this->input($field)),
                ]);
            }
        }
    }

    /**
     * Normalize a single date value to Y-m-d format.
     *
     * @param string|null $date
     * @return string|null
     */
    private function normalizeDate(?string $date): ?string
    {
        try {
            return $date ? Carbon::parse($date)->format('Y-m-d') : null;
        } catch (\Exception $e) {
            return $date;
        }
    }
}
