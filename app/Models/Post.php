<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends Model
{
    use HasFactory;
    use SoftDeletes;

    /**
     * The model's default values for attributes.
     *
     * @var array
     */
    protected $attributes = [
        'user_id' => '1',
    ];

    protected $dates = ['deleted_at'];

    protected $fillable = [
        'title',
        'content',
    ];

    function user() {
        return $this->belongsTo('App\Models\User');
    }

}
