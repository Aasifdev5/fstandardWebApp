@php
    $isSuperAdmin = $user_session->is_super_admin;
@endphp
@if ($isSuperAdmin)
    <div class="sidebar-wrapper">
        <div>
            <div class="logo-wrapper"><a href="{{ route('dashboard') }}"><img class=" for-light" src="<?php echo '/' . $general_setting['app_logo'] ?? ''; ?>"
                        width="157px" height="80px" alt=""></a>
                <div class="back-btn"><i data-feather="grid"></i></div>
                <div class="toggle-sidebar icon-box-sidebar"><i class="status_toggle middle sidebar-toggle"
                        data-feather="grid"> </i></div>
            </div>
            <div class="logo-icon-wrapper"><a href="{{ route('dashboard') }}">
                    <div class="icon-box-sidebar"><i data-feather="grid"></i></div>
                </a></div>
            <nav class="sidebar-main">
                <div class="left-arrow" id="left-arrow"><i data-feather="arrow-left"></i></div>
                <div id="sidebar-menu">
                    <ul class="sidebar-links" id="simple-bar">
                        <li class="back-btn">
                            <div class="mobile-back text-end"><span>Back</span><i class="fa fa-angle-right ps-2"
                                    aria-hidden="true"></i></div>
                        </li>
                        <li class="pin-title sidebar-list">
                            <h6>Pinned</h6>
                        </li>
                        <hr>
                        <li class="sidebar-list {{ Request::is('dashboard') ? 'active' : '' }}"><i
                                class="fa fa-thumb-tack"></i>
                            <a class="sidebar-link sidebar-title link-nav" href="{{ route('dashboard') }}">
                                <i class="icofont icofont-chart-line-alt text-white"></i>
                                <span class="lan-3" style="margin-left: 20px;">{{ __('Dashboard') }}</span>
                            </a>
                        </li>

                        <li class="sidebar-list {{ Request::is('settings*') ? 'active' : '' }}"><i
                                class="fa fa-thumb-tack"></i>
                            <a class="sidebar-link sidebar-title" href="javascript:void(0)">
                                <i data-feather="settings"></i>
                                <span>{{ __('Application') }}</span>
                            </a>
                            <ul class="sidebar-submenu">
                                <li>
                                    <a class="{{ Request::is('settings/general_setting') ? 'active' : '' }}"
                                        href="{{ route('settings.general_setting') }}">
                                        <span>{{ __('Global Settings') }}</span>
                                    </a>
                                </li>
                                <li>
                                    <a class="{{ Request::is('settings/location/country*') ? 'active' : '' }}"
                                        href="{{ route('settings.location.country.index') }}">
                                        <span>{{ __('Location Settings') }}</span>
                                    </a>
                                </li>
                                <li>
                                    <a class="{{ Request::is('settings/mail-configuration') ? 'active' : '' }}"
                                        href="{{ route('settings.mail-configuration') }}">
                                        <span>{{ __('Mail Configuration') }}</span>
                                    </a>
                                </li>
                                <li>
                                    <a class="{{ Request::is('settings/mail-configuration') ? 'active' : '' }}"
                                        href="{{ route('settings.mail-configuration') }}">
                                        <span>{{ __('SMS Configuration') }}</span>
                                    </a>
                                </li>
                                <li>
                                    <a class="{{ Request::is('settings/mail-configuration') ? 'active' : '' }}"
                                        href="{{ route('settings.mail-configuration') }}">
                                        <span>{{ __('Push Notification Configuration') }}</span>
                                    </a>
                                </li>
                                <li>
                                    <a class="{{ Request::is('settings/mail-configuration') ? 'active' : '' }}"
                                        href="{{ route('settings.mail-configuration') }}">
                                        <span>{{ __('Notification Templates') }}</span>
                                    </a>
                                </li>
                                <li>
                                    <a class="{{ Request::is('settings/payment_method_settings') ? 'active' : '' }}"
                                        href="{{ route('settings.payment_method_settings') }}">
                                        <span>{{ __('Payment Options') }}</span>
                                    </a>
                                </li>
                                <li>
                                    <a class="{{ Request::is('settings/support-ticket/cms') ? 'active' : '' }}"
                                        href="{{ route('settings.support-ticket.cms') }}">
                                        <span>{{ __('Support Ticket') }}</span>
                                    </a>
                                </li>
                            </ul>
                        </li>

                        {{-- <li class="sidebar-list {{ Request::is('widgets*') ? 'active' : '' }}"><i
                                class="fa fa-thumb-tack"></i>
                            <a class="sidebar-link sidebar-title" href="javascript:void(0)">
                                <i data-feather="airplay"></i>
                                <span class="lan-6">Widgets</span>
                            </a>
                            <ul class="sidebar-submenu">
                                <li><a class="{{ Request::is('general_widget') ? 'active' : '' }}"
                                        href="{{ route('general_widget') }}">General</a></li>
                                <li><a class="{{ Request::is('chart_widget') ? 'active' : '' }}"
                                        href="{{ route('chart_widget') }}">Chart</a></li>
                            </ul>
                        </li> --}}
                        {{-- <li class="sidebar-list {{ Request::is('chambeadors') ? 'active' : '' }}"><i
                                class="fa fa-thumb-tack"></i>
                            <a class="sidebar-link sidebar-title link-nav" href="{{ route('chambeadors') }}">
                                <i class="fa fa-users text-light"></i>&nbsp;&nbsp;&nbsp;
                                <span>Chambeadors</span>
                            </a>
                        </li>
                        <li class="sidebar-list {{ Request::is('admin/balance-management') ? 'active' : '' }}">
                            <i class="fa fa-wallet"></i>
                            <a class="sidebar-link sidebar-title link-nav" href="{{ route('balance.management') }}">
                                <i class="fa fa-wallet text-light"></i>&nbsp;&nbsp;&nbsp;
                                <span>Gestión de Saldos</span>
                            </a>
                        </li> --}}
                        {{-- <li class="sidebar-list {{ Request::is('file_manager') ? 'active' : '' }}"><i
                                class="fa fa-thumb-tack"></i>
                            <a class="sidebar-link sidebar-title link-nav" href="{{ route('file_manager') }}">
                                <i data-feather="git-pull-request"></i>
                                <span>File manager</span>
                            </a>
                        </li> --}}
                        <li class="sidebar-list {{ Request::is('users') ? 'active' : '' }}"><i
                                class="fa fa-thumb-tack"></i>
                            <a class="sidebar-link sidebar-title link-nav" href="{{ route('users') }}">
                                <i class="fa fa-users text-light"></i>&nbsp;&nbsp;&nbsp;
                                <span>Client Manage</span>
                            </a>
                        </li>
                        {{-- <li class="sidebar-list {{ Request::is('admin/portfolios') ? 'active' : '' }}"><i
                                class="fa fa-thumb-tack"></i>
                            <a class="sidebar-link sidebar-title link-nav" href="{{ route('portfolios.index') }}">
                                <i class="icofont icofont-briefcase text-light"></i>&nbsp;&nbsp;&nbsp;
                                <span>Portfolio</span>
                            </a>
                        </li> --}}
                        <li class="sidebar-list {{ Request::is('admin/testimonials') ? 'active' : '' }}"><i
                                class="fa fa-thumb-tack"></i>
                            <a class="sidebar-link sidebar-title link-nav" href="{{ route('testimonials.index') }}">
                                <i class="icofont icofont-award text-light"></i>&nbsp;&nbsp;&nbsp;
                                <span>Testimonial</span>
                            </a>
                        </li>
                        <!-- Clients -->





                        {{-- <li class="sidebar-list {{ Request::is('banners') ? 'active' : '' }}"><i
                                class="fa fa-thumb-tack"></i>
                            <a class="sidebar-link sidebar-title link-nav" href="{{ route('admin.banners.index') }}">
                                <i data-feather="monitor"></i>
                                <span>Slider</span>
                            </a>
                        </li> --}}
                        {{-- <li class="sidebar-list"><i class="fa fa-thumb-tack"></i><a class="sidebar-link sidebar-title"
                                href="javascript:void(0)"><i data-feather="message-circle"></i><span>Chat</span></a>
                            <ul class="sidebar-submenu">
                                <li><a href="{{ route('chat.index') }}">Chat App</a></li>

                            </ul>
                        </li> --}}
                        {{-- <li class="sidebar-list {{ Request::is('news') ? 'active' : '' }}"><i
                                class="fa fa-thumb-tack"></i>
                            <a class="sidebar-link sidebar-title link-nav" href="{{ route('news.index') }}">
                                <i class="icofont icofont-triangle text-light"></i>&nbsp;&nbsp;&nbsp;
                                <span>Noticias</span>
                            </a>
                        </li>
                        <li class="sidebar-list {{ Request::is('qrcode') ? 'active' : '' }}"><i
                                class="fa fa-thumb-tack"></i>
                            <a class="sidebar-link sidebar-title link-nav" href="{{ url('admin/qrcode') }}">
                                <i class="fa fa-qrcode text-light"></i>&nbsp;&nbsp;&nbsp;<span>CÓDIGO QR</span>

                            </a>
                        </li>
                        <li class="sidebar-list {{ Request::is('category') ? 'active' : '' }}"><i
                                class="fa fa-thumb-tack"></i>
                            <a class="sidebar-link sidebar-title link-nav" href="{{ route('category.index') }}">
                                <i class="icofont icofont-triangle text-light"></i>&nbsp;&nbsp;&nbsp;
                                <span>Categoría</span>
                            </a>
                        </li> --}}
                        {{-- <li class="sidebar-list {{ Request::is('restaurants') ? 'active' : '' }}">
                            <a class="sidebar-link sidebar-title link-nav" href="{{ route('restaurants.index') }}">
                                <i class="fa fa-cutlery text-light"></i>&nbsp;&nbsp;&nbsp;
                                <span>Restaurantes</span>
                            </a>
                        </li> --}}

                        {{-- <li class="sidebar-list {{ Request::is('subcategory') ? 'active' : '' }}"><i
                                class="fa fa-thumb-tack"></i>
                            <a class="sidebar-link sidebar-title link-nav" href="{{ route('subcategory.index') }}">
                                <i class="icofont icofont-triangle text-light"></i>&nbsp;&nbsp;&nbsp;
                                <span>Subcategory</span>
                            </a>
                        </li> --}}
                        {{-- <li class="sidebar-list {{ Request::is('products*') ? 'active' : '' }}">
                            <i class="fa fa-thumb-tack"></i>
                            <a class="sidebar-link sidebar-title link-nav" href="{{ route('products.list') }}">
                                <i class="icofont icofont-triangle text-light"></i>&nbsp;&nbsp;&nbsp;
                                <span>Products</span>
                            </a>
                        </li>
                        <li class="sidebar-list {{ Request::is('orders*') ? 'active' : '' }}">
                            <a class="sidebar-link sidebar-title link-nav" href="{{ route('admin.orders.index') }}">
                                <span role="img" aria-label="Package" class="align-middle">📦</span>
                                <span class="ms-2 align-middle">Orders</span>
                            </a>
                        </li> --}}
                        <li class="sidebar-list {{ Request::is('blogs*') ? 'active' : '' }}"><i
                                class="fa fa-thumb-tack"></i>
                            <a class="sidebar-link sidebar-title" href="javascript:void(0)">
                                <i class="fa fa-bar-chart-o text-light"></i>&nbsp;&nbsp;
                                <span>{{ __('Manage Trade') }}</span>
                            </a>
                            <ul class="sidebar-submenu">
                                 <li><a class="{{ Request::is('blog/blog-category/index') ? 'active' : '' }}"
                                        href="{{ route('blog.blog-category.index') }}">{{ __('Trade History') }}</a>
                                </li>
                                <li><a class="{{ Request::is('blog/create') ? 'active' : '' }}"
                                        href="{{ route('blog.create') }}">{{ __('Open Order') }}</a></li>
                                <li><a class="{{ Request::is('blog/index') ? 'active' : '' }}"
                                        href="{{ route('blog.index') }}">{{ __('Order History') }}</a></li>
                                <li><a class="{{ Request::is('blog/blog-comment-list') ? 'active' : '' }}"
                                        href="{{ route('blog.blog-comment-list') }}">{{ __('Open Position') }}</a>
                                </li>
                                <li><a class="{{ Request::is('blog/blog-category/index') ? 'active' : '' }}"
                                        href="{{ route('blog.blog-category.index') }}">{{ __('Position History') }}</a>
                                </li>
                            </ul>
                        </li>
                        <li class="sidebar-list {{ Request::is('blogs*') ? 'active' : '' }}"><i
                                class="fa fa-thumb-tack"></i>
                            <a class="sidebar-link sidebar-title" href="javascript:void(0)">
                                <i class="icofont icofont-social-blogger text-light"></i>&nbsp;&nbsp;
                                <span>{{ __('Blogs') }}</span>
                            </a>
                            <ul class="sidebar-submenu">
                                <li><a class="{{ Request::is('blog/create') ? 'active' : '' }}"
                                        href="{{ route('blog.create') }}">{{ __('Add Blog') }}</a></li>
                                <li><a class="{{ Request::is('blog/index') ? 'active' : '' }}"
                                        href="{{ route('blog.index') }}">{{ __('Blog List') }}</a></li>
                                <li><a class="{{ Request::is('blog/blog-comment-list') ? 'active' : '' }}"
                                        href="{{ route('blog.blog-comment-list') }}">{{ __('Lista de Comentarios') }}</a>
                                </li>
                                <li><a class="{{ Request::is('blog/blog-category/index') ? 'active' : '' }}"
                                        href="{{ route('blog.blog-category.index') }}">{{ __('Blog Categeory') }}</a>
                                </li>
                            </ul>
                        </li>

                        {{-- <li class="sidebar-list {{ Request::is('admin/pages') ? 'active' : '' }}"><i
                                class="fa fa-thumb-tack"></i>
                            <a class="sidebar-link sidebar-title link-nav" href="{{ url('admin/pages') }}">
                                <i data-feather="book"></i>
                                <span>{{ __('Pages') }}</span>
                            </a>
                        </li> --}}
                        <li class="sidebar-list {{ Request::is('admin/mail-templates') ? 'active' : '' }}"><i
                                class="fa fa-thumb-tack"></i>
                            <a class="sidebar-link sidebar-title link-nav" href="{{ url('admin/mail-templates') }}">
                                <i class="fa fa-gavel text-light"></i>&nbsp;&nbsp;
                                <span>{{ __('Manage Orders') }}</span>
                            </a>
                        </li>
                        {{-- <li class="sidebar-list {{ Request::is('admin/mail-templates') ? 'active' : '' }}"><i
                                class="fa fa-thumb-tack"></i>
                            <a class="sidebar-link sidebar-title link-nav" href="{{ url('admin/mail-templates') }}">
                                <i data-feather="mail"></i>
                                <span>{{ __('Mail Template') }}</span>
                            </a>
                        </li> --}}
                        <li class="sidebar-list {{ Request::is('admin/mail-templates') ? 'active' : '' }}"><i
                                class="fa fa-thumb-tack"></i>
                            <a class="sidebar-link sidebar-title link-nav" href="{{ url('admin/mail-templates') }}">
                                <i data-feather="lock"></i>
                                <span>{{ __('Trade Rules') }}</span>
                            </a>
                        </li>
                        <li class="sidebar-list {{ Request::is('admin/mail-templates') ? 'active' : '' }}"><i
                                class="fa fa-thumb-tack"></i>
                            <a class="sidebar-link sidebar-title link-nav" href="{{ url('admin/mail-templates') }}">
                                <i data-feather="gift"></i>
                                <span>{{ __('Manage Referral') }}</span>
                            </a>
                        </li>
                        <li class="sidebar-list {{ Request::is('admin/mail-templates') ? 'active' : '' }}"><i
                                class="fa fa-thumb-tack"></i>
                            <a class="sidebar-link sidebar-title link-nav" href="{{ url('admin/mail-templates') }}">
                                <i data-feather="trending-down"></i>
                                <span>{{ __('Deposits') }}</span>
                            </a>
                        </li>
                        <li class="sidebar-list {{ Request::is('admin/mail-templates') ? 'active' : '' }}"><i
                                class="fa fa-thumb-tack"></i>
                            <a class="sidebar-link sidebar-title link-nav" href="{{ url('admin/mail-templates') }}">
                                <i data-feather="trending-up"></i>
                                <span>{{ __('Withdrawals') }}</span>
                            </a>
                        </li>
                        {{-- <li class="sidebar-list {{ Request::is('admin/language') ? 'active' : '' }}"><i
                                class="fa fa-thumb-tack"></i>
                            <a class="sidebar-link sidebar-title link-nav" href="{{ url('admin/language') }}">
                                <i class="fa fa-language text-light"></i> &nbsp;&nbsp;
                                <span>{{ __('Multi Language') }}</span>
                            </a>
                        </li> --}}

                        <li class="sidebar-list {{ Request::is('support-ticket*') ? 'active' : '' }}"><i
                                class="fa fa-thumb-tack"></i>
                            <a class="sidebar-link sidebar-title" href="javascript:void(0)">
                                <i class="icon-headphone-alt text-light"></i>&nbsp;&nbsp;
                                <span>{{ __('Support Ticket') }}</span>
                            </a>
                            <ul class="sidebar-submenu">
                                <li><a class="{{ Request::is('support-ticket/index') ? 'active' : '' }}"
                                        href="{{ route('support-ticket.index') }}">{{ __('All Tickets') }}</a></li>
                                <li><a class="{{ Request::is('support-ticket/open') ? 'active' : '' }}"
                                        href="{{ route('support-ticket.open') }}">{{ __('Open Ticket') }}</a></li>
                            </ul>
                        </li>
                        <li class="sidebar-list {{ Request::is('support-ticket*') ? 'active' : '' }}"><i
                                class="fa fa-thumb-tack"></i>
                            <a class="sidebar-link sidebar-title" href="javascript:void(0)">
                                <i data-feather="file-text"></i>
                                <span>{{ __('Report') }}</span>
                            </a>
                            <ul class="sidebar-submenu">
                                <li><a class="{{ Request::is('support-ticket/index') ? 'active' : '' }}"
                                        href="{{ route('support-ticket.index') }}">{{ __('Transaction History') }}</a>
                                </li>
                                <li><a class="{{ Request::is('support-ticket/open') ? 'active' : '' }}"
                                        href="{{ route('support-ticket.open') }}">{{ __('Login History') }}</a></li>
                                <li><a class="{{ Request::is('support-ticket/open') ? 'active' : '' }}"
                                        href="{{ route('support-ticket.open') }}">{{ __('Notification History') }}</a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </div>
                <div class="right-arrow" id="right-arrow"><i data-feather="arrow-right"></i></div>
            </nav>
        </div>
    </div>
