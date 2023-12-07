<?php

namespace app\controllers\api;

/**
 * This is the class for REST controller "UserController".
 */

use app\components\SSOToken;
use app\components\UploadFile;
use app\models\Otp;
use app\models\User;
use Dompdf\Exception;
use Yii;
use yii\web\HttpException;
use yii\web\Response;
use yii\web\UploadedFile;


class UserController extends \yii\rest\ActiveController
{

    use UploadFile;
    public $modelClass = 'app\models\User';
    // public function behaviors()
    // {
    //     $parent = parent::behaviors();
    //     $parent['authentication'] = [
    //         "class" => "\app\components\CustomAuth",
    //         "only" => ["user-view", "update-profile"],
    //         // 'except' => ['load-user', 'login', 'register', 'kirim-otp', 'reset-password', 'register-sosmed'],
    //     ];

    //     return $parent;
    // }

    public function behaviors()
    {
        $behaviors = parent::behaviors();

        return array_merge([
            'corsFilter'  => [
                'class' => \yii\filters\Cors::className(),
                'cors'  => [
                    'Origin'                           => ['http://localhost:8080',],
                    'Access-Control-Request-Method'    => ['GET', 'POST', 'PUT', 'PATCH', 'DELETE', 'HEAD', 'OPTIONS'],
                    'Access-Control-Allow-Credentials' => true,
                    'Access-Control-Max-Age'           => 3600,                 // Cache (seconds)
                    'Access-Control-Allow-Origin'      => ['*'],
                    'Access-Control-Request-Headers' => ['*'],
                    'Access-Control-Expose-Headers' => [],
                ],
            ],
            'contentNegotiator' => [
                'class' => yii\filters\ContentNegotiator::className(),
                'formats' => [
                    'application/json' => Response::FORMAT_JSON,
                    'application/xml' => Response::FORMAT_XML,
                ],
            ],
            'verbFilter' => [
                'class' => \yii\filters\VerbFilter::className(),
                'actions' => $this->verbs(),
            ],
            'rateLimiter' => [
                'class' => \yii\filters\RateLimiter::className(),
            ],
            'authentication' => [
                'class' => \app\components\CustomAuth::class,
                'only' => ['register', 'forgot-password'],
                // 'header' => 'Authorization',
                // 'pattern' => '/Bearer {secret_token}/',
            ]
        ], $behaviors);

        return $behaviors;
    }
    public function actions()
    {
        $actions = parent::actions();
        unset($actions['index']);
        unset($actions['view']);
        unset($actions['create']);
        unset($actions['update']);
        unset($actions['delete']);
        return $actions;
    }

    function verbs()
    {
        return [
            'secret-method-to-check-your-token-is-valid-or-not' => ['GET', 'HEAD'],
            'this-is-really-really-secret-method-to-get-data-for-registration-another-module' => ['GET', 'HEAD'],
            'load-user' => ['GET', 'HEAD'],
            'view' => ['GET', 'HEAD'],
            'register' => ['POST'],
            'login' => ['POST'],
            'update' => ['PUT', 'PATCH'],
            'forgot-password' => ['POST'],
        ];
    }

    public function actionSecretMethodToCheckYourTokenIsValidOrNot()
    {
        Yii::$app->response->format = Response::FORMAT_JSON;

        $response = SSOToken::checkToken();
        return $response;
    }

    public function actionThisIsReallyReallySecretMethodToGetDataForRegistrationAnotherModule()
    {
        $user = \app\models\User::findOne(["id" => Yii::$app->user->id]);
        if ($user == null) {
            throw new HttpException(404);
        }

        $fields = $_POST['fields'];

        $data = [];
        if (is_array($fields)) :
            foreach ($fields as $field) :
                if ($user->hasAttribute($field)) :
                    $data[$field] = $user->$field;
                endif;

            endforeach;
        else :
            if ($user->hasAttribute($fields)) :
                $data[$fields] = $user->$fields;
            endif;
        endif;

        return [
            "success" => true,
            "message" => $this->messageFetchSuccess(),
            "data" => $data,
        ];
    }

