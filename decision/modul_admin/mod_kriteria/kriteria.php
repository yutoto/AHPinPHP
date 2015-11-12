<?php
$aksi="modul_admin/mod_kriteria/aksi_kriteria.php";
switch($_GET[act]){
  // Tampil Kriteria
  default:
    echo "<h2>Assessment Criteria Management</h2>
          <input type=button class='btn btn-success' value='Add Criteria' 
          onclick=\"window.location.href='?modul=kriteria&act=tambah';\">
          <table class='table table-bordered' id='datatable'><thead>
          <tr><th>id</th><th>criteria</th><th>action</th></tr></thead>"; 
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
    $tampil=mysql_query("SELECT * FROM kriteria ORDER BY id_kriteria ASC");
    while ($r=mysql_fetch_array($tampil)){
       echo "<tr><td>$r[id_kriteria]</td>
             <td>$r[nama_kriteria]</td>
             <td><a href=?modul=kriteria&act=edit&id=$r[id_kriteria]>Edit</a> | 
	               <a href=$aksi?modul=kriteria&act=hapus&id=$r[id_kriteria]>Delete</a>
             </td></tr>";
    }
    echo "</table>";
	
    break;
  
  // Form Tambah Kategori
  case "tambah":
    echo "<h2>Add Criteria</h2>
          <form method=POST action='$aksi?modul=kriteria&act=input'>
          <table class='table table-bordered'>
          <tr><td>Id</td><td>  <input type=text class='form-control' name='id_kriteria'></td></tr>
		  <tr><td>Criteria</td><td>  <input type=text class='form-control' name='nama_kriteria'></td></tr>
          <tr><td colspan=2><input type=submit class='btn btn-success' name=submit value=Save>
                            <input type=button class='btn btn-success' value=Cancel onclick=self.history.back()></td></tr>
          </table></form>";
     break;
  
  // Form Edit Kategori  
  case "edit":
    $edit=mysql_query("SELECT * FROM kriteria WHERE id_kriteria='$_GET[id]'");
    $r=mysql_fetch_array($edit);

    echo "<h2>Edit Criteria</h2>
          <form method=POST action=$aksi?modul=kriteria&act=update>
          <input type=hidden name=id value='$r[id_kriteria]'>
          <table class='table table-bordered'>
          <tr><td>Id</td><td><input type=text readonly class='form-control' name='id_kriteria' value='$r[id_kriteria]'></td></tr>
		  <tr><td>Criteria</td><td><input type=text class='form-control' name='nama_kriteria' value='$r[nama_kriteria]'></td></tr>
          <tr><td colspan=2><input type=submit class='btn btn-success' value=Update>
                            <input type=button class='btn btn-success' value=Cancel onclick=self.history.back()></td></tr>
          </table></form>";
    break;  
}
?>

