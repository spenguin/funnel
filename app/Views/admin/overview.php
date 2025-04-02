<h2><?php echo esc($title); ?><h2>
<p><a href="/admin/edit">Create New Campaign</a></p>
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
        </tr>
    </thead>
    <tbody>
        <?php 
            if( !empty($campaigns) && is_array($campaigns)):
                foreach( $campaigns as $key => $campaign )
                { ?>
                    <tr>
                        <td><?php echo $key; ?></td>
                        <td><?php echo $campaign['name']; ?></td>
                        <td><?php echo $campaign['description']; ?></td>
                        <td><?php echo $campaign['pledge_goal']; ?></td>
                        <td><?php echo $campaign['pledge_count']; ?></td>
                        <td><?php echo $campaign['pledge_goal'] - $campaign['pledge_count']; ?></td>
                        <td>0</td>
                        <td><?php echo $campaign['createdAt']; ?></td>
                        <td><?php echo $campaign['status']; ?></td>
                    </tr>
                <?php }

            else: ?>

                <h3>No campaigns</h3>
            
        <?php endif; ?>
    </tbody>
</table>