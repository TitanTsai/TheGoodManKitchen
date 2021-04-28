<?php
/**
 * The Template for displaying all single products
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see         https://docs.woocommerce.com/document/template-structure/
 * @package     WooCommerce\Templates
 * @version     1.6.4
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

get_header(); ?>

	<div class="container mt-3 mt-md-5" style="min-height:60vh;">

		<?php
			/**
			 * woocommerce_before_main_content hook.
			 *
			 * @hooked woocommerce_output_content_wrapper - 10 (outputs opening divs for the content)
			 * @hooked woocommerce_breadcrumb - 20
			 */
			do_action( 'woocommerce_before_main_content' );
		?>

		<?php while ( have_posts() ) : ?>
			<div class="row d-flex justify-content-center">
				<div class="single-product_container col-11 col-md-12">
					<?php the_post(); ?>
					<?php wc_get_template_part('content', 'single-product');?>
				</div>
			</div>
		<?php endwhile; // end of the loop. ?>

		
	</div>
	
	<div class="container">
		<div class="d-flex justify-content-between next-prev-button">
			<div><?php previous_post_link('← %link'); ?></div>
			<div><?php next_post_link('%link →'); ?> </div>
		</div>
	
		<?php
		/**
		 * woocommerce_after_main_content hook.
		 *
		 * @hooked woocommerce_output_content_wrapper_end - 10 (outputs closing divs for the content)
		 */
		do_action( 'woocommerce_after_main_content' );
		?>
	</div>
<?php
get_footer();

/* Omit closing PHP tag at the end of PHP files to avoid "headers already sent" issues. */
