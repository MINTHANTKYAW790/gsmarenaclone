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

class WelcomeController extends Controller
{
    public function index()
    {
        $brands = Brand::all();
        $devices = Device::with(['specs.category'])->paginate(8);
        return view('welcome', compact('devices', 'brands'));
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
        $review = $device->reviews()->findOrFail($id);
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
}
