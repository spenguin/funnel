<!-- Declare the master template path -->
<?= $this->extend('layouts/admin') ?>

<!-- Inject the title section -->
<?= $this->section('title') ?>
    Campaign Details
<?= $this->endSection() ?>

<!-- Inject the navigation section -->
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

<!-- Inject the content section -->
<?= $this->section('content') ?>
    <p>Campaign Details</p>
    <p>Customers</p>
    <ul>
        <?php 
            foreach( $customers as $customer ): ?>
                <li><?php echo $customer['customer_id']; ?>
            <?php endforeach;
        ?>
    </ul>
    <p>File Types created</p>

<?php echo $this->endSection(); ?>