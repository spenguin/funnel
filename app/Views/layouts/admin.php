<!doctype html>
<html lang="en" dir="ltr">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <title><?= $this->renderSection('title') ?></title>
        <link rel="shortcut icon" href="<?= base_url('assets/admin/images/favicon.ico') ?>">
        <link rel="stylesheet" href="<?php echo base_url('/css/admin/styles.css'); ?>">
    </head>
    <body>
        <div class="container">
            <aside class="sidebar">
                <h4>SPP Funnel</h4>
                <nav>
                    <?php echo $this->renderSection('navigation'); ?>
                    <!-- <a href="">Home</a>
                    <a href="/campaigns">Campaigns</a>
                    <a href="/logout">Logout</a>
                </nav> -->
            </aside>
            <main class="main">
                <?php echo $this->renderSection('content'); ?>
            </main>
        </div>
    </body>
</html>