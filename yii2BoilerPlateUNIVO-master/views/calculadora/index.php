<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->title = 'Calculadora Mejorada';
?>

<div class="container mt-5">
    <h1 class="text-center"><?= Html::encode($this->title) ?></h1>

    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header text-white bg-dark">
                    <h4>Operaciones Matemáticas</h4>
                </div>
                <div class="card-body">
                    <?php $form = ActiveForm::begin(['id' => 'calculadora-form']); ?>

                    <?= $form->field($model, 'numero1')->textInput(['placeholder' => 'Ingrese el primer número'])->label('Número 1') ?>

                    <?= $form->field($model, 'numero2')->textInput(['placeholder' => 'Ingrese el segundo número'])->label('Número 2') ?>

                    <?= $form->field($model, 'operacion')->radioList([
    '+' => ' Suma  ',
    '-' => ' Resta  ',
    '*' => ' Multiplicación  ',
    '/' => ' División  ',
], [
    'itemOptions' => [
        'class' => 'form-check-input', 
        'style' => 'margin-bottom: 10px; margin-right: 10px;'
    ],
    'separator' => '<br>', 
])->label('Operación') ?>


                    <div class="form-group" style="margin-top: 60px;">
                        <?= Html::submitButton('Calcular', ['class' => 'btn btn-success btn-block']) ?>
                    </div>

                    <?php ActiveForm::end(); ?>

                    <?php if ($model->resultado !== null): ?>
                        <div class="alert alert-info text-center">
                            <strong>Resultado:</strong> <?= Html::encode($model->resultado) ?>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>
