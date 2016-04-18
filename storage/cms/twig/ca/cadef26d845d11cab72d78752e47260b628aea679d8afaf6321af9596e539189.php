<?php

/* /var/www/kaide-backend/themes/kaide/pages/index.htm */
class __TwigTemplate_3382590207803b7e02827db264ee403596405bb8156511626547166a9a33df93 extends Twig_Template
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
        echo "<!doctype html>
<html lang=\"en\">
<head>
<meta charset=\"UTF-8\">
<title>Document</title>
<link href=\"";
        // line 6
        echo $this->env->getExtension('CMS')->themeFilter(array(0 => "assets/less/theme-kaide.less"));
        // line 8
        echo "\" rel=\"stylesheet\">
</head>
<body>

<div>
<p>kaide meter system.version:1.0.0</p>
<p>kaide api : <a href=\"http://120.76.137.219/apidocs/api.html\">http://120.76.137.219/apidocs/api.html</a></p>
</div>
</body>
</html>";
    }

    public function getTemplateName()
    {
        return "/var/www/kaide-backend/themes/kaide/pages/index.htm";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  28 => 8,  26 => 6,  19 => 1,);
    }
}
/* <!doctype html>*/
/* <html lang="en">*/
/* <head>*/
/* <meta charset="UTF-8">*/
/* <title>Document</title>*/
/* <link href="{{ [*/
/*             'assets/less/theme-kaide.less'*/
/*         ]|theme }}" rel="stylesheet">*/
/* </head>*/
/* <body>*/
/* */
/* <div>*/
/* <p>kaide meter system.version:1.0.0</p>*/
/* <p>kaide api : <a href="http://120.76.137.219/apidocs/api.html">http://120.76.137.219/apidocs/api.html</a></p>*/
/* </div>*/
/* </body>*/
/* </html>*/
