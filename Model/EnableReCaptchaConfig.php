<?php
/**
 * [Enable reCAPTCHA v3] reCAPTCHA v3 拡張 モデル
 *
 * @copyright  Copyright 2021 - , tecking
 * @link       https://github.com/tecking
 * @package    tecking.bcplugins.enable_re_captcha
 * @since      baserCMS v 4.3.7.1
 * @version    0.6.1
 * @license    MIT License
 */
class EnableReCaptchaConfig extends AppModel {

	/**
	 * クラス
	 *
	 * @var string
	 */
	public $name = 'EnableReCaptchaConfig';

	/**
	 * プラグイン
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

	/**
	 * 暗号化するフィールド
	 *
	 * @var string
	 */
	private $encryptedField = 'secret_key';

	/**
	 * beforeSave
	 *
	 * @param array $options
	 * @return void
	 */
	public function beforeSave($options = []) {

		if (!empty($this->data[$this->alias][$this->encryptedField])) {

			$this->data[$this->alias][$this->encryptedField] = openssl_encrypt($this->data[$this->alias][$this->encryptedField], Configure::read('EnableReCaptcha.encryptionMethod'), Configure::read('Security.cipherSeed'));

		}

		return true;

	}

	/**
	 * afterFind
	 *
	 * @param [array] $results
	 * @param boolean $primary
	 * @return void
	 */
	public function afterFind($results, $primary = false) {

		foreach ($results as $key => $value) {

			if (@is_array($results[$key][$this->alias])) {

				$results[$key][$this->alias][$this->encryptedField] = openssl_decrypt($results[$key][$this->alias][$this->encryptedField], Configure::read('EnableReCaptcha.encryptionMethod'), Configure::read('Security.cipherSeed'));

			}

		}

		return $results;

	}

}