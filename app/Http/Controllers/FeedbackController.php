<?php

namespace App\Http\Controllers;

use App\Models\Device;
use App\Models\Feedback;
use App\Repositories\DeviceRepository;
use App\Repositories\FeedbackRepository;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;


class FeedbackController extends Controller
{
    protected $feedbackRepository;
    protected $deviceRepository;

    public function __construct(
        FeedbackRepository $feedbackRepository,
        DeviceRepository $deviceRepository
    ) {
        $this->feedbackRepository = $feedbackRepository;
        $this->deviceRepository = $deviceRepository;
    }

    public function index(Request $request)
    {
        if ($request->ajax()) {

            $feedback = $this->feedbackRepository->getDatatableQuery();
            return Datatables::of($feedback)
                ->addIndexColumn()
                ->addColumn('device_name', function ($feedback) {
                    return $feedback->device ? $feedback->device->name : 'N/A';
                })
                ->addColumn('user_name', function ($feedback) {
                    return $feedback->user ? $feedback->user->name : 'N/A';
                })
                ->addColumn('image_1', function ($feedback) {
                    $imageUrl = asset('images/' . basename($feedback->image_1));
                    return '<img src="' . $imageUrl . '" alt="Image 1" height="40">';
                })
                ->addColumn('image_2', function ($feedback) {
                    $imageUrl = asset('images/' . basename($feedback->image_2));
                    return '<img src="' . $imageUrl . '" alt="Image 2" height="40">';
                })
                ->addColumn(
                    'action',
                    function ($feedback) {
                        $btn = '<div class="row m-sm-n1 justify-content-center">';
                        $btn = $btn . '<div class="mx-2 button-box text-center">
                                            <a rel="tooltip" class="button-size icon-primary"
                                                href="' . route('feedback.edit', [$feedback->id]) . '" data-original-title="" title="Edit">
                                                <i class="fas fa-pencil-alt"></i>
                                            </a>
                                        </div>';
                        $btn = $btn .  '<div class="mx-2 button-box text-center">
                             <form action="' . route('feedback.destroy', $feedback->id) . '" method="POST" id="del-role-' . $feedback->id . '" class="d-inline">
                                <input type="hidden" name="_token" value="' . csrf_token() . '">
                                <input type="hidden" name="_method" value="DELETE">
                                <a rel="tooltip" class="button-size icon-primary destroy_btn"
                                                 data-origin="del-role-' . $feedback->id . '" data-text="Are you sure you want to delete  ' . $feedback->name . ' ?"  data-original-title="" title="Delete" >
                                                <i class="fas fa-trash"></i>
                                            </a>
                                </button>
                            </form></div>';
                        $btn .= '<div class="mx-2 button-box text-center">
                            <a href="' . route('feedback.show', $feedback->id) . '" class="button-size icon-primary" title="View">
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
        return view('feedback.index');
    }

    public function create()
    {
        $devices = $this->deviceRepository->getAll();
        return view('feedback.create', compact('devices'));
    }

    public function store(Request $request)
    {
        $data = $request->all();
        $image1FileName = auth()->id() . '_' . time() . '.' . $request->file('image_1')->extension();
        $data['image_1'] = $request->file('image_1')->move(public_path('images'), $image1FileName);
        $data['image_1'] = $image1FileName;
        $data['user_id'] = auth()->id();
        $this->feedbackRepository->create($data);
        return redirect()->route('feedback.index')->with('success', 'Feedback created successfully.');
    }

    public function edit(Feedback $feedback)
    {
        $device = Device::with(['specs.category'])->findOrFail($feedback->device_id);
        return view('feedback.edit', [
            'feedback' => $feedback,
            'device' => $device,
        ]);
    }

    public function update(Request $request, Feedback $feedback)
    {
        $image1FileName = $feedback->image_1;
        if ($request->hasFile('image_1')) {
            $image1FileName = auth()->id() . '_' . time() . '.' . $request->file('image_1')->extension();
            $request->file('image_1')->move(public_path('images'), $image1FileName);
        }
        $data = $request->all();
        $data['image_1'] = $image1FileName;
        $this->feedbackRepository->update($data, $feedback->id);
        return redirect()->route('feedback.index')->with('success', 'Feedback updated successfully.');
    }

    public function show(Feedback $feedback)
    {
        $device = Device::with(['specs.category'])->findOrFail($feedback->device_id);
        return view('feedback.show', compact('feedback', 'device'));
    }


    public function destroy(Feedback $feedback)
    {
        $this->feedbackRepository->destroy($feedback);
        return redirect()
            ->route('feedback.index')
            ->withSuccess('Feedback deleted successfully.');
    }
}
