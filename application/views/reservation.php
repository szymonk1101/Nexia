<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="utf8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta http-equiv="Content-Language" content="pl" />
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Nexia - Zarezerwuj usługę</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no, shrink-to-fit=no" />
    <meta name="description" content="This is an example dashboard created using build-in elements and components." />
    <meta name="msapplication-tap-highlight" content="no" />
    <!--
    =========================================================
    * ArchitectUI HTML Theme Dashboard - v1.0.0
    =========================================================
    * Product Page: https://dashboardpack.com
    * Copyright 2019 DashboardPack (https://dashboardpack.com)
    * Licensed under MIT (https://github.com/DashboardPack/architectui-html-theme-free/blob/master/LICENSE)
    =========================================================
    * The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software.
    -->
    <link href="<?= base_url('web/admin/main.css'); ?>" rel="stylesheet"></head>
</head>
<body>

    <div class="container">

        <div class="row">
            <div class="col-sm-12">
                Wybierz usługę:
                <select class="form-control">
                    <?php foreach($services as $s): ?>
                    <option value="<?= $s->id; ?>"><?= $s->name; ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
        </div>

        <div class="row">
            <div class="col-sm-12">
                Wybierz osobę:
                <select class="form-control">

                </select>
            </div>
        </div>

        <div class="row">
            <div class="col-sm-6">
                Wybierz dzień:
                
            </div>

            <div class="col-sm-6">
                Wybierz godzinę:
                
            </div>
        </div>

    </div>

    <script src="http://maps.google.com/maps/api/js?sensor=true"></script>
    <script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
</body>
</html>