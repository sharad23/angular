<?php

class TransactionsController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 * GET /transactions
	 *
	 * @return Response
	 */
	public function index()
	{
		   /*$data = User::with(array('transactions'=>function($query){

		                         $query->where('amount', '>', 1000);
		                         $query->with(array('brokers'=>function($query){
                                        
                                         $query->where('broker','=','sharad');
		                         }));
		                         
		                    }))
		   	            ->get();
		   echo '<pre>';
		   print_r($data->toArray());
		   echo '</pre>';
		   */
		   /*$trans = Transaction::test();
		   echo '<pre>';
		   print_r($trans->toArray());
		   echo '</pre>'; 
           */
           $search = "sharad";
           $data = User::find(8)->transactions()->test();
           echo '<pre>';
           print_r($data->toArray());
           echo '</pre>';
           

    }

	/**
	 * Show the form for creating a new resource.
	 * GET /transactions/create
	 *
	 * @return Response
	 */
	public function create()
	{
		//
	}

	/**
	 * Store a newly created resource in storage.
	 * POST /transactions
	 *
	 * @return Response
	 */
	public function store()
	{
		//
		$trans = Transaction::create(array('user_id'=>Input::get('user_id'),'amount'=>Input::get('amount'),'description'=>Input::get('description')));
        $brokers = array();
        foreach(Input::get('brokers') as $row){

        	   $brokers[] = new Broker(array('broker'=>$row));
        }
        $trans->brokers()->saveMany($brokers);
        return Transaction::with('brokers')->find($trans->id)->toJson();
	}

	/**
	 * Display the specified resource.
	 * GET /transactions/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		//
	}

	/**
	 * Show the form for editing the specified resource.
	 * GET /transactions/{id}/edit
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
	 * PUT /transactions/{id}
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
	 * DELETE /transactions/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
		Transaction::destroy($id);
	}

	

}