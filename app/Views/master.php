<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?= $this->renderSection('title') ?></title>
    <!-- Assets are placed relative to the public folder -->
    <link rel="stylesheet" href="<?= base_url('css/styles.css') ?>">
</head>
<body>

    <header>
        <nav>
            <a href="<?= base_url('/') ?>">Home</a> | 
            <a href="<?= base_url('/about') ?>">About</a>
        </nav>
    </header>

    <main>
        <!-- The page view content injected here -->
        <?= $this->renderSection('content') ?>
    </main>

    <footer>
        <p>&copy; <?= date('Y') ?> My Web Application</p>
    </footer>

</body>
</html>
