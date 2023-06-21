<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\TagihanBlanan;
use Illuminate\Support\Facades\Auth;
use App\User;
use Illuminate\Validation\Rules\RequiredIf;
use Symfony\Component\HttpFoundation\Request;

class SetoranController extends Controller
{

	/**
	 * Index page
	 *
	 * @param Request $request
	 *
	 * @return \Illuminate\View\View
	 */
	public function index(Request $request)
	{
		if ($request['id_user']) {
			$user = User::where('role_id', '>=', 2)->pluck("name", "id")->prepend('Please select', 0);
			$tagihanblanan = TagihanBlanan::with("datameteranpelanggan")
				->where('id_petugas', '=', $request['id_user'])
				->where('status_storan', '=', null)
				->get();
			return view('admin.setoran.index', compact('tagihanblanan', 'user'));
			// return $tagihanblanan;
		}
		$user_id = Auth::user()->id;
		$role_id = Auth::user()->role_id;
		if ($role_id <= 2) {
			$tagihanblanan = '';
			$user = User::where('role_id', '>=', 2)->pluck("name", "id")->prepend('Please select', 0);
			return view('admin.setoran.index', compact('user', 'tagihanblanan'));
		} else {
			$tagihanblanan = TagihanBlanan::with("datameteranpelanggan")
				->where('id_petugas', '=', $user_id)
				->where('status_storan', '=', null)
				->get();
			return view('admin.setoran.index', compact('tagihanblanan'));
		}
		// return response()->json($tagihanblanan);

		// return view('admin.setoran.index');
	}
	public function kirimstoran(Request $request)
	{
		// return $request;
		if ($request->get('setorkan') != 'mass') {
			$toUpdate = json_decode($request->get('setorkan'));
			$dataToUpdate = [
				'status_storan' => true,
			];

			TagihanBlanan::whereIn('id', $toUpdate)->update($dataToUpdate);
		} else {
			$toUpdate = json_decode($request->get('setorkan'));
			$dataToUpdate = [
				'status_storan' => true,
			];

			TagihanBlanan::whereIn('id', $toUpdate)->update($dataToUpdate);
		}
		return redirect()->route(config('quickadmin.route') . '.setoran.index');
	}
}
