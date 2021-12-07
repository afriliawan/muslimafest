<section style="padding-top:220px;">
	<div class="row">
		<h3>Ubah Profil</h3>
		<BR>
		<center><?= $this->session->flashdata('message'); ?></center>
		<div class="box-wrapper">
        <div class="row" style="width:85%;">
        <?= form_open_multipart('aksi-ubah-profil'); ?>
		<input id="email" class="input-tb" name="email" value="<?= $user['email']; ?>" type="text" placeholder="Email" readonly>
		<input id="Nama lengkap" class="input-tb" name="nama" value="<?= $user['nama']; ?>" type="text" placeholder="Masukan nama Anda">
		<input id="No HP" class="input-tb" name="nohp" type="text" value="<?= $user['nohp']; ?>" placeholder="Masukan nomor telepon">
	</div>
		</div>
		
		<div style="padding-top:10px;"></div>	
            <button type="submit" class="button">
                Ubah
            </button>
</section>
