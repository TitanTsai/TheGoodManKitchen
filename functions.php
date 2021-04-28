<?php 

function load_stylesheets(){
    wp_enqueue_style('bootstrap', get_stylesheet_directory_uri().'/assets/css/bootstrap.min.css');
	wp_enqueue_style('jqueryui', get_stylesheet_directory_uri().'/assets/css/jquery-ui.css');
    wp_enqueue_style( 'themebase-css', get_stylesheet_uri() );
	wp_enqueue_script('jquery_3.5.1',get_template_directory_uri(). '/assets/js/jquery-3.5.1.min.js');
	wp_enqueue_script('jquery_ui',get_template_directory_uri(). '/assets/js/jquery-ui.js');
    wp_enqueue_script('bootstrap-js',get_template_directory_uri(). '/assets/js/bootstrap.min.js', 'jquery', false, true);
	wp_enqueue_script('tw_zipcode',get_template_directory_uri(). '/assets/js/jquery.twzipcode.min.js');
}

add_action('wp_enqueue_scripts', 'load_stylesheets');

//新增幻燈片系統
	add_action( 'init', 'custom_bootstrap_slider' );
	function custom_bootstrap_slider() {
		$labels = array(
			'name'               => _x( '首頁幻燈片', 'post type general name'),
			'singular_name'      => _x( '幻燈片', 'post type singular name'),
			'menu_name'          => _x( '首頁幻燈片', 'admin menu'),
			'name_admin_bar'     => _x( '幻燈片', 'add new on admin bar'),
			'add_new'            => _x( '新增幻燈片', 'Slide'),
			'add_new_item'       => __( '名稱'),
			'new_item'           => __( '新幻燈片'),
			'edit_item'          => __( '編輯幻燈片'),
			'view_item'          => __( '檢視'),
			'all_items'          => __( '所有幻燈片'),
			'featured_image'     => __( '精選圖片', 'text_domain' ),
			'search_items'       => __( '搜尋'),
			'parent_item_colon'  => __( 'Parent Slide:'),
			'not_found'          => __( '沒有幻燈片.'),
			'not_found_in_trash' => __( 'No Slide found in Trash.'),
		);

		$args = array(
			'labels'             => $labels,
			'menu_icon'	     => 'dashicons-star-half',
					'description'        => __( 'Description.'),
			'public'             => true,
			'publicly_queryable' => true,
			'show_ui'            => true,
			'show_in_menu'       => true,
			'query_var'          => true,
			'rewrite'            => true,
			'capability_type'    => 'post',
			'has_archive'        => true,
			'hierarchical'       => true,
			'menu_position'      => null,
			'supports'           => array('title','editor','thumbnail')
		);

		register_post_type( 'slider', $args );
	}

//Bootstrap Walker

	require_once('bs4navwalker.php');

// 註冊主選單
	register_nav_menu('top', 'Top menu');

	register_nav_menus( array(
		'top' => __( '主選單' ),
	) );


//新增導覽列購物車

	add_shortcode ('woo_cart_but', 'woo_cart_but' );
	/**
	 * Create Shortcode for WooCommerce Cart Menu Item
	 */
	function woo_cart_but() {
		ob_start();
	
			$cart_count = WC()->cart->cart_contents_count; // Set variable for cart item count
			$cart_url = wc_get_cart_url();  // Set Cart URL
	
			?>
			<div class="nav-item mx-md-3">
				<a class="nav-link cart-contents" href="<?php echo $cart_url; ?>" title="mini_cart">
					<?php if ( $cart_count > 0 ) {
					
					?>
						<span class="cart-contents-count"><?php echo $cart_count; ?></span>
						<?php
							}
						?>
					</a>
			</div>
			<?php
				
		return ob_get_clean();
	
	}


	add_filter( 'woocommerce_add_to_cart_fragments', 'woo_cart_but_count' );
	/**
	 * Add AJAX Shortcode when cart contents update
	 */
	function woo_cart_but_count( $fragments ) {
	
		ob_start();
		
		$cart_count = WC()->cart->cart_contents_count;
		$cart_url = wc_get_cart_url();
		
		?>
		<a class="cart-contents menu-item" href="<?php echo $cart_url; ?>" title="<?php _e( 'View your shopping cart' ); ?>">
		<?php
		if ( $cart_count > 0 ) {
			?>
			<span class="cart-contents-count"><?php echo $cart_count; ?></span>
			<?php            
		}
			?></a>
		<?php
	
		$fragments['a.cart-contents'] = ob_get_clean();
		
		return $fragments;
	}

