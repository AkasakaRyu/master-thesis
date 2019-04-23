<div class="list-group">
	<a href="<?= base_url('settings/dashboard'); ?>" class="<?php if($Title=='Settings') : echo 'active'; endif; ?> list-group-item"><i class="fa fa-list-alt"></i> &nbsp; Beranda</a>
	<a href="<?= base_url('settings/user/'); ?>" class="<?php if($Title=='User') : echo 'active'; endif; ?> list-group-item"><i class="fa fa-list-alt"></i> &nbsp; User</a>
	<a href="<?= base_url('settings/layanan/'); ?>" class="<?php if($Title=='Layanan') : echo 'active'; endif; ?> list-group-item"><i class="fa fa-list-alt"></i> &nbsp; Layanan/Poli</a>
	<a href="<?= base_url('settings/barang/'); ?>" class="<?php if($Title=='Barang') : echo 'active'; endif; ?> list-group-item"><i class="fa fa-list-alt"></i> &nbsp; Barang</a>
	<a href="<?= base_url('settings/payment/'); ?>" class="<?php if($Title=='Payment') : echo 'active'; endif; ?> list-group-item"><i class="fa fa-list-alt"></i> &nbsp; Pembayaran</a>
	<a href="<?= base_url('settings/tindakan/'); ?>" class="<?php if($Title=='Tindakan') : echo 'active'; endif; ?> list-group-item"><i class="fa fa-list-alt"></i> &nbsp; Tindakan</a>
	<a href="<?= base_url('settings/penyakit/'); ?>" class="<?php if($Title=='Penyakit') : echo 'active'; endif; ?> list-group-item"><i class="fa fa-list-alt"></i> &nbsp; Penyakit</a>
</div>