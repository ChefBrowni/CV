<?php
error_reporting(0);
include("config.php");
?>
<?php
if (isset($_GET["order"]))
{
$order=$_GET["order"];
}
else
{
$order="cikknev";
}  
if (isset($_GET["sort"]))
{
$sort=$_GET["sort"];
}
else
{
$sort='ASC';
}
 if (isset($_GET['pageno'])) 
 {
  $pageno = $_GET['pageno'];
 } 
 else 
 {
  $pageno = 1;
 }

 if ($_REQUEST["darab"]<>'') 
 {
  $no_of_records_per_page = mysql_real_escape_string($_REQUEST["darab"]);
 }
 else
 {
  $no_of_records_per_page = 100;
 }
 $offset = ($pageno-1) * $no_of_records_per_page;
 $lap = " LIMIT $offset, $no_of_records_per_page";
 
 if ($_REQUEST['order']<>'' and $_REQUEST['sort']<>'') 
 {
  $orderby = "ORDER BY $order $sort";
 }
 if ($_REQUEST["string"]<>'') 
 {
  $search_string = " AND (cikkszam LIKE '%".mysql_real_escape_string($_REQUEST["string"])."%' OR cikknev LIKE '%".mysql_real_escape_string($_REQUEST["string"])."%')"; 
 }
 if ($_REQUEST["garancia"]<>'') 
 {
  $search_garancia = " AND garancia='".mysql_real_escape_string($_REQUEST["garancia"])."'"; 
 }
 if ($_REQUEST["marka"]<>'') 
 {
  $search_marka = " AND gyarto='".mysql_real_escape_string($_REQUEST["marka"])."'"; 
 }
 if ($_REQUEST["kat"]<>'') 
 {
  $search_kat = " AND (cikkcsopnev='".mysql_real_escape_string($_REQUEST["kat"])."' 
  OR cikkfajta='".mysql_real_escape_string($_REQUEST["kat"])."')"; 
 }
 if ($_REQUEST["keszlet"]<>'') 
 {
  $search_rak = " AND keszlet>='1'"; 
 }
 if ($_REQUEST["from"]<>'' and $_REQUEST["to"]<>'')
 {
  $sql ="SELECT * FROM ".$SETTINGS["data_table"]." WHERE statusz='1' AND ar >= '".mysql_real_escape_string($_REQUEST["from"])."' AND ar <= '".mysql_real_escape_string($_REQUEST["to"])."'".$search_rak.$search_garancia.$search_kat.$search_marka.$search_string.$orderby.$lap;
 } 
 else if ($_REQUEST["from"]<>'') 
 {
  $sql = "SELECT * FROM ".$SETTINGS["data_table"]." WHERE statusz='1' AND ar >= '".mysql_real_escape_string($_REQUEST["from"])."'".$search_rak.$search_garancia.$search_kat.$search_marka.$search_string.$orderby.$lap;
 } 
 else if ($_REQUEST["to"]<>'') 
 {
  $sql = "SELECT * FROM ".$SETTINGS["data_table"]." WHERE statusz='1' AND  ar <= '".mysql_real_escape_string($_REQUEST["to"])."'".$search_rak.$search_garancia.$search_kat.$search_marka.$search_string.$orderby.$lap;
 } 
 else if ($_REQUEST["marka"]<>'') 
 {
  $sql = "SELECT * FROM ".$SETTINGS["data_table"]." WHERE statusz='1' AND gyarto='".mysql_real_escape_string($_REQUEST["marka"])."'".$search_rak.$search_garancia.$search_kat.$search_marka.$search_string.$orderby.$lap;
 } 
 else if ($_REQUEST["garancia"]<>'') 
 {
  $sql = "SELECT * FROM ".$SETTINGS["data_table"]." WHERE statusz='1' AND garancia='".mysql_real_escape_string($_REQUEST["garancia"])."'".$search_rak.$search_garancia.$search_kat.$search_marka.$search_string.$orderby.$lap;
 } 
  else if ($_REQUEST["string"]<>'') 
 {
  $sql = "SELECT * FROM ".$SETTINGS["data_table"]." WHERE statusz='1' AND (cikkszam LIKE '%".mysql_real_escape_string($_REQUEST["string"])."%' OR cikknev LIKE '%".mysql_real_escape_string($_REQUEST["string"])."%')".$search_rak.$search_garancia.$search_kat.$search_marka.$search_string.$orderby.$lap;
 } 
 else if ($_REQUEST["marka"]<>'' and $_REQUEST["kat"]<>'') 
 {
  $sql = "SELECT * FROM ".$SETTINGS["data_table"]." WHERE statusz='1' AND gyarto='".mysql_real_escape_string($_REQUEST["marka"])."' AND (cikkcsopnev='".mysql_real_escape_string($_REQUEST["kat"])."' OR cikkfajta='".mysql_real_escape_string($_REQUEST["kat"])."')".$search_rak.$search_garancia.$search_kat.$search_marka.$search_string.$orderby.$lap;
 } 
 else if ($_REQUEST["marka"]<>'' and $_REQUEST["kat"]<>'' and $_REQUEST["garancia"]<>'') 
 {
  $sql = "SELECT * FROM ".$SETTINGS["data_table"]." WHERE statusz='1' AND gyarto='".mysql_real_escape_string($_REQUEST["marka"])."' AND (cikkcsopnev='".mysql_real_escape_string($_REQUEST["kat"])."' OR cikkfajta='".mysql_real_escape_string($_REQUEST["kat"])."' AND garancia='".mysql_real_escape_string($_REQUEST["garancia"])."')".$search_rak.$search_garancia.$search_kat.$search_marka.$search_string.$orderby.$lap;
 } 
 else if ($_REQUEST["marka"]<>'' and $_REQUEST["kat"]<>'' and $_REQUEST["garancia"]<>'' and $_REQUEST["keszlet"]<>'') 
 {
  $sql = "SELECT * FROM ".$SETTINGS["data_table"]." WHERE statusz='1' AND gyarto='".mysql_real_escape_string($_REQUEST["marka"])."' AND (cikkcsopnev='".mysql_real_escape_string($_REQUEST["kat"])."' OR cikkfajta='".mysql_real_escape_string($_REQUEST["kat"])."' AND garancia='".mysql_real_escape_string($_REQUEST["garancia"])."' AND keszlet>='1')".$search_rak.$search_garancia.$search_kat.$search_marka.$search_string.$orderby.$lap;
 } 
 else 
 {
  $sql = "SELECT * FROM ".$SETTINGS["data_table"]." WHERE statusz='1'".$search_rak.$search_garancia.$search_kat.$search_marka.$search_string.$orderby.$lap;
 }
//<!------------------------------------------------------------------------------------ SQL----------------------------------------------------------------------------------------------------->

//<!----------------------------------------------------------------------------------LAPOZÓS------------------------------------------------------------------------------------------------------------>
  if ($_REQUEST["from"]<>'' and $_REQUEST["to"]<>'')
 {
  $total_pages = "SELECT count(*)  FROM ".$SETTINGS["data_table"]." WHERE statusz='1' AND ar >= '".mysql_real_escape_string($_REQUEST["from"])."' AND ar <= '".mysql_real_escape_string($_REQUEST["to"])."'";
 } 
 if ($_REQUEST["from"]<>'' and $_REQUEST["to"]<>'' and $_REQUEST["marka"]<>'')
 {
  $total_pages = "SELECT count(*)  FROM ".$SETTINGS["data_table"]." WHERE statusz='1' AND ar >= '".mysql_real_escape_string($_REQUEST["from"])."' AND ar <= '".mysql_real_escape_string($_REQUEST["to"])."' AND gyarto='".mysql_real_escape_string($_REQUEST["marka"])."'";
 }
 if ($_REQUEST["from"]<>'' and $_REQUEST["to"]<>'' and $_REQUEST["kat"]<>'')
 {
  $total_pages = "SELECT count(*)  FROM ".$SETTINGS["data_table"]." WHERE statusz='1' AND ar >= '".mysql_real_escape_string($_REQUEST["from"])."' AND ar <= '".mysql_real_escape_string($_REQUEST["to"])."' AND (cikkcsopnev='".mysql_real_escape_string($_REQUEST["kat"])."' OR cikkfajta='".mysql_real_escape_string($_REQUEST["kat"])."')";
 }
  if ($_REQUEST["from"]<>'' and $_REQUEST["to"]<>'' and $_REQUEST["marka"]<>'' and $_REQUEST["garancia"]<>'')
 {
  $total_pages = "SELECT count(*)  FROM ".$SETTINGS["data_table"]." WHERE statusz='1' AND ar >= '".mysql_real_escape_string($_REQUEST["from"])."' AND ar <= '".mysql_real_escape_string($_REQUEST["to"])."' AND gyarto='".mysql_real_escape_string($_REQUEST["marka"])."' AND garancia='".mysql_real_escape_string($_REQUEST["garancia"])."'";
 }
  if ($_REQUEST["from"]<>'' and $_REQUEST["to"]<>'' and $_REQUEST["marka"]<>'' and $_REQUEST["kat"]<>'')
 {
  $total_pages = "SELECT count(*)  FROM ".$SETTINGS["data_table"]." WHERE statusz='1' AND ar >= '".mysql_real_escape_string($_REQUEST["from"])."' AND ar <= '".mysql_real_escape_string($_REQUEST["to"])."' AND gyarto='".mysql_real_escape_string($_REQUEST["marka"])."' AND (cikkcsopnev='".mysql_real_escape_string($_REQUEST["kat"])."' OR cikkfajta='".mysql_real_escape_string($_REQUEST["kat"])."')";
 } 
