@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/admin.css') }}">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/css/bootstrap.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>
@endsection

@section('content')

<form action="/admin" method="get">
  @csrf
  <div class="search-form__item">
    <form action="admin/search" method="GET">
      @csrf
      <input type="text" name="text" placeholder="名前やメールアドレスを入力してください">
      <select class="create-form__item-select" name="gender" id="gender">
        <option value="">性別</option>
        <option value="全て">全て</option>
        <option value="男性">男性</option>
        <option value="女性">女性</option>
        <option value="その他">その他</option>
      </select>
      <select class="create-form__item-select" name="content" id="content">
        <option value="">お問い合わせの種類</option>
        <option value="商品のお届けについて">商品のお届けについて</option>
        <option value="商品の交換について">商品の交換について</option>
        <option value="商品トラブル">商品トラブル</option>
        <option value="ショップへのお問い合わせ">ショップへのお問い合わせ</option>
        <option value="その他">その他</option>
      </select>
      <input type="date" name="created_at">
    </form>
    <div class="search-form__button">
      <button class="search-form__button-submit" type="submit">検索</button>
    </div>
    <div class="reset-form__button">
      <button type="reset">リセット</button> <!-- リセットボタン -->
    </div>
  </div>
</form>

<a href="{{ route('admin.users.export') }}" class="btn btn-primary">
  エクスポート
</a>
<!-- ページネーション用のリンクボタン -->
<div class="paginate">
  {{ $contacts ->links() }}
</div>
</div>
<div class="contacts">
  <table class="contacts__table">
    <tr class="table-heading">
      <th class="column">お名前</th>
      <th class="column">性別</th>
      <th class="column">メールアドレス</th>
      <th class="column" colspan="2">お問い合わせ種類</th>
    </tr>
    @foreach($contacts as $contact)
    <tr class="table-inner">
      <td class="name">
        {{ $contact['first_name'] }}
        <span class="space"></span>
        <span class="first">{{ $contact['last_name'] }}</span>
      </td>
      <td class="gender">{{ $contact['gender'] }}
      </td>
      <td class="address">
        {{ $contact['email']}}
      </td>
      <td class="category">
        {{ $contact['category']['content']}}
      </td>
      <td class="detail-button">
        <div class="modal-wata__wrap">
          <input type="radio" id="modal-wata__open" class="modal-wata__open-input" name="modal-wata__trigger" />
          <label for="modal-wata__open" class="modal-wata__open-label">詳細</label>
          <input type="radio" id="modal-wata__close" name="modal-wata__trigger" />
          <div class="modal-wata">
            <div class="modal-wata__content-wrap">
              <label for="modal-wata__close" class="modal-wata__close-label">×
              </label>
              <table class="modal__content">
                <tr class="modal-inner">
                  <th class="modal-ttl">お名前</th>
                  <td class="modal-data">
                    {{ $contact['fist_name'] }}
                    <span class="space"></span>
                    <span class="firstName">{{ $contact['last_name'] }}</span>
                  </td>
                </tr>
                <tr class="modal-inner">
                  <th class="modal-ttl">性別</th>
                  <td class="modal-data">{{ $contact['gender'] }}
                  </td>
                </tr>
                <tr class="modal-inner">
                  <th class="modal-ttl">メールアドレス</th>
                  <td class="modal-data">{{ $contact['email'] }}</td>
                </tr>
                <tr class="modal-inner">
                  <th class="modal-ttl">電話番号</th>
                  <td class="modal-data">{{ $contact['tel'] }}</td>
                </tr>
                <tr class="modal-inner">
                  <th class="modal-ttl">住所</th>
                  <td class="modal-data">{{ $contact['address'] }}</td>
                </tr>
                <tr class="modal-inner">
                  <th class="modal-ttl">建物名</th>
                  <td class="modal-data">{{ $contact['building'] }}</td>
                </tr>
                <tr class="modal-inner">
                  <th class="modal-ttl">お問い合わせの種類</th>
                  <td class="modal-data">{{ $contact['category']['content'] }}</td>
                </tr>
                <tr class="modal-inner">
                  <th class="modal-ttl--last">お問い合わせ内容</th>
                  <td class="modal-data--last">
                    {{ $contact['detail']}}
                  </td>
                </tr>
                <label for="modal-wata__close">
                  <div class="modal-wata__background"></div>
                </label>
                <form class="delete-form" action="contact/delete" method="post">
                  @method('delete')
                  @csrf
                  <div class="delete-form__button">
                    <input type="hidden" name="id" value="{{ $contact['id'] }}" />
                    <button class="delete-btn">削除</button>
                  </div>
                </form>
              </table>
            </div>
          </div>
        </div>
      </td>
    </tr>
    @endforeach
  </table>
</div>
@endsection