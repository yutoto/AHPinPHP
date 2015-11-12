<?php

$queri=mysql_query("SELECT * FROM previous_calculation group by eval_code order by datemade desc");
$hasil=mysql_num_rows($queri);
if ($hasil){
    
    echo "  <h2>Previous evaluasion of employee</h2>
	    <table class='table table-bordered'>
	    <tr>
		<th>Evaluation code/name</th>
		<th>Evaluation date</th>
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
	    
	
	    while ($hasil_r=mysql_fetch_array($queri)){
		$ev_code = $hasil_r['eval_code'];
		$datemade = $hasil_r['datemade'];
		$tampil=mysql_query("SELECT COUNT(DISTINCT eval_code) FROM previous_calculation group by eval_code");
		$tampil_hasil=mysql_num_rows($tampil);
		echo "<tr>
			<td><a href='indexs.php?modul=view_evaluation&eval_name=".$ev_code."'>$ev_code</a></td>
			<td>$datemade</td>
		    </tr>";
	    }
    echo "</table>";
	// Create page number
	$total_record = mysql_result(mysql_query("SELECT COUNT(*) as Num FROM previous_calculation group by eval_code"),0);
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
	echo "Please redo the process of scoring employee<br/>";
	echo "	<form method='post' action='?modul=evaluasi'>
		    <input type=submit class='btn btn-success' value=Redo>&nbsp;&nbsp;&nbsp;OR
		</form>";
}

?>
