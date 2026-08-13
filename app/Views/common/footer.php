<?php
/**
 * Footer file
 */
?>
</div><!-- end container -->

<!-- FOOTER: DEBUG INFO + COPYRIGHTS -->

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

<!-- SCRIPTS -->

<script>
	function toggleMenu() {
		var menuItems = document.getElementsByClassName('menu-item');
		for (var i = 0; i < menuItems.length; i++) {
			var menuItem = menuItems[i];
			menuItem.classList.toggle("hidden");
		}
	}
</script>

<!-- -->

</body>
</html>