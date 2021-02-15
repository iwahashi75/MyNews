<?php

namespace App\Http\Controllers\Admin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

//Laravel14 追記することでNews　Modelが扱えるようになる
use App\News;

class NewsController extends Controller
{
    //以下を追記 NewsControllerにaddというactionを実装
    public function add()
    {
        return view('admin.news.create');
    }
    //PHP13 以下を追記　createアクション
    //このRequestクラスはブラウザを通してユーザーから送られる情報を全て含んでいるオブジェクトを取得できる
  public function create(Request $request)
  {
      //PHP14 以下を追記
        // Varidationを行う（News::$rulesは、News.phpファイルの$rules変数を呼び出す）
      $this->validate($request, News::$rules);
      
      //new:モデルからインスタンス（レコード）を生成
      $news = new News;
      //formで入力された値を取得
      $form = $request->all();
      
      //フォームから画像が送信されてきたら保存して$news->image_pathに画像のパスを保存する
      //issetメソッド：引数の中にデータがあるか判断するメソッド
      if (isset($form['image'])) {
        $path = $request->file('image')->store('public/image');
        $news->image_path = basename($path);
      } else {
          $news->image_path = null;
      }
      // フォームから送信されてきた_tokenを削除する
      unset($form['_token']);
      // フォームから送信されてきたimageを削除する
      unset($form['image']);
      // データベースに保存する
      $news->fill($form);
      $news->save();
      
      // admin/news/createにリダイレクトする
      return redirect('admin/news/create');
  }  
  //laravel15以下を追記
  public function index(Request $request)
  {
     $cond_title = $request->cond_title;
     if ($cond_title != '') {
       //検索されたら検索結果を取得する
       $posts = News::where('title', $cond_title)->get();
     }else {
       //それ以外は全てのニュースを取得する
        $posts = News::all();
        
     }
     return view('admin.news.index', ['posts' => $posts, 'cond_title' => $cond_title]);
  }
//lalavel16　以下を追記
public function edit(Request $request)
  {
      // News Modelからデータを取得する
      $news = News::find($request->id);
      if (empty($news)) {
        abort(404);    
      }
      return view('admin.news.edit', ['news_form' => $news]);
  }


  public function update(Request $request)
  {
      // Validationをかける
      $this->validate($request, News::$rules);
      // News Modelからデータを取得する
      $news = News::find($request->id);
      // 送信されてきたフォームデータを格納する
      $news_form = $request->all();
      unset($news_form['_token']);

      // 該当するデータを上書きして保存する
      $news->fill($news_form)->save();

      return redirect('admin/news');
  }
//以下を追記laravel16 Controllerを実装する
  public function delete(Request $request)
  {
  //該当するNews Modelを取得
    $news = News::find($request->id);
  //削除する
    $news->delete();
    return redirect('admin/news/');
  }
  
  
}