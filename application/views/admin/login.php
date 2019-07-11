<?php $this->load->view('admin/partials/header'); ?>

<form method="POST" action="<?= base_url('admin/login'); ?>">

    <input type="text" name="identity" id="identity" /><br />
    <input type="password" name="password" id="password" /><br /><br />
    <input type="submit" value="Zaloguj się" />

</form>

<?php $this->load->view('admin/partials/footer'); ?>