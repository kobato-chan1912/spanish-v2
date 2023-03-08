<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Song;
use Illuminate\Http\Request;

class SitemapController extends Controller
{
    //
    public function index()
    {
//        $songs = Song::all();
//        $lastTime = Song::latest()->first()->created_at;
        $lastTimeCategory = Category::latest()->first()->created_at;
        $lastTimeSong = Song::latest()->first()->created_at;
        return response()->view('webpage.sitemap.index', compact('lastTimeCategory', 'lastTimeSong'))
            ->header('Content-Type', 'text/xml');

    }

    public function postSitemap(): \Illuminate\Http\Response
    {
        $songs = Song::all();
        return response()->view('webpage.sitemap.post', compact('songs'))
            ->header('Content-Type', 'text/xml');
    }
    public function categorySitemap(): \Illuminate\Http\Response
    {
        $categories = Category::all();
        return response()->view('webpage.sitemap.category', compact('categories'))
            ->header('Content-Type', 'text/xml');
    }
}
