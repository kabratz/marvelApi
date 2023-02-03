<?php

namespace App\Http\Controllers;

use App\Models\Character;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Route;

class CharacterController extends Controller
{
    private $prefix = 'http://gateway.marvel.com/v1/public/';
    private $publicKey = '9c833bc78bf199886291e884d2b746cf';
    private $privateKey = '9d0035051fad1d906ec3f920a0b2df82e4fd53a9';
    private $timestemp = '213';
    
    
    public function importAll()
    {
        $hash = md5($this->timestemp.$this->privateKey.$this->publicKey);

        $response = Http::get("{$this->prefix}characters?ts={$this->timestemp}&apikey={$this->publicKey}&hash={$hash}");
        $data = json_decode($response->body())->data->results;
    

        foreach($data as $characterImported)
        {
            $character = Character::find($characterImported->id);

            /* if exist a character with the same id, update it */
            if ($character)
            {
                $character->name        = $characterImported->name;
                $character->image       = $characterImported->thumbnail->path.'.'.$characterImported->thumbnail->extension;
                $character->description = $characterImported->description;
            }
            /* if doesn't exist a character with the same id, create it */
            else
            {

                $character = new Character([
                    'id'          => $characterImported->id,
                    'name'        => $characterImported->name,
                    'image'       => $characterImported->thumbnail->path.'.'.$characterImported->thumbnail->extension,
                    'description' => $characterImported->description,
                ]);
            }

            $character->save();
            
        }

        return redirect()->back();
    }

    public function getAll()
    {
        $characters = Character::all();

        return $characters;
    }

    public function loadAll()
    {
        $data['characters'] = $this->getAll();
        return view('characters', $data);
    }

}
