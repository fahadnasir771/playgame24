<?php

namespace App\Http\Controllers;

use App\Models\Receipt;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        // dd(DB::select("SELECT * FROM receipts group by created_at"));
        // dd(Receipt::groupBy('only_date')->get());
        return view('home')->with([
            'filter' => Receipt::groupBy('only_date')->get(),
            // 'dates' => Receipt::
        ]);
    }

    public function gen() {
        return view('gen');
    }
}
