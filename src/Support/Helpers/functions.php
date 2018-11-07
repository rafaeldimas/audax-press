<?php

if (!function_exists('get_posttype_name')) {
    function get_posttype_name($posttype) {
        $obj = get_post_type_object($posttype);

        if (!is_object($obj)) {
            return false;
        }

        return $obj->labels->singular_name;
    }
}

if (!function_exists('get_template_part_with_var')) {
    function get_template_part_with_var($slug, $name = null, array $var = array()) {
        do_action("get_template_part_{$slug}", $slug, $name);

        $templates = array();
        $name = (string) $name;
        if ('' !== $name) {
            $templates[] = "{$slug}-{$name}.php";
        }

        $templates[] = "{$slug}.php";

        extract($var);

        require locate_template($templates);
    }
}

if (!function_exists('get_script_uri')) {
    function get_script_uri() {
        $name = 'scripts.min.js';

        if (WP_DEBUG) {
            $name = 'scripts.js';
        }

        return get_stylesheet_directory_uri() . '/assets/js/' . $name;
    }
}

if (!function_exists('make_parans_order_by_custom_field')) {
    function make_parans_order_by_custom_field($customField, $order = 'ASC', $isNumber = true) {
        return array(
            'meta_key' => $customField,
            'orderby' => $isNumber ? 'meta_value_num' : 'meta_value',
            'order' => $order,
        );
    }
}

if (!function_exists('get_units')) {
    function get_units($limit = -1, $args = array()) {
        $defaults = array(
            'post_type' => 'unit',
            'posts_per_page' => $limit,
        );

        $settings = array_merge($defaults, $args);

        return new WP_Query($settings);
    }
}

if (!function_exists('get_catalog_by_term')) {
    function get_catalog_by_term($term, $limit = -1, $args = array()) {
        $defaults = array(
            'post_type' => 'catalog',
            'posts_per_page' => $limit,
            'tax_query' => array(
                array(
                    'taxonomy' => $term->taxonomy,
                    'field' => 'term_id',
                    'terms' => $term->term_id,
                )
            )
        );

        $settings = array_merge($defaults, $args);

        return new WP_Query($settings);
    }
}

if (!function_exists('get_catalog_provider')) {
    function get_catalog_provider() {
        $catalog_provider = array();
        $terms = get_terms(array(
            'hide_empty' => false,
            'taxonomy' => 'catalog_provider',
            'parent' => false,
        ));

        if (!empty($terms) && !is_wp_error($terms)) {
            foreach ($terms as $term) {
                $catalog_provider[] = (object) array(
                    'id' => $term->term_id,
                    'name' => $term->name,
                    'order' => (int) odin_get_term_meta($term->term_id, 'provider_order') ?: PHP_INT_MAX,
                    'logo_id' => odin_get_term_meta($term->term_id, 'provider_logo'),
                    'url' => odin_get_term_meta($term->term_id, 'provider_url'),
                    'view_on_catalog_page' => odin_get_term_meta($term->term_id, 'provider_view_on_catalog_page'),
                );
            }
        }

        usort($catalog_provider, function ($a, $b) {
            return $a->order - $b->order;
        });

        return !empty($catalog_provider) ? $catalog_provider : false;
    }
}

if (!function_exists('get_catalog_provider_golds')) {
    function get_catalog_provider_golds() {
        $catalog_provider = array();
        $terms = get_terms(array(
            'hide_empty' => false,
            'taxonomy' => 'catalog_provider',
            'parent' => false,
        ));

        if (!empty($terms) && !is_wp_error($terms)) {
            foreach ($terms as $term) {
                if (odin_get_term_meta($term->term_id, 'provider_is_gold') === 'yes') {
                    $catalog_provider[] = (object) array(
                        'id' => $term->term_id,
                        'name' => $term->name,
                        'order' => (int) odin_get_term_meta($term->term_id, 'provider_order') ?: PHP_INT_MAX,
                        'logo_id' => odin_get_term_meta($term->term_id, 'provider_logo'),
                        'url' => odin_get_term_meta($term->term_id, 'provider_url'),
                    );
                }
            }
        }

        usort($catalog_provider, function ($a, $b) {
            return $a->order - $b->order;
        });

        return !empty($catalog_provider) ? $catalog_provider : false;
    }
}

if (!function_exists('get_sliders')) {
    function get_sliders($slugCategory, $limit = -1, $args = array()) {
        $defaults = array(
            'tax_query' => array(
                array(
                    'taxonomy' => 'slider_category',
                    'field'    => 'slug',
                    'terms'    => $slugCategory,
                ),
            ),
            'post_type' => 'slider',
            'posts_per_page' => $limit,
        );

        $defaults = array_merge($defaults, make_parans_order_by_custom_field('slider_order'));

        $settings = array_merge($defaults, $args);

        return new WP_Query($settings);
    }
}

