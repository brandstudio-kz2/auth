<?php

namespace BrandStudio\Auth\Traits;

trait AuthUserTrait
{

    public function toAuthResponse() {
      return $this->toArray();
    }

    public function verificationTokens()
    {
        return $this->hasMany(BrandStudio\Auth\Models\VerificationToken::class, 'user_id');
    }

    public function findForPassport($username)
    {
        return $this->where(function($query) use($username) {
            foreach(config('brandstudio.auth.auth_fields') as $field) {
                $query->orWhere($field, $username);
            }
        })->first();
    }


}
