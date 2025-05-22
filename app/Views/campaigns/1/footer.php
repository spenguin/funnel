<?php
/**
 * Footer file
 */
?>
</div><!-- end container -->

<!-- FOOTER: DEBUG INFO + COPYRIGHTS -->
</div><!-- end container -->
    <footer>
        <?php if( ENVIRONMENT != "production" ): ?>
            <div class="environment">
                <p>Page rendered in {elapsed_time} seconds</p>
                <p>Environment: <?= ENVIRONMENT ?></p>
            </div>
        <?php endif; ?>

        <div class="copyrights">
            <p>&copy; <?= date('Y') ?> Weirdspace/Soaring Penguin Press</p>
        </div>
    </footer>
</body>
</html>