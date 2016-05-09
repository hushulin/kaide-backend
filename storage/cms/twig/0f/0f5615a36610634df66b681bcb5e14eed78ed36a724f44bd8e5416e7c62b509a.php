<?php

/* /var/www/kaide-backend/themes/kaide/layouts/fallback */
class __TwigTemplate_695df928f2acd7dd7bfdd32d66c1d98d89a69aa977a7522ce094b3ddaefbab17 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = false;

        $this->blocks = array(
        );
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        // line 1
        echo $this->env->getExtension('CMS')->pageFunction();
    }

    public function getTemplateName()
    {
        return "/var/www/kaide-backend/themes/kaide/layouts/fallback";
    }

    public function getDebugInfo()
    {
        return array (  19 => 1,);
    }
}
/* {% page %}*/
