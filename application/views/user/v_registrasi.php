<!DOCTYPE html>
<html lang="en" dir="ltr">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>REGISTRATION PAGE | <?= $Info->app_info_name ?></title>
		<link rel="stylesheet" href="<?= base_url('assets/bootstrap/css/bootstrap.min.css') ?>">
		<link rel="stylesheet" href="<?= base_url('assets/fontawesome/css/fontawesome.css') ?>">
		<link rel="stylesheet" href="<?= base_url('assets/fath/css/main.css') ?>">
		<script src="<?= base_url('assets/jquery/jquery.min.js') ?>"></script>
		<script src="<?= base_url('assets/bootstrap/popper/popper.min.js') ?>"></script>
		<script src="<?= base_url('assets/bootstrap/js/bootstrap.min.js') ?>"></script>
		<script src="<?= base_url('assets/sweetalert/sweetalert.min.js') ?>"></script>
		<script>
		  $.ajaxSetup( {
		    data: {
		      '<?= $this->security->get_csrf_token_name() ?>': '<?= $this->security->get_csrf_hash() ?>'
		    }
		  });
		</script>
	</head>
	<body class="bg-success text-light">
		<div class="container-fluid">
			<div class="row">
				<div class="col-md-12">
					<div class="row d-flex d-flex align-items-center bg-light text-dark" style="min-height: 100vh">
						<div class="col-12">
							<?= form_open('',array('id' => 'FrmDiv')) ?>
								<div class="card card-light">
									<div class="card-body">
										<h2>Registration Page</h2>
										<p class="lead"><?= $Info->app_info_name ?></p>
										<div class="row">
										<div class="col-md-4">
											<div class="form-group">
												<label for="">NIM <span class="text-muted"><i>*Required*</i></span></label>
												<?php
													$data = array(
														'name' => 'mahasiswa_nim',
														'type' => 'number',
														'min' => '0',
														'id' => 'mahasiswa_nip',
														'class' => 'form-control',
														'required' => 'true',
														'autocomplete' => 'off'
													);
													echo form_input($data);
												?>
											</div>
										</div>
										<div class="col-md-8">
											<div class="form-group">
												<label for="">Name <span class="text-muted"><i>*Required*</i></span></label>
												<?php
													$data = array(
														'name' => 'mahasiswa_nama',
														'id' => 'mahasiswa_nama',
														'class' => 'form-control',
														'required' => 'true',
														'autocomplete' => 'off'
													);
													echo form_input($data);
												?>
											</div>
										</div>
										<div class="col-md-4">
											<div class="form-group">
												<label for="">Email <span class="text-muted"><i>*Required*</i></span></label>
												<?php
													$data = array(
														'name' => 'mahasiswa_email',
														'type' => 'email',
														'id' => 'mahasiswa_email',
														'class' => 'form-control',
														'required' => 'true',
														'autocomplete' => 'off'
													);
													echo form_input($data);
												?>
											</div>
										</div>
										<div class="col-md-4">
											<div class="form-group">
												<label for="">Address <span class="text-muted"><i>*Required*</i></span></label>
												<?php
													$data = array(
														'name' => 'mahasiswa_alamat',
														'id' => 'mahasiswa_alamat',
														'class' => 'form-control',
														'required' => 'true',
														'autocomplete' => 'off'
													);
													echo form_input($data);
												?>
											</div>
										</div>
										<div class="col-md-4">
											<div class="form-group">
												<label for="">Phone Number <span class="text-muted"><i>*Required*</i></span></label>
												<?php
													$data = array(
														'name' => 'mahasiswa_kontak',
														'type' => 'number',
														'min' => '0',
														'id' => 'mahasiswa_kontak',
														'class' => 'form-control',
														'required' => 'true',
														'autocomplete' => 'off'
													);
													echo form_input($data);
												?>
											</div>
										</div>
									</div>
										<button type="submit" name="button" class="btn btn-success btn-lg btn-circle">
											<i class="fa fa-edit mr-2"></i> Submit
										</button>
										<a href="<?= base_url('portal') ?>" class="btn btn-danger btn-lg btn-circle">
											<i class="fa fa-caret-left mr-2"></i> Back
										</a>
									</div>
								</div>
							<?= form_close() ?>
						</div>
					</div>
				</div>
			</div>
		</div>
		<script type="text/javascript">
		$(document).ready(function() {
			$('#FrmDiv').submit(function(e) {
				e.preventDefault();
				swal({
					title: "Anda Yakin Ingin Menyimpan Data?",
					text: "",
					icon: "warning",
					buttons: true,
					dangerMode: true,
				}).then((Oke) => {
					if(Oke) {
						$.ajax({
							type: "POST",
							url: "<?= base_url('user/registrasi/simpan/') ?>",
							data: $("#FrmDiv").serialize(),
							timeout: 5000,
							success: function(response) {
								var data = JSON.parse(response);
								swal(data.warning, data.pesan, data.kode).then((value) => {
									if(data.kode=="success") {
										window.location.href = "<?= base_url('portal') ?>";
									}
								})
							},
							error: function(xhr, status, error) {
								swal(error, "Please Ask Support or Refresh the Page!", "error").then((value) => {
									// location.reload();
								})
							}
						})
					} else {
						swal("Poof!","Data Storage Canceled", "error").then((value) => {
							// location.reload();
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
