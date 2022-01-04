@extends('admin.layout.app')
@section('content')
<style>
    .add_more{float: right; margin-bottom: 5px;
    }
</style>
<div class="content-page">
    <!-- Start content -->
    <div class="content">
        <div class="col-xs-12">
            <div class="page-title-box">
                <h4 class="page-title">Kontrol Paneli</h4>
                <ol class="breadcrumb p-0 m-0">
                    <li> <a href="{{ url('dashboard') }}">Kontrol Paneli</a></li>
                    <li class="active"> İlanlar </li>
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

            <div class="card-box">
                <div class="row">
                    <div class="col-xs-12 bg-white">
                        <table id="load_datatable" class="table table-colored table-inverse table-hover table-striped table-bordered">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Başlık</th>
                                <th>Kullanıcı</th>
                                <th>Kategori</th>
                                <th>Bölge</th>
                                <th>Şehir</th>
                                <th>İlan Türü</th>
                                <th>Tarih</th>
                                <th>Durum&nbsp;|&nbsp;Eylem</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td colspan="4">Henüz Kayıt bulunamadı.</td>
                            </tr>
                            </tbody>
                        </table>
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
            "order": [[7, 'desc']],
            processing: true,
            serverSide: true,
            "initComplete": function (settings, json) {
            },
            ajax: "{!! url('load-ads-list') !!}",
            columns: [
                {data: 'id', name: 'id'},
                {data: 'title', name: 'ads.title'},
                {data: 'user_name', name: 'users.name'},
                {data: 'category_title', name: 'categories.name'},
                {data: 'region_title', name: 'region.title'},
                {data: 'city_title', name: 'city.title'},
                {data: 'f_type', name: 'f_type'},
                {data: 'created_at', name: 'ads.created_at'},
                {data: 'action', name: 'action', orderable: false, searchable: false}
                //{ data: 'updated_at', name: 'updated_at' }
            ]
        });
    });
</script>
@endsection