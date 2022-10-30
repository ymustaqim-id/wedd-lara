<?php
/**
 * Created by naveedulhassan.
 * Date: 1/22/16
 * Time: 2:55 PM
 */

namespace App\Console\Commands\Generator;


class Db
{
    public static function fields($table)
    {
        $columns = \DB::select('show fields from '.$table);
        $tableFields = array(); // return value
        foreach ($columns as $column) {
            $column = (array)$column;
            $field = new \stdClass();
            $field->name = $column['Field'];
            $field->defValue = $column['Default'];
            $field->required = $column['Null'] == 'NO';
            $field->key = $column['Key'];
            // type and length
            $field->maxLength = 0;// get field and type from $res['Type']
            $type_length = explode( "(", $column['Type'] );
            $field->type = $type_length[0];
            if( count($type_length) > 1 ) { // some times there is no "("
                $field->maxLength = (int)$type_length[1];
                if( $field->type == 'enum' ) { // enum has some values  'Male','Female')
                    $matches = explode( "'", $type_length[1] );
                    foreach($matches as $match) {
                        if( $match && $match != "," && $match != ")" ){ $field->enumValues[] = $match; }
                    }
                }
            }
            // everything decided for the field, add it to the array
            $tableFields[$field->name] = $field;
        }
        return $tableFields;
    }

    public static function getConditionStr($field)
    {
        if( in_array( $field->type, ['varchar','text'] ) )
            return "'{$field->name}','like','%'.\Request::input('{$field->name}').'%'";
        return "'{$field->name}',\Request::input('{$field->name}')";
    }

    public static function getValidationRule($field)
    {
        // skip certain fields
        if ( in_array( $field->name, static::skippedFields() ) )
            return "";

        $rules = [];
        // required fields
        if( $field->required )
            $rules[] = "required";

        // strings
        if( in_array( $field->type, ['varchar','text'] ) )
        {
            $rules[] = "string";
            if ( $field->maxLength ) $rules[] = "max:".$field->maxLength;
        }

        // dates
        if( in_array( $field->type, ['date','datetime'] ) )
            $rules[] = "date";

        // numbers
        if ( in_array( $field->type, ['int','unsigned_int'] ) )
            $rules [] = "integer";

        // emails
        if( preg_match("/email/", $field->name) ){ $rules[] = "email"; }

        // enums
        if ( $field->type == 'enum' )
            $rules [] = "in:".join( ",", $field->enumValues );

        return "'".$field->name."' => '".join( "|", $rules )."',";
    }

    public static function skippedFields()
    {
        return ['id','created_at','updated_at'];
    }

    public static function isGuarded($fieldName)
    {
        return in_array( $fieldName, static::skippedFields() );
    }

    public static function getSearchInputStr ( $field )
    {
        // selects
        if ( $field->type == 'enum' )
        {
            $output = "{!!\Nvd\Crud\Html::selectRequested(\n";
            $output .= "\t\t\t\t\t'".$field->name."',\n";
            $output .= "\t\t\t\t\t[ '', '".join("', '",$field->enumValues)."' ],\n"; //Yes', 'No
            $output .= "\t\t\t\t\t['class'=>'form-control']\n";
            $output .= "\t\t\t\t)!!}";
            return $output;
        }

        // input type:
        $type = 'text';
        if ( $field->type == 'date' ) $type = $field->type;
        $output = '<input type="'.$type.'" class="form-control" name="'.$field->name.'" value="{{Request::input("'.$field->name.'")}}">';
        return $output;

    }

    public static function getFormInputMarkup ( $field, $modelName = '' )
    {
        // skip certain fields
        if ( in_array( $field->name, static::skippedFields() ) )
            return "";

        // string that binds the model
        $modelStr = $modelName ? '->model($'.$modelName.')' : '';

        //autocomplete
        if(($field->type == 'int')&&(preg_match("/id_|_id/",$field->name,$match))){
          $fieldName = strtolower(preg_replace("/id_|_id/","",$field->name));
          // $str="{{ Form::hidden('{$field->name}',$".$modelName."->exists?$".$modelName."->{$field->name}:null,array('id'=>'{$field->name}')) }}\n";
          $str="{!! App\Console\Commands\Generator\Form::input('{$field->name}','hidden')->model($".$modelName.")->showHidden() !!}\n";
          // $modelStr = $fieldName ? '->model($'.$modelName.'->'.$fieldName.'->name)' : '';
          $modelStr = $fieldName ? '->model(null)' : '';
          $value = "$".$modelName."->exists?(isset($".$modelName."->{$fieldName})?$".$modelName."->{$fieldName}->{$fieldName}:null):null";
          // $str.="{!! \App\Generator\src\Form::autocomplete('{$fieldName}',array('value'=>$value)){$modelStr}->show() !!}";
          $str.="{!! App\Console\Commands\Generator\Form::autocomplete('{$fieldName}',array('value'=>$value)){$modelStr}->show() !!}\n";
          return $str;
        }

        // selects

        if ( $field->type == 'enum' )
        {
            return "{!! App\Console\Commands\Generator\Form::select( '{$field->name}', [ '".join("', '",$field->defValue)."' ] ){$modelStr}->show() !!}\n";
            return "{!! \App\Generator\src\Form::select( '{$field->name}', [ '".join("', '",$field->enumValues)."' ] ){$modelStr}->show() !!}\n";
        }

        if ( $field->type == 'text' )
        {
            return "{!! App\Console\Commands\Generator\Form::textarea( '{$field->name}' ){$modelStr}->show() !!}\n";
        }

        // input type:
        $type = 'text';
        if ( $field->type == 'date' ) $type = $field->type;
        return "{!! App\Console\Commands\Generator\Form::input('{$field->name}','{$type}'){$modelStr}->show() !!}\n";
    }

}
