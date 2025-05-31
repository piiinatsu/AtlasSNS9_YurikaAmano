<?php

return [

    // 共通ルール
    'required' => ':attributeは必須項目です。',
    'string' => ':attributeは文字列で入力してください。',
    'min' => [
        'string' => ':attributeは:min文字以上で入力してください。',
    ],
    'max' => [
        'string' => ':attributeは:max文字以内で入力してください。',
    ],
    'email' => ':attributeの形式が正しくありません。',
    'unique' => 'この:attributeはすでに使用されています。',
    'confirmed' => ':attributeと確認用入力が一致しません。',
    'alpha_num' => ':attributeは英数字のみで入力してください。',
    'image' => ':attributeは画像ファイルでなければなりません。',
    'mimes' => ':attributeは:values形式のファイルでなければなりません。',

    // フィールド名の日本語化
    'attributes' => [
        'username' => 'ユーザー名',
        'email' => 'メールアドレス',
        'password' => 'パスワード',
        'password_confirmation' => 'パスワード（確認用）',
        'newPassword' => 'パスワード',
        'new_password' => '新しいパスワード',
        'new_password_confirmation' => '新しいパスワード（確認用）',
        'post' => 'つぶやき',
        'bio' => '自己紹介文',
        'icon_image' => 'アイコン画像',
    ],
];
