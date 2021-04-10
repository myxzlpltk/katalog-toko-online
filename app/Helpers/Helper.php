<?php

namespace App\Helpers;

class Helper{

	public static function rating($rating){
		$rating = floor($rating*2)/2;
		if(!$rating) return 'Belum ada rating';

		$html = '';
		for ($i=1; $i<=5; $i++) $html .= self::_rating($rating, $i);
		return $html;
	}

	public static function _rating($rating, $index=6){
		$ratingPartial = $rating - $index + 1;
		if($ratingPartial >= 1){
			return '<span class="icon_star"></span>';
		}
		elseif($ratingPartial >= 0.5){
			return '<span class="icon_star-half_alt"></span>';
		}
		else{
			return '<span class="icon_star_alt"></span>';
		}
	}

	public static function idr($price){
		return 'Rp. '.str_replace(',', '.', number_format($price));
	}
}
