@php
    $isSuperAdmin = $user_session->is_super_admin;
@endphp
@if ($isSuperAdmin)
    <div class="sidebar-wrapper">
        <div>
            <div class="logo-wrapper"><a href="{{ route('dashboard') }}"><img class=" for-light" src="<?php echo '/' . $general_setting['app_logo'] ?? ''; ?>"
                        width="120px" height="120px" style="margin-top: -26px;margin-left: 32px;" alt=""></a>
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
                            <a class="sidebar-link sidebar-title d-flex align-items-center" href="javascript:void(0)">
                                <i data-feather="settings" class="me-2"></i>&nbsp;&nbsp;&nbsp;
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
                                    <a class="{{ Request::is('admin/notification-settings') ? 'active' : '' }}"
                                        href="{{ route('admin.notification.settings') }}">
                                        <span>{{ __('Notification Configuration') }}</span>
                                    </a>
                                </li>
                                <li>
                                    <a class="{{ Request::is('admin/notification-templates*') ? 'active' : '' }}"
                                        href="{{ route('notification.template.index') }}">
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
                        <li class="sidebar-list {{ Request::is('kyc*') ? 'active' : '' }}">
                            <a class="sidebar-link sidebar-title link-nav" href="{{ route('kyc.index') }}">
                                <i class="fa fa-id-card text-light"></i>&nbsp;&nbsp;&nbsp;
                                <span>KYC Manage</span>
                            </a>
                        </li>

                        <li class="sidebar-list {{ Request::segment(2) == 'funding-plans' ? 'active' : '' }}">
                            <i class="fa fa-thumb-tack"></i>
                            <a class="sidebar-link sidebar-title link-nav" href="{{ route('funding-plans.index') }}">
                                <i class="fa fa-trophy text-warning"></i>&nbsp;&nbsp;&nbsp;
                                <span>Funding Plans</span>
                            </a>
                        </li>
                        <li class="sidebar-list {{ Request::is('admin/plan-purchases*') ? 'active' : '' }}">
                            <i class="fa fa-thumb-tack"></i>
                            <a class="sidebar-link sidebar-title link-nav" href="{{ route('plan-purchases.index') }}">
                                <i class="fa fa-credit-card text-light"></i>&nbsp;&nbsp;
                                <span>Plan Purchases</span>
                            </a>
                        </li>
                        <!-- Icons Around the World (Celebrity Endorsements) -->
                        <li class="sidebar-list {{ Request::is('admin/celebrity-endorsements*') ? 'active' : '' }}">
                            <i class="fa fa-thumb-tack"></i>
                            <a class="sidebar-link sidebar-title link-nav"
                                href="{{ route('celebrity-endorsements.index') }}">
                                <i class="fas fa-star text-warning"></i>&nbsp;&nbsp;
                                <span>Starz</span>
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
                        <!-- Manage Trades & Positions -->
                        <li
                            class="sidebar-list {{ Request::is('admin/trades*') || Request::is('admin/positions*') ? 'active' : '' }}">
                            <a class="sidebar-link sidebar-title" href="javascript:void(0)">
                                <i class="fa fa-bar-chart text-light"></i>&nbsp;&nbsp;&nbsp;
                                <span>{{ __('Trading Activity') }}</span>
                            </a>
                            <ul class="sidebar-submenu">
                                <li>
                                    <a class="{{ Request::is('admin/trades') ? 'active' : '' }}"
                                        href="{{ route('trades.index') }}">
                                        <i class="fa fa-history"></i> Trade History
                                    </a>
                                </li>
                                <li>
                                    <a class="{{ Request::is('admin/orders/open') ? 'active' : '' }}"
                                        href="{{ route('orders.open') }}">
                                        <i class="fa fa-clock-o"></i> Open Orders
                                    </a>
                                </li>
                                <li>
                                    <a class="{{ Request::is('admin/orders/history') ? 'active' : '' }}"
                                        href="{{ route('orders.history') }}">
                                        <i class="fa fa-list-alt"></i> Order History
                                    </a>
                                </li>
                                <li>
                                    <a class="{{ Request::is('admin/positions') ? 'active' : '' }}"
                                        href="{{ route('positions.index') }}">
                                        <i class="fa fa-line-chart"></i> Open Positions
                                    </a>
                                </li>
                                <li>
                                    <a class="{{ Request::is('admin/positions/history') ? 'active' : '' }}"
                                        href="{{ route('positions.history') }}">
                                        <i class="fa fa-archive"></i> Position History
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li class="sidebar-list {{ Request::is('admin/instruments*') ? 'active' : '' }}">
                            <a class="sidebar-link sidebar-title" href="{{ route('instruments.index') }}">
                                <i class="fa fa-bar-chart text-light" style="margin-left:3px;"></i>
                                &nbsp;&nbsp;&nbsp;
                                <span>Instruments</span>
                            </a>
                        </li>
                        <li
                            class="sidebar-list {{ Request::is('admin/blockchain-hash-records*') ||
                            Request::is('admin/delayed-feed-assignments*') ||
                            Request::is('admin/hedging-monitor*') ||
                            Request::is('admin/slippage-profiles*')
                                ? 'active'
                                : '' }}">
                            <a class="sidebar-link sidebar-title" href="javascript:void(0)">
                                <i class="fa fa-shield text-light" style="margin-left:3px;"></i>

                                &nbsp;&nbsp;&nbsp;
                                <span>Risk & Compliance</span>
                            </a>
                            <ul class="sidebar-submenu">

                                <li>
                                    <a class="{{ Request::is('admin/blockchain-hash-records*') ? 'active' : '' }}"
                                        href="{{ route('blockchain-hash-records.index') }}">
                                        <i class="fa fa-link"></i> Blockchain Hash Records
                                    </a>
                                </li>

                                <li>
                                    <a class="{{ Request::is('admin/delayed-feed-assignments*') ? 'active' : '' }}"
                                        href="{{ route('delayed-feed-assignments.index') }}">
                                        <i class="fa fa-clock-o"></i> Delayed Feed Assignments
                                    </a>
                                </li>

                                <li>
                                    <a class="{{ Request::is('admin/hedging-monitor*') ? 'active' : '' }}"
                                        href="{{ route('hedging-monitor.index') }}">
                                        <i class="fa fa-balance-scale"></i> Hedging Monitor
                                    </a>
                                </li>

                                <li>
                                    <a class="{{ Request::is('admin/slippage-profiles*') ? 'active' : '' }}"
                                        href="{{ route('slippage-profiles.index') }}">
                                        <i class="fa fa-tachometer"></i> Slippage Profiles
                                    </a>
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
                                {{-- <li><a class="{{ Request::is('blog/blog-comment-list') ? 'active' : '' }}"
                                        href="{{ route('blog.blog-comment-list') }}">{{ __('Lista de Comentarios') }}</a>
                                </li> --}}
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
                        <!-- Manage Orders -->
                        <li class="sidebar-list {{ Request::is('admin/orders*') ? 'active' : '' }}">
                            <a class="sidebar-link sidebar-title link-nav" href="{{ route('orders.index') }}">
                                <i class="fa fa-gavel text-light"></i>
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
                        <li
                            class="sidebar-list {{ Request::is('admin/system-trade-config') || Request::is('admin/system-trade-config/*') ? 'active' : '' }}">
                            <i class="fa fa-thumb-tack"></i>
                            <a class="sidebar-link sidebar-title link-nav d-flex align-items-center"
                                href="{{ route('system-trade-config.edit') }}">
                                <i data-feather="activity" class="me-2"></i>
                                <span>{{ __('Trade Config') }}</span>
                            </a>
                        </li>

                        <li class="sidebar-list {{ Request::is('admin/referral-settings') ? 'active' : '' }}">
                            <i class="fa fa-thumb-tack"></i>
                            <a class="sidebar-link sidebar-title link-nav d-flex align-items-center"
                                href="{{ url('admin/referral-settings') }}">
                                <i data-feather="users" class="me-2"></i>
                                <span>{{ __('Manage Referral') }}</span>
                            </a>
                        </li>

                        <li class="sidebar-list {{ Request::is('admin/mail-templates') ? 'active' : '' }}">
                            <i class="fa fa-thumb-tack"></i>
                            <a class="sidebar-link sidebar-title link-nav d-flex align-items-center"
                                href="{{ url('admin/mail-templates') }}">
                                <i data-feather="trending-up" class="me-2"></i>
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
                            <a class="sidebar-link sidebar-title d-flex align-items-center" href="javascript:void(0)">
                                <i data-feather="file-text" class="me-2"></i>
                                <span>{{ __('Report') }}</span>
                            </a>

                            <ul class="sidebar-submenu">
                                <li><a class="{{ Request::is('support-ticket/index') ? 'active' : '' }}"
                                        href="{{ route('support-ticket.index') }}">{{ __('Transaction History') }}</a>
                                </li>
                                <li><a class="{{ Request::is('support-ticket/open') ? 'active' : '' }}"
                                        href="{{ route('support-ticket.open') }}">{{ __('Login History') }}</a>
                                </li>
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