if (!function_exists('get_product_lines')) {
    function get_product_lines() {
        $productLine = array();
        $terms = get_terms(array(
            'hide_empty' => false,
            'taxonomy' => 'productline',
            'parent' => false,
        ));

        if (!empty($terms) && !is_wp_error($terms)) {
            foreach($terms as $term) {
                $productLine[] = (object) array(
                    'id' => $term->term_id,
                    'name' => $term->name,
                    'image_id' => odin_get_term_meta($term->term_id, 'product_line_images'),
                );
            }
        }

        return !empty($productLine) ? $productLine : false;
    }
}

if (!function_exists('get_children_product_lines')) {
    function get_children_product_lines($parentProductLine) {
        $posttype = 'productline';
        $productLine = array();
        $childrenProductLines = get_term_children($parentProductLine->term_id, $posttype);

        if (!empty($childrenProductLines) && !is_wp_error($childrenProductLines)) {
            $prefix = 'product_line';
            foreach ($childrenProductLines as $childrenProductLine) {
                $termObj = get_term_by('id', $childrenProductLine, $posttype);
                $productLine[] = (object) array_merge_recursive((array) $termObj, array(
                    'custom_description' => odin_get_term_meta($termObj->term_id, $prefix.'_custom_description'),
                    'image_id' => odin_get_term_meta($termObj->term_id, $prefix.'_images'),
                ));
            }
        }

        return !empty($productLine) ? $productLine : false;
    }
}

if (!function_exists('get_latest_posts_events')) {
    function get_latest_posts_events($limit = -1, $args = array()) {
        $defaults = array(
            'post_type' => array('post', 'event'),
            'posts_per_page' => $limit,
        );

        $settings = array_merge($defaults, $args);

        return new WP_Query($settings);
    }
}

if (!function_exists('get_catalog')) {
    function get_catalog($limit = -1, array $args = array()) {
        $defaults = array(
            'post_type' => 'catalog',
            'posts_per_page' => $limit,
        );

        $settings = array_merge($defaults, $args);

        return new WP_Query($settings);
    }
}

if (!function_exists('format_address_unit')) {
    function format_address_unit($unit) {
        $prefix = $unit->post_type . '_address_';

        $cep        = get_post_meta($unit->ID, $prefix . 'cep', true);
        $city       = get_post_meta($unit->ID, $prefix . 'city', true);
        $state      = get_post_meta($unit->ID, $prefix . 'state', true);
        $street     = get_post_meta($unit->ID, $prefix . 'street', true);
        $number     = get_post_meta($unit->ID, $prefix . 'number', true);
        $district   = get_post_meta($unit->ID, $prefix . 'district', true);

        return compact('cep', 'city', 'state', 'street', 'number', 'district');
    }
}
if (!function_exists('format_string_address_unit')) {
    function format_string_address_unit($unit) {
        if (!function_exists('format_address_unit')) {
            return false;
        }

        list($cep, $city, $state, $street, $number, $district) = array_values(format_address_unit($unit));

        $address = '';

        if ($street) {
            $address .= $street;
        }

        if ($number) {
            $address .= ', ' . $number . "\n";
        }

        if ($district) {
            $address .= $district . ' - ';
        }

        if ($city && $state) {
            $address .= $city . ' - ' . $state;
        }

        if (!($city && $state) && $city) {
            $address .= $city;
        }

        if (!($city && $state) && $state) {
            $address .= $state;
        }

        if ($cep) {
            $address .= "\n" . $cep;
        }

        return $address;
    }
}

if (!function_exists('format_html_address_unit')) {
    function format_html_address_unit($unit) {
        if (!function_exists('format_string_address_unit')) {
            return false;
        }

        $address = format_string_address_unit($unit);

        $html = implode('<br>', explode("\n", $address));

        return $html;
    }
}

function alter_labels_posttype_posts($name) {
    $get_post_type = get_post_type_object('post');
    $labels = $get_post_type->labels;
    $labels->name = sprintf(__('%ss', 'odin'), $name);
    $labels->singular_name = sprintf(__('%s', 'odin'), $name);
    $labels->add_new = __('Add New', 'odin');
    $labels->add_new_item = sprintf(__('Add New %s', 'odin'), $name);
    $labels->edit_item = sprintf(__('Edit %s', 'odin'), $name);
    $labels->update_item = sprintf(__('Update %s', 'odin'), $name);
    $labels->new_item = sprintf(__('New %s', 'odin'), $name);
    $labels->view_item = sprintf(__('View %s', 'odin'), $name);
    $labels->search_items = sprintf(__('Search %s', 'odin'), $name);
    $labels->not_found = sprintf(__('No %s found', 'odin'), $name);
    $labels->not_found_in_trash = sprintf(__('No %s found in Trash', 'odin'), $name);
    $labels->all_items = sprintf(__('All %ss', 'odin'), $name);
    $labels->menu_name = sprintf(__('%ss', 'odin'), $name);
    $labels->name_admin_bar = sprintf(__('%ss', 'odin'), $name);
    $labels->parent_item_colon = sprintf(__('Parent %s:', 'odin'), $name);
}
