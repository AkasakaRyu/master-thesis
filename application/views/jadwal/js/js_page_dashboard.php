<script>
  	$(document).ready(function() {
  	$("#dosen_id").select2({
			placeholder: "-- PILIH DOSEN --",
		});
		
		$.ajax({
			url: "<?= base_url('dosen/dashboard/options/') ?>",
			type: "GET",
			dataType: "json",
			success:function(data) {
				$.each(data, function(key, value) {
					$('#dosen_id').append('<option value="'+ value.id +'">'+ value.text +' | Sisa : '+value.kuota+'</option>');
				});
			}
		});

		$("#mahasiswa_id").select2({
			placeholder: "-- PILIH DOSEN --",
		});
		
		$.ajax({
			url: "<?= base_url('mahasiswa/dashboard/options/') ?>",
			type: "GET",
			dataType: "json",
			success:function(data) {
				$.each(data, function(key, value) {
					$('#mahasiswa_id').append('<option value="'+ value.id +'">'+ value.text +'</option>');
				});
			}
		});

		$("#dtDiv").DataTable({
			"processing": true,
			"ajax": {
				"url": "<?= base_url('jadwal/dashboard/list_data/') ?>",
				"type": "POST"
			},
			"responsive" : "true"
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
						url: "<?= base_url('jadwal/dashboard/simpan/') ?>",
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
				url: "<?= base_url('jadwal/dashboard/get_data/') ?>",
				dataType: 'json',
				data: { jadwal_id: $(this).attr("data") },
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
						url: "<?= base_url('jadwal/dashboard/hapus/') ?>",
						data: { jadwal_id: $(this).attr("data") },
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
