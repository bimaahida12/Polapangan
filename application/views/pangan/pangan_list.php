<div class="col-md-12">
    <?php
        if ($this->session->userdata('message') !== null) {
            echo '<div class="alert alert-info alert-with-icon" data-notify="container">
            <i data-notify="icon" class="material-icons">add_alert</i>
            <span data-notify="message"> '.$this->session->userdata("message").' </span></div>';  
        }
    ?>
    <div class="col-md-12 text-right">
        <?php if ($this->session->userdata('auth')['status'] == 1) { ?>
            <?php echo anchor(site_url('pangan/create'), ' <i class="material-icons">add_box</i> Tambah Data Makanan', 'class="btn btn-success"'); ?>
        <?php } ?>
        <?php echo anchor(site_url('pangan/excel'), '<i class="material-icons">cloud_download</i> Excel', 'class="btn btn-warning"'); ?>
    </div>
    <div class="card">
        <div class="card-header" data-background-color="green">
            <h4 class="title">Daftar Konversi Makanan</h4>
        </div>
        <div class="card-content table-responsive">
            <table class="table" id="mytable">
                <thead class="text-primary">
                <?php if ($this->session->userdata('auth')['status'] == 1) { ?>
                    <tr>
                        <th width="80px">No</th>
                        <th>Nama</th>
                        <th>Urt</th>
                        <th>Takaran</th>
                        <th>Berat (Gram)</th>
                        <th>Kalori (Kkal)</th>
                        <th>Jenis Makanan</th>
                        <th>Action</th>
                    </tr>
                <?php }else{ ?>
                    <tr>
                        <th width="80px">No</th>
                        <th>Nama</th>
                        <th>Urt</th>
                        <th>Takaran</th>
                        <th>Berat (Gram)</th>
                        <th>Kalori (Kkal)</th>
                        <th>Jenis Makanan</th>
                    </tr>
                <?php } ?>
                </thead>
            </table>
        </div>
    </div>
</div>
<?php if ($this->session->userdata('auth')['status'] == 1) { ?>
    <script type="text/javascript">
    $(document).ready(function() {
        $.fn.dataTableExt.oApi.fnPagingInfo = function(oSettings)
        {
            return {
                "iStart": oSettings._iDisplayStart,
                "iEnd": oSettings.fnDisplayEnd(),
                "iLength": oSettings._iDisplayLength,
                "iTotal": oSettings.fnRecordsTotal(),
                "iFilteredTotal": oSettings.fnRecordsDisplay(),
                "iPage": Math.ceil(oSettings._iDisplayStart / oSettings._iDisplayLength),
                "iTotalPages": Math.ceil(oSettings.fnRecordsDisplay() / oSettings._iDisplayLength)
            };
        };

        var t = $("#mytable").dataTable({
            initComplete: function() {
                var api = this.api();
                $('#mytable_filter input')
                        .off('.DT')
                        .on('keyup.DT', function(e) {
                            if (e.keyCode == 13) {
                                api.search(this.value).draw();
                    }
                });
            },
            oLanguage: {
                sProcessing: "loading..."
            },
            processing: true,
            serverSide: true,
            ajax: {"url": "pangan/json", "type": "POST"},
            columns: [
                {
                    "data": "id",
                    "orderable": false
                },{"data": "nama"},{"data": "urt"},{"data": "takaran"},{"data": "gram"},{"data": "kalori"},{"data": "jenis_pangan"},{"data": "action"},
            ],
            order: [[0, 'desc']],
            rowCallback: function(row, data, iDisplayIndex) {
                var info = this.fnPagingInfo();
                var page = info.iPage;
                var length = info.iLength;
                var index = page * length + (iDisplayIndex + 1);
                $('td:eq(0)', row).html(index);
            }
        });
    });
</script>
<?php }else{ ?>
    <script type="text/javascript">
    $(document).ready(function() {
        $.fn.dataTableExt.oApi.fnPagingInfo = function(oSettings)
        {
            return {
                "iStart": oSettings._iDisplayStart,
                "iEnd": oSettings.fnDisplayEnd(),
                "iLength": oSettings._iDisplayLength,
                "iTotal": oSettings.fnRecordsTotal(),
                "iFilteredTotal": oSettings.fnRecordsDisplay(),
                "iPage": Math.ceil(oSettings._iDisplayStart / oSettings._iDisplayLength),
                "iTotalPages": Math.ceil(oSettings.fnRecordsDisplay() / oSettings._iDisplayLength)
            };
        };

        var t = $("#mytable").dataTable({
            initComplete: function() {
                var api = this.api();
                $('#mytable_filter input')
                        .off('.DT')
                        .on('keyup.DT', function(e) {
                            if (e.keyCode == 13) {
                                api.search(this.value).draw();
                    }
                });
            },
            oLanguage: {
                sProcessing: "loading..."
            },
            processing: true,
            serverSide: true,
            ajax: {"url": "pangan/json", "type": "POST"},
            columns: [
                {
                    "data": "id",
                    "orderable": false
                },{"data": "nama"},{"data": "urt"},{"data": "takaran"},{"data": "gram"},{"data": "kalori"},{"data": "jenis_pangan"},
            ],
            order: [[0, 'desc']],
            rowCallback: function(row, data, iDisplayIndex) {
                var info = this.fnPagingInfo();
                var page = info.iPage;
                var length = info.iLength;
                var index = page * length + (iDisplayIndex + 1);
                $('td:eq(0)', row).html(index);
            }
        });
    });
</script>
<?php } ?>