    // public function actionLoadUser()
    // {
    //     $user = Yii::$app->user->identity;
    //     if ($user) {
    //         return $user;
    //     } else {
    //         throw new \yii\web\HttpException(401, 'Unauthorized');
    //     }
    // }
    public function actionProfile()
    {
        $user = Yii::$app->user->identity;

        if ($user) {
            Yii::$app->response->format = Response::FORMAT_JSON;
            return $user;
        } else {
            throw new \yii\web\NotFoundHttpException('User not found.');
        }
    }
    public function actionLoadUser()
    {
        $headers = Yii::$app->request->headers;
        $accessToken = $headers->get('Authorization');
        $accessToken = str_replace('Bearer ', '', $accessToken);

        $user = User::findOne(['secret_token' => $accessToken]);
        if ($user) {
            Yii::$app->response->format = Response::FORMAT_JSON;
            return [
                'success' => true,
                'user' => $user,
            ];
        }

        Yii::$app->response->format = Response::FORMAT_JSON;
        return [
            'success' => false,
            'message' => 'User not found',
        ];
    }

    // public function actionLogin()
    // {
    //     Yii::$app->response->format = Response::FORMAT_JSON;

    //     $params = Yii::$app->request->post();
    //     if (strtolower(Yii::$app->request->method) != "post") {
    //         throw new HttpException(405);
    //     }
    //     try {
    //         $user = \app\models\User::findByUsername($params['username']);
    //         // $valid = \app\models\User::validateUser('username', 'password');  
    //         // var_dump($user);die;

    //         if (isset($user)) :
    //             if (\Yii::$app->security->validatePassword($params['password'], $user->password) == false)
    //                 throw new HttpException(400, Yii::t("action_message", "Password Salah"));
    //             // $user->scenario = $user::SCENARIO_UPDATE;
    //             $generate_random_string = SSOToken::generateToken();
    //             $user->secret_token = $generate_random_string;
    //             // $user->fcm_token = $params['fcm_token'];
    //             $user->validate();
    //             $user->save();
    //             // var_dump($user);die;

    //             $token = $generate_random_string;

    //             return (object) [
    //                 "success" => true,
    //                 "message" => Yii::t("action_message", "Login Berhasil"),
    //                 "token" => $token,
    //             ];
    //         endif;
    //     } catch (\Exception $e) {
    //         throw new HttpException(500, $e->getMessage());
    //     }

    //     throw new HttpException(400, Yii::t("action_message", "Login gagal"));
    // }

    // public function actionLogin()
    // {
    //     $model = new LoginForm();
    //     if ($model->load(Yii::$app->getRequest()->getBodyParams(), '') && $model->login()) {
    //         $user = User::findOne(['username' => $model->username]);
    //         $generate_random_string = SSOToken::generateToken();
    //         $user->secret_token = $generate_random_string;
    //         $user->save();

    //         $result['success'] = true;
    //         $result['message'] = "success login";
    //         unset($user->password); // remove password from response
    //         $result["data"] = $user;

    //         // Yii::$app->response->headers->set('secret-token', $secretToken);
    //         return $result;
    //     } else {
    //         Yii::$app->response->statusCode = 401;
    //         $result = [
    //             'status' => 'error',
    //             'message' => 'Email & password tidak boleh kosong!',
    //             'data' => ["username" => $model->username, "password" => $model->password],
    //         ];
    //         return $result;
    //     }
    // }


    public function actionLogin()
    {
        $username = Yii::$app->request->post('username');
        $password = Yii::$app->request->post('password');

        Yii::$app->response->format = Response::FORMAT_JSON;
        $params = Yii::$app->request->post();

        $result = [];

        // validasi jika kosong
        if (empty($username) || empty($password)) {
            Yii::$app->response->statusCode = 401;
            $result = [
                'status' => 'error',
                'message' => 'Email & password tidak boleh kosong!',
                'data' => ["username" => $username, "password" => $password],
            ];
        } else {
            try {
                $user = User::findByUsername([
                    'username' => $username,
                ]);
                if (isset($user)) {
                    if ($user->validatePassword($password)) {

                        if ($user->confirm == 0 && $user->status == 0) {

                            $result["success"] = true;
                            $result["message"] = "Akun anda belum aktif,Masukkan Kode OTP Anda terlebih dahulu untuk mengaktifkan";
                            unset($user->password); // remove password from response
                            $result["user"] = $user;
                        } else {
                            $generate_random_string = SSOToken::generateToken();
                            $user->secret_token = $generate_random_string;
                            $user->save();

                            $result['success'] = true;
                            $result['message'] = "success login";
                            unset($user->password); // remove password from response
                            $result["user"] = $user;
                        }
                    } else {
                        $result["success"] = false;
                        $result["message"] = "password salah";
                        $result["user"] = null;
                    }
                } else {
                    $result["success"] = false;
                    $result["message"] = "email tidak ada";
                    $result["user"] = null;
                }
            } catch (\Exception $e) {
                $result["success"] = false;
                $result["message"] = "email atau password salah";
                $result["user"] = $e->getMessage();
            }
        }
        // Yii::$app->response->format = Response::FORMAT_JSON;
        return $result;
    }

