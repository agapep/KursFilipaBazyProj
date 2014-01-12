<!DOCTYPE html>
<html xml:lang="pl">
<head>
	<meta http-equiv="Content-type" content="text/html; charset=utf-8" />
	<link rel="stylesheet" href="../style.css" type="text/css" media="screen" />
	<meta name="author" content="Pecyna Krzysztof" />
	<meta name="description" content="Kursy" />
	<title>Kursy - Pecyna Krzyszof :: DOKUMENTACJA</title>

	
</head>
<body>
	<div id="head">
		<h1>KURSY FILIPA</h1>
	</div>
	<H2>Opis Aplikacji</H2>
	<p>Program powstał jako projekt zaliczeniowy na zajęcia z przedmiotu Bazy Danych I. 
	Napisany jest w języku php i służy do pomocy w organizowaniu rekolekcji o nazwie Kurs Filipa. Strona współpracuje z bazą danych postresql i wykorzystuje większość jej możliwości. </p>
	
	<ul class="std">
		<li><b>autor:</b> Krzysztof Pecyna</li>
		<li><b>email:</b> slovic.r@gmail.com</li>
		<li><b>tel:</b> 668 686 231</li>
		<li><b>wersja php:</b> <?php  echo phpversion(); ?></li>
		<li><b>baza danych:</b> postgresql 9.3</li>
		<li><b>data powstania:</b> 2011</li>
		<li><b>data ostatniej aktualizacji:</b> styczeń 2014</li>	
	</ul>
	
	<h3>Używanie aplikacji</h3>
	Aplikacja ma za zadanie pomoc przy organizowaniu rekolekcji o nazwie "kurs filipa". Każdy organizowany kurs posiada trzy daty które będą go definiowały (data początku, końca, i ostateczny termin zbierania zapisów). Każdy kurs będzie posiadał swoją cenę, maksymalną liczbę uczestników oraz dom rekolekcyjny w którym będzie się odbywał. Listą dostępnych domów rekolekcyjnych można swobodnie manipulować. <br/>
	
	Do każdego kursu może być przypisany 0 lub więcej:
	<ul>	
		<li><b>członków ekipy</b> - ludzie organizujący kurs. Każdy będzie wykonywał jakąś funkcje na naszym kursie. Każdy członek ekipy może być przypisany do więcej niż jednej funkcji w kursie. Każdy członek ekipy może być przypisany do więcej niż jednego kursu</li> 
		<li><b>uczestników</b> - ludzie którzy wyjeżdżają na kurs w charakterze uczestników. Każdy uczestnik może być przypisany tylko do jednego kursu. </li> 
	</ul>
	<p>Lista możliwych do wykonania funkcji nie jest zamknięta i zawsze może być rozszerzona. Na każdym kursie kilka członków ekipy może wykonywać jedną funkcję. Może zdarzyć się też przypadek, że nikt nie bedzie wykonywał danej funkcji w konkretnym kursie.</p>
	
	<h3>Opis Tworzenia</h3>
	
	<p>Pisząc tą aplikację chciałem zniwelować jedno z podstawowych ograniczeń jakie niosą ze sobą bazy danych sql - brak elastyczności. Raz napisaną Baze ciężko później zmienić bez mocnej edycji wewnątrz samej aplikacji. Jako, iż żadko w dzisiejszym świecie zdarza się tak jasna specyfikacja danych (zazwyczaj przychodzi czas kiedy trzeba zmienić strukturę) postanowiłem aby aplikacja sama mapowała strukturę tabeli na odpowiednie tabele i formularze. Wymagało to nieco bardziej abstrakcyjnego myślenia i ograniczenie się w pewnych miejscach, ale gra była warta świeczki. Niestety moje zdolności nie pozwoliły mi na stworzenie sprawnie działającej/elastycznej implementacji za pierwszym razem w 2011 roku. Oczywiście projekt działał i spełniał wymagania, ale sam kod był brzydki i posiadał wiele błędów. Pojawiła się też redudancja w kodzie programu.</p>
	
	<p>Obecna implementacja jest architektonicznym kompromisem między tym jak napisałbym tą aplikacje teraz (znając frameworki django i play), a tym co napisałem wcześniej. Udało mi się rozwiązać wszystkie znalezione problemy. Działanie nie uległo większej zmianie, ale kod jest zwięźlejszy i czytelniejszy.</p>   
	
	<h3>Działanie aplikacji</h3>
	<p>Aplikacja działa jako nakładka na bazę danych. Wyświetlanie danych o kursach/uczestnikach/domach rekolekcyjnych oraz formularzy do ich dodawania odbywa się o ich definicje w samej bazie danych. Oznacza to, że jeśli zmienimy listę lub kolejność kolumn w poszczególnych tabelach zostanie to automatycznie uwzględnione w odpowiednich formularzach/widokach. Oznacza to także, że niewielkim nakładem pracy jesteśmy w stanie dostosować tą aplikacje do działania na zupełnie nowej bazie danych.</p> 
	
	<h2>Opis Bazy Danych<h2>
	<h3>Tworzenie Bazy Danych</h3>
	<p>Aby utworzyć bazę danych dla projektu należy wykonać plik z instrukcjami <span style="color:red"><b>./CreateDB/DO.sql</b></span>. zostanie wtedy wywołane rekurencyjnie drzewo plików z rozszerzeniem .sql znajdujące się w katalogu ./CreateDB/*. Znajdują się tam 3 katalogi które wykonają po kolei: </p>
	<ul>
		<li>zniszczenie starych tabel itp.</li>
		<li><span style="color:green"><b>konstrukcję nowych tabel itp.</b></span></li>
		<li><span style="color:blue">dodanie przykładowych danych</span></li>
		<li>wywołanie kilku kontrolnych zapytań</li>
	</ul>
	<p>Najbardziej interesujący jest katalog <span style="color:green"><b>CREATE</b></span> który tworzy domeny, tabele i odpowiednie triggery.
	</p>
	<pre>
	<span style="color:green"><b>├── CREATE</b>
	│   ├── CREATE.sql
	│   ├── CREATE_TABLES.sql
	│   ├── CREATE_TRIGGERS.sql
	│   ├── DOMAIN
	│   │   └── EMAIL.sql
	│   ├── DROP.sql
	│   ├── TABLES
	│   │   ├── DOMY.sql
	│   │   ├── EKIPA.sql
	│   │   ├── FUNKCJE_EKIPA_KURS.sql
	│   │   ├── FUNKCJE.sql
	│   │   ├── KURSY.sql
	│   │   ├── UCZESTNICY.sql
	│   ├── test.sql
	│   └── TRIGGERS
	│       ├── EKIPA.sql
	│       ├── FUNKCJE.sql
	│       ├── KURS.sql
	│       └── UCZESTNICY.sql</span>
	<span style="color:red"><b>├── DO.sql</b></span>
	<span style="color:blue"><b>├── INSERT</b>
	│   ├── DOMY.sql
	│   ├── EKIPA.sql
	│   ├── FUNKCJE.sql
	│   ├── INSERT.sql
	│   ├── KURSY.sql
	│   ├── UCZESTNICY.sql</span>
	└── SELECT
		├── KURSY.sql
		└── SELECT.sql
	
	
	</pre>
	<H3>Diagram ERD</H3>
	<a href="./BazyERD.png" ><img src="./BazyERD.png" width="600px" />  </a>
	
	<h3>Proces testowania aplikacji:</h3>
	Na potrzeby własne napisałem też dokumentacje dot. testowania owej aplikacji. Oto znalezione przeze mnie pola które sprawdzałem. 

	<big><pre>
	<b>Wyświetlanie:</b>
	  - wyświetlanie listy kursów
	  - wyświetlanie listy domów rekolekcyjnych
	  - wyświetlanie listy ludzi z ekipy
	  
	  - wyświetlanie kursu
		- poprawne wyświetlanie ekipy
		- poprawne wyświetlanie członków
	  - wyświetlanie domu
	  - wyświetlanie członka ekipy
		- poprawne wyświetlanie aktualnych kursów
		- minionych kursów

	<b>Dodawanie:</b>
	  - Poprawne dodanie kursu
		- walidacja adresu email
		- Dodanie funkcji/członka ekipy do kursu
		- dodanie uczestnika do kursu (z poziomu widoku kursu)
	  - dodanie uczestnika (z menu głównego)
	  - Poprawne dodanie nowego członka ekipy
	  - Poprawne dodanie nowej funkcji
	  
	<b>Usuwanie:</b>
	  - Usuwanie kursu
		- czy usunięto powiązania z funkcja/ekipa
		- czy usunięto uczestników
	  - Usuwanie domu rekolekcyjnego
		- czy usunięto odbywające się tam kursy
		- czy usunięto dane dot. tych kursów
	  - Usuwanie ekipy
		- czy usunięto funkcje w kursach w których brał udział
	  - Usuwanie funkcji
		- czy zniknęły informacje o nich w kursach
		- czy zniknęły info u osób pełniących te funkcje
	  - usuwanie uczestników
	  - odłączenie funkcji/ekipy od kursu  

	<b>Edycja:</b>
	  - edycja kursu
	  - edycja ekipy
	  - edycja uczestnika
	  - edycja funkcji
	  - edycja domu rekolekcyjnego

	</pre></big>
	<small style="font-size: xx-small">	  
	*Testowałem wszystkie te przypadki jakiś czas temu na swojej maszynie. Z uwagi na dużą czasochłonność nie miałem możliwości przeprowadzić tego procesu w całości na fatcacie.</small>
	<div id="foot">
		<p><a href="mailto:slovic@dsv.agh.edu.pl">Copyright @ Pecyna Krzysztof</a> :: <a href="..">Strona</a></p>
	</div>
	<div id='temp'></div>
</body>
</html>
