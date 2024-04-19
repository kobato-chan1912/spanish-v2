<?php

namespace App\Http\Controllers;

use App\Models\Ad;
use App\Models\Category;
use App\Models\Song;
use Carbon\Carbon;
use Illuminate\Http\Request;

class WebPageController extends Controller
{
    //
    public $page;
    public $url;
    public function __construct(Request $request)
    {
        $this->page = $request->get('page');
        $this->url = "?page=";
    }

    public function indexHome(Request $request)
    {
        $post = file_get_contents(storage_path("app/public/post_outside.txt"));
        $page = $this->page;
        $url = $this->url;
        $newestSongs = Song::orderBy("id", "desc")->where("display",1)->paginate(10);
        $bestSongs = Song::orderBy("downloads", "desc")->where("display",1)->limit(10)->get();
        $popularSongs = Song::orderBy("listeners", "desc")->where("display",1)->limit(10)->get();

        $topWeekSongs = Song::orderBy("listeners", "desc")->where("display",1)
            ->where('created_at', '>=', Carbon::today()->startOfWeek())->limit(6)->get();

        $topMonthSongs = Song::orderBy("listeners", "desc")->where("display",1)
            ->where('created_at', '>=', Carbon::today()->startOfMonth())->limit(6)->get();



        return view ("webpage.home.home",
            compact('post', 'newestSongs', 'bestSongs', 'popularSongs', 'page', 'url' , 'topMonthSongs', 'topWeekSongs'));
    }

    public function download(Request $request, $category, $song)
    {
        $category = Category::where("category_slug", $category)->where("display",1)->firstOrFail();
        $song = Song::where("slug", $song)->where("display",1)->where("category_id", $category->id)->firstOrFail();
        if ($song != null){
            $currentDownload = $song->downloads;
            $song->update(["downloads" => $currentDownload+1]);

            $similarSongs = Song::where("category_id", $song->category_id)
                ->where("display", 1)
                ->where("id", "!=", $song->id)
                ->limit(12)->get();
            return view("webpage.download.index", compact('song', 'similarSongs'));
        } else {
            abort("404");
        }

    }
    public function dlDownload(Request $request): \Symfony\Component\HttpFoundation\BinaryFileResponse
    {
        if ($request->has("id")){
            $id = $request->get("id");
            $song = Song::where('id', '=', $id)->firstOrFail();
            $pathToFile=public_path(). $song->url;
            return response()->download($pathToFile);
        } else {
            abort("404");
        }

    }

//    public function newest(Request $request){
//        $page = $request->page;
//        $url = "?page=";
//        $songs = Song::orderBy("id", "desc")->paginate(10);
//        return view("webpage.categories.index", compact('songs', 'page', 'url'));
//    }



}
