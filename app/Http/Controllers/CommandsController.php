<?php

namespace App\Http\Controllers;

use Artisan;
use OneSignal; 

class CommandsController extends Controller
{
	public function get_index()
	{
	    return view('cmd.index');
    }


	public function get_artisan($command)
	{
        Artisan::call($command);

        if ($command == 'migrate:refresh') {
            Artisan::call('db:seed');
        }

	    return redirect('/cmd')->with('output', Artisan::output());
    }


    public function get_additional()
    {

        $output = shell_exec('dir');
        if (empty($output)) {
            $output = shell_exec('ls');
        }
        dd($output);
    }


	public function get_send()
    {
		try {
			$data = [
				'type_notification' => 1,
				'relation_id'		=> 1,
				'message'			=> 'hello'
			];

			OneSignal::sendNotificationToUser('message', 'a6c60001-9867-4a2e-9a8f-fa96a839bcf5');
			echo 'sent';
		} catch (Exception $exc) {
			echo $exc->getTraceAsString();
		}

//		$notification = \App\Models\Notification::find(1);
//		dispatch(new \App\Jobs\SendNotificationJob($notification));
	}
}