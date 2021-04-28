<?php
/**
 * Lost password form
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/myaccount/form-lost-password.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.5.2
 */

defined( 'ABSPATH' ) || exit;

do_action( 'woocommerce_before_lost_password_form' );
?>

<div style="height:70vh">
	<div class="row align-items-center justify-content-center h-100">
		<div class="col-md-6 col-11">

			<form method="post" class="woocommerce-ResetPassword lost_reset_password">
				<h3 class="login_title text-center">忘記密碼了？</h3>
				<p>請在下方欄位輸入您的使用者名稱或電子郵件，我們將寄送一封電子郵件以重設您的密碼。</p><?php // @codingStandardsIgnoreLine ?>

				<div class="mt-3">
					<input placeholder="<?php esc_html_e( 'Username or email', 'woocommerce' ); ?>" class="form-control login_field" type="text" name="user_login" id="user_login" autocomplete="username" />
				</div>

				<div class="clear"></div>

				<?php do_action( 'woocommerce_lostpassword_form' ); ?>

				<div class="float-end mt-3">
					<input type="hidden" name="wc_reset_password" value="true" />
					<button type="submit" class="btn btn-primary" value="<?php esc_attr_e( 'Reset password', 'woocommerce' ); ?>"><?php esc_html_e( 'Reset password', 'woocommerce' ); ?></button>
				</div>

				<?php wp_nonce_field( 'lost_password', 'woocommerce-lost-password-nonce' ); ?>

			</form>	
		</div>
	</div>
</div>



<?php
do_action( 'woocommerce_after_lost_password_form' );
