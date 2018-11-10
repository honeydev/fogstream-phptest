<?php

declare(strict_types=1);

namespace News;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Avatar extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'user_id'
    ];
    /**
     * @return bool
     */
    public function isDefault(): bool
    {
        $owner = $this->hasOne('News\User', 'id', 'user_id')->first();
        return $owner->email === 'default';
    }
    /**
     * @return string
     */
    public function getUrl(): string
    {
        $owner = $this->hasOne('News\User', 'id', 'user_id')->first();
        $storageUrl = Storage::url(config('filesystems.folders.avatars'));
        return url("/") . "{$storageUrl}/{$owner->email}/{$this->name}";
    }
}
