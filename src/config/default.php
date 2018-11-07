<?php

use Audax\AudaxPress\Contract\Entity\AdminMenu as EntityAdminMenuContract;
use Audax\AudaxPress\Contract\Entity\FrontMenu as EntityFrontMenuContract;
use Audax\AudaxPress\Contract\Entity\Metabox as EntityMetaboxContract;
use Audax\AudaxPress\Contract\Entity\PostType as EntityPostTypeContract;
use Audax\AudaxPress\Contract\Entity\Shortcode as EntityShortcodeContract;
use Audax\AudaxPress\Contract\Entity\Taxonomy as EntityTaxonomyContract;
use Audax\AudaxPress\Contract\Manage\Menu as ManageMenuContract;
use Audax\AudaxPress\Contract\Manage\Metabox as ManageMetaboxContract;
use Audax\AudaxPress\Contract\Manage\PostType as ManagePostTypeContract;
use Audax\AudaxPress\Contract\Manage\Shortcode as ManageShortcodeContract;
use Audax\AudaxPress\Contract\Manage\Taxonomy as ManageTaxonomyContract;
use Audax\AudaxPress\Entity\AdminMenu as EntityAdminMenu;
use Audax\AudaxPress\Entity\FrontMenu as EntityFrontMenu;
use Audax\AudaxPress\Entity\Metabox as EntityMetabox;
use Audax\AudaxPress\Entity\PostType as EntityPostType;
use Audax\AudaxPress\Entity\Shortcode as EntityShortcode;
use Audax\AudaxPress\Entity\Taxonomy as EntityTaxonomy;
use Audax\AudaxPress\Manage\Menu as ManageMenu;
use Audax\AudaxPress\Manage\Metabox as ManageMetabox;
use Audax\AudaxPress\Manage\PostType as ManagePostType;
use Audax\AudaxPress\Manage\Shortcode as ManageShortcode;
use Audax\AudaxPress\Manage\Taxonomy as ManageTaxonomy;

return [
    EntityPostType::class => DI\autowire(),
    EntityPostTypeContract::class => DI\get(EntityPostType::class ),

    EntityTaxonomy::class => DI\autowire(),
    EntityTaxonomyContract::class => DI\get(EntityTaxonomy::class ),

    EntityMetabox::class => DI\autowire(),
    EntityMetaboxContract::class => DI\get(EntityMetabox::class ),

    EntityFrontMenu::class => DI\autowire(),
    EntityFrontMenuContract::class => DI\get(EntityFrontMenu::class ),

    EntityAdminMenu::class => DI\autowire(),
    EntityAdminMenuContract::class => DI\get(EntityAdminMenu::class ),

    EntityShortcode::class => DI\autowire(),
    EntityShortcodeContract::class => DI\get(EntityShortcode::class ),

    ManagePostType::class => DI\autowire(),
    ManagePostTypeContract::class=> DI\get(ManagePostType::class ),

    ManageTaxonomy::class => DI\autowire(),
    ManageTaxonomyContract::class => DI\get(ManageTaxonomy::class ),

    ManageMetabox::class => DI\autowire(),
    ManageMetaboxContract::class => DI\get(ManageMetabox::class ),

    ManageMenu::class => DI\autowire(),
    ManageMenuContract::class => DI\get(ManageMenu::class ),

    ManageShortcode::class => DI\autowire(),
    ManageShortcodeContract::class => DI\get(ManageShortcode::class ),
];
