<?php
namespace app\components\widgets;

use yii;
use yii\helpers\ArrayHelper;
use iutbay\yii2kcfinder\KCFinderAsset;
use iutbay\yii2kcfinder\KCFinder;

class CKEditor extends \dosamigos\ckeditor\CKEditor
{

	public $enableKCFinder = true;

	/**
	 * Registers CKEditor plugin
	 */
	protected function registerPlugin()
	{
		if ($this->enableKCFinder)
		{
			$this->registerKCFinder();
		}

		parent::registerPlugin();
	}

	/**
	 * Registers KCFinder
	 */
	protected function registerKCFinder()
	{
		$register = KCFinderAsset::register($this->view);
		$kcfinderUrl = $register->baseUrl;

		$browseOptions = [
			'filebrowserBrowseUrl' => $kcfinderUrl . '/browse.php?opener=ckeditor&type=files',
			'filebrowserUploadUrl' => $kcfinderUrl . '/upload.php?opener=ckeditor&type=files',
		];

		$this->clientOptions = ArrayHelper::merge($browseOptions, $this->clientOptions);
	}
	
	public function init()
	{
		//Pengaturan hak akses untuk user secara keseluruhan
		$kcfOptions = array_merge(KCFinder::$kcfDefaultOptions, [
			'uploadURL' => Yii::getAlias('@web') . '/upload',
			'access' => [
				'files' => [
					'upload' => true,
					'delete' => false,
					'copy' => false,
					'move' => false,
					'rename' => false,
				],
				'dirs' => [
					'create' => true,
					'delete' => false,
					'rename' => false,
				],
			],
		]);

		// Set kcfinder session options
		Yii::$app->session->set('KCFINDER', $kcfOptions);
		$this->preset = 'full';	
		parent::init();
	}
}
