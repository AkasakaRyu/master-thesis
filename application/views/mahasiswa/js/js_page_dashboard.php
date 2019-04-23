<script>
  	$(document).ready(function() {
		$("#dtDiv").DataTable({
			"processing": true,
			"ajax": {
				"url": "<?= base_url('mahasiswa/dashboard/list_data/') ?>",
				"type": "POST"
			}
		});

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
					swal("Poof!","Penyimpanan Data Dibatalkan", "error").then((value) => {
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

		$(document).on('click','#hapus',function() {
			swal({
				title: "Anda Yakin Ingin Menghapus Data?",
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
					swal("Poof!","Penyimpanan Data Dibatalkan", "error").then((value) => {
						location.reload();
					})
				}
			})
		});
	});
</script>
