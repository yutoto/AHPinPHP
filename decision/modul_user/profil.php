<?php
$aksi="modul_user/aksi_profil.php";
$edit=mysql_query("SELECT k.nip,k.nama_karyawan,k.jabatan,k.divisi,k.alamat,k.telp,p.username,p.password
                  FROM karyawan k, pengguna p 
				  WHERE p.username='$_SESSION[namauser]' AND p.nip=k.nip
				  ");
$r=mysql_fetch_array($edit);

    echo "<h2>Edit Profile</h2>
          <form method=POST action=$aksi?modul=profil&act=update>
          <input type=hidden name=id value='$r[nip]'><input type=hidden name=id1 value='$r[username]'>
          <table class='table table-bordered'>
		  <tr><td>ID</td> <td> <input type=text class='form-control' readonly name='nip' size=30 value='$r[nip]'></td></tr>
          <tr><td>Name</td> <td>  <input type=text class='form-control' name='nama_karyawan' size=30  value='$r[nama_karyawan]'></td></tr>
		  <tr><td>Position</td> <td>  <input type=text class='form-control' name='jabatan' size=30 value='$r[jabatan]'></td></tr>
          <tr><td>Division</td>       <td> <input type=text class='form-control' name='divisi' size=30 value='$r[divisi]'></td></tr>
          <tr><td>Adress</td>   <td> <input type=text class='form-control' name='alamat' size=30 value='$r[alamat]'></td></tr>
		  <tr><td>Phone</td>   <td> <input type=text class='form-control' name='telp' size=30 value='$r[telp]'></td></tr>
		  <tr><td>Username</td>     <td> <input type=text class='form-control' readonly name='username' value='$r[username]'></td></tr>
          <tr><td>Password</td>     <td> <input type=text class='form-control' name='password'></td></tr>";
    
    echo "<tr><td colspan=2>*) If you don't want to change the password, just please left it blank.</td></tr>
          <tr><td colspan=2><input type=submit class='btn btn-success' value=Update>
                            <input type=button class='btn btn-success' value=Cancel onclick=self.history.back()></td></tr>
          </table></form>";
?>

