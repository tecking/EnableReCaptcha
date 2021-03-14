<?php
/**
 * [Enable reCAPTCHA v3] reCAPTCHA v3 拡張 コントローラー
 *
 * @copyright  Copyright 2021 - , tecking
 * @link       https://github.com/tecking
 * @package    tecking.bcplugins.enable_re_captcha
 * @since      baserCMS v 4.3.7.1
 * @version    0.6.1
 * @license    MIT License
 */
class EnableReCaptchasController extends AppController {

	/**
	 * クラス
	 *
	 * @var string
	 */
	public $name = 'EnableReCaptchas';

	/**
	 * モデル
	 *
	 * @var array
	 */
	public $uses = ['EnableReCaptcha.EnableReCaptchaConfig'];

	/**
	 * コンポーネント
	 *
	 * @var array
	 */
	public $components = ['BcAuth', 'Cookie', 'BcAuthConfigure'];

	/**
	 * beforeFilter
	 *
	 * @return void
	 */
	public function beforeFilter() {

		parent::beforeFilter();
		$this->pageTitle = ('reCAPTCHA v3 拡張 設定');
		
	}

	/**
	 * 設定画面のアクション
	 *
	 * @return void
	 */
	public function admin_form() {

		/**
		 * パンくずリスト
		 */
		$this->crumbs = [
			[
				'name' => 'プラグイン管理',
				'url' => [
					'plugin' => '',
					'controller' => 'plugins',
					'action' => 'index'
				]
			],
			[
				'name' => 'reCAPTCHA v3 拡張 設定',
				'url' => [
					'plugin' => 'enable_re_captcha',
					'controller' => 'enable_re_captchas',
					'action' => 'form'
				]
			]
		];

		/**
		 * データが送信されていなければ、データベースからデータを取得
		 * データが送信されていれば、データベースを更新
		 */
		if (!$this->data) {

			$this->data = $this->EnableReCaptchaConfig->find('first');

		} else {

			$this->EnableReCaptchaConfig->id = $this->data['EnableReCaptchaConfig']['id'];

			if ($this->EnableReCaptchaConfig->save($this->data)) {

				$this->BcMessage->setSuccess('設定を保存しました。');
				$this->redirect([
					'plugin' => 'enable_re_captcha',
					'controller' => 'enable_re_captchas',
					'action' => 'form'
				]);

			} else {

				$this->BcMessage->setError('何らかの理由で保存できませんでした。');

			}
			
		}

	}

}
