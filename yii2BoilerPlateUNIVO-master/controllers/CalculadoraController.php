<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use app\models\CalculadoraModels;

class CalculadoraController extends Controller
{
    public $layout = 'main'; // Esto asegura que uses el layout principal
      /**
     * Acción principal para renderizar la calculadora.
     */
    public function actionIndex()
    {
        $model = new CalculadoraModels();// Instancia del modelo

        if ($model->load(Yii::$app->request->post()) && $model->calcular()) {
            // Carga los datos enviados por el formulario y valida los datos
            return $this->render('index', [
                'model' => $model,
            ]);
        }
 // Renderiza la vista 'index' y pasa el modelo a la vista
        return $this->render('index', [
            'model' => $model,
        ]);
    }
}
