<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Redirect;
use Schema;
use App\TagihanBlanan;
use App\Http\Requests\CreateTagihanBlananRequest;
use App\Http\Requests\UpdateTagihanBlananRequest;
use Illuminate\Http\Request;

use App\DataMeteranPelanggan;


class TagihanBlananController extends Controller {

	/**
	 * Display a listing of tagihanblanan
	 *
     * @param Request $request
     *
     * @return \Illuminate\View\View
	 */
	public function index(Request $request)
    {
        $tagihanblanan = TagihanBlanan::with("datameteranpelanggan")->get();

		return view('admin.tagihanblanan.index', compact('tagihanblanan'));
	}

	/**
	 * Show the form for creating a new tagihanblanan
	 *
     * @return \Illuminate\View\View
	 */
	public function create()
	{
	    $datameteranpelanggan = DataMeteranPelanggan::pluck("nama", "id")->prepend('Please select', 0);

	    
	    return view('admin.tagihanblanan.create', compact("datameteranpelanggan"));
	}

	/**
	 * Store a newly created tagihanblanan in storage.
	 *
     * @param CreateTagihanBlananRequest|Request $request
	 */
	public function store(CreateTagihanBlananRequest $request)
	{
	    
		TagihanBlanan::create($request->all());

		return redirect()->route(config('quickadmin.route').'.tagihanblanan.index');
	}

	/**
	 * Show the form for editing the specified tagihanblanan.
	 *
	 * @param  int  $id
     * @return \Illuminate\View\View
	 */
	public function edit($id)
	{
		$tagihanblanan = TagihanBlanan::find($id);
	    $datameteranpelanggan = DataMeteranPelanggan::pluck("nama", "id")->prepend('Please select', 0);

	    
		return view('admin.tagihanblanan.edit', compact('tagihanblanan', "datameteranpelanggan"));
	}

	/**
	 * Update the specified tagihanblanan in storage.
     * @param UpdateTagihanBlananRequest|Request $request
     *
	 * @param  int  $id
	 */
	public function update($id, UpdateTagihanBlananRequest $request)
	{
		$tagihanblanan = TagihanBlanan::findOrFail($id);

        

		$tagihanblanan->update($request->all());

		return redirect()->route(config('quickadmin.route').'.tagihanblanan.index');
	}

	/**
	 * Remove the specified tagihanblanan from storage.
	 *
	 * @param  int  $id
	 */
	public function destroy($id)
	{
		TagihanBlanan::destroy($id);

		return redirect()->route(config('quickadmin.route').'.tagihanblanan.index');
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
            TagihanBlanan::destroy($toDelete);
        } else {
            TagihanBlanan::whereNotNull('id')->delete();
        }

        return redirect()->route(config('quickadmin.route').'.tagihanblanan.index');
    }

}
