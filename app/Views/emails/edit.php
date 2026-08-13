<h2><?php echo esc($title); ?></h2>
<p><a href="/emails">Cancel</a></p>

<?php echo form_open($action); ?>
    <label for="campaign_id">Campaign: <?php echo form_dropdown( 'campaign_id', $campaign_options, $campaign_email['campaign_id'] ); ?></label>
    <label for="email_type_id">Email Type: <?php echo form_dropdown( 'email_type_id', $email_type_options, $campaign_email['email_type_id'] ); ?></label>
    <label for="subject">Subject: <?php echo form_input('subject', $campaign_email['subject']); ?></label>
    <label for="body">Body: <?php echo form_textarea('body', $campaign_email['body']); ?></label>
    <?php echo form_submit('submit', 'Submit'); ?>
 <?php echo form_close(); ?>


