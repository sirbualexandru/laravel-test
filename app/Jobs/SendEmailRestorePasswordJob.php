<?php

namespace App\Jobs;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailer;
use Illuminate\Mail\Message;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;

class SendEmailRestorePasswordJob extends Job implements ShouldQueue
{
    use InteractsWithQueue, SerializesModels;

    private $email;
    private $password;

    public function __construct($email, $password)
    {
        $this->email 	= $email;
        $this->password = $password;
    }

    public function handle(Mailer $mailer)
    {
        $mailer->send('email.restore-password', [
            'email' 	=> $this->email,
            'password' 	=> $this->password,
        ], function(Message $message) {
            $app = config('project.name');
            $message->to($this->email)->subject("[{$app}]: password recovery");
        });

    }

}
