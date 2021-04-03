<?php
/**
 * [Enable reCAPTCHA v3] reCAPTCHA v3 拡張 ビューイベントリスナー
 *
 * @copyright  Copyright 2021 - , tecking
 * @link       https://github.com/tecking
 * @package    tecking.bcplugins.enable_re_captcha
 * @since      baserCMS v 4.3.7.1
 * @version    0.6.2
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

		/**
		 * ビュー
		 */
		$View = $event->subject;
		$content = $View->Blocks->get('content');

		/**
		 * モデル
		 */
		$Model = ClassRegistry::init('EnableReCaptcha.EnableReCaptchaConfig');
		$row = $Model->find('first');

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

			$View->BcHtml->scriptBlock('grecaptcha.ready(function () { grecaptcha.execute("' . $row['EnableReCaptchaConfig']['site_key'] . '",{ action: "homepage" }).then(function(token) { let recaptchaResponse = document.getElementById("MailMessageReCaptchaResponse"); if (recaptchaResponse != null) { recaptchaResponse.value = token; } }); });', ['inline' => false]);

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



