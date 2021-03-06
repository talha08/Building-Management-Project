<?php

class FlatsController extends \BaseController {

	/**
	 * Display a listing of flats
	 *
	 * @return Response
	 */
	public function index()
	{
		$flats = Flat::all();

		return View::make('flats.index', compact('flats'))->with('title',"Flat");
	}

	/**
	 * Show the form for creating a new flat
	 *
	 * @return Response
	 */
	public function create()
	{

		return View::make('flats.create')->with('title',"Create Flat");
	}

	/**
	 * Store a newly created flat in storage.
	 *
	 * @return Response
	 */
	public function store()
	{

		$data = Input::all();
		$validator = Validator::make($data, Flat::$rules);

		if ($validator->fails())
		{
			return Redirect::back()->withErrors($validator)->withInput();
		}

		$flats = new Flat();

		$flats->name = $data['name'];
		$flats->flat_details = $data['flat_details'];
		$flats->rent_amount = $data['rent_amount'];



		if($flats->save()){
			return Redirect::route('flats.index')->with('success',"Log Inserted Successfully");
		}else{
			return Redirect::route('flats.index')->with('error',"Something went wrong.Try again");
		}
	}

	/**
	 * Display the specified flat.
	 *
	 * @param  int  $id
	 * @return Response
	 */


	/**
	 * Show the form for editing the specified flat.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$flat = Flat::find($id);

		return View::make('flats.edit', compact('flat'))->with('title',"Flat");
	}

	/**
	 * Update the specified flat in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		$data = Input::all();
		$validator = Validator::make($data, Flat::$rules);

		if ($validator->fails())
		{
			return Redirect::back()->withErrors($validator)->withInput();
		}

		$flats = Flat::find($id);

		$flats->name = $data['name'];
		$flats->flat_details = $data['flat_details'];
		$flats->rent_amount = $data['rent_amount'];


		if($flats->save()){
			return Redirect::route('flats.index')->with('success',"Flat  Updated Successfully");
		}else{
			return Redirect::route('flats.index')->with('error',"Something went wrong.Try again");
		}
	}

	/**
	 * Remove the specified flat from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		Flat::destroy($id);

		return Redirect::route('flats.index')->with('error',"Flat successfully deleted");
	}




//button click payment
	public function paymentVerification($id){
		try {
			$flat = Flat::find($id);
			$flat->payment_status = true;
			if ($flat->save()) {
				$money = new Money();
				$money->title = 'Direct Paid';
				$money->type = 'credit';
				$money->method = 'Cash';
				$money->amount = $flat->rent_amount;
				$money->date = \Carbon\Carbon::now() ;
				$money->flat_id = $flat->id;
				if($money->save()){
					return Redirect::back()->with('success',"Payment Completed Successfully");
				}else
				{
					return Redirect::back()->with('error',"Something went wrong, Please try again");
				}
			}
			else{
				return Redirect::back()->with('error',"Something went wrong, Please try again");
			}
		}catch(Exception $e){
			return Redirect::back()->with('error', "Something went wrong.");
		}
	}





	//flats own terms and condition
	public function flatTermsAndCondition(){
		$flat= Flat::where('id', Auth::user()->flat_id)->first();
		return View::make('flats.terms', compact('flat'))->with('title'," - Flat Terms and Condition");
	}





   //show terms and conditons by all user which associate with their flat
	public function show($id)
	{
		$flat= Flat::where('id',$id)->first();
		return View::make('flats.terms', compact('flat'))->with('title',"Flat Terms and Condition");
	}


}
