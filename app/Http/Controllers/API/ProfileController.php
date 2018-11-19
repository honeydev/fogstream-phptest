<?php

namespace News\Http\Controllers\API;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use \News\Savers\AvatarSaver;
use News\Http\Controllers\Controller;
use News\User;

class ProfileController extends Controller
{
    /**
     * @var \News\Savers\AvatarSaver
     */
    private $avatarSaver;

    /**
     * ProfileController constructor.
     * @param AvatarSaver $avatarSaver
     */
    public function __construct(AvatarSaver $avatarSaver)
    {
        $this->avatarSaver = $avatarSaver;
    }

    /**
     * @param Request $request
     * @param string $userId
     * @return \Illuminate\Http\JsonResponse
     */
    public function getProfile(Request $request, string $userId)
    {
        $user = User::find($userId);
        $avatar = $user->avatar();
        if (empty($user)) {
            return response()->json(["error" => ["User not found"]], 404);
        }
        return response()->json(['success' => ["user" => $user->toArray(), "avatar" => $avatar->toArray()]], 200);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function storeProfile(Request $request)
    {
        $user = $request->user();
        $validatedRequestBody = $request->validate([
            'name' => 'between:1,255',
            'birthday' => 'date_format:"Y-m-d"',
            'avatar' => 'image|max:3000'
        ]);
        $user->fill($validatedRequestBody);
        $user->save();
        if ($request->has('avatar')) {
            $this->avatarSaver->save($request->avatar, $user);
        }
        return response()->json(["success" => [
            "user" => $user->toArray(),
            "avatar" => $user->avatar()->toArray()
            ]
        ]);
    }
}
