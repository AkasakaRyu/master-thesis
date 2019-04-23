<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<?php $this->load->view('template/v_header'); ?>
	</head>
	<body class="bg-grey">
		<div class="cover"></div>
		<nav class="navbar navbar-expand-md navbar-dark bg-success">
			<?php $this->load->view('template/v_navbar'); ?>
		</nav>
		<div class="container" style="min-height: 100vh">
			<main class="main">
				<div class="row d-flex align-items-start flex-column">
					 <div class="col-12">
					 	<div class="container py-4">
							<?php $this->load->view($Konten); ?>
						</div>
					</div>
				</div>
			</main>
		</div>
		<footer class="footer">
			<?php $this->load->view('template/v_footer'); ?>
		</footer>
	</body>
</html>