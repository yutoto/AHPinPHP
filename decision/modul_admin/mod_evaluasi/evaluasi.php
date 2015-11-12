<?php
$aksi="modul_admin/mod_evaluasi/aksi_evaluasi.php";
switch($_GET[acts]){
  // Tampil Karyawan
  default:
  $queri=mysql_query("SELECT * FROM konsistensi");
	$cr=mysql_num_rows($queri);
	if ($cr){
    echo "<h2>Data of Employee</h2>
           <table class='table table-bordered' id='datatable'><thead>
          <tr><th>ID</th><th>Name</th><th>Position</th><th>Division</th><th>Action</th></tr></thead>"; 
	// Paging
  	$hal = $_GET[hal];
	if(!isset($_GET['hal'])){ 
		$page = 1; 
		$hal = 1;
	} else { 
		$page = $_GET['hal']; 
	}
	$jmlperhalaman = 10;  // jumlah record per halaman
	$offset = (($page * $jmlperhalaman) - $jmlperhalaman);
    $tampil=mysql_query("SELECT nip, nama_karyawan, jabatan, divisi FROM karyawan WHERE jabatan != 'admin' ORDER BY nip");
    while ($r=mysql_fetch_array($tampil)){
       echo "<tr>
             <td>$r[nip]</td>
             <td>$r[nama_karyawan]</td>
			 <td>$r[jabatan]</td>
			 <td>$r[divisi]</td>
		     <td><a href=?modul=dtakary&act=edit&id=$r[nip]>Detail</a> | 
	               <a href=?modul=evaluasi&acts=edit&id=$r[nip]>Evaluasi</a>
             </td></tr>";
    }
    echo "</table>";
	// membuat nomor halaman
	$total_record = mysql_result(mysql_query("SELECT COUNT(*) as Num FROM karyawan"),0);
	$total_halaman = ceil($total_record / $jmlperhalaman);
	echo "<center>Page :<br/>"; 
	$perhal=4;
	if($hal > 1){ 
		$prev = ($page - 1); 
		echo "<a href=indexs.php?modul=evaluasi&hal=$prev> << </a> "; 
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
				echo "<a href=indexs.php?modul=evaluasi&hal=$i>$i</a> "; 
		}
		} 
	}
	if($hal < $total_halaman){ 
		$next = ($page + 1); 
		echo "<a href=indexs.php?modul=evaluasi&hal=$next>>></a>"; 
	} 
	echo "</center><br/>";
	}else{
		echo "Comparation among criterias haven't been done. 
		<br><a href=?modul=bobot&act=buatperbandingan>Create Criteria Comparation</a>";
	}
    break;
    
  case "edit":
	$edit=mysql_query("SELECT * FROM karyawan WHERE nip='$_GET[id]'");
	$r1=mysql_fetch_array($edit);
	$cek=mysql_query("SELECT * FROM evaluasi WHERE nip='$_GET[id]'");
	$jlh=mysql_num_rows($cek);
	if ($jlh > 0){
		echo "<h2>Input the Score of Employee Assessment</h2>
			<form method=POST action=$aksi?modul=evaluasi&acts=update>
				<table class='table table-bordered'>
					ID 		: $r1[nip]<br>
					Name		: $r1[nama_karyawan]<br>
					Position	: $r1[jabatan]<br>
					Division	: $r1[divisi]<br>
					Evaluation Score : 10-100<br>
					<tr>
						<th>criteria</th>
						<th>grade</th>
					</tr>";
					
					$jlhkriteria = mysql_result(mysql_query("SELECT COUNT(*) as Num FROM kriteria"),0); // Jumlah Kriteria
					for ($i=1;$i<=$jlhkriteria;$i++){
					$evaluasi=mysql_query("SELECT k.nama_kriteria,e.id_kriteria,e.nilai FROM evaluasi e, kriteria k WHERE e.nip='$_GET[id]' AND e.id_kriteria='$i' AND e.id_kriteria=k.id_kriteria");
					$hasil=mysql_fetch_array($evaluasi);
					
				echo 	"<tr>
						<td>
							$hasil[nama_kriteria]
							<input type=hidden name='id_kriteria".$i."' value='$hasil[id_kriteria]'>
						</td>
						<td>
							<input type=text name='nilai".$i."' value='$hasil[nilai]'>
							<input type=hidden name=nip value='$_GET[id]'>
						</td>
					</tr>";
				}
				
				echo 	"<tr>
						<td colspan=2>
							<label>Evlauasion Code/Name</label> &nbsp;<input class='eval_code' placeholder='Evaluation code/name' type=text name='eval_code'>
						</td>
					</tr>
					
					<tr>
						<td colspan=2>
							<input type=submit class='btn btn-success' value=Submit>
							<input type=button class='btn btn-success' value=Cancel onclick=self.history.back()><input type=hidden name=jlhkriteria value='$jlhkriteria'>
						</td>
					</tr>
				</table>
			</form>";
	}else {
		$id = $_GET[id];
		echo "	<h2>Input the Score of Employee Assessment</h2>
			<form method=POST action=$aksi?modul=evaluasi&acts=input>
				<table class='table table-bordered'>
					ID 		: $r1[nip]<br>
					Name		: $r1[nama_karyawan]<br>
					Position	: $r1[jabatan]<br>
					Division	: $r1[divisi]<br>
					Evaluation Score : 10-100<br>
					<tr><th>criteria</th><th>grade</th></tr>";
					$jlhkriteria = mysql_result(mysql_query("SELECT COUNT(*) as Num FROM kriteria"),0); // Jumlah Kriteria
					for ($i=1;$i<=$jlhkriteria;$i++){
						$tampil=mysql_query("SELECT * FROM kriteria WHERE id_kriteria='$i' ORDER BY id_kriteria ASC");
						$r=mysql_fetch_array($tampil);
						
						echo 	"<tr>
								<td>
									$r[nama_kriteria]<input type=hidden name='id_kriteria".$i."' value='$r[id_kriteria]'>
								</td>
								<td>
									<input type=text name='nilai".$i."'><input type=hidden name=nip value='$id'>
								</td>
							 </tr>";
					}
					
					echo 	"<tr>
							<td colspan=2>
								<input type=submit class='btn btn-success' value=Submit>
								<input type=button class='btn btn-success' value=Cancel onclick=self.history.back()>
								<input type=hidden name=jlhkriteria value='$jlhkriteria'>
							</td>
						</tr>
				</table>";
		
		echo 	"</form>";
	}
    break;
}
?>
