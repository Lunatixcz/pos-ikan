<div id="kt_aside" class="aside aside-dark aside-hoverable" data-kt-drawer="true" data-kt-drawer-name="aside" data-kt-drawer-activate="{default: true, lg: false}" data-kt-drawer-overlay="true" data-kt-drawer-width="{default:'200px', '300px': '250px'}" data-kt-drawer-direction="start" data-kt-drawer-toggle="#kt_aside_mobile_toggle">
    <!--begin::Brand-->
    <div class="aside-logo flex-column-auto" id="kt_aside_logo">
        <!--begin::Logo-->
        <a href="{{ route('dashboard') }}" class="text-4xl text-medium text-white">
            Asna Seafood
        </a>
        <!--end::Logo-->
        <!--begin::Aside toggler-->
        <!--end::Aside toggler-->
    </div>
    <!--end::Brand-->
    <!--begin::Aside menu-->
    <div class="aside-menu flex-column-fluid">
        <!--begin::Aside Menu-->
        <div class="hover-scroll-overlay-y my-5 my-lg-5" id="kt_aside_menu_wrapper" data-kt-scroll="true" data-kt-scroll-activate="{default: false, lg: true}" data-kt-scroll-height="auto" data-kt-scroll-dependencies="#kt_aside_logo, #kt_aside_footer" data-kt-scroll-wrappers="#kt_aside_menu" data-kt-scroll-offset="0" style="height: 954px;">
            <!--begin::Menu-->
            <div class="menu menu-column menu-title-gray-800 menu-state-title-primary menu-state-icon-primary menu-state-bullet-primary menu-arrow-gray-500" id="#kt_aside_menu" data-kt-menu="true" data-kt-menu-expand="false">
                <div class="menu-item">
                    <a href="{{ route('dashboard') }}">
                        <div class="menu-link">
                            <span class="menu-icon">
                                <!--begin::Svg Icon | path: icons/duotune/ecommerce/ecm007.svg-->
                                <svg xmlns="http://www.w3.org/2000/svg" width="1.6rem" height="1.6rem" viewBox="0 0 24 24">
                                    <path fill="currentColor" d="M13.106 22h-2.212c-3.447 0-5.17 0-6.345-1.012c-1.175-1.012-1.419-2.705-1.906-6.093l-.279-1.937c-.38-2.637-.57-3.956-.029-5.083c.54-1.127 1.691-1.813 3.992-3.183l1.385-.825C9.8 2.622 10.846 2 12 2c1.154 0 2.199.622 4.288 1.867l1.385.825c2.3 1.37 3.451 2.056 3.992 3.183c.54 1.127.35 2.446-.03 5.083l-.278 1.937c-.487 3.388-.731 5.081-1.906 6.093C18.276 22 16.553 22 13.106 22" opacity="0.5" />
                                    <path fill="currentColor" d="M8.25 18a.75.75 0 0 1 .75-.75h6a.75.75 0 0 1 0 1.5H9a.75.75 0 0 1-.75-.75" />
                                </svg>
                                <!--end::Svg Icon-->
                            </span>
                            <span class="menu-title">Dashboard</span>
                        </div>
                    </a>
                </div>
                <div class="menu-item">
                    <a href="{{ route('ikan.index') }}">
                    <div class="menu-link">
                        <span class="menu-icon">
                            <svg xmlns="http://www.w3.org/2000/svg" width="1.6rem" height="1.6rem" viewBox="0 0 24 24">
                                <path fill="currentColor" d="M8.422 20.618C10.178 21.54 11.056 22 12 22V12L2.638 7.073a3.196 3.196 0 0 0-.04.067C2 8.154 2 9.417 2 11.942v.117c0 2.524 0 3.787.597 4.801c.598 1.015 1.674 1.58 3.825 2.709z" />
                                <path fill="currentColor" d="m17.577 4.432l-2-1.05C13.822 2.461 12.944 2 12 2c-.945 0-1.822.46-3.578 1.382l-2 1.05C4.318 5.536 3.242 6.1 2.638 7.072L12 12l9.362-4.927c-.606-.973-1.68-1.537-3.785-2.641" opacity="0.7" />
                                <path fill="currentColor" d="M21.403 7.14a3.153 3.153 0 0 0-.041-.067L12 12v10c.944 0 1.822-.46 3.578-1.382l2-1.05c2.151-1.129 3.227-1.693 3.825-2.708c.597-1.014.597-2.277.597-4.8v-.117c0-2.525 0-3.788-.597-4.802" opacity="0.5" />
                                <path fill="currentColor" d="m6.323 4.484l.1-.052l1.493-.784l9.1 5.005l4.025-2.011c.137.155.257.32.362.498c.15.254.262.524.346.825L17.75 9.964V13a.75.75 0 0 1-1.5 0v-2.286l-3.5 1.75v9.44A3.062 3.062 0 0 1 12 22c-.248 0-.493-.032-.75-.096v-9.44l-8.998-4.5c.084-.3.196-.57.346-.824a3.15 3.15 0 0 1 .362-.498l9.04 4.52l3.387-1.693z" />
                            </svg>
                        </span>
                        <span class="menu-title">
                            Stok Ikan
                        </span>
                    </div>
                    </a>
                </div>
                <div class="menu-item">
                    <a href="{{ route('supplier.index') }}">
                    <div class="menu-link">
                        <span class="menu-icon">
                            <svg xmlns="http://www.w3.org/2000/svg" width="1.6rem" height="1.6rem" viewBox="0 0 24 24">
                                <circle cx="15" cy="6" r="3" fill="currentColor" opacity="0.4" />
                                <ellipse cx="16" cy="17" fill="currentColor" opacity="0.4" rx="5" ry="3" />
                                <circle cx="9.001" cy="6" r="4" fill="currentColor" />
                                <ellipse cx="9.001" cy="17.001" fill="currentColor" rx="7" ry="4" />
                            </svg>
                        </span>
                        <span class="menu-title">
                            Supplier
                        </span>
                    </div>
                    </a>
                </div>
                <div class="menu-item">
                    <a href="{{ route('customer.index') }}">
                        <div class="menu-link">
                            <span class="menu-icon">
                                <svg xmlns="http://www.w3.org/2000/svg" width="1.6rem" height="1.6rem" viewBox="0 0 24 24">
                                    <circle cx="15" cy="6" r="3" fill="currentColor" opacity="0.4" />
                                    <ellipse cx="16" cy="17" fill="currentColor" opacity="0.4" rx="5" ry="3" />
                                    <circle cx="9.001" cy="6" r="4" fill="currentColor" />
                                    <ellipse cx="9.001" cy="17.001" fill="currentColor" rx="7" ry="4" />
                                </svg>
                            </span>
                            <span class="menu-title">
                                Customer
                            </span>
                        </div>
                    </a>
                </div>
                <div data-kt-menu-trigger="click" class="menu-item menu-accordion">
                    <span class="menu-link">
                        <span class="menu-icon">
                            <svg xmlns="http://www.w3.org/2000/svg" width="1.6rem" height="1.6rem" viewBox="0 0 24 24">
                                <path fill="currentColor" d="M7.245 2h9.51c1.159 0 1.738 0 2.206.163a3.045 3.045 0 0 1 1.881 1.936C21 4.581 21 5.177 21 6.37v14.004c0 .858-.985 1.314-1.608.744a.946.946 0 0 0-1.284 0l-.483.442a1.657 1.657 0 0 1-2.25 0a1.657 1.657 0 0 0-2.25 0a1.657 1.657 0 0 1-2.25 0a1.657 1.657 0 0 0-2.25 0a1.657 1.657 0 0 1-2.25 0l-.483-.442a.946.946 0 0 0-1.284 0c-.623.57-1.608.114-1.608-.744V6.37c0-1.193 0-1.79.158-2.27c.3-.913.995-1.629 1.881-1.937C5.507 2 6.086 2 7.245 2" opacity="0.5" />
                                <path fill="currentColor" d="M7 6.75a.75.75 0 0 0 0 1.5h.5a.75.75 0 0 0 0-1.5zm3.5 0a.75.75 0 0 0 0 1.5H17a.75.75 0 0 0 0-1.5zM7 10.25a.75.75 0 0 0 0 1.5h.5a.75.75 0 0 0 0-1.5zm3.5 0a.75.75 0 0 0 0 1.5H17a.75.75 0 0 0 0-1.5zM7 13.75a.75.75 0 0 0 0 1.5h.5a.75.75 0 0 0 0-1.5zm3.5 0a.75.75 0 0 0 0 1.5H17a.75.75 0 0 0 0-1.5z" />
                            </svg>
                        </span>
                        <span class="menu-title">Transaksi</span>
                        <span class="menu-arrow"></span>
                    </span>
                    <div class="menu-sub menu-sub-accordion menu-active-bg" style="display: none; overflow: hidden;">
                        <div class="menu-item">
                            <a class="menu-link" href="{{ route('pembelian.index') }}">
                                <span class="menu-bullet">
                                    <span class="bullet bullet-dot"></span>
                                </span>
                                <span class="menu-title">Pembelian</span>
                            </a>
                        </div>
                        <div class="menu-item">
                            <a class="menu-link" href="{{ route('penjualan.index') }}">
                                <span class="menu-bullet">
                                    <span class="bullet bullet-dot"></span>
                                </span>
                                <span class="menu-title">Penjualan</span>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="menu-item">
                    <a href="{{ route('laporan.index') }}">
                        <div class="menu-link">
                            <span class="menu-icon">
                                <svg xmlns="http://www.w3.org/2000/svg" width="1.6rem" height="1.6rem" viewBox="0 0 24 24">
                                    <path fill="currentColor" d="M17.121 21.121C18 20.243 18 18.828 18 16v-3.34c-1.477-.502-3.458-.91-6-.91s-4.523.408-6 .91V16c0 2.828 0 4.243.879 5.121C7.757 22 9.172 22 12 22c2.828 0 4.243 0 5.121-.879M17.12 2.879C16.243 2 14.829 2 12 2s-4.243 0-5.122.879c-.492.492-.709 1.153-.804 2.136C6.634 5 7.252 5 7.93 5h8.141c.678 0 1.296 0 1.855.015c-.095-.983-.312-1.644-.804-2.136" />
                                    <path fill="currentColor" d="M16 6H8c-2.828 0-4.243 0-5.121.879C2 7.757 2 9.172 2 12c0 2.828 0 4.243.879 5.121c.492.493 1.153.71 2.136.804C5 17.366 5 16.748 5 16.071v-3.029l-.193.085a.75.75 0 0 1-.614-1.368c1.722-.773 4.288-1.51 7.807-1.51c3.52 0 6.085.737 7.807 1.51a.75.75 0 1 1-.614 1.368a12.138 12.138 0 0 0-.193-.085v3.029c0 .677 0 1.295-.015 1.854c.983-.095 1.644-.311 2.136-.804C22 16.243 22 14.828 22 12c0-2.828 0-4.243-.879-5.121C20.243 6 18.828 6 16 6" opacity="0.5" />
                                </svg>
                            </span>
                            <span class="menu-title">
                                Laporan
                            </span>
                        </div>
                    </a>
                </div>
            </div>
            <!--end::Menu-->
        </div>
        <!--end::Aside Menu-->
    </div>
    <!--end::Aside menu-->
    <!--begin::Footer-->
    <!--end::Footer-->
</div>
