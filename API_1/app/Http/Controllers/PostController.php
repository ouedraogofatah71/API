<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\Post;
use Illuminate\Http\Request;
use App\Http\Requests\StorePostRequest;
use App\Http\Requests\UpdatePostRequest;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {   
        try {
            $query=Post::query();
            $perPage=5;//Nombre d'element par page
            $page=$request->input('page',1);
            $search=$request->input('search');
            if($search){
                $query->where('title','like','%'.$search.'%');
            }
            $total=$query->count();
            $result=$query->offset(($page-1)* $perPage)->limit($perPage)->get();

            return response()->json([
                "status_code" => 200,
                "status_message" => "The Posts list",
                "current_page" => $page,
                "last_page"=>ceil($total/$perPage),
                "items"=> $result
            ], 200); // Code de statut HTTP 200
        } catch (Exception $e) {
            // Retourner une réponse JSON avec un message d'erreur structuré
            return response()->json([
                "status_code" => 500,
                "status_message" => "An error occurred",
                "error" => $e->getMessage() // Inclure le message d'erreur
            ], 500); // Code de statut HTTP 500
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return "Formulaire d'enregistrement";
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePostRequest $request)
    {
        try {
            $post = new Post();
            $post->title = $request->title;
            $post->description = $request->description;
            $post->save();

            return response()->json([
                "status_code" => 200,
                "status_message" => "Post created successfully",
                "data" => $post
            ], 200); // Code de statut HTTP 200
        } catch (Exception $e) {
            // Retourner une réponse JSON avec un message d'erreur structuré
            return response()->json([
                "status_code" => 500,
                "status_message" => "An error occurred",
                "error" => $e->getMessage() // Inclure le message d'erreur
            ], 500); // Code de statut HTTP 500
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {
        try {
            return response()->json([
                "status_code" => 200,
                "status_message" => "Post Information",
                "data" => $post
            ], 200); // Code de statut HTTP 200
        } catch (Exception $e) {
            // Retourner une réponse JSON avec un message d'erreur structuré
            return response()->json([
                "status_code" => 500,
                "status_message" => "An error occurred",
                "error" => $e->getMessage() // Inclure le message d'erreur
            ], 500); // Code de statut HTTP 500
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post)
    {  
        return "Formulaire d'édition";
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePostRequest $request,Post $post)
    {
        try {
            // $post = Post::find($post);
            $post->title = $request->title;
            $post->description = $request->description;
            $post->update();

            return response()->json([
                "status_code" => 200,
                "status_message" => "Post updated successfully",
                "data" => $post
            ], 200); // Code de statut HTTP 200
        } catch (Exception $e) {
            // Retourner une réponse JSON avec un message d'erreur structuré
            return response()->json([
                "status_code" => 500,
                "status_message" => "An error occurred",
                "error" => $e->getMessage() // Inclure le message d'erreur
            ], 500); // Code de statut HTTP 500
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
       try {
        $post->delete();
        return response()->json([
            "status_code" => 200,
            "status_message" => "Post deleted successfully",
            "data" => $post
        ], 200); // Code de statut HTTP 200
       } catch (Exception $e) {
        return response()->json($e);
       }
    }
}
