<!-- Declare the master template path -->
<?= $this->extend('layouts/admin') ?>

<!-- Inject the title section -->
<?= $this->section('title') ?>
    Emails
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
    <a href="<?php echo base_url('/emails/create' ); ?>">Create Email</a>
    <a href="<?php echo base_url('/emails/send' ); ?>">Send Email</a>
    <table>
        <thead>
            <tr>
                <td>Id</td>
                <td>Campaign Id</td>
                <td>File Name</td>
                <td>Preceding Email</td>
                <td>Email Delay</td>
                <td>Send</td>
            </tr>
        </thead>
        <tbody>
            <?php
                foreach( $emails as $email ): ?>
                    <tr>
                        <td><a href=""><?php echo $email['id']; ?></a></td>
                        <td><?php echo $email['campaign_id']; ?></td>
                        <td><a href="/files/view/<?php echo $email['name']; ?>" target="_blank"><?php echo $email['name']; ?></a></td>
                        <td><?php echo $email['preceding_file_id']; ?></td>
                        <td><?php echo $email['file_delay']; ?></td>
                        <td><a href="emails/sendEmail/<?php echo $email['id']; ?>">Send email</a></td>
                    </tr>
                <?php endforeach; ?>
        </tbody>
    </table>
<?= $this->endSection() ?>
