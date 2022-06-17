<script src="<?= base_url('') ?>assets/superadmin/vendor/jquery/jquery.min.js"></script>
<script src="<?= base_url('') ?>assets/superadmin/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="<?= base_url('') ?>assets/superadmin/vendor/jquery-easing/jquery.easing.min.js"></script>
<script src="<?= base_url('') ?>assets/superadmin/js/ruang-admin.min.js"></script>
<script src="<?= base_url('') ?>assets/superadmin/vendor/chart.js/Chart.min.js"></script>
<script src="<?= base_url('') ?>assets/superadmin/js/demo/chart-area-demo.js"></script>
<script src="<?= base_url('') ?>assets/superadmin/vendor/datatables/jquery.dataTables.min.js"></script>
<script src="<?= base_url('') ?>assets/superadmin/vendor/datatables/dataTables.bootstrap4.min.js"></script>
<script src="<?= base_url('') ?>assets/superadmin/js/bcPaint.js"></script>
<script src="<?php echo base_url() . 'assets/superadmin/js/lightgallery-all.min.js' ?>"></script>
<script src="https://cdn.jsdelivr.net/picturefill/2.3.1/picturefill.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>



<!-- Page level custom scripts -->
<script>
    $(document).ready(function() {

        // $("#form_add_data").on('submit', () => {
        //     $.ajax({
        //         type: 'POST',
        //         url: `<?= base_url("superadmin/master_data/save_mahasiswa") ?>`,
        //         data: $(this).serialize(),
        //         success: (data) => {
        //             let data1 = json.parse(data)
        //             console.log(data1)
        //             swal({
        //                 title: `halo ${data1.nama_lengkap}`,
        //                 icon: "success"
        //             })
        //         }
        //     });
        // })


        $('input[name="program"]').on('change', () => {
            let id = $('input[name="program"]:checked').val();
            $.ajax({
                type: 'POST',
                url: `<?= base_url('superadmin/Master_data/get_prodi/') ?>${id}`,
                success: function(data) {
                    let parsed = JSON.parse(data);
                    $("#select_prodi").html(parsed);
                }
            });
        });

        $('input[name="jenis_permohonan"]').on('change', () => {
            let id_permohonan = $('input[name="jenis_permohonan"]:checked').val();
            $("p").append(" <strong>Appended text Example</strong>.");
        });


        $("#exampleModalCenter").modal("show");

        flatpickr("#tgl", {

        });
        // $('#dataTable').DataTable(); // ID From dataTable 
        $('#dataTableHover').DataTable({

        }); // ID From dataTable with Hover

        $('#home-tab').click(() => {

        })
        // $(".lightgallery").lightGallery();        
        $('#bcPaint').bcPaint();

        $(document).bind("contextMenu", function(e) {
            e.preventDefault();
        });

        $(document).keydown(function(e) {
            if (e.which === 123) {
                return false;
            }
        });

        $("[data-toggle='modal']").on("contextmenu", function(e) {
            e.preventDefault();
        })

        $('#upload_foto').change((e) => {
            var input = $(e.currentTarget);
            var file = input[0].files[0];
            // console.log(file);
            if (file) {
                let reader = new FileReader();
                reader.onload = function(event) {
                    $('.poto_add').attr('src', event.target.result);
                }
                reader.readAsDataURL(file);
            }
        });


        $("#logoutModal").on("show.bs.modal", (e) => {
            let nama = `<?= $this->session->userdata('nama'); ?>`
            $("#logout").click(() => {

                $("#logoutModal").modal("hide");
                swal({
                    title: "Anda Berhasil Logout!!",
                    text: `Sampai Berjumpa Kembali ${nama}!!`,
                    icon: "success",
                }).then(() => {
                    window.location = `<?= base_url('superadmin/Login/logout'); ?>`;
                })
            })
        })

        $("#btn_poto_ttd").change((e) => {
            var input = $(e.currentTarget);
            var file = input[0].files[0];
            if (file) {
                let reader = new FileReader();
                let file_nama = file.name;
                let name_file = file_nama.substr(0, 22)
                reader.onload = function(event) {
                    $('.poto_ttd').attr('src', event.target.result);
                    $(".nama_poto").html(name_file)
                }
                reader.readAsDataURL(file);
            }
        })

    });
</script>
</body>


</html>