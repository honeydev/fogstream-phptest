<?php

namespace News;

use Illuminate\Database\Eloquent\Model;

class Avatar extends Model
{
    public $table = 'avatars';

    public function isDefault()
    {
        $owner = $this->hasOne('News\User', 'id', 'user_id')->first();
        return $owner->email = 'default';
    }

    public function getUri()
    {
        $owner = $this->hasOne('News\User', 'id', 'user_id')->first();
        $avatarFolder = config('filesystems.folders.avatars');
        return "/{$avatarFolder}/{$owner->email}/{$this->name}";
    }

    public function remove()
    {
        $fileUri = $this->getUri();
        $this->delete();

    }
}
