<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Banner;
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
        $datas = Banner::all();
        return view('frontend.index', compact('datas'));
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function about()
    {
        return view('frontend.about');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function services()
    {
        return view('frontend.services');
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
