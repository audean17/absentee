<!doctype html>
<html class="fixed">
	<head>
		<?php $this->load->view('incHeaderTagVw'); ?>
	</head>
	<body>
		<section class="body">

			<!-- start: header -->
			<?php $this->load->view('incHeaderVw.php');?>
			<!-- end: header -->

			<div class="inner-wrapper">
               <!-- left sidebar -->
			<?php $this->load->view('incMenuVw.php');?>

				<section role="main" class="content-body">
					<header class="page-header">
						<h2><?php echo $titleContent;?></h2>

						<div class="right-wrapper pull-right">
							<ol class="breadcrumbs">
                            <?php echo $LeftCaption;?>
							</ol>

							<a class="sidebar-right-toggle" data-open="sidebar-right"><i class="fa fa-chevron-left"></i></a>
						</div>
					</header>

					<!-- start: page -->
					<?php
						if ($typePage=="header"){
							$this->load->view('incPegawaiTableVw.php');
						}elseif ($typePage=="detail"){
							$this->load->view('incPegawaiFamilyTableVw.php');
						}else{
							$this->load->view('incPegawaiPendidikanTableVw.php');
						}
					?>

				</section>
			</div>
			<?php $this->load->view('incSideBarRight.php');?>
		</section>
		<?php $this->load->view('incJavascriptVendorVw.php');?>

	</body>
</html>
