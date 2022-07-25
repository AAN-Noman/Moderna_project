<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Support\ServiceProvider;
use App\Models\Ola;
use App\Models\Team;
use App\Models\About;
use App\Models\Price;
use App\Models\Skill;
use App\Models\Antman;
use App\Models\Banner;
use App\Models\Batman;
use App\Models\Contact;
use App\Models\Ironman;
use App\Models\Service;
use App\Models\Language;
use App\Models\Portfolio;
use App\Models\Tetstimonial;
use App\Http\Controllers\Controller;

class FrontendController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $ironman = Ironman::all();
        $datas = Banner::all();
        $services = Service::all();
        return view('frontend.index', compact('datas', 'services', 'ironman'));
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function abouts()
    {
        $worker = Ola::all();
        $skill = Skill::all();
        $tetstimonial = Tetstimonial::all();
        $about = About::all();
        $language = Language::all();
        return view('frontend.about', compact('about', "skill", 'language', 'tetstimonial', 'worker'));
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function services()
    {
        $antman = Antman::all();
        $price = Price::all();
        $batman = Batman::all();
        $ironman = Ironman::all();
        $services = Service::all();
        return view('frontend.services', compact('ironman', 'services', 'batman', 'price', 'antman'));
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function portfolio()
    {
        $portfolio = Portfolio::all();
        return view('frontend.Portfolio', compact('portfolio'));
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function teams()
    {
        $team = Team::all();
        return view('frontend.team', compact('team'));
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function blog()
    {
        return view('frontend.blog');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function contacts()
    {
        $contact = Contact::all();
        return view('frontend.contact', compact('contact'));
    }
}


