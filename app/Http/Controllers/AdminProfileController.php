<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AdminProfileController extends Controller
{
    public function update(Request $request): RedirectResponse
    {
        $validator = Validator::make($request->all(), [
            'name' => ['required', 'string', 'max:255'],
            'old_password' => ['required', 'string'],
            'new_password' => ['required', 'string', 'min:8'],
        ]);
        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput(['name' => $request->input('name')])
                ->with('open_profile_modal', true);
        }
        $data = $validator->validated();

        $admin = $request->user();
        if (! Hash::check($data['old_password'], $admin->password)) {
            return back()->withErrors(['old_password' => 'Password lama tidak sesuai.'])
                ->withInput(['name' => $data['name']])->with('open_profile_modal', true);
        }

        $admin->name = $data['name'];
        $admin->password = Hash::make($data['new_password']);
        $admin->save();

        return back()->with('success', 'Profil admin berhasil diperbarui.');
    }
}
