<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Rsvp extends Model {

    public $guarded = ["id","created_at","updated_at"];
    protected $table="rsvp";
    public $timestamps=true;
    protected $primaryKey = "id";
    public $incrementing = true;
    public static function findRequested()
    {
        $query = Landing::query();

        // search results based on user input
        \Request::input('id') and $query->where('id',\Request::input('id'));
        \Request::input('nama') and $query->where('nama','like','%'.\Request::input('nama').'%');
        \Request::input('wish') and $query->where('wish','like','%'.\Request::input('wish').'%');
        \Request::input('kehadiran') and $query->where('kehadiran','like','%'.\Request::input('kehadiran').'%');
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
            'nama' => 'string|max:200',
            'wish' => 'string|max:500',
            'kehadiran' => 'string|max:500',
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
