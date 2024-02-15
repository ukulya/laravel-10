<?php

namespace App\Http\Controllers\Profile;

use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateAvatarRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AvatarController extends Controller
{
    // public function update(Request $request)
    public function update(UpdateAvatarRequest $request)
    {
        // return 'hello';
        // return response()->redirectTo('profile.edit');
        // return response()->redirectTo(route('profile.edit'));
        // return back(); // we're back on the same page
        // return back()->withInput(['message'=>'Success.Avatar is changed.']); // we can return smth from the controller - it is stored in the session - doesnt work
        // return back()->with('message','Success.Avatar is changed.'); // 
        // dd($request->input('_token')); // "s7qySKsBdScKKwUK0F1ct3jBpVFRCVd7jvaCVWwV" // app\Http\Controllers\Profile\AvatarController.php:17
        // dd($request->all());
        //         array:3 [▼ // app\Http\Controllers\Profile\AvatarController.php:18
        //   "_token" => "s7qySKsBdScKKwUK0F1ct3jBpVFRCVd7jvaCVWwV"
        //   "_method" => "patch"
        //   "avatar" => "call-center-new.png"
        // ]
        //  $request->validate([
        //     // 'avatar' => 'file',
        //     // 'avatar' => 'image',
        //     'avatar' => 'required|image', // we need the server-side validation coz there are some advanced users that can simply play with html input attributes and send incorrect data
        // ]);
        // the validation runs from left to right - first it checks for required,then for image
        // we add new validation rule with PIPE sign |
        // we can also use an array 'avatar' => ['required','image'],
        // dd($request->all()); // it is now saving the avatar as an object
        //         array:3 [▼ // app\Http\Controllers\Profile\AvatarController.php:30
        //   "_token" => "lQ2euYFSvFoGHfCAKbJr7xk1xQeNzzxFkCWRwHmV"
        //   "_method" => "patch"
        //   "avatar" => Illuminate\Http\UploadedFile {#329 ▼
        //     -test: false
        //     -originalName: "info-outline.svg"
        //     -mimeType: "image/svg+xml"
        //     -error: 0
        //     #hashName: null
        //     path: "D:\ospanel\userdata\temp"
        //     filename: "php1026.tmp"
        //     basename: "php1026.tmp"
        //     pathname: "D:\ospanel\userdata\temp\php1026.tmp"
        //     extension: "tmp"
        //     realPath: "D:\ospanel\userdata\temp\php1026.tmp"
        //     aTime: 2024-02-12 06:47:27
        //     mTime: 2024-02-12 06:47:27
        //     cTime: 2024-02-12 06:47:27
        //     inode: 14355223812244518
        //     size: 986
        //     perms: 0100666
        //     owner: 0
        //     group: 0
        //     type: "file"
        //     writable: true
        //     readable: true
        //     executable: false
        //     file: true
        //     dir: false
        //     link: false
        //     linkTarget: "D:\ospanel\userdata\temp\php1026.tmp"
        //   }
        // ]


        // what is form request validation?
        // it is not good to have the validation inside the controller
        // we need to create a new from validation request
        // php artisan make:request UpdateAvatarRequest
        // 1.what we are doing
        // 2.where we are doing
        // 3. Request 

        // we're gonna move the validation to the UpdateAvatarRequest

        // we need to use UpdateAvatarRequest instead of Request
        // we're getting "403 | THIS ACTION IS UNAUTHORIZED."
        // we need enable authorize true on UpdateAvatarRequest
        // dd($request->all());

        // how do we store the files - the configuration is in the config file - /config/filesystems.php
        // dd($request->file('avatar'));
        // Illuminate\Http\UploadedFile {#1305 ▼ // app\Http\Controllers\Profile\AvatarController.php:87
        //     -test: false
        //     -originalName: "info-outline.svg"
        //     -mimeType: "image/svg+xml"
        //     -error: 0
        //     #hashName: null
        //     path: "D:\ospanel\userdata\temp"
        //     filename: "php782D.tmp"
        //     basename: "php782D.tmp"
        //     pathname: "D:\ospanel\userdata\temp\php782D.tmp"
        //     extension: "tmp"
        //     realPath: "D:\ospanel\userdata\temp\php782D.tmp"
        //     aTime: 2024-02-12 07:34:51
        //     mTime: 2024-02-12 07:34:51
        //     cTime: 2024-02-12 07:34:51
        //     inode: 11258999068428252
        //     size: 986
        //     perms: 0100666
        //     owner: 0
        //     group: 0
        //     type: "file"
        //     writable: true
        //     readable: true
        //     executable: false
        //     file: true
        //     dir: false
        //     link: false
        //     linkTarget: "D:\ospanel\userdata\temp\php782D.tmp"
        //   }
        // return back()->with('message','Success.Avatar is changed.'); 
        // let's store the file in avatars path - under new folder storage/app/avatar
        // $request->file('avatar')->store('avatars');

        // return redirect(route('profile.edit'))->with('message','Avatar is updated.'); 

        // we can also use path
        // $path = $request->file('avatar')->store('avatars');
        // very nice way to update authenticate the user
        // dd(auth()->user());
        // App\Models\User {#664 ▼ // app\Http\Controllers\Profile\AvatarController.php:126
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
        //       "avatar" => "new unguarded value"
        //       "email_verified_at" => null
        //       "password" => "$2y$12$hwv4.gr6QR.6liwyq8JXrORiELVEfw8yTK3fAgX8qkxtY/c.bJ11S"
        //       "remember_token" => null
        //       "created_at" => "2024-02-05 09:34:31"
        //       "updated_at" => "2024-02-05 10:16:25"
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
        //         auth()->user()->update(['avatar' =>'test']);
        //         dd(auth()->user());
        //          #attributes: array:9 [▼
        //     "id" => 1
        //     "name" => "Urkuiash"
        //     "email" => "ukulya150992@gmail.com"
        //     "avatar" => "test"
        //     "email_verified_at" => null
        //     "password" => "$2y$12$hwv4.gr6QR.6liwyq8JXrORiELVEfw8yTK3fAgX8qkxtY/c.bJ11S"
        //     "remember_token" => null
        //     "created_at" => "2024-02-05 09:34:31"
        //     "updated_at" => "2024-02-14 11:22:47"
        //   ]

        // $path = $request->file('avatar')->store('avatars');
        // auth()->user()->update(['avatar' => storage_path('app/public')."/$path"]);
        //         dd(auth()->user());
        //          #attributes: array:9 [▼
        //     "id" => 1
        //     "name" => "Urkuiash"
        //     "email" => "ukulya150992@gmail.com"
        //     "avatar" => "D:\ospanel\domains\laravel-10\storage\app/avatars/SSAcHLPU1cAUuYsQZk0hIv3y4JKBV67K9LweTIDi.jpg"
        //     "email_verified_at" => null
        //     "password" => "$2y$12$hwv4.gr6QR.6liwyq8JXrORiELVEfw8yTK3fAgX8qkxtY/c.bJ11S"
        //     "remember_token" => null
        //     "created_at" => "2024-02-05 09:34:31"
        //     "updated_at" => "2024-02-14 11:26:56"
        //   ]

        // $path = $request->file('avatar')->store('public/avatars');
        // auth()->user()->update(['avatar' => storage_path('app')."/$path"]);
        // dd($path); //"public/avatars/6DPDLMKr4zvxXmrsFi88Gke5hR4KgX869uXE4gbl.jpg"  // not good public/avatars


        // $path = $request->file('avatar')->store('avatars','public');
        // auth()->user()->update(['avatar' => storage_path('app')."/$path"]);
        // dd($path); //"avatars/6DPDLMKr4zvxXmrsFi88Gke5hR4KgX869uXE4gbl.jpg"  // good avatars

        // we need to store the path without storage_path link
        // $path = $request->file('avatar')->store('avatars','public');
        // auth()->user()->update(['avatar' => $path]);
        // dd($path); // "avatars/kKepfe65af2ikV3jeDC0JI3i8cOdK1GM03Vophpg.jpg"

        // delete old file before uploading new one - use Facades/Storage
        // $path = $request->file('avatar')->store('avatars', 'public');
        // if ($oldAvatar = $request->user()->avatar) {
        //     // dd($oldAvataer); // "avatars/XoVy7jgAvFNf3LUsquXQP8pjj9TP7wQt8MMvcBw2.jpg"
        //     // Storage::delete($oldAvataer);    doesnt work 
        //     Storage::disk('public')->delete($oldAvatar);    //doesnt work - Disk [pubilc] does not have a configured driver.
        // }
        // auth()->user()->update(['avatar' => $path]);

        // we can also use storage to create dirs and files

        $path = Storage::disk('public')->put('avatars', $request->file('avatar')); 
        // dd($path);// "avatars/HHaohYuiBfVTZGnrIa4NHBRZxbIPmFF3aOkosDNo.jpg"
        if ($oldAvatar = $request->user()->avatar) {
            Storage::disk('public')->delete($oldAvatar); 
        }
        auth()->user()->update(['avatar' => $path]);
    }
}
