   
  <style type="text/css">
	.dataTables_wrapper {
		  max-width: 120%;
		  display: block;

	  }

  </style>  

    
    <!-- start: page -->
    
			<!-- Theme modal fauzan -->
			<?php echo $modalfau;?>

<?php
 		
 	
			echo $reportMenu;
		
?>
                                
<!-- scripts --> 
<script src="<?php echo base_url(); ?>assets/js/jquery.js"></script> 
<script src="<?php echo base_url(); ?>assets/js/bootstrap.min.js"></script> 
<script>
		function doGenerateReport(href,typeReport,myProvinsiId,myPeriodId,myTargetId){
			var myHref="";
			myHref=href;
			var ok='myDet';
			var myProvinsiId=myProvinsiId;
			var myPeriodId=myPeriodId;
			var myTargetId=myTargetId;
			$.ajax({
				type: "POST",
				url: myHref,
				data: {
					'myProvinsiId':myProvinsiId,
					'myPeriodId':myPeriodId,
					'testing':ok,
					'myTargetId':myTargetId
				},
				dataType: "json",
				success: function(data) {
					 
				}
			});
		}

</script>