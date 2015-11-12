<?php
include "config/koneksi.php";
include "config/fungsi_indotgl.php";
ini_set('display_errors', 1); ini_set('error_reporting', E_ERROR);
// Home page
if ($_GET[modul]=='beranda'){
  echo "<h2>Welcome</h2>
          <p>Hi <b>$_SESSION[namauser]</b>, welcome to the ";
  if ($_SESSION[leveluser] == 'admin') { echo "<b>Administrator</b>"; }
  else { echo "<b>User</b>"; } 
  echo "  page of DSS for Employee Assessment.<br>
		   Please use the left panels to access the module you want to use. </p>
          <p>&nbsp;</p>
          <p>&nbsp;</p>
          <p>&nbsp;</p>
          <p>&nbsp;</p>
          <p align=right>Login Today: ";
  echo tgl_indo(date("Y m d")); 
  echo " | "; 
  echo date("H:i:s");
  echo "</p>";
}

// User page
elseif ($_GET[modul]=='dtakary'){
  include "modul_admin/mod_karyawan/karyawan.php";
}

// Modul part
elseif ($_GET[modul]=='kriteria'){
  include "modul_admin/mod_kriteria/kriteria.php";
}

// Weight of Criteria part
elseif ($_GET[modul]=='bobot'){
  include "modul_admin/mod_bobot/matrik.php";
  mysql_query("DELETE FROM hasil_evaluasi"); 
}

// Employee Evaluation part
elseif ($_GET[modul]=='evaluasi'){
  include "modul_admin/mod_evaluasi/evaluasi.php";
}

// Employee Evaluation Report part
elseif ($_GET[modul]=='laporan'){
  include "modul_admin/mod_laporan/laporan.php";
}

// Previous Employee Evaluation Report part
elseif ($_GET[modul]=='previous_evaluations'){
  include "modul_admin/mod_laporan/previous_evaluations.php";
}

// View Evaluation part
elseif ($_GET[modul]=='view_evaluation'){
  include "modul_admin/mod_laporan/veiw_evaluation.php";
}

// Help part
elseif ($_GET[modul]=='bantuan'){
  include "bantuan.php";
}

// About The System part
elseif ($_GET[modul]=='tentang'){
  include "tentang.php";
}

// User Result part
elseif ($_GET[modul]=='hasil'){
  include "modul_admin/mod_laporan/laporan.php";
}

// User Profile part
elseif ($_GET[modul]=='profil'){
  include "modul_user/profil.php";
}

// If modules can't be found
else{
  echo "<p><b>MODUL HASN'T BEEN CREATED</b></p>";
}


?>
