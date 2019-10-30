<?php
namespace app\components;

use dosamigos\ckeditor\CKEditor;
use kartik\select2\Select2;
use yii\helpers\Html;

/**
 * Class khusus untuk membuat form sederhana tanpa melibatkan active record sama sekali
 * Class sederhana untuk mengenerate form berdasarkan data yang diberikan
 * oleh array. umumnya dipakai buat generate Lookup (Global Configuration)
 */
class PlainFormHelper
{
	public static function text($name, $value, $extra, $options=[])
	{
		$string = Html::textInput($name, $value, $options);
		
		$hint = isset($extra['params']['hint']) && !empty($extra['params']['hint'])? $extra['params']['hint']:'';
		if($hint){
			$string .= '<small>'.$hint.'</small>';
		}
		return $string;
	}
	
	public static function hidden($name, $value, $extra, $options=[])
	{
		return Html::hiddenInput($name, $value, $options);
	}
	
	
	public static function textarea($name, $value, $extra, $options=[])
	{
		$string = Html::textarea($name, $value, $options);
		
		$hint = isset($extra['params']['hint']) && !empty($extra['params']['hint'])? $extra['params']['hint']:'';
		if($hint){
			$string .= '<small>'.$hint.'</small>';
		}
		
		return $string;
	}
	
	public static function checkbox($name, $value, $extra, $options=[])
	{
		return Html::checkbox($name, $value==$options['value'], $options);
	}
	
	/**
	 * Menampilkan file Field
	 * @param type $form
	 * @param type $name
	 * @param type $model
	 * @param type $extra paramater yang ada di formFields
	 * @param type $options
	 * @return type
	 */
	public static function file($name, $value, $extra, $options=[])
	{
		//Kalau file readonly, maka tampilkan saja konten file-nya.
		$content = '';
		if(!empty($value)){
			if(isset($extra['params']['isImage']) && $extra['params']['isImage']){
				$content = '<img style="max-width:100px;max-height:80px" class="form-image" src="'.$value.'" />';
			}else{
				$content = $value;
			}
			$content = '<br/>'.$content;
		}
		
		$string = Html::fileInput($name, null, $options).$content;
		$hint = isset($extra['params']['hint']) && !empty($extra['params']['hint'])? $extra['params']['hint']:'';
		if($hint){
			$string .= '<small>'.$hint.'</small>';
		}
		
		return $string;
	}
	
	public static function datepicker($name, $value, $extra, $options=[])
	{
		$defaultOptions = [
			'options' => [
				'class' => 'form-control'
				],
			'dateFormat' => 'yyyy-MM-dd',
		];
		
		//Timpa option yang dikasih ke default options. 
		//kalau ada field yang sama-sama ada, maka $options yang dipakai
		$finalOptions = $options + $defaultOptions ;
		
		$string =  \yii\jui\DatePicker::widget([
			'name'  => $name,
			'value'  => $value,
			'dateFormat' => 'yyyy-MM-dd',
			'options'=>$finalOptions,
		]);
		
		$hint = isset($extra['params']['hint']) && !empty($extra['params']['hint'])? $extra['params']['hint']:'';
		if($hint){
			$string .= '<small>'.$hint.'</small>';
		}
		return $string;
	}
	
	public static function richtext($name, $value, $extra, $options=[])
	{
		//kalau readonly, maka jangan richtext, melainkan, tampilkan kontennya.
		if(isset($options['readonly'])){
			$content = '<div class="form-richtext">'. $model->$name.'</div>';
			return '<div class="form-group"><label>'.$model->attributeLabels()[$name].'</label><br/>'.$content.'</div>';
		}
		
		$defaultOptions = [
			'options' => ['rows' => 6],
			'preset' => 'standard'
		];
		
		//Timpa option yang dikasih ke default options. 
		//kalau ada field yang sama-sama ada, maka $options yang dipakai
		$finalOptions = $options + $defaultOptions ;
		
		$string = CKEditor::widget([
			'name'=>$name,
			'value'=>$value,
			'options'=>$finalOptions
		]);
		$hint = isset($extra['params']['hint']) && !empty($extra['params']['hint'])? $extra['params']['hint']:'';
		if($hint){
			$string .= '<small>'.$hint.'</small>';
		}
		return $string;
	}
	
	public static function select($name, $value, $extra, $options=[])
	{
		//Kalau readonly, maka dropdown pakai dropdown biasa saja
		if(isset($options['readonly'])){
			unset($options['readonly']);
			$options['disabled'] = 'disabled';
			return Html::dropDownList($name, $value, $options['data'], $finalOptions);
		}
		
		
		//Dropdown biasa
		$defaultOptions = [
			'size' => Select2::MEDIUM,
		];
		
		//Timpa option yang dikasih ke default options. 
		//kalau ada field yang sama-sama ada, maka $options yang dipakai
		$finalOptions = $options + $defaultOptions ;
		
		$string = Html::dropDownList($name, $value, $options['data'], $finalOptions);
		
		$hint = isset($extra['params']['hint']) && !empty($extra['params']['hint'])? $extra['params']['hint']:'';
		if($hint){
			$string .= '<br/><small>'.$hint.'</small>';
		}
		return $string;
	}
	
	/**
	 * Menampilkan fungsi render field sesuai dengan data yang dilempar oleh
	 * formFields() dari PostController
	 * @param type $field
	 */
	public static function render($field, $value, $options=[])
	{
		$functionName = $field['type'];
		switch($functionName){
			case 'file':
				return call_user_func( array('\app\components\PlainFormHelper', $functionName), $field['name'], $value, $field, $options);
				
			case 'select':
//				var_dump($field);die();
				$data = $field['params']['data'];
				$options['data'] = $data;
				return call_user_func( array('\app\components\PlainFormHelper', $functionName), $field['name'], $value, $field, $options);
				
			default:
				$options['class']='form-control';
				return call_user_func( array('\app\components\PlainFormHelper', $functionName), $field['name'], $value, $field, $options);
		}
		
	}
}
