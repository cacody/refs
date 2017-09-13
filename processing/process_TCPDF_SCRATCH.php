<?php
//make checkboxes into lists



// need to match these to new omfs form elements
//$fieldofview_list = implode('<br>', $_POST['fieldofview']);
//$reasonforscan_list = implode('<br>', $_POST['reasonforscan']);
//$scanoptions_list = implode('<br>', $_POST['scanoptions']);
//$imageoutput_list = implode('<br>', $_POST['imageoutput']);

$extractions_list = implode('<br>', $_POST['extractions']); // First-pass extractions array 
$tooth_selection_upper_img = '<img src="images/oms/teeth1.png" style="width:300px;height:auto;">';
$tooth_selection_lower_img = '<img src="images/oms/teeth2.png" style="width:300px;height:auto;">';
$uploadType = $_POST['uploadType']; // Type of Panorex?, Bitewing?, etc.



// EXTRACTIONS PROCESSING-----------------------------------------------------

	// Creates new associative array using extractions array and 
	//   ties the checkbox selected with the followup questions
function extractCombo() {
	$extractions_array = $_POST['extractions'];
	foreach($extractions_array as $value) {
		$graft_val = $_POST["graft$value"];
		$closure_val = $_POST["closure$value"];
	 	$new[] = array('tooth' => $value, 
					   'graft' => $graft_val, 
					   'closure' => $closure_val);
	 }
	return $new;
}

	// Setting the created extractions array to a variable. Easier to work with.  
$extractionData = extractCombo();
	// Format the extraction data for output to the PDF
function process_extractions() {
	global $extractionData;
	$result = '';
	foreach($extractionData as $key=>$value) {
		$result .= '#'.
		$extractionData[$key]['tooth'] . 
		'| Graft? ' . $extractionData[$key]['graft'] . 
		'| Closure? ' . $extractionData[$key]['closure'] . '<br>';
	}
	return $result;
}
	// Set formatted extractions to a variable for printing 
	// in HEREDOC (<<<htmleoq) below
$extraction_results = 'process_extractions'; // lets us use a function in heredoc


// END EXTRACTIONS PROCESSING---------------------------------------------------



// ORTHO EXTRACTIONS PROCESSING-------------------------------------------------

function orthoCombo() {
	$ortho_extractions_array = $_POST['ortho_extractions'];
	foreach($ortho_extractions_array as $value) {
		$exposure_val = $_POST["ortho_exposure$value"];
		$technique_val = $_POST["ortho_technique$value"];
	 	$new[] = array('tooth' => $value, 
					   'exposure' => $exposure_val, 
					   'technique' => $technique_val);
	 }
	return $new;
}
$orthoData = orthoCombo();

function process_ortho_extractions() {
	global $orthoData;
	$result = '';
	foreach($orthoData as $key=>$value) {
		$result .= '<tr>' . 
		'<td width="20%">#'. $orthoData[$key]['tooth'] . '</td>' .
		'<td>' . $orthoData[$key]['exposure'] . '</td>' .
		'<td>' . $orthoData[$key]['technique'] . '</td>' .
		'</tr>';
	}
	return $result;
}

$ortho_results = 'process_ortho_extractions';
$ortho_extractions_list = implode('<br>', $_POST['ortho_extractions']); // First-pass extractions array


// END ORTHO EXTRACTIONS PROCESSING---------------------------------------------



$implants_list = implode('<br>', $_POST['implants']); 

function implantCombo() {
	$implants_array = $_POST['implants'];
	foreach($implants_array as $value) {
		//$exposure_val = $_POST["ortho_exposure$value"];
		//$technique_val = $_POST["ortho_technique$value"];
	 	$new[] = array('tooth' => $value);
	 }
	return $new;
}
$implantData = implantCombo();

function process_implants() {
	global $implantData;
	$result = '';
	foreach($implantData as $key=>$value) {
		$result .= '#'.
		$implantData[$key]['tooth'] . '<br>';
	}
	return $result;
}

$implant_results = 'process_implants';








$pdffilepath = '/Users/cacody-admin/Development/referrals-dev/referrals/';
$pdffilename = "omfs_$patientlastname" .
	           "_$patientfirstname" . 
	           "_" .date('Y-m-d-His').'.pdf';
$email_path = 'https://referrals-dev/referrals/'.$pdffilename;


