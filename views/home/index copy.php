<?php
use yii\helpers\Url;
?>
<section id="header" class="header-wakaf bg-overlay pt-120 pb-120">
  <div class="bg-img"><img src="<?= $bg_login ?>" alt="background"></div>
  <div class="">
    <div class="row">
      <div class="col-sm-12 col-md-12 col-lg-6 offset-lg-6">
        <div class="header-panel-wrap margin-wakaf">
          <ul class="nav nav-tabs pb-4" id="isalam" role="tablist">
            <li class="nav-item text-center" style="width: 50%;">
              <a class="nav-link font-weight-bold active" id="Wakaf-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true"><i class="fas fa-hand-holding-usd"></i> Wakaf</a>
            </li>
            <li class="nav-item text-center" style="width: 50%;">
              <a class="nav-link font-weight-bold" id="wakaf-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false"><i class="fas fa-money-bill-alt"></i> Infak</a>
            </li>
          </ul>
          <div class="tab-content" id="myTabContent">
            <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">

              <div class="form-group">
                <div class="row">
                  <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                    <label for="Wakaf" style="font-size: 1.4rem;color: #f1a502;margin-top: 10px;">Ayo Mulai Wakaf</label>
                  </div>
                  <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                    <select class="form-control select-wakaf border-r5 shadow-r2" id="select-category" style="overflow: scroll;" onchange="myFunction(event)">
                      <option class="font-weight-bold" disabled selected>Silahkan Pilih Program</option>
                      <?php
                      foreach ($list_pendanaans as $pendana) { ?>
                        <option class="font-weight-bold" value="<?= $pendana->id ?>"><?= $pendana->nama_pendanaan ?></option>
                      <?php } ?>
                    </select>
                  </div>
                  <div class="col-lg-8 col-md-8 col-sm-12 col-12 pt-4">
                    <p style="color: #2a2a2a;" class="font-weight-bold pt-4">Silahkan Isi Jumlah Wakafmu, Insyaallah Semua Berkah</p>
                  </div>
                  <div class="col-12 pt-4">
                    <div class="form-group">
                      <label for="">Isi Nominal Wakaf Anda</label>
                      <div class="input-group mb-2">
                        <div class="input-group-prepend mr-2" style="height:calc(1.5em + .75rem + 2px);">
                          <div class="input-group-text bg-white border-r5 font-weight-bold" style="color: #afafaf;">Rp</div>
                        </div>

                        <input type="hidden" class="form-control select-wakaf border-r5" id="pendanaan_wakaf" name="pendanaan_wakaf" placeholder="Minimal Wakaf Rp. 10.000">
                        <input type="number" class="form-control select-wakaf border-r5" id="nominal" name="nominal" placeholder="Minimal Wakaf Rp. 10.000">
                      </div>
                    </div>
                  </div>
                  <div class="col-12">
                    <button type="submit" class="btn-sm btn-block text-white font-weight-bold" style="height: 3rem;background-color: #f1a502;" id="bayarkan">Wakaf Sekarang</button>
                  </div>
                </div>
              </div>

            </div>
            <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">

              <div class="form-group">
                <div class="row">
                  <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                    <label for="Infak" style="font-size: 1.4rem;color: #f1a502;margin-top: 10px;">Ayo Mulai Infak</label>
                  </div>
                  <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                    <select class="form-control select-wakaf border-r5 shadow-r2" id="select-category" style="overflow: scroll;" onchange="myFunction2(event)">
                      <option class="font-weight-bold" disabled selected>Silahkan Pilih Program</option>
                      <?php foreach ($list_pendanaans as $pendana) { ?>
                        <option class="font-weight-bold" value="<?= $pendana->id ?>"><?= $pendana->nama_pendanaan ?></option>
                      <?php } ?>
                    </select>
                  </div>
                  <div class="col-lg-8 col-md-8 col-sm-12 col-12 pt-4">
                    <p style="color: #2a2a2a;" class="font-weight-bold pt-4">Silahkan Isi Jumlah Infakmu, Insyaallah Semua Berkah</p>
                  </div>
                  <div class="col-12 pt-4">
                    <div class="form-group">
                      <label for="">Isi Nominal Infak Anda</label>
                      <div class="input-group mb-2">
                        <div class="input-group-prepend mr-2" style="height:calc(1.5em + .75rem + 2px);">
                          <div class="input-group-text bg-white border-r5 font-weight-bold" style="color: #afafaf;">Rp</div>
                        </div>
                        <input type="hidden" class="form-control select-wakaf border-r5 shadow-r2" id="pendanaan_infak" name="pendanaan_infak" placeholder="Minimal Wakaf Rp. 10.000">
                        <input type="number" class="form-control select-wakaf border-r5 shadow-r2" id="nominal2" name="nominal2" placeholder="Minimal infak Rp. 10.000">
                      </div>
                    </div>
                  </div>
                  <div class="col-12">
                    <button type="submit" class="btn-sm btn-block text-white font-weight-bold" style="height: 3rem;background-color: #f1a502;" id="bayarkan2">Infak Sekarang</button>
                  </div>
                </div>
              </div>

            </div>
          </div>
        </div>
      </div><!-- /.col-lg-12 -->
    </div><!-- /.row -->
  </div><!-- /. -->
