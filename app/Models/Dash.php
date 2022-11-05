<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Dash extends Model {

    public $guarded = ["id","created_at","updated_at"];
    protected $table="table_home";
    public $timestamps=true;
    protected $primaryKey = "id";
    public $incrementing = true;
    public static function findRequested()
    {
        $query = Landing::query();

        // search results based on user input
        \Request::input('id') and $query->where('id',\Request::input('id'));
        \Request::input('nama_mempelai') and $query->where('nama_mempelai','like','%'.\Request::input('nama_mempelai').'%');
        \Request::input('keterangan') and $query->where('keterangan','like','%'.\Request::input('keterangan').'%');
        \Request::input('url_foto') and $query->where('url_foto','like','%'.\Request::input('url_foto').'%');
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
            'nama_mempelai' => 'string|max:191',
            'keterangan' => 'string|max:500',
            'url_foto' => 'string|max:500',
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
