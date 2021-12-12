<!DOCTYPE html>
<html ng-app="app">
<head lang="en">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Admin - Digital 3</title>

    <link href="{{ asset('assets/common/images/favicon.144x144.png') }}" rel="apple-touch-icon" type="image/png" sizes="144x144">
    <link href="{{ asset('assets/common/images/favicon.114x114.png') }}" rel="apple-touch-icon" type="image/png" sizes="114x114">
    <link href="{{ asset('assets/common/images/favicon.72x72.png') }}" rel="apple-touch-icon" type="image/png" sizes="72x72">
    <link href="{{ asset('assets/common/images/favicon.57x57.png') }}" rel="apple-touch-icon" type="image/png">
    <link href="{{ asset('assets/common/images/favicon.png') }}" rel="icon" type="image/png">
    <link href="favicon.ico" rel="shortcut icon">

    <!-- HTML5 shim and Respond.js for < IE9 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

    <!-- Vendors Styles -->
    <!-- v1.0.0 -->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/vendors/bootstrap/dist/css/bootstrap.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/vendors/jscrollpane/style/jquery.jscrollpane.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/vendors/ladda/dist/ladda-themeless.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/vendors/ngprogress/ngProgress.css') }}">
    <link rel="stylesheet" type="text/css"
          href="{{ asset('assets/vendors/eonasdan-bootstrap-datetimepicker/build/css/bootstrap-datetimepicker.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/vendors/fullcalendar/dist/fullcalendar.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/vendors/cleanhtmlaudioplayer/src/player.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/vendors/cleanhtmlvideoplayer/src/player.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/vendors/bootstrap-sweetalert/dist/sweetalert.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/vendors/summernote/dist/summernote.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/vendors/owl.carousel/dist/assets/owl.carousel.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/vendors/ionrangeslider/css/ion.rangeSlider.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/vendors/datatables/media/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/vendors/angular-datatables/dist/css/angular-datatables.min.css') }}">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/fixedcolumns/3.2.2/css/fixedColumns.dataTables.min.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/vendors/c3/c3.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/vendors/chartist/dist/chartist.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/common/css/source/slim/slim.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/vendors/fancybox-plus/css/jquery.fancybox-plus.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/vendors/angular-bootstrap/ui-bootstrap-csp.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/vendors/angular-ui-select/dist/select.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/vendors/select2/dist/css/select2.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/vendors/bootstrap-daterangepicker/daterangepicker.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/vendors/angular-input-stars-directive/angular-input-stars.css') }}">

    <!-- Clean UI Styles -->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/common/css/source/main.css') }}">

    <!-- Vendors Scripts -->
    <!-- v1.0.0 -->
    <script src="{{ asset('assets/vendors/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/vendors/tether/dist/js/tether.min.js') }}"></script>
    <script src="{{ asset('assets/vendors/bootstrap/dist/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('assets/vendors/jquery-mousewheel/jquery.mousewheel.min.js') }}"></script>
    <script src="{{ asset('assets/vendors/jscrollpane/script/jquery.jscrollpane.min.js') }}"></script>
    <script src="{{ asset('assets/vendors/spin.js/spin.js') }}"></script>
    <script src="{{ asset('assets/vendors/ladda/dist/ladda.min.js') }}"></script>
    <script src="{{ asset('assets/vendors/select2/dist/js/select2.full.min.js') }}"></script>
    <script src="{{ asset('assets/vendors/html5-form-validation/dist/jquery.validation.min.js') }}"></script>
    <script src="{{ asset('assets/vendors/jquery-typeahead/dist/jquery.typeahead.min.js') }}"></script>
    <script src="{{ asset('assets/vendors/jquery-mask-plugin/dist/jquery.mask.min.js') }}"></script>
    <script src="{{ asset('assets/vendors/autosize/dist/autosize.min.js') }}"></script>
    <script src="{{ asset('assets/vendors/bootstrap-show-password/bootstrap-show-password.min.js') }}"></script>
    <script src="{{ asset('assets/vendors/moment/min/moment.min.js') }}"></script>
    <script src="{{ asset('assets/vendors/eonasdan-bootstrap-datetimepicker/build/js/bootstrap-datetimepicker.min.js') }}"></script>
    <script src="{{ asset('assets/vendors/fullcalendar/dist/fullcalendar.min.js') }}"></script>
    <script src="{{ asset('assets/vendors/cleanhtmlaudioplayer/src/jquery.cleanaudioplayer.js') }}"></script>
    <script src="{{ asset('assets/vendors/cleanhtmlvideoplayer/src/jquery.cleanvideoplayer.js') }}"></script>
    <script src="{{ asset('assets/vendors/bootstrap-sweetalert/dist/sweetalert.min.js') }}"></script>
    <script src="{{ asset('assets/vendors/remarkable-bootstrap-notify/dist/bootstrap-notify.min.js') }}"></script>
    <script src="{{ asset('assets/vendors/summernote/dist/summernote.min.js') }}"></script>
    <script src="{{ asset('assets/vendors/owl.carousel/dist/owl.carousel.min.js') }}"></script>
    <script src="{{ asset('assets/vendors/ionrangeslider/js/ion.rangeSlider.min.js') }}"></script>
    <script src="{{ asset('assets/vendors/nestable/jquery.nestable.js') }}"></script>
    <script src="{{ asset('assets/vendors/datatables/media/js/jquery.dataTables.min.js') }}"></script>
    <!--<script src="{{ asset('assets/vendors/datatables/media/js/dataTables.bootstrap4.min.js') }}"></script>-->
    <!--<script src="{{ asset('assets/vendors/datatables-fixedcolumns/js/dataTables.fixedColumns.js') }}"></script>-->
    <!--<script src="{{ asset('assets/vendors/datatables-responsive/js/dataTables.responsive.js') }}"></script>-->
    <script src="{{ asset('assets/vendors/editable-table/mindmup-editabletable.js') }}"></script>
    <script src="{{ asset('assets/vendors/d3/d3.min.js') }}"></script>
    <script src="{{ asset('assets/vendors/c3/c3.min.js') }}"></script>
    <script src="{{ asset('assets/vendors/chartist/dist/chartist.min.js') }}"></script>
    <script src="{{ asset('assets/vendors/peity/jquery.peity.min.js') }}"></script>
    <!-- v1.0.1 -->
    <script src="{{ asset('assets/vendors/chartist-plugin-tooltip/dist/chartist-plugin-tooltip.min.js') }}"></script>
    <!-- v1.1.1 -->
    <script src="{{ asset('assets/vendors/gsap/src/minified/TweenMax.min.js') }}"></script>
    <script src="{{ asset('assets/vendors/hackertyper/hackertyper.js') }}"></script>
    <script src="{{ asset('assets/vendors/jquery-countTo/jquery.countTo.js') }}"></script>
    <script src="{{ asset('assets/common/js/www/lib/tinymce/tinymce.min.js') }}"></script>
    <script src="{{ asset('assets/vendors/fancybox-plus/dist/jquery.fancybox-plus.min.js') }}"></script>
    <script src="{{ asset('assets/vendors/jquery.observe_field/jquery.observe_field.js') }}"></script>
    <script src="{{ asset('assets/vendors/bootstrap-daterangepicker/daterangepicker.js') }}"></script>
    <script src="{{ asset('assets/vendors/moment/min/moment.min.js') }}"></script>

    <!-- Angular Version Scripts -->
    <script src="http://maps.google.com/maps/api/js?key=AIzaSyC1hapx0hpf4AYbltS0ZH-Ns8Njcge2rjY&"></script>
    <script src="{{ asset('assets/vendors/angular/angular.min.js') }}"></script>
    <script src="{{ asset('assets/vendors/angular-route/angular-route.min.js') }}"></script>
    <script src="{{ asset('assets/vendors/ngprogress/build/ngprogress.min.js') }}"></script>
    <script src="{{ asset('assets/vendors/angular-ladda/dist/angular-ladda.min.js') }}"></script>
    <script src="{{ asset('assets/vendors/angular-datatables/dist/angular-datatables.min.js') }}"></script>
    <script src="{{ asset('assets/vendors/angular-sanitize/angular-sanitize.min.js') }}"></script>
    <script src="https://cdn.datatables.net/fixedcolumns/3.2.2/js/dataTables.fixedColumns.min.js"></script>
    <script src="{{ asset('assets/vendors/angular-datatables/dist/plugins/fixedcolumns/angular-datatables.fixedcolumns.min.js') }}"></script>
    <!--<script src="{{ asset('assets/vendors/angular-bootstrap/ui-bootstrap.min.js') }}"></script>-->
    <script src="{{ asset('assets/vendors/angular-bootstrap/ui-bootstrap-tpls.min.js') }}"></script>
    <script src="{{ asset('assets/vendors/angular-ui-tinymce/dist/tinymce.min.js') }}"></script>
    <script src="{{ asset('assets/vendors/ng-file-upload/ng-file-upload-shim.min.js') }}"></script>
    <script src="{{ asset('assets/vendors/ng-file-upload/ng-file-upload.min.js') }}"></script>
    <script src="{{ asset('assets/common/js/www/lib/slim/slim.kickstart.min.js') }}"></script>
    <script src="{{ asset('assets/common/js/www/lib/slim/slim.angular.js') }}"></script>
    <script src="{{ asset('assets/vendors/ng-file-upload/ng-file-upload-shim.min.js') }}"></script>
    <script src="{{ asset('assets/vendors/ng-file-upload/ng-file-upload.min.js') }}"></script>
    <script src="{{ asset('assets/vendors/checklist-model/checklist-model.js') }}"></script>
    <script src="{{ asset('assets/vendors/ngmap/build/scripts/ng-map.min.js') }}"></script>
    <script src="{{ asset('assets/vendors/angular-ui-select/dist/select.min.js') }}"></script>
    <script src="{{ asset('assets/vendors/angular-thumbnails/dist/angular-thumbnails.min.js') }}"></script>
    <script src="{{ asset('assets/vendors/angular-daterangepicker/js/angular-daterangepicker.min.js') }}"></script>
    <script src="{{ asset('assets/vendors/angular-number-picker/dist/angular-number-picker.js') }}"></script>
    <script src="{{ asset('assets/vendors/angular-input-stars-directive/angular-input-stars.js') }}"></script>

    <script src="{{ asset('assets/common/js/www/app.js') }}"></script>
    <script src="{{ asset('assets/common/js/www/config.js') }}"></script>
    <script src="{{ asset('assets/common/js/www/constant.js') }}"></script>
    <script src="{{ asset('assets/common/js/www/directive.js') }}"></script>
    <script src="{{ asset('assets/common/js/www/filter.js') }}"></script>
    <script src="{{ asset('assets/common/js/www/global.js') }}"></script>

    <!-- Angular Version Services -->
    <script src="{{ asset('assets/common/js/www/services/InterceptorAuthentication.js') }}"></script>
    <script src="{{ asset('assets/common/js/www/services/Authentication.js') }}"></script>
    <script src="{{ asset('assets/common/js/www/services/Session.js') }}"></script>
    <script src="{{ asset('assets/common/js/www/services/Promise.js') }}"></script>
    <script src="{{ asset('assets/common/js/www/services/Urls.js') }}"></script>
    <script src="{{ asset('assets/common/js/www/services/Notification.js') }}"></script>

    <!-- Angular Version Factories -->
    <script src="{{ asset('assets/common/js/www/factories/Role.js') }}"></script>
    <script src="{{ asset('assets/common/js/www/factories/User.js') }}"></script>
    <script src="{{ asset('assets/common/js/www/factories/FileManager.js') }}"></script>
    <script src="{{ asset('assets/common/js/www/factories/BlogTag.js') }}"></script>
    <script src="{{ asset('assets/common/js/www/factories/BlogCategory.js') }}"></script>
    <script src="{{ asset('assets/common/js/www/factories/Blog.js') }}"></script>
    <script src="{{ asset('assets/common/js/www/factories/ProductTag.js') }}"></script>
    <script src="{{ asset('assets/common/js/www/factories/ProductType.js') }}"></script>
    <script src="{{ asset('assets/common/js/www/factories/ProductGenre.js') }}"></script>
    <script src="{{ asset('assets/common/js/www/factories/Product.js') }}"></script>
    <script src="{{ asset('assets/common/js/www/factories/ImportData.js') }}"></script>

    <!-- Angular Version Controllers -->
    <script src="{{ asset('assets/common/js/www/controllers/ErrorController.js') }}"></script>
    <script src="{{ asset('assets/common/js/www/controllers/DashboardController.js') }}"></script>
    <script src="{{ asset('assets/common/js/www/controllers/LoginController.js') }}"></script>
    <script src="{{ asset('assets/common/js/www/controllers/LogoffController.js') }}"></script>
    <script src="{{ asset('assets/common/js/www/controllers/EmailController.js') }}"></script>
    <script src="{{ asset('assets/common/js/www/controllers/RoleController.js') }}"></script>
    <script src="{{ asset('assets/common/js/www/controllers/UserController.js') }}"></script>
    <script src="{{ asset('assets/common/js/www/controllers/BlogTagController.js') }}"></script>
    <script src="{{ asset('assets/common/js/www/controllers/BlogCategoryController.js') }}"></script>
    <script src="{{ asset('assets/common/js/www/controllers/BlogController.js') }}"></script>
    <script src="{{ asset('assets/common/js/www/controllers/ProductTagController.js') }}"></script>
    <script src="{{ asset('assets/common/js/www/controllers/ProductTypeController.js') }}"></script>
    <script src="{{ asset('assets/common/js/www/controllers/ProductGenreController.js') }}"></script>
    <script src="{{ asset('assets/common/js/www/controllers/ProductController.js') }}"></script>
    <script src="{{ asset('assets/common/js/www/controllers/ImportDataController.js') }}"></script>

    <!-- Clean UI Scripts -->
    <script src="{{ asset('/assets/common/js/common.js') }}"></script>
</head>
<style>
    .select2-container--open {
        z-index: 9999999;
    }

    .ui-select-multiple.ui-select-bootstrap {
        padding: 6px 10px;
    }
</style>
