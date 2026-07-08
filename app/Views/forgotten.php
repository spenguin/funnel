<!-- Declare the master template path -->
<?= $this->extend('layouts/public') ?>

<!-- Inject the title section -->
<?= $this->section('page-title') ?>
    Forgotten your password?
<?= $this->endSection() ?>

<!-- Inject the navigation section -->
<?php echo $this->section('form'); ?>
    <form action="/forgotten" method="post">
        <label for="username">Username or Email:</label>
        <input type="text" name="username" required>
        <br>
        <button type="submit">Submit</button>
        <p><a href="/login">Return to Login</a></p>
    </form>
<?php echo $this->endSection(); ?>

<!-- Inject the content section -->
<?= $this->section('footer') ?>
    <h1>Welcome to our Soaring Penguin Press Campaign Manager</h1>
<?= $this->endSection() ?>

