<?php session_start(); ?>

<?php if ($_SESSION["flash"]): ?>
	<!-- TODO: Make a disposable component -->
	<?php unset($_SESSION["flash"]) ?>
<?php endif; ?>