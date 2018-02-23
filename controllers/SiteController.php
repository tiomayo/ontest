<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\Response;
use yii\widgets\ActiveForm;
use yii\filters\VerbFilter;
use yii\helpers\ArrayHelper;
use app\models\LoginForm;
use app\models\Users;
use app\models\Jadwal;
use app\models\Soal;
use app\models\Model;
use app\components\AccessRule;

class SiteController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'ruleConfig' => [
                    'class' => AccessRule::className(),
                ],
                'only' => ['index','logout','start','next','tambah-peserta','tambah-soal','view'],
                'rules' => [
                    [
                        'actions' => ['index'],
                        'allow' => true,
                        'roles' => [Users::admin, Users::peserta],
                    ],
                    [
                        'actions' => ['start','next','tambah-peserta','tambah-soal','view'],
                        'allow' => true,
                        'roles' => [Users::admin]
                    ],
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    public function beforeAction($action) {
        date_default_timezone_set('Asia/Jakarta');
        return parent::beforeAction($action);
    }

    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        $this->layout = 'form';
        $isPeserta = Yii::$app->session->get('peserta');

        if (Yii::$app->user->isGuest) {
            $this->redirect(['login']);
        } elseif ($isPeserta) {
            return $this->render('disclaimer');
        } else {
            $dataProvider = new ActiveDataProvider([
                'query' => Jadwal::find(),
            ]);
            return $this->render('index', [
                'dataProvider' => $dataProvider,
            ]);
        }
    }

    /**
     * Login action.
     *
     * @return Response|string
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $this->layout = 'login';
        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post())) {
            $peserta = Users::find()->where(['username' => $_POST['LoginForm']['username'], 'level' => 2])->one();

            if($peserta){
                Yii::$app->session->set('peserta',$peserta->id);
                $jam = Jadwal::find()->where(['id' => $peserta->id_jadwal])->one();
                if (isset($jam) && (date("Y-m-d H:i:s") > $jam->waktu_tes) && (date("Y-m-d H:i:s") < $jam->waktu_selesai)) {
                    $model->login();
                    return $this->goBack();
                } else {
                    Yii::$app->session->destroy();
                    Yii::$app->session->setFlash('eror','Login gagal.');
                    return $this->render('login', ['model' => $model]);
                }
            }

            if($model->login()) {
                return $this->goBack();
            } else {
                Yii::$app->session->destroy();
                return $this->render('login', ['model' => $model]);
            }
        }
        $model->password = '';

        return $this->render('login', [
            'model' => $model,
        ]);
    }

    /**
     * Logout action.
     *
     * @return Response
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    public function actionStart()
    {
        $this->layout='form';
        $jadwal = new Jadwal();
        $peserta = [new Users];

        if ($jadwal->load(Yii::$app->request->post())) {

            $peserta = Model::createMultiple(Users::classname());
            Model::loadMultiple($peserta, Yii::$app->request->post());

            // ajax validation
            if (Yii::$app->request->isAjax) {
                Yii::$app->response->format = Response::FORMAT_JSON;
                return ArrayHelper::merge(
                    ActiveForm::validateMultiple($peserta),
                    ActiveForm::validate($jadwal)
                );
            }

            $transaction = \Yii::$app->db->beginTransaction();
            try {
                if ($flag = $jadwal->save()) {
                    foreach ($peserta as $p) {
                        $p->level = 2;
                        $str = $p->username;
                        $str = substr($str, 0, 10);
                        $str = hash('sha256', $str);
                        $p->password = substr($str, 0,6);
                        $p->id_jadwal = $jadwal->id;
                        if (! ($flag = $p->save(false))) {
                            $transaction->rollBack();
                            break;
                        }
                    }
                }

                if ($flag) {
                    $transaction->commit();
                    return $this->redirect(['next', 'id' => $jadwal->id]);
                }
            } catch (Exception $e) {
                $transaction->rollBack();
            }
        }

        return $this->render('create_jadwal', [
            'jadwal' => $jadwal,
            'peserta' => (empty($peserta)) ? [new Users] : $peserta,
        ]);
    }

    public function actionNext($id)
    {
        $this->layout= 'form';
        $jadwal = Jadwal::findOne($id);
        $soal = [new Soal];

        $soal = Model::createMultiple(Soal::classname());
        Model::loadMultiple($soal, Yii::$app->request->post());

        if (Yii::$app->request->isAjax) {
            Yii::$app->response->format = Response::FORMAT_JSON;
            return ActiveForm::validateMultiple($soal);
        }

        if (Model::loadMultiple($soal, Yii::$app->request->post())) {
            $transaction = \Yii::$app->db->beginTransaction();
            try {
                foreach ($soal as $s) {
                    $s->id_jadwal = $jadwal->id;
                    if (! ($flag = $s->save(false))) {
                        $transaction->rollBack();
                        break;
                    }
                }
                if ($flag) {
                    $transaction->commit();
                    return $this->redirect(['index']);
                }
            } catch (Exception $e) {
                $transaction->rollBack();
            }
        }

        return $this->render('next', [
            'jadwal' => $jadwal,
            'soal' => (empty($soal)) ? [new Soal] : $soal,
        ]);
    }

    public function actionTambahPeserta($id)
    {
        $jadwal = Jadwal::findOne($id);
        $peserta = new Users();

        if ($peserta->load(Yii::$app->request->post())) {
            if (Yii::$app->request->isAjax) {
                \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
                return ActiveForm::validate($peserta); }

            $peserta->attributes = $_POST['Users'];

            $str = $_POST['Users']['username'];
            $str = substr($str, 0, 10);
            $str = hash('sha256', $str);
            $peserta->password = substr($str, 0,6);
            $peserta->level = 2;
            $peserta->id_jadwal = $jadwal->id;
            $peserta->save();

            return $this->redirect(Yii::$app->request->referrer);
        }

        return $this->renderAjax('_form-tambah-peserta',[
            'peserta' => $peserta,
        ]);
    }

    public function actionTambahSoal($id)
    {
        $jadwal = Jadwal::findOne($id);
        $soal = new Soal();

        if ($soal->load(Yii::$app->request->post())) {
            if (Yii::$app->request->isAjax) {
                \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
                return ActiveForm::validate($soal); }

            $soal->attributes = $_POST['Soal'];
            $soal->id_jadwal = $jadwal->id;
            $soal->save();
            return $this->redirect(Yii::$app->request->referrer);
        }

        return $this->renderAjax('_form-tambah-soal',[
            'soal' => $soal,
        ]);
    }

    public function actionView($id)
    {
        $this->layout = 'form';
        $jadwal = Jadwal::findOne($id);
        $daftarPeserta = new ActiveDataProvider([
            'query' => Users::find()->where(['id_jadwal' => $id]),
        ]);
        $daftarSoal = new ActiveDataProvider([
            'query' => Soal::find()->where(['id_jadwal' => $id]),
        ]);

        return $this->render('view',[
            'jadwal' => $jadwal,
            'daftarPeserta' => $daftarPeserta,
            'daftarSoal' => $daftarSoal
        ]);
    }

    public function actionInstruksi($id)
    {
        $this->layout = 'form';
        $user = Users::findOne($id);
        $jadwal = Jadwal::findOne($user->id_jadwal);
        return $this->render('instruksi', ['jadwal' => $jadwal]);
    }

    public function actionMulaites($id)
    {
        $this->layout = 'form';
        $jadwal = Jadwal::findOne($id);
        $soal = Soal::find()->where(['id_jadwal' => $id])->all();

        return $this->render('lembarsoal',['jadwal'=>$jadwal,'soal'=>$soal]);
    }

    public function actionSaveHasil($id)
    {
        
    }
}
