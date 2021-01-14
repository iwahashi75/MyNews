<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Profile;

class ProfileController extends Controller
{
    //以下を追記Actionを追加
    public function add()
    {
      return view('admin.profile.create');
    }
    
    public function create(Request $request)
    {
      $this->validate($request, Profile::$rules);
      
      //new:モデルからインスタンス（レコード）を生成
      $profile = new Profile;
      //formで入力された値を取得
      $form = $request->all();
      
      // フォームから送信されてきた_tokenを削除する
      unset($form['_token']);
      // データベースに保存する
      $profile->fill($form);
      $profile->save();
      
      // admin/news/createにリダイレクトする
      return redirect('admin/profile/create');
    }
    
    public function edit()
    {
      return view('admin.profile.edit');
    }
    
    public function update()
    {
      return redirect('admin/profile/edit');
    }
    
}
