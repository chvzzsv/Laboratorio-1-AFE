<?php

namespace app\controllers;

use yii\web\Controller;
use app\models\ModelsCalculadora;

class CalculadoraController extends Controller
{
    public function actionIndex()
    {
        $model = new ModelsCalculadora();

        if ($model->load(\Yii::$app->request->post()) && $model->calcular()) {
            return $this->render('index', ['model' => $model]);
        }

        return $this->render('index', ['model' => $model]);
    }
}
