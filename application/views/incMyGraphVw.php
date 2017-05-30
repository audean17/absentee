  
  <style type="text/css">
	.dataTables_wrapper {
		  max-width: 120%;
		  display: block;

	  }
	  
 

.demo-container {
 	width: 650px;
	height: 650px;
	padding: 0px 0px 0px 0px;
	background: #fff;
	 
	 
}

.demo-placeholder {
	width: 100%;
	height: 100%;
	font-size: 14px;
	line-height: 1.2em;
}

.demo-placeholder2 {
	width: 100%;
	height: 100%;
	font-size: 14px;
	line-height: 1.2em;
}

.legend table {
	border-spacing: 5px;
}	  
 

	.demo-container {
		position: relative;
		height: 260px;
	}
	.demo-container2 {
		position: relative;
		height: 260px;
	}

	#placeholder {
		width: 450px;
	}

 	#placeholder2 {
		width: 100%;
	}

 
  

	
  </style>  

    
    <!-- start: page -->
    
			<!-- Theme modal fauzan -->
			<?php echo $modalfau;?>









							<div class="col-md-12 col-lg-12 col-xl-4">
								<div class="row">
                                
									<div class="col-md-6 col-xl-12">
										<section class="panel">
											<div class="panel-body bg-primary">
												<div class="widget-summary">
													<div class="widget-summary-col widget-summary-col-icon">
														<div class="summary-icon">
															<i class="fa fa-life-ring"></i>
														</div>
													</div>
													<div class="widget-summary-col">
														<div class="summary">
															<h4 class="title">&nbsp;</h4>
															<div class="info">
																<strong class="amount"><?php //echo $totalRequest;?></strong>
															</div>
														</div>
										
                                        				<div class="summary-footer">
															<a class="text-uppercase" href="javascript:location.href ='<?php //echo site_url("headline/rptUsulanByProvinsi/all")?>';" target="new" style="cursor:pointer;">(view all)</a>
														</div>
													</div>
												</div>
											</div>
										</section>
									</div>
	                                    
									<div class="col-md-6 col-xl-12">
										<section class="panel">
											<div class="panel-body bg-secondary">
												<div class="widget-summary">
													<div class="widget-summary-col widget-summary-col-icon">
														<div class="summary-icon">
															<i class="fa fa-life-ring"></i>
														</div>
													</div>
													<div class="widget-summary-col">
														<div class="summary">
															<h4 class="title">&nbsp;</h4>
															<div class="info">
																<strong class="amount"><?php //echo $totalFailSyarat;?></strong>
															</div>
														</div>
														<div class="summary-footer">
															<a class="text-uppercase" href="javascript:location.href ='<?php //echo site_url("headline/rptUsulanByProvinsi/noSyarat")?>';" target="new" style="cursor:pointer;">(view all)</a>
														</div>
													</div>
												</div>
											</div>
										</section>
									</div>
                                    
									<div class="col-md-6 col-xl-12">
										<section class="panel">
											<div class="panel-body bg-tertiary">
												<div class="widget-summary">
													<div class="widget-summary-col widget-summary-col-icon">
														<div class="summary-icon">
															<i class="fa fa-life-ring"></i>
														</div>
													</div>
													<div class="widget-summary-col">
														<div class="summary">
															<h4 class="title">&nbsp;</h4>
															<div class="info">
																<strong class="amount"><?php //echo $totalNotYetVermin;?></strong>
															</div>
														</div>
														<div class="summary-footer">
															<a class="text-uppercase" href="javascript:location.href ='<?php //echo site_url("headline/rptUsulanByProvinsi/noVermin")?>';" target="new" style="cursor:pointer;">(view all)</a>
														</div>
													</div>
												</div>
											</div>
										</section>
									</div>

									<div class="col-md-6 col-xl-12">
										<section class="panel">
											<div class="panel-body bg-quartenary">
												<div class="widget-summary">
													<div class="widget-summary-col widget-summary-col-icon">
														<div class="summary-icon">
															<i class="fa fa-life-ring"></i>
														</div>
													</div>
													<div class="widget-summary-col">
														<div class="summary">
															<h4 class="title">&nbsp;</h4>
															<div class="info">
																<strong class="amount"><?php //echo $totalNotYetVertek;?></strong>
															</div>
														</div>
														<div class="summary-footer">
															<a class="text-uppercase" href="javascript:location.href ='<?php //echo site_url("headline/rptUsulanByProvinsi/noVertek")?>';" target="new" style="cursor:pointer;">(view all)</a>
														</div>
													</div>
												</div>
											</div>
										</section>
									</div>
                                    
								</div>
							</div>
  
					
                         
					<div class="col-md-6 col-lg-12 col-xl-6">
							<section class="panel">
								<div class="panel-body">
									<div class="row">
	
                                        
                                                <div class="demo-container2">
                                                    <div id="placeholder2" class="demo-placeholder2"></div>
                                                </div>
                                        
   									</div>
								</div>
							</section>
						</div>



