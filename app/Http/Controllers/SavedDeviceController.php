<?php

namespace App\Http\Controllers;

use App\Models\SavedDevices;
use App\Models\Device;
use Illuminate\Support\Facades\Auth;

class SavedDeviceController extends Controller
{
    public function index()
    {
        $savedDevices = SavedDevices::with('device')->where('user_id', Auth::id())->get();
        return view('savedDevices.index', compact('savedDevices'));
    }

    public function store(Device $device)
    {
        
        info($device);
        SavedDevices::firstOrCreate([
            'user_id' => Auth::id(),
            'device_id' => $device->id,
        ]);

        return back()->with('success', 'Device saved!');
    }

    public function destroy($id)
    {
        $savedDevice = SavedDevices::where('id', $id)->where('user_id', Auth::id())->first();

        if ($savedDevice) {
            $savedDevice->delete();
            return back()->with('success', 'Device removed.');
        }

        return back()->with('error', 'Not found.');
    }
}

