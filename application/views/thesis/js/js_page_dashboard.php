<script>
  	$(document).ready(function() {
		$("#dtDiv").DataTable({
			"processing": true,
			"ajax": {
				"url": "<?= base_url('thesis/dashboard/list_data/') ?>",
				"type": "POST"
			},
			"responsive": true
		});

		$('#FrmJudul').submit(function(e) {
			e.preventDefault();
			swal({
				title: "Are You Sure You Want to Search for This Title?",
				text: "",
				icon: "warning",
				buttons: true,
				dangerMode: true,
			}).then((Oke) => {
				if(Oke) {
					$.ajax({
						type: "POST",
						url: "<?= base_url('thesis/dashboard/cari_judul/') ?>",
						data: $("#FrmJudul").serialize(),
						timeout: 5000,
						success: function(response) {
							var data = JSON.parse(response);
							swal(data.warning, data.pesan, data.kode).then((value) => {
								$("#thesis_judul").attr("readonly","true");
								$("#cari").attr("disabled","true");
								if(data.kode=="success") {
									$("#kirim").css("display","inline-block");
								} else {
									$.ajax({
										type: "POST",
										url: "<?= base_url('thesis/dashboard/daftar_judul/') ?>",
										data: { thesis_judul: $("#thesis_judul").val() },
										timeout: 5000,
										success: function(response) {
											var data = JSON.parse(response);
											$.each(data, function(key, value) {
												$('#list').append('<li>'+value.text+'</li>');
											});
										},
										error: function(xhr, status, error) {
											swal(error, "Please Ask Support or Refresh the Page!", "error").then((value) => {
												location.reload();
											})
										}
									})
								}
							})
						},
						error: function(xhr, status, error) {
							swal(error, "Please Ask Support or Refresh the Page!", "error").then((value) => {
								location.reload();
							})
						}
					})
				} else {
					swal("Poof!","Data Storage Canceled!", "error").then((value) => {
						location.reload();
					})
				}
			})
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
						url: "<?= base_url('thesis/dashboard/simpan/') ?>",
						data: $("#FrmDiv").serialize(),
						timeout: 5000,
						success: function(response) {
							var data = JSON.parse(response);
							swal(data.warning, data.pesan, data.kode).then((value) => {
								if(data.kode=="success") {
									location.reload();
								}
							})
						},
						error: function(xhr, status, error) {
							swal(error, "Please Ask Support or Refresh the Page!", "error").then((value) => {
								location.reload();
							})
						}
					})
				} else {
					swal("Poof!","Data Storage Canceled!", "error").then((value) => {
						location.reload();
					})
				}
			})
		});

		$('#FrmSend').submit(function(e) {
			e.preventDefault();
			swal({
				title: "Are You Sure You Want To Send Data?",
				text: "",
				icon: "warning",
				buttons: true,
				dangerMode: true,
			}).then((Oke) => {
				if(Oke) {
					$.ajax({
						type: "POST",
						url: "<?= base_url('thesis/dashboard/simpan/') ?>",
						data: { thesis_judul: $("#thesis_judul").val() },
						timeout: 5000,
						success: function(response) {
							var data = JSON.parse(response);
							swal(data.warning, data.pesan, data.kode).then((value) => {
								if(data.kode=="success") {
									location.reload();
								}
							})
						},
						error: function(xhr, status, error) {
							swal(error, "Please Ask Support or Refresh the Page!", "error").then((value) => {
								location.reload();
							})
						}
					})
				} else {
					swal("Poof!","Data Storage Canceled!", "error").then((value) => {
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
				url: "<?= base_url('thesis/dashboard/get_data/') ?>",
				dataType: 'json',
				data: { thesis_id: $(this).attr("data") },
				success: function(data) {
					if(data.thesis_status=="Waiting") {
						$("#thesis_tujuan").attr("disabled","true");
						$("#thesis_rumusan_masalah").attr("disabled","true");
						$("#thesis_kerangka_teori").attr("disabled","true");
						$("#thesis_metodologi_penelitian").attr("disabled","true");
					} else if(data.thesis_status=="Approved") {
						$("#thesis_judul").attr("readonly","true");
					}
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
						url: "<?= base_url('thesis/dashboard/hapus/') ?>",
						data: { thesis_id: $(this).attr("data") },
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
					swal("Poof!","Data Storage Canceled!", "error").then((value) => {
						location.reload();
					})
				}
			})
		});

		$(document).on('click','#terima',function() {
			swal({
				title: "Are You Sure You Want To Approve This Thesis?",
				text: "",
				icon: "warning",
				buttons: true,
				dangerMode: true,
			}).then((Oke) => {
				if(Oke) {
					$.ajax({
						type: "POST",
						url: "<?= base_url('thesis/dashboard/terima/') ?>",
						data: { thesis_id: $(this).attr("data") },
						timeout: 5000,
						success: function(response) {
							var data = JSON.parse(response);
							swal(data.warning, data.pesan, data.kode).then((value) => {
								if(data.kode=="success") {
									location.reload();
								}
							})
						},
						error: function(xhr, status, error) {
							swal(error, "Please Ask Support or Refresh the Page!", "error").then((value) => {
								location.reload();
							})
						}
					})
				} else {
					swal("Poof!","Data Storage Canceled!", "error").then((value) => {
						location.reload();
					})
				}
			})
		});

		$(document).on('click','#tolak',function() {
			$('#DivTolak').modal('show');
			var form = $("#FrmTolak");
			jQuery.ajax({
				type: "POST",
				url: "<?= base_url('thesis/dashboard/get_data/') ?>",
				dataType: 'json',
				data: { thesis_id: $(this).attr("data") },
				success: function(data) {
					if(data.thesis_status=="Waiting") {
						$("#thesis_tujuan").attr("disabled","true");
						$("#thesis_rumusan_masalah").attr("disabled","true");
						$("#thesis_kerangka_teori").attr("disabled","true");
						$("#thesis_metodologi_penelitian").attr("disabled","true");
					}
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

		$('#FrmTolak').submit(function(e) {
			e.preventDefault();
			swal({
				title: "Are you sure you want to reject data?",
				text: "",
				icon: "warning",
				buttons: true,
				dangerMode: true,
			}).then((Oke) => {
				if(Oke) {
					$.ajax({
						type: "POST",
						url: "<?= base_url('thesis/dashboard/tolak/') ?>",
						data: $("#FrmTolak").serialize(),
						timeout: 5000,
						success: function(response) {
							var data = JSON.parse(response);
							swal(data.warning, data.pesan, data.kode).then((value) => {
								if(data.kode=="success") {
									location.reload();
								}
							})
						},
						error: function(xhr, status, error) {
							swal(error, "Please Ask Support or Refresh the Page!", "error").then((value) => {
								location.reload();
							})
						}
					})
				} else {
					swal("Poof!","Data Storage Canceled!", "error").then((value) => {
						location.reload();
					})
				}
			})
		});

	});
</script>
