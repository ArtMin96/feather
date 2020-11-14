<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateUserProfile;
use App\Models\Profiles;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

class ProfileController extends Controller
{

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Show the user profile screen.
     *
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function show(Request $request)
    {
        return view('profile.show', [
            'request' => $request,
            'user'    => $request->user(),
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function updateProfile(Request $request, $id)
    {

        $rules = [
            'first_name' => 'max:255',
            'last_name' => 'max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . Auth::user()->id . ',id',
        ];

        $request->validate($rules);

        $user = User::findOrFail($id);
        $user->first_name = $request->input('first_name');
        $user->last_name = $request->input('last_name');
        $user->email = $request->input('email');

        if ($request->hasFile('avatar')) {

            $avatar = $request->file('avatar');

            // Get filename with extension
            $filenameWithExt = $avatar->getClientOriginalName();

            // Get file path
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);

            // Remove unwanted characters
            $filename = preg_replace("/[^A-Za-z0-9 ]/", '', $filename);
            $filename = preg_replace("/\s+/", '-', $filename);

            // Get the original image extension
            $extension = $avatar->getClientOriginalExtension();

            // Create unique file name
            $fileNameToStore = $filename.'_'.time().'.'.$extension;

            // Resize image
            $resize = Image::make($avatar)->resize(300, 300, function ($constraint) {
                $constraint->aspectRatio();
            })->encode('jpg');

            // Create hash value
            $hash = md5($resize->__toString());

            // Prepare qualified image name
            $image = $hash."jpg";

            // Put image to storage
            $save = Storage::put("public/avatars/{$user->id}/{$fileNameToStore}", $resize->__toString());

            if ($save) {

                // Save the public image path
                $user->profile->avatar = "avatars/{$user->id}/{$fileNameToStore}";
                $user->profile->avatar_status = true;
                $user->profile->save();
            }
        }

        $user->updated_ip_address = $request->ip();
        $user->save();

        return redirect()
            ->route('profile.show', $user->id)
            ->with('success', __('profile.update_account_success'));
    }

    /**
     * Update a user's profile.
     *
     * @param UpdateUserProfile $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(UpdateUserProfile $request, $id)
    {
        $user = User::findOrFail($id);

        $input = $request->only('bio', 'twitter_username', 'github_username', 'avatar_status');

        if ($user->profile === null) {
            $profile = new Profiles();
            $profile->fill($input);
            $user->profile()->save($profile);
        } else {
            $user->profile->fill($input)->save();
        }

        $user->updated_ip_address = $request->ip();
        $user->save();

        return redirect()
            ->route('profile.show', $user->id)
            ->with('success', __('profile.update_account_success'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
