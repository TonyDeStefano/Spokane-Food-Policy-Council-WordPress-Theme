<?php

/** @var \SpokaneFoodPolicy\Controller $sfp_controller */
global $sfp_controller;

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

<div class="sfp-container">

		<div class="row sfp-header">
			<div class="col-sm-4 text-center sfp-logo">
				<a href="/"><img src="<?php bloginfo('template_directory'); ?>/img/sfpc-logo.png"></a>
			</div>
			<div class="col-sm-8">
				<nav class="navbar navbar-default">
					<div class="container-fluid">
						<div class="navbar-header">
							<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-1" aria-expanded="false">
								<span class="sr-only">Toggle navigation</span>
								<span class="icon-bar"></span>
								<span class="icon-bar"></span>
								<span class="icon-bar"></span>
							</button>
						</div>
						<div id="navbar-1" class="collapse navbar-collapse">
							<ul class="nav navbar-nav">
								<?php foreach ( $sfp_controller->get_menu_items( \SpokaneFoodPolicy\Controller::MENU_MAIN ) AS $menu_item ) { ?>
									<li<?php if ( $menu_item->hasChildren() ) { ?> class="dropdown" <?php } ?>>
										<a href="<?php echo $menu_item->getUrl(); ?>"<?php if ( $menu_item->hasChildren() ) { ?> class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"<?php } ?>>
											<?php echo $menu_item->getTitle(); ?>
											<?php if ( $menu_item->hasChildren() ) { ?>
												<span class="caret"></span>
											<?php } ?>
										</a>
										<div class="tomato-top"></div>
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
			</div>
		</div>

		<div class="container">