</section>

<div class="container">
  <div class="col-12 mt-4">
    <div class="count-program shadow-br2">
      <div class="row">
        <div class="col-4 text-center text-dark">

          <svg xmlns="http://www.w3.org/2000/svg" width="50" height="50" viewBox="0 0 223.271 204.298">
            <g transform="translate(1.5 1.504)">
              <path d="M217.793,296.842c-4.626-7.493-14.4-9.9-22.739-5.613l-38.238,19.629a17.124,17.124,0,0,0-12.594-5.516H118.244a6.246,6.246,0,0,1-2.037-.169,11.566,11.566,0,0,1-1.546-1.34l-.223-.211c-20.822-19.6-38.428-18.348-58.457-10.447a14.113,14.113,0,0,1-6.686,1.455l-5.8.007v-1.616a12.213,12.213,0,0,0-12.2-12.2H12.2A12.212,12.212,0,0,0,0,293.022v60.333a12.213,12.213,0,0,0,12.2,12.2h19.09a12.213,12.213,0,0,0,12.2-12.2v-1.609H54.074a5.344,5.344,0,0,1,2.155.321c.405.114,13.654,3.664,13.654,3.664a4.3,4.3,0,0,0,2.223-8.31s-13.175-3.531-13.553-3.637a12.74,12.74,0,0,0-4.479-.641H43.491v-39.9h5.634c.065,0,.129,0,.194,0l.361-.016a21.958,21.958,0,0,0,9.459-2.046c17.917-7.069,31.745-7.909,49.4,8.705l.213.2c2.9,2.742,4.572,3.859,9.492,3.859h25.978a8.573,8.573,0,0,1,0,17.147l-42.093.012a4.3,4.3,0,0,0,0,8.6h0l42.092-.012A17.165,17.165,0,0,0,160.9,318.433l38.087-19.552c3.754-1.932,8.9-1.7,11.489,2.485,2.279,3.684,1.041,8.558-2.884,11.342L146.73,356.039c-12.7,8.458-18.073,6.9-31.022,3.142-1.974-.573-4.015-1.165-6.276-1.777a4.3,4.3,0,0,0-2.247,8.3c2.186.592,4.189,1.173,6.126,1.734,6.274,1.82,11.545,3.351,17.04,3.35,6.2,0,12.686-1.95,21.206-7.633l.108-.074,60.909-43.366C220.249,314.276,222.492,304.439,217.793,296.842Zm-182.9,56.512a3.6,3.6,0,0,1-3.6,3.6H12.2a3.6,3.6,0,0,1-3.6-3.6V293.022a3.6,3.6,0,0,1,3.6-3.6h19.09a3.6,3.6,0,0,1,3.6,3.6Z" transform="translate(0 -169.499)" fill="#e2681d" stroke="#e2681d" stroke-width="3" />
              <path d="M137.864,86.808l47.518,45.857a4.3,4.3,0,0,0,5.974,0l17.3-16.687,17.3,16.688a4.3,4.3,0,0,0,5.972,0l27.453-26.48c.037-.036.074-.073.11-.11a24.971,24.971,0,0,0,0-34.39A19.593,19.593,0,0,0,249.4,66.095a39.736,39.736,0,0,0-10.411-34.576,31.3,31.3,0,0,0-24.188-9.466,37.6,37.6,0,0,0-24.071,10.237l-.435.407c-.658.616-1.368,1.281-1.924,1.766-.556-.485-1.267-1.15-1.925-1.766l-.434-.406a37.6,37.6,0,0,0-24.072-10.238,31.318,31.318,0,0,0-24.188,9.466,40.055,40.055,0,0,0,0,55.183c.033.036.069.071.105.106ZM253.3,77.66a16.3,16.3,0,0,1,.048,22.391l-24.407,23.543-24.407-23.543a16.3,16.3,0,0,1,.05-22.394c5.163-5.352,13.55-3.815,18.355.675l.256.24c1.791,1.682,3.338,3.135,5.741,3.135s3.875-1.381,5.743-3.13l.258-.241C239.745,73.844,248.132,72.305,253.3,77.66ZM143.946,37.493c9.168-9.5,25.4-9.012,36.2,1.081l.43.4c2.944,2.756,4.889,4.577,7.8,4.577s4.86-1.821,7.8-4.577l.431-.4c10.79-10.092,27.027-10.577,36.2-1.079a31.2,31.2,0,0,1,7.828,28.583,23.762,23.762,0,0,0-11.571,5.975l-.124.116-.123-.116a23.542,23.542,0,0,0-15.072-6.4,19.888,19.888,0,0,0-15.351,6.029,24.972,24.972,0,0,0,0,34.393c.036.037.072.074.11.11L202.456,110l-14.087,13.591-44.475-42.92a31.38,31.38,0,0,1,.052-43.179Z" transform="translate(-72.222 -22.023)" fill="#e2681d" stroke="#e2681d" stroke-width="3" />
              <path d="M202.732,446.918a4.3,4.3,0,1,0,0,8.6h.012a4.3,4.3,0,1,0-.012-8.6Z" transform="translate(-113.074 -264.147)" fill="#e2681d" stroke="#e2681d" stroke-width="3" />
            </g>
          </svg>
          <p class="pt-3 font-weight-bold" style="font-size: 2rem;"><?= $count_program ?></p>
          <p class="font-weight-bold" style="font-size: 1rem;color: #e2681d;">Jumlah Program
          <p>
        </div>
        <div class="col-4 text-center text-dark">

          <svg xmlns="http://www.w3.org/2000/svg" width="50" height="50" viewBox="0 0 215.139 204.298">
            <g transform="translate(1.502 1.501)">
              <g transform="translate(79.747 0)">
                <path d="M252.679,28.312,229.863,1.721c-.043-.05-.088-.1-.135-.146a5.426,5.426,0,0,0-7.355-.269L204.193,17a5.336,5.336,0,0,0-.551,7.526l.712.825-1.173,1.013c-3.112,2.688-7.8,3.492-12.528,2.15-.1-.027-13.561-3.848-13.658-3.871a19.6,19.6,0,0,0-14.868,2.441c-.1.056-34.843,19.942-34.937,20-3.171,2.066-7.589,7.231-4.026,13.484l.043.072a8.949,8.949,0,0,0,6.3,4.383,9.431,9.431,0,0,0,16.551,5.79L158.93,55.943a9.373,9.373,0,0,0,1.311-1.974l.531-.219a8.779,8.779,0,0,0,6.47,6.294c16.158,4.583,19.521,5.91,24.045,5.41,12.612-1.352,15.5-1.765,21.854-5.421a100.185,100.185,0,0,0,13.25-9.153l.775.9a5.335,5.335,0,0,0,7.527.551L252,37.385A6.455,6.455,0,0,0,252.679,28.312Zm-110.572,39.1a4.214,4.214,0,0,1-7.389-2.894l15.412-6.376Zm68.431-11.9c-5.4,3.11-7.223,3.406-19.753,4.75-3.431.368-6.12-.7-22.119-5.236-2.049-.581-2.585-1.677-2.809-2.45a4.949,4.949,0,0,1-.112-2.067c0-.012,0-.024.006-.037s.011-.045.016-.067a3.992,3.992,0,0,1,.615-1.311,2.2,2.2,0,0,1,2.374-.842c4.936.679,16.69,2.251,16.808,2.267a2.609,2.609,0,0,0,.692-5.171c-.118-.016-11.862-1.586-16.788-2.264a7.585,7.585,0,0,0-8.4,4.9l-3.8,1.569c-30.03,12.382-23.26,9.694-25.489,10.337-4.195.589-7.069-4.87-1.794-8.389l34.8-19.919.007,0c.042-.024.084-.05.124-.076a14.316,14.316,0,0,1,10.847-1.787l13.474,3.822c6.425,1.822,12.916.618,17.361-3.22l1.173-1.013,15.219,17.626A94.931,94.931,0,0,1,210.539,55.511ZM248.59,33.435c-.055.048-17.32,14.981-17.393,14.972-.1-.007-23.751-27.319-23.6-27.454l18.181-15.7h0a.19.19,0,0,1,.224-.016l22.712,26.47A1.227,1.227,0,0,1,248.59,33.435Z" transform="translate(-121.84 0)" fill="#e2681d" stroke="#e2681d" stroke-width="3" />
              </g>
              <g transform="translate(0 127.332)">
                <path d="M134.72,308.378a9.444,9.444,0,0,0-16.551-5.79l-12.879,14.88a9.343,9.343,0,0,0-1.31,1.973l-.531.219a8.778,8.778,0,0,0-6.47-6.294c-17.1-4.852-19.334-5.824-23.994-5.415l-.05,0c-12.612,1.352-15.5,1.766-21.854,5.421a100.156,100.156,0,0,0-13.25,9.153l-.774-.9a5.342,5.342,0,0,0-7.527-.551L11.279,336.84a5.163,5.163,0,0,0-.507,7.317l24.051,27.409a5.023,5.023,0,0,0,6.977.58l.048-.041,18.181-15.7a5.333,5.333,0,0,0,.552-7.527l-.712-.825,1.173-1.012c3.113-2.688,7.8-3.491,12.528-2.15l12.1,3.431a2.609,2.609,0,1,0,1.424-5.019l-12.1-3.431c-6.425-1.822-12.916-.618-17.361,3.22L56.459,344.1,41.239,326.48a94.894,94.894,0,0,1,12.443-8.58c5.409-3.113,7.225-3.406,19.782-4.752,2.936-.256,4.771.273,14.834,3.164,7.8,2.24,9.407,2.251,10.066,4.525a4.947,4.947,0,0,1,.112,2.067,3.874,3.874,0,0,1-.636,1.415,2.2,2.2,0,0,1-2.374.842c-4.937-.679-16.69-2.251-16.808-2.267a2.609,2.609,0,0,0-.692,5.171c.118.016,11.862,1.586,16.788,2.264a7.573,7.573,0,0,0,8.4-4.9c.13-.054,26.269-10.827,26.395-10.89,2.755-1.4,5.358-1.719,7,.916,1.889,3.375-1.461,5.894-2.3,6.456l-34.8,19.918-.046.027-.085.053a13.278,13.278,0,0,1-1.827.993,2.609,2.609,0,0,0,2.128,4.763,18.479,18.479,0,0,0,2.483-1.344c.1-.059,34.834-19.937,34.934-20C146.492,320.157,141.942,309.534,134.72,308.378Zm-78.088,43.91a.11.11,0,0,1,.029.087c-.006.077-17.974,15.566-18.032,15.616l-23.9-27.236,18.21-15.723a.119.119,0,0,1,.168.013Zm57.459-37.016,8.023-9.27A4.214,4.214,0,0,1,129.5,308.9Z" transform="translate(-9.488 -299.328)" fill="#e2681d" stroke="#e2681d" stroke-width="3" />
              </g>
              <g transform="translate(85.189 84.31)">
                <path d="M213.873,216.606a4.356,4.356,0,0,0,3.632,1.973,4.255,4.255,0,0,0,3.42-2.01,6.971,6.971,0,0,1,12.488.732,2.609,2.609,0,0,0,4.8-2.049A12.176,12.176,0,0,0,217.4,212.52c-7.139-9.147-21.811-3.951-21.8,7.543.013,12.084,10.476,21.326,20.265,25.947a3.641,3.641,0,0,0,3.111,0c7.038-3.339,14.52-9.264,17.983-16.419a2.609,2.609,0,1,0-4.7-2.273c-2.822,5.83-9.07,10.736-14.85,13.648-8.142-4.026-16.585-11.518-16.595-20.905C200.81,212.978,210.31,210.337,213.873,216.606Z" transform="translate(-195.599 -207.822)" fill="#e2681d" stroke="#e2681d" stroke-width="3" />
              </g>
            </g>
          </svg>
          <p class="pt-3 font-weight-bold" style="font-size: 2rem;">4</p>
          <p class="font-weight-bold" style="font-size: 1rem;color: #e2681d;">Jumlah Penerima Wakaf
          <p>
        </div>
        <div class="col-4 text-center text-dark">

          <svg xmlns="http://www.w3.org/2000/svg" width="50" height="50" viewBox="0 0 260.661 196.245">
            <g transform="translate(1.5 1.5)">
              <g transform="translate(0 0)">
                <path d="M231.222,200.725h-1.364a21.881,21.881,0,0,0,3.541-11.953v-6.191a22.028,22.028,0,0,0-24.264-21.9,26.274,26.274,0,0,0-19.189-8.263h-1.364a21.881,21.881,0,0,0,3.541-11.953V134.27a22.016,22.016,0,0,0-24.315-21.9,26.286,26.286,0,0,0-19.138-8.209h-1.364a21.882,21.882,0,0,0,3.542-11.953V86.019a22.018,22.018,0,1,0-44.036,0v6.191a21.878,21.878,0,0,0,3.542,11.953H108.99a26.288,26.288,0,0,0-19.138,8.209,22.016,22.016,0,0,0-24.315,21.9v6.191a21.88,21.88,0,0,0,3.541,11.953H67.714a26.275,26.275,0,0,0-19.189,8.263,22.028,22.028,0,0,0-24.264,21.9v6.191A21.88,21.88,0,0,0,27.8,200.724H26.439A26.471,26.471,0,0,0,0,227.164v25.049a5.033,5.033,0,0,0,5.032,5.032H106.184a5.032,5.032,0,0,0,0-10.065H92.616V227.164A16.393,16.393,0,0,1,108.99,210.79h39.681a16.393,16.393,0,0,1,16.374,16.375v20.016H151.476a5.032,5.032,0,0,0,0,10.065H252.628a5.033,5.033,0,0,0,5.032-5.032V227.164a26.469,26.469,0,0,0-26.439-26.439Zm-7.888-18.144v6.191a11.953,11.953,0,0,1-23.906,0v-6.191a11.953,11.953,0,0,1,23.906,0Zm-41.275-48.311v6.191a11.953,11.953,0,0,1-23.906,0v-6.191a11.953,11.953,0,0,1,23.906,0Zm-65.182-42.06V86.018a11.953,11.953,0,0,1,23.906,0v6.191a11.953,11.953,0,0,1-23.906,0Zm-7.887,22.018h39.681a16.307,16.307,0,0,1,8.4,2.315,22,22,0,0,0-8.978,17.727v6.191a21.88,21.88,0,0,0,3.541,11.953h-1.364a26.312,26.312,0,0,0-19.188,8.263,22.231,22.231,0,0,0-4.482,0,26.4,26.4,0,0,0-19.2-8.262h-1.364a21.881,21.881,0,0,0,3.541-11.953v-6.191a22,22,0,0,0-8.978-17.727,16.3,16.3,0,0,1,8.4-2.315Zm31.793,74.545a11.953,11.953,0,0,1-23.906,0v-6.191a11.953,11.953,0,0,1,23.906,0ZM75.6,140.461v-6.191a11.953,11.953,0,0,1,23.906,0v6.191a11.953,11.953,0,0,1-23.906,0ZM34.327,188.772v-6.191a11.953,11.953,0,0,1,23.906,0v6.191a11.953,11.953,0,0,1-23.906,0Zm48.167,58.408H10.065V227.164A16.393,16.393,0,0,1,26.439,210.79H66.12a16.393,16.393,0,0,1,16.374,16.375Zm5.061-35.467A26.416,26.416,0,0,0,66.12,200.725H64.755A21.881,21.881,0,0,0,68.3,188.772v-6.191a22,22,0,0,0-9.025-17.76,16.3,16.3,0,0,1,8.442-2.342H107.4a16.351,16.351,0,0,1,8.441,2.342,22,22,0,0,0-9.024,17.76v6.191a21.88,21.88,0,0,0,3.541,11.953H108.99A26.421,26.421,0,0,0,87.555,211.714Zm61.116-10.989h-1.364a21.881,21.881,0,0,0,3.541-11.953v-6.191a22,22,0,0,0-9.024-17.759,16.314,16.314,0,0,1,8.441-2.343h39.681a16.3,16.3,0,0,1,8.442,2.342,22,22,0,0,0-9.025,17.76v6.191a21.88,21.88,0,0,0,3.541,11.953H191.54a26.417,26.417,0,0,0-21.435,10.989,26.415,26.415,0,0,0-21.435-10.989ZM247.6,247.181H175.166V227.164A16.393,16.393,0,0,1,191.54,210.79h39.681A16.393,16.393,0,0,1,247.6,227.164Z" transform="translate(0 -64)" fill="#e2681d" stroke="rgba(112,112,112,0)" stroke-width="3" />
                <path d="M250.971,428a5.034,5.034,0,1,0,3.558,1.475A5.068,5.068,0,0,0,250.971,428Z" transform="translate(-122.172 -244.819)" fill="#e2681d" stroke="rgba(112,112,112,0)" stroke-width="3" />
              </g>
            </g>
          </svg>
          <p class="pt-3 font-weight-bold" style="font-size: 2rem;"><?= $count_wakif ?></p>
          <p class="font-weight-bold" style="font-size: 1rem;color: #e2681d;">Jumlah Wakaf
          <p>
        </div>
      </div>
    </div>
  </div>

  <!-- <section class="fancybox-layout4 pt-4 mt-4" style="padding-bottom:1rem">
        <div class="col-12">
          <div class="team-img bg-banner" style="background-image: url(<?= $bg_login ?>);">
            <div class="overlay-banner text-right p-5">
              <div class="row">
                <div class="col-4"></div>
                <div class="col-8 col-8 mt-5 mb-5 pr-1">
                  <p class="text-white text-banner">Mari Semarakkan Gerakan Wakaf Nasional Untuk Indonesia Lebih Baik </p>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section> -->

  <img src="<?= \Yii::$app->request->BaseUrl . "/uploads/setting/" . $setting->banner ?>" class="pt-4">

  <div class="col-12">
    <hr>
  </div>

  <section id="services" class="services pb-90">
    <div class="">
      <h2 class="text-center" style="color:orange">Ayo Mulai Berwakaf</h2>
      <p class="text-center font-weight-bold">Pilih program wakaf terbaik kami, Insyaallah memberi manfaat untuk kita semua.</p>
      <div class="row">
        <?php foreach ($pendanaans as $pendanaan) {
          $nominal = \app\models\Pembayaran::find()->where(['pendanaan_id' => $pendanaan->id, 'status_id' => 6])->sum('nominal');
          $pewakaf = \app\models\Pembayaran::find()->where(['pendanaan_id' => $pendanaan->id, 'status_id' => 6])->count();
          $datetime1 =  new Datetime($pendanaan->pendanaan_berakhir);
          $datetime2 =  new Datetime(date("Y-m-d H:i:s"));
          $interval = $datetime1->diff($datetime2)->days;
          $target = $pendanaan->nominal;
          $nilai_sekarang = ($nominal / $target) * 100;
        ?>
          <div class="col-lg-4 col-md-6 mt-3">
            <!-- <a href="<?= \Yii::$app->request->baseUrl . "/home/detail-berita?id=" . $berita->slug ?>"> -->
            <div class="card shadow-br2" style="border-radius: 15px;">
              <!-- <img src="" class="card-img-top" alt="..."> -->
              <div class="team-img" style="background-image: url(<?= \Yii::$app->request->baseUrl . "/uploads/" . $pendanaan->poster ?>);border-radius: 15px;">
              </div>
              <div class="card-body">
                <h6 class="card-title"><?= $pendanaan->nama_pendanaan ?></h6>
                <div class="row">
                  <div class="col-12">
                    <div class="progress">
                      <div class="progress-bar bg-warning" role="progressbar" style="width: <?= $nilai_sekarang ?>%" aria-valuenow="<?= $nilai_sekarang ?>" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                  </div>
                  <div class="col-lg-6 col-md-6 col-6 text-left pt-4 font-weight-bold font-size-08">
                    Sudah Terkumpul
                  </div>
                  <div class="col-lg-6 col-md-6 col-6 text-right pt-4 font-weight-bold font-size-08">
                    Durasi
                  </div>
                </div>
                <div class="row">
                  <div class="col-lg-8 col-md-8 col-8 text-left font-weight-bold" style="color: #ffa500;font-size: 1.3rem;">
                    <?= \app\components\Angka::toReadableHarga($nominal, false)  ?><br>
                  </div>
                  <div class="col-lg-4 col-md-4 col-4 text-right font-weight-bold" style="color: #ffa500;font-size: 1.3rem;">
                    <?= $interval; ?> Hari
                  </div>
                </div>
                <hr>
                <div class="row">

                  <div class="col-lg-12 col-md-12 col-12 text-left font-weight-bold font-size-08">
                    <i class="fa fa-users" aria-hidden="true"></i> Jumlah Pewakaf(<?= $pewakaf ?>)
                  </div>
                </div>
                <div class="row">
                  <div class="col-sm-12 col-md-12 col-lg-12" style="margin-top: 5px;">
                    <a href="<?= \Yii::$app->request->BaseUrl . "/home/detail-program/" . $pendanaan->id ?>" class="btn btn-sm btn-program btn-block">Mulai Wakaf</a>
                  </div>
                </div>
              </div>
            </div>
            </a>
          </div>
        <?php }
        ?>
      </div><!-- /.row -->
    </div><!-- /. -->
  </section><!-- /.Services -->

  <div class="col-12">
    <hr>
  </div>

  <section id="services" class="services pb-50">
    <div class="">
      <h2 class="text-center" style="color:orange">Informasi & Berita</h2>
      <p class="text-center font-weight-bold">Update Informasi seputar wakaf dan kegiatan yayasan Inisiator Isalam</p>
      <div class="row">
        <?php foreach ($news as $berita) { ?>
          <div class="col-lg-4 col-md-4 mt-3">
            <a href="<?= \Yii::$app->request->baseUrl . "/detail-berita?id=" . $berita->slug ?>">
              <div class="card border-r15 shadow-br2">
                <div class="border-r15" style="background-image: url(<?= \Yii::$app->request->baseUrl . "/uploads/berita/" . $berita->gambar ?>);background-size: cover;height: 200px;">

                </div>
                <div class="card-body">
                  <h6 class="card-title"><?= $berita->getShowTitle() ?></h6>
                  <div class="content-berita__info">
                    <div class="row">
                      <div class="col-lg-6 col-md-6 col-6 text-left">
                        <?= date("d M Y", strtotime($berita->created_at)); ?> <br>
                      </div>
                      <div class="col-lg-6 col-md-6 col-6 text-right">
                        <?= $berita->kategoriBerita->nama ?>
                      </div>
                    </div>
                    <hr>
                  </div>
                  <p style="color: #666; margin-bottom: .5rem; font-size: .9rem" :hover="color: #666">
                    <?= $berita->getDescription() ?> .. <a href="<?= Url::to(['home/detail-berita', 'id' => $berita->slug]) ?>" style="color: #d07500;">Baca Selengkapnya</a>
                  </p>
                  <div style="text-align: right;">
                    <!-- <a href="<?= Url::to(['home/detail-berita', 'id' => $berita->slug]) ?>" class="btn btn-more"><?= Yii::t("cruds", "Baca Selengkapnya") ?></a> -->
                  </div>
                </div>
              </div>
            </a>
          </div>
        <?php } ?>
      </div>
    </div><!-- /. -->
  </section><!-- /.Services -->

  <div class="col-12">
    <hr>
  </div>

  <div class="row">
    <div class="col-lg-6 col-md-6 col-sm-12 col-12">
      <div class="embed-responsive embed-responsive-16by9">
        <iframe class="embed-responsive-item border-r15" width="560" height="315" src="<?= $setting->youtube_link ?>" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
      </div>
    </div>
    <div class="col-lg-6 col-md-6 col-sm-12 col-12">
      <h3 class="text-mari-wakaf"><?= $setting->judul_video ?></h3>
      <p class="text-justify"><?= $setting->deskripsi_video ?></p>
    </div>
  </div>

  <div class="col-12">
    <hr>
  </div>

  <div class="col-sm-12 col-md-12 col-lg-12 pb-4">
    <h2 class="text-center" style="color:orange">Mitra Yayasan I-salam</h2>
    <div class="carousel owl-carousel" data-slide="6" data-slide-md="4" data-slide-sm="2" data-autoplay="true" data-nav="false" data-dots="false" data-space="20" data-loop="true" data-speed="700">
      <?php foreach ($lembagas as $lembaga) { ?>
        <div class="client img-mitra">
          <a href="#"><img class="mx-auto" src="<?= \Yii::$app->request->baseUrl . "/uploads/lembaga_penerima/" . $lembaga->foto; ?>" alt="client"></a>
        </div><!-- /.client -->
      <?php } ?>
    </div><!-- /.carousel -->
  </div>

