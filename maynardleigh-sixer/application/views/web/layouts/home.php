<?php $this->load->view('web/layouts/header'); ?>
<?php echo isset($template['partials']['top'])?$template['partials']['top']:""; ?>
<?php echo $template['body']; ?>
<?php echo isset($template['partials']['bottom'])?$template['partials']['bottom']:""; ?>
<?php $this->load->view('web/layouts/footer'); ?>
