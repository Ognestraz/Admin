        </div>
        <!-- /#wrapper -->
        
        <script>
            var BASE_HREF = "<?=URL::to('/')?>";
            var BASE_HREF_ADMIN = "<?=URL::to('/')?>/admin";
            var controllerSettings = {};
            window.FileAPI = {
                debug: false,
                staticPath: '<?=URL::to('/')?>/assets/js/FileAPI/' 
            };			
        </script>        
        <script src='<?=elixir("js/admin-sb2.js");?>'></script>
        <script src="//tinymce.cachefly.net/4.1/tinymce.min.js"></script>
        <script src='<?=elixir("js/admin.js");?>'></script>
    </body>
</html>