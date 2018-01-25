<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Article;

class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $articleList = Article::orderBy('created_at', 'desc')->get();
        foreach($articleList as $key=>$value){
            if(strlen($value['content']) > 10){
                $articleList[$key]['contentShort'] = substr($value['content'], 0, 9).'...';
            }
        }
        return view('article.index', ['articleList'=>$articleList]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('article.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $this->validate($request, ['title'=>'required|max:50']);
        if(Article::create(['title'=>$request->title, 'content'=>$request->content])){
            return redirect()->route('article.index');
        }else{
            return redirect()->route('errorPage');
        }
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $articleRecord = Article::find($id);
        return view('article.edit', compact('articleRecord'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $this->validate($request, ['title'=>'required|max:50']);
        $articleRecord = Article::findOrFail($id);
        $articleRecord->update(['title'=>$request->title, 'content'=>$request->content]);
        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $articleRecord = Article::findOrFail($id);
        if($articleRecord->delete()){
            return back();
        }else{
            return redirect()->route('errorPage');
        }
    }
}
