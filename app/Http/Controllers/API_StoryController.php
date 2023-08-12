<?php

namespace App\Http\Controllers;

use App\Models\Story;
use App\Http\Controllers\Controller;
use App\Repositories\StoryRepositoryInterface;
use Illuminate\Http\Request;

class API_StoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public $StoryRepository;

    public function __construct(StoryRepositoryInterface $StoryRepository)
    {
        return $this->StoryRepository = $StoryRepository;
    }

    public function index()
    {
        $Story= $this->StoryRepository->getAllStory();
        return response()->json($Story, 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $Story = new Story();
        $Story->Story;
        $this->StoryRepository->createStory($Story);
        return response($Story,200);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $Story = $this->StoryRepository->getStoryById($id);
        if($Story){//exist
            return response()->json($Story, 200);
        }
        else{
            return response()->json([
                'message' => 'not found Story'
            ], 404);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        //validate
        $request->validate([
            'Story_id' => 'required'
        ]);

        $id = $request->Story_id;

        //check exist
        $exist = $this->StoryRepository->getStoryById($id);

        if($exist){
            $Story = Story::make($request->all());
            $this->StoryRepository->updateStory($id, $Story);
            return response()->json([
                'Story'=>$this->StoryRepository->getStoryById($id)
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
            'Story_id' => 'required'
        ]);

        $id = $request->Story_id;

        //check exist
        $Story = $this->StoryRepository->getStoryById($id);

        if($Story){
            $this->StoryRepository->deleteStoryById($id);
            return response()->json([
                'Story deleted'
            ], 200);
        }else{
            return response()->json([
                'message' => 'Story not found'
            ], 404);
        }
    }
}
