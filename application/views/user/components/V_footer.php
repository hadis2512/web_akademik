<!-- Jquery Core Js -->
<script src="<?= base_url() ?>assets/user/vendors/js/vendor.bundle.base.js"></script>
<!-- endinject -->
<!-- Plugin js for this page -->
<!-- End plugin js for this page -->
<!-- inject:js -->
<script src="<?= base_url() ?>assets/user/js/off-canvas.js"></script>
<script src="<?= base_url() ?>assets/user/js/hoverable-collapse.js"></script>
<script src="<?= base_url() ?>assets/user/js/template.js"></script>
<script src="<?= base_url() ?>assets/user/js/settings.js"></script>
<script src="<?= base_url() ?>assets/user/js/todolist.js"></script>
<script src="<?= base_url() ?>assets/user/js/dashboard.js"></script>
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.3/moment-with-locales.min.js" integrity="sha512-vFABRuf5oGUaztndx4KoAEUVQnOvAIFs59y4tO0DILGWhQiFnFHiR+ZJfxLDyJlXgeut9Z07Svuvm+1Jv89w5g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script>
    $(document).ready(() => {

        // formulir
        let id_pengguna = $('#formulirM').data('pengguna');
        $.ajax({
            type: 'POST',
            url: `<?= base_url('user/User/get_data_form/') ?>${id_pengguna}`,
            success: function(data) {
                // console.log(data)
                let dataP = JSON.parse(data);
                let html = "";
                console.log(dataP)
                if (dataP.length < 4) {
                    $("#loadmore").addClass('d-none');
                }

                const dataCard = (indexStart, indexEnd) => {
                    const dataSliced = dataP.slice(indexStart, indexEnd);
                    dataSliced.forEach((res, index) => {
                        if (res.approval == 0 && res.approval_admin == 0) {
                            var status = '<div class="badge badge-success align-self-start">Terkirim</div>';
                        } else if (res.approval == 0 && res.approval_admin == 1) {
                            var status = '<div class="badge badge-success align-self-start"><i class="fas fa-check mr-2"></i>Admin</div>';
                        } else if (res.approval == 0 && res.approval_admin == 2) {
                            var status = '<div class="badge badge-danger align-self-start">Duplikasi</div>';
                        } else if (res.approval == 1 && res.approval_admin == 1 && res.status_surat == 0) {
                            var status = '<div class="badge badge-success align-self-start"><i class="fas fa-check mr-2"></i>Kaprodi</div>';
                        } else if (res.approval == 1 && res.approval_admin == 1) {
                            var status = '<div class="badge badge-success align-self-start"><i class="fas fa-check mr-2"></i>Surat</div>';
                        } else if (res.approval == 2 && res.approval_admin == 1) {
                            var status = '<div class="badge badge-success align-self-start">Ditolak Kaprodi</div>';
                        }

                        // let date = new Date(res.created_at).getTime();
                        // let dateNow = new Date().getTime();
                        // let dateBaru = new Date(dateNow - date);
                        var a = moment(res.created_at)
                        var b = moment()
                        // console.log(b.diff(a, "days"))
                        // console.log(moment(res.created_at).fromNow())
                        // console.log(new Date().getDate())
                        // console.log(new Date(res.created_at).getDate())
                        let totDate = b.diff(a, "days") + " hari yang lalu";
                        // let totDate = date.getDate(dateNow) + " hari yang lalu";
                        html += `
              <div class = "col-md-4 mb-2 stretch-card transparent" >
              <div class = "card card-light-blue">
              <div class = "card-header d-flex justify-content-between">
              <p class = "mb-0" > ${res.no_form} </p>${status}
              </div> 
              <div class = "card-body" >
              <h4 class = "mb-2" >${res.jenis_permohonan} </h4> 
              </div> 
              <div class = "card-footer d-flex justify-content-between" >
              <p class = "mb-0" >${totDate}</p>
              <a href="#" id="modal_detail" data-toggle="modal" data-target="#modalDetail_form" name="" data-jenis="${res.id_jenis_permohonan}" data-formulir="${res.id_formulir}" class="test font-weight-bold text-light float-right">details<i class="ml-2 icon-arrow-right"></i>
              </a>
              </div>
              </div>
              </div>
              </div>`;


                        // $now = date('d F y');
                        // $tgl_lapor = date('d F y  ', strtotime($a['created_at']));
                        // $datediff = $User->dateDifference($tgl_lapor, $now);
                        // echo $datediff . ' hari yang lalu';
                    });
                    $('#formulirM').html(html);
                };

                let idx = 0;
                let idxEnd = 3;

                dataCard(idx, idxEnd);

                $('#loadmore').on('click', () => {
                    html = '';
                    dataCard(idx, idxEnd += 3);

                    if (idxEnd >= dataP.length) {
                        $('#loadmore').addClass('d-none');
                    }
                })
            }
        })

        $('#modalDetail_form').on('show.bs.modal', function(event) {
            // console.log(event)
            var div = $(event.relatedTarget) // Tombol dimana modal di tampilkan
            var modal = $(this)
            $('html').css('overflow-y', 'hidden')
            let id_formulir = div.data('formulir')
            let jenis_permohonan = div.data('jenis')
            // alert(jenis_permohonan)
            if (jenis_permohonan == 1) {
                $.ajax({
                    type: 'POST',
                    url: `<?= base_url('user/User/get_detail_form/') ?>${id_formulir}/${jenis_permohonan}`,
                    success: function(data) {
                        let parsed2 = JSON.parse(data);
                        let data1 = parsed2;
                        let html = "";
                        console.log(data1)
                        data1.forEach((res, index) => {
                            if (res.approval == 0 && res.approval_admin == 0) {
                                var status = '<div class="badge badge-success align-self-start">Terkirim</div>';
                                var log =
                                    '<div class="w-100 badge badge-success">Formulir sudah terkirim ke <b>Admin</b>, silahkan tunggu!</div>';
                                // if (res.approval_admin == 1 ) {
                                //   res.approval = '<div class="badge badge-success">Validasi Admin</div>';
                                // } else if (res.approval_admin == 2) {
                                //   res.approval = '<div class="badge badge-danger">Duplikat</div>';
                                // }
                            } else if (res.approval == 0 && res.approval_admin == 1) {
                                var status = '<div class="badge badge-success align-self-start">Disetujui Admin</div>';
                                var log =
                                    '<div class="w-100 badge badge-success">Formulir sudah di approve oleh <b>Admin</b>, formulir sudah terkirim ke <b>Dosen</b>, silahkan tunggu!</div>';
                            } else if (res.approval == 0 && res.approval_admin == 2) {
                                var status = '<div class="badge badge-danger align-self-start">Duplikasi</div>';
                                var log =
                                    '<div class="w-100 badge badge-danger">Formulir di tolak oleh <b>Admin</b>!</div>';
                            } else if (res.approval == 1 && res.approval_admin == 1 && res.status_surat == 0) {
                                var status = '<div class="badge badge-success align-self-start">Disetujui Kaprodi</div>';
                                var log =
                                    '<div class="w-100 badge badge-success">Formulir sudah di approve oleh <b>Admin dan Kaprodi</b>, silahkan tunggu untuk pembuatan suratnya!</div>';
                            } else if (res.approval == 1 && res.approval_admin == 1 && res.status_surat == 1) {
                                var status = '<div class="badge badge-success align-self-start">Surat Sudah Siap</div>';
                                var log =
                                    '<div class="w-100 badge badge-success">Surat sudah siap!</div>';
                            } else if (res.approval == 2 && res.approval_admin == 1) {
                                var status = '<div class="badge badge-success align-self-start">Ditolak Kaprodi</div>';
                                var log =
                                    '<div class="w-100 badge badge-danger">Formulir di tolak oleh <b>Dosen</b>!</div>';
                            }

                            // if (res.approval_admin == 0) {
                            //   var log =
                            //     '<div class="w-100 badge badge-success">Formulir sudah terkirim ke <b>Admin</b>, silahkan tunggu!</div>';
                            // } else if (res.approval_admin == 1 && res.approval == 0) {
                            //   var log =
                            //     '<div class="w-100 badge badge-success">Formulir sudah di approve oleh <b>Admin</b>, formulir sudah terkirim ke <b>Dosen</b>, silahkan tunggu!</div>';
                            // } else if (res.approval_admin == 1 && res.approval == 1 &&
                            //   res.status_surat == 0) {
                            //   var log =
                            //     '<div class="w-100 badge badge-success">Formulir sudah di approve oleh <b>Admin/Dosen</b>, silahkan tunggu untuk pembuatan suratnya!</div>';
                            // } else if (res.approval_admin == 1 && res.approval == 2) {
                            //   var log =
                            //     '<div class="w-100 badge badge-danger">Formulir di tolak oleh <b>Dosen</b>!</div>';
                            // } else if (res.approval_admin == 2) {
                            //   var log =
                            //     '<div class="w-100 badge badge-danger">Formulir di tolak oleh <b>Admin</b>!</div>';
                            // } else if (res.approval_admin == 1 && res.approval == 1 &&
                            //   res.status_surat == 1) {
                            //   var log =
                            //     `<a href="<?= base_url('user/User/cetak/') ?>${res.id_jenis_permohonan}/${res.id_formulir}" class="btn btn-info mx-auto"><i class="fa-solid fa-print mr-2"></i>Cetak Surat</a>`;
                            // }

                            let months = ["January", "February", "March", "April",
                                "May", "June", "July", "August", "September",
                                "October", "November", "December"
                            ];
                            let date = new Date(res.tgl_lahir);
                            let tanggal_lahir =
                                `${date.getDate()}-${months[date.getMonth()]}-${date.getFullYear()}`;
                            html += `<div class="modal-header">
                                            <div class="d-flex justify-content-around">
                                                <h5 class="modal-title mr-2" id="exampleModalLabel">${res.no_form} </h5>
                                                ${status}
                                            </div>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body row">  
                                              <form class="forms-sample col-lg-12" >                                                                                  
                                              <div id="accordion">
                                                    <p id="akordion" class="akordion-child mb-3 " style="cursor:pointer;" data-toggle="collapse" data-target="#collapseIji" aria-expanded="true" aria-controls="collapseOne">
                                                      <b>Data Mahasiswa</b> <i  class="ti-angle-right ml-2" ></i>
                                                    </p>
                                                  <div id="collapseIji" class="collapse" aria-labelledby="headingOne" data-parent="#accordion">
                                                    <div class="form-group row">
                                                        <div class="col-lg-6">
                                                          <label for="exampleInputUsername1">NIM</label>
                                                          <input type="text" class="form-control" id="exampleInputUsername1" placeholder="Username" value="${res.nim}" readonly>
                                                        </div>
                                                        <div class="col-lg-6">
                                                          <label for="exampleInputUsername1" class="">Nama</label>
                                                          <input type="text" class="form-control " id="exampleInputUsername1" placeholder="Username" value="${res.nama_lengkap}" readonly>
                                                        </div>                                        
                                                    </div> 
                                                    <div class="form-group row">
                                                        <div class="col-lg-6">
                                                          <label for="exampleInputUsername1">Program</label>
                                                          <input type="text" class="form-control" id="exampleInputUsername1" placeholder="Username" value="${res.nama_program}" readonly>
                                                        </div>
                                                        <div class="col-lg-6">
                                                          <label for="exampleInputUsername1" class="">Program Studi</label>
                                                          <input type="text" class="form-control " id="exampleInputUsername1" placeholder="Username" value="${res.nama_prodi}" readonly>
                                                        </div>                                        
                                                    </div> 
                                                    <div class="form-group row">
                                                        <div class="col-lg-6">
                                                          <label for="tempat">Tempat</label>                                                
                                                          <input type="text" class="form-control" id="tempat" placeholder="Tempat" value="${res.tempat}" readonly>                                                    
                                                        </div>
                                                        <div class="col-lg-6">
                                                          <label for="tgl">Tanggal Lahir</label>                                                
                                                          <input type="text" class="form-control" id="tgl" placeholder="tgl_lahir" value="${tanggal_lahir}" readonly>
                                                        </div>                                        
                                                    </div> 
                                                    <div class="form-group row">
                                                        <div class="col-lg-6">
                                                          <label for="exampleInputUsername1">Alamat</label>
                                                          <input type="text" class="form-control" id="exampleInputUsername1" placeholder="Username" value="${res.alamat}" readonly>
                                                        </div>
                                                        <div class="col-lg-6">
                                                          <label for="exampleInputUsername1" class="">No Telepon</label>
                                                          <input type="text" class="form-control " id="exampleInputUsername1" placeholder="Username" value="${res.no_telp}" readonly>
                                                        </div>                                        
                                                    </div> 
                                                    
                                                    </div>
                                                    </div>
                                                    <div class="form-group row mt-2">
                                                        <div class="col-lg-6">
                                                          <label for="exampleInputUsername1">Jenis Permohonan</label>
                                                          <input type="text" class="form-control" id="exampleInputUsername1" placeholder="Username" value="${res.jenis_permohonan}">
                                                        </div>
                                                        <div class="col-lg-6">
                                                          <label for="exampleInputUsername1" class="">Jenis Tugas</label>
                                                          <input type="text" class="form-control " id="exampleInputUsername1" placeholder="Username" value="${res.jenis_tugas}" >
                                                        </div>                                        
                                                    </div> 
                                                    <div class="form-group row">
                                                        <div class="col-lg-12">
                                                          <label for="exampleInputUsername1">Judul Tugas</label>
                                                          <input type="text" class="form-control" id="exampleInputUsername1" placeholder="Username" value="${res.judul_tugas}" >
                                                        </div>                                                    
                                                    </div>   
                                                    <div class="form-group row">
                                                        <div class="col-lg-6">
                                                          <label for="exampleInputUsername1">Nama Perusahaan</label>
                                                          <input type="text" class="form-control" id="exampleInputUsername1" placeholder="Username" value="${res.nama_perusahaan}">
                                                        </div>
                                                        <div class="col-lg-6">
                                                          <label for="exampleInputUsername1" class="">Alamat Surat</label>
                                                          <input type="text" class="form-control " id="exampleInputUsername1" placeholder="Username" value="${res.alamat_surat}" >
                                                        </div>                                        
                                                    </div> 
                                                    <div class="form-group row">
                                                        <div class="col-lg-6">
                                                          <label for="exampleInputUsername1">Perwakilan Perusahaan</label>
                                                          <input type="text" class="form-control" id="exampleInputUsername1" placeholder="Username" value="${res.perwakilan_perusahaan}" >
                                                        </div>                                                    
                                                        <div class="col-lg-6">
                                                          <label for="exampleInputUsername1">Jabatan Perwakilan</label>
                                                          <input type="text" class="form-control" id="exampleInputUsername1" placeholder="Username" value="${res.jabatan_perwakilan}" >
                                                        </div>                                                    
                                                    </div>                                                                                                 
                                                    <div class="form-group row">
                                                        <div class="col-lg-12">
                                                          <label for="exampleInputUsername1">Telp Perusahaan</label>
                                                          <input type="text" class="form-control" id="exampleInputUsername1" placeholder="Username" value="${res.no_telp_perusahaan}" >
                                                        </div>                                                    
                                                    </div>                                                                                              
                                              </form>

                                            </div>
                                            <div class="modal-footer">
                                                ${log }
                                            </div>`
                            $('#data_modal').html(html);
                        })
                    },
                    error: function(error) {
                        console.log(error);
                    }
                });
            } else if (jenis_permohonan == 2) {
                $.ajax({
                    type: 'POST',
                    url: `<?= base_url('user/User/get_detail_form/') ?>${id_formulir}/${jenis_permohonan}`,
                    success: function(data) {
                        let parsed2 = JSON.parse(data);
                        let data2 = [parsed2];
                        console.log(data2)
                        let html = "";
                        data2.forEach((res, index) => {
                            if (res.approval == 0 && res.approval_admin == 0) {
                                var status = '<div class="badge badge-success align-self-start">Terkirim</div>';
                                var log =
                                    '<div class="w-100 badge badge-success">Formulir sudah terkirim ke <b>Admin</b>, silahkan tunggu!</div>';
                                // if (res.approval_admin == 1 ) {
                                //   res.approval = '<div class="badge badge-success">Validasi Admin</div>';
                                // } else if (res.approval_admin == 2) {
                                //   res.approval = '<div class="badge badge-danger">Duplikat</div>';
                                // }
                            } else if (res.approval == 0 && res.approval_admin == 1) {
                                var status = '<div class="badge badge-success align-self-start">Disetujui Admin</div>';
                                var log =
                                    '<div class="w-100 badge badge-success">Formulir sudah di approve oleh <b>Admin</b>, formulir sudah terkirim ke <b>Dosen</b>, silahkan tunggu!</div>';
                            } else if (res.approval == 0 && res.approval_admin == 2) {
                                var status = '<div class="badge badge-danger align-self-start">Duplikasi</div>';
                                var log =
                                    '<div class="w-100 badge badge-danger">Formulir di tolak oleh <b>Admin</b>!</div>';
                            } else if (res.approval == 1 && res.approval_admin == 1 && res.status_surat == 0) {
                                var status = '<div class="badge badge-success align-self-start">Disetujui Kaprodi</div>';
                                var log =
                                    '<div class="w-100 badge badge-success">Formulir sudah di approve oleh <b>Admin dan Kaprodi</b>, silahkan tunggu untuk pembuatan suratnya!</div>';
                            } else if (res.approval == 1 && res.approval_admin == 1 && res.status_surat == 1) {
                                var status = '<div class="badge badge-success align-self-start">Surat Sudah Siap</div>';
                                var log =
                                    '<div class="w-100 badge badge-success">Surat sudah siap!</div>';
                            } else if (res.approval == 2 && res.approval_admin == 1) {
                                var status = '<div class="badge badge-success align-self-start">Ditolak Kaprodi</div>';
                                var log =
                                    '<div class="w-100 badge badge-danger">Formulir di tolak oleh <b>Dosen</b>!</div>';
                            }
                            let months = ["January", "February", "March", "April",
                                "May", "June", "July", "August", "September",
                                "October", "November", "December"
                            ];
                            let date = new Date(res.tgl_lahir);
                            let tanggal_lahir =
                                `${date.getDate()}-${months[date.getMonth()]}-${date.getFullYear()}`;
                            html += `<div class="modal-header">
                                            <div class="d-flex justify-content-around">
                                                <h5 class="modal-title mr-2" id="exampleModalLabel">${res.no_form} </h5>
                                                ${status}
                                            </div>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body row">  
                                              <form class="forms-sample col-lg-12" >       
                                              <div id="accordion">
                                                    <p id="akordion" class="akordion-child mb-3 " style="cursor:pointer;" data-toggle="collapse" data-target="#collapseIji" aria-expanded="true" aria-controls="collapseOne">
                                                      <b>Data Mahasiswa</b> <i  class="ti-angle-right ml-2" ></i>
                                                    </p>
                                                  <div id="collapseIji" class="collapse" aria-labelledby="headingOne" data-parent="#accordion">
                                                    <div class="form-group row">
                                                        <div class="col-lg-6">
                                                          <label for="exampleInputUsername1">NIM</label>
                                                          <input type="text" class="form-control" id="exampleInputUsername1" placeholder="Username" value="${res.nim}" readonly>
                                                        </div>
                                                        <div class="col-lg-6">
                                                          <label for="exampleInputUsername1" class="">Nama</label>
                                                          <input type="text" class="form-control " id="exampleInputUsername1" placeholder="Username" value="${res.nama_lengkap}" readonly>
                                                        </div>                                        
                                                    </div> 
                                                    <div class="form-group row">
                                                        <div class="col-lg-6">
                                                          <label for="exampleInputUsername1">Program</label>
                                                          <input type="text" class="form-control" id="exampleInputUsername1" placeholder="Username" value="${res.nama_program}" readonly>
                                                        </div>
                                                        <div class="col-lg-6">
                                                          <label for="exampleInputUsername1" class="">Program Studi</label>
                                                          <input type="text" class="form-control " id="exampleInputUsername1" placeholder="Username" value="${res.nama_prodi}" readonly>
                                                        </div>                                        
                                                    </div> 
                                                    <div class="form-group row">
                                                        <div class="col-lg-6">
                                                          <label for="tempat">Tempat</label>                                                
                                                          <input type="text" class="form-control" id="tempat" placeholder="Tempat" value="${res.tempat}" readonly>                                                    
                                                        </div>
                                                        <div class="col-lg-6">
                                                          <label for="tgl">Tanggal Lahir</label>                                                
                                                          <input type="text" class="form-control" id="tgl" placeholder="tgl_lahir" value="${tanggal_lahir}" readonly>
                                                        </div>                                        
                                                    </div> 
                                                    <div class="form-group row">
                                                        <div class="col-lg-6">
                                                          <label for="exampleInputUsername1">Alamat</label>
                                                          <input type="text" class="form-control" id="exampleInputUsername1" placeholder="Username" value="${res.alamat}" readonly>
                                                        </div>
                                                        <div class="col-lg-6">
                                                          <label for="exampleInputUsername1" class="">No Telepon</label>
                                                          <input type="text" class="form-control " id="exampleInputUsername1" placeholder="Username" value="${res.no_telp}" readonly>
                                                        </div>                                        
                                                    </div> 
                                                  </div>
                                                  </div>
                                                    <div class="form-group row">
                                                        <div class="col-lg-6">
                                                          <label for="exampleInputUsername1">Nama Perusahaan</label>
                                                          <input type="text" class="form-control" id="exampleInputUsername1" placeholder="Username" value="${res.nama_perusahaan}">
                                                        </div>
                                                        <div class="col-lg-6">
                                                          <label for="exampleInputUsername1" class="">Alamat Surat</label>
                                                          <input type="text" class="form-control " id="exampleInputUsername1" placeholder="Username" value="${res.alamat_surat}" >
                                                        </div>                                        
                                                    </div> 
                                                    <div class="form-group row">
                                                        <div class="col-lg-6">
                                                          <label for="exampleInputUsername1">Perwakilan Perusahaan</label>
                                                          <input type="text" class="form-control" id="exampleInputUsername1" placeholder="Username" value="${res.perwakilan_perusahaan}" >
                                                        </div>                                                    
                                                        <div class="col-lg-6">
                                                          <label for="exampleInputUsername1">Jabatan Perwakilan</label>
                                                          <input type="text" class="form-control" id="exampleInputUsername1" placeholder="Username" value="${res.jabatan_perwakilan}" >
                                                        </div>                                                    
                                                    </div>                                                                                                 
                                                    <div class="form-group row">
                                                        <div class="col-lg-12">
                                                          <label for="exampleInputUsername1">Telp Perusahaan</label>
                                                          <input type="text" class="form-control" id="exampleInputUsername1" placeholder="Username" value="${res.no_telp_perusahaan}" >
                                                        </div>                                                    
                                                    </div>
                                              </form>

                                            </div>
                                            <div class="modal-footer">
                                                ${log}
                                            </div>`
                            $('#data_modal').html(html);
                        })
                    },
                    error: function(error) {
                        console.log(error);
                    }
                });
            }




        });

        $('#modalDetail_form_dosen').on('show.bs.modal', function(event) {
            var div = $(event.relatedTarget) // Tombol dimana modal di tampilkan
            var modal = $(this)
            $('html').css('overflow-y', 'hidden')
            let id_formulir = div.data('formulir')
            let jenis_permohonan = div.data('jenis')

            if (jenis_permohonan == 1) {
                $.ajax({
                    type: 'POST',
                    url: `<?= base_url('user/User/get_detail_form/') ?>${id_formulir}/${jenis_permohonan}`,
                    success: function(data) {
                        let parsed3 = JSON.parse(data);
                        let data1 = parsed3;
                        let html = "";
                        data1.forEach((res, index) => {
                            if (res.approval == 0) {
                                var status = "Not Approval";
                                var color = "text-warning"
                            } else if (res.approval == 1) {
                                var status = "Approval";
                                var color = "text-success"
                            } else if (res.approval == 2) {
                                var status = "Duplicate";
                                var color = "text-danger"
                            }

                            let months = ["January", "February", "March", "April",
                                "May", "June", "July", "August", "September",
                                "October", "November", "December"
                            ];
                            let date = new Date(res.tgl_lahir);
                            let tanggal_lahir =
                                `${date.getDate()}-${months[date.getMonth()]}-${date.getFullYear()}`;
                            html += `<div class="modal-header">
                                            <div class="d-flex justify-content-around">
                                                <h5 class="modal-title" id="exampleModalLabel">${res.no_form} </h5>
                                                <span class="${color} ml-3"> (<b>${status}</b>)</span>
                                            </div>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body row">  
                                              <form class="forms-sample col-lg-12" >                                                                                  
                                              <div id="accordion">
                                                    <p id="akordion" class="akordion-child mb-3 " style="cursor:pointer;" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                                      <b>Data Mahasiswa</b> <i  class="ti-angle-right ml-2" ></i>
                                                    </p>
                                                  <div id="collapseOne" class="collapse" aria-labelledby="headingOne" data-parent="#accordion">
                                                    <div class="form-group row">
                                                        <div class="col-lg-6">
                                                          <label for="exampleInputUsername1">NIM</label>
                                                          <input type="text" class="form-control" id="exampleInputUsername1" placeholder="Username" value="${res.nim}" readonly>
                                                        </div>
                                                        <div class="col-lg-6">
                                                          <label for="exampleInputUsername1" class="">Nama</label>
                                                          <input type="text" class="form-control " id="exampleInputUsername1" placeholder="Username" value="${res.nama_lengkap}" readonly>
                                                        </div>                                        
                                                    </div> 
                                                    <div class="form-group row">
                                                        <div class="col-lg-6">
                                                          <label for="exampleInputUsername1">Program</label>
                                                          <input type="text" class="form-control" id="exampleInputUsername1" placeholder="Username" value="${res.nama_program}" readonly>
                                                        </div>
                                                        <div class="col-lg-6">
                                                          <label for="exampleInputUsername1" class="">Program Studi</label>
                                                          <input type="text" class="form-control " id="exampleInputUsername1" placeholder="Username" value="${res.nama_prodi}" readonly>
                                                        </div>                                        
                                                    </div> 
                                                    <div class="form-group row">
                                                        <div class="col-lg-6">
                                                          <label for="tempat">Tempat</label>                                                
                                                          <input type="text" class="form-control" id="tempat" placeholder="Tempat" value="${res.tempat}" readonly>                                                    
                                                        </div>
                                                        <div class="col-lg-6">
                                                          <label for="tgl">Tanggal Lahir</label>                                                
                                                          <input type="text" class="form-control" id="tgl" placeholder="tgl_lahir" value="${tanggal_lahir}" readonly>
                                                        </div>                                        
                                                    </div> 
                                                    <div class="form-group row">
                                                        <div class="col-lg-6">
                                                          <label for="exampleInputUsername1">Alamat</label>
                                                          <input type="text" class="form-control" id="exampleInputUsername1" placeholder="Username" value="${res.alamat}" readonly>
                                                        </div>
                                                        <div class="col-lg-6">
                                                          <label for="exampleInputUsername1" class="">No Telepon</label>
                                                          <input type="text" class="form-control " id="exampleInputUsername1" placeholder="Username" value="${res.no_telp}" readonly>
                                                        </div>                                        
                                                    </div> 
                                                  </div>
                                                </div>
                                                    <div class="form-group row">
                                                        <div class="col-lg-6">
                                                          <label for="exampleInputUsername1">Jenis Permohonan</label>
                                                          <input type="text" class="form-control" id="exampleInputUsername1" placeholder="Username" value="${res.jenis_permohonan}" readonly>
                                                        </div>
                                                        <div class="col-lg-6">
                                                          <label for="exampleInputUsername1" class="">Jenis Tugas</label>
                                                          <input type="text" class="form-control " id="exampleInputUsername1" placeholder="Username" value="${res.jenis_tugas}" readonly>
                                                        </div>                                        
                                                    </div> 
                                                    <div class="form-group row">
                                                        <div class="col-lg-12">
                                                          <label for="exampleInputUsername1">Judul Tugas</label>
                                                          <input type="text" class="form-control" id="exampleInputUsername1" placeholder="Username" value="${res.judul_tugas}" readonly>
                                                        </div>                                                    
                                                    </div>                                                                                                 
                                              </form>

                                            </div>
                                            <div class="modal-footer d-flex justify-content-center">
                                                <button type="button" class="btn btn-danger tolak"   data-formulir="${res.id_formulir}">Reject</button>
                                                <button type="button" class="btn btn-success setuju"  value="${res.id_formulir}">Approve</button>
                                            </div>`
                            $('#data_modal_dosen').html(html);
                            $('.tolak').click((e) => {
                                var div = $(event.relatedTarget)
                                var modal = $(this)
                                let id_formulir = div.data('formulir')
                                // alert(id_formulir)
                                $.ajax({
                                    type: 'POST',
                                    url: `<?= base_url('user/User/reject/') ?>${id_formulir}`,
                                    success: function(data) {
                                        location.reload(true);
                                    }
                                })
                            })


                            $('.setuju').click(() => {
                                var div = $(event.relatedTarget)
                                var modal = $(this)
                                let id_formulir = div.data('formulir')
                                // alert(id_formulir)
                                $.ajax({
                                    type: 'POST',
                                    url: `<?= base_url('user/User/approve/') ?>${id_formulir}`,
                                    success: function(data) {
                                        location.reload(true);
                                    }
                                })

                            })
                        })
                    },
                    error: function(error) {
                        console.log(error)
                    }

                });
            } else if (jenis_permohonan == 2) {
                $.ajax({
                    type: 'POST',
                    url: `<?= base_url('user/User/get_detail_form/') ?>${id_formulir}/${jenis_permohonan}`,
                    success: function(data) {
                        let parsed2 = JSON.parse(data);
                        let data2 = [parsed2];

                        console.log(data2)
                        let html = "";
                        data2.forEach((res, index) => {
                            if (res.approval == 0) {
                                var status = "Not Approval";
                                var color = "text-warning"
                            } else if (res.approval == 1) {
                                var status = "Approval";
                                var color = "text-success"
                            } else if (res.approval == 2) {
                                var status = "Duplicate";
                                var color = "text-danger"
                            }
                            let months = ["January", "February", "March", "April",
                                "May", "June", "July", "August", "September",
                                "October", "November", "December"
                            ];
                            let date = new Date(res.tgl_lahir);
                            let tanggal_lahir =
                                `${date.getDate()}-${months[date.getMonth()]}-${date.getFullYear()}`;
                            html += `<div class="modal-header">
                                            <div class="d-flex justify-content-around">
                                                <h5 class="modal-title" id="exampleModalLabel">${res.no_form} </h5>
                                                <span class="${color} ml-3"> (<b>${status}</b>)</span>
                                            </div>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body row">  
                                              <form class="forms-sample col-lg-12" >       
                                              <div id="accordion">
                                                    <p id="akordion" class="akordion-child mb-3 " style="cursor:pointer;" data-toggle="collapse" data-target="#collapseIji" aria-expanded="true" aria-controls="collapseOne">
                                                      <b>Data Mahasiswa</b> <i  class="ti-angle-right ml-2" ></i>
                                                    </p>
                                                  <div id="collapseIji" class="collapse" aria-labelledby="headingOne" data-parent="#accordion">
                                                    <div class="form-group row">
                                                        <div class="col-lg-6">
                                                          <label for="exampleInputUsername1">NIM</label>
                                                          <input type="text" class="form-control" id="exampleInputUsername1" placeholder="Username" value="${res.nim}" readonly>
                                                        </div>
                                                        <div class="col-lg-6">
                                                          <label for="exampleInputUsername1" class="">Nama</label>
                                                          <input type="text" class="form-control " id="exampleInputUsername1" placeholder="Username" value="${res.nama_lengkap}" readonly>
                                                        </div>                                        
                                                    </div> 
                                                    <div class="form-group row">
                                                        <div class="col-lg-6">
                                                          <label for="exampleInputUsername1">Program</label>
                                                          <input type="text" class="form-control" id="exampleInputUsername1" placeholder="Username" value="${res.nama_program}" readonly>
                                                        </div>
                                                        <div class="col-lg-6">
                                                          <label for="exampleInputUsername1" class="">Program Studi</label>
                                                          <input type="text" class="form-control " id="exampleInputUsername1" placeholder="Username" value="${res.nama_prodi}" readonly>
                                                        </div>                                        
                                                    </div> 
                                                    <div class="form-group row">
                                                        <div class="col-lg-6">
                                                          <label for="tempat">Tempat</label>                                                
                                                          <input type="text" class="form-control" id="tempat" placeholder="Tempat" value="${res.tempat}" readonly>                                                    
                                                        </div>
                                                        <div class="col-lg-6">
                                                          <label for="tgl">Tanggal Lahir</label>                                                
                                                          <input type="text" class="form-control" id="tgl" placeholder="tgl_lahir" value="${tanggal_lahir}" readonly>
                                                        </div>                                        
                                                    </div> 
                                                    <div class="form-group row">
                                                        <div class="col-lg-6">
                                                          <label for="exampleInputUsername1">Alamat</label>
                                                          <input type="text" class="form-control" id="exampleInputUsername1" placeholder="Username" value="${res.alamat}" readonly>
                                                        </div>
                                                        <div class="col-lg-6">
                                                          <label for="exampleInputUsername1" class="">No Telepon</label>
                                                          <input type="text" class="form-control " id="exampleInputUsername1" placeholder="Username" value="${res.no_telp}" readonly>
                                                        </div>                                        
                                                    </div> 
                                                  </div>
                                                  </div>
                                                    <div class="form-group row">
                                                        <div class="col-lg-6">
                                                          <label for="exampleInputUsername1">Nama Perusahaan</label>
                                                          <input type="text" class="form-control" id="exampleInputUsername1" placeholder="Username" value="${res.nama_perusahaan}"readonly>
                                                        </div>
                                                        <div class="col-lg-6">
                                                          <label for="exampleInputUsername1" class="">Alamat Surat</label>
                                                          <input type="text" class="form-control " id="exampleInputUsername1" placeholder="Username" value="${res.alamat_surat}" readonly>
                                                        </div>                                        
                                                    </div> 
                                                    <div class="form-group row">
                                                        <div class="col-lg-6">
                                                          <label for="exampleInputUsername1">Perwakilan Perusahaan</label>
                                                          <input type="text" class="form-control" id="exampleInputUsername1" placeholder="Username" value="${res.perwakilan_perusahaan}"readonly >
                                                        </div>                                                    
                                                        <div class="col-lg-6">
                                                          <label for="exampleInputUsername1">Jabatan Perwakilan</label>
                                                          <input type="text" class="form-control" id="exampleInputUsername1" placeholder="Username" value="${res.jabatan_perwakilan}"readonly >
                                                        </div>                                                    
                                                    </div>                                                                                                 
                                                    <div class="form-group row">
                                                        <div class="col-lg-12">
                                                          <label for="exampleInputUsername1">Telp Perusahaan</label>
                                                          <input type="text" class="form-control" id="exampleInputUsername1" placeholder="Username" value="${res.no_telp_perusahaan}" readonly>
                                                        </div>                                                    
                                                    </div>
                                              </form>

                                            </div>
                                            <div class="modal-footer d-flex justify-content-center">
                                                <button type="button" class="btn btn-danger tolak"  data-formulir="${res.id_formulir}">Reject</button>
                                                <button type="button" class="btn btn-success setuju"  value="${res.id_formulir}">Approve</button>
                                            </div>`
                            $('#data_modal_dosen').html(html);
                            $('.tolak').click((e) => {
                                var div = $(event.relatedTarget)
                                var modal = $(this)
                                let id_formulir = div.data('formulir')
                                // alert(id_formulir)
                                $.ajax({
                                    type: 'POST',
                                    url: `<?= base_url('user/User/reject/') ?>${id_formulir}`,
                                    success: function(data) {
                                        location.reload(true);
                                    }
                                })
                            })


                            $('.setuju').click(() => {
                                var div = $(event.relatedTarget)
                                var modal = $(this)
                                let id_formulir = div.data('formulir')
                                // alert(id_formulir)
                                $.ajax({
                                    type: 'POST',
                                    url: `<?= base_url('user/User/approve/') ?>${id_formulir}`,
                                    success: function(data) {
                                        location.reload(true);
                                    }
                                })
                            })
                        })

                    },
                    error: function(error) {
                        console.log(error);
                    }
                });



            }

        });
        $('#modalDetail_form_dosen').on('hide.bs.modal', (event) => {
            $('html').css('overflow-y', 'auto')
        });
        $('#modalDetail_form').on('hide.bs.modal', (event) => {
            $('html').css('overflow-y', 'auto')
        });
        // $('#modal_detail_dosen').click(() => {
        //   let id_formulir = $('.test').attr('data-formulir');
        //   let jenis_permohonan = $('.test').attr('data-jenis');
        //   alert(jenis_permohonan);
        //   $('#modalDetail_form').modal('show')

        // });
        $('#akordion').click(() => {
            console.log('asuk')
            // if ($(this).closest('#akordion').find('.')) {

            // }
        });

        $('#program_m').on('change', () => {
            // let id = $('select[id="program_m"]:selected').val();
            let value = $("#program_m").val();
            $.ajax({
                type: 'POST',
                url: `<?= base_url('user/User/get_prodi/') ?>${value}`,
                success: function(data) {
                    let parsed = JSON.parse(data);
                    // console.log(parsed)
                    $("#select_prodi").html(parsed);
                    // $(this).next('select[id="select_prodi"]').focus().val(parsed);
                }
            });
        });


        flatpickr("#tgl", {});

        $('#uplod').change((e) => {
            var input = $(e.currentTarget);
            var file = input[0].files[0];
            // console.log(file);
            if (file) {
                let reader = new FileReader();
                reader.onload = function(event) {
                    $('.pp_v').attr('src', event.target.result);
                }
                reader.readAsDataURL(file);
            }
        });
        $("#btn_ganti_poto").click(() => {
            $("#uplod").click();
        });
    })
</script>
</body>

</html>