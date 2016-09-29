<?php

/** @var \OnaWhiteAngus\Controller $ona_controller */
global $ona_controller;

?>

<div class="wrap">

	<h1>
		ONA White Angus Settings
	</h1>

	<form method="post" action="options.php" autocomplete="off" id="ona-hover-cow-form">

		<?php

		settings_fields( 'ona_white_angus_settings' );
		do_settings_sections( 'ona_white_angus_settings' );

		?>

		<input type="hidden" name="<?php echo \OnaWhiteAngus\HoverCow::OPTION_NAME; ?>" value="<?php echo esc_html( \OnaWhiteAngus\HoverCow::getOptionValue() ); ?>">
		<input type="hidden" name="<?php echo \OnaWhiteAngus\HomepageBox::OPTION_NAME; ?>" value="<?php echo esc_html( \OnaWhiteAngus\HomepageBox::getOptionValue() ); ?>">

		<table class="form-table table table-bordered">
			<thead>
				<tr>
					<th></th>
					<th>Current Value</th>
					<th>Change To</th>
				</tr>
			</thead>
			<tr valign="top">
				<th scope="row">
					<label for="<?php echo \OnaWhiteAngus\Controller::OPTION_PHONE; ?>">
						Phone Number
					</label>
				</th>
				<td>
					<?php echo $ona_controller->getPhoneNumber(); ?>
				</td>
				<td>
					<input
						type="text"
						class="form-control"
						id="<?php echo \OnaWhiteAngus\Controller::OPTION_PHONE; ?>"
						name="<?php echo \OnaWhiteAngus\Controller::OPTION_PHONE; ?>"
						value="<?php echo esc_html( $ona_controller->getPhoneNumber() ); ?>">
				</td>
			</tr>
			<tr valign="top">
				<th scope="row">
					<label for="<?php echo \OnaWhiteAngus\Controller::OPTION_ADDRESS; ?>">
						Address
					</label>
				</th>
				<td>
					<?php echo $ona_controller->getAddress(); ?>
				</td>
				<td>
					<textarea
						class="form-control"
						id="<?php echo \OnaWhiteAngus\Controller::OPTION_ADDRESS; ?>"
						name="<?php echo \OnaWhiteAngus\Controller::OPTION_ADDRESS; ?>"><?php echo esc_html( $ona_controller->getAddress( FALSE ) ); ?></textarea>
				</td>
			</tr>
			<tr valign="top">
				<th scope="row">
					<label for="<?php echo \OnaWhiteAngus\Controller::OPTION_FACEBOOK; ?>">
						Facebook Link
					</label>
				</th>
				<td>
					<a href="<?php echo $ona_controller->getFacebookLink(); ?>" target="_blank"><?php echo $ona_controller->getFacebookLink(); ?></a>
				</td>
				<td>
					<input
						type="text"
						class="form-control"
						id="<?php echo \OnaWhiteAngus\Controller::OPTION_FACEBOOK; ?>"
						name="<?php echo \OnaWhiteAngus\Controller::OPTION_FACEBOOK; ?>"
						value="<?php echo esc_html( $ona_controller->getFacebookLink() ); ?>">
				</td>
			</tr>
			<tr valign="top">
				<th scope="row">
					<label for="<?php echo \OnaWhiteAngus\Controller::OPTION_TWITTER; ?>">
						Twitter Link
					</label>
				</th>
				<td>
					<a href="<?php echo $ona_controller->getTwitterLink(); ?>" target="_blank"><?php echo $ona_controller->getTwitterLink(); ?></a>
				</td>
				<td>
					<input
						type="text"
						class="form-control"
						id="<?php echo \OnaWhiteAngus\Controller::OPTION_TWITTER; ?>"
						name="<?php echo \OnaWhiteAngus\Controller::OPTION_TWITTER; ?>"
						value="<?php echo esc_html( $ona_controller->getTwitterLink() ); ?>">
				</td>
			</tr>
			<tr valign="top">
				<th scope="row">
					<label for="<?php echo \OnaWhiteAngus\Controller::OPTION_INSTAGRAM; ?>">
						Instagram Link
					</label>
				</th>
				<td>
					<a href="<?php echo $ona_controller->getInstagramLink(); ?>" target="_blank"><?php echo $ona_controller->getInstagramLink(); ?></a>
				</td>
				<td>
					<input
						type="text"
						class="form-control"
						id="<?php echo \OnaWhiteAngus\Controller::OPTION_INSTAGRAM; ?>"
						name="<?php echo \OnaWhiteAngus\Controller::OPTION_INSTAGRAM; ?>"
						value="<?php echo esc_html( $ona_controller->getInstagramLink() ); ?>">
				</td>
			</tr>
			<tr valign="top">
				<th scope="row">
					<label for="<?php echo \OnaWhiteAngus\Controller::OPTION_YOUTUBE; ?>">
						YouTube Link
					</label>
				</th>
				<td>
					<a href="<?php echo $ona_controller->getYouTubeLink(); ?>" target="_blank"><?php echo $ona_controller->getYouTubeLink(); ?></a>
				</td>
				<td>
					<input
						type="text"
						class="form-control"
						id="<?php echo \OnaWhiteAngus\Controller::OPTION_YOUTUBE; ?>"
						name="<?php echo \OnaWhiteAngus\Controller::OPTION_YOUTUBE; ?>"
						value="<?php echo esc_html( $ona_controller->getYouTubeLink() ); ?>">
				</td>
			</tr>
			<tr valign="top">
				<th scope="row">
					<label for="<?php echo \OnaWhiteAngus\Controller::OPTION_CALL_TO_ACTION; ?>">
						Call to Action Text
					</label>
				</th>
				<td>
					<?php echo $ona_controller->getCallToAction(); ?>
				</td>
				<td>
					<input
						type="text"
						class="form-control"
						id="<?php echo \OnaWhiteAngus\Controller::OPTION_CALL_TO_ACTION; ?>"
						name="<?php echo \OnaWhiteAngus\Controller::OPTION_CALL_TO_ACTION; ?>"
						value="<?php echo esc_html( $ona_controller->getCallToAction() ); ?>">
				</td>
			</tr>
			<tr valign="top">
				<th scope="row">
					<label for="<?php echo \OnaWhiteAngus\Controller::OPTION_REGISTER_LINK; ?>">
						Registration Link
					</label>
				</th>
				<td>
					<?php echo $ona_controller->getRegisterLink(); ?>
				</td>
				<td>
					<input
						type="text"
						class="form-control"
						id="<?php echo \OnaWhiteAngus\Controller::OPTION_REGISTER_LINK; ?>"
						name="<?php echo \OnaWhiteAngus\Controller::OPTION_REGISTER_LINK; ?>"
						value="<?php echo esc_html( $ona_controller->getRegisterLink() ); ?>">
				</td>
			</tr>
			<tr valign="top">
				<th scope="row">
					<label for="<?php echo \OnaWhiteAngus\Controller::OPTION_ANNUAL_FEE; ?>">
						Annual Membership Fee
					</label>
				</th>
				<td>
					<?php if ( strlen( $ona_controller->getAnnualFee() ) > 0 ) { ?>
						$<?php echo number_format( $ona_controller->getAnnualFee(), 2 ); ?>
					<?php } else { ?>
						N/A
					<?php } ?>
				</td>
				<td>
					<input
						type="text"
						class="form-control"
						id="<?php echo \OnaWhiteAngus\Controller::OPTION_ANNUAL_FEE; ?>"
						name="<?php echo \OnaWhiteAngus\Controller::OPTION_ANNUAL_FEE; ?>"
						value="<?php echo esc_html( $ona_controller->getAnnualFee() ); ?>">
				</td>
			</tr>
			<tr valign="top">
				<th scope="row">
					<label for="<?php echo \OnaWhiteAngus\Controller::OPTION_LIFETIME_FEE; ?>">
						Lifetime Membership Fee
					</label>
				</th>
				<td>
					<?php if ( strlen( $ona_controller->getLifetimeFee() ) > 0 ) { ?>
						$<?php echo number_format( $ona_controller->getLifetimeFee(), 2 ); ?>
					<?php } else { ?>
						N/A
					<?php } ?>
				</td>
				<td>
					<input
						type="text"
						class="form-control"
						id="<?php echo \OnaWhiteAngus\Controller::OPTION_LIFETIME_FEE; ?>"
						name="<?php echo \OnaWhiteAngus\Controller::OPTION_LIFETIME_FEE; ?>"
						value="<?php echo esc_html( $ona_controller->getLifetimeFee() ); ?>">
				</td>
			</tr>
		</table>

		<?php submit_button(); ?>

	</form>

</div>