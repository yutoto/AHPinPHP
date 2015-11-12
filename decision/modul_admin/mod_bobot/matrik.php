<?php
$aksi="modul_admin/mod_bobot/aksi_matrik.php";
switch($_GET[act]){
  // Tampil Matrik Perbandingan Kriteria
  default:
    $queri=mysql_query("SELECT * FROM konsistensi");
	$cr=mysql_num_rows($queri);
	if ($cr){
	    echo "<h2>Matrix of Criteria Comparation</h2>";
		echo "
			<table class='table table-bordered'>
          <tr><th>criteria 1</th><th>criteria 2</th><th>grade</th></tr>"; 
		$tampil=mysql_query("SELECT * FROM matrik_kriteria ORDER BY id_kriteria");
		while ($r=mysql_fetch_array($tampil)){
		   echo "<tr><td>$r[id_kriteria]</td>
				 <td>$r[id_bandingan]</td>
				 <td>$r[nilai]
				 </td></tr>";
		}
		echo "</table>";
		echo "<br>";
		echo "<h2>Matrix of Normalization Criteria</h2>";
		echo "
			<table class='table table-bordered'>
          <tr><th>criteria 1</th><th>criteria 2</th><th>grade</th></tr>"; 
		$tampil1=mysql_query("SELECT * FROM matrik_normalisasi_kriteria ORDER BY id_kriteria");
		while ($r1=mysql_fetch_array($tampil1)){
		   echo "<tr><td>$r1[id_kriteria]</td>
				 <td>$r1[id_bandingan]</td>
				 <td>$r1[nilai]
				 </td></tr>";
		}
		echo "</table>";
		echo "<br>";
		echo "<h2>Final Weighting Criteria</h2>";
		echo "
			<table class='table table-bordered'>
          <tr><th>criteria</th><th>grade</th></tr>"; 
		$tampil2=mysql_query("SELECT nama_kriteria, bobot FROM bobot_kriteria ORDER BY id_kriteria");
		while ($r2=mysql_fetch_array($tampil2)){
		   echo "<tr><td>$r2[nama_kriteria]</td>
				 <td>$r2[bobot]
				 </td></tr>";
		}
		echo "</table>";
		echo "<br>";
		$jlhkriteria = mysql_result(mysql_query("SELECT COUNT(*) as Num FROM kriteria"),0); // Jumlah Kriteria
		if ($jlhkriteria == 1){
			echo "No Need to Count the Consistency Ratio because the Matrik Dimension is 1X1, Means that the Random Index Value will be 0<br/>";
			echo "<form method='post' action='$aksi?modul=bobot&act=lanjutkan'>
				<input type=submit class='btn btn-success' value=Continue></form>
				<form method='post' action='$aksi?modul=bobot&act=hitunglagi'>
					<input type=submit class='btn btn-success' value=Redo></form>";
		} else if ($jlhkriteria == 2){
			echo "No Need to Count the Consistency Ratio because the Matrik Dimension is 2X2, Means that the Random Index Value will be 0<br/>";
			echo "<form method='post' action='$aksi?modul=bobot&act=lanjutkan'>
				<input type=submit class='btn btn-success' value=Continue></form>
				<form method='post' action='$aksi?modul=bobot&act=hitunglagi'>
					<input type=submit class='btn btn-success' value=Redo></form>";
		}
		else if ($jlhkriteria > 2){
			$tampil3 = mysql_query("SELECT * FROM konsistensi");
			$r3=mysql_fetch_array($tampil3);
			echo "Consistency Ratio (CR) : $r3[cr] <br>";
			if ($r3[cr] <= 0.1){
				echo "Consistency Ratio CAN be accepted (<=0.1)<br/>";
				echo "<form method='post' action='$aksi?modul=bobot&act=lanjutkan'>
					<input type=submit  class='btn btn-success'value=Continue></form>
					<form method='post' action='$aksi?modul=bobot&act=hitunglagi'>
					<input type=submit class='btn btn-success' value=Redo></form>";
			}
			else{
				echo "Consistency Ratio CAN'T be accepted (>0.1)<br/>";
				echo "Please check again the scale for criteria comparation<br/>";
				echo "<form method='post' action='$aksi?modul=bobot&act=hitunglagi'>
					<input type=submit class='btn btn-success' value=Redo></form>
				";
			}
		}
		echo "<br>";
	}
	else{
		echo "The comparation among criterias haven't been done. 
		<br><a href=?modul=bobot&act=buatperbandingan>Create the Criteria Comparation</a>";
	}
    break;
  
  // Matrik Perbandingan
  case "buatperbandingan":
    echo "<h2>Pairwise Comparation Judgement Matrix (PCJM)</h2>
	<br>Score used is the Comparation Scale created by Saaty (1-9)
	     <br>
	     <table class='table table-bordered'>
          <tr><td>1</td><td> : Equal Importance</td></tr>
		  <tr><td>3</td><td> : Moderate importance of one over another</td></tr>
		  <tr><td>5</td><td> : Essential or strong importance</td></tr>
		  <tr><td>7</td><td> : Very strong importance</td></tr>
		  <tr><td>9</td><td> : Extreme importance</td></tr>
		  <tr><td>2,4,6,8</td><td> : Intermediate values between the two adjacent judgments</td></tr>
         </table>";
    echo "<form method='post' action='$aksi?modul=bobot&act=matrikperbandingan'>
	
		  <table class='table table-bordered'>
          <tr><th>criteria 1</th><th>criteria 2</th><th>grade (weight of criteria)</th></tr>"; 
    $jlhkriteria = mysql_result(mysql_query("SELECT COUNT(*) as Num FROM kriteria"),0); // Jumlah Kriteria
	for ($i=1; $i<=$jlhkriteria; $i++){
		$queri1=mysql_query("SELECT * FROM kriteria WHERE id_kriteria='$i' ORDER BY id_kriteria ASC");
		$kriteria1=mysql_fetch_array($queri1);
		for ($j=$i+1; $j<=$jlhkriteria; $j++){
		$queri2=mysql_query("SELECT * FROM kriteria WHERE id_kriteria='$j' ORDER BY id_kriteria ASC");
		$kriteria2=mysql_fetch_array($queri2);
			echo "<tr>";
			echo "<td><input type='radio' name='Matriks".$i.$j."' value='kanan'>&nbsp;$kriteria1[nama_kriteria]<input type=hidden name='id_kriteria".$i.$j."' value='$r[id_kriteria]'></td>
				  <td><input type='radio' name='Matriks".$i.$j."' value='kiri'>&nbsp;$kriteria2[nama_kriteria]<input type=hidden name='id_kriteria".$i.$j."' value='$r[id_kriteria]'></td>
				  <td><select name='M".$i.$j."'>
					<option value='1'>1</option>
					<option value='2'>2</option>
					<option value='3'>3</option>
					<option value='4'>4</option>
					<option value='5'>5</option>
					<option value='6'>6</option>
					<option value='7'>7</option>
					<option value='8'>8</option>
					<option value='9'>9</option>
				  </select></td>
				 ";
			echo "</tr>";
		}
	}
    echo "</table>
	<input type='submit' class='btn btn-success' name='Submit' value='Submit'><input type=button class='btn btn-success' value=Cancel onclick=self.history.back()></form>";
	break;
}
?>
