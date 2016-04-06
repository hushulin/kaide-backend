<?php namespace Hushulin\Kaide\Models;

use Model;

/**
 * Xiaofei Model
 */
class Xiaofei extends Model
{

    /**
     * @var string The database table used by the model.
     */
    public $table = 'xiaofeis';

    /**
     * @var array Guarded fields
     */
    protected $guarded = ['id'];

    /**
     * @var array Fillable fields
     */
    // protected $fillable = [];

    /**
     * @var array Relations
     */
    public $hasOne = [];
    public $hasMany = [];

    public $belongsTo = [
        'meter' => ['Hushulin\Kaide\Models\Meter'],
    ];

    public $belongsToMany = [];
    public $morphTo = [];
    public $morphOne = [];
    public $morphMany = [];
    public $attachOne = [];
    public $attachMany = [];

}