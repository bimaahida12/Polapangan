<!doctype html>
<html>
    <head>
        <title>harviacode.com - codeigniter crud generator</title>
        <link rel="stylesheet" href="<?php echo base_url('assets/bootstrap/css/bootstrap.min.css') ?>"/>
        <style>
            body{
                padding: 15px;
            }
        </style>
    </head>
    <body>
        <h2 style="margin-top:0px">Detail_pangan_keluarga Read</h2>
        <table class="table">
	    <tr><td>Urt</td><td><?php echo $urt; ?></td></tr>
	    <tr><td>Berat</td><td><?php echo $berat; ?></td></tr>
	    <tr><td>Asal</td><td><?php echo $asal; ?></td></tr>
	    <tr><td>Rata Rata Berat</td><td><?php echo $rata_rata_berat; ?></td></tr>
	    <tr><td>Pangan Keluarga Id</td><td><?php echo $pangan_keluarga_id; ?></td></tr>
	    <tr><td>Pangan Id</td><td><?php echo $pangan_id; ?></td></tr>
	    <tr><td></td><td><a href="<?php echo site_url('detail_pangan_keluarga') ?>" class="btn btn-default">Cancel</a></td></tr>
	</table>
        </body>
</html>