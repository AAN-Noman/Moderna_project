<?php

namespace App\Http\Controllers\Frontend;

use App\Models\About;
use App\Models\Price;
use App\Models\Skill;
use App\Models\Antman;
use App\Models\Banner;
use App\Models\Batman;
use App\Models\Ironman;
use App\Models\Service;
use App\Models\Language;
use App\Models\Tetstimonial;
use Illuminate\Http\Request;
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
        $skill = Skill::all();
        $tetstimonial = Tetstimonial::all();
        $about = About::all();
        $language = Language::all();
        return view('frontend.about', compact('about', "skill", 'language', 'tetstimonial'));
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
        return view('frontend.portfolio');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function team()
    {
        return view('frontend.team');
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
    public function contact()
    {
        return view('frontend.contact');
    }
}
