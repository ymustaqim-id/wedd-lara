<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class User extends Model {

    public $guarded = ["id","created_at","updated_at"];
    protected $table="users";
    public $timestamps=true;
    protected $primaryKey = "id";
    public $incrementing = true;
    public static function findRequested()
    {
        $query = User::query();

        // search results based on user input
        \Request::input('id') and $query->where('id',\Request::input('id'));
        \Request::input('name') and $query->where('name','like','%'.\Request::input('name').'%');
        \Request::input('username') and $query->where('username','like','%'.\Request::input('username').'%');
        \Request::input('email') and $query->where('email','like','%'.\Request::input('email').'%');
        \Request::input('email_verified_at') and $query->where('email_verified_at',\Request::input('email_verified_at'));
        \Request::input('password') and $query->where('password','like','%'.\Request::input('password').'%');
        \Request::input('jenis_kelamin') and $query->where('jenis_kelamin','like','%'.\Request::input('jenis_kelamin').'%');
        \Request::input('remember_token') and $query->where('remember_token','like','%'.\Request::input('remember_token').'%');
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
            'username' => 'required|string|max:191',
            'email' => 'required|string|max:191|email',
            'email_verified_at' => 'email',
            'password' => 'required|string|max:191',
            'jenis_kelamin' => 'string|max:1',
            'remember_token' => 'string|max:100',
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
