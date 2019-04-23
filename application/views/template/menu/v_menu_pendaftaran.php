<div class="list-group">
	<a href="<?= base_url('pendaftaran/dashboard'); ?>" class="<?php if($Title=='Pendaftaran') : echo 'active'; endif; ?> list-group-item"><i class="fa fa-list-alt"></i> &nbsp; Beranda</a>
	<a href="<?= base_url('pendaftaran/jadwal'); ?>" class="<?php if($Title=='Jadwal') : echo 'active'; endif; ?> list-group-item"><i class="fa fa-list-alt"></i> &nbsp; Jadwal Petugas Medis</a>
	<a href="<?= base_url('pendaftaran/rekap/kunjungan/'); ?>" class="<?php if($Title=='Rekap Data Pendaftaran') : echo 'active'; endif; ?> list-group-item"><i class="fa fa-list-alt"></i> &nbsp; Rekap Data Pendaftaran</a>
	<a href="<?= base_url('pendaftaran/rekap/pasien/'); ?>" class="<?php if($Title=='Rekap Data Pasien') : echo 'active'; endif; ?> list-group-item"><i class="fa fa-list-alt"></i> &nbsp; Rekap Data Pasien</a>
</div>