//支援Woocommerce
	function mytheme_add_woocommerce_support() {
		add_theme_support( 'woocommerce' );
		add_theme_support('post-thumbnails');
	}

	add_action( 'after_setup_theme', 'mytheme_add_woocommerce_support' );

//商品頁面內容
	add_action( 'kitchen_product_summary', 'woocommerce_template_single_title', 5 );
	add_action( 'kitchen_product_summary', 'woocommerce-variation-description',10);
	add_action( 'kitchen_product_summary', 'woocommerce_template_single_add_to_cart', 15 );

//一律顯示價格
	add_filter('woocommerce_show_variation_price',      function() { return TRUE;});

//Bootstrap輸入樣式
	add_filter('woocommerce_form_field_args',  'wc_form_field_args',10,3);
	function wc_form_field_args($args, $key, $value) {
		$args['class'][] = 'form-group'; 

		// add form-control to the actual input
		$args['input_class'][] = 'form-control';
	return $args;
	} 

//地址自動填入
	add_filter("woocommerce_after_checkout_form", "twzipcodefield_shipping");
		function twzipcodefield_shipping() {
			$output = '
			
			<script>
			var $ = jQuery.noConflict();
			function updateValue(field){
			$("#"+field+"_state").val($(".woocommerce-"+field+"-fields select[name=\'county\']").val());
			$("#"+field+"_city").val($(".woocommerce-"+field+"-fields select[name=\'district\']").val());
			$("#"+field+"_postcode").val($(".woocommerce-"+field+"-fields input[name=\'zipcode\']").val());
			}
			$(document).ready(function(){
			$(".woocommerce-billing-fields").twzipcode({
			"detect": false
			});
			function updateField(field){
			$(".woocommerce-"+field+"-fields select[name=\'county\']").appendTo($("#"+field+"_state_field"));
			$(".woocommerce-"+field+"-fields select[name=\'district\']").appendTo($("#"+field+"_city_field"));
			$(".woocommerce-"+field+"-fields input[name=\'zipcode\']").appendTo($("#"+field+"_postcode_field"));
			} 
			updateField("billing");
			$("select[name=\'county\'],select[name=\'district\']").change(function(){updateValue("billing");})
			$("input[name=\'zipcode\']").keyup(function(){updateValue("billing");})
			$("#billing_postcode,#billing_state,#billing_city").hide();
			})
			</script>';
		echo $output;
	}


