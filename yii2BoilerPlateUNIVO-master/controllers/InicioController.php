<?php
namespace app\controllers;
use Yii;
use yii\web\Controller;
use app\models\InicioModels;
use DateTime;


class  InicioController extends Controller
{
    public function actionIndex()
{
    $titulo = 'Yes it is!';
    $h2 = 'Hola';
    $datetime = new DateTime();

    return $this -> render('index', 
[

    'titulo' => $titulo,
    'subtitulo' => $h2,
    'datetime' => $datetime,

]
    
);
}
public function actionSuma()
{
$model = new InicioModels();

if ($model-> load (Yii:: $app-> request-> post ()) && $model -> validate()){
    $total = $model -> valor_a + $model -> valor_b;
    $respuesta = ("El resultado es: ". $total);
    
    return $this -> render('suma', 
[


    'model' => $model,
    'respuesta' =>$respuesta
    

]
    
);
   

    
}

return $this -> render('suma', 
[


    'model' => $model,
    

]
    
);
}
}
