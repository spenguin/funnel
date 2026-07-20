<?php echo $this->extend('layouts/admin' ); ?>

<?php echo $this->section('title'); ?>
	Create or Edit File
<?php echo $this->endSection(); ?>

<?php echo $this->section('navigation'); ?>
	<nav>
		<a href="<?= base_url('/') ?>">Home</a> | 
		<a href="<?= base_url('/about') ?>">About</a> |
		<?php $session = session(); ?>
		<?php if( is_null($session->logged) ): ?>
			<a href="<?= base_url('/login') ?>">Login</a>
		<?php else: ?>
			<a href="<?= base_url('/logout') ?>">Logout</a>
		<?php endif; ?>
	</nav>
<?php echo $this->endSection(); ?>

<?php echo $this->section('content'); ?>
	<p>Create or Update File</p>

<?php echo $this->endSection(); ?>