<?php

namespace App\Repositories\CompanySeries\Company;

use App\Entities\CompanySeries\Company\Company;
use App\Repositories\BaseRepository;
use Exception;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class CompanyRepositoryEloquent extends BaseRepository implements CompanyRepository
{
    /**
     * @return string
     */
    public function model(): string
    {
        return Company::class;
    }

    /**
     * @param array $attributes
     * @return LengthAwarePaginator|Collection|mixed|null
     */
    public function create(array $attributes): mixed
    {
        DB::beginTransaction();

        try {
            $company = $this->model->create($attributes);

            DB::commit();

            return $company->refresh();
        }catch (Exception){
            DB::rollBack();

            return null;
        }
    }
}
