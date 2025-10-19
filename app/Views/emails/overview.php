<h2><?php echo esc($title); ?></h2>
<p><a href="/emails/create">Create New Email</a></p>
<table style="width:1000px;" >
    <thead>
        <tr>
            <td>id</td>
            <td>Campaign</td>
            <td>Email Type</td>
            <td>Subject</td>
        </tr>
    </thead>
    <tbody>
        <?php 
            if( !empty($campaign_emails) && is_array($campaign_emails)):
                foreach( $campaign_emails as $key => $email )
                { ?>
                    <tr>
                        <td><a href="/emails/<?php echo $email['id']; ?>"><?php echo $email['id']; ?></a></td>
                        <td><?php echo $campaigns[$email['campaign_id']]; ?></td>
                        <td><?php echo $email_types[$email['email_type_id']]; ?></td>
                        <td><?php echo $email['subject']; ?></td>
                        <td><a href="/emails/delete/<?php echo $key; ?>">X</a></td>
                    </tr>
                    <?php    
                }
            else: ?>
                <h3>No Emails</h3>
            <?php endif; ?>
    </tbody>
</table>