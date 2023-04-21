<?php
namespace App\Traits;

use App\Models\ArticleImage;

trait HandleArticle
{
    public function rules()
    {
        return [
            'title' => ['required', 'alpha_num', 'unique:articles,title'],
            'description' => ['max:1000'],
            'article_image' => ['required'],
            'images' => ['required']
        ];
    }

    public function image_name_generate($image)
    {    
        static $count = 1;
        return date('Ymdmis', time()) . 
        $count++ . '.' . 
        $image->getClientOriginalExtension();
    }

    public function check_file($file_name)
    {
        if (file_exists(public_path() . '\Articles\images\\' . $file_name)) {
            unlink(public_path() . '\Articles\images\\' . $file_name);
        }
    }

    public function recording_images(array $array, int $id)
    {
        foreach ($array as $image) {
        $article_images = new ArticleImage;
        $image_name = $this->image_name_generate($image);
        $image->move('Articles/images', $image_name);
        $article_images->article_id = $id;
        $article_images->image = $image_name;
        $article_images->save();
        }
    }

}