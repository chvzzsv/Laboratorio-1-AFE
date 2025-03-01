<?php

namespace app\controllers;

use Yii;
use yii\data\SqlDataProvider;
use app\models\Tasks;
use app\models\TasksSearch;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

class TasksController extends Controller
{
    public function behaviors()
    {
        return array_merge(
            parent::behaviors(),
            [
                'verbs' => [
                    'class' => VerbFilter::className(),
                    'actions' => [
                        'delete' => ['POST'],
                    ],
                ],
            ]
        );
    }

    public function actionIndex()
    {
        // Filtro y búsqueda con TasksSearch
        $searchModel = new TasksSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        // Filtro adicional
        $dataProvider->query->where(['status' => 1]);
        $dataProvider->pagination->pageSize = 5;

        // Configuración de SqlDataProvider
        $count = Yii::$app->db->createCommand('SELECT COUNT(*) FROM tasks WHERE status = :status')
            ->bindValue(':status', 1)
            ->queryScalar();

        $taskDP = new SqlDataProvider([
            'sql' => 'SELECT * FROM tasks WHERE status = :status',
            'params' => [':status' => 1],
            'key' => 'id_task',
            'totalCount' => $count,
            'pagination' => [
                'pageSize' => 5, // Corregido de 'pagiSize'
            ],
        ]);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'taskDP' => $taskDP, // Si deseas renderizar ambos
        ]);
    }

    public function actionView($id_task)
    {
        return $this->render('view', [
            'model' => $this->findModel($id_task),
        ]);
    }

    public function actionCreate()
    {
        $model = new Tasks();

        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->save()) {
                return $this->redirect(['view', 'id_task' => $model->id_task]);
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    public function actionUpdate($id_task)
    {
        $model = $this->findModel($id_task);

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id_task' => $model->id_task]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    public function actionDelete($id_task)
    {
        $this->findModel($id_task)->delete();

        return $this->redirect(['index']);
    }

    protected function findModel($id_task)
    {
        if (($model = Tasks::findOne(['id_task' => $id_task])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
