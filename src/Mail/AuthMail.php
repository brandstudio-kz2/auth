<?php

namespace BrandStudio\Auth\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use BrandStudio\Auth\Models\VerificationToken;

class AuthMail extends Mailable
{
    use Queueable, SerializesModels;

    protected $token;
    protected $type;
    protected $password;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(VerificationToken $token, string $type, $password)
    {
        $this->token = $token;
        $this->type = $type;
        $this->password = $password;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->to($this->token->login)
                    ->subject($this->getSubject())
                    ->view('brandstudio::mail.'.$this->getViewName())
                    ->with([
                        'token' => $this->token,
                        'password' => $this->password,
                    ]);
    }

    private function getSubject() : string
    {
        return trans('brandstudio::auth.subject_'.$this->type);
    }

    private function getViewName() : string
    {
        switch ($this->type) {
            case 'password_reset':
                return 'password_reset';
            case 'registration':
                return 'registration';
            default:
                return 'confirm_email';
        }
    }

}
