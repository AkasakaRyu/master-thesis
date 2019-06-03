<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<?php $this->load->view('template/v_header'); ?>
	</head>
	<body class="bg-grey">
		<div class="cover"></div>
		<nav class="navbar navbar-dark navbar-expand-sm bg-success justify-content-center">
			<?php $this->load->view('template/v_navbar'); ?>
		</nav>
		<main class="main">
			<div class="container-fluid">
				<div class="row d-flex align-items-start flex-column">
					<div class="col-12">
						<?php $this->load->view($Konten); ?>
					</div>
				</div>
			</div>
		</main>
		<footer class="footer">
			<?php $this->load->view('template/v_footer'); ?>
		</footer>
	</body>
</html>