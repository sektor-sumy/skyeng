<?php namespace App\Http\Controllers;

class WelcomeController extends Controller {

	/*
	|--------------------------------------------------------------------------
	| Welcome Controller
	|--------------------------------------------------------------------------
	|
	| This controller renders the "marketing page" for the application and
	| is configured to only allow guests. Like most of the other sample
	| controllers, you are free to modify or remove it as you desire.
	|
	*/
	
	/**
	 * Create a new controller instance.
	 *
	 * @return void
	 */
	public function __construct()
	{
		$this->middleware('guest');
	}

	/**
	 * Show the application welcome screen to the user.
	 *
	 * @return Response
	 */
	public function index()
	{
		$userList = \App\Client::all();
		return view('welcome', ['data' => $userList]);
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$userInfo = \App\Client::find($id);
		$zenInfo = \App\Zendesk::curlWrap("/search.json?query=type:user+email:$userInfo->email", null, "GET");
		$data = \App\Zendesk::curlWrap("/users/{$zenInfo->results[0]->id}/tickets/requested.json", null, "GET");
		$i=0;
		foreach ($data->tickets as $ticket) {
			$userName = \App\Zendesk::curlWrap("/users/$ticket->assignee_id.json", null, "GET");
			$data->tickets[$i]->assignee_name = $userName->user->name;
			$i++;
		}
		return view('show', ['userInfo' => $userInfo, 'zenInfo' => $zenInfo, 'data' => $data]);
	}


}
