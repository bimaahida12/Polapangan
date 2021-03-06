<div class="col-md-10">
    <div class="card">
        <div class="card-header" data-background-color="green">
            <h4 class="title"><?php echo $button ?> Pangan</h4>
            <p class="category"><?= $nama?></p>
        </div>
        <div class="card-content">
            <form action="<?php echo $action; ?>" method="post">
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group label-floating">
                            <label for="varchar"  class="control-label">Nama <?php echo form_error('nama') ?></label>
                            <input type="text" class="form-control" name="nama" id="nama" value="<?php echo $nama; ?>" required />
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group label-floating">
                            <label for="varchar" class="control-label">Takaran <?php echo form_error('takaran') ?></label>
                            <input type="text" class="form-control" name="takaran" id="takaran" value="<?php echo $takaran; ?>" required />
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group label-floating">
                            <label for="double" class="control-label">Urt <?php echo form_error('urt') ?></label>
                            <input type="text" class="form-control" name="urt" id="urt" value="<?php echo $urt; ?>" required/>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group label-floating">
                            <label for="double" class="control-label">Gram <?php echo form_error('gram') ?></label>
                            <input type="text" class="form-control" name="gram" id="gram" value="<?php echo $gram; ?>" required/>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group label-floating">
                            <label for="double" class="control-label">Kalori <?php echo form_error('kalori') ?></label>
                            <input type="text" class="form-control" name="kalori" id="kalori" value="<?php echo $kalori; ?>" required/>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group label-floating">
                            <label for="double" class="control-label">Lemak <?php echo form_error('lemak') ?></label>
                            <input type="text" class="form-control" name="lemak" id="lemak" value="<?php echo $lemak; ?>" required/>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group label-floating">
                            <label for="double" class="control-label">Karbohidrat <?php echo form_error('karbohidrat') ?></label>
                            <input type="text" class="form-control" name="karbohidrat" id="karbohidrat" value="<?php echo $karbohidrat; ?>" required/>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group label-floating">
                            <label for="double" class="control-label">Protein <?php echo form_error('protein') ?></label>
                            <input type="text" class="form-control" name="protein" id="protein" value="<?php echo $protein; ?>" required/>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group label-floating">
                            <label for="int">Jenis Pangan<?php echo form_error('jenis_pangan_id') ?></label>
                            <select class="form-control" name="jenis_pangan_id" id="jenis_pangan_id" required>
                                <?php foreach ($jenis as $key => $value) { ?>
                                    <option value="<?= $value->id?>" <?php if($jenis_pangan_id == $value->id){echo 'selected';}?>><?= $value->nama?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                </div>
                <input type="hidden" name="id" value="<?php echo $id; ?>" /> 
                <button type="submit" class="btn btn-primary pull-right"><?php echo $button ?></button> 
                <a href="<?php echo site_url('pangan') ?>" class="btn btn-danger pull-right"><i class="material-icons">arrow_back</i> Batal</a>
                <div class="clearfix"></div>
            </form>
        </div>
    </div>
</div>