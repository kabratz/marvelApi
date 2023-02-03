<?php

namespace App\Http\Controllers;

use App\Models\Character;
use Illuminate\Http\Request;
use App\Http\Controllers;
use App\Http\Controllers\CharacterController;
use App\Http\Controllers\StoryController;

class HomeController extends Controller
{
    public function index()
    {
        $data['characters'] = (new CharacterController)->getAll();
        $data['stories'] = (new StoryController)->getAll();
       
        return view('index',$data);
    }
}
