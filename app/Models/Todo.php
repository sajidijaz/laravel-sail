<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
* @mixin
 */
class Todo extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'title', 'status', 'due_on'];

    public function user(): BelongsTo
    {
        return $this->belongsTo('App\Models\User', 'user_id');
    }

}
