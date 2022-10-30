<?php

namespace App\Console\Commands\Generator;

use Illuminate\Console\Command;
use App\Console\Commands\Generator\Db;
use App\Console\Commands\Generator\Table;

class crudGenerator extends Command
{
    public $tableName;
    public $table;
    public $export;
    public $fields;
    public $fieldsArr;
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'generate:crud {tableName}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate Simple CRUD';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle(){
        $this->tableName = $this->argument('tableName');
        $this->fields=Db::fields($this->tableName);
        $this->table=new Table();
        $this->table->fields=$this->fields;
        $this->table->name=$this->tableName;
        // dd($this->table);
        $this->fieldsArr=[];
        foreach ($this->fields as $key => $value) {
            $this->fieldsArr[]=$value->name;
        }
        // dd($fieldsArr);
        $this->authAttr = str_replace('_', '-', $this->tableName);
        $this->generateModel();
        $this->generateRoute();
        $this->generateController();
        $this->generateAutocomplete();

        $this->generateViews();
        // $this->generatePermissions();
    }

    public function generateModel()
    {
      // dd(Db::fields($this->tableName));
        // $modelFile = $this->modelsDir().'/'.$this->modelClassName().".php";
        $modelFile = $this->modelsDir().'/Models/'.$this->modelClassName().".php";
        // dd($modelFile);
        if($this->confirmOverwrite($modelFile))
        {
            $content = view('crud.model', [
              'gen' => $this,
              'fields' => $this->fields,
              'fieldsArr' => $this->fieldsArr,
              'table'=>$this->table
            ]);
            file_put_contents($modelFile, $content);
            $this->info( "Model class ".$this->modelClassName()." generated successfully." );
        }
    }

    public function generateRoute()
    {
        $route  = "Route::get('{$this->route()}/load-data','{$this->controllerClassName()}@loadData');\n";
        if($this->export){
            $route  .= "Route::post('{$this->route()}/export-data','{$this->controllerClassName()}@postExportData');\n";
        }
        $route .= "Route::resource('{$this->route()}','{$this->controllerClassName()}');\n";
        $route .= "Route::delete('{$this->route()}/{id}/restore','{$this->controllerClassName()}@restore');\n";
        $routesFile = base_path('routes/web.php');
        $routesFileContent = file_get_contents($routesFile);

        if ( strpos( $routesFileContent, $route ) == false )
        {
            $routesFileContent = $this->getUpdatedContent($routesFileContent, $route);
            file_put_contents($routesFile,$routesFileContent);
            $this->info("created route: ".$route);

            return true;
        }

        $this->info("Route: '".$route."' already exists.");
        $this->info("Skipping...");
        return false;
    }

    protected function getUpdatedContent ( $existingContent, $route )
    {
        // check if the user has directed to add routes
        $str = "nvd-crud routes go here";
        if( strpos( $existingContent, $str ) !== false )
            return str_replace( $str, "{$str}\n\t".$route, $existingContent );

        // check for 'web' middleware group
        $regex = "/(Route\s*\:\:\s*group\s*\(\s*\[\s*\'middleware\'\s*\=\>\s*\[\s*\'web\'\s*\]\s*\]\s*\,\s*function\s*\(\s*\)\s*\{)/";
        if( preg_match( $regex, $existingContent ) )
            return preg_replace( $regex, "$1\n\t".$route, $existingContent );

        // if there is no 'web' middleware group
        return $existingContent."\n".$route;
    }

    public function generateController()
    {
      $controllerFile = $this->controllersDir().'/'.$this->controllerClassName().".php";
        if($this->confirmOverwrite($controllerFile))
        {
            // dd($this->export);
            $content = view('crud.controller',
            [
                'gen' => $this,
                'fields' => $this->fields,
                'fieldsArr' => $this->fieldsArr,
                'table'=>$this->table,
                'export'=>$this->export,
            ]);
            file_put_contents($controllerFile, $content);
            $this->info( $this->controllerClassName()." generated successfully." );
        }
    }