//新增到貨日期欄位

	//Jquery日期選擇器
	add_action( 'wp_enqueue_scripts', 'enabling_date_picker' );
	function enabling_date_picker() {
		// Only on front-end and checkout page
		if( is_admin() || ! is_checkout() ) return;

		// Load the datepicker jQuery-ui plugin script
		wp_enqueue_script( 'jquery-ui-datepicker' );

	}

	add_action( 'woocommerce_before_order_notes', 'delivery_date_select' );

	function delivery_date_select( $checkout ) {
		$datepicker_slug = 'date';

		woocommerce_form_field( $datepicker_slug, array(
			'type'          => 'text',
			'class'         => array('form-group col-5'),
			'label'         => __('到貨日期'),
			'placeholder'   => __('請選擇日期'),
			'required'		=> true,
			), $checkout->get_value( 'date' ));
	
		?>
		
		<script language="javascript">
		jQuery( function($){
			var a = '#<?php echo $datepicker_slug ?>';
			$(a).datepicker({
				dateFormat: 'yy-mm-dd', // ISO formatting date
				minDate : "+3d",
				maxDate : "+14d",
				defaultDate:new Date(),
			});
		});
		</script>

		<?php

	}

	add_action('woocommerce_before_order_notes','delivery_daytime_select');
	
	function delivery_daytime_select($checkout){
		woocommerce_form_field( 'daytime', array(
		'type'          => 'select',
		'class'         => array( 'col-5 mx-2' ),
		'label'         => __( '配送時段' ),
		'required'		=> true,
		'options'       => array(
		'不限時段'		=> __( '不限時段'),
		'08:00~13:00'	=> __( '08:00~13:00'),
		'14:00~18:00'	=> __( '14:00~18:00'),
				)
		),
		$checkout->get_value( 'daytime' ));

		echo '<div style="color:#b45050">訂單自成立至到貨約需三個工作日</div>';
	}

	//檢查是否填入資料
	add_action('woocommerce_checkout_process', 'my_custom_checkout_field_process');

	function my_custom_checkout_field_process() {
		// Check if set, if its not set add an error.
		if ( ! $_POST['date'] )
			wc_add_notice( __( '請選擇欲收到貨的日期' ), 'error' );
		
	}

	//儲存資訊
	add_action( 'woocommerce_checkout_update_order_meta', 'update_delivery_date_meta' );

	function update_delivery_date_meta( $order_id ) {
		if ( ! empty( $_POST['date'] ) ) {
			update_post_meta( $order_id, '到貨日期', sanitize_text_field( $_POST['date'] ) );
		}
	}

	add_action( 'woocommerce_checkout_update_order_meta', 'update_delivery_time_meta' );

	function update_delivery_time_meta( $order_id ) {
		if ( ! empty( $_POST['daytime'] ) ) {
			update_post_meta( $order_id, '配送時段', sanitize_text_field( $_POST['daytime'] ) );
		}
	}

	//在管理頁面顯示	
	add_action( 'woocommerce_admin_order_data_after_billing_address', 'admin_display_delivery_date_and_time_meta', 10, 1 );
	function admin_display_delivery_date_and_time_meta($order){
		echo '<div><h3>'.__('到貨日期').':</h3> <div>' . get_post_meta( $order->id, '到貨日期', true ) . '</div>';
		echo '<div>'.__('配送時段').':' . get_post_meta( $order->id, '配送時段', true ) . '</div></div>';
	}

//合併帳戶與地址頁面
	add_filter( 'woocommerce_account_menu_items', 'bbloomer_remove_address_my_account', 999 );
	
	function bbloomer_remove_address_my_account( $items ) {
		unset($items['edit-address']);
		return $items;
	}

	add_action( 'woocommerce_account_edit-account_hook', 'woocommerce_account_edit_address' );


//重新導向至登入畫面
	add_action('template_redirect','check_if_logged_in');
    
	function check_if_logged_in()
    {
        $pageid = get_option( 'woocommerce_checkout_page_id' );
        if(!is_user_logged_in() && is_page($pageid))
        {
            $url = add_query_arg(
                'redirect_to',
                get_permalink($pagid),
                site_url('/my-account/') // your my acount url
            );
            wp_redirect($url);
            exit;
        }
        if(is_user_logged_in())
        {
        if(is_page(get_option( 'woocommerce_myaccount_page_id' )))
        {
            
            $redirect = $_GET['redirect_to'];
            if (isset($redirect)) {
            echo '<script>window.location.href = "'.$redirect.'";</script>';
            }
    
        }
        }
    }


//隱藏結帳欄位
	add_filter( 'woocommerce_checkout_fields' , 'custom_override_checkout_fields' );

	function custom_override_checkout_fields( $fields ) {
		unset($fields['billing']['billing_company']);
		unset($fields['billing']['billing_address_2']);
		return $fields;
	} 	

//新增訂單狀態
	function register_shipping_order_status() {
		register_post_status( 'wc-shipping', array(
			'label'                     => '運送中',
			'public'                    => true,
			'exclude_from_search'       => false,
			'show_in_admin_all_list'    => true,
			'show_in_admin_status_list' => true,
			'label_count'               => _n_noop( 'shipping (%s)', 'shipping (%s)' )
		) );

		register_post_status( 'wc-pickup', array(
			'label'                     => '可取貨',
			'public'                    => true,
			'exclude_from_search'       => false,
			'show_in_admin_all_list'    => true,
			'show_in_admin_status_list' => true,
			'label_count'               => _n_noop( 'pickup (%s)', 'pickup (%s)' )
		) );
	}
	add_action( 'init', 'register_shipping_order_status' );

	function add_shipping_to_order_statuses( $order_statuses ) {
	
		$new_order_statuses = array();
	
		// add new order status after processing
		foreach ( $order_statuses as $key => $status ) {
	
			$new_order_statuses[ $key ] = $status;
	
			if ( 'wc-processing' === $key ) {
				$new_order_statuses['wc-shipping'] = '運送中';
				$new_order_statuses['wc-pickup'] = '可取貨';
			}
		}
	
		return $new_order_statuses;
	}
	add_filter( 'wc_order_statuses', 'add_shipping_to_order_statuses' );


