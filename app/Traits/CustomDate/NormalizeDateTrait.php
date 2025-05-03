<?php

namespace App\Traits\CustomDate;

use Carbon\Carbon;

trait NormalizeDateTrait
{
    /**
     * Normalize the date fields in the request.
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
     */
    private function normalizeDate(?string $date): ?string
    {
        if (! $date) {
            return null;
        }

        $parts = explode('-', $date);

        if (count($parts) !== 3) {
            return $date;
        }

        [$year, $month, $day] = $parts;

        $year = (int) $year;
        $month = (int) $month;
        $day = (int) $day;

        if (! checkdate($month, $day, $year)) {
            return $date;
        }

        return Carbon::createFromDate($year, $month, $day)->format('Y-m-d');
    }
}
