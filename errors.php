<?php if (count($errors) > 0): ?>
	<div class="error">
		<?php foreach ($errors as $error): ?>
			<p class="red-text text-darken-4"><?php echo $error; ?></p>
		<?php endforeach; ?>
	</div>
<?php endif; ?>