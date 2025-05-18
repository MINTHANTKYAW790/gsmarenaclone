<?php


namespace App\Repositories;

use App\Models\Device;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use InvalidArgumentException;

class DeviceRepository
{
    /**
     * Device $device
     */
    protected Device $device;

    /**
     * Constructor for DeviceRepository.
     */
    public function __construct(
        Device $device,
    ) {
        $this->device = $device;
    }

    /**
     * Get Social City.
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getDevices()
    {
        $devices = $this->device->get();
        return $devices;
    }

    /**
     * Get Social City for admin portal.
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getDatatableQuery()
    {
        $brands =  $this->device->get();
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
            $device = $this->device->create($data);
        } catch (Exception $exc) {
            DB::rollBack();
            Log::error($exc);
            throw new InvalidArgumentException('Unable to create social device');
        }
        DB::commit();
        return $device;
    }

    /**
     * Autor : MTK
     * Get social city eloquent query for admin datatable.
     *
     * @return \Eloquent
     */
    public function getById($id)
    {
        return $this->device
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
            $group = $this->device->findOrFail($brand_id);
            $result = $group->update($data);
        } catch (Exception $exc) {
            DB::rollBack();
            Log::error($exc);
            throw new InvalidArgumentException('Unable to update social device.');
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
        return $this->device->all();
    }

    /**
     * Delete social city.
     *
     * @return boolean
     */
    public function destroy(Device $device)
    {
        return $device->delete();
    }
}
