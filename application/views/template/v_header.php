<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title><?= strtoupper($Title) ?> | <?= $this->session->userdata('sistem_name') ?></title>
<link href="<?= base_url('assets/bootstrap/css/bootstrap.min.css'); ?>" rel="stylesheet">
<link href="<?= base_url('assets/fontawesome/css/fontawesome.css'); ?>" rel="stylesheet">
<link href="<?= base_url('assets/select2/css/select2.min.css'); ?>" rel="stylesheet">
<link href="<?= base_url('assets/fath/css/main.css'); ?>" rel="stylesheet">
<link href="<?= base_url('assets/datatables/datatables.min.css'); ?>" rel="stylesheet">
<link href="<?= base_url('assets/pace/themes/purple/pace-theme-corner-indicator.css'); ?>" rel="stylesheet" >
<style media="screen">
  html {
    position: relative;
    min-height: 100%;
  }
  body {
    /* Margin bottom by footer height */
    margin-bottom: 60px;
  }
  .container .text-muted {
    margin: 20px 0;
  }
  .footer {
    bottom: 0;
    width: 100%;
    height: 60px;
    border-top: 1px solid #e7e7e7;
    position: absolute;
    background-color: #f8f8f8;
  }
  .input-group.date .input-group-addon{
    cursor: pointer;
  }
  .select2-container {
    padding: 0;
    padding-top: 2px;
    width: 100% !important;
  }
  .selec2-dropdown {
	z-index: 99999;
  }
  .select2-dropdown.increasezindex {
	z-index: 99999;
  }
</style>
<script src="<?= base_url('assets/jquery/jquery.min.js'); ?>"></script>
<script src="<?= base_url('assets/bootstrap/js/bootstrap.min.js'); ?>"></script>
<script src="<?= base_url('assets/select2/js/select2.min.js'); ?>"></script>
<script src="<?= base_url('assets/datatables/datatables.min.js'); ?>"></script>
<script src="<?= base_url('assets/pace/pace.min.js') ?>"></script>
<script src="<?= base_url('assets/sweetalert/sweetalert.min.js') ?>"></script>
<script>Pace.on("done", function(){ $(".cover").fadeOut(1000); });</script>
<script>
  $.ajaxSetup( {
    data: {
      '<?= $this->security->get_csrf_token_name() ?>': '<?= $this->security->get_csrf_hash() ?>'
    }
  });
</script>
