<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Redirect;
use Schema;
use App\HargaPerMeter3Air;
use App\Http\Requests\CreateHargaPerMeter3AirRequest;
use App\Http\Requests\UpdateHargaPerMeter3AirRequest;
use Illuminate\Http\Request;



class HargaPerMeter3AirController extends Controller {

	/**
	 * Display a listing of hargapermeter3air
	 *
     * @param Request $request
     *
     * @return \Illuminate\View\View
	 */
	public function index(Request $request)
    {
        $hargapermeter3air = HargaPerMeter3Air::all();

		return view('admin.hargapermeter3air.index', compact('hargapermeter3air'));
	}

	/**
	 * Show the form for creating a new hargapermeter3air
	 *
     * @return \Illuminate\View\View
	 */
	public function create()
	{
	    
	    
	    return view('admin.hargapermeter3air.create');
	}

	/**
	 * Store a newly created hargapermeter3air in storage.
	 *
     * @param CreateHargaPerMeter3AirRequest|Request $request
	 */
	public function store(CreateHargaPerMeter3AirRequest $request)
	{
	    
		HargaPerMeter3Air::create($request->all());

		return redirect()->route(config('quickadmin.route').'.hargapermeter3air.index');
	}

	/**
	 * Show the form for editing the specified hargapermeter3air.
	 *
	 * @param  int  $id
     * @return \Illuminate\View\View
	 */
	public function edit($id)
	{
		$hargapermeter3air = HargaPerMeter3Air::find($id);
	    
	    
		return view('admin.hargapermeter3air.edit', compact('hargapermeter3air'));
	}

	/**
	 * Update the specified hargapermeter3air in storage.
     * @param UpdateHargaPerMeter3AirRequest|Request $request
     *
	 * @param  int  $id
	 */
	public function update($id, UpdateHargaPerMeter3AirRequest $request)
	{
		$hargapermeter3air = HargaPerMeter3Air::findOrFail($id);

        

		$hargapermeter3air->update($request->all());

		return redirect()->route(config('quickadmin.route').'.hargapermeter3air.index');
	}

	/**
	 * Remove the specified hargapermeter3air from storage.
	 *
	 * @param  int  $id
	 */
	public function destroy($id)
	{
		HargaPerMeter3Air::destroy($id);

		return redirect()->route(config('quickadmin.route').'.hargapermeter3air.index');
	}

    /**
     * Mass delete function from index page
     * @param Request $request
     *
     * @return mixed
     */
    public function massDelete(Request $request)
    {
        if ($request->get('toDelete') != 'mass') {
            $toDelete = json_decode($request->get('toDelete'));
            HargaPerMeter3Air::destroy($toDelete);
        } else {
            HargaPerMeter3Air::whereNotNull('id')->delete();
        }

        return redirect()->route(config('quickadmin.route').'.hargapermeter3air.index');
    }

}
