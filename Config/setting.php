<?php
/**
 * [Enable reCAPTCHA v3] reCAPTCHA v3 拡張 設定ファイル
 *
 * @copyright  Copyright 2021 - , tecking
 * @link       https://github.com/tecking
 * @package    tecking.bcplugins.enable_re_captcha
 * @since      baserCMS v 4.3.7.1
 * @version    0.6.2
 * @license    MIT License
 */
$config = [
		'EnableReCaptcha' => [
			'threshold' => 0.5, // スパム bot と判定するスコアのしきい値
			'encryptionMethod' => 'aes-256-ecb' // サイトシークレットを保存する際の暗号化メソッド
		]
	];