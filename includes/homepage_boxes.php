<?php

/** @var \OnaWhiteAngus\Controller $ona_controller */
global $ona_controller;

?>

<div class="wrap">

	<h1>
		Homepage Boxes
	</h1>

	<form method="post" action="options.php" autocomplete="off" id="ona-homepage-boxes-form">

		<?php

		settings_fields( 'ona_white_angus_settings' );
		do_settings_sections( 'ona_white_angus_settings' );

		?>

		<input type="hidden" name="<?php echo \OnaWhiteAngus\Controller::OPTION_PHONE; ?>" value="<?php echo esc_html( $ona_controller->getPhoneNumber() ); ?>">
		<input type="hidden" name="<?php echo \OnaWhiteAngus\Controller::OPTION_ADDRESS; ?>" value="<?php echo esc_html( $ona_controller->getAddress( FALSE ) ); ?>">
		<input type="hidden" name="<?php echo \OnaWhiteAngus\Controller::OPTION_FACEBOOK; ?>" value="<?php echo esc_html( $ona_controller->getFacebookLink() ); ?>">
		<input type="hidden" name="<?php echo \OnaWhiteAngus\Controller::OPTION_TWITTER; ?>" value="<?php echo esc_html( $ona_controller->getTwitterLink() ); ?>">
		<input type="hidden" name="<?php echo \OnaWhiteAngus\Controller::OPTION_INSTAGRAM; ?>" value="<?php echo esc_html( $ona_controller->getInstagramLink() ); ?>">
		<input type="hidden" name="<?php echo \OnaWhiteAngus\Controller::OPTION_YOUTUBE; ?>" value="<?php echo esc_html( $ona_controller->getYouTubeLink() ); ?>">
		<input type="hidden" name="<?php echo \OnaWhiteAngus\Controller::OPTION_CALL_TO_ACTION; ?>" value="<?php echo esc_html( $ona_controller->getCallToAction() ); ?>">
		<input type="hidden" name="<?php echo \OnaWhiteAngus\Controller::OPTION_REGISTER_LINK; ?>" value="<?php echo esc_html( $ona_controller->getRegisterLink() ); ?>">
		<input type="hidden" name="<?php echo \OnaWhiteAngus\Controller::OPTION_LIFETIME_FEE; ?>" value="<?php echo esc_html( $ona_controller->getLifetimeFee() ); ?>">
		<input type="hidden" name="<?php echo \OnaWhiteAngus\Controller::OPTION_ANNUAL_FEE; ?>" value="<?php echo esc_html( $ona_controller->getAnnualFee() ); ?>">
		<input type="hidden" name="<?php echo \OnaWhiteAngus\HoverCow::OPTION_NAME; ?>" value="<?php echo esc_html( \OnaWhiteAngus\HoverCow::getOptionValue() ); ?>">
		<input type="hidden" id="ona-homepage-boxes" name="<?php echo \OnaWhiteAngus\HomepageBox::OPTION_NAME; ?>">

	</form>

	<table class="table table-bordered table-striped">
		<thead>
		<tr>
			<th>Title</th>
			<th>Content</th>
			<th>Link</th>
			<th>Link Text</th>
		</tr>
		</thead>
		<?php for ( $x=1; $x<=3; $x++ ) { ?>
			<?php $homepage_box = new \OnaWhiteAngus\HomepageBox( $x ); ?>
			<tr>
				<td>
					<input id="homepage-box-title-<?php echo $x; ?>" class="form-control" value="<?php echo esc_html( $homepage_box->getTitle() ); ?>">
				</td>
				<td>
					<textarea id="homepage-box-content-<?php echo $x; ?>" class="form-control"><?php echo esc_html( $homepage_box->getContent() ); ?></textarea>
				</td>
				<td>
					<input id="homepage-box-link-<?php echo $x; ?>" class="form-control" value="<?php echo esc_html( $homepage_box->getLink() ); ?>">
				</td>
				<td>
					<input id="homepage-box-link-text-<?php echo $x; ?>" class="form-control" value="<?php echo esc_html( $homepage_box->getLinkText() ); ?>">
				</td>
			</tr>
		<?php } ?>
	</table>

	<?php submit_button( 'Save Changes', 'primary ona-homepage-boxes-submit' ); ?>

</div>