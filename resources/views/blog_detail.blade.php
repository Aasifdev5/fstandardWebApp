@extends('master')

@section('title', $blog_detail->title ?? 'Blog Post')

@section('content')
@php
    $wordCount = str_word_count(strip_tags($blog_detail->details ?? ''));
    $readTime  = max(1, ceil($wordCount / 200));
@endphp

<style>
    :root {
        --primary: #f89c10;     /* Your exact orange */
        --primary-dark: #e07a00;
        --accent: #f89c10;
        --gradient: linear-gradient(135deg, #f89c10 0%, #ff9f1c 100%);
    }

    .blog-detail-header {
        background: var(--gradient);
        color: white;
        padding: 100px 0 70px;
    }
    .blog-detail-title {
        font-size: 2.8rem;
        font-weight: 800;
        line-height: 1.2;
    }
    .blog-content {
        font-size: 1.15rem;
        line-height: 1.9;
        color: #444;
    }
    .blog-content h2,
    .blog-content h3 {
        margin-top: 45px;
        color: var(--primary);
        font-weight: 700;
    }
    .blog-content blockquote {
        border-left: 5px solid var(--primary);
        padding: 20px 30px;
        background: #fff8e1;
        font-style: italic;
        margin: 40px 0;
        border-radius: 8px;
    }

    .section-title {
        position: relative;
        padding-bottom: 15px;
    }
    .section-title:after {
        content: '';
        position: absolute;
        bottom: 0;
        left: 50%;
        transform: translateX(-50%);
        width: 80px;
        height: 4px;
        background: var(--gradient);
        border-radius: 2px;
    }

    /* Buttons */
    .btn-primary {
        background: var(--gradient);
        border: none;
        border-radius: 30px;
        padding: 10px 28px;
        font-weight: 600;
        transition: all 0.3s ease;
    }
    .btn-primary:hover {
        background: var(--primary-dark);
        transform: translateY(-3px);
        box-shadow: 0 8px 25px rgba(248, 156, 16, 0.4);
    }

    /* Links & Accents */
    a.text-primary,
    .text-primary,
    .replyBtn,
    .btn-link.text-primary {
        color: var(--primary) !important;
    }
    a.text-primary:hover,
    .replyBtn:hover {
        color: var(--primary-dark) !important;
    }

    /* Comment Reply Border */
    .border-primary {
        border-color: var(--primary) !important;
    }

    /* Like Icon Hover */
    .heart-icon:hover {
        filter: brightness(0) saturate(100%) invert(61%) sepia(93%) saturate(1100%) hue-rotate(10deg) brightness(105%) contrast(101%);
    }
</style>

<!-- Header -->
<div class="blog-detail-header">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-9 text-center">
                <h1 class="blog-detail-title">{{ $blog_detail->title }}</h1>
                <div class="d-flex justify-content-center flex-wrap mt-4 text-white-50 fs-5">
                    <div class="me-4"><i class="fas fa-calendar-alt"></i> {{ $blog_detail->created_at->format('F d, Y') }}</div>
                    <div class="me-4"><i class="fas fa-clock"></i> {{ $readTime }} min read</div>
                    <div><i class="fas fa-comments"></i> {{ $commentCount }} Comments</div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="container my-5">
    <div class="row justify-content-center">
        <div class="col-lg-9">

            <img src="{{ asset($blog_detail->image) }}" class="img-fluid rounded-4 shadow-lg mb-5" alt="{{ $blog_detail->title }}">

            <article class="blog-content">
                {!! $blog_detail->details !!}
            </article>

            <!-- Likes -->
            <div class="d-flex align-items-center mt-5 mb-4">
                <img class="heart-icon me-3" src="{{ asset('assets/heart.svg') }}" alt="Like"
                     style="width:34px;cursor:pointer;transition:0.3s;" data-blog-id="{{ $blog_detail->id }}">
                <span id="likeText" class="fs-5 fw-bold text-primary">
                    {{ $blog_detail->like_count }} {{ Str::plural('Like', $blog_detail->like_count) }}
                </span>
            </div>

            <hr class="my-5">

            <!-- Comments -->
            <div class="comments-section">
                <h3 class="mb-4">Comments ({{ $commentCount }})</h3>

                @auth
                    <form id="commentForm" class="bg-white p-4 rounded-4 shadow-sm mb-5">
                        @csrf
                        <input type="hidden" name="blog_id" value="{{ $blog_detail->id }}">
                        <textarea name="comment" class="form-control mb-3" rows="4" placeholder="Share your thoughts..." required></textarea>
                        <button type="submit" class="btn btn-primary">Post Comment</button>
                    </form>
                @else
                    <p class="text-center py-4">
                        <a href="{{ url('Userlogin') }}" class="btn btn-outline-primary btn-lg">Login to Comment</a>
                    </p>
                @endauth

                @forelse($blogComments as $comment)
                    <div class="bg-white rounded-4 shadow-sm p-4 mb-4">
                        <div class="d-flex">
                            <img src="{{ $comment->user->image_path ? getImageFile($comment->user->image_path) : asset('149071.png') }}"
                                 class="rounded-circle me-3" width="50" height="50" alt="{{ $comment->user->name }}">
                            <div class="flex-grow-1">
                                <strong>{{ $comment->user->name }}</strong>
                                <small class="text-muted ms-2">{{ $comment->created_at->diffForHumans() }}</small>
                                <p class="mt-2 mb-1">{{ $comment->comment }}</p>

                                @auth
                                    <button class="btn btn-sm btn-link text-primary replyBtn"
                                            data-bs-toggle="modal" data-bs-target="#replyModal"
                                            data-parent_id="{{ $comment->id }}">
                                        Reply
                                    </button>
                                @endauth
                            </div>
                        </div>

                        @foreach($comment->blogCommentReplies as $reply)
                            <div class="bg-light rounded-3 p-3 ms-5 mt-3 border-start border-3 border-primary">
                                <div class="d-flex">
                                    <img src="{{ $reply->user->image_path ? getImageFile($reply->user->image_path) : asset('149071.png') }}"
                                         class="rounded-circle me-3" width="40" height="40">
                                    <div>
                                        <strong>{{ $reply->user->name }}</strong>
                                        <small class="text-muted ms-2">{{ $reply->created_at->diffForHumans() }}</small>
                                        <p class="mt-1 mb-0">{{ $reply->comment }}</p>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @empty
                    <p class="text-center text-muted py-4">No comments yet. Be the first!</p>
                @endforelse
            </div>

            <!-- Related Posts -->
            @if($latest_posts->count())
                <h3 class="my-5 text-center section-title">Continue Reading</h3>
                <div class="row">
                    @foreach($latest_posts->take(3) as $post)
                        <div class="col-md-4 mb-4">
                            <div class="card h-100 border-0 shadow-sm rounded-4 overflow-hidden">
                                <img src="{{ asset($post->image) }}" class="card-img-top" style="height:200px;object-fit:cover;">
                                <div class="card-body d-flex flex-column">
                                    <h5 class="card-title fw-bold">{{ $post->title }}</h5>
                                    <p class="card-text text-muted small flex-grow-1">
                                        {!! Str::limit(strip_tags($post->short_description), 80) !!}
                                    </p>
                                    <a href="{{ url('blog_detail/'.$post->slug) }}" class="btn btn-primary btn-sm mt-3 align-self-start">Read More</a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
    </div>
</div>

<!-- Reply Modal -->
<div class="modal fade" id="replyModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <form id="replyForm">
                @csrf
                <input type="hidden" name="blog_id" value="{{ $blog_detail->id }}">
                <input type="hidden" name="parent_id" id="parent_id">
                <div class="modal-header">
                    <h5 class="modal-title">Reply to Comment</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <textarea name="reply_comment" class="form-control" rows="4" placeholder="Write your reply..." required></textarea>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Send Reply</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Scripts (unchanged) -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">

<script>
$(document).ready(function(){
    toastr.options = { positionClass:"toast-top-right", timeOut:4000, progressBar:true };

    $('.heart-icon').on('click', function(){
        $.post(`/blog/{{ $blog_detail->id }}/like`, {_token:'{{csrf_token()}}'}, function(res){
            if(res.success){
                $('#likeText').text(res.like_count + ' ' + (res.like_count == 1 ? 'Like' : 'Likes'));
                toastr.success('Post liked!');
            }
        });
    });

    $('.replyBtn').on('click', function(){
        $('#parent_id').val($(this).data('parent_id'));
    });

    $('#commentForm, #replyForm').on('submit', function(e){
        e.preventDefault();
        const route = this.id === 'commentForm'
            ? "{{ route('blog-comment.store') }}"
            : "{{ route('blog-comment-reply.store') }}";

        $.post(route, $(this).serialize(), function(res){
            if(res.success){
                toastr.success(res.message || 'Success!');
                setTimeout(() => location.reload(), 1200);
            } else {
                toastr.error(res.message || 'Error');
            }
        }).fail(() => toastr.error('Network error'));
    });
});
</script>
@endsection
