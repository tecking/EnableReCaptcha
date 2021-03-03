<?php
/**
 * [Enable reCAPTCHA v3] reCAPTCHA v3 拡張 コントローラーイベントリスナー
 *
 * @copyright  Copyright 2021 - , tecking
 * @link       https://github.com/tecking
 * @package    tecking.bcplugins.enable_re_captcha
 * @since      baserCMS v 4.3.7.1
 * @version    0.2.0
 * @license    MIT License
 */
class EnableReCaptchaControllerEventListener extends BcControllerEventListener {

	public $events = ['Mail.Mail.beforeRender'];

	public function mailMailBeforeRender(CakeEvent $event) {
		$Controller = $event->subject;

		$Model = ClassRegistry::init('EnableReCaptcha.EnableReCaptchaConfig');
		$row = $Model->find('first');

		if ($Controller->name === 'Mail' && $Controller->request->params['action'] === 'confirm') {

			if ($row['EnableReCaptchaConfig']['error_message'] !== '') {
				$errorMessage = $row['EnableReCaptchaConfig']['error_message'];
			} else {
				$errorMessage = '何らかの理由でメールが送信できませんでした。';
			}

			$verifyResponse = file_get_contents('https://www.google.com/recaptcha/api/siteverify?secret=' . $row['EnableReCaptchaConfig']['secret_key'] . '&response=' . $Controller->request->data['MailMessage']['reCaptchaResponse']);
			
			$reCaptcha = json_decode($verifyResponse);
			if ($reCaptcha->success) {
				$Controller->set('siteKey', $row['EnableReCaptchaConfig']['site_key']);
			} else {
				$Controller->BcMessage->setError(h($errorMessage));
				$Controller->set('reCaptcha', $reCaptcha->success);
			}
		}

	}

}
