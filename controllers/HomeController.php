<?php

namespace app\controllers;



date_default_timezone_set('Asia/Jakarta');

use Yii;
use \Exception;
// use yii\base\Model;

use yii\db\Query;

use app\models\Toko;
use app\models\User;
use Midtrans\Config;
use Mpdf\Tag\Select;
use yii\helpers\Url;
use yii\base\Request;
use yii\web\Response;
use app\models\Alamat;
use app\models\Galeri;
use app\models\Produk;
use app\models\Slides;
use yii\db\Expression;
use app\models\Pesanan;
use app\models\Setting;
use yii\web\Controller;
use yii\data\Pagination;
use yii\helpers\Console;
use app\models\Keranjang;
use app\models\LoginForm;
use dmstr\bootstrap\Tabs;
use yii\web\UploadedFile;
use app\models\base\Model;
use app\models\FotoProduk;
use app\models\Keuntungan;
use app\models\NilaiSikap;
use yii\helpers\VarDumper;
use yii\web\HttpException;
use app\models\HubungiKami;
use yii\filters\VerbFilter;
use app\components\Constant;
use app\models\ReviewProduk;
use yii\helpers\ArrayHelper;
use app\models\DetailPesanan;
use app\models\ProductDetail;
use app\components\UploadFile;

use app\models\KategoriProduk;
use app\models\ProductVariant;
use yii\filters\AccessControl;
use app\models\StrukturOrganisasi;
use app\models\search\AlamatSearch;
use app\models\ProductDetailVariant;
use app\models\search\PesananSearch;
use app\models\search\KeranjangSearch;
use app\models\search\ProdukSayaSearch;
use app\components\ActionMidtransConfig;
use app\models\search\KeranjangSayaSearch;
use app\models\home\Registrasi as HomeRegistrasi;

/**
 * This is the class for controller "BeritaController".
 */
class HomeController extends Controller
{
    use UploadFile;

