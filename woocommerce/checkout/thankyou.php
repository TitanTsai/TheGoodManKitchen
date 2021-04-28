<?php
/**
 * Thankyou page
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/checkout/thankyou.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.7.0
 */

defined( 'ABSPATH' ) || exit;
?>

<div class="page_container  align-items-center  woocommerce-order">

	<?php
	if ( $order ) :

		do_action( 'woocommerce_before_thankyou', $order->get_id() );
		?>

		<?php if ( $order->has_status( 'failed' ) ) : ?>

			<p class="woocommerce-notice woocommerce-notice--error woocommerce-thankyou-order-failed"><?php esc_html_e( 'Unfortunately your order cannot be processed as the originating bank/merchant has declined your transaction. Please attempt your purchase again.', 'woocommerce' ); ?></p>

			<p class="woocommerce-notice woocommerce-notice--error woocommerce-thankyou-order-failed-actions">
				<a href="<?php echo esc_url( $order->get_checkout_payment_url() ); ?>" class="button pay"><?php esc_html_e( 'Pay', 'woocommerce' ); ?></a>
				<?php if ( is_user_logged_in() ) : ?>
					<a href="<?php echo esc_url( wc_get_page_permalink( 'myaccount' ) ); ?>" class="button pay"><?php esc_html_e( 'My account', 'woocommerce' ); ?></a>
				<?php endif; ?>
			</p>

		<?php else : ?>
			<div class="text-center thankyou_container m-1 p-1">
				<h2 class="thankyou">謝謝</h2>

				<div class="text-center mb-3 order-placed_icon img-flex">
					<img src="<?php bloginfo('template_url'); ?>/assets/images/order_placed.svg" alt="">
				</div>

				<div class="order_detail p-4">
					<h4>我們已收到您的訂單</h4>

					<div>
						<ul class="list-unstyled">
							<li class="order_number m-2">
								<?php esc_html_e( 'Order number:', 'woocommerce' ); ?><br>
								<h5>#<?php echo $order->get_order_number(); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></h5>
							</li>

							<li class="order_meta">
								<?php esc_html_e( 'Date:', 'woocommerce' ); ?>
								<?php echo wc_format_datetime( $order->get_date_created() ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
							</li>

							<li class="order_meta">
								<?php esc_html_e( 'Total:', 'woocommerce' ); ?>
								<?php echo $order->get_formatted_order_total(); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
							</li>
		
							<li class="order_meta">
								<?php if ( $order->get_payment_method_title() ) : ?>
									<?php esc_html_e( 'Payment method:', 'woocommerce' ); ?>
									<?php echo wp_kses_post( $order->get_payment_method_title() ); ?>
								<?php endif; ?>
							</li>
						</ul>
					</div>			
					<p class="mt-1 text-break">您可以在<a href="/wordpress/my-account" style="text-decoration:none;font-weight:300;"> 會員中心 </a>查詢訂單狀態。若您使用銀行轉帳付款，我們將在確認款項後處理您的訂單。請注意我們不會主動聯繫您操作ATM匯款。</p>
				</div>			
			<?php endif; ?>
			
			<?php do_action( 'woocommerce_thankyou_' . $order->get_payment_method(), $order->get_id() ); ?>
			
			<?php do_action( 'woocommerce_thankyou', $order->get_id() ); ?>
		</div>
								
	<?php else : ?>

		<p class="woocommerce-notice woocommerce-notice--success woocommerce-thankyou-order-received"><?php echo apply_filters( 'woocommerce_thankyou_order_received_text', esc_html__( 'Thank you. Your order has been received.', 'woocommerce' ), null ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></p>

	<?php endif; ?>

</div>
