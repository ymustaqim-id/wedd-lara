<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tundangan extends Model {

    public $guarded = ["id","created_at","updated_at"];
    protected $table="tundangan";
    public $timestamps=true;
    protected $primaryKey = "id";
    public $incrementing = true;
    public static function findRequested()
    {
        $query = Tundangan::query();

        // search results based on user input
        \Request::input('id') and $query->where('id',\Request::input('id'));
        \Request::input('template') and $query->where('template','like','%'.\Request::input('template').'%');
        \Request::input('created_at') and $query->where('created_at',\Request::input('created_at'));
        \Request::input('updated_at') and $query->where('updated_at',\Request::input('updated_at'));

        // sort results
        \Request::input("sort") and $query->orderBy(\Request::input("sort"),\Request::input("sortType","desc"));

        // paginate results
        return $query->paginate(15);
    }

    public static function validationRules( $attributes = null )
    {
        $rules = [
            'template' => 'string|max:1000',
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

    public function roleUser(){
        return $this->hasOne('App\Models\RoleUser','user_id');
    }

    public function pk(){
      return $this->{$this->primaryKey};
    }

    }
