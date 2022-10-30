<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Response;
use App\Models;

class AutocompleteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return  \Illuminate\Http\Response
     */
    public function search($method,Request $r)
    {
        return $this->$method($r);
    }

    //autocomplete goes here
  	 private function permission($r){
        $q=$r->input("q");
        $query=Models\Permission::select(\DB::raw("permissions.*"))
        ->where("name","like","%$q%")
        ->limit(20);
        $results=$query->get();
        return \Response::json($results->toArray());
      }
	     private function parent($r){
          $q=$r->input("q");
          $query=Models\Menu::select(\DB::raw("menus.*"))
          ->where("name","like","%$q%")
          ->limit(20);
          $results=$query->get();
          return \Response::json($results->toArray());
        }
    private function role($r){
      $q=strtoupper($r->input("q"));
      $query=\App\Role::select(\DB::raw("*"))
      ->where("name","like","%$q%")
      ->limit(20);
      $results=$query->get();
      return \Response::json($results->toArray());
    }
}
