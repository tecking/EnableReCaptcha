<?php
/**
 * [Enable reCAPTCHA v3] reCAPTCHA v3 拡張 コントローラーイベントリスナー
 *
 * @copyright  Copyright 2021 - , tecking
 * @link       https://github.com/tecking
 * @package    tecking.bcplugins.enable_re_captcha
 * @since      baserCMS v 4.3.7.1
 * @version    0.5.0
 * @license    MIT License
 */
class EnableReCaptchaControllerEventListener extends BcControllerEventListener {

	/**
	 * イベント
	 *
	 * @var array
	 */
	public $events = ['Mail.Mail.beforeRender'];

	/**
	 * コントローラー
	 *
	 * @param CakeEvent $event
	 * @return void
	 */
	public function mailMailBeforeRender(CakeEvent $event) {
		
		$Controller = $event->subject;

		/**
		 * モデル
		 */
		$Model = ClassRegistry::init('EnableReCaptcha.EnableReCaptchaConfig');
		$row = $Model->find('first');

		/**
		 * メール内容確認画面
		 */
		if ($Controller->name === 'Mail' && $Controller->request->params['action'] === 'confirm') {

			if ($row['EnableReCaptchaConfig']['error_message'] !== '') {
				$errorMessage = $row['EnableReCaptchaConfig']['error_message'];
			} else {
				$errorMessage = '何らかの理由でメールが送信できませんでした。';
			}

			/**
			 * トークン取得
			 */
			$verifyResponse = file_get_contents('https://www.google.com/recaptcha/api/siteverify?secret=' . $row['EnableReCaptchaConfig']['secret_key'] . '&response=' . $Controller->request->data['MailMessage']['reCaptchaResponse']);
			$reCaptcha = json_decode($verifyResponse);

			/**
			 * reCAPTCHA API からのレスポンスが false または、スコアが 0.5 未満なら例外処理とする
			 */
			if ($reCaptcha->success === false || $reCaptcha->score < 0.5) {
				$Controller->Session->delete('Mail');
				throw new BadRequestException(h($errorMessage));
			}

		}

	}

}
