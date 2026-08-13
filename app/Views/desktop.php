<!-- Declare the master template path -->
<?= $this->extend('layouts/admin') ?>

<!-- Inject the title section -->
<?= $this->section('title') ?>
    Desktop
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
    <?php 
        if( isset($title) )
        {
            switch ($title)
            {
                case 'desktop':
                    ?>
                    <h1>Campaign control</h1>
                    <p>This is where you create or maintain Campaigns</p>
                    <?php
                    var_dump($campaigns);
                    break;
            }
        }
    ?>



<?= $this->endSection() ?>
