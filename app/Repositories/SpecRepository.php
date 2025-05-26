<?php


namespace App\Repositories;

use App\Models\Device;
use App\Models\Spec;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use InvalidArgumentException;

class SpecRepository
{
    /**
     * Spec $spec
     */
    protected Spec $spec;

    /**
     * Constructor for SpecRepository.
     */
    public function __construct(
        Spec $spec,
    ) {
        $this->spec = $spec;
    }

    /**
     * Get Social City.
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getSpecs()
    {
        $specs = $this->spec->get();
        return $specs;
    }

    /**
     * Get Social City for admin portal.
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getDatatableQuery()
    {
        $devices = Device::with(['brand', 'specs.category'])->get(); // Eager load for display
        return $devices;
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
            $spec = $this->spec->create($data);
        } catch (Exception $exc) {
            DB::rollBack();
            Log::error($exc);
            throw new InvalidArgumentException('Unable to create social spec');
        }
        DB::commit();
        return $spec;
    }

    /**
     * Autor : MTK
     * Get social city eloquent query for admin datatable.
     *
     * @return \Eloquent
     */
    public function getById($id)
    {
        return $this->spec
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
            $group = $this->spec->findOrFail($brand_id);
            $result = $group->update($data);
        } catch (Exception $exc) {
            DB::rollBack();
            Log::error($exc);
            throw new InvalidArgumentException('Unable to update social spec.');
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
        return $this->spec->all();
    }

    /**
     * Delete social city.
     *
     * @return boolean
     */
    public function destroy(Spec $spec)
    {
        return $spec->delete();
    }
}
