<?php
include "../config/koneksi.php";

$kriteria = "
CREATE TABLE IF NOT EXISTS kriteria(
id_kriteria INT(11) NOT NULL AUTO_INCREMENT,
nama_kriteria VARCHAR(100) NOT NULL,

PRIMARY KEY (id_kriteria))";
$query = mysql_query($kriteria);
if ($query !== TRUE) {
	echo "<h3 style='color: red;'>ERROR: cannot create kriteria table</h3>"; 
} else {
	echo "<h3>table kriteria is created</h3>"; 
}
/*---------------------------------------------------------------------*/

$bobot_kriteria = "
CREATE TABLE IF NOT EXISTS bobot_kriteria (
id_kriteria INT(11) NOT NULL,
nama_kriteria VARCHAR(100) NOT NULL,
bobot FLOAT NOT NULL,

FOREIGN KEY (id_kriteria) REFERENCES kriteria(id_kriteria) on delete cascade on update cascade)";
$query = mysql_query($bobot_kriteria);
if ($query === TRUE) {
	echo "<h3>bobot_kriteria table is created</h3>"; 
} else {
	echo "<h3 style='color: red;'>ERROR: bobot_kriteria table NOT created </h3>"; 
}

/*---------------------------------------------------------------------*/

$evaluasi = "
CREATE TABLE IF NOT EXISTS evaluasi(
id INT(11) NOT NULL AUTO_INCREMENT,
nip INT(11) NOT NULL,
id_kriteria INT(11) NOT NULL,
nilai INT(11) NOT NULL,

PRIMARY KEY (id),
FOREIGN KEY (id_kriteria) REFERENCES kriteria(id_kriteria) on delete cascade on update cascade,
FOREIGN KEY (nip) REFERENCES karyawan(nip) on delete cascade on update cascade)";
$query = mysql_query($evaluasi);
if ($query !== TRUE) {
	echo "<h3 style='color: red;'>ERROR: cannot create evaluasi table</h3>"; 
} else {
	echo "<h3>table evaluasi is created</h3>"; 
}

/*---------------------------------------------------------------------*/
$hasil_evaluasi = "
CREATE TABLE IF NOT EXISTS hasil_evaluasi(
nip INT(11) NOT NULL,
total_nilai FLOAT NOT NULL,
datemade DATETIME NOT NULL,

FOREIGN KEY (nip) REFERENCES karyawan(nip) on delete cascade on update cascade)";
$query = mysql_query($hasil_evaluasi);
if ($query !== TRUE) {
	echo "<h3 style='color: red;'>ERROR: cannot create hasil_evaluasi table</h3>"; 
} else {
	echo "<h3>table hasil_evaluasi is created</h3>"; 
}


/*---------------------------------------------------------------------*/
$previous_calculation = "
CREATE TABLE IF NOT EXISTS previous_calculation(
nip INT(11) NOT NULL,
total_nilai FLOAT NOT NULL,
datemade DATETIME NOT NULL,

FOREIGN KEY (nip) REFERENCES karyawan(nip) on delete cascade on update cascade)";
$query = mysql_query($previous_calculation);
if ($query !== TRUE) {
	echo "<h3 style='color: red;'>ERROR: cannot create previous_calculation table</h3>"; 
} else {
	echo "<h3>table previous_calculation is created</h3>"; 
}


/*---------------------------------------------------------------------*/
$karyawan = "
CREATE TABLE IF NOT EXISTS karyawan (
nip INT(11) NOT NULL AUTO_INCREMENT,
nama_karyawan VARCHAR(30) NOT NULL,
jabatan VARCHAR(30) NOT NULL,
divisi VARCHAR(30) NOT NULL,
alamat VARCHAR(100) NOT NULL,
telp VARCHAR(30) NOT NULL,
reg_date DATETIME NOT NULL,

PRIMARY KEY (nip))";
$query = mysql_query($karyawan);
if ($query !== TRUE) {
	echo "<h3 style='color: red;'>ERROR: cannot create karyawan table</h3>"; 
} else {
	echo "<h3>table karyawan is created</h3>"; 
}


/*---------------------------------------------------------------------*/
$konsistensi = "
CREATE TABLE IF NOT EXISTS konsistensi(
cr FLOAT NOT NULL)";
$query = mysql_query($konsistensi);
if ($query !== TRUE) {
	echo "<h3 style='color: red;'>ERROR: cannot create konsistensi table</h3>"; 
} else {
	echo "<h3>table konsistensi is created</h3>"; 
}


/*---------------------------------------------------------------------*/
$matrik_kriteria = "
CREATE TABLE IF NOT EXISTS matrik_kriteria ( 
indeks INT(11) NOT NULL AUTO_INCREMENT,
id_kriteria INT(11) NOT NULL,
id_bandingan INT(11) NOT NULL,
nilai FLOAT NOT NULL,

PRIMARY KEY (indeks),
FOREIGN KEY (id_kriteria) REFERENCES kriteria(id_kriteria) on delete cascade on update cascade)"; 
$query = mysql_query($matrik_kriteria); 
if ($query === TRUE) {
	echo "<h3>table matrik_kriteria is created</h3>"; 
} else {
	echo "<h3 style='color: red;'>ERROR: matrik_kriteria table NOT created</h3>"; 
}


/*---------------------------------------------------------------------*/
$matrik_normalisasi_kriteria = "
CREATE TABLE IF NOT EXISTS matrik_normalisasi_kriteria ( 
indeks INT(11) NOT NULL AUTO_INCREMENT,
id_kriteria INT(11) NOT NULL,
id_bandingan INT(11) NOT NULL,
nilai FLOAT NOT NULL,

PRIMARY KEY (indeks),
FOREIGN KEY (id_kriteria) REFERENCES kriteria(id_kriteria) on delete cascade on update cascade)"; 
$query = mysql_query($matrik_normalisasi_kriteria); 
if ($query === TRUE) {
	echo "<h3>table matrik_normalisasi_kriteria is created</h3>"; 
} else {
	echo "<h3 style='color: red;'>ERROR: matrik_normalisasi_kriteria table NOT created</h3>"; 
}


/*---------------------------------------------------------------------*/
$menu = "
CREATE TABLE IF NOT EXISTS menu ( 
menu VARCHAR(30) NOT NULL,
link VARCHAR(50) NOT NULL,
status ENUM('admin','user') NOT NULL,
aktif ENUM('y','n') NOT NULL,
urutan INT(5) NOT NULL)"; 
$query = mysql_query($menu); 
if ($query === TRUE) {
	echo "<h3>table menu is created</h3>"; 
} else {
	echo "<h3 style='color: red;'>ERROR: menu table NOT created</h3>"; 
}


/*---------------------------------------------------------------------*/
$pengguna = "
CREATE TABLE IF NOT EXISTS pengguna ( 
nip INT(11) NOT NULL,
username VARCHAR(10) NOT NULL,
password VARCHAR(50) NOT NULL,
level ENUM('admin','user') NOT NULL DEFAULT 'user',

PRIMARY KEY (username),
FOREIGN KEY (nip) REFERENCES karyawan(nip) on delete cascade on update cascade)"; 
$query = mysql_query($pengguna); 
if ($query === TRUE) {
	echo "<h3>table pengguna is created</h3>"; 
} else {
	echo "<h3 style='color: red;'>ERROR: pengguna table NOT created</h3>"; 
}

?>
