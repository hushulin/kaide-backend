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
            'icon'        => 'icon-leaf'
        ];
    }

    public function registerNavigation()
    {
        return [
            'kaide' => [
                'label'       => 'Kaide后台',
                'url'         => Backend::url('hushulin/kaide/mycontroller'),
                'icon'        => 'icon-leaf',
                'permissions' => ['hushulin.kaide.*'],
                'order'       => 500,
            ],
        ];
    }
}
