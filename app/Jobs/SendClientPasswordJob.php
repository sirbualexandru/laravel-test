<?php

namespace App\Jobs;

use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailer;
use Illuminate\Mail\Message;

class SendClientPasswordJob extends Job implements ShouldQueue
{
    use InteractsWithQueue, SerializesModels;

    private $user;
    private $password;
    private $newUser;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($user, $password, $newUser)
    {
        $this->user 	= $user;
        $this->password = $password;
        $this->newUser  = $newUser;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle(Mailer $mailer)
    {
        $mailer->send('email.userInfo', [
            'user' 	        => $this->user,
            'password' 	    => $this->password,
            'customMessage' => false,
            'isNewUser'     => $this->newUser
        ], function(Message $message) {
            $app = config('project.name');
            $message->to($this->user->email)->subject("[{$app}]: password");
        });
    }
}