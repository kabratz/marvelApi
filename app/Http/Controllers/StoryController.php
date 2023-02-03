<?php

namespace App\Http\Controllers;

use App\Models\Story;
use App\Models\StoryCharacter;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Http\Controllers\StoryCharacterController;


class StoryController extends Controller
{
    private $prefix = 'http://gateway.marvel.com/v1/public/';
    private $publicKey = '9c833bc78bf199886291e884d2b746cf';
    private $privateKey = '9d0035051fad1d906ec3f920a0b2df82e4fd53a9';
    private $timestemp = '213';

    public function importAll()
    {
        $hash = md5($this->timestemp . $this->privateKey . $this->publicKey);

        $response = Http::get("{$this->prefix}stories?ts={$this->timestemp}&apikey={$this->publicKey}&hash={$hash}");
        $data = json_decode($response->body())->data->results;

        // dd($data);
        foreach ($data as $storyImported) {
           
    
            $story = Story::find($storyImported->id);

            /* if exist a story with the same id, update it */
            if ($story)
            {
                $story->title       = $storyImported->title;
                $story->description = $storyImported->description;
            }
            /* if doesn't exist a story with the same id, create it */
            else
            {
                $story = new Story([
                    'id'          => $storyImported->id,
                    'title'       => $storyImported->title,
                    'description' => $storyImported->description,
                ]);
            }
            $story->save();

            
        }

        return redirect()->back();
    }

    public function getAll()
    {
        $stories = Story::all();

        return $stories;
    }

    public function loadAll()
    {
        $data['stories'] = $this->getAll();
        foreach($data['stories'] as $key => $story)
        {
            $characters = (new StoryCharacterController)->getByStoryId($story->id);
            if (sizeof($characters) > 0)
            {
                $data['stories'][$key]->characters = $characters;
            }
        }
        /* dd($data); */
        return view('stories', $data);
    }
}
