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
    <table>
        <?php 
            foreach( $customers as $customer ): //var_dump($customer); ?>
                <tr>
                    <td><?php echo $customer['id']; ?></td>
                    <td><?php echo $customer['name']; ?></td>
                    <td><?php echo $customer['email']; ?></td>
                    <td><?php echo $customer['campaign_email_sent']; ?></td>
                    <td><?php echo $customer['paid']; ?></td>
                </tr>
            <?php endforeach;
        ?>
    </table>
    <p>File Types created</p>
    <table>
        <?php 
            foreach( $files as $file ): ?>
                <tr>
                    <td><?php echo $file['id']; ?></td>
                    <td><?php echo $file['file_type_id']; ?></td>
                    <td><a href="/files/view/<?php echo $file['name']; ?>" target="_blank"><?php echo $file['name']; ?></a></td>
                    <td><?php echo $file['preceding_file_id']; ?></td>
                    <td><?php echo $file['file_delay']; ?></td>
                </tr>

        <?php endforeach; ?>
    </table>


<?php echo $this->endSection(); ?>