<?php namespace Hushulin\Kaide\Controllers;

use BackendMenu;
use Backend\Classes\Controller;
use Flash;
use Redirect;

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

        $this->addJs('/plugins/hushulin/kaide/My97DatePicker/WdatePicker.js');
    }


    public function onSearch()
    {
        $start = post('start');
        $end = post('end');

        if (empty($start) || empty($end)) {
            Flash::error('参数错误！');
            return $this->listRefresh();
        }

        return Redirect::to('/backend/hushulin/kaide/xiaofei?start='.$start.'&end='.$end);
    }

    public function listExtendQuery($query)
    {
        $start = get('start');
        $end = get('end');

        if ($start != '' && $end != '') {
            $query->where('created_at' , '>=' , $start)->where('created_at' , '<=' , $end);
        }

    }
}