    public function actionLogout()
    {
        $headers = Yii::$app->request->headers;
        $accessToken = $headers->get('Authorization');
        $accessToken = str_replace('Bearer ', '', $accessToken);

        $user = User::findOne(['secret_token' => $accessToken]);
        if ($user) {
            $user->secret_token = null;
            if ($user->save()) {
                Yii::$app->response->format = Response::FORMAT_JSON;
                return [
                    'success' => true,
                    'message' => 'Berhasil Logout',
                ];
            }
        }

        return [
            'success' => false,
            'message' => 'Gagal Logout',
        ];
    }

    public function actionUserView()
    {
        $result = [];
        try {
            $user = User::findOne([
                'id' => \Yii::$app->user->identity->id
            ]);
            // $marketing = MarketingDataUser::findOne(['user_id' => \Yii::$app->user->identity->id]);

            if (isset($user)) {
                $result['success'] = true;
                $result['message'] = "success";
                // unset($user->fcm_token);
                unset($user->password); // remove password from response
                $result["data"] = $user;
                // $result["data-marketing"] = $marketing;
            } else {
                $result["success"] = false;
                $result["message"] = "gagal";
                $result["data"] = "data kosong";
                $result["data-marketing"] = null;
            }
        } catch (\Exception $e) {
            $result["success"] = false;
            $result["message"] = "gagal";
            $result["data"] = "error";
            $result["data-marketing"] = null;
        }
        return $result;
    }

