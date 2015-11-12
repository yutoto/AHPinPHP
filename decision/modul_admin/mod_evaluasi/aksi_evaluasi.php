<?php
session_start();
include "../../config/koneksi.php";

$modul=$_GET[modul];
$acts=$_GET[acts];
$jlhkriteria=$_POST[jlhkriteria];
$id=$_POST[nip];
// Input Score
if ($modul=='evaluasi' AND $acts=='input'){
  for($i=1;$i<=$jlhkriteria;$i++){
  	$nilai = $_POST['nilai'.$i];
	$id_kriteria = $_POST['id_kriteria'.$i];
  	mysql_query("INSERT INTO evaluasi(nip, id_kriteria, nilai) VALUES('$_POST[nip]', '$id_kriteria', '$nilai')");
  }
  
  //Total Score
  $total=0;
  for($i=1;$i<=$jlhkriteria;$i++){
  	$nilai = $_POST['nilai'.$i];
	$id_kriteria = $_POST['id_kriteria'.$i];
	$tampil=mysql_query("SELECT bobot FROM bobot_kriteria WHERE id_kriteria='$id_kriteria' ORDER BY id_kriteria ASC");
	$r=mysql_fetch_array($tampil);
	$skor_total=$nilai*$r[bobot];
	$total += $skor_total;
  }
  
  mysql_query("INSERT INTO previous_calculation(nip, total_nilai, datemade) VALUES('$_POST[nip]', '$total', now())");
    mysql_query("INSERT INTO hasil_evaluasi(nip, total_nilai, datemade) VALUES('$_POST[nip]', '$total', now())");
    header('location:../../indexs.php?modul='.$modul);
  
}

// Update Score
elseif ($modul=='evaluasi' AND $acts=='update'){
  for($i=1;$i<=$jlhkriteria;$i++){
  	$nilai = $_POST['nilai'.$i];
	$id_kriteria = $_POST['id_kriteria'.$i];
	mysql_query("UPDATE evaluasi SET nip = '$_POST[nip]', id_kriteria = '$id_kriteria', nilai = '$nilai' WHERE nip = '$_POST[nip]' AND id_kriteria = '$id_kriteria'");  
	
  }
  
  //Total Score
  $total=0;
  for($i=1;$i<=$jlhkriteria;$i++){
  	$nilai = $_POST['nilai'.$i];
	$id_kriteria = $_POST['id_kriteria'.$i];
	$tampil=mysql_query("SELECT bobot FROM bobot_kriteria WHERE id_kriteria='$id_kriteria'");
	$r=mysql_fetch_array($tampil);
	$skor_total=$nilai*$r[bobot];
	$total += $skor_total;
  }  
  
  $eval_code = $_POST['eval_code'];
  mysql_query("INSERT INTO hasil_evaluasi(nip, total_nilai, eval_code, datemade) VALUES('$_POST[nip]', '$total', '$eval_code', now())");  
  mysql_query("INSERT INTO previous_calculation(nip, total_nilai, eval_code, datemade) VALUES('$_POST[nip]', '$total', '$eval_code', now())");  
  header('location:../../indexs.php?modul='.$modul.'');
  
}
?>

