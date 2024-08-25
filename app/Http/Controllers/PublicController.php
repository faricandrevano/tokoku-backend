<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PublicController extends Controller
{
    public function help()
    {
        return view('pages.public.help', [
            'title' => 'Help',
        ]);
    }

    public function term()
    {
        return view('pages.public.term', [
            'title' => 'Term',
        ]);
    }

    public function privacy()
    {
        return view('pages.public.privacy', [
            'title' => 'Privacy Policy',
        ]);
    }
}
