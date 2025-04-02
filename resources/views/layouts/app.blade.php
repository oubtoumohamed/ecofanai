<!doctype html>
<html lang="en" data-layout="vertical" data-layout-style="default" data-layout-position="fixed" data-layout-mode="light" data-topbar="light" data-sidebar="dark" data-sidebar-size="lg" data-layout-width="fluid">
<!--html lang="en" data-layout="horizontal" data-layout-style="" data-layout-position="fixed" data-topbar="light" -->
<head>
    <meta charset="utf-8" />
    <title>{{ config('app.name', 'JanoubTech') }}</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- App favicon -->
    <link rel="shortcut icon" href="{{ asset('assets/images/favicon.ico') }}">
    <!--script src="{{ asset('assets/js/layout.js') }}"></script-->
    <!-- Bootstrap Css -->
    <link href="{{ asset('assets/css/bootstrap.min.css') }}?v=1" rel="stylesheet" type="text/css" />
    <!-- Icons Css -->
    <link href="{{ asset('assets/css/icons.min.css') }}?v=1" rel="stylesheet" type="text/css" />
    <!-- App Css-->
    <link href="{{ asset('assets/css/app.min.css') }}?v=1" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/css/custom.min.css') }}?v=1" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/libs/sweetalert2/sweetalert2.min.css') }}?v=0.1" rel="stylesheet" type="text/css" />

    <style>.selectize-input{ padding: .25rem 0.5rem;}</style>
    @yield('css')
