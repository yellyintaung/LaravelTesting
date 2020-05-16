<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Article;

class ArticleController extends Controller
{
    
    public function __construct()
    {
        $this->middleware('auth')->except(['index', 'detail']);
    }
    
    public function index(){
        $data = Article::latest()->paginate(5);
        return view('articles.index')->with('articles',$data);
    }
    
    public function detail($id){
        $article = Article::find($id);
        return view('articles.detail')->with('article',$article);
    }
    
    public function add(){
        $data = [
            [ "id" => 1, "name" => "News" ],
            [ "id" => 2, "name" => "Tech" ],
        ];
        return view('articles.add', [
            'categories' => $data
            ]);
            
        }
        
        public function create(Request $request){
            
            $validator = validator(request()->all(), [
                'title' => 'required',
                'body' => 'required',
                'category_id' => 'required',
                ]);
                if($validator->fails()) {
                    return back()->withErrors($validator);
                }
                
                $article = new Article();
                $article->title = $request->title;
                $article->body = $request->body;
                $article->category_id = $request->category_id;
                $article->save();
                
                return redirect('/articles');
            }
            
            public function delete($id){
                $article = Article::find($id);
                
                $article->delete();
                return redirect('/articles')->with('info','Article delete!');
            }
            
        }
        