// this is the dev upload method before we hid that form element
// gonna keep it as a reference for now
$upload_dir = "/Users/cacody-admin/Development/referrals-dev/upload/";
$url_upload_dir = '/Users/cacody-admin/Development/referrals-dev/upload/';
$supporting_doc_html = '';
//if (is_uploaded_file( $_FILES["referralfile"]["tmp_name"]) ) {
//	move_uploaded_file($_FILES["referralfile"]["tmp_name"], $upload_dir.$_FILES["referralfile"]["name"]);
//	$supporting_doc_html = '<a href="'.$url_upload_dir.$_FILES["referralfile"]["name"].'">Supporting File</a>';
//}

$htmlout = <<<htmleoq
<br><br><br><br><br>
<table class="table" cellspacing="0" cellpadding="1" border="0">
<tbody>
	<tr>
		<td>
		
			<h3>Referred By</h3>
			<hr>
			<p>
				<strong>{$doctorfirstname} {$doctorlastname}</strong> (NPI: {$doctornpi})<br>
				{$practicename}<br>
				{$address}<br>
				{$city}, {$state} {$zipcode}<br>
				{$email}<br>
				<strong>{$doctorphone}</strong><br>
				
	
			</p>
		</td>
		<td>
		
			<h3>Patient</h3>
			<hr>
			<p>
			<strong>{$patientfirstname} {$patientlastname}</strong><br>
			DOB: {$dob}<br>
			<strong>{$patientphone}</strong><br>
			
			</p>
		</td>
	</tr>
</tbody>
</table>


	<hr>
	




<h4>Options</h4>
<table class="table" cellspacing="0" cellpadding="5" border="1">
<tbody>
	<tr>
		<th>Upload Type</th>
		<td>{$uploadType}</td>
	</tr>
	<tr><td colspan="2" bgcolor="#0000FF" color="yellow"><strong>EXTRACTIONS</strong></td></tr>
	<tr>
		<td width="60%">{$tooth_selection_upper_img}<br>{$tooth_selection_lower_img}</td>
	    <td width="40%">{$extraction_results()}</td>
	</tr>
	<tr><td colspan="2" bgcolor="#0000FF" color="yellow"><strong>ORTHO EXTRACTIONS</strong></td></tr>
	<tr>
		<td>{$tooth_selection_upper_img}<br>{$tooth_selection_lower_img}</td>
	    <td><table class="subtable">
				<tbody>
				<tr>
					<td width="20%">Tooth</td>
					<td>Exposure</td>
					<td>Technique</td>
				</tr>{$ortho_results()}
				</tbody>
			</table>
		</td>
	</tr>
	<tr><td colspan="2" bgcolor="#0000FF" color="yellow"><strong>IMPLANTS</strong></td></tr>
	<tr>
		<td>{$tooth_selection_upper_img}<br>{$tooth_selection_lower_img}</td>
	    <td>{$implant_results()}</td>
	</tr>
</tbody>
</table>


<style>
.table {
    border-collapse: collapse !important;
    border-width:0;
    border-color:#fff;
}
.table {
  /*width: 100%;*/
  margin-bottom: 20px;
}
.table thead > tr > th,
.table tbody > tr > th,
.table tfoot > tr > th,
.table thead > tr > td,
.table tbody > tr > td,
.table tfoot > tr > td {
  padding: 8px;
  line-height: 1.428571429;
  vertical-align: top;
  border:none;
  text-align: left !important;
}

.subtable {
	font-size:24px;
}

.table table tbody tr:nth-child(odd) {
   background-color: #ddd;
}

</style>

htmleoq;

//echo $htmlout;


/************************************************ Create PDF ******************/

class MYPDF extends TCPDF {

    //Page header
    public function Header() {
        // Logo
		$image_file = K_PATH_IMAGES.'signature-marketing_whitebg_40.png';
        $this->Image($image_file, PDF_MARGIN_LEFT, 10, 80, '', 'PNG', '', 'T', true, 300, '', false, false, 0, false, false, false);
		//Contact Info
	$contact_text = '<h1>Oral and Maxillofacial Surgery</h1><b>Brent B Ward, DDS, MD</b> <br />
	Section Head, Oral and Maxillofacial Surgery/Hospital Dentistry <br />
	Associate Professor, Oral and Maxillofacial Surgery/Hospital Dentistry <br />
	Directory, Oral/Head and Neck Oncology and Microvascular Reconstructive Surgery Fellowship Program <br />
	1011 N. University Avenue, Room 1340, Ann Arbor, MI 48104-1078 <br />
	Tel: 734-764-1568 Fax: 734-615-8399';
        $this->SetFont('helvetica', '', 8);
		$this->SetTextColor(50,50,50); //gray
        $this->writeHTMLCell(0, 0, '', '', $contact_text, 0, 1, 0, true, 'R', true);
    }

