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
<div class="explanation">
    <h3>What we're trying to do</h3>
    <p>Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts. Separated they live in Bookmarksgrove right at the coast of the Semantics, a large language ocean. A small river named Duden flows by their place and supplies it with the necessary regelialia.</p>
</div>

<!-- <div class="opening">
    <p>Opening</p>

</div>
<div class="videoblock">
    <p>Video block</p>
</div> -->
<div class="quotes">
    <h3>What Readers Say</h3>
    <div class="quote__wrapper">
        <div class="quote">
            <p>“It's tough to find more honest and straight- forward marketing advice than what you'll get from these indie authors.”</p>
            <p class="quote__name">Janet Friedman</p>
            <p class="quote__title">Former Editor, Writer’s Digest</p>
        </div>
        <div class="quote">
            <p>“It's tough to find more honest and straight- forward marketing advice than what you'll get from these indie authors.”</p>
            <p class="quote__name">Janet Friedman</p>
            <p class="quote__title">Former Editor, Writer’s Digest</p>
        </div>
        <div class="quote">
            <p>“It's tough to find more honest and straight- forward marketing advice than what you'll get from these indie authors.”</p>
            <p class="quote__name">Janet Friedman</p>
            <p class="quote__title">Former Editor, Writer’s Digest</p>
        </div>  
    </div>    
</div>
<!-- <?php if( isset($data['quote'][0]) ): ?>
    <div class="quote">
        <p>Quote</p>
    </div>
<?php endif; ?> -->

<!-- <?php if( isset($data['quote'][1]) ): ?>
    <div class="quote">
        <p>Quote</p>
    </div>
<?php endif; ?> -->
<div class="book">
    <h3>About the Book</h3>
    <div class="book__wrapper">
        <p class="book__title">Salmonella Smorgasbord</p>
        <p>Page count: 256pp</p>
        <p>Trim size: h 180mm x w 260mm</p>
        <p>Illustrations: Full Colour</p>
        <p>Format: Digital, Softcover</p>
        <p>ISBN: 978-1-908030-54-2</p>
    </div>
</div>
<div class="creators">
    <h3>About the Authors</h3>


</div>
<!-- <?php if( isset($data['quote'][2]) ): ?>
    <div class="quote">
        <p>Quote</p>
    </div>
<?php endif; ?> -->
<div class="form">
    <form action="<?php echo base_url();?>/preview/<?php echo $this->data['slug']; ?>" method="post">
        <label for="name">Name: <input type="text" name="name" required/></label>
        <label for="email">Email: <input type="email" name="email" required/></label>
        <input type="submit" name="submit" value="I'd like to see it" />
        <p>Your preview will appear in your inbox shortly. When the campaign for the title is about to begin, we will contact you again.</p>
    </form>
</div>