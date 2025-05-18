<?php
//sprawdzamy czy w sesji zapisano nr gracza, czyli czy jest zalogowany
if(empty($_SESSION['user'])){
    //nie jest zalogowany, przenieś do strony logowania
    header("Location: logowanie.php");
} else {
    //dodatkowo zabezpieczymy sesję, rzutując wartość na liczbę
    $_SESSION['user'] = (int)$_SESSION['user'];

    //pobieramy dane gracza z bazy
    $uzytkownik = mysql_fetch_array(mysql_query("select * from gracze where gracz = ".$_SESSION['user']));

    //jeżeli nie pobrało gracza, to znaczy, że ktoś kombinuje coś z sesją i trzeba go wylogować
    if(empty($uzytkownik)) header("Location: wyloguj.php");
	
    if($uzytkownik['exp'] >= $uzytkownik['exp_max']){
	
	$new_exp = $uzytkownik['exp'] - $uzytkownik['exp_max'];
	$new_exp_max = $uzytkownik['exp_max'] + 3 * ($uzytkownik['nivel']+ 1);
	$new_nivel = $uzytkownik['nivel'] + 1;
	$zycie_max = $uzytkownik['nivel'] * 100 * 10 / 100;
	
	mysql_query("update gracze set exp = ".$new_exp.", nivel = ".$new_nivel.", exp_max = ".$new_exp_max.", zycie = zycie_max, zycie_max = zycie_max + ".$zycie_max." where gracz = ".$uzytkownik['gracz']);
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
            $reg = $uzytkownik['zycie_max'] * 0.3;

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
            $reg = $uzytkownik['zycie_max'] * 0.2;

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
            $reg = $uzytkownik['zycie_max'] * 0.1;

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
	
	if($uzytkownik['nivel'] >= 100){
	
	$arena_level = 100;
	
	}elseif($uzytkownik['nivel'] >= 90){
	
	$arena_level = 90;
	
	}elseif($uzytkownik['nivel'] >= 80){
	
	$arena_level = 80;
	
	}elseif($uzytkownik['nivel'] >= 70){
	
	$arena_level = 70;
	
	}elseif($uzytkownik['nivel'] >= 60){
	
	$arena_level = 60;
	
	}elseif($uzytkownik['nivel'] >= 50){
	
	$arena_level = 50;
	
	}elseif($uzytkownik['nivel'] >= 40){
	
	$arena_level = 40;
	
	}elseif($uzytkownik['nivel'] >= 30){
	
	$arena_level = 30;
	
	}elseif($uzytkownik['nivel'] >= 20){
	
	$arena_level = 20;
	
	}elseif($uzytkownik['nivel'] >= 10){
	
	$arena_level = 10;
	
	}elseif($uzytkownik['nivel'] >= 2){
	
	$arena_level = 2;
	
	mysql_query("update gracze set arena_level = ".$arena_level." where gracz = ".$uzytkownik['gracz']);
	}	
	
	if($uzytkownik['rank'] > 2){
	
	$pozostalo1 = $uzytkownik['ostatnia_walka_pvc'] + 300 - time();
	$p1 = time() - 600;
		
	if($pozostalo1 > 0){
	
	mysql_query("update gracze set ostatnia_walka_pvc = ".$p1." where gracz = ".$uzytkownik['gracz']);
	
	}
	
	$pozostalo2 = $uzytkownik['ostatnia_walka_pvp'] + 450 - time();
	$p2 = time() - 900;
	
	if($pozostalo2 > 0){
	
	mysql_query("update gracze set ostatnia_walka_pvp = ".$p2." where gracz = ".$uzytkownik['gracz']);
	
	}
	
	}
	
	elseif($uzytkownik['rank'] > 1){
	
	$pozostalo1 = $uzytkownik['ostatnia_walka_pvc'] + 300 - time();
	$p1 = time() - 300;
		
	if($pozostalo1 > 0){
	
	mysql_query("update gracze set ostatnia_walka_pvc = ".$p1." where gracz = ".$uzytkownik['gracz']);
	
	}
	
	$pozostalo2 = $uzytkownik['ostatnia_walka_pvp'] + 450 - time();
	$p2 = time() - 450;
	
	if($pozostalo2 > 0){
	
	mysql_query("update gracze set ostatnia_walka_pvp = ".$p2." where gracz = ".$uzytkownik['gracz']);
	
	}
	
	}
	
?> 
