<html>
	<head>
	<title>Sprawdzenie poprawności automatu</title>
	<link href="style.css" rel="stylesheet">
	</head>
 <body>

<div class="tytul">Sprawdzenie poprawności automatu</div>
<?php

//wczytanie pliku tekstowego

$plik_tmp = $_FILES['plik']['tmp_name']; 
$plik_nazwa = $_FILES['plik']['name']; 
 move_uploaded_file($plik_tmp, "pliki/$plik_nazwa");
 $fp = fopen("pliki/{$plik_nazwa}", "r");
 $i=0;
while(!feof($fp))
{
   $linia[$i] = trim(fgets($fp));
   $i++;
}

// usowanie pustych linni z tablicy
$count = count($linia);
 
for($i=0; $i< $count; $i++)
{
 if($linia[$i] == '' or empty($linia[$i]))
 {
  unset($linia[$i]);
 }
}
//sprawdzanie czy automat został zainicjowany/////////////////////////////////////////////

if("begin automaton"==$linia[0]){
   echo '<div class="pop">poprawna inicjacja automatu</div>';
}
	else{
	
		echo '<div class="blad">błąd - automat nie został zainicjowany</div>';
	}
	//linia 2 ilość stanów i czy linia kończy się średnikiem****************************
	
	//sprawdzenie czy jest poprawna ilość stanów////////////////////////////////////////
	
	$liczba_stanów = explode(":",$linia[1]);
	//echo (int)$liczba_stanów[1]."<br/><br/>";
	
	if((int)$liczba_stanów[1]>=2){
			
			echo '<div class="pop">Ilość stanów poprawna(większa lub równa 2)<br/> zadeklarowana liczba stanów = '.(int)$liczba_stanów[1].'</div>';
	}
	else{
		echo '<div class="blad">Nieodpowiednia ilość stanów <br/> zadeklarowana liczba stanów = '.(int)$liczba_stanów[1].'</div>';
	}
	
	
	//**********************************************************************************
	
	
	//czy podany został przynajmniej jeden stan początkowy////////////////////////////// 
	
	$stan_poczatkowy=strstr($linia[2], ":");
	$stan_poczatkowy = str_replace(':','',$stan_poczatkowy);
	
		
		$zmiennaPomocnicza = true;
		$iteracja = 0;
		
		
		while($zmiennaPomocnicza != false){
			
			$stanOk = false;
			
			if (@$stan_poczatkowy[$iteracja] == 'a'){
				$stanOk = true;
			}else {
				$stanOk = false;
				$zmiennaPomocnicza = false;
			}
			
			
			
			if (is_numeric(@$stan_poczatkowy[$iteracja+1])){
				$stanOk = true;
			}else {
				$stanOk = false;
				$zmiennaPomocnicza = false;
			}
			
			
			if ((@$stan_poczatkowy[$iteracja+2] == ',')||(@$stan_poczatkowy[$iteracja+2] == ';')){
				$stanOk = true;
			if (@$stan_poczatkowy[$iteracja+2] == ';'){
				
				$zmiennaPomocnicza = false;
			}}else {
				$stanOk = false;
				$zmiennaPomocnicza = false;
			}
			
			
			
			
		$iteracja+=3;
		
		}
		if($stanOk == true){
			echo "<div class='pop'>Stany wejściowe ok</div>";
		}else echo "<div class='blad'>błąd stanów wejściowych</div>";
		
		
	
	//czy liczba stanów odpowiada ilości lini stanów
	
	$liczba_lini = (int)count($linia);
	$liczba_lini_stanow = ((int)$liczba_stanów[1]*2);
	$wygenerowana_liczba_lini_stanow=(int)count($linia)-6;
		if($liczba_lini_stanow == $wygenerowana_liczba_lini_stanow){
			echo '<div class="pop">poprawna ilość lini</div>';
		}
		else{
			echo '<div class="blad">nieodpowiednia ilość linni</div>';
		}
	//sprawdzanie czy wywołana została komenda begin transitions /////////////////////////////////////////////

		if("begin transitions"==$linia[3]){
		   echo '<div class="pop">poprawne wywołąnie begin transitions</div>';
		}
			else{
			
				echo '<div class="blad">błąd - błąd begin transitions</div>';
			}
	
	// sprawdzaanie wygenerowanych stanów przejść automatu
	
	for($i = 4 ; $i <$liczba_lini_stanow +5; $i++){
		$stany_wygenerowane=strstr($linia[$i], ":");
	
	$stany_wygenerowane = str_replace(':','',$stany_wygenerowane);
	
		
		$zmiennaPomocnicza = true;
		$iteracja = 0;
		if($stany_wygenerowane == ";"){
			$stanOk = true;
		}
		else{
		while($zmiennaPomocnicza != false){
			
			$stanOk = false;
			
			if (@$stany_wygenerowane[$iteracja] == 'a'){
				$stanOk = true;
			}else {
				$stanOk = false;
				$zmiennaPomocnicza = false;
			}
			
			
			
			if (is_numeric(@$stany_wygenerowane[$iteracja+1])){
				$stanOk = true;
			}else {
				$stanOk = false;
				$zmiennaPomocnicza = false;
			}
			
			
			if ((@$stany_wygenerowane[$iteracja+2] == ',')||(@$stany_wygenerowane[$iteracja+2] == ';')){
				$stanOk = true;
			if (@$stany_wygenerowane[$iteracja+2] == ';'){
				
				$zmiennaPomocnicza = false;
			}}else {
				$stanOk = false;
				$zmiennaPomocnicza = false;
			}
			
			
			
			
		$iteracja+=3;
		
		}
		}
		if($stanOk != true){
			break;
		}
		
	}
			if($stanOk == true){
			echo "<div class='pop'>Transition ok</div>";
		}else echo "<div class='blad'>błąd transition</div>";



	
	
	//czy podany został przynajmniej jeden stan końcowy////////////////////////////// 
	
	$stan_koncowy=strstr($linia[$liczba_lini-2], ":");
	
	$stan_koncowy = str_replace(':','',$stan_koncowy);
		
		
		$zmiennaPomocnicza = true;
		$iteracja = 0;
		
		
		while($zmiennaPomocnicza != false){
			
			$stanOk = false;
			
			if (@$stan_koncowy[$iteracja] == 'a'){
				$stanOk = true;
			}else {
				$stanOk = false;
				$zmiennaPomocnicza = false;
			}
			
			
		
			if (is_numeric(@$stan_koncowy[$iteracja+1])){
				$stanOk = true;
			}else {
				$stanOk = false;
				$zmiennaPomocnicza = false;
			}
			
			
			if ((@$stan_koncowy[$iteracja+2] == ',')||(@$stan_koncowy[$iteracja+2] == ';')){
				$stanOk = true;
			if (@$stan_koncowy[$iteracja+2] == ';'){
				
				$zmiennaPomocnicza = false;
			}}else {
				$stanOk = false;
				$zmiennaPomocnicza = false;
			}
			
		$iteracja+=3;
		
		}
		if($stanOk == true){
			echo "<div class='pop'>Stany wyjściowe ok</div>";
		}else echo "<div class='blad'>błąd stanów wyjściowych</div>";
		
	//sprawdzenie czy automat został zakończony poprawnie///////////////////////////////
	
	//echo $linia[$liczba_lini-2];
	if("end automaton" == $linia[$liczba_lini-1]){
		
		echo '<div class="pop">automat zakończony poprawnie</div>';
	}
		else{
			echo '<div class="blad">błąd - automat nie został zakończony poprawną instrukcją</div>';
		}
	


	










	
?>