<?php

namespace App\Http\Controllers;

use App\Models\About;
use App\Models\Hero;
use App\Models\Project;
use App\Models\Skill;

class HomepageController extends Controller
{
    public function index()
    {
        $heroes = Hero::latest()->get();
        $abouts = About::latest()->get();
        $skills = Skill::oldest()->get();
        $projects = Project::latest()->get();

        return view('front.index', compact('heroes', 'abouts', 'skills', 'projects'));
    }
}
