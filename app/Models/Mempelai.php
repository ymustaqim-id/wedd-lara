<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Mempelai extends Model {

    public $guarded = ["id","created_at","updated_at"];
    protected $table="mempelai";
    public $timestamps=true;
    protected $primaryKey = "id";
    public $incrementing = true;
    public static function findRequested()
    {
        $query = Mempelai::query();

        // search results based on user input
        \Request::input('id') and $query->where('id',\Request::input('id'));
        \Request::input('nama') and $query->where('nama','like','%'.\Request::input('nama').'%');
        \Request::input('biodata') and $query->where('biodata','like','%'.\Request::input('biodata').'%');
        \Request::input('facebook') and $query->where('facebook','like','%'.\Request::input('facebook').'%');
        \Request::input('twitter') and $query->where('twitter','like','%'.\Request::input('twitter').'%');
        \Request::input('instagram') and $query->where('instagram','like','%'.\Request::input('instagram').'%');
        \Request::input('foto') and $query->where('foto','like','%'.\Request::input('foto').'%');
        \Request::input('jenis_kelamin') and $query->where('jenis_kelamin','like','%'.\Request::input('jenis_kelamin').'%');
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
            'nama' => 'required|string|max:191',
            'biodata' => 'string|max:500',
            'facebook' => 'string|max:191',
            'twitter' => 'string|max:191',
            'instagram' => 'string|max:191',
            'foto' => 'string|max:191',
            'jenis_kelamin' => 'string|max:1',
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
