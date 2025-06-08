<?php


namespace App\Repositories;

use App\Models\Feedback;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use InvalidArgumentException;

class FeedbackRepository
{
    /**
     * Feedback $feedback
     */
    protected Feedback $feedback;

    /**
     * Constructor for FeedbackRepository.
     */
    public function __construct(
        Feedback $feedback,
    ) {
        $this->feedback = $feedback;
    }

    /**
     * Get Social City.
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getBrands()
    {
        $brands = $this->feedback->get();
        return $brands;
    }

    /**
     * Get Social City for admin portal.
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getDatatableQuery()
    {
        $brands =  $this->feedback->get();
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
            $feedback = $this->feedback->create($data);
        } catch (Exception $exc) {
            DB::rollBack();
            Log::error($exc);
            throw new InvalidArgumentException('Unable to create social feedback');
        }
        DB::commit();
        return $feedback;
    }

    /**
     * Autor : MTK
     * Get social city eloquent query for admin datatable.
     *
     * @return \Eloquent
     */
    public function getById($id)
    {
        return $this->feedback
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
            $group = $this->feedback->findOrFail($brand_id);
            $result = $group->update($data);
        } catch (Exception $exc) {
            DB::rollBack();
            Log::error($exc);
            throw new InvalidArgumentException('Unable to update social feedback.');
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
        return $this->feedback->all();
    }

    /**
     * Delete social city.
     *
     * @return boolean
     */
    public function destroy(Feedback $feedback)
    {
        return $feedback->delete();
    }
}