    public function beforeAction($action)
    {
        $this->enableCsrfValidation = false;
        $this->layout = '@app/views/layouts-home/main';
        return parent::beforeAction($action);
    }

    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
            'access' => [
                'class' => AccessControl::className(),
                // 'only' => ['logout', 'design-bangunan'],
                'rules' => [
                    [
                        'actions' => [
                            'login', 'registrasi', 'error', 'index', 'news', 'detail-berita', 'about', 'member',
                            'kalender', 'galeri', 'program', 'detail-program',
                            'produk', 'get-kalender', 'lupa-password', 'hubungi', 'visi', 'organisasi',
                            'membership', 'kontak', 'detail-produk', 'list-produk',
                            'ajax-select-variant', 'ajax-select-harga', 'ajax-select-intharga', 'ajax-select-provinsi', 'ajax-select-city', 'ajax-select-paket', 'ajax-select-weight'
                        ],
                        'allow' => true,
                    ],
                    [
                        'actions' => [
                            'logout', 'index', 'verifikasi-akun', 'kirim-otp', 'profile', 'edit-profile',
                            'bayar', 'pembayaran', 'pembayarans', 'chechkout', 'order', 'cancel-transaksi',
                            'register-toko', 'edit-toko', 'toko-saya', 'produk-saya', 'create-produk', 'view-produk', 'update-produk', 'delete-produk', 'find-model-produk',
                            'foto-produk-baru', 'foto-produk-update', 'foto-produk-delete', 'review', 'keranjang', 'add-keranjang', 'create-keranjang', 'update-keranjang',
                            'delete-keranjang', 'view-keranjang', 'find-keranjang', 'pesanan', 'create-pesanan', 'view-pesanan', 'delete-pesanan', 'find-pesanan', 'alamat',
                            'create-alamat', 'update-alamat', 'view-alamat', 'delete-alamat', 'find-alamat',
                        ], // add all actions to take guest to login page
                        'allow' => true,
                        'roles' => ['@'],
                    ],

                ],

            ],

        ];
    }

    function printExampleWarningMessage()
    {
        if (strpos(Config::$serverKey, 'your ') != false) {
            echo "<code>";
            echo "<h4>Please set your server key from sandbox</h4>";
            echo "In file: " . __FILE__;
            echo "<br>";
            echo "<br>";
            echo htmlspecialchars('Config::$serverKey = \'<your server key>\';');
            die();
        }
    }


    public function actionRegistrasi()
    {
        // $this->layout = "main-login";
        $model = new HomeRegistrasi();
        // if (Yii::$app->request->isAjax) {
        //     return $this->renderAjax("registrasi", compact("model"));
        // }
        $pondok = Toko::find()->select(['id', 'nama'])->all();
        // var_dump($pondok);
        // die;
        if ($model->load($_POST)) {
            // $pondok_id = $_POST('asal_pondok');
            $pondok_nama = Toko::find()->select('nama')->where(['id' => $model->asal_pondok])->scalar();
            // var_dump($pondok_nama);
            // die;
            $asalPondok = ($model->asal_pondok === 'other') ? $model->other_asal_pondok : $pondok_nama;

            $model->asal_pondok = $asalPondok;

            // var_dump($model->registrasi());die;
            if ($model->registrasi()) {
                Yii::$app->session->setFlash("success", "Pendaftaran berhasil. Silahkan login");

                return $this->redirect(["home/login"]);
            }
            Yii::$app->session->setFlash("error", "Pendaftaran gagal. Validasi data tidak valid : ");
        }
        // else {
        //     Yii::$app->session->setFlash("error", "Pendaftaran gagal");

        // }
        return $this->render('registrasi', [
            'model' => $model,
            'pondok' => $pondok
        ]);
    }

    public function actionRegisterToko()
    {
        // $this->layout = "main-login";
        $model = new Toko();
        // if (Yii::$app->request->isAjax) {
        //     return $this->renderAjax("registrasi", compact("model"));
        // }

        if ($model->load($_POST)) {
            $model->id_user = Yii::$app->user->identity->id;
            $model->created_at = date('Y-m-d H:i:s');
            // var_dump($model->registrasi());die;
            if ($model->save()) {
                Yii::$app->session->setFlash("success", "Pendaftaran berhasil");

                return $this->redirect(["home/toko-saya"]);
            }
            Yii::$app->session->setFlash("error", "Pendaftaran gagal. Validasi data tidak valid ");
        }
        // else {
        //     Yii::$app->session->setFlash("error", "Pendaftaran gagal");

        // }
        return $this->render('register-toko', [
            'model' => $model,
        ]);
    }
    public function actionAjaxSelectVariant()
    {
        // Yii::$app->response->format = Response::FORMAT_JSON;
        // include("../../config/db.php");
        // $warna = $_POST['warna'];
        // $size = $_POST['size'];
        // $stokes = ProductDetailVariant::find()
        //     ->select('*')
        //     ->innerJoin('product_detail', "product_detail_id = product_detail.id")
        //     ->where(['product_variant_id' => [$warna, $size]])
        //     ->groupBy('product_detail_id')
        //     ->having('count(*) = 2')
        //     ->asArray()
        //     ->one();

        if ($warna = !null && $size = !null) {
            $warna = $_POST['warna'];
            $size = $_POST['size'];
            $stokes = ProductDetailVariant::find()
                ->select('*')
                ->innerJoin('product_detail', "product_detail_id = product_detail.id")
                ->where(['product_variant_id' => [$warna, $size]])
                ->groupBy('product_detail_id')
                ->having('count(*) = 2')
                ->asArray()
                ->one();

            $output = $stokes["stok"] ?? 0;
            return $output;
        } else if ($warna = null && $size = !null) {
            $stokes = ProductDetailVariant::find()
                ->select('*')
                ->innerJoin('product_detail', "product_detail_id = product_detail.id")
                ->where(['product_variant_id' => [$size]])
                ->groupBy('product_detail_id')
                ->having('count(*) = 1')
                ->asArray()
                ->one();

            $output = $stokes["stok"] ?? 0;
            return $output;
        }

        // $warna = $_POST['warna'];
        // $size = $_POST['size'];
        // $stokes = ProductDetail::find()
        //     ->select('*')
        //     ->innerJoin('product_variant', "product_detail_id = product_detail.id")
        //     ->where(['product_variant.id' => [$warna, $size]])
        //     ->groupBy('product_variant.id')
        //     ->having('count(*) = 2')
        //     ->asArray()
        //     ->one();
    }

    public function actionAjaxSelectWeight()
    {
        if ($warna = !null && $size = !null) {
            $warna = $_POST['warna'];
            $size = $_POST['size'];
            $stokes = ProductDetailVariant::find()
                ->select('*')
                ->innerJoin('product_detail', "product_detail_id = product_detail.id")
                ->where(['product_variant_id' => [$warna, $size]])
                ->groupBy('product_detail_id')
                ->having('count(*) = 2')
                ->asArray()
                ->one();

            $output1 = $stokes["berat"] ?? 0;
            // $output = rtrim($output1, '0');
            $output = number_format($output1, 1) . ' gram';
            return $output;
        } else if ($warna = null && $size = !null) {
            $stokes = ProductDetailVariant::find()
                ->select('*')
                ->innerJoin('product_detail', "product_detail_id = product_detail.id")
                ->where(['product_variant_id' => [$size]])
                ->groupBy('product_detail_id')
                ->having('count(*) = 1')
                ->asArray()
                ->one();

            $output1 = $stokes["berat"] ?? 0;
            // $output = rtrim($output1, '0');
            $output = number_format($output1, 1) . ' gram';
            return $output;
        }
    }
    public function actionAjaxSelectHarga()
    {
        // Yii::$app->response->format = Response::FORMAT_JSON;
        // include("../../config/db.php");
        // $warna = $_POST['warna'];
        // $size = $_POST['size'];
        // $stokes = ProductDetailVariant::find()
        //     ->select('*')
        //     ->innerJoin('product_detail', "product_detail_id = product_detail.id")
        //     ->where(['product_variant_id' => [$warna, $size]])
        //     ->groupBy('product_detail_id')
        //     ->having('count(*) = 2')
        //     ->asArray()
        //     ->one();

        if ($warna = !null && $size = !null) {
            $warna = $_POST['warna'];
            $size = $_POST['size'];
            $stokes = ProductDetailVariant::find()
                ->select('*')
                ->innerJoin('product_detail', "product_detail_id = product_detail.id")
                ->where(['product_variant_id' => [$warna, $size]])
                ->groupBy('product_detail_id')
                ->having('count(*) = 2')
                ->asArray()
                ->one();

            $outputharga = $stokes["harga"] ?? 0;
            return \app\components\Angka::toReadableHarga($outputharga);
        } else if ($warna = null && $size = !null) {
            $stokes = ProductDetailVariant::find()
                ->select('*')
                ->innerJoin('product_detail', "product_detail_id = product_detail.id")
                ->where(['product_variant_id' => [$size]])
                ->groupBy('product_detail_id')
                ->having('count(*) = 1')
                ->asArray()
                ->one();

            $output = $stokes["harga"] ?? 0;
            return $output;
        }

        // $warna = $_POST['warna'];
        // $size = $_POST['size'];
        // $stokes = ProductDetail::find()
        //     ->select('*')
        //     ->innerJoin('product_variant', "product_detail_id = product_detail.id")
        //     ->where(['product_variant.id' => [$warna, $size]])
        //     ->groupBy('product_variant.id')
        //     ->having('count(*) = 2')
        //     ->asArray()
        //     ->one();

    }
    public function actionAjaxSelectIntharga()
    {
        // Yii::$app->response->format = Response::FORMAT_JSON;
        // include("../../config/db.php");
        // $warna = $_POST['warna'];
        // $size = $_POST['size'];
        // $stokes = ProductDetailVariant::find()
        //     ->select('*')
        //     ->innerJoin('product_detail', "product_detail_id = product_detail.id")
        //     ->where(['product_variant_id' => [$warna, $size]])
        //     ->groupBy('product_detail_id')
        //     ->having('count(*) = 2')
        //     ->asArray()
        //     ->one();

        if ($war = !null && $siz = !null) {
            $war = $_POST['war'];
            $siz = $_POST['siz'];
            $stokes = ProductDetailVariant::find()
                ->select('*')
                ->innerJoin('product_detail', "product_detail_id = product_detail.id")
                ->where(['product_variant_id' => [$war, $siz]])
                ->groupBy('product_detail_id')
                ->having('count(*) = 2')
                ->asArray()
                ->one();

            $outputharga = $stokes["harga"] ?? 0;
            return ($outputharga);
        } else if ($warna = null && $size = !null) {
            $stokes = ProductDetailVariant::find()
                ->select('*')
                ->innerJoin('product_detail', "product_detail_id = product_detail.id")
                ->where(['product_variant_id' => [$size]])
                ->groupBy('product_detail_id')
                ->having('count(*) = 1')
                ->asArray()
                ->one();

            $outputint = $stokes["harga"] ?? 0;
            return $outputint;
        }

        // $warna = $_POST['warna'];
        // $size = $_POST['size'];
        // $stokes = ProductDetail::find()
        //     ->select('*')
        //     ->innerJoin('product_variant', "product_detail_id = product_detail.id")
        //     ->where(['product_variant.id' => [$warna, $size]])
        //     ->groupBy('product_variant.id')
        //     ->having('count(*) = 2')
        //     ->asArray()
        //     ->one();

    }

    public function actionAjaxSelectProvinsi()
    {

        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://api.rajaongkir.com/starter/province",
            CURLOPT_SSL_VERIFYHOST => 0,
            CURLOPT_SSL_VERIFYPEER => 0,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_HTTPHEADER => array(
                "key: 654728f94c01d4867dd03c62a82adea3"
            ),
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        if ($err) {
            echo "cURL Error #:" . $err;
        } else {
            //get dalam bentuk json
            // kita konversi ke array dulu
            $array_response = json_decode($response, TRUE);
            $dataprovinsi = $array_response["rajaongkir"]["results"];

            echo "<option value=''> --Pilih Provinsi--</option>";
            foreach ($dataprovinsi as $key => $tiap_provinsi) {
                echo "<option value='" . $tiap_provinsi["province_id"] . "' id_provinsi='" . $tiap_provinsi["province_id"] . "'>";
                echo $tiap_provinsi["province"];
                echo '"</option>';
            }
        }
    }
    public function actionAjaxSelectCity()
    {
        $id_provinsi_terpilih = $_POST["id_provinsi"];
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://api.rajaongkir.com/starter/city?province=" . $id_provinsi_terpilih,
            CURLOPT_SSL_VERIFYHOST => 0,
            CURLOPT_SSL_VERIFYPEER => 0,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_HTTPHEADER => array(
                "key: 654728f94c01d4867dd03c62a82adea3"
            ),
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        if ($err) {
            echo "cURL Error #:" . $err;
        } else {
            $array_response = json_decode($response, TRUE);
            $datacity = $array_response["rajaongkir"]["results"];

            echo "<option value=''>--Pilih Distrik--</option>";

            foreach ($datacity as $key => $tiap_city) {
                echo "<option value='" . $tiap_city["city_id"] . "'            
                nama_provinsi ='" . $tiap_city["province"] . "'
                id_city ='" . $tiap_city["city_id"] . "'
                nama_city ='" . $tiap_city["city_name"] . "'
                tipe_city ='" . $tiap_city["type"] . "'
                kodepos ='" . $tiap_city["postal_code"] . "'>";
                echo $tiap_city["type"] . "";
                echo $tiap_city["city_name"];
                echo "</option>";
            }
        }
    }

    public function actionAjaxSelectPaket()
    {
        $tokoKecamatan = $_POST['tokoKecamatan'];
        $kecamatanPembeli = $_POST['kecamatanPembeli'];
        $ekspedisi = $_POST['ekspedisi'];
        $berat = $_POST['berat'];

        $originToko = Toko::find()->where(['idkec' => $tokoKecamatan])->all();

        $results = [];

        foreach ($originToko as $toko) {
            $curl = curl_init();

            curl_setopt_array($curl, array(
                CURLOPT_URL => "https://api.rajaongkir.com/starter/cost",
                CURLOPT_SSL_VERIFYHOST => 0,
                CURLOPT_SSL_VERIFYPEER => 0,
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => "",
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 30,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => "POST",
                CURLOPT_POSTFIELDS => "origin=" . $toko->idkec . "&destination=" . $kecamatanPembeli . "&weight=" . $berat . "&courier=" . $ekspedisi,
                CURLOPT_HTTPHEADER => array(
                    "content-type: application/x-www-form-urlencoded",
                    "key: 654728f94c01d4867dd03c62a82adea3"
                ),
            ));

            $response = curl_exec($curl);
            $err = curl_error($curl);

            curl_close($curl);

            if ($err) {
                echo "cURL Error #:" . $err;
            } else {
                $array_response = json_decode($response, TRUE);
                $paket = $array_response["rajaongkir"]["results"][0]["costs"];
                $results = null;

                foreach ($paket as $key => $tiap_paket) {
                    $service = $tiap_paket["service"];
                    $value = $tiap_paket["cost"][0]["value"];
                    $etd = $tiap_paket["cost"][0]["etd"];

                    $results[] = array(
                        'service' => $service,
                        'value' => $value,
                        'etd' => $etd
                    );
                }
            }
        }

        echo json_encode($results);
    }

    public function actionLogin()
    {

        if (!\Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {

            //log last login column
            $user = Yii::$app->user->identity;
            $user->last_login = new Expression("NOW()");
            $user->save();
            if ($user->role_id == 3) {

                return $this->redirect(Yii::$app->request->referrer);
            } else {
                return $this->goBack();
            }
        }
        return $this->render('login', [
            'model' => $model,
        ]);
    }
    public function actionLogins()
    {
        if (!\Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if (Yii::$app->request->isAjax) {
            return $this->renderAjax("login", compact("model"));
        }
        if ($model->load($_POST)) {
            if ($model->login()) {
                Yii::$app->session->setFlash("success", "Login berhasil");
                return $this->redirect(Yii::$app->request->referrer);
            }

            Yii::$app->session->setFlash("error", "Login gagal. Validasi data tidak valid");
            // Yii::$app->session->setFlash("error", "Login gagal. Validasi data tidak valid : " . Constant::flattenError($model->getErrors()));
            return $this->redirect(Yii::$app->request->referrer);
        } else {
            Yii::$app->session->setFlash("error", "Login gagal");
            return $this->redirect(Yii::$app->request->referrer);
        }
    }

    public function actionLupa()
    {
        // if (!\Yii::$app->user->isGuest) {
        //     return $this->goHome();
        // }
        // var_dump("tes");die;
        if (Yii::$app->request->isAjax) {
            return $this->renderAjax("lupa");
        }
        $getEmail = $_POST['Lupa']['email'];
        $getModel = \app\models\User::find()->where(['username' => $getEmail])->one();
        if (isset($_POST['Lupa'])) {
            if ($getModel != null) {
                // if ($detik >= 01 || $getModel->is_used == 0) {
                $getToken = rand(0, 99999);
                $getTime = date("Y-m-d H:i:s");
                $getModel->secret_link = md5($getToken . $getTime);
                $getModel->secret_at = $getTime;
                $getModel->secret_is_used = 1;
                $subjek = "Reset Password";
                $text = "Klik link berikut untuk mengatur ulang Password. 
                    <b>Harap diperhatikan bahwa link berikut hanya berlaku 5 menit.</b><br>
                    Abaikan jika Anda tidak mengatur ulang password!<br/> 
                    <a href='
                    http://" . Url::base('http') . "/site/ganti-password?token=" . $getModel->secret_link . "'>Klik Disini</a>
                    <br/> Jika link tidak dapat dibuka salin teks berikut dan tempel di url browser : <br/>
                    " . Url::base('http') . "/site/ganti-password?token=" . $getModel->secret_link;
                if ($getModel->validate()) {

                    // $getModel->token_created_at = null;
                    Yii::$app->mailer->compose()
                        ->setTo($getModel->username)
                        ->setFrom(['adminIsalam@gmail.com' => 'Isalam'])
                        ->setSubject($subjek)
                        ->setHtmlBody($text)
                        ->send();
                    $getModel->save();

                    // \Yii::$app->getSession()->setFlash(
                    //     'success',
                    //     ''
                    // );
                    Yii::$app->session->setFlash("success", "Link untuk mereset Password Anda telah dikirim ke email Anda. Mohon <b>Cek Spam</b> jika tidak ada di kotak masuk!");
                    return $this->redirect(Yii::$app->request->referrer);
                }
            } else {
                // \Yii::$app->getSession()->setFlash(
                //     'error',
                //     'Email Tidak Terdaftar'
                // );
                Yii::$app->session->setFlash("false", "Email Tidak Terdaftar");
                return $this->redirect(Yii::$app->request->referrer);
            }
        }
        // Yii::$app->session->setFlash("false", "Email Tidak Terdaftar");
        return $this->redirect(Yii::$app->request->referrer);
    }

    public function actionIndex()
    {
        date_default_timezone_set('Asia/Jakarta');
        $params = array(
            'transaction_details' => array(
                'order_id' => rand(),
                'gross_amount' => 10000,
            )
        );
        $setting = Setting::find()->one();
        $icon = \Yii::$app->request->baseUrl . "/uploads/setting/" . $setting->logo;

        // $icon2 = \Yii::$app->request->baseUrl . "/uploads/setting/" . $setting->logo;
        $bg_login = \Yii::$app->request->baseUrl . "/uploads/setting/" . $setting->banner;
        $bg = \Yii::$app->request->baseUrl . "/uploads/setting/" . $setting->banner;
        $count_wakif = User::find()->where(['role_id' => 5])->count();

        $galeris = Galeri::find()->where(['flag' => 0])->limit(5)->all();
        $slides = Slides::find()->where(['status' => 1])->orderBy(new Expression('rand()'))->one();
        $slider = Slides::find()->where(['status' => 1])->all();
        $produk = Produk::find()->limit(8)->orderBy(new Expression('rand()'))->all();
        $produks = Produk::find()->limit(3)->orderBy(new Expression('rand()'))->all();
        $populers = Produk::find()->limit(30)->orderBy(['view_count' => SORT_DESC])->all();
        $ratings = Produk::find()
            ->joinWith('reviewProduks') // Melakukan join dengan tabel 'review_produk'
            ->select('produk.*, AVG(review_produk.rating) as average_rating') // Menghitung rata-rata rating
            ->groupBy('produk.id') // Mengelompokkan berdasarkan produk
            ->orderBy(['average_rating' => SORT_DESC]) // Mengurutkan berdasarkan rating terbaik
            ->limit(18)
            ->all();
        $latest = Produk::find()->limit(30)->orderBy(['id' => SORT_DESC])->all();
        $model = new HubungiKami;
        $kategoris = KategoriProduk::find()->all();

        if ($model->load($_POST)) {

            if ($model->save()) {
                Yii::$app->session->setFlash('success', "Data berhasil disimpan.");
            } else {
                Yii::$app->session->setFlash('error', "Data tidak berhasil disimpan.");
            }
            return $this->redirect(['home/index']);
        }

        return $this->render('index', [
            'setting' => $setting,
            'galeris' => $galeris,
            'slider' => $slider,
            // 'snapToken' => $snapToken,
            'count_wakif' => $count_wakif,
            'icon' => $icon,
            'bg_login' => $bg_login,
            'bg' => $bg,
            'slides' => $slides,
            'model' => $model,
            'produk' => $produk,
            'produks' => $produks,
            'kategoris' => $kategoris,
            'populers' => $populers,
            'ratings' => $ratings,
            'latest' => $latest
        ]);
    }
    public function actionProduk()
    {
        date_default_timezone_set('Asia/Jakarta');
        $params = array(
            'transaction_details' => array(
                'order_id' => rand(),
                'gross_amount' => 10000,
            )
        );
        $setting = Setting::find()->one();
        $icon = \Yii::$app->request->baseUrl . "/uploads/setting/" . $setting->logo;
        $bg_login = \Yii::$app->request->baseUrl . "/uploads/setting/" . $setting->banner;
        $bg = \Yii::$app->request->baseUrl . "/uploads/setting/" . $setting->banner;
        $count_wakif = User::find()->where(['role_id' => 5])->count();

        $galeris = Galeri::find()->where(['flag' => 0])->limit(5)->all();
        $slides = Slides::find()->where(['status' => 1])->orderBy(new Expression('rand()'))->one();
        $slider = Slides::find()->where(['status' => 1])->all();
        $kategoris = KategoriProduk::find()->all();
        $model = new HubungiKami;
        // $produk = Produk::find()->limit(6)->all();
        // $produks = Produk::find()->orderBy(new Expression('rand()'))->one();

        // if (isset($_GET['kategori'])) {
        //     $kategori = $_GET['kategori'];
        //     $get_id = KategoriProduk::find()->where(['nama' => $kategori])->one();
        //     $query = Produk::find()->where(['kategori_produk_id' => $get_id]);
        //     $discount = Produk::find()
        //         ->where(['kategori_produk_id' => $get_id])
        //         ->andWhere(['!=', 'diskon', 0])
        //         ->andWhere(['=', 'diskon_status', 1]);
        //     // echo '<pre>';
        //     // var_dump($discount);
        //     // die;
        //     $count = $query->count();
        //     $countdiscount = $discount->count();
        //     $pagination = new Pagination(['totalCount' => $count, 'pageSize' => 9]);
        //     $paginationdiscount = new Pagination(['totalCount' => $countdiscount, 'pageSize' => 9]);
        //     $produks = $query->offset($pagination->offset)
        //         ->limit($pagination->limit)
        //         ->all();
        //     $produkscdiscount = $discount->offset($paginationdiscount->offset)
        //         ->limit($paginationdiscount->limit)
        //         ->all();
        //     // var_dump($produks);
        //     $produkterbaru = Produk::find()->where(['kategori_produk_id' => $get_id])
        //         ->orderBy(['id' => SORT_DESC])
        //         ->limit(30)
        //         ->all();
        //     $summary = Constant::getPaginationSummary($pagination, $count);
        //     if (isset($_GET['cari'])) {
        //         $kategori = $_GET['kategori'];
        //         $get_id = KategoriProduk::find()->where(['nama' => $kategori])->one();
        //         $query = Produk::find()->where(['kategori_produk_id' => $get_id]);
        //         $discount = Produk::find()
        //             ->where(['kategori_produk_id' => $get_id])
        //             ->andWhere(['!=', 'diskon', 0])
        //             ->andWhere(['=', 'diskon_status', 1])
        //             ->andWhere(['like', 'nama', $_GET['cari']]);
        //         // echo '<pre>';
        //         // var_dump($discount);
        //         // die;
        //         $count = $query->count();
        //         $countdiscount = $discount->count();
        //         $pagination = new Pagination(['totalCount' => $count, 'pageSize' => 9]);
        //         $paginationdiscount = new Pagination(['totalCount' => $countdiscount, 'pageSize' => 9]);
        //         $produks = $query->andWhere((['like', 'nama', $_GET['cari']]))->offset($pagination->offset)
        //             ->limit($pagination->limit)
        //             ->all();
        //         $produkscdiscount = $discount->andWhere((['like', 'nama', $_GET['cari']]))->offset($paginationdiscount->offset)
        //             ->limit($paginationdiscount->limit)
        //             ->all();
        //         // var_dump($produks);
        //         $produkterbaru = Produk::find()->where(['kategori_produk_id' => $get_id])->andWhere((['like', 'nama', $_GET['cari']]))
        //             ->orderBy(['id' => SORT_DESC])
        //             ->limit(30)
        //             ->all();
        //         $summary = Constant::getPaginationSummary($pagination, $count);
        //     }
        // } else {
        //     $query = Produk::find();
        //     $discount = Produk::find()
        //         ->where(['diskon_status' => 1])
        //         ->andWhere(['!=', 'diskon', 0]);
        //     $count = $query->count();
        //     $countdiscount = $discount->count();
        //     $pagination = new Pagination(['totalCount' => $count, 'pageSize' => 9]);
        //     $paginationdiscount = new Pagination(['totalCount' => $countdiscount, 'pageSize' => 9]);
        //     $produks = $query->offset($pagination->offset)
        //         ->limit($pagination->limit)
        //         ->all();
        //     $produkterbaru = Produk::find()
        //         ->orderBy(['id' => SORT_DESC])
        //         ->limit(30)
        //         ->all();
        //     $produkscdiscount = $discount->offset($paginationdiscount->offset)
        //         ->limit($paginationdiscount->limit)
        //         ->all();
        //     $summary = Constant::getPaginationSummary($pagination, $count);
        //     if (isset($_GET['cari'])) {
        //         $query = Produk::find();
        //         $discount = Produk::find()
        //             ->where(['diskon_status' => 1])
        //             ->andWhere(['!=', 'diskon', 0])
        //             ->andWhere((['like', 'nama', $_GET['cari']]));
        //         $count = $query->count();
        //         $countdiscount = $discount->count();
        //         $pagination = new Pagination(['totalCount' => $count, 'pageSize' => 9]);
        //         $paginationdiscount = new Pagination(['totalCount' => $countdiscount, 'pageSize' => 9]);
        //         $produks = $query->andWhere((['like', 'nama', $_GET['cari']]))->offset($pagination->offset)
        //             ->limit($pagination->limit)
        //             ->all();
        //         $produkterbaru = Produk::find()->andWhere((['like', 'nama', $_GET['cari']]))->offset($pagination->offset)
        //             ->orderBy(['id' => SORT_DESC])
        //             ->limit(30)
        //             ->all();
        //         $produkscdiscount = $discount->andWhere((['like', 'nama', $_GET['cari']]))->offset($paginationdiscount->offset)
        //             ->limit($paginationdiscount->limit)
        //             ->all();
        //         $summary = Constant::getPaginationSummary($pagination, $count);
        //     }
        // }

        // 
        // 
        // 
        $produks = Produk::find();
        $produkscdiscount = Produk::find()
            ->where(['diskon_status' => 1])
            ->andWhere(['!=', 'diskon', 0]);
        if (isset($_GET['kategori'])) {
            $kategori = $_GET['kategori'];
            $get_id = KategoriProduk::find()->where(['nama' => $kategori])->one();
            $produks->andWhere(['kategori_produk_id' => $get_id]);
            $produkscdiscount->where(['kategori_produk_id' => $get_id]);
        }
        if (isset($_GET['cari'])) {
            $produks->andWhere(['like', 'nama', $_GET['cari']]);
            $produkscdiscount->andWhere((['like', 'nama', $_GET['cari']]));
        }
        if (isset($_GET['sort'])) {
            switch (intval($_GET['sort'])) {
                case 1:
                    $produks->orderBy(['created_at' => SORT_DESC]);
                    $produkscdiscount->orderBy(['created_at' => SORT_DESC]);
                    break;
                case 2:
                    $produks->orderBy(['updated_at' => SORT_DESC]);
                    break;
                case 3:
                    // $query->andWhere(['kategori_berita_id' => $kategori->id]);

                    $produks->orderBy(['view_count' => SORT_DESC]);
                    break;
                case 4:
                    $produks->orderBy(['created_at' => SORT_DESC]);
                    break;
            }
        }
        if (isset($_GET['sort'])) {
            switch (intval($_GET['sort'])) {
                case 1:
                    break;
                case 2:
                    $produkscdiscount->orderBy(['updated_at' => SORT_DESC]);
                    break;
                case 3:
                    // $query->andWhere(['kategori_berita_id' => $kategori->id]);

                    $produkscdiscount->orderBy(['view_count' => SORT_DESC]);
                    break;
                case 4:
                    $produkscdiscount->orderBy(['created_at' => SORT_DESC]);
                    break;
            }
        }

        $cloned =  $produks;
        $count = $cloned->count();
        $pagination = new Pagination([
            "totalCount" => $count,
            "pageSize" => 9
        ]);
        $produks = $produks->offset($pagination->offset)
            ->limit($pagination->limit)
            ->all();

        // 
        $clonedpd =  $produkscdiscount;
        $countpd = $clonedpd->count();
        $paginationpd = new Pagination([
            "totalCount" => $countpd,
            "pageSize" => 9
        ]);
        $produkscdiscount = $produkscdiscount->offset($paginationpd->offset)
            ->limit($paginationpd->limit)
            ->all();

        $summary = Constant::getPaginationSummary($pagination, $count);


        // if ($model->load($_POST)) {

        //     if ($model->save()) {
        //         Yii::$app->session->setFlash('success', "Data berhasil disimpan.");
        //     } else {
        //         Yii::$app->session->setFlash('error', "Data tidak berhasil disimpan.");
        //     }
        //     return $this->redirect(['home/index']);
        // }

        return $this->render('produk', [
            'setting' => $setting,
            'galeris' => $galeris,
            'slider' => $slider,
            'kategoris' => $kategoris,
            // 'produk' => $produk,            
            'produks' => $produks,
            'pagination' => $pagination,
            // 'produkterbaru' => $produkterbaru,
            'produkscdiscount' => $produkscdiscount,
            'summary' => $summary,
            'get_id' => $get_id,
            // 'snapToken' => $snapToken,
            'count_wakif' => $count_wakif,
            'icon' => $icon,
            'bg_login' => $bg_login,
            'bg' => $bg,
            'slides' => $slides,
            'model' => $model,
        ]);
    }
    public function actionListProduk()
    {
        $setting = Setting::find()->one();
        $icon = \Yii::$app->request->baseUrl . "/uploads/setting/" . $setting->logo;


        if (isset($_GET['kategori'])) {
            $kategori = $_GET['kategori'];
            $get_id = KategoriProduk::find()->where(['nama' => $kategori])->one();
            $query = Produk::find()->where(['kategori_produk_id' => $get_id]);
            $count = $query->count();
            $pagination = new Pagination(['totalCount' => $count, 'pageSize' => 9]);
            $produks = $query->offset($pagination->offset)
                ->limit($pagination->limit)
                ->all();
        } else {
            $query = Produk::find();
            $count = $query->count();
            $pagination = new Pagination(['totalCount' => $count, 'pageSize' => 9]);
            $produks = $query->offset($pagination->offset)
                ->limit($pagination->limit)
                ->all();
        }
        $summary = Constant::getPaginationSummary($pagination, $count);

        $kategori_produks = KategoriProduk::find()->all();
        $count_wakif = User::find()->where(['role_id' => 5])->count();

        return $this->render('list-produk', [
            'setting' => $setting,
            'count_wakif' => $count_wakif,
            'produks' => $produks,
            'kategori_produks' => $kategori_produks,
            'icon' => $icon,
            'pagination' => $pagination,
            'summary' => $summary,
        ]);
    }
    public function actionDetailProduk($id)
    {
        date_default_timezone_set('Asia/Jakarta');
        $params = array(
            'transaction_details' => array(
                'order_id' => rand(),
                'gross_amount' => 10000,
            )
        );
        $setting = Setting::find()->one();
        $icon = \Yii::$app->request->baseUrl . "/uploads/setting/" . $setting->logo;
        $bg_login = \Yii::$app->request->baseUrl . "/uploads/setting/" . $setting->banner;
        $bg = \Yii::$app->request->baseUrl . "/uploads/setting/" . $setting->banner;
        $count_wakif = User::find()->where(['role_id' => 5])->count();

        $galeris = Galeri::find()->where(['flag' => 0])->limit(5)->all();
        $slides = Slides::find()->where(['status' => 1])->orderBy(new Expression('rand()'))->one();
        $slider = Slides::find()->where(['status' => 1])->all();
        $kategoris = KategoriProduk::find()->all();
        $model = new HubungiKami;
        $produk = Produk::findOne(['id' => $id]);
        $fotos_produk = FotoProduk::find()->where(['produk_id' => $id])->all();
        $count_review = ReviewProduk::find()->where(['produk_id' => $id])->count();



        $alamats = Alamat::find()->where(["usrid" => Yii::$app->user->id])->all();

        $stocks = ProductDetail::find()->where(['id_product' => $id])->all();

        $already_view = Yii::$app->session->get('viewproduk');
        if (is_array($already_view) == false) $already_view = [];
        if (in_array($produk->id, $already_view) == false) {
            $produk->view_count++;
            $produk->save(false);
            array_push($already_view, $produk->id);
        }

        Yii::$app->session->set('viewproduk', $already_view);
        // $getwarnas = ProductDetail::find()
        //     ->select('product_variant.*')
        //     ->innerJoin('product_variant', '`product_detail_id` = `product_detail`.`id` and`type` = "color"')
        //     ->where(['id_product' => $id])
        //     ->all();

        // $getsizes = ProductDetail::find()
        //     ->select('product_variant.*')
        //     ->innerJoin('product_variant', '`product_detail_id` = `product_detail`.`id` and`type` = "color"')
        //     ->where(['id_product' => $id])
        //     ->all();


        $getwarnas = ProductVariant::find()
            ->select('product_variant.*')
            ->innerJoin('product_detail', "product_detail_id = product_detail.id")
            ->where(['product_detail.id_product' => $id, 'type' => "color"])
            ->all();

        $getsizes = ProductVariant::find()
            ->select('product_variant.*')
            ->innerJoin('product_detail', "product_detail_id = product_detail.id")
            ->where(['product_detail.id_product' => $id, 'type' => "size"])
            ->all();

        $minimumprice = ProductDetail::find()->where(['id_product' => $id])->min('harga');
        $maximumprice = ProductDetail::find()->where(['id_product' => $id])->max('harga');
        $averageprice = ProductDetail::find()->where(['id_product' => $id])->average('harga');

        // $stokones = ProductDetailVariant::find()
        //     ->select('*')
        //     ->innerJoin('product_detail', "product_detail_id = product_detail.id")
        //     ->where(['product_variant_id' => [3, 4]])
        //     ->groupBy('product_detail_id')
        //     ->having('count(*) = 2')
        //     ->asArray()
        //     ->one();

        $stokones = ProductDetail::find()
            ->where(['id_product' => $id])
            ->sum('stok');
        $weightone1 = ProductDetail::find()
            ->where(['id_product' => $id])
            ->average('berat');

        $weightone = number_format($weightone1, 1) . ' gram';
        // ->one();

        // dd($stokones);


        // $getsizes = ProductDetail::find()->where([
        //     'type' => 'size',
        //     'id_product' => $id
        // ])->all();

        // $produk_get= ProdukVariant::find()->where(['type' => "color"]) and (["id_produk = 1"])->all();
        // $produk_detail = ProdukDetail::find()->where(['produk_id' => $id])->all();

        // $customer = Customer::findAll([
        //     'type' => 'color',
        //     'id_produk' => $id,
        // ]);


        // $review_produks = ReviewProduk::find()->where(['produk_id'=>$id])->all();
        // $query_pagi_review = ReviewProduk::find()->where(['produk_id'=>$id]);
        // $pagination = new Pagination(['totalCount' => $query_pagi_review->count(), 'pageSize'=>2]);

        $query_pagi_review = ReviewProduk::find()->where(['produk_id' => $id]);
        $countQuery = clone $query_pagi_review;
        $pagination = new Pagination(['totalCount' => $countQuery->count(), 'pageSize' => 2]);
        $review_produks = $query_pagi_review->offset($pagination->offset)
            ->orderBy(['id' => SORT_DESC])
            ->limit($pagination->limit)
            ->all();
        $jml = $query_pagi_review->sum('rating');
        if ($jml == null) {
            $round_jml = 0;
        } else {
            $round_jml = round($jml / $count_review);
        }
        // $round_jml = 5;

        if ($produk == null) throw new HttpException(404);
        if ($model->load($_POST)) {

            if ($model->save()) {
                Yii::$app->session->setFlash('success', "Data berhasil disimpan.");
            } else {
                Yii::$app->session->setFlash('error', "Data tidak berhasil disimpan.");
            }
            return $this->redirect(['home/index']);
        }

        $model_member = new ReviewProduk();

        if ($model_member->load($_POST)) {
            try {
                if ($model_member->save()) {
                    Yii::$app->session->setFlash('success', "Review berhasil disimpan.");
                } else {
                    Yii::$app->session->setFlash('error', "Review tidak berhasil disimpan.");
                }
            } catch (\Exception $e) {
                $msg = (isset($e->errorInfo[2])) ? $e->errorInfo[2] : $e->getMessage();
                $model_member->addError('_exception', $msg);
            }

            return $this->redirect(['home/detail-produk', 'id' => $id]);
        }

        return $this->render('detail-produk', [
            'setting' => $setting,
            'galeris' => $galeris,
            'slider' => $slider,
            'kategoris' => $kategoris,
            'produk' => $produk,
            'fotos_produk' => $fotos_produk,
            'pagination' => $pagination,
            'review_produks' => $review_produks,
            'jml' => $jml,
            'round_jml' => $round_jml,
            // 'snapToken' => $snapToken,
            'count_wakif' => $count_wakif,
            'icon' => $icon,
            'bg_login' => $bg_login,
            'bg' => $bg,
            'slides' => $slides,
            'model' => $model,
            'count_review' => $count_review,
            'model_member' => $model_member,
            'alamats' => $alamats,
            'getwarnas' => $getwarnas,
            'getsizes' => $getsizes,
            'stocks' => $stocks,
            'stokones' => $stokones,
            'minimumprice' => $minimumprice,
            'maximumprice' => $maximumprice,
            'averageprice' => $averageprice,
            'weightone' => $weightone,
        ]);
    }



    public function actionAbout()
    {
        //about ipi
        $setting = Setting::find()->one();
        $slides = Slides::find()->where(['status' => 1])->orderBy(new Expression('rand()'))->one();
        $icon = \Yii::$app->request->baseUrl . "/uploads/setting/" . $setting->logo;
        $bg_login = \Yii::$app->request->baseUrl . "/uploads/setting/" . $setting->banner;
        $bg = \Yii::$app->request->baseUrl . "/uploads/setting/" . $setting->banner;
        $struktur_organisasi = StrukturOrganisasi::find()->where(['flag' => 0])->all();
        $count_wakif = User::find()->where(['role_id' => 5])->count();
        $nilais = NilaiSikap::find()->all();
        $keuntungans = Keuntungan::find()->all();
        $model = new HubungiKami;

        //member of ipi
        $members = Toko::find();
        $count = $members->count();
        $pagination = new Pagination(['totalCount' => $count, 'pageSize' => 6]);
        $member = $members->offset($pagination->offset)
            ->limit($pagination->limit)
            ->all();
        $summary = Constant::getPaginationSummary($pagination, $count);


        if ($model->load($_POST)) {
            $model->status = 0;

            if ($model->save()) {
                Yii::$app->session->setFlash('success', "Data berhasil disimpan.");
            } else {
                Yii::$app->session->setFlash('error', "Data tidak berhasil disimpan.");
            }
            return $this->redirect(['home/about']);
        }

        return $this->render('about_us', [
            'setting' => $setting,
            'slides' => $slides,
            'nilais' => $nilais,
            'keuntungans' => $keuntungans,
            'count_wakif' => $count_wakif,
            'struktur_organisasi' => $struktur_organisasi,
            'icon' => $icon,
            'bg_login' => $bg_login,
            'bg' => $bg,
            'model' => $model,
            //member of ipi
            'member' => $member,
            'summary' => $summary,
            'pagination' => $pagination
        ]);
    }
    public function actionMember()
    {
        $members = Toko::find();
        $count = $members->count();
        $pagination = new Pagination(['totalCount' => $count, 'pageSize' => 6]);
        $member = $members->offset($pagination->offset)
            ->limit($pagination->limit)
            ->all();
        $summary = Constant::getPaginationSummary($pagination, $count);
        return $this->render('member', [
            'member' => $member,
            'summary' => $summary,
            'pagination' => $pagination
        ]);
    }

    public function actionHubungi()
    {
        $model = new HubungiKami();

        // var_dump($_POST['perusahaan']);die;
        if (isset($_POST)) {
            $model->nama = "-";
            $model->nomor_hp = "-";
            $model->perusahaan = $_POST['perusahaan'];
            $model->email = $_POST['email'];
            $model->pesan = $_POST['pesan'];
            $model->created_at = date('Y-m-d H:i:s');
            if ($model->save()) {
                Yii::$app->session->setFlash('success', "Data berhasil disimpan.");
            } else {
                Yii::$app->session->setFlash('error', "Data tidak berhasil disimpan.");
            }
            return $this->redirect(['home/index']);
        }
    }
    public function actionReview($id)
    {
        $model = new ReviewProduk();

        // var_dump($_POST['perusahaan']);die;
        if ($id == null) {

            return $this->redirect(['home/produk']);
        }
        if (isset($_POST)) {
            $model->produk_id = $id;
            $model->nama = $_POST['nama'];
            $model->review = $_POST['review'];
            $model->email = $_POST['email'];
            $model->rating = (int)$_POST['rate'];
            $model->created_at = date('Y-m-d H:i:s');
            if ($model->save()) {
                Yii::$app->session->setFlash('success', "Terima Kasih Telah Memberikan Ulasan");
            } else {
                Yii::$app->session->setFlash('error', "Gagal Menyimpan Ulasan");
            }
            return $this->redirect(['home/detail-produk', "id" => $id]);
        }

        return $this->redirect(['home/detail-produk', "id" => $id]);
    }
    // public function actionOrganisasi()
    // {
    //     $setting = Setting::find()->one();
    //     $icon = \Yii::$app->request->baseUrl . "/uploads/setting/" . $setting->logo;
    //     $bg_login = \Yii::$app->request->baseUrl . "/uploads/setting/" . $setting->banner;
    //     $bg = \Yii::$app->request->baseUrl . "/uploads/setting/" . $setting->banner;
    //     $organisasis = Organisasi::find()->where(['flag' => 1])->all();
    //     $count_wakif = User::find()->where(['role_id' => 5])->count();
    //     $model = new HubungiKami;


    //     if ($model->load($_POST)) {
    //         $model->status = 0;

    //         if ($model->save()) {
    //             Yii::$app->session->setFlash('success', "Data berhasil disimpan.");
    //         } else {
    //             Yii::$app->session->setFlash('error', "Data tidak berhasil disimpan.");
    //         }
    //         return $this->redirect(['home/organisasi']);
    //     }

    //     return $this->render('struktur_organisasi', [
    //         'setting' => $setting,
    //         'count_wakif' => $count_wakif,
    //         'organisasis' => $organisasis,
    //         'icon' => $icon,
    //         'bg_login' => $bg_login,
    //         'bg' => $bg,
    //         'model' => $model
    //     ]);
    // }
    public function actionUmkm()
    {

        $setting = Setting::find()->one();
        return $this->render('umkm', []);
    }
    public function actionKontak()
    {
        $setting = Setting::find()->one();
        $icon = \Yii::$app->request->baseUrl . "/uploads/setting/" . $setting->logo;
        $bg_login = \Yii::$app->request->baseUrl . "/uploads/setting/" . $setting->banner;
        $bg = \Yii::$app->request->baseUrl . "/uploads/setting/" . $setting->banner;
        $count_wakif = User::find()->where(['role_id' => 5])->count();
        $model = new HubungiKami;


        if ($model->load($_POST)) {
            // $model->status = 0;
            $model->created_at = date('Y-m-d H:i:s');
            if ($model->save()) {
                Yii::$app->session->setFlash('success', "Data berhasil disimpan.");
            } else {
                Yii::$app->session->setFlash('error', "Data tidak berhasil disimpan.");
            }
            return $this->redirect(['home/kontak']);
        }

        return $this->render('kontak', [
            'setting' => $setting,
            'count_wakif' => $count_wakif,
            'icon' => $icon,
            'bg_login' => $bg_login,
            'bg' => $bg,
            'model' => $model
        ]);
    }
    public function actionEditToko()
    {
        $model = Toko::find()->where(["id_user" => Yii::$app->user->id])->one();
        $setting = Setting::find()->one();
        $icon = \Yii::$app->request->baseUrl . "/uploads/setting/" . $setting->logo;


        if ($model->load($_POST)) {
            $model->updated_at = date('Y-m-d H:i:s');

            // if ($model->validate()) {
            if ($model->save(false)) {
                Yii::$app->session->setFlash("success", "Toko berhasil diubah");
                // }
            } else {
                Yii::$app->session->setFlash("error", "Toko gagal diubah");
            }
            return $this->redirect(["toko-saya"]);
        }
        end:
        return $this->render('edit-toko', [
            'model' => $model,
            'setting' => $setting,
            'icon' => $icon,
        ]);
    }
    public function actionTokoSaya()
    {
        $confirm = Yii::$app->user->identity->confirm;
        $status = Yii::$app->user->identity->status;
        if ($confirm != 1 || $status != 1) {
            return $this->redirect(["home/index"]);
        }
        $toko = Toko::findOne(['id_user' => Yii::$app->user->identity->id]);
        $setting = Setting::find()->one();
        $icon = \Yii::$app->request->baseUrl . "/uploads/setting/" . $setting->logo;



        return $this->render('toko-saya', [
            'toko' => $toko,
            'setting' => $setting,
            'icon' => $icon,
        ]);
    }
    public function actionProdukSaya()
    {
        $searchModel  = new ProdukSayaSearch;
        $dataProvider = $searchModel->search($_GET);
        $dataProvider->pagination = ['pageSize' => 2];
        Tabs::clearLocalStorage();

        Url::remember();
        \Yii::$app->session['__crudReturnUrl'] = null;

        return $this->render('produk-saya', [
            'dataProvider' => $dataProvider,
            'searchModel' => $searchModel,
        ]);
    }

    public function actionViewProduk($id)
    {
        $model = $this->findModelProduk($id);
        // $details = $model->details;

        \Yii::$app->session['__crudReturnUrl'] = Url::previous();
        Url::remember();
        Tabs::rememberActiveState();
        $model = Produk::findOne(['id' => $id]);
        return $this->render('produk/view', [
            'model' => $model,
            // 'details' => $details,
        ]);
    }

    public function actionCreateProduk()
    {
        $model = new Produk;
        // var_dump($model);
        // die;
        $modelsProductDetail = [new ProductDetail];
        $modelsProductVariant = [[new ProductVariant]];
        // var_dump(Yii::$app->request->post());
        // die;

        try {
            if ($model->load($_POST)) {

                $modelsProductDetail = Model::createMultiple(ProductDetail::classname());
                Model::loadMultiple($modelsProductDetail, Yii::$app->request->post());
                // var_dump($modelsProductDetail);
                // die;

                // validate person and houses models
                $valid = $model->validate();
                if ($valid) {
                    $transaction = Yii::$app->db->beginTransaction();
                    // var_dump($transaction);
                    // die;
                    try {
                        if ($flag = $model->save(false)) {
                            $valid = Model::validateMultiple($modelsProductDetail) && $valid;

                            if (isset($_POST['ProductVariant'][0][0])) {
                                foreach ($_POST['ProductVariant'] as $indexProductDetail => $productvariants) {
                                    foreach ($productvariants as $indexProductVariant => $productvariant) {
                                        // var_dump($productvariant);
                                        // die;
                                        $data['ProductVariant'] = $productvariant;
                                        $modelProductVariant = new ProductVariant;
                                        $modelProductVariant->load($data);
                                        $modelProductVariant->id_produk = $model->id;
                                        $modelsProductVariant[$indexProductDetail][$indexProductVariant] = $modelProductVariant;
                                        $valid = $modelProductVariant->validate();

                                        if ($valid == false) {
                                            // var_dump($modelProductVariant->getErrors());
                                            // die;
                                        }
                                    }
                                }
                            }

                            foreach ($modelsProductDetail as $indexProductDetail => $modelProductDetail) {

                                if ($flag === false) {
                                    break;
                                }


                                $modelProductDetail->id_product = $model->id;

                                $modelProductDetail->validate();
                                if (!($flag = $modelProductDetail->save(false))) {
                                    break;
                                }



                                if (isset($modelsProductVariant[$indexProductDetail]) && is_array($modelsProductVariant[$indexProductDetail])) {
                                    foreach ($modelsProductVariant[$indexProductDetail] as $indexProductVariant => $modelProductVariant) {
                                        $modelProductVariant->product_detail_id = $modelProductDetail->id;
                                        $modelProductVariant->validate();
                                        if (!($flag = $modelProductVariant->save(false))) {
                                            break;
                                        }

                                        // inputkan detail produk variant
                                        $newDetailVariant = new ProductDetailVariant;
                                        $newDetailVariant->product_detail_id = $modelProductDetail->id;
                                        $newDetailVariant->product_variant_id = $modelProductVariant->id;
                                        if (!($flag = $newDetailVariant->save(false))) {
                                            break;
                                        }
                                    }
                                }
                            }
                        }
                    } catch (Exception $e) {
                        $transaction->rollBack();
                    }
                }


                $toko = Toko::findOne(['id_user' => Yii::$app->user->identity->id]);
                $model->toko_id = $toko->id;
                $model->created_at = date('Y-m-d H:i:s');
                $foto_banners = UploadedFile::getInstance($model, 'foto_banner');
                if ($foto_banners != NULL) {
                    # store the source foto_banners name
                    $model->foto_banner = $foto_banners->name;
                    $arr = explode(".", $foto_banners->name);
                    $extension = end($arr);

                    # generate a unique foto_banners name
                    $model->foto_banner = Yii::$app->security->generateRandomString() . ".{$extension}";

                    # the path to save foto_banners
                    // unlink(Yii::getAlias("@app/web/uploads/pengajuan/") . $oldFile);
                    if (file_exists(Yii::getAlias("@app/web/uploads/banner_produk/")) == false) {
                        mkdir(Yii::getAlias("@app/web/uploads/banner_produk/"), 0777, true);
                    }
                    $path = Yii::getAlias("@app/web/uploads/banner_produk/") . $model->foto_banner;
                    $foto_banners->saveAs($path);
                }
                if ($model->save()) {
                    // var_dump($model);
                    // die;
                    if ($flag) {
                        // var_dump($transaction);
                        // die;
                        // var_dump($modelProductDetail);
                        // var_dump($model);
                        // var_dump($modelProductVariant);
                        // die;
                        $transaction->commit();
                        return $this->redirect(['view-produk', 'id' => $model->id]);
                    } else {
                        $transaction->rollBack();
                    }
                }
            } elseif (!\Yii::$app->request->isPost) {
                $model->load($_GET);
            }
        } catch (Exception $e) {
            $msg = (isset($e->errorInfo[2])) ? $e->errorInfo[2] : $e->getMessage();
            $model->addError('_exception', $msg);
        }
        return $this->render('produk/create', [
            'model' => $model,
            'modelsProductDetail' => (empty($modelsProductDetail)) ? [new ProductDetail] : $modelsProductDetail,
            'modelsProductVariant' => (empty($modelsProductVariant)) ? [[new ProductVariant]] : $modelsProductVariant
        ]);
    }


    public function actionUpdateProduk($id)
    {
        $model = $this->findModelProduk($id);
        $modelsProductDetail = $model->productDetail;
        $modelsProductVariant = [];
        $oldProductVariants = [];

        if (!empty($modelsProductDetail)) {
            foreach ($modelsProductDetail as $indexProductDetail => $modelProductDetail) {
                $productvariants = $modelProductDetail->productVariants;
                $modelsProductVariant[$indexProductDetail] = $productvariants;
                $oldProductVariants = ArrayHelper::merge(ArrayHelper::index($productvariants, 'id'), $oldProductVariants);
            }
        }

        $oldBanner = $model->foto_banner;

        if ($model->load(Yii::$app->request->post())) {
            $transaction = Yii::$app->db->beginTransaction();
            try {
                // Reset product variants
                $modelsProductVariant = [];

                $oldProductDetailIDs = ArrayHelper::map($modelsProductDetail, 'id', 'id');
                $modelsProductDetail = Model::createMultiple(ProductDetail::classname(), $modelsProductDetail);

                foreach ($modelsProductDetail as $pd) {
                    $pd->id_product = $model->id;
                }
                Model::loadMultiple($modelsProductDetail, Yii::$app->request->post());
                $deletedProductDetailIDs = array_diff($oldProductDetailIDs, array_filter(ArrayHelper::map($modelsProductDetail, 'id', 'id')));

                // Validate models
                $valid = $model->validate();
                $valid = Model::validateMultiple($modelsProductDetail) && $valid;

                $productvariantsIDs = [];
                if (isset($_POST['ProductVariant'][0][0])) {
                    foreach ($_POST['ProductVariant'] as $indexProductDetail => $productvariants) {
                        foreach ($productvariants as $indexProductVariant => $productvariant) {
                            $data['ProductVariant'] = $productvariant;
                            $modelProductVariant = (isset($productvariant['id']) && isset($oldProductVariants[$productvariant['id']])) ? $oldProductVariants[$productvariant['id']] : new ProductVariant;
                            $modelProductVariant->load($data);
                            $modelsProductVariant[$indexProductDetail][$indexProductVariant] = $modelProductVariant;
                            $modelProductVariant->id_produk = $model->id;
                            if (!$modelProductVariant->validate()) {
                                dd($modelProductVariant->getErrors());
                                $valid = 0;
                            }
                        }
                        $productvariantsIDs = ArrayHelper::merge($productvariantsIDs, ArrayHelper::getColumn($productvariants, 'id'));
                    }
                }

                $oldProductVariantsIDs = ArrayHelper::getColumn($oldProductVariants, 'id');
                $deletedProductVariantsIDs = array_diff($oldProductVariantsIDs, $productvariantsIDs);

                // dd($valid);
                if ($valid) {
                    // Handle foto_banner
                    $foto_banners = UploadedFile::getInstance($model, 'foto_banner');
                    if ($foto_banners != null) {
                        $model->foto_banner = $foto_banners->name;
                        $arr = explode(".", $foto_banners->name);
                        $extension = end($arr);
                        $model->foto_banner = Yii::$app->security->generateRandomString() . ".{$extension}";

                        if (!file_exists(Yii::getAlias("@app/web/uploads/banner_produk/"))) {
                            mkdir(Yii::getAlias("@app/web/uploads/banner_produk/"), 0777, true);
                        }

                        $path = Yii::getAlias("@app/web/uploads/banner_produk/") . $model->foto_banner;

                        if ($oldBanner != null) {
                            $foto_banners->saveAs($path);
                            // unlink(Yii::$app->basePath . '/web/uploads/pendanaan/foto_banner/' . $oldBukti);
                        } else {
                            $foto_banners->saveAs($path);
                        }
                    } else {
                        $model->foto_banner = $oldBanner;
                    }

                    if ($flag = $model->save(false)) {
                        if (!empty($deletedProductVariantsIDs)) {
                            ProductVariant::deleteAll(['id' => $deletedProductVariantsIDs]);
                        }

                        if (!empty($deletedProductDetailIDs)) {
                            ProductDetail::deleteAll(['id' => $deletedProductDetailIDs]);
                        }

                        foreach ($modelsProductDetail as $indexProductDetail => $modelProductDetail) {
                            if ($flag === false) {
                                break;
                            }

                            $modelProductDetail->id_product = $model->id;

                            if (!($flag = $modelProductDetail->save(false))) {
                                // dd("model product detail gagal disimpan");
                                break;
                            }

                            // if (isset($modelsProductVariant[$indexProductDetail]) && is_array($modelsProductVariant[$indexProductDetail])) {
                            //     foreach ($modelsProductVariant[$indexProductDetail] as $indexProductVariant => $modelProductVariant) {
                            //         $modelProductVariant->product_detail_id = $modelProductDetail->id;
                            //         if (!($flag = $modelProductVariant->save(false))) {
                            //             break;
                            //         }
                            //     }
                            // }
                            if (isset($modelsProductVariant[$indexProductDetail]) && is_array($modelsProductVariant[$indexProductDetail])) {
                                foreach ($modelsProductVariant[$indexProductDetail] as $indexProductVariant => $modelProductVariant) {
                                    $modelProductVariant->product_detail_id = $modelProductDetail->id;
                                    $modelProductVariant->validate();
                                    if (!($flag = $modelProductVariant->save(false))) {
                                        // dd('product variant gagal di simpan');
                                        break;
                                    }

                                    // inputkan detail produk variant
                                    $newDetailVariant = ProductDetailVariant::findOne(['product_detail_id' => $modelProductDetail->id, 'product_variant_id' => $modelProductVariant->id]);
                                    if (!$newDetailVariant) {
                                        $newDetailVariant = new ProductDetailVariant;
                                    }
                                    $newDetailVariant->product_detail_id = $modelProductDetail->id;
                                    $newDetailVariant->product_variant_id = $modelProductVariant->id;
                                    if (!($flag = $newDetailVariant->save(false))) {
                                        // dd('product detail variant gagal di simpan');
                                        break;
                                    }
                                }
                            }
                        }
                    }
                } else {
                    $flag = 0;
                }

                // var_dump($flag);
                // die;

                if ($flag) {
                    $transaction->commit();
                    return $this->redirect(['view-produk', 'id' => $model->id]);
                } else {
                    // $transaction->getErrors();
                    $transaction->rollBack();
                }
            } catch (Exception $e) {
                $msg = (isset($e->errorInfo[2])) ? $e->errorInfo[2] : $e->getMessage();
                $model->addError('_exception', $msg);
                $transaction->rollBack();
            }
        }

        return $this->render('produk/update', [
            'model' => $model,
            'modelsProductDetail' => (empty($modelsProductDetail)) ? [new ProductDetail] : $modelsProductDetail,
            'modelsProductVariant' => (empty($modelsProductVariant)) ? [[new ProductVariant]] : $modelsProductVariant
        ]);
    }




    public function actionDeleteProduk($id)
    {
        $model = $this->findModelProduk($id);
        $name = $model->nama;

        if ($model->delete()) {
            Yii::$app->session->setFlash('success', 'Record  <strong>"' . $name . '"</strong> deleted successfully.');
        }

        return $this->redirect(['index']);
    }
    // public function actionDeleteProduk($id)
    // {
    //     try {
    //         Produk::findOne(['id' => $id])->delete();
    //     } catch (\Exception $e) {
    //         $msg = (isset($e->errorInfo[2])) ? $e->errorInfo[2] : $e->getMessage();
    //         \Yii::$app->getSession()->addFlash('error', $msg);
    //         return $this->redirect(Url::previous());
    //     }

    //     // TODO: improve detection
    //     $isPivot = strstr('$id', ',');
    //     if ($isPivot == true) {
    //         return $this->redirect(Url::previous());
    //     } elseif (isset(\Yii::$app->session['__crudReturnUrl']) && \Yii::$app->session['__crudReturnUrl'] != '/') {
    //         Url::remember(null);
    //         $url = \Yii::$app->session['__crudReturnUrl'];
    //         \Yii::$app->session['__crudReturnUrl'] = null;

    //         return $this->redirect($url);
    //     } else {
    //         return $this->redirect(['produk-saya']);
    //     }
    // }

    protected function findModelProduk($id)
    {
        if (($model = Produk::findOne($id)) !== null) {
            return $model;
        } else {
            throw new HttpException(404, 'The requested page does not exist.');
        }
    }

    public function actionFotoProdukBaru()
    {
        $model = new FotoProduk();

        try {
            if ($model->load($_POST)) {
                $model->produk_id = $_GET['FotoProduk']['produk_id'];
                $fotos = UploadedFile::getInstance($model, 'foto');
                if ($fotos != NULL) {
                    # store the source fotos name
                    $model->foto = $fotos->name;
                    $arr = explode(".", $fotos->name);
                    $extension = end($arr);

                    # generate a unique fotos name
                    $model->foto = Yii::$app->security->generateRandomString() . ".{$extension}";

                    # the path to save fotos
                    // unlink(Yii::getAlias("@app/web/uploads/pengajuan/") . $oldFile);
                    if (file_exists(Yii::getAlias("@app/web/uploads/foto_produk/")) == false) {
                        mkdir(Yii::getAlias("@app/web/uploads/foto_produk/"), 0777, true);
                    }
                    $path = Yii::getAlias("@app/web/uploads/foto_produk/") . $model->foto;
                    $fotos->saveAs($path);
                }
                if ($model->save()) {
                    return $this->redirect(['view-produk', 'id' => $_GET['FotoProduk']['produk_id']]);
                }
            } elseif (!\Yii::$app->request->isPost) {
                $model->load($_GET);
            }
        } catch (\Exception $e) {
            $msg = (isset($e->errorInfo[2])) ? $e->errorInfo[2] : $e->getMessage();
            $model->addError('_exception', $msg);
        }
        return $this->render('foto-produk/create', ['model' => $model]);
    }
    public function actionFotoProdukUpdate($id)
    {
        $model = FotoProduk::findOne(['id' => $id]);
        $oldFoto = $model->foto;
        try {
            if ($model->load($_POST)) {
                $model->produk_id = $_GET['FotoProduk']['produk_id'];
                $fotos = UploadedFile::getInstance($model, 'foto');
                if ($fotos != NULL) {
                    # store the source fotos name
                    $model->foto = $fotos->name;
                    $arr = explode(".", $fotos->name);
                    $extension = end($arr);

                    # generate a unique fotos name
                    $model->foto = Yii::$app->security->generateRandomString() . ".{$extension}";

                    # the path to save fotos
                    // unlink(Yii::getAlias("@app/web/uploads/pengajuan/") . $oldFile);
                    if (file_exists(Yii::getAlias("@app/web/uploads/foto_produk/")) == false) {
                        mkdir(Yii::getAlias("@app/web/uploads/foto_produk/"), 0777, true);
                    }
                    $path = Yii::getAlias("@app/web/uploads/foto_produk/") . $model->foto;
                    $fotos->saveAs($path);
                }
                if ($model->save()) {

                    return $this->redirect(['view-produk', 'id' => $_GET['FotoProduk']['produk_id']]);
                }
            } elseif (!\Yii::$app->request->isPost) {
                $model->load($_GET);
            }
        } catch (\Exception $e) {
            $msg = (isset($e->errorInfo[2])) ? $e->errorInfo[2] : $e->getMessage();
            $model->addError('_exception', $msg);
        }
        return $this->render('foto-produk/update', ['model' => $model]);
    }
    public function actionFotoProdukDelete($id)
    {
        try {
            $model = FotoProduk::findOne(['id' => $id]);
            $produk_id = $model->produk_id;
            $model->delete();
        } catch (\Exception $e) {
            $msg = (isset($e->errorInfo[2])) ? $e->errorInfo[2] : $e->getMessage();
            \Yii::$app->getSession()->addFlash('error', $msg);
            return $this->redirect(Url::previous());
        }

        // TODO: improve detection
        $isPivot = strstr('$id', ',');
        if ($isPivot == true) {
            return $this->redirect(['view-produk', 'id' => $produk_id]);
        } elseif (isset(\Yii::$app->session['__crudReturnUrl']) && \Yii::$app->session['__crudReturnUrl'] != '/') {
            Url::remember(null);
            $url = \Yii::$app->session['__crudReturnUrl'];
            \Yii::$app->session['__crudReturnUrl'] = null;

            return $this->redirect($url);
        } else {
            return $this->redirect(['view-produk', 'id' => $produk_id]);
        }
    }
    public function actionProfile()
    {
        $confirm = Yii::$app->user->identity->confirm;
        $status = Yii::$app->user->identity->status;
        if ($confirm != 1 || $status != 1) {
            return $this->redirect(["home/index"]);
        }

        Tabs::clearLocalStorage();

        Url::remember();
        \Yii::$app->session['__crudReturnUrl'] = null;

        $model_alamat = Alamat::find()->where(['usrid' => Yii::$app->user->identity->id]);
        $setting = Setting::find()->one();
        $icon = \Yii::$app->request->baseUrl . "/uploads/setting/" . $setting->logo;



        return $this->render('profile', [
            'setting' => $setting,
            'icon' => $icon,
            'model_alamat' => $model_alamat
        ]);
    }

    public function actionEditProfile()
    {
        $confirm = Yii::$app->user->identity->confirm;
        $status = Yii::$app->user->identity->status;
        if ($confirm != 1 || $status != 1) {
            return $this->redirect(["home/index"]);
        }
        $model = User::find()->where(["id" => Yii::$app->user->id])->one();
        $setting = Setting::find()->one();
        $icon = \Yii::$app->request->baseUrl . "/uploads/setting/" . $setting->logo;
        $alamat = Alamat::find()->where(["usrid" => Yii::$app->user->id])->one();
        if ($alamat == null) {
            $alamat = Alamat::find()->one();
        }

        $oldMd5Password = $model->password;
        $model->password = "";
        $oldPhotoUrl = $model->photo_url;

        if ($model->load($_POST)) {
            $model->nomor_handphone = Constant::purifyPhone($model->nomor_handphone);
            //password
            if ($model->password != "") {
                $model->password = \Yii::$app->security->generatePasswordHash($model->password);
            } else {
                $model->password = $oldMd5Password;
            }

            # get the uploaded file instance
            $image = UploadedFile::getInstance($model, 'photo_url');
            if ($image != null) {
                $response = $this->uploadImage($image, "user_image");

                // dd($response);
                if ($response->success == false) {
                    Yii::$app->session->setFlash("error", "Gambar Tidak Dapat Diunggah");
                    goto end;
                }
                $model->photo_url = $response->filename;
                // if ($model->photo_url != null) {
                //     unlink(Yii::getAlias("@app/web/uploads/") . $oldPhotoUrl);
                // }
                // $this->deleteOne($oldPhotoUrl);
            } else {
                $model->photo_url = $oldPhotoUrl;
            }

            // if ($model->validate()) {
            if ($model->save(false)) {
                Yii::$app->session->setFlash("success", "Profile berhasil diubah");
                // }
            } else {
                Yii::$app->session->setFlash("error", "Profile gagal diubah");
            }
            return $this->redirect(["profile"]);
        }
        end:
        $model->password = "";
        return $this->render('edit-profile', [
            'model' => $model,
            'setting' => $setting,
            'icon' => $icon,
            'alamat' => $alamat,
        ]);
    }

    public function actionGetKalender($id)
    {
        $query = new Query;
        $query->select(['*'])
            ->from('kalender_event')
            ->where(['id' => $id]);
        $command = $query->createCommand();
        $dataB = $command->queryOne();
        return json_encode($dataB);
    }

    public function actionAddKeranjang($id)
    {
        $request = Yii::$app->request;
        $barang = Produk::findOne(['id' => $id]);
        $model = new Keranjang();
        $model->produk_id = $id;
        $model->user_id = Yii::$app->user->identity->id;
        $model->harga = (string)$request->get('harga');
        $model->variant1 = (string)$request->get('variant1');
        $model->variant2 = (string)$request->get('variant2');
        $model->jumlah = intval($request->get('jumlah'));
        $model->intv1 = intval($request->get('intv1'));
        $model->intv2 = intval($request->get('intv2'));
        $model->status_id = 3;

        if (!$model->validate()) {
            return [
                'success' => false,
                'message' => $model->getErrors()
            ];
        }
        $model->save();
    }

    public function actionKeranjang()
    {
        $model = Keranjang::find()->where(['user_id' => Yii::$app->user->identity->id, 'id_transaksi' => 0])->all();
        $count_keranjang = Keranjang::find()->count();
        $totalharga = Keranjang::find()->where(['user_id' => Yii::$app->user->identity->id, 'id_transaksi' => 0])->sum('harga*jumlah');

        $searchModel  = new KeranjangSearch;
        $dataProvider = $searchModel->search($_GET);


        Tabs::clearLocalStorage();

        Url::remember();
        \Yii::$app->session['__crudReturnUrl'] = null;

        return $this->render('keranjang/index', [
            'dataProvider' => $dataProvider,
            'searchModel' => $searchModel,
            'model' => $model,
            'count_keranjang' => $count_keranjang,
            'totalharga' => $totalharga,
        ]);
    }

    public function actionViewKeranjang($id)
    {
        \Yii::$app->session['__crudReturnUrl'] = Url::previous();
        Url::remember();
        Tabs::rememberActiveState();

        return $this->render('keranjang/view', [
            'model' => $this->findKeranjang($id),
        ]);
    }


    public function actionCreateKeranjang()
    {
        $model = new Keranjang;

        try {
            if ($model->load($_POST) && $model->save()) {
                return $this->redirect(['view-keranjang', 'id' => $model->id]);
            } elseif (!\Yii::$app->request->isPost) {
                $model->load($_GET);
            }
        } catch (\Exception $e) {
            $msg = (isset($e->errorInfo[2])) ? $e->errorInfo[2] : $e->getMessage();
            $model->addError('_exception', $msg);
        }
        return $this->render('keranjang/create', ['model' => $model]);
    }

    public function actionUpdateKeranjang($id)
    {
        $model = $this->findKeranjang($id);

        if ($model->load($_POST) && $model->save()) {
            return $this->redirect(Url::previous());
        } else {
            return $this->render('keranjang/update', [
                'model' => $model,
            ]);
        }
    }

    public function actionDeleteKeranjang($id)
    {
        try {
            $this->findKeranjang($id)->delete();
        } catch (\Exception $e) {
            $msg = (isset($e->errorInfo[2])) ? $e->errorInfo[2] : $e->getMessage();
            \Yii::$app->getSession()->addFlash('error', $msg);
            return $this->redirect(Url::previous());
        }

        // TODO: improve detection
        $isPivot = strstr('$id', ',');
        if ($isPivot == true) {
            return $this->redirect(Url::previous());
        } elseif (isset(\Yii::$app->session['__crudReturnUrl']) && \Yii::$app->session['__crudReturnUrl'] != '/') {
            Url::remember(null);
            $url = \Yii::$app->session['__crudReturnUrl'];
            \Yii::$app->session['__crudReturnUrl'] = null;

            return $this->redirect($url);
        } else {
            return $this->redirect(['keranjang']);
        }
    }

    protected function findKeranjang($id)
    {
        if (($model = Keranjang::findOne($id)) !== null) {
            return $model;
        } else {
            throw new HttpException(404, 'The requested page does not exist.');
        }
    }

    public function actionOrder()
    {
        $keranjang = Keranjang::find()->where(['user_id' => Yii::$app->user->identity->id, 'id_transaksi' => 0])->all();
        $totalharga = Keranjang::find()->where(['user_id' => Yii::$app->user->identity->id, 'id_transaksi' => 0])->sum('harga*jumlah');
        $useralamats = Alamat::find()->where(['usrid' => Yii::$app->user->identity->id])->all();
        $markets = Toko::find()->all();

        // $getwarnas = ProductVariant::find()
        //     ->select('product_variant.*')
        //     ->innerJoin('product_detail', "product_detail_id = product_detail.id")
        //     ->where(['product_detail.id_product' => $id, 'type' => "color"])
        //     ->all();
        // $tes = Keranjang::find()->where(['user_id' => Yii::$app->user->identity->id, 'id_transaksi' => 0])->one();
        // $pro = Produk::find()
        //     ->select(['produk.harga', 'toko.nama'])
        //     ->innerJoin('toko', true)
        //     ->where(['produk.id' => 1, 'toko.id' => ])->one();
        // var_dump($pro);
        // die;

        Tabs::clearLocalStorage();

        Url::remember();
        \Yii::$app->session['__crudReturnUrl'] = null;

        return $this->render('pesanan/order', [
            // 'dataProvider' => $dataProvider,
            // 'searchModel' => $searchModel,
            'keranjang' =>  $keranjang,
            'totalharga' => $totalharga,
            'useralamats' => $useralamats,
            'markets' => $markets,
            // 'indent' => $indent,
        ]);
    }

    public function actionPesanan()
    {
        $searchModel  = new PesananSearch;
        $dataProvider = $searchModel->search($_GET);

        Tabs::clearLocalStorage();

        Url::remember();
        \Yii::$app->session['__crudReturnUrl'] = null;

        $confirm = Yii::$app->user->identity->confirm;
        $status = Yii::$app->user->identity->status;
        if ($confirm != 1 || $status != 1) {
            return $this->redirect(["home/index"]);
        }
        // $request = Yii::$app->request;
        // $stt = $request->get('transaction_status');
        // var_dump($stt);
        // die;

        $allpesanan = Pesanan::find()->where(['user_id' => Yii::$app->user->identity->id])->all();
        foreach ($allpesanan as $pesanan) {
            $data_all = DetailPesanan::find()->where(['pesanan_id' => $pesanan->id])->all();
            $query = DetailPesanan::find()->where(['pesanan_id' => $pesanan->id]);
            $count = $query->count();
            $pagination = new Pagination(['totalCount' => $count, 'pageSize' => 6]);
            $pesanans = $query->offset($pagination->offset)
                ->where(['usrid' => Yii::$app->user->identity->id])
                ->limit($pagination->limit)
                ->orderBy(['id' => SORT_DESC])
                ->all();
            foreach ($data_all as $data) {
                $wf = DetailPesanan::find()->where(['id' => $data->id])->one();
                // $a = $this->findMidtrans($wf->kode_transaksi);
                $a = $this->findMidtrans($wf->invoice);

                // var_dump($a);
                // die;

                if ($a->status_code == "404") {
                    $wf->status_id = $wf->status_id;
                    $sts = "Tidak Ada";
                } else {
                    if ($a->transaction_status == "pending") {
                        $carts = Keranjang::find()->where(['id_transaksi' => $data->id])->all();
                        foreach ($carts as $cart) {
                            $cart->status_id = 3;
                            $cart->save();
                        };
                        $wf->status_id = 3;
                        $sts = "Ada";
                    } elseif ($a->transaction_status == "capture" || $a->transaction_status == "settlement") {
                        $carts = Keranjang::find()->where(['id_transaksi' => $data->id])->all();
                        foreach ($carts as $cart) {
                            $cart->status_id = 2;
                            $cart->save();
                        };
                        $wf->status_id = 2;
                        $wf->selesai = date('Y-m-d H:i:s');
                        $sts = "Ada";
                    } elseif ($a->transaction_status == "deny") {
                        $carts = Keranjang::find()->where(['id_transaksi' => $data->id])->all();
                        foreach ($carts as $cart) {
                            $cart->status_id = 4;
                            $cart->save();
                        };
                        $wf->status_id = 4;
                        $wf->selesai = date('Y-m-d H:i:s');
                        $sts = "Ada";
                    } elseif ($a->transaction_status == "cancel") {
                        $carts = Keranjang::find()->where(['id_transaksi' => $data->id])->all();
                        foreach ($carts as $cart) {
                            $cart->status_id = 5;
                            $cart->save();
                        };
                        $wf->status_id = 5;
                        $wf->selesai = date('Y-m-d H:i:s');
                        $sts = "Ada";
                    } elseif ($a->transaction_status == "expire") {
                        $carts = Keranjang::find()->where(['id_transaksi' => $data->id])->all();
                        foreach ($carts as $cart) {
                            $cart->status_id = 6;
                            $cart->save();
                        };
                        $wf->status_id = 6;
                        $wf->selesai = date('Y-m-d H:i:s');
                        $wf->keterangan = "Melewati Batas Waktu Pembayaran";
                        $sts = "Ada";
                    }
                }
                // var_dump($wf);
                // die;
                if ($a->status_code == "404") {
                    // $wf->jenis_pembayaran_id = "Tidak Ditemukan";
                } else {
                    if ($a->payment_type == "cstore") {
                        // $wf->jenis_pembayaran_id = $a->store;
                    } else {
                        // $wf->jenis_pembayaran_id = $a->payment_type;
                    }
                }
                $wf->save();
            }
        }
        return $this->render('pesanan/index', [
            'dataProvider' => $dataProvider,
            'searchModel' => $searchModel,
            'pagination' => $pagination,
            'pesanans' => $pesanans,
        ]);

        // $data_all = DetailPesanan::find()->where(['usrid' => Yii::$app->user->identity->id])->all();

        // $query = DetailPesanan::find()->where(['usrid' => Yii::$app->user->identity->id]);
        // $count = $query->count();
        // $pagination = new Pagination(['totalCount' => $count, 'pageSize' => 6]);
        // $pesanans = $query->offset($pagination->offset)
        //     ->where(['usrid' => Yii::$app->user->identity->id])
        //     ->limit($pagination->limit)
        //     ->orderBy(['id' => SORT_DESC])
        //     ->all();
        // foreach ($data_all as $data) {
        //     $wf = DetailPesanan::find()->where(['id' => $data->id])->one();
        //     // $a = $this->findMidtrans($wf->kode_transaksi);
        //     $a = $this->findMidtrans($wf->invoice);
        //     // var_dump($a);
        //     // die;

        //     if ($a->status_code == "404") {
        //         $wf->status_id = $wf->status_id;
        //         $sts = "Tidak Ada";
        //     } else {
        //         if ($a->transaction_status == "pending") {
        //             $carts = Keranjang::find()->where(['id_transaksi' => $data->id])->all();
        //             foreach ($carts as $cart) {
        //                 $cart->status_id = 3;
        //                 $cart->save();
        //             };
        //             $wf->status_id = 3;
        //             $sts = "Ada";
        //         } elseif ($a->transaction_status == "capture" || $a->transaction_status == "settlement") {
        //             $carts = Keranjang::find()->where(['id_transaksi' => $data->id])->all();
        //             foreach ($carts as $cart) {
        //                 $cart->status_id = 2;
        //                 $cart->save();
        //             };
        //             $wf->status_id = 2;
        //             $wf->selesai = date('Y-m-d H:i:s');
        //             $sts = "Ada";
        //         } elseif ($a->transaction_status == "deny") {
        //             $carts = Keranjang::find()->where(['id_transaksi' => $data->id])->all();
        //             foreach ($carts as $cart) {
        //                 $cart->status_id = 4;
        //                 $cart->save();
        //             };
        //             $wf->status_id = 4;
        //             $wf->selesai = date('Y-m-d H:i:s');
        //             $sts = "Ada";
        //         } elseif ($a->transaction_status == "cancel") {
        //             $carts = Keranjang::find()->where(['id_transaksi' => $data->id])->all();
        //             foreach ($carts as $cart) {
        //                 $cart->status_id = 5;
        //                 $cart->save();
        //             };
        //             $wf->status_id = 5;
        //             $wf->selesai = date('Y-m-d H:i:s');
        //             $sts = "Ada";
        //         } elseif ($a->transaction_status == "expire") {
        //             $carts = Keranjang::find()->where(['id_transaksi' => $data->id])->all();
        //             foreach ($carts as $cart) {
        //                 $cart->status_id = 6;
        //                 $cart->save();
        //             };
        //             $wf->status_id = 6;
        //             $wf->selesai = date('Y-m-d H:i:s');
        //             $wf->keterangan = "Melewati Batas Waktu Pembayaran";
        //             $sts = "Ada";
        //         }
        //     }
        //     // var_dump($wf);
        //     // die;
        //     if ($a->status_code == "404") {
        //         // $wf->jenis_pembayaran_id = "Tidak Ditemukan";
        //     } else {
        //         if ($a->payment_type == "cstore") {
        //             // $wf->jenis_pembayaran_id = $a->store;
        //         } else {
        //             // $wf->jenis_pembayaran_id = $a->payment_type;
        //         }
        //     }
        //     $wf->save();
        // }
    }
    /**
     * Displays a single DetailPesanan model.
     * @param integer $id
     *
     * @return mixed
     */
    public function actionViewPesanan($id)
    {
        // var_dump($snapToken);

        // \Yii::$app->session['__crudReturnUrl'] = Url::previous();
        Url::remember();
        $totalharga = 0;
        // Tabs::rememberActiveState();
        $pesanan = Pesanan::find()->where(['id' => $id])->one();
        // $totalharga = $pesanan->nominal;
        $detailpesanan = DetailPesanan::find()->where(['pesanan_id' => $id])->all();
        // echo '<pre>';
        // var_dump($detailpesanan);
        // die;
        foreach ($detailpesanan as $detpesanan) {
            $query = (new Query())
                ->select('*')
                ->from('keranjang k')
                ->join('JOIN', 'produk p', 'k.produk_id = p.id')
                // ->join('JOIN', 'product_detail pd', 'p.id = pd.id_product')
                ->where(['k.id_transaksi' => $detpesanan->id]);

            $keranjang = $query->all();
            // echo '<pre>';
            // var_dump($keranjang);
            // die;
            $keranjang_pesan = Keranjang::find()->where(['user_id' => Yii::$app->user->identity->id, 'id_transaksi' => $detpesanan->id])->all();
            // $totalharga = Keranjang::find()->where(['user_id' => Yii::$app->user->identity->id, 'id_transaksi' => $detpesanan->id])->sum('harga*jumlah');
        }

        $model = $this->findPesanan($id);
        // $produk_pesan = Produk::find()->where(['id' => $keranjang_pesan->produk_id]);
        // var_dump($produk_pesan);
        // die;
        return $this->render('pesanan/view', [
            'model' => $model,
            'keranjang' => $keranjang,
            'keranjang_pesan' => $keranjang_pesan,
            'totalharga' => $totalharga,
            'detailpesanan' => $detailpesanan,
            'pesanan' => $pesanan,
        ]);
    }

    /**
     * Creates a new DetailPesanan model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreatePesanan()
    {
        $model = new DetailPesanan;

        try {
            if ($model->load($_POST) && $model->save()) {
                return $this->redirect(['view', 'id' => $model->id]);
            } elseif (!\Yii::$app->request->isPost) {
                $model->load($_GET);
            }
        } catch (\Exception $e) {
            $msg = (isset($e->errorInfo[2])) ? $e->errorInfo[2] : $e->getMessage();
            $model->addError('_exception', $msg);
        }
        return $this->render('pesanan/create', ['model' => $model]);
    }

    /**
     * Updates an existing DetailPesanan model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdatePesanan($id)
    {
        $model = $this->findPesanan($id);

        if ($model->load($_POST) && $model->save()) {
            return $this->redirect(Url::previous());
        } else {
            return $this->render('pesanan/update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing DetailPesanan model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDeletePesanan($id)
    {
        try {
            $this->findPesanan($id)->delete();
        } catch (\Exception $e) {
            $msg = (isset($e->errorInfo[2])) ? $e->errorInfo[2] : $e->getMessage();
            \Yii::$app->getSession()->addFlash('error', $msg);
            return $this->redirect(Url::previous());
        }

        // TODO: improve detection
        $isPivot = strstr('$id', ',');
        if ($isPivot == true) {
            return $this->redirect(Url::previous());
        } elseif (isset(\Yii::$app->session['__crudReturnUrl']) && \Yii::$app->session['__crudReturnUrl'] != '/') {
            Url::remember(null);
            $url = \Yii::$app->session['__crudReturnUrl'];
            \Yii::$app->session['__crudReturnUrl'] = null;

            return $this->redirect($url);
        } else {
            return $this->redirect(['pesanan/index']);
        }
    }
    /**
     * Finds the DetailPesanan model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return DetailPesanan the loaded model
     * @throws HttpException if the model cannot be found
     */
    protected function findPesanan($id)
    {
        if (($model = Pesanan::findOne($id)) !== null) {
            return $model;
        } else {
            throw new HttpException(404, 'The requested page does not exist.');
        }
    }


    public function actionAlamat()
    {
        $searchModel  = new AlamatSearch;
        $dataProvider = $searchModel->search($_GET);

        Tabs::clearLocalStorage();

        Url::remember();
        \Yii::$app->session['__crudReturnUrl'] = null;

        return $this->render('alamat/index', [
            'dataProvider' => $dataProvider,
            'searchModel' => $searchModel,
        ]);
    }
    public function actionViewAlamat($id)
    {
        \Yii::$app->session['__crudReturnUrl'] = Url::previous();
        Url::remember();
        Tabs::rememberActiveState();

        return $this->render('alamat/view', [
            'model' => $this->findAlamat($id),
        ]);
    }

    public function actionCreateAlamat()
    {
        $model = new Alamat;

        try {
            if ($model->load($_POST) && $model->save()) {
                return $this->redirect(['view-alamat', 'id' => $model->id]);
            } elseif (!\Yii::$app->request->isPost) {
                $model->load($_GET);
            }
        } catch (\Exception $e) {
            $msg = (isset($e->errorInfo[2])) ? $e->errorInfo[2] : $e->getMessage();
            $model->addError('_exception', $msg);
        }
        return $this->render('alamat/create', ['model' => $model]);
    }
    public function actionUpdateAlamat($id)
    {
        $model = $this->findAlamat($id);

        if ($model->load($_POST) && $model->save()) {
            return $this->redirect(Url::previous());
        } else {
            return $this->render('alamat/update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Alamat model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDeleteAlamat($id)
    {
        try {
            $this->findAlamat($id)->delete();
        } catch (\Exception $e) {
            $msg = (isset($e->errorInfo[2])) ? $e->errorInfo[2] : $e->getMessage();
            \Yii::$app->getSession()->addFlash('error', $msg);
            return $this->redirect(Url::previous());
        }

        // TODO: improve detection
        $isPivot = strstr('$id', ',');
        if ($isPivot == true) {
            return $this->redirect(Url::previous());
        } elseif (isset(\Yii::$app->session['__crudReturnUrl']) && \Yii::$app->session['__crudReturnUrl'] != '/') {
            Url::remember(null);
            $url = \Yii::$app->session['__crudReturnUrl'];
            \Yii::$app->session['__crudReturnUrl'] = null;

            return $this->redirect($url);
        } else {
            return $this->redirect(['profile']);
        }
    }

    /**
     * Finds the Alamat model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Alamat the loaded model
     * @throws HttpException if the model cannot be found
     */
    protected function findAlamat($id)
    {
        if (($model = Alamat::findOne($id)) !== null) {
            return $model;
        } else {
            throw new HttpException(404, 'The requested page does not exist.');
        }
    }



    public function actionPembayaran()
    {

        $totalbayar = $_POST['totalbayar'];
        $tujuan = $_POST['tujuan'];
        $kodepospembeli = $_POST['kodepospembeli'];
        $berat = $_POST['berat'];
        $paket = $_POST['paket'];
        $kurir = $_POST['kurir'];
        $alamatpembeli = $_POST['alamatpembeli'];
        // var_dump($totalbayar);
        // die;

        // var_dump($kurir);
        // die;
        // $totalbayar = $_POST['totalbayar'];
        // $kodepospembeli = $_POST['kodepospembeli'];
        // $alamatpembeli = $_POST['alamatpembeli'];

        //production
        // ActionMidtransConfig::$serverKey = 'SB-Mid-server-LWT_5RGvHlROlIbmaE8K0ntb';
        // ActionMidtransConfig::$clientKey = 'SB-Mid-client-lrPe45BCGoT9yG2O';

        //sandbox
        ActionMidtransConfig::$serverKey = 'SB-Mid-server-KfOHtIYQdM-mZcR0GlslJk28';
        ActionMidtransConfig::$clientKey = 'SB-Mid-client-O9CttO-48I-qx0KO';


        // non-relevant function only used for demo/example purpose

        // Uncomment for production environment
        ActionMidtransConfig::$isProduction = false;

        // Enable sanitization
        ActionMidtransConfig::$isSanitized = true;

        // Enable 3D-Secure
        ActionMidtransConfig::$is3ds = true;

        $confirm = Yii::$app->user->identity->confirm;
        $status = Yii::$app->user->identity->status;
        $idsr = Yii::$app->user->identity->id;
        if ($confirm != 1 || $status != 1) {
            return $this->redirect(["home/index"]);
        }



        // Required
        $items = Keranjang::find()->where(['id_transaksi' => 0])->all();
        // var_dump($items);
        // die;
        $items = array(
            array(
                'id'       => 'item1',
                'price'    => 100000,
                'quantity' => 1,
                'name'     => 'Adidas f50'
            ),
            array(
                'id'       => 'item2',
                'price'    => 50000,
                'quantity' => 2,
                'name'     => 'Nike N90'
            )
        );

        // Populate customer's billing address
        $billing_address = array(
            'first_name'   => "Andri",
            'last_name'    => "Setiawan",
            'address'      => "Karet Belakang 15A, Setiabudi.",
            'city'         => "Jakarta",
            'postal_code'  => "51161",
            'phone'        => "081322311801",
            'country_code' => 'IDN'
        );

        // Populate customer's shipping address
        $shipping_address = array(
            'first_name'   => "John",
            'last_name'    => "Watson",
            'address'      => "Bakerstreet 221B.",
            'city'         => "Jakarta",
            'postal_code'  => "51162",
            'phone'        => "081322311801",
            'country_code' => 'IDN'
        );

        // Populate customer's info
        $customer_details = array(
            'first_name'       => YII::$app->user->identity->name,
            'last_name'        => " Customer",
            'email'            => YII::$app->user->identity->username,
            'phone'            => YII::$app->user->identity->nomor_handphone,
            'billing_address'  => "Sby",
            'shipping_address' => $shipping_address,
        );
        $order_id_midtrans = rand();
        $transaction_details = [
            'order_id'    => $order_id_midtrans,
            'gross_amount'  => (int)$totalbayar,
        ];


        $params = [
            "transaction_details" => $transaction_details,
            "customer_details" => $customer_details,
        ];


        $snapToken = \app\components\ActionMidtransSnap::getSnapToken($params);
        // var_dump($snapToken); die;
        // if ($totalbayar = !null) {
        $pesanan = new Pesanan();
        $pesanan->created_at = date('Y-m-d H:i:s');
        $pesanan->user_id = $idsr;
        $pesanan->invoice = $order_id_midtrans;
        $pesanan->token_midtrans = $snapToken;
        $pesanan->nominal = $totalbayar;
        $pesanan->save();

        // die(var_dump($result))
        // $keranjang = Keranjang::find()->where(["user_id = $idsr && id_transaksi = 0"])->all();
        $query = (new Query())
            ->select('*')
            ->from('keranjang k')
            ->join('JOIN', 'produk p', 'k.produk_id = p.id')
            ->join('JOIN', 'product_detail pd', 'p.id = pd.id_product')
            ->where(['k.user_id' => $idsr, 'k.id_transaksi' => 0]);

        $keranjang = $query->all();

        // echo '<pre>';
        // die(var_dump($keranjang));

        $mapByToko = null;

        foreach ($keranjang as $ker) {
            $mapByToko[$ker['toko_id']][] = $ker;
        }

        foreach ($mapByToko as $toko_id => $listProduk) {
            $totalbayar = 0;
            $berat = 0;
            $idkec_penjual = Toko::find()->select('idkec')->where(['id' => $toko_id])->one();
            // var_dump($idkec_penjual->idkec);
            // die;
            foreach ($listProduk as $produk) {
                $totalbayar = $kurir[$toko_id]['harga_paket'] + $produk['harga'];
            }
            $model = new DetailPesanan();
            $model->toko_id = $toko_id;
            $model->pesanan_id = $pesanan->id;
            $model->invoice = $order_id_midtrans;
            $model->nama = Yii::$app->user->identity->name;
            $model->nominal = $totalbayar;
            $model->usrid  = Yii::$app->user->identity->id;
            $model->alamat_pembeli = $alamatpembeli;
            $model->alamat_penjual = $idkec_penjual->idkec;
            $model->berat = (int)$berat;
            $model->ongkir = $kurir[$toko_id]['harga_paket'];
            $model->kurir = $kurir[$toko_id]['ekspedisi'];
            $model->paket = $paket;
            $model->dari = (int)11;
            $model->tujuan = $tujuan;
            $model->resi =  null;
            $model->id_bayar = 2;
            $model->ajukanbatal = 1;
            $model->keterangan = "Proses";
            $model->status_id = 3;
            $model->token_midtrans = $snapToken;

            $model->save();
            // $this->layout= false;
            $idsr = Yii::$app->user->identity->id;

            Yii::$app->db->createCommand("
            UPDATE keranjang k
            JOIN produk p
            on k.produk_id = p.id
            join toko t 
            on t.id = p.toko_id
            set id_transaksi = $model->id
            where k.user_id = $idsr
            and k.id_transaksi = 0
            and t.id = $toko_id")->execute();
            // Keranjang::updateAll(['id_transaksi' => $model->id, 'created_at2' => date('Y-m-d H:i:s')], "user_id = $idsr && id_transaksi = 0 ");
        }

        echo  json_encode([
            'success' => true,
            'data' => 'okee',
        ]);

        // Yii::$app->getResponse()->redirect(['pesanan'])->send();
    }
    public function actionPembayaranOrigin()
    {

        //production
        ActionMidtransConfig::$serverKey = 'SB-Mid-server-KfOHtIYQdM-mZcR0GlslJk28';
        ActionMidtransConfig::$clientKey = 'SB-Mid-client-O9CttO-48I-qx0KO';

        //sandobox
        // ActionMidtransConfig::$serverKey = 'SB-Mid-server-LWT_5RGvHlROlIbmaE8K0ntb';
        // ActionMidtransConfig::$clientKey = 'SB-Mid-client-lrPe45BCGoT9yG2O';

        // non-relevant function only used for demo/example purpose

        // Uncomment for production environment
        ActionMidtransConfig::$isProduction = false;

        // Enable sanitization
        ActionMidtransConfig::$isSanitized = false;

        // Enable 3D-Secure
        ActionMidtransConfig::$is3ds = false;

        $confirm = Yii::$app->user->identity->confirm;
        $status = Yii::$app->user->identity->status;
        if ($confirm != 1 || $status != 1) {
            return $this->redirect(["home/index"]);
        }
        $produk = \app\models\Produk::find()
            ->where(['id' => $id])->one();
        // Required

        $items = array(
            array(
                'id'       => 'item1',
                'price'    => 100000,
                'quantity' => 1,
                'name'     => 'Adidas f50'
            ),
            array(
                'id'       => 'item2',
                'price'    => 50000,
                'quantity' => 2,
                'name'     => 'Nike N90'
            )
        );

        // Populate customer's billing address
        $billing_address = array(
            'first_name'   => "Andri",
            'last_name'    => "Setiawan",
            'address'      => "Karet Belakang 15A, Setiabudi.",
            'city'         => "Jakarta",
            'postal_code'  => "51161",
            'phone'        => "081322311801",
            'country_code' => 'IDN'
        );

        // Populate customer's shipping address
        $shipping_address = array(
            'first_name'   => "John",
            'last_name'    => "Watson",
            'address'      => "Bakerstreet 221B.",
            'city'         => "Jakarta",
            'postal_code'  => "51162",
            'phone'        => "081322311801",
            'country_code' => 'IDN'
        );

        // Populate customer's info
        $customer_details = array(
            'first_name'       => "Andri",
            'last_name'        => "Setiawan",
            'email'            => "test@test.com",
            'phone'            => "081322311801",
            'billing_address'  => "Sby",
            'shipping_address' => "Sby"
        );

        $transaction_details = [
            'order_id'    => rand(),
            'gross_amount'  => 259000,
        ];


        $params = [
            "transaction_details" => $transaction_details,
            "customer_details" => $customer_details,
        ];


        $paymentUrl = \app\components\ActionMidtransSnap::createTransaction($params)->redirect_url;


        Yii::$app->response->format = Response::FORMAT_JSON;

        return [
            'success' => true,
            'url' => $paymentUrl
        ];
    }


    protected function findMidtrans($id)
    {
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://api.sandbox.midtrans.com/v2/" . $id . "/status",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_POSTFIELDS => "\n\n",
            CURLOPT_HTTPHEADER => array(
                "Accept: application/json",
                "Content-Type: application/json",
                "Authorization: Basic U0ItTWlkLXNlcnZlci1LZk9IdElZUWRNLW1aY1IwR2xzbEprMjg6"
            ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        $a = json_decode($response);
        return $a;
    }
    protected function findMidtransCancel($id)
    {
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://api.sandbox.midtrans.com/v2/" . $id . "/cancel",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => "\n\n",
            CURLOPT_HTTPHEADER => array(
                "Accept: application/json",
                "Content-Type: application/json",
                "Authorization: Basic U0ItTWlkLXNlcnZlci1LZk9IdElZUWRNLW1aY1IwR2xzbEprMjg6"
            ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        $a = json_decode($response);
        return $a;
    }
    protected function findMidtransProduction($id)
    {
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://api.midtrans.com/v2/" . $id . "/status",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_POSTFIELDS => "\n\n",
            CURLOPT_HTTPHEADER => array(
                "Accept: application/json",
                "Content-Type: application/json",
                "Authorization: Basic U0ItTWlkLXNlcnZlci1LZk9IdElZUWRNLW1aY1IwR2xzbEprMjg6"
            ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        $a = json_decode($response);
        return $a;
    }
    protected function findMidtransProductionCancel($id)
    {
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://api.midtrans.com/v3/" . $id . "/cancel",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => "\n\n",
            CURLOPT_HTTPHEADER => array(
                "Accept: application/json",
                "Content-Type: application/json",
                "Authorization: Basic U0ItTWlkLXNlcnZlci1LZk9IdElZUWRNLW1aY1IwR2xzbEprMjg6"
            ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        $a = json_decode($response);
        return $a;
    }

    public function actionCancelTransaksi($id)
    {
        $confirm = Yii::$app->user->identity->confirm;
        $status = Yii::$app->user->identity->status;
        $usr = Yii::$app->user->identity->id;
        if ($confirm != 1 || $status != 1 || $usr == null) {
            return $this->redirect(["home/index"]);
        }
        // var_dump('yes');
        // die;
        $pesanans  = Pesanan::find()->where(['id' => $id])->one();
        $a = $this->findMidtransCancel($pesanans->invoice);
        $detail = DetailPesanan::find()->where(['pesanan_id' => $id])->all();
        // Yii::$app->db->createCommand("
        //     UPDATE detail-pesanan k
        //     JOIN pesanan p
        //     on k.produk_id = p.id
        //     join toko t 
        //     on t.id = p.toko_id
        //     set id_transaksi = $model->id
        //     where k.user_id = $idsr
        //     and k.id_transaksi = 0
        //     and t.id = $toko_id")->execute();
        DetailPesanan::updateAll(['status_id' => 5, 'selesai' => date('Y-m-d H:i:s'), 'keterangan' => "Dibatalkan Oleh Pembeli"], "pesanan_id = $pesanans->id");
        foreach ($detail as $wf) {
            // $wf->status_id = 5;
            // $wf->selesai = date('Y-m-d H:i:s');
            // $wf->keterangan = "Dibatalkan Oleh Pembeli";
            $carts = Keranjang::find()->where(['id_transaksi' => $id])->all();
            foreach ($carts as $cart) {
                $cart->status_id = 5;
                $cart->save();
            }
            if ($a->status_code == "404") {
                // $wf->jenis_pembayaran_id = "Tidak Ditemukan";
            } else {
                if ($a->payment_type == "cstore") {
                    // $wf->jenis_pembayaran_id = $a->store;
                } else {
                    // $wf->jenis_pembayaran_id = $a->payment_type;
                }
            }
        }
        if ($wf->save()) {
            return $this->redirect(["home/pesanan"]);
        }
        Yii::$app->response->format = Response::FORMAT_JSON;
        return [
            'success' => false,
            'message' => $wf->getErrors()
        ];
    }

    public function callback()
    // https://834b-182-1-75-92.ap.ngrok.io -> http://localhost:8080
    {
        $request = Yii::$app->request;
        $serverKey = 'SB-Mid-server-KfOHtIYQdM-mZcR0GlslJk28';
        $hashed = hash("sha15", $request->order_id . $request->status_code . $request->gross_amount . $serverKey);
        if ($hashed == $request->signature_key) {
            if ($request->transaction_status == 'capture') {
                $pesanan = new DetailPesanan();
                $pesanan = DetailPesanan::find()->where(['invoice' => $request->order_id]);
                $pesanan->status_id = 2;
                $pesanan->save();
            }
        }
    }

    function midtranstoken()
    {
        if (isset($_POST["invoice"])) {
            //echo $_POST["invoice"];
            $bayar = $this->func->getBayar($_POST["invoice"], "semua", "invoice");
            $usrid = $this->func->getUser($bayar->usrid, "semua");
            $profil = $this->func->getProfil($bayar->usrid, "semua", "usrid");
            $email = ($usrid->username != "") ? $usrid->username : $this->func->globalset("email");
            $params = array(
                'transaction_details' => array(
                    'order_id' => $_POST["invoice"],
                    'gross_amount' => $bayar->transfer,
                ),
                'customer_details' => array(
                    'first_name' => $profil->nama,
                    'last_name' => "",
                    'email' => $email,
                    'phone' => $profil->nohp,
                ),
            );
            $token = \Midtrans\Snap::getSnapToken($params);
            echo json_encode(["midtranstoken" => $token, "token" => $this->security->get_csrf_hash()]);
        } else {
            show_error("Invoice tidak ditemukan", 404);
        }
    }
}