    public function actionRegister()
    {
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        $val = \yii::$app->request->post();

        $rolee =  2;
        if ($val['role'] == "pewakaf") {
            $rolee = 5;
        }

        $user = new User();
        // $user->name = $val['name'];
        $user->username = $val['username'];
        $user->password = Yii::$app->security->generatePasswordHash($val['confirm_password']);
        $user->name = $val['name'];
        $user->role_id = $rolee;
        $user->confirm = 0;
        $user->status = 0;
        $user->pin = $val['pin'];
        $user->photo_url = 'default.png';
        $user->nomor_handphone = ($val['no_hp']) ?? '';
        // $user->address = $val['address'];

        if ($val['confirm_password'] != $val['password']) {
            return ['success' => false, 'message' => 'Password tidak sama', 'data' => null];
        }
        if ($user->nomor_handphone == '') {
            return ['success' => false, 'message' => 'No Telp tidak boleh kosong', 'data' => null];
        }

        // if ($user->username == '') {
        //     return ['success' => false, 'message' => 'gagal', 'data' => 'Email tidak boleh kosong'];
        // }

        if (strlen($val['password']) < 3) {
            return ['success' => false, 'message' => 'Password minimal 4 karakter', 'data' => null];
        }
        if (strlen($val['pin']) < 3) {
            return ['success' => false, 'message' => 'Pin minimal 3 karakter', 'data' => null];
        }
        if (filter_var($val['pin'], FILTER_VALIDATE_INT) == false) {
            return ['success' => false, 'message' => 'Pin Harus berupa angka', 'data' => null];
        }

        if (filter_var($user->username, FILTER_VALIDATE_EMAIL) == false) {
            return ['success' => false, 'message' => 'email anda tidak valid', 'data' => null];
        }

        $check = User::findOne(['nomor_handphone' => $user->nomor_handphone]);
        if ($check != null) {
            return ['success' => false, 'message' => 'No Telp telah digunakan', 'data' => null];
        }

        // $check = User::findOne(['email' => $user->email]);
        // if ($check) {
        //     return ['success' => false, 'message' => 'gagal', 'data' => 'Email telah digunakan'];
        // }

        // check username
        if ($user->username) {
            $cek = User::find()->where(['username' => $user->username])->asArray()->one();
            if (isset($cek)) {
                return ['success' => false, 'message' => 'Email telah digunakan', 'data' => null];
            }
        }

        if ($user->validate()) {
            $user->save();
            $otp = new Otp();

            $otp->id_user = $user->id;
            $otp->kode_otp = (string) random_int(1000, 9999);
            $otp->created_at = date('Y-m-d H:i:s');
            $otp->is_used = 0;
            $otp->save();
            $text = "
            Hay,\nini adalah kode OTP untuk Login anda.\n
            {$otp->kode_otp}
            \nJangan bagikan kode ini dengan siapapun.
            \nKode akan Kadaluarsa dalam 5 Menit
            ";
            Yii::$app->mailer->compose()
                ->setTo($user->username)
                ->setFrom(['Inisiatorsalam@gmail.com'])
                ->setSubject('Kode OTP')
                ->setTextBody($text)
                ->send();



            unset($user->password);
            return ['success' => true, 'message' => 'success', 'data' => $user];
        } else {
            $user->rollback();
            return ['success' => false, 'message' => 'gagal', 'data' => $user->getErrors()];
        }
    }
    public function actionCheckEmail()
    {
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        $val = \yii::$app->request->post();
        $cek = User::find()->where(['username' => $val['username']])->one();
        if (isset($cek)) {
            $user_id = $cek->id;
            $otp = Otp::findOne(['id_user' => $user_id, 'is_used' => 0]);


            if ($otp) {

                $now = time();
                $validasi = strtotime($otp->created_at) + 60;
                if ($now > $validasi) {
                    $otp->kode_otp = (string) random_int(1000, 9999);
                    $otp->save();
                    $text = "
                Hay,\nini adalah kode OTP untuk Login anda.\n
                {$otp->kode_otp}
                \nJangan bagikan kode ini dengan siapapun.
                \nKode akan Kadaluarsa dalam 5 Menit
                ";
                    $user = User::findOne(['id' => $user_id]);
                    Yii::$app->mailer->compose()
                        ->setTo($user->username)
                        ->setFrom(['adminIsalam@gmail.com' => 'Isalam'])
                        ->setSubject('Kode OTP')
                        ->setTextBody($text)
                        ->send();

                    return [
                        "success" => true,
                        "message" => "OTP Berhasil Terkirim",
                        "data" => $otp->kode_otp
                    ];
                } else {
                    return [
                        "success" => false,
                        "message" => "OTP gagal terkirim,Mohon Tunggu 1 menit",
                        "data" => [],
                    ];
                }
                // return ['success' => true, 'message' => 'Otp Berhasil Terkirim', 'data' => $cek];
            } else {
                $otp = new Otp();

                $otp->id_user = $user_id;
                $otp->kode_otp = (string) random_int(1000, 9999);
                $otp->created_at = date('Y-m-d H:i:s');
                $otp->is_used = 0;
                $otp->save();
                $text = "
            Hay,\nini adalah kode OTP untuk Login anda.\n
            {$otp->kode_otp}
            \nJangan bagikan kode ini dengan siapapun.
            \nKode akan Kadaluarsa dalam 5 Menit
            ";
                $user = User::findOne(['id' => $user_id]);
                Yii::$app->mailer->compose()
                    ->setTo($user->username)
                    ->setFrom(['Inisiatorsalam@gmail.com'])
                    ->setSubject('Kode OTP')
                    ->setTextBody($text)
                    ->send();


                return ['success' => true, 'message' => 'Otp Berhasil Terkirim', 'data' => $otp->kode_otp];
            }
        } else {

            return ['success' => false, 'message' => 'Email Tidak Terdaftar', 'data' => []];
        }
    }
    public function actionLupaPassword()
    {
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        $val = \yii::$app->request->post();

        // $otp = Otp::findOne(['kode_otp' => $val['kode_otp'], 'is_used' => 0]);
        // if($otp){
        $user = User::findOne([
            'visible_token' => $val['token']
        ]);
        if ($user) {
            if ($val['confirm_password'] != $val['password']) {
                return ['success' => false, 'message' => 'Password tidak sama', 'data' => null];
            }
            // $user->name = $val['name'];
            // $user->username = $val['username'];
            $pass = $val['confirm_password'];
            $user->password = Yii::$app->security->generatePasswordHash($pass);
            // $user->address = $val['address'];
            if ($user->save()) {
                // $user->save();
                unset($user->password);

                //             $text = "
                // Hay,\nini adalah kode OTP untuk Login anda.\n
                // {$otp->kode_otp}
                // \nJangan bagikan kode ini dengan siapapun.
                // \nKode akan Kadaluarsa dalam 5 Menit
                // ";

                //         Yii::$app->mailer->compose()
                //             ->setTo($user->username)
                //             ->setFrom(['adminIsalam@gmail.com' => 'Isalam'])
                //             ->setSubject('Kode OTP')
                //             ->setTextBody($text)
                //             ->send();
                return ['success' => true, 'message' => 'success', 'data' => $user];
            } else {
                // $user->rollback();
                return ['success' => false, 'message' => 'gagal', 'data' => $user->getErrors()];
            }
        } else {

            return ['success' => false, 'message' => 'Data tidak ditemukan', 'data' => []];
        }
        // }else{

        //     return ['success' => false, 'message' => 'Kode Otp tidak terdeteksi', 'data' => []];
        // }



    }

