<?php

namespace app\controllers;

use app\models\Product;
use app\models\ProductSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;

/**
 * ProductController implements the CRUD actions for Product model.
 */
class ProductController extends Controller
{
    /**
     * @inheritDoc
     */
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

    /**
     * Lists all Product models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new ProductSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionCatalog()
    {
        $searchModel = new ProductSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('catalog', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Product model.
     * @param int $id_tovar Id Tovar
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id_tovar)
    {
        return $this->render('view', [
            'model' => $this->findModel($id_tovar),
        ]);
    }

    /**
     * Creates a new Product model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new Product();
        if ($this->request->isPost) {
            $model->load($this->request->post());
            $model->image=UploadedFile::getInstance($model,'image');
            $file_name='/web/productImage/' . \Yii::$app->getSecurity()->generateRandomString(50). '.' . $model->image->extension;
            $model->image->saveAs(\Yii::$app->basePath . $file_name);
            $model->image=$file_name;
            if ($model->save(false)) {
                return $this->redirect(['view', 'id_tovar' => $model->id_tovar]);
            }
        } else {
            $model->loadDefaultValues();
        }
        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Product model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id_tovar Id Tovar
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id_tovar)
    {
        $model = $this->findModel($id_tovar);

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            $model->image=UploadedFile::getInstance($model,'image');
            $file_name='/web/productImage/' . \Yii::$app->getSecurity()->geneateRandomString(50). '.' . $model->image->extension;
            $model->image->saveAs(\Yii::$app->basePath . $file_name);
            $model->image=$file_name;
            $model->save(false);
            return $this->redirect(['view', 'id_tovar' => $model->id_tovar]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Product model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id_tovar Id Tovar
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id_tovar)
    {
        $this->findModel($id_tovar)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Product model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id_tovar Id Tovar
     * @return Product the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id_tovar)
    {
        if (($model = Product::findOne(['id_tovar' => $id_tovar])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
    public function actionProducts() {
        $rows = Product::find()->all();
        return $this->render('products', ['rows'=>$rows]);
    }
}
