<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller {
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct() {
        $this->middleware('auth')->only('downloads');
    }

    public function index() {
        return view('calendar.index');
    }

    /**
     * Show the welcome page.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function welcome() {
        return view('welcome');
    }

    /**
     * Show the home page.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function home() {
        return view('home');
    }

    /**
     * Show the downloads page.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function downloads() {
        return view('downloads');
    }
}
