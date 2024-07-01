<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class ArticleController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except(['index', 'detail']);
    }
    public function index()
    {
        $data = Article::latest()->paginate(3);

        return view("articles.index", [
            "articles" => $data,
        ]);
    }

    public function detail($id)
    {
        $article = Article::find($id);

        return view("articles.detail", [
            "article" => $article
        ]);
    }

    public function add()
    {
        return view("articles.add");
    }

    public function create()
    {
        $validator = validator(request()->all(), [
            "title" => "required",
            "body" => "required",
            "category_id" => "required",
        ]);

        if($validator->fails()) {
            return back()->withErrors($validator);
        }

        $article = new Article; // create new model
        $article->title = request()->title;
        $article->body = request()->body;
        $article->category_id = request()->category_id;
        $article->user_id = auth()->id();
        $article->save();

        return redirect("/articles");
    }

    public function delete($id)
    {
        $article = Article::find($id);
        
        if( Gate::allows('delete-article', $article) )
        {
            $article->delete();
            return redirect("/articles")->with("info", "Article Deleted");
        }

        return back()->with('info', 'Unauthorized!!!');
    }
}
