<?php
//sprawdzamy czy w sesji zapisano nr gracza, czyli czy jest zalogowany
if(empty($_SESSION['user'])){
    //nie jest zalogowany, przenieś do strony logowania
    header("Location: logowanie.php");
} else {
    //dodatkowo zabezpieczymy sesję, rzutując wartość na liczbę
    $_SESSION['user'] = (int)$_SESSION['user'];

    //pobieramy dane gracza z bazy
    $conn = mysqli_connect("localhost", "root", "3227", "gladiatus");
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$id = mysqli_real_escape_string($conn, $id); // sanitize ID
$result = mysqli_query($conn, "SELECT * FROM gracze WHERE gracz = '$id'");
$gracz = mysqli_fetch_array($result);

    //jeżeli nie pobrało gracza, to znaczy, że ktoś kombinuje coś z sesją i trzeba go wylogować
    if(empty($uzytkownik)) header("Location: wyloguj.php");
	
		if( ($uzytkownik['centurion_time'] > 0) && ($uzytkownik['centurion_time'] < time()) ){
	if($uzytkownik['rank'] < 3) {
	mysql_query("update gracze set centurion_time = 0, rank = 1 where gracz = ".$uzytkownik['gracz']);
	}
	}
		if( ($uzytkownik['bendicion1_time'] > 0) && ($uzytkownik['bendicion1_time'] < time()) ){
	mysql_query("update gracze set bendicion1_time = 0, bendicion1_type = 0 where gracz = ".$uzytkownik['gracz']);
	}
		if( ($uzytkownik['bendicion2_time'] > 0) && ($uzytkownik['bendicion2_time'] < time()) ){
	mysql_query("update gracze set bendicion2_time = 0, bendicion2_type = 0 where gracz = ".$uzytkownik['gracz']);
	}
		if( ($uzytkownik['bendicion3_time'] > 0) && ($uzytkownik['bendicion3_time'] < time()) ){
	mysql_query("update gracze set bendicion3_time = 0, bendicion3_type = 0 where gracz = ".$uzytkownik['gracz']);
	}
		if( ($uzytkownik['bendicion4_time'] > 0) && ($uzytkownik['bendicion4_time'] < time()) ){
	mysql_query("update gracze set bendicion4_time = 0, bendicion4_type = 0 where gracz = ".$uzytkownik['gracz']);
	}

	$tst = $uzytkownik['sila'];
	$tab = $uzytkownik['zrecznosc'];
	$tag = $uzytkownik['wyrzymalosc'];
	$tco = $uzytkownik['constitucion'];
	$tch = $uzytkownik['carisma'];
	$tin = $uzytkownik['inteligencja'];
	
if($uzytkownik['bendicion1_type'] == 3){
$chmt = 1.50;
} else {
$chmt = 1;
}

if($uzytkownik['bendicion1_type'] == 5){
$lfmt = 1.75;
} else {
$lfmt = 1;
}

if($uzytkownik['bendicion3_type'] == 1){
$dmmt = 1.25;
} else {
$dmmt = 1;
}

if($uzytkownik['bendicion3_type'] == 2){
$skmt = 1.50;
} else {
$skmt = 1;
}

if($uzytkownik['bendicion3_type'] == 3){
$ctct = 10;
} else {
$ctct = 0;
}

if($uzytkownik['bendicion3_type'] == 4){
$stmt = 1.50;
} else {
$stmt = 1;
}

if($uzytkownik['bendicion4_type'] == 4){
$agmt = 1.50;
} else {
$agmt = 1;
}

if($uzytkownik['bendicion4_type'] == 5){
$comt = 1.50;
} else {
$comt = 1;
}

$uzytkownik['zycie_max'] = (int)($uzytkownik['zycie_max'] * $lfmt);

mysql_query("update gracze set zycie_max = ".$uzytkownik['zycie_max']." where gracz = ".$uzytkownik['gracz']);

$uzytkownik['carisma_max'] = (int)($uzytkownik['carisma_max'] * $chmt);

mysql_query("update gracze set carisma_max = ".$uzytkownik['carisma_max']." where gracz = ".$uzytkownik['gracz']);

$rom1 = $uzytkownik['obrazenia_min'];
$rom2 = $uzytkownik['obrazenia_max'];
$srom1 = (int)($rom1 * $dmmt);
$srom2 = (int)($rom2 * $dmmt);

mysql_query("update gracze set obrazenia_min = ".$srom1.", obrazenia_max = ".$srom2." where gracz = ".$uzytkownik['gracz']);

$uzytkownik['zrecznosc'] = (int)($uzytkownik['zrecznosc'] * $chmt);

mysql_query("update gracze set zrecznosc = ".$uzytkownik['zrecznosc']." where gracz = ".$uzytkownik['gracz']);

$uzytkownik['ctchance'] = (int)($uzytkownik['ctchance'] + $ctct);

mysql_query("update gracze set ctchance = ".$uzytkownik['ctchance']." where gracz = ".$uzytkownik['gracz']);

$uzytkownik['sila_max'] = (int)($uzytkownik['sila_max'] * $stmt);

mysql_query("update gracze set sila_max = ".$uzytkownik['sila_max']." where gracz = ".$uzytkownik['gracz']);

$uzytkownik['wyrzymalosc_max'] = (int)($uzytkownik['wyrzymalosc_max'] * $agmt);

mysql_query("update gracze set wyrzymalosc_max = ".$uzytkownik['wyrzymalosc_max']." where gracz = ".$uzytkownik['gracz']);

$uzytkownik['constitucion_max'] = (int)($uzytkownik['constitucion_max'] * $comt);

mysql_query("update gracze set constitucion_max = ".$uzytkownik['constitucion_max']." where gracz = ".$uzytkownik['gracz']);
	
$plife = $uzytkownik['zycie'] * 100 / $uzytkownik['zycie_max'];
if($uzytkownik['exp'] <= 0){
$pexp = 0;
} else {
$pexp = $uzytkownik['exp'] * 100 / $uzytkownik['exp_max'];
}
$pst = $uzytkownik['sila'] * 100 / $uzytkownik['sila_max'];
$pab = $uzytkownik['zrecznosc'] * 100 / $uzytkownik['zrecznosc_max'];
$pag = $uzytkownik['wyrzymalosc'] * 100 / $uzytkownik['wyrzymalosc_max'];
$pco = $uzytkownik['constitucion'] * 100 / $uzytkownik['constitucion_max'];
$pch = $uzytkownik['carisma'] * 100 / $uzytkownik['carisma_max'];
$pin = $uzytkownik['inteligencja'] * 100 / $uzytkownik['inteligencja_max'];
	
	$uzytkownik['sila'] = $uzytkownik['sila'] + $uzytkownik['sila_i'];
	$uzytkownik['zrecznosc'] = $uzytkownik['zrecznosc'] + $uzytkownik['zrecznosc_i'];
	$uzytkownik['wyrzymalosc'] = $uzytkownik['wyrzymalosc'] + $uzytkownik['wyrzymalosc_i'];
	$uzytkownik['constitucion'] = $uzytkownik['constitucion'] + $uzytkownik['constitucion_i'];
	$uzytkownik['carisma'] = $uzytkownik['carisma'] + $uzytkownik['carisma_i'];
	$uzytkownik['inteligencja'] = $uzytkownik['inteligencja'] + $uzytkownik['inteligencja_i'];
	
	if($uzytkownik['sila'] < 1){
	$uzytkownik['sila'] = 1;
	}
	if($uzytkownik['zrecznosc'] < 1){
	$uzytkownik['zrecznosc'] = 1;
	}
	if($uzytkownik['wyrzymalosc'] < 1){
	$uzytkownik['wyrzymalosc'] = 1;
	}
	if($uzytkownik['constitucion'] < 1){
	$uzytkownik['constitucion'] = 1;
	}
	if($uzytkownik['carisma'] < 1){
	$uzytkownik['carisma'] = 1;
	}
	if($uzytkownik['inteligencja'] < 1){
	$uzytkownik['inteligencja'] = 1;
	}
	
	
	if($uzytkownik['zycie'] > $uzytkownik['zycie_max']){	
	$uzytkownik['zycie'] = $uzytkownik['zycie_max'];
	
	mysql_query("update gracze set zycie = ".$uzytkownik['zycie']." where gracz = ".$uzytkownik['gracz']);
	
	}
	
	
	if($uzytkownik['exp'] >= $uzytkownik['exp_max']){
	
	$exp = $uzytkownik['exp'] - $uzytkownik['exp_max'];
	$new_exp_max = $uzytkownik['exp_max'] + 3 * ($uzytkownik['nivel']+ 1);
	$new_nivel = $uzytkownik['nivel'] + 1;
	if($uzytkownik['bendicion2_type'] == 5){
	$oxlt = 1.5;
	} else {
	$oxlt = 1;
	}
	$zloto1 = $uzytkownik['nivel'] * 123;
	$zloto = $zloto1 * $oxlt;
	$zycie_max = 25;
	$lvl = $uzytkownik['nivel'];
	
	if($lvl % 3 == 0){
	$sm = 1;
	$zm = 1;
	$wm = 1;
	$cm1 = 1;
	$cm2 = 1;
	$im = 1;
	
	mysql_query("update gracze set inteligencja_max = inteligencja_max + ".$im.", sila_max = sila_max + ".$sm.", zrecznosc_max = zrecznosc_max + ".$zm.", wyrzymalosc_max = wyrzymalosc_max + ".$wm.", constitucion_max = constitucion_max + ".$cm1.", carisma_max = carisma_max + ".$cm2." where gracz = ".$uzytkownik['gracz']);
	}
	
	mysql_query("update gracze set exp = ".$exp.", zloto = zloto + ".$zloto." nivel = ".$new_nivel.", exp_max = ".$new_exp_max.", zycie = zycie + ".$zycie_max.", zycie_max = zycie_max + ".$zycie_max." where gracz = ".$uzytkownik['gracz']);
	
	}
	
	if($uzytkownik['nivel'] >= 100){
	
	$arena_level = 100;
	
	$new_exp = $uzytkownik['exp'] - $uzytkownik['exp_max'];
	$new_exp_max = $uzytkownik['exp_max'] + 3 * ($uzytkownik['nivel']+ 1);
	$new_nivel = $uzytkownik['nivel'] + 1;
	$zycie_max = $uzytkownik['nivel'] * 100 * 10 / 100;
	$arena_level2 = $arena_level;
	
	mysql_query("update gracze set arena_level = ".$arena_level2." where gracz = ".$uzytkownik['gracz']);
	
	}elseif($uzytkownik['nivel'] >= 90){
	
	$arena_level = 90;
	
	$new_exp = $uzytkownik['exp'] - $uzytkownik['exp_max'];
	$new_exp_max = $uzytkownik['exp_max'] + 3 * ($uzytkownik['nivel']+ 1);
	$new_nivel = $uzytkownik['nivel'] + 1;
	$zycie_max = $uzytkownik['nivel'] * 100 * 10 / 100;
	$arena_level2 = $arena_level;
	
	mysql_query("update gracze set arena_level = ".$arena_level2." where gracz = ".$uzytkownik['gracz']);
	
	}elseif($uzytkownik['nivel'] >= 80){
	
	$arena_level = 80;
	
	$new_exp = $uzytkownik['exp'] - $uzytkownik['exp_max'];
	$new_exp_max = $uzytkownik['exp_max'] + 3 * ($uzytkownik['nivel']+ 1);
	$new_nivel = $uzytkownik['nivel'] + 1;
	$zycie_max = $uzytkownik['nivel'] * 100 * 10 / 100;
	$arena_level2 = $arena_level;
	
	mysql_query("update gracze set arena_level = ".$arena_level2." where gracz = ".$uzytkownik['gracz']);
	
	}elseif($uzytkownik['nivel'] >= 70){
	
	$arena_level = 70;
	
	$new_exp = $uzytkownik['exp'] - $uzytkownik['exp_max'];
	$new_exp_max = $uzytkownik['exp_max'] + 3 * ($uzytkownik['nivel']+ 1);
	$new_nivel = $uzytkownik['nivel'] + 1;
	$zycie_max = $uzytkownik['nivel'] * 100 * 10 / 100;
	$arena_level2 = $arena_level;
	
	mysql_query("update gracze set arena_level = ".$arena_level2." where gracz = ".$uzytkownik['gracz']);
	
	}elseif($uzytkownik['nivel'] >= 60){
	
	$arena_level = 60;
	
	$new_exp = $uzytkownik['exp'] - $uzytkownik['exp_max'];
	$new_exp_max = $uzytkownik['exp_max'] + 3 * ($uzytkownik['nivel']+ 1);
	$new_nivel = $uzytkownik['nivel'] + 1;
	$zycie_max = $uzytkownik['nivel'] * 100 * 10 / 100;
	$arena_level2 = $arena_level;
	
	mysql_query("update gracze set arena_level = ".$arena_level2." where gracz = ".$uzytkownik['gracz']);
	
	}elseif($uzytkownik['nivel'] >= 50){
	
	$arena_level = 50;
	
	$new_exp = $uzytkownik['exp'] - $uzytkownik['exp_max'];
	$new_exp_max = $uzytkownik['exp_max'] + 3 * ($uzytkownik['nivel']+ 1);
	$new_nivel = $uzytkownik['nivel'] + 1;
	$zycie_max = $uzytkownik['nivel'] * 100 * 10 / 100;
	$arena_level2 = $arena_level;
	
	mysql_query("update gracze set arena_level = ".$arena_level2." where gracz = ".$uzytkownik['gracz']);
	
	}elseif($uzytkownik['nivel'] >= 40){
	
	$arena_level = 40;
	
	$new_exp = $uzytkownik['exp'] - $uzytkownik['exp_max'];
	$new_exp_max = $uzytkownik['exp_max'] + 3 * ($uzytkownik['nivel']+ 1);
	$new_nivel = $uzytkownik['nivel'] + 1;
	$zycie_max = $uzytkownik['nivel'] * 100 * 10 / 100;
	$arena_level2 = $arena_level;
	
	mysql_query("update gracze set arena_level = ".$arena_level2." where gracz = ".$uzytkownik['gracz']);
	
	}elseif($uzytkownik['nivel'] >= 30){
	
	$arena_level = 30;
	
	$new_exp = $uzytkownik['exp'] - $uzytkownik['exp_max'];
	$new_exp_max = $uzytkownik['exp_max'] + 3 * ($uzytkownik['nivel']+ 1);
	$new_nivel = $uzytkownik['nivel'] + 1;
	$zycie_max = $uzytkownik['nivel'] * 100 * 10 / 100;
	$arena_level2 = $arena_level;
	
	mysql_query("update gracze set arena_level = ".$arena_level2." where gracz = ".$uzytkownik['gracz']);
	
	}elseif($uzytkownik['nivel'] >= 20){
	
	$arena_level = 20;
	
	$new_exp = $uzytkownik['exp'] - $uzytkownik['exp_max'];
	$new_exp_max = $uzytkownik['exp_max'] + 3 * ($uzytkownik['nivel']+ 1);
	$new_nivel = $uzytkownik['nivel'] + 1;
	$zycie_max = $uzytkownik['nivel'] * 100 * 10 / 100;
	$arena_level2 = $arena_level;
	
	mysql_query("update gracze set arena_level = ".$arena_level2." where gracz = ".$uzytkownik['gracz']);
	
	}elseif($uzytkownik['nivel'] >= 10){
	
	$arena_level = 10;
	
	$new_exp = $uzytkownik['exp'] - $uzytkownik['exp_max'];
	$new_exp_max = $uzytkownik['exp_max'] + 3 * ($uzytkownik['nivel']+ 1);
	$new_nivel = $uzytkownik['nivel'] + 1;
	$zycie_max = $uzytkownik['nivel'] * 100 * 10 / 100;
	$arena_level2 = $arena_level;	
	mysql_query("update gracze set arena_level = ".$arena_level2." where gracz = ".$uzytkownik['gracz']);	
	}elseif($uzytkownik['nivel'] >= 2){	
	$arena_level = 2;
	$arena_level2 = $arena_level;	
	mysql_query("update gracze set arena_level = ".$arena_level2." where gracz = ".$uzytkownik['gracz']);	
	}
	
	$plife = $uzytkownik['zycie'] * 100 / $uzytkownik['zycie_max'];
	if($uzytkownik['exp'] <= 0){
	$pexp = 0;
	} else {
	$pexp = $uzytkownik['exp'] * 100 / $uzytkownik['exp_max'];
	}
	
	$pst = $uzytkownik['sila'] * 100 / $uzytkownik['sila_max'];
	$pab = $uzytkownik['zrecznosc'] * 100 / $uzytkownik['zrecznosc_max'];
	$pag = $uzytkownik['wyrzymalosc'] * 100 / $uzytkownik['wyrzymalosc_max'];
	$pco = $uzytkownik['constitucion'] * 100 / $uzytkownik['constitucion_max'];
	$pch = $uzytkownik['carisma'] * 100 / $uzytkownik['carisma_max'];
	$pin = $uzytkownik['inteligencja'] * 100 / $uzytkownik['inteligencja_max'];
	
	
	if($uzytkownik['nivel'] >= 80){
	$uzytkownik['avatar'] = 10;
	} elseif($uzytkownik['nivel'] >= 70){
	$uzytkownik['avatar'] = 9;
	} elseif($uzytkownik['nivel'] >= 60){
	$uzytkownik['avatar'] = 8;
	} elseif($uzytkownik['nivel'] >= 50){
	$uzytkownik['avatar'] = 7;
	} elseif($uzytkownik['nivel'] >= 40){
	$uzytkownik['avatar'] = 6;
	} elseif($uzytkownik['nivel'] >= 30){
	$uzytkownik['avatar'] = 5;
	} elseif($uzytkownik['nivel'] >= 20){
	$uzytkownik['avatar'] = 4;
	} elseif($uzytkownik['nivel'] >= 10){
	$uzytkownik['avatar'] = 3;
	} elseif($uzytkownik['nivel'] >= 5){
	$uzytkownik['avatar'] = 2;
	} elseif($uzytkownik['nivel'] >= 1){
	$uzytkownik['avatar'] = 1;
	}
	
if($uzytkownik['bendicion1_type'] == 2){
$lfrt = 0.75;
} else {
$lfrt = 0;
}
	
	if($uzytkownik['rank'] > 2){
	
	//regeneracja życia
    if($uzytkownik['ostatnio_zregenerowano'] + 75 < time()){
        //minęło 5 min od czasu ostatniej regeneracji życia gracza

        if($uzytkownik['zycie'] < $uzytkownik['zycie_max']){
            //jeżeli trzeba regenerować
            
            //sprawdzamy ile trzeba zregenerować punktów
            $max = $uzytkownik['zycie_max'] - $uzytkownik['zycie'];

            //sprawdzamy ile czasu minęło od ostatniej regeneracji (jeden obieg to 5min = 300sek)
            $obieg = ((time() - $uzytkownik['ostatnio_zregenerowano']) / 75);

            //sprawdzamy ile życia regeneruje się w 1 obiegu, my przyjmujemy 10% * max ilość życia
            $reg1 = (int)($uzytkownik['inteligencja'] / 300);
			$reg2 = (int)(0.1 + $reg1);
            $reg = (int)(($uzytkownik['zycie_max'] * $reg2) * 4) + (int)((($uzytkownik['zycie_max'] * $reg2) * 4) * $lfrt);

            //obliczamy ile dokładnie można zregenerować punktów życia, mnożąc ilość obiegów przez wskaźnik regeneracji
            $lecz = floor($obieg * $reg);

            //minimum regeneruje się 5 punktów
            if($lecz < 5) $lecz = 20;

            //jeżeli ilość wyleczonego życia jest większa niż maksimum życia gracza, to ogranicz dane do maksimum
            if($lecz > $max) $lecz = $max;

            mysql_query("update gracze set ostatnio_zregenerowano = ".time().", zycie = zycie + ".$lecz." where gracz = ".$uzytkownik['gracz']);
        } 
    }
	
	} elseif($uzytkownik['rank'] > 1){
	
	//regeneracja życia
    if($uzytkownik['ostatnio_zregenerowano'] + 150 < time()){
        //minęło 5 min od czasu ostatniej regeneracji życia gracza

        if($uzytkownik['zycie'] < $uzytkownik['zycie_max']){
            //jeżeli trzeba regenerować
            
            //sprawdzamy ile trzeba zregenerować punktów
            $max = $uzytkownik['zycie_max'] - $uzytkownik['zycie'];

            //sprawdzamy ile czasu minęło od ostatniej regeneracji (jeden obieg to 5min = 300sek)
            $obieg = ((time() - $uzytkownik['ostatnio_zregenerowano']) / 150);

            //sprawdzamy ile życia regeneruje się w 1 obiegu, my przyjmujemy 10% * max ilość życia
            $reg1 = (int)($uzytkownik['inteligencja'] / 300);
			$reg2 = (int)(0.1 + $reg1);
            $reg = (int)(($uzytkownik['zycie_max'] * $reg2) * 2) + (int)((($uzytkownik['zycie_max'] * $reg2) * 2) * $lfrt);

            //obliczamy ile dokładnie można zregenerować punktów życia, mnożąc ilość obiegów przez wskaźnik regeneracji
            $lecz = floor($obieg * $reg);

            //minimum regeneruje się 5 punktów
            if($lecz < 5) $lecz = 10;

            //jeżeli ilość wyleczonego życia jest większa niż maksimum życia gracza, to ogranicz dane do maksimum
            if($lecz > $max) $lecz = $max;

            mysql_query("update gracze set ostatnio_zregenerowano = ".time().", zycie = zycie + ".$lecz." where gracz = ".$uzytkownik['gracz']);
        } 
    }
	
	} elseif($uzytkownik['rank'] = 1) {
	if($uzytkownik['ostatnio_zregenerowano'] + 300 < time()){
        //minęło 5 min od czasu ostatniej regeneracji życia gracza

        if($uzytkownik['zycie'] < $uzytkownik['zycie_max']){
            //jeżeli trzeba regenerować
            
            //sprawdzamy ile trzeba zregenerować punktów
            $max = $uzytkownik['zycie_max'] - $uzytkownik['zycie'];

            //sprawdzamy ile czasu minęło od ostatniej regeneracji (jeden obieg to 5min = 300sek)
            $obieg = ((time() - $uzytkownik['ostatnio_zregenerowano']) / 300);

            //sprawdzamy ile życia regeneruje się w 1 obiegu, my przyjmujemy 10% * max ilość życia
			$reg1 = (int)($uzytkownik['inteligencja'] / 300);
			$reg2 = (int)(0.1 + $reg1);
            $reg = (int)($uzytkownik['zycie_max'] * $reg2) + (int)(($uzytkownik['zycie_max'] * $reg2) * $lfrt);

            //obliczamy ile dokładnie można zregenerować punktów życia, mnożąc ilość obiegów przez wskaźnik regeneracji
            $lecz = floor($obieg * $reg);

            //minimum regeneruje się 5 punktów
            if($lecz < 5) $lecz = 5;

            //jeżeli ilość wyleczonego życia jest większa niż maksimum życia gracza, to ogranicz dane do maksimum
            if($lecz > $max) $lecz = $max;

            mysql_query("update gracze set ostatnio_zregenerowano = ".time().", zycie = zycie + ".$lecz." where gracz = ".$uzytkownik['gracz']);
        } 
    }
	}
	
}

            if($uzytkownik['sila'] > $uzytkownik['sila_max']){
			$uzytkownik['sila'] = $uzytkownik['sila_max'];
			}
            if($uzytkownik['zrecznosc'] > $uzytkownik['zrecznosc_max']){
			$uzytkownik['zrecznosc'] = $uzytkownik['zrecznosc_max'];
			}
            if($uzytkownik['wyrzymalosc'] > $uzytkownik['wyrzymalosc_max']){
			$uzytkownik['wyrzymalosc'] = $uzytkownik['wyrzymalosc_max'];
			}
			if($uzytkownik['constitucion'] > $uzytkownik['constitucion_max']){
			$uzytkownik['constitucion'] = $uzytkownik['constitucion_max'];
			}
			if($uzytkownik['carisma'] > $uzytkownik['carisma_max']){
			$uzytkownik['carisma'] = $uzytkownik['carisma_max'];
			}
			if($uzytkownik['inteligencja'] > $uzytkownik['inteligencja_max']){
			$uzytkownik['inteligencja'] = $uzytkownik['inteligencja_max'];
			}
?> 