if ($_REQUEST["from"]<>'' and $_REQUEST["to"]<>'' and $_REQUEST["garancia"]<>'')
 {
  $total_pages = "SELECT count(*)  FROM ".$SETTINGS["data_table"]." WHERE statusz='1' AND ar >= '".mysql_real_escape_string($_REQUEST["from"])."' AND ar <= '".mysql_real_escape_string($_REQUEST["to"])."' AND garancia='".mysql_real_escape_string($_REQUEST["garancia"])."'";
 }
 if ($_REQUEST["from"]<>'' and $_REQUEST["to"]<>''  and $_REQUEST["string"]<>''  and $_REQUEST["marka"]<>'')
 {
  $total_pages = "SELECT count(*)  FROM ".$SETTINGS["data_table"]." WHERE statusz='1' AND ar >= '".mysql_real_escape_string($_REQUEST["from"])."' AND ar <= '".mysql_real_escape_string($_REQUEST["to"])."' AND (cikkszam LIKE '%".mysql_real_escape_string($_REQUEST["string"])."%' OR cikknev LIKE '%".mysql_real_escape_string($_REQUEST["string"])."%') AND gyarto='".mysql_real_escape_string($_REQUEST["marka"])."'";
 } 
 if ($_REQUEST["from"]<>'' and $_REQUEST["to"]<>'' and $_REQUEST["string"]<>'' and $_REQUEST["garancia"]<>'')
 {
  $total_pages = "SELECT count(*)  FROM ".$SETTINGS["data_table"]." WHERE statusz='1' AND ar >= '".mysql_real_escape_string($_REQUEST["from"])."' AND ar <= '".mysql_real_escape_string($_REQUEST["to"])."' AND (cikkszam LIKE '%".mysql_real_escape_string($_REQUEST["string"])."%' OR cikknev LIKE '%".mysql_real_escape_string($_REQUEST["string"])."%') AND garancia='".mysql_real_escape_string($_REQUEST["garancia"])."'";
 }
if ($_REQUEST["marka"]<>'' and $_REQUEST["kat"]<>'' and $_REQUEST["garancia"]<>'' and $_REQUEST["keszlet"]<>'' ) 
 {
  $total_pages = "SELECT count(*) FROM ".$SETTINGS["data_table"]." WHERE statusz='1' AND gyarto='".mysql_real_escape_string($_REQUEST["marka"])."'AND (cikkcsopnev='".mysql_real_escape_string($_REQUEST["kat"])."' OR cikkfajta='".mysql_real_escape_string($_REQUEST["kat"])."') AND garancia='".mysql_real_escape_string($_REQUEST["garancia"])."' AND keszlet>='1'";
 }
else if ($_REQUEST["marka"]<>'' and $_REQUEST["kat"]<>'' and $_REQUEST["garancia"]<>'') 
 {
  $total_pages = "SELECT count(*) FROM ".$SETTINGS["data_table"]." WHERE statusz='1' AND gyarto='".mysql_real_escape_string($_REQUEST["marka"])."'AND (cikkcsopnev='".mysql_real_escape_string($_REQUEST["kat"])."' OR cikkfajta='".mysql_real_escape_string($_REQUEST["kat"])."') AND garancia='".mysql_real_escape_string($_REQUEST["garancia"])."'";
 }
else if ($_REQUEST["marka"]<>'' and $_REQUEST["kat"]<>'') 
 {
  $total_pages = "SELECT count(*) FROM ".$SETTINGS["data_table"]." WHERE statusz='1' AND gyarto='".mysql_real_escape_string($_REQUEST["marka"])."'AND (cikkcsopnev='".mysql_real_escape_string($_REQUEST["kat"])."' OR cikkfajta='".mysql_real_escape_string($_REQUEST["kat"])."')";
 }
else if ($_REQUEST["marka"]<>'' and $_REQUEST["garancia"]<>'') 
 {
  $total_pages = "SELECT count(*) FROM ".$SETTINGS["data_table"]." WHERE statusz='1' AND gyarto='".mysql_real_escape_string($_REQUEST["marka"])."' AND garancia='".mysql_real_escape_string($_REQUEST["garancia"])."'";
 }
  else if ($_REQUEST["marka"]<>'' and $_REQUEST["keszlet"]<>'') 
 {
  $total_pages = "SELECT count(*) FROM ".$SETTINGS["data_table"]." WHERE statusz='1' AND gyarto='".mysql_real_escape_string($_REQUEST["marka"])."' AND keszlet>='1'";
 }
 else if ($_REQUEST["from"]<>'' and $_REQUEST["to"]<>'' and $_REQUEST["string"]<>'' and $_REQUEST["garancia"]<>'' and $_REQUEST["keszlet"]<>'')
 {
  $total_pages = "SELECT count(*)  FROM ".$SETTINGS["data_table"]." WHERE statusz='1' AND ar >= '".mysql_real_escape_string($_REQUEST["from"])."' AND ar <= '".mysql_real_escape_string($_REQUEST["to"])."' AND (cikkszam LIKE '%".mysql_real_escape_string($_REQUEST["string"])."%' OR cikknev LIKE '%".mysql_real_escape_string($_REQUEST["string"])."%') AND garancia='".mysql_real_escape_string($_REQUEST["garancia"])."'  AND keszlet>='1'";
 }
 else if ($_REQUEST["from"]<>'' and $_REQUEST["to"]<>'' and $_REQUEST["string"]<>'')
 {
  $total_pages = "SELECT count(*)  FROM ".$SETTINGS["data_table"]." WHERE statusz='1' AND ar >= '".mysql_real_escape_string($_REQUEST["from"])."' AND ar <= '".mysql_real_escape_string($_REQUEST["to"])."' AND (cikkszam LIKE '%".mysql_real_escape_string($_REQUEST["string"])."%' OR cikknev LIKE '%".mysql_real_escape_string($_REQUEST["string"])."%')";
 }
  else if ($_REQUEST["from"]<>'' and $_REQUEST["to"]<>'' and $_REQUEST["garancia"]<>'')
 {
  $total_pages = "SELECT count(*)  FROM ".$SETTINGS["data_table"]." WHERE statusz='1' AND ar >= '".mysql_real_escape_string($_REQUEST["from"])."' AND ar <= '".mysql_real_escape_string($_REQUEST["to"])."' AND garancia='".mysql_real_escape_string($_REQUEST["garancia"])."'";
 }
 else if ($_REQUEST["from"]<>'' and $_REQUEST["to"]<>'' and $_REQUEST["marka"]<>'' and $_REQUEST["keszlet"]<>'')
 {
  $total_pages = "SELECT count(*)  FROM ".$SETTINGS["data_table"]." WHERE statusz='1' AND ar >= '".mysql_real_escape_string($_REQUEST["from"])."' AND ar <= '".mysql_real_escape_string($_REQUEST["to"])."' AND gyarto='".mysql_real_escape_string($_REQUEST["marka"])."' AND ar <= '".mysql_real_escape_string($_REQUEST["to"])."' AND keszlet>='1'";
 }
 else if ($_REQUEST["from"]<>'' and $_REQUEST["to"]<>'' and $_REQUEST["string"]<>'' and $_REQUEST["keszlet"]<>'')
 {
  $total_pages = "SELECT count(*)  FROM ".$SETTINGS["data_table"]." WHERE statusz='1' AND ar >= '".mysql_real_escape_string($_REQUEST["from"])."' AND ar <= '".mysql_real_escape_string($_REQUEST["to"])."' AND (cikkszam LIKE '%".mysql_real_escape_string($_REQUEST["string"])."%' OR cikknev LIKE '%".mysql_real_escape_string($_REQUEST["string"])."%') AND keszlet>='1'";
 }
 else if ($_REQUEST["from"]<>'' and $_REQUEST["to"]<>'' and $_REQUEST["string"]<>'' and $_REQUEST["kat"]<>'')
 {
  $total_pages = "SELECT count(*)  FROM ".$SETTINGS["data_table"]." WHERE statusz='1' AND ar >= '".mysql_real_escape_string($_REQUEST["from"])."' AND ar <= '".mysql_real_escape_string($_REQUEST["to"])."' AND (cikkszam LIKE '%".mysql_real_escape_string($_REQUEST["string"])."%' OR cikknev LIKE '%".mysql_real_escape_string($_REQUEST["string"])."%') AND cikkcsopnev='".mysql_real_escape_string($_REQUEST["kat"])."' OR cikkfajta='".mysql_real_escape_string($_REQUEST["kat"])."'";
 } 
 else if ($_REQUEST["from"]<>'' and $_REQUEST["to"]<>'' and $_REQUEST["marka"]<>'' and $_REQUEST["string"]<>'')
 {
  $total_pages = "SELECT count(*)  FROM ".$SETTINGS["data_table"]." WHERE statusz='1' AND ar >= '".mysql_real_escape_string($_REQUEST["from"])."' AND ar <= '".mysql_real_escape_string($_REQUEST["to"])."' AND gyarto='".mysql_real_escape_string($_REQUEST["marka"])."'AND (cikkszam LIKE '%".mysql_real_escape_string($_REQUEST["string"])."%' OR cikknev LIKE '%".mysql_real_escape_string($_REQUEST["string"])."%')";
 }
  else if ($_REQUEST["from"]<>'' and $_REQUEST["to"]<>'' and $_REQUEST["keszlet"]<>'')
 {
  $total_pages = "SELECT count(*)  FROM ".$SETTINGS["data_table"]." WHERE statusz='1' AND ar >= '".mysql_real_escape_string($_REQUEST["from"])."' AND ar <= '".mysql_real_escape_string($_REQUEST["to"])."' AND keszlet>='1'";
 }
