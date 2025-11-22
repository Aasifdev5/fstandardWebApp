@extends('layout.master')
@section('title')
Editar perfil
@endsection
@section('main_content')
<!-- page-wrapper Start-->
<div class="container-fluid">
    <!-- sign up page start-->
    <div class="auth-bg-video">
        <div class="authentication-box">
            <div class="text-center"><img src="assets/images/endless-logo.png" alt=""></div>
            <div class="card mt-4 p-4">
                <h4 class="text-center">Editar perfil</h4>
                <form class="theme-form" action="update_profile" method="post" enctype="multipart/form-data">
                    @if(Session::has('success'))
                    <div class="alert alert-success">
                        <p>{{session::get('success')}}</p>
                    </div>
                    @endif
                    @if(Session::has('fail'))
                    <div class="alert alert-danger">
                        <p>{{session::get('fail')}}</p>
                    </div>
                    @endif
                    @csrf
                    <input type="hidden" name="user_id" value="{{$user_session->id}}">
                    <div class="row g-1">
                        <div class="col-md-12">
                            <div class="mb-2">
                                <div class="personal-image">
                                    <label class="label">
                                        <input type="file" name="profile_photo" id="profilePhotoInput" onchange="previewImage(this)" />
                                        <figure class="personal-figure">
                                            @if(!empty($user_session->profile_photo))
                                            <img src="{{asset('profile_photo/')}}<?php echo '/' . $user_session->profile_photo; ?>" class="personal-avatar" alt="avatar" id="profileImagePreview">
                                            @else
                                            <img src="images/profile photo.png" class="personal-avatar" alt="avatar" id="profileImagePreview">
                                            @endif
                                        </figure>
                                    </label>
                                    <p>PNG, JPG, JPEG</p>
                                </div>
                                <script>
                                    function previewImage(input) {
                                        var preview = document.getElementById('profileImagePreview');
                                        var file = input.files[0];
                                        var reader = new FileReader();
                                        reader.onloadend = function() {
                                            preview.src = reader.result;
                                        }
                                        if (file) {
                                            reader.readAsDataURL(file);
                                        } else {
                                            preview.src = "images/profile photo.png"; // Default image when no file selected
                                        }
                                    }
                                </script>
                                <span class="text-danger">@error('profile_photo'){{$message}}@enderror</span>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="col-form-label">Nombre completo</label>
                                <input class="form-control" type="text" name="name" value="{{$user_session->name}}" placeholder="John">
                                <span class="text-danger">@error('name'){{$message}}@enderror</span>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="col-form-label">País </label>
                                <input class="form-control" type="text" name="country" value="{{$user_session->country}}" placeholder="India">
                                <span class="text-danger">@error('country'){{$message}}@enderror</span>
                            </div>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="col-form-label">Correo electrónico</label>
                        <input class="form-control" type="email" name="email" value="{{$user_session->email}}" placeholder="John Deo">
                        <span class="text-danger">@error('email'){{$message}}@enderror</span>
                    </div>
                    <div class="mb-3">
                        <label class="col-form-label">Nueva contraseña (opcional)</label>
                        <input class="form-control" type="password" name="password" placeholder="Ingresa nueva contraseña">
                        <span class="text-danger">@error('password'){{$message}}@enderror</span>
                    </div>
                    <div class="mb-3">
                        <label class="col-form-label">Confirmar nueva contraseña</label>
                        <input class="form-control" type="password" name="password_confirmation" placeholder="Confirma la contraseña">
                        <span class="text-danger">@error('password_confirmation'){{$message}}@enderror</span>
                    </div>
                    <div class="row g-2">
                        <div class="col-sm-4">
                            <button class="btn btn-primary" type="submit">Actualizar</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- page-wrapper Ends-->
@endsection
