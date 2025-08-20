<?php echo $this->extend('layout'); ?>

<?php echo $this->section('content') ?>
    <h1>Login</h1>
    <?php echo form_open( 'login' ); ?>
        <?php //echo validation_errors('<span class="error">', '</span>'); ?>
        <?php echo form_label( 'Username' ) . form_input( 'username' ); ?>
        <?php echo form_label( 'Password' ) . form_password( 'password' ); ?>
        <?php echo form_submit( 'submit', 'Submit' ); ?>
<?php echo form_close(); ?>
<?php echo $this->endSection() ?>




