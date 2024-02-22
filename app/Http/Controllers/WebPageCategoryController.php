<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use App\Models\Song;
use Illuminate\Http\Request;

class WebPageCategoryController extends Controller
{
    //
    public $page;
    public $url;
    public function __construct(Request $request)
    {
        $this->page = $request->get('page');
        $this->url = "?page=";
    }

    public function loadView($songs, $title, $ogTitle, $ogDes, $custom = null){
        return view("webpage.categories.index",
            ["songs" => $songs, "page" => $this->page, "url" => $this->url,
                "og_title" => $ogTitle, "og_des" => $ogDes, "title" => $title, "custom" => $custom]);
    }

    public function newestSongs()
    {
        $songs = Song::orderBy("id", "desc")->where("display", 1)->paginate(10);
        return $this->loadView($songs,
            "Últimos tonos de llamada",
            "Últimos tonos de llamada – Descarga tonos de llamada 100% gratis",
            "Descarga 75.000 de los últimos tonos de llamada en mp3 para todos los dispositivos móviles. Descarga gratis los últimos tonos de llamada de 2021.");
    }
    public function popularSongs()
    {
        $songs = Song::orderBy("listeners", "desc")->where("display", 1)->paginate(10);
        return $this->loadView($songs, "TOP tonos de llamada",
            "TOP tonos de llamada - Descarga tonos de llamada 100% gratis",
            "Descarga los 75.000 tonos de llamada más populares en mp3 para todos los dispositivos móviles. Descarga gratis los tonos de llamada mas populares de 2021.",
        );
    }

    public function categorySongs($slug){
        // Slug Solve //

        if ($slug=="about-us")
        {
            $content = file_get_contents(storage_path("app/public/about_us.txt"));
            return view("webpage.outside.index", ["content" => $content, "text" => "Tanıtmak - ". env("WEB_NAME")]);
        }
        if ($slug=="privacy-policy")
        {
            $content = file_get_contents(storage_path("app/public/privacy_policy.txt"));
            return view("webpage.outside.index", ["content" => $content, "text" => "Kullanım Şartları - ". env("WEB_NAME")]);
        }
        if ($slug=="terms-of-use")
        {
            $content = file_get_contents(storage_path("app/public/terms_of_use.txt"));
            return view("webpage.outside.index", ["content" => $content, "text" => "Gizlilik Politikası - ". env("WEB_NAME")]);
        }


        $category = Category::where("category_slug", $slug)->where("display",1)->first();
        $song = Song::where("slug", $slug)->where("display",1)->first();
        $post = Post::where("slug", $slug)->where("display",1)->first();

        if ($category != null){ // has category

            $songs = Song::where("category_id", $category->id)->where("display", 1)->paginate(10);
            $title = "Dzwonek $category->category_name";
            $metaDes = "En iyi zil seslerinin koleksiyonu $category->category_name düzenli olarak güncellenmektedir. Cep telefonunuz için ücretsiz $category->category_name zil seslerini indirin.";
            return $this->loadView($songs, $title, $category->meta_title, $category->meta_description, $category);

            // return view
        } elseif ($post != null){ // has Post

            return view("webpage.post.index", ["post" => $post]);
        }
        else {
            abort("404");
        }
    }


    public function showSongs($category, $song)
    {
        $category = Category::where("category_slug", $category)->where("display",1)->firstOrFail();
        $song = Song::where("slug", $song)->where("display",1)->where("category_id", $category->id)->firstOrFail();
        $similarSongs = Song::where("category_id", $song->category_id)
            ->where("display", 1)
            ->where("id", "!=", $song->id)
            ->limit(12)->get();
        $currentListener = $song->listeners;
        Song::where("id", $song->id)->update(["listeners" => $currentListener+1]);
        return view("webpage.song.index",
            ["song" => $song, "similarSongs" => $similarSongs, "og_title" => $song->meta_title,
                "og_des" => $song->meta_description]);
    }


    public function losMejores(){
        $songs  = Song::orderBy("downloads", "desc")->where("display", 1)->paginate(10);
        return $this->loadView($songs, "Mejores tonos de llamada ",
            "Mejores tonos de llamada - Descarga tonos de llamada 100% gratis",
            "Descarga los 75.000 mejores tonos de llamada en mp3 para todos los dispositivos móviles. Descarga gratis los mejores tonos de llamada de 2021.");
    }
    public function search(Request $request, $search){
        $songs = Song::where('title', 'LIKE', "%$search%")->paginate(10);
        return $this->loadView($songs, "Search Results: $search", "You searched for $search - Descargar tono de llamada mp3 gratis para móvil Android e iOS 2022",
            "");
    }
}
