<?php

declare(strict_types=1);

namespace News\Savers;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\Model;
use News\{User, Preview};

class PreviewSaver
{
    public function save(UploadedFile $preview, Model $news): Model
    {
        $author = $news->author();
        $previewFolder = config('filesystems.folders.public_storage') . config('filesystems.folders.previews');
        $targetDir = "{$previewFolder}/{$author->email}";
        $file = Storage::putFile($targetDir, $preview);
        return Preview::create([
            'name' => pathinfo($file, PATHINFO_BASENAME),
            'news_id' => $news->id
        ]);
    }
}
