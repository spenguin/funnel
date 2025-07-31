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
    <p>Shortly, we'll be launching a crowd funding campaign for Meanwhile... The Best.</p>
    <p>To whet your appetite, we'd like to offer you a sneak preview.</p>
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
            <div class="quote__image">
                <img src="<?php echo base_url(); ?>/assets/img/antonyjohnson.jpg">
            </div>
            <p>“Stories ranging from charming to frightening or exciting, and always engaging, this is a great showcase of emerging comics talent”</p>
            <p class="quote__name">Antony Johnston</p>
            <p class="quote__title">Writer, Atomic Blonde, Dog Sitter Detective, Resident Evil Village</p>
        </div>
        <div class="quote">
            <div class="quote__image">
                <img src="<?php echo base_url(); ?>/assets/img/michaelgilbert.jpg">
            </div>            
            <p>“I’ve just had the pleasure of reading Meanwhile... The Best, and I’m delighted to report that it has first-rate stories and terrific art. Do yourself a favor and pick up a
copy!”</p>
            <p class="quote__name">Michael T Gilbert</p>
            <p class="quote__title">Writer,/Artist Mr Monster, The Wraith</p>
        </div>
        <div class="quote">
            <div class="quote__image">
                <img src="<?php echo base_url(); ?>/assets/img/DavidHine2015.jpg">
            </div>             
            <p>“[Y]ou may well find that every single one of these stories, against all the odds, is very much your thing.”</p>
            <p class="quote__name">David Hine</p>
            <p class="quote__title">Writer, Silent War, Bulletproof Coffin (from his introduction)</p>
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
        <p class="book__title">Meanwhile... The Best</p>
        <p>Page count: 210pp</p>
        <p>Trim size: h 165mm x w 235mm</p>
        <p>Illustrations: Full Colour</p>
        <p>Format: Digital, Softcover</p>
        <p>ISBN: 978-1-908030-58-0</p>
        <p>Price: UKP19.99</p>
    </div>
</div>
<div class="creators">
    <h3>Who are the Creators</h3>
    <ul class="creators__list">
        <li>Laurel Dundee</li>
        <li>Victor Martins</li>
        <li>Shing Yin Khor</li>
        <li>Yuko Rabbit</li>
        <li>Joao Fazenda</li>
        <li>Rachel Smythe</li>
        <li>Simone Buchert</li>
        <li>Scott Lowson & Jenny-Linn Cole</li>
        <li>Francis Desharnais</li>
        <li>Ginny Skinner</li>
        <li>Matthew Dooley</li>
        <li>Andy Pearson</li>
        <li>Efthymia Theodoropoulou</li>
        <li>Burhan Kum</li>
        <li>Elizabeth Hart Bergstrom & Terry Eden</li>
    </ul>


</div>
<!-- <?php if( isset($data['quote'][2]) ): ?>
    <div class="quote">
        <p>Quote</p>
    </div>
<?php endif; ?> -->
<div class="form">
    <h3>What do you think?</h3>
    <p> Want to give us your email address and we'll give you a preview? And we'll let you know when the campaign is about to launch.</p>
    <form action="<?php echo base_url();?>/preview/<?php echo $this->data['slug']; ?>" method="post">
        <label for="name">Name: <input type="text" name="name" required/></label>
        <label for="email">Email: <input type="email" name="email" required/></label>
        <input type="submit" name="submit" value="I'd like to see it" />
        <p>Your preview will appear in your inbox shortly. When the campaign for the title is about to begin, we will contact you again.</p>
    </form>
</div>