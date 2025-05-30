<?php


namespace App\Repositories;

use App\Models\Review;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use InvalidArgumentException;

class ReviewRepository
{
    /**
     * Review $review
     */
    protected Review $review;

    /**
     * Constructor for ReviewRepository.
     */
    public function __construct(
        Review $review,
    ) {
        $this->review = $review;
    }

    /**
     * Get Social City.
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getBrands()
    {
        $brands = $this->review->get();
        return $brands;
    }

    /**
     * Get Social City for admin portal.
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getDatatableQuery()
    {
        $brands =  $this->review->get();
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
            $review = $this->review->create($data);
        } catch (Exception $exc) {
            DB::rollBack();
            Log::error($exc);
            throw new InvalidArgumentException('Unable to create social review');
        }
        DB::commit();
        return $review;
    }

    /**
     * Autor : MTK
     * Get social city eloquent query for admin datatable.
     *
     * @return \Eloquent
     */
    public function getById($id)
    {
        return $this->review
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
            $group = $this->review->findOrFail($brand_id);
            $result = $group->update($data);
        } catch (Exception $exc) {
            DB::rollBack();
            Log::error($exc);
            throw new InvalidArgumentException('Unable to update social review.');
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
        return $this->review->all();
    }

    /**
     * Delete social city.
     *
     * @return boolean
     */
    public function destroy(Review $review)
    {
        return $review->delete();
    }
}
