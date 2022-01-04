@extends('admin.layout.app')
@section('content')
<?php
    $setting = DB::table('setting')->first();

?>
    <div class="content-page">
        <!-- Start content -->
        <div class="content">
            <div class="container">
                <div class="row">
                    <div class="col-xs-12">
                        <div class="page-title-box">
                            <h4 class="page-title">Kontrol Paneli</h4>
                            <ol class="breadcrumb p-0 m-0">
                                <li><a href="{{ url('dashboard') }}">Anasayfa</a> </li>
                                <li class="active"> Öne Çıkan İlan Ayarları</li>
                            </ol>
                            <div class="clearfix"></div>
                        </div>
                    </div>
                </div>
                <!-- end row -->
                <div class="row">
                    <div class="col-md-12 col-xs-12 col-xxs-12">
                        <div class="panel panel-color panel-inverse">
                            <div class="panel-heading">
                                <h3 class="panel-title">Öne Çıkan Reklam Ayarları</h3>
                            </div>
                            <div class="panel-body">
                                <form action="" id="featuredAdsForm">
                                    {{csrf_field()}}
                                    <input type="hidden" id="featuredAdsId" name="id" value="{{ isset($featured_ads->id)? $featured_ads->id : ''}}">
                                    <div class="form-group">
                                        <lable>Başlık</lable>

                                        <input type="text" class="form-control" name="title" required value="{{ isset($featured_ads->title)? $featured_ads->title : ''}}">
                                    </div>
                                    <div class="row">
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <lable>normal ilan fiyatı</lable>
                                                <input type="text" readonly onkeyup="this.value=this.value.replace(/[^\d.]/,'')" onkeydown="this.value=this.value.replace(/[^\d.]/,'')" class="form-control" name="normal_listing_price" value="{{ isset($featured_ads->normal_listing_price)? $featured_ads->normal_listing_price : 0}}">
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <lable>Anasayfa ilan fiyatı</lable>
                                                <input type="text" onkeyup="this.value=this.value.replace(/[^\d.]/,'')" onkeydown="this.value=this.value.replace(/[^\d.]/,'')" class="form-control" name="home_page_price" value="{{ isset($featured_ads->home_page_price)? $featured_ads->home_page_price : ''}}">
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <lable>Anasayfa ilan günleri</lable>
                                                <input type="number" onkeyup="this.value=this.value.replace(/[^\d.]/,'')" onkeydown="this.value=this.value.replace(/[^\d.]/,'')" class="form-control" name="home_page_days" value="{{ isset($featured_ads->home_page_days)? $featured_ads->home_page_days : ''}}">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <lable>Sayfa tepesi ilan fiyatı</lable>
                                                <input type="text" onkeyup="this.value=this.value.replace(/[^\d.]/,'')" onkeydown="this.value=this.value.replace(/[^\d.]/,'')" class="form-control" name="top_page_price" value="{{ isset($featured_ads->top_page_price)? $featured_ads->top_page_price : ''}}">
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <lable>Sayfa tepesi ilan günleri</lable>
                                                <input type="number" onkeyup="this.value=this.value.replace(/[^\d.]/,'')" onkeydown="this.value=this.value.replace(/[^\d.]/,'')" class="form-control" name="top_page_days" value="{{ isset($featured_ads->top_page_days)? $featured_ads->top_page_days : ''}}">
                                            </div>
                                        </div>

                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <lable>Acil ilan fiyatı</lable>
                                                <input type="text" onkeyup="this.value=this.value.replace(/[^\d.]/,'')" onkeydown="this.value=this.value.replace(/[^\d.]/,'')" class="form-control" name="urgent_price" value="{{ isset($featured_ads->urgent_price)? $featured_ads->urgent_price : ''}}">
                                            </div>
                                        </div>

                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <lable>Acil ilan günleri</lable>
                                                <input type="number" onkeyup="this.value=this.value.replace(/[^\d.]/,'')" onkeydown="this.value=this.value.replace(/[^\d.]/,'')" class="form-control" name="urgent_days" value="{{ isset($featured_ads->urgent_days)? $featured_ads->urgent_days : ''}}">
                                            </div>
                                        </div>

                                    </div>

                                    <div class="row">
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <lable>Acil artı üst sayfa fiyatı</lable>
                                                <input type="text" onkeyup="this.value=this.value.replace(/[^\d.]/,'')" onkeydown="this.value=this.value.replace(/[^\d.]/,'')" class="form-control" name="urgent_top_price" value="{{ isset($featured_ads->urgent_top_price)? $featured_ads->urgent_top_price : ''}}">
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <lable>Acil artı üst sayfa günleri</lable>
                                                <input type="number" onkeyup="this.value=this.value.replace(/[^\d.]/,'')" onkeydown="this.value=this.value.replace(/[^\d.]/,'')" class="form-control" name="urgent_top_days" value="{{ isset($featured_ads->urgent_top_days)? $featured_ads->urgent_top_days : ''}}">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <lable> Detail </lable>
                                        <textarea name="description" class="form-control" id="" rows="5">{{ isset($featured_ads->description)? $featured_ads->description : ''}}</textarea>
                                    </div>

                                    <div class="form-group">
                                        <div class="checkbox checkbox-primary checkbox-inline">
                                            <input id="status" name="status" type="checkbox" value="1" {{ isset($featured_ads->status) && $featured_ads->status == 1  ? 'checked' : ''}}>
                                            <label for="status" class="text-bold">Durum</label>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <button class="btn btn-success"> Kaydet </button>
                                    </div>
                                </form>
                            </div>
                        </div>

                        <div class="panel panel-color panel-inverse">
                            <div class="panel-heading">
                                <h3 class="panel-title">Ödeme İşlemci Ayarları</h3>
                            </div>
                            <div class="panel-body">
                                <div class="alert alert-info"><strong>Not!</strong> Yalnızca bir ödeme işlemcisi etkinleştirilebilir. </div>
                                <h3> Stripe Ayarları </h3>
                                <hr>

                                <form action="" id="stripeForm">
                                    <input type="hidden" name="id" id="gatewayId" value="{{ isset($paymentGateway)&& $paymentGateway->id !='' ? $paymentGateway->id : '' }}">
                                    {{csrf_field()}}
                                    <div class="form-group">
                                        <lable>Publishable Key</lable>
                                        <input type="text" name="stripe_publishable_key" value="{{ isset($paymentGateway)&& $paymentGateway->stripe_publishable_key !='' ? $paymentGateway->stripe_publishable_key : '' }}" class="form-control" placeholder="Enter publish key">
                                    </div>

                                    <div class="form-group">
                                        <lable>Secret Key</lable>
                                        <input type="text" name="stripe_secret_key" value="{{ isset($paymentGateway)&& $paymentGateway->stripe_secret_key !='' ? $paymentGateway->stripe_secret_key : '' }}" class="form-control" placeholder="Enter secret key">
                                    </div>

                                    <div class="form-group">
                                        <div class="checkbox checkbox-primary checkbox-inline">
                                            <input id="stripe_status" name="stripe_status" type="checkbox" value="1" {{ isset($paymentGateway->stripe_status) && $paymentGateway->stripe_status == 1  ? 'checked' : ''}}>
                                            <label for="stripe_status" class="text-bold">Status</label>
                                        </div>
                                        <br>
                                        <br>
                                        <strong>Uygulama kimlik bilgilerini almak için lütfen <a href="https://stripe.com/" target="_blank">buradan </a>Stripe'de hesap oluşturun </strong>

                                    </div>
                                    <hr>
                                    <h3> Paypal Ayarları </h3>
                                    <hr>
                                    <div class="form-group">
                                        <lable>Paypal E-Posta</lable>
                                        <input type="text" name="paypal_email" value="{{ isset($paymentGateway)&& $paymentGateway->paypal_email !='' ? $paymentGateway->paypal_email : '' }}" class="form-control" placeholder="İş e-postanızı girin" >
                                    </div>

                                    <div class="form-group">
                                        <div class="checkbox checkbox-primary checkbox-inline">
                                            <input id="paypal_status" name="paypal_status" type="checkbox" value="1" {{ isset($paymentGateway->paypal_status) && $paymentGateway->paypal_status == 1  ? 'checked' : ''}}>
                                            <label for="paypal_status" class="text-bold">Durum</label>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <button class="btn btn-success btn-sm">Kaydet</button>
                                        <br>
                                        <br>
                                        <strong>Uygulama kimlik bilgilerini almak için lütfen <a href="https://www.paypal.com" target="_blank">buradan</a> PayPal'da hesap oluşturun</strong>
                                        <br>
                                        <p class="label label-danger"> <strong>
                                            Ödeme etkinleştirildikten sonra Uygulama URL'sine Yönlendirdiğinizden Emin Olun.
                                        </strong> </p>

                    										<div>
                                          <ol>
                                            <li>Tekrar: Ödeme yapıldıktan sonra yeni URL'ye yönlendir</li>
                                            <li>PayPal web sitesine gidin ve hesabınıza giriş yapın.</li>
                                            <li>Sayfanın üst kısmındaki "Profil" i tıklayın.</li>
                                            <li>Satış Tercihleri sütunundaki "Web Sitesi Ödeme Tercihleri" bağlantısını tıklayın.</li>
                                            <li>Otomatik Geri Dönüş "Açık" düğmesini tıklayın.</li>
                                            <li>Dönüş URL Gereksinimlerini inceleyin.</li>
                                            <li>Bu URL'yi kopyalayın {{url('/verify_ad')}} ve Dönüş URL'sine girin. </li>
                                            <li>"Kaydet" i tıklayın.</li>
                                          </ol>
                                        </div>
                                    </div>

                                </form>
                            </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- end row -->
            </div> <!-- container -->
        </div> <!-- content -->
        <script>

            $(document).ready(function () {
                $('#paypal_status').click(function () {
                    if( $(this).is(":checked")  ){
                        $('#stripe_status').prop("checked", false);
                    }else{
                        $('#paypal_status').prop("checked", true);
                    }
                });

                $('#stripe_status').click(function () {
                    if( $(this).is(":checked")  ){
                        $('#paypal_status').prop("checked", false);
                    }else{
                        $('#stripe_status').prop("checked", true);
                    }
                });


               $('#featuredAdsForm').submit(function () {
                   var data = new FormData(this);
                   $.ajax({
                       url: "{{ route('featured-ads.store') }}",
                       data: data,
                       contentType: false,
                       processData: false,
                       type: 'POST',
                       success: function(result){
                           if(result.msg == 1){
                            $('#paypalId').val(result.id);
                            swal('Success', 'Settings saved successfully!', 'success');
                           }
                           $('#loading').hide();
                       }
                   });
                return false;
               });

               $('#stripeForm').submit(function () {
                   var data = new FormData(this);
                   $.ajax({
                       url: "{{ route('save-payment-gateway') }}",
                       data: data,
                       contentType: false,
                       processData: false,
                       type: 'POST',
                       success: function(result){
                           if(result.msg == 1){
                            swal('Success', 'Stripe settings saved successfully!', 'success');
                           }
                           $('#loading').hide();
                       }
                   });
                return false;
               });


            });

        </script>
@endsection
