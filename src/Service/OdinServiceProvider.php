<?php

namespace Radial\Service;

use Radial\Support\Core\ServiceProvider;

class OdinServiceProvider extends ServiceProvider
{
    protected $actionRemoved = array(
        'wp_head' => array(
            'feed_links_extra',
            'feed_links',
            'rsd_link',
            'wlwmanifest_link',
            'index_rel_link',
            'parent_post_rel_link',
            'start_post_rel_link',
            'adjacent_posts_rel_link_wp_head',
            'wp_generator',
            'print_emoji_detection_script'
        ),
        'admin_print_scripts' => 'print_emoji_detection_script',
        'wp_print_styles' => 'print_emoji_styles',
        'admin_print_styles' => 'print_emoji_styles',
        'the_content_feed' => 'wp_staticize_emoji',
        'comment_text_rss' => 'wp_staticize_emoji',
        'wp_mail' => 'wp_staticize_emoji_for_email',
    );

    public function boot()
    {
        $this->setup();
    }

    public function setup()
    {
        $basePath = get_template_directory() . '/app/Core/Odin';

        $this->registerTranslation('odin', $basePath . '/languages');

        $this->registerHelperFunction($basePath . '/helpers.php');

        $this->registerNavMenu('main-manu', __('Main FrontMenu', 'odin'));

        $this->themeSupport();
        $this->optimize();
    }

    protected function themeSupport()
    {
        $this->registerThemeSupport('post-thumbnails', array('page', 'post', 'event'));
        $this->registerThemeSupport('custom-header');
        $this->registerThemeSupport('custom-background');
        $this->registerThemeSupport('html5');
        $this->registerThemeSupport('title-tag');
        $this->registerThemeSupport('custom-logo');
    }

    public function optimize()
    {
        $this->unregisterActions($this->actionRemoved);

        $this->unregisterFilter( 'the_content_feed', 'wp_staticize_emoji' );
        $this->unregisterFilter( 'comment_text_rss', 'wp_staticize_emoji' );
        $this->unregisterFilter( 'wp_mail', 'wp_staticize_emoji_for_email' );

         // Remove WP version from RSS.
        $this->registerFilter( 'the_generator', '__return_false' );

        // Remove injected CSS from gallery.
        $this->registerFilter( 'use_default_gallery_style', '__return_false' );

        $this->registerFilter( 'wp_head', function () {
            // Remove injected CSS for recent comments widget.
            if ( has_filter( 'wp_head', 'wp_widget_recent_comments_style' ) ) {
                $this->unregisterFilter( 'wp_head', 'wp_widget_recent_comments_style' );
            }

            // Remove injected CSS from recent comments widget.
            global $wp_widget_factory;

            if ( isset( $wp_widget_factory->widgets['WP_Widget_Recent_Comments'] ) ) {
                $this->unregisterAction( 'wp_head', array( $wp_widget_factory->widgets['WP_Widget_Recent_Comments'], 'recent_comments_style' ) );
            }
        }, 1);

        $callbackModifyCategoryRel = function ( $text ) {
            $search = array( 'rel="category"', 'rel="category tag"' );
            $text = str_replace( $search, 'rel="nofollow"', $text );

            return $text;
        };

        $this->registerFilter( 'wp_list_categories', $callbackModifyCategoryRel );
        $this->registerFilter( 'the_category', $callbackModifyCategoryRel );

        $callbackModifyTagRel = function ( $taglink ) {
            return str_replace( 'rel="tag">', 'rel="nofollow">', $taglink );
        };

        $this->registerFilter( 'wp_tag_cloud', $callbackModifyTagRel  );
        $this->registerFilter( 'the_tags', $callbackModifyTagRel  );

        $this->registerFilter( 'tiny_mce_plugins', function ( $plugins ) {
            return is_array( $plugins ) ? array_diff( $plugins, array( 'wpemoji' ) ) : array();
        } );
    }
}
