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

	if($_POST["version"] == "spark"){
		$dataset = $_POST["dataset"];

		exec("chmod a+rwx /home/maaz/Desktop/Web/casper/exec_server/script_spark.sh");

		if($dataset == "yelp"){
			exec("cp /home/maaz/Desktop/Web/casper/exec_server/run_spark_yelp.sh /home/maaz/Desktop/Web/casper/exec_server/script_spark.sh");
		}
		else if($dataset == "wc"){
			exec("cp /home/maaz/Desktop/Web/casper/exec_server/run_spark_wc.sh /home/maaz/Desktop/Web/casper/exec_server/script_spark.sh");
		}
		else if($dataset == "hist"){
			exec("cp /home/maaz/Desktop/Web/casper/exec_server/run_spark_hist.sh /home/maaz/Desktop/Web/casper/exec_server/script_spark.sh");
		}

		$process = new Process("/home/maaz/Desktop/Web/casper/exec_server/php_root_spark");
		
		// Wait for process to finish
		while($process->status()){
			usleep(50000);
		}

		// Read output
		$output = file_get_contents("/home/maaz/Desktop/Web/casper/exec_server/output_spark.txt");
		header('Content-type: application/json');
		$response = array();
		$response["output"] = $output;
		echo json_encode($response);
	}
	else{
		$dataset = $_POST["dataset"];

		exec("chmod a+rwx /home/maaz/Desktop/Web/casper/exec_server/script_seq.sh");

		if($dataset == "yelp"){
			exec("cp /home/maaz/Desktop/Web/casper/exec_server/run_seq_yelp.sh /home/maaz/Desktop/Web/casper/exec_server/script_seq.sh");
		}
		else if($dataset == "wc"){
			exec("cp /home/maaz/Desktop/Web/casper/exec_server/run_seq_wc.sh /home/maaz/Desktop/Web/casper/exec_server/script_seq.sh");
		}
		else if($dataset == "hist"){
			exec("cp /home/maaz/Desktop/Web/casper/exec_server/run_seq_hist.sh /home/maaz/Desktop/Web/casper/exec_server/script_seq.sh");
		}

		$process = new Process("/home/maaz/Desktop/Web/casper/exec_server/php_root_seq");
		
		// Wait for process to finish
		while($process->status()){
			usleep(50000);
		}

		// Read output
		$output = file_get_contents("/home/maaz/Desktop/Web/casper/exec_server/output_seq.txt");
		header('Content-type: application/json');
		$response = array();
		$response["output"] = $output;
		echo json_encode($response);
	}
?>
