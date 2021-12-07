<section style="padding-top:220px;">
	<div class="row">
		<h3>Profil Saya</h3>
		<BR>
		<center><?= $this->session->flashdata('message'); ?></center>
		<div class="box-wrapper">
			<table width="100%" border="0" cellspacing="0" cellpadding="0">
  				<tr>
    				<td style="width:30%;">Nama</td>
    				<td style="width:70%;"><?= $user['nama']; ?></td>
  				</tr>
  				<tr>
    				<td style="width:30%;">Email</td>
    				<td style="width:70%;"><?= $user['email']; ?></td>
  				</tr>
  				<tr>
    				<td style="width:30%;">No. Hp</td>
    				<td style="width:70%;"><?= $user['nohp']; ?></td>
  				</tr>
			</table>
		</div>
		
		<div style="padding-top:10px;"></div>
		
		<a href="<?= base_url('ubah-profil'); ?>">
			<div class="button">
				UBAH PROFIL
			</div>
		</a>
		<a href="<?= base_url('ubah-password'); ?>">
			<div class="button">
				UBAH PASSWORD
			</div>
		</a>
	</div>
</section>