    public function actionUpdateProfile()
    {
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        $val = \yii::$app->request->post();

        $user = User::findOne([
            'id' => \Yii::$app->user->identity->id
        ]);
        $old = $user->password;
        $old_phone = $user->nomor_handphone;
        $old_name = $user->name;
        // $new = Yii::$app->security->generatePasswordHash($val['old_password']);
        $password = $val['old_password'];
        if ($password != null) {
            $p = $user->validatePassword($password);
        }
        // var_dump($old_name);die;
        $photo_url = $user->photo_url;
        $image = UploadedFile::getInstanceByName("photo_url");
        if ($image) {
            $response = $this->uploadImage($image, "user");
            if ($response->success == false) {
                throw new HttpException(419, "Gambar gagal diunggah");
            }
            $user->photo_url = $response->filename;
        } else {
            $user->photo_url = $photo_url;
        }
        if ($val['name'] == null) {
            $user->name = $old_name;
        } else {
            $user->name = $val['name'];
        }
        // var_dump($user->name);die;
        if ($val['confirm_password'] == null && $val['new_password'] == null && $password == null) {
            $user->password = $old;
        } else {
            $user->password = Yii::$app->security->generatePasswordHash($val['confirm_password']);
        }
        // $user->name = $val['name'];
        if ($val['no_hp'] != null) {
            $check = User::findOne(['nomor_handphone' => $val['no_hp']]);
            if ($check != null) {
                return ['success' => false, 'message' => 'No Telp telah digunakan', 'data' => null];
            }
            $user->nomor_handphone = $val['no_hp'];
        } else {

            $user->nomor_handphone = $old_phone;
        }
        // $user->address = $val['address'];

        if ($val['confirm_password'] != null || $val['new_password'] != null) {
            if ($p == false) {

                return ['success' => false, 'message' => 'Password lama yang anda masukkan tidak sama', 'data' => null];
            }
            if ($val['confirm_password'] != $val['new_password']) {
                return ['success' => false, 'message' => 'Password tidak sama', 'data' => null];
            }
            if (strlen($val['new_password']) < 3 || strlen($val['confirm_password']) < 3) {
                return ['success' => false, 'message' => 'Password minimal 4 karakter', 'data' => null];
            }
        }
        if ($user->validate()) {
            $user->save();

            return ['success' => true, 'message' => 'Berhasil Update  Profile', 'data' => $user];
        } else {
            return ['success' => false, 'message' => 'Gagal Update Profile', 'data' => $user->getErrors()];
        }
    }
    public function actionOtpPassword()
    {
        $kode_otp = $_POST['kode_otp'];

        $email = $_POST['username'];
        $data_user = User::findOne(['username' => $email]);
        if ($data_user == null) {
            return [
                "success" => false,
                "message" => "Data user tidak ditemukan",
                "data" => [],
            ];
        } else {
            $otp = Otp::findOne(['kode_otp' => $kode_otp, 'id_user' => $data_user->id, 'is_used' => 0]);
            if ($otp) {
                $now = time();
                $validasi = strtotime($otp->created_at) + (60 * 5);

                if ($now < $validasi) {
                    $otp->is_used = 1;
                    $otp->save();
                    $user = User::findOne(['id' => $otp->id_user]);
                    $generate_random_string = SSOToken::generateToken();
                    $user->visible_token = $generate_random_string;
                    $user->confirm = 1;
                    $user->status = 1;
                    $user->save();

                    return [
                        "success" => true,
                        "message" => "Otp Valid",
                        "data" => $generate_random_string
                    ];
                } else {
                    return [
                        "success" => false,
                        "message" => "Kode Otp Sudah Kadaluarsa",
                        "data" => [],
                    ];
                }
            }

            return [
                "success" => false,
                "message" => "OTP yang anda masukan tidak valid",
            ];
        }
    }
    public function actionCheckOtp()
    {
        $kode_otp = $_POST['kode_otp'];
        $user_id = $_POST['user_id'];
        $otp = Otp::findOne(['kode_otp' => $kode_otp, 'id_user' => $user_id, 'is_used' => 0]);
        if ($otp) {
            $now = time();
            $validasi = strtotime($otp->created_at) + (60 * 5);

            if ($now < $validasi) {
                $otp->is_used = 1;
                $otp->save();
                $user = User::findOne(['id' => $otp->id_user]);
                $user->confirm = 1;
                $user->status = 1;
                $user->save();

                return [
                    "success" => true,
                    "message" => "Otp Valid",
                    "data" => [
                        "user" => $otp->user->name,
                        "kode_otp" => $otp->kode_otp,
                    ],
                ];
            }
        }

        return [
            "success" => false,
            "message" => "OTP yang anda masukan tidak valid",
        ];
    }
    public function actionRefreshOtp()
    {
        $user_id = $_POST['user_id'];
        $otp = Otp::findOne(['id_user' => $user_id, 'is_used' => 0]);


        if ($otp) {

            $now = time();
            $validasi = strtotime($otp->created_at) + 60;
            if ($now > $validasi) {
                $otp->kode_otp = (string) random_int(1000, 9999);
                $otp->save();
                $text = "
        Hay,\nini adalah kode OTP untuk Login anda.\n
        {$otp->kode_otp}
        \nJangan bagikan kode ini dengan siapapun.
        \nKode akan Kadaluarsa dalam 5 Menit
        ";
                $user = User::findOne(['id' => $user_id]);
                Yii::$app->mailer->compose()
                    ->setTo($user->username)
                    ->setFrom(['adminIsalam@gmail.com' => 'Isalam'])
                    ->setSubject('Kode OTP')
                    ->setTextBody($text)
                    ->send();

                return [
                    "success" => true,
                    "message" => "OTP Berhasil Terkirim",
                    "data" => [
                        "user" => $otp->user->name,
                        "kode_otp" => $otp->kode_otp,
                    ],
                ];
            } else {
                return [
                    "success" => false,
                    "message" => "OTP gagal terkirim,Mohon Tunggu 1 menit",
                    "data" => "Mohon Tunggu 1 menit",
                ];
            }
        }

        return [
            "success" => false,
            "message" => "OTP gagal terkirim",
            "data" => [],
        ];
    }
}




