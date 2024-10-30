=== CSS Classes For WooCommerce - customize the WooCommerce cart and checkout via CSS ===

Contributors:      giuse
Requires at least: 4.6
Tested up to:      6.4
Requires PHP:      7.2
Stable tag:        0.0.3
License:           GPLv2 or later
License URI:       https://www.gnu.org/licenses/gpl-2.0.html
Tags:              customization, body, style, cart, checkout

CSS classes depending on the cart to customize the checkout.

== Description ==

CSS Classes For WooCommerce adds CSS classes to the body depending on the cart and the customer.
You can then use those classes to customize the checkout and cart pages with your custom CSS.

== CSS classes added to the body if: ==
* The cart is empty or not empty
* There is at least a product with a price greater than zero (payment methood needed)
* The shipping methods are shown or not needed
* If the shipping address is needed or there are only digital products in the cart
* The prices are shown including or excluding taxes
* All products are sold individually
* There are specific products in the cart
* The quantity of specific products is a specific number
* The billing address of the customer has a specific country
* The customer has a specific role on the website
* The customer has already bought something
* The customer has bought a specific number of time

If for example in the cart there are only products that can be sold individually, you can take advantage of the CSS class added by this plugin to hide the column "Qty" .
In this case you will write the CSS


`
.ccfw-cart-all-sold-individually-true .shop_table .product-quantity {
    display: none;
}
`

== How customize the WooCommerce cart and checkout via CSS ==
* The plugin doesn't provide any option, and you will not see any settings page. Just activate it.
* Right-click and click on Inspect on the frontend.
* Read the value of the class attribute of the body element.
* Use the CSS classes added to the body for your custom CSS

== Requirements ==
You can take advantage of this plugin only if you have at least basic skills with CSS and are able to add your custom CSS.
In other cases, you will not know what to do with this plugin.

== Changelog ==

= 0.0.3 =
* Checked: WordPress v. 6.4

= 0.0.2 =
* Added: CSS class for each row depending on the product ID, slug, and category

= 0.0.1 =
* Initial release.