    // Page footer
    public function Footer() {
		global $pdffilename;
        $this->SetFont('helvetica', '', 8);
		//$this->SetTextColor(255,203,5); //maize
		$this->SetTextColor(0,39,76); //blue
		$this->SetXY(-50, -20);
        //$this->Cell(100, 20, $search_text, 0, false, 'R', 0, '', 0, false, 'M', 'M');
        $this->writeHTML("<em>$pdffilename</em>", true, false, true, false, '');
    }
}
/*  ----- This is for dev, uncomment lines below for prod ------- */

/*
$pdffilepath = '/www/mitools/assets/referrals/cbct/';
$pdffilename = 'cbct_'.date('YmdHis').'.pdf';
$email_path = 'https://referrals.dent.umich.edu/referrals/cbct/'.$pdffilename;
*/

$pdf = new MYPDF('P', PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
// set default header data
//$pdf->setPrintFooter(false);
$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
$pdf->AddPage();
$pdf->SetFont('helvetica', '', 10);
$pdf->writeHTML($htmlout, true, false, true, false, '');
$pdf->Output($pdffilepath.$pdffilename, 'F');


// OLD EMAIL OF LINK TO DEPT - REPLACING WITH EMAIL TO BOX OF PDF *************

/**$emailout = <<<htmleoq
	<p>A Cone Beam CT Referral Form has been filled out, it can be viewed at: <a href="{$email_path}">{$email_path}</a></p>
htmleoq;**/

/**$out_address = 'corincody@umich.edu';
$mail = new my_phpmailer;
	$mail->ClearAddresses();
	//$mail->AddAddress($out_address);
	$mail->AddAddress('cacody@umich.edu');
	$mail->Subject = "Cone Beam CT Referral Form";
	$mail->Body = $emaillout;
	$altbody = strip_tags($emailout);
	$mail->AltBody = $altbody;
	//$mail->Send();
**/

// SEND PDF OF FORM FIELDS TO BOX DIRECTORY ***********************************

//Create a new PHPMailer instance
$mail = new PHPMailer;
//Set who the message is to be sent from
$mail->setFrom('cacody@umich.edu', 'Corin Cody');
//Set an alternative reply-to address
$mail->addReplyTo('cacody@umich.edu', 'Corin Cody');
//Set who the message is to be sent to
$mail->addAddress('OMFS_DE.obvyimbylm2hpewu@u.box.com', 'John Doe');
//Set the subject line
$mail->Subject = 'PHPMailer mail() test';
//Read an HTML message body from an external file, 
// convert referenced images to embedded,
// convert HTML into a basic plain-text alternative body
//$mail->msgHTML(file_get_contents('../PHPMailer/examples/contents.html'), dirname(__FILE__));
//Replace the plain text body with one created manually
$mail->Body = 'This is a plain-text message body';
//Attach an image file
$mail->addAttachment($pdffilepath.$pdffilename);
//send the message, check for errors
if (!$mail->send()) {
    echo "Mailer Error: " . $mail->ErrorInfo;
} else {
    echo "Message sent!";
}


//out message is printed to the screen in the main process script
$out_message = "Thanks for filling out the referral, it has been sent.<hr><br><br>";



// OPS - we should implode the results of the foreach below for presenting
// in the PDF-ized html. 



// this stuff is just for development
// comment it out for prod
// echo '<pre>'; print_r($_POST); exit();
echo '<h1>Extractions</h1>';
echo '<pre>'; print_r(extractCombo()); echo '</pre>'; // show the combo array
echo '<hr>';
echo $extractionData[1]['tooth']; // prints out second result in ^ ^
echo '<hr>';
echo process_extractions(); // the layout version for the pdf
echo '<hr>';



echo '<h1>Ortho Extractions</h1>';
echo '<pre>'; print_r(orthoCombo()); echo '</pre>';
echo '<hr>';
echo $orthoData[1]['tooth'];
echo '<hr>';
echo process_ortho_extractions();
echo '<hr>';

echo '<h1>Implants</h1>';
echo '<pre>'; print_r(implantCombo()); echo '</pre>';
echo '<hr>';
echo $implantData[1]['tooth'];
echo '<hr>';
echo process_implants();
echo '<hr>';

echo '<h1>print_r($_REQUEST)</h1>';
echo '<pre>'; print_r($_REQUEST); echo '</pre>';
echo '<h1>print_r($_POST)</h1>';
echo '<pre>'; print_r($_POST); exit();



?>
















