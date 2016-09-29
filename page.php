<?php

get_header();

/** @var \OnaWhiteAngus\Controller $ona_controller */
global $ona_controller;

?>

<div class="row">

	<?php if ( $ona_controller->has_left_side_bar() ) { ?>
		<div class="col-md-4">
			<?php get_sidebar(); ?>
		</div>
	<?php } ?>

	<div class="col-md-<?php echo ( $ona_controller->has_left_side_bar() || $ona_controller->has_right_side_bar() ) ? '8' : '12'; ?>">

		<main id="content">

			<?php if ( ! is_front_page() ) { ?>

				<?php while ( have_posts() ) : the_post(); ?>


					<article class="page" id="pageid-<?php the_ID(); ?>">

						<?php do_action( 'basic_before_page_title' );  ?>

						<?php if ( ! has_shortcode( get_the_content(), 'ona_white_angus' ) ) { ?>
							<h1><?php the_title(); ?></h1>
						<?php } ?>

						<?php do_action( 'basic_after_page_title' );  ?>

						<?php do_action( 'basic_before_page_content_box' );  ?>
						<div class="entry-box clearfix">
							<?php do_action( 'basic_before_page_content' );  ?>
							<?php the_content(); ?>
							<?php do_action( 'basic_after_page_content' );  ?>
						</div>
						<?php do_action( 'basic_after_page_content_box' );  ?>

					</article>

					<?php

					if ( comments_open() || get_comments_number() ) { comments_template(); }

				endwhile; ?>

			<?php } else { ?>

				<?php require_once ( 'includes/home.php' ); ?>

			<?php } ?>

		</main>

	</div>

	<?php if ( $ona_controller->has_right_side_bar() ) { ?>
		<div class="col-md-4">
			<?php get_sidebar(); ?>
		</div>
	<?php } ?>

</div>

<?php get_footer(); ?>