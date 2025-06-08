<?php

namespace App\Http\Controllers;

use App\Models\SpecCategory;
use App\Repositories\SpecCategoryRepository;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;


class SpecCategoryController extends Controller
{
    protected $specCategoryRepository;

    public function __construct(
        SpecCategoryRepository $specCategoryRepository,
    ) {
        $this->specCategoryRepository = $specCategoryRepository;
    }

    public function index(Request $request)
    {
        if ($request->ajax()) {

            $specCategory = $this->specCategoryRepository->getDatatableQuery();
            return Datatables::of($specCategory)
                ->addIndexColumn()
                ->addColumn('action',function ($specCategory) {
                        $btn = '<div class="row m-sm-n1 justify-content-center">';
                            $btn = $btn . '<div class="mx-2 button-box text-center">
                                            <a rel="tooltip" class="button-size icon-primary"
                                                href="' . route('category.edit', [$specCategory->id]) . '" data-original-title="" title="Edit">
                                                <i class="fas fa-pencil-alt"></i>
                                            </a>
                                        </div>';
                            $btn = $btn .  '<div class="mx-2 button-box text-center">
                             <form action="' . route('category.destroy', $specCategory->id) . '" method="POST" id="del-role-' . $specCategory->id . '" class="d-inline">
                                <input type="hidden" name="_token" value="' . csrf_token() . '">
                                <input type="hidden" name="_method" value="DELETE">
                                <a rel="tooltip" class="button-size icon-primary destroy_btn"
                                                 data-origin="del-role-' . $specCategory->id . '" data-text="Are you sure you want to delete  ' . $specCategory->name . ' ?"  data-original-title="" title="Delete" >
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
        return view('category.index');
    }

    public function create()
    {
        return view('category.create');
    }

    public function store(Request $request)
    {
        $data = $request->all();
        $this->specCategoryRepository->create($data);
        return redirect()->route('category.index')->with('success', 'SpecCategory created successfully.');
    }

    public function edit($id)
    {
        $specCategory = SpecCategory::FindOrFail($id);
        return view('category.edit', [
            'specCategory' => $specCategory,
        ]);
    }

    public function update(Request $request, $id)
    {
        $data = $request->all();
        $this->specCategoryRepository->update($data, $id);
        return redirect()->route('category.index')->with('success', 'SpecCategory updated successfully.');
    }

    public function destroy(SpecCategory $specCategory)
    {
        $this->specCategoryRepository->destroy($specCategory);
        return redirect()
            ->route('category.index')
            ->withSuccess('SpecCategory deleted successfully.');
    }
}