@else
    <div class="sidebar-wrapper">
        <div>
            <div class="logo-wrapper"><a href="{{ route('dashboard') }}"><img class=" for-light"
                        src="<?php echo '/' . $general_setting['app_footer_payment_image'] ?? ''; ?>" width="157px" height="80px" alt=""></a>
                <div class="back-btn"><i data-feather="grid"></i></div>
                <div class="toggle-sidebar icon-box-sidebar"><i class="status_toggle middle sidebar-toggle"
                        data-feather="grid"> </i></div>
            </div>
            <div class="logo-icon-wrapper"><a href="{{ route('dashboard') }}">
                    <div class="icon-box-sidebar"><i data-feather="grid"></i></div>
                </a></div>
            <nav class="sidebar-main">
                <div class="left-arrow" id="left-arrow"><i data-feather="arrow-left"></i></div>
                <div id="sidebar-menu">
                    <ul class="sidebar-links" id="simple-bar">
                        <li class="back-btn">
                            <div class="mobile-back text-end"><span>Back</span><i class="fa fa-angle-right ps-2"
                                    aria-hidden="true"></i></div>
                        </li>
                        <li class="pin-title sidebar-list">
                            <h6>Pinned</h6>
                        </li>
                        <hr>





                    </ul>
                </div>
                <div class="right-arrow" id="right-arrow"><i data-feather="arrow-right"></i></div>
            </nav>
        </div>
    </div>
@endif
