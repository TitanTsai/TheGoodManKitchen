<?php
/**
 * Login Form
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/myaccount/form-login.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 4.1.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

do_action( 'woocommerce_before_customer_login_form' ); ?>

<?php if ( 'yes' === get_option( 'woocommerce_enable_myaccount_registration' ) ) : ?>

<div class="login_form" id="customer_login">
	<div class="row justify-content-center align-items-center" style="min-height:75vh">
<?php endif; ?>
		
			<div class="col-10 col-md-5 col-lg-4">
				<form method="post">
					<?php do_action( 'woocommerce_login_form_start' ); ?>

					<h2 class="login_title text-center mb-4">會員登入</h2>
					
					<div class="form-group row mb-4">
						<input type="text" class="login_field form-control" required placeholder="請輸入Email / 使用者名稱" name="username" id="username" autocomplete="username" value="<?php echo ( ! empty( $_POST['username'] ) ) ? esc_attr( wp_unslash( $_POST['username'] ) ) : ''; ?>" /><?php // @codingStandardsIgnoreLine ?>
					</div>

					<div class="form-group row mb-4">
						<input type="password" class="login_field form-control" name="password" id="password" autocomplete="current-password" placeholder="請輸入密碼">
					</div>
				
					<div class="form-check">
						<input class="form-check-input" type="checkbox" name="rememberme" id="rememberme" value="forever" />
						<label class="form-check-label" for="rememberme">保持登入</label>
					</div>
					
					<?php wp_nonce_field( 'woocommerce-login', 'woocommerce-login-nonce' ); ?>

					<div class="mt-4 row">
						<button type="submit" class="col m-1 btn-lg btn-primary " name="login" value="<?php esc_attr_e( 'Log in', 'woocommerce' ); ?>"><?php esc_html_e( 'Log in', 'woocommerce' ); ?></button>
						<button type="button" class="col m-1 btn btn-outline-primary " data-bs-toggle="modal" data-bs-target="#exampleModal">註冊</button>
					</div>

					<?php do_action( 'woocommerce_login_form' ); ?>

					<div class="mt-4 text-center">
						<a class="login_lost-password" href="<?php echo esc_url( wp_lostpassword_url() ); ?>">忘記密碼？</a>
					</div>

					<div class="text-center">
						<?php do_action( 'woocommerce_login_form_end' ); ?>
					</div>
				</form>
			</div>
		
<?php if ( 'yes' === get_option( 'woocommerce_enable_myaccount_registration' ) ) : ?>
	</div>

<!-- Register Modal -->
	<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
		<div class="modal-dialog modal-dialog-centered">
			<div class="modal-content">

				<div class="modal-header">
					<h3 class="modal-title" id="exampleModalLabel"><?php esc_html_e( 'Register', 'woocommerce' ); ?></h3>
					<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
				</div>
				
				<div class="modal-body">
					<div class="container-fluid">
						<form method="post" <?php do_action( 'woocommerce_register_form_tag' ); ?> >

							<?php do_action( 'woocommerce_register_form_start' ); ?>

							<?php if ( 'no' === get_option( 'woocommerce_registration_generate_username' ) ) : ?>
								<div class="mb-4">
									<input type="text" required placeholder="使用者名稱" class="form-control login_field" name="username" id="reg_username" autocomplete="username" value="<?php echo ( ! empty( $_POST['username'] ) ) ? esc_attr( wp_unslash( $_POST['username'] ) ) : ''; ?>" /><?php // @codingStandardsIgnoreLine ?>
								</div>
							<?php endif; ?>

							<div class="mb-4">
								<input type="email" required placeholder="電子郵件" class="form-control login_field" name="email" id="reg_email" autocomplete="email" value="<?php echo ( ! empty( $_POST['email'] ) ) ? esc_attr( wp_unslash( $_POST['email'] ) ) : ''; ?>" /><?php // @codingStandardsIgnoreLine ?>
							</div>


							<?php if ( 'no' === get_option( 'woocommerce_registration_generate_password' ) ) : ?>
								<div class="mb-4">
									<input type="password" required placeholder="密碼" class="form-control login_field" name="password" id="reg_password" autocomplete="new-password" />
								</div>

							<?php else : ?>

								<p><?php esc_html_e( 'A password will be sent to your email address.', 'woocommerce' ); ?></p>

							<?php endif; ?>
							
							<div class="mt-4">
								<?php do_action( 'woocommerce_register_form' ); ?>
							</div>

							<div class="form-group mb-3 d-grid gap-2">
								<?php wp_nonce_field( 'woocommerce-register', 'woocommerce-register-nonce' ); ?>
								<button type="submit" class="btn btn-block btn-primary" name="register" value="<?php esc_attr_e( 'Register', 'woocommerce' ); ?>"><?php esc_html_e( 'Register', 'woocommerce' ); ?></button>
							</div>

							

							<?php do_action( 'woocommerce_register_form_end' ); ?>

						</form>
					</div>
				</div>
	
		</div>
	</div>
	</div>

</div>
<?php endif; ?>

<?php do_action( 'woocommerce_after_customer_login_form' ); ?>
