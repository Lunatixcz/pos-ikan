<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        <title>Metronic - the world's #1 selling Bootstrap Admin Theme Ecosystem for HTML, Vue, React, Angular &amp; Laravel by Keenthemes</title>
		<meta charset="utf-8" />
		<meta name="description" content="The most advanced Bootstrap Admin Theme on Themeforest trusted by 94,000 beginners and professionals. Multi-demo, Dark Mode, RTL support and complete React, Angular, Vue &amp; Laravel versions. Grab your copy now and get life-time updates for free." />
		<meta name="keywords" content="Metronic, bootstrap, bootstrap 5, Angular, VueJs, React, Laravel, admin themes, web design, figma, web development, free templates, free admin themes, bootstrap theme, bootstrap template, bootstrap dashboard, bootstrap dak mode, bootstrap button, bootstrap datepicker, bootstrap timepicker, fullcalendar, datatables, flaticon" />
		<meta name="viewport" content="width=device-width, initial-scale=1" />
		<meta property="og:locale" content="en_US" />
		<meta property="og:type" content="article" />
		<meta property="og:title" content="Metronic - Bootstrap 5 HTML, VueJS, React, Angular &amp; Laravel Admin Dashboard Theme" />
		<meta property="og:url" content="https://keenthemes.com/metronic" />
		<meta property="og:site_name" content="Keenthemes | Metronic" />
		<link rel="canonical" href="https://preview.keenthemes.com/metronic8" />
		<link rel="shortcut icon" href="assets/media/logos/favicon.ico" />
		<!--begin::Fonts-->
		<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700" />
		<!--end::Fonts-->
		<!--begin::Page Vendor Stylesheets(used by this page)-->
		<link href="Template/assets/plugins/custom/fullcalendar/fullcalendar.bundle.css" rel="stylesheet" type="text/css" />
		<link href="Template/assets/plugins/custom/datatables/datatables.bundle.css" rel="stylesheet" type="text/css" />
		<!--end::PagTemplate/e Vendor Stylesheets-->
		<!--begin::GTemplate/lobal Stylesheets Bundle(used by all pages)-->
		<link href="Template/assets/plugins/global/plugins.bundle.css" rel="stylesheet" type="text/css" />
		<link href="Template/assets/css/style.bundle.css" rel="stylesheet" type="text/css" />

        @vite(['resources/css/app.css', 'resources/js/app.js'])
		<!--end::Global Stylesheets Bundle-->
    </head>
    <body id="kt_body"class="header-fixed header-tablet-and-mobile-fixed toolbar-enabled toolbar-fixed aside-enabled aside-fixed" style="--kt-toolbar-height:55px;--kt-toolbar-height-tablet-and-mobile:55px">
        <div class="d-flex flex-column flex-road">
            <div class="page d-flex flex-row  flex-column-fluid">
                @include('layouts.navigation')
                <div class="wrapper d-flex flex-column flex-row-fluid" id="kt_wrapper">
                    {{-- @include('layouts.header') --}}
                    <div class="content d-flex flex-column flex-column-fluid container-xxl" id="kt_content">
                        @yield('content')
                    </div>
                </div>
            </div>
        </div>
		<!--begin::Global Javascript Bundle(used by all pages)-->
		<script src="Template/assets/plugins/global/plugins.bundle.js"></script>
		<script src="Template/assets/js/scripts.bundle.js"></script>
		<!--end::GlobTemplate/al Javascript Bundle-->
		<!--begin::PaTemplate/ge Vendors Javascript(used by this page)-->
		<script src="Template/assets/plugins/custom/fullcalendar/fullcalendar.bundle.js"></script>
		<script src="Template/assets/plugins/custom/datatables/datatables.bundle.js"></script>
		<!--end::PageTemplate/ Vendors Javascript-->
		<!--begin::PaTemplate/ge Custom Javascript(used by this page)-->
		<script src="Template/assets/js/widgets.bundle.js"></script>
		<script src="Template/assets/js/custom/widgets.js"></script>
		<script src="Template/assets/js/custom/apps/chat/chat.js"></script>
		<script src="Template/assets/js/custom/utilities/modals/upgrade-plan.js"></script>
		<script src="Template/assets/js/custom/utilities/modals/create-app.js"></script>
		<script src="Template/assets/js/custom/utilities/modals/users-search.js"></script>
        @stack('scripts')
    </body>

</html>
