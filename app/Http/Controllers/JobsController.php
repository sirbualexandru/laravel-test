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

class JobsController extends Controller
{

    public function index()
    {
        return view('jobs.index', [
            'active_menu'   =>  'jobs',
            'resource'      =>  'jobs'
        ]);
    }


    public function datatable()
    {
        $currentUser = Auth::user();

        if ($currentUser->hasRole('employer')) {
            $jobs = Jobs::with('category')->where('jobs.user_id', $currentUser->id);
        } 
        if ($currentUser->hasRole('candidate')) {
            $jobs = Jobs::with('category');
        }

        return Datatables::of($jobs)
            ->addColumn('status', function (Jobs $jobs) {
                if ($jobs->candidates->contains(Auth::user()->id)) {
                    return '<span><i class="fa fa-check"></i> Applied </span>';
                } else {
                    return '<span><i class="fa fa-times"></i> Not applied </button>';
                }
            })
            ->addColumn('action', function (Jobs $jobs) {
                if (Auth::user()->hasRole('employer')) {
                    return view('jobs.chunk.employer_action', [
                        'id'        => $jobs->id,
                        'resource'  => 'jobs'
                    ]);
                }

                if (Auth::user()->hasRole('candidate')) {
                    return view('jobs.chunk.candidate_action', [
                        'id'        => $jobs->id,
                        'resource'  => 'jobs'
                    ]);
                }
            })
            ->editColumn('created_at', function (Jobs $jobs) {
                return $jobs->created_at->format(config('project.formatUI'));
            })
            ->make(true);
    }


    public function create()
    {
        return view('jobs.create',[
				'active_menu'   =>  'jobs'
			]);
    }


    public function store(Request $request)
    {
        $input = $request->all();

        $currentUser = Auth::user();

        $rules = config('validations.web.jobs.store');
        $this->validate($request, $rules);

        $job = DB::transaction(function() use ($input, $currentUser) {
            $job = new Jobs();
            
            // associate category
            $category = Category::findOrFail($input['category_id']);
            $job->category()->associate($category);

            // associate user
            $user = User::findOrFail($currentUser->id);
            $job->employer()->associate($user);

            $job->fill($input);
            $job->save();

            return $job;
        });

        return view('message.success', [
            'message'   => trans('Page has been successfully created'),
            'redirect'  => url('jobs/'. $job->id. '/edit')
        ]);
    }


    public function edit($id)
    {
        $page  = Jobs::findOrFail($id);

        return view('jobs.update')->with([
            'page'          => $page,
            'active_menu'   => 'jobs',
        ]);
    }


    public function update(Request $request, $id)
    {
        $input = $request->all();

        $currentUser = Auth::user();
        $job = Jobs::findOrFail($id);

        $rules = config('validations.web.jobs.update');

        $this->validate($request, $rules);

        $job = DB::transaction(function() use ($input, $job, $currentUser) {
            // associate category
            $category = Category::findOrFail($input['category_id']);
            $job->category()->associate($category);

            // associate user
            $user = User::findOrFail($currentUser->id);
            $job->employer()->associate($user);

            $job->fill($input);
            $job->save();

            return $job;
        });

        return response()->view('message.success', [
            'message'  => trans('Update page has been successfully'), 
            'redirect' => url('jobs')
        ]);
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

        return view('jobs.see')->with([
            'page'          => $job,
            'employer'      => $employer,
            'current_user'  => $currentUser,
            'active_menu'   => 'jobs',
        ]);
    }


    public function applyForJob(Request $request)
    {
        $input = $request->all();

        $response = DB::transaction(function() use ($input) {
            
            $currentUser = Auth::user();
            $job = Jobs::find($input['id']);

            if ($job->candidates->contains($currentUser->id)) {
                return trans('You have already applied to this job');
            } else {
                // associate job
                $job->candidates()->attach($currentUser->id);
                return trans('You have successfully applied to this job');
            }
        });

        return response()->view('message.success', [
            'message'  => $response, 
            'redirect' => url('jobs')
        ]);
    }

}