<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Acara extends Model {

    public $guarded = ["id","created_at","updated_at"];
    protected $table="acara";
    public $timestamps=true;
    protected $primaryKey = "id";
    public $incrementing = true;
    public static function findRequested()
    {
        $query = Mempelai::query();

        // search results based on user input
        \Request::input('id') and $query->where('id',\Request::input('id'));
        \Request::input('waktu') and $query->where('waktu','like','%'.\Request::input('waktu').'%');
        \Request::input('tempat') and $query->where('tempat','like','%'.\Request::input('tempat').'%');
        \Request::input('maps') and $query->where('maps','like','%'.\Request::input('maps').'%');
        \Request::input('jenis_acara') and $query->where('jenis_acara','like','%'.\Request::input('jenis_acara').'%');
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
            'waktu' => 'string|max:191',
            'tempat' => 'string|max:191',
            'maps' => 'string|max:500',
            'jenis_acara' => 'string|max:1',
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
