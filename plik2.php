<html>
	<head>
	<title>Sprawdzenie poprawności automatu</title>
	<link href="style.css" rel="stylesheet">
	</head>
 <body>

<div class="tytul">Sprawdzenie poprawności automatu</div>
<?php

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
	
	//czy linia kończy się średnikiem///////////////////////////////////////////////////
	
	$znak_końca_lini = strlen($linia[1]);
	//echo $linia[1][$znak_końca_lini-1]."<br/><br/>";
	if($linia[1][$znak_końca_lini-1]!=";"){
		echo '<div class="blad">brak średnika na końcu lini drugiej</div>';
	}
	
	//**********************************************************************************
	
	
	//czy podany został przynajmniej jeden stan początkowy////////////////////////////// 
	
	$stan_poczatkowy=strstr($linia[2], ":");
	//echo $stan_poczatkowy."<br/><br/>";
	switch($stan_poczatkowy){
		case "":
			echo '<div class="blad">brak stanu początkowego</div>';
			break;
		case ":":
			echo '<div class="blad">brak stanu początkowego</div>';
			break;
		case ":;":
			echo '<div class="blad">brak stanu początkowego</div>';
			break;
		default:
			echo '<div class="pop">stan początkowy istnieje</div>';
	}
	
	//czy liczba stanów odpowiada ilości lini stanów
	
	$liczba_lini = (int)count($linia);
	$liczba_lini_stanow = ((int)$liczba_stanów[1]*2);
	$wygenerowana_liczba_lini_stanow=(int)count($linia)-7;
		if($liczba_lini_stanow == $wygenerowana_liczba_lini_stanow){
			echo '<div class="pop">poprawna ilość lini przejść</div>';
		}
		else{
			echo '<div class="blad">nieodpowiednia ilość przejść</div>';
		}
	//sprawdzanie czy wywołana została komenda begin transitions /////////////////////////////////////////////

		if("begin transitions"==$linia[3]){
		   echo '<div class="pop">poprawne wywołąnie begin transitions</div>';
		}
			else{
			
				echo '<div class="blad">błąd - błąd begin transitions</div>';
			}
	
	//czy podany został przynajmniej jeden stan końcowy////////////////////////////// 
	
	$stan_koncowy=strstr($linia[$liczba_lini-3], ":");
	//echo $stan_poczatkowy."<br/><br/>";
	switch($stan_koncowy){
		case "":
			echo '<div class="blad">brak stanu końcowy</div>';
			break;
		case ":":
			echo '<div class="blad">brak stanu końcowy</div>';
			break;
		case ":;":
			echo '<div class="blad">brak stanu końcowy</div>';
			break;
		default:
			echo '<div class="pop">stan końcowy istnieje</div>';
	}
	
	//sprawdzenie czy automat został zakończony poprawnie///////////////////////////////
	
	//echo $linia[$liczba_lini-2];
	if("end automaton" == $linia[$liczba_lini-2]){
		
		echo '<div class="pop">automat zakończony poprawnie</div>';
	}
		else{
			echo '<div class="blad">błąd - automat nie został zakończony poprawną instrukcją</div>';
		}
	
	
?>