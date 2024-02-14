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
        // dd(auth()->user());
        // App\Models\User {#668 ▼ // app\Http\Controllers\ProfileController.php:19
        //     #connection: "mysql"
        //     #table: "users"
        //     #primaryKey: "id"
        //     #keyType: "int"
        //     +incrementing: true
        //     #with: []
        //     #withCount: []
        //     +preventsLazyLoading: false
        //     #perPage: 15
        //     +exists: true
        //     +wasRecentlyCreated: false
        //     #escapeWhenCastingToString: false
        //     #attributes: array:9 [▼
        //       "id" => 1
        //       "name" => "Urkuiash"
        //       "email" => "ukulya150992@gmail.com"
        //       "avatar" => "D:\ospanel\domains\laravel-10\storage\app/avatars/SSAcHLPU1cAUuYsQZk0hIv3y4JKBV67K9LweTIDi.jpg"
        //       "email_verified_at" => null
        //       "password" => "$2y$12$hwv4.gr6QR.6liwyq8JXrORiELVEfw8yTK3fAgX8qkxtY/c.bJ11S"
        //       "remember_token" => null
        //       "created_at" => "2024-02-05 09:34:31"
        //       "updated_at" => "2024-02-14 11:26:56"
        //     ]
        //     #original: array:9 [▶]
        //     #changes: []
        //     #casts: array:2 [▶]
        //     #classCastCache: []
        //     #attributeCastCache: []
        //     #dateFormat: null
        //     #appends: []
        //     #dispatchesEvents: []
        //     #observables: []
        //     #relations: []
        //     #touches: []
        //     +timestamps: true
        //     +usesUniqueIds: false
        //     #hidden: array:2 [▶]
        //     #visible: []
        //     #fillable: []
        //     #guarded: []
        //     #rememberTokenName: "remember_token"
        //     #accessToken: null
        //   }

        // dd($request->user());
//  #attributes: array:9 [▼
        //       "id" => 1
        //       "name" => "Urkuiash"
        //       "email" => "ukulya150992@gmail.com"
        //       "avatar" => "D:\ospanel\domains\laravel-10\storage\app/avatars/SSAcHLPU1cAUuYsQZk0hIv3y4JKBV67K9LweTIDi.jpg"
        //       "email_verified_at" => null
        //       "password" => "$2y$12$hwv4.gr6QR.6liwyq8JXrORiELVEfw8yTK3fAgX8qkxtY/c.bJ11S"
        //       "remember_token" => null
        //       "created_at" => "2024-02-05 09:34:31"
        //       "updated_at" => "2024-02-14 11:26:56"
        //     ]

        // we cant see the img now - laravel doesnt have access to storage - we need to create symbolic link - symlink
        // run php artisan storage:link //  INFO  The [D:\ospanel\domains\laravel-10\public\storage] link has been connected to [D:\ospanel\domains\laravel-10\storage\app/public].  

        // here we're sending user info together with view - as a 2nd param you can pass array of data
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
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
