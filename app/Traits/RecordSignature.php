<?php
  namespace App\Traits;

  trait RecordSignature
  {
    protected static function boot()
    {
        parent::boot();

        static::updating(function ($model) {
          if(isset(\Auth::User()->id)){
            $model->user_update = \Auth::User()->id;
          }
        });

        static::creating(function ($model) {
          if(isset(\Auth::User()->id)){
            $model->user_input = \Auth::User()->id;
          }
        });
        //etc

    }

  }
?>
