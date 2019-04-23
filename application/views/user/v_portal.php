<!DOCTYPE html>
<html lang="en" dir="ltr">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>Home</title>
		<link rel="stylesheet" href="<?= base_url('assets/bootstrap/css/bootstrap.min.css') ?>">
		<link rel="stylesheet" href="<?= base_url('assets/fontawesome/css/fontawesome.css') ?>">
		<link rel="stylesheet" href="<?= base_url('assets/fath/css/main.css') ?>">
	</head>
	<body class="bg-success text-light">
		<div class="container-fluid">
			<div class="row">
				<div class="col-md-8 d-none d-md-block">
					<div class="row d-flex d-flex align-items-center" style="min-height: 100vh">
						<div class="col-12 p-5">
							<div class="text-center">
								<img src="<?= $Instansi->instansi_logo ?>" alt="" width="150px">
							</div>
							<h5 class="display-4 mt-3 text-center"><?= $Instansi->instansi_nama ?></h5>
							<p class="lead text-center"><?= $Instansi->instansi_alamat ?></p>
							<div class="card card-light enable-shadow">
								<div class="card-body">
									<h4 class="mb-0"><i class="fa fa-info mr-2"></i> <?= $Info->app_info_name ?></h4>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="col-md-4">
					<div class="row d-flex d-flex align-items-center bg-light text-dark" style="min-height: 100vh">
						<div class="col-12">
							<?= form_open('',array('id' => 'FrmLogin')) ?>
								<div class="card card-light">
									<div class="card-body">
										<h2>Login</h2>
										<p class="lead"><?= $Info->app_info_name ?></p>
										<div class="form-group mt-5">
											<?php
												$data = array(
													'id' => 'user_login',
													'class' => 'form-control form-control-lg',
													'name' => 'user_login',
													'placeholder' => 'Username',
													'autocomplete' => 'off',
													'required' => 'true'
												);
												echo form_input($data);
											?>
										</div>
										<div class="form-group">
											<?php
												$data = array(
													'id' => 'user_pass',
													'class' => 'form-control form-control-lg',
													'name' => 'user_pass',
													'placeholder' => 'Password',
													'type' => 'password',
													'autocomplete' => 'off',
													'required' => 'true'
												);
												echo form_input($data);
											?>
										</div>
										<button type="submit" name="button" class="btn btn-block btn-success btn-lg btn-circle"><i class="fa fa-sign-in-alt mr-2"></i> Masuk</button>
									</div>
								</div>
							<?= form_close() ?>
						</div>
					</div>
				</div>
			</div>
		</div>
		<script src="<?= base_url('assets/jquery/jquery.min.js') ?>"></script>
		<script src="<?= base_url('assets/bootstrap/popper/popper.min.js') ?>"></script>
		<script src="<?= base_url('assets/bootstrap/js/bootstrap.min.js') ?>"></script>
		<script src="<?= base_url('assets/sweetalert/sweetalert.min.js') ?>"></script>
		<script type="text/javascript">
		$(document).ready(function() {
			$.ajaxSetup( { data: { '<?= $this->security->get_csrf_token_name() ?>': '<?= $this->security->get_csrf_hash() ?>' } });

			$('#FrmLogin').submit(function(e) {
				e.preventDefault();
				$.ajax({
					type: "POST",
					url: "<?= base_url('portal/login_proses') ?>",
					data: $("#FrmLogin").serialize(),
					timeout: 5000,
					success: function(response) {
						var data = JSON.parse(response);
						swal(data.warning, data.pesan, data.kode).then((value) => {
							location.reload();
						})
					},
					error: function(xhr, status, error) {
						swal(error, "Please Ask Support or Refresh the Page!", "error").then((value) => {
							location.reload();
						})
					}
				})
			});

			$('.sidebar-control').on('click', function() {
				$('.sidebar').toggleClass('sidebar-lite-hover');
			});

		});
		</script>
	</body>
</html>