<!-- scripts --> 
<script src="<?php echo base_url(); ?>assets/js/jquery.js"></script> 
<script src="<?php echo base_url(); ?>assets/js/bootstrap.min.js"></script> 
<!-- Examples -->
 <script type="text/javascript">
		function doGenerateReport2(href,typeReport,myProvinsiId,myPeriodId,myTargetId){
			var myHref="";
			myHref=href;
			var ok='myDet';
			var myProvinsiId=myProvinsiId;
			var myPeriodId=myPeriodId;
			var myTargetId=myTargetId;
			alert(myHref);
			
			$.ajax({
				type: "POST",
				url: myHref,
				data: {
					'myProvinsiId':myProvinsiId,
					'myPeriodId':myPeriodId,
					'typeReport':typeReport,
					'myTargetId':myTargetId
				},
				dataType: "json",
				success: function(data) {
//					 alert("test: "+data['msg']);
				}
			});
		}
                                      
                                          $(function() {
                                      
                                              //var data = [ ["January", 10], ["February", 8], ["March", 4], ["April", 13], ["May", 17], ["June", 9] ];
											  
											  var arrPropinsi="";
											<?php
												$dataPropinsiku = json_encode($dataPropinsi);
												echo "var arrPropinsi = ". $dataPropinsi . ";\n";
												
											?>
                                      			//alert(arrPropinsi);
                                              $.plot("#placeholder2", [ arrPropinsi ], {
                                                  series: {
                                                      bars: {
                                                          show: true,
                                                          barWidth: 0.6,
                                                          align: "center",
														  fillColor: { colors: [{ opacity: 0.5 }, { opacity: 1}] },
														  lineWidth: 1														  
                                                      },
													  points: {
														  show: true
													  }
                                                  },
												  grid: {
													  color: '#646464',
													  borderColor: 'transparent',
													  borderWidth: 20,
													  hoverable: true,
													  clickable: true
												  },
												  legend: {
													  noColumns: 1,
													  labelBoxBorderColor: "#858585"
													  
												  },
                                                  xaxis: {
                                                      mode: "categories",
                                                      tickLength: 0
													  
                                                  }
                                              });
                                      
											  $("<div id='tooltip'></div>").css({
												  position: "absolute",
												  display: "none",
												  border: "1px solid #fdd",
												  padding: "2px",
												  "background-color": "#fee",
												  opacity: 0.80
											  }).appendTo("body");
									  
											  $("#placeholder2").bind("plothover", function (event, pos, item) {
									   
													  if (item) {
														  var x = item.datapoint[0],
															  y = item.datapoint[1].toFixed(0);
									  
														  $("#tooltip").html(y + " unit")
															  .css({top: item.pageY+5, left: item.pageX+5})
															  .fadeIn(200);
													  } else {
														  $("#tooltip").hide();
													  }
											  });     
/*
											  $("#placeholder").bind("plotclick", function (event, pos, item) {
													if (item) {
														$("#clickdata").text(" - click point " + item.dataIndex + " in " + item.series.label);
														plot.highlight(item.series, item.datapoint);
													}
												});											                                   
  */
                                          });
                                      
                                          </script>
 
  
 	<script type="text/javascript">

	$(function() {
 	var data = [];
 
 		<?php
			$dataku = json_encode($dataUnit);
			echo "var data = ". $dataku . ";\n";
		?>
	 
		var placeholder = $("#placeholder");

 			placeholder.unbind();

			 
 
			$.plot('#placeholder', data, {
				series: {
					pie: {
						show: true,
						radius: 1,
						label: {
							show: true,
							radius: 2/3,
							formatter: labelFormatter,
							background: {
								opacity: 0.5
							}
						}
					}
				},
				legend: {
					show: false
				}
			});
			
 
		 
	});

	// A custom label formatter used by several of the plots

	function labelFormatter(label, series) {
		return "<div style='font-size:8pt; text-align:center; padding:2px; color:white;'>" + label + "<br/>" + Math.round(series.percent) + "%</div>";
	}

	//
 


</script>
   