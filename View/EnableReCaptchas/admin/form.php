<?php
/**
 * [Enable reCAPTCHA v3] reCAPTCHA v3 拡張 ビュー
 *
 * @copyright  Copyright 2021 - , tecking
 * @link       https://github.com/tecking
 * @package    tecking.bcplugins.enable_re_captcha
 * @since      baserCMS v 4.3.7.1
 * @version    0.6.1
 * @license    MIT License
 */
?>
<style>
.alh-description {
	margin-bottom: 10px;
	padding-bottom: 10px;
	border-bottom: 1px solid #eeeeea;
}
</style>
<div class="bca-main__contents clearfix">
	<div class="alh-description">
		<p>設定の前にあらかじめ、<a href="https://developers.google.com/recaptcha/docs/v3" target="_blank">reCAPTCHA v3のサイト</a>でサイトキーとシークレットキーを取得しておいてください。</p>
	</div>
	
	<?php echo $this->BcForm->create('EnableReCaptchaConfig') ?>
	<?php echo $this->BcForm->hidden('EnableReCaptchaConfig.id', ['value' => $this->data['EnableReCaptchaConfig']['id']]) ?>
	<table class="form-table bca-form-table">
		<tr>
			<th class="bca-form-table__label">サイトキー</th>
			<td class="bca-form-table__input"><?php echo $this->BcForm->input('EnableReCaptchaConfig.site_key', ['type' => 'text', 'size' => 50]) ?></td>
		</tr>
		<tr>
			<th class="bca-form-table__label">シークレットキー</th>
			<td class="bca-form-table__input"><?php echo $this->BcForm->input('EnableReCaptchaConfig.secret_key',  ['type' => 'text', 'size' => 50]) ?></td>
		</tr>
		<tr>
			<th class="bca-form-table__label">エラーメッセージ</th>
			<td class="bca-form-table__input"><?php echo $this->BcForm->input('EnableReCaptchaConfig.error_message',  ['type' => 'text', 'size' => 50]) ?><br><small>空白の場合、エラー時には「何らかの理由でメールが送信できませんでした。」と表示されます。</small></td>
		</tr>
		<tr>
			<th class="bca-form-table__label">バッジ表示設定</th>
			<td class="bca-form-table__input"><?php echo $this->BcForm->input('EnableReCaptchaConfig.hide_badge', ['type' => 'checkbox', 'label' =>'reCAPTCHAバッジを非表示にする']) ?><br><small>バッジを非表示にするときは、<a href="https://developers.google.com/recaptcha/docs/faq#id-like-to-hide-the-recaptcha-badge.-what-is-allowed" target="_blank">Googleの規定</a>に沿ってサイト内にリンク文字列を記述する必要があります。</small></td>
		</tr>
	</table>
	<div class="submit bca-actions">
		<?php echo $this->BcForm->button('保存', [
			'type' => 'submit',
			'id' => 'BtnSave',
			'div' => false,
			'class' => 'button bca-btn',
			'data-bca-btn-type' => 'save',
			'data-bca-btn-size' => 'lg',
			'data-bca-btn-width' => 'lg'
		])
		?>
	</div>
	<?php echo $this->BcForm->end() ?>
</div>