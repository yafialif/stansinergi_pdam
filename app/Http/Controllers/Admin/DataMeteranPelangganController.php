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
		$datameteranpelanggan = DataMeteranPelanggan::find($id);
		if (count($tagihanbulanan) < 1) {
			$start_meteran = $datameteranpelanggan->start_meteran;
		} else {
			$start_meteran = $tagihanbulanan[0]->akhir_meteran;
			if ($tagihanbulanan[0]->status_tagihan != "lunas") {
				$tunggakan = $tagihanbulanan[0]->total_tagihan;
			}
		}
		$data = array(
			'start_meteran' => $start_meteran,
			'tunggakan' => $tunggakan,
			'jenis_pelanggan' => $datameteranpelanggan->jenis_saluran
		);
		return response()->json($data);
	}
	public function ReportTagihanByPelanggan()
	{
		$data = TagihanBlanan::with("datameteranpelanggan")->where('status_tagihan', '=', 'belum_lunas')->get();
	}
	public function ReportTagihanByDate($startDate, $endDate)
	{
		// return $endDate;
		$startDate = \Carbon\Carbon::parse($startDate)->format('Y-m-d');
		$endDate = \Carbon\Carbon::parse($endDate)->format('Y-m-d');
		$data = TagihanBlanan::with("datameteranpelanggan")->where('status_tagihan', '=', 'belum_lunas')
			->whereBetween('created_at', [$startDate, $endDate])
			->get();
		return response()->json($data);
	}
	public function cetakresi($id)
	{
		$tagihan = TagihanBlanan::with('datameteranpelanggan')->join('datameteranpelanggan', 'datameteranpelanggan.id', '=', 'tagihanblanan.datameteranpelanggan_id')->find($id);

		$pdf = new CustomTCPDF();
		$pdf->SetCustomPageSize(80, 50); // Atur ukuran kertas 80 x 50 (dalam satuan mm)
		$pdf->SetFont('helvetica', '', 10);

		// Add a page

		// Tampilkan judul
		if ($tagihan->status_tagihan == "lunas") {
			$pdf->Cell(0, 10, 'Bukti Pembayaran PDAM', 0, 1, 'C');
		} else {
			$pdf->Cell(0, 10, 'Tagihan Pembayaran PDAM', 0, 1, 'C');
		}
		$pdf->SetFont('helvetica', '', 7);
		// Tampilkan informasi pembayaran
		$pdf->Cell(25, 5, 'Petugas', 0, 0);
		$pdf->Cell(0, 5, ': ' . $tagihan->nama_petugas, 0, 1);
		$pdf->Cell(25, 5, 'Nomor Pelanggan', 0, 0);
		$pdf->Cell(0, 5, ': ' . $tagihan->no_meteran, 0, 1);
		if ($tagihan->status_tagihan == "lunas") {
			$pdf->Cell(25, 5, 'Tanggal Pembayaran', 0, 0);
			$pdf->Cell(0, 5, ': ' . $tagihan->created_at, 0, 1);
		}
		$pdf->Cell(25, 5, 'Bulan Tagihan', 0, 0);
		$pdf->Cell(0, 5, ': ' . date("F", strtotime($tagihan->bulan_tagihan)), 0, 1);
		$pdf->Cell(25, 5, 'Status Tagihan', 0, 0);
		$pdf->Cell(0, 5, ': ' . $tagihan->status_tagihan, 0, 1);
		if ($tagihan->status_tagihan == "lunas") {
			$pdf->Cell(25, 5, 'Terbayar', 0, 0);
			$pdf->Cell(0, 5, ': ' . $tagihan->total_tagihan, 0, 1);
		} else {
			$pdf->Cell(25, 5, 'Tagihan', 0, 0);
			$pdf->Cell(0, 5, ': ' . $tagihan->total_tagihan, 0, 1);
		}
		// Tampilkan informasi pelanggan
		$pdf->Cell(0, 5, 'Informasi Pelanggan', 0, 1, 'B');
		$pdf->Cell(25, 5, 'Nama Pelanggan', 0, 0);
		$pdf->Cell(0, 5, ': ' . $tagihan->nama, 0, 1);
		$pdf->Cell(25, 5, 'Alamat Pelanggan', 0, 0);
		$pdf->Cell(0, 5, ': ' . $tagihan->rt . '/' . $tagihan->rw . ' ' . $tagihan->alamat, 0, 1);
		if ($tagihan->status_tagihan == "lunas") {
			$imagePath = public_path('images/lunas.png'); // Ganti dengan path gambar logo Anda
			$pdf->Image($imagePath, 15, $pdf->GetY() + 6, 20);
		}
		// Output file PDF
		$pdf->Output('bukti_pembayaran_' . $tagihan->nama . '.pdf', 'I');
	}
}
class CustomTCPDF extends TCPDF
{
	public function SetCustomPageSize($width, $height)
	{
		$this->SetCreator(PDF_CREATOR);
		$this->SetDisplayMode('fullpage', 'SinglePage', 'UseNone');
		$this->SetMargins(1, 1, 1, true);
		$this->SetAutoPageBreak(false, 0);
		$this->setPageOrientation('P', false, 0);
		$this->AddPage('', [intval($width), intval($height)]);
	}
}
