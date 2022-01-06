<!-- Login Content -->
<script src="<?= base_url(''); ?>assets/superadmin/vendor/jquery/jquery.min.js"></script>
<script src="<?= base_url(''); ?>assets/superadmin/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="<?= base_url(''); ?>assets/superadmin/vendor/jquery-easing/jquery.easing.min.js"></script>
<script src="<?= base_url(''); ?>assets/superadmin/js/ruang-admin.min.js"></script>
<script src="<?= base_url('') ?>assets/superadmin/vendor/datatables/jquery.dataTables.min.js"></script>
<script src="<?= base_url('') ?>assets/superadmin/vendor/datatables/dataTables.bootstrap4.min.js"></script>

<!-- Page level custom scripts -->
<script>
    $(document).ready(function() {
        $('#dataTable').DataTable(); // ID From dataTable 
        $('#dataTableHover').DataTable(); // ID From dataTable with Hover
    });
</script>
</body>

</html>