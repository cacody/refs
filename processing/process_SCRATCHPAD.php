<?php


// Creates new associative array using extractions array and 
// associated answers to the bone graft question and sinus closure question.
function extractCombo() {
	$extractions_array = $_POST['extractions'];
	foreach($extractions_array as $value) {
		$graft_val = $_POST["graft$value"];
		$closure_val = $_POST["closure$value"];
	 	$new[] = array('tooth' => $value, 'graft' => $graft_val, 'closure' => $closure_val);
	 }
	return $new;
}

// Have to call this function to get access to new array. 
$data = extractCombo();

// OPS - we should implode the results of the foreach below for presenting
// in the PDF-ized html. 



// ********************* this stuff is just for development
// comment it out for prod
// echo '<pre>'; print_r($_POST); exit();
echo '<pre>'; print_r(extractCombo()); echo '</pre>';
echo '<hr>';
foreach($data as $key=>$value) {
	echo $data[$key]['tooth'] . 
		 "| Graft? " . $data[$key]['graft'] . 
		"| Closure? " . $data[$key]['closure'] . "<br>";
}


?>