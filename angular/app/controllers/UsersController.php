<?php


class UsersController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 * GET /users
	 *
	 * @return Response
	 */
	public function index()
	{
		//
		$users = User::all();
		echo $users->toJson();

	}

	/**
	 * Show the form for creating a new resource.
	 * GET /users/create
	 *
	 * @return Response
	 */
	public function create()
	{
		//
	}

	/**
	 * Store a newly created resource in storage.
	 * POST /users
	 *
	 * @return Response
	 */
	public function store()
	{
		//
		$user = new User;
		$user->username = Input::get('username');
		$user->password = Hash::make(Input::get('username'));
		$user->save();
        return $user;
	}

	/**
	 * Display the specified resource.
	 * GET /users/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		//
		$user = User::with('transactions.brokers')->find($id);
		return $user->toJson();
		
	}

	/**
	 * Show the form for editing the specified resource.
	 * GET /users/{id}/edit
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		//
	}

	/**
	 * Update the specified resource in storage.
	 * PUT /users/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		//
	}

	/**
	 * Remove the specified resource from storage.
	 * DELETE /users/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
		User::destroy($id);
		return $id;	
	}

	public function validate(){
          
		  $param['username'] = Input::get('username');
		  $param['password'] = Input::get('password');

		  if(Auth::attempt(array('username'=>$param['username'],'password'=>$param['password']))){

                  return Auth::user()->toJson();
          }
         

		
	}

	public function dataTable($user_id,$page,$limit,$search=""){
          
          
          $page = $page * $limit;
          $user = User::find($user_id);
          //$resp['trans'] = $user->transactions()->dataTable($search,$limit,$page)->toArray();
          $trans = $user->transactions()->dataTable($search,$limit,$page);
          $data = [];
          foreach($trans as $tran){
               
               
          	   $brokers = $tran->brokers->toArray();
          	   $trans_array = $tran->toArray();
          	   $trans_array['brokers'] = $brokers;
          	   $data[]=$trans_array;
          	   
          }
          $resp['trans'] = $data;
          $resp['total'] = $user->transactions()->countDataTable($search);
          return json_encode($resp);

    }

	

}