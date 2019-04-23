<div class="col-12 mt-5">
	<div class="pl-3 py-4">
		<div class="card card-light enable-shadow">
			<div class="card-header bg-secondary text-white">
				<h4 class="card-title mb-0">
					<i class="fa fa-cogs mr-2"></i> Data <?= $Title ?>
					<div class="float-none float-md-right mt-2 mt-md-0">
						<a href="#" class="btn btn-sm btn-block btn-light" role="button" data-toggle="modal" data-target="#DivMod"><i class="fa fa-plus mr-2"></i> Tambah <?= $Title ?></a>
					</div>
					<div class="float-none float-md-right mt-2 mt-md-0 mr-md-1">
						<a href="<?= base_url('user/dashboard') ?>" class="btn btn-sm btn-block btn-light"><i class="fa fa-home mr-2"></i> Beranda</a>
					</div>
				</h4>
			</div>
			<div class="card-body">
				<div class="table-responsive">
					<table class="table table-sm table-striped table-bordered" id="dtDiv">
						<thead>
							<tr>
								<th>Penempatan</th>
								<th>Pengecualian Kata</th>
								<th>Maksimum Kata</th>
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
						<h5 class="modal-title"><i class="fa fa-cogs mr-3"></i> Tambah Data <?= $Title ?></h5>
					</div>
					<?= form_open("#",array('id' => 'FrmDiv')) ?>
						<div class="modal-body">
							<div class="row">
								<div class="col-md-6">
									<div class="form-group">
										<label for="">Kode <?= $Title ?></label>
										<?php
											$data = array(
												'name' => 'kata_id',
												'id' => 'kata_id',
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
										<label for="">Penempatan <?= $Title ?></label>
										<?php
											$data = array(
												'name' => 'kata_input',
												'id' => 'kata_input',
												'class' => 'form-control',
												'required' => 'true',
												'autocomplete' => 'off'
											);
											$option = array(
												'' => '',
												'Judul' => 'Judul',
												'Rumusan' => 'Rumusan',
												'Kerangka' => 'Kerangka'
											);
											echo form_dropdown($data,$option);
										?>
									</div>
								</div>
								<div class="col-md-8">
									<div class="form-group">
										<label for="">Pengecualian <?= $Title ?> (Gunakan tanda koma (,) untuk memisahkan)</label>
										<?php
											$data = array(
												'name' => 'kata_daftar',
												'id' => 'kata_daftar',
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
										<label for="">Maksimum <?= $Title ?></label>
										<?php
											$data = array(
												'name' => 'kata_maksimum',
												'type' => 'number',
												'min' => '0',
												'id' => 'kata_maksimum',
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
<?php $this->load->view('kata/js/js_page_dashboard') ?>