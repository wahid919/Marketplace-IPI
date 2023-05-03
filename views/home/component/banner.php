<div class="owl-carousel">
    <?php foreach ($banner as $item) : ?>
        <div class="item">
            <a href="<?= \Yii::$app->request->baseUrl . "/detail-berita?id=" . $item->slug ?>">
                <div class="item-content" style="background-image: url(<?= Yii::$app->formatter->asMyImage("berita/$item->gambar", false, "logo.png") ?>);background-position:center;background-size:cover;">
                </div>
            </a>
        </div>
    <?php endforeach ?>
</div>