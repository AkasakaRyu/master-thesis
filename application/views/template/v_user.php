<div class="card card-primary" style="border-radius: 3px;">
	<div class="card-body">
		<h4 class="card-title text-center"><?= $this->session->userdata('nama') ?></h4>
		<p class="card-text text-center">Login Terakhir : <?= $this->session->userdata('last_login') ?></p>
	</div>
	<div class="card-footer text-center">
		<a href="" class="btn btn-warning"><i class="fa fa-cog"></i> Settings</a>
	</div>
</div>
<?php $this->load->view('template/menu/'.$Menu); ?>
