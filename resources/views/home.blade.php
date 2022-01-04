@extends('layouts.app')
@section('content')
<style>
    .img-cat{ height:28px; width: 38px; }
    .form-control{ background-color: white!important;}
    .slider img{
        min-height: 140px !important;
        width: 270px!important;
    }

    .icon-bar span{
        background-color: aqua    
    }
</style>
<link rel="stylesheet" href="{{ asset('assets/css/slick.css') }}">

<?php
// settings
$setting = DB::table('setting')->first();
function buildCategory($parent, $category) {
    //print_r($category['parent_cats'][$parent]);
    $html = $bold = "";
    if (isset($category['parent_cats'][$parent])) {
        $html .= "";
        foreach ($category['parent_cats'][$parent] as $cat_id) {
            if (!isset($category['parent_cats'][$cat_id])) {
                $html .= "<option value='".$cat_id."'>" .ucfirst($category['categories'][$cat_id]['name']). "</option>";
            }
            if (isset($category['parent_cats'][$cat_id])) {
                if($category['categories'][$cat_id]['parent_id'] == 0){
                    $html .= "<optgroup label='" . ucfirst($category['categories'][$cat_id]['name']) . "'>";
                }else{
                    $html .= "<option  value='".$cat_id."'> " .ucfirst($category['categories'][$cat_id]['name']). "</option>";
                }
                //$html .= "<optgroup label='" . ucfirst($category['categories'][$cat_id]['name']) . "'>";
                $html .= buildCategory($cat_id, $category);
                $html .= "</optgroup>";
            }
        }
        $html .= "";
    }
    $html .='';
    return $html;
}
?>
    @if (session('success'))
        <div class="alert alert-success">
            {!! session('success') !!}
        </div>
    @endif
    @if (session('error'))
        <div class="alert alert-danger">
            {!! session('error') !!}
        </div>
    @endif
    <div class="main_bg">
        <div class="dtable hw100">
            <div class="dtable-cell hw100">
                <div class="container m-b-30">
                    @if( isset($setting) && $setting->home_ads  == 1 && $setting->home_ads_p == 'bs' )
                        <div class="ads_bs">
                            {!! $setting->home_adsense !!}
                        </div>
                    @endif
                    <form action="{{url('search/query')}}" method="get">
                        <div class="row search-row animated fadeInUp">
                            <div class="col-lg-3 col-sm-3 search-col relative"><i class="icon-docs icon-append"></i>
                                <input type="text" name="keyword" class="form-control has-icon" placeholder="Aranan Kelime" value="">
                            </div>
                            <div class="col-lg-3 col-sm-3 search-col relative locationicon">
                                <i class="icon-location-2 icon-append"></i>
                                <select name="region" id="region" class="form-control locinput input-rel searchtag-input has-icon selecters">
                                    <option value="">Bölge Seç</option>
                                    @foreach($region as $value)
                                        <option value="{{ $value->id }}">{{ ucfirst($value->title) }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-lg-3 col-sm-3 search-col relative">
                                {{--{!! $category !!}--}}
                                <i class="icon  icon-th icon-append"></i>
                                <select name="category" style="height:48px" class="form-control locinput input-rel has-icon" id="category" required>
                                    <option value=""> Kategori Seç</option>
                                    {!! buildCategory(0, $category) !!}
                                    {{--<input class="form-control" id="category" name="category" readonly type="text" data-toggle="modal" data-target="#categoryModal">--}}
                                </select>
                            </div>
                            <div class="col-lg-3 col-sm-3 search-col">
                                <button class="btn btn-danger btn-search btn-block"><i class="icon-search"></i><strong>Find</strong></button>
                            </div>
                        </div>
                    </form>
                        @if( isset($setting->home_ads) && $setting->home_ads  == 1 && $setting->home_ads_p == 'as' )
                            <div class="ads_bs">
                                {!! $setting->home_adsense !!}
                            </div>
                        @endif
                </div>
            </div>
        </div>
    </div>
    <div class="main-container">
        <div class="container">
            <div id="hidden_main_cat" class="col-md-12 p-20">
                <center><h2><span>Anasayfa</span> Vitrin</h2></center>
                <div class="row">
                    <div class="col-xs-6 col-sm-4">
                        <div class="vitrin-infoKutu">
                            <a href="">
                                <div class="vitrin-img d-flex flex-row justify-content-center align-items-center">
                                    <img src="assets/images/urun-1.jpg" alt="" class=" d-flex justify-content-center">
                                </div>
                            </a>
                            <div class="vitrin-icerik">
                                <div class="row">
                                    <div class="col-xs-12 col-sm-12">
                                        <h2 class="vitrin-baslik">Apple iPhone 11</h2>
                                        <div class="vitrin-detay">
                                            <span class="vitrin-kategori">Apple</span> / <span
                                                class="vitrin-İlanTarih">16 May. 2021</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xs-6 col-sm-4">
                        <div class="vitrin-infoKutu">
                            <a href="">
                                <div class="vitrin-img">
                                    <img src="assets/images/urun-2.jpg"  alt="" class="">
                                </div>
                            </a>
                            <div class="vitrin-icerik">
                                <div class="row">
                                    <div class="col-xs-12 col-sm-12">
                                        <h2 class="vitrin-baslik">Xiaomi Redmi Note 9 Pro</h2>
                                        <div class="vitrin-detay">
                                            <span class="vitrin-kategori">Xiaomi</span> / <span
                                                class="vitrin-İlanTarih">16 May. 2021</span>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xs-6 col-sm-4">
                        <div class="vitrin-infoKutu">
                            <a href="">
                                <div class="vitrin-img">
                                    <img src="assets/images/urun-3.jpg"  alt="" class="">
                                </div>
                            </a>
                            <div class="vitrin-icerik">
                                <div class="row">
                                    <div class="col-xs-12 col-sm-12">
                                        <h2 class="vitrin-baslik">Xiaomi Redmi Note 8 Pro</h2>
                                        <div class="vitrin-detay">
                                            <span class="vitrin-kategori">Xiaomi</span> / <span
                                                class="vitrin-İlanTarih">16 May. 2021</span>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xs-6 col-sm-4">
                        <div class="vitrin-infoKutu">
                            <a href="">
                                <div class="vitrin-img">
                                    <img src="assets/images/urun-4.jpg"  alt="" class="">
                                </div>
                            </a>
                            <div class="vitrin-icerik">
                                <div class="row">
                                    <div class="col-xs-12 col-sm-12">
                                        <h2 class="vitrin-baslik">General Mobile GM 20 Pro</h2>
                                        <div class="vitrin-detay">
                                            <span class="vitrin-kategori">General Mobile</span> / <span
                                                class="vitrin-İlanTarih">16 May. 2021</span>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xs-6 col-sm-4">
                        <div class="vitrin-infoKutu">
                            <a href="">
                                <div class="vitrin-img">
                                    <img src="assets/images/urun-5.jpg"  alt="" class="">
                                </div>
                            </a>
                            <div class="vitrin-icerik">
                                <div class="row">
                                    <div class="col-xs-12 col-sm-12">
                                        <h2 class="vitrin-baslik">Huawei Mate 40 Pro</h2>
                                        <div class="vitrin-detay">
                                            <span class="vitrin-kategori">Huawei</span> / <span
                                                class="vitrin-İlanTarih">16 May. 2021</span>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xs-6 col-sm-4">
                        <div class="vitrin-infoKutu">
                            <a href="">
                                <div class="vitrin-img">
                                    <img src="assets/images/urun-6.jpg" alt="" class="">
                                </div>
                            </a>
                            <div class="vitrin-icerik">
                                <div class="row">
                                    <div class="col-xs-12 col-sm-12">
                                        <h2 class="vitrin-baslik">Samsung Galaxy Note 20 Ultra</h2>
                                        <div class="vitrin-detay">
                                            <span class="vitrin-kategori">Samsung</span> / <span
                                                class="vitrin-İlanTarih">16 May. 2021</span>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class=" p-b-10 page-content">
            @if( isset($setting))
             @if( $setting->home_ads_p != 'r' || $setting->home_ads == 0 )
                <div class=" p-b-10 page-content">
             @else
                <div class=" p-b-10 page-content col-md-9">
             @endif
            @endif

            <div id="MainCategory" class="box-title no-border">
                <div class="inner">
                    <h2><span>Anasayfa</span> Vitrin</h2>
                    <a href="#" class="pull-right" style="margin-top:15px">Tüm vitrin ilanlarını görüntüle</a>
                </div>
            </div>
                <div id="MainCategory">
                    <div class="vitrin-katman sect-pt4 route">
                        <div class="container">
                            <div class="row">
                                <div class="col-md-2 col-2">
                                    <div class="vitrin-infoKutu">
                                        <a href="">
                                            <div class="vitrin-img">
                                                <img src="assets/images/urun-1.jpg" alt="" class="">
                                            </div>
                                        </a>
                                        <div class="vitrin-icerik">
                                            <div class="row">
                                                <div class="col-sm-12">
                                                    <h2 class="vitrin-baslik">Apple iPhone 11</h2>
                                                    <div class="vitrin-detay">
                                                        <span class="vitrin-kategori">Apple</span> / <span
                                                            class="vitrin-İlanTarih">16 May. 2021</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2 col-2">
                                    <div class="vitrin-infoKutu">
                                        <a href="">
                                            <div class="vitrin-img">
                                                <img src="assets/images/urun-2.jpg"  alt="" class="">
                                            </div>
                                        </a>
                                        <div class="vitrin-icerik">
                                            <div class="row">
                                                <div class="col-sm-12">
                                                    <h2 class="vitrin-baslik">Xiaomi Redmi Note 9 Pro</h2>
                                                    <div class="vitrin-detay">
                                                        <span class="vitrin-kategori">Xiaomi</span> / <span
                                                            class="vitrin-İlanTarih">16 May. 2021</span>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2 col-2">
                                    <div class="vitrin-infoKutu">
                                        <a href="">
                                            <div class="vitrin-img">
                                                <img src="assets/images/urun-3.jpg"  alt="" class="">
                                            </div>
                                        </a>
                                        <div class="vitrin-icerik">
                                            <div class="row">
                                                <div class="col-sm-12">
                                                    <h2 class="vitrin-baslik">Xiaomi Redmi Note 8 Pro</h2>
                                                    <div class="vitrin-detay">
                                                        <span class="vitrin-kategori">Xiaomi</span> / <span
                                                            class="vitrin-İlanTarih">16 May. 2021</span>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2 col-2">
                                    <div class="vitrin-infoKutu">
                                        <a href="">
                                            <div class="vitrin-img">
                                                <img src="assets/images/urun-4.jpg"  alt="" class="">
                                            </div>
                                        </a>
                                        <div class="vitrin-icerik">
                                            <div class="row">
                                                <div class="col-sm-12">
                                                    <h2 class="vitrin-baslik">General Mobile GM 20 Pro</h2>
                                                    <div class="vitrin-detay">
                                                        <span class="vitrin-kategori">Apple</span> / <span
                                                            class="vitrin-İlanTarih">16 May. 2021</span>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2 col-2">
                                    <div class="vitrin-infoKutu">
                                        <a href="">
                                            <div class="vitrin-img">
                                                <img src="assets/images/urun-5.jpg"  alt="" class="">
                                            </div>
                                        </a>
                                        <div class="vitrin-icerik">
                                            <div class="row">
                                                <div class="col-sm-12">
                                                    <h2 class="vitrin-baslik">Huawei Mate 40 Pro</h2>
                                                    <div class="vitrin-detay">
                                                        <span class="vitrin-kategori">Huawei</span> / <span
                                                            class="vitrin-İlanTarih">16 May. 2021</span>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2 col-2">
                                    <div class="vitrin-infoKutu">
                                        <a href="">
                                            <div class="vitrin-img">
                                                <img src="assets/images/urun-6.jpg" alt="" class="">
                                            </div>
                                        </a>
                                        <div class="vitrin-icerik">
                                            <div class="row">
                                                <div class="col-sm-12">
                                                    <h2 class="vitrin-baslik">Samsung Galaxy Note 20 Ultra</h2>
                                                    <div class="vitrin-detay">
                                                        <span class="vitrin-kategori">Samsung</span> / <span
                                                            class="vitrin-İlanTarih">16 May. 2021</span>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @if( isset($setting->home_ads) && $setting->home_ads  == 1 && $setting->home_ads_p == 'r' )
                <div class="col-sm-3 page-sidebar col-thin-left">
                    <aside>
                        <div class="inner-box">
                            {!! $setting->home_adsense !!}
                        </div>
                        <div class="inner-box no-padding"><img class="img-responsive" src="images/add2.jpg" alt="">
                        </div>
                    </aside>
                </div>
            @endif
        </div>
        <!-- slider  -->

        <div class="main-container">
            <div class="container">
                <div id="hidden_main_cat" class="col-md-12 p-20">
                    <center><h2>Hızlı <span>Açık</span> Artırmalar</h2></center>
                    <div class="row">
                        <div class="col-xs-6 col-sm-4">
                            <div class="vitrin-infoKutu">
                                <a href="">
                                    <div class="vitrin-img d-flex flex-row justify-content-center align-items-center">
                                        <img src="assets/images/urun-1.jpg" alt="" class=" d-flex justify-content-center">
                                    </div>
                                </a>
                                <div class="vitrin-icerik">
                                    <div class="row">
                                        <div class="col-xs-12 col-sm-12">
                                            <h2 class="vitrin-baslik">Apple iPhone 11</h2>
                                            <div class="vitrin-detay">
                                                <span class="vitrin-kategori">Apple</span> / <span
                                                    class="vitrin-İlanTarih">16 May. 2021</span><hr>
                                                    <span>Kalan Süre: <span id="time" style="font-size: 15px; color: #009BBD"></span> </span><br>
                                                    <span style="font-size: 20px">2.500 TL </span> <span>| Açılış Fiyatı</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xs-6 col-sm-4">
                            <div class="vitrin-infoKutu">
                                <a href="">
                                    <div class="vitrin-img">
                                        <img src="assets/images/urun-2.jpg"  alt="" class="">
                                    </div>
                                </a>
                                <div class="vitrin-icerik">
                                    <div class="row">
                                        <div class="col-xs-12 col-sm-12">
                                            <h2 class="vitrin-baslik">Xiaomi Redmi Note 9 Pro</h2>
                                            <div class="vitrin-detay">
                                                <span class="vitrin-kategori">Xiaomi</span> / <span
                                                    class="vitrin-İlanTarih">16 May. 2021</span><hr>
                                                    <span>Kalan Süre: <span id="time" style="font-size: 15px; color: #009BBD"></span> </span><br>
                                                    <span style="font-size: 20px">2.500 TL </span> <span>| Açılış Fiyatı</span>
                                            </div>
                                        </div>
    
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xs-6 col-sm-4">
                            <div class="vitrin-infoKutu">
                                <a href="">
                                    <div class="vitrin-img">
                                        <img src="assets/images/urun-3.jpg"  alt="" class="">
                                    </div>
                                </a>
                                <div class="vitrin-icerik">
                                    <div class="row">
                                        <div class="col-xs-12 col-sm-12">
                                            <h2 class="vitrin-baslik">Xiaomi Redmi Note 8 Pro</h2>
                                            <div class="vitrin-detay">
                                                <span class="vitrin-kategori">Xiaomi</span> / <span
                                                    class="vitrin-İlanTarih">16 May. 2021</span><hr>
                                                    <span>Kalan Süre: <span id="time" style="font-size: 15px; color: #009BBD"></span> </span><br>
                                                    <span style="font-size: 20px">2.500 TL </span> <span>| Açılış Fiyatı</span>
                                            </div>
                                        </div>
    
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xs-6 col-sm-4">
                            <div class="vitrin-infoKutu">
                                <a href="">
                                    <div class="vitrin-img">
                                        <img src="assets/images/urun-4.jpg"  alt="" class="">
                                    </div>
                                </a>
                                <div class="vitrin-icerik">
                                    <div class="row">
                                        <div class="col-xs-12 col-sm-12">
                                            <h2 class="vitrin-baslik">General Mobile GM 20 Pro</h2>
                                            <div class="vitrin-detay">
                                                <span class="vitrin-kategori">General Mobile</span> / <span
                                                    class="vitrin-İlanTarih">16 May. 2021</span><hr>
                                                    <span>Kalan Süre: <span id="time" style="font-size: 15px; color: #009BBD"></span> </span><br>
                                                    <span style="font-size: 20px">2.500 TL </span> <span>| Açılış Fiyatı</span>
                                            </div>
                                        </div>
    
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xs-6 col-sm-4">
                            <div class="vitrin-infoKutu">
                                <a href="">
                                    <div class="vitrin-img">
                                        <img src="assets/images/urun-5.jpg"  alt="" class="">
                                    </div>
                                </a>
                                <div class="vitrin-icerik">
                                    <div class="row">
                                        <div class="col-xs-12 col-sm-12">
                                            <h2 class="vitrin-baslik">Huawei Mate 40 Pro</h2>
                                            <div class="vitrin-detay">
                                                <span class="vitrin-kategori">Huawei</span> / <span
                                                    class="vitrin-İlanTarih">16 May. 2021</span><hr>
                                                    <span>Kalan Süre: <span id="time" style="font-size: 15px; color: #009BBD"></span> </span><br>
                                                    <span style="font-size: 20px">2.500 TL </span> <span>| Açılış Fiyatı</span>
                                            </div>
                                        </div>
    
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xs-6 col-sm-4">
                            <div class="vitrin-infoKutu">
                                <a href="">
                                    <div class="vitrin-img">
                                        <img src="assets/images/urun-6.jpg" alt="" class="">
                                    </div>
                                </a>
                                <div class="vitrin-icerik">
                                    <div class="row">
                                        <div class="col-xs-12 col-sm-12">
                                            <h2 class="vitrin-baslik">Samsung Galaxy Note 20 Ultra</h2>
                                            <div class="vitrin-detay">
                                                <span class="vitrin-kategori">Samsung</span> / <span
                                                    class="vitrin-İlanTarih">16 May. 2021</span><hr>
                                                    <span>Kalan Süre: <span id="time" style="font-size: 15px; color: #009BBD"></span> </span><br>
                                                    <span style="font-size: 20px">2.500 TL </span> <span>| Açılış Fiyatı</span>
                                            </div>
                                        </div>
    
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                    <div class=" p-b-10 page-content">
                    @if( isset($setting))
                    @if( $setting->home_ads_p != 'r' || $setting->home_ads == 0 )
                        <div class=" p-b-10 page-content">
                    @else
                        <div class=" p-b-10 page-content col-md-9">
                    @endif
                    @endif
    
                    <div class="row">
                        <div class="col-sm-12 col-xs-12" style="display: flex; justify-content: center; ">
                            <img src="assets/images/adyazreklamdepoin.png" style="margin-bottom: 50px; max-width: 100%" alt="">
                        </div>
                    </div>

                    <div id="MainCategory" class="box-title no-border">
                        <div class="inner">
                            <h2>Hızlı <span>Açık</span> Artırmalar</h2>
                            <a href="#" class="pull-right" style="margin-top:15px">Tüm hızlı açık artırmaları görüntüle</a>
                        </div>
                    </div>
                    <div id="MainCategory">
                        <div class="acikArtirma-katman sect-pt4 route">
                            <div class="container">
                                <div class="row">
                                    <div class="col-md-2 col-2">
                                        <div class="acikArtirma-infoKutu">
                                            <a href="">
                                                <div class="acikArtirma-img">
                                                    <img src="assets/images/urun-1.jpg" alt="" class="">
                                                </div>
                                            </a>
                                            <div class="acikArtirma-icerik">
                                                <div class="row">
                                                    <div class="col-sm-12">
                                                        <h2 class="acikArtirma-baslik">Apple iPhone 11</h2>
                                                        <div class="acikArtirma-detay">
                                                            <span class="acikArtirma-kategori">Apple</span> / <span
                                                                class="acikArtirma-İlanTarih">16 May. 2021</span><hr>
                                                            <span>Kalan Süre: <span id="time" style="font-size: 15px; color: #009BBD"></span> </span><br>
                                                            <span style="font-size: 20px">2.500 TL </span> <span>| Açılış Fiyatı</span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-2 col-2">
                                        <div class="acikArtirma-infoKutu">
                                            <a href="">
                                                <div class="acikArtirma-img">
                                                    <img src="assets/images/urun-2.jpg"  alt="" class="">
                                                </div>
                                            </a>
                                            <div class="acikArtirma-icerik">
                                                <div class="row">
                                                    <div class="col-sm-12">
                                                        <h2 class="acikArtirma-baslik">Xiaomi Redmi Note 9 Pro</h2>
                                                        <div class="acikArtirma-detay">
                                                            <span class="acikArtirma-kategori">Xiaomi</span> / <span
                                                                class="acikArtirma-İlanTarih">16 May. 2021</span><hr>
                                                                <span>Kalan Süre: <span id="time" style="font-size: 15px; color: #009BBD"></span> </span><br>
                                                                <span style="font-size: 20px">2.500 TL </span> <span>| Açılış Fiyatı</span>
                                                        </div>
                                                    </div>
    
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-2 col-2">
                                        <div class="acikArtirma-infoKutu">
                                            <a href="">
                                                <div class="acikArtirma-img">
                                                    <img src="assets/images/urun-3.jpg"  alt="" class="">
                                                </div>
                                            </a>
                                            <div class="acikArtirma-icerik">
                                                <div class="row">
                                                    <div class="col-sm-12">
                                                        <h2 class="acikArtirma-baslik">Xiaomi Redmi Note 8 Pro</h2>
                                                        <div class="acikArtirma-detay">
                                                            <span class="acikArtirma-kategori">Xiaomi</span> / <span
                                                                class="acikArtirma-İlanTarih">16 May. 2021</span><hr>
                                                                <span>Kalan Süre: <span id="time" style="font-size: 15px; color: #009BBD"></span> </span><br>
                                                                <span style="font-size: 20px">2.500 TL </span> <span>| Açılış Fiyatı</span>
                                                        </div>
                                                    </div>
    
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-2 col-2">
                                        <div class="acikArtirma-infoKutu">
                                            <a href="">
                                                <div class="acikArtirma-img">
                                                    <img src="assets/images/urun-4.jpg"  alt="" class="">
                                                </div>
                                            </a>
                                            <div class="acikArtirma-icerik">
                                                <div class="row">
                                                    <div class="col-sm-12">
                                                        <h2 class="acikArtirma-baslik">General Mobile GM 20 Pro</h2>
                                                        <div class="acikArtirma-detay">
                                                            <span class="acikArtirma-kategori">Apple</span> / <span
                                                                class="acikArtirma-İlanTarih">16 May. 2021</span><hr>
                                                                <span>Kalan Süre: <span id="time" style="font-size: 15px; color: #009BBD"></span> </span><br>
                                                                <span style="font-size: 20px">2.500 TL </span> <span>| Açılış Fiyatı</span>
                                                        </div>
                                                    </div>
    
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-2 col-2">
                                        <div class="acikArtirma-infoKutu">
                                            <a href="">
                                                <div class="acikArtirma-img">
                                                    <img src="assets/images/urun-5.jpg"  alt="" class="">
                                                </div>
                                            </a>
                                            <div class="acikArtirma-icerik">
                                                <div class="row">
                                                    <div class="col-sm-12">
                                                        <h2 class="acikArtirma-baslik">Huawei Mate 40 Pro</h2>
                                                        <div class="acikArtirma-detay">
                                                            <span class="acikArtirma-kategori">Huawei</span> / <span
                                                                class="acikArtirma-İlanTarih">16 May. 2021</span><hr>
                                                                <span>Kalan Süre: <span id="time" style="font-size: 15px; color: #009BBD"></span> </span><br>
                                                                <span style="font-size: 20px">2.500 TL </span> <span>| Açılış Fiyatı</span>
                                                        </div>
                                                    </div>
    
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-2 col-2">
                                        <div class="acikArtirma-infoKutu">
                                            <a href="">
                                                <div class="acikArtirma-img">
                                                    <img src="assets/images/urun-6.jpg" alt="" class="">
                                                </div>
                                            </a>
                                            <div class="acikArtirma-icerik">
                                                <div class="row">
                                                    <div class="col-sm-12">
                                                        <h2 class="acikArtirma-baslik">Samsung Galaxy Note 20 Ultra</h2>
                                                        <div class="acikArtirma-detay">
                                                            <span class="acikArtirma-kategori">Samsung</span> / <span
                                                                class="acikArtirma-İlanTarih">16 May. 2021</span><hr>
                                                                <span>Kalan Süre: <span id="time" style="font-size: 15px; color: #009BBD"></span> </span><br>
                                                                <span style="font-size: 20px">2.500 TL </span> <span>| Açılış Fiyatı</span>
                                                        </div>
                                                    </div>
    
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @if( isset($setting->home_ads) && $setting->home_ads  == 1 && $setting->home_ads_p == 'r' )
                    <div class="col-sm-3 page-sidebar col-thin-left">
                        <aside>
                            <div class="inner-box">
                                {!! $setting->home_adsense !!}
                            </div>
                            <div class="inner-box no-padding"><img class="img-responsive" src="images/add2.jpg" alt="">
                            </div>
                        </aside>
                    </div>
                @endif
            </div>

    <div class="clearfix" style="clear: both"></div>

        <?php $featured_ads = DB::table('featured_ads')->first(); ?>
            @if( isset( $featured_ads->status) && count( $home_ads ) > 0  && $featured_ads->status == 1 )
            <div class="col-xl-12 content-box m-t-20">
                <div class=" row-featured">
                    <div class="col-xl-12  box-title ">
                        <div class="inner p-l-r-10">
                            <h2>
                                <span>Öne çıkan </span> İlanlar
                            </h2>
                        </div>
                    </div>
            <!--/.item-list-->
                    @foreach($home_ads as $h_ads)
                        <div class="col-md-2 col-2 col-sm-4 col-sm-6">
                            <div class="item-list" style="min-height: 311px;padding:20px">
                                <div class="row">
                                    <div class="no-padding photobox">
                                        <div class="add-image"><span class="photo-count"><i class="fa fa-camera"></i> {{ \App\AdsImages::where('ad_id', $h_ads->id)->count() }} </span>
                                            <a href="{{url('single/'.urlencode(strtolower(str_slug($h_ads->title.'-'.$h_ads->id, '-'))) )}}">
                                                <img height="200" class=" no-margin" src="{{ asset('assets/images/listings/'.$h_ads->image) }}" alt="img">
                                            </a>
                                        </div>
                                    </div>
                                    <a class="pull-left" href="{{url('single/'.urlencode(strtolower(str_slug($h_ads->title.'-'.$h_ads->id, '-'))) )}}"><strong> {{ ucfirst( substr($h_ads->title, 0, 50) ) }}.. </strong> </a>
                                    <a class="pull-right" href="{{url('single/'.urlencode(strtolower(str_slug($h_ads->title.'-'.$h_ads->id, '-'))) )}}"> <strong> {{  $setting->currency_place == 'left' ? $setting->currency : ''  }}{{ number_format($h_ads->price) }} {{  $setting->currency_place == 'right' ? $setting->currency : ''  }} </strong> </a>
                                    <div class="clearfix"></div>
                                    <!--/.add-desc-box-->
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        @endif
    <div class="clearfix" style="clear: both"></div>

   @if( isset($featured_ads->status) && $featured_ads->status == 0)
        @if( count($newAds) > 0 )
        <div class="col-xl-12 content-box m-t-20">
            <div class=" row-featured">
                <div class="col-xl-12  box-title ">
                    <div class="inner p-l-r-10">
                        <h2>
                            <span>SON </span> LISTELENENLER
                        </h2>
                    </div>
                </div>

                <div style="clear: both"></div>
                <div class=" relative  content featured-list-row  w100">
                    <div class="slider autoplay">
                        @foreach($newAds as $ad)
                        <div class="multiple">
                            <a href="{{url('single/'.urlencode(strtolower(str_slug($ad->title.'-'.$ad->id, '-')))  )}}">
                            <img class="img-responsive" src="{{ asset('assets/images/listings/'.$ad->image) }}" alt="img" style="height: 100px !important;">
                            </a>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
        @endif
    @endif
        @if( count( $regionAds ) > 0 )
        <div class="col-xl-12 content-box m-t-20">
            <div class=" row-featured">
                <div class="col-xl-12  box-title ">
                    <div class="inner p-l-r-10">
                        <h2>
                            <span><i class="icon-location-2"></i> En iyi konumlar</span>
                        </h2>
                    </div>
                </div>
                <div class="col-xl-12 tab-inner">
                    <div class="row cat-list arrow">
                        @foreach($regionAds as $val)
                        <li class="cat-list col-md-2 col-2  col-md-6 col-xxs-12">
                            <a href="{{ url('search/query') }}?region={{ $val->id }}"> {{$val->title}} <small class="label label-success">{{ \App\Ads::where(['region_id' => $val->id, 'status' => 1])->count() }}</small></a>
                        </li>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
        @endif
    </div>
    <div class="page-info stat_bg m-t-20" style="background-size: cover!important;background-position: bottom;">
        <div class="bg-overly">
            <div class="container text-center section-promo">
                <div class="row">
                    <div class="col-sm-3 col-sm-6 col-xxs-12">
                        <div class="iconbox-wrap">
                            <div class="iconbox">
                                <div class="iconbox-wrap-icon">
                                    <i class="icon  icon-group"></i>
                                </div>
                                <div class="iconbox-wrap-content">
                                    <h5><span>{{ number_format( \App\User::where(['type' => 'u'])->count() ) }}</span></h5>
                                    <div class="iconbox-wrap-text">Güvenilir Satıcılar</div>
                                </div>
                            </div>
                            <!-- /..iconbox -->
                        </div>
                        <!--/.iconbox-wrap-->
                    </div>

                    <div class="col-sm-3 col-sm-6 col-xxs-12">
                        <div class="iconbox-wrap">
                            <div class="iconbox">
                                <div class="iconbox-wrap-icon">
                                    <i class="icon  icon-th-large-1"></i>
                                </div>
                                <div class="iconbox-wrap-content">
                                    <h5><span>{{ number_format( \App\Category::where('parent_id', '!=', 0)->count() ) }}</span></h5>

                                    <div class="iconbox-wrap-text">Kategoriler</div>
                                </div>
                            </div>
                            <!-- /..iconbox -->
                        </div>
                        <!--/.iconbox-wrap-->
                    </div>
                    <div class="col-sm-3 col-sm-6  col-xxs-12">
                        <div class="iconbox-wrap">
                            <div class="iconbox">
                                <div class="iconbox-wrap-icon">
                                    <i class="icon  icon-map"></i>
                                </div>
                                <div class="iconbox-wrap-content">
                                    <h5><span>{{ number_format(\App\City::count()) }}</span></h5>
                                    <div class="iconbox-wrap-text">Konum</div>
                                </div>
                            </div>
                            <!-- /..iconbox -->
                        </div>
                        <!--/.iconbox-wrap-->
                    </div>
                    <div class="col-sm-3 col-sm-6 col-xxs-12">
                        <div class="iconbox-wrap">
                            <div class="iconbox">
                                <div class="iconbox-wrap-icon">
                                    <img src="{{asset('assets/images/spk-icon.png')}}" alt="ad-icon" height="40">
                                </div>
                                <div class="iconbox-wrap-content">
                                    <h5><span>{{ number_format( \App\Ads::where(['status' => 1])->count() ) }}</span></h5>
                                    <div class="iconbox-wrap-text"> Aktif İlanlar </div>
                                </div>
                            </div>
                            <!-- /..iconbox -->
                        </div>
                        <!--/.iconbox-wrap-->
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="{{ asset('assets/js/slick.js') }}"></script>
    <script src="{{ asset('assets/js/jquery.countdown.min.js') }}"></script>
    <script src="{{ asset('assets/js/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/js/main.js') }}"></script>

    <script>
        $(document).ready(function () {
            $('.autoplay').slick({
                slidesToShow: 3,
                slidesToScroll: 1,
                autoplay: true,
                autoplaySpeed: 2000,
            });
        })

        function startTimer(duration, display) {
    var start = Date.now(),
        diff,
        minutes,
        seconds;
    function timer() {
        // get the number of seconds that have elapsed since 
        // startTimer() was called
        diff = duration - (((Date.now() - start) / 1000) | 0);

        // does the same job as parseInt truncates the float
        minutes = (diff / 60) | 0;
        seconds = (diff % 60) | 0;

        minutes = minutes < 10 ? "0" + minutes : minutes;
        seconds = seconds < 10 ? "0" + seconds : seconds;

        display.textContent = minutes + ":" + seconds; 

        if (diff <= 0) {
            // add one second so that the count down starts at the full duration
            // example 05:00 not 04:59
            start = Date.now() + 1000;
        }
    };
    // we don't want to wait a full second before the timer starts
    timer();
    setInterval(timer, 1000);
}

window.onload = function () {
    var fiveMinutes = 60 * 5,
        display = document.querySelector('#time');
    startTimer(fiveMinutes, display);
};
    </script>

@endsection
