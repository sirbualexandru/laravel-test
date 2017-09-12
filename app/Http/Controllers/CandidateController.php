<?php 

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Jobs;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Auth;
use Datatables;
use Validator;

class CandidateController extends Controller
{

    public function index()
    {
        return view('candidates.index', [
            'active_menu'   =>  'candidates',
            'resource'      =>  'candidates'
        ]);
    }


    public function datatable()
    {
        $currentUser = Auth::user();

        $candidates = Jobs::select([
                'jobs.name as job_name',
                'jobs.id as job_id',
                'users.id as user_id',
                'users.first_name',
                'users.last_name',
                'users.email'
            ])
            ->join('applied_jobs',  'jobs.id',                 '=',  'applied_jobs.job_id')
            ->join('users',         'applied_jobs.user_id',    '=',  'users.id')
            ->where('jobs.user_id', $currentUser->id)
            ->get();
        

        return Datatables::of($candidates)
            ->addColumn('action', function (Jobs $jobs) {
                return view('candidates.chunk.action', [
                    'user_id'   => $jobs->user_id,
                    'job_id'    => $jobs->job_id,
                    'resource'  => 'candidates'
                ]);
            })
            ->make(true);
    }



    public function destroy($id)
    {
        Jobs::destroy($id);
        return trans('Page deleted');
    }


    public function seeJob($id)
    {
        $currentUser = Auth::user();

        $job = Jobs::findOrFail($id);

        $employer = User::findOrFail($job->user_id);

        return view('candidates.see_job')->with([
            'page'          => $job,
            'employer'      => $employer,
            'current_user'  => $currentUser,
            'active_menu'   => 'candidates',
        ]);
    }


    public function seeCandidate($id)
    {
        $candidate = User::findOrFail($id);

        return view('candidates.see_candidate')->with([
            'page'          => $candidate,
            'active_menu'   => 'candidates',
        ]);
    }

}