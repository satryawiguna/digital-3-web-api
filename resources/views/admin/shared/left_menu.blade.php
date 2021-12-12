<nav class="left-menu" left-menu ng-class="{'hidden-left-menu': hideLeftMenu}">
    <div class="logo-container">
        <a href="#/dashboard" class="logo">
            <img class="logo-inverse" src="./assets/common/images/admin/logo-inverse.png" alt="Digital 3" />
        </a>
    </div>
    <div class="left-menu-inner scroll-pane">
        <ul class="left-menu-list left-menu-list-root list-unstyled">
            <!-- DASHBOARD -->
            <li ng-show="authentication.isAuthorized(['super', 'admin'])">
                <a class="left-menu-link" href="#/dashboard">
                    <i class="left-menu-link-icon icmn-home2"><!-- --></i>
                    <span class="menu-top-hidden">Dashboard</span>
                </a>
            </li>
            <li ng-show="authentication.isAuthorized(['super', 'admin'])" class="left-menu-list-separator"><!-- --></li>

            <!-- MAIN MENU -->
            <li class="left-menu-list-disabled">
                <a class="left-menu-link" href="javascript: void(0);">
                    Main Menu
                </a>
            </li>

            <!-- SYSTEM ACCESS MANAGEMENT -->
            <li ng-show="authentication.isAuthorized(['super', 'admin'])" class="left-menu-list-submenu">
                <a class="left-menu-link" href="javascript: void(0);">
                    <i class="left-menu-link-icon icmn-database"><!-- --></i>
                    System Access
                </a>
                <ul class="left-menu-list list-unstyled">
                    <li  ng-show="authentication.isAuthorized(['super'])">
                        <a class="left-menu-link" href="#/role">
                            Roles
                        </a>
                    </li>
                    <li  ng-show="authentication.isAuthorized(['super'])">
                        <a class="left-menu-link" href="#/user">
                            Users
                        </a>
                    </li>
                    <li  ng-show="authentication.isAuthorized(['super'])">
                        <a class="left-menu-link" href="#/importData">
                            Import Data
                        </a>
                    </li>
                </ul>
            </li>
            <li ng-show="authentication.isAuthorized(['super', 'admin'])" class="left-menu-list-separator"><!-- --></li>

            <!-- BLOG / POST MANAGEMENT -->
            <li ng-show="authentication.isAuthorized(['super', 'admin'])" class="menu-top-hidden left-menu-list-submenu">
                <a class="left-menu-link" href="javascript: void(0);">
                    <i class="left-menu-link-icon icmn-rss"><!-- --></i>
                    Blogs
                </a>
                <!-- level 1 -->
                <ul class="left-menu-list list-unstyled">
                    <li ng-show="authentication.isAuthorized(['super', 'admin'])" class="left-menu-list-submenu">
                        <a class="left-menu-link" href="javascript: void(0);">
                            Posts
                        </a>
                        <!-- level 2 -->
                        <ul class="left-menu-list list-unstyled">
                            <li ng-show="authentication.isAuthorized(['super', 'admin'])" >
                                <a class="left-menu-link" href="#/blog">
                                    &nbsp;&nbsp;
                                    Posts List
                                </a>
                            </li>
                            <li ng-show="authentication.isAuthorized(['super', 'admin'])" >
                                <a class="left-menu-link" href="#/blog/add">
                                    &nbsp;&nbsp;
                                    Add New
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li ng-show="authentication.isAuthorized(['super', 'admin'])" class="left-menu-list-submenu">
                        <a class="left-menu-link" href="javascript: void(0);">
                            Categories
                        </a>
                        <!-- level 2 -->
                        <ul class="left-menu-list list-unstyled">
                            <li ng-show="authentication.isAuthorized(['super', 'admin'])" >
                                <a class="left-menu-link" href="#/blogCategory">
                                    &nbsp;&nbsp;
                                    Categories List
                                </a>
                            </li>
                            <li ng-show="authentication.isAuthorized(['super', 'admin'])" >
                                <a class="left-menu-link" href="#/blogCategory/add">
                                    &nbsp;&nbsp;
                                    Add New
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li ng-show="authentication.isAuthorized(['super', 'admin'])" class="left-menu-list-submenu">
                        <a class="left-menu-link" href="javascript: void(0);">
                            Tags
                        </a>
                        <!-- level 2 -->
                        <ul class="left-menu-list list-unstyled">
                            <li ng-show="authentication.isAuthorized(['super', 'admin'])" >
                                <a class="left-menu-link" href="#/blogTag">
                                    &nbsp;&nbsp;
                                    Tags List
                                </a>
                            </li>
                            <li ng-show="authentication.isAuthorized(['super', 'admin'])" >
                                <a class="left-menu-link" href="#/blogTag/add">
                                    &nbsp;&nbsp;
                                    Add New
                                </a>
                            </li>
                        </ul>
                    </li>
                </ul>
            </li>
            <li ng-show="authentication.isAuthorized(['super', 'admin'])" class="left-menu-list-separator"><!-- --></li>

            <!-- PRODUCT MANAGEMENT -->
            <li ng-show="authentication.isAuthorized(['super', 'admin'])" class="menu-top-hidden left-menu-list-submenu">
                <a class="left-menu-link" href="javascript: void(0);">
                    <i class="left-menu-link-icon icmn-database2"><!-- --></i>
                    Products
                </a>

                <!-- level 1 -->
                <ul class="left-menu-list list-unstyled">
                    <li ng-show="authentication.isAuthorized(['super', 'admin'])" class="left-menu-list-submenu">
                        <a class="left-menu-link" href="javascript: void(0);">
                            Products
                        </a>
                        <!-- level 2 -->
                        <ul class="left-menu-list list-unstyled">
                            <li ng-show="authentication.isAuthorized(['super', 'admin'])" >
                                <a class="left-menu-link" href="#/product">
                                    &nbsp;&nbsp;
                                    Product List
                                </a>
                            </li>
                            <li ng-show="authentication.isAuthorized(['super', 'admin'])" >
                                <a class="left-menu-link" href="#/product/add">
                                    &nbsp;&nbsp;
                                    Add New
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li ng-show="authentication.isAuthorized(['super', 'admin'])" class="left-menu-list-submenu">
                        <a class="left-menu-link" href="javascript: void(0);">
                            Types
                        </a>
                        <!-- level 2 -->
                        <ul class="left-menu-list list-unstyled">
                            <li ng-show="authentication.isAuthorized(['super', 'admin'])" >
                                <a class="left-menu-link" href="#/productType">
                                    &nbsp;&nbsp;
                                    Type List
                                </a>
                            </li>
                            <li ng-show="authentication.isAuthorized(['super', 'admin'])" >
                                <a class="left-menu-link" href="#/productType/add">
                                    &nbsp;&nbsp;
                                    Add New
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li ng-show="authentication.isAuthorized(['super', 'admin', 'agent'])" class="left-menu-list-submenu">
                        <a class="left-menu-link" href="javascript: void(0);">
                            Genres
                        </a>
                        <!-- level 2 -->
                        <ul class="left-menu-list list-unstyled">
                            <li ng-show="authentication.isAuthorized(['super', 'admin'])" >
                                <a class="left-menu-link" href="#/productGenre">
                                    &nbsp;&nbsp;
                                    Genre List
                                </a>
                            </li>
                            <li ng-show="authentication.isAuthorized(['super', 'admin'])" >
                                <a class="left-menu-link" href="#/productGenre/add">
                                    &nbsp;&nbsp;
                                    Add New
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li ng-show="authentication.isAuthorized(['super', 'admin'])" class="left-menu-list-submenu">
                        <a class="left-menu-link" href="javascript: void(0);">
                            Tags
                        </a>
                        <!-- level 2 -->
                        <ul class="left-menu-list list-unstyled">
                            <li ng-show="authentication.isAuthorized(['super', 'admin'])" >
                                <a class="left-menu-link" href="#/productTag">
                                    &nbsp;&nbsp;
                                    Tag List
                                </a>
                            </li>
                            <li ng-show="authentication.isAuthorized(['super', 'admin'])" >
                                <a class="left-menu-link" href="#/productTag/add">
                                    &nbsp;&nbsp;
                                    Add New
                                </a>
                            </li>
                        </ul>
                    </li>
                </ul>
            </li>
        </ul>
    </div>
</nav>