<div class="col-md-12">
<?php
    if ($this->session->userdata('message') !== null) {
        echo '<div class="alert alert-info alert-with-icon" data-notify="container">
        <i data-notify="icon" class="material-icons">add_alert</i>
        <span data-notify="message"> '.$this->session->userdata("message").' </span></div>';  
    }
?>
<div class="row">
<div class="col-md-6 text-left">
    <?php echo anchor(base_url('keluarga'), ' <i class="material-icons">arrow_back</i> Kembali ke Daftar keluarga', 'class="btn btn-info"'); ?>
</div>
<div class="col-md-6 text-right">
    <?php if ($this->session->userdata('auth')['status'] == 2) { ?>
        <?php echo anchor(base_url('user/create/'.$id), ' <i class="material-icons">add_box</i> Tambah Data Anggota Keluarga', 'class="btn btn-success"'); ?>
    <?php } ?>
</div>
</div>
<div class="card">
    <div class="card-header" data-background-color="green">
        <h4 class="title">Daftar Anggota Keluarga</h4>
    </div>
    <div class="card-content table-responsive">
        <table class="table" id="mytable">
            <thead class="text-primary">
            <tr>
                <th width="80px">No</th>
                <th>Nama</th>
                <th>Jenis Kelamin</th>
                <th>Umur</th>
                <th>Pendidikan</th>
                <th>Pekerjaan</th>
                <!-- <th>Hubungan</th> -->
                <th width="200px">Aksi</th>
            </tr>
            </thead>
        </table>
    </div>
</div>
</div>
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
            ajax: {"url": "<?= base_url("user_keluarga/json/".$id);?>", "type": "POST"},
            columns: [
                {
                    "data": "id",
                    "orderable": false
                },{"data": "nama"},{"data": "jk"},{"data": "age"},{"data": "pendidikan"},{"data": "pekerjaan"},
                {
                    "data" : "action",
                    "orderable": false,
                    "className" : "text-center"
                }
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