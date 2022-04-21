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
<script>
  $(document).ready(() => {
    // $('.test').click(() => {
    //   let id_formulir = $('.test').attr('data-formulir');
    //   let jenis_permohonan = $('.test').attr('data-jenis');
    //   $('.modalDetail_form').modal('show')
    // })
    $('#modalDetail_form').on('show.bs.modal', function(event) {
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
            let parsed2 = JSON.parse(data);
            let data1 = parsed2;
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
              let months = ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"];
              let date = new Date(res.tgl_lahir);
              let tanggal_lahir = `${date.getDate()}-${months[date.getMonth()]}-${date.getFullYear()}`;
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
                                              </form>

                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary w-100" data-dismiss="modal">Close</button>
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
            let data1 = parsed2;
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
              let months = ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"];
              let date = new Date(res.tgl_lahir);
              let tanggal_lahir = `${date.getDate()}-${months[date.getMonth()]}-${date.getFullYear()}`;
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
                                                <button type="button" class="btn btn-secondary w-100" data-dismiss="modal">Close</button>
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

              let months = ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"];
              let date = new Date(res.tgl_lahir);
              let tanggal_lahir = `${date.getDate()}-${months[date.getMonth()]}-${date.getFullYear()}`;
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
              let months = ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"];
              let date = new Date(res.tgl_lahir);
              let tanggal_lahir = `${date.getDate()}-${months[date.getMonth()]}-${date.getFullYear()}`;
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
    flatpickr("#tgl", {});


  })
</script>
</body>

</html>