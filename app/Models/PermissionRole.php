<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
// use App\Traits\RecordSignature;

class PermissionRole extends Model {
    // use RecordSignature;
    
    public $guarded = ["id","created_at","updated_at"];
    protected $table="permission_role";
    public $timestamps=false;
    protected $primaryKey = "role_id";
    public $incrementing = true;
    public static function findRequested()
    {
        $query = PermissionRole::query();

        // search results based on user input
        \Request::input('permission_id') and $query->where('permission_id',\Request::input('permission_id'));
        \Request::input('role_id') and $query->where('role_id',\Request::input('role_id'));
        
        // sort results
        \Request::input("sort") and $query->orderBy(\Request::input("sort"),\Request::input("sortType","asc"));

        // paginate results
        return $query->paginate(15);
    }

    public static function validationRules( $attributes = null )
    {
        $rules = [
            'permission_id' => 'required|integer',
            'role_id' => 'required|integer',
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

    
    public function permission()
    {
        return $this->belongsTo('App\Models\Permission','permission_id');
    }

    public function setPermissionAttribute($permission) {
      unset($this->attributes['permission']);
    }


    
    public function role()
    {
        return $this->belongsTo('App\Models\Role','role_id');
    }

    public function setRoleAttribute($role) {
      unset($this->attributes['role']);
    }


    }
