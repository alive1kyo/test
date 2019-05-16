	//	和暦表示（誕生日・契約日）from hl_paycont
	function convGtJDate($thaday) {
		$year = substr($thaday, 0, 4);
		$month = substr($thaday, 4, 2);
		$day = substr($thaday, 6, 2);
		$date = $thaday;
		$gengo = "";
		$wayear = 0;
		// if文
    if ($date >= 20190501) {
			$gengo = "令和";
			$wayear = $year - 2018;
		} elseif ($date >= 19890108) {
			$gengo = "平成";
			$wayear = $year - 1988;
		} elseif ($date >= 19261225) {
			$gengo = "昭和";
			$wayear = $year - 1925;
		} elseif ($date >= 19120730) {
			$gengo = "大正";
			$wayear = $year - 1911;
		} elseif ($date >= 18680125) {
			$gengo = "明治";
			$wayear = $year - 1867;
		} else {
			$gengo = "江戸時代以前";
			$wayear = 0;
		}
    // 3項演算子
    $wayear = ($wayear <= 0) ? 0 : $wayear;
		// switch文
    switch ($wayear) {
			case 0:
				$wadate = $gengo;
				break;
			case 1:
				$wadate = $gengo."元年".$month."月".$day."日";
				break;
			default:
				$wadate = $gengo.sprintf("%02d", $wayear)."年".$month."月".$day."日";
		}
		if ($thaday.length <= 5) {$wadate = "-";}
		return ($wadate);
	}
