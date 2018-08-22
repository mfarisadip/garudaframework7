*********************************************************************************
		            Untuk mengaktifkan SQLite3
*********************************************************************************

	- Jika anda menemukan error, 
	  "Fatal error: Uncaught Error: Class 'GF_SQLite' not found in...",
	  maka anda harus mengaktifkan extension pada "extension=php_sqlite3.dll" 
	  "php.ini" anda. Caranya :

	- Buka xampp , kemudian "config" pada bagian "apache", lalu pilih "php.ini",
	  kemudian cari "extension=php_sqlite3.dll" lalu hilangkan tanda ";" (petik koma)
	  tersebut. Lalu save

	- Terakhir, restart xampp anda. Selesai.

*********************************************************************************
		           Untuk mengaktifkan PostgreSQL
*********************************************************************************

	- Buka xampp , kemudian "config" pada bagian "apache", lalu pilih "php.ini",
	  kemudian cari "extension=php_pgsql.dll" lalu hilangkan tanda ";" (petik koma)
	  tersebut. Lalu save

	- Terakhir, restart xampp anda. Selesai.

*********************************************************************************