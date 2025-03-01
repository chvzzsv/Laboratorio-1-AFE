<?php
/* @var $this yii\web\View */
/* @var $model app\models\CalculadoraModels */

use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->title = 'Calculadora'; // Título de la página
?>

<div class="content">
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header bg-primary text-white">
                        <h3 class="card-title">Calculadora</h3><!-- Encabezado del formulario -->
                    </div>
                    <div class="card-body">
                        <?php $form = ActiveForm::begin([
                            'id' => 'calculadora-form',
                            'options' => ['class' => 'form-horizontal'],// Clase CSS para el formulario
                        ]); ?>

                        <div class="form-group">
                            <?= $form->field($model, 'numero1')->textInput(['class' => 'form-control', 'placeholder' => 'Número 1'])->label(false) ?>
                        </div>

                        <div class="form-group">
                            <?= $form->field($model, 'numero2')->textInput(['class' => 'form-control', 'placeholder' => 'Número 2'])->label(false) ?>
                        </div>

                        <div class="form-group">
                            <?= $form->field($model, 'operacion')->dropDownList([// genera un menú desplegable
                                'suma' => 'Suma',
                                'resta' => 'Resta',
                                'multiplicacion' => 'Multiplicación',
                                'division' => 'División',
                            ], ['class' => 'form-control'])->label(false) ?>
                        </div>

                        <div class="form-group">
                            <?= Html::submitButton('Calcular', ['class' => 'btn btn-primary btn-block']) ?>
                        </div>

                        <?php ActiveForm::end(); ?>

                        <?php if (isset($model->resultado)): // Verifica si existe un resultado ?>
                            <div class="alert alert-success">
                                <strong>Resultado:</strong> <?= Html::encode($model->resultado) // Muestra el resultado ?>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
