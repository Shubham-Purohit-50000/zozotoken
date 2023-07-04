<?php

namespace App\Models;

class Recharge extends BaseModel
{
    /**
     * Get the coin that owns the Recharge
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function coin()
    {
        return $this->belongsTo(Coin::class, 'coin_id', 'uuid');
    }
    /**
     * Get the user that owns the Recharge
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'uuid');
    }
}