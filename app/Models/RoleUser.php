<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RoleUser extends Model {

    public $guarded = ["id","created_at","updated_at"];
    protected $table="role_user";
    public $timestamps=false;
    protected $primaryKey = "user_type";
    public $incrementing = true;
    public static function findRequested()
    {
        $query = RoleUser::query();

        // search results based on user input
        \Request::input('role_id') and $query->where('role_id',\Request::input('role_id'));
        \Request::input('user_id') and $query->where('user_id',\Request::input('user_id'));
        \Request::input('user_type') and $query->where('user_type','like','%'.\Request::input('user_type').'%');

        // sort results
        \Request::input("sort") and $query->orderBy(\Request::input("sort"),\Request::input("sortType","asc"));

        // paginate results
        return $query->paginate(15);
    }

    public static function validationRules( $attributes = null )
    {
        $rules = [
            'role_id' => 'required|integer',
            'user_id' => 'required|integer',
            'user_type' => 'required|string|max:191',
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


    public function role()
    {
        return $this->belongsTo('App\Models\Role','role_id');
    }

    public function setRoleAttribute($role) {
      unset($this->attributes['role']);
    }



    public function user()
    {
        return $this->belongsTo('App\Models\User','user_id');
    }

    public function setUserAttribute($user) {
      unset($this->attributes['user']);
    }


    }