</div>

<script>
  function myFunction(e) {
    document.getElementById("pendanaan_wakaf").value = e.target.value
  }

  function myFunction2(e) {
    document.getElementById("pendanaan_infak").value = e.target.value
  }
  var duit = document.getElementById("nominal");
  duit.addEventListener('keyup', function(e) {
    console.log(this.value);
    duit.setAttribute("value", this.value);
  });

  var duit2 = document.getElementById("nominal2");
  duit2.addEventListener('keyup', function(e) {
    // console.log(this.value);
    duit2.setAttribute("value", this.value);
  });

  document.querySelector("#bayarkan").addEventListener("click", () => {
    let dana = document.querySelector("#pendanaan_wakaf").getAttribute("value");
    if (dana == null) {
      alert("Anda Belum Memilih Program Wakaf");
    } else {
      let nominal = document.querySelector("#nominal").getAttribute("value");
      if (nominal == null) {
        alert("Anda Belum Mengisi Nominal Pendanaan");
      } else {

        let ket = "wakaf";
        var base_url = window.origin + "/isalam/web/home/pembayarans/" + dana + "?nominal=" + nominal + "&keterangan=" + ket;
        // console.log(base_url);
        window.location.href = base_url;
      }
    }

  });
  document.querySelector("#bayarkan2").addEventListener("click", () => {
    let dana2 = document.querySelector("#pendanaan_infak").getAttribute("value");
    if (dana2 == null) {

      alert("Anda Belum Memilih Program Infak");
    } else {
      let nominal2 = document.querySelector("#nominal2").getAttribute("value");
      if (nominal2 == null) {

        alert("Anda Belum Mengisi Nominal Infak");
      } else {
        let ket2 = "infak";
        var base_url2 = window.origin + "/isalam/web/home/pembayarans/" + dana2 + "?nominal=" + nominal2 + "&keterangan=" + ket2;
        //   console.log(base_url);
        window.location.href = base_url2;
      }
    }
  });
</script>