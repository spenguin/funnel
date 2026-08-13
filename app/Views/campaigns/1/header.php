<?php
/**
 * Header file
 */
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title><?php echo $this->data['title']; ?></title>
	<meta name="description" content="<?php echo $this->data['description']; ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="shortcut icon" type="image/png" href="/favicon.ico"/>
    <link rel="stylesheet" href=" <?php echo base_url(); ?>/assets/css/preview.css">
	<link rel="stylesheet" href=" <?php echo base_url(); ?>/<?php echo $this->data['slug']; ?>/css/<?php echo $this->data['slug']; ?>.css">
</head>
<body class="<?php echo $this->data['_controller'] . ' ' . $this->data['slug']; ?>">
	<header>

	</header>
	<div class="container">