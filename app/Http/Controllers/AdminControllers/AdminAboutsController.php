<?php

namespace App\Http\Controllers\AdminControllers;

use App\Http\Controllers\Controller;
use App\Models\Abouts;
use Illuminate\Http\Request;

class AdminAboutsController extends Controller
{
    public function edit()
    {
        return view('admin_dashboard.abouts.edit', [
            'abouts' => Abouts::find(1),
        ]);
    }

    public function update()
    {
        $validated = request()->validate([
            'first_text' => 'required|min:50',
            'second_text' => 'required|min:50',
            'our_mission' => 'required',
            'our_vision' => 'required',
            'services' => 'required',
            'first_image' => 'image',
            'second_image' => 'image',
        ]);

        if (request()->has('first_image')) {
            $first_image = request()->file('first_image');
            $path = $first_image->store('setting', 'public');
            $validated['first_image'] = $path;

        }

        if (request()->has('second_image')) {
            $second_image = request()->file('second_image');
            $path = $second_image->store('setting', 'public');
            $validated['second_image'] = $path;
        }

        Abouts::find(1)->update($validated);

        return redirect()->route('admin.abouts.edit')->with('success', 'About has been updated');
    }
}
