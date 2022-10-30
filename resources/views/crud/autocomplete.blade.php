<?php
/* @var $gen \App\Generator\src\Commands\Crud */
?>
<?='<?php'?>

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Response;

class AutocompleteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function search($method,Request $r)
    {
        return $this->$method($r);
    }

    //autocomplete goes here
}
