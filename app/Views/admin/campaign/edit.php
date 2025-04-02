<h2><h2><?php echo esc($title); ?></h2>
<p><a href="/admin">Cancel</a></p>

<form action="/admin/edit" method="post">
    <label for="name">Name: <input type="text" name="name" required /></label>
    <label for="description">Description:<textarea name="description"></textarea>
    <label for="sample_url">Sample URL:<input type="text" name="sample_url"/></label>
    <label for="goal">Pledge Goal:<input type="int" name="goal" /></label>

    <input type="submit" class="button" name="submit" value="Submit" />
</form>