<?php namespace Hushulin\Kaide\Controllers;

use BackendMenu;
use Backend\Classes\Controller;

/**
 * Xiaofei Back-end Controller
 */
class Xiaofei extends Controller
{
    public $implement = [
        'Backend.Behaviors.FormController',
        'Backend.Behaviors.ListController'
    ];

    public $formConfig = 'config_form.yaml';
    public $listConfig = 'config_list.yaml';

    public function __construct()
    {
        parent::__construct();

        BackendMenu::setContext('Hushulin.Kaide', 'kaide', 'xiaofei');
    }
}