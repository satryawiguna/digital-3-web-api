@include('admin.shared.header')

<body class="theme-green colorful-enabled" ng-controller="MainController">

<div data-loading ></div>

@include('admin.shared.left_menu')

@include('admin.shared.top_menu')

<section class="page-content" ng-view></section>

@include('admin.shared.footer')