<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Http\Controllers;
use Illuminate\Routing\Controller as BaseController;

class HelloWordController extends BaseController{
    //put your code here
    public function getHelloWordTitle(){
        $data['title'] = 'Form Watch Video';
        return view('openload', $data);
    }
}
