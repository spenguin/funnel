<!-- <div class="special-offer">
    <p>Special Offer</p>
</div>
<div class="purchase">
    <p>Buy now</p>
</div> -->
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
    <p>Until the campaign begins, we have a special offer for you: for a small deposit now, you'll be able to get <?php echo $title; ?> as 25% off the cover price! And we'll post it out to you for free!</p>
    <p>But you need to act fast. As soon as the campaign starts, this special offer will no longer be available.</p>
</div>
<div class="payment">
    <script async
        src="https://js.stripe.com/v3/buy-button.js">
    </script>

    <stripe-buy-button
        buy-button-id="buy_btn_1Riq5pAkVHx5lEPjFZk6hH7S"
        publishable-key="pk_live_KOhP2QcexFYv9jB1jbxYnR3r"
    >
    </stripe-buy-button>
</div>