<?php

declare(strict_types=1);

namespace News\Savers;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\Model;
use News\Avatar;

class AvatarSaver 
{
    /**
     * @param UploadedFile $avatar
     * @param Model $owner
     * @return Model
     */
    public function save(UploadedFile $avatar, Model $owner): Model
    {
        $currentAvatar = $owner->avatar();
        $avatarsFolder = config('filesystems.folders.public_storage') . config('filesystems.folders.avatars');
        $targetDir = "{$avatarsFolder}/{$owner->email}";
        $file = Storage::putFile($targetDir, $avatar);
        $newAvatar = Avatar::create([
            'name' => pathinfo($file, PATHINFO_BASENAME),
            'user_id' => $owner->id
        ]);
        if (!$currentAvatar->isDefault()) {
            $oldAvatarName = $currentAvatar->name;
            $currentAvatar->delete();
            Storage::delete("{$targetDir}/{$oldAvatarName}");
        }
        return $newAvatar;
    }
}
