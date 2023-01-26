<?php

namespace app\controllers;

use app\models\Cart;
use app\models\Product;
use app\models\CartSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * CartController implements the CRUD actions for Cart model.
 */
class CartController extends Controller
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
     * Lists all Cart models.
     *
     * @return string
     */

    public function actionIndex()
    {
        $searchModel = new CartSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Cart model.
     * @param int $id_cart Id Cart
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id_cart)
    {
        return $this->render('view', [
            'model' => $this->findModel($id_cart),
        ]);
    }

    /**
     * Creates a new Cart model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    /*public function actionCreate()
    {
        $model = new Cart();

        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->save()) {
                return $this->redirect(['view', 'id_cart' => $model->id_cart]);
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }
*/


    public function actionCreate(){
        $product_id = \Yii::$app->request->post('product_id');
        $items=\Yii::$app->request->post('count');
        $product = Product::findOne($product_id);
        if (!$product) return false;
        if ($product->count > 0) {
            $product->count -= $items;
            $product->save(false);
            $model = cart::find()->where(['user_id' => \Yii::$app->user->identity->id_user])->andWhere(['product_id' => $product_id])->one();
         if ($model) {
             $model->count += $items;
             $model->save();
             return $product->count;
         }
         $model = new cart();
         $model->user_id = \Yii::$app->user->identity->id_user;
         $model->product_id = $product->id_tovar;
         $model->count = $items;
         if ($model->save(false)) return $product->count;
         }
                return 'false';
            }
    public function beforeAction($action){
        if ($action->id=='create') $this->enableCsrfValidation=false;
        return parent::beforeAction($action);
    }
    /**
     * Updates an existing Cart model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id_cart Id Cart
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id_cart)
    {
        $model = $this->findModel($id_cart);

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id_cart' => $model->id_cart]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Cart model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id_cart Id Cart
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id_cart)
    {
        $this->findModel($id_cart)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Cart model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id_cart Id Cart
     * @return Cart the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id_cart)
    {
        if (($model = Cart::findOne(['id_cart' => $id_cart])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
