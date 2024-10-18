<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Contact;
use App\Models\Category;
use Symfony\Component\HttpFoundation\StreamedResponse;

class UserExportController extends Controller
{
    public function export()
    {

        // ストリーミングレスポンスを使ってCSVを生成
        $response = new StreamedResponse(function () {
            // 出力用バッファを開く
            $handle = fopen('php://output', 'w');
            fputs($handle, "\xEF\xBB\xBF"); // UTF-8 BOMを追加

            // CSVのヘッダー行を作成
            fputcsv($handle, [
                'お名前',
                '性別',
                'メールアドレス',
                'お問い合わせ種類',
                '作成日'
            ]);

            // ユーザーデータとお問い合わせ種類をデータデータベースから取得してCSVに書き込む
            Contact::with('category')->chunk(200, function ($contacts) use ($handle) {
                foreach ($contacts as $contact) {
                    foreach ($contact->categories as $category) {
                        fputcsv($handle, [
                            $contact->name,
                            $contact->gender,
                            $contact->email,
                            $category->content,
                            $contact->created_at->format('Y-m-d H:i:s'),
                        ]);
                    }
                }
            });


            // 出力用バッファを閉じる
            fclose($handle);
        });

        // HTTPレスポンスヘッダーを設定してCSVファイルのダウンロードを指定
        $response->headers->set('Content-Type', 'text/csv; charset=UTF-8');
        $response->headers->set('Content-Disposition', 'attachment; filename="users_orders.csv"');
        $response->headers->set('Cache-Control', 'no-store, no-cache, must-revalidate');
        $response->headers->set('Pragma', 'no-cache');
        $response->headers->set('Expires', '0');

        return $response;
    }
}
