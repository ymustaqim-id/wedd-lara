<?php
namespace App\Console\Commands\Generator;

/**
* kolom database
*/
class Table
{
	public function pk(){
		$pk = "";
		foreach ($this->fields as $key => $field) {
			if($field->key!="" && (strpos('PRI',$field->key)!==false)){
				try {
					$pk=$field->name;
				} catch (\Exception $e) {

				}
			}
		}

		return $pk;
	}
	public function pkStr(){
		$pkList=$this->pk();
		$pkStr="";
		foreach ($pkList as $key => $value) {
			$pkStr.=$pkStr!=""?",":"";
			$pkStr.=$value;
		}
		return $pkStr;
	}
}
?>
