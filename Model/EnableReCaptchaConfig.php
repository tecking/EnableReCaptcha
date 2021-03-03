<?php
/**
 * [Enable reCAPTCHA v3] reCAPTCHA v3 拡張 モデル
 *
 * @copyright  Copyright 2021 - , tecking
 * @link       https://github.com/tecking
 * @package    tecking.bcplugins.enable_re_captcha
 * @since      baserCMS v 4.3.7.1
 * @version    0.2.0
 * @license    MIT License
 */
class EnableReCaptchaConfig extends AppModel {

	/**
	 * クラス名
	 *
	 * @var string
	 */
	public $name = 'EnableReCaptchaConfig';

	/**
	 * プラグイン名
	 *
	 * @var string
	 */
	public $plugin = 'EnableReCaptcha';

	/**
	 * データベース接続設定
	 *
	 * @var string
	 */
	public $useDbConfig = 'plugin';

}