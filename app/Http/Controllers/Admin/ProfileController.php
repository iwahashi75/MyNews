<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Profile;
// Laravel17 以下を追記
use App\ProfileHistory;

use Carbon\Carbon;

class ProfileController extends Controller
{
    public function index(Request $request)
    {
       $cond_name = $request->cond_name;
       if ($cond_name != '') {
         //検索されたら検索結果を取得する
         $posts = Profile::where('name', $cond_name)->get();
       }else {
         //それ以外は全てのニュースを取得する
          $posts = Profile::all();
          
       }
       return view('admin.profile.index', ['posts' => $posts, 'cond_name' => $cond_name]);
    }
    
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
      return redirect('admin/profile');
    }
    
    public function edit(Request $request)
    {
       // News Modelからデータを取得する
      $profile = Profile::find($request->id);
      if (empty($profile)) {
        abort(404);    
      }
      return view('admin.profile.edit', ['profile_form' => $profile]);
    }
    
    public function update(Request $request)
    {
    //mynews/app/Http/Controllers/Admin/NewsController.php から参照、編集
     // Validationをかける
      $this->validate($request, Profile::$rules);
      // News Modelからデータを取得する
      $profile = Profile::find($request->id);
      // 送信されてきたフォームデータを格納する
      $profile_form = $request->all();
      unset($profile_form['_token']);

      // 該当するデータを上書きして保存する
      $profile->fill($profile_form)->save();
      
      //Laravel17 課題２
      $history = new ProfileHistory;
        $history->profile_id = $profile->id;
        $history->edited_at = Carbon::now();
        $history->save();
    
      return redirect('admin/profile');
    }
  
    public function delete(Request $request)
    {
    //該当するNews Modelを取得
      $profile = Profile::find($request->id);
    //削除する
      $profile->delete();
      return redirect('admin/profile/');
    }
}