    public function generateAutocomplete()
    {
        $controllerFile = $this->controllersDir()."/AutocompleteController.php";
        if(!file_exists($controllerFile)){
          $content = view('crud.autocomplete');
          file_put_contents($controllerFile, $content);
          $this->info( "AutocompleteController generated successfully." );

          $route = "Route::get('autocomplete/{method}','AutocompleteController@search');\n";
          $routesFile = base_path('routes/web.php');
          $routesFileContent = file_get_contents($routesFile);

          if ( strpos( $routesFileContent, $route ) == false )
          {
              $routesFileContent = $this->getUpdatedContent($routesFileContent, $route);
              file_put_contents($routesFile,$routesFileContent);
              $this->info("created route: ".$route);
          }
        }

        foreach($this->fields as $field){
          if(($field->type == 'number')&&(preg_match("/id_|_id/",$field->name,$match))){
  					$fieldName = preg_replace("/id_|_id/","",$field->name);
            $autocompleteFunctionName='private function '.$fieldName.'($r)';
            $autocompleteFileContent = file_get_contents($controllerFile);
            if ( strpos( $autocompleteFileContent, $autocompleteFunctionName ) == false )
            {
              $autocomplete = '/*'.$autocompleteFunctionName.'{
          $q=$r->input("q");
          $query='.ucfirst($fieldName).'::select(\DB::raw("'.$fieldName.'.*"))
          ->where("name","like","%$q%")
          ->limit(20);
          $results=$query->get();
          return \Response::json($results->toArray());
        }
        */      ';

              $autocompleteFileContent = $this->getUpdatedAutocomplete($autocompleteFileContent, $autocomplete);
              if($autocompleteFileContent!=null){
                file_put_contents($controllerFile,$autocompleteFileContent);
                $this->info("append autocomplete");
              }
            }else{
              $this->info("autocomplete function exists");
            }
          }
        }
    }

    public function generateViews()
    {
        $listViews = ['index','form'];
        if( !file_exists($this->viewsDir()) ) mkdir($this->viewsDir());
        foreach ( $listViews as $view ){
            $viewFile = $this->viewsDir()."/".$view.".blade.php";
            if($this->confirmOverwrite($viewFile))
            {
                $content = view('crud.views.'.$view, [
                    'gen' => $this,
                    'fields' => $this->fields,
                    'fieldsArr' => $this->fieldsArr,
                    'export'=>$this->export,
                    'table'=>$this->table
                ]);
                // dd($content);
                file_put_contents($viewFile, $content);
                // echo $viewFile;exit;

                $this->info( "View file ".$view." generated successfully." );
            }
        }
    }

    protected function confirmOverwrite($file)
    {
        // if file does not already exist, return
        if( !file_exists($file) ) return true;

        // file exists, get confirmation
        if ($this->confirm($file.' already exists! Do you wish to overwrite this file? [y|N]')) {
            $this->info("overwriting...");
            return true;
        }
        else{
            $this->info("Using existing file ...");
            return false;
        }
    }

    public function route()
    {
        return str_slug(str_replace("_"," ", str_singular($this->tableName)));
    }

    public function controllerClassName()
    {
        return studly_case(str_singular($this->tableName))."Controller";
    }

    public function viewsDir()
    {
        return base_path('resources/views/'.$this->viewsDirName());
    }

    public function viewsDirName()
    {
        return str_singular($this->tableName);
    }

    public function controllersDir()
    {
        return app_path('Http/Controllers');
    }

    public function modelsDir()
    {
        return app_path();
    }

    public function modelClassName()
    {
        return studly_case(str_singular($this->tableName));
    }

    public function modelVariableName()
    {
        return camel_case(str_singular($this->tableName));
    }

    public function titleSingular()
    {
        return ucwords(str_singular(str_replace("_", " ", $this->tableName)));
    }

    public function titlePlural()
    {
        return ucwords(str_replace("_", " ", $this->tableName));
    }
}
