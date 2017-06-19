<?php

	 //$line= $exportEmployee[0]['Employee'];
	 //$this->CSV->addRow(array_keys($line));
	
	$resultArray = array();
	foreach ($exportEmployee as $emp)
	{
	    //$line = $emp[0];
	    // $data = json_decode($emp, TRUE);
	    // $this->CSV->addRow($emp);	 
	    // array_push($resultArray, $emp);   
	    $resultArray[] = $emp;
	}
	$data = json_encode($resultArray);
	
	$jsonDecoded = json_decode($data, true);
	
	$this->CSV->addRow($jsonDecoded);

	$filename='DownloadedEmployee';
	echo  $this->CSV->render($filename);

?>