<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Symfony\Contracts\Service\Attribute\Required;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required'], // Ganti 'email' dengan field lain
            'password' => ['required'],
        ]);

        $user = User::where('email', $request->email)->first();

        if (Auth::attempt($credentials)) {
            $token = $user->createToken('auth_token')->plainTextToken;
            return response([
                'user' => $user,
                'token' => $token
            ], 200);
        } else {
            return response([
                'message' => 'Invalid Credentials'
            ], 401);
        }
    }

    public function logOut(Request $request)
    {
        $request->user()->currentAccessToken()->delete();

        return response(['message' => 'Logged Out'], 200);
    }

    public function updateProfile(Request $request)
    {

        $request->validate([
            'image_url' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'face_embedded' => 'required',
        ]);

        $user   = $request->user();

        $image  = $request->file('image_url');
        $face_embedded  = $request->face_embedded;

        $image->storeAs('public/images', $image->hashName());
        $user->image_url    = $image->hashName();
        $user->face_embedded = $face_embedded;
        $user->save();

        return response([
            'message'   => 'Profile Updated',
            'data'      =>$user
        ], 200);
    }
}
