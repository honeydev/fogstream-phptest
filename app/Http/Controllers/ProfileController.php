<?php

namespace News\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    /**
     * @var \News\Savers\AvatarSaver
     */
    private $avatarSaver;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(\News\Savers\AvatarSaver $avatarSaver)
    {
        $this->middleware('auth');
        $this->avatarSaver = $avatarSaver;
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user();
        $avatar = $user->avatar();
        return view('news.profile', [
            'page' => 'Profile',
            'user' => Auth::user(),
            'avatar' => Storage::url($avatar->getUri())
        ]);
    }

    /**
     * Show the update profile page
     *
     * @return \Illuminate\Http\Response
     */
    public function updatePage()
    {
        $user = Auth::user();

        return view('news.update', [
            'page' => 'Update profile',
            'user' => $user
        ]);
    }

    public function storeProfile(Request $request)
    {
        $request->validate([
            'name' => 'between:1,255',
            'birthday' => 'date_format:"Y-m-d"',
            'avatar' => 'image|max:3000'
        ]);

        $user = Auth::user();

        if ($request->has('name')) {
            if ($user->name !== $request->name){
                $user->name = $request->name;
            }
        }

        if ($request->has('birthday')) {
            if ($user->birthday !== $request->birthday) {
                $user->birthday = $request->birthday;
            }
        }

        $user->save();
        $this->avatarSaver->save($request->avatar);
        return redirect('profile');
    }
}
