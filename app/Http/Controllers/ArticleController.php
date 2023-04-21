<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\ArticleImage;
use App\Traits\HandleArticle;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ArticleController extends Controller
{
    use HandleArticle;
    /**
     * Display a listing of the resource.
     */
   
    public function index()
    {
        $articles = Article::all();
        return view('home', ['articles' => $articles]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('article.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate($this->rules());
        
        $article = new Article;
    
        $image = $request->article_image;
        $image_name =  $this->image_name_generate($image);
        $request->article_image->move('Articles/images', $image_name);
        
        $article->title = $request->title;
        $article->description = $request->description;
        $article->article_image = $image_name;
        $article->save();

        $this->recording_images($request->images, $article->id);

        return redirect()->route('article.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $article = Article::find($id);
        $images = ArticleImage::where('article_id', $id)->get();
        return view('article.show', compact('article', 'images'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $article = Article::find($id);

        return view('article.edit', compact('article'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate($this->rules());

        $article = Article::find($id);

        $this->check_file($article->article_image);

        $delete_images = ArticleImage::where('article_id', $id)->get();
        foreach ($delete_images as $image) {
            $this->check_file($image->image);
            $image->delete();
        }

        $image = $request->article_image;
        $image_name = $this->image_name_generate($image);
        $request->article_image->move('Articles/images', $image_name);
        
        $article->title = $request->title;
        $article->description = $request->description;
        $article->article_image = $image_name;
        $article->save();

        $this->recording_images($request->images, $article->id);

        return redirect()->route('article.index');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $delete = Article::find($id);

        $delete_images = ArticleImage::where('article_id', $id)->get();

        foreach ($delete_images as $image) $this->check_file($image->image);

        $this->check_file($delete->article_image);

        $delete->delete();
        return redirect()->route('article.index');
    }
}