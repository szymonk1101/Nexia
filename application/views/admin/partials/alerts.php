<?php if(isset($_SESSION['alert-primary']) || isset($alert_primary)): ?>
<div class="alert alert-primary fade show" role="alert"><?= isset($_SESSION['alert-primary']) ? $_SESSION['alert-primary'] : $alert_primary; ?></div>
<?php endif; ?>

<?php if(isset($_SESSION['alert-secondary']) || isset($alert_secondary)): ?>
<div class="alert alert-secondary fade show" role="alert"><?= isset($_SESSION['alert-secondary']) ? $_SESSION['alert-secondary'] : $alert_secondary; ?></div>
<?php endif; ?>

<?php if(isset($_SESSION['alert-success']) || isset($alert_success)): ?>
<div class="alert alert-success fade show" role="alert"><?= isset($_SESSION['alert-success']) ? $_SESSION['alert-success'] : $alert_success; ?></div>
<?php endif; ?>

<?php if(isset($_SESSION['alert-danger']) || isset($alert_danger)): ?>
<div class="alert alert-danger fade show" role="alert"><?= isset($_SESSION['alert-danger']) ? $_SESSION['alert-danger'] : $alert_danger; ?></div>
<?php endif; ?>

<?php if(isset($_SESSION['alert-warning']) || isset($alert_warning)): ?>
<div class="alert alert-warning fade show" role="alert"><?= isset($_SESSION['alert-warning']) ? $_SESSION['alert-warning'] : $alert_warning; ?></div>
<?php endif; ?>

<?php if(isset($_SESSION['alert-info']) || isset($alert_info)): ?>
<div class="alert alert-info fade show" role="alert"><?= isset($_SESSION['alert-info']) ? $_SESSION['alert-info'] : $alert_info; ?></div>
<?php endif; ?>

<?php if(isset($_SESSION['alert-light']) || isset($alert_light)): ?>
<div class="alert alert-light fade show" role="alert"><?= isset($_SESSION['alert-light']) ? $_SESSION['alert-light'] : $alert_light; ?></div>
<?php endif; ?>

<?php if(isset($_SESSION['alert-dark']) || isset($alert_dark)): ?>
<div class="alert alert-dark fade show" role="alert"><?= isset($_SESSION['alert-dark']) ? $_SESSION['alert-dark'] : $alert_dark; ?></div>
<?php endif; ?>