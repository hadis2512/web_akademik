<!-- Login Content -->
<script src="<?= base_url(''); ?>assets/superadmin/vendor/jquery/jquery.min.js"></script>
<script src="<?= base_url(''); ?>assets/superadmin/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="<?= base_url(''); ?>assets/superadmin/vendor/jquery-easing/jquery.easing.min.js"></script>
<script src="<?= base_url(''); ?>assets/superadmin/js/ruang-admin.min.js"></script>
<script src="<?= base_url('') ?>assets/superadmin/vendor/datatables/jquery.dataTables.min.js"></script>
<script src="<?= base_url('') ?>assets/superadmin/vendor/datatables/dataTables.bootstrap4.min.js"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>


<!-- Page level custom scripts -->
<script>
    $(document).ready(function() {
        $('#dataTable').DataTable(); // ID From dataTable 
        $('#dataTableHover').DataTable(); // ID From dataTable with Hover

        $("#login").click(() => {
            let username = $("#username").val();
            let password = $("#password").val();
            if (username != 0 && password != 0) {
                $.ajax({
                    type: 'POST',
                    url: `<?= base_url('superadmin/Login/LoginViaAjax/') ?>${username}/${password}`,
                    success: function(data) {
                        let parsed = JSON.parse(data);
                        if (parsed != null) {
                            swal({
                                title: "Login Berhasil!",
                                text: `Halo, ${username}`,
                                icon: "success",
                            }).then(() => {

                                window.location = `<?= base_url("superadmin/Login/berhasilLoginAjax/") ?>`;
                            })
                        } else {
                            swal({
                                title: "Username atau Password salah!",
                                icon: "error",
                            })
                        }
                    },
                })
            } else if (username == 0) {
                swal({
                    title: "Username Tidak Boleh Kosong",
                    icon: "error"
                })
            } else if (password == 0) {
                swal({
                    title: "Password Tidak Boleh Kosong",
                    icon: "error"
                })
            }
        })

    });
</script>
</body>

</html>