<?php

namespace GrupoAudax\AudaxPress\Service;

use GrupoAudax\AudaxPress\Contract\Entity\AdminMenu as AdminMenuContract;
use GrupoAudax\AudaxPress\Contract\Entity\FrontMenu as FrontMenuContract;
use GrupoAudax\AudaxPress\Contract\Entity\Metabox as MetaboxContract;
use GrupoAudax\AudaxPress\Contract\Entity\PostType as PostTypeContract;
use GrupoAudax\AudaxPress\Contract\Entity\Shortcode as ShortcodeContract;
use GrupoAudax\AudaxPress\Contract\Entity\Taxonomy as TaxonomyContract;
use GrupoAudax\AudaxPress\Entity\AdminMenu;
use GrupoAudax\AudaxPress\Entity\FrontMenu;
use GrupoAudax\AudaxPress\Entity\Metabox;
use GrupoAudax\AudaxPress\Entity\PostType;
use GrupoAudax\AudaxPress\Entity\Shortcode;
use GrupoAudax\AudaxPress\Entity\Taxonomy;
use GrupoAudax\AudaxPress\Support\ServiceProvider;

class EntityServiceProvider extends ServiceProvider
{
    public $bindings = [
        AdminMenu::class => AdminMenu::class,
        AdminMenuContract::class => AdminMenu::class,

        FrontMenu::class => FrontMenu::class,
        FrontMenuContract::class => FrontMenu::class,

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
