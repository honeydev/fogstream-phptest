<?php

declare(strict_types=1);

namespace News;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class News extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title', 'body', 'user_id'
    ];

    public function author(): User
    {
        return $this->hasOne('\News\User', 'id', 'user_id')->first();
    }

    public function preview()
    {
        return $this->hasOne('\News\Preview', 'news_id', 'id')->first();
    }

    public function getFormatedData(): string
    {
        $carbon = Carbon::parse($this->created_at);
        return "{$carbon->day}.{$carbon->month}.{$carbon->year} in {$carbon->hour}:{$carbon->minute}:{$carbon->second}";
    }

    public function getUrl(): string
    {
        return url('/news') . "/{$this->id}";
    }
}
