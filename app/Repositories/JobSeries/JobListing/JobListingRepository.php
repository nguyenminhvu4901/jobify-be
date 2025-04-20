<?php

namespace App\Repositories\JobSeries\JobListing;

interface JobListingRepository
{
    public function storeDataWithTransaction(array $attributes = []): array;
}
