<header class="header">
    <div class="header__wrapper">
        <div class="header__text">
            <?php echo $heading; ?>
        </div>
        <div class="header__image">
            <img src="<?php echo base_url(); ?>/<?php echo $slug; ?>/images/cover-image.png" />
        </div>
    </div>
</header>


<div class="opening">
    <p>Opening</p>

</div>
<div class="videoblock">
    <p>Video block</p>
</div>
<?php if( isset($data['quote'][0]) ): ?>
    <div class="quote">
        <p>Quote</p>
    </div>
<?php endif; ?>
<div class="explanation">
    <p>Explanation</p>
</div>
<?php if( isset($data['quote'][1]) ): ?>
    <div class="quote">
        <p>Quote</p>
    </div>
<?php endif; ?>
<div class="description">
    <p>Description</p>
</div>
<?php if( isset($data['quote'][2]) ): ?>
    <div class="quote">
        <p>Quote</p>
    </div>
<?php endif; ?>
<div class="form">
    <form action="<?php echo base_url();?>/preview/<?php echo $this->data['slug']; ?>" method="post">
        <label for="name">Name: <input type="text" name="name" required/></label>
        <label for="email">Email: <input type="email" name="email" required/></label>
        <input type="submit" name="submit" value="I'd like to see it" />
    </form>
</div>