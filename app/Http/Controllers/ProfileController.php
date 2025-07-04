<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $user = $request->user();
        $user->fill($request->validated());

        if ($request->hasFile('profile_photo')) {
            // Eski fotoğrafı sil
            if ($user->profile_photo && \Storage::disk('public')->exists('avatars/' . $user->profile_photo)) {
                \Storage::disk('public')->delete('avatars/' . $user->profile_photo);
            }
            // Yeni fotoğrafı kaydet
            $file = $request->file('profile_photo');
            $filename = uniqid() . '.' . $file->getClientOriginalExtension();
            $file->storeAs('avatars', $filename, 'public');
            $user->profile_photo = $filename;
        }

        if ($user->isDirty('email')) {
            $user->email_verified_at = null;
        }

        $user->save();

        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }

    public function show(\App\Models\User $user)
    {
        $user->load(['posts']);
        return view('profile.show', compact('user'));
    }

    public function makeAdmin(Request $request, \App\Models\User $user)
    {
        $user->role_id = 0;
        $user->save();
        return redirect()->back()->with('success', 'Kullanıcıya admin yetkisi verildi!');
    }

    public function deleteUser(Request $request, \App\Models\User $user)
    {
        // Admin kullanıcıyı silmeye izin verme
        if ($user->isAdmin()) {
            return redirect()->back()->with('error', 'Admin kullanıcı silinemez!');
        }
        $user->delete();
        return redirect()->back()->with('success', 'Kullanıcı başarıyla silindi!');
    }
}
