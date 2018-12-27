<?php

namespace App\Http\Controllers;

use App\News;
use App\Profile;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function show(Request $request)
    {
        $cond_title = $request->cond_title;
        if ($cond_title != '') {
            $posts = News::where('title', $cond_title) . orderBy('created_at', 'desc')->get();
        } else {
            $posts = News::all()->sortByDesc('creatd_at');

        }

        // $headline = Profile::find(Auth::user()->id);
        // $headline = Profile::find(6);
        // $headline = Profile::where('user_id', $request->id);
        $user_id_for_show = $request->id;

        $headline = Profile::find($request->id);
        return view('profile.show', ['user_id_for_show' => $user_id_for_show, 'headline' => $headline, 'posts' => $posts, 'cond_title' => $cond_title]);
    }

}
