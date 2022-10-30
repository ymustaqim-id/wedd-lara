<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Menu extends Model {

    public $guarded = ["id","created_at","updated_at"];
    protected $table="menus";
    public $timestamps=true;
    protected $primaryKey = "id";
    public $incrementing = true;
    public static function findRequested()
    {
        $query = Menu::query();

        // search results based on user input
        \Request::input('id') and $query->where('id',\Request::input('id'));
        \Request::input('name') and $query->where('name','like','%'.\Request::input('name').'%');
        \Request::input('url') and $query->where('url','like','%'.\Request::input('url').'%');
        \Request::input('icon') and $query->where('icon','like','%'.\Request::input('icon').'%');
        \Request::input('ordinal') and $query->where('ordinal',\Request::input('ordinal'));
        \Request::input('parent_id') and $query->where('parent_id',\Request::input('parent_id'));
        \Request::input('permission_id') and $query->where('permission_id',\Request::input('permission_id'));
        \Request::input('created_at') and $query->where('created_at',\Request::input('created_at'));
        \Request::input('updated_at') and $query->where('updated_at',\Request::input('updated_at'));

        // sort results
        \Request::input("sort") and $query->orderBy(\Request::input("sort"),\Request::input("sortType","asc"));

        // paginate results
        return $query->paginate(15);
    }

    public static function validationRules( $attributes = null )
    {
        $rules = [
            'name' => 'required|string|max:191',
            'url' => 'string|max:191',
            'icon' => 'string|max:191',
            'ordinal' => 'integer',
            'parent_id' => 'integer',
            'permission_id' => 'integer',
        ];

        // no list is provided
        if(!$attributes)
            return $rules;

        // a single attribute is provided
        if(!is_array($attributes))
            return [ $attributes => $rules[$attributes] ];

        // a list of attributes is provided
        $newRules = [];
        foreach ( $attributes as $attr )
            $newRules[$attr] = $rules[$attr];
        return $newRules;
    }

    public function pk(){
      return $this->{$this->primaryKey};
    }


    public function parent()
    {
        return $this->belongsTo('App\Models\Menu','parent_id');
    }

    public function setParentAttribute($parent) {
      unset($this->attributes['parent']);
    }



    public function permission()
    {
        return $this->belongsTo('App\Models\Permission','permission_id');
    }

    public function setPermissionAttribute($permission) {
      unset($this->attributes['permission']);
    }


    }
