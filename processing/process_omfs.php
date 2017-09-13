<?php
//make checkboxes into lists



// need to match these to new omfs form elements
//$fieldofview_list = implode('<br>', $_POST['fieldofview']);
//$reasonforscan_list = implode('<br>', $_POST['reasonforscan']);
//$scanoptions_list = implode('<br>', $_POST['scanoptions']);
//$imageoutput_list = implode('<br>', $_POST['imageoutput']);


$uploadType = $_POST['uploadType']; // Type of uploaded file: Panorex?, Bitewing?, etc.
$extractions_list = implode('<br>', $_POST['extractions']);


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

<h2>Oral and Maxillofacial Surgery Referral</h2>

<h4>Referred By</h4>
<table class="table" cellspacing="0" cellpadding="5" border="1">
<tbody>
	<tr>
		<th>Doctor Name</th>
		<td>{$doctorfirstname} {$doctorlastname}</td>
	</tr>
	<tr>
		<th>Doctor NPI</th>
		<td>{$doctornpi}</td>
	</tr>
	<tr>
		<th>Practice Name</th>
		<td>{$practicename}</td>
	</tr>
	<tr>
		<th>Street Address</th>
		<td>{$address} <br /> {$city}, {$state} {$zipcode}</td>
	</tr>
	<tr>
		<th>Phone Number</th>
		<td>{$doctorphone}</td>
	</tr>
	<tr>
		<th>Email</th>
		<td>{$email}</td>
	</tr>
</tbody>
</table>

<table cellspacing="0" cellpadding="10" border="0">
<tr><td></td></tr>
</table>

<h4>Patient Information</h4>
<table class="table" cellspacing="0" cellpadding="5" border="1">
<tbody>
	<tr>
		<th>Patient Name</th>
		<td>{$patientfirstname} {$patientlastname}</td>
	</tr>
	<tr>
		<th>Patient Phone</th>
		<td>{$patientphone}</td>
	</tr>
	<tr>
		<th>Date of Birth</th>
		<td>{$dob}</td>
	</tr>
</tbody>
</table>

<table cellspacing="0" cellpadding="10" border="0">
<tr><td></td></tr>
</table>

<h4>Options</h4>
<table class="table" cellspacing="0" cellpadding="5" border="1">
<tbody>
	<tr>
		<th>Upload Type</th>
		<td>{$uploadType}</td>
	</tr>
	<tr>
	    <th>Extractions</th>
		<td>{$extractions_list}</td>
	</tr>
</tbody>
</table>


<style>
.table {
    border-collapse: collapse !important;
}
.table {
  width: 100%;
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
  border-top: 1px solid #dddddd;
  text-align: left !important;
}
</style>

htmleoq;

//echo $htmlout;


/************************************************ Create PDF ************************************************/

class MYPDF extends TCPDF {

    //Page header
    public function Header() {
        // Logo
		$image_file = K_PATH_IMAGES.'signature-marketing_whitebg_40.png';
        $this->Image($image_file, PDF_MARGIN_LEFT, 10, 80, '', 'PNG', '', 'T', true, 300, '', false, false, 0, false, false, false);
		//Contact Info
	$contact_text = '<b>Brent B Ward, DDS, MD</b> <br />
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
$pdffilepath = '/Users/cacody-admin/Development/referrals-dev/referrals/';
$pdffilename = 'omfs_'.date('YmdHis').'.pdf';
$email_path = 'https://referrals-dev/referrals/'.$pdffilename;
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
$out_message = "Thanks for filling out the referral, it has been sent.";
?>
















