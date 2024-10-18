@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/index.css') }}" />
@endsection

@section('content')
@if (session('status'))
<p>{{ session('status') }}</p>
@endif
<div class="contact-form__content">
    <div class="contact-form__heading">
        <h2>Contact</h2>
    </div>
    <form class="form" action="/contacts/confirm" method="post">
        @csrf
        <div class="form__group">
            <div class="form__group-title">
                <span class="form__label--item">お名前</span>
                <span class="form__label--required">※</span>
            </div>
            <div class="form__group-content">
                <div class="form__input--text">
                    <input type="text" name="first_name" placeholder="例:山田" value="{{ old('first_name') }}" />
                    <input type="text" name="last_name" placeholder="例:太郎" value="{{ old('last_name') }}" />
                </div>
            </div>
        </div>
        <div class="form__error">
            <!--バリデーション機能を実装したら記述します。-->
            @error('first_name')
            {{ $message }}
            @enderror
            @error('last_name')
            {{ $message }}
            @enderror
        </div>
        <div class="form__group">
            <div class="form__group-title">
                <span class="form__label--item">性別</span>
                <span class="form__label--required">※</span>
            </div>
            <label>
                <input type="radio" name="gender" value="男性" {{ old('gender') == '男性' ? 'checked' : '' }}checked>
                男性
            </label>
            <label>
                <input type="radio" name="gender" value="女性" {{ old('gender') == '女性' ? 'checked' : '' }}>
                女性
            </label>
            <label>
                <input type="radio" name="gender" value="その他" {{ old('gender') == 'その他' ? 'checked' : '' }}>
                その他
            </label>
            <div class="form__error">
                <!--バリデーション機能を実装したら記述します。-->
                @error('gender')
                {{ $message }}
                @enderror
            </div>
        </div>
        <div class="form__group">
            <div class="form__group-title">
                <span class="form__label--item">メールアドレス</span>
                <span class="form__label--required">※</span>
            </div>
            <div class="form__group-content">
                <div class="form__input--text">
                    <input type="email" name="email" placeholder="例:test@example.com" value="{{ old('email') }}" />
                </div>
                <div class="form__error">
                    <!--バリデーション機能を実装したら記述します。-->
                    @error('email')
                    {{ $message }}
                    @enderror
                </div>
            </div>
        </div>
        <div class="form__group">
            <div class="form__group-title">
                <span class="form__label--item">電話番号</span>
                <span class="form__label--required">※</span>
            </div>
            <div class="form__group-content">
                <div class="form__input--text">
                    <input type="text" name="tel1" placeholder="080" value="{{ old('tel1') }}" />-
                    <input type="text" name="tel2" placeholder="1234" value="{{ old('tel2') }}" />-
                    <input type="text" name="tel3" placeholder="5678" value="{{ old('tel3') }}" />
                </div>
                <div class="form__error">
                    <!--バリデーション機能を実装したら記述します。-->
                    @error('tel')
                    {{ $message }}
                    @enderror
                </div>
            </div>
        </div>
        <div class="form__group">
            <div class="form__group-title">
                <span class="form__label--item">住所</span>
                <span class="form__label--required">※</span>
            </div>
            <div class="form__group-content">
                <div class="form__input--text">
                    <input type="text" name="address" placeholder="例:東京都渋谷区千駄ヶ谷1-2-3" value="{{ old('address') }}" />
                </div>
                <div class="form__error">
                    <!--バリデーション機能を実装したら記述します。-->
                    @error('address')
                    {{ $message }}
                    @enderror
                </div>
            </div>
        </div>
        <div class="form__group">
            <div class="form__group-title">
                <span class="form__label--item">建物</span>
            </div>
            <div class="form__group-content">
                <div class="form__input--text">
                    <input type="text" name="building" placeholder="例:千駄ヶ谷マンション101" value="{{ old('building') }}" />
                </div>
            </div>
        </div>
        <div class="form__group">
            <div class="form__group-title">
                <span class="form__label--item">お問い合わせの種類</span>
                <span class="form__label--required">※</span>
            </div>
            <select class="create-form__item-select" name="content" id="content">
                <option value="">選択してください</option>
                <option value="商品のお届けについて" {{ old('content') == "商品のお届けについて" ? 'selected' : '' }}>商品のお届けについて</option>
                <option value="商品の交換について" {{ old('content') == "商品の交換について" ? 'selected' : '' }}>商品の交換について</option>
                <option value="商品トラブル" {{ old('content') == "商品トラブル" ? 'selected' : '' }}>商品トラブル</option>
                <option value="ショップへのお問い合わせ" {{ old('content') == "ショップへのお問い合わせ" ? 'selected' : '' }}>ショップへのお問い合わせ</option>
                <option value="その他" {{ old('content') == "その他" ? 'selected' : '' }}>その他</option>
            </select>
            <div class="form__error">
                <!--バリデーション機能を実装したら記述します。-->
                @error('content')
                {{ $message }}
                @enderror
            </div>
        </div>
        <div class="form__group">
            <div class="form__group-title">
                <span class="form__label--item">お問い合わせ内容</span>
                <span class="form__label--required">※</span>
            </div>
            <div class="form__group-content">
                <div class="form__input--textarea">
                    <textarea name="detail" placeholder="お問い合わせ内容をご記載ください">{{ old('detail') }}</textarea>
                </div>
                <div class="form__error">
                    <!--バリデーション機能を実装したら記述します。-->
                    @error('detail')
                    {{ $message }}
                    @enderror
                </div>
            </div>
        </div>
        <div class="form__button">
            <button class="form__button-submit" type="submit">確認画面</button>
        </div>
    </form>
</div>
@endsection