<?php

namespace App\Http\Controllers;

use App\Models\Book1;
use Illuminate\Http\Request;

class Book1Controller extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $books1 = Book1::where('user_id',Auth::id())->orderBy('created_at', 'asc')->paginate(3);
        // ほんのデータをとってくる
        return view('books1', ['books1' => $books1]);
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
         'item_name' => 'required|min:3|max:255',
         'item_number' => 'required|min:1|max:3',
         'item_amount' => 'required|max:6',
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
	  $books1 = new Book1;
	  $books1->user_id = Auth::id();//ここを追加
	  $books1->item_name   = $request->item_name;
	  $books1->item_number = $request->item_number;
	  $books1->item_amount = $request->item_amount;
	  $books1->published   = $request->published;
	  $books1->save(); 
	  return redirect('/');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Book1  $book1
     * @return \Illuminate\Http\Response
     */
    public function show(Book1 $book1)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Book1  $book1
     * @return \Illuminate\Http\Response
     */
    public function edit(Book1 $book1)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Book1  $book1
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Book1 $book1)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Book1  $book1
     * @return \Illuminate\Http\Response
     */
    public function destroy(Book1 $book1)
    {
        //
    }
}
