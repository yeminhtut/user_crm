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
	public function profile(Request $request, $uid){
		
		$user = \App\Classes\User::find($uid);
		
		if ($request->user()->id !== $user->id) {
			Redirect::to('/user/'.$request->user()->id)->send();
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

	public function edit_profile(Request $request,$uid){
		$user = \App\Classes\User::find($uid);
		if ($request->user()->id !== $user->id) {
			Redirect::to('/user/edit/'.$request->user()->id)->send();
		}
		$data['user'] = $user;
		return view('user.edit_profile',$data);
	}
}
