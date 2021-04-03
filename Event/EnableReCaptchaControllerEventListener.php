<?php
/**
 * [Enable reCAPTCHA v3] reCAPTCHA v3 拡張 コントローラーイベントリスナー
 *
 * @copyright  Copyright 2021 - , tecking
 * @link       https://github.com/tecking
 * @package    tecking.bcplugins.enable_re_captcha
 * @since      baserCMS v 4.3.7.1
 * @version    0.6.2
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
		 * メール内容確認画面
		 */
		if ($Controller->name === 'Mail' && $Controller->request->params['action'] === 'confirm') {

			/**
			 * モデル
			 */
			$Model = ClassRegistry::init('EnableReCaptcha.EnableReCaptchaConfig');
			$row = $Model->find('first');

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
			 * reCAPTCHA API からのレスポンスが false または、スコアがしきい値 (EnableReCaptcha.threshold) 未満なら例外処理とする
			 */
			if (Configure::read('EnableReCaptcha.threshold')) {

				$threshold = (float) Configure::read('EnableReCaptcha.threshold');

			} else {

				$threshold = 0.5;

			}
			
			if ($reCaptcha->success === false || $reCaptcha->score < $threshold) {

				$Controller->Session->delete('Mail');
				throw new BadRequestException(h($errorMessage));

			}

		}

	}

}
