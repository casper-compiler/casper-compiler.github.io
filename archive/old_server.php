<?php
	// Get java code from POST request 
	$javaCode = $_POST["javaCode"]; 

	// Write input code to file 
	$fh = fopen ("/home/maaz/Desktop/Web/casper/tempCode.java","w");
	fwrite($fh, $javaCode);
	fclose($fh);
	exec("chmod a+rwx /home/maaz/Desktop/Web/casper/tempCode.java");

	$log = shell_exec("/home/maaz/Desktop/Web/casper/php_root 2>&1");
	
	$fhOut = file_get_contents("/home/maaz/Desktop/Web/casper/tempOutput.java");

	// output in JSON format 
	header('Content-type: application/json');
	$response = array();
	$response["consoleLog"] = $log;
	$response["sparkCode"] = $fhOut;
	echo json_encode($response);
?>
