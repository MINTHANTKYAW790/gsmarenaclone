<?php

namespace App\Http\Controllers;

use App\Models\Device;
use App\Models\Review;
use App\Repositories\DeviceRepository;
use App\Repositories\ReviewRepository;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;


class ReviewController extends Controller
{
    protected $reviewRepository;
    protected $deviceRepository;

    public function __construct(
        ReviewRepository $reviewRepository,
        DeviceRepository $deviceRepository
    ) {
        $this->reviewRepository = $reviewRepository;
        $this->deviceRepository = $deviceRepository;
    }

    public function index(Request $request)
    {
        if ($request->ajax()) {

            $review = $this->reviewRepository->getDatatableQuery();
            return Datatables::of($review)
                ->addIndexColumn()
                ->addColumn('device_name', function ($review) {
                    return $review->device ? $review->device->name : 'N/A';
                })
                ->addColumn('user_name', function ($review) {
                    return $review->user ? $review->user->name : 'N/A';
                })
                ->addColumn('image_1', function ($review) {
                    $imageUrl = asset('images/' . basename($review->image_1));
                    return '<img src="' . $imageUrl . '" alt="Image 1" height="40">';
                })
                ->addColumn('image_2', function ($review) {
                    $imageUrl = asset('images/' . basename($review->image_2));
                    return '<img src="' . $imageUrl . '" alt="Image 2" height="40">';
                })
                ->addColumn(
                    'action',
                    function ($review) {
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
                        $btn .= '<div class="mx-2 button-box text-center">
                            <a href="' . route('review.show', $review->id) . '" class="button-size icon-primary" title="View">
                                <i class="fas fa-eye"></i>
                            </a>
                        </div>';
                        $btn = $btn . '</div>';
                        return $btn;
                    }
                )
                ->rawColumns(['image_1', 'image_2', 'action'])
                ->make(true);
        }
        return view('review.index');
    }

    public function create()
    {
        $devices = $this->deviceRepository->getAll();
        return view('review.create', compact('devices'));
    }

    public function store(Request $request)
    {
        $data = $request->all();
        $image1FileName = auth()->id() . '_' . time() . '.' . $request->file('image_1')->extension();
        $data['image_1'] = $request->file('image_1')->move(public_path('images'), $image1FileName);

        $image2FileName = auth()->id() . '_' . time() . '.' . $request->file('image_2')->extension();
        $data['image_2'] = $request->file('image_2')->move(public_path('images'), $image2FileName);

        $data['image_1'] = $image1FileName;
        $data['image_2'] = $image2FileName;
        $data['user_id'] = auth()->id();
        $this->reviewRepository->create($data);
        return redirect()->route('review.index')->with('success', 'Review created successfully.');
    }

    public function edit(Review $review)
    {
        $device = Device::with(['specs.category'])->findOrFail($review->device_id);
        return view('review.edit', [
            'review' => $review,
            'device' => $device,
        ]);
    }

    public function update(Request $request, Review $review)
    {
        $image1FileName = $review->image_1;
        if ($request->hasFile('image_1')) {
            $image1FileName = auth()->id() . '_' . time() . '.' . $request->file('image_1')->extension();
            $request->file('image_1')->move(public_path('images'), $image1FileName);
        }
        $image2FileName = $review->image_2;
        if ($request->hasFile('image_2')) {
            $image2FileName = auth()->id() . '_' . time() . '.' . $request->file('image_2')->extension();
            $request->file('image_2')->move(public_path('images'), $image2FileName);
        }
        $data = $request->all();
        $data['image_1'] = $image1FileName;
        $data['image_2'] = $image2FileName;
        $this->reviewRepository->update($data, $review->id);
        return redirect()->route('review.index')->with('success', 'Review updated successfully.');
    }

    public function show(Review $review)
    {
        $device = Device::with(['specs.category'])->findOrFail($review->device_id);
        return view('review.show', compact('review', 'device'));
    }


    public function destroy(Review $review)
    {
        $this->reviewRepository->destroy($review);
        return redirect()
            ->route('review.index')
            ->withSuccess('Review deleted successfully.');
    }
}
