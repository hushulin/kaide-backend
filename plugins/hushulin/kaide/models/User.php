<?php namespace Hushulin\Kaide\Models;

use Model;

/**
 * User Model
 */
class User extends Model
{

    /**
     * @var string The database table used by the model.
     */
    public $table = 'users';

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
    public $belongsTo = [];
    public $belongsToMany = [];
    public $morphTo = [];
    public $morphOne = [];
    public $morphMany = [];
    public $attachOne = [];
    public $attachMany = [];

}