<script src="<?= base_url('') ?>assets/superadmin/vendor/jquery/jquery.min.js"></script>
<script src="<?= base_url('') ?>assets/superadmin/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="<?= base_url('') ?>assets/superadmin/vendor/jquery-easing/jquery.easing.min.js"></script>
<script src="<?= base_url('') ?>assets/superadmin/js/ruang-admin.min.js"></script>
<script src="<?= base_url('') ?>assets/superadmin/vendor/chart.js/Chart.min.js"></script>
<script src="<?= base_url('') ?>assets/superadmin/js/demo/chart-area-demo.js"></script>
<script src="<?= base_url('') ?>assets/superadmin/vendor/datatables/jquery.dataTables.min.js"></script>
<script src="<?= base_url('') ?>assets/superadmin/vendor/datatables/dataTables.bootstrap4.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
<!-- Page level custom scripts -->



<script>
    $(document).ready(function() {
        flatpickr("#tgl", {

        });
        $('#dataTable').DataTable(); // ID From dataTable 
        $('#dataTableHover').DataTable(); // ID From dataTable with Hover

    });
</script>
</body>


</html>