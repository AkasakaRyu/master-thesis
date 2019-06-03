<div class="col-12">
	<div class="pl-3 py-4">
		<div class="card card-light enable-shadow">
			<div class="card-header bg-secondary text-white">
				<h4 class="card-title mb-0">
					<i class="fa fa-user-tie mr-2"></i>Lists
					<?php if($this->session->userdata('access')=="LVL19011700001") : ?>
						<div class="float-none float-md-right mt-2 mt-md-0">
							<a href="#" class="btn btn-sm btn-block btn-light" role="button" data-toggle="modal" data-target="#DivMod"><i class="fa fa-plus mr-2"></i> Add</a>
						</div>
					<?php endif ?>
					<div class="float-none float-md-right mt-2 mt-md-0 mr-md-1">
						<a href="<?= base_url('user/dashboard') ?>" class="btn btn-sm btn-block btn-light"><i class="fa fa-home mr-2"></i> Beranda</a>
					</div>
				</h4>
			</div>
			<div class="card-body">
				<?php if($this->session->userdata('access')!="LVL19011700003") : ?>
					<div class="table-responsive">
						<table class="table table-sm table-striped table-bordered" id="dtDiv">
							<thead>
								<tr>
									<th class="cells-number" data-priority="1">Status</th>
									<th>Title</th>
									<th>NIM</th>
									<th>Students</th>
									<th>Notes</th>
									<th class="none">Aim</th>
									<th class="none">Formulation</th>
									<th class="none">Framework</th>
									<th class="none">Methodology</th>
									<th class="text-center"><i class="fa fa-cogs"></i></th>
								</tr>
							</thead>
							<tbody></tbody>
						</table>
					</div>
				<?php else : ?>
					<?= form_open('',array('id' => 'FrmJudul')) ?>
						<div class="row">
							<div class="col-lg-12">
								<label>Title Thesis Search</label>
								<div class="d-flex">
									<?php 
										$data = array(
											'id' => 'thesis_judul',
											'name' => 'thesis_judul',
											'class' => 'form-control form-control-sm form-control form-control-sm-sm',
											'required' => 'true',
											'autocomplete' => 'off',
											'style' => 'border-radius:0;outline:none'
										);
										echo form_input($data);
									?>
									<button id="cari" type="submit" class="btn btn-info" style="border-radius: 0;">Search</button>
								</div>
								<span id="list"></span>
							</div>
							<hr />
							<div class="col-lg-12 mt-4">
								<h5>List of My Theses</h5>
								<div class="table-responsive">
									<table class="table table-sm table-striped table-bordered" id="dtDiv">
										<thead>
											<tr>
												<th class="cells-number" data-priority="1">Status</th>
												<th>Title</th>
												<th>NIM</th>
												<th>Students</th>
												<th>Notes</th>
												<th class="none">Aim</th>
												<th class="none">Formulation</th>
												<th class="none">Framework</th>
												<th class="none">Methodology</th>
												<th class="text-center"><i class="fa fa-cogs"></i></th>
											</tr>
										</thead>
										<tbody></tbody>
									</table>
								</div>
							</div>
						</div>
					<?= form_close() ?>
				<?php endif ?>
			</div>
			<?php if($this->session->userdata('access')=="LVL19011700003") : ?>
				<div class="card-footer">
					<?= form_open('',array('id' => 'FrmSend')) ?>
						<button id="kirim" type="submit" class="btn btn-success" style="border-radius:0;display:none">Send</button>
					<?= form_close() ?>
					<a id="reset" href="<?= base_url('thesis/dashboard') ?>" class="btn btn-danger" style="border-radius:0;">Reset</a>
				</div>
			<?php endif ?>
		</div>
		<div class="modal fade bd-example-modal-lg" id="DivMod" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
			<div class="modal-dialog modal-lg" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title"><i class="fa fa-user-tie mr-3"></i> Forms</h5>
					</div>
					<?= form_open("#",array('id' => 'FrmDiv')) ?>
						<div class="modal-body">
							<div class="row">
								<div class="col-md-4">
									<div class="form-group">
										<label for="">System Code <span class="text-muted"><i>leave it default</i></span></label>
										<?php
											$data = array(
												'name' => 'thesis_id',
												'id' => 'thesis_id',
												'class' => 'form-control form-control-sm',
												'readonly' => 'true',
												'required' => 'true',
												'autocomplete' => 'off'
											);
											echo form_input($data);
										?>
									</div>
								</div>
								<div class="col-md-8">
									<div class="form-group">
										<label for="">Title <span class="text-muted"><i>*required*</i></span></label>
										<?php
											$data = array(
												'name' => 'thesis_judul',
												'id' => 'thesis_judul',
												'class' => 'form-control form-control-sm',
												'required' => 'true',
												'autocomplete' => 'off'
											);
											echo form_input($data);
										?>
									</div>
								</div>
								<?php if($this->session->userdata('access')=="LVL19011700001") : ?>
									<div class="col-md-12">
										<div class="form-group">
											<label for="">Students <span class="text-muted"><i>*Required*</i></span></label>
											<?php
												$data = array(
													'name' => 'user_id',
													'id' => 'user_id',
													'class' => 'form-control form-control-sm',
													'required' => 'true'
												);
												$option = array(
													'' => ''
												);
												echo form_dropdown($data,$option);
											?>
										</div>
									</div>
									<script>
										$("#user_id").select2({
											placeholder: "-- PICK A STUDENTS --",
										});
										
										$.ajax({
											url: "<?= base_url('mahasiswa/dashboard/options/') ?>",
											type: "GET",
											dataType: "json",
											success:function(data) {
												$.each(data, function(key, value) {
													$('#user_id').append('<option value="'+ value.id +'">'+ value.text +'</option>');
												});
											}
										});
									</script>
								<?php endif ?>
								<div class="col-md-6">
									<div class="form-group">
										<label for="">Aim <span class="text-muted"><i>*Fillable after approved*</i></span></label>
										<?php
											$data = array(
												'name' => 'thesis_tujuan',
												'id' => 'thesis_tujuan',
												'class' => 'form-control form-control-sm',
												'autocomplete' => 'off',
												'rows' => '2'
											);
											echo form_textarea($data);
										?>
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
										<label for="">Formulation <span class="text-muted"><i>*Fillable after approved*</i></span></label>
										<?php
											$data = array(
												'name' => 'thesis_rumusan_masalah',
												'id' => 'thesis_rumusan_masalah',
												'class' => 'form-control form-control-sm',
												'autocomplete' => 'off',
												'rows' => '2'
											);
											echo form_textarea($data);
										?>
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
										<label for="">Framework <span class="text-muted"><i>*Fillable after approved*</i></span></label>
										<?php
											$data = array(
												'name' => 'thesis_kerangka_teori',
												'id' => 'thesis_kerangka_teori',
												'class' => 'form-control form-control-sm',
												'autocomplete' => 'off',
												'rows' => '2'
											);
											echo form_textarea($data);
										?>
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
										<label for="">Methodology <span class="text-muted"><i>*Fillable after approved*</i></span></label>
										<?php
											$data = array(
												'name' => 'thesis_metodologi_penelitian',
												'id' => 'thesis_metodologi_penelitian',
												'class' => 'form-control form-control-sm',
												'autocomplete' => 'off',
												'rows' => '2'
											);
											echo form_textarea($data);
										?>
									</div>
								</div>
							</div>
						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-circle btn-secondary" data-dismiss="modal"><i class="fa fa-times mr-2"></i> Close</button>
							<button type="submit" class="btn btn-circle btn-primary"><i class="fa fa-check mr-2"></i> Save</button>
						</div>
					<?= form_close() ?>
				</div>
			</div>
		</div>
		<div class="modal fade bd-example-modal-lg" id="DivTolak" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
			<div class="modal-dialog modal-lg" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title"><i class="fa fa-user-tie mr-3"></i> Reject?</h5>
					</div>
					<?= form_open("#",array('id' => 'FrmTolak')) ?>
						<div class="modal-body">
							<div class="row">
								<div class="col-md-2">
									<div class="form-group">
										<label for="">System Code <span class="text-muted"><i>leave it default</i></span></label>
										<?php
											$data = array(
												'name' => 'thesis_id',
												'id' => 'thesis_id',
												'class' => 'form-control form-control-sm',
												'readonly' => 'true',
												'required' => 'true',
												'autocomplete' => 'off'
											);
											echo form_input($data);
										?>
									</div>
								</div>
								<div class="col-md-10">
									<div class="form-group">
										<label for="">Notes for Students <span class="text-muted"><i>*Required*</i></span></label>
										<?php
											$data = array(
												'name' => 'thesis_keterangan',
												'id' => 'thesis_keterangan',
												'class' => 'form-control form-control-sm',
												'required' => 'true',
												'autocomplete' => 'off'
											);
											echo form_input($data);
										?>
									</div>
								</div>
							</div>
						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-circle btn-secondary" data-dismiss="modal"><i class="fa fa-times mr-2"></i> Close</button>
							<button type="submit" class="btn btn-circle btn-primary"><i class="fa fa-check mr-2"></i> Save changes</button>
						</div>
					<?= form_close() ?>
				</div>
			</div>
		</div>
	</div>
</div>
<?php $this->load->view('thesis/js/js_page_dashboard') ?>