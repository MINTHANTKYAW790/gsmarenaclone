<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Books;
use App\Models\Author;
use App\Models\Brand;
use App\Models\Device;
use App\Models\Genre;
use App\Models\PublishingHouse;
use App\Models\Review;
use App\Models\SavedDevices;
use App\Repositories\DeviceRepository;
use App\Repositories\ReviewRepository;
use Illuminate\Support\Facades\DB;

class WelcomeController extends Controller
{
    protected $deviceRepository;
    protected $reviewRepository;
    public function __construct(
        DeviceRepository $deviceRepository,
        ReviewRepository $reviewRepository
    ) {
        $this->deviceRepository = $deviceRepository;
        $this->reviewRepository = $reviewRepository;
    }


    public function index()
    {
        $brands = Brand::all();
        $devices = Device::with(['specs.category'])->paginate(8);
        $savedDevices = SavedDevices::with('device.brand')
            ->where('user_id', auth()->id())
            ->get();
        info("in the filterByBrand method");
        info($savedDevices);
        $savedDeviceIds = $savedDevices->pluck('device_id')->toArray();

        return view('welcome', compact('devices', 'brands', 'savedDeviceIds'));
    }

    public function filterByBrand($id)
    {
        $brands = Brand::all();
        $devices = Device::where('brand_id', $id)->paginate(8);
        $selectedBrand = Brand::findOrFail($id);
        return view('welcome', compact('brands', 'devices', 'selectedBrand'));
    }

    public function deviceReview($id)
    {
        $brands = Brand::all();
        $device = Device::with('reviews')->findOrFail($id);
        $review = Review::where('device_id', $id)->first();
        if (!$review) {
            $review = Review::where('id', $id)->first();
        }


        return view('guestReview', compact('brands', 'device', 'review'));
    }

    public function reviews()
    {
        $reviews = Review::latest()->paginate(6);
        return view('reviews', compact('reviews'));
    }

    public function showDevices(Device $device)
    {
        info("in the showDevices method");
        info($device);
        $brands = Brand::all();
        $device->load('brand', 'specs.category');
        return view('deviceDetail', compact('device', 'brands',));
    }

    public function savedlist()
    {
        $savedDevices = SavedDevices::with('device.brand')
            ->where('user_id', auth()->id())
            ->paginate(8);
        return view('savedList', compact('savedDevices'));
    }

    public function deleteFromSavedList($id)
    {
        $savedDevice = SavedDevices::where('user_id', auth()->id())
            ->where('id', $id)
            ->firstOrFail();

        $savedDevice->delete();

        return redirect()->route('savedlist')->with('success', 'Device removed from saved list.');
    }

    public function createReview()
    {
        $devices = $this->deviceRepository->getAll();
        return view('createReview', compact('devices'));
    }

    public function storeReview(Request $request)
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
        return redirect()->route('reviews')->with('success', 'Review created successfully.');
    }
}
