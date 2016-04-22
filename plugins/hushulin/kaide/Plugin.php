<?php namespace Hushulin\Kaide;

/**
 * The plugin.php file (called the plugin initialization script) defines the plugin information class.
 */

use System\Classes\PluginBase;
use Backend;

class Plugin extends PluginBase
{

    public function pluginDetails()
    {
        return [
            'name'        => 'Kaide后台',
            'description' => 'kaide后台系统，包括用户，水表，缴费，通知等模块',
            'author'      => 'Hushulin',
            'icon'        => 'icon-home'
        ];
    }

    /**
     * Registers any back-end permissions used by this plugin.
     *
     * @return array
     */
    public function registerPermissions()
    {

        return [
            'hushulin.kaide.backend' => [
                'tab' => 'Kaide',
                'label' => 'Kaide后台管理权限'
            ],
        ];
    }

    public function registerNavigation()
    {
        return [
            'kaide' => [
                'label'       => '后台管理系统',
                'url'         => Backend::url('hushulin/kaide/user'),
                'icon'        => 'icon-home',
                'permissions' => ['hushulin.kaide.*'],
                'order'       => 500,


                'sideMenu' => [
                    'user' => [
                        'label' => '用户',
                        'url' => Backend::url('hushulin/kaide/user'),
                        'icon' => 'icon-user',
                        'permissions' => ['hushulin.kaide.*'],
                        'order' => 304,
                    ],
                    'order' => [
                        'label' => '缴费列表',
                        'url' => Backend::url('hushulin/kaide/order'),
                        'icon' => 'icon-shopping-cart',
                        'permissions' => ['hushulin.kaide.*'],
                        'order' => 403,
                    ],
                    'xiaofei' => [
                        'label' => '使用水量',
                        'url' => Backend::url('hushulin/kaide/xiaofei'),
                        'icon' => 'icon-fire',
                        'permissions' => ['hushulin.kaide.*'],
                        'order' => 502,
                    ],
                    'notification' => [
                        'label' => '通知',
                        'url' => Backend::url('hushulin/kaide/notification'),
                        'icon' => 'icon-volume-up',
                        'permissions' => ['hushulin.kaide.*'],
                        'order' => 601,
                    ],
                    'meter' => [
                        'label' => '水表',
                        'url' => Backend::url('hushulin/kaide/meter'),
                        'icon' => 'icon-tint',
                        'permissions' => ['hushulin.kaide.*'],
                        'order' => 701,
                    ],
                ],
            ],
        ];
    }
}


// public function registerNavigation()
// {
//     return [
//         'blog' => [
//             'label'       => 'Blog',
//             'url'         => Backend::url('acme/blog/posts'),
//             'icon'        => 'icon-pencil',
//             'permissions' => ['acme.blog.*'],
//             'order'       => 500,

//             'sideMenu' => [
//                 'posts' => [
//                     'label'       => 'Posts',
//                     'icon'        => 'icon-copy',
//                     'url'         => Backend::url('acme/blog/posts'),
//                     'permissions' => ['acme.blog.access_posts']
//                 ],
//                 'categories' => [
//                     'label'       => 'Categories',
//                     'icon'        => 'icon-copy',
//                     'url'         => Backend::url('acme/blog/categories'),
//                     'permissions' => ['acme.blog.access_categories']
//                 ]
//             ]
//         ]
//     ];
// }
