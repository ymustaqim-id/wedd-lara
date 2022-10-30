<?php
function message($isSuccess,$successMessage="Data has been saved",$failedMessage="Failed to save data")
{
    if($isSuccess){
        Session::flash('message',$successMessage);
    } else {
        Session::flash('message',$failedMessage);
    }

    Session::flash('messageType',$isSuccess ? 'success' : 'error');
}

function validatorMessageStr($errors){
	$err="<ul>";
    foreach ($errors->all() as $error):
        $err.="<li>$error</li>";
    endforeach;
    $err.="</ul>";
    return $err;
}
