@extends('layouts.app')
@section('content')
<style>
    .img-cat{ height:28px; width: 38px; }
    .form-control{ background-color: white!important;}
    .slider img{
        min-height: 140px !important;
        width: 270px!important;
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
                            <div class="col-lg-9 col-sm-9 search-col relative"><i class="icon-docs icon-append"></i>
                                <input required type="text" name="keyword" class="form-control has-icon" placeholder="Aranan Kelime" value="">
                            </div>

                            {{--   <div class="col-lg-3 col-sm-3 search-col relative locationicon">
                                <i class="icon-location-2 icon-append"></i>
                                <select name="region" id="region" class="form-control locinput input-rel searchtag-input has-icon selecters">
                                    <option value="">Bölge Seç</option>
                                    @foreach($region as $value)
                                        <option value="{{ $value->id }}">{{ ucfirst($value->title) }}</option>
                                    @endforeach
                                </select>
                            </div>              --}}
                            {{--  <div class="col-lg-3 col-sm-3 search-col relative">      --}}

                                {{--{!! $category !!}--}}

                            {{--  <i class="icon  icon-th icon-append"></i>
                                <select name="category" style="height:48px" class="form-control locinput input-rel has-icon" id="category" required>
                                    <option value=""> Kategori Seç</option>   --}}

                                   {{--  {!! buildCategory(0, $category) !!}   --}}
                                    {{--<input class="form-control" id="category" name="category" readonly type="text" data-toggle="modal" data-target="#categoryModal">--}}
                                {{-- </select> --}}
                            {{-- </div>--}}
                            <div class="col-lg-3 col-sm-3 search-col">
                                <button class="btn btn-depored btn-search btn-block"><i class="icon-search"></i><strong>Bul!</strong></button>
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
    <div>
        
    </div>

@endsection
