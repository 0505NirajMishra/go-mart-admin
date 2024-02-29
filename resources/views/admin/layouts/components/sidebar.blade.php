<!DOCTYPE html>
<html>

<head>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
        integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>


@php
    function checkActiveSideBar(array $links)
    {
        foreach ($links as $link) {
            if (request()->is('*admin/' . $link . '*')) {
                return true;
            }
        }
        return false;
    }
@endphp

<!--begin::Aside-->
<div id="kt_aside" class="aside aside-dark aside-hoverable" data-kt-drawer="true" data-kt-drawer-name="aside"
    data-kt-drawer-activate="{default: true, lg: false}" data-kt-drawer-overlay="true"
    data-kt-drawer-width="{default:'200px', '300px': '250px'}" data-kt-drawer-direction="start"
    data-kt-drawer-toggle="#kt_aside_mobile_toggle">
    <!--begin::Brand-->
    <div class="aside-logo flex-column-auto" id="kt_aside_logo">
        <!--begin::Logo-->
        <a href="javascript:void(0)" style="text-decoration: none;">

            <span style="font-size:30px;color:white;font-weight:600px;">Gomart</span>
        </a>
        <!--end::Logo-->
        <!--begin::Aside toggler-->
        <div id="kt_aside_toggle" class="btn btn-icon w-auto px-0 btn-active-color-primary aside-toggle"
            data-kt-toggle="true" data-kt-toggle-state="active" data-kt-toggle-target="body"
            data-kt-toggle-name="aside-minimize">
            <!--begin::Svg Icon | path: icons/duotone/Navigation/Angle-double-left.svg-->
            <span class="svg-icon svg-icon-1 rotate-180">
                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px"
                    height="24px" viewBox="0 0 24 24" version="1.1">
                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                        <polygon points="0 0 24 0 24 24 0 24" />
                        <path
                            d="M5.29288961,6.70710318 C4.90236532,6.31657888 4.90236532,5.68341391 5.29288961,5.29288961 C5.68341391,4.90236532 6.31657888,4.90236532 6.70710318,5.29288961 L12.7071032,11.2928896 C13.0856821,11.6714686 13.0989277,12.281055 12.7371505,12.675721 L7.23715054,18.675721 C6.86395813,19.08284 6.23139076,19.1103429 5.82427177,18.7371505 C5.41715278,18.3639581 5.38964985,17.7313908 5.76284226,17.3242718 L10.6158586,12.0300721 L5.29288961,6.70710318 Z"
                            fill="#000000" fill-rule="nonzero"
                            transform="translate(8.999997, 11.999999) scale(-1, 1) translate(-8.999997, -11.999999)" />
                        <path
                            d="M10.7071009,15.7071068 C10.3165766,16.0976311 9.68341162,16.0976311 9.29288733,15.7071068 C8.90236304,15.3165825 8.90236304,14.6834175 9.29288733,14.2928932 L15.2928873,8.29289322 C15.6714663,7.91431428 16.2810527,7.90106866 16.6757187,8.26284586 L22.6757187,13.7628459 C23.0828377,14.1360383 23.1103407,14.7686056 22.7371482,15.1757246 C22.3639558,15.5828436 21.7313885,15.6103465 21.3242695,15.2371541 L16.0300699,10.3841378 L10.7071009,15.7071068 Z"
                            fill="#000000" fill-rule="nonzero" opacity="0.5"
                            transform="translate(15.999997, 11.999999) scale(-1, 1) rotate(-270.000000) translate(-15.999997, -11.999999)" />
                    </g>
                </svg>
            </span>
            <!--end::Svg Icon-->
        </div>
        <!--end::Aside toggler-->
    </div>
    <!--end::Brand-->
    <!--begin::Aside menu-->
    <div class="aside-menu flex-column-fluid">
        <!--begin::Aside Menu-->
        <div class="hover-scroll-overlay-y my-5 my-lg-5" id="kt_aside_menu_wrapper" data-kt-scroll="true"
            data-kt-scroll-activate="{default: false, lg: true}" data-kt-scroll-height="auto"
            data-kt-scroll-dependencies="#kt_aside_logo, #kt_aside_footer" data-kt-scroll-wrappers="#kt_aside_menu"
            data-kt-scroll-offset="0">
            <!--begin::Menu-->
            <div class="menu menu-column menu-title-gray-800 menu-state-title-primary menu-state-icon-primary menu-state-bullet-primary menu-arrow-gray-500"
                id="#kt_aside_menu" data-kt-menu="true">
                <div class="menu-item">
                    <div class="menu-content pb-2">
                        <span
                            class="menu-section text-muted text-uppercase fs-8 ls-1">{{ trans_choice('content.sidebar.dashboard', 1) }}</span>
                    </div>
                </div>
                <div class="menu-item">
                    <a class="menu-link {{ checkActiveSideBar(['dashboard']) ? 'menu-item active' : '' }}"
                        href="{{ route('admin.dashboard') }} ">
                        <span class="menu-icon">
                            <!--begin::Svg Icon | path: icons/duotone/Design/PenAndRuller.svg-->
                            <span class="svg-icon svg-icon-2">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24px" height="24px"
                                    viewBox="0 0 24 24" version="1.1">
                                    <path
                                        d="M3,16 L5,16 C5.55228475,16 6,15.5522847 6,15 C6,14.4477153 5.55228475,14 5,14 L3,14 L3,12 L5,12 C5.55228475,12 6,11.5522847 6,11 C6,10.4477153 5.55228475,10 5,10 L3,10 L3,8 L5,8 C5.55228475,8 6,7.55228475 6,7 C6,6.44771525 5.55228475,6 5,6 L3,6 L3,4 C3,3.44771525 3.44771525,3 4,3 L10,3 C10.5522847,3 11,3.44771525 11,4 L11,19 C11,19.5522847 10.5522847,20 10,20 L4,20 C3.44771525,20 3,19.5522847 3,19 L3,16 Z"
                                        fill="#000000" opacity="0.3" />
                                    <path
                                        d="M16,3 L19,3 C20.1045695,3 21,3.8954305 21,5 L21,15.2485298 C21,15.7329761 20.8241635,16.200956 20.5051534,16.565539 L17.8762883,19.5699562 C17.6944473,19.7777745 17.378566,19.7988332 17.1707477,19.6169922 C17.1540423,19.602375 17.1383289,19.5866616 17.1237117,19.5699562 L14.4948466,16.565539 C14.1758365,16.200956 14,15.7329761 14,15.2485298 L14,5 C14,3.8954305 14.8954305,3 16,3 Z"
                                        fill="#000000" />
                                </svg>
                            </span>
                            <!--end::Svg Icon-->
                        </span>
                        <span class="menu-title">{{ trans_choice('content.sidebar.dashboard', 1) }}</span>
                    </a>
                </div>

                <div class="menu-item">
                    <div class="menu-content pt-8 pb-2">
                        <span
                            class="menu-section text-muted text-uppercase fs-8 ls-1">{{ trans_choice('content.sidebar.menu', 2) }}</span>
                    </div>
                </div>

                {{-- <div data-kt-menu-trigger="click"
                        class="menu-item menu-accordion {{ checkActiveSideBar(['users', 'roles', 'permissions']) ? 'hover show' : '' }}">
                        <span class="menu-link">
                            <span class="menu-icon">
                                <!--begin::Svg Icon | path: icons/duotone/General/Shield-protected.svg-->
                                <span class="svg-icon svg-icon-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                                        width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                            <rect x="0" y="0" width="24" height="24" />
                                            <path
                                                d="M4,4 L11.6314229,2.5691082 C11.8750185,2.52343403 12.1249815,2.52343403 12.3685771,2.5691082 L20,4 L20,13.2830094 C20,16.2173861 18.4883464,18.9447835 16,20.5 L12.5299989,22.6687507 C12.2057287,22.8714196 11.7942713,22.8714196 11.4700011,22.6687507 L8,20.5 C5.51165358,18.9447835 4,16.2173861 4,13.2830094 L4,4 Z"
                                                fill="#000000" opacity="0.3" />
                                            <path
                                                d="M14.5,11 C15.0522847,11 15.5,11.4477153 15.5,12 L15.5,15 C15.5,15.5522847 15.0522847,16 14.5,16 L9.5,16 C8.94771525,16 8.5,15.5522847 8.5,15 L8.5,12 C8.5,11.4477153 8.94771525,11 9.5,11 L9.5,10.5 C9.5,9.11928813 10.6192881,8 12,8 C13.3807119,8 14.5,9.11928813 14.5,10.5 L14.5,11 Z M12,9 C11.1715729,9 10.5,9.67157288 10.5,10.5 L10.5,11 L13.5,11 L13.5,10.5 C13.5,9.67157288 12.8284271,9 12,9 Z"
                                                fill="#000000" />
                                        </g>
                                    </svg>
                                </span>
                                <!--end::Svg Icon-->
                            </span>
                            <span
                                class="menu-title">{{ trans_choice('content.sidebar.user_management', 1) }}</span>
                            <span class="menu-arrow"></span>
                        </span>
                        <div class="menu-sub menu-sub-accordion menu-active-bg">
                            <div class="menu-item">
                                <a class="menu-link {{ checkActiveSideBar(['users']) ? 'active' : '' }}"
                                    href="{{ route('admin.users.index') }}">
                                    <span class="menu-bullet">
                                        <span class="bullet bullet-dot"></span>
                                    </span>
                                    <span class="menu-title">{{ trans_choice('content.sidebar.user', 1) }}</span>
                                </a>
                            </div>
                            <div class="menu-item">
                                <a class="menu-link {{ checkActiveSideBar(['roles']) ? 'active' : '' }}"
                                    href="{{ route('admin.roles.index') }}">
                                    <span class="menu-bullet">
                                        <span class="bullet bullet-dot"></span>
                                    </span>
                                    <span class="menu-title">{{ trans_choice('content.sidebar.role', 1) }}</span>
                                </a>
                            </div>
                            <div class="menu-item">
                                <a class="menu-link {{ checkActiveSideBar(['permissions']) ? 'active' : '' }}"
                                    href="{{ route('admin.permissions.index') }}">
                                    <span class="menu-bullet">
                                        <span class="bullet bullet-dot"></span>
                                    </span>
                                    <span
                                        class="menu-title">{{ trans_choice('content.sidebar.permission', 1) }}</span>
                                </a>
                            </div>
                        </div>
                    </div> --}}

                <div class="menu-item">
                    <a class="menu-link {{ checkActiveSideBar(['user']) ? 'menu-item active' : '' }}"
                        href="{{ route('admin.users.index') }}">
                        <span class="menu-icon">

                            <span class="svg-icon svg-icon-2">
                                <!-- <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                                        width="24px" height="24px" viewBox="0 0 24 24" version="1.1" >
                                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd" >
                                            <polygon points="0 0 24 0 24 24 0 24" />
                                            <path
                                                d="M12,11 C9.790861,11 8,9.209139 8,7 C8,4.790861 9.790861,3 12,3 C14.209139,3 16,4.790861 16,7 C16,9.209139 14.209139,11 12,11 Z"
                                                fill="#000000" fill-rule="nonzero" opacity="0.3" />
                                            <path
                                                d="M3.00065168,20.1992055 C3.38825852,15.4265159 7.26191235,13 11.9833413,13 C16.7712164,13 20.7048837,15.2931929 20.9979143,20.2 C21.0095879,20.3954741 20.9979143,21 20.2466999,21 C16.541124,21 11.0347247,21 3.72750223,21 C3.47671215,21 2.97953825,20.45918 3.00065168,20.1992055 Z"
                                                fill="#000000" fill-rule="nonzero" />
                                        </g>
                                    </svg> -->
                                <i class="fa fa-user" style="color:cyanblue;font-size:15px;"></i>
                            </span>

                        </span>
                        <span class="menu-title">Users</span>
                    </a>
                </div>

                {{-- start category menu section  --}}

                <div class="menu-item">
                    <a class="menu-link {{ checkActiveSideBar(['category']) ? 'menu-item active' : '' }}"
                        href="{{ route('admin.categorys.index') }}">
                        <span class="menu-icon">
                            <span class="svg-icon svg-icon-2">
                                <i class="fa fa-bars" style="color:cyanblue;font-size:15px;"></i>
                            </span>

                        </span>
                        <span class="menu-title">Categories</span>
                    </a>
                </div>

                {{-- <!-- end  category menu section --!> --}}


                {{-- start subcategory menu section  --}}

                <!--<div class="menu-item">-->
                <!--    <a class="menu-link {{ checkActiveSideBar(['subcategory']) ? 'menu-item active' : '' }}"-->
                <!--        href="{{ route('admin.subcategorys.index') }}">-->
                <!--        <span class="menu-icon">-->
                <!--            <span class="svg-icon svg-icon-2">-->
                <!--                <i class="fa fa-bars" style="color:cyanblue;font-size:15px;"></i>-->
                <!--            </span>-->

                <!--        </span>-->
                <!--        <span class="menu-title">Subcategory</span>-->
                <!--    </a>-->
                <!--</div>-->

                {{-- <!-- end subcategory menu section --!> --}}

                <!-- start Store menu section --!>

                    <!--<div class="menu-item">-->
                    <!--    <a class="menu-link {{ checkActiveSideBar(['store']) ? 'menu-item active' : '' }}"-->
                    <!--        href="{{ route('admin.stores.index') }}">-->
                    <!--        <span class="menu-icon">-->
                    <!--            <i-->
                    <!--                class="fa-solid fa-store"-->
                    <!--                style="color:cyanblue;font-size:15px;"-->
                    <!--            ></i>-->
                    <!--        </span>-->
                    <!--        <span class="menu-title">Stores</span>-->
                    <!--    </a>-->
                    <!--</div>-->

                    <!-- end Store menu section --!>


                    <!-- start Item menu section --!>

                    <div class="menu-item">
                        <a class="menu-link {{ checkActiveSideBar(['item']) ? 'menu-item active' : '' }}"
                            href="{{ route('admin.items.index') }}">
                            <span class="menu-icon">
                                <i class="fa fa-cart-shopping" style="color:cyanblue;font-size:15px;"></i>
                            </span>
                            <span class="menu-title">Items</span>
                        </a>
                    </div>

                    <!-- end Item menu section --!>

                    <!-- start Driver menu section --!>

                    <!--<div class="menu-item">-->
                    <!--    <a class="menu-link {{ checkActiveSideBar(['driver']) ? 'menu-item active' : '' }}"-->
                    <!--        href="{{ route('admin.drivers.index') }}">-->
                    <!--        <span class="menu-icon">-->
                    <!--            <i class="fa fa-car" style="color:cyanblue;font-size:15px;"></i>-->
                    <!--        </span>-->
                    <!--        <span class="menu-title">Drivers</span>-->
                    <!--    </a>-->
                    <!--</div>-->

                    <!-- end Driver menu section --!>

                    <!-- start Banner menu section --!>

                    <div class="menu-item">
                        <a class="menu-link {{ checkActiveSideBar(['banner']) ? 'menu-item active' : '' }}"
                            href="{{ route('admin.banners.index') }}">
                            <span class="menu-icon">
                                <i class="fa fa-table" style="color:cyanblue;font-size:15px;"></i>
                            </span>
                            <span class="menu-title">Banner Items</span>
                        </a>
                    </div>

                    <!-- end Banner menu section --!>
                    
                    <!-- start Notification menu section --!>

                    <div class="menu-item">
                        <a class="menu-link {{ checkActiveSideBar(['notification']) ? 'menu-item active' : '' }}"
                            href="{{ route('admin.notifications.index') }}">
                            <span class="menu-icon">
                                <i class="fa fa-bell" style="color:cyanblue;font-size:15px;"></i>
                            </span>
                            <span class="menu-title">Notifications</span>
                        </a>
                    </div>

                    <!-- end Notification menu section --!>

                    <!-- start Order menu section --!>

                    <div class="menu-item">
                        <a class="menu-link {{ checkActiveSideBar(['order']) ? 'menu-item active' : '' }}"
                            href="{{ route('admin.orders.index') }}">
                            <span class="menu-icon">
                                <i class="fa fa-book" style="color:cyanblue;font-size:15px;"></i>
                            </span>
                            <span class="menu-title">Orders</span>
                        </a>
                    </div>

                    <!-- end Order menu section --!>

                    <!-- start Review menu section --!>

                    <!--<div class="menu-item">-->
                    <!--    <a class="menu-link {{ checkActiveSideBar(['review']) ? 'menu-item active' : '' }}"-->
                    <!--        href="{{ route('admin.reviews.index') }}">-->
                    <!--        <span class="menu-icon">-->
                    <!--            <i class="fa fa-star" style="color:cyanblue;font-size:15px;"></i>-->
                    <!--        </span>-->
                    <!--        <span class="menu-title">Reviews</span>-->
                    <!--    </a>-->
                    <!--</div>-->

                    <!-- end Review menu section --!>

                    <!-- start Global menu section --!>

                    <!--<div class="menu-item">-->
                    <!--    <a class="menu-link {{ checkActiveSideBar(['global']) ? 'menu-item active' : '' }}"-->
                    <!--        href="{{ url('/') }}/admin/globals/edit/1">-->
                    <!--        <span class="menu-icon">-->
                    <!--            <i class="fa fa-gear" style="color:cyanblue;font-size:15px;"></i>-->
                    <!--        </span>-->
                    <!--        <span class="menu-title">Global Setting</span>-->
                    <!--    </a>-->
                    <!--</div>-->

                    <!-- end Global menu section --!>

                    <!-- start Currency menu section --!>

                    <!-- <div class="menu-item">
                        <a class="menu-link {{ checkActiveSideBar(['currency']) ? 'menu-item active' : '' }}"
                            href="{{ route('admin.currencys.index') }}">
                            <span class="menu-icon">
                                <i class="fa fa-dollar-sign" style="color:cyanblue;font-size:15px;"></i>
                            </span>
                            <span class="menu-title">Currency</span>
                        </a>
                    </div> -->

                <!-- end Currency menu section --!>

                    <!-- start Coupan menu section --!>

                    <div class="menu-item">
                        <a class="menu-link {{ checkActiveSideBar(['coupan']) ? 'menu-item active' : '' }}"
                            href="{{ route('admin.coupans.index') }}">
                            <span class="menu-icon">
                                <i class="fa fa-building" style="color:cyanblue;font-size:15px;"></i>
                            </span>
                            <span class="menu-title">Coupon</span>
                        </a>
                    </div>

                    <!-- end Coupan menu section --!>

                    <!-- start Coupan menu section --!>

                    <!--<div class="menu-item">-->
                    <!--    <a class="menu-link {{ checkActiveSideBar(['language']) ? 'menu-item active' : '' }}"-->
                    <!--        href="{{ route('admin.languages.index') }}">-->
                    <!--        <span class="menu-icon">-->
                    <!--            <i class="fa fa-language" style="color:cyanblue;font-size:15px;"></i>-->
                    <!--        </span>-->
                    <!--        <span class="menu-title">Languages</span>-->
                    <!--    </a>-->
                    <!--</div>-->

                    <!-- end Coupan menu section --!>

                    <!-- start Commission menu section --!>

                        <!-- <div class="menu-item">
                            <a class="menu-link {{ checkActiveSideBar(['commission']) ? 'menu-item active' : '' }}"
                                href="{{ url('/') }}/admin/commissions/edit/1">
                                <span class="menu-icon">
                                    <i class="fa-brands fa-creative-commons-share" style="color:cyanblue;font-size:15px;"></i>
                                </span>
                                <span class="menu-title">Commission</span>
                            </a>
                        </div> -->

                <!-- end Commission menu section --!>

                    
                    <!-- start Commission menu section --!>

                        <!-- <div class="menu-item">
                            <a class="menu-link {{ checkActiveSideBar(['radius']) ? 'menu-item active' : '' }}"
                                href="{{ url('/') }}/admin/radiuss/edit/1">
                                <span class="menu-icon">
                                    <i class="fa-brands fa-creative-commons-share" style="color:cyanblue;font-size:15px;"></i>
                                </span>
                                <span class="menu-title">Radius configuration </span>
                            </a>
                        </div> -->

                <!-- end Commission menu section --!>

                    <!-- start vat menu section --!>

                        <!-- <div class="menu-item">
                            <a class="menu-link {{ checkActiveSideBar(['vat']) ? 'menu-item active' : '' }}"
                                href="{{ url('/') }}/admin/vats/edit/1">
                                <span class="menu-icon">
                                    <i class="fa-brands fa-creative-commons-share" style="color:cyanblue;font-size:15px;"></i>
                                </span>
                                <span class="menu-title">Vat Setting</span>
                            </a>
                        </div> -->

                <!-- end vat menu section --!>

                    <!-- start delivery charge menu section --!>

                        <!-- <div class="menu-item">
                            <a class="menu-link {{ checkActiveSideBar(['deliverycharge']) ? 'menu-item active' : '' }}"
                                href="{{ url('/') }}/admin/deliverycharges/edit/1">
                                <span class="menu-icon">
                                    <i class="fa-brands fa-creative-commons-share" style="color:cyanblue;font-size:15px;"></i>
                                </span>
                                <span class="menu-title">Delivery Charge</span>
                            </a>
                        </div> -->

                <!-- end delivery charge menu section --!>

                    <!-- start special offer menu section --!>

                        <!-- <div class="menu-item">
                            <a class="menu-link {{ checkActiveSideBar(['specialoffer']) ? 'menu-item active' : '' }}"
                                href="{{ url('/') }}/admin/specialoffers/edit/1">
                                <span class="menu-icon">
                                    <i class="fa-brands fa-creative-commons-share" style="color:cyanblue;font-size:15px;"></i>
                                </span>
                                <span class="menu-title">Special Offer</span>
                            </a>
                        </div> -->

                <!-- end delivery special offer menu section --!>

                    <!-- start  Stores Payment menu section --!>

                        <!-- <div class="menu-item">
                            <a class="menu-link {{ checkActiveSideBar(['storepayment']) ? 'menu-item active' : '' }}"
                                href="{{ route('admin.storepayments.index') }}">
                                <span class="menu-icon">
                                    <i class="fa fa-language" style="color:cyanblue;font-size:15px;"></i>
                                </span>
                                <span class="menu-title">Stores Payments</span>
                            </a>
                        </div> -->

                <!-- end Stores Payment menu section --!>

                    <!-- start  Stores Payment menu section --!>

                        <!-- <div class="menu-item">
                            <a class="menu-link {{ checkActiveSideBar(['storepayout']) ? 'menu-item active' : '' }}"
                                href="{{ route('admin.storepayouts.index') }}">
                                <span class="menu-icon">
                                    <i class="fa fa-language" style="color:cyanblue;font-size:15px;"></i>
                                </span>
                                <span class="menu-title">Stores Payouts</span>
                            </a>
                        </div> -->

                <!-- end Stores Payment menu section --!>

                    <!-- start  Driver Payment menu section --!>

                        <!-- <div class="menu-item">
                            <a class="menu-link {{ checkActiveSideBar(['driverpayment']) ? 'menu-item active' : '' }}"
                                href="{{ route('admin.driverpayments.index') }}">
                                <span class="menu-icon">
                                    <i class="fa fa-language" style="color:cyanblue;font-size:15px;"></i>
                                </span>
                                <span class="menu-title">Driver Payment</span>
                            </a>
                        </div> -->

                <!-- end Driver Payment menu section --!>

                    <!-- start  Driver Payout menu section --!>

                        <!-- <div class="menu-item">
                            <a class="menu-link {{ checkActiveSideBar(['driverpayout']) ? 'menu-item active' : '' }}"
                                href="{{ route('admin.driverpayouts.index') }}">
                                <span class="menu-icon">
                                    <i class="fa fa-language" style="color:cyanblue;font-size:15px;"></i>
                                </span>
                                <span class="menu-title">Driver Payout</span>
                            </a>
                        </div> -->

                <!-- end Driver Payout menu section --!>

                    <!-- start Wallet Transaction menu section --!>

                        <!-- <div class="menu-item">
                            <a class="menu-link {{ checkActiveSideBar(['wallettransaction']) ? 'menu-item active' : '' }}"
                                href="{{ route('admin.wallettransactions.index') }}">
                                <span class="menu-icon">
                                    <i class="fa fa-language" style="color:cyanblue;font-size:15px;"></i>
                                </span>
                                <span class="menu-title">Wallet Transaction</span>
                            </a>
                        </div> -->

                <!-- end Wallet Transaction menu section --!>
                    
                    <!-- start Order Transaction menu section --!>

                        <!-- <div class="menu-item">
                            <a class="menu-link {{ checkActiveSideBar(['ordertransaction']) ? 'menu-item active' : '' }}"
                                href="{{ route('admin.ordertransactions.index') }}">
                                <span class="menu-icon">
                                    <i class="fa fa-language" style="color:cyanblue;font-size:15px;"></i>
                                </span>
                                <span class="menu-title">Order Transaction</span>
                            </a>
                        </div> -->

                <!-- end Order Transaction menu section --!>

                    <!-- start Payment Key menu section --!>

                        <!-- <div class="menu-item">
                            <a class="menu-link {{ checkActiveSideBar(['payment']) ? 'menu-item active' : '' }}"
                                href="{{ url('/') }}/admin/payments/edit/1">
                                <span class="menu-icon">
                                    <i  class="fa fa-key"
                                        style="color:cyanblue;font-size:15px;">
                                    </i>
                                </span>
                                <span class="menu-title">Payment</span>
                            </a>
                        </div> -->

                <!-- end Payment Key menu section --!>

                </div>
                <!--end::Menu-->
            </div>
            <!--end::Aside Menu-->
        </div>
        <!--end::Aside menu-->
    </div>
    <!--end::Aside-->

</html>
