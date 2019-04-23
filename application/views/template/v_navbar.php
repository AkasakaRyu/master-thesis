<a href="<?= base_url() ?>" class="btn btn-light btn-single-circle mr-2 sidebar-control"><i class="fa fa-bars"></i></a>
<a href="" class="navbar-brand"><?= $this->session->userdata('sistem_name') ?></a>
<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarContent" aria-controls="navbarContent" aria-expanded="false" aria-label="Toggle navigation">
	<i class="fa fa-ellipsis-v"></i>
</button>

<div class="collapse navbar-collapse" id="navbarContent">
	<div class="py-2 py-md-0 ml-auto">
		<a href="<?= base_url('user/dashboard/logout') ?>" class="btn d-block d-md-inline text-left btn-light"><i class="fa fa-user-circle mr-2"></i> <?= $this->session->userdata('nama') ?></a>
	</div>
</div>