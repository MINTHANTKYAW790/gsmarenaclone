<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Books;
use App\Models\Author;
use App\Models\Brand;
use App\Models\Device;
use App\Models\Genre;
use App\Models\PublishingHouse;

class WelcomeController extends Controller
{
    public function index()
    {
        $brands = Brand::all();
        $devices = Device::all();
        // $books = Books::latest()->paginate(5);
        return view('welcome', compact('devices', 'brands'));
    }

    public function filterByBrand($id)
    {
        $brands = Brand::all();
        $devices = Device::where('brand_id', $id)->get();
        $selectedBrand = Brand::findOrFail($id);
        return view('welcome', compact('brands', 'devices', 'selectedBrand'));
    }
}
