<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Repositories\BrandRepository;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;


class BrandController extends Controller
{
    protected $brandRepository;

    public function __construct(
        BrandRepository $brandRepository,
    ) {
        $this->brandRepository = $brandRepository;
    }

    public function index(Request $request)
    {
        if ($request->ajax()) {

            $brand = $this->brandRepository->getDatatableQuery();
            return Datatables::of($brand)
                ->addIndexColumn()
            ->addColumn('logo_url', function ($brand) {
                $imageUrl = asset('images/' . basename($brand->logo_url)); // or storage path if using Storage
                return '<img src="' . $imageUrl . '" alt="Logo" height="40">';
            })
                ->addColumn('action',function ($brand) {
                        $btn = '<div class="row m-sm-n1 justify-content-center">';
                            $btn = $btn . '<div class="mx-2 button-box text-center">
                                            <a rel="tooltip" class="button-size icon-primary"
                                                href="' . route('brand.edit', [$brand->id]) . '" data-original-title="" title="Edit">
                                                <i class="fas fa-pencil-alt"></i>
                                            </a>
                                        </div>';
                            $btn = $btn .  '<div class="mx-2 button-box text-center">
                             <form action="' . route('brand.destroy', $brand->id) . '" method="POST" id="del-role-' . $brand->id . '" class="d-inline">
                                <input type="hidden" name="_token" value="' . csrf_token() . '">
                                <input type="hidden" name="_method" value="DELETE">
                                <a rel="tooltip" class="button-size icon-primary destroy_btn"
                                                 data-origin="del-role-' . $brand->id . '" data-text="Are you sure you want to delete  ' . $brand->name . ' ?"  data-original-title="" title="Delete" >
                                                <i class="fas fa-trash"></i>
                                            </a>
                                </button>
                            </form></div>';
                        $btn = $btn . '</div>';
                        return $btn;
                    }
                )
                ->rawColumns(['logo_url', 'action'])
                ->make(true);
        }
        return view('brand.index');
    }

    public function create()
    {
        return view('brand.create');
    }

    public function store(Request $request)
    {
        info($request);
        $data = $request->all();
        $imageFileName = auth()->id() . '_' . time() . '.' . $request->file('logo_url')->extension();
        $data['logo_url'] = $request->file('logo_url')->move(public_path('images'), $imageFileName);
        info("data");
        info($data);
        $this->brandRepository->create($data);
        return redirect()->route('brand.index')->with('success', 'Brand created successfully.');
    }

    public function edit(Brand $brand)
    {
        return view('brand.edit', [
            'brand' => $brand,
        ]);
    }

   public function update(Request $request, Brand $brand)
    {
        info($brand);
        info("inside of update");
        info($request);
        $imageFileName = $brand->logo_url;
        if ($request->hasFile('logo_url')) {
            $imageFileName = auth()->id() . '_' . time() . '.' . $request->file('logo_url')->extension();
            $request->file('logo_url')->move(public_path('images'), $imageFileName);
        }
        info($imageFileName);
        $data = $request->all();
        $data['logo_url'] = $imageFileName;
        info($data);
        $this->brandRepository->update($data, $brand->id);
        return redirect()->route('brand.index')->with('success', 'Brand updated successfully.');
    }

    public function destroy(Brand $brand)
    {
        $this->brandRepository->destroy($brand);
        return redirect()
            ->route('brand.index')
            ->withSuccess('Brand deleted successfully.');
    }
}