//測試管理員欄位
add_action( 'add_meta_boxes', 'mv_add_meta_boxes' );
if ( ! function_exists( 'mv_add_meta_boxes' ) )
{
    function mv_add_meta_boxes()
    {
        add_meta_box( 'mv_other_fields', __('物流單號','woocommerce'), 'mv_add_other_fields_for_packaging', 'shop_order', 'side', 'core' );
    }
}

// Adding Meta field in the meta container admin shop_order pages
if ( ! function_exists( 'mv_add_other_fields_for_packaging' ) )
{
    function mv_add_other_fields_for_packaging()
    {
        global $post;

        $meta_field_data = get_post_meta( $post->ID, 'tracking_number', true ) ? get_post_meta( $post->ID, 'tracking_number', true ) : '';

        echo '<input type="hidden" name="mv_other_meta_field_nonce" value="' . wp_create_nonce() . '">
        <p style="border-bottom:solid 1px #eee;padding-bottom:13px;">
            <input type="text" style="width:250px;";" name="my_field_name" placeholder="' . $meta_field_data . '" value="' . $meta_field_data . '"></p>';

    }
}

// Save the data of the Meta field
add_action( 'save_post', 'mv_save_wc_order_other_fields', 10, 1 );
if ( ! function_exists( 'mv_save_wc_order_other_fields' ) )
{

    function mv_save_wc_order_other_fields( $post_id ) {

        // We need to verify this with the proper authorization (security stuff).

        // Check if our nonce is set.
        if ( ! isset( $_POST[ 'mv_other_meta_field_nonce' ] ) ) {
            return $post_id;
        }
        $nonce = $_REQUEST[ 'mv_other_meta_field_nonce' ];

        //Verify that the nonce is valid.
        if ( ! wp_verify_nonce( $nonce ) ) {
            return $post_id;
        }

        // If this is an autosave, our form has not been submitted, so we don't want to do anything.
        if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
            return $post_id;
        }

        // Check the user's permissions.
        if ( 'page' == $_POST[ 'post_type' ] ) {

            if ( ! current_user_can( 'edit_page', $post_id ) ) {
                return $post_id;
            }
        } else {

            if ( ! current_user_can( 'edit_post', $post_id ) ) {
                return $post_id;
            }
        }
        // --- Its safe for us to save the data ! --- //

        // Sanitize user input  and update the meta field in the database.
        update_post_meta( $post_id, 'tracking_number', $_POST[ 'my_field_name' ] );
    }
}


//新增促銷訊息
add_action( 'wp', 'add_product_content' );
function add_product_content() {

	if ( is_product() && has_term( 'chicken', 'product_tag' ) ) {
		add_action( 'woocommerce_after_add_to_cart_button', 'content_after_addtocart_button' );
		function content_after_addtocart_button() {
		echo '
		<div class="my-3" style="color:#f2f2f2;font-size:1.1em">
		<i class="fas fa-bullhorn"></i> &nbsp;雞胸系列買十送一（共十一片）</div>
		';
		}
	}
}

function bootstrap_pagination( $echo = true ) {
	global $wp_query;

	$big = 999999999; // need an unlikely integer

	$pages = paginate_links( array(
			'base' => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
			'format' => '?paged=%#%',
			'current' => max( 1, get_query_var('paged') ),
			'total' => $wp_query->max_num_pages,
			'type'  => 'array',
			'prev_next'   => true,
			'prev_text'    => __('« Prev'),
			'next_text'    => __('Next »'),
		)
	);

	if( is_array( $pages ) ) {
		$paged = ( get_query_var('paged') == 0 ) ? 1 : get_query_var('paged');

		$pagination = '<ul class="pagination">';

		foreach ( $pages as $page ) {
			$pagination .= "<li>$page</li>";
		}

		$pagination .= '</ul>';

		if ( $echo ) {
			echo $pagination;
		} else {
			return $pagination;
		}
	}
}

?>
