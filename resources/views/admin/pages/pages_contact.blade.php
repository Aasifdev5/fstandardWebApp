@extends('master')
@section('title')
{{stripslashes($page_info->page_title)}}
@endsection
@section('main_content')

<br>
<div class="container" style="margin-bottom: 50px">
<!-- Start Contat Page -->
<div class="contact-page-area vfx-item-ptb vfx-item-info">
  <div class="container-fluid">
    <div class="row">
      <div class="col-lg-8 col-md-7 col-sm-12 col-xs-12">
		 <div class="contact-form">

				@if (count($errors) > 0)
                <div class="message">
				<div class="alert alert-danger">
					<ul style="list-style: none;">
						@foreach ($errors->all() as $error)
							<li>{{ $error }}</li>
						@endforeach
					</ul>
				</div>
            </div>
				@endif

            @if(Session::has('flash_message'))
              <div class="alert alert-success">
                 {{ Session::get('flash_message') }}
               </div>
            @endif
            @if(Session::has('error_flash_message'))
              <div class="alert alert-danger">
                 {{ Session::get('error_flash_message') }}
               </div>
            @endif
           {!! Form::open(array('url' => 'contact_send','class'=>'row','id'=>'contact_form','role'=>'form')) !!}
            <div class="col-lg-6 col-md-12 col-sm-12 col-xs-12">
              <div class="form-group mb-3">
                <label>Nombre</label>
                <input type="text" name="name" id="name" class="form-control" placeholder="Nombre" required>
              </div>
            </div>
            <div class="col-lg-6 col-md-12 col-sm-12 col-xs-12">
              <div class="form-group mb-3">
				<label>Correo Electrónico</label>
                <input type="email" name="email" id="email" class="form-control" placeholder="Correo Electrónico" required>
              </div>
            </div>
            <div class="col-lg-6 col-md-12 col-sm-12 col-xs-12">
              <div class="form-group mb-3">
				<label>Teléfono</label>
                <input type="text" name="phone" id="phone" class="form-control" placeholder="Teléfono">
              </div>
            </div>
            <div class="col-lg-6 col-md-12 col-sm-12 col-xs-12">
              <div class="form-group mb-3">
				<label>Asunto</label>
                <input type="text" name="subject" id="subject" class="form-control" placeholder="Asunto" required>
              </div>
            </div>
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
              <div class="form-group mb-3">
              <label>Mensaje</label>
                <textarea name="message" id="message" class="form-control" cols="30" rows="4" placeholder="Mensaje..." required></textarea>
              </div>
            </div>
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
              <div class="form-group">
                <button type="submit" class="btn btn-sm btn-block btn-primary">Enviar</button>
              </div>
            </div>
          {!! Form::close() !!}
        </div>
      </div>
	  <div class="col-lg-4 col-md-5 col-sm-12 col-xs-12">
	    @if($page_info->page_content)
        <div class="contact-form">
            {!!stripslashes($page_info->page_content)!!}
        </div>
        @endif
	  </div>
    </div>
  </div>
</div>
</div>

<!-- End Contact Page -->
@endsection
