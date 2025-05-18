<?php


namespace App\Repositories;

use App\Models\SpecCategory;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use InvalidArgumentException;

class SpecCategoryRepository
{
    /**
     * SpecCategory $specCategory
     */
    protected SpecCategory $specCategory;

    /**
     * Constructor for SpecCategoryRepository.
     */
    public function __construct(
        SpecCategory $specCategory,
    ) {
        $this->specCategory = $specCategory;
    }

    /**
     * Get Social City.
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getSpecCategories()
    {
        $specCategories = $this->specCategory->get();
        return $specCategories;
    }

    /**
     * Get Social City for admin portal.
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getDatatableQuery()
    {
        $brands =  $this->specCategory->get();
        return $brands;
    }

    /**
     * Author : MTK
     * Save social city with request data.
     *
     * @param array $data
     * @return Model
     */
    public function create(array $data)
    {
        DB::beginTransaction();
        try {
            $specCategory = $this->specCategory->create($data);
        } catch (Exception $exc) {
            DB::rollBack();
            Log::error($exc);
            throw new InvalidArgumentException('Unable to create social specCategory');
        }
        DB::commit();
        return $specCategory;
    }

    /**
     * Autor : MTK
     * Get social city eloquent query for admin datatable.
     *
     * @return \Eloquent
     */
    public function getById($id)
    {
        return $this->specCategory
            ->findOrFail($id);
    }

    /**
     * Author : MTK
     * Save social city with request data.
     *
     * @param array $data
     * @return Model
     */
    public function update(array $data, $brand_id)
    {
        info("inside of update repository");
        DB::beginTransaction();
        try {
            $group = $this->specCategory->findOrFail($brand_id);
            $result = $group->update($data);
        } catch (Exception $exc) {
            DB::rollBack();
            Log::error($exc);
            throw new InvalidArgumentException('Unable to update social specCategory.');
        }
        DB::commit();
        return $result;
    }

    /**
     * Author : MTK
     * Get social city eloquent query for admin datatable.
     *
     * @return \Eloquent
     */
    public function getAll()
    {
        return $this->specCategory->all();
    }

    /**
     * Delete social city.
     *
     * @return boolean
     */
    public function destroy(SpecCategory $specCategory)
    {
        return $specCategory->delete();
    }
}
