<?php

namespace App\Http\Controllers;

use App\Models\Device;
use App\Models\Feedback;
use App\Repositories\DeviceRepository;
use App\Repositories\FeedbackRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
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
        // Get the latest feedback for each device using a subquery
        $latestFeedbacks = Feedback::select('device_id', DB::raw('MAX(id) as latest_id'))
            ->groupBy('device_id');

        $feedbacks = Feedback::whereIn('id', $latestFeedbacks->pluck('latest_id'))
            ->latest()
            ->with(['user', 'device']) // eager load to prevent N+1
            ->paginate(6);
        return view('feedbacks', compact('feedbacks'));
    }


    public function create(Request $request)
    {
        $devices = $this->deviceRepository->getAll();
        $selectedDeviceId = $request->device_id;

        return view('createFeedback', compact('devices', 'selectedDeviceId'));
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
        return view('editFeedback', [
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
        $feedbacks = Feedback::where('device_id', $feedback->device_id)->get();
        info('feedbacks');
        info($feedbacks);
        return view('guestFeedback', compact('feedback', 'feedbacks'));
    }


    public function destroy(Feedback $feedback)
    {
        $this->feedbackRepository->destroy($feedback);
        return redirect()
            ->route('feedback.index')
            ->withSuccess('Feedback deleted successfully.');
    }
}
