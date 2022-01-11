<?php

//////////////////////////////////////////////////////////////////////////
// Gibt alle Dateien innerhalb eines Ordnerpfades aus.
// Die erzeugte Datei kann verwendet werden,
// um anschließend mit Hilfe von glodl.php die Dateien
// herunterzuladen.
// glodl.php muss dabei auf dem Rechner ausgeführt werden,
// der die Daten empfangen soll.
// Die Daten werden als HTTP Downloads heruntergeladen.
//////////////////////////////////////////////////////////////////////////

if(!isset($_GET['path'])) {
		$path = $_SERVER['DOCUMENT_ROOT'];
		echo 'using path: ' . $path . "\n\n---\n";
} else {
		$path = $_GET['path'];
}

$imagesList = array();

foreach (new RecursiveIteratorIterator(new RecursiveDirectoryIterator($path . '/glodownload')) as $filename) {
    if ($filename->isDir()) continue;
    	$file = str_replace("\\","/",$filename->getPathname());
				
		echo $file;
		echo "\n";
}

//echo json_encode($imagesList, JSON_PRETTY_PRINT);
echo 'done';
die;