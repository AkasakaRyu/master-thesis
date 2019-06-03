<div class="col-12">
	<div class="pl-3 py-4">
		<div class="card card-light enable-shadow">
			<div class="card-header bg-secondary text-white">
				<h4 class="card-title mb-0">
					<i class="fa fa-user-tie mr-2"></i> Lists
					<div class="float-none float-md-right mt-2 mt-md-0">
						<a href="#" class="btn btn-sm btn-block btn-light" role="button" data-toggle="modal" data-target="#DivMod"><i class="fa fa-plus mr-2"></i> Add</a>
					</div>
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
								<th>NIP</th>
								<th>Name</th>
								<th>Email</th>
								<th class="none">Address</th>
								<th>Phone Number</th>
								<th>Quota</th>
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
								<div class="col-md-6">
									<div class="form-group">
										<label for="">System Code <span class="text-muted"><i>leave it empty</i></span></label>
										<?php
											$data = array(
												'name' => 'dosen_id',
												'id' => 'dosen_id',
												'class' => 'form-control',
												'readonly' => 'true',
												'required' => 'true',
												'autocomplete' => 'off'
											);
											echo form_input($data);
										?>
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
										<label for="">NIP <span class="text-muted"><i>*required*</i></span></label>
										<?php
											$data = array(
												'name' => 'dosen_nip',
												'type' => 'number',
												'min' => '0',
												'id' => 'dosen_nip',
												'class' => 'form-control',
												'required' => 'true',
												'autocomplete' => 'off'
											);
											echo form_input($data);
										?>
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
										<label for="">Name <span class="text-muted"><i>*required*</i></span></label>
										<?php
											$data = array(
												'name' => 'dosen_nama',
												'id' => 'dosen_nama',
												'class' => 'form-control',
												'required' => 'true',
												'autocomplete' => 'off'
											);
											echo form_input($data);
										?>
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
										<label for="">Email <span class="text-muted"><i>*required*</i></span></label>
										<?php
											$data = array(
												'name' => 'dosen_email',
												'type' => 'email',
												'id' => 'dosen_email',
												'class' => 'form-control',
												'required' => 'true',
												'autocomplete' => 'off'
											);
											echo form_input($data);
										?>
									</div>
								</div>
								<div class="col-md-12">
									<div class="form-group">
										<label for="">Address <span class="text-muted"><i>*required*</i></span></label>
										<?php
											$data = array(
												'name' => 'dosen_alamat',
												'id' => 'dosen_alamat',
												'class' => 'form-control',
												'required' => 'true',
												'autocomplete' => 'off'
											);
											echo form_input($data);
										?>
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
										<label for="">Phone Number <span class="text-muted"><i>*required*</i></span></label>
										<?php
											$data = array(
												'name' => 'dosen_kontak',
												'type' => 'number',
												'min' => '0',
												'id' => 'dosen_kontak',
												'class' => 'form-control',
												'required' => 'true',
												'autocomplete' => 'off'
											);
											echo form_input($data);
										?>
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
										<label for="">Quota <span class="text-muted"><i>*required*</i></span></label>
										<?php
											$data = array(
												'name' => 'dosen_kuota',
												'type' => 'number',
												'min' => '0',
												'id' => 'dosen_kuota',
												'class' => 'form-control',
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
<?php $this->load->view('dosen/js/js_page_dashboard') ?>