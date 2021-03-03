# Enable reCAPTCHA v3（reCAPTCHA v3 拡張）

## これは何?

[baserCMS](https://basercms.net/) で動作するウェブサイトに reCAPTCHA v3 を組み込むためのプラグインです。

## インストール方法

git clone または ZIP ファイルをダウンロードして /app/Plugin ディレクトリ内に配置してください。ZIP ファイルの場合 EnableReCaptcha-master というフォルダ名で展開されるので、あらかじめ EnableReCaptcha とリネームする必要があります。

インストール後、プラグイン管理画面で『reCAPTCHA v3 拡張』プラグインを有効化してください。

## 使い方

プラグイン利用前に、[reCAPTCHA v3 のサイト](https://developers.google.com/recaptcha/docs/v3)でサイトキーとシークレットキーを取得しておいてください。

キーが取得できたら、プラグイン設定画面の「サイトキー」「シークレットキー」欄に入力して保存します。これで、フロント側の全ページで reCAPTCHA v3 が有効化されます。

このほか、プラグイン設定画面では下記の2項目も設定可能です。

* エラーメッセージ  
reCAPTCHA が不審なメール送信を判定したときに表示するメッセージを設定できます。設定値が空白の時は「何らかの理由でメールが送信できませんでした。」と表示されます。
* バッジ表示設定  
reCAPTCHA 有効時に画面右下に表示されるバッジ（アイコン）の表示 / 非表示を選択できます。バッジを非表示にするときは、[Google の規定](https://developers.google.com/recaptcha/docs/faq#id-like-to-hide-the-recaptcha-badge.-what-is-allowed)に沿ってサイト内にリンク文字列を記述する必要があります。

## 更新履歴

* 0.2.0 ( 2021-03-03 )
	* 公開
