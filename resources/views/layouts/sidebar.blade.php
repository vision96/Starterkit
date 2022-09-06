<!-- ========== Left Sidebar Start ========== -->
<div class="vertical-menu">

    <div data-simplebar class="h-100">

        <!--- Sidemenu -->
        <div id="sidebar-menu">
            <!-- Left Menu Start -->
            <ul class="metismenu list-unstyled" id="side-menu">
                <li class="menu-title" key="t-menu">@lang('translation.menu')</li>

                <li>
                    <a href="{{route('root')}}" class="waves-effect">
                        <i class="bx bx-home-circle"></i>
                        <span key="t-dashboards">@lang('translation.dashboards')</span>
                    </a>
                </li>

                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="bx bxs-bank"></i>
                        <span key="t-banks">@lang('translation.Banks')</span>
                    </a>

                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="{{route('add-bank')}}" key="t-add-bank">@lang('translation.Add_Bank')</a></li>
                    </ul>
                </li>

                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="bx bx-money"></i>
                        <span key="t-cheques">@lang('translation.Cheques')</span>
                    </a>

                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="{{route('add-cheque')}}" key="t-add-cheque">@lang('translation.Add_Cheque')</a></li>
                    </ul>
                </li>

{{--                <li>--}}
{{--                    <a href="#" class="waves-effect">--}}
{{--                        <i class="bx bxs-cog"></i>--}}
{{--                        <span key="t-settings">@lang('translation.Settings')</span>--}}
{{--                    </a>--}}
{{--                </li>--}}

            </ul>
        </div>
        <!-- Sidebar -->
    </div>
</div>
<!-- Left Sidebar End -->
