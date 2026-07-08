<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login</title>
</head>
<body>
    <h1><?= $this->renderSection('page-title') ?></h1>
    <?php if(session()->getFlashdata('msg')): ?>
        <div><?php echo session()->getFlashdata('msg'); ?></div>
    <?php endif; ?>
    <?php echo $this->renderSection('form'); ?>
    <?php echo $this->renderSection('footer'); ?>

</body>
</html>