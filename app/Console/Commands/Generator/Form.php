<?php
/**
 * Created by naveedulhassan.
 * Date: 1/21/16
 * Time: 3:08 PM
 *
  * modified by jongklo
 */
namespace App\Console\Commands\Generator;
use Illuminate\Support\MessageBag;
use Log;

/**
 * Class Form
 * @package App\Generator\src
 *
 * @property $name;
 * @property $value;
 *
 * @method Form label($label = "")
 * @method Form model($value = "")
 * @method Form type($value = "")
 * @method Form helpBlock($value = false)
 * @method Form options($value = false)
 * @method Form useOptionKeysForValues($value = false)
 */
class Form
{
    protected $_name;
    protected $_value;
    protected $attributes = [];
    protected $label;
    protected $helpBlock = true; // show help block or not
    protected $model; // model to be bound
    protected $type; // element type: select, input, textarea
    protected $options; // only for select element
    protected $useOptionKeysForValues; // only for select element

    public static function input( $name, $type = 'text',$attributesOptions=[] )
    {
        if(!empty($attributesOptions['class'])){
            $attributesOptions['class'].=" form-control";
        }else{
            $attributesOptions['class']="form-control";
        }
        $elem = static::createElement($name,'input',$attributesOptions);
        $elem->attributes['type'] = $type;
        return $elem;
    }

    public static function autocomplete($name,$attributesOptions=[])
    {
        if(!empty($attributesOptions['class'])){
            $attributesOptions['class'].=" form-control";
        }else{
            $attributesOptions['class']="form-control";
        }
        $elem = static::createElement($name,'autocomplete',$attributesOptions);
        $elem->attributes['type'] = 'text';
        return $elem;
    }

    public static function select( $name, $options, $useOptionKeysForValues = false )
    {
        $elem = static::createElement($name,"select");
        $elem->options = $options;
        $elem->useOptionKeysForValues = $useOptionKeysForValues;
        return $elem;
    }

    public static function radio($name="inputName",$label="Label Name",$options=array(array('value'=>'A','label'=>'Apel')),$defaultValue=null){
        $templates = '
            <div class="form-group row">
                    <label class="col-md-3 col-form-label" for="'.$name.'"> '.$label.' </label>
                    <div class="col-md-7 row">';

        foreach($options as $option){
            $val = isset($option['value'])?$option['value']:$option;
            $lbl = isset($option['label'])?$option['label']:$option;
            $templates.='<div class="radio-custom radio-primary">';
            $idName = $name."-".preg_replace('/\W/','', strtolower($val));
            $templates.= \Form::radio($name,$val ,($defaultValue==$val),array('class'=>'md-radiobtn','id'=>$idName));
            $templates.= '<label for="'.$idName.'">'.$lbl.' </label>
                                    </div>&nbsp;&nbsp;';
        }

        $templates.='
                        </div>
                        </div>
        ';
        return $templates;
    }

    public static function checkbox($name="inputName",$label="Label Name",$option=array('value'=>'Y','label'=>'Aktif'),$defaultValue=null){
      $checked=($defaultValue==$option['value']?"checked":"");
      $templates = '
            <div class="form-group row">
            <label class="col-md-3 col-form-label" for="'.$name.'"> '.$label.' </label>
                    <div class="col-md-7">
            <div class="checkbox-custom checkbox-default">
                    <input type="checkbox" name="'.$name.'" value="'.$option['value'].'" '.$checked.'>
                    <label for="inputBasicRemember">'.$option['label'].'</label>
            </div>
            </div>
        </div>';
      return $templates;
    }

    public static function textarea($name)
    {
        return static::createElement($name,"textarea");
    }

    public function attributes($value = null)
    {
        if($value and !is_array($value))
            throw new \Exception("Attributes should be an array.");

        if($value)
        {
            $this->attributes = array_merge($this->attributes, $value);
            return $this;
        }

        return $this->attributes;
    }

    public function show($options=[])
    {
        $this->setValue();

        $errors = \Session::get('errors', new MessageBag());
        // $hasError = ($errors and $errors->has($this->name)) ? " has-error" : "";

        $output = '<div class="form-group row">';
        $output .= $this->label? "<label for='{$this->name}' class='col-form-label ".array_get($options,'class-label','col-md-3')."'>".array_get($options,'label',$this->label) : "";
        $output .= $this->label? "</label>" : "";
        $output .= "<div class='".array_get($options,'class-input','col-md-7')."'>";
        $output .= call_user_func([$this, "show".ucfirst($this->type)]);
        // Log::info(call_user_func([$this, "show".ucfirst($this->type)]));
        if ( $this->helpBlock and $errors and $errors->has($this->name) )
        {
            $output .= '<span class="help-block text-danger">';
            $output .= $errors->first($this->name);
            $output .= '</span>';
        }

        $output .= "</div>";
        $output .= "</div>";
        return $output;
    }

    public function showInput()
    {
        $output = Html::startTag("input", $this->attributes, true );
        return $output;
    }

    public function showAutocomplete()
    {
        $output = '<div class="input-search clearfix">';
        $output .= Html::startTag("input", $this->attributes, true );
        $output .= '<button type="submit" class="input-search-btn">
                      <i class="icon md-search" aria-hidden="true"></i>
                    </button>';
        $output .= '</div>';
        return $output;
    }
    public function showHidden()
    {
        $this->setValue();
        $output = '  <div class="form-group">';
        $output .= call_user_func([$this, "show".ucfirst($this->type)]);
        $output .= '</div>';
        return $output;
    }

    public function showSelect()
    {
        $this->setValue();
        return \Form::select( $this->name, $this->options, $this->value, $this->attributes);
    }

    protected function showRadio()
    {

    }

    protected function showTextarea()
    {
        $output = Html::startTag( "textarea", $this->attributes );
        $output .= $this->value;
        $output .= Html::endTag("textarea");
        return $output;
    }

    protected static function createElement( $name, $type,$attributesOptions=[] )
    {
        $elem = new self;
        $elem->type = $type;
        $elem->name = $name;
        $elem->attributes['id'] = $name;
        $elem->attributes['class'] = 'form-control';
        foreach ($attributesOptions as $key => $value) {
            $elem->attributes[$key]=$value;
        }
        $elem->label = ucwords( str_replace( "_"," ", $name ) );
        return $elem;
    }

    protected function setValue()
    {
        $this->value = old($this->name);

        if( empty($this->value) and $this->model ) {
            $this->value = $this->model->{$this->name};
        }

        return $this;
    }

    public function __call( $attr, $args = null )
    {
        if( !property_exists($this, $attr) )
            throw new \Exception("Method {$attr} does not exist.");

        if(count($args)){
            $this->$attr = $args[0];
            return $this;
        }

        return $this->$attr;
    }

    public function __set($property, $value)
    {
        if( in_array( $property, ['name','value'] ) )
        {
            $this->{"_".$property} = $value;
            if( $property != 'value' or $this->type == 'input' ) // textarea and select should not have a value attribute
            {
                $this->attributes[$property] = $value;
            }
        }
    }

    public function __get($property)
    {
        return $this->{"_".$property};
    }
    public static function label($options=[]){
        $output = '<div class="form-group">';
        $output .= $this->label? "<label for='{$this->name}' class=".array_get($options,'class-label','col-sm-4').">".array_get($options,'label',$this->label) : "";
        $output .= $this->label? "</label>" : "";
        $output .= "<div class='".array_get($options,'class-input','col-sm-8')."'>s.d</div>";
        $output .= "</div>";
        return $output;
    }
}
