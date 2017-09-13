<!DOCTYPE html>
<html>
<head>
	<title>Referrals to University of Michigan School of Dentistry</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<!-- Bootstrap Stylesheet -->
		<link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap.min.css">
		<link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap-theme.min.css">
		<link rel="stylesheet" href="css/style.css">
		<!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
		<!--[if lt IE 9]>
		<script src="//cdnjs.cloudflare.com/ajax/libs/html5shiv/3.6.2/html5shiv.js"></script>
		<script src="//cdnjs.cloudflare.com/ajax/libs/respond.js/1.2.0/respond.js"></script>
		<![endif]-->
	<meta http-equiv="content-type" content="text/html; charset=utf-8" />
</head>
<body>

<form id="referral_form" role="form" enctype="multipart/form-data" action="process.php" method="post" class="form-horizontal">
<section id="provider">
	<div class="container">
	 

		<?php include_once 'form_provider_info.html'; ?>

		

	</div> <!-- /.container for provider info -->
</section>

<section id="patient">
	<div class="container">
	
	<?php include_once 'form_patient_info.html'; ?>
	
	</div> <!-- /.container for patient info-->
</section>

<section id="department">
	<div class="container">
		
		<legend>Type of Referral</legend>
		<!-- customized section for each discipline or type of referral -->
		<ul class="nav nav-pills nav-justified text-center">
		  <li id="cbct-link" role="presentation">
			<a href="#tab-cbct" data-toggle="tab">CBCT</a><br>
			<small class="text-center">Cone-beam Computed Tomography</small>
		  </li>
		  <li id="endo-link" role="presentation">
			<a href="#tab-endo" data-toggle="tab">Endo</a><br>
			<small>Endodontics</small>
		  </li>
		  <li id="omfs-link" role="presentation">
			<a href="#tab-omfs" data-toggle="tab">OMFS</a><br>
			<small>Oral and Maxillofacial Surgery</small>
		  </li>
		  <li id="paes-link" role="presentation">
			<a href="#tab-paes" data-toggle="tab">PAES</a><br>
			<small>Patient Admissions and Emergency Services</small>
		  </li>
	   </ul>
	</div>		
		<div class="tab-content clearfix">
		    <div class="tab-pane cbct" id="tab-cbct">
		        <?php include_once 'form_dept_cbct.html'; ?>
		    </div> <!-- end tab1 -->
		    <div class="tab-pane endo" id="tab-endo">
		        <?php include_once 'form_dept_endo.html'; ?>
		    </div> <!-- end tab2 -->
		    <div class="tab-pane omfs" id="tab-omfs">
		        <?php include_once 'form_dept_omfs.html'; ?>
			
		    </div> <!-- end tab3 -->
		    <div class="tab-pane paes" id="tab-paes">
		        <?php include_once 'form_dept_paes.html'; ?>
			
		    </div> <!-- end tab4 -->
		</div>
	<br><br><br><br>
</section>
</form>




<script src="//code.jquery.com/jquery.js"></script>
<script src="//netdna.bootstrapcdn.com/bootstrap/3.0.0/js/bootstrap.min.js"></script>

<!-- For saving provider info in the browser -->
<script>
/**
$(document).ready(function(){
    dataLoad();
    $(document).on("click", "#save-data-fields", function(){
        dataSave();
    });
});

function dataLoad() {
    if (localStorage.getItem('fieldString') !== null) {
        var inputParse = JSON.parse(localStorage.getItem('fieldString'));
        $.each(inputParse, function (key, value) {
            var field = document.getElementById(key);
            if(field.type == 'radio' || field.type == 'checkbox'){
                field.checked = value;
            }else{
                field.value = value;
            }
        });
    }
}

function dataSave(){
    var mngrFields = {};

    $(".save-field").each(function(){
        if (this.type == "radio" || this.type == "checkbox"){
            mngrFields[this.id] = this.checked;
        } else {
            mngrFields[this.id] = this.value;
        }
    });
    localStorage.setItem('fieldString', JSON.stringify(mngrFields));
}
**/
</script>

<!-- custom scripting, usually applies to departmental forms -->
<script src="js/script.js"></script>
</body>
</html>
