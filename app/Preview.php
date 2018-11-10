<?php

namespace News;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Preview extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'user_id', 'news_id'
    ];

    /**
     * @return News
     */
    public function news(): News
    {
        return $this->hasOne('\News\News', 'id', 'news_id')->first();
    }

    public function getUrl(): string
    {
        $owner = $this->news()->author();
        $storageUrl = Storage::url(config('filesystems.folders.previews'));
        return url("/") . "{$storageUrl}/{$owner->email}/{$this->name}";
    }
}
