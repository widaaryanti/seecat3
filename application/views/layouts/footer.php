<?php if($this->uri->segment('1') == "admin"):?>
<footer class="main-footer">
    <div class="text-center">
        Copyright &copy;
        <?= date("Y");?>
        <div class="bullet"></div>
        Create By UBSI Tasikmalaya
    </div>
</footer>
<?php endif;?>
</div>
</div>

<!-- General JS Scripts -->
<script src="<?= base_url(); ?>assets/admin/modules/jquery.min.js"></script>
<script src="<?= base_url(); ?>assets/admin/modules/popper.js"></script>
<script src="<?= base_url(); ?>assets/admin/modules/tooltip.js"></script>
<script src="<?= base_url(); ?>assets/admin/modules/bootstrap/js/bootstrap.min.js"></script>
<script src="<?= base_url(); ?>assets/admin/modules/nicescroll/jquery.nicescroll.min.js"></script>
<script src="<?= base_url(); ?>assets/admin/modules/moment.min.js"></script>
<script src="<?= base_url(); ?>assets/admin/js/stisla.js"></script>

<!-- JS Libraies -->
<!-- JS Libraies -->
<script src="<?= base_url(); ?>assets/admin/modules/summernote/summernote-bs4.js"></script>
<script src="<?= base_url(); ?>assets/admin/modules/datatables/datatables.min.js"></script>
<script src="<?= base_url(); ?>assets/admin/modules/datatables/DataTables-1.10.16/js/dataTables.bootstrap4.min.js">
</script>
<script src="<?= base_url(); ?>assets/admin/modules/datatables/Select-1.2.4/js/dataTables.select.min.js"></script>
<script src="<?= base_url(); ?>assets/admin/modules/jquery-ui/jquery-ui.min.js"></script>

<!-- Page Specific JS File -->
<script src="<?= base_url(); ?>assets/admin/js/page/modules-datatables.js"></script>

<!-- Template JS File -->
<script src="<?= base_url(); ?>assets/admin/js/scripts.js"></script>
<script src="<?= base_url(); ?>assets/admin/js/custom.js"></script>
</body>

</html>