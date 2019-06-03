<div class="row">
	<div class="col-lg-12">
		<?php if($this->session->userdata('access')=="LVL19011700001") : ?>
			<div class="row m-0">
				<div class="col-lg-12 mt-4 mb-0">
					<div class="jumbotron">
						<h1>Hello, <?= $this->session->userdata('nama') ?></h1>
						<p>You entered the <?= $this->session->userdata('level') ?> account. Please use this tools wisely!</p>
					</div>
				</div>
				<div class="col-lg-4 mt-4">
					<div class="card bg-success enable-shadow">
						<div class="card-header">
							<h4 class="text-white text-center card-title">
								<i class="fa fa-user-tie"></i>
								Lecturer Database
							</h4>
							<hr />
						</div>
						<div class="card-footer">
							<p class="card-text"><a href="<?= base_url('dosen/dashboard'); ?>" class="btn btn-block btn-secondary">Access Module</a></p>
						</div>
					</div>
				</div>
				<div class="col-lg-4 mt-4">
					<div class="card bg-success enable-shadow">
						<div class="card-header">
							<h4 class="text-white text-center card-title">
								<i class="fa fa-user-graduate"></i>
								Student Database
							</h4>
							<hr />
						</div>
						<div class="card-footer">
							<p class="card-text"><a href="<?= base_url('mahasiswa/dashboard'); ?>" class="btn btn-block btn-secondary">Access Module</a></p>
						</div>
					</div>
				</div>
				<div class="col-lg-4 mt-4">
					<div class="card bg-success enable-shadow">
						<div class="card-header">
							<h4 class="text-white text-center card-title">
								<i class="fa fa-book"></i>
								Thesis Database
							</h4>
							<hr />
						</div>
						<div class="card-footer">
							<p class="card-text"><a href="<?= base_url('thesis/dashboard'); ?>" class="btn btn-block btn-secondary">Access Module</a></p>
						</div>
					</div>
				</div>
			</div>
		<?php elseif($this->session->userdata('access')=="LVL19011700002") : ?>
			<div class="row m-0">
				<div class="col-lg-12 mt-4 mb-0">
					<div class="jumbotron">
						<h1>Hello, <?= $this->session->userdata('nama') ?></h1>
						<p>You entered the <?= $this->session->userdata('level') ?> account. Please use this tools wisely!</p>
					</div>
				</div>
				<div class="col-lg-6 mt-4">
					<div class="card bg-success enable-shadow">
						<div class="card-header">
							<h4 class="text-white text-center card-title">
								<i class="fa fa-book"></i>
								Thesis Approval
							</h4>
							<hr />
						</div>
						<div class="card-footer">
							<p class="card-text"><a href="<?= base_url('thesis/dashboard'); ?>" class="btn btn-block btn-secondary">Access Module</a></p>
						</div>
					</div>
				</div>
				<div class="col-lg-6 mt-4">
					<div class="card bg-success enable-shadow">
						<div class="card-header">
							<h4 class="text-white text-center card-title">
								<i class="fa fa-clock"></i>
								Schedule a Thesis
							</h4>
							<hr />
						</div>
						<div class="card-footer">
							<p class="card-text text-white"><a href="<?= base_url('jadwal/dashboard') ?>" class="btn btn-block btn-secondary">Access Module</a></p>
						</div>
					</div>
				</div>
			</div>
		<?php elseif($this->session->userdata('access')=="LVL19011700003") : ?>
			<div class="row m-0">
				<div class="col-lg-12 mt-4 mb-0">
					<div class="jumbotron">
						<h1>Hello, <?= $this->session->userdata('nama') ?></h1>
						<p>You entered the <?= $this->session->userdata('level') ?> account. Please use this tools wisely!</p>
					</div>
				</div>
				<div class="col-lg-4 mt-4">
					<div class="card bg-success enable-shadow">
						<div class="card bg-success enable-shadow">
						<div class="card-header">
							<h4 class="text-white text-center card-title">
								<i class="fa fa-user-graduate"></i>
								My Profile
							</h4>
							<hr />
						</div>
						<div class="card-footer">
							<p class="card-text"><a href="<?= base_url('mahasiswa/dashboard'); ?>" class="btn btn-block btn-secondary">Access Module</a></p>
						</div>
					</div>
					</div>
				</div>
				<div class="col-lg-4 mt-4">
					<div class="card bg-success enable-shadow">
						<div class="card-header">
							<h4 class="text-white text-center card-title">
								<i class="fa fa-book"></i>
								My Thesis
							</h4>
							<hr />
						</div>
						<div class="card-footer">
							<p class="card-text"><a href="<?= base_url('thesis/dashboard'); ?>" class="btn btn-block btn-secondary">Access Module</a></p>
						</div>
					</div>
				</div>
				<div class="col-lg-4 mt-4">
					<div class="card bg-success enable-shadow">
						<div class="card-header">
							<h4 class="text-white text-center card-title">
								<i class="fa fa-clock"></i>
								My Schedule
							</h4>
							<hr />
						</div>
						<div class="card-footer">
							<p class="card-text text-white"><a href="<?= base_url('jadwal/dashboard') ?>" class="btn btn-block btn-secondary">Access Module</a></p>
						</div>
					</div>
				</div>
			</div>
		<?php endif ?>
	</div>
</div>