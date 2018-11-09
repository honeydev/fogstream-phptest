<?php

declare(strict_types=1);

namespace News\Savers;

use GuzzleHttp\Psr7\UploadedFile;
use News\User;

class AvatarSaver 
{
    public function save(UploadedFile $avatar)
    {
        $owner = Auth::user();
        $currentAvatar = $owner->avatar();
        $avatarsFolder = config('filesystem.folders.avatars');
        $targetDir = "{$avatarsFolder}/{$owner->email}";
        dd($targetDir);

        if ($currentAvatar->isDefault()) {

        }
    }
}
