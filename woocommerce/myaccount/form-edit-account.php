<?php
/**
 * Edit account form
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/myaccount/form-edit-account.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.5.0
 */

defined( 'ABSPATH' ) || exit;

do_action( 'woocommerce_before_edit_account_form' ); ?>

<h3 class="myaccount_title">帳戸資料</h3>

<form class="woocommerce-EditAccountForm edit-account account_section-container" action="" method="post" <?php do_action( 'woocommerce_edit_account_form_tag' ); ?> >

	<?php do_action( 'woocommerce_edit_account_form_start' ); ?>

		<h5>基本資料</h5>

		<div class="m-3">
			<div class="row mb-3">
				<label for="account_display_name" class="col-sm-2 col-form-label">用戶名稱</label>
				<div class="col-sm-6">
					<input type="text" required class="form-control" name="account_display_name" id="account_display_name"  aria-describedby="accountnameHelp" value="<?php echo esc_attr( $user->display_name ); ?>"> 
				</div>
			</div>

			<div class="row mb-3">
				<label for="account_email" class="col-sm-2 col-form-label">電子郵件</label>
				<div class="col-sm-6">
					<input type="email" required class="form-control" name="account_email" id="account_email" autocomplete="email" value="<?php echo esc_attr( $user->user_email ); ?>" />
				</div>
			</div>

			<div class="row mb-3">
				<label for="account_last_name" class="col-sm-2 col-form-label">姓氏</label>
				<div class="col-sm-6">
					<input type="text" required class="form-control" name="account_last_name" id="account_last_name" autocomplete="family-name" value="<?php echo esc_attr( $user->last_name ); ?>">
				</div>
			</div>

			<div class="row mb-3">
				<label for="account_first_name" class="col-sm-2 col-form-label">名字</label>
				<div class="col-sm-6">
					<input type="text" required class="form-control" name="account_first_name" id="account_first_name" autocomplete="given-name" value="<?php echo esc_attr( $user->first_name ); ?>">
				</div>
			</div>

		</div>

		<h5>變更密碼</h5>

		<div class="m-3">
			<div class="row mb-3">
				<label for="password_current" class="col-sm-2 col-form-label">目前的密碼</label>
				<div class="col-sm-6">
					<input type="password" class="form-control" name="password_current" id="password_current" autocomplete="off" placeholder="不需變更請留空"/>
				</div>
			</div>

			<div class="row mb-3">
				<label for="password_1" class="col-sm-2 col-form-label">新密碼</label>
				<div class="col-sm-6">
					<input type="password" class="form-control" name="password_1" id="password_1" autocomplete="off" placeholder="不需變更請留空">
				</div>
			</div>

			<div class="row mb-3">
				<label for="password_2" class="col-sm-2 col-form-label">確認新密碼</label>
				<div class="col-sm-6">
					<input type="password" class="form-control" name="password_2" id="password_2" autocomplete="off" placeholder="再次輸入新密碼">
				</div>
			</div>

		</div>

	<?php do_action( 'woocommerce_edit_account_form' ); ?>

	<div class="text-center">
		<?php wp_nonce_field( 'save_account_details', 'save-account-details-nonce' ); ?>
		<button type="submit" class="btn btn-secondary" name="save_account_details" value="<?php esc_attr_e( 'Save changes', 'woocommerce' ); ?>"><?php esc_html_e( 'Save changes', 'woocommerce' ); ?></button>
		<input type="hidden" name="action" value="save_account_details" />
	</div>

	<?php do_action( 'woocommerce_edit_account_form_end' ); ?>
</form>

<div class="account_section-container">
	<?php do_action('woocommerce_account_edit-account_hook');?>
</div>
<?php do_action( 'woocommerce_after_edit_account_form' ); ?>
