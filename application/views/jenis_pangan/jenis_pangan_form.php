<div class="col-md-10">
    <div class="card">
        <div class="card-header" data-background-color="green">
            <h4 class="title"><?php echo $button ?> Jenis Pangan</h4>
            <p class="category"><?= $nama?></p>
        </div>
        <div class="card-content">
            <form action="<?php echo $action; ?>" method="post">
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group label-floating">
                            <label for="varchar" class="control-label">Nama <?php echo form_error('nama') ?></label>
                            <input type="text" class="form-control" name="nama" id="nama" value="<?php echo $nama; ?>" />
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group label-floating">
                            <label for="varchar" class="control-label">Bobot <?php echo form_error('bobot') ?></label>
                            <input type="text" class="form-control" name="bobot" id="bobot" value="<?php echo $bobot; ?>" />
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group label-floating">
                            <label for="varchar" class="control-label">Skor Max <?php echo form_error('skor') ?></label>
                            <input type="text" class="form-control" name="skor" id="skor" value="<?php echo $skor; ?>" />
                        </div>
                    </div>
                </div>
                <input type="hidden" name="id" value="<?php echo $id; ?>" /> 
                <button type="submit" class="btn btn-primary pull-right"><?php echo $button ?></button> 
                <a href="<?php echo site_url('jenis_pangan') ?>" class="btn btn-danger pull-right"><i class="material-icons">arrow_back</i>Batal</a>
                <div class="clearfix"></div>
            </form>
        </div>
    </div>
</div>