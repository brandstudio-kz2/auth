<?php

namespace BrandStudio\Auth\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use BrandStudio\Auth\Models\VerificationToken;
use BrandStudio\Auth\Facades\BsAuth;

class DeleteVerificationTokenJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $token;

    public function __construct(VerificationToken $token)
    {
        $this->token = $token;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        try {
            $this->token->delete();
            if (BsAuth::isRegistrationToken($this->token)) {
                $this->token->user->delete();
            }
        } catch (\Exception $e) {
            //
        }
    }
}
