<?php

namespace Radial\Service;

use Radial\Support\Core\ServiceProvider;

class ApplicationServiceProvider extends ServiceProvider
{

    public function boot()
    {
        $this->registerHelperFunction(get_template_directory() . '/app/Support/Helpers/functions.php');
        $this->filters();
        $this->actions();
        $this->script();
        $this->locale();
    }

    public function filters()
    {
        $this->registerFilter('sanitize_file_name', function ($filename) {
            return preg_replace('/[^\w,\s-\.]/', '-', iconv('UTF-8', 'ASCII//TRANSLIT', $filename));
        }, 10);
    }

    protected function actions()
    {
        $this->registerAction('init', function () {
            alter_labels_posttype_posts('Notícia');
        });
    }

    protected function script()
    {
        $this->alterStylesheetDefault();

        $this->registerAction('wp_enqueue_scripts', function () {
            $cssUri = get_stylesheet_uri();
            $jsUri = \get_script_uri();

            wp_enqueue_style('google-font-muli', 'https://fonts.googleapis.com/css?family=Muli:600,900', array(), null);
            wp_enqueue_style('radial-css', $cssUri, array('google-font-muli'));

            wp_enqueue_script('jquery', '', array(), '', true);
            wp_enqueue_script('radial-modernizr', 'https://cdnjs.cloudflare.com/ajax/libs/modernizr/2.8.3/modernizr.min.js', array('jquery'), null, true);
            wp_enqueue_script('radial-fontawesome', 'https://use.fontawesome.com/releases/v5.0.9/js/all.js', array(), null, true);
            wp_enqueue_script('radial-mibew', '/mibew/js/compiled/chat_popup.js', array(), null, true);
            wp_enqueue_script('radial-js', $jsUri, array('jquery', 'radial-modernizr', 'radial-fontawesome', 'radial-mibew'), '', true);
        });
    }

    protected function alterStylesheetDefault()
    {
        $this->registerFilter('stylesheet_uri', function () {
            $name = 'style.min.css';

            if (WP_DEBUG) {
                $name = 'style.css';
            }

            return get_stylesheet_directory_uri() . '/assets/css/' . $name;
        }, 10);
    }

    protected function locale()
    {
        setlocale(LC_ALL, 'pt_BR', 'pt_BR.utf-8', 'pt_BR.utf-8', 'portuguese');
    }
}
