<?php namespace Hushulin\Kaide\Controllers;

use BackendMenu;
use Backend\Classes\Controller;

/**
 * Order Back-end Controller
 */
class Order extends Controller
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

        BackendMenu::setContext('Hushulin.Kaide', 'kaide', 'order');

        // $mydpik = new \Backend\FormWidgets\DatePicker($this , (object)array('fieldName' => 'created_at' , 'valueFrom' => date('Y-m-d H:i:s')));

        // $mydpik->alias = 'mydpik';

        // $mydpik->bindToController();

        $this->addCss('/plugins/hushulin/kaide/vendor/pikaday/css/pikaday.css', 'core');
        $this->addCss('/plugins/hushulin/kaide/vendor/clockpicker/css/jquery-clockpicker.css', 'core');
        $this->addCss('/plugins/hushulin/kaide/css/datepicker.css', 'core');
        $this->addJs('/plugins/hushulin/kaide/js/build-min.js', 'core');

    }
}