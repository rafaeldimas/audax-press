<?php

namespace Radial\Domain\PostType\Entity;

use Core\Odin\PostType;
use Radial\Support\Module\EntityAbstract;

class PostTypeAbstract extends EntityAbstract
{
    protected $posttype;

    public function register()
    {
        $this->posttype = new PostType($this->name, $this->slug);

        $this->setLabels()->setArgs();

        add_filter('post_type_link', [$this, 'rewriteUrlPostType'], 1, 2);
    }

    protected function setLabels()
    {
        $this->posttype->set_labels($this->labels);
        return $this;
    }

    protected function setArgs()
    {
        $this->posttype->set_arguments($this->args);
        return $this;
    }

    public function rewriteUrlPostType($post_link, $post)
    {
        return $post_link;
    }
}