// <?php

// namespace app\modules\api\modules\v1\controllers;

// /**
//  * This is the class for REST controller "UserController".
//  */

// use Yii;
// use yii\web\HttpException;
// use yii\web\Response;
// use yii\web\UploadedFile;
// use app\models\User;


// class AuthController extends \yii\rest\ActiveController
// {
//     use \app\traits\MessageTrait;
//     use \app\traits\UploadFileTrait;

//     public $modelClass = 'app\models\User';

//     public function behaviors()
//     {
//         $behaviors = parent::behaviors();

//         return array_merge([
//             'corsFilter'  => [
//                 'class' => \yii\filters\Cors::className(),
//                 'cors'  => [
//                     'Origin'                           => ['http://localhost:5173',],
//                     'Access-Control-Request-Method'    => ['GET', 'POST', 'PUT', 'PATCH', 'DELETE', 'HEAD', 'OPTIONS'],
//                     'Access-Control-Allow-Credentials' => true,
//                     'Access-Control-Max-Age'           => 3600,                 // Cache (seconds)
//                     'Access-Control-Allow-Origin'      => ['*'],
//                     'Access-Control-Request-Headers' => ['*'],
//                     'Access-Control-Expose-Headers' => [],
//                 ],
//             ],
//             'contentNegotiator' => [
//                 'class' => yii\filters\ContentNegotiator::className(),
//                 'formats' => [
//                     'application/json' => Response::FORMAT_JSON,
//                     'application/xml' => Response::FORMAT_XML,
//                 ],
//             ],
//             'verbFilter' => [
//                 'class' => \yii\filters\VerbFilter::className(),
//                 'actions' => $this->verbs(),
//             ],
//             'rateLimiter' => [
//                 'class' => \yii\filters\RateLimiter::className(),
//             ],
//             'authentication' => [
//                 'class' => \app\components\CustomAuth::class,
//                 'except' => ['login', 'register', 'forgot-password'],
//             ]
//         ], $behaviors);

