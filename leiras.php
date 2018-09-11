<?php
error_reporting(0);
include("config.php");
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Súgó</title>
	<link rel="stylesheet" href="css/bootstrap.min.css">
              <link rel="stylesheet" href="css/pagin.css">
              <link rel="stylesheet" href="css/chosen.css">
              <link rel="stylesheet" type="text/css" href="dashboard/vendor/font-awesome/css/font-awesome.min.css">
              <!---LINK\\\--->

              <!---///SCRIPT--->
              <script src="js/bootstrap.min.js"></script>
              <script src="js/jquery-1.11.3.min.js"></script>
</head>
<body>
	<style type="text/css">
		body
		{
			font-size: 2.0em;
		}
	</style>
	<div>

		<h1 class="text-center"><u>Súgó 2018.08.24</u></h1>



<span style="background-color: red">Piros szín</span>=Nincs még
<br>
<span style="background-color: orange">Narancs szín</span>=Kérdéses
<br>
<span style="background-color: green">Zöld szín</span>=Van
<br>
<ul>
<li style="color : orange;">Milyen gyors 40.000 termékkel?</li>
<li style="color : green;">Kereséssel elveszti az éppen beállított sorrendet</li>
<li style="color : green;">Képek+leírás tooltipben legyen  (szerveren most nem is jó egyet se hoz be, vagy nincs egy se?)</li>
<li style="color : green;">Beszerzési árnál és ajánlott árnál ezres helyiértéknél . legyen</li>
<li style="color : green;">A fejléceket lehessen csökkenő/növekvőbe is sorrendbe tenni.</li>
<li style="color : green;">És kellene lehetőség állítani hogy egyszerre hány terméket látok egy oldalon</li>
<li style="color : green;">Lapozónál nincs konkrét lapszámra kattintás lehetőség</li>
<li style="color : green;">Nem lehet márkára szűrni (Az is lenyílóban kellene mint a garancia) + a kategóriát is így lenne jó megoldani</li>
<li style="color : green;">A beszállítóktól azok az adatok kellenek amit az .xls-ben kértem, azok is legyenek a fejlécek
- cikkcsopnev és a cikkfajtat egybe kell gyúrni 
<span style="color: red;">És gondoskodni róla hogy ezt minden beszállítónál meg lehessen tenni (előzetes adatbázis beállító oldal kell)</span>
<li style="color : green;">Ajánlott fogy ár: oszlop is kell + és Ajándék is</li>
<li style="color : green;">Nincs raktáron szűkítés lehetőség!</li>
<li style="color : green;">Cikkszám (második) oszlop nem kell</li>
<li style="color : green;">Kisebb betűméret</li>
<li style="color : green;">Ne legyenek a szövegek levágva, elpontozva</li>
<li style="color : green;">Ne legyen ilyen sormagasság, harmada is elég</li>
<li style="color : green;">Miért van ennyi fejléc?</li>
<li style="color : green;">Megjegyzésnek mi lesz a szerepe?</li>
<li style="color : green;">Kategória kiválasztás csoportosan nem működik (márka igen)</li>
<li style="color : green;">A töröl gombra miért van szükség?</li>
</ul>

		<table>
				<h1>Ár-tól/Ár-ig</h1>
				<tr>
					<input type="text" placeholder="Ár-tól"> 
					<span>Itt meg adhatod a minimum értéket az árnak, hogy melyik a legkisebb érték amit keresel.</span>
					<p>(nem kötelező, megadhatod a maximumot magában)</p>
				</tr>
				<tr>
					<input type="text" placeholder="Ár-ig">
					 <span>Itt meg adhatod a maximum értéket az árnak, hogy melyik a legnagyobb érték amit keresel.</span>
				</tr>
				<hr>
				<h1>Keresés</h1>
				<tr>
					<input type="text" placeholder="Keresés">
					<span>A keresés keres jelenleg:</span>
					<li>Cikkszám</li>
					<li>Cikknév</li>
				</tr>
				<hr>
				<h1>Garancia</h1>
				<tr>
					<select class="chosen-select" tabindex="5" name="garancia">
   <option value="<?php echo $_REQUEST["garancia"]; ?>"><?php echo $_REQUEST["garancia"]; ?></option>
   <option value="">Üres</option>
   <option value="Nem garanciális">Nem garanciális</option>
   <optgroup label="Hónap">
    <option value="2 hónap saját">2 hónap saját</option>
    <option value="3 Hónap">3 Hónap</option>
    <option value="6 hónap saját">6 hónap saját</option>
    <option value="12 hónap saját">12 hónap saját</option>
    <option value="24 hónap saját">24 hónap saját</option>
    <option value="36 hónap saját">36 hónap saját</option>
    <option value="60 hónap saját">60 hónap saját</option>
    <option value="84 hónap saját">84 hónap saját</option>
   </optgroup>
   <optgroup label="Garancialeveles">
    <option value="Garancialeveles 1 év">Garancialeveles 1 év</option>
    <option value="Garancialeveles 2 év">Garancialeveles 2 év</option>
    <option value="Garancialeveles 3 év">Garancialeveles 3 év</option>
    <option value="Garancialeveles 5 év">Garancialeveles 5 év</option>
   </optgroup>
   <optgroup label="Élettartam">
    <option value="Élettartam">Élettartam</option>
    <option value="Élettartam saját">Élettartam saját</option>
   </optgroup>
   <optgroup label="Évek">
    <option value="6 év">6 év</option>
    <option value="10 év">10 év</option>
    <option value="25 év">25 év</option>
    <option value="30 év">30 év</option>
   </optgroup>
  </select>
 <span>Kiválaszhatod a garancia idejét és az alapján listázhatsz.</span>
				<br>
				</tr>
  <select class="chosen-select"  tabindex="5"  value="<?php echo $_REQUEST["marka"]; ?>" name="marka">
   <option value="<?php echo $_REQUEST["marka"]; ?>"><?php echo $_REQUEST["marka"]; ?></option>
   <option value="">Üres</option>
   <?php
   require 'include/db.php';
   while ($row = mysqli_fetch_array($resultd)) 
   {
    echo "<option>". $row['gyarto'] ."</option>";
   }
   ?>       
  </select>
  <span>Kiválaszhatod a márkát és az alapján listázhatsz.</span>
