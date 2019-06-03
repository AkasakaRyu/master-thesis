<div class="col-12">
	<div class="pl-3 py-4">
		<div class="card card-light enable-shadow">
			<div class="card-header bg-secondary text-white">
				<h4 class="card-title mb-0">
					<i class="fa fa-user-tie mr-2"></i> Data
					<?php if($this->session->userdata('access')!="LVL19011700003") : ?>
						<div class="float-none float-md-right mt-2 mt-md-0">
							<a href="#" class="btn btn-sm btn-block btn-light" role="button" data-toggle="modal" data-target="#DivMod"><i class="fa fa-plus mr-2"></i> Add</a>
						</div>
					<?php endif ?>
					<div class="float-none float-md-right mt-2 mt-md-0 mr-md-1">
						<a href="<?= base_url('user/dashboard') ?>" class="btn btn-sm btn-block btn-light"><i class="fa fa-home mr-2"></i> Dashboard</a>
					</div>
				</h4>
			</div>
			<div class="card-body">
				<div class="table-responsive">
					<table class="table table-sm table-striped table-bordered" id="dtDiv">
						<thead>
							<tr>
								<th>Students</th>
								<th>Lecturer</th>
								<th>Date</th>
								<th class="text-right"><i class="fa fa-cogs"></i></th>
							</tr>
						</thead>
						<tbody></tbody>
					</table>
				</div>
			</div>
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
										<label for="">System Code <span class="text-muted"><i>leave default</i></span></label>
										<?php
											$data = array(
												'name' => 'jadwal_id',
												'id' => 'jadwal_id',
												'class' => 'form-control form-control-sm',
												'readonly' => 'true',
												'required' => 'true',
												'autocomplete' => 'off'
											);
											echo form_input($data);
										?>
									</div>
								</div>
								<div class="col-md-4">
									<div class="form-group">
										<label for="">Lecturer <span class="text-muted"><i>*Required*</i></span></label>
										<?php
											$data = array(
												'name' => 'dosen_id',
												'type' => 'number',
												'min' => '0',
												'id' => 'dosen_id',
												'class' => 'form-control form-control-sm',
												'required' => 'true',
												'autocomplete' => 'off'
											);
											$option = array(
												'' => ''
											);
											echo form_dropdown($data,$option);
										?>
									</div>
								</div>
								<div class="col-md-4">
									<div class="form-group">
										<label for="">Students <span class="text-muted"><i>*Required*</i></span></label>
										<?php
											$data = array(
												'name' => 'mahasiswa_id',
												'id' => 'mahasiswa_id',
												'class' => 'form-control form-control-sm',
												'required' => 'true',
												'autocomplete' => 'off'
											);
											$option = array(
												'' => ''
											);
											echo form_dropdown($data,$option);
										?>
									</div>
								</div>
								<div class="col-md-12">
									<div class="form-group">
										<label for="">Date <span class="text-muted"><i>*Required*</i></span></label>
										<?php
											$data = array(
												'name' => 'jadwal_tanggal',
												'type' => 'date',
												'id' => 'jadwal_tanggal',
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
							<button type="submit" class="btn btn-circle btn-primary"><i class="fa fa-check mr-2"></i> Save</button>
						</div>
					<?= form_close() ?>
				</div>
			</div>
		</div>
	</div>
</div>
<?php $this->load->view('jadwal/js/js_page_dashboard') ?>