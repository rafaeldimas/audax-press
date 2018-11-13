<?php

namespace GrupoAudax\AudaxPress\Service;

use GrupoAudax\AudaxPress\Contract\Manage\Menu as MenuContract;
use GrupoAudax\AudaxPress\Contract\Manage\Metabox as MetaboxContract;
use GrupoAudax\AudaxPress\Contract\Manage\PostType as PostTypeContract;
use GrupoAudax\AudaxPress\Contract\Manage\Shortcode as ShortcodeContract;
use GrupoAudax\AudaxPress\Contract\Manage\Taxonomy as TaxonomyContract;
use GrupoAudax\AudaxPress\Manage\Menu;
use GrupoAudax\AudaxPress\Manage\Metabox;
use GrupoAudax\AudaxPress\Manage\PostType;
use GrupoAudax\AudaxPress\Manage\Shortcode;
use GrupoAudax\AudaxPress\Manage\Taxonomy;
use GrupoAudax\AudaxPress\Support\ServiceProvider;

class ManageServiceProvider extends ServiceProvider
{
    public $bindings = [
        Menu::class => Menu::class,
        MenuContract::class => Menu::class,

        Metabox::class => Metabox::class,
        MetaboxContract::class => Metabox::class,

        PostType::class => PostType::class,
        PostTypeContract::class => PostType::class,

        Shortcode::class => Shortcode::class,
        ShortcodeContract::class => Shortcode::class,

        Taxonomy::class => Taxonomy::class,
        TaxonomyContract::class => Taxonomy::class,
    ];

    /**
     * @return mixed
     */
    public function register()
    {
        // TODO: Implement register() method.
    }

    /**
     * @return mixed
     */
    public function boot()
    {
        // TODO: Implement boot() method.
    }
}
