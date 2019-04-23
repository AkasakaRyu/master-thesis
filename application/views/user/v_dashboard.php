<div class="row">
	<div class="col-lg-12">
		<div class="row m-0">
			<div class="col-lg-6 mt-4">
				<div class="card bg-success enable-shadow">
					<div class="card-header">
						<h4 class="text-white text-center card-title">
							<i class="fa fa-user-tie"></i>
							Dosen
						</h4>
						<hr />
					</div>
					<div class="card-footer">
						<p class="card-text"><a href="<?= base_url('dosen/dashboard'); ?>" class="btn btn-block btn-secondary">Akses Modul</a></p>
					</div>
				</div>
			</div>
			<div class="col-lg-6 mt-4">
				<div class="card bg-success enable-shadow">
					<div class="card-header">
						<h4 class="text-white text-center card-title">
							<i class="fa fa-user-graduate"></i>
							Mahasiswa
						</h4>
						<hr />
					</div>
					<div class="card-footer">
						<p class="card-text"><a href="<?= base_url('mahasiswa/dashboard'); ?>" class="btn btn-block btn-secondary">Akses Modul</a></p>
					</div>
				</div>
			</div>
		</div>
		<div class="row m-0">
			<div class="col-lg-6 mt-4">
				<div class="card bg-success enable-shadow">
					<div class="card-header">
						<h4 class="text-white text-center card-title">
							<i class="fa fa-cogs"></i>
							Setting Kata
						</h4>
						<hr />
					</div>
					<div class="card-footer">
						<p class="card-text"><a href="<?= base_url('kata/dashboard'); ?>" class="btn btn-block btn-secondary">Akses Modul</a></p>
					</div>
				</div>
			</div>
			<div class="col-lg-6 mt-4">
				<div class="card bg-success enable-shadow">
					<div class="card-header">
						<h4 class="text-white text-center card-title">
							<i class="fa fa-book"></i>
							Thesis
						</h4>
						<hr />
					</div>
					<div class="card-footer">
						<p class="card-text"><a href="<?= base_url('thesis/dashboard'); ?>" class="btn btn-block btn-secondary">Akses Modul</a></p>
					</div>
				</div>
			</div>
		</div>
		<div class="col-lg-12 mt-4">
			<div class="card bg-success enable-shadow">
				<div class="card-header">
					<h4 class="text-white text-center card-title">
						<i class="fa fa-clock"></i>
						Jadwal Ujian
					</h4>
					<hr />
				</div>
				<div class="card-footer">
					<p class="card-text text-white"><a class="btn btn-block btn-secondary">Akses Modul</a></p>
				</div>
			</div>
		</div>
	</div>
</div>
<?php $this->load->view('user/js/js_page_dashboard') ?>