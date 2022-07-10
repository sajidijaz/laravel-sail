<?php

namespace App\Models;

use App\Filters\PostFilter;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Builder;

/**
 * @mixin
 */
class Post extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'title', 'body'];

    public function scopeFilter(Builder $builder, $request): Builder
    {
        return (new PostFilter($request))->filter($builder);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo('App\Models\User', 'user_id');
    }

}
