<!DOCTYPE html>
<html>
<head>
    <title>Referrals to University of Michigan School of Dentistry</title>
	<meta http-equiv="content-type" content="text/html; charset=utf-8" />
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
</head>
<body>
<section>	<!-- "Page Header"  -->
	<div class="container">
		<div class="page-header">
		  <h1><img src="./images/signature-marketing_transparent_40.png" /></h1>
		</div>
		<h2>Refferal Form</h2>
	</div>
<section>


<!-- START FORM -->
<form id="referral_form" role="form" enctype="multipart/form-data" action="processing/process.php" method="post" class="form-horizontal">

<section> 	<!-- "Referred By"  -->
	<div class="container">
		<?php include_once 'forms/form_provider_info.html'; ?>
	</div>
<section>
	
<section>	<!-- "Patient Information" -->
	<div class="container">
		<?php include_once 'forms/form_patient_info.html'; ?>
	</div>
</section>


<section> <!-- "Referral Type (specialty)" -->
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<legend>Type of Referral</legend>	
				
							
					<ul class="nav nav-pills nav-justified text-center">
					  <li role="presentation"><a href="#tab1" data-toggle="tab">CBCT</a><br><small class="text-center">Cone-beam Computed Tomography</small></li>
					  <li role="presentation"><a href="#tab2" data-toggle="tab">Endo</a><br><small>Endodontics</small></li>
					  <li role="presentation"><a href="#tab3" data-toggle="tab">OMSHD</a><br><small>Oral and Maxillofacial Surgery</small></li>
					  <li role="presentation"><a href="#tab4" data-toggle="tab">PAES</a><br><small>Patient Admissions and Emergency Services</small></li>
					</ul>
					<div class="tab-content clearfix">
					    <div class="tab-pane" id="tab1">
					        <?php include_once 'forms/form_dept_cbct.html'; ?>
					    </div> <!-- end tab1 -->

					    <div class="tab-pane" id="tab2">
					        <?php include_once 'forms/form_dept_endo.html'; ?>
					    </div> <!-- end tab2 -->

					    <div class="tab-pane" id="tab3">
					        <?php include_once 'forms/form_dept_omfs.html'; ?>

					    </div> <!-- end tab3 -->
					    <div class="tab-pane" id="tab4">
					        <?php include_once 'forms/form_dept_paes.html'; ?>
					    </div> <!-- end tab4 -->
					</div>
			</div>
		</div>
	</div>
</section>

<!-- no crap space - replace with css -->
<p>&nbsp;</p>
<p>&nbsp;</p>

<!-- END FORM -->
</form>



<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="//code.jquery.com/jquery.js"></script>
<!-- Bootstrap Javascript -->
<script src="//netdna.bootstrapcdn.com/bootstrap/3.0.0/js/bootstrap.min.js"></script>


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
<script src="js/script.js"></script>

<!-- Latest compiled and minified JavaScript -->

</body>
</html>
