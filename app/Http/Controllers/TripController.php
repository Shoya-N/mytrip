<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

// 以下の1行を追記することで、Trip Modelが扱えるようになる
use App\Models\Trip;
use Auth;

class TripController extends Controller
{
    public function add ()
    {
        return view('trip.create'); 
    }
    
    public function create (Request $request)
    {
        // Validationを行う
        $this->validate($request, Trip::$rules);
        
        $trip = new Trip;
        $form = $request->all();
        
        
        // フォームから画像が送信されてきたら、保存して、$trip->image_path に画像のパスを保存する
        if (isset($form['image'])) {
            $path = $request->file('image')->store('public/image');
            $trip->image_path = basename($path);
        } else {
            $trip->image_path = null;
        }
        
        // フォームから送信されてきた_tokenを削除する
        unset($form['_token']);
        // フォームから送信されてきたimageを削除する
        unset($form['image']);
        
        // データベースに保存する
        $trip->fill($form);
        $trip->user_id = Auth::id();
        $trip->save();
        
        return redirect('trip');
    }
    
    public function index(Request $request)
    {
        $cond_title = $request->cond_title;
        if ($cond_title != '') {
            // 検索されたら検索結果を取得する
            $posts = Trip::where('body', $cond_title)->get();
        } else {
            
            $posts = Trip::where('user_id', \Auth::user()->id)->get();
            
        }
        return view('trip.index', ['posts' => $posts, 'cond_title' => $cond_title]);
    }
    
     public function edit(Request $request)
    {
        // Trip Modelからデータを取得する
        $trip = Trip::find($request->id);
        if (empty($trip)) {
            abort(404);
        }
        return view('trip.edit', ['trip_form' => $trip]);
    }
    
    public function update(Request $request)
    {
        // Validationをかける
        $this->validate($request, Trip::$rules);
        // Trip Modelからデータを取得する
        $trip = Trip::find($request->id);
        // 送信されてきたフォームデータを格納する
        $trip_form = $request->all();
        
        if ($request->remove == 'true'){
            $trip_form['image_path'] = null;
        } elseif ($request->file('image')) {
            $path = $request->file('image')->store('public/image');
            $trip_form['image_path'] = basename($path);
        } else {
            $trip_form['image_path'] = $trip->image_path;
        }
        
        unset($trip_form['image']);
        unset($trip_form['remove']);
        unset($trip_form['_token']);
        
        //該当するデータを上書きして保存する
        $trip->fill($trip_form)->save();
        
        return redirect('/trip');
    }
    
    public function delete(Request $request)
    {
        // 該当するNews Modelを取得
        $trip = Trip::find($request->id);

        // 削除する
        $trip->delete();

        return redirect('trip/');
    }
}
