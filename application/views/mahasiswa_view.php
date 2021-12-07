<!DOCTYPE html>
<html>
<head>
    <title>Data Mahasiswa</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>
<body>
    <div class="container">
        <div class="row">
            <h2>Data <small>Mahasiswa</small></h2>
            <a href="<?= base_url('Mahasiswa/mahasiswa_add'); ?>"><button type="button" class="btn btn-success">Add New</button></a>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>NIM</th>
                        <th>NAMA</th>
                        <th>PRODI</th>
                        <th>QR CODE</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($data->result() as $row):?>
                    <tr>
                        <td style="vertical-align: middle;"><?php echo $row->nim;?></td>
                        <td style="vertical-align: middle;"><?php echo $row->nama;?></td>
                        <td style="vertical-align: middle;"><?php echo $row->prodi;?></td>
                        <?php
                           $hilangnyaBackslash = stripslashes($qrnya);
                           $ubahLinknya = str_replace('C:xampphtdocsmuslimafest', '', $hilangnyaBackslash);
                           $srcLink = base_url() . $ubahLinknya;
                        ?>
                        <td><img style="width: 100px;" src="<?php echo $srcLink; ?>"></td>
                    </tr>
                    <?php endforeach;?>
                </tbody>
            </table>
        </div>
    </div>
 
    <!-- Modal add new mahasiswa-->
    
    <script type="text/javascript" src="<?php echo base_url().'assets/js/bootstrap.js'?>"></script>
</body>
</html>