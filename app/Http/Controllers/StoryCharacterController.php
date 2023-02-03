<?php

namespace App\Http\Controllers;

use App\Models\Character;
use App\Models\Story;
use App\Models\StoryCharacter;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class StoryCharacterController extends Controller
{
    public function create(Request $request)
    {
        if ($request['story'] AND $request['character'])
        {
            $storyCharacter = new StoryCharacter([
                'story_id' => $request['story'],
                'character_id' => $request['character']
            ]);
        }
        if($storyCharacter->save())
        {
            $return['msg'] = 'Character saved!';
            $return['id'] = $storyCharacter->id;
        }
        else
        {
            $return['msg'] = 'Error to save!';
        }
        
        return $return;
    }

    public function getByStoryId($storyId)
    {
        $storyCharacters = StoryCharacter::where('story_id', $storyId)
                                        ->get();
        $return = array();
        if (sizeof($storyCharacters) > 0)
        {
            foreach ($storyCharacters as $storyCharacter)
            {
                $return[] = Character::find($storyCharacter->character_id);
            }
        }
        return $return;
    }

    public function getCharactersAvaibleToStory(Request $request)
    {

        $storyCharacters = StoryCharacter::select('character_id')
                             ->where('story_id', $request->story_id)
                             ->get();
        $charactersExistent[] = '';
                                
        foreach ($storyCharacters as $storyCharacter)
        {
            $charactersExistent[] = $storyCharacter->character_id;
        }
        //return json_encode($charactersExistent);

        $characters = Character::select('id', 'name')
                        ->whereNotIn('id', $charactersExistent)
                        ->get();

        return $characters;
    }

    public function delete(Request $request)
    {
        $storyCharacter = StoryCharacter::where('story_id', $request->story_id)
                                        ->where('character_id', $request->character_id);
                      

        if($storyCharacter->delete())
        {
            $return['msg'] = 'Character Deleted!';
        }
        else
        {
            $return['msg'] = 'Error to delete!';
        }
        return $return;
    }
}
