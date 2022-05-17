<?php $this->load->view('superadmin/components/V_header'); ?>

</style>
<div class="row">
    <div class="col-lg-12">
        <div class="container">
            <form method="POST" id="form-data" action="http://localhost/web_akademik/superadmin/master_data/ttd_test">

                <h1>Testing Tanda tangan digital</h1>



                <div class="row">
                    <div class="col-xs-12 col-sm-12 cols-md-12 text-center">
                        <h3>Try it Out</h3>
                    </div>
                </div>
                <div id="bcPaint"></div>


                <input type="text" name="signed" id="signed" />
                <div class="" id="test"></div>
                <br />

                <!-- <button type="submit" class="btn btn-success">Submit</button> -->
            </form>
            <!-- <div class="table-responsive p-3">
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
                            <th>Jenis Kelamin</th>
                        </tr>
                    </thead>
                </table>
            </div> -->
        </div>
    </div>
</div>
<?php $this->load->view('superadmin/components/V_footer'); ?>