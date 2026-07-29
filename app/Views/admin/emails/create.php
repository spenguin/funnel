<!-- Declare the master template path -->
<?= $this->extend('layouts/admin') ?>

<!-- Inject the title section -->
<?= $this->section('title') ?>
    Create Email
<?= $this->endSection() ?>

<!-- Inject the navigation section -->
<?php echo $this->section('navigation'); ?>
    <nav>
        <a href="<?= base_url('/') ?>">Home</a> | 
        <a href="<?= base_url('/campaigns') ?>">Campaigns</a> |
        <a href="<?= base_url('/emails') ?>">Emails</a> |
        <a href="<?= base_url('/logout') ?>">Logout</a>
    </nav>
<?php echo $this->endSection(); ?>

<!-- Inject the content section -->
<?= $this->section('content') ?>
    <form method="post" action="/emails/create" style="width: 600px;margin: 0 auto;">
        <label for="emailSubject">Email Subject:</label>
        <input type="text" name="emailSubject" /><br>
        <label for="campaign">Campaign:</label>
        <select name="campaign">
            <option value=0>All Customers</option>
        </select><br>
        <label for="emailBody">Email Body:</label>
        <textarea name="emailBody" required style="height: 700px;"></textarea>
        <input type="submit" name="submit" value="Create Email" />
    </form>
<?= $this->endSection() ?>
