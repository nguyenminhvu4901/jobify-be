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

    /**
     * @param $company
     * @param $operationTypes
     * @return Company|null
     */
    public function syncOperationTypes($company, $operationTypes): ?Company
    {
        DB::beginTransaction();

        try {
            $company->operationTypes()->sync($operationTypes);

            DB::commit();

            return $company->refresh();
        }catch (Exception){
            DB::rollBack();

            return null;
        }
    }

    /**
     * @param $company
     * @param $businessSectors
     * @return Company|null
     */
    public function syncBusinessSectors($company, $businessSectors): ?Company
    {
        DB::beginTransaction();

        try {
            $company->businessSectors()->sync($businessSectors);

            DB::commit();

            return $company->refresh();
        }catch (Exception){
            DB::rollBack();

            return null;
        }
    }
}
