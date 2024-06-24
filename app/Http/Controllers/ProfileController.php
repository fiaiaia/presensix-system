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
    public function changeProfile(Request $request): View
    {
        return view('user.main.changeProfile');
    }

    public function updateProfile(Request $request){
        try {
            if($request->avatarData){
                $update = Profiles::updateOrCreate(
                    ["user_id" => auth()->user()->id],
                    ["profile" => $request->avatarData]);
    
                $data_response = [
                    'status' => 200,
                    'output' => 'Avatar changed successfully!'
                ];
            }else{
                $data_response = [
                'status' => 404,
                'output' => 'Something Wrong!'
                ];
            }
        }catch (\Throwable $th) {
          DB::rollBack();
          $message = $th->getMessage();
          $data_response = [
              'status' => 500,
              'output' => $message
          ];
        }
        return response()->json(['data'=>$data_response]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $request->user()->fill($request->validated());

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        $request->user()->save();

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
}
