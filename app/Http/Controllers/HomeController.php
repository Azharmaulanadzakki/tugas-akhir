<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');

        $mapels = DB::table('mapels')
            ->when($search, function ($query) use ($search) {
                return $query->where('judul', 'like', '%' . $search . '%')
                    ->orWhere('description', 'like', '%' . $search . '%');
            })
            ->latest()
            ->paginate();

        return view('home', compact('mapels', 'search'));
    }
}