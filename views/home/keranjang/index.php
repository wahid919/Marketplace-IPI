<?php

use yii\helpers\Url;
use yii\helpers\Html;
use app\models\Produk;
use yii\grid\GridView;
use app\models\ProductVariant;

/**
 * @var yii\web\View $this
 * @var yii\data\ActiveDataProvider $dataProvider
 * @var app\models\search\KeranjangSearch $searchModel
 */

$this->title = 'Keranjang';
$this->params['breadcrumbs'][] = $this->title;
?>

<!-- Shoping Cart Section Begin -->
<hr>
<section class="shoping-cart" style="padding-top: 3%;">
    <div class="section-title product__discount__title" style="text-align: center;">
        <h2>Keranjang</h2>
    </div>
    <br>
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="shoping__cart__table">
                    <table>
                        <thead>
                            <tr>
                                <th class="shoping__product">Products</th>
                                <th>Price</th>
                                <th>Quantity</th>
                                <th>Total</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            foreach ($model as $mode) {
                                $produkkeranjang = Produk::find()->where(['id' => $mode->produk_id])->one();
                                $total = $mode->harga * $mode->jumlah;
                            ?>
                                <tr>
                                    <td class="shoping__cart__item">
                                        <img style="max-width:20%" src="<?= \Yii::$app->request->baseUrl . "/uploads/banner_produk/" . $produkkeranjang->foto_banner ?>" alt="">
                                        <h5><?= $produkkeranjang->nama ?>
                                            <p><span>Warna: <?= $mode->variant1 ?>, Ukuran: <?= $mode->variant2 ?></span></p>
                                        </h5>
                                    </td>
                                    <td class="shoping__cart__price" style="width:13%">
                                        <?= \app\components\Angka::toReadableHarga($mode->harga); ?>
                                    </td>
                                    <td class="shoping__cart__quantity" style="width:13%">
                                        <div class="quantity">
                                            <div class="pro-qty">
                                                <input type="text" value="<?= $mode->jumlah ?>">
                                            </div>
                                        </div>
                                    </td>
                                    <td class="shoping__cart__total" style="width:14%">
                                        <?= \app\components\Angka::toReadableHarga($total); ?>
                                    </td>
                                    <td class="shoping__cart__item__close">
                                        <a class="btn " href="<?= Url::to(["delete-keranjang", "id" => $mode->id]) ?>" title="Hapus Data" data-confirm="Apakah Anda yakin ingin menghapus data ini ?"><span class="icon_close"></span></a>
                                    </td>
                                </tr>
                                <!-- <tr>
                                    <td class="shoping__cart__item">
                                        <img src="img/cart/cart-2.jpg" alt="">
                                        <h5>Fresh Garden Vegetable</h5>
                                    </td>
                                    <td class="shoping__cart__price">
                                        $39.00
                                    </td>
                                    <td class="shoping__cart__quantity">
                                        <div class="quantity">
                                            <div class="pro-qty">
                                                <input type="text" value="1">
                                            </div>
                                        </div>
                                    </td>
                                    <td class="shoping__cart__total">
                                        $39.99
                                    </td>
                                    <td class="shoping__cart__item__close">
                                        <span class="icon_close"></span>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="shoping__cart__item">
                                        <img src="img/cart/cart-3.jpg" alt="">
                                        <h5>Organic Bananas</h5>
                                    </td>
                                    <td class="shoping__cart__price">
                                        $69.00
                                    </td>
                                    <td class="shoping__cart__quantity">
                                        <div class="quantity">
                                            <div class="pro-qty">
                                                <input type="text" value="1">
                                            </div>
                                        </div>
                                    </td>
                                    <td class="shoping__cart__total">
                                        $69.99
                                    </td>
                                    <td class="shoping__cart__item__close">
                                        <span class="icon_close"></span>
                                    </td>
                                </tr> -->
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="shoping__cart__btns">
                    <a href="<?= Yii::$app->request->baseUrl . "/home/produk" ?>" class="primary-btn cart-btn">CONTINUE SHOPPING</a>
                    <a href="#" class="primary-btn cart-btn cart-btn-right"><span class="icon_loading"></span>
                        Upadate Cart</a>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="shoping__continue">
                    <div class="shoping__discount">
                        <h5>Discount Codes</h5>
                        <form action="#">
                            <input type="text" placeholder="Enter your coupon code">
                            <button type="submit" class="site-btn">APPLY COUPON</button>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="shoping__checkout">
                    <h5 style="pointer-events: none;">Cart Total</h5>
                    <ul>
                        <li>Subtotal <span><?= \app\components\Angka::toReadableHarga($totalharga); ?></span></li>
                        <li>Total <span><?= \app\components\Angka::toReadableHarga($totalharga); ?></span></li>
                    </ul>
                    <a href="<?= Url::to(['order']) ?>" class="primary-btn">PROCEED TO CHECKOUT</a>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Shoping Cart Section End -->