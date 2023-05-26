<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Redirect;
use Schema;
use App\HargaPerMeter2;
use App\Http\Requests\CreateHargaPerMeter2Request;
use App\Http\Requests\UpdateHargaPerMeter2Request;
use Illuminate\Http\Request;



class HargaPerMeter2Controller extends Controller {

	/**
	 * Display a listing of hargapermeter2
	 *
     * @param Request $request
     *
     * @return \Illuminate\View\View
	 */
	public function index(Request $request)
    {
        $hargapermeter2 = HargaPerMeter2::all();

		return view('admin.hargapermeter2.index', compact('hargapermeter2'));
	}

	/**
	 * Show the form for creating a new hargapermeter2
	 *
     * @return \Illuminate\View\View
	 */
	public function create()
	{
	    
	    
	    return view('admin.hargapermeter2.create');
	}

	/**
	 * Store a newly created hargapermeter2 in storage.
	 *
     * @param CreateHargaPerMeter2Request|Request $request
	 */
	public function store(CreateHargaPerMeter2Request $request)
	{
	    
		HargaPerMeter2::create($request->all());

		return redirect()->route(config('quickadmin.route').'.hargapermeter2.index');
	}

	/**
	 * Show the form for editing the specified hargapermeter2.
	 *
	 * @param  int  $id
     * @return \Illuminate\View\View
	 */
	public function edit($id)
	{
		$hargapermeter2 = HargaPerMeter2::find($id);
	    
	    
		return view('admin.hargapermeter2.edit', compact('hargapermeter2'));
	}

	/**
	 * Update the specified hargapermeter2 in storage.
     * @param UpdateHargaPerMeter2Request|Request $request
     *
	 * @param  int  $id
	 */
	public function update($id, UpdateHargaPerMeter2Request $request)
	{
		$hargapermeter2 = HargaPerMeter2::findOrFail($id);

        

		$hargapermeter2->update($request->all());

		return redirect()->route(config('quickadmin.route').'.hargapermeter2.index');
	}

	/**
	 * Remove the specified hargapermeter2 from storage.
	 *
	 * @param  int  $id
	 */
	public function destroy($id)
	{
		HargaPerMeter2::destroy($id);

		return redirect()->route(config('quickadmin.route').'.hargapermeter2.index');
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
            HargaPerMeter2::destroy($toDelete);
        } else {
            HargaPerMeter2::whereNotNull('id')->delete();
        }

        return redirect()->route(config('quickadmin.route').'.hargapermeter2.index');
    }

}
