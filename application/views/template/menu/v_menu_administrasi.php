<div class="list-group">
	<a href="<?= base_url('administrasi/dashboard'); ?>" class="<?php if($Title=='Administrasi') : echo 'active'; endif; ?> list-group-item"><i class="fa fa-list-alt"></i> &nbsp; Beranda</a>
	<a href="<?= base_url('pendaftaran/rekap/administrasi/'); ?>" class="<?php if($Title=='Rekap Data Administrasi') : echo 'active'; endif; ?> list-group-item"><i class="fa fa-list-alt"></i> &nbsp; Rekap Data Pembayaran</a>
	<a href="<?= base_url('pendaftaran/rekap/kunjungan/'); ?>" class="<?php if($Title=='Rekap Data Pendaftaran') : echo 'active'; endif; ?> list-group-item"><i class="fa fa-list-alt"></i> &nbsp; Rekap Data Pendaftaran</a>
</div>