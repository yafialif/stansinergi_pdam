<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateTagihanBlananRequest extends FormRequest {

	/**
	 * Determine if the user is authorized to make this request.
	 *
	 * @return bool
	 */
	public function authorize()
	{
		return true;
	}

	/**
	 * Get the validation rules that apply to the request.
	 *
	 * @return array
	 */
	public function rules()
	{
		return [
            'datameteranpelanggan_id' => 'required', 
            'awal_meteran' => 'required', 
            'akhir_meteran' => 'required', 
            'total_pemakaian' => 'required', 
            'harga' => 'required', 
            'total_tagihan_bulan_ini' => 'required', 
            'tunggakan_sebelumnya' => 'required', 
            'status_tagihan' => 'required', 
            
		];
	}
}
