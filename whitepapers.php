<?php
require_once "api/classes/classes.inc";

$metaTITLE['fr'] = 'Whitepapers';
$metaTITLE['en'] = 'Whitepapers';
$bodyClass = 'whitepapers';

include 'includes/header.php';

?>

<link rel="stylesheet" href="angular/www/bower_components/sass-bootstrap/dist/css/bootstrap.css" />
<link rel="stylesheet" href="css/cyborg.css" />
<link rel="stylesheet" href="css/whitepapers.css" />

<script src="angular/www/bower_components/ng-file-upload-shim/angular-file-upload-shim.js"></script>
<script src="angular/www/bower_components/angular/angular.js"></script>
<script src="angular/www/bower_components/angular-resource/angular-resource.js"></script>
<script src="angular/www/bower_components/angular-cookies/angular-cookies.js"></script>
<script src="angular/www/bower_components/angular-sanitize/angular-sanitize.js"></script>
<script src="angular/www/bower_components/angular-route/angular-route.js"></script>
<script src="angular/www/bower_components/lodash/dist/lodash.compat.js"></script>
<script src="angular/www/bower_components/restangular/dist/restangular.js"></script>
<script src="angular/www/bower_components/angular-ui-router/release/angular-ui-router.js"></script>
<script src="angular/www/bower_components/angular-animate/angular-animate.js"></script>
<script src="angular/www/bower_components/angular-busy/dist/angular-busy.js"></script>
<script src="angular/www/bower_components/angular-bootstrap/ui-bootstrap-tpls.js"></script>
<script src="angular/www/bower_components/angular-xeditable/dist/js/xeditable.js"></script>
<script src="angular/www/bower_components/gsap/src/uncompressed/TweenMax.js"></script>
<script src="angular/www/bower_components/ng-Fx/dist/ng-Fx.js"></script>
<script src="angular/www/bower_components/angular-confirm-click/dist/confirmClick.js"></script>
<script src="angular/www/bower_components/angular-class/angular-class.js"></script>
<script src="angular/www/bower_components/angular-bindonce/bindonce.js"></script>
<script src="angular/www/bower_components/angular-webstorage/angular-webstorage.js"></script>
<script src="angular/www/bower_components/angular-cache/dist/angular-cache.min.js"></script>
<script src="angular/www/bower_components/textAngular/dist/textAngular.min.js"></script>
<script src="angular/www/bower_components/ngInfiniteScroll/build/ng-infinite-scroll.js"></script>
<script src="angular/www/bower_components/ng-file-upload/angular-file-upload.js"></script>
<script src="angular/www/bower_components/angular-ui-bootstrap-bower/ui-bootstrap-tpls.js"></script>
<script src="angular/www/bower_components/bootstrap-css/js/bootstrap.min.js"></script>
<script src="angular/www/bower_components/bootstrap-tagsinput/dist/bootstrap-tagsinput.min.js"></script>
<!-- endbower -->
<script src="angular/www/bower_components/bootstrap-tagsinput/dist/bootstrap-tagsinput-angular.js"></script>
<script src="angular/www/bower_components/bootstrap-file-input/bootstrap.file-input.js"></script>
<script src="angular/www/bower_components/sass-bootstrap/js/dropdown.js"></script>

<div ng-app="leLabApp" ng-controller="WhitepapersCtrl" class="whitepapers">

	<div ui-view="main" autoscroll="false"></div>

</div>

<script src="js/app.js"></script>

<script src="angular/www/scripts/config/config.js"></script>

<script src="angular/www/scripts/filters/filters.js"></script>

<script src="angular/www/scripts/services/tags.js"></script>
<script src="angular/www/scripts/services/credits.js"></script>
<script src="angular/www/scripts/services/dashboard.js"></script>
<script src="angular/www/scripts/services/engineers.js"></script>
<script src="angular/www/scripts/services/genres.js"></script>
<script src="angular/www/scripts/services/images.js"></script>
<script src="angular/www/scripts/services/whitepapers.js"></script>
<script src="angular/www/scripts/services/user.js"></script>
<script src="angular/www/scripts/services/session.js"></script>

<script src="js/whitepapers.js"></script>

<?php
include 'includes/footer.php';
?>