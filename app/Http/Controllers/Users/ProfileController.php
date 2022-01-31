<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use App\Profile;
use App\User;
use App\UserHistory;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Utl;

class ProfileController extends Controller
{
    public function add()
    {
        return view('users.profile.create');
    }

    public function edit(Request $request)
    {
        // 松田変更
        $id = 0;
        //if (Auth::user()->id === 9) {
        if (Utl::isAdmin()) {
            $id = $request->id;
        } else if (Utl::isLogin()) {
            $id = Auth::id();
        }

        if (0 != $id) {
          $user = User::find($id);
          return view('users.profile.edit', ['user' => $user]);
        } else {
          // ログインしていない場合はトップページに
          return redirect('/');
        }
    }

    public function update(Request $request)
    {
        $this->validate($request, Profile::$rules);

        $profile = Profile::find($request->profile_id);
        // $profile_form = $user->profile;
        // $profile_form = new Profile;
        $profile_form = $request->all();

        if ($request->remove == 'true') {
            // 松田変更ここから
            //$profile_form['profile_image_path'] = null;
            // 画像を削除する(画像無しのファイルは削除されない)
            parent::deleteImage($profile->profile_image_path);
            // プロフィールの画像名をno_imageに変更
            $profile_form['profile_image_path'] = Utl::getNoProfileImgFileName();
            // 松田変更ここまで
        } elseif ($request->file('image')) {

            // 松田変更ここから
            //$path = $request->file('image')->store('public/image');
            $path =  parent::swapImage($request->file('image'), $profile->profile_image_path);
            // 松田変更ここまで
            $profile_form['profile_image_path'] = basename($path);
        } else {
            $profile_form['profile_image_path'] = $profile->profile_image_path;
        }

        unset($profile_form['_token']);
        unset($profile_form['image']);
        unset($profile_form['profile_id']);
        unset($profile_form['remove']);

        $profile->fill($profile_form)->save();
        // $profile_form->user_id = Auth::id();

        // $profile_form->introduction = $request->input('introduction');
        // $profile_form->name = $request->input('name');
        // $profile_form->gender = $request->input('gender');
        // $profile_form->hobby = $request->input('hobby');
        // $profile_form->profile_image_path = $request->input('image');

        // $profile_form->save();

        $userhistory = new UserHistory;
        $userhistory->profile_id = $profile->id;
        $userhistory->edited_at = Carbon::now();
        $userhistory->save();

        return redirect('profile/' . $profile->id . '/show');
    }

}
