<?php
	if(isset($_GET['url']) && isset($_GET['titre'])){
    	$url=$_GET['url'];
    	$titre=$_GET['titre'];

    	$buffer = '';
		if($file = fopen ($url, "r")) {
	    	while (!feof($file)) {
	        	$buffer .= fgets($file, 4096);
	    	}
	    	fclose ($file);
		}
		$taille = strlen($buffer);
		echo($taille);

    	
		header('Content-Type: application/octet-stream');
		header('Content-Length: '. $taille);
		header('Content-disposition: attachment; filename='."$titre".".mp3");
		header('Pragma: no-cache');
		header('Cache-Control: no-store, no-cache, must-revalidate, post-check=0, pre-check=0');
		header('Expires: 0');
		readfile($url);
	}
?>