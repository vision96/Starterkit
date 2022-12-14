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
                        <li><a href="{{route('show-banks')}}" key="t-show-banks">@lang('translation.Show_Banks')</a></li>
                        <li><a href="{{route('show-branches')}}" key="t-show-branches">@lang('translation.Show_Branches')</a></li>
                    </ul>
                </li>

                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="bx bx-money"></i>
                        <span key="t-cheques">@lang('translation.Cheques')</span>
                    </a>

                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="{{route('show-cheques')}}" key="t-show-cheques">@lang('translation.Show_Cheques')</a></li>
                        <li><a href="{{route('show-chequeRecipients')}}" key="t-show-recipients">@lang('translation.Show_Recipients')</a></li>
                    </ul>
                </li>

                <li>
                     <a href="{{route('settings')}}" class="waves-effect">
                    <i class="bx bxs-cog"></i>
                    <span key="t-settings">@lang('translation.Settings')</span>
                    </a>
                </li>

                <li>
                    <a href="{{route('system-information')}}" class="waves-effect">
                        <i class="bx bx-shield-quarter"></i>
                        <span key="t-system-information">@lang('translation.System_information')</span>
                    </a>
                </li>

            </ul>
        </div>
        <!-- Sidebar -->
    </div>
</div>
<!-- Left Sidebar End -->
