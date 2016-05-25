<?php

namespace App\Http\Controllers;

use Auth;

use Illuminate\Http\Request;

use App\Http\Requests;

use Illuminate\Support\Facades\Redirect;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        
        if( Auth::user() ) {
            Auth::user()->adminCheck();
        }
    }

    public function index(){
    	return view('restricted');
    }

    /**
	 * profile for user
	 */
	public function profile(Request $request,$user_name){
		
		//$user = \App\Classes\User::where('user_name', $user_name)->firstOrFail();
		$user = Auth::user();
		
		if ($request->user()->user_name !== $user_name) {
			Redirect::to('/'.$user->user_name)->send();
		}

		$data['user'] = $user;
		
		// $data['comments_count'] = $data['user'] -> comments -> count();
		// $data['posts_count'] = $data['user'] -> posts -> count();
		// $data['posts_active_count'] = $data['user'] -> posts -> where('active', '1') -> count();
		// $data['posts_draft_count'] = $data['posts_count'] - $data['posts_active_count'];
		// $data['latest_posts'] = $data['user'] -> posts -> where('active', '1') -> take(5);
		// $data['latest_comments'] = $data['user'] -> comments -> take(5);
		//return view('admin.profile', $data);
		//var_dump($data['user']->name);
		return view('user.profile', $data);
	}

	public function edit_profile(Request $request){
		$data['user'] = $request->user();
		$data['user_info'] = $request->user()->user_info;
		return view('user.edit_profile',$data);
	}

	public function test(){
		echo 'test';
	}

	public function test_fn(){
		$auth_user = Auth::user();
		$auth_user_name = $auth_user->user_name;		
		Redirect::to('/'.$auth_user_name)->send();
	}
}
