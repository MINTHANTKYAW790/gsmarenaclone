<?php

namespace App\Http\Controllers;

use App\Models\Device;
use App\Models\Spec;
use App\Models\SpecCategory;
use App\Repositories\DeviceRepository;
use App\Repositories\SpecCategoryRepository;
use App\Repositories\SpecRepository;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;


class SpecController extends Controller
{
    protected $specRepository;
    protected $deviceRepository;
    protected $specCategoryRepository;

    public function __construct(
        SpecRepository $specRepository,
        DeviceRepository $deviceRepository,
        SpecCategoryRepository $specCategoryRepository,
    ) {
        $this->specRepository = $specRepository;
        $this->deviceRepository = $deviceRepository;
        $this->specCategoryRepository = $specCategoryRepository;
    }

    public function index(Request $request)
    {
        if ($request->ajax()) {

            $spec = $this->specRepository->getDatatableQuery();
            return Datatables::of($spec)
                ->addIndexColumn()
                ->addColumn('device_name', fn($row) => $row->name)
                ->addColumn('brand_name', fn($row) => $row->brand->name)
                ->addColumn(
                    'action',
                    function ($spec) {
                        $btn = '<div class="row m-sm-n1 justify-content-center">';
                        $btn = $btn . '<div class="mx-2 button-box text-center">
                                            <a rel="tooltip" class="button-size icon-primary"
                                                href="' . route('spec.edit', [$spec->id]) . '" data-original-title="" title="Edit">
                                                <i class="fas fa-pencil-alt"></i>
                                            </a>
                                        </div>';
                        $btn = $btn .  '<div class="mx-2 button-box text-center">
                             <form action="' . route('spec.destroy', $spec->id) . '" method="POST" id="del-role-' . $spec->id . '" class="d-inline">
                                <input type="hidden" name="_token" value="' . csrf_token() . '">
                                <input type="hidden" name="_method" value="DELETE">
                                <a rel="tooltip" class="button-size icon-primary destroy_btn"
                                                 data-origin="del-role-' . $spec->id . '" data-text="Are you sure you want to delete  ' . $spec->name . ' ?"  data-original-title="" title="Delete" >
                                                <i class="fas fa-trash"></i>
                                            </a>
                                </button>
                            </form></div>';
                        $btn .= '<div class="mx-2 button-box text-center">
                            <a href="' . route('spec.show', $spec->specs->first()?->id ?? 0) . '" class="button-size icon-primary" title="View">
                                <i class="fas fa-eye"></i>
                            </a>
                        </div>';
                        $btn = $btn . '</div>';
                        return $btn;
                    }
                )
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('spec.index');
    }

    public function create()
    {
        $devices = $this->deviceRepository->getAll();
        $spec_categories = $this->specCategoryRepository->getAll();
        return view('spec.create', compact('devices', 'spec_categories'));
    }

    public function store(Request $request)
    {
        $specs = $request->input('specs'); 

        foreach ($specs as $categoryId => $entries) {
            foreach ($entries as $entry) {
                $key = $entry['key'] ?? null;
                $value = $entry['value'] ?? null;

                if (!empty($key) && !empty($value)) {
                    Spec::create([
                        'device_id' => $request->device_id,
                        'spec_category_id' => $categoryId,
                        'key' => $key,
                        'value' => $value,
                    ]);
                }
            }
        }
        return redirect()->route('spec.index')->with('success', 'Spec created successfully.');
    }

    public function edit($deviceId)
    {
        $device = Device::with(['specs.category'])->findOrFail($deviceId);
        $spec_categories = SpecCategory::all();
        return view('spec.edit', compact('device', 'spec_categories'));
    }

    public function update(Request $request, $deviceId)
    {
        $device = Device::findOrFail($deviceId);
        $submittedSpecIds = [];
        foreach ($request->specs as $category_id => $specGroup) {
            foreach ($specGroup as $spec) {

                if (!empty($spec['id'])) {
                    $submittedSpecIds[] = $spec['id'];

                    Spec::where('id', $spec['id'])->update([
                        'key' => $spec['key'],
                        'value' => $spec['value'],
                    ]);
                } else {
                    info("in the else");
                    $exists = Spec::where('device_id', $deviceId)
                        ->where('spec_category_id', $category_id)
                        ->where('key', $spec['key'])
                        ->exists();

                    if ($exists) {
                        return redirect()->back()
                            ->withInput()
                            ->with('error', "Spec with key '{$spec['key']}' already exists.");
                    }

                    $newSpec = Spec::create([
                        'device_id' => $deviceId,
                        'spec_category_id' => $category_id,
                        'key' => $spec['key'],
                        'value' => $spec['value'],
                    ]);
                    $submittedSpecIds[] = $newSpec->id;
                }
            }
        }

        Spec::where('device_id', $deviceId)
            ->whereNotIn('id', $submittedSpecIds)
            ->delete();
        return redirect()->route('spec.index')->with('success', 'Specs updated successfully.');
    }

    public function show(Spec $spec)
    {
        $spec->load('device.brand', 'device.specs.category');
        return view('spec.show', compact('spec'));
    }

    public function destroy(Spec $spec)
    {
        $this->specRepository->destroy($spec);
        return redirect()
            ->route('spec.index')
            ->withSuccess('Spec deleted successfully.');
    }
}
