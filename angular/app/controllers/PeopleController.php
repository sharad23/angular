<?php

class PeopleController extends \BaseController {

	/**
	 * Display a listing of people
	 *
	 * @return Response
	 */
	public function index()
	{       

		    $person = Person::create(array('name'=>'Sharad'));
            $inputAddress = array(array('name'=>'Thamel'),array('name'=>'Thahity'));
            $addressIds = array();
			foreach ($inputAddress as $id => $addressData)
			{
			    $address = Address::find($id) ?: new Address;
			    $address->fill($addressData);
			    $address->save();
			    $addressIds[] = $address->id;
			}

			$changes = $person->addresses()->sync($addressIds);

			// Delete the unused addresses
			/*foreach ($changes['detached'] as $detachedAddressId)
			{
			    $address = Address::find($detachedAddressId);
			    if (!empty($address)) $address->delete();
			}
			*/
	}

	/**
	 * Show the form for creating a new person
	 *
	 * @return Response
	 */
	public function create()
	{
		return View::make('people.create');
	}

	/**
	 * Store a newly created person in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$validator = Validator::make($data = Input::all(), Person::$rules);

		if ($validator->fails())
		{
			return Redirect::back()->withErrors($validator)->withInput();
		}

		Person::create($data);

		return Redirect::route('people.index');
	}

	/**
	 * Display the specified person.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$person = Person::findOrFail($id);

		return View::make('people.show', compact('person'));
	}

	/**
	 * Show the form for editing the specified person.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$person = Person::find($id);

		return View::make('people.edit', compact('person'));
	}

	/**
	 * Update the specified person in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		$person = Person::findOrFail($id);

		$validator = Validator::make($data = Input::all(), Person::$rules);

		if ($validator->fails())
		{
			return Redirect::back()->withErrors($validator)->withInput();
		}

		$person->update($data);

		return Redirect::route('people.index');
	}

	/**
	 * Remove the specified person from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		Person::destroy($id);

		return Redirect::route('people.index');
	}

}
