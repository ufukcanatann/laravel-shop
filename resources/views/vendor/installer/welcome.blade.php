@extends('vendor.installer.layouts.master')

@section('template_title')
    {{ trans('installer_messages.welcome.templateTitle') }}
@endsection

@section('title')
    {{ trans('installer_messages.welcome.title') }}
@endsection

@section('container')

    <style>
        input{
            margin: 0!important;
        }
        .hidden{
            display: none;
        }
        .info input, .info select {
            margin-bottom: 0!important;
        }
        .error{  color: red; }
        .success{  color: green; }
        input[type=email]{
            outline: none;
            border: 1px solid #ddd;
            border-radius: 3px;
            padding: 10px 12px;
            width: calc(100% - 24px);
            margin: 0 auto 1em
        }
    </style>
    <p class="text-center">
      {{ trans('installer_messages.welcome.message') }}
        <div class="hidden ShowERR" style="padding: 5px"></div>
    <form id="admin_info">
        <div class="block">
            <input type="radio" name="appSettingsTabs" id="appSettingsTab1" value="null" checked />
            <label for="appSettingsTab1">
                <span>
                    Kişisel Giriş Bilgileri
                </span>
            </label>
            <div class="info">
                <div class="form-group">
                    <label for="">İsim</label>
                    <input type="text" name="name" value="{{ \Session()->exists('admin_name')? \Session::get('admin_name') : '' }}" required autocomplete="off" placeholder="Enter Your name">
                </div>
                <div class="form-group">
                    <label for="">E-Posta</label>
                    <input type="email" name="email" value="{{ \Session()->exists('admin_email')? \Session::get('admin_email') : '' }}" required autocomplete="off" placeholder="Enter your email id">
                </div>
                <div class="form-group">
                    <label for="">Parola</label>
                    <input type="password" name="password" value="{{ \Session()->exists('admin_password')? \Session::get('') : '' }}" required autocomplete="off" placeholder="Enter your password">
                </div>
                <br>
            </div>
        </div>
        <div class="block">
            <input type="radio" name="appSettingsTabs" id="appSettingsTab2" value="null" />
            <label for="appSettingsTab2">
                <span> Veritabanı Bilgileri </span>
            </label>
            <div class="info">
                <p class="text-center btn btn-xs btn-primary pull-right" style="cursor: help; margin:5px" data-toggle="modal" data-target="#myModal"> Need Help?</p>
                <div class="clearfix"></div>
                <div class="form-group">
                        <label for="database_hostname">
                            Veritabanı Ana Bilgisayarı
                        </label>
                        <input type="text" name="DB_HOST" id="database_hostname" value="{{ trim( isset($db['DB_HOST']) && $db['DB_HOST'] !='' ? $db['DB_HOST'] : '') }}" placeholder="Database Host" required>
                    </div>

                    <div class="form-group ">
                        <label for="database_name">
                            Veri tabanı ismi
                        </label>
                        <input type="text" name="DB_DATABASE" id="database_name" value="{{ trim( isset($db['DB_DATABASE']) && $db['DB_DATABASE'] !='' ? $db['DB_DATABASE'] : '') }}" placeholder="Database Name" required>
                    </div>

                    <div class="form-group ">
                        <label for="database_username">
                            Veritabanı Kullanıcı Adı
                        </label>
                        <input type="text" name="DB_USERNAME" id="database_username" value="{{ trim( isset($db['DB_USERNAME']) && $db['DB_USERNAME'] !='' ? $db['DB_USERNAME'] : '') }}" placeholder="Database User Name" required>
                    </div>
                    <div class="form-group ">
                        <label for="database_password">
                            Veritabanı Parolası
                        </label>
                        <input type="password" name="DB_PASSWORD" id="database_password" value="{{ trim( isset($db['DB_PASSWORD']) && $db['DB_PASSWORD'] !='' ? $db['DB_PASSWORD'] : '') }}" placeholder="Database Password" required>
                    </div>
                <br>
            </div>
        </div>
        <br>
        <div class="text-center">
        <button class="button swing" type="submit"> <i></i> Bağlantıyı kontrol et </button>
        </div>
    </form>

    <!-- Modal -->
    <div class="modal fade" id="myModal" role="dialog">
        <div class="modal-dialog modal-md">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Ranksol Kullanıcı Kılavuzu</h4>
                </div>
                <div class="modal-body">
                    <h3 id="db_cr"><strong>A) Veritabanı Oluşturma</strong></h3>
                    <p>
                        Uygulamayı yüklemeden önce bir veritabanı kimlik bilgilerine ihtiyacınız vardır, bu nedenle önce yerel sunucunuzda nasıl veritabanı oluşturacağınıza bakın.
                        Aşağıda belirtilen ekran görüntülerinde adım adım talimatlara bakın.
                    </p>
                    <img src="{{ asset('installer/img/step-1.png') }}" alt="" width="100%"><br>
                    <img src="{{ asset('installer/img/step-2.png') }}" alt="" width="100%"><br>
                    <img src="{{ asset('installer/img/step-3.png') }}" alt="" width="100%"><br>
                    <img src="{{ asset('installer/img/step-4.png') }}" alt="" width="100%"><br>
                    <img src="{{ asset('installer/img/step-5.png') }}" alt="" width="100%"><br>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function(){
            $('#admin_info').submit(function(){
            $('.swing i').addClass('fa fa-spin fa-spinner');

                var data = $( this ).serialize();
                $.ajax({
                    url: "<?php echo route('LaravelInstaller::write_env'); ?>",
                    data: data,
                    contentType: false,
                    processData: false,
                    type: 'GET',
                    success: function(result){
                        if(result.error!=1){
                            $.get("{{ route('LaravelInstaller::checkDB') }}", {name:'my name'}, function (res) {

                                if(res.error!=''){
                                    $('.ShowERR').html(res.error).removeClass('hidden').addClass('error');
                                }
                                if(res.success == '1' ){
                                    window.location.href="{{ route('LaravelInstaller::requirements') }}";
                                }
                                $('.swing i').removeClass('fa fa-spin fa-spinner');
                            });
                        }
                    }
                });
                return false;
            });
        });
    </script>
@endsection