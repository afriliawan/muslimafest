
<section style="padding-top:150px;">
	<div style="padding-top:20px;"></div>
	<div class="row">
		<h3>Halaman Login</h3>
	</div>
    
    <center><?= $this->session->flashdata('message'); ?></center>
    <form class="user" method="post" action="<?= base_url('login'); ?>">
	<div style="padding-bottom:10px;"></div>
	<div class="row" style="width:85%;">
		<input id="email" name="email" class="input-tb" type="text" placeholder="Email">
		<input id="password" name="password" class="input-tb" type="password" placeholder="Password">
	</div>
	
	<div style="padding-bottom:20px;"></div>
	
	<div class="row">
    <div class="text-center">
		<a class="small" href="<?=base_url('lupa-password'); ?>">Lupa password?</a>
	</div>
	<div class="text-center">
		<a class="small" href="<?= base_url('buat-akun');?>">Buat akun baru</a>
	</div>
	<button type="submit" class="button">
           LOGIN
        </button>
		</a>
	</div>
	
</section>