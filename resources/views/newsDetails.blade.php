@extends('master')

@section('title')
    {{ __('Detalles de la Noticia') }}
@endsection

@section('content')
<div class="page_content_wrap" style="padding-top: 50px !important; padding-bottom: 0 !important;">
    <div class="content_wrap">
        <div class="content">

            <article id="post-{{ $news->id }}" data-post-id="{{ $news->id }}" class="post_item_single post_type_post full_post_read bg-dark text-light p-4  shadow-lg">
                <!-- News Header -->
                <div class="header_content_wrap header_align_mc">

                    <!-- News Thumbnail -->
                    @if ($news->thumbnail)
                        <div class="post_featured text-center mb-4">
                            <img class="img-fluid  shadow-lg"
                                src="{{ asset($news->thumbnail) }}"
                                alt="{{ $news->title }}"
                                style="max-width: 100%; height: auto;">
                        </div>
                    @endif

                    <!-- Category & Metadata -->
                    <div class="post_header post_header_single entry-header">
                        <div class="post_meta post_meta_categories">

                        </div>
                        <div class="post_meta post_meta_other text-secondary">
                            <span class="post_meta_item post_date">
                                Fecha: {{ \Carbon\Carbon::parse($news->created_at)->locale('es')->translatedFormat('d F Y, h:i A') }}
                            </span>
                            @if ($news->author)
                                <span class="post_meta_item post_author">
                                    <i class="eicon-user"></i>
                                    <strong>Author : {{ $news->author }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                </div><!-- .header_content_wrap -->

                <!-- News Content -->
                <div class="post_content post_content_single entry-content mt-4" itemprop="mainEntityOfPage">
                    <h2 class="elementor-heading-title elementor-size-xl text-white fw-bold mb-3">
                        {{ $news->title }}
                    </h2>

                    <!-- Embedded Media -->
                    @if ($news->file_path)
                        @php
                            $fileType = pathinfo($news->file_path, PATHINFO_EXTENSION);
                        @endphp



                        @if (in_array($fileType, ['mp3', 'wav']))
                            <div class="text-center mb-4">
                                <audio controls class="w-100  border shadow">
                                    <source src="{{ asset($news->file_path) }}" type="audio/{{ $fileType }}">
                                    {{ __('Tu navegador no soporta el elemento de audio.') }}
                                </audio>
                            </div>
                        @endif

                        @if (in_array($fileType, ['mp4', 'avi', 'mov']))
                            <div class="text-center mb-4">
                                <video controls class="w-100  shadow-lg" style="max-height: 400px;">
                                    <source src="{{ asset($news->file_path) }}" type="video/{{ $fileType }}">
                                    {{ __('Tu navegador no soporta el elemento de video.') }}
                                </video>
                            </div>
                        @endif
                    @endif

                    <!-- Article Content -->
                    <div class="content mb-4" style="line-height: 1.8; font-size: 1.1rem;">
                        {!! $news->content !!}
                    </div>

                    <div id="trx_addons_emotions" class="trx_addons_emotions mt-4 p-3 bg-light text-dark shadow">
                        <h5 class="trx_addons_emotions_title">What's your reaction?</h5>
                        @php
                        use App\Models\Reaction;

                        // Fetch reactions from the database before the loop
                        $newsReactions = Reaction::where('news_id', $news->id)->pluck('count', 'type');
                    @endphp

                    @foreach(['cool' => 'heart', 'bad' => 'path-1888', 'lol' => 'group-1045', 'sad' => 'group-1047'] as $slug => $icon)
                        <span class="trx_addons_emotions_item icon-{{ $icon }}" data-slug="{{ $slug }}" data-postid="{{ $news->id }}">
                            <span class="trx_addons_emotions_item_number">
                                {{ $newsReactions[$slug] ?? 0 }}
                            </span>
                            {{ ucfirst($slug) }}
                        </span>
                    @endforeach

                    </div>

                    <script>
                    document.addEventListener('DOMContentLoaded', function() {
                        let newsId = {{ $news->id }};
                        loadReactions(newsId);

                        document.querySelectorAll('.trx_addons_emotions_item').forEach(item => {
                            item.addEventListener('click', function() {
                                let slug = this.getAttribute('data-slug');

                                fetch('/reactions', {
                                    method: 'POST',
                                    headers: {
                                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                                        'Content-Type': 'application/json'
                                    },
                                    body: JSON.stringify({ news_id: newsId, type: slug })
                                }).then(response => response.json())
                                  .then(data => {
                                      if (data.success) {
                                          this.querySelector('.trx_addons_emotions_item_number').innerText = data.count;
                                      }
                                  }).catch(error => console.error('Error:', error));
                            });
                        });
                    });

                    function loadReactions(newsId) {
                        fetch('/reactions/' + newsId)
                        .then(response => response.json())
                        .then(data => {
                            document.querySelectorAll('.trx_addons_emotions_item').forEach(item => {
                                let slug = item.getAttribute('data-slug');
                                item.querySelector('.trx_addons_emotions_item_number').innerText = data[slug] || 0;
                            });
                        });
                    }
                    </script>

                    <!-- Tags & Social Share -->
                    <div class="post_meta post_meta_single mt-4">
                        <span class="post_meta_item post_share">
                            <div class="socials_share socials_size_tiny socials_type_block">
                                <span class="socials_caption">Share:</span>
                                <a class="social_item social_item_style_icons sc_icon_type_icons social_item_type_icons" href="https://twitter.com/intent/tweet?url={{ urlencode(request()->fullUrl()) }}" target="_blank">
                                    <span class="social_icon social_icon_x">
                                        <span class="icon-x"></span>
                                      </span>
                                </a>
                                <a class="social_item social_item_style_icons sc_icon_type_icons social_item_type_icons" href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(request()->fullUrl()) }}" target="_blank">
                                    <span class="social_icon social_icon_facebook">
                                        <span class="icon-facebook"></span>
                                      </span>
                                </a>
                                <a class="social_item social_item_style_icons sc_icon_type_icons social_item_type_icons" href="http://pinterest.com/pin/create/button/?url={{ urlencode(request()->fullUrl()) }}" target="_blank">
                                    <span class="social_icon social_icon_instagramm">
                                        <span class="icon-instagramm"></span>
                                      </span>
                                </a>
                            </div>
                        </span>
                    </div>

                </div><!-- .entry-content -->
            </article>

            <!-- Comments Section -->
            <section class="comments_wrap">
                <div class="comments_list">
                    <h3 class="section_title">{{ __('Comentarios') }}</h3>
                    <ul id="comments_container">
                        @foreach ($comments as $comment)
                            <li>
                                @if ($comment->user)
                                    <strong>{{ $comment->user->name }}</strong>: {{ $comment->comment }}
                                @else
                                    <strong>Anonymous</strong>: {{ $comment->comment }}
                                @endif
                                <br>
                                <small>
                                    {{ \Carbon\Carbon::parse($comment->created_at)->locale('es')->translatedFormat('d F Y, h:i A') }}
                                </small>
                            </li>
                        @endforeach
                    </ul>
                </div>

                <div class="comments_form_wrap">
                    <div class="comments_form">
                        <h3 class="section_title comments_form_title">
                            {{ __('Deja un comentario') }}
                        </h3>
                        <form id="commentform">
                            @csrf
                            <input type="hidden" name="news_id" value="{{ $news->id }}"> <!-- Add this line -->
                            <div class="comments_field comments_author">
                                <label for="author" class="required">{{ __('Nombre') }}</label>
                                <input id="author" name="author" type="text" placeholder="Tu Nombre *" required>
                            </div>
                            <div class="comments_field comments_email">
                                <label for="email" class="required">{{ __('E-mail') }}</label>
                                <input id="email" name="email" type="email" placeholder="Tu E-mail *" required>
                            </div>
                            <div class="comments_field comments_comment">
                                <label for="comment" class="required">{{ __('Comentario') }}</label>
                                <textarea id="comment" name="comment" placeholder="Tu comentario *" required></textarea>
                            </div>
                            <div class="comments_field">
                                <input id="privacy_policy" name="privacy_policy" type="checkbox">
                                <label for="privacy_policy">{{ __('Acepto los términos y condiciones.') }}</label>
                            </div>
                            <p class="form-submit">
                                <button type="submit" class="submit">{{ __('Enviar Comentario') }}</button>
                            </p>
                        </form>
                    </div>
                </div>
            </section>

            <script>
            document.addEventListener('DOMContentLoaded', function() {
    document.getElementById('commentform').addEventListener('submit', function(event) {
        event.preventDefault();
        let formData = new FormData(this);

        fetch("{{ route('comments.store') }}", {
            method: 'POST',
            headers: { 'X-CSRF-TOKEN': '{{ csrf_token() }}' },
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            if (data.message === 'Comentario enviado con éxito.') {
                this.reset(); // Reset the form
                let container = document.getElementById('comments_container');
                // Append the new comment to the list
                container.innerHTML += `
                    <li>
                        <strong>${data.comment.author}</strong>: ${data.comment.comment}
                        <br><small>${new Date(data.comment.created_at).toLocaleString()}</small>
                    </li>
                `;
            }
        })
        .catch(error => console.error('Error:', error));
    });
});
            </script>

            <!-- Related Posts Section -->
            <section class="related_wrap related_position_below_content related_style_classic">
                <h3 class="section_title related_wrap_title">{{ __('También te puede interesar') }}</h3>
                <div class="columns_wrap posts_container columns_padding_bottom">
                    @forelse ($latest_posts as $item)
                        <div class="column-1_2">
                            <div id="post-{{ $item->id }}" class="related_item post_format_standard post-{{ $item->id }}">

                                <!-- Featured Image -->
                                <div class="post_featured with_thumb hover_dots">
                                    <img loading="lazy" width="800" height="428" src="{{ asset($item->thumbnail) }}"
                                        alt="{{ $item->title }}" class="img-fluid">
                                    <div class="mask"></div>
                                    <a href="{{ url('newsDetails/' . $item->id) }}" class="icons" aria-label="Leer más sobre {{ $item->title }}">
                                        <span></span><span></span><span></span>
                                    </a>
                                </div>

                                <!-- Post Header -->
                                <div class="post_header entry-header">
                                    <div class="post_meta">
                                        <a href="{{ url('newsDetails/' . $item->id) }}" class="post_meta_item post_date">
                                            {{ \Carbon\Carbon::parse($item->created_at)->locale('es')->translatedFormat('d F Y') }}
                                        </a>
                                    </div>
                                    <h6 class="post_title entry-title">
                                        <a href="{{ url('newsDetails/' . $item->id) }}">{{ $item->title }}</a>
                                    </h6>
                                    <p>
                                        <a class="more-link" href="{{ url('newsDetails/' . $item->id) }}">{{ __('Leer más') }}</a>
                                    </p>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="alert alert-warning text-center w-100">
                            <strong>{{ __('No se encontraron publicaciones de blog.') }}</strong>
                        </div>
                    @endforelse
                </div>
            </section>

        </div>
    </div>
</div>
@endsection
