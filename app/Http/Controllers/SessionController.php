<?php

namespace App\Http\Controllers;

use App\Models\Session;
use Illuminate\Http\Request;

class SessionController extends Controller
{
    public function createSession(){
        return view('admin.addSession');
    }

    public function storeSession(Request $request){
        $request->validate([
             'sessionDescription'=> 'required|string',
             'className'=>'required|string',
             'sessionTime'=> 'required|string',
             'sessionDate'=> 'required|string'
        ]);

        //add to database
        Session::create([
            'description' => $request->input('sessionDescription'),
            'class'=>$request->input('className'),
            'time'=>$request->input('sessionTime'),
            'date'=>$request->input('sessionDate')
            

        ]);
        return redirect()->back()->with('success', 'Session added successfully!');

    }

    public function fetchSessions(Request $request)
    {
        try {
            // Retrieve all sessions from the database
            $sessions = Session::all();
            
            
            $html = '<p class="display-5 text-center fw-bold">Sessions timetable</p>';
            $html .= '<div class="table-responsive">';
            $html .= '<table class="table table-bordered table-striped">';
            $html .= '<thead class="thead-dark"><tr><th>Description</th><th>Class</th><th>Time</th><th>Date</th></tr></thead>';
            $html .= '<tbody>';
    
            foreach ($sessions as $session) {
                // Access the fields of each session record
                $html .= '<tr>';
                $html .= '<td>' . $session->description . '</td>';
                $html .= '<td>' . $session->class . '</td>';
                $html .= '<td>' . $session->time . '</td>';
                $html .= '<td>' . $session->date . '</td>';
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