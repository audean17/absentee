<?php
$getYear=substr($myPeriodeId,0,4);
$getNumberMonth=substr($myPeriodeId,4,2);
//die("tahun: ".$getYear. " - bulan: ".$getNumberMonth);

?>
<html>
	<head>
		<title>Absensi</title>
		<!-- Web Fonts  -->
		<link href="//fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,800" rel="stylesheet" type="text/css">

		<!-- Vendor CSS -->
		<link rel="stylesheet" href="<?php echo base_url(); ?>assets/porto/vendor/bootstrap/css/bootstrap.css" />

		<!-- Invoice Print Style -->
		<link rel="stylesheet" href="<?php echo base_url(); ?>assets/porto/stylesheets/invoice-print.css" />
	</head>
	<body>
		<div class="invoice">
			<header class="clearfix">
				<div class="row">
					<div class="col-sm-6 mt-md">
						<h2 class="h2 mt-none mb-sm text-dark text-weight-bold">ABSENSI</h2>
						<h4 class="h4 m-none text-dark text-weight-bold">Periode : <?php  echo date("F", mktime(0, 0, 0, $getNumberMonth, 10)). " ".$getYear;?></h4>
					</div>
					<div class="col-sm-6 text-right mt-md mb-md">
						<address class="ib mr-xlg">
							Employee: <?php echo $myFullName. " (".$myEmployeeId.")";?>
							<br/>
							Department : <?php echo $myDepartment;?>
							<br/>
							 
						</address>
						 
					</div>
				</div>
			</header>
			
		
			<div >
				<table class="table">
					<thead>
						<tr class="h5 text-dark">
							<th rowspan="2"  class="text-weight-semibold" style="border-left:1px solid #999;">Date</th>
							<th colspan="2"  class="text-center text-weight-semibold" style="border-left:1px solid #999;">Absent</th>
							<th colspan="3" class="text-center text-weight-semibold" style="border-left:1px solid #999;">Over time</th>
							<th colspan="3"  class="text-center text-weight-semibold" style="border-left:1px solid #999;border-right:1px solid #999;">Cut Off Absent</th>
						</tr>
                    <tr>
                        <th class="text-weight-semibold"  style="border-left:1px solid #999;">IN</th>
                        <th>OUT</th>
                        <th style="border-left:1px solid #999;">Status</th>
                        <th>Total</th>
                        <th>Reason</th>
                        <th style="border-left:1px solid #999;">Status</th>
                        <th>Type</th>
                        <th style="border-right:1px solid #999; ">Pengajuan</th>
                         
                    </tr>
					</thead>
                    
 					<tbody>
                    <?php
						foreach ($listAbsentee as $row) {
							
							$full_name=$row->employee_first_name." ".$row->employee_last_name;
							$myDataSplitOvertime=$row->employee_id."|".$full_name."|".$row->absent_date."|".$row->in."|".$row->out."|".$row->amount_overtime."|".$row->absent_date_db."|".$row->overtime_reason;
							$myDataSplitComplain=$row->employee_id."|".$full_name."|".$row->absent_date."|".$row->in."|".$row->out."|".$row->cut_absentee_type_desc."|".$row->absent_date_db."|".$row->absentee_complain;
						
					?>
						<tr>
							
                            <td style="width:100px;border-left:1px solid #999;"><?php echo $row->absent_date;?></td>
                            <td style="width:70px;border-left:1px solid #999;"><?php echo $row->in;?></td>
                            <td style="width:70px;"><?php echo $row->out;?></td>
                            <td style="width:70px;border-left:1px solid #999;"><?php echo $row->overtime_status;?></td>
                            <td style="width:70px;"><?php echo number_format($row->amount_overtime,2,".",",");?></td>
                            <td style="width:370px;">&nbsp;</td>
											
                            <td style="width:70px;border-left:1px solid #999;"><?php echo $row->absent_status;?></td>
                            <td><?php echo $row->cut_absentee_type_desc;?></td>
                            <td style="width:70px;border-right:1px solid #999;">&nbsp;</td>
                                            
                            
						</tr>
                        <?php }?>
                        <tr>
							
                            <td  colspan="9">&nbsp;</td>
                                            
                            
						</tr>
					</tbody>
				</table>
			</div>
		
			<div class="invoice-summary">
				<div class="row">
					<div class="col-sm-4 col-sm-offset-8">
						<table class="table h5 text-dark">
							<tbody>
								<tr class="b-top-none">
									<td colspan="2">&nbsp;</td>
									<td class="text-left">Jakarta, </td>
								</tr>
								<tr class="b-top-none">
									<td colspan="3">&nbsp;</td>
									
								</tr>
								<tr class="b-top-none">
									<td colspan="2">&nbsp;</td>
									<td class="text-left"><?php echo $myFullName;?></td>
								</tr>
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>

		<script>
			window.print();
		</script>
	</body>
</html>