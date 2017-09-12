<?php

namespace App\Jobs;

use OneSignal;
use App\Jobs\Job;
use App\Models\User;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendNotificationJob extends Job implements ShouldQueue
{
    use InteractsWithQueue, SerializesModels;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(User $user,$type = 'feedback', $message = false)
    {
		$this->user = $user; 
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
		try {
			foreach ($this->user->device_tokens as $deviceToken) {
				OneSignal::sendNotificationToUser("test MEssage", $deviceToken->token);
			}
		} catch (\GuzzleHttp\Exception\RequestException $e) {
			Log::error($e->getMessage());
		}
    }
}
