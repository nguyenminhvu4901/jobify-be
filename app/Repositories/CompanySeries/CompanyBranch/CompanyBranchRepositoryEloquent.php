<?php

namespace App\Repositories\CompanySeries\CompanyBranch;

use App\Entities\CompanySeries\CompanyBranch\CompanyBranch;
use App\Repositories\BaseRepository;
use Exception;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class CompanyBranchRepositoryEloquent extends BaseRepository implements CompanyBranchRepository
{
    public function model(): string
    {
        return CompanyBranch::class;
    }

    /**
     * @return LengthAwarePaginator|Collection|mixed|null
     */
    public function create(array $attributes): mixed
    {
        DB::beginTransaction();

        try {
            $companyBranch = $this->model->create($attributes);

            DB::commit();

            return $companyBranch->refresh();
        } catch (Exception) {
            DB::rollBack();

            return null;
        }
    }

    public function checkExistByIdAndCompanyId($companyBranchId, $companyId): mixed
    {
        return $this->model
            ->whereById($companyBranchId)
            ->whereByCompanyId($companyId)
            ->exists();
    }
}
