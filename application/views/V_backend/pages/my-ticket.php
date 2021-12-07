
<section style="padding-top:190px;">
	<div style="padding-top:20px;"></div>
	<div class="row">
		<h3>Tiket Saya</h3>
		<BR>
		<div class="box-wrapper">
		
		<?php
			$hilangnyaBackslash = stripslashes($qrnya);
			$ubahLinknya = str_replace('C:xampphtdocsmuslimafest', '', $hilangnyaBackslash);
			$srcLink = base_url() . $ubahLinknya;
		?>
		<?php if ($statusTicket[0]['kegiatan'] == "Belum Masuk") {?>
			<div class="qr-list">
				<div class="box-left">
					
					<img src="<?= $srcLink; ?>" width="100" alt="muslima fest 2021">
				</div>
				<div class="box-right">
				&nbsp;&nbsp;&nbsp;Belum terpakai<BR>
				&nbsp;&nbsp;&nbsp;(Belum Masuk)
				</div>
			</div>
			<?php }else if ($statusTicket[0]['kegiatan'] == "Masuk") { ?>
				<div class="qr-list terpakai">
					<div class="box-left">
						<img src="assets/images/qrcode-02.png" width="100" alt="muslima fest 2021">
					</div>
					<div class="box-right">
					&nbsp;&nbsp;&nbsp;Sudah terpakai<BR>
					&nbsp;&nbsp;&nbsp;(Sudah Masuk)
					</div>
				</div>
			<?php }else if ($statusTicket[0]['kegiatan'] == "Snack") { ?>
				<div class="qr-list terpakai">
					<div class="box-left">
						<img src="assets/images/qrcode-02.png" width="100" alt="muslima fest 2021">
					</div>
					<div class="box-right">
					&nbsp;&nbsp;&nbsp;Sudah terpakai<BR>
					&nbsp;&nbsp;&nbsp;Snack
					</div>
				</div>
			<?php } ?>
<!-- 			
			
			
			<div class="qr-list terpakai">
				<div class="box-left">
					<img src="assets/images/qrcode-02.png" width="100" alt="muslima fest 2021">
				</div>
				<div class="box-right">
					Sudah terpakai
				</div>
			</div> -->

		</div>
	</div>
	
	
	
</section>