<?php echo $this->extend('layouts/admin' ); ?>

<?php echo $this->section('title'); ?>
	Create New campaign
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
	<p>Create New Campaign</p>
	<form method="post" action="/campaigns/create">
		<label for="name">Campaign Name:</label>
		<input type="text" name="name" required />
		<br>
		<label for="description">Description</label>
		<textarea name="description"></textarea>
		<br>
        <button type="submit" name="submit" value="submit">Create Campaign</button>
        <p><a href="/campaigns">Return to Campaigns Dashboard</a></p>
	</form>		
<?php echo $this->endSection(); ?>

