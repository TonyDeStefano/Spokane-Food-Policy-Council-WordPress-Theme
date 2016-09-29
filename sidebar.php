<aside id="sidebar" class="<?php echo $class; ?>">

	<ul id="widgetlist">

	    <?php if ( is_active_sidebar( 'sidebar' ) ) { ?>

			<?php dynamic_sidebar( 'sidebar' ); ?>

		<?php } ?>

	</ul>

</aside>

