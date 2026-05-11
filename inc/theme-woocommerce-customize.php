<?php

/**
 * Package Highit
 * Author Ir Tech
 * @since 1.0.1
 * */

if (! defined('ABSPATH')) {
	exit(); //exit if access directly
}

if (! class_exists('Highit_Woocomerce_Customize')) {
	class Highit_Woocomerce_Customize
	{
		//$instance variable
		private static $instance;

		public function __construct()
		{
			//remove woocommerce action
			remove_action('woocommerce_archive_description', 'woocommerce_taxonomy_archive_description', 10);
			remove_action('woocommerce_archive_description', 'woocommerce_product_archive_description', 10);
			remove_action('woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_price', 10);


			//add filter for woocomerce page
			add_filter('woocommerce_post_class', array($this, 'wc_product_post_class'), 20, 3);
			// add_filter('woocommerce_show_page_title', '__return_false');
			add_filter('woocommerce_enqueue_styles', '__return_false');

			//add action for woocommerce layout
			// add_filter('woocommerce_add_to_cart_fragments', array(
			// 	$this,
			// 	'woocommerce_header_add_to_cart_fragment'
			// ));
			add_action('woocommerce_before_shop_loop', array(
				$this,
				'woocommerce_before_shop_header_wrap_start'
			), 12);

			add_action('woocommerce_before_shop_loop', array($this, 'woocommerce_before_shop_header_wrap_end'), 32);

			add_action('woocommerce_before_shop_loop_item_title', array(
				$this,
				'woocommerce_before_shop_loop_item_thumbnail_wrap_start'
			), 9);

			add_action('woocommerce_before_shop_loop_item_title', 'woocommerce_template_loop_product_link_open', 9);
			add_action('woocommerce_before_shop_loop_item_title', 'woocommerce_template_loop_product_link_close', 10);

			add_action('woocommerce_before_shop_loop_item_title', array(
				$this,
				'woocommerce_before_shop_loop_item_ul_start'
			), 11);

			if (defined('YITH_WCQV_VERSION')) {
				add_filter('yith_add_quick_view_button_html', '__return_false');
				add_action('woocommerce_before_shop_loop_item_title', array(
					$this,
					'woocommerce_before_shop_loop_item_li_quick_view'
				), 11);
			}

			// add_action('woocommerce_before_shop_loop_item_title', array(
			// 	$this,
			// 	'woocommerce_before_shop_loop_item_li_add_to_cart'
			// ), 11);

			add_action('woocommerce_before_shop_loop_item_title', array(
				$this,
				'woocommerce_before_shop_loop_item_ul_end'
			), 11);
			add_action('woocommerce_before_shop_loop_item_title', array(
				$this,
				'woocommerce_before_shop_loop_item_thumbnail_wrap_end'
			), 12);
			add_action('woocommerce_before_shop_loop_item_title', array(
				$this,
				'woocommerce_shop_loop_item_content_wrap_start'
			), 14);

			add_action('woocommerce_before_shop_loop_item_title', 'woocommerce_template_loop_product_link_open', 15);
			add_action('woocommerce_after_shop_loop_item', 'woocommerce_template_loop_price', 6);

			add_action('woocommerce_after_shop_loop_item', array(
				$this,
				'woocommerce_shop_loop_item_content_wrap_end'
			), 12);

			add_action('woocommerce_before_single_product_summary', array(
				$this,
				'woocommerce_before_single_product_summary_wrapper_start'
			), 9);
			add_action('woocommerce_before_single_product_summary', array(
				$this,
				'woocommerce_before_single_product_thumbnail_wrapper_end'
			), 22);
			add_action('woocommerce_after_single_product_summary', array(
				$this,
				'woocommerce_before_single_product_summary_wrapper_end'
			), 9);
			add_action('woocommerce_before_account_navigation', array(
				$this,
				'woocommerce_before_account_navigation_wrapper_start'
			), 10);
			add_action('woocommerce_account_content', array(
				$this,
				'woocommerce_before_account_navigation_wrapper_end'
			), 30);


			// Single Product Page
			remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_excerpt', 20);
			add_action('woocommerce_single_product_summary', 'woocommerce_template_single_excerpt', 6);

			add_action('woocommerce_after_add_to_cart_form', array($this, 'add_product_delivery_info'));
			add_filter('woocommerce_product_tabs', array($this, 'add_product_info_tabs'), 99);

			// Related Products
			add_filter('woocommerce_output_related_products_args', array($this, 'related_products_args'));
			add_filter('woocommerce_catalog_orderby', array($this, 'remove_woocommerce_sorting_options'));

			add_filter('woocommerce_get_price_html', array($this, 'custom_get_price_html'), 10, 2);
		}

		// Remove Sorting Options
		public function remove_woocommerce_sorting_options($catalog_orderby_options)
		{
			unset($catalog_orderby_options['popularity']);  // Remove "Sort by popularity"
			unset($catalog_orderby_options['rating']);      // Remove "Sort by average rating"
			unset($catalog_orderby_options['date']);        // Remove "Sort by latest"

			return $catalog_orderby_options;
		}

		// Related Products
		public function related_products_args($args)
		{
			$args['posts_per_page'] = 5;
			return $args;
		}

		function custom_get_price_html($price, $product)
		{
			if (is_product() && $product->is_on_sale() && !$product->is_type('variable')) {
				$regular_price = floatval($product->get_regular_price());
				$sale_price = floatval($product->get_price());

				if ($regular_price) {
					$discount = round(($regular_price - $sale_price) * 100 / $regular_price, 2);

					$discountIcon = '<svg width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M6.75 10.5L11.25 6M7.5 6.375C7.5 6.58211 7.33211 6.75 7.125 6.75C6.91789 6.75 6.75 6.58211 6.75 6.375C6.75 6.16789 6.91789 6 7.125 6C7.33211 6 7.5 6.16789 7.5 6.375ZM11.25 10.125C11.25 10.3321 11.0821 10.5 10.875 10.5C10.6679 10.5 10.5 10.3321 10.5 10.125C10.5 9.91789 10.6679 9.75 10.875 9.75C11.0821 9.75 11.25 9.91789 11.25 10.125ZM3.75 15.75V3.75C3.75 3.35218 3.90804 2.97064 4.18934 2.68934C4.47064 2.40804 4.85218 2.25 5.25 2.25H12.75C13.1478 2.25 13.5294 2.40804 13.8107 2.68934C14.092 2.97064 14.25 3.35218 14.25 3.75V15.75L12 14.25L10.5 15.75L9 14.25L7.5 15.75L6 14.25L3.75 15.75Z" stroke="#6908D8" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/></svg>';

					return $price . '<span class="discount-percent">' . $discountIcon .  $discount . '% Off</span>';
				}
			}

			// Exclude Tax for Variable Products
			if (isset($_COOKIE['exclude_tax']) && $_COOKIE['exclude_tax'] == 'yes' && $product->is_type('variable')) {
				$prices = $product->get_variation_prices(false);

				if (!empty($prices['price'])) {
					$min_price = current($prices['price']);
					$max_price = end($prices['price']);

					if ($min_price !== $max_price) {
						$tax_exc_min_price = wc_get_price_excluding_tax($product, array('price' => $min_price));
						$tax_exc_max_price = wc_get_price_excluding_tax($product, array('price' => $max_price));

						$price = wc_format_price_range($tax_exc_min_price, $tax_exc_max_price);
					} else {
						$price = wc_get_price_excluding_tax($product);
					}
				}
			}

			return $price;
		}

		function add_product_info_tabs($tabs)
		{
			if (isset($tabs['additional_information'])) {
				$tabs['additional_information']['title'] = __('Specification', 'woocommerce');
				$tabs['delivery_info']['title'] = __('Delivery & Returns', 'woocommerce');
				$tabs['delivery_info']['callback'] = 'woocommerce_product_delivery_returns_tab';
			}

			return $tabs;
		}

		function add_product_delivery_info()
		{
			global $post;

			$delivery_days = floatval(get_post_meta($post->ID, '_delivery_time', true));

			// $delivery_date = date("D d M", strtotime("+$delivery_days days"));

			$delivery_date = highit_get_business_day($delivery_days);

			if (!empty($delivery_days)) {
?>
				<div class="delivery-info">
					<svg width="48" height="48" viewBox="0 0 48 48" fill="none" xmlns="http://www.w3.org/2000/svg">
						<rect x="0.6" y="0.6" width="46.8" height="46.8" rx="23.4" fill="white" />
						<rect x="0.6" y="0.6" width="46.8" height="46.8" rx="23.4" stroke="#DCE4E9" stroke-width="1.2" />
						<g clip-path="url(#clip0_1754_38961)">
							<path fill-rule="evenodd" clip-rule="evenodd" d="M30.1313 15.6188C32.6283 16.1983 33.5835 17.6583 34.781 19.668H30.1313V15.6188ZM15.5389 19.8367C16.0278 19.8367 16.3826 20.0727 16.3826 20.6242C16.3826 21.0894 16.0062 21.4667 15.5413 21.468H10.4438C9.97781 21.468 9.6001 21.8459 9.6001 22.3117C9.6001 22.7778 9.97781 23.1555 10.4438 23.1555H18.0376C18.508 23.1555 18.8846 23.533 18.8846 23.9992C18.8846 24.4653 18.5069 24.843 18.0409 24.843H10.4438C9.97781 24.843 9.6001 25.2207 9.6001 25.6867C9.6001 26.1528 9.97781 26.5305 10.4438 26.5305H12.3001V29.0617C12.3001 29.5278 12.6778 29.9055 13.1438 29.9055H14.8399C15.1423 31.3948 16.4582 32.493 18.0095 32.493C19.5607 32.493 20.8767 31.3948 21.179 29.9055H29.7462C30.0485 31.3948 31.3645 32.493 32.9157 32.493C34.467 32.493 35.7829 31.3948 36.0853 29.9055H37.5563C38.0224 29.9055 38.4001 29.5278 38.4001 29.0617V23.9992C38.4001 21.5236 35.7889 21.3592 35.7865 21.3555H29.2876C28.8216 21.3555 28.4438 20.9778 28.4438 20.5117V15.4492H13.1438C12.6778 15.4492 12.3001 15.8269 12.3001 16.293V18.1492H11.2876C10.8216 18.1492 10.4438 18.5269 10.4438 18.993C10.4438 19.459 10.8216 19.8367 11.2876 19.8367H15.5389ZM34.0095 28.1648C34.6136 28.7688 34.6136 29.7486 34.0095 30.3526C33.0379 31.3242 31.3688 30.633 31.3688 29.2586C31.3688 27.8844 33.0379 27.1932 34.0095 28.1648ZM19.1033 28.1648C19.7073 28.7688 19.7073 29.7486 19.1033 30.3526C18.1316 31.3242 16.4626 30.633 16.4626 29.2586C16.4626 27.8844 18.1316 27.1932 19.1033 28.1648Z" fill="#FAC800" />
						</g>
						<defs>
							<clipPath id="clip0_1754_38961">
								<rect width="28.8" height="28.8" fill="white" transform="translate(9.6001 9.59961)" />
							</clipPath>
						</defs>
					</svg>

					<div class="info">
						<p>Approximate Delivery Time</p>
						<p>Get it by <span><?php echo $delivery_date; ?></span></p>
					</div>

					<!-- <div class="btn-wrap">
					<button class="boxed-btn yellow-btn">
						<svg width="18" height="14" viewBox="0 0 18 14" fill="none" xmlns="http://www.w3.org/2000/svg">
							<path d="M3.16667 11.167C3.16667 11.609 3.34226 12.0329 3.65482 12.3455C3.96738 12.6581 4.39131 12.8337 4.83333 12.8337C5.27536 12.8337 5.69928 12.6581 6.01184 12.3455C6.3244 12.0329 6.5 11.609 6.5 11.167M3.16667 11.167C3.16667 10.725 3.34226 10.301 3.65482 9.98848C3.96738 9.67592 4.39131 9.50033 4.83333 9.50033C5.27536 9.50033 5.69928 9.67592 6.01184 9.98848C6.3244 10.301 6.5 10.725 6.5 11.167M3.16667 11.167H1.5V2.00033C1.5 1.77931 1.5878 1.56735 1.74408 1.41107C1.90036 1.25479 2.11232 1.16699 2.33333 1.16699H9.83333V11.167M6.5 11.167H11.5M11.5 11.167C11.5 11.609 11.6756 12.0329 11.9882 12.3455C12.3007 12.6581 12.7246 12.8337 13.1667 12.8337C13.6087 12.8337 14.0326 12.6581 14.3452 12.3455C14.6577 12.0329 14.8333 11.609 14.8333 11.167M11.5 11.167C11.5 10.725 11.6756 10.301 11.9882 9.98848C12.3007 9.67592 12.7246 9.50033 13.1667 9.50033C13.6087 9.50033 14.0326 9.67592 14.3452 9.98848C14.6577 10.301 14.8333 10.725 14.8333 11.167M14.8333 11.167H16.5V6.16699M16.5 6.16699H9.83333M16.5 6.16699L14 2.00033H9.83333" stroke="#3D3100" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
						</svg> Free Delivery</button>
				</div> -->
				</div>
			<?php }  ?>

			<div class="help-link">
				<p>
					<svg width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
						<path d="M9 13.1667V13.175M9 10.2499C8.98466 9.97941 9.05763 9.71123 9.20793 9.48578C9.35823 9.26033 9.57772 9.08982 9.83333 8.99993C10.1466 8.88015 10.4277 8.6893 10.6546 8.4424C10.8816 8.19549 11.0481 7.89929 11.1411 7.57709C11.2341 7.2549 11.2511 6.91551 11.1906 6.58566C11.1302 6.2558 10.994 5.94448 10.7928 5.6762C10.5916 5.40792 10.3308 5.19 10.0311 5.03962C9.73134 4.88923 9.40079 4.81047 9.06544 4.80954C8.73009 4.80861 8.3991 4.88553 8.09854 5.03426C7.79797 5.18298 7.53603 5.39944 7.33333 5.6666M1.5 9C1.5 9.98491 1.69399 10.9602 2.0709 11.8701C2.44781 12.7801 3.00026 13.6069 3.6967 14.3033C4.39314 14.9997 5.21993 15.5522 6.12987 15.9291C7.03982 16.306 8.01509 16.5 9 16.5C9.98491 16.5 10.9602 16.306 11.8701 15.9291C12.7801 15.5522 13.6069 14.9997 14.3033 14.3033C14.9997 13.6069 15.5522 12.7801 15.9291 11.8701C16.306 10.9602 16.5 9.98491 16.5 9C16.5 8.01509 16.306 7.03982 15.9291 6.12987C15.5522 5.21993 14.9997 4.39314 14.3033 3.6967C13.6069 3.00026 12.7801 2.44781 11.8701 2.0709C10.9602 1.69399 9.98491 1.5 9 1.5C8.01509 1.5 7.03982 1.69399 6.12987 2.0709C5.21993 2.44781 4.39314 3.00026 3.6967 3.6967C3.00026 4.39314 2.44781 5.21993 2.0709 6.12987C1.69399 7.03982 1.5 8.01509 1.5 9Z" stroke="#2D3139" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
					</svg>
					Any Confusion?<a href="#"> Help</a>
				</p>
			</div>
		<?php
		}

		/**
		 * Show cart contents / total Ajax
		 * @since 1.0.2
		 */
		function woocommerce_header_add_to_cart_fragment($fragments)
		{
			global $woocommerce;
			ob_start();
		?>
			<a class="highit-header-cart" href="<?php echo wc_get_cart_url(); ?>"
				title="<?php esc_attr_e('View your shopping cart', 'highit'); ?>">
				<i class="fa fa-shopping-basket" aria-hidden="true"></i>
				<span class="cart-badge"><?php echo sprintf('%d', WC()->cart->get_cart_contents_count()); ?></span>
			</a>
		<?php
			$fragments['a.highit-header-cart'] = ob_get_clean();

			return $fragments;
		}

		/**
		 * shop header wrap start
		 * @since 1.0.2
		 * */
		public function woocommerce_before_shop_header_wrap_start()
		{
		?>
			<div class="woocommerce-header-area-wrap">
			<?php
		}

		/**
		 * shop header wrap end
		 * @since 1.0.2
		 * */
		public function woocommerce_before_shop_header_wrap_end()
		{
			?>
			</div>
		<?php
		}

		/**
		 * product class for archive and single page
		 * @since 1.0.2
		 * */
		public function wc_product_post_class($class)
		{
			$class[] = is_product() ? 'highit-product-single-page-item' : 'highit-single-product-item';

			return $class;
		}

		/**
		 * add wrapper for thumbnail and sale attribute start
		 * @sinsce 1.0.0
		 * */
		public function woocommerce_before_shop_loop_item_thumbnail_wrap_start()
		{
		?>
			<div class="woocommerce-thumbnail-wrap">
			<?php
		}

		/**
		 * add ul after thumbnail wrap start
		 * @sinsce 1.0.0
		 * */
		public function woocommerce_before_shop_loop_item_ul_start()
		{
			?>
				<ul class="highit-thumb-inner-item-list">
				<?php
			}

			/**
			 * add ul after thumbnail wrap start
			 * @sinsce 1.0.0
			 * */
			public function woocommerce_before_shop_loop_item_li_add_to_cart()
			{
				?>
					<li>
						<?php
						$args = ['quantity', 'class', 'attributes', 'icon' => '<i class="fas fa-shopping-cart"></i>'];
						global $product;
						echo apply_filters(
							'highit_woocommerce_loop_add_to_cart_link', // WPCS: XSS ok.
							sprintf(
								'<a href="%s" data-quantity="%s" data-product_id="%s" data-product_sku="%s" class="%s" %s>%s</a>',
								esc_url($product->add_to_cart_url()),
								esc_attr(isset($args['quantity']) ? $args['quantity'] : 1),
								$product->get_id(),
								$product->get_sku(),
								esc_attr(isset($args['class']) ? $args['class'] : 'button add_to_cart_button ajax_add_to_cart'),
								isset($args['attributes']) ? wc_implode_html_attributes($args['attributes']) : '',
								wp_kses($args['icon'], Highit()->kses_allowed_html('all'))
							),
							$product,
							$args
						);
						?>
					</li>
				<?php
			}

			/**
			 * add ul after thumbnail wrap start
			 * @sinsce 1.0.0
			 * */
			public function woocommerce_before_shop_loop_item_li_quick_view()
			{
				?>
					<li>
						<?php
						$args = ['quantity', 'class', 'attributes', 'icon' => '<i class="far fa-eye"></i>'];
						global $product;
						echo apply_filters(
							'yith_wcqv_show_quick_view_button', // WPCS: XSS ok.
							sprintf(
								'<a href="%s" data-quantity="%s" data-product_id="%s" data-product_sku="%s" class="%s" %s>%s</a>',
								esc_url($product->add_to_cart_url()),
								esc_attr(isset($args['quantity']) ? $args['quantity'] : 1),
								$product->get_id(),
								$product->get_sku(),
								esc_attr(isset($args['class']) ? $args['class'] : 'button add_to_cart_button yith-wcqv-button'),
								isset($args['attributes']) ? wc_implode_html_attributes($args['attributes']) : '',
								wp_kses($args['icon'], Highit()->kses_allowed_html('all'))
							),
							$product,
							$args
						);
						?>
					</li>
				<?php
			}


			/**
			 * add ul after thumbnail wrap end
			 * @sinsce 1.0.2
			 * */
			public function woocommerce_before_shop_loop_item_ul_end()
			{
				?>
				</ul>
			<?php
			}

			/**
			 * add wrapper for thumbnail and sale attribute end
			 * @sinsce 1.0.2
			 * */
			public function woocommerce_before_shop_loop_item_thumbnail_wrap_end()
			{
			?>
			</div>
		<?php
			}

			/**
			 * add wrapper for title, price and add to cart item
			 * @sinsce 1.0.2
			 * */
			public function woocommerce_shop_loop_item_content_wrap_start()
			{
		?>
			<div class="product-contnent-wrap">
			<?php
			}

			/**
			 * add wrapper for title, price and add to cart item
			 * @sinsce 1.0.2
			 * */
			public function woocommerce_shop_loop_item_content_wrap_end()
			{
			?>
			</div>
		<?php
			}

			/**
			 * add wrapper for title, price and add to cart item and product summery for single product page
			 * @sinsce 1.0.2
			 * */
			public function woocommerce_before_single_product_summary_wrapper_start()
			{
		?>
			<div class="woocommmerce-product-single-page-top-content-wrap">
				<div class="woocommerce-thumbnail-wrapper">
				<?php
			}

			/**
			 * add wrapper for title, price and add to cart item and product summery for single product page
			 * @sinsce 1.0.2
			 * */
			public function woocommerce_before_single_product_summary_wrapper_end()
			{
				?>
				</div>
			<?php
			}
			/**
			 * add wrapper for title, price and add to cart item . single product page thumbnail wrap
			 * @sinsce 1.0.2
			 * */
			public function woocommerce_before_single_product_thumbnail_wrapper_end()
			{
			?>
			</div>
		<?php
			}

			/**
			 * add wrapper for my account navigation and content
			 * @sinsce 1.0.2
			 * */
			public function woocommerce_before_account_navigation_wrapper_start()
			{
		?>
			<div class="woocommerce-my-account-page-wrapper">
			<?php
			}

			/**
			 * add wrapper for my account navigation and content
			 * @sinsce 1.0.2
			 * */
			public function woocommerce_before_account_navigation_wrapper_end()
			{
			?>
			</div>
<?php
			}


			/**
			 * get Instance
			 * @since 1.0.2
			 * */
			public static function getInstance()
			{
				if (null == self::$instance) {
					self::$instance = new self();
				}

				return self::$instance;
			}
		} //end class

		if (class_exists('Highit_Woocomerce_Customize')) {
			Highit_Woocomerce_Customize::getInstance();
		}
	}
