<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$set = $this->db->get_where('sekolah', ['id'=>1])->row_array();
function tgl_indo($tanggal){
  $bulan = array(
    1 => 'Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember'
    );
  $pecah = explode('-', $tanggal);
  return $pecah[2] . ' ' . $bulan[ (int)$pecah[1] ] . ' ' . $pecah[0];
}
 
?>
<!DOCTYPE html>
<html>
<head>
	<title>Cetak Daftar Hadir</title>
</head>
<style type="text/css">
	body {
		font-family: arial;
	}
	.tabel {
		width: 98%; margin: 0 auto;
		 font-size: 14px;
		
		color: #666;
  		text-shadow: 1px 1px 0px #fff;
  		background: #000;
 		border: #ccc 1px solid;
	}
.tabel th {
  padding: 8px;
  border:1px solid #e0e0e0;
  background: #ededed;
}
 
.tabel tr {
  text-align: center;
}
 
.tabel td {
  padding: 5px;
  border-top: 1px solid #ffffff;
  border-bottom: 1px solid #e0e0e0;
  border-left: 1px solid #e0e0e0;
  background: #fafafa;
}
 
.tabel tr:last-child td {
  border-bottom: 0;
}
 
</style>
<body onload="window.print()">
<table width="100%">
	<td align="center" width="20%"><img src="<?php echo base_url('assets/images/').$set['LogoSekolah']; ?>" width=85px;></td><td align="center" width="60%"><span style="font-size: 16px;"><?php echo $set['Judul']; ?></span><br/><span style="font-size: 30px; font-weight: bold;"><?php echo $set['NamaSekolah']; ?></span><br><span style="font-size: 12px; font-style: italic;"><?php echo $set['AlamatSekolah']; ?></span></td><td width="20%"></td>
</table>
<hr style="border-top: 3px double #000; border-bottom: 1.5px solid #000;" width="98%">
<?php                     
   foreach ($map->result() as $k) {     
?>
<table style="width: 98%; margin: 0 auto; font-size: 15px;"><tr><td width="150px;">Mapel</td><td width="1%">:</td><td><?php echo $k->NamaSoal; ?></td></tr>
	<tr><td>Kelas</td><td>:</td><td><?php echo $kela; ?></td></tr>
	<tr><td>Jadwal Mengerjakan</td><td>:</td><td><?php echo tgl_indo($k->tanggal_uji)." | ".$k->waktu_awal." s/d ".$k->waktu_akhir; ?></td></tr>
</table>

<br>
<table class="tabel">
	<thead>
	<tr><th>NO</th><th>No. Peserta</th><th>Nama</th><th>Mulai Mengerjakan</th><th>Ttd</th></tr>
	</thead>
	                                <tbody>
                                    <?php 
                                    $no=1;
                                    foreach ($sudah->result() as $abs) { ?>
                                    <tr>
                                        <td><?php echo $no; ?></td>
                                        <td><?php echo $abs->no_peserta; ?></td>
                                        <td align="left"><?php echo $abs->nama_siswa; ?></td>
                                        <td><?php echo $abs->TanggalMengerjakan; ?> <?php echo $abs->Jam; ?></td>
                                        <td>ttd</td>
                                    </tr>
                                <?php $no++; }  ?>
                                <?php  
                                $noo=$sudah->num_rows();
                                foreach ($soa->result_array() as $bel) { ?>
                                    <tr>
                                        <td><?php echo $noo; ?></td>
                                        <td><?php echo $bel['no_peserta']; ?></td>
                                        <td align="left"><?php echo $bel['nama_siswa']; ?></td>
                                        <td></td>
                                        <td></td>
                                    </tr>
                                <?php $noo++; }?>
                                </tbody>
</table>
<table width="30%" style="margin: 0 auto; float: right; font-size: 18px;">
  <tr><td style="padding-top: 40px;">............., <?php echo tgl_indo($k->tanggal_uji); ?></td></tr>
  <tr><td style="padding-top: 10px;">..............................</td></tr>
  <tr><td style="padding-top: 80px;">..............................</td></tr>
</table>
<?php } ?>
</body>
</html>