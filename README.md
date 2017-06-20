
Języki, automaty, gramatyki i kompilatory
Program ma za zadanie sprawdzić poprawność pliku txt wygenerowanego przez automat.

Krok1.

przesłanie pliku na server

Krok2.

	-Wczytany plik zostaje zapisany do tablicy z podziałem na wiersze

Krok3.

	-Zostają usunięte puste wiersze z pliku aby ułatwić poruszanie się po tablicy oraz ograniczyć liczbę błędów

Krok4.

	Sprawdzony zostaje pierwszy wiersz – czy zawiera komendę begin automaton

Krok5   

	-Pobrana z pliku zostaje wartość odpowiadająca liczbie stanów i jeżeli jest większa lub równa 2 wyświetlony zostaje komunikat że liczba stanów jest poprawna.

Krok6.

	-Sprawdzana zostaję zawartość wiersza odpowiadającego stanom wejściowym – sprawdzane zostaję czy istnieje chociaż jeden stan oraz czy jego struktura pasuję do szablonu

Krok7.

	-Sprawdzane zostaję czy ilość linni w pliku zgadza się z tym ile stanów zostało wygenerowanych.

Krok8.

	-Sprawdzony zostaje czy  wiersz zawiera komende begin transitions 

Krok9.

	Niemal identyczny kod co przy sprawdzaniu stanów początkowych z tym wyjątkiem że istniej możliwość że dany stan może nie zostać zadeklarowany. Czynność zostaje powtórzona dla każdej linni odpowiadającej begin transitions 

Krok10.
		Krok6.

Krok11,

		-Sprawdzony zostaje czy  wiersz zawiera komende  end automaton 
Kod Programu
