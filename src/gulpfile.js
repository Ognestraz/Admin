var elixir = require('laravel-elixir');

elixir(function(mix) {
    mix
    .scripts([
        //"lib/bootstrap.js",
        "lib/jquery/jquery.form.js",
        "lib/jquery/jquery-ui.min.js",
        "lib/jquery/jquery.cookie.js",
        "lib/jquery/tree.jquery.js",
        "lib/jquery/jquery.validate.js",
        "lib/FileAPI/FileAPI.min.js",
        "lib/FileAPI/FileAPI.exif.js",
        "lib/jquery/jquery.fileapi.min.js",
        "lib/jquery/jquery.prettyloader.js",
        "lib/jquery/jquery.jcrop.min.js",
        //"lib/tinymce.min.js",
        "app/init.js",
        "app/crop.js",
        "app.js",
        "app/controller/file.js",
        "app/controller/video.js",
        "app/actions.js"
    ], 'public/js/admin.js')
    .scripts([
        "bower_components/jquery/dist/jquery.min.js",
        "bower_components/bootstrap/dist/js/bootstrap.min.js",
        "bower_components/metisMenu/dist/metisMenu.min.js",
        "bower_components/raphael/raphael-min.js",
        "bower_components/morrisjs/morris.min.js",
        "bower_components/datatables/media/js/jquery.dataTables.min.js",
        "bower_components/datatables-plugins/integration/bootstrap/3/dataTables.bootstrap.min.js",
        "bower_components/jquery-prettyPhoto/js/jquery.prettyPhoto.js",
        "js/morris-data.js",
        "dist/js/sb-admin-2.js"
    ], 'public/js/admin-sb2.js', 'resources/assets/sb-admin-2');
});

elixir(function(mix) {
    mix.less('app/image.icon-list.less', 'resources/assets/css/admin/app/image.icon-list.css');
});

elixir(function(mix) {
    mix.styles([
        //"admin/bootstrap.css",
        "bootstrap-theme.css",
        "ui-lightness/jquery-ui-1.10.3.custom.min.css",
        "prettyloader.css",
        "jquery.jcrop.css",
        "main.css",
        "app/image.icon-list.css",
        "jqtree.css"
    ], 'public/css/admin.css')
    .styles([
        "bower_components/bootstrap/dist/css/bootstrap.min.css"
    ], 'public/css/bootstrap.css', 'resources/assets/sb-admin-2')
    .styles([
        "bower_components/bootstrap/dist/css/bootstrap.min.css",
        "bower_components/metisMenu/dist/metisMenu.min.css",
        "bower_components/jquery-prettyPhoto/css/prettyPhoto.css",
        "dist/css/timeline.css",
        "dist/css/sb-admin-2.css",
        "bower_components/morrisjs/morris.css",
        "bower_components/font-awesome/css/font-awesome.min.css"
    ], 'public/css/admin-sb2.css', 'resources/assets/sb-admin-2');
});

elixir(function(mix) {
    mix.copy("resources/assets/sb-admin-2/bower_components/font-awesome/fonts", "public/build/fonts")
        .copy("resources/assets/sb-admin-2/bower_components/jquery-prettyPhoto/images/prettyPhoto/default", "public/build/images/prettyPhoto/default");
});

