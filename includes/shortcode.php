<?php

/** @var \OnaWhiteAngus\Controller $this */

$action = ( isset( $_GET['action'] ) ) ? $_GET['action'] : '';
$page = ( isset( $_GET['page'] ) ) ? $_GET['page'] : '';

if ( $page == '' )
{
	if ( $this->getAttribute( 'page' ) == 'register' )
	{
		$page = 'register';
	}
	elseif ( $this->getAttribute( 'page' ) == 'resources' )
	{
		$page = 'resources';
	}
	elseif ( $this->getAttribute( 'page' ) == 'directory' )
	{
		$page = 'directory';
	}
}

?>

<?php if ( count( $this->getErrors() ) > 0 ) { ?>

	<div class="alert alert-danger">
		<ul>
			<?php foreach ( $this->getErrors() as $error ) { ?>
				<li><?php echo $error; ?></li>
			<?php } ?>
		</ul>
	</div>

<?php } ?>

<?php if ( $page == 'directory' ) { ?>

	<h2>Find a Breeder</h2>

	<?php

	$members = \OnaWhiteAngus\Member::getActiveMembers();
	$states = array();

	foreach ( $members AS $member )
	{
		if ( $member->isCurrent() )
		{
			if ( ! array_key_exists( $member->getState(), $states ) )
			{
				$states[ $member->getState() ] = [];
			}

			$states[ $member->getState() ][] = $member;
		}
	}

	?>

	<?php if ( count( $states ) == 0 ) { ?>

		<p>No breeders were found at this time. Please check back later.</p>

	<?php } else { ?>

		<?php if ( count( $states ) > 1 ) { ?>
			<p class="btn-group">
				<?php foreach ( $states as $state => $members ) { ?>
					<a href="#<?php echo $state; ?>" class="btn btn-default btn-xs">
						<?php echo $state; ?>
					</a>
				<?php } ?>
			</p>
		<?php } ?>

		<?php foreach ( $states as $state => $members ) { ?>

			<?php /** @var \OnaWhiteAngus\Member[] $members */ ?>

			<a name="<?php echo $state; ?>"></a>
			<div class="panel panel-default">
				<div class="panel-heading">
					<h3 class="panel-title">
						<?php echo \OnaWhiteAngus\Controller::get_state_and_abbr( $state ); ?>
					</h3>
				</div>
				<div class="panel-body">

					<?php foreach ( $members as $member ) { ?>

						<p>

							<?php if ( strlen( $member->getFarmName() ) > 0 ) { ?>
								<strong><?php echo $member->getFarmName(); ?></strong><br>
								<?php echo $member->getFullName(); ?><br>
							<?php } else { ?>
								<strong><?php echo $member->getFullName(); ?></strong><br>
							<?php } ?>
							<?php echo $member->getAddress(); ?><br>
							<?php echo $member->getCity() . ', ' . $member->getState() . ' ' . $member->getZip(); ?><br>
							<?php echo $member->getPhone(); ?>

						</p>

						<hr>

					<?php } ?>

				</div>
			</div>

		<?php } ?>

	<?php } ?>

<?php } elseif ( ! $this->getMember()->isMember() ) { ?>

	<?php if ( $action == 'signedup' && ! is_user_logged_in() ) { ?>

		<div class="alert alert-info">
			Thank you for registering! You can now log in below.
		</div>

	<?php } ?>

	<div class="row">

		<?php if ( $action != 'signedup' ) { ?>

			<div class="col-sm-8">

				<h2>Join the White Angus Association</h2>

				<form method="post">

					<?php

					wp_nonce_field( 'ona_white_angus_signup', 'ona_white_angus_nonce' );
					$current_user = wp_get_current_user();

					?>

					<input type="hidden" name="ona_white_angus_action" value="signup">

					<div class="form-group">
						<label for="email">Email <strong>*</strong></label>
						<input class="form-control" type="text" id="email" name="email" value="<?php echo ( isset( $_POST['email'] ) ) ? esc_html( $_POST['email'] ) : ( ( is_user_logged_in() ) ? $current_user->user_email : '' ); ?>">
					</div>

					<?php if ( ! is_user_logged_in() ) { ?>

						<div class="form-group">
							<label for="username">Username <strong>*</strong></label>
							<input class="form-control" type="text" id="username" name="username" value="<?php echo ( isset( $_POST['username'] ) ) ? esc_html( $_POST['username'] ) : ''; ?>">
						</div>

						<div class="form-group">
							<label for="password">Password <strong>*</strong></label>
							<input class="form-control" type="password" id="password" name="password" value="<?php echo ( isset( $_POST['password'] ) ) ? esc_html( $_POST['password'] ) : ''; ?>">
						</div>

					<?php } ?>

					<div class="form-group">
						<label for="fname">First Name <strong>*</strong></label>
						<input class="form-control" type="text" id="fname" name="fname" value="<?php echo ( isset( $_POST['fname'] ) ) ? esc_html( $_POST['fname'] ) : ( ( is_user_logged_in() ) ? $current_user->user_firstname : '' ); ?>">
					</div>

					<div class="form-group">
						<label for="lname">Last Name <strong>*</strong></label>
						<input class="form-control" type="text" id="lname" name="lname" value="<?php echo ( isset( $_POST['lname'] ) ) ? esc_html( $_POST['lname'] ) : ( ( is_user_logged_in() ) ? $current_user->user_lastname : '' ); ?>">
					</div>

					<div class="form-group">
						<label for="farm-name">Farm Name</label>
						<input class="form-control" type="text" id="farm-name" name="farm_name" value="<?php echo ( isset( $_POST['farm_name'] ) ) ? esc_html( $_POST['farm_name'] ) : ''; ?>">
					</div>

					<div class="form-group">
						<label for="address">Address <strong>*</strong></label>
						<input class="form-control" type="text" id="address" name="address" value="<?php echo ( isset( $_POST['address'] ) ) ? esc_html( $_POST['address'] ) : ''; ?>">
					</div>

					<div class="form-group">
						<label for="city">City <strong>*</strong></label>
						<input class="form-control" type="text" id="city" name="city" value="<?php echo ( isset( $_POST['city'] ) ) ? esc_html( $_POST['city'] ) : ''; ?>">
					</div>

					<div class="form-group">
						<label for="state">State <strong>*</strong></label>
						<select class="form-control" id="state" name="state">
							<?php $temp = ( isset( $_POST['state'] ) ) ? esc_html( $_POST['state'] ) : ''; ?>
							<?php foreach ( \OnaWhiteAngus\Controller::get_states() as $abbr => $state ) { ?>
								<option value="<?php echo $abbr; ?>"<?php if ( $temp == $abbr ) { ?> selected<?php } ?>>
									<?php echo $abbr . ' - ' . $state; ?>
								</option>
							<?php } ?>
						</select>
					</div>

					<div class="form-group">
						<label for="zip">Zip <strong>*</strong></label>
						<input class="form-control" type="text" id="zip" name="zip" value="<?php echo ( isset( $_POST['zip'] ) ) ? esc_html( $_POST['zip'] ) : ''; ?>">
					</div>

					<div class="form-group">
						<label for="phone">Phone Number <strong>*</strong></label>
						<input class="form-control" type="text" id="phone" name="phone" value="<?php echo ( isset( $_POST['phone'] ) ) ? esc_html( $_POST['phone'] ) : ''; ?>">
					</div>

					<p>
						<button class="btn btn-default">
							Submit
						</button>
					</p>

				</form>

			</div>

		<?php } ?>

		<div class="col-sm-4">

			<?php if ( ! is_user_logged_in() ) { ?>

				<?php

				$args = array (
					'echo'           => TRUE,
					'redirect'       => $_SERVER['REQUEST_URI'],
					'form_id'        => 'loginform',
					'label_username' => __( 'Username' ),
					'label_password' => __( 'Password' ),
					'label_remember' => __( 'Remember Me' ),
					'label_log_in'   => __( 'Log In' ),
					'id_username'    => 'user_login',
					'id_password'    => 'user_pass',
					'id_remember'    => 'rememberme',
					'id_submit'      => 'wp-submit',
					'remember'       => TRUE,
					'value_username' => '',
					'value_remember' => FALSE
				);

				?>

				<h2>Already Signed Up?</h2>
				<p>If you have a login and password, enter them here.</p>

				<div id="ona_login_form">
					<?php wp_login_form( $args ); ?>
				</div>

				<p>
					<a href="/wp-login.php?action=lostpassword">Lost Password?</a>
				</p>

			<?php } ?>
		</div>
	</div>

<?php } elseif ( $page == 'register' ) { ?>

	<h2>Register Your Animal</h2>

<?php } elseif ( $page == 'resources' ) { ?>

	<h2>Member Resources</h2>

<?php } else { ?>

	<h2>My White Angus Account</h2>

<?php } ?>
