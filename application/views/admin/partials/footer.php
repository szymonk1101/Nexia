
    <script src="http://maps.google.com/maps/api/js?sensor=true"></script>
    <script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
    <script type="text/javascript" src="<?= base_url('web/admin/plugins/toastr.min.js'); ?>"></script>
    <script type="text/javascript" src="<?= base_url('web/admin/plugins/push.min.js'); ?>"></script>
    <script type="text/javascript" src="<?= base_url('web/admin/plugins/serviceWorker.min.js'); ?>"></script>
    <script type="text/javascript" src="<?= base_url('web/admin/scripts/notifications.js'); ?>"></script>
    <script type="text/javascript" src="<?= base_url('web/admin/scripts/main.js'); ?>"></script>
    <script type="text/javascript">

        var USER_ID = <?= get_instance()->getUserId(); ?>;

        $(function() {

            initNotifications({
                get_url: '<?= base_url('admin/api/notifications/getActiveUserNotificationsForNow'); ?>',
                displayed_url: '<?= base_url('admin/api/notifications/setDisplayed'); ?>'
            });

        });

        Push.config({
            serviceWorker: '<?= base_url('web/admin/plugins/serviceWorker.min.js'); ?>', // Sets a custom service worker script
            fallback: function(payload) {
                // Code that executes on browsers with no notification support
                // "payload" is an object containing the 
                // title, body, tag, and icon of the notification 
            }
        });


        Push.create("Hello world!", {
            body: "How's it hangin'?"
            //link: '#',
            //icon: '',
            //timeout: 4000,
        });


    </script>
</body>
</html>