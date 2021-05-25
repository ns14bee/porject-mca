<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Menu extends Model{
    protected $table = 'menu';	
    protected $primaryKey = 'id';
    public $timestamps = false;
    
    public static function getAllMenus(){
        return Menu::select('id','name')->get();
    }
}
