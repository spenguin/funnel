<!-- Declare the master template path -->
<?= $this->extend('layouts/master') ?>

<!-- Inject the title section -->
<?= $this->section('title') ?>
    Home Page - Welcome
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
    <h1>Welcome to our Website</h1>
    <p>This paragraph is injected directly into the master layout content section.</p>
<?= $this->endSection() ?>
