<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Device;

class CompareController extends Controller
{
    public function index()
    {
        $brands = Brand::all();
        return view('compare.index', compact('brands'));
    }

    public function loadDevice($id)
    {
        $device = Device::with(['specs.category'])->findOrFail($id);

         $response = response()->json([
            'name' => $device->name,
            'image_url' => $device->image_url,
            'specs' => $device->specs->map(function ($spec) {
                return [
                    'key' => $spec->key,
                    'value' => $spec->value,
                    'category' => [
                        'name' => optional($spec->category)->name,
                    ]
                ];
            })->toArray()
        ]);
        info($response);
         return $response;
    }

    public function comparePage()
    {
        $brands = Brand::all();
        return view('compare', compact('brands'));
    }
}
