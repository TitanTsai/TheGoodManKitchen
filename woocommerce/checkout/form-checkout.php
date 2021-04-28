<?php
/**
 * Checkout Form
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/checkout/form-checkout.php.
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

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

do_action( 'woocommerce_before_checkout_form', $checkout );

// If checkout registration is disabled and not logged in, the user cannot checkout.
if ( ! $checkout->is_registration_enabled() && $checkout->is_registration_required() && ! is_user_logged_in() ) {
	echo esc_html( apply_filters( 'woocommerce_checkout_must_be_logged_in_message', __( 'You must be logged in to checkout.', 'woocommerce' ) ) );
	return;
}

?>

<form name="checkout" method="post" class="checkout woocommerce-checkout" action="<?php echo esc_url( wc_get_checkout_url() ); ?>" enctype="multipart/form-data">
	<h2 class="page_title"><?php the_title();?></h2>
	<div class="container page_content p-3 p-md-5 mb-3">
		<?php if ( $checkout->get_checkout_fields() ) : ?>

			<h3 class="text-center checkout_section-titles">訂購資訊</h3>

			<?php do_action( 'woocommerce_checkout_before_customer_details' ); ?>

			<div class="row gx-5 mb-1" id="customer_details">
				<div class="col-md-6">
					<?php do_action( 'woocommerce_checkout_billing' ); ?>
				</div>

				<div class="col-md-6">
					<?php do_action( 'woocommerce_checkout_shipping' ); ?>
					<?php do_action( 'woocommerce_checkout_after_customer_details' ); ?>
				</div>
			</div>

			<?php endif; ?>
	</div>

	<?php do_action( 'woocommerce_checkout_before_order_review_heading' ); ?>
	
	<div class="container page_content p-3 p-md-5 my-md-5">
		<h3 class="text-center checkout_section-titles" id="order_review_heading">訂單總覽</h3>
		
		<?php do_action( 'woocommerce_checkout_before_order_review' ); ?>

		<div id="order_review" class="row woocommerce-checkout-review-order">
			<?php do_action( 'woocommerce_checkout_order_review' ); ?>
		</div>

		<?php do_action( 'woocommerce_checkout_after_order_review' ); ?>
	</div>
	

</form>
	
<?php
		/**
		 * Terms and conditions hook used to inject content.
		 *
		 * @since 3.4.0.
		 * @hooked wc_checkout_privacy_policy_text() Shows custom privacy policy text. Priority 20.
		 * @hooked wc_terms_and_conditions_page_content() Shows t&c page content. Priority 30.
		 */
		do_action( 'woocommerce_checkout_terms_and_conditions' );
		?>
		
<?php do_action( 'woocommerce_after_checkout_form', $checkout ); ?>
