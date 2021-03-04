<?php
/**
 * [Enable reCAPTCHA v3] reCAPTCHA v3 拡張 ヘルパーイベントリスナー
 *
 * @copyright  Copyright 2021 - , tecking
 * @link       https://github.com/tecking
 * @package    tecking.bcplugins.enable_re_captcha
 * @since      baserCMS v 4.3.7.1
 * @version    0.2.1
 * @license    MIT License
 */
class EnableReCaptchaHelperEventListener extends BcHelperEventListener {

	/**
	 * イベント
	 *
	 * @var array
	 */
	public $events = ['Form.beforeEnd'];
	
	/**
	 * ヘルパー
	 */
	public function formBeforeEnd(CakeEvent $event) {

		if (BcUtil::isAdminSystem()) {
			return;
		}

		$View = $event->subject;

		if ($View->plugin !== 'Mail') {
			return;
		}

		$View->Mailform->unlockField('MailMessage.reCaptchaResponse');
		echo $View->Mailform->hidden('MailMessage.reCaptchaResponse');

	}

}