@extends('master')

@section('title')
    {{ __('Nuevas Noticias') }}
@endsection

@section('content')
    <div class="page_content_wrap" style="padding-top: 50px !important; padding-bottom: 0 !important;">
        <div class="content_wrap">
            <style>
                /* Additional styles as previously defined */
                .pagination .page-link {
                    color: #000;
                    /* Default link color */
                }

                .pagination .page-item .active .page-link {
                    background-color: #0090FF;
                    /* Active page background color */
                    color: #000;
                    /* Active page text color */
                }

                .pagination .page-link:hover {
                    background-color: rgba(0, 144, 255, 0.1);
                    /* Optional: Light hover effect */
                }
            </style>

            <div class="content">
                <div class="posts_container columns_wrap columns_padding_bottom">
                    @if (Session::has('success'))
                        <div class="alert alert-success">
                            <p>{{ session::get('success') }}</p>
                        </div>
                    @endif
                    @if (Session::has('fail'))
                        <div class="alert alert-danger">
                            <p>{{ session::get('fail') }}</p>
                        </div>
                    @endif



                    @forelse ($latest_posts as $item)
                        <div class="column-1_3">
                            <article id="post-{{ $item->id }}"
                                class="post_item post_format_standard post_layout_classic post_layout_classic_3 post-{{ $item->id }} post type-post status-publish format-standard has-post-thumbnail hentry category-news-updates tag-pool tag-summer tag-water">

                                <!-- Featured Image Section -->
                                <div class="post_featured with_thumb hover_dots">
                                    <img loading="lazy" width="370" height="208" src="{{ asset($item->thumbnail) }}"
                                        class="attachment-neptunus-thumb-med size-neptunus-thumb-med wp-post-image"
                                        alt="{{ $item->title }}" decoding="async" srcset="
                                {{ asset($item->thumbnail) }} 370w,
                                {{ asset($item->thumbnail) }} 1170w,
                                {{ asset($item->thumbnail) }} 270w
                            " sizes="(max-width: 370px) 100vw, 370px">
                                    <div class="mask"></div>
                                    <a href="{{ url('newsDetails/' . $item->id) }}" class="icons"
                                        aria-label="Read more about {{ $item->title }}">
                                        <span></span><span></span><span></span>
                                    </a>
                                </div>

                                <!-- Post Header -->
                                <div class="post_header entry-header">
                                    <h4 class="post_title entry-title">
                                        <a href="{{ url('newsDetails/' . $item->id) }}" rel="bookmark">{{ $item->title }}</a>
                                    </h4>
                                    <div class="post_meta">
                                        <!-- Author Name -->
                                        <span class="post_meta_item post_author">
                                            <a href="{{ url('newsDetails/' . $item->id) }}">{{ $item->author }}</a>
                                        </span>

                                        <!-- Date in Spanish -->
                                        <span class="post_meta_item post_date">
                                            <a href="{{ url('newsDetails/' . $item->id) }}">
                                                {{ \Carbon\Carbon::parse($item->created_at)->locale('es')->translatedFormat('d F Y') }}
                                            </a>
                                        </span>
                                    </div>
                                </div>

                                <!-- Post Content -->
                                <div class="post_content entry-content">
                                    <div class="post_content_inner">
                                        {!! Str::limit(strip_tags($item->content), 150) !!}
                                    </div>
                                </div>

                            </article>
                        </div>
                    @empty
                        <!-- No Posts Found -->
                        <div class="alert alert-warning text-center w-100">
                            <strong>{{ __('No se encontraron publicaciones de blog.') }}</strong>
                        </div>
                    @endforelse

                </div>

                @if ($latest_posts->hasPages())
                    <nav class="navigation pagination" aria-label="Posts pagination">
                        <h2 class="screen-reader-text">Posts pagination</h2>
                        <div class="nav-links">
                            {{-- Previous Page Link --}}
                            @if ($latest_posts->onFirstPage())
                                <span class="page-numbers disabled" aria-disabled="true">&laquo;</span>
                            @else
                                <a class="prev page-numbers" href="{{ $latest_posts->previousPageUrl() }}"
                                    aria-label="Previous Page">&laquo;</a>
                            @endif

                            {{-- Pagination Elements --}}
                            @foreach ($latest_posts->links()->elements[0] as $page => $url)
                                @if ($page == $latest_posts->currentPage())
                                    <span class="page-numbers current" aria-current="page"><span
                                            class="meta-nav screen-reader-text">Page </span>{{ $page }}</span>
                                @else
                                    <a class="page-numbers" href="{{ $url }}" aria-label="Page {{ $page }}"><span
                                            class="meta-nav screen-reader-text">Page </span>{{ $page }}</a>
                                @endif
                            @endforeach

                            {{-- Next Page Link --}}
                            @if ($latest_posts->hasMorePages())
                                <a class="next page-numbers" href="{{ $latest_posts->nextPageUrl() }}"
                                    aria-label="Next Page">&raquo;</a>
                            @else
                                <span class="page-numbers disabled" aria-disabled="true">&raquo;</span>
                            @endif
                        </div>
                    </nav>
                @endif
            </div><!-- </.content> -->
        </div><!-- </.content_wrap> -->
    </div>

@endsection
