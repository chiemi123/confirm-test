<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ContactRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'gender' => ['required'],
            'email' => ['required', 'string', 'email', 'max:255'],
            'tel1' => ['required', 'digits_between:1,5'],
            'tel2' => ['required', 'digits_between:1,5'],
            'tel3' => ['required', 'digits_between:1,5'],
            'address' => ['required', 'string', 'max:255'],
            'content' => ['required'],
            'detail' => ['required', 'string', 'max:120'],
        ];
    }

    public function messages()
    {
        return [
            'first_name.required' => '姓を入力してください',
            'last_name.required' => '名を入力してください',
            'gender.required' => '性別を選択してください',
            'email.required' => 'メールアドレスを入力してください',
            'email.email' => 'メールアドレスはメール形式を入力してください',
            'tel1.required' => '電話番号を入力してください',
            'tel2.required' => '電話番号を入力してください',
            'tel3.required' => '電話番号を入力してください',
            'tel.numeric' => '電話番号は5桁までの数字で入力してください',
            'address.required' => '住所を入力してください',
            'content.required' => 'お問い合わせの種類を選択してください',
            'detail.required' => 'お問い合わせ内容を入力してください',
        ];
    }

    /**
     * 入力値の整形
     */
    protected function passedValidation()
    {
        // 電話番号の3つのパーツを結合して1つにする
        $this->merge([
            'tel' => $this->tel1 . $this->tel2 . $this->tel3,
        ]);
    }
}
