<?php

namespace App\Http\Controllers;

use App\Models\Device;
use App\Repositories\BrandRepository;
use App\Repositories\DeviceRepository;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;


class DeviceController extends Controller
{
    protected $deviceRepository;
    protected $brandRepository;

    public function __construct(
        DeviceRepository $deviceRepository,
        BrandRepository $brandRepository,
    ) {
        $this->deviceRepository = $deviceRepository;
        $this->brandRepository = $brandRepository;
    }

    public function index(Request $request)
    {
        if ($request->ajax()) {

            $device = $this->deviceRepository->getDatatableQuery();
            return Datatables::of($device)
                ->addIndexColumn()
                ->addColumn('brand_name', function ($device) {
                    return $device->brand->name ?? '';
                })
                ->addColumn('image_url', function ($brand) {
                    $imageUrl = asset('images/' . basename($brand->image_url)); // or storage path if using Storage
                    return '<img src="' . $imageUrl . '" alt="Logo" height="40">';
                })
                ->addColumn(
                    'action',
                    function ($device) {
                        $btn = '<div class="row m-sm-n1 justify-content-center">';
                        $btn = $btn . '<div class="mx-2 button-box text-center">
                                            <a rel="tooltip" class="button-size icon-primary"
                                                href="' . route('device.edit', [$device->id]) . '" data-original-title="" title="Edit">
                                                <i class="fas fa-pencil-alt"></i>
                                            </a>
                                        </div>';
                        $btn = $btn .  '<div class="mx-2 button-box text-center">
                             <form action="' . route('device.destroy', $device->id) . '" method="POST" id="del-role-' . $device->id . '" class="d-inline">
                                <input type="hidden" name="_token" value="' . csrf_token() . '">
                                <input type="hidden" name="_method" value="DELETE">
                                <a rel="tooltip" class="button-size icon-primary destroy_btn"
                                                 data-origin="del-role-' . $device->id . '" data-text="Are you sure you want to delete  ' . $device->name . ' ?"  data-original-title="" title="Delete" >
                                                <i class="fas fa-trash"></i>
                                            </a>
                                </button>
                            </form></div>';
                        $btn = $btn . '</div>';
                        return $btn;
                    }
                )
                ->rawColumns(['image_url', 'action'])
                ->make(true);
        }
        return view('device.index');
    }

    public function create()
    {
        $brands = $this->brandRepository->getDatatableQuery();
        return view('device.create', compact('brands'));
    }

    public function store(Request $request)
    {
        info($request);
        $data = $request->all();
        $imageFileName = auth()->id() . '_' . time() . '.' . $request->file('image_url')->extension();
        $data['image_url'] = $request->file('image_url')->move(public_path('images'), $imageFileName);
        info("data");
        info($data);
        
        $data['image_url'] = $imageFileName;
        $this->deviceRepository->create($data);
        return redirect()->route('device.index')->with('success', 'Device created successfully.');
    }

    public function edit(Device $device)
    {
        return view('device.edit', [
            'device' => $device,
        ]);
    }

    public function update(Request $request, Device $device)
    {
        info($device);
        info("inside of update");
        info($request);
        $imageFileName = $device->image_url;
        if ($request->hasFile('image_url')) {
            $imageFileName = auth()->id() . '_' . time() . '.' . $request->file('image_url')->extension();
            $request->file('image_url')->move(public_path('images'), $imageFileName);
        }
        info($imageFileName);
        $data = $request->all();
        $data['image_url'] = $imageFileName;
        info($data);
        $this->deviceRepository->update($data, $device->id);
        return redirect()->route('device.index')->with('success', 'Device updated successfully.');
    }

    public function destroy(Device $device)
    {
        $this->deviceRepository->destroy($device);
        return redirect()
            ->route('device.index')
            ->withSuccess('Device deleted successfully.');
    }
}
