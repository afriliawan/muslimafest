<section style="padding-top:220px;">
	<div class="row">
		<h3>Ubah Password</h3>
		<BR>
		<center><?= $this->session->flashdata('message'); ?></center>
		<div class="box-wrapper">
       
        <form action="<?= base_url('C_backend/changePassword'); ?>" method="post">
                    <div class="form-group">
                        <label for="currentPassword">Current Password</label><BR>
                        <input type="password" class="form-control" id="currentPassword" name="currentPassword"><BR>
                        <?= form_error('currentPassword','<small class="text-danger pl-3">','</small>');?>
                    </div>
                    <div class="form-group">
                        <label for="newPassword1">New Password</label><BR>
                        <input type="password" class="form-control" id="newPassword1" name="newPassword1"><BR>
                        <?= form_error('newPassword1','<small class="text-danger pl-3">','</small>');?>
                    </div>
                    <div class="form-group">
                        <label for="newPassword2">Repeat Password</label><BR>
                        <input type="password" class="form-control" id="newPassword2" name="newPassword2"><BR>
                        <?= form_error('newPassword2','<small class="text-danger pl-3">','</small>');?>
                    </div>
                    <div style="padding-top:10px;"></div>	
            <button type="submit" class="button">
                Ubah
            </button>
		</div>
		
</section>
