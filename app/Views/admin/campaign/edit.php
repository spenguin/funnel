<h2><?php echo esc($title); ?></h2>
<p><a href="/admin">Cancel</a></p>

<form action="/admin/<?php echo $campaign['id']; ?>" method="post">
    <label for="name">Name: <input type="text" name="name" value="<?php echo $campaign['name']; ?>" required /></label>
    <label for="description">Description:<textarea name="description"><?php echo $campaign['description']; ?></textarea>
    <label for="sample_url">Sample URL:<input type="text" name="sample_url" value="<?php echo $campaign['sample_url']; ?>" /></label>
    <label for="pledge_goal">Pledge Goal:<input type="int" name="pledge_goal" value="<?php echo $campaign['pledge_goal']; ?>" /></label>

    <input type="submit" class="button" name="submit" value="Submit" />
</form>