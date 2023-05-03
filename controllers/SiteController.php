<?php

namespace app\controllers;

// use Endroid\QrCode\QrCode;
// use Endroid\QrCode\ErrorCorrectionLevel;
//use app\components\NodeLogger;
use app\models\Action;
use app\models\home\Registrasi as HomeRegistrasi;
use app\components\Tanggal;
use app\models\ContactForm;
use app\models\LoginForm;
use app\models\Setting;
use app\models\User;
use kartik\mpdf\Pdf;
use Yii;
use yii\db\Expression;
use yii\helpers\Url;
use yii\web\Controller;
use yii\web\Response;
use yii\web\UploadedFile;

class SiteController extends Controller
{

    public function behaviors()
    {
        //NodeLogger::sendLog(Action::getAccess($this->id));
        //apply role_action table for privilege (doesn't apply to super admin)
        return Action::getAccess($this->id);
    }

    public function actions()
    {
        return [
            // 'error' => [
            //     'class' => 'yii\web\ErrorAction',
            // ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }
    public function actionError()
    {
        $exception = Yii::$app->errorHandler->exception;
        $setting = Setting::find()->one();
        if ($exception !== null) {
            $this->layout = false;
            return $this->render('errors', ['exception' => $exception,'setting' => $setting]);
        }
    }

    public function actionIndex()
    {
        $user = Yii::$app->user->identity;
        if ($user->role_id == 8) {
            return $this->render('index_pegawai');
        }
        $userAll = User::find()->where(['status'=>1])->count();
        $investor = User::find()->where(['role_id' => 5])->count();
        $operator = User::find()->where(['role_id' => 2])->all();
        $marketing = User::find()->where(['role_id' => 3])->all();
        $user = User::find()->where(['role_id' => 4])->all();
        
        // var_dump($harian);
        // die;
       


        return $this->render('index',[
            'userAll' => $userAll,
            'investor' => $investor,
            'operator' => $operator,
            'marketing' => $marketing,
            'user' => $user,
            
        ]);
    }

    public function actionProfile()
    {
        $model = User::find()->where(["id" => Yii::$app->user->id])->one();
        $oldMd5Password = $model->password;
        $oldPhotoUrl = $model->photo_url;

        $model->password = "";
        $model->pin = "";

        if ($model->load($_POST)) {
            //password
            if ($model->password != "") {
                $model->password = Yii::$app->security->generatePasswordHash($model->password);
            } else {
                $model->password = $oldMd5Password;
            }

            # get the uploaded file instance
            $image = UploadedFile::getInstance($model, 'photo_url');
            if ($image != null) {
                # store the source file name
                $model->photo_url = $image->name;
                $arr = explode(".", $image->name);
                $extension = end($arr);

                # generate a unique file name
                $model->photo_url = Yii::$app->security->generateRandomString() . ".{$extension}";

                # the path to save file
                $path = Yii::getAlias("@app/web/uploads/user_image/") . $model->photo_url;
                $image->saveAs($path);
            } else {
                $model->photo_url = $oldPhotoUrl;
            }

            
            if ($model->save()) {
                Yii::$app->session->addFlash("success", "Profile successfully updated.");
            } else {
                Yii::$app->session->addFlash("danger", "Profile cannot updated.");
            }
            return $this->redirect(["profile"]);
        }
        return $this->render('profile', [
            'model' => $model,
        ]);
    }

    // public function actionRegister()
    // {
    //     $this->layout = "main-login";

    //     if (!\Yii::$app->user->isGuest) {
    //         return $this->goHome();
    //     }

    //     $model = new RegisterForm();
    //     if ($model->load(Yii::$app->request->post()) && $model->register()) {
    //         Yii::$app->session->addFlash("success", "Register success, please login");
    //         return $this->redirect(["site/login"]);
    //     }
    //     return $this->render('register', [
    //         'model' => $model,
    //     ]);
    // }
    // public function actionRegistrasi(){
        
    //     $this->layout = "main-login";

    //     if (!\Yii::$app->user->isGuest) {
    //         return $this->goHome();
    //     }
    //     $model = new HomeRegistrasi();
    //     if ($model->load(Yii::$app->request->post()) && $model->register()) {
    //         Yii::$app->session->addFlash("success", "Register success, please login");
    //         return $this->redirect(["site/login"]);
    //     }
    //     if ($model->load($_POST)) {
    //         if ($model->registrasi()) {
    //             Yii::$app->session->setFlash("success", "Pendaftaran berhasil. Silahkan login");
    //             return $this->redirect(["site/login"]);
    //         }
    //         Yii::$app->session->setFlash("error", "Pendaftaran gagal. Validasi data tidak valid : ");
    //     } else {
    //         Yii::$app->session->setFlash("error", "Pendaftaran gagal");
    //     }
    //     return $this->render('register', [
    //         'model' => $model,
    //     ]);
    // }

    public function actionLogin()
    {
        
        return $this->redirect(['home/login']);
        $this->layout = "main-login";

        if (!\Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {

            //log last login column
            $user = Yii::$app->user->identity;
            $user->last_login = new Expression("NOW()");
            $user->save();
            if($user->role_id == 3){
                
                return $this->redirect(Yii::$app->request->referrer);
            }else{
                return $this->goBack();
            }
        }
        return $this->render('login', [
            'model' => $model,
        ]);
    }

    public function actionLogout()
    {
        //log last login column
        $user = Yii::$app->user->identity;
        $user->last_logout = new Expression("NOW()");
        $user->save();

        Yii::$app->user->logout();

        return $this->goHome();
    }

    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->contact(Yii::$app->params['adminEmail'])) {
            Yii::$app->session->setFlash('contactFormSubmitted');

            return $this->refresh();
        }
        return $this->render('contact', [
            'model' => $model,
        ]);
    }

    public function actionAbout()
    {
        return $this->render('about');
    }
    
}
