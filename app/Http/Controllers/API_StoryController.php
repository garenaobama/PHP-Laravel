<?php

namespace App\Http\Controllers;

use App\Models\Story;
use App\Http\Controllers\Controller;
use App\Repositories\PageRepository;
use App\Repositories\StoryRepositoryInterface;
use Illuminate\Http\Request;

class API_StoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public $StoryRepository;

    public function __construct(StoryRepositoryInterface $StoryRepository){
        $this->StoryRepository=$StoryRepository;
    }

    public function index()
    {
        $story = $this->StoryRepository->getAllStory();
        return response()->json($story);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $story = new Story();
        $story->author_id = $request->author_id;
        $story->type_id = $request->type_id;
        $story->name = $request->name;
        $story->thumbnail = $request->thumbnail;
        $story->coin = $request->coin;
        $story->isActive = $request-> isActive;
        $this->StoryRepository->createStory($story);
        return response()->json([
            'story' => $story,
            'message' => 'Data inserted',
        ], 201); //success
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $story = $this->StoryRepository->getStoryById($id);
        return response()->json($story);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        // Validate the request data
        $request->validate([
            'story_id' => 'required',
        ]);

        $id = $request->story_id;

        // Find the story by id
        $exist = Story::find($id);

        if($exist){//if exist then update
            $story= Story::make($request->all());

            // Update the story with the request data
            $this->StoryRepository->updateStory($id,$story);

            // Return a JSON response with the updated story
            return response()->json([
                'story'=>$story,
                'message' => 'Data updated',
            ], 200);
        }else{
            return response()->json([
                'message' => 'Story not found'
            ], 404);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        //validate
        $request->validate([
           'story_id' => 'required'
        ]);

        $id = $request->story_id;

        //find the story by id
        $story = $this->StoryRepository->getStoryById($id);

        //delete story
        if ($story){
            $this->StoryRepository->deleteStoryById($id);
            return response()->json([
                'message' => 'Story deleted successfully',
            ], 200);
        }
        else{
            return response()->json([
                'message' => 'Story not found'
            ], 404);
        }
    }
}
