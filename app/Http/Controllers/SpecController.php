<?php

namespace App\Http\Controllers;

use App\Models\Spec;
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
        return view('spec.create',compact('devices', 'spec_categories'));
    }

    public function store(Request $request)
    {
        $data = $request->all();
        $this->specRepository->create($data);
        return redirect()->route('spec.index')->with('success', 'Spec created successfully.');
    }

    public function edit(Spec $spec)
    {
        return view('spec.edit', [
            'spec' => $spec,
        ]);
    }

    public function update(Request $request, Spec $spec)
    {
        info($spec);
        info("inside of update");
        $data = $request->all();
        $this->specRepository->update($data, $spec->id);
        return redirect()->route('spec.index')->with('success', 'Spec updated successfully.');
    }

    public function destroy(Spec $spec)
    {
        $this->specRepository->destroy($spec);
        return redirect()
            ->route('spec.index')
            ->withSuccess('Spec deleted successfully.');
    }
}
