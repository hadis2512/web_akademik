<script>
    $(document).ready(() => {
        let id_user = $('#suratM').data('pengguna');
        $.ajax({
            type: 'POST',
            url: `<?= base_url('user/User/get_data_surat/') ?>${id_user}`,
            success: function(data) {
                // console.log(data)
                let dataS = JSON.parse(data);
                let html = "";
                console.log(dataS)
                if (dataS.length < 3) {
                    $("#loadmore1").addClass('d-none');
                }

                const dataCard = (indexStart, indexEnd) => {
                    const dataSliced = dataS.slice(indexStart, indexEnd);
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



                        var a = moment(res.created_at)
                        var b = moment()
                        let totDate = b.diff(a, "days") + " hari yang lalu";
                        html += `<div class = "col-md-4 mb-2 stretch-card transparent" >
                                 <div class = "card card-light-blue">
                                 <div class = "card-header d-flex justify-content-between">
                                 <p class = "mb-0 " > ${res.no_surat} </p>
                                         
                                 </div> 
                                 <div class = "card-body" >
                                 <h4 class = "mb-2" >${res.jenis_permohonan} </h4>              
                                 </div> 
                                 <div class = "card-footer d-flex justify-content-between" >
                                 <p class = "mb-0" >${totDate}</p>
                                 <a href="#" id="modal_detail" data-toggle="modal" data-target="#modalLihatSurat" name="" data-surat="${res.id_surat}"  class="test font-weight-bold text-light float-right">details<i class="ml-2 icon-arrow-right"></i>
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
                    $('#suratM').html(html);
                };

                let idx = 0;
                let idxEnd = 3;

                dataCard(idx, idxEnd);

                $('#loadmore1').on('click', () => {
                    html = '';
                    dataCard(idx, idxEnd += 3);

                    if (idxEnd >= dataS.length) {
                        $('#loadmore1').addClass('d-none');
                    }
                })
            }
        })

        $('#modalLihatSurat').on('show.bs.modal', function(event) {
            // console.log(event)
            var div = $(event.relatedTarget) // Tombol dimana modal di tampilkan
            var modal = $(this)
            // $('html').css('overflow-y', 'hidden')
            let id_surat = div.data('surat')
            let jenis_permohonan = div.data('jenis')
            alert(id_surat)

            $.ajax({
                type: 'POST',
                url: `<?= base_url('user/User/get_surat_by_id/') ?>${id_surat}`,
                success: function(data) {
                    let parsed2 = JSON.parse(data);
                    let data1 = parsed2;
                    let html = "";
                    console.log(data1)
                    html += `<div class="modal-header">                                    
                                    <h6 class="modal-title mr-2" id="exampleModalLabel">
                                        <b>${data1.nama_file}</b>                                        
                                    </h6>                                                                      
                                    <a href="<?= base_url('user/User/download_surat/') ?>${data1.id_jenis_permohonan}/${data1.id_surat}" class="btn btn-success btn-sm "><i class="fas fa-print mr-2"></i>Cetak</a>                                    
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                     <span aria-hidden="true">&times;</span>
                                </button>                                
                            </div>                        

                            <div class="modal-body row">                                                                                                                            
                                <object type="application/pdf" data="<?= base_url() ?>${data1.file_pdf}" height="750" style="width:100%;"></object>
                            </div>`
                    $('#data_surat_ready').html(html);
                },
                error: function(error) {
                    console.log(error);
                }
            });


        });




    })
</script>