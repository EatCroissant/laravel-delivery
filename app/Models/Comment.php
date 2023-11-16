<?php

namespace App\Models;

use DateTimeInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;
use Laravel\Sanctum\HasApiTokens;

class Comment extends Model
{
    use HasFactory;
    protected $fillable = ["text", 'user_id', 'reply_to'];

    protected static function booted()
    {

        static::creating(function () {
            Log::error('clear comments');
            Cache::forget('comments:0');
        });
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function comments()
    {
        return $this->hasMany(self::class, 'reply_to', 'id');
    }

    protected function serializeDate(DateTimeInterface $date): string
    {
        return $date->diffForHumans();
    }
}
