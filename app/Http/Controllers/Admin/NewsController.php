<?php

namespace App\Http\Controllers\Admin;

use App\History;
use App\Http\Controllers\Controller;
use App\News;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Utl; // 松田追加

class NewsController extends Controller
{
    public function add()
    {
        return view('admin.news.create');
    }

    public function create(Request $request)
    {

        // Varidationを行う
        $this->validate($request, News::$rules);

        $news = new News;
        $news->user_id = $request->user()->id;

        $form = $request->all();

        // フォームから画像が送信されてきたら、保存して、$news->image_path に画像のパスを保存する
        if (isset($form['image'])) {
            // 松田変更ここから
            //$path = $request->file('image')->store('public/image');
            $path =  parent::s3Store($request->file('image'));
            // 松田変更ここまで
            $news->image_path = basename($path);
        } else {
            $news->image_path = null;
        }

        // フォームから送信されてきた_tokenを削除する
        unset($form['_token']);
        unset($form['image']);
        // データベースに保存する
        $news->fill($form);
        $news->save();

        return redirect('admin/news/');
    }

    public function index(Request $request)
    {
        $cond_title = $request->cond_title;
        if ($cond_title != '') {
            // 検索されたら検索結果を取得する
            $posts = News::where('title', $cond_title)->get();
        } else {
            // それ以外はすべてのニュースを取得する
            $posts = News::all()->sortByDesc('created_at');

        }
        return view('admin.news.index', ['posts' => $posts, 'cond_title' => $cond_title]);
    }
    public function edit(Request $request)
    {
        // News Modelからデータを取得する
        $news = News::find($request->id);

        return view('admin.news.edit', ['news_form' => $news]);
    }

    public function update(Request $request)
    {
        $this->validate($request, News::$rules);
        $news = News::find($request->id);
        $news_form = $request->all();

        if ($request->remove == 'true') {
            $news_form['image_path'] = null;
        } elseif ($request->file('image')) {
            // 松田変更ここから
            //$path = $request->file('image')->store('public/image');
            $path =  parent::s3Store($request->file('image'));
            // 松田変更ここまで
            $news_form['image_path'] = basename($path);
        } else {
            $news_form['image_path'] = $news->image_path;
        }

        unset($news_form['_token']);
        unset($news_form['image']);
        unset($news_form['remove']);
        $news->fill($news_form)->save();

        $history = new History;
        $history->news_id = $news->id;
        $history->edited_at = Carbon::now();
        $history->save();

        return redirect('admin/news/');
    }

    public function delete(Request $request)
    {
        // 該当するNews Modelを取得
        $news = News::find($request->id);
        // 松田変更ここから
        // 画像が登録されていれば削除する
        if (!Utl::isNullOrEmpty($news->image_path)) {
          parent::s3Remove($news->image_path);
        }
        // 松田変更ここまで
        // 削除する
        $news->delete();
        return redirect('admin/news/');
    }

}
