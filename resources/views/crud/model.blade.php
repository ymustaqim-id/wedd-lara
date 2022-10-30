<?php
/* @var $gen \App\Generator\src\Commands\Crud */
/* @var $fields [] */
?>
<?='<?php'?>

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\RecordSignature;
{{ in_array('deleted_at',$fieldsArr)?'use Illuminate\Database\Eloquent\SoftDeletes;':'' }}
class <?=$gen->modelClassName()?> extends Model {
    use RecordSignature;
    {{ in_array('deleted_at',$fieldsArr)?'use SoftDeletes;':'' }}
    public $guarded = ["id","created_at","updated_at"];
    protected $table="{{$gen->tableName}}";
    public $timestamps={{ in_array('created_at',$fieldsArr) && in_array('updated_at',$fieldsArr)?'true':'false' }};
    protected $primaryKey = "{{ $table->pk() }}";
    public $incrementing = true;
    public static function findRequested()
    {
        $query = <?=$gen->modelClassName()?>::query();

        // search results based on user input
        @foreach ( $fields as $field )
\Request::input('{{$field->name}}') and $query->where({!! \App\Console\Commands\Generator\Db::getConditionStr($field) !!});
        @endforeach

        // sort results
        \Request::input("sort") and $query->orderBy(\Request::input("sort"),\Request::input("sortType","asc"));

        // paginate results
        return $query->paginate(15);
    }

    public static function validationRules( $attributes = null )
    {
        $rules = [
@foreach ( $fields as $field )
@if( $rule = \App\Console\Commands\Generator\Db::getValidationRule( $field ) )
            {!! $rule !!}
@endif
@endforeach
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

    <?php
    foreach ( $fields as $field )  {
      if(($field->type == 'int')&&(preg_match("/id_|_id/",$field->name,$match))){
          $fieldName = preg_replace("/id_|_id/","",$field->name);
    ?>

    public function {{$fieldName}}()
    {
        return $this->belongsTo('App\Models\{{ucwords($fieldName)}}','{{$field->name}}');
    }

    public function set{{ucwords($fieldName)}}Attribute(${{$fieldName}}) {
      unset($this->attributes['{{$fieldName}}']);
    }

    
    <?php
      }
    }
    ?>
}
