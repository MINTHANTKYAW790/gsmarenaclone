<?php

namespace App\Http\Controllers;

use App\Models\Review;
use App\Repositories\ReviewRepository;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;


class ReviewController extends Controller
{
    protected $reviewRepository;

    public function __construct(
        ReviewRepository $reviewRepository,
    ) {
        $this->reviewRepository = $reviewRepository;
    }

    public function index(Request $request)
    {
        if ($request->ajax()) {

            $review = $this->reviewRepository->getDatatableQuery();
            return Datatables::of($review)
                ->addIndexColumn()
            ->addColumn('logo_url', function ($review) {
                $imageUrl = asset('images/' . basename($review->logo_url)); // or storage path if using Storage
                return '<img src="' . $imageUrl . '" alt="Logo" height="40">';
            })
                ->addColumn('action',function ($review) {
                        $btn = '<div class="row m-sm-n1 justify-content-center">';
                            $btn = $btn . '<div class="mx-2 button-box text-center">
                                            <a rel="tooltip" class="button-size icon-primary"
                                                href="' . route('review.edit', [$review->id]) . '" data-original-title="" title="Edit">
                                                <i class="fas fa-pencil-alt"></i>
                                            </a>
                                        </div>';
                            $btn = $btn .  '<div class="mx-2 button-box text-center">
                             <form action="' . route('review.destroy', $review->id) . '" method="POST" id="del-role-' . $review->id . '" class="d-inline">
                                <input type="hidden" name="_token" value="' . csrf_token() . '">
                                <input type="hidden" name="_method" value="DELETE">
                                <a rel="tooltip" class="button-size icon-primary destroy_btn"
                                                 data-origin="del-role-' . $review->id . '" data-text="Are you sure you want to delete  ' . $review->name . ' ?"  data-original-title="" title="Delete" >
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
        return view('review.index');
    }

    public function create()
    {
        return view('review.create');
    }

    public function store(Request $request)
    {
        info($request);
        $data = $request->all();
        $imageFileName = auth()->id() . '_' . time() . '.' . $request->file('logo_url')->extension();
        $data['logo_url'] = $request->file('logo_url')->move(public_path('images'), $imageFileName);
        info("data");
        info($data);
        $this->reviewRepository->create($data);
        return redirect()->route('review.index')->with('success', 'Review created successfully.');
    }

    public function edit(Review $review)
    {
        return view('review.edit', [
            'review' => $review,
        ]);
    }

   public function update(Request $request, Review $review)
    {
        info($review);
        info("inside of update");
        info($request);
        $imageFileName = $review->logo_url;
        if ($request->hasFile('logo_url')) {
            $imageFileName = auth()->id() . '_' . time() . '.' . $request->file('logo_url')->extension();
            $request->file('logo_url')->move(public_path('images'), $imageFileName);
        }
        info($imageFileName);
        $data = $request->all();
        $data['logo_url'] = $imageFileName;
        info($data);
        $this->reviewRepository->update($data, $review->id);
        return redirect()->route('review.index')->with('success', 'Review updated successfully.');
    }

    public function destroy(Review $review)
    {
        $this->reviewRepository->destroy($review);
        return redirect()
            ->route('review.index')
            ->withSuccess('Review deleted successfully.');
    }
}
