<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Undangan extends Model {

    public $guarded = ["id","created_at","updated_at"];
    protected $table="undangan";
    public $timestamps=true;
    protected $primaryKey = "id";
    public $incrementing = true;
    public static function findRequested()
    {
        $query = Undangan::query();

        // search results based on user input
        \Request::input('id') and $query->where('id',\Request::input('id'));
        \Request::input('nama') and $query->where('nama','like','%'.\Request::input('nama').'%');
        \Request::input('wa') and $query->where('wa','like','%'.\Request::input('wa').'%');
        \Request::input('url') and $query->where('url','like','%'.\Request::input('url').'%');
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
            'nama' => 'string|max:191',
            'wa' => 'string|max:191',
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
