<?php $this->load->view('superadmin/components/V_header'); ?>
<div class="row">
    <div class="col-lg-12">
        <div class="card mb-4">
            <div class="table-responsive p-3">
                <table class="table align-items-center table-flush table-hover test" id="dataTableHover">
                    <thead class="thead-light">
                        <tr class="text-center">
                            <th>No</th>
                            <th>NIM</th>
                            <th>Email</th>
                            <th>Nama Lengkap</th>
                            <th>Tempat/Tgl Lahir</th>
                            <th>Jenis Kelamin</th>
                            <th>Action</th>
                            <!-- <th>Jenis Kelamin</th> -->
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>
</div>
<?php $this->load->view('superadmin/components/V_footer'); ?>