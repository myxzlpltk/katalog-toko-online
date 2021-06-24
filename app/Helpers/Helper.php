<?php

namespace App\Helpers;

class Helper{

	public static function idr($price){
		return 'Rp. '.str_replace(',', '.', number_format($price));
	}
}
