<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Redirect;
use Schema;
use App\DataMeteranPelanggan;
use App\Http\Requests\CreateDataMeteranPelangganRequest;
use App\Http\Requests\UpdateDataMeteranPelangganRequest;
use App\TagihanBlanan;
use Illuminate\Http\Request;
use TCPDF;


class DataMeteranPelangganController extends Controller
{

	/**
	 * Display a listing of datameteranpelanggan
	 *
	 * @param Request $request
	 *
	 * @return \Illuminate\View\View
	 */
	public function index(Request $request)
	{
		$datameteranpelanggan = DataMeteranPelanggan::all();

		return view('admin.datameteranpelanggan.index', compact('datameteranpelanggan'));
	}

	/**
	 * Show the form for creating a new datameteranpelanggan
	 *
	 * @return \Illuminate\View\View
	 */
	public function create()
	{


		return view('admin.datameteranpelanggan.create');
	}

	/**
	 * Store a newly created datameteranpelanggan in storage.
	 *
	 * @param CreateDataMeteranPelangganRequest|Request $request
	 */
	public function store(CreateDataMeteranPelangganRequest $request)
	{

		DataMeteranPelanggan::create($request->all());

		return redirect()->route(config('quickadmin.route') . '.datameteranpelanggan.index');
	}

	/**
	 * Show the form for editing the specified datameteranpelanggan.
	 *
	 * @param  int  $id
	 * @return \Illuminate\View\View
	 */
	public function edit($id)
	{
		$datameteranpelanggan = DataMeteranPelanggan::find($id);


		return view('admin.datameteranpelanggan.edit', compact('datameteranpelanggan'));
	}

	/**
	 * Update the specified datameteranpelanggan in storage.
	 * @param UpdateDataMeteranPelangganRequest|Request $request
	 *
	 * @param  int  $id
	 */
	public function update($id, UpdateDataMeteranPelangganRequest $request)
	{
		$datameteranpelanggan = DataMeteranPelanggan::findOrFail($id);



		$datameteranpelanggan->update($request->all());

		return redirect()->route(config('quickadmin.route') . '.datameteranpelanggan.index');
	}

	/**
	 * Remove the specified datameteranpelanggan from storage.
	 *
	 * @param  int  $id
	 */
	public function destroy($id)
	{
		DataMeteranPelanggan::destroy($id);

		return redirect()->route(config('quickadmin.route') . '.datameteranpelanggan.index');
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
			DataMeteranPelanggan::destroy($toDelete);
		} else {
			DataMeteranPelanggan::whereNotNull('id')->delete();
		}

		return redirect()->route(config('quickadmin.route') . '.datameteranpelanggan.index');
	}
	public function getDataPelanggan($id)
	{
		$start_meteran = 0;
		$tunggakan = 0;
		$tagihanbulanan = TagihanBlanan::where('datameteranpelanggan_id', '=', $id)
			->orderBy('created_at', 'desc')
			->limit(1)
			->get();
		if (count($tagihanbulanan) < 1) {
			$datameteranpelanggan = DataMeteranPelanggan::find($id);
			$start_meteran = $datameteranpelanggan->start_meteran;
		} else {
			$start_meteran = $tagihanbulanan[0]->akhir_meteran;
			if ($tagihanbulanan[0]->status_tagihan == "belum_lunas") {
				$tunggakan = $tagihanbulanan[0]->total_tagihan;
			}
		}

		$data = array(
			'start_meteran' => $start_meteran,
			'tunggakan' => $tunggakan
		);
		return response()->json($data);
	}
	public function cetakresi($id)
	{
		$tagihan = TagihanBlanan::find($id);

		$pdf = new CustomTCPDF();
		$pdf->SetCustomPageSize(80, 50); // Atur ukuran kertas 80 x 50 (dalam satuan mm)
		$pdf->SetFont('helvetica', '', 10);

		// Add a page

		// Tampilkan judul
		$pdf->Cell(0, 10, 'Bukti Pembayaran PDAM', 0, 1, 'C');

		$pdf->SetFont('helvetica', '', 8);
		// Tampilkan informasi pembayaran
		$pdf->Cell(30, 5, 'Petugas', 0, 0);
		$pdf->Cell(0, 5, ': 3434535', 0, 1);
		$pdf->Cell(30, 5, 'Nomor Pelanggan', 0, 0);
		$pdf->Cell(0, 5, ': 3434535', 0, 1);

		$pdf->Cell(30, 5, 'Tanggal Pembayaran', 0, 0);
		$pdf->Cell(0, 5, ': 234234', 0, 1);

		$pdf->Cell(30, 5, 'Bulan Tagihan', 0, 0);
		$pdf->Cell(0, 5, ': 23234234', 0, 1);
		$pdf->Cell(30, 5, 'Status Tagihan', 0, 0);
		$pdf->Cell(0, 5, ': 23234234', 0, 1);
		$pdf->Cell(30, 5, 'Jumlah Pembayaran', 0, 0);
		$pdf->Cell(0, 5, ': 234234', 0, 1);

		// Tampilkan informasi pelanggan
		$pdf->Cell(0, 5, 'Informasi Pelanggan', 0, 1, 'B');

		$pdf->Cell(30, 5, 'Nama Pelanggan', 0, 0);
		$pdf->Cell(0, 5, ': 234243', 0, 1);

		$pdf->Cell(30, 5, 'Alamat Pelanggan', 0, 0);
		$pdf->Cell(0, 5, ': 23234234', 0, 1);

		$imagePath = public_path('images/lunas.png'); // Ganti dengan path gambar logo Anda
		$pdf->Image($imagePath, 10, $pdf->GetY() + 10, 20);
		// Output file PDF
		$pdf->Output('bukti_pembayaran.pdf', 'I');
	}
}
class CustomTCPDF extends TCPDF
{
	public function SetCustomPageSize($width, $height)
	{
		$this->SetCreator(PDF_CREATOR);
		$this->SetDisplayMode('fullpage', 'SinglePage', 'UseNone');
		$this->SetMargins(2, 1, 2, true);
		$this->SetAutoPageBreak(false, 0);
		$this->setPageOrientation('P', false, 0);
		$this->AddPage('', [intval($width), intval($height)]);
	}
}
