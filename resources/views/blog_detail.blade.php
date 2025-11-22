@extends('master')
@section('title')
    {{ __('Detalles del blog') }}
@endsection
@section('content')

    <style>
        .transparent-card {
            background-color: rgba(26, 26, 26, 0.7);
            /* Adjust the alpha value for transparency */
            border: 1px solid rgba(46, 46, 46, 0.5);
            /* Optional: Semi-transparent border */
        }

        a {
            text-decoration: none;
        }

        .transparent-card .card-body,
        .transparent-card .card-footer {
            background-color: transparent;
            /* Ensure the card body and footer are transparent */
        }

        .image-parent {
            width: 100%;
            position: relative;
            border-radius: 8px;
            /* border: 1px solid #2e2e2e; */
            box-sizing: border-box;
            display: flex;
            flex-direction: column;
            align-items: flex-start;
            justify-content: flex-start;
            padding: 24px 16px;
            gap: 16px;
            text-align: left;
            font-size: 20px;
            color: #ededed;
            font-family: 'Space Grotesk';
        }

        .card-footer {
            border: none;
            /* Remove the border */
        }
    </style>
    <section style="padding: 90px 0; background: #000">
        <div class="container-fluid custom-bg w-100">
            <div class="container my-5">
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
                <div class="row">
                    <!-- Text Column -->
                    <div class="col-lg-6 col-md-12 order-2 order-md-1">
                        <!-- Heading -->
                        <h2 class="text-center text-lg-start">
                            <span
                                style="
                  color: #fff;
                  font-size: 33px;
                  letter-spacing: -0.02em;
                  display: inline-block;
                  font-family: 'Space Grotesk', sans-serif;
                  font-weight: 700;
                ">
                                {{ $blog_detail->title }}
                            </span>
                        </h2>

                        <!-- Paragraph -->
                        <p class="text-center text-md-start"
                            style="
                font-family: 'Space Grotesk', sans-serif;
                font-weight: 400;
                line-height: 28px;
                color: #a1a1a1;
              ">
                            {!! $blog_detail->short_description !!}
                        </p>

                        <!-- Button -->
                        <div class="col-sm-3">
                            <div class="card-footer bg-transparent frame-parent"
                                style=" border-radius: 9px;
              border: 1px solid #2e2e2e;
              box-sizing: border-box;">
                                <div class="heart-parent">
                                    <img class="heart-icon" src="{{ asset('assets/heart.svg') }}" alt="Likes" />
                                    <span class="div">{{ $blog_detail->like_count }}</span>
                                </div>
                                <div class="heart-parent">
                                    <img class="heart-icon" src="{{ asset('assets/Message square.svg') }}" alt="Comments" />
                                    <span class="div">{{ $commentCount }}
                                    </span>
                                </div>
                            </div>
                        </div>

                    </div>
                    <style>
                        .heart-icon {
                            width: 24px;
                            position: relative;
                            height: 24px;
                            overflow: hidden;
                            flex-shrink: 0;
                        }

                        .div {
                            position: relative;
                            line-height: 150%;
                        }

                        .heart-parent {
                            display: flex;
                            flex-direction: row;
                            align-items: center;
                            justify-content: flex-start;
                            gap: 8px;
                        }

                        .frame-parent {
                            position: relative;

                            display: flex;
                            flex-direction: row;
                            align-items: center;
                            justify-content: flex-start;
                            padding: 24px 16px;
                            gap: 24px;
                            font-size: 16px;
                            color: #ededed;
                            font-family: "Space Grotesk";
                        }
                    </style>
                    <!-- Image Column -->
                    <div class="col-lg-6 col-md-12 order-1 order-md-2">
                        <img class="img-fluid rounded-3" src="{{ asset($blog_detail->image) }}" alt="Placeholder Image"
                            style="padding-top: 20px; width: 100%; height: auto" />
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section style="padding: 20px 0; background: #000;">
        <div class="container my-4">
            <div class="row">
                <div class="col-lg-9 col-md-12 col-sm-12 col-12 mb-4 p-4"
                    style="background: #000; border: 1px solid #A1A1A1; border-radius: 16px; padding-left: 15px; padding-right: 15px;">
                    <div class="text-white">
                        {!! $blog_detail->details !!}

                        <div class="badges mt-4 d-flex align-items-center">
                            <img class="heart-icon me-2" alt="Me gusta" src="{{ asset('assets/heart.svg') }}"
                                data-blog-id="{{ $blog_detail->id }}" style="cursor: pointer;">
                            <div class="badges1">{{ __('Me gusta') }}</div>&nbsp;
                            <span id="likeCount">{{ $blog_detail->like_count }}</span>
                        </div>
                        <br>
                        @php
                            // Check if $user_session exists and has an id
                            $userId = !empty($user_session) ? $user_session->id : null;
                        @endphp
                        @if (!@empty($user_session))
                            <!-- Input for a new comment -->

                            <form id="commentForm" class="comment-one__form contact-form-validated">
                                @csrf
                                <input type="hidden" class="blog_id" name="blog_id" value="{{ $blog_detail->id }}">
                                @if ($userId)
                                    <input type="hidden" name="user_id" class="user_id" value="{{ $userId }}">
                                @endif
                                <div class="textarea mt-4">
                                    <label class="label text-white">{{ __('Nuevo comentario') }}</label>
                                    <div class="content mt-2">
                                        <textarea class="form-control" name="comment" rows="5" placeholder="Escribe tu comentario" style="padding: 10px;"></textarea>
                                    </div>
                                </div>

                                <br>

                                <div class="col-sm-12">

                                    <div class="comment-form__btn-box">
                                        <button type="submit"
                                            class="btn btn-sm btn-outline-primary btn-sm d-flex align-items-center justify-content-center pull-right comment-form__btn">{{ __('Enviar comentario') }}</button>
                                    </div>
                                </div>

                            </form>
                            <br>
                            <!-- Display comments and replies -->
                            @foreach ($blogComments as $blogComment)
                                @if ($blogComment->blog_id == $blog_detail->id)
                                    <!-- Main Comment -->
                                    <div class="main-comment mb-4">
                                        <div class="blog-comment-item d-flex align-items-start">
                                            <!-- Comment Author Image -->
                                            <div class="comment-author-img radius-50 overflow-hidden me-3">
                                                @if (!empty($blogComment->user->image_path))
                                                    <img src="{{ getImageFile($blogComment->user->image_path) }}"
                                                        alt="avatar" style="width: 50px; height: 50px;">
                                                @else
                                                    <img src="{{ asset('149071.png') }}" alt="dummy-avatar"
                                                        style="width: 50px; height: 50px;">
                                                @endif
                                            </div>

                                            <div class="author-details d-flex flex-grow-1 justify-content-between">
                                                <div>
                                                    <h6 class="author-name font-16">{{ $blogComment->user->name }}</h6>
                                                    <p class="mb-0">{{ $blogComment->comment }}</p>

                                                    @guest
                                                        <div class="mt-2">
                                                            <button
                                                                class="replyBtn blog-reply-btn btn btn-sm btn-outline-primary font-medium"
                                                                data-bs-toggle="modal" data-bs-target="#commentReplyModal"
                                                                data-parent_id="{{ $blogComment->id }}">
                                                                {{ __('Reply') }} <span class="iconify"
                                                                    data-icon="la:angle-right"></span>
                                                            </button>
                                                        </div>
                                                    @endguest
                                                </div>

                                                <div class="comment-date-time text-muted font-12 mb-2 align-self-start">
                                                    {{ $blogComment->created_at->format('j M, Y') }} {{ __('AT') }}
                                                    {{ $blogComment->created_at->format('h:i A') }}
                                                </div>
                                            </div>


                                        </div>
                                    </div>
                                @endif


                                <!-- Replies for Main Comment -->
                                @foreach ($blogComment->blogCommentReplies as $reply)
                                    <div class="reply-comment mb-4 ms-5">
                                        <div class="blog-comment-item d-flex align-items-start">
                                            <!-- Reply Author Image -->
                                            <div class="comment-author-img radius-50 overflow-hidden me-3">
                                                @if (!empty($reply->user->image_path))
                                                    <img src="{{ getImageFile($reply->user->image_path) }}" alt="avatar"
                                                        style="width: 50px; height: 50px;">
                                                @else
                                                    <img src="{{ asset('149071.png') }}" alt="dummy-avatar"
                                                        style="width: 50px; height: 50px;">
                                                @endif
                                            </div>

                                            <!-- Reply Details -->
                                            <div class="author-details flex-grow-1">
                                                <h6 class="author-name font-16">{{ $reply->user->name }}</h6>
                                                <div class="comment-date-time color-gray font-12 mb-2">
                                                    {{ $reply->created_at->format('j M, Y') }} {{ __('AT') }}
                                                    {{ $reply->created_at->format('h:i A') }}
                                                </div>
                                                <p class="mb-0">{{ $reply->comment }}</p>

                                                @guest
                                                    <button
                                                        class="replyBtn blog-reply-btn btn btn-sm btn-outline-primary font-medium reply-btn mt-2"
                                                        data-bs-toggle="modal" data-bs-target="#commentReplyModal"
                                                        data-parent_id="{{ $blogComment->id }}">
                                                        {{ __('Reply') }} <span class="iconify"
                                                            data-icon="la:angle-right"></span>
                                                    </button>
                                                @endguest
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            @endforeach
                        @else
                            <!-- Display comments and replies -->
                            @foreach ($blogComments as $blogComment)
                                @if ($blogComment->blog_id == $blog_detail->id)
                                    <!-- Main Comment -->
                                    <div class="main-comment mb-4">
                                        <div class="blog-comment-item d-flex align-items-start">
                                            <!-- Comment Author Image -->
                                            <div class="comment-author-img radius-50 overflow-hidden me-3">
                                                @if (!empty($blogComment->user->image_path))
                                                    <img src="{{ getImageFile($blogComment->user->image_path) }}"
                                                        alt="avatar" style="width: 50px; height: 50px;">
                                                @else
                                                    <img src="{{ asset('149071.png') }}" alt="dummy-avatar"
                                                        style="width: 50px; height: 50px;">
                                                @endif
                                            </div>

                                            <div class="author-details d-flex flex-grow-1 justify-content-between">
                                                <div>
                                                    <h6 class="author-name font-16">{{ $blogComment->user->name }}</h6>
                                                    <p class="mb-0">{{ $blogComment->comment }}</p>

                                                    @guest
                                                        <div class="mt-2">
                                                            <button
                                                                class="replyBtn blog-reply-btn btn btn-sm btn-outline-primary font-medium"
                                                                data-bs-toggle="modal" data-bs-target="#commentReplyModal"
                                                                data-parent_id="{{ $blogComment->id }}">
                                                                {{ __('Reply') }} <span class="iconify"
                                                                    data-icon="la:angle-right"></span>
                                                            </button>
                                                        </div>
                                                    @endguest
                                                </div>

                                                <div class="comment-date-time text-muted font-12 mb-2 align-self-start">
                                                    {{ $blogComment->created_at->format('j M, Y') }} {{ __('AT') }}
                                                    {{ $blogComment->created_at->format('h:i A') }}
                                                </div>
                                            </div>


                                        </div>
                                    </div>
                                @endif
                            @endforeach
                            <a class="btn btn-outline-primary btn-sm d-flex align-items-center justify-content-center"
                                href="{{ url('Userlogin') }}">
                                {{ __('Iniciar Sesión') }}
                            </a>
                        @endif

                    </div>
                </div>

                <div class="col-lg-3 col-md-12 col-sm-12 col-12 mb-4">
                    <div class="sidebar">
                        <div class="lo-ms-ledo-wrapper">
                            <h3 class="text-light">{{ __('Lo más leído') }}</h3>
                            <hr>
                        </div>
                        @forelse ($latest_posts as $item)
                            <!-- Blog Post 1 -->
                            <div class="col-lg-12 col-md-6 col-12 mb-4">
                                <div class="card h-100 image-parent h-100 transparent-card">
                                    <a href="{{ url('blog_detail/' . $item->slug) }}" class=" text-white"><img
                                            class="card-img-top" alt="Blog Image" src="{{ asset($item->image) }}">
                                        <div class="card-body">
                                            <b class="ttulo-del-blog">{{ $item->title }}</b>
                                            <p class="estamos-dedicados-a">{!! $item->short_description !!}</p>
                                        </div>
                                    </a>
                                    <div class="card-footer bg-transparent frame-parent">
                                        <div class="heart-parent">
                                            <img class="heart-icon" src="{{ asset('assets/heart.svg') }}"
                                                alt="Likes">
                                            <span class="div">{{ $item->like_count }}</span>
                                        </div>
                                        <div class="heart-parent">
                                            <img class="heart-icon" src="{{ asset('assets/Message square.svg') }}"
                                                alt="Comments">
                                            <span class="div">
                                                @php
                                                    $commentCount = \App\Models\BlogComment::where('blog_id', $item->id)
                                                        ->where('status', '1')
                                                        ->count();
                                                @endphp
                                                {{ $commentCount }}
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @empty

                            <div class="alert alert-warning text-center">
                                <strong>{{ __('No se encontraron publicaciones de blog.') }}</strong>
                            </div>
                        @endforelse



                    </div>
                </div>
            </div>
            <div class="container">
                <h1 class="text-light">{{ __('Continúa leyendo') }}:</h1>

                <div class="row">
                    @forelse ($latest_posts as $item)
                        <!-- Blog Post 1 -->
                        <div class="col-lg-4 col-12 mb-4">
                            <div class="card image-parent h-100 transparent-card">
                                <a href="{{ url('blog_detail/' . $item->slug) }}" class=" text-white"><img
                                        src="{{ asset($item->image) }}" class="image-icon card-img-top"
                                        alt="Blog Image">
                                    <div class="card-body stack">
                                        <h5 class="card-title fw-bold ttulo-del-blog">{{ $item->title }}</h5>
                                        <p class="card-text estamos-dedicados-a">{!! $item->short_description !!}</p>
                                    </div>
                                </a>
                                <div class="card-footer bg-transparent frame-parent">
                                    <div class="heart-parent">
                                        <img class="heart-icon" src="{{ asset('assets/heart.svg') }}" alt="Likes">
                                        <span class="div">{{ $item->like_count }}</span>
                                    </div>
                                    <div class="heart-parent">
                                        <img class="heart-icon" src="{{ asset('assets/Message square.svg') }}"
                                            alt="Comments">
                                        <span class="div">
                                            @php
                                                $commentCount = \App\Models\BlogComment::where('blog_id', $item->id)
                                                    ->where('status', '1')
                                                    ->count();
                                            @endphp
                                            {{ $commentCount }}
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="alert alert-warning text-center">
                            <strong>{{ __('No se encontraron publicaciones de blog.') }}</strong>
                        </div>
                    @endforelse



                </div>
            </div>

        </div>
    </section>
    <!-- Reply Modal -->
    @if ($userId)
        <div class="modal fade" id="commentReplyModal" tabindex="-1" aria-labelledby="commentReplyModalLabel"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="commentReplyModalLabel">{{ __('Reply to Comment') }}</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form id="ReplycommentForm" class="reply-comment-form">
                        @csrf
                        <input type="hidden" name="blog_id" value="{{ $blog_detail->id }}">
                        <input type="hidden" name="user_id" value="{{ $user_session->id }}">
                        <input type="hidden" name="parent_id" id="modalParentId">

                        <div class="modal-body">
                            <div class="form-group">
                                <textarea class="form-control" name="reply_comment" rows="4" placeholder="Escribe tu respuesta"></textarea>
                            </div>
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary"
                                data-bs-dismiss="modal">{{ __('Close') }}</button>
                            <button type="submit" class="btn btn-primary">{{ __('Enviar respuesta') }}</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endif

    <!-- Include Toastr and jQuery -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>

    <script>
        $(document).ready(function() {
            // Like button click event
            $('.heart-icon').on('click', function() {
                const blogId = $(this).data('blog-id');

                $.ajax({
                    type: 'POST',
                    url: `/blog/${blogId}/like`,
                    data: {
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(response) {
                        if (response.success) {
                            $('#likeCount').text(response.like_count);
                        } else {
                            alert('Could not process your request.');
                        }
                    },
                    error: function() {
                        alert('An error occurred. Please try again.');
                    }
                });
            });
            // Toastr settings
            toastr.options = {
                "closeButton": true,
                "progressBar": true,
                "positionClass": "toast-top-right",
                "showDuration": "300",
                "hideDuration": "1000",
                "timeOut": "5000"
            };

            // Handle reply button click
            $(document).on('click', '.replyBtn', function() {
                $('#modalParentId').val($(this).data('parent_id'));
            });

            // Submit main comment
            $('#commentForm').submit(function(e) {
                e.preventDefault();
                let formData = $(this).serialize();

                $.ajax({
                    type: "POST",
                    url: "{{ route('blog-comment.store') }}",
                    data: formData,
                    dataType: "json",
                    success: function(response) {
                        if (response.success) {
                            $('#commentForm')[0].reset();
                            $('.appendCommentList').prepend(response.html);
                            toastr.success("Comment successfully added.", "", {
                                onHidden: function() {
                                    location.reload();
                                }
                            });
                        } else {
                            toastr.error("Failed to store comment.");
                        }
                    },
                    error: function(xhr) {
                        console.error(xhr.responseText);
                        toastr.error("Failed to store comment. Please try again later.");
                    }
                });
            });

            // Submit reply comment
            $('#ReplycommentForm').submit(function(e) {
                e.preventDefault();
                let formData = $(this).serialize();
                let user_id = $('.user_id').val();

                if (!user_id) {
                    toastr.warning("You need to login first!");
                    return;
                }

                $.ajax({
                    type: "POST",
                    url: "{{ route('blog-comment-reply.store') }}",
                    data: formData,
                    dataType: "json",
                    success: function(response) {
                        if (response.success) {
                            $('#ReplycommentForm')[0].reset();
                            $('.appendCommentList').prepend(response.html);
                            toastr.success(response.message, "", {
                                onHidden: function() {
                                    location.reload();
                                }
                            });
                        } else {
                            toastr.error(response.message);
                        }
                    },
                    error: function(xhr) {
                        console.error(xhr.responseText);
                        toastr.error("Failed to store reply. Please try again later.");
                    }
                });
            });
        });
    </script>

@endsection
