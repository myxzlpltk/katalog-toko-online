<?php

namespace Database\Seeders;

use App\Models\BusinessField;
use App\Models\BusinessType;
use Illuminate\Database\Seeder;

class BusinessFieldSeeder extends Seeder{

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(){
    	$fields = [
    		'Pertanian' => ['Pertaniaan', 'Kehutanan', 'Perikanan', 'Perkebunan'],
			'Pertambangan' => ['Galian Pasir', 'Galian Tanah', 'Galian Batu', 'Galian Bata'],
			'Pabrikasi' => ['Industri', 'Assembly', 'Sintesis'],
			'Kontruksi' => ['Kontruksi Bangunan', 'Kontruksi Jembatan', 'Kontruksi Pengairan', 'Kontruksi Jalan Raya'],
			'Perdagangan' => ['Perdagangan Kecil', 'Perdagangan Grosir', 'Perdagangan Agen', 'Perdagangan Ekspor-Impor'],
			'Jasa Keuangan' => ['Perbankkan', 'Asuransi', 'Koperasi'],
			'Jasa Perorangan' => ['Potongan Rambut', 'Salon', 'Loundry', 'Catering'],
			'Jasa Umum' => ['Pengangkutan', 'Pergudangan', 'Wartel', 'Distribusi'],
			'Jasa Wisata' => ['Jasa Biro Perjalanan Wisata', 'Jasa Prawuwista'],
		];

    	foreach($fields as $field => $types){
			$businessField = BusinessField::query()->create(['name' => $field]);

			foreach($types as $type){
				BusinessType::query()->create(['name' => $type, 'business_field_id' => $businessField->id]);
			}
		}
    }
}
