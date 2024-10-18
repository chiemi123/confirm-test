<?php

namespace App\Http\Controllers;

use Illuminate\Pagination\Paginator;
use App\Http\Requests\ContactRequest;
use App\Http\Requests\AuthRequest;
use Illuminate\Http\Request;
use App\Models\Contact;
use App\Models\User;

class AuthController extends Controller
{
    //
    public function store(AuthRequest $request)
    {
        // バリデーション済みデータを取得
        $validatedData = $request->validated();

        // 新しいポストをデータベースに保存
        $users = User::create([
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
            'password' => $validatedData['password'],
        ]);

        return redirect()->route('auth.login');
    }
    //ページネーションの実装
    public function index()
    {
        $contacts = Contact::Paginate(7);
        return view('admin', ['contacts' => $contacts]);
    }

    public $contact;

    public function search(Request $request)
    {
        // フォームからの検索条件を取得
        $text = $request->input('text');
        $gender = $request->input('gender');
        $content = $request->input('content');
        $created_at = $request->input('created_at');

        // クエリビルダで条件を追加していく
        $contacts = Contact::query()
            ->when($text, function ($query, $text) {
                if ($text === 'exact') {
                    return $query->where('text', '=', $text);  // 完全一致
                } else {
                    return $query->where('text', 'LIKE', "%{$text}%");  // 部分一致
                }
            })
            ->when($gender, function ($query, $gender) {
                return $query->where('gender', 'LIKE', "%{$gender}%");
            })
            ->when($content, function ($query, $content) {
                return $query->where('content', 'LIKE', "%{$content}%");
            })
            ->when($created_at, function ($query, $created_at) {
                return $query->whereDate('created_at', $created_at);
            })
            ->paginate(7);


        // 結果をビューに返す
        return view('admin', ['contacts' => $contacts]);
    }
    // 削除機能の実装
    public function destroy(ContactRequest $request)
    {
        contact::find($request->id)->delete();

        return redirect('/admin');
    }
}