//         return $behaviors;
//     }

//     public function actions()
//     {
//         $actions = parent::actions();
//         unset($actions['index']);
//         unset($actions['view']);
//         unset($actions['create']);
//         unset($actions['update']);
//         unset($actions['delete']);
//         return $actions;
//     }

//     function verbs()
//     {
//         return [
//             'secret-method-to-check-your-token-is-valid-or-not' => ['GET', 'HEAD'],
//             'this-is-really-really-secret-method-to-get-data-for-registration-another-module' => ['GET', 'HEAD'],
//             'view' => ['GET', 'HEAD'],
//             'register' => ['POST'],
//             'login' => ['POST'],
//             'update' => ['PUT', 'PATCH'],
//             'forgot-password' => ['POST'],
//         ];
//     }

//     public function actionSecretMethodToCheckYourTokenIsValidOrNot()
//     {
//         Yii::$app->response->format = Response::FORMAT_JSON;

//         $response = (new \app\helpers\SsoTokenHelper)->checkToken();
//         return $response;
//     }

//     public function actionThisIsReallyReallySecretMethodToGetDataForRegistrationAnotherModule()
//     {
//         $user = \app\models\User::findOne(["id" => Yii::$app->user->id]);
//         if ($user == null) {
//             throw new HttpException(404);
//         }

//         $fields = $_POST['fields'];

//         $data = [];
//         if (is_array($fields)) :
//             foreach ($fields as $field) :
//                 if ($user->hasAttribute($field)) :
//                     $data[$field] = $user->$field;
//                 endif;

//             endforeach;
//         else :
//             if ($user->hasAttribute($fields)) :
//                 $data[$fields] = $user->$fields;
//             endif;
//         endif;

//         return [
//             "success" => true,
//             "message" => $this->messageFetchSuccess(),
//             "data" => $data,
//         ];
//     }

//     public function actionRegister()
//     {
//         Yii::$app->response->format = Response::FORMAT_JSON;


//         $user = new \app\models\User;
//         $user->scenario = \app\models\User::SCENARIO_REGISTER_APP;

//         $request = \yii::$app->request->post();
//         $user->load($request, '');

//         $user->phone = \app\components\Constant::purifyPhone($user->phone);
//         $user->role_id = \app\models\User::ROLE_USER_REGULER; // role
//         if ($user->save())  {
//             $user->password = \Yii::$app->security->generatePasswordHash($user->password);
//             $generate_random_string = (new \app\helpers\SsoTokenHelper)->generateToken();
//             $user->secret_token = $generate_random_string;
//             $user->save();

//             return ['success' => true, 'message' => Yii::t("action_message", "Berhasil melakukan registrasi"), 'token' => $user->secret_token];
//         } else {
//             throw new HttpException(422, $this->message422(
//                 \app\components\Constant::flattenError(
//                     $user->getErrors()
//                 )
//             ));
//         }
//     }

//     public function actionLogin()
//     {
//         Yii::$app->response->format = Response::FORMAT_JSON;

//         $params = Yii::$app->request->post();
//         if (strtolower(Yii::$app->request->method) != "post") {
//             throw new HttpException(405);
//         }
//         try {
//             $user = \app\models\User::findByUsername($params['username']);
//             // $valid = \app\models\User::validateUser('username', 'password');  
//             // var_dump($user);die;

