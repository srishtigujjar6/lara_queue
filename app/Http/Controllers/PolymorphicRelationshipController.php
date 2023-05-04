<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Author;
use App\Models\Post;
use App\Models\Image;
use App\Models\Tag;

class PolymorphicRelationshipController extends Controller
{
    public function saveAllData(){

        // $author = new Author();
        // $author->name ="Ravi";
        // $author->save();

        // $post = new Post();
        // $post->name ="Today";
        // $post->description ="Lorem Ipsum.";
        // $post->save();

        $item = Author::find(2);
        // $item = Post::find(1);
        
        // IMAGE
        // $item->images()->create([
        //     'url' => 'url/new'
        // ]);

        // TAG
        $item->tags()->create([
            'name' => 'jara'
        ]);

    }    
    
    // ===============================
        // One to One and one to many (Image,post,author)
        
        // Image Model // imageable()( $this->morphTo() )
        // Post & Author Model // images() {$this->morphMany(Image::class, 'imageable')}
        // Post & Author Model // images() {$this->morphOne(Image::class, 'imageable')}
                
        // Many to many (Tag,Post,Author and taggables table)

        // Tag Model // Posts(){ $this->morphedByMany(Post::class, 'taggable')}
        // Tag Model // Authors(){ $this->morphedByMany(Author::class, 'taggable')}
        // Post Model // Tags(){ morphToMany(Tag::class, 'taggable')}
        // Author Model // Tags(){ morphToMany(Tag::class, 'taggable')}
            
    // ===============================

    // One to One and one to many ===============================

    public function getImageByPostid($id){
        $item = Post::find($id);
        dump($item->image);
        dump($item->images);
        return $item->images;
    }

    public function getImageByAuthorid($id){
        $item = Author::find($id);
        dump($item->image);
        dump($item->images);
        return $item->images;
    }

    public function getParentModelByImageid($id){
        $item = Image::find($id);
        dump($item->imageable);
        return $item->imageable;
    }

    // Many to many =============================================
    
    public function getTagOfPostById($id){
        $item = Post::find($id);
        // dump($item->tags);
        return $item->tags;
    }

    public function getTagOfAuthorById($id){
        $item = Author::find($id);
        // dump($item->tags);
        return $item->tags;
    }

    public function getPostModelsByTagId($id){
        $item = Tag::find($id);
        // dump($item->posts);
        return $item->posts;
    }

    public function getAuthorModelsByTagId($id){
        $item = Tag::find($id);
        // dump($item->authors);
        return $item->authors;
    }

    // ======================= QUERIES =========================

    
    public function getdataqueries(){
        // only posts which has tags
        // $posts = Post::has('tags')->get();

        // $posts = Post::whereRelation('tags', 'tag_id', '>' ,5)->get();  // ??
        

        // $posts = Post::has('images')->get();

        dump($posts);
        return $posts;
    }
    
}
  