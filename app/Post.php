<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Post extends Model
{

    protected $fillable = ['title','content', 'slug'];

    public static function generateSlug($title){
        $slug= Str::slug($title);
        $slug_base = $slug;

        //verifico se è presente nel db
        //SELECT * From posts WHERE slug = $slug (first restituisce solo il primo risultato di un oggetto)
        $post_presente = Post::where('slug',$slug)->first();

        //se è presente concateno allo slug un contatore
        $c=1;
        while($post_presente){
            $slug = $slug_base . '-' . $c;
            $c++;
            $post_presente = Post::where('slug', $slug)->first();
        }

        return $slug;
    }
}
