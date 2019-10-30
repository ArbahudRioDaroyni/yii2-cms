<?php
namespace app\components;

use app\components\widgets\CKEditor;
use kartik\select2\Select2;
/**
 * Class khusus untuk membantu PostController
 * Class sederhana untuk mengenerate form berdasarkan data yang diberikan
 * oleh PostController bagian formFields()
 */
class FormHelper
{
	public static function text($form, $name, $model, $field, $options=[])
	{
		$hint = isset($field['hint']) && !empty($field['hint'])? $field['hint']:'';
		return $form->field($model, $name)->textInput($options)->hint($hint);
	}
	
	public static function hidden($form, $name, $model, $field, $options=[])
	{
		$input = $form->field($model, $name);
		$input->template = '{input}';
		$input->options['tag'] = false;
		return $input->hiddenInput($options);
	}
	
	
	public static function textarea($form, $name, $model, $field, $options=[])
	{
		$hint = isset($field['hint']) && !empty($field['hint'])? $field['hint']:'';
		return $form->field($model, $name)->textarea($options)->hint($hint);
	}
	
	public static function checkbox($form, $name, $model, $field, $options=[])
	{
		$hint = isset($field['hint']) && !empty($field['hint'])? $field['hint']:'';
		return $form->field($model, $name)->checkbox($options)->hint($hint);
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
	public static function file($form, $name, $model, $extra, $options=[])
	{
		//Kalau file readonly, maka tampilkan saja konten file-nya.
		if(isset($options['readonly'])){
			if($extra['isImage']){
				$content = '<img class="form-image" src="'.$model->$name.'" />';
			}else{
				$content = '<a href="'.$model->$name.'" target="_blank">'.$model->$name.'</a>';
			}
			
			return '<div class="form-group"><label>'.$model->attributeLabels()[$name].'</label><br/>'.$content.'</div>';
		}
		
		$content ='';
		if(!empty($model->$name)){
			if($extra['isImage']){
				$content = '<img class="form-image" src="'.$model->$name.'" />';
			}else{
				$content = $model->$name;
			}
		}
		
		$hint = isset($extra['hint']) && !empty($extra['hint'])? $extra['hint']:'';
		$fileField = $form->field($model, $name)->fileInput($options)->hint($hint);
		
		if($model->$name){
			$deleteButton = '<a href="#" class="delete-img btn btn-danger">Hapus Gambar</a>';
		}else{
			$deleteButton = '';
		}

		$uniqid = uniqid();
		
		//Register script ke bawah
		\Yii::$app->view->registerJs('jQuery("#'.$uniqid.' a.delete-img").click(function(){
					var obj = jQuery(this);
					jQuery.post("'.\yii\helpers\Url::to(['delete-image']).'", 
						{"value":"'.$model->id.'", "model":"'.str_replace('\\','\\\\',$model::classname()).'", "field":"'.$name.'"}, 
						function(data){
							obj.siblings(".content").html("");
						});
						
						return false;
				});', \yii\web\View::POS_END, $uniqid);
		
		return "<div class='filefield' id='$uniqid'> 
					$fileField 
					<span class='content'>$content</span> 
					&nbsp;
					$deleteButton 
				</div>
				<br/><br/>";
	}
	
	public static function datepicker($form, $name, $model, $field, $options=[])
	{

		if(isset($options['readonly'])){
			return $form->field($model, $name)->textInput($options);
		}


		$defaultOptions = [
			'options' => [
				'class' => 'form-control'
				],
			'dateFormat' => 'yyyy-MM-dd',
		];
		
		//Timpa option yang dikasih ke default options. 
		//kalau ada field yang sama-sama ada, maka $options yang dipakai
		$finalOptions = $options + $defaultOptions ;
		
		return $form->field($model, $name)->widget(\yii\jui\DatePicker::classname(), $finalOptions);
	}
	
	public static function richtext($form, $name, $model, $field, $options=[])
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
		
		$hint = isset($field['hint']) && !empty($field['hint'])? $field['hint']:'';
		return $form->field($model, $name)->hint($hint)->widget(CKEditor::className(), $finalOptions);
	}
	
	public static function select($form, $name, $model, $field, $options=[])
	{
		//Kalau readonly, maka dropdown pakai dropdown biasa saja
		if(isset($options['readonly'])){
			unset($options['readonly']);
			$options['disabled'] = 'disabled';
			return $form->field($model, $name)->dropDownList($field['data'], $options);
		}
		
		
		//Dropdown biasa
		$defaultOptions = [
			'size' => Select2::MEDIUM,
		];
		
		//Timpa option yang dikasih ke default options. 
		//kalau ada field yang sama-sama ada, maka $options yang dipakai
		$options['data'] = $field['data'];
		$finalOptions = $options + $defaultOptions ;
		
		$hint = isset($field['hint']) && !empty($field['hint'])? $field['hint']:'';
		return $form->field($model, $name)->hint($hint)->widget(Select2::className(),$finalOptions);
	}
	
	/**
	 * Menampilkan fungsi render field sesuai dengan data yang dilempar oleh
	 * formFields() dari PostController
	 * @param type $field
	 */
	public static function render($field, $form, $model, $options=[])
	{
        //Kalau tidak diset tipe
		if(!isset($field['type'])){
			$field['type'] = 'text';
		}

		$functionName = $field['type'];
		
		//Utamakan option yang ada di parameter, baru option yang dilempar via fields.
		$mergedOptions = $options + (isset($field['options'])? $field['options']: []);
		
		return call_user_func( array('\app\components\FormHelper', $functionName), $form, $field['name'], $model, $field, $mergedOptions);
		
	}

}
