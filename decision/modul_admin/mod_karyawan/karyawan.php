<?php
$aksi="modul_admin/mod_karyawan/aksi_karyawan.php";
switch($_GET[act]){
  // Tampil Karyawan
  default:
    echo "<h2>Employee Data Management</h2>
          <input type=button class='btn btn-success' value='Add Employee' onclick=\"window.location.href='?modul=dtakary&act=tambah';\">
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
    $tampil=mysql_query("SELECT nip,nama_karyawan,jabatan,divisi FROM karyawan ORDER BY nip");
    while ($r=mysql_fetch_array($tampil)){
       echo "<tr>
             <td>$r[nip]</td>
             <td>$r[nama_karyawan]</td>
			 <td>$r[jabatan]</td>
			 <td>$r[divisi]</td>
		     <td><a href=?modul=dtakary&act=edit&id=$r[nip]>Edit</a> | 
	               <a href=$aksi?modul=dtakary&act=hapus&id=$r[nip]>Delete</a>
             </td></tr>";
      $no++;
    }
    echo "</table>";
    break;
  
  case "tambah":
    echo "<h2>Add Employee</h2>
          <form method=POST action='$aksi?modul=dtakary&act=input'>
         <table class='table table-bordered'>
          <tr><td>ID</td>     <td>  <input type=text class='form-control' name='nip'></td></tr>
          <tr><td>Name</td> <td>  <input type=text class='form-control' name='nama_karyawan' size=30></td></tr>
		  <tr><td>Position</td> <td> <input type=text class='form-control' name='jabatan' size=30></td></tr>
		  <tr><td>Division</td> <td>  <input type=text class='form-control' name='divisi' size=30></td></tr>  
          <tr><td>Adress</td>       <td>  <input type=text class='form-control' name='alamat' size=30></td></tr>
          <tr><td>Phone</td>   <td><input type=text class='form-control' name='telp' size=20></td></tr>
		  <tr><td>Username</td>   <td>  <input type=text class='form-control' name='username' size=20></td></tr>
		  <tr><td>Password</td>   <td> <input type=text class='form-control' type=password name='password' size=20></td></tr>
		  <tr><td colspan=2><input type=submit class='btn btn-success' value=Save>
                            <input type=button class='btn btn-success' value=Cancel onclick=self.history.back()></td></tr>
          </table></form>";
     break;
    
  case "edit":
    $edit=mysql_query("SELECT * FROM karyawan WHERE nip='$_GET[id]'");
    $r=mysql_fetch_array($edit);
	$edit1=mysql_query("SELECT * FROM pengguna WHERE nip='$_GET[id]'");
    $r1=mysql_fetch_array($edit1);

    echo "<h2>Edit Employee</h2>
          <form method=POST action=$aksi?modul=dtakary&act=update>
          <input type=hidden name=id value='$r[nip]'><input type=hidden name=id1 value='$r1[username]'>
          <table class='table table-bordered'>
		  <tr><td>ID</td> <td> <input type=text class='form-control' readonly name='nip' size=30 value='$r[nip]'></td></tr>
          <tr><td>Name</td> <td>  <input type=text class='form-control' name='nama_karyawan' size=30  value='$r[nama_karyawan]'></td></tr>
		  <tr><td>Position</td> <td> <input type=text class='form-control' name='jabatan' size=30 value='$r[jabatan]'></td></tr>
          <tr><td>Division</td>       <td> <input type=text class='form-control' name='divisi' size=30 value='$r[divisi]'></td></tr>
          <tr><td>Adress</td>   <td> <input type=text class='form-control' name='alamat' size=30 value='$r[alamat]'></td></tr>
		  <tr><td>Phone</td>   <td> <input type=text class='form-control' name='telp' size=30 value='$r[telp]'></td></tr>
		  <tr><td>Username</td>     <td> <input type=text class='form-control' readonly name='username' value='$r1[username]'></td></tr>
          <tr><td>Password</td>     <td>  <input type=text class='form-control' name='password'></td></tr>";

    if ($r1[level]=='admin'){
      echo "<tr><td>Level</td>     <td> : <input type=radio name='level' value='admin' checked> Admin   
                                           <input type=radio name='level' value='user'> User </td></tr>";
    }
    else{
      echo "<tr><td>Level</td>     <td> : <input type=radio name='level' value='admin'> Admin  
                                           <input type=radio name='level' value='user' checked> User </td></tr>";
    }
    
    echo "<tr><td colspan=2>*) If you don't want to change the password, just please left it blank.</td></tr>
          <tr><td colspan=2><input class='btn btn-success' type=submit value=Update>
                            <input class='btn btn-success' type=button value=Cancel onclick=self.history.back()></td></tr>
          </table></form>";
    break;  
}
?>
