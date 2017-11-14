<?php
/**
 * Created by PhpStorm.
 * User: Igor Martins
 * Date: 01/10/2017
 * Time: 23:24
 */

function layout(){
    return \Request::is('admin/*') ? 'layouts.admin' : 'layouts.app';
}

//Caso for administrador posso renderizar código personalizado
function isAdmin(){
    return \Request::is('admin/*') ? true : false;
}