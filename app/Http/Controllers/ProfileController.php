<?php

declare(strict_types=1);

namespace News\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    /**
     * @var \News\Savers\AvatarSaver
     */
    private $avatarSaver;
    /**
     * ProfileController constructor.
     * @param \News\Savers\AvatarSaver $avatarSaver
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
            'avatar' => $avatar
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

        return view('news.updateprofile', [
            'page' => 'Update profile',
            'user' => $user
        ]);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function storeProfile(Request $request)
    {
        $validatedRequestBody = $request->validate([
            'name' => 'between:1,255',
            'birthday' => 'date_format:"Y-m-d"',
            'avatar' => 'image|max:3000'
        ]);

        $user = Auth::user();
        $user->fill($validatedRequestBody);
        $user->save();
        if ($request->has('avatar')) {
            $this->avatarSaver->save($request->avatar, $user);
        }
        return redirect('profile');
    }
}
