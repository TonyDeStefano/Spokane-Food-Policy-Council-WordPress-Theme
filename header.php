<?php

/** @var \OnaWhiteAngus\Controller $ona_controller */
global $ona_controller;

?>

<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>

	<!--[if IE]><meta http-equiv="X-UA-Compatible" content="IE=9; IE=8; IE=7; IE=edge" /><![endif]-->
	<meta charset="utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0">

	<?php wp_head(); ?>

	<link rel="icon" type="image/x-icon" href="<?php bloginfo('template_directory'); ?>/img/favicon.ico" />

</head>
<body <?php body_class(); ?>>

<nav class="navbar navbar-inverse navbar-ona navbar-gray visible-xs">
	<div class="container">
		<div class="navbar-header">
			<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-3" aria-expanded="false" aria-controls="navbar">
				<span class="sr-only">Toggle navigation</span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</button>
		</div>
		<div id="navbar-3" class="collapse navbar-collapse">
			<ul class="nav navbar-nav navbar-right">
				<?php foreach ( $ona_controller->get_menu_items( \OnaWhiteAngus\Controller::MENU_MAIN ) AS $menu_item ) { ?>
					<li<?php if ( $menu_item->hasChildren() ) { ?> class="dropdown" <?php } ?>>
						<a href="<?php echo $menu_item->getUrl(); ?>"<?php if ( $menu_item->hasChildren() ) { ?> class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"<?php } ?>>
							<?php echo $menu_item->getTitle(); ?>
							<?php if ( $menu_item->hasChildren() ) { ?>
								<span class="caret"></span>
							<?php } ?>
						</a>
						<?php if ( $menu_item->hasChildren() ) { ?>
							<ul class="dropdown-menu">
								<?php foreach ( $menu_item->getChildren() as $child ) { ?>
									<li>
										<a href="<?php echo $child->getUrl(); ?>">
											<?php echo $child->getTitle(); ?>
										</a>
									</li>
								<?php } ?>
							</ul>
						<?php } ?>
					</li>
				<?php } ?>
				<?php foreach ( $ona_controller->get_menu_items( \OnaWhiteAngus\Controller::MENU_SECONDARY ) AS $menu_item ) { ?>
					<li<?php if ( $menu_item->hasChildren() ) { ?> class="dropdown" <?php } ?>>
						<a href="<?php echo $menu_item->getUrl(); ?>"<?php if ( $menu_item->hasChildren() ) { ?> class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"<?php } ?>>
							<?php echo $menu_item->getTitle(); ?>
								<?php if ( $menu_item->hasChildren() ) { ?>
								<span class="caret"></span>
							<?php } ?>
						</a>
						<?php if ( $menu_item->hasChildren() ) { ?>
							<ul class="dropdown-menu">
								<?php foreach ( $menu_item->getChildren() as $child ) { ?>
									<li>
										<a href="<?php echo $child->getUrl(); ?>">
											<?php echo $child->getTitle(); ?>
										</a>
									</li>
								<?php } ?>
							</ul>
						<?php } ?>
					</li>
				<?php } ?>
				<?php if ( strlen( $ona_controller->getPhoneNumber() ) > 0 ) { ?>
					<li>
						<a href="tel:<?php echo $ona_controller->getPhoneNumber( TRUE ); ?>">
							<?php echo $ona_controller->getPhoneNumber(); ?>
						</a>
					</li>
				<?php } ?>
			</ul>
		</div>
	</div>
</nav>

<nav class="navbar navbar-inverse navbar-ona navbar-yellow hidden-xs">
	<div class="container">
		<div class="navbar-header">
			<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-1" aria-expanded="false" aria-controls="navbar">
				<span class="sr-only">Toggle navigation</span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</button>
		</div>
		<div id="navbar-1" class="collapse navbar-collapse">
			<ul class="nav navbar-nav navbar-right">
				<?php foreach ( $ona_controller->get_menu_items( \OnaWhiteAngus\Controller::MENU_MAIN ) AS $menu_item ) { ?>
					<li<?php if ( $menu_item->hasChildren() ) { ?> class="dropdown" <?php } ?>>
						<a href="<?php echo $menu_item->getUrl(); ?>"<?php if ( $menu_item->hasChildren() ) { ?> class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"<?php } ?>>
							<?php echo $menu_item->getTitle(); ?>
								<?php if ( $menu_item->hasChildren() ) { ?>
								<span class="caret"></span>
							<?php } ?>
						</a>
						<?php if ( $menu_item->hasChildren() ) { ?>
							<ul class="dropdown-menu">
								<?php foreach ( $menu_item->getChildren() as $child ) { ?>
									<li>
										<a href="<?php echo $child->getUrl(); ?>">
											<?php echo $child->getTitle(); ?>
										</a>
									</li>
								<?php } ?>
							</ul>
						<?php } ?>
					</li>
				<?php } ?>
				<?php if ( strlen( $ona_controller->getPhoneNumber() ) > 0 ) { ?>
					<li>
						<a href="tel:<?php echo $ona_controller->getPhoneNumber( TRUE ); ?>">
							<?php echo $ona_controller->getPhoneNumber(); ?>
						</a>
					</li>
				<?php } ?>
			</ul>
		</div>
	</div>
</nav>

<nav class="navbar navbar-inverse navbar-ona navbar-gray hidden-xs">
	<div class="container">
		<div class="navbar-header">
			<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-2" aria-expanded="false" aria-controls="navbar">
				<span class="sr-only">Toggle navigation</span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</button>
		</div>
		<div id="navbar-2" class="collapse navbar-collapse">
			<ul class="nav navbar-nav navbar-right">
				<?php foreach ( $ona_controller->get_menu_items( \OnaWhiteAngus\Controller::MENU_SECONDARY ) AS $menu_item ) { ?>
					<li<?php if ( $menu_item->hasChildren() ) { ?> class="dropdown" <?php } ?>>
						<a href="<?php echo $menu_item->getUrl(); ?>"<?php if ( $menu_item->hasChildren() ) { ?> class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"<?php } ?>>
							<?php echo $menu_item->getTitle(); ?>
								<?php if ( $menu_item->hasChildren() ) { ?>
								<span class="caret"></span>
							<?php } ?>
						</a>
						<?php if ( $menu_item->hasChildren() ) { ?>
							<ul class="dropdown-menu">
								<?php foreach ( $menu_item->getChildren() as $child ) { ?>
									<li>
										<a href="<?php echo $child->getUrl(); ?>">
											<?php echo $child->getTitle(); ?>
										</a>
									</li>
								<?php } ?>
							</ul>
						<?php } ?>
					</li>
				<?php } ?>
			</ul>
		</div>
	</div>
</nav>

<div id="cow-banner">

	<div class="yellow-arrow-down">
		<i class="fa fa-chevron-down" aria-hidden="true"></i>
	</div>
	<?php if ( is_front_page() ) { ?>
		<img src="<?php bloginfo('template_directory'); ?>/img/cow-banner.jpg" class="img">
	<?php } else { ?>
		<img src="<?php bloginfo('template_directory'); ?>/img/cow-banner-internal.jpg" class="img">
	<?php } ?>

	<div id="ona-logo">
		<a href="/">
			<img src="<?php bloginfo('template_directory'); ?>/img/white-angus-top-logo.png">
		</a>
	</div>

</div>

<div id="ona-logo-mobile">
	<a href="/">
		<img src="<?php bloginfo('template_directory'); ?>/img/white-angus-top-logo.png">
	</a>
</div>

<div class="ona-content">