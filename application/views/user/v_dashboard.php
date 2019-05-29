<div class="row">
	<div class="col-lg-12">
		<?php if($this->session->userdata('level')=="Master") : ?>
			<div class="row m-0">
				<div class="col-lg-6 mt-4">
					<div class="card bg-success enable-shadow">
						<div class="card-header">
							<h4 class="text-white text-center card-title">
								<i class="fa fa-user-tie"></i>
								Database Dosen
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
								Database Mahasiswa
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
				<div class="col-lg-12 mt-4">
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
			</div>
		<?php elseif($this->session->userdata('level')=="Mahasiswa") : ?>
			<div class="row m-0">
				<div class="col-lg-6 mt-4">
					<div class="card bg-success enable-shadow">
						<div class="card bg-success enable-shadow">
						<div class="card-header">
							<h4 class="text-white text-center card-title">
								<i class="fa fa-user-graduate"></i>
								Profil Saya
							</h4>
							<hr />
						</div>
						<div class="card-footer">
							<p class="card-text"><a href="<?= base_url('mahasiswa/dashboard'); ?>" class="btn btn-block btn-secondary">Akses Modul</a></p>
						</div>
					</div>
					</div>
				</div>
				<div class="col-lg-6 mt-4">
					<div class="card bg-success enable-shadow">
						<div class="card-header">
							<h4 class="text-white text-center card-title">
								<i class="fa fa-book"></i>
								Thesis Saya
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
							Jadwal Ujian Saya
						</h4>
						<hr />
					</div>
					<div class="card-footer">
						<p class="card-text text-white"><a href="<?= base_url('jadwal/dashboard') ?>" class="btn btn-block btn-secondary">Akses Modul</a></p>
					</div>
				</div>
			</div>
		<?php elseif($this->session->userdata('level')=="Kepala Jurusan") : ?>
			<div class="row m-0">
				<div class="col-lg-6 mt-4">
					<div class="card bg-success enable-shadow">
						<div class="card-header">
							<h4 class="text-white text-center card-title">
								<i class="fa fa-user-tie"></i>
								Database Dosen
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
								Database Mahasiswa
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
				<div class="col-lg-6 mt-4">
					<div class="card bg-success enable-shadow">
						<div class="card-header">
							<h4 class="text-white text-center card-title">
								<i class="fa fa-clock"></i>
								Jadwal Ujian
							</h4>
							<hr />
						</div>
						<div class="card-footer">
							<p class="card-text text-white"><a href="<?= base_url('jadwal/dashboard') ?>" class="btn btn-block btn-secondary">Akses Modul</a></p>
						</div>
					</div>
				</div>
			</div>
		<?php endif ?>
	</div>
</div>
<?php $this->load->view('user/js/js_page_dashboard') ?>