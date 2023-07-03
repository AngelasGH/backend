<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\UserRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = User::all();

        return $user;
    }

    public function show(string $id)
    {
        $user = User::findOrFail($id);

        return $user;
    }

    public function store(UserRequest $request)
    {
        $validated = $request->validated();

        $validated['password'] = Hash::make($validated['password']);

        $user = User::create($validated);

        return $user;
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user = User::findOrFail($id);

        $user->delete();

        return $user;
    }

    public function image(UserRequest $request, string $id){
        $user = User::findOrFail($id);

        if(!is_null($user->image)){
            Storage::disk('public')->delete($user->image);
        }

        $user->image = $request -> file('image')->storePublicly('images', 'public');
        $user->save();

        return $user;
    }


}