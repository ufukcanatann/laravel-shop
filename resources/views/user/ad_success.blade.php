@extends('layouts.app')
@section('content')
    <style>
        .main-container{
            padding: 30px 0;
        }
        #preview_profile{
            display: block;
            height: 60px;
            margin-bottom: 10px;
        }
        .userImg{ height: 55px; }
    </style>
    <div class="main-container">
        <div class="container">
            <div class="row">
                <div class="col-md-12 page-content">
                    <div class="inner-box category-content">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="alert alert-success pgray  alert-lg" role="alert">
                                   @if($id == 1)
                                        <h2 class="no-margin no-padding">✔ Tebrikler! İlanınız yakında hazır olacak.</h2>
                                        <p> Yönetici incelemesindeki ilanınız için tebrikler. incelemeden sonra etkinleştirilecek </p>
                                   @endif
                                   @if($id == 4)
                                        <h2 class="no-margin no-padding"><i class="fa fa-envelope-o" aria-hidden="true"></i> Tebrikler! E-posta, posta adresinize gönderildi!</h2>
                                        <p> Lütfen e-postanızı aktif hesabınız ve yayımlanan ilanınız için onaylayın.</p>
                                           <p>ilan incelemeden sonra etkinleştirilecek </p>
                                   @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        $(document).ready(function(){
            $('#load_datatable').DataTable({
                "pageLength":25,
                "order": [[0, 'desc']],
                processing: true,
                serverSide: true,
                "initComplete": function (settings, json) {
                },
                ajax: "{!! url('load-my-ads') !!}?load_ads=active",
                columns: [
                    {data: 'id', name: 'id'},
                    {data: 'title', name: 'ads.title'},
                    {data: 'category_title', name: 'categories.name'},
                    {data: 'region_title', name: 'region.title'},
                    {data: 'city_title', name: 'city.title'},
                    {data: 'price', name: 'ads.price'},
                    {data: 'created_at', name: 'ads.created_at'},
                    {data: 'action', name: 'action', orderable: false, searchable: false}
                    //{ data: 'updated_at', name: 'updated_at' }
                ]
            });
        });
    </script>
@endsection
