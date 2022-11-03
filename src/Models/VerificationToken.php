<?php

namespace BrandStudio\Auth\Models;

use Illuminate\Database\Eloquent\Model;

class VerificationToken extends Model
{

    public $timestamps = false;

    protected $fillable = [
        'user_id', 'password', 'token', 'login',
    ];

    public function user()
    {
        return $this->belongsTo(config('brandstudio.auth.model'), 'user_id');
    }

}
