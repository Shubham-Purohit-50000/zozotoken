<?php
namespace App\Http\Traits;

trait SetUserIdTrait
{
    protected static function boot()
    {
        parent::boot();
        static::creating(function ($model) {
            $model->user_id = currentUserId();
        });
    }
}