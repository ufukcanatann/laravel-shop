@extends('admin.layout.app')
@section('title', 'Setting')
@section('content')
    <link href="{{ asset('admin_assets/plugins/bootstrap-colorpicker/css/bootstrap-colorpicker.min.css') }}" rel="stylesheet">
    <style>
        form#add_category .loader {
            float: right;
            margin-left: 5px;
            margin-top: 6px;
        }
        form#add_category .loader img{
            display: none;
        }
        .file_hidden, .top_image_hidden, .bottom_image_hidden{
            display: none !important;
        }
        #preview_profile, #preview_tb, #preview_bb{
            display: block;
            height: 60px;
            margin-bottom: 10px;
        }
        .bg-lightgray{ background-color: #f3f3f3;}

    </style>
    <div class="content-page">
        <!-- Start content -->
        <div class="content">

            <div class="col-xs-12">
                <div class="page-title-box">
                    <h4 class="page-title">Kontrol Paneli</h4>
                    <ol class="breadcrumb p-0 m-0">
                        <li> <a href="{{ url('dashboard') }}">Kontrol Paneli</a></li>
                        <li class="active"> Ağ Ayarları </li>
                    </ol>
                    <div class="clearfix"></div>
                </div>
            </div>

            <div class="col-xs-12">

                @if (session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif

                @if (session('error'))
                    <div class="alert alert-danger">
                        {{ session('error') }}
                    </div>
                @endif

                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <div class="col-xs-12">
                    <div class="row">
                        <div class="panel panel-color panel-inverse">
                            <div class="panel-heading">
                                <h3 class="panel-title">Ağ Ayarları</h3>
                            </div>
                            <div class="panel-body">
                                <form class="form-horizontal" role="form" id="setting" method="post" action="{{ route('setting.store') }}"  enctype="multipart/form-data">
                                    {{ csrf_field() }}
                                    <input type="hidden" name="id" value="{{ (isset($data->id) && $data->id != "")? $data->id :''  }}">

                                    <div class="form-group">
                                        <label class="col-xs-2 control-label">logo görseli:</label>
                                        <div class="col-xs-10">
                                            <img id="preview_profile" src="<?= ( isset($data) && $data->logo !="")? asset('assets/images/logo/'.$data->logo.' ') : asset('assets/images/logo/logo.png') ?>" alt="" class="img-responsive">
                                            <input type="file" name="logo" class="form-control file_hidden">
                                            <button id="browse_profile" class="btn w-md btn-bordered btn-success waves-effect waves-ligh " type="button">Seç</button>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-xs-2 control-label">Site simge görseli:</label>
                                        <div class="col-xs-10">
                                            <img src="<?= ( isset($data) && $data->favicon !="")? asset('assets/ico/'.$data->favicon.' ') : asset('assets/ico/favicon.png') ?>" alt="" class="img-responsive">
                                            <input type="file" name="favicon" class="form-control">
                                            <small><i class="fa fa-warning text-danger"></i> İzin verilen maksimum dosya boyutu 32x32 </small>

                                        </div>
                                    </div>

                                    <div class="form-group account-btn m-t-10">
                                        <label class="col-xs-2 control-label">Uygulama başlığı:</label>
                                        <div class="col-xs-10">
                                            <input type="text" name="title" class="form-control" value="{{ (isset($data->title)? $data->title : '') }}" placeholder="example.com">
                                        </div>
                                    </div>
                                    <div class="form-group account-btn m-t-10">
                                        <label class="col-xs-2 control-label">Bize ulaşın e-postası:</label>
                                        <div class="col-xs-10">
                                            <input type="email" name="contact_email" required class="form-control" value="{{ (isset($data->contact_email)? $data->contact_email : '') }}" placeholder="info@posta.com">
                                            <small><i class="fa fa-warning text-danger"></i> Lütfen kullanıcıların iletişim için e-postalarını gönderebilecekleri bir e-posta adresi girin. </small>
                                        </div>
                                    </div>

                                    <div class="form-group account-btn m-t-10">
                                        <label class="col-xs-2 control-label">Para birimi:</label>
                                        <div class="col-xs-3">
                                            <input type="text" name="currency" class="form-control" value="{{ (isset($data->currency)? $data->currency : '') }}" placeholder="$, €, Rs etc">
                                            <small> Tek para birimi sembolü ekleyebilirsiniz! </small>
                                        </div>
                                        <div class="col-xs-7">
                                            <div class="radio radio-info radio-inline">
                                                <input type="radio" id="inlineRadio2" value="left" name="currency_place" {{ (isset($data->currency_place) && $data->currency_place == 'left' ? 'checked' : '') }}>
                                                <label for="inlineRadio2"> <strong>Sol</strong> ( $123 ) </label>
                                            </div>
                                            <div class="radio radio-info radio-inline">
                                                <input type="radio" id="inlineRadio1" value="right" name="currency_place" {{ (isset($data->currency_place) && $data->currency_place == 'right' ? 'checked' : '') }}>
                                                <label for="inlineRadio1"> <strong> Sağ </strong> ( 123 Rs ) </label>
                                            </div>

                                            <small style="display: block"> Para Birimi Sembolü yerleşimini seçin </small>

                                        </div>
                                    </div>
                                    <div class="form-group account-btn m-t-10">
                                        <label class="col-xs-2 control-label">Telif hakkı metni:</label>
                                        <div class="col-xs-10">
                                            <input type="text" name="copy_right_text" class="form-control" value="{{ (isset($data->copy_right_text)? $data->copy_right_text : '') }}" placeholder="© example.com">
                                        </div>
                                    </div>
                                    <!-- Body bg -->
                                    <div class="form-group account-btn m-t-10">
                                        <label class="col-xs-2 control-label">Gövde arkaplanı:</label>
                                        <div data-color-format="rgb" data-color="{{ (isset($data->body_bg)? $data->body_bg : '') }}" class="colorpicker-default input-group col-xs-10">
                                            <input type="text" name="body_bg" readonly="readonly" value="{{ (isset($data->body_bg)? $data->body_bg : '') }}" class="form-control">
                                            <span class="input-group-btn add-on">
                                                <button class="btn btn-white" type="button">
                                                    <i style="background-color: {{ (isset($data->body_bg)? $data->body_bg : '') }};margin-top: 2px;"></i>
                                                </button>
                                            </span>
                                        </div>
                                    </div>

                                    <div class="form-group account-btn m-t-10">
                                        <label class="col-xs-2 control-label">Gezinme arkaplanı:</label>
                                        <div data-color-format="rgb" data-color="{{ (isset($data->nav_bg)? $data->nav_bg : '') }}" class="colorpicker-default input-group col-xs-10">
                                            <input type="text" name="nav_bg" readonly="readonly" value="{{ (isset($data->nav_bg)? $data->nav_bg : '') }}" class="form-control">
                                            <span class="input-group-btn add-on">
                                                <button class="btn btn-white" type="button">
                                                    <i style="background-color: {{ (isset($data->nav_bg)? $data->nav_bg : '') }};margin-top: 2px;"></i>
                                                </button>
                                            </span>
                                        </div>
                                    </div>
                                    <div class="form-group account-btn m-t-10">
                                        <label class="col-xs-2 control-label">Altbilgi arkaplanı:</label>
                                        <div data-color-format="rgb" data-color="{{ (isset($data->footer_bg)? $data->footer_bg : '') }}" class="colorpicker-default input-group col-xs-10">
                                            <input type="text" name="footer_bg" readonly="readonly" value="{{ (isset($data->footer_bg)? $data->footer_bg : '') }}" class="form-control">
                                            <span class="input-group-btn add-on">
                                                <button class="btn btn-white" type="button">
                                                    <i style="background-color: {{ (isset($data->footer_bg)? $data->footer_bg : '') }};margin-top: 2px;"></i>
                                                </button>
                                            </span>
                                        </div>
                                    </div>
                                    <div class="form-group account-btn m-t-10">
                                        <label class="col-xs-2 control-label">Altbilgi bağlantı başlıkları:</label>
                                        <div data-color-format="rgb" data-color="{{ (isset($data->footer_head_color)? $data->footer_head_color : '') }}" class="colorpicker-default input-group col-xs-10">
                                            <input type="text" name="footer_head_color" readonly="readonly" value="{{ (isset($data->footer_head_color)? $data->footer_head_color : '') }}" class="form-control">
                                            <span class="input-group-btn add-on">
                                                <button class="btn btn-white" type="button">
                                                    <i style="background-color: {{ (isset($data->footer_head_color)? $data->footer_head_color : '') }};margin-top: 2px;"></i>
                                                </button>
                                            </span>
                                        </div>
                                    </div>
                                    <div class="form-group account-btn m-t-10">
                                        <label class="col-xs-2 control-label">Altbilgi bağlantıları:</label>
                                        <div data-color-format="rgb" data-color="{{ (isset($data->footer_link_color)? $data->footer_link_color : '') }}" class="colorpicker-default input-group col-xs-10">
                                            <input type="text" name="footer_link_color" readonly="readonly" value="{{ (isset($data->footer_link_color)? $data->footer_link_color : '') }}" class="form-control">
                                            <span class="input-group-btn add-on">
                                                <button class="btn btn-white" type="button">
                                                    <i style="background-color: {{ (isset($data->footer_link_color)? $data->footer_link_color : '') }};margin-top: 2px;"></i>
                                                </button>
                                            </span>
                                        </div>
                                    </div>

                                    <div class="col-md-offset-1">
                                        <div class="form-group">
                                            <div class="checkbox checkbox-success checkbox-inline">
                                                <input id="social_links" name="social_links" type="checkbox" value="1" {{ (isset($data->social_links) && $data->social_links == 1)? 'checked' : ''   }}>
                                                <label for="social_links" class="text-bold">Sosyal bağlantılar</label>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-offset-1 social_link m-t-10 m-b-10 {{ (isset($data->social_links) && $data->social_links == 1)? '' : 'hidden'   }}">
                                        <button type="button" class="btn btn-sm btn-facebook" onclick="$('.facebook').removeClass('hidden');" >Facebook</button>
                                        <button type="button" class="btn btn-sm btn-linkedin" onclick="$('.linkedin').removeClass('hidden');" >Linkedin</button>
                                        <button type="button" class="btn btn-sm btn-twitter" onclick="$('.twitter').removeClass('hidden');" >Twitter</button>
                                        <button type="button" class="btn btn-sm btn-googleplus" onclick="$('.googleplus').removeClass('hidden');" >Google+</button>

                                        <div class="facebook {{ $data->facebook !='' ? '' : 'hidden' }} m-t-10">
                                            <div class="form-group">
                                                <label for="">Facebook Bağlantısı</label>
                                                <input type="url" name="facebook" class="form-control" value="{{ $data->facebook !='' ? $data->facebook : '' }} ">
                                            </div>
                                        </div>

                                        <div class="linkedin {{ $data->linkedin !='' ? '' : 'hidden' }} m-t-10">
                                            <div class="form-group">
                                                <label for="">Linkedin Bağlantısı</label>
                                                <input type="url" name="linkedin" class="form-control" value="{{ $data->linkedin !='' ? $data->linkedin : '' }} ">
                                            </div>
                                        </div>

                                        <div class="twitter {{ $data->twitter !='' ? '' : 'hidden' }} hiddenm-t-10">
                                            <div class="form-group">
                                                <label for="">Twitter Bağlantısı</label>
                                                <input type="url" name="twitter" class="form-control" value="{{ $data->twitter !='' ? $data->twitter : '' }} ">
                                            </div>
                                        </div>

                                        <div class="googleplus {{ $data->googleplus !='' ? '' : 'hidden' }} m-t-10">
                                            <div class="form-group">
                                                <label for="">Googleplus Bağlantısı</label>
                                                <input type="url" name="googleplus" class="form-control" value="{{ $data->googleplus !='' ? $data->googleplus : '' }} ">
                                            </div>
                                        </div>
                                    </div>
                                    <!-- config themes -->
                                    <?php
                                    $theme = '';
                                    $theme = env('THEME');

                                    ?>
                                    <div class="form-group account-btn m-t-10">
                                        <label class="col-xs-2 control-label">Tema seç:</label>
                                        <div class="col-xs-7">
                                            <div class="radio radio-info radio-inline">
                                                @if(isset($theme))
                                                    <input type="radio" id="inlineRadio3" value="default" name="theme" {{  $theme == 'default' ? 'checked' : '' }}>
                                                @else
                                                    <input type="radio" id="inlineRadio3" value="default" name="theme" checked>
                                                @endif
                                                <label for="inlineRadio3"> Varsayılan </label>
                                            </div>
                                            <div class="radio radio-info radio-inline">
                                                <input type="radio" id="inlineRadio4" value="theme1" name="theme" {{ (isset($theme) && $theme == 'theme1' ? 'checked' : '') }}>
                                                <label for="inlineRadio4"> Nimble Ads genişletilmiş sürümü </label>
                                            </div>
                                        </div>
                                    </div>



                                    <div class="home-bg {{  $theme == 'theme1'? 'hidden' : '' }}">
                                        <div class="form-group bg-lightgray p-t-10 p-b-10">
                                            <label class="col-xs-2 control-label">Anasayfa başlığı arkaplanı:</label>
                                            <div class="col-xs-10">
                                                <img id="preview_tb" src="<?= ( isset($data) && $data->t_bg_img !="")? asset('assets/images/bg/'.$data->t_bg_img.' ') : asset('assets/images/bg-img.jpg') ?>" alt="" class="img-responsive">
                                                <input type="file" name="t_bg_img" class="form-control top_image_hidden">
                                                <button id="homePageTopBtn" class="btn w-md btn-bordered btn-success waves-effect waves-ligh " type="button">Seç</button>
                                            </div>

                                            <label class="col-xs-2 control-label">Arkaplan pozisyonu:</label>
                                            <div class="col-xs-3">
                                                <select name="t_bg_position" class="form-control">
                                                    <option value="">Seçeneği seçin</option>
                                                    <option {{ (isset($data->t_bg_position) && $data->t_bg_position == 'top' ? 'selected' : '') }} value="top">Üst</option>
                                                    <option {{ (isset($data->t_bg_position) && $data->t_bg_position == 'bottom' ? 'selected' : '') }} value="bottom">Alt</option>
                                                    <option {{ (isset($data->t_bg_position) && $data->t_bg_position == 'center' ? 'selected' : '') }} value="center">Orta</option>
                                                    <option {{ (isset($data->t_bg_position) && $data->t_bg_position == 'left' ? 'selected' : '') }} value="left">Sol</option>
                                                    <option {{ (isset($data->t_bg_position) && $data->t_bg_position == 'right' ? 'selected' : '') }} value="right">Sağ</option>
                                                </select>
                                            </div>

                                        </div>
                                        <div class="form-group bg-lightgray p-t-10 p-b-10">
                                            <label class="col-xs-2 control-label">Anasayfa alt istatistiklerinin arkaplanı:</label>
                                            <div class="col-xs-10">
                                                <img id="preview_bb" src="<?= ( isset($data) && $data->b_bg_img !="")? asset('assets/images/bg/'.$data->b_bg_img.' ') : asset('assets/images/bg4.jpg') ?>" alt="" class="img-responsive">
                                                <input type="file" name="b_bg_img" class="form-control bottom_image_hidden">
                                                <button id="homePageBottomBtn" class="btn w-md btn-bordered btn-success waves-effect waves-light " type="button">Seç</button>
                                            </div>

                                            <label class="col-xs-2 control-label">Arkaplan pozisyonu:</label>
                                            <div class="col-xs-3">
                                                <select name="b_bg_position" class="form-control">
                                                    <option value="">Seçeneği Seç</option>
                                                    <option {{ (isset($data->b_bg_position) && $data->b_bg_position == 'top' ? 'selected' : '') }} value="top">Üst</option>
                                                    <option {{ (isset($data->b_bg_position) && $data->b_bg_position == 'center' ? 'selected' : '') }} value="center">Orta</option>
                                                    <option {{ (isset($data->b_bg_position) && $data->b_bg_position == 'bottom' ? 'selected' : '') }} value="bottom">Alt</option>
                                                    <option {{ (isset($data->b_bg_position) && $data->b_bg_position == 'left' ? 'selected' : '') }} value="left">Sol</option>
                                                    <option {{ (isset($data->b_bg_position) && $data->b_bg_position == 'right' ? 'selected' : '') }} value="right">Sağ</option>
                                                </select>

                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-offset-1">
                                        <div class="form-group">
                                            <div class="checkbox checkbox-success checkbox-inline">
                                                <input id="hide_price" name="hide_price" type="checkbox" value="1" {{ (isset($data->hide_price) && $data->hide_price == 1)? 'checked' : ''   }}>
                                                <label for="hide_price" class="text-bold">İlan Fiyatlarını Gizle</label>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-offset-1">
                                        <div class="form-group">
                                            <div class="checkbox checkbox-success checkbox-inline">
                                                <input id="map_listings" name="map_listings" type="checkbox" value="1" {{ (isset($data->map_listings) && $data->map_listings == 1)? 'checked' : ''   }}>
                                                <label for="map_listings" class="text-bold">Harita Listeleri</label>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-offset-1">
                                        <div class="form-group">
                                            <div class="checkbox checkbox-success checkbox-inline">
                                                <input id="translate" name="translate" type="checkbox" value="1" {{ (isset($data->translate) && $data->translate == 1)? 'checked' : ''   }}>
                                                <label for="translate" class="text-bold">Çevirici</label>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-offset-1">
                                        <div class="form-group">
                                            <div class="checkbox checkbox-success checkbox-inline">
                                                <input id="live_chat" name="live_chat" type="checkbox" value="1" {{ (isset($data->live_chat) && $data->live_chat == 1)? 'checked' : ''   }}>
                                                <label for="live_chat" class="text-bold">Canlı sohbet</label>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-offset-1">
                                        <div class="form-group">
                                            <div class="checkbox checkbox-success checkbox-inline">
                                                <input id="mobile_verify" name="mobile_verify" type="checkbox" value="1" {{ (isset($data->mobile_verify) && $data->mobile_verify == 1)? 'checked' : ''   }}>
                                                <label for="mobile_verify" class="text-bold">Mobil doğrulama</label>
                                            </div>
                                            @if(isset($data->mobile_verify) && $data->mobile_verify == 1)
                                                <a href="{{ Route('mobile_verify.index') }}" class="btn btn-primary btn-sm"> mobil doğrulama api ayarları </a>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="form-group account-btn m-t-10">
                                        <label class=" control-label"></label>
                                        <div class="col-xs-10">
                                            <button class="btn w-md btn-bordered btn-info waves-effect waves-light pull-right" type="submit" >Kaydet</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        $(document).ready(function() {

            $('input[type="radio"]').click(function () {
                if ($('#inlineRadio3').is(":checked")) {
                    $('.home-bg').removeClass('hidden');
                }else{
                    $('.home-bg').addClass('hidden');
                }
            });

            $('#social_links').click(function () {
                if ($('#social_links').is(":checked")) {
                    $('.social_link').removeClass('hidden');
                    console.log('ok');
                } else {
                    $('.social_link').addClass('hidden');
                }
            });

            // color picker
            $('.colorpicker-default').colorpicker({
                format: 'hex'
            });

            // profile preview
            function readURL(input, id) {
                if (input.files && input.files[0]) {
                    var reader = new FileReader();
                    reader.onload = function(e) {
                        $('#'+id).attr('src', e.target.result);
                    }

                    reader.readAsDataURL(input.files[0]);
                }
            }

            // browse image
            $('#browse_profile').click( function(){
                $('.file_hidden').click();
            });

            // browse top bg
            $('#homePageTopBtn').click( function(){
                $('.top_image_hidden').click();
            });
            // browse top bg
            $('#homePageBottomBtn').click( function(){
                $('.bottom_image_hidden').click();
            });

            /* profile */
            $(".file_hidden").change(function() {
                readURL(this, 'preview_profile');
            });
            /* home page top background */
            $(".top_image_hidden").change(function() {
                readURL(this, 'preview_tb');
            });
            /* home page bottom background */
            $(".bottom_image_hidden").change(function() {
                readURL(this, 'preview_bb');
            });

        });
    </script>
@endsection