//             if (isset($user)) :
//                 if (\Yii::$app->security->validatePassword($params['password'], $user->password) == false)
//                     throw new HttpException(400, Yii::t("action_message", "Password Salah"));
//                 $user->scenario = $user::SCENARIO_UPDATE;
//                 $generate_random_string = (new \app\helpers\SsoTokenHelper)->generateToken();
//                 $user->secret_token = $generate_random_string;
//                 $user->fcm_token = $params['fcm_token'];
//                 $user->validate();
//                 $user->save();
//                 // var_dump($user);die;

//                 $token = $generate_random_string;

//                 return (object) [
//                     "success" => true,
//                     "message" => Yii::t("action_message", "Login Berhasil"),
//                     "token" => $token,
//                 ];
//             endif;
//         } catch (\Exception $e) {
//             throw new HttpException(500, $e->getMessage());
//         }

//         throw new HttpException(400, Yii::t("action_message", "Login gagal"));
//     }

//     public function actionUpdate()
//     {
//         Yii::$app->response->format = Response::FORMAT_JSON;
//         $request = Yii::$app->request->bodyParams;

//         $user = \app\models\User::findOne(["id" => Yii::$app->user->id]);
//         $photo_url = $user->photo_url;
//         $user->scenario = $user::SCENARIO_UPDATE;
//         $user->load($request);

//         $user->phone = \app\components\Constant::purifyPhone($user->phone);
//         $image = UploadedFile::getInstanceByName("photo_url");
//         if ($image) {
//             $response = $this->uploadImage($image, "user");
//             if ($response->success == false) throw new HttpException(419, $this->messageImageFailedUpload());
//             $user->photo_url = $response->fileName;
//         } else {
//             $user->photo_url = $photo_url;
//         }

//         if ($user->validate()) {
//             $password = $request["User"]['password'];
//             if ($password) $user->password = \Yii::$app->security->generatePasswordHash($user->password);

//             $user->save();

//             return [
//                 "success" => true,
//                 "message" => Yii::t("action_message", "Profil berhasil diubah"),
//                 "data" => $user,
//             ];
//         }

//         throw new HttpException(422, $this->message422(
//             \app\components\Constant::flattenError(
//                 $user->getErrors()
//             )
//         ));
//     }

//     public function actionView()
//     {
//         $user = \app\models\User::findOne(["id" => Yii::$app->user->id]);
//         if ($user == null) throw new HttpException(404, $this->message404());

//         return [
//             "success" => (1 == 1),
//             "message" => $this->messageFetchSuccess(),
//             "data" => $user,
//         ];
//     }

//     public function actionLogout()
//     {
//         $headers = Yii::$app->request->headers;
//         $accept = $headers->get('Authorization');
//         $model = User::find()->where(['secret_token' => $accept])->one();
//         // var_dump($model);
//         if (!empty($model)) {
//             $model->secret_token = null;
//             $model->save();
//             // \Yii::$app->user->logout(false);
//             Yii::$app->response->format = Response::FORMAT_JSON;
//             return [
//                 'success' => true,
//                 'message' => 'Berhasil Logout',

//             ];
//         } else {
//             return [
//                 "success" => false,
//                 "message" => "Gagal Logout"
//             ];
//         }
//     }
//     public function actionForgotPassword()
// {
//     $model = new \app\models\User;
//     $model->scenario = \app\models\User::SCENARIO_FORGOT_PASSWORD;
    

//     if ($model->load(Yii::$app->request->post()) && $model->validate()) {
//         $user = User::findByEmail($model->email);
//         if ($user) {
//             $user->generatePasswordResetToken();
//             if ($user->save()) {
//                 $resetLink = Yii::$app->urlManager->createAbsoluteUrl(['site/reset-password', 'token' => $user->password_reset_token]);
//                 $subject = 'Reset Password';
//                 $body = "Click the link below to reset your password:\n\n$resetLink";
//                 Yii::$app->mailer->compose()
//                     ->setTo($user->email)
//                     ->setSubject($subject)
//                     ->setTextBody($body)
//                     ->send();

//                 Yii::$app->session->setFlash('success', 'Check your email for further instructions.');
//                 return $this->goHome();
//             } else {
//                 Yii::$app->session->setFlash('error', 'Failed to generate password reset token.');
//             }
//         } else {
//             Yii::$app->session->setFlash('error', 'User not found.');
//         }
//     }

//     return $this->render('forgotPassword', [
//         'model' => $model,
//     ]);
// }

// }