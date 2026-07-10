<!-- Declare the master template path -->
<?= $this->extend('layouts/admin') ?>

<!-- Inject the title section -->
<?= $this->section('title') ?>
    Campaigns
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
	<p><a href="/campaigns/create">Create New Campaign</a></p>
	<table>
		<thead>
			<tr>
				<td>id</td>
				<td>Name</td>
				<td>Description</td>
				<td>Goal</td>
				<td>Count</td>    
				<td>Gap</td>
				<td>%</td>
				<td>Created</td>
				<td>Status</td>
				<td>&nbsp;</td>
			</tr>
		</thead>
		<tbody>
			<?php 
				if( !empty($campaigns) && is_array($campaigns)):
					foreach( $campaigns as $key => $campaign )
					{ ?>
						<tr>
							<td><a href="/campaigns/<?php echo $campaign['id']; ?>"><?php echo $campaign['id']; ?></a></td>
							<td><?php echo $campaign['name']; ?></td>
							<td><?php echo $campaign['description']; ?></td>
							<td><?php echo $campaign['pledge_goal']; ?></td>
							<td><?php echo $campaign['pledge_count']; ?></td>
							<td><?php echo $campaign['pledge_goal'] - $campaign['pledge_count']; ?></td>
							<td>0</td>
							<td><?php echo $campaign['createdAt']; ?></td>
							<td><?php echo $campaign['status']; ?></td>
							<td><a href="/campaigns/delete/<?php echo $key; ?>">X</a></td>
						</tr>
					<?php }

				else: ?>

					<h3>No campaigns</h3>
				
			<?php endif; ?>
		</tbody>
	</table>

<?= $this->endSection() ?>
