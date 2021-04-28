<?php
/**
 * View Order
 *
 * Shows the details of a particular order on the account page.
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/myaccount/view-order.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.0.0
 */

defined( 'ABSPATH' ) || exit;

$notes = $order->get_customer_order_notes();
?>

<h3 class="myaccount_title">訂單詳情</h3>

	<div class="thankyou_container mt-md-5 p-1 p-md-3">

			<div class="row p-3 order_details">
				<div class="col-12 col-md-6 mb-3 mb-md-0">
					<div class="row">
						<div class="col-6 col-md-12 order_details-id"><?php echo esc_html( _x( '#', 'hash before order number', 'woocommerce' ) . $order->get_order_number() ); ?></div>
						<div class="col-6 col-md-12 order_datails-status" id="order_current_status"><?php echo esc_html( wc_get_order_status_name( $order->get_status() ) ); ?></div>
					</div>
				</div>

				<div class="col-12 col-md-6 text-md-end">
					<div class="col-12 order_details-date">建立時間：<?php echo esc_html(wc_format_datetime( $order->get_date_created() ));?></div>
					<div class="col-12 order_details-tracking_num">
						包裹號碼：
						<a href="https://www.t-cat.com.tw/Inquire/Trace.aspx?no=<?php echo esc_html(get_post_meta($order->id, 'tracking_number', true));?>">
							<?php echo esc_html(get_post_meta($order->id, 'tracking_number', true));?>
						</a>
					</div>
				</div>
				
			</div>

			<hr>
			
			<div class="m-4 m-md-5 progress-bar-container">
				<div class="progress">
					<div class="progress-bar" id="myProgress" role="progressbar" style="height:4px;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
				</div>

				<div class="progress-icons">
					<div class="progress-stage-icon" style="left:0%" id="step1"></div>
					<div class="progress-stage-icon" style="left:25%" id="step2"></div>
					<div class="progress-stage-icon" style="left:50%" id="step3"></div>
					<div class="progress-stage-icon" style="left:75%" id="step4"></div>
					<div class="progress-stage-icon" style="left:100%" id="step5"></div>
				</div>

				<div class="stage_labels">
					<p class="stage_labels-tag" style="left:0%" id="label1">訂單已建立</p>
					<p class="stage_labels-tag" style="left:25%" id="label2">等待付款中</p>
					<p class="stage_labels-tag" style="left:50%" id="label3">處理中</p>
					<p class="stage_labels-tag" style="left:75%" id="label4">運送中</p>
					<p class="stage_labels-tag" style="left:100%" id="label5">完成</p>
				</div>
			</div>

			<div class="row mt-3 mt-md-4 p-3 order_review_table">
				<?php do_action( 'woocommerce_view_order', $order_id ); ?>
			</div>
		</div>

			<script>
				orderprogressbar();
				
				function orderprogressbar() {
					var step1 = document.getElementById('step1');
					var step2 = document.getElementById('step2');
					var step3 = document.getElementById('step3');
					var step4 = document.getElementById('step4');
					var step5 = document.getElementById('step5');
					var lab1 = document.getElementById('label1');
					var lab2 = document.getElementById('label2');
					var lab3 = document.getElementById('label3');
					var lab4 = document.getElementById('label4');
					var lab5 = document.getElementById('label5');
					var orderstatus = document.getElementById('order_current_status').innerHTML;

						if(orderstatus=='保留'){
							step1.classList.add("icon-active");
							lab1.classList.add("label-active");
							document.getElementById('myProgress').setAttribute("style", "width:0%");
						}
						else if(orderstatus=='等待付款中'){
							step1.classList.add("icon-active");
							step2.classList.add("icon-pending");
							lab1.classList.add("label-active");
							lab2.classList.add("label-pending");
							document.getElementById('myProgress').setAttribute("style", "width:25%");
						}

						else if(orderstatus=='處理中'){
							step1.classList.add("icon-active");
							step2.classList.add("icon-active");
							step3.classList.add("icon-active");
							lab1.classList.add("label-active");
							lab2.classList.add("label-active");
							lab3.classList.add("label-active");
							document.getElementById('myProgress').setAttribute("style", "width:50%");
						}

						else if(orderstatus=='可取貨'){
							step1.classList.add("icon-active");
							step2.classList.add("icon-active");
							step3.classList.add("icon-active");
							step4.classList.add("icon-pickup");
							lab1.classList.add("label-active");
							lab2.classList.add("label-active");
							lab3.classList.add("label-active");
							lab4.classList.add("label-shipping");
							document.getElementById("label4").innerHTML = "可取貨";
							document.getElementById('myProgress').setAttribute("style", "width:75%");
						}  

						else if(orderstatus=='運送中'){
							step1.classList.add("icon-active");
							step2.classList.add("icon-active");
							step3.classList.add("icon-active");
							step4.classList.add("icon-shipping");
							lab1.classList.add("label-active");
							lab2.classList.add("label-active");
							lab3.classList.add("label-active");
							lab4.classList.add("label-shipping");
							document.getElementById('myProgress').setAttribute("style", "width:75%");
						}  

						else if(orderstatus=='完成'){
							step1.classList.add("icon-active");
							step2.classList.add("icon-active");
							step3.classList.add("icon-active");
							step4.classList.add("icon-active");
							step5.classList.add("icon-active");
							lab1.classList.add("label-active");
							lab2.classList.add("label-active");
							lab3.classList.add("label-active");
							lab4.classList.add("label-active");
							lab5.classList.add("label-active");
							document.getElementById('myProgress').setAttribute("style", "width:100%");
						}
						
						else{
						document.getElementById('myProgress').value=0;
						}
					}

					
			
			</script>

			<?php if ( $notes ) : ?>
				<div class="mt-3">
					<h3><?php esc_html_e( 'Order updates', 'woocommerce' ); ?></h3>
					<ol class="woocommerce-OrderUpdates commentlist notes">
						<?php foreach ( $notes as $note ) : ?>
						<li class="woocommerce-OrderUpdate comment note">
							<div class="woocommerce-OrderUpdate-inner comment_container">
								<div class="woocommerce-OrderUpdate-text comment-text">
									<p class="woocommerce-OrderUpdate-meta meta"><?php echo date_i18n( esc_html__( 'l jS \o\f F Y, h:ia', 'woocommerce' ), strtotime( $note->comment_date ) ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></p>
									<div class="woocommerce-OrderUpdate-description description">
										<?php echo wpautop( wptexturize( $note->comment_content ) ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
									</div>
									<div class="clear"></div>
								</div>
								<div class="clear"></div>
							</div>
						</li>
						<?php endforeach; ?>
					</ol>
				</div>
			<?php endif; ?>

			
		</div>

