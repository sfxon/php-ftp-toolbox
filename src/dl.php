<?php

//////////////////////////////////////////////////////////////////////////
// Copies a file by its name to another server by using curl ftp.
// Part of the dlstart tool, which is a complete downloader.
// See dlstart.php for more information.
// Parameters:
// 	POST['filename'] -> filename of the file
//////////////////////////////////////////////////////////////////////////

define('ALLOW_GET_CONFIG', false);		// if true, it is possible to use get params for the ftp config.

// Get ftp configuration
if(isset($_GET['host']) && isset($_GET['user']) && isset($_GET['pass']) && ALLOW_GET_CONFIG) {
	define('DOWNLOAD_FTP_HOST', $_GET['host']);
	define('DOWNLOAD_FTP_USER', $_GET['user']);
	define('DOWNLOAD_FTP_PASS', $_GET['pass']);
} else {
	if(file_exists('dlconf.php')) {
		require_once('dlconf.php');
	} else {
		die('no ftp config found');
	}
}

$path = "";

// Can be used, to get the root path. (Little helper)
if(isset($_GET['path'])) {
		var_dump($_SERVER['DOCUMENT_ROOT']);
		die;
}

// Wenn der Parameter nicht gesetzt ist, Verarbeitung abbrechen.
if(!isset($_POST['filename'])) {
		die('Es wurde kein Dateiname angegeben.');
}

// Wenn der Parameter gesetzt ist, übernehmen
$path = $_POST['filename'];

// Wenn kein Dateiname angegeben wurde..
if($path === "") {
	$files = get_files_json($path);
	echo $files;
	die;
}	

// Wenn es sich um ein Verzeichnis handelt -> Inhalt des Verzeichnisses auflisten (außer . und ..)
if(is_dir($path)) {
		$files = get_files_json($path);
		echo $files;
		die;
}

// Wenn es sich um eine Datei handelt, die Datei übertragen
if(is_file($path)) {
		get_the_file($path);
}

die;

///////////////////////////////////////////////////////
// Ordnerstruktur abrufen
///////////////////////////////////////////////////////
function get_files_json($path) {
		$files = scandir($path);
		
		$retfiles = array();
		
		foreach($files as $file) {
				if($file != '.' && $file != '..') {
						$retfiles[] = $path . '/' . ($file);
				}
		}
		
		$files = json_encode($retfiles, JSON_PRETTY_PRINT);
		return $files;
}

///////////////////////////////////////////////////////
// Datei übertragen
///////////////////////////////////////////////////////
function get_the_file($localfile) {
		$dst_host = DOWNLOAD_FTP_HOST;
		$dst_path = 'ftp://' . $dst_host . '/' . $localfile;
		
		$dst_path = str_replace(' ', '%20', $dst_path);	//Escape Spaces in filenames, or the files will fail.
		
		$ch = curl_init();
    $fp = fopen($localfile, 'r');
		
    curl_setopt($ch, CURLOPT_URL, $dst_path);
    curl_setopt($ch, CURLOPT_USERPWD, DOWNLOAD_FTP_USER . ':' . DOWNLOAD_FTP_PASS);
    curl_setopt($ch, CURLOPT_UPLOAD, 1);
    curl_setopt($ch, CURLOPT_INFILE, $fp);
    curl_setopt($ch, CURLOPT_INFILESIZE, filesize($localfile));
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
		curl_setopt($ch, CURLOPT_FTP_CREATE_MISSING_DIRS, true);
    curl_exec ($ch);
    $error_no = curl_errno($ch);
		$curl_err = curl_error($ch);
    curl_close ($ch);
		
		if ($error_no == 0) {
				$error = 'file done';
				echo $error;
				die;
		} else {
				$error = 'File upload error.';
				var_dump($error_no);
				echo 'Dateiname: ';
				var_dump($localfile);
				echo $error;
				
				var_dump($curl_err);
				die;
		}
}