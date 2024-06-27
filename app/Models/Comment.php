<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Comment extends Model
{
    use HasFactory;

    /**
    * The attributes that are mass assignable.
    *
    * @var array
    */
    protected $fillable = [
        'user_id', 
        'post_id',
        'comment_text',
    ]; 

    /**
     * @var string[] 
     */
    protected $with = [
        'user',
    ];
    
    /**
    * The belongs to Relationship
    *
    * @return BelongsTo
    */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    } 
}
