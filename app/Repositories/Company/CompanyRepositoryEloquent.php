<?php

namespace App\Repositories\Company;

use App\Entities\Company\Company;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Prettus\Repository\Eloquent\BaseRepository;

class CompanyRepositoryEloquent extends BaseRepository implements CompanyRepository
{
    public function model()
    {
        return Company::class;
    }

    /**
     * @param array $data
     * @return LengthAwarePaginator|Collection|mixed|null
     */
    public function create(array $data): mixed
    {
        DB::beginTransaction();

        try {
            $company = $this->model->create($data);

            DB::commit();

            return $company->refresh();
        }catch (\Exception $e){
            DB::rollBack();

            return null;
        }
    }


}
