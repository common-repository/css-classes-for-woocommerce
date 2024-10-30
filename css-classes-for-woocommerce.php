<?php
/**
 * Plugin Name: CSS Classes For WooCommerce | Customize the woocommerce cart and checkout pages via CSS
 * Plugin URI: https://josemortellaro.com/
 * Description: CSS classes depending on the cart to customize the checkout.
 * Author: Jose Mortellaro
 * Author URI: https://josemortellaro.com
 * Domain Path: /languages/
 * Text Domain: css-classes-for-woocommerce
 * Version: 0.0.3
 *
 * @package CSS Classes For WooCommerce
 */

/**
 * This program is free software; you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation; either version 2 of the License, or
 * (at your option) any later version.
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 */

defined( 'ABSPATH' ) || exit; // Exit if accessed directly.

add_filter(
	'body_class',
	function( $classes ) {
		// Add body class depending on the cart.
		if ( function_exists( 'WC' ) ) {
			$cart = WC()->cart;
			// Cart conditions.
			$classes[] = sanitize_html_class( 'ccfw-contents-count-' . WC()->cart->get_cart_contents_count() );
			$classes[] = $cart->is_empty() ? 'ccfw-empty-cart' : 'ccfw-non-empty-cart';
			$classes[] = $cart->needs_payment() ? 'ccfw-cart-needs-payment' : 'ccfw-cart-not-needs-payment';
			$classes[] = $cart->show_shipping() ? 'ccfw-cart-show-shipping' : 'ccfw-cart-not-show-shipping';
			$classes[] = $cart->needs_shipping() ? 'ccfw-cart-needs-shipping' : 'ccfw-cart-not-needs-shipping';
			$classes[] = $cart->needs_shipping_address() ? 'ccfw-cart-needs-shipping-address' : 'ccfw-cart-not-needs-shipping-address';
			$classes[] = $cart->display_prices_including_tax() ? 'ccfw-prices-including-tax' : 'ccfw-prices-not-including-tax';
			$n         = $p = 0;
			// Loop over cart items.
			foreach ( $cart->get_cart() as $cart_item_key => $cart_item ) {
				$product = $cart_item['data'];
				if ( $product->is_sold_individually() ) {
					++$n;
				}
				$classes[] = sanitize_html_class( 'ccfw-cart-product-' . $cart_item['product_id'] );
				$classes[] = sanitize_html_class( 'ccfw-cart-product-' . $cart_item['product_id'] . '-qty-' . $cart_item['quantity'] );
				$classes[] = sanitize_html_class( 'ccfw-cart-product-' . $cart_item['product_id'] . '-sold-individually-' . ( $product->is_sold_individually() ? 'true' : 'false' ) );
				++$p;
			}
			$classes[] = 'ccfw-cart-all-sold-individually-' . ( $n === $p && 0 !== $n ? 'true' : 'false' );

			// Customer.
			$customer = WC()->cart->get_customer();
			if ( $customer ) {
				$classes[] = sanitize_html_class( 'ccfw-customer-country-' . $customer->get_billing_country() );
				$classes[] = sanitize_html_class( 'ccfw-customer-role-' . $customer->get_role() );
				$args      = array(
					'customer_id' => $customer->get_ID(),
					'limit'       => -1,
				);
				$query     = new WC_Order_Query( $args );
				$orders    = $query->get_orders();
				$classes[] = 'ccfw-customer-has-bought-' . ( count( $orders ) > 0 ? 'true' : 'false' );
				$classes[] = sanitize_html_class( 'ccfw-customer-prev-orders-' . count( $orders ) );
			}
			$classes[] = 'css-classes-for-woocommerce';
			return apply_filters( 'css_classes_for_woocommerce', $classes, $cart );
		}
		return $classes;
	}
);

add_filter( 'woocommerce_cart_item_class', function( $css_class, $cart_item, $cart_item_key ) {
	if( isset( $cart_item['product_id'] ) ){
		$css_class .= ' cart-item-ID-' . esc_attr( $cart_item['product_id'] );
	}
	if( isset( $cart_item['data'] ) ){
		$data = $cart_item['data'];
		$css_class .= ' cart-item-' . esc_attr( $data->get_slug() );
		foreach( $data->get_category_ids() as $cat_id ){
			$css_class .= ' cart-item-cat-id-' . esc_attr( $cat_id );
		}
	}
	return $css_class;
}, 10, 3 );