</head>
<body class="fullscreen-enable">

    <!-- Begin page -->
    <div id="layout-wrapper">

        <header id="page-topbar">
            <div class="layout-width">
                <div class="navbar-header">
                    <div class="d-flex">
                        <a href="{{ route('home') }}" class="fs-16 fw-bold text-muted header-item" style="text-transform: uppercase;">EcoFanAi</a>
                    </div>

                    <div class="d-flex align-items-center">

                        {{--<div class="ms-1 header-item d-none d-sm-flex">
                            <button type="button" id="gofullscreen" class="btn btn-icon btn-topbar btn-ghost-secondary rounded-circle shadow-none" data-toggle="fullscreen">
                                <i class='bx bx-fullscreen fs-22'></i>
                            </button>
                        </div>--}}

                        <div class="ms-1 header-item d-sm-flex">
                            <button id="light-dark-mode" type="button" class="btn btn-icon btn-topbar btn-ghost-secondary rounded-circle shadow-none">
                                <i class='bx bx-moon fs-22'></i>
                            </button>
                        </div>

                        
                        @if( isGranted('ADMIN') )
						@php $notifs = notifications(); @endphp
						<div class="dropdown topbar-head-dropdown ms-1 header-item">
							<button type="button" class="btn btn-icon btn-topbar btn-ghost-secondary rounded-circle shadow-none" id="page-header-notifications-dropdown" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
								<i class='bx bx-bell fs-22'></i>
								@if( $notifs->count() )
								<span class="position-absolute topbar-badge fs-10 translate-middle badge rounded-pill bg-danger">{{ $notifs->count() }}<span class="visually-hidden">unread messages</span></span>
								@endif
							</button>
							<div class="dropdown-menu dropdown-menu-lg dropdown-menu-end p-0" aria-labelledby="page-header-notifications-dropdown">

								<div class="dropdown-head bg-primary bg-pattern rounded-top">
									<div class="p-3">
										<div class="row align-items-center">
											<div class="col">
												<h6 class="m-0 fs-16 fw-semibold text-white"> Notifications </h6>
											</div>
										</div>
									</div>
								</div>

								<div data-simplebar style="min-height: 100px;max-height: 400px;" class="pe-2">
									@foreach( $notifs as $notif )
									<div class="text-reset notification-item d-block dropdown-item position-relative">
										<div class="d-flex">
											<div class="avatar-xs me-3">
												<span class="avatar-title bg-soft-info text-info rounded-circle fs-16">
													<i class="bx bx-badge-check"></i>
												</span>
											</div>
											<div class="flex-1">
												<a href="{{ route('notification_show', $notif->id) }}" class="stretched-link">
													<h6 class="mt-0 lh-base">{!! $notif->object !!}</h6>
													<h6 class="mt-0 lh-base">{!! $notif->contenu !!}</h6>
												</a>
											</div>
										</div>
									</div>
									@endforeach
								</div>
							</div>
						</div>
                        @endif

                        <div class="dropdown ms-sm-3 header-item topbar-user">
                            <button type="button" class="btn shadow-none" id="page-header-user-dropdown" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="d-flex align-items-center">
                                    <img class="rounded-circle header-profile-user" src="{{ asset('assets/images/blank.png') }}" alt="Header Avatar">
                                    <span class="text-start ms-xl-2">
                                        <span class="d-none d-xl-inline-block ms-1 fw-medium user-name-text">{{ auth()->user() }}</span>
                                        <span class="d-none d-xl-block ms-1 fs-12 text-muted user-name-sub-text">{{ auth()->user()->role }}</span>
                                    </span>
                                </span>
                            </button>
                            <div class="dropdown-menu dropdown-menu-end">
                                <!-- item-->
                                <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();" ><i class="mdi mdi-logout text-muted fs-16 align-middle me-1"></i> <span class="align-middle" data-key="t-logout">Logout</span></a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </header>
        <!-- Left Sidebar End -->
        <!-- Vertical Overlay-->
        <div class="vertical-overlay"></div>
        <div class="main-content">
            <div class="page-content">
                <div class="container-fluid">
                    @yield('content')
                </div>
                <!-- container-fluid -->
            </div>
            <!-- End Page-content -->

            <footer class="footer">
                <div class="main-nav-page">
                    <a href="{{ route('home') }}" class="main-nav-item active">
                        <i class="ri-home-line fs-24"></i>
                        <span>Home</span>
                    </a>
                    <a href="{{ route('take') }}" class="main-nav-item">
                        <i class="ri-vidicon-2-line fs-24"></i>
                        <span>New Action</span>
                    </a>
                    <a href="{{ route('home') }}" class="main-nav-item">
                        <i class="ri-road-map-line fs-24"></i>
                        <span>Bin Map</span>
                    </a>
                    <a href="{{ route('history') }}" class="main-nav-item">
                        <i class="ri-history-line fs-24"></i>
                        <span>History</span>
                    </a>
                </div>
            </footer>
        </div>

    </div>
    <!-- END layout-wrapper -->

    <!--start back-to-top-->
    <button onclick="topFunction()" class="btn btn-danger btn-icon" id="back-to-top">
        <i class="ri-arrow-up-line"></i>
    </button>
    <!--end back-to-top-->

    <!-- JAVASCRIPT -->
    <script>
        if (typeof module === 'object') {
            window.module = module; module = undefined;
        }
    </script>
    <script src="{{ asset('assets/libs/jquery/jquery-3.6.1.min.js') }}"></script>
    <script src="{{ asset('assets/libs/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/libs/simplebar/simplebar.min.js') }}"></script>
    <script src="{{ asset('assets/libs/node-waves/waves.min.js') }}"></script>
    <script src="{{ asset('assets/libs/feather-icons/feather.min.js') }}"></script>
    <script src="{{ asset('assets/libs/flatpickr/flatpickr.min.js') }}"></script>

    @yield('js')

    <!-- App js -->
    <script src="{{ asset('assets/libs/sweetalert2/sweetalert2.min.js') }}"></script>
    <script src="{{ asset('assets/js/app.js') }}?v=1.0"></script>
    <script src="{{ asset('assets/js/selectize.js') }}?v=1.9"></script>
    <script src="{{ asset('assets/js/datetimepicker.js') }}?v=0.9"></script>
    <script type="text/javascript">
        jQuery(document).ready(function(){

            //$('.loading').fadeOut(2000)

            $element__ = $('.nav-link.{{ explode('_',\Request::route()->getName())[0] }}');
            $element__.addClass('active');
            $element__.closest('.menu-dropdown').addClass('show');

            $('.delete_from_list,.delete_from_show').click(function (e) {
                e.preventDefault();
                //var form = $(this).parent('form');
                var this_url = $(this).attr('href');
                swal.fire({
                    title: '<strong>{{ __('global.confirm_delete') }}</strong>',
                    text: "{{ __('global.confirm_delete_text') }}",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'OUI',
                    confirmButtonClass:"btn btn-outline-danger pe-5 ps-5 me-2",
                    cancelButtonText: 'NON',
                    cancelButtonClass:"btn btn-info pe-5 ps-5 me-2",
                    buttonsStyling: 0,
                }).then(function (result) {
                    console.log(result);
                    if (result.isConfirmed) {
                        window.location.href = this_url;
                        /*swal.fire(
                            'Supprimer !',
                            'Ce élément a été supprimer avec succès',
                            'success'
                        );
                        form.submit();*/
                    }
                });
            });
        });
        var $selectizes = [];

        async function loadSelect(prms){

            var cnfg = {
                load: true,
                module: "",
                action: "list",
                defaultfilter: '',
                selector: "",
                fieldVal: "id",
                fieldText: "",
                fieldLabel: "",
                selected: 0,
                defaultoptions: [],
                callback: null
            };

            $.extend(cnfg, prms);

            if( ! $(cnfg.selector).length )
                return;

            if( !cnfg.defaultoptions.length )
                cnfg.defaultoptions = [];

            let options = cnfg.defaultoptions;


            fltr = ( typeof cnfg.defaultfilter === 'function' ? cnfg.defaultfilter() : cnfg.defaultfilter );

            var filter_ = "forAction=loadSelect&filter[dataonly][value]=1&filter[dataonly][scope]=1&" + fltr;

            if( cnfg.selected || cnfg.load ){
                if( cnfg.selected )
                    filter_ += "&filter[id][operation]==&filter[id][value]=" + cnfg.selected;

                await $.ajax({
                    url: '{{ route('admin') }}/' + cnfg.module + '/'+cnfg.action+'?' + filter_, /*encodeURIComponent(query),*/
                    type: 'GET',
                    success: function(result) {
                        options = cnfg.defaultoptions.concat(result);
                        if( cnfg.callback ){
                            cnfg.callback(options);
                        }
                    }
                });
            }

            // new code just for optimisation

            $select = $(cnfg.selector).selectize({
                valueField: cnfg.fieldVal ? cnfg.fieldVal : 'id',
                searchField: cnfg.fieldLabel ? cnfg.fieldLabel : "text",
                labelField: cnfg.fieldLabel ? cnfg.fieldLabel : "text",
                options: options,
                create: false,
                copyClassesToDropdown: true,
                load: function(query, callback) {
                    if (!query.length) return callback();

                    fltr = ( typeof cnfg.defaultfilter === 'function' ? cnfg.defaultfilter() : cnfg.defaultfilter );

                    filter_ = "forAction=loadSelect&filter[dataonly][value]=1&filter[dataonly][scope]=1&" + fltr;

                    if( cnfg.fieldText.search(',') > 0 ){
                        condtn = 'and';
                        $.each( cnfg.fieldText.split(','), function(i,f){
                            filter_ += "&filter["+f+"][value]=" + query +"&filter["+f+"][andor]="+condtn;
                            condtn = 'or';
                        });
                    }else{
                        filter_ += "&filter["+cnfg.fieldText+"][value]=" + query;
                    }

                    $.ajax({
                        url: '{{ route('admin') }}/' + cnfg.module + '/'+cnfg.action+'?' + filter_, /*encodeURIComponent(query),*/
                        type: 'GET',
                        error: function() {
                            callback();
                        },
                        success: function(result) {
                            options = cnfg.defaultoptions.concat(result);
                            callback(options);
                            if( cnfg.callback ){
                                cnfg.callback(options);
                            }
                        }
                    });
                }
            });

            $selectizes[ cnfg.selector ] =  $select[0].selectize;
            $select[0].selectize.setValue(cnfg.selected);

            return $selectizes[ cnfg.module ];
        }

        function number_format(nbr, n = 2, verg=',', sep = ' ') {

            nbr = nbr.toFixed(2)+"";

            var attr = nbr.split('.');

            var int_ = attr[0];
            var dec_ = attr[1];

            int_ = int_.replace(/\B(?=(\d{3})+(?!\d))/g, sep);

            if( !dec_ )
                dec_ = '00';

            return int_+verg+dec_;
        }
    </script>

    <script>if (window.module) module = window.module;</script>
</body>

</html>
