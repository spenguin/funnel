<?php echo $this->extend('layouts/admin' ); ?>

<?php echo $this->section('title'); ?>
	Display File
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
    <div style="width: 600px; margin:0 auto;" ?>
    	<?php echo $body; ?>
        <form method="post" action="/files/sendTest/<?php echo $fileName; ?>">
            <label for="testEmail">Test email address:</label>
            <input type="email" name="testEmail" required />
            <input type="submit" name="submit" value="Send Test Email" />
        </form>
    </div>
<?php echo $this->endSection(); ?>