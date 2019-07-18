
    <script src="http://maps.google.com/maps/api/js?sensor=true"></script>
    <script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
    <script type="text/javascript" src="<?= base_url('web/admin/plugins/toastr.min.js'); ?>"></script>
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
    </script>
</body>
</html>