<br>
  <select class="chosen-select" tabindex="5" name="kat">
   <option value="<?php echo $_REQUEST["kat"]; ?>"><?php echo $_REQUEST["kat"]; ?></option>
   <option value="">Üres</option>
   <optgroup label="Főkategória"> 
    <?php
    require 'include/db.php';
    while ($row = mysqli_fetch_array($resultf)) 
    {
     echo "<option>". $row['cikkfajta'] ."</option>";
    }
    ?>
   </optgroup>
   <optgroup label="Alkategória">
    <?php
    require 'include/db.php';
    while ($row = mysqli_fetch_array($resulte)) 
    {
     echo "<option>". $row['cikkcsopnev'] ."</option>";
    }
    ?>
   </optgroup>
  </select>
  <span>Kiválaszhatod a kategóriát és az alapján listázhatsz. Felül vannak a fő kategóriák alul pedig az alkategóriák</span>
				<hr>


				<h1>Gombok</h1>
				<tr><input type="button" class="btn btn-success btn-lg" value="Feltölt"> gombbal tudod feltölteni az adott terméket.</tr>
				<br>
				<tr><input type="button" class="btn btn-warning btn-lg" value="Kihagy"> gombbal tudod kihagyni az adott terméket.</tr>
				<br>
				<tr><input type="button" class="btn btn-danger btn-lg" value="Töröl"> gombbal tudod törölni az adott terméket.</tr>
				<hr>
				<h1>Szelektek</h1>

                       		<div class="side-by-side clearfix">
                             <select class="chosen-select" tabindex="5" id="select1">
                            <option>ÖSSZES KATEGÓRIA</option>
                            <?php
                            require 'include/db.php';
                            while ($row = mysqli_fetch_array($resulta)) 
                            {
                                 echo "<option value=" . $row['nev'] . "> ". $row['nev'] ." </option>";
                            }
                            ?>       
                          </select>
                          Itt tudod kiválasztani az összes termékre vonatkozó kategóriákat.
                      </div>

					<div class="side-by-side clearfix">
                          <select class="chosen-select" tabindex="5" id="select2">
                                <option>ÖSSZES MÁRKA</option>
                            <?php
                            require 'include/db.php';
                            while ($row = mysqli_fetch_array($resultb)) 
                            {
                                 echo "<option value=" . $row['nev'] . ">" . $row['nev'] . "</option>";
                            }
                            ?>        
                          </select>
                          <span>Itt tudod kiválasztani az összes termékre vonatkozó Márkát.</span>
                      </div>
                      <hr>
                <h1>Szerkesztett termékek megtekintése</h1>
				<tr>
					<input type="button" class="btn btn-success btn-lg" value="Feltöltve"> gombbal megtudod megnézni azokat az termékeket amik felvannak töltve.</tr>
				<br>
				<tr>
					<input type="button" class="btn btn-warning btn-lg" value="Kihagyva"> gombbal megtudod megnézni azokat az termékeket amik ki vannak hagyva.</tr>
				<br>
				<tr>
					<input type="button" class="btn btn-danger btn-lg" value="Törölve"> gombbbal megtudod megnézni azokat az termékeket amik törölve lettek.</tr>
				<hr>

				<h1>Sorrendezhetőség</h1>
				<thead>
					<tr>
                        <th><a>Cikkszám</a></th>
                        <th><a>Gyártó</a></th>
                        <th><a>Cikknév</a></th>
                        <th><a>Cikkcsopnev</a></th>
                        <th><a>Cikkfajta</a></th>
                        <th><a>Ár</a></th>
                        <th><a>Garancia</a></th>
                        <th><a>Raktár</a></th>
                    </tr>
                    <span>Itt kiválaszthatod mi alapján szeretnéd megjeleníteni a termékeket(cikkszám,gyártó,cikknév..stb)</span>
				</thead>
				
		
				
		</table>
		<hr>
		<h1>Lapozó</h1>
		<ul class="pagination">
<li><a href="">Első</a></li>
</li>
<li class="<?php if($pageno <= 1){ echo ''; } ?>">
<a href=><?php echo "".($pageno - 1);  ?></a>
</li>

<li class="active">
<a href=""><?php echo $pageno; ?></a>
</li>
<li class="<?php if($pageno >= $total_pages){ echo 'disabled'; } ?>">
<a href=""><?php echo "".($pageno +1);  ?></a>
</li>
<li>
<span>.....</span>
</li>
<li class="<?php if($pageno+5 >= $total_pages){ echo 'disabled'; } ?>">
<a href=""><?php echo "".($pageno +5);  ?></a>
</li>
<li class="<?php if($pageno+10 >= $total_pages){ echo 'disabled'; } ?>">
<a href=""><?php echo "".($pageno +10);  ?></a>
</li>

<li><a href=""<?php echo $total_pages; ?></a></li>
</ul>
	</div>
	<script src="js/jquery-3.2.1.min.js" type="text/javascript"></script>
  <script src="js/chosen.jquery.js" type="text/javascript"></script>
  <script src="js/prism.js" type="text/javascript" charset="utf-8"></script>
  <script src="js/init.js" type="text/javascript" charset="utf-8"></script>
</body>
</html>