else if ($_REQUEST["garancia"]<>'') 
 {
  $total_pages = "SELECT count(*) FROM ".$SETTINGS["data_table"]." WHERE statusz='1' AND garancia='".mysql_real_escape_string($_REQUEST["garancia"])."'";
 } 
 else if ($_REQUEST["marka"]<>'')  
 {
  $total_pages = "SELECT count(*) FROM ".$SETTINGS["data_table"]." WHERE statusz='1' AND gyarto='".mysql_real_escape_string($_REQUEST["marka"])."'";
 } 
 else if ($_REQUEST["kat"]<>'')  
 {
  $total_pages = "SELECT count(*) FROM ".$SETTINGS["data_table"]." WHERE statusz='1' AND (cikkcsopnev='".mysql_real_escape_string($_REQUEST["kat"])."' OR cikkfajta='".mysql_real_escape_string($_REQUEST["kat"])."')";
 }
 else if ($_REQUEST["to"]<>'')
 {
  $total_pages = "SELECT count(*)  FROM ".$SETTINGS["data_table"]." WHERE statusz='1' AND  ar <= '".mysql_real_escape_string($_REQUEST["to"])."'";
 } 
else if ($_REQUEST["string"]<>'')
 {
  $total_pages = "SELECT count(*)  FROM ".$SETTINGS["data_table"]." WHERE statusz='1' AND (cikkszam LIKE '%".mysql_real_escape_string($_REQUEST["string"])."%' OR cikknev LIKE '%".mysql_real_escape_string($_REQUEST["string"])."%')";
 } 
else if ($_REQUEST["keszlet"]<>'')
 {
  $total_pages = "SELECT count(*)  FROM ".$SETTINGS["data_table"]." WHERE statusz='1' AND keszlet>='1'";
 } 
 else
 {
  $total_pages = "SELECT count(*) FROM ".$SETTINGS["data_table"]." WHERE statusz='1' ";
 }
 $result = mysqli_query($conn,$total_pages);
 $total_rows = mysqli_fetch_array($result)[0];
 $total_pages = ceil($total_rows / $no_of_records_per_page);

?>
<!DOCTYPE html>
<html>
<head>
<title>Digitalko kihagyott termékek</title>
<meta charset="utf-8">

<!------------------------------------------------------------------------------------------------LINK-------------------------------------------------------------------------------->  
<link rel="stylesheet" href="css/bootstrap.min.css">
<link rel="stylesheet" href="css/pagin.css">
<link rel="stylesheet" href="css/chosen.css">
<link rel="stylesheet" type="text/css" href="dashboard/vendor/font-awesome/css/font-awesome.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<!------------------------------------------------------------------------------------------------LINK-------------------------------------------------------------------------------->  


<!------------------------------------------------------------------------------------------------SCRIPT-------------------------------------------------------------------------------->  
<script src="js/bootstrap.min.js"></script>
<script src="js/jquery-1.11.3.min.js"></script>
<script type="text/javascript">
$(document).ready(function(){
$('#checkBoxAll').click(function(){
 if ($(this).is(":checked"))
  $('.chkCheckBoxId').prop('checked', true);
 else
  $('.chkCheckBoxId').prop('checked', false);
});
});
</script>
<!------------------------------------------------------------------------------------------------SCRIPT-------------------------------------------------------------------------------->           
</head> 
<body>

<!------------------------------------------------------------------------------------------------ADATBÁZIS------------------------------------------------------------------------------> 
<form method="POST">
<input type="submit" class="btn btn-primary" name="vissza" value="Vissza a fő oldalra">
<input type="button" class='btn btn-success' value="Feltöltve" id="gomb" onclick="window.location.href='inventoryup.php'" />
<input type="button" class='btn btn-danger' value="Törölve" id="gomb" onclick="window.location.href='inventorydel.php'" />
  <?php  
  if (isset($_POST["vissza"])) 
  {
    header('location:inventory.php');
  }
  ?>
   </form>
<h5 class="text-center"><a href="inventorydown.php">Oldal újratöltés</a></h5>

<!---Felsőtábla\\\--->
<div>
<table id="felso" class="form-group">
<!------------------------------------------------------------------------------------------------Szűkités------------------------------------------------------------------------------->          
<form method="GET" action="">
 <td>
  <input name="from" type="text" id="input" class="form-control" value="<?php echo $_REQUEST["from"]; ?>" placeholder="Ár-tól">
 </td>
 <td>
  <input name="to"   type="text" id="input" class="form-control"  value="<?php echo $_REQUEST["to"]; ?>" placeholder="Ár-ig"/>
 </td>
 <td>
  <input type="text" name="string" id="input" class="form-control"  value="<?php echo stripcslashes($_REQUEST["string"]); ?>" placeholder="Keresés" />
 </td>
 <td>
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
 </td>
 <td>
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
 </td>
 <td>
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
 </td>
 <td>
  <input type="checkbox" name="keszlet" class="form-control">Raktáron
 </td>
 <td>
  <input type="submit" name="button" id="gomb" class="btn btn-info btn-lg" id="button" value="Szűrés">
 </td>
  <td>
  <input type="text" name="darab" value="<?php echo $_REQUEST["darab"]; ?>" placeholder="<?php echo $_REQUEST["darab"]; ?>" class="form-control" id="input">
 </td>
 <td>
  <input type="submit" name="darabbtn" value="Oldal" class="btn btn-primary" id="gomb">
 </td>
 <td id="nem"><input type="text" name="order" value="<?php echo $_REQUEST["order"]?>" placeholder="<?php echo $_REQUEST["order"]?>"></td>
 <td id="nem"><input type="text" name="sort" value="<?php echo $_REQUEST["sort"]?>"  placeholder="<?php echo $_REQUEST["sort"]?>"></td>
</form>
<!------------------------------------------------------------------------------------------------Szűkités------------------------------------------------------------------------------->   

<!------------------------------------------------------------------------------------------------ACTIONGOMBOK------------------------------------------------------------------------------->   
<form action="" method="POST" class="form-group">
 <td>
  <input type='submit' class='btn btn-success btn-lg' id="gomb" name="feltolt" value="Feltölt">
 </td>
 <td>
  <input type='submit' class='btn btn-secondary btn-lg' id="gomb" name="kihagy" value="Kihagy">
 </td>
 <td>
  <input type='submit' class='btn btn-danger btn-lg' id="gomb" name="torol" value="Töröl">
 </td> 

 <!------------------------------------------------------------------------------------------------ACTIONGOMBOK-------------------------------------------------------------------------------> 
</table>
</div>

<!------------------------------------------------------------------------------------------------KATEGÓRIA SZELEKT-------------------------------------------------------------------------------> 

<div id="osszes">
<select class="chosen-select" tabindex="5" id="select1">
 <option>ÖSSZES KATEGÓRIA</option>
 <?php
 require 'include/db.php';
 while ($row = mysqli_fetch_array($resulta)) 
 {
  echo "<option>". $row['nev'] ."</option>";
 }
 ?>       
</select>
<select class="chosen-select" tabindex="5" id="select2">
 <option>ÖSSZES MÁRKA</option>
 <?php
 require 'include/db.php';
 $nev=$row['nev'];
 while ($row = mysqli_fetch_array($resultb))

 {
  echo "<option>". $row['nev'] ."</option>";
 }
 ?>        
</select>
</div>
<!------------------------------------------------------------------------------------------------KATEGÓRIA SZELEKT-------------------------------------------------------------------------------> 

<!------------------------------------------------------------------------------------------------FELSŐ TÁBLA------------------------------------------------------------------------------------> 

<!------------------------------------------------------------------------------------------------ALSÓ TÁBLA------------------------------------------------------------------------------------->

<table id="also" class="table-bordered table-striped">

<!------------------------------------------------------------------------------------------------FEJLÉC-----------------------------------------------------------------------------------------> 
<thead>
<?php
 $sort =='DESC' ? $sort = 'ASC' : $sort ='DESC';
 ?>
 <tr>
  <td><input type='checkbox' id='checkBoxAll' /></td>
  <th><a href='?from=<?php echo $_REQUEST["from"]; ?>&to=<?php echo $_REQUEST["to"]; ?>&string=<?php echo $_REQUEST["string"]; ?>&marka=<?php echo $_REQUEST["marka"]; ?>&kat=<?php echo $_REQUEST["kat"]; ?>&garancia=<?php echo $_REQUEST["garancia"]; ?>&keszlet=<?php echo $_REQUEST["keszlet"]; ?>&button=Szűrés&darab=<?php echo $_REQUEST["darab"]?>&order=cikkszam&&sort=<?php echo $sort ?>' value="<?php echo $_REQUEST["order"]; ?>" >Cikkszám</a></th>
  <th><a a href='?from=<?php echo $_REQUEST["from"]; ?>&to=<?php echo $_REQUEST["to"]; ?>&string=<?php echo $_REQUEST["string"]; ?>&marka=<?php echo $_REQUEST["marka"]; ?>&kat=<?php echo $_REQUEST["kat"]; ?>&garancia=<?php echo $_REQUEST["garancia"]; ?>&keszlet=<?php echo $_REQUEST["keszlet"]; ?>&button=Szűrés&darab=<?php echo $_REQUEST["darab"]?>&order=gyarto&&sort=<?php echo $sort ?>' value="<?php echo $_REQUEST["order"]; ?>">Márka</a></th>
  <th><a a href='?from=<?php echo $_REQUEST["from"]; ?>&to=<?php echo $_REQUEST["to"]; ?>&string=<?php echo $_REQUEST["string"]; ?>&marka=<?php echo $_REQUEST["marka"]; ?>&kat=<?php echo $_REQUEST["kat"]; ?>&garancia=<?php echo $_REQUEST["garancia"]; ?>&keszlet=<?php echo $_REQUEST["keszlet"]; ?>&button=Szűrés&darab=<?php echo $_REQUEST["darab"]?>&order=cikknev&&sort=<?php echo $sort ?>' value="<?php echo $_REQUEST["order"]; ?>">Termnév</a></th>
  <th><a a href='?from=<?php echo $_REQUEST["from"]; ?>&to=<?php echo $_REQUEST["to"]; ?>&string=<?php echo $_REQUEST["string"]; ?>&marka=<?php echo $_REQUEST["marka"]; ?>&kat=<?php echo $_REQUEST["kat"]; ?>&garancia=<?php echo $_REQUEST["garancia"]; ?>&keszlet=<?php echo $_REQUEST["keszlet"]; ?>&button=Szűrés&darab=<?php echo $_REQUEST["darab"]?>&order=cikkfajta&&sort=<?php echo $sort ?>' value="<?php echo $_REQUEST["order"]; ?>">Kat</a></th>
  <th><a a href='?from=<?php echo $_REQUEST["from"]; ?>&to=<?php echo $_REQUEST["to"]; ?>&string=<?php echo $_REQUEST["string"]; ?>&marka=<?php echo $_REQUEST["marka"]; ?>&kat=<?php echo $_REQUEST["kat"]; ?>&garancia=<?php echo $_REQUEST["garancia"]; ?>&keszlet=<?php echo $_REQUEST["keszlet"]; ?>&button=Szűrés&darab=<?php echo $_REQUEST["darab"]?>&order=ar&&sort=<?php echo $sort ?>' value="<?php echo $_REQUEST["order"]; ?>">Ár</a></th>
  <th><a a href='?from=<?php echo $_REQUEST["from"]; ?>&to=<?php echo $_REQUEST["to"]; ?>&string=<?php echo $_REQUEST["string"]; ?>&marka=<?php echo $_REQUEST["marka"]; ?>&kat=<?php echo $_REQUEST["kat"]; ?>&garancia=<?php echo $_REQUEST["garancia"]; ?>&keszlet=<?php echo $_REQUEST["keszlet"]; ?>&button=Szűrés&darab=<?php echo $_REQUEST["darab"]?>&order=beszar&&sort=<?php echo $sort ?>' value="<?php echo $_REQUEST["order"]; ?>">Beszár</a></th>
  <th><a a href='?from=<?php echo $_REQUEST["from"]; ?>&to=<?php echo $_REQUEST["to"]; ?>&string=<?php echo $_REQUEST["string"]; ?>&marka=<?php echo $_REQUEST["marka"]; ?>&kat=<?php echo $_REQUEST["kat"]; ?>&garancia=<?php echo $_REQUEST["garancia"]; ?>&keszlet=<?php echo $_REQUEST["keszlet"]; ?>&button=Szűrés&darab=<?php echo $_REQUEST["darab"]?>&order=garancia&&sort=<?php echo $sort ?>' value="<?php echo $_REQUEST["order"]; ?>">Gar</a></th>
  <th><a a href='?from=<?php echo $_REQUEST["from"]; ?>&to=<?php echo $_REQUEST["to"]; ?>&string=<?php echo $_REQUEST["string"]; ?>&marka=<?php echo $_REQUEST["marka"]; ?>&kat=<?php echo $_REQUEST["kat"]; ?>&garancia=<?php echo $_REQUEST["garancia"]; ?>&keszlet=<?php echo $_REQUEST["keszlet"]; ?>&button=Szűrés&darab=<?php echo $_REQUEST["darab"]?>&order=keszlet&&sort=<?php echo $sort ?>' value="<?php echo $_REQUEST["order"]; ?>">Rak</a></th>
  <th>Aján</th>
  <th>Kép</th>
  <th>Termnév</th>
  <th>Gar.</th>
  <th>Tömeg</th>
  <th>X-mm</th>
  <th>Y-mm</th>
  <th>Z-mm</th>
  <th>Megjegy</th>
  <th>Kat.</th>
  <th>Márka</th>
 </tr>
</thead>
<tbody>
 <!-----------------------------------------------------------------------------------------Ezt már csak Isten érti----------------------------------------------------------------------------------------------------->


<!-------------------------------------------------------------------------------------------------MEGJELENÍTÉS------------------------------------------------------------------------------------------------------>
<?php
 $sql_result = mysqli_query($conn,$sql);


 $sql_result = mysql_query ($sql, $connection ) or die ('request "Could not execute SQL query" '.$sql);
 if (mysql_num_rows($sql_result)>0) 
 {
  $i = 0;
  while ($row = mysql_fetch_assoc($sql_result)) 
  {
     $id = $row['id'];
     $kepek = $row['kepek'];
   ?>
   <!-----------------------------------------------------------------------------------------SQL------------------------------------------------------------------------------------------------------------>

   <!------------------------------------------------------------------------------------LAPOZÓ ÉS SQL----------------------------------------------------------------------------------------------------->

   <tr>
    <td id="checkboi"><input type="checkbox" class="chkCheckBoxId" value="<?php echo $row['id']; ?>" name="id_<?php echo $i;?>"/></td>
    <td id="cikkszam"><?php echo $row['cikkszam']; ?></td>
    <td id="gyarto"><?php echo $row['gyarto']; ?></td>
    <td id="cikknev"><?php echo $row['cikknev']; ?></p></td>
    <td id="kat"><b><?php echo $row['cikkfajta']; ?></b>  /  <?php echo $row['cikkcsopnev']; ?></td>
    <?php
    $num = array();
    if($row["ar"] > 999){
     $ertek = (string)$row['ar'];
     for($x = 0; $x < (strlen($row["ar"])); $x++){
      $num[$x] = $ertek[$x];
     }
     switch (strlen($ertek)){
      case 4: $row["ar"] = $num[0].'.'.$num[1].$num[2].$num[3];
      echo "<td id=\"ar\">".$row["ar"]."</td>";
      break;
      case 5: $row["ar"] = $num[0].$num[1].'.'.$num[2].$num[3].$num[4];
      echo "<td id=\"ar\">".$row["ar"]."</td>";
      break;
      case 6: $row["ar"] = $num[0].$num[1].$num[2].'.'.$num[3].$num[4].$num[5];
      echo "<td id=\"ar\">".$row["ar"]."</td>";
      break;
      case 7: $row["ar"] = $num[0].'.'.$num[1].$num[2].$num[3].'.'.$num[4].$num[5].$num[6];
      echo "<td id=\"ar\">".$row["ar"]."</td>";
      break;
      case 8: $row["ar"] = $num[0].$num[1].'.'.$num[2].$num[3].$num[4].'.'.$num[5].$num[6].$num[7];
      echo "<td id=\"ar\">".$row["ar"]."</td>";
      break;
      default: echo "<script type='text/JavaScrit'> alert('Túl nagy szám!'); </script>";
     }
    }else{
     echo "<td id=\"ar\" >".$row['ar']."</td>";
    }
    ?>
    <td id="beszar"><?php echo $row['beszar']; ?></td>
    <td id="garancia"><?php echo $row['garancia']; ?></td>
    <td id="keszlet"><?php echo $row['keszlet']; ?></td>
    <td id="ajandek"><?php echo $row['ajan']; ?></td>
    <td id="kepjel"><a href="#view<?php echo $id?>" data-toggle="modal"><img src="<?php echo $row['kepek']; ?>" width="30" height="30" alt=" "> </a></td>
    <div id="view<?php echo $id?>" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title"><?php echo $row["cikknev"];?></h4>
                     <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
                  <div class="modal-body">
                    <div  class="form-group" id="leiras"><u><b>Leírás:</u>  <?php echo $row['leiras'];?></div>
                    <div id="kep"><img src="<?php echo $row['kepek'];  ?>" class="img-responsive" width="200" height="200"></div>
                    <div id="kep"><img src="<?php echo $row['kepek1']; ?>" class="img-responsive" width="200" height="200"></div>
                    <div id="kep"><img src="<?php echo $row['kepek2']; ?>" class="img-responsive" width="200" height="200"></div>
                    <div id="kep"><img src="<?php echo $row['kepek3']; ?>" class="img-responsive" width="200" height="200"></div>
                    <div id="kep"><img src="<?php echo $row['kepek4']; ?>" class="img-responsive" width="200" height="200"></div>
                    <div id="kep"><img src="<?php echo $row['kepek5']; ?>" class="img-responsive" width="200" height="200"></div>
                </div>
                   <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    </div>
            </div>
        </div>
    </div>
    <td id="nem"><textarea name="cikkszam_<?php echo $i; ?>" class="form-control"><?php echo $row['cikkszam'];?></textarea></td>
    <td id="cikknev"><textarea name="cikknev_<?php echo $i; ?>"  style="height: 45px;" class="form-control"><?php echo $row['cikknev'];?> </textarea></td>
    <td id="garancia"><textarea name="garancia_<?php echo $i; ?>" style="height: 45px;" class="form-control"><?php echo $row['garancia'];?></textarea></td>
    <td id="sizearea"><textarea name="tomeg_<?php echo $i; ?>"  style="height: 45px;" class="form-control"></textarea></td>
    <td id="sizearea"><textarea name="x_<?php echo $i; ?>" style="height: 45px;"class="form-control"></textarea></td>
    <td id="sizearea"><textarea name="y_<?php echo $i; ?>" style="height: 45px;"class="form-control"></textarea></td>
    <td id="sizearea"><textarea name="z_<?php echo $i; ?>" style="height: 45px;"class="form-control"></textarea></td>
    <td id="megjegyzes"><textarea name="megjegyzes_<?php echo $i; ?>"  style="height: 45px;"class="form-control"></textarea></td>
    <td id="nem"><textarea name="leiras_<?php echo $i; ?>"><?php echo $row['leiras'];?></textarea></td>
    <td id="nem"><textarea name="kep_<?php echo $i; ?>"><?php echo $row['kepek'];?></textarea></td>
    <td id="nem"><textarea name="ar_<?php echo $i; ?>"><?php echo $row['ar'];?></textarea></td>
    <td>
     <select id="smallselect" name="kategoria_<?php echo $i; ?>" class="select">
      <?php
      require "include/db.php";
      $elem=$row["nev"];
      while ($row = mysqli_fetch_array($resulta)) 
      {
       echo "<option>" . $row['nev'] . "</option>";
      }
      ?>       
     </select>
    </td>
    <td>
     <select id="smallselect" name="gyarto_<?php echo $i; ?>" class="select2">
      <?php
      require "include/db.php";
      $elem=$row["nev"];
      while ($row = mysqli_fetch_array($resultb)) 
      {
       echo "<option>" . $row['nev'] . "</option>";
      }
      ?>        
     </select>
    </td>
   </tr>
   <?php
   $i++;
  }
 } 
 else 
 {
  ?>
  <tr>
   <td colspan="50">
    <h1 id="miss">Nem található ilyen :( </h1>
   </td>
   <?php 
  }
  ?>
  

<!------------------------------------------------------------------------------MEGJELENÍTÉS---------------------------------------------------------------------------------------------------------->


<!---------------------------------------------------------------------------------FELTÖLTÉS------------------------------------------------------------------------------------------------------>
  <?php
  require "include/db.php";
  if(isset($_POST['feltolt']))
  {
   for($i=0; $i<20; $i++)
   {
    if( isset($_POST['id_'.$i]) )
    {
     $cikkszam = $_POST['cikkszam_'.$i];
     $cikknev = $_POST["cikknev_".$i];
     $ar = $_POST["ar_".$i];
     $gyarto = $_POST["gyarto_".$i];
     $kategoria = $_POST["kategoria_".$i];
     $garancia = $_POST["garancia_".$i];
     $leiras = $_POST["leiras_".$i];
     $kep = $_POST["kep_".$i];
     $tomeg = $_POST["tomeg_".$i];
     $x = $_POST["x_".$i];
     $y = $_POST["y_".$i];
     $z = $_POST["z_".$i];
     $megjegyzes = $_POST["megjegyzes_".$i];

     $sql = "INSERT INTO test
     (cikkszam,cikknev,ar,gyarto,kategoria,garancia,leiras,kep,tomeg,x,y,z,megjegyzes)
     VALUES (
     '$cikkszam',
     '$cikknev',
     '$ar',
     '$kategoria',
     '$gyarto',
     '$garancia',
     '$leiras',
     '$kep',
     '$tomeg',
     '$x',
     '$y',
     '$z',
     '$megjegyzes'
    )";

    if ($mysqli->query($sql) === true)
    {} 
  }
 }
}
//<!---------------------------------------------------------------------------------FELTÖLTÉS------------------------------------------------------------------------------------------------------>


//<!---------------------------------------------------------------------------------FELTÖLTVE STÁTUSZ----------------------------------------------------------------------------------------------->
for($i=0; $i<20; $i++){
 if(isset($_POST['feltolt'])){
  $id = $_POST['id_'.$i];
  $sql = "UPDATE asd SET 
  statusz='0'
  WHERE id='$id' ";
  if ($mysqli->query($sql) === TRUE) 
  {
  echo '<script>window.location.href="inventorydown.php"</script>';
  } else {
   echo "Error updating record: " . $mysqli->error;
  }
 }
}
//<!---------------------------------------------------------------------------------FELTÖLTVE STÁTUSZ----------------------------------------------------------------------------------------------->


//<!---------------------------------------------------------------------------------TÖRÖLVE STÁTUSZ----------------------------------------------------------------------------------------------->
for($i=0; $i<20; $i++){
 if(isset($_POST['torol'])){
                         // sql to delete a record
  $id = $_POST['id_'.$i];
  $sql = "UPDATE asd SET 
  statusz='1'
  WHERE id='$id' ";
  if ($mysqli->query($sql) === TRUE) {
   echo '<script>window.location.href="inventorydown.php"</script>';
  } else {
   echo "Error updating record: " . $mysqli->error;
  }
 }
}
//<!---------------------------------------------------------------------------------TÖRÖLVE STÁTUSZ----------------------------------------------------------------------------------------------->


//<!---------------------------------------------------------------------------------KIHAGY STÁTUSZ----------------------------------------------------------------------------------------------->
for($i=0; $i<20; $i++){
 if(isset($_POST['kihagy'])){
                         // sql to delete a record
  $id = $_POST['id_'.$i];
  $sql = "UPDATE asd SET 
  statusz='2'
  WHERE id='$id' ";
  if ($mysqli->query($sql) === TRUE) {
   echo '<script>window.location.href="inventorydown.php"</script>';
  } else {
   echo "Error updating record: " . $mysqli->error;
  }
 } 
}
?>
<!---------------------------------------------------------------------------------KIHAGY STÁTUSZ----------------------------------------------------------------------------------------------->


<!---------------------------------------------------------------------------------ÖSSZES SELECT----------------------------------------------------------------------------------------------->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<script type="text/javascript">
 $(function() {
  var setValue = "2";

  /* Initialize the select's to base value */
  $('select').each(function() {
   $(this).val();
  });

  /* Change the values of select's when anyone of the select changes */
  $('#select1').change(function() {
   setValue = $(this).val();

   $('.select').each(function() {
    $(this).val(setValue);
   });
  });

 });
</script>
<script type="text/javascript">
 $(function() {
  var setValue = "2";

  /* Initialize the select's to base value */
  $('select').each(function() {
   $(this).val();
  });

  /* Change the values of select's when anyone of the select changes */
  $('#select2').change(function() {
   setValue = $(this).val();

   $('.select2').each(function() {
    $(this).val(setValue);
   });
  });

 });
</script>
<!---------------------------------------------------------------------------------ÖSSZES SELECT----------------------------------------------------------------------------------------------->

</table>
<!---------------------------------------------------------------------------------ALSÓ TÁBLA----------------------------------------------------------------------------------------------->

<!---------------------------------------------------------------------------------LAPOZÓ DESIGN----------------------------------------------------------------------------------------------->
</form>
<form>
<?php  
  if ($_REQUEST["from"]<>'' and $_REQUEST["to"]<>'')
 {
  $total_pages = "SELECT count(*)  FROM ".$SETTINGS["data_table"]." WHERE statusz='1' AND ar >= '".mysql_real_escape_string($_REQUEST["from"])."' AND ar <= '".mysql_real_escape_string($_REQUEST["to"])."'";
 } 
 if ($_REQUEST["from"]<>'' and $_REQUEST["to"]<>'' and $_REQUEST["marka"]<>'')
 {
  $total_pages = "SELECT count(*)  FROM ".$SETTINGS["data_table"]." WHERE statusz='1' AND ar >= '".mysql_real_escape_string($_REQUEST["from"])."' AND ar <= '".mysql_real_escape_string($_REQUEST["to"])."' AND gyarto='".mysql_real_escape_string($_REQUEST["marka"])."'";
 }
 if ($_REQUEST["from"]<>'' and $_REQUEST["to"]<>'' and $_REQUEST["kat"]<>'')
 {
  $total_pages = "SELECT count(*)  FROM ".$SETTINGS["data_table"]." WHERE statusz='1' AND ar >= '".mysql_real_escape_string($_REQUEST["from"])."' AND ar <= '".mysql_real_escape_string($_REQUEST["to"])."' AND (cikkcsopnev='".mysql_real_escape_string($_REQUEST["kat"])."' OR cikkfajta='".mysql_real_escape_string($_REQUEST["kat"])."')";
 }
  if ($_REQUEST["from"]<>'' and $_REQUEST["to"]<>'' and $_REQUEST["marka"]<>'' and $_REQUEST["garancia"]<>'')
 {
  $total_pages = "SELECT count(*)  FROM ".$SETTINGS["data_table"]." WHERE statusz='1' AND ar >= '".mysql_real_escape_string($_REQUEST["from"])."' AND ar <= '".mysql_real_escape_string($_REQUEST["to"])."' AND gyarto='".mysql_real_escape_string($_REQUEST["marka"])."' AND garancia='".mysql_real_escape_string($_REQUEST["garancia"])."'";
 }
  if ($_REQUEST["from"]<>'' and $_REQUEST["to"]<>'' and $_REQUEST["marka"]<>'' and $_REQUEST["kat"]<>'')
 {
  $total_pages = "SELECT count(*)  FROM ".$SETTINGS["data_table"]." WHERE statusz='1' AND ar >= '".mysql_real_escape_string($_REQUEST["from"])."' AND ar <= '".mysql_real_escape_string($_REQUEST["to"])."' AND gyarto='".mysql_real_escape_string($_REQUEST["marka"])."' AND (cikkcsopnev='".mysql_real_escape_string($_REQUEST["kat"])."' OR cikkfajta='".mysql_real_escape_string($_REQUEST["kat"])."')";
 } 
if ($_REQUEST["from"]<>'' and $_REQUEST["to"]<>'' and $_REQUEST["garancia"]<>'')
 {
  $total_pages = "SELECT count(*)  FROM ".$SETTINGS["data_table"]." WHERE statusz='1' AND ar >= '".mysql_real_escape_string($_REQUEST["from"])."' AND ar <= '".mysql_real_escape_string($_REQUEST["to"])."' AND garancia='".mysql_real_escape_string($_REQUEST["garancia"])."'";
 }
 if ($_REQUEST["from"]<>'' and $_REQUEST["to"]<>''  and $_REQUEST["string"]<>''  and $_REQUEST["marka"]<>'')
 {
  $total_pages = "SELECT count(*)  FROM ".$SETTINGS["data_table"]." WHERE statusz='1' AND ar >= '".mysql_real_escape_string($_REQUEST["from"])."' AND ar <= '".mysql_real_escape_string($_REQUEST["to"])."' AND (cikkszam LIKE '%".mysql_real_escape_string($_REQUEST["string"])."%' OR cikknev LIKE '%".mysql_real_escape_string($_REQUEST["string"])."%') AND gyarto='".mysql_real_escape_string($_REQUEST["marka"])."'";
 } 
 if ($_REQUEST["from"]<>'' and $_REQUEST["to"]<>'' and $_REQUEST["string"]<>'' and $_REQUEST["garancia"]<>'')
 {
  $total_pages = "SELECT count(*)  FROM ".$SETTINGS["data_table"]." WHERE statusz='1' AND ar >= '".mysql_real_escape_string($_REQUEST["from"])."' AND ar <= '".mysql_real_escape_string($_REQUEST["to"])."' AND (cikkszam LIKE '%".mysql_real_escape_string($_REQUEST["string"])."%' OR cikknev LIKE '%".mysql_real_escape_string($_REQUEST["string"])."%') AND garancia='".mysql_real_escape_string($_REQUEST["garancia"])."'";
 }
if ($_REQUEST["marka"]<>'' and $_REQUEST["kat"]<>'' and $_REQUEST["garancia"]<>'' and $_REQUEST["keszlet"]<>'' ) 
 {
  $total_pages = "SELECT count(*) FROM ".$SETTINGS["data_table"]." WHERE statusz='1' AND gyarto='".mysql_real_escape_string($_REQUEST["marka"])."'AND (cikkcsopnev='".mysql_real_escape_string($_REQUEST["kat"])."' OR cikkfajta='".mysql_real_escape_string($_REQUEST["kat"])."') AND garancia='".mysql_real_escape_string($_REQUEST["garancia"])."' AND keszlet>='1'";
 }
else if ($_REQUEST["marka"]<>'' and $_REQUEST["kat"]<>'' and $_REQUEST["garancia"]<>'') 
 {
  $total_pages = "SELECT count(*) FROM ".$SETTINGS["data_table"]." WHERE statusz='1' AND gyarto='".mysql_real_escape_string($_REQUEST["marka"])."'AND (cikkcsopnev='".mysql_real_escape_string($_REQUEST["kat"])."' OR cikkfajta='".mysql_real_escape_string($_REQUEST["kat"])."') AND garancia='".mysql_real_escape_string($_REQUEST["garancia"])."'";
 }
else if ($_REQUEST["marka"]<>'' and $_REQUEST["kat"]<>'') 
 {
  $total_pages = "SELECT count(*) FROM ".$SETTINGS["data_table"]." WHERE statusz='1' AND gyarto='".mysql_real_escape_string($_REQUEST["marka"])."'AND (cikkcsopnev='".mysql_real_escape_string($_REQUEST["kat"])."' OR cikkfajta='".mysql_real_escape_string($_REQUEST["kat"])."')";
 }
else if ($_REQUEST["marka"]<>'' and $_REQUEST["garancia"]<>'') 
 {
  $total_pages = "SELECT count(*) FROM ".$SETTINGS["data_table"]." WHERE statusz='1' AND gyarto='".mysql_real_escape_string($_REQUEST["marka"])."' AND garancia='".mysql_real_escape_string($_REQUEST["garancia"])."'";
 }
  else if ($_REQUEST["marka"]<>'' and $_REQUEST["keszlet"]<>'') 
 {
  $total_pages = "SELECT count(*) FROM ".$SETTINGS["data_table"]." WHERE statusz='1' AND gyarto='".mysql_real_escape_string($_REQUEST["marka"])."' AND keszlet>='1'";
 }
 else if ($_REQUEST["from"]<>'' and $_REQUEST["to"]<>'' and $_REQUEST["string"]<>'' and $_REQUEST["garancia"]<>'' and $_REQUEST["keszlet"]<>'')
 {
  $total_pages = "SELECT count(*)  FROM ".$SETTINGS["data_table"]." WHERE statusz='1' AND ar >= '".mysql_real_escape_string($_REQUEST["from"])."' AND ar <= '".mysql_real_escape_string($_REQUEST["to"])."' AND (cikkszam LIKE '%".mysql_real_escape_string($_REQUEST["string"])."%' OR cikknev LIKE '%".mysql_real_escape_string($_REQUEST["string"])."%') AND garancia='".mysql_real_escape_string($_REQUEST["garancia"])."'  AND keszlet>='1'";
 }
 else if ($_REQUEST["from"]<>'' and $_REQUEST["to"]<>'' and $_REQUEST["string"]<>'')
 {
  $total_pages = "SELECT count(*)  FROM ".$SETTINGS["data_table"]." WHERE statusz='1' AND ar >= '".mysql_real_escape_string($_REQUEST["from"])."' AND ar <= '".mysql_real_escape_string($_REQUEST["to"])."' AND (cikkszam LIKE '%".mysql_real_escape_string($_REQUEST["string"])."%' OR cikknev LIKE '%".mysql_real_escape_string($_REQUEST["string"])."%')";
 }
  else if ($_REQUEST["from"]<>'' and $_REQUEST["to"]<>'' and $_REQUEST["garancia"]<>'')
 {
  $total_pages = "SELECT count(*)  FROM ".$SETTINGS["data_table"]." WHERE statusz='1' AND ar >= '".mysql_real_escape_string($_REQUEST["from"])."' AND ar <= '".mysql_real_escape_string($_REQUEST["to"])."' AND garancia='".mysql_real_escape_string($_REQUEST["garancia"])."'";
 }
 else if ($_REQUEST["from"]<>'' and $_REQUEST["to"]<>'' and $_REQUEST["marka"]<>'' and $_REQUEST["keszlet"]<>'')
 {
  $total_pages = "SELECT count(*)  FROM ".$SETTINGS["data_table"]." WHERE statusz='1' AND ar >= '".mysql_real_escape_string($_REQUEST["from"])."' AND ar <= '".mysql_real_escape_string($_REQUEST["to"])."' AND gyarto='".mysql_real_escape_string($_REQUEST["marka"])."' AND ar <= '".mysql_real_escape_string($_REQUEST["to"])."' AND keszlet>='1'";
 }
 else if ($_REQUEST["from"]<>'' and $_REQUEST["to"]<>'' and $_REQUEST["string"]<>'' and $_REQUEST["keszlet"]<>'')
 {
  $total_pages = "SELECT count(*)  FROM ".$SETTINGS["data_table"]." WHERE statusz='1' AND ar >= '".mysql_real_escape_string($_REQUEST["from"])."' AND ar <= '".mysql_real_escape_string($_REQUEST["to"])."' AND (cikkszam LIKE '%".mysql_real_escape_string($_REQUEST["string"])."%' OR cikknev LIKE '%".mysql_real_escape_string($_REQUEST["string"])."%') AND keszlet>='1'";
 }
 else if ($_REQUEST["from"]<>'' and $_REQUEST["to"]<>'' and $_REQUEST["string"]<>'' and $_REQUEST["kat"]<>'')
 {
  $total_pages = "SELECT count(*)  FROM ".$SETTINGS["data_table"]." WHERE statusz='1' AND ar >= '".mysql_real_escape_string($_REQUEST["from"])."' AND ar <= '".mysql_real_escape_string($_REQUEST["to"])."' AND (cikkszam LIKE '%".mysql_real_escape_string($_REQUEST["string"])."%' OR cikknev LIKE '%".mysql_real_escape_string($_REQUEST["string"])."%') AND cikkcsopnev='".mysql_real_escape_string($_REQUEST["kat"])."' OR cikkfajta='".mysql_real_escape_string($_REQUEST["kat"])."'";
 } 
 else if ($_REQUEST["from"]<>'' and $_REQUEST["to"]<>'' and $_REQUEST["marka"]<>'' and $_REQUEST["string"]<>'')
 {
  $total_pages = "SELECT count(*)  FROM ".$SETTINGS["data_table"]." WHERE statusz='1' AND ar >= '".mysql_real_escape_string($_REQUEST["from"])."' AND ar <= '".mysql_real_escape_string($_REQUEST["to"])."' AND gyarto='".mysql_real_escape_string($_REQUEST["marka"])."'AND (cikkszam LIKE '%".mysql_real_escape_string($_REQUEST["string"])."%' OR cikknev LIKE '%".mysql_real_escape_string($_REQUEST["string"])."%')";
 }
  else if ($_REQUEST["from"]<>'' and $_REQUEST["to"]<>'' and $_REQUEST["keszlet"]<>'')
 {
  $total_pages = "SELECT count(*)  FROM ".$SETTINGS["data_table"]." WHERE statusz='1' AND ar >= '".mysql_real_escape_string($_REQUEST["from"])."' AND ar <= '".mysql_real_escape_string($_REQUEST["to"])."' AND keszlet>='1'";
 }
else if ($_REQUEST["garancia"]<>'') 
 {
  $total_pages = "SELECT count(*) FROM ".$SETTINGS["data_table"]." WHERE statusz='1' AND garancia='".mysql_real_escape_string($_REQUEST["garancia"])."'";
 } 
 else if ($_REQUEST["marka"]<>'')  
 {
  $total_pages = "SELECT count(*) FROM ".$SETTINGS["data_table"]." WHERE statusz='1' AND gyarto='".mysql_real_escape_string($_REQUEST["marka"])."'";
 } 
 else if ($_REQUEST["kat"]<>'')  
 {
  $total_pages = "SELECT count(*) FROM ".$SETTINGS["data_table"]." WHERE statusz='1' AND (cikkcsopnev='".mysql_real_escape_string($_REQUEST["kat"])."' OR cikkfajta='".mysql_real_escape_string($_REQUEST["kat"])."')";
 }
 else if ($_REQUEST["to"]<>'')
 {
  $total_pages = "SELECT count(*)  FROM ".$SETTINGS["data_table"]." WHERE statusz='1' AND  ar <= '".mysql_real_escape_string($_REQUEST["to"])."'";
 } 
else if ($_REQUEST["string"]<>'')
 {
  $total_pages = "SELECT count(*)  FROM ".$SETTINGS["data_table"]." WHERE statusz='1' AND (cikkszam LIKE '%".mysql_real_escape_string($_REQUEST["string"])."%' OR cikknev LIKE '%".mysql_real_escape_string($_REQUEST["string"])."%')";
 } 
else if ($_REQUEST["keszlet"]<>'')
 {
  $total_pages = "SELECT count(*)  FROM ".$SETTINGS["data_table"]." WHERE statusz='1' AND keszlet>='1'";
 } 
 else
 {
  $total_pages = "SELECT count(*) FROM ".$SETTINGS["data_table"]." WHERE statusz='1' ";
 }
 $result = mysqli_query($conn,$total_pages);
 $total_rows = mysqli_fetch_array($result)[0];
 $total_pages = ceil($total_rows / $no_of_records_per_page);

 ?>

<ul class="pagination">
<li><a href="?from=<?php echo $_REQUEST["from"]; ?>&to=<?php echo $_REQUEST["to"]; ?>&string=<?php echo $_REQUEST["string"]; ?>&marka=<?php echo $_REQUEST["marka"]; ?>&kat=<?php echo $_REQUEST["kat"]; ?>&garancia=<?php echo $_REQUEST["garancia"]; ?>&keszlet=<?php echo $_REQUEST["keszlet"]; ?>&button=Szűrés&darab=<?php echo $_REQUEST["darab"]?>&order=<?php echo $_REQUEST["order"]; ?>&&sort=<?php echo $sort ?>&pageno=1">Első</a></li>
</li>
<li class="<?php if($pageno <= 1){ echo ''; } ?>">
<a href="<?php if($pageno <= 1){ echo '#'; } else { echo "?from=".$_REQUEST["from"]."&to=".$_REQUEST["to"]."&string=".$_REQUEST["string"]."&marka=".$_REQUEST["marka"]."&kat=".$_REQUEST["kat"]."&garancia=".$_REQUEST["garancia"]."&keszlet=".$_REQUEST["keszlet"]."&button=Szűrés&darab=".$_REQUEST["darab"]."&order=".$_REQUEST["order"]."&&sort=".$_REQUEST["sort"]."&pageno=".($pageno - 1); } ?>"><?php echo "".($pageno - 1);  ?></a>
</li>

<li class="active">
<a href="<?php if($pageno <= 1){ echo '#'; } else { echo "?from=".$_REQUEST["from"]."&to=".$_REQUEST["to"]."&string=".$_REQUEST["string"]."&marka=".$_REQUEST["marka"]."&kat=".$_REQUEST["kat"]."&garancia=".$_REQUEST["garancia"]."&keszlet=".$_REQUEST["keszlet"]."&button=Szűrés&darab=".$_REQUEST["darab"]."&order=".$_REQUEST["order"]."&&sort=".$_REQUEST["sort"]."&pageno=".($pageno); } ?>"><?php echo $pageno;  ?></a>
</li>
<li class="<?php if($pageno >= $total_pages){ echo 'disabled'; } ?>">
<a href="<?php if($pageno >= $total_pages){ echo '#'; } else { echo "?from=".$_REQUEST["from"]."&to=".$_REQUEST["to"]."&string=".$_REQUEST["string"]."&marka=".$_REQUEST["marka"]."&kat=".$_REQUEST["kat"]."&garancia=".$_REQUEST["garancia"]."&keszlet=".$_REQUEST["keszlet"]."&button=Szűrés&darab=".$_REQUEST["darab"]."&order=".$_REQUEST["order"]."&&sort=".$_REQUEST["sort"]."&pageno=".($pageno + 1); } ?>"><?php echo "".($pageno +1);  ?></a>
</li>
<li>
<span>.....</span>
</li>
<li class="<?php if($pageno+5 >= $total_pages){ echo 'disabled'; } ?>">
<a href="<?php if($pageno+5 >= $total_pages){ echo '#'; } else { echo "?from=".$_REQUEST["from"]."&to=".$_REQUEST["to"]."&string=".$_REQUEST["string"]."&marka=".$_REQUEST["marka"]."&kat=".$_REQUEST["kat"]."&garancia=".$_REQUEST["garancia"]."&keszlet=".$_REQUEST["keszlet"]."&button=Szűrés&darab=".$_REQUEST["darab"]."&order=".$_REQUEST["order"]."&&sort=".$_REQUEST["sort"]."&pageno=".($pageno + 5); } ?>"><?php echo "".($pageno +5);  ?></a>
</li>
<li class="<?php if($pageno+10 >= $total_pages){ echo 'disabled'; } ?>">
<a href="<?php if($pageno1+10 >= $total_pages){ echo '#'; } else { echo "?from=".$_REQUEST["from"]."&to=".$_REQUEST["to"]."&string=".$_REQUEST["string"]."&marka=".$_REQUEST["marka"]."&kat=".$_REQUEST["kat"]."&garancia=".$_REQUEST["garancia"]."&keszlet=".$_REQUEST["keszlet"]."&button=Szűrés&darab=".$_REQUEST["darab"]."&order=".$_REQUEST["order"]."&&sort=".$_REQUEST["sort"]."&pageno=".($pageno + 10); } ?>"><?php echo "".($pageno +10);  ?></a>
</li>

<li><a href="?from=<?php echo $_REQUEST["from"]; ?>&to=<?php echo $_REQUEST["to"]; ?>&string=<?php echo $_REQUEST["string"]; ?>&marka=<?php echo $_REQUEST["marka"]; ?>&kat=<?php echo $_REQUEST["kat"]; ?>&garancia=<?php echo $_REQUEST["garancia"]; ?>&keszlet=<?php echo $_REQUEST["keszlet"]; ?>&button=Szűrés&darab=<?php echo $_REQUEST["darab"]?>&order=<?php echo $_REQUEST["order"]; ?>&sort=<?php echo $sort ?>&pageno=<?php echo $total_pages; ?>"><?php echo $total_pages; ?></a></li>
</ul>

<!---------------------------------------------------------------------------------LAPOZÓ DESIGN----------------------------------------------------------------------------------------------->
</form> 
<!---------------------------------------------------------------------------------SELECT KERESŐ----------------------------------------------------------------------------------------------->
<script src="js/jquery-3.2.1.min.js" type="text/javascript"></script>
<script src="js/chosen.jquery.js" type="text/javascript"></script>
<script src="js/prism.js" type="text/javascript" charset="utf-8"></script>
<script src="js/init.js" type="text/javascript" charset="utf-8"></script>
<!---------------------------------------------------------------------------------SELECT KERESŐ----------------------------------------------------------------------------------------------->
</body>
</html>

