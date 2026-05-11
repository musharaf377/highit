<?php

trait HighitFunctions
{
    public function get_attr_color_code($color_slug, $attr_slug = 'colour')
    {
        // Get term by slug (the color attribute value)
        $term = get_term_by('slug', $color_slug, 'pa_' . $attr_slug);

        if (!$term || is_wp_error($term)) {
            return false;
        }

        // Get the color code meta value
        $color_code = get_term_meta($term->term_id, 'cfvsw_color', true);

        return !empty($color_code) ? $color_code : false;
    }

    public function get_instock_product_count($category_id = 0)
    {
        $args = array(
            'post_type'      => 'product',
            'post_status'    => 'publish',
            'meta_query'     => array(
                array(
                    'key'     => '_stock_status',
                    'value'   => 'instock',
                    'compare' => '='
                )
            ),
            'fields'         => 'ids', // Only fetch IDs for better performance
        );

        if ($category_id) {
            $args['tax_query'] = array(
                array(
                    'taxonomy' => 'product_cat',
                    'field'    => 'term_id',
                    'terms'    => $category_id,
                ),
            );
        }

        $query = new WP_Query($args);

        return $query->found_posts;
    }

    public function get_outofstock_product_count($category_id = 0)
    {
        $args = array(
            'post_type'      => 'product',
            'post_status'    => 'publish',
            'meta_query'     => array(
                array(
                    'key'     => '_stock_status',
                    'value'   => 'outofstock',
                    'compare' => '='
                )
            ),
            'fields'         => 'ids', // Only fetch product IDs for performance
        );

        if ($category_id) {
            $args['tax_query'] = array(
                array(
                    'taxonomy' => 'product_cat',
                    'field'    => 'term_id',
                    'terms'    => $category_id,
                ),
            );
        }

        $query = new WP_Query($args);

        return $query->found_posts;
    }

    public function get_new_products_count($category_id = 0)
    {
        // Set up arguments for query
        $args = array(
            'post_type'      => 'product',
            'post_status'    => 'publish',
            'date_query'     => array(
                array(
                    'after' => '30 days ago',
                    'column' => 'post_date'
                ),
            ),
            'fields'         => 'ids',
            'posts_per_page' => -1,
        );

        if ($category_id) {
            $args['tax_query'] = array(
                array(
                    'taxonomy' => 'product_cat',
                    'field'    => 'term_id',
                    'terms'    => $category_id,
                ),
            );
        }

        // Get products
        $query = new WP_Query($args);

        // Return count
        return $query->post_count;
    }

    public function get_offer_products_count($category_id = 0)
    {
        // Set up arguments for query
        $args = array(
            'post_type'      => 'product',
            'post_status'    => 'publish',
            'posts_per_page' => -1,
            'fields'         => 'ids',
            'meta_query'     => array(
                'relation' => 'OR',
                // Simple products on sale
                array(
                    'key'     => '_sale_price',
                    'value'   => '',
                    'compare' => '!=',
                ),
                // Variable products with variations on sale
                array(
                    'key'     => '_min_variation_sale_price',
                    'value'   => '',
                    'compare' => '!=',
                ),
            ),
        );

        if ($category_id) {
            $args['tax_query'] = array(
                array(
                    'taxonomy' => 'product_cat',
                    'field'    => 'term_id',
                    'terms'    => $category_id,
                ),
            );
        }

        // Get products
        $query = new WP_Query($args);

        // Return count
        return $query->post_count;
    }

    public function get_popular_products_count($category_id = 0)
    {
        // Set up arguments for query
        $args = array(
            'post_type'      => 'product',
            'post_status'    => 'publish',
            'posts_per_page' => -1,
            'fields'         => 'ids',
            'meta_key'       => 'total_sales',
            'orderby'        => 'meta_value_num',
            'order'          => 'DESC',
            'meta_query'     => array(
                array(
                    'key'     => 'total_sales',
                    'value'   => '0',
                    'compare' => '>',
                )
            )
        );

        if ($category_id) {
            $args['tax_query'] = array(
                array(
                    'taxonomy' => 'product_cat',
                    'field'    => 'term_id',
                    'terms'    => $category_id,
                ),
            );
        }

        // Get products
        $query = new WP_Query($args);

        // Return count
        return $query->post_count;
    }

    /**
     * Get WooCommerce category data from a URL
     */
    function get_woo_category_from_url($url = '')
    {
        $current_url = empty($url) ? $this->get_current_url() : $url;

        $slug = $this->get_category_slug_from_url($current_url);

        if (!$slug) {
            return false;
        }

        // Get the category data
        $category = get_term_by('slug', $slug, 'product_cat');

        if (!$category) {
            return false;
        }

        // Build a structured response
        return array(
            'id' => $category->term_id,
            'slug' => $category->slug,
            'name' => $category->name,
            'description' => $category->description,
            'count' => $category->count,
            'parent' => $category->parent,
            'url' => get_term_link($category->term_id, 'product_cat'),
            'image_id' => get_term_meta($category->term_id, 'thumbnail_id', true),
            'image_url' => wp_get_attachment_url(get_term_meta($category->term_id, 'thumbnail_id', true))
        );
    }

    /**
     * Extract category slug from URL
     */
    function get_category_slug_from_url($url)
    {
        // Make sure we have a URL to work with
        if (empty($url)) {
            return false;
        }

        // Parse the URL to get its components
        $url_parts = parse_url($url);

        if (empty($url_parts['path'])) {
            return false;
        }

        $path = trim($url_parts['path'], '/');
        $path_parts = explode('/', $path);

        $slug = $path_parts[count($path_parts) - 1];

        return $slug;
    }

    function get_current_url()
    {
        $current_url = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";

        return $current_url;
    }

    public function get_highest_product_price()
    {
        global $wpdb;

        // Query for the highest regular price among simple products
        $highest_regular_price = $wpdb->get_var("
            SELECT MAX(CAST(meta_value AS DECIMAL(10,2)))
            FROM {$wpdb->postmeta} pm
            JOIN {$wpdb->posts} p ON p.ID = pm.post_id
            WHERE pm.meta_key = '_regular_price'
            AND p.post_type = 'product'
            AND p.post_status = 'publish'
        ");

        // Query for the highest regular price among variable products
        $highest_variation_price = $wpdb->get_var("
            SELECT MAX(CAST(meta_value AS DECIMAL(10,2)))
            FROM {$wpdb->postmeta} pm
            JOIN {$wpdb->posts} p ON p.ID = pm.post_id
            WHERE pm.meta_key = '_max_variation_regular_price'
            AND p.post_type = 'product'
            AND p.post_status = 'publish'
        ");

        // Return the higher of the two prices
        return max((float)$highest_regular_price, (float)$highest_variation_price);
    }
}
