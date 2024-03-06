<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\EmailList;
use Illuminate\Support\Facades\Auth;

class EmailListController extends Controller
{


    public function showSubscribers()
    {
        $subscribers = EmailList::all();

        // Check if the authenticated user has the admin or editor role
        if (Auth::user()->hasRole('admin')) {
            // If the user has the admin role, return the admin view
            return view('admin.subs', compact('subscribers'));
        } elseif (Auth::user()->hasRole('editor')) {
            // If the user has the editor role, return the writer view
            return view('writer.subs', compact('subscribers'));
        } else {
            // If the user doesn't have the required role, redirect them to an unauthorized page
            return redirect()->route('unauthorized');
        }
    }








}
