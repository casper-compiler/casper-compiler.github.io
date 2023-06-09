<?php

	error_reporting(E_ALL);
	ini_set('display_errors', 'on');

	class Process{
		private $pid;
		private $command;

		public function __construct($cl=false){
		    if ($cl != false){
		        $this->command = $cl;
		        $this->runCom();
		    }
		}
		private function runCom(){
		    $command = 'nohup '.$this->command.' & echo $!';
		    exec($command ,$op);
		    $this->pid = (int)$op[0];
		}

		public function setPid($pid){
		    $this->pid = $pid;
		}

		public function getPid(){
		    return $this->pid;
		}

		public function status(){
		    $command = 'ps -p '.$this->pid;
		    exec($command,$op);
		    if (!isset($op[1]))return false;
		    else return true;
		}

		public function start(){
		    if ($this->command != '')$this->runCom();
		    else return true;
		}

		public function stop(){
		    $command = 'kill '.$this->pid;
		    exec($command);
		    if ($this->status() == false)return true;
		    else return false;
		}
	}

	$logfile = "/home/maaz/Desktop/Web/casper/server/log.txt";

	// If this is the start of a new job
	$pid = $_POST["pid"];
	$process = null;
	if($pid == "-1"){
		// Write input code to file
		$javaCode = $_POST["javaCode"];
		$fh = fopen ("/home/maaz/Desktop/Web/casper/server/tempCode.java","w");
		fwrite($fh, $javaCode);
		fclose($fh);

		// Fix file permissions
		exec("chmod a+rwx /home/maaz/Desktop/Web/casper/server/tempCode.java");

		exec("chmod a+rwx /home/maaz/Desktop/Web/casper/server/script.sh");

		$benchmark = $_POST["benchmark"];
		if($benchmark == "yelp" || $benchmark == "score"){
			exec("cp /home/maaz/Desktop/Web/casper/server/script_yelp.sh /home/maaz/Desktop/Web/casper/server/script.sh");
		}
		else if($benchmark == "wordcount"){
			exec("cp /home/maaz/Desktop/Web/casper/server/script_wc.sh /home/maaz/Desktop/Web/casper/server/script.sh");
		}
		else if($benchmark == "histogram"){
			exec("cp /home/maaz/Desktop/Web/casper/server/script_hist.sh /home/maaz/Desktop/Web/casper/server/script.sh");
		}

		// Execute Casper
		$cmd = "/home/maaz/Desktop/Web/casper/server/php_root";
		$process = new Process(sprintf("%s > %s 2>&1", $cmd, $logfile));
		$pid = $process->getPid();
	}
	else{
		$process = new Process();
		$process->setPid($pid);
	}

	$lastmodif = isset($_POST['timestamp']) ? $_POST['timestamp'] : 0;
	$currentmodif = filemtime($logfile);
	
	while($currentmodif <= $lastmodif && $process->status()){
		usleep(500000);		
		clearstatcache();
		$currentmodif = filemtime($logfile);
	}

	$logText = file_get_contents($logfile);

	if($process->status()){
		header('Content-type: application/json');
		$response = array();
		$response["consoleLog"] = $logText;
		$response["pid"] = $pid;
		$response["timestamp"] = $currentmodif;
		$response["sparkCode"] = "";
		$response["finished"] = "false";
		echo json_encode($response);
	}
	else{
		$genCode = file_get_contents("/home/maaz/Desktop/Web/casper/server/tempOutput.java");

		header('Content-type: application/json');
		$response = array();
		$response["consoleLog"] = $logText;
		$response["pid"] = $pid;
		$response["timestamp"] = $currentmodif;
		$response["sparkCode"] = $genCode;
		$response["finished"] = "true";
		echo json_encode($response);
	}	
?>
