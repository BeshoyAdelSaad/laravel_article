<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\ArticleImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public $i = 0;
    public function image_name_generate()
    {
        static $count = 1;
        return date('Ymdmis',time()) . $count++;
    }
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
        $request->validate([
            'title' => ['required', 'alpha_num'],
            'description' => ['max:1000'],
            'article_image' => ['required'],
            'images' => ['required']
        ]);
        
        $article = new Article;
    

        $image = $request->article_image;
        $image_name =  $this->image_name_generate() . '.' . $image->getClientOriginalExtension();
        $request->article_image->move('Articles/images', $image_name);
        
        $article->title = $request->title;
        $article->description = $request->description;
        $article->article_image = $image_name;
        $article->save();
        
        foreach($request->images as $image)
        {
            $article_images = new ArticleImage;
            $image_name = $this->image_name_generate() . "." . $image->getClientOriginalExtension();
            $image->move('Articles/images', $image_name);
            $article_images->article_id = $article->id;
            $article_images->image = $image_name;
            $article_images->save();
        }
        
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
        
        $request->validate([
            'title' => ['required', 'alpha_num'],
            'description' => ['max:1000'],
            'article_image' => ['required'],
            'images' => ['required']
        ]);

        $article = Article::find($id);

        if (file_exists(public_path() . '\Articles\images\\' . $article->article_image)) {
            unlink(public_path() . '\Articles\images\\' . $article->article_image);
        }

        $delete_images = ArticleImage::where('article_id', $id)->get();
        foreach ($delete_images as $image) {
            if (file_exists(public_path() . '\Articles\images\\' . $image->image)) {
                unlink(public_path() . '\Articles\images\\' . $image->image);
            }
            $image->delete();
        }

        
       
        $image = $request->article_image;
        $image_name = $this->image_name_generate() . '.' . $image->getClientOriginalExtension();
        $request->article_image->move('Articles/images', $image_name);
        
        $article->title = $request->title;
        $article->description = $request->description;
        $article->article_image = $image_name;
        $article->save();

       
        
        foreach ($request->images as $image) {
            $article_images = new ArticleImage;
            $image_name = $this->image_name_generate() . "." . $image->getClientOriginalExtension();
            $image->move('Articles/images', $image_name);
            $article_images->article_id = $article->id;
            $article_images->image = $image_name;
            $article_images->save();
        }

        return redirect()->route('article.index');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $delete = Article::find($id);

        $delete_images = ArticleImage::where('article_id', $id)->get();
        foreach ($delete_images as $image) {
            if (file_exists(public_path() . '\Articles\images\\' . $image->image)) {
                unlink(public_path() . '\Articles\images\\' . $image->image);
            }
        }
        if (file_exists(public_path() . '\Articles\images\\' . $delete->article_image)) {
            unlink(public_path() . '\Articles\images\\' . $delete->article_image);
        }

        $delete->delete();
        return redirect()->route('article.index');
    }
}