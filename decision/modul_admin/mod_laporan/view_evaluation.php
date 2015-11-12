<?php
$eval_name = $_GET['eval_name'];
$queri=mysql_query("SELECT * FROM previous_calculation where eval_code='$eval_name'");
$hasil=mysql_num_rows($queri);
if ($hasil){
    echo    "<h2>Previous evaluasion of employee for $eval_name</h2>
	    <table class='table table-bordered'>
		<tr>
		    <th>ID</th>
		    <th>Name</th>
		    <th>Position</th>
		    <th>Division</th>
		    <th>Final Grade</th>
		    <th>Evaluation name</th>
		</tr>"; 
		// Paging
		$hal = $_GET[hal];
		if(!isset($_GET['hal'])){ 
			$page = 1; 
			$hal = 1;
		} else { 
			$page = $_GET['hal']; 
		}
		$jmlperhalaman = 10;  // sum of record per page
		$offset = (($page * $jmlperhalaman) - $jmlperhalaman);
		$tampil=mysql_query("SELECT h.nip,k.nama_karyawan,k.jabatan,k.divisi,h.total_nilai
				 FROM karyawan k, previous_calculation h
				 WHERE k.jabatan != 'manajer' AND h.nip=k.nip AND h.eval_code='$eval_name'
				 ORDER BY h.total_nilai DESC LIMIT $offset, $jmlperhalaman");
	
		while ($r=mysql_fetch_array($tampil)){
		   echo "<tr>
			    <td>$r[nip]</td>
			    <td>$r[nama_karyawan]</td>
			    <td>$r[jabatan]</td>
			    <td>$r[divisi]</td>
			    <td>$r[total_nilai]</td>
			    <td>$eval_name</td>
			</tr>";
		}
	 echo "</table>";
	 
	// create page number
	$total_record = mysql_result(mysql_query("SELECT COUNT(*) as Num FROM previous_calculation where eval_code='$eval_name'"),0);
	$total_halaman = ceil($total_record / $jmlperhalaman);
	echo "<center>Page :<br/>"; 
	$perhal=4;
	if($hal > 1){ 
		$prev = ($page - 1); 
		echo "<a href=indexs.php?modul=previous_evaluations&hal=$prev> << </a> "; 
	}
	if($total_halaman<=10){
	$hal1=1;
	$hal2=$total_halaman;
	}else{
	$hal1=$hal-$perhal;
	$hal2=$hal+$perhal;
	}
	if($hal<=5){
	$hal1=1;
	}
	if($hal<$total_halaman){
	$hal2=$hal+$perhal;
	}else{
	$hal2=$hal;
	}
	for($i = $hal1; $i <= $hal2; $i++){ 
		if(($hal) == $i){ 
			echo "[<b>$i</b>] "; 
			} else { 
		if($i<=$total_halaman){
				echo "<a href=indexs.php?modul=previous_evaluations&hal=$i>$i</a> "; 
		}
		} 
	}
	if($hal < $total_halaman){ 
		$next = ($page + 1); 
		echo "<a href=indexs.php?modul=previous_evaluations&hal=$next>>></a>"; 
	} 
	echo "</center><br/>";
}
else{
	echo "";
}

?>
