<?php

namespace App\Http\Controllers;

use App\Models\question;
use Illuminate\Http\Request;
use Validator;  //この1行だけ追加！
class QuestionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $question = question::where('user_id',Auth::id())->orderBy('created_at', 'asc')->paginate(3);
        return view('question', ['question' => $question]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
     public function store(Request $request)
    {
         //バリデーション
    $validator = Validator::make($request->all(), [
         'item_content1' => 'required|min:3|max:255',
         'item_content2' => 'required|min:1|max:3',
         'item_content3' => 'required|max:6',
         'published'   => 'required',
    ]);

    //バリデーション:エラー 
    if ($validator->fails()) {
        return redirect('/')
            ->withInput()
            ->withErrors($validator);
    }

    //以下に登録処理を記述（Eloquentモデル）
	  // Eloquentモデル
	  $books = new Book;
	  $books->user_id = Auth::id();//ここを追加
	  $books->item_content1   = $request->item_content1;
	  $books->item_content2 = $request->item_content2;
	  $books->item_content3 = $request->item_content3;
	  $books->published   = $request->published;
	  $books->save(); 
	  return redirect('/');
    }


    /**
     * Display the specified resource.
     *
     * @param  \App\Models\question  $question
     * @return \Illuminate\Http\Response
     */
    public function show(question $question)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\question  $question
     * @return \Illuminate\Http\Response
     */
    public function edit(question $question)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\question  $question
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, question $question)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\question  $question
     * @return \Illuminate\Http\Response
     */
    public function destroy(question $question)
    {
        //
    }
}
