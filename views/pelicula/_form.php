<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\Pelicula $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="pelicula-form">

    <?php $form = ActiveForm::begin([
        'options' => ['enctype' => 'multipart/form-data']
    ]); ?>

    <?php if($model->portada): ?>
        <div class="from-group">
            <?= Html::label('Imagen Actual') ?>
            <div>
                <?= Html::img(Yii::getAlias('@web' . '/portadas/' . $model->portada, ['style' => 'width: 200px'])) ?>
            </div>

        </div>
    <?php endif; ?>

    <?php //$form->field($model, 'portada')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'imageFile')->fileInput()->label('Seleccionar portada') ?>
    

    <?= $form->field($model, 'titulo')->textInput(['maxlength' => true, 'placeholder'=>'Titulo de la pelicula', 'required'=>true]) ?>
    <?= $form->field($model, 'sinopsis')->textarea(['maxlength' => 255,'placeholder'=>'Escriba aqui la sinopsis...', 'required'=>true]) ?>

    <?= $form->field($model, 'año')->input('number', ['min'=>1900, 'max'=>date('Y')]) 
        ->textInput(['pattern'=>'\d{4}', 'tittle'=>'Debe ser un año de 4 digitos', 'placeholder'=>'YYYY', 'required'=>true]) ?>

    <?= $form->field($model, 'duracion')->input('text') 
            ->textInput(['placeholder'=>'00:00:00', 'pattern'=>'^([0-1]?[0-9]|2[0-3]):[0-5][0-9]:[0-5][0-9]$', 'tittle'=> 'Formato requerido: HH:MM:SS', 'required'=>true]) ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
