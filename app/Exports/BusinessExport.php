<?php

namespace App\Exports;

use App\Models\Business;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class BusinessExport implements FromQuery, WithHeadings, WithMapping {

	private $incr = 1;

	public function query(){
		$with = [
			'businessType.businessField',
			'activeMembers.user' => function($query){
				return $query->without('userable');
			},
			'teacher.user' => function($query){
				return $query->without('userable');
			},
		];

		if(auth()->user()->is_admin){
			return Business::query()->latest()->with($with);
		}
		else{
			return Business::query()
				->where('teacher_id', auth()->user()->userable_id)
				->latest()
				->with($with);
		}
	}

	public function headings(): array{
		return [
			'#',
			'Tanggal Entri',
			'Nama Usaha',
			'Tagline',
			'Jenis Usaha',
			'Bidang Usaha',
			'Direktur',
			'Dosen Pembimbing',
			'Anggota 1',
			'Anggota 2',
			'Anggota 3',
			'Anggota 4',
			'Anggota 5',
		];
	}

	public function map($business): array{
		return array_merge(
			[
				$this->incr++,
				$business->created_at,
				$business->name,
				$business->tagline,
				$business->businessType->name,
				$business->businessType->businessField->name,
				$business->activeMembers->where('id', $business->owner_id)->first()->user->name,
				$business->teacher->user->name,
			],
			$business->activeMembers->where('id', '!=', $business->owner_id)->pluck('user.name')->toArray()
		);
	}
}
