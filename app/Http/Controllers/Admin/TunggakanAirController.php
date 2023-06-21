<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\DataMeteranPelanggan;
use App\TagihanBlanan;

class TunggakanAirController extends Controller
{

	/**
	 * Index page
	 *
	 * @param Request $request
	 *
	 * @return \Illuminate\View\View
	 */
	public function index()
	{
		$data = TagihanBlanan::with("datameteranpelanggan")->where('status_tagihan', '=', 'belum_lunas')->get();
		return view('admin.tunggakanair.index', compact('data'));
	}
}
