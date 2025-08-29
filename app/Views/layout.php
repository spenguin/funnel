<?php
/**
 * Layout file
 */
?>
<?php echo view('common/header', $this->data) ?>

    <main>
        <?php echo $this->renderSection('content') ?>
    </main>

<?php echo view('common/footer'); ?>