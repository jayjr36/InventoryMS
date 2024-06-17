<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{

    public function create()
    {
        return view('admin.addPosts');
    }

    public function store(Request $request)
    {
        // Validate the request
        $request->validate([
            'title' => 'required|string',
            'body' => 'required|string',

        ]);

        try {
            // Create and save the item
            Post::create([
                'title' => $request->input('title'),
                'body' => $request->input('body'),
            ]);

            return redirect()->route('post.create')->with('success', 'Post added successfully!');
        } catch (\Exception $e) {

            return redirect()->route('post.create')->with('error', 'Failed to add post. Please try again.');
        }
    }

    public function index()
    {
      $posts = Post::all();
      return view('admin.posts', compact('posts'));
    }
    
   
    public function update(Request $request, $id)
    {
      $request->validate([
        'title' => 'required|max:255',
        'body' => 'required',
      ]);

      try{

      }catch (\Exception $e) {
            
        return redirect()->route('posts.index')->with('error', 'Failed to update post. Please try again.');
    }
      $post = Post::find($id);
      $post->update($request->all());

      return redirect()->route('posts.index')->with('success', 'Post updated successfully.');
    }
   
    public function destroy($id)
    {
        try{
      $post = Post::find($id);
      $post->delete();
      return redirect()->route('posts.index')->with('success', 'Post deleted successfully');
        }catch (\Exception $e) {
            
            return redirect()->route('posts.index')->with('error', 'Failed to delete post. Please try again.');
        }
    }
  
    public function show($id)
    {

      $post = Post::find($id);
      return view('posts.show', compact('post'));
    }
    
    public function edit($id)
    {
        try{
      $post = Post::find($id);
      return view('admin.editPost', compact('post'));
      
        }catch (\Exception $e) {
            
            return redirect()->route('posts.index')->with('error', 'Failed to edit post. Please try again.');
        }
    }

    public function fetchAnnouncements(Request $request)
    {
        try {
            // Retrieve all sessions from the database
            $posts = Post::all();
    
            $html = '<p class="display-5 text-center fw-bold">Announcements</p>';
            $html .= '<div class="table-responsive">';
            $html .= '<table class="table table-bordered table-striped">';
            $html .= '<thead class="thead-dark"><tr><th>id</th><th>title</th><th>Body</th><th>Date</th></tr></thead>';
            $html .= '<tbody>';
    
            foreach ($posts as $post) {
                // Access the fields of each session record
                $html .= '<tr>';
                $html .= '<td>' . $post->id . '</td>';
                $html .= '<td>' . $post->title . '</td>';
                $html .= '<td>' . $post->body . '</td>';
                $html .= '<td>' . $post->created_at . '</td>';
                $html .= '</tr>';
            }
    
            $html .= '</tbody>';
            $html .= '</table>';
            $html .= '</div>';
    
            return response()->json(['html' => $html]);
        } catch (\Exception $e) {
            \Log::error('Error fetching session items: ' . $e->getMessage());
            return response()->json(['error' => 'Internal Server Error'], 500);
        }
    }
    
}
