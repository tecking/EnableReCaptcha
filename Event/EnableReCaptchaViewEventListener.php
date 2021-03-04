<?php
/**
 * [Enable reCAPTCHA v3] reCAPTCHA v3 拡張 ビューイベントリスナー
 *
 * @copyright  Copyright 2021 - , tecking
 * @link       https://github.com/tecking
 * @package    tecking.bcplugins.enable_re_captcha
 * @since      baserCMS v 4.3.7.1
 * @version    0.2.1
 * @license    MIT License
 */
class EnableReCaptchaViewEventListener extends BcViewEventListener {

	/**
	 * イベント
	 *
	 * @var array
	 */
	public $events = ['beforeLayout'];

	/**
	 * ビュー
	 *
	 * @param CakeEvent $event
	 * @return void
	 */
	public function beforeLayout(CakeEvent $event) {

		if (BcUtil::isAdminSystem()) {
			return;
		}
		
		$View = $event->subject;

		$Model = ClassRegistry::init('EnableReCaptcha.EnableReCaptchaConfig');
		$row = $Model->find('first');

		$content = $View->Blocks->get('content');

		/**
		 * エラーの時は flash メッセージ以外の content を削除
		 */
		if (isset($View->viewVars['reCaptcha']) && $View->viewVars['reCaptcha'] === false) {
			preg_match('/<div id="flashMessage" class=".+?">.+?<\/div>/', $content, $flashMsg);
			if (!empty($flashMsg)) {
				$content = $flashMsg[0];
			} else {
				$content = '何らかの理由でメールが送信できませんでした。';
			}
		}

		/**
		 * reCAPTCHA に必要な JavaScript をロード
		 */
		if (!empty($row['EnableReCaptchaConfig']['site_key'])) {

			$View->BcBaser->js(
				[
					'https://www.google.com/recaptcha/api.js?render=' . $row['EnableReCaptchaConfig']['site_key']
				],
				false
			);

			$View->BcHtml->scriptBlock('grecaptcha.ready(function () { grecaptcha.execute("' . $row['EnableReCaptchaConfig']['site_key'] . '",{ action: "homepage" }).then(function(token) { let recaptchaResponse = document.getElementById("MailMessageReCaptchaResponse"); recaptchaResponse.value = token;}); });', ['inline' => false]);

		}

		/**
		 * バッジ非表示設定が true なら CSS をロード
		 */
		if ($row['EnableReCaptchaConfig']['hide_badge'] === true) {
			$View->BcBaser->css('EnableReCaptcha.style', false);
		}

		$View->Blocks->set('content', $content);
		
	}

}



