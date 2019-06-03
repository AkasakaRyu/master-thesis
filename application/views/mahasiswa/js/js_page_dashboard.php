<script>
		$(document).ready(function() {
		$("#dtDiv").DataTable({
			"processing": true,
			"ajax": {
				"url": "<?= base_url('mahasiswa/dashboard/list_data/') ?>",
				"type": "POST"
			},
			"responsive": true
		});

		$('#FrmDiv').submit(function(e) {
			e.preventDefault();
			swal({
				title: "Are You Sure You Want to Save Data?",
				text: "",
				icon: "warning",
				buttons: true,
				dangerMode: true,
			}).then((Oke) => {
				if(Oke) {
					$.ajax({
						type: "POST",
						url: "<?= base_url('mahasiswa/dashboard/simpan/') ?>",
						data: $("#FrmDiv").serialize(),
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
				} else {
					swal("Poof!","Data Storage Canceled", "error").then((value) => {
						location.reload();
					})
				}
			})
		});

		$(document).on('click','#edit',function() {
			$('#DivMod').modal('show');
			var form = $("#FrmDiv");
			jQuery.ajax({
				type: "POST",
				url: "<?= base_url('mahasiswa/dashboard/get_data/') ?>",
				dataType: 'json',
				data: { mahasiswa_id: $(this).attr("data") },
				success: function(data) {
					$.each(data, function(key, value) {
						var ctrl = $('[name='+key+']');
						var ctrl2 = $('select#'+key);
						console.log(ctrl.prop("type"));
						switch(ctrl.prop("type")) {
							case "select-one" :
								ctrl2.val(value).trigger("change");
							break;
							default:
								ctrl.val(value);
						}
					});
				}
			});
		});

		$(document).on('click','#pass',function() {
			$('#DivPass').modal('show');
			var form = $("#FrmPass");
			jQuery.ajax({
				type: "POST",
				url: "<?= base_url('mahasiswa/dashboard/get_data/') ?>",
				dataType: 'json',
				data: { mahasiswa_id: $(this).attr("data") },
				success: function(data) {
					$.each(data, function(key, value) {
						var ctrl = $('[name='+key+']');
						var ctrl2 = $('select#'+key);
						console.log(ctrl.prop("type"));
						switch(ctrl.prop("type")) {
							case "select-one" :
								ctrl2.val(value).trigger("change");
							break;
							default:
								ctrl.val(value);
						}
					});
				}
			});
		});

		$('#FrmPass').submit(function(e) {
			e.preventDefault();
			swal({
				title: "Are You Sure You Want to Change Password?",
				text: "",
				icon: "warning",
				buttons: true,
				dangerMode: true,
			}).then((Oke) => {
				if(Oke) {
					$.ajax({
						type: "POST",
						url: "<?= base_url('mahasiswa/dashboard/ganti_password/') ?>",
						data: $("#FrmPass").serialize(),
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
				} else {
					swal("Poof!","Data Storage Canceled", "error").then((value) => {
						location.reload();
					})
				}
			})
		});

		$(document).on('click','#hapus',function() {
			swal({
				title: "Are You Sure You Want to Delete Data?",
				text: "",
				icon: "warning",
				buttons: true,
				dangerMode: true,
			}).then((Oke) => {
				if(Oke) {
					$.ajax({
						type: "POST",
						url: "<?= base_url('mahasiswa/dashboard/hapus/') ?>",
						data: { mahasiswa_id: $(this).attr("data") },
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
				} else {
					swal("Poof!","Data Storage Canceled", "error").then((value) => {
						location.reload();
					})
				}
			})
		});
		$("#show_hide_password a").on('click', function(event) {
			event.preventDefault();
			if($('#show_hide_password input').attr("type") == "text"){
				$('#show_hide_password input').attr('type', 'password');
				$('#show_hide_password i').addClass( "fa-eye-slash" );
				$('#show_hide_password i').removeClass( "fa-eye" );
			}else if($('#show_hide_password input').attr("type") == "password"){
				$('#show_hide_password input').attr('type', 'text');
				$('#show_hide_password i').removeClass( "fa-eye-slash" );
				$('#show_hide_password i').addClass( "fa-eye" );
			}
		});
	});
</script>
