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

	public static function get_avg_luminance($image, $num_samples=10) {
		$img = imagecreatefromstring($image);

		$width = imagesx($img);
		$height = imagesy($img);

		$x_step = intval($width/$num_samples);
		$y_step = intval($height/$num_samples);

		$total_lum = 0;

		$sample_no = 1;

		for ($x=0; $x<$width; $x+=$x_step) {
			for ($y=0; $y<$height; $y+=$y_step) {

				$rgb = imagecolorat($img, $x, $y);
				$r = ($rgb >> 16) & 0xFF;
				$g = ($rgb >> 8) & 0xFF;
				$b = $rgb & 0xFF;

				// choose a simple luminance formula from here
				// http://stackoverflow.com/questions/596216/formula-to-determine-brightness-of-rgb-color
				$lum = ($r+$r+$b+$g+$g+$g)/6;

				$total_lum += $lum;

				// debugging code
				//           echo "$sample_no - XY: $x,$y = $r, $g, $b = $lum<br />";
				$sample_no++;
			}
		}

		// work out the average
		$avg_lum  = $total_lum/$sample_no;

		return $avg_lum;
	}
}
