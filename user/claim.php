<?php
$IdPanjar 	= $_GET['nmr'];
$Panjar		= $_GET['panjar'];
$namas1="";
$jabatans1="";
$namas2="";
$jabatans2="";
if($_GET["aksi"] && $_GET["nmr"]){
include_once("../library/koneksi.php");
session_start();
$uangpanjar = preg_replace("/[^0-9]/", "", $_GET['panjar']);
$pagi;
$siang;
$malam;
$lain;
$hrglain;
$Daily_Allowence;
$Acco=array();
$com;
$hcom;
$BiayaAco=array();
$SubtotalAco=0;
$a=0;
$id_panjar="";			
if($_SESSION["user"]!="" && $_SESSION["pass"]!=""){
$edit = mysql_query("select * from panjardb where id_panjar='".$_GET["nmr"]."'");
$editDb = mysql_fetch_assoc($edit);
if ($query) {
	header('location:index.php?menu=view');
}
$id_panjar = $editDb["id_panjar"];
if($_POST["makan"]){			
			$tgl = $_POST['tgl'];			
			$mkn_pg = $_POST['mkn_pg'];			
			$mkn_sg = $_POST['mkn_sg'];			
			$mkn_ml = $_POST['mkn_ml'];
			$dll	= $_POST['dll'];
			$hrglain=$_POST['hrglain'];
			$daily = $_POST['daily'];			
			$ket = $_POST['ket'];	
			$accom = $_POST['acomodation'];		
			$biaya = $_POST['BiayaAcom'];
			$query1 = mysql_query("insert into transmakan values ('','$id_panjar','$tgl','$mkn_pg','$mkn_sg','$mkn_ml','$dll','$hrglain','$daily','$accom','$biaya','$ket')") or die(mysql_error());
}
			if ($query1) {
				echo "<script>alert('$hrglain')</script>";
	echo "<script>document.location='?menu=claim&aksi=edit&nmr=$id_panjar&panjar=$uangpanjar'</script>";
}
makan();
trans();
$id_panjar = $editDb["id_panjar"];
if(isset($_POST['trans'])){
			$tgl_trans = $_POST['tgl_trans'];			
			$asal = $_POST['asal'];			
			$tujuan = $_POST['tujuan'];			
			$qty = $_POST['qty'];			
			$jns_trans = $_POST['jns_trans'];			
			$harga = $_POST['harga'];			
			$keterangan = $_POST['keterangan'];	
			$total = $qty * $harga;		
			$query2 = mysql_query("insert into transportasi values ('','$id_panjar','$tgl_trans','$asal','$tujuan','$qty','$jns_trans','$harga','$total','$keterangan')") or die(mysql_error());
			if ($query2) {
				echo "<script>document.location='?menu=claim&aksi=edit&nmr=$id_panjar&panjar=$uangpanjar'</script>";
	//header('location:index.php?menu=view');
}
}

?>
    <style type="text/css">
        .panel.panel-default .panel-body .table.table-striped.table-bordered.table-hover thead tr th {
            text-align: center;
        }
    </style>

    <div>
        <div class='panel panel-default'>
            <div class='panel-heading'>
                Aplikasi Panjar Pertamina
            </div>
            <div class='panel-body'>

                <form action="" method="POST" class="form-horizontal">
                    <div class="form-group">
                        <label class="control-label col-lg-4">No Pekerja</label>
                        <div class="col-lg-4">
                            <input type="text" name="no_pek" autofocus required class="form-control" readonly value="<?php echo $editDb['no_pek'];?>">

                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-lg-4">Nama Pekerja</label>
                        <div class="col-lg-4">
                            <input type="text" name="nama_pek" autofocus required class="form-control" readonly value="<?php echo $editDb['nama_pek'];?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-lg-4">No Trip</label>
                        <div class="col-lg-4">
                            <input type="text" name="no_trip" autofocus required class="form-control" readonly value="<?php echo $editDb['no_trip'];?>" />
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-lg-4">Tujuan</label>
                        <div class="col-lg-4">
                            <input type="text" name="pan_tujuan" autofocus required class="form-control" readonly value="<?php echo $editDb['pan_tujuan'];?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-lg-4">Tanggal Keberangkatan</label>
                        <div class="col-lg-2">
                            <input type="date" class="form-control" autofocus required placeholder="1998-05-09" name="tgl_acara" readonly value="<?php echo $editDb['tgl_acara'];?>"/>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-lg-4">Tanggal Kembali</label>
                        <div class="col-lg-2">
                            <input type="date" class="form-control" autofocus required placeholder="1998-05-09" name="tgl_kmbl" readonly value="<?php echo $editDb['tgl_kmbl'];?>" />
                        </div>
                    </div>
					<?php
					$QRegulasi=mysql_query("select * from panjardb where id_panjar='$IdPanjar'")or die(mysql_error());
					$CekReulasi=mysql_fetch_array($QRegulasi);
					if($CekReulasi['regulasi']==NULL)
					{?>
						<div class="pull-right">
							<a href="#addregulasi" class="btn btn-primary btn-rect" data-toggle="modal">Upload Regulasi</a>                               
						</div><br><br><br>
					<?php
					}else
					{?>
						<div class="pull-right">
							<a href="../image/FilesSpd/<?php echo $CekReulasi['regulasi']?>" class="btn btn-primary btn-rect" target="_blank" data-toggle="modal">Download</a>                               
						</div><br><br><br>
					<?php
					}
					?>



                    <div class='panel panel-default'>
                        <div class='panel-heading'>
                            Rincian Makan
                        </div>
                        <div class='panel-body'>
                            <div class="col-lg-2">
                                <a href="#myModal4" class="btn btn-primary btn-rect" data-toggle="modal">Tambah</a>
                                <p>
                            </div>
                            <table class="table table-striped table-bordered table-hover" border="2">
                                <thead>
                                    <tr>
                                        <th rowspan="2" text=center align=center>No</th>
                                        <th rowspan="2">Tanggal</th>
                                        <th colspan="4" align="center" valign="middle" nowrap="nowrap">Tujangan Makan</th>
                                        <th rowspan="2" align="center" valign="middle">Accommodation</th>
                                        <th rowspan="2" align="center" valign="middle">Daily Allowance</th>
                                        <th rowspan="2" align="center" valign="middle">Keterangan</th>
                                        <th width="60" rowspan="2" align="center" valign="middle">Aksi</th>
                                    </tr>
                                    <tr>
                                        <th align=center valign="middle">Makan Pagi</th>
                                        <th align="center" valign="middle">Makan Siang</th>
                                        <th>Makan Malam</th>
                                        <th>Makan lainnya</th>
                                    </tr>
                                </thead>

                                <?php
			
				$pjrSql = "SELECT * FROM transmakan where id_panjar = '".$editDb['id_panjar']."' ";
				$pjrQry = mysql_query($pjrSql , $server)  or die ("Query panjardb salah : ".mysql_error());
				$nomor  = 0 ; 
				while ($pjr = mysql_fetch_array($pjrQry)){
				$nomor++;
			?>
                                    <tbody>
                                        <tr>
                                            <td align=center>
                                                <?php echo  $nomor; ?>
                                            </td>
                                            <td align=center>
                                                <?php echo $pjr['tgl'];?>
                                            </td>
                                            <td align=center>
                                                <?php echo $pjr['mkn_pg'];?>
                                            </td>
                                            <td align=center>
                                                <?php echo $pjr['mkn_sg'];?>
                                            </td>
                                            <td align=center>
                                                <?php echo $pjr['mkn_ml'];?>
                                            </td>
                                            <td align=center>
                                                <?php echo $pjr['dll'];?>
                                            </td>                                            
                                            <td align=center>
                                                <?php echo $pjr['acomodation'];?>
                                            </td>
                                            <td align=center>
                                                <?php echo $pjr['daily'];?>
                                            </td>
                                            <td align=center>
                                                <?php echo $pjr['ket'];?>
                                            </td>
                                            <td>
                                                <div class='btn-group'>
                                                    <a href="?menu=claimdelete&aksi=hapus&id_makan=<?php echo $pjr['id_makan'];?>&id_panjar=<?php echo$id_panjar;?>&uangpanjar=<?php echo $uangpanjar;?>" class="btn btn-xs btn-danger tipsy-kiri-atas" title="Hapus Data Ini" onclick="return confirm('ANDA YAKIN AKAN MENGHAPUS DATA PENTING INI ... ?')"><img src='../image/hapus.png' /></a>
                                                </div>
                                            </td>
                                        </tr>
                                        <?php 
					$pagi+=$pjr['mkn_pg'];
					$siang+=$pjr['mkn_sg'];
					$malam+=$pjr['mkn_ml'];
					$lain+= $pjr['dll'];
					$hrglain+= ($pjr['dll']*$pjr['hrglain']);
					$Daily_Allowence+= $pjr['daily'];
					$com+=$pjr['acomodation'];
					$hcom+=$pjr['acomodation']*$pjr['BiayaAcom'];
					$Acco[]=array('acomo'=>$pjr['acomodation'], 'biaya'=>$pjr['BiayaAcom']);
					
					//print_r($Acco);
					
					
					} 					
					?>

                                        <tr style="background-color: yellow">
						<td colspan="2 " align=center><label>JUMLAH</td>
						<td align=center><label><?php echo $pagi;?></td>
						<td align=center><label><?php echo $siang;?></td>
						<td align=center><label><?php echo $malam;?></td>
						<td align=center><label><?php echo $lain;?></td>
						<td align=center><label><?php echo $com;?></td>
						<td align=center><label><?php echo $Daily_Allowence;?></td>
						<td colspan="2 " align=center></td>
					</tr>
				
				</tbody>	
			</table>
		</div>
		</div>
		<div class='panel panel-default'>
		<div class='panel-heading'>
			Rincian Transportasi
		</div>
		<div class='panel-body'>
		<div class="col-lg-2 ">
								<a href="#myModal5" class="btn btn-primary btn-rect" data-toggle="modal">Tambah</a><p>
							</div>	
			<table class="table table-striped table-bordered table-hover " border="0|0 ">
				<thead>
					<tr>
						<th>No</th>
						<th>Tanggal</th>							
						<th>From</th>
						<th>To</th>
						<th>Quantity</th>
						<th>Jenis Transportasi</th>
						<th>Harga<br>(Rp)</th>
						<th>Total<br>(Rp)</th>
						<th>Keterangan</th>
						<th width="60 " rowspan="2 " align="center " valign="middle ">Aksi</th>						
					</tr>
				</thead>
				
			<?php
			
				$transSql = "SELECT * FROM transportasi where id_panjar='".$editDb['id_panjar']."' ";
				$transQry = mysql_query($transSql , $server)  or die ("Query transdb salah : ".mysql_error());
				$nomor  = 0 ; 
				
				while ($trans = mysql_fetch_array($transQry)){
				$nomor++;
				
			?>
				<tbody>
					<tr>
						<?
						$d= preg_replace("/[^0-9]/ ", " ", $trans['harga'])*$trans['qty'];
						?>
						<td align=center ><?php echo  $nomor; ?></td> 
						<td align=center ><?php echo $trans['tgl_trans'];?></td>
						<td align=center ><?php echo $trans['asal'];?></td>
						<td align=center ><?php echo $trans['tujuan'];?></td>
						<td align=center ><?php echo $trans['qty'];?></td>
						<td align=center ><?php echo $trans['jns_trans'];?></td>
						<td align=center ><?php echo $trans['harga'];?></td>
						<td align="center "><?php echo number_format(preg_replace("/[^0-9]/ ", " ", $trans['harga'])*$trans['qty'],"2 ",", ",". "); ?> </td>
						<td align=center ><?php echo $trans['keterangan'];?></td>
						<td>
						  <div class='btn-group'>
						  <a href="?menu=claim2delete&aksi=hapus&nmr=<?php echo $trans[ 'id_trans']; ?>" class="btn btn-xs btn-danger tipsy-kiri-atas" title="Hapus Data Ini" onclick="return confirm('ANDA YAKIN AKAN MENGHAPUS DATA PENTING INI ... ?')"><img src='../image/hapus.png' /></a>
                        </div>
                        </td>
                        </tr>
                        <?php 
					$a+= preg_replace("/[^0-9]/", "", $trans['harga'])*$trans['qty'];
					} ?>
                        <?php
					$qry = mysql_query("select SUM() as jumlahtrans from transportasi where id_panjar='".$_GET["nmr"]."' ");
					$data = mysql_fetch_array($qry);
					?>
                            <tr style="background-color: yellow;">
						<td colspan="7 " align=center><label>JUMLAH</td>
						<td align="center "><label><?php echo number_format($a,"2 ",", ",". ");?></td>
						<td colspan="2 " align=center></td>
					</tr>
				
				</tbody>	
			</table>
		</div>
		</div>
		
		
		
		<div class='panel panel-default'>
		<div class='panel-heading'>
			Perhitungan Rincian Panjar Pertamina
		</div>
		<div class='panel-body'>
		<div class="col-md-12 ">
			<p><b>Meal Allowence</b></p>
		</div>
		
		<!--Makan Pagi -->
		<div class="col-md-4 ">
			<p>Uang Makan Pagi</p>
		</div>
		<div class="col-sm-1 ">
			<p><?php echo $pagi?></p>
		</div>
		<div class="col-sm-1 ">
			<p>x</p>
		</div>		
		<div class="col-md-1 ">
			<p class="pull-right ">75.000</p>
		</div>
		<div class="col-md-1 ">
			<p>=</p>
		</div>	
		<div class="col-sm-1 ">
			<p class="pull-left ">Rp.</p>
		</div>
		<div class="col-sm-1 " align="right ">
			<p class="pull-right "><?php echo number_format($pagi*75000,2,", ",". ") ?></p>
		</div>
		<div class="col-md-12 ">
		</div> 
		
		<!--Makan Siang -->
		<div class="col-md-4 ">
			<p>Uang Makan Siang</p>
		</div>
		<div class="col-sm-1 ">
			<p><?php echo $siang?></p>
		</div>
		<div class="col-sm-1 ">
			<p>x</p>
		</div>		
		<div class="col-md-1 ">
			<p class="pull-right ">75.000</p>
		</div>
		<div class="col-md-1 ">
			<p>=</p>
		</div>	
		<div class="col-md-1 ">
			<p class="pull-left ">Rp.</p>
		</div>
		<div class="col-md-1 " align="right ">
			<p class="pull-right "><?php echo number_format($siang*75000,2,", ",". ") ?></p>
		</div>
		<div class="col-md-12 ">
		</div>
		
		<!--Makan Malam -->
		<div class="col-md-4 ">
			<p>Uang Makan Malam</p>
		</div>
		<div class="col-md-1 ">
			<p><?php echo $malam?></p>
		</div>
		<div class="col-md-1 ">
			<p>x</p>
		</div>		
		<div class="col-md-1 ">
			<p class="pull-right ">75.000</p>
		</div>
		<div class="col-md-1 ">
			<p>=</p>
		</div>	
		<div class="col-md-1 ">
			<p class="pull-left ">Rp.</p>
		</div>
		<div class="col-md-1 " align="right ">
			<p class="pull-right "><?php echo number_format($malam*75000,2,", ",". ") ?></p>
		</div>
		<!--invoice -->
		<div class="col-md-4 ">
			<p>Uang Makan ada Invoice</p>
		</div>
		<div class="col-md-1 ">
			<p></p>
		</div>
		<div class="col-md-1 ">
			<p></p>
		</div>		
		<div class="col-md-1 ">
			<p class="pull-right "></p>
		</div>
		<div class="col-md-1 ">
			<p>=</p>
		</div>	
		<div class="col-md-1 ">
			<p class="pull-left ">Rp.</p>
		</div>
		<div class="col-md-1 " align="right ">
			<p class="pull-right "><?php echo number_format($hrglain,2,", ",". ") ?></p>
		</div>
		
		<div class="col-md-4 ">
		</div>
		<div class="col-md-4 ">
			<p class=" "><b>Total</b></p>
		</div>
		<div class="col-md-1 ">
			<p class="pull-left "><b>Rp.</b></p>
		</div>
		<div class="col-md-1 ">
			<p class="pull-right "><b><u><?php echo number_format(($malam*75000)+($siang*75000)+($pagi*75000)+$hrglain,2,", ",". ") ?></u></b></p>
		</div>
		
		<div class="col-md-12 "><p></p></div>
		<div class="col-md-12 "><p></p></div>
		
		<div class="col-md-12 ">
			<p><b>Accommodation</b></p>
		</div>
		
		<?php
		
		foreach($Acco as $item)
		{
			$SubtotalAco+=($item['acomo']*$item['biaya']);
			?>					
					
			
			<div class="col-md-4 ">
				<p>Accommodation</p>
			</div>
			<div class="col-md-1 ">
				<p><?php echo $item['acomo']?></p>
			</div>
			<div class="col-md-1 ">
				<p>x</p>
			</div>		
			<div class="col-md-1 ">
				<p class="pull-right "><?php echo number_format($item['biaya'],2,", ",". ") ?></p>
			</div>
			<div class="col-md-1 ">
				<p>=</p>
			</div>	
			<div class="col-md-1 ">
				<p class="pull-left ">Rp.</p>
			</div>
			<div class="col-md-1 " align="right ">
				<p class="pull-right "><?php echo number_format($item['acomo']*$item['biaya'],2,", ",". ")?></p>
			</div>
			<div class="col-md-12 "></div>
			
		<?php
		}	
		?>
		<div class="col-md-4 ">
				<p></p>
			</div>
			<div class="col-md-1 ">
				<p>Total</p>
			</div>
			<div class="col-md-1 ">
				<p></p>
			</div>		
			<div class="col-md-1 ">
				<p class="pull-right "></p>
			</div>
			<div class="col-md-1 ">
				<p>=</p>
			</div>	
			<div class="col-md-1 ">
				<p class="pull-left ">Rp.</p>
			</div>
			<div class="col-md-1 " align="right ">
				<p class="pull-right "><?php echo number_format($SubtotalAco,2,", ",". ")?></p>
			</div>
			<div class="col-md-12 "></div>
		<div class="col-md-12 "><p></p></div>
			<div class="col-md-12 "><p></p></div>
		
		
		<div class="col-md-4 ">
			<p><b>Daily Allowence</b></p>
		</div>
		<div class="col-sm-1 ">
			<p><?php echo $Daily_Allowence?></p>
		</div>
		<div class="col-sm-1 ">
			<p>x</p>
		</div>		
		<div class="col-md-1 ">
			<p class="pull-right ">100.000</p>
		</div>
		<div class="col-md-1 ">
			<p>=</p>
		</div>	
		<div class="col-sm-1 ">
			<p class="pull-left ">Rp.</p>
		</div>
		<div class="col-sm-1 " align="right ">
			<p class="pull-right "><?php echo number_format($Daily_Allowence*100000,2,", ",". ") ?></p>
		</div>
		<div class="col-md-12 ">
		</div> 
		
			
		</div>
		</div>
		
		<?php
		$STtl=$SubtotalAco+($malam*75000)+($siang*75000)+($pagi*75000)+$hrglain+($Daily_Allowence*100000)+$a;
		?>
		<div class="col-md-5 "></div>
		<div class="col-md-7 ">
			<div class='panel panel-default'>
				<div class='panel-body'>
					<div class="col-md-3 ">
						<div class="pull-left ">Sub Total</div>
					</div>
					<div class="col-md-1 ">
						<div class="pull-left ">=</div>
					</div>
					<div class="col-md-3 ">
						<div class="pull-left ">Rp.</div>
					</div>
					<div class="col-md-2 ">
						<div class="pull-right "><?php echo number_format($STtl,2,", ",". ") ?></div>
					</div>
				</div>
				<div class='panel-body'>
					<div class="col-md-3 ">
						<div class="pull-left ">Panjar Dinas</div>
					</div>
					<div class="col-md-1 ">
						<div class="pull-left ">=</div>
					</div>
					<div class="col-md-3 ">
						<div class="pull-left ">Rp.</div>
					</div>
					<div class="col-md-2 ">
						<div class="pull-right "><?php echo number_format($uangpanjar,2,", ",". ") ?></div>
					</div>
				</div>
				<div class='panel-body'>
					<div class="col-md-3 ">
						<div class="pull-left ">Total Claim</div>
					</div>
					<div class="col-md-1 ">
						<div class="pull-left ">=</div>
					</div>
					<div class="col-md-3 ">
						<div class="pull-left ">Rp.</div>
					</div>
					<div class="col-md-2 ">
						<div class="pull-right "><?php echo number_format($STtl-$uangpanjar,2,", ",". ") ?></div>
					</div>
				</div>
				
			</div>
			
		</div>
		<div class="pull-left ">
				<?php 
				$qcek = mysql_query("select * from ttd where id_panjar='$id_panjar'")or die(mysql_error());
				$ada=mysql_num_rows($qcek);
				$datapejabat=mysql_fetch_array($qcek);
				if($ada==0)
				{
				?>
					<a href="#addpejabat" data-toggle="modal"><img src='../image/addpejabat.ico' width="50px" height="50px" /></a>
				<?php
				}else
				{					
					$namas1	= $datapejabat[2];
					$jabatans1 = $datapejabat[3];
					$namas2	= $datapejabat[4];
					$jabatans2 = $datapejabat[5];
				?>
					<a href="#editpejabat" data-toggle="modal"><img src='../image/addpejabat.ico' width="50px" height="50px" /></a>
				<?php
				}
				?>
				
				<a target="_blank " href="report.php?aksi=print&IdPanjar=<?php echo $id_panjar;?>&uangpanjar=<?php echo $_GET['panjar']?>"><img src='../image/printer.png' width="50px " height="50px " /></a> 
				<a target="_blank " href="report.php?aksi=excel"><img src='../image/excel.png' width="50px " height="50px " /></a>
				</div>
		
		</form>
		</div>
	</div>
</div>
<?php 

} ?>
<?php
}else{
	header("Location:../index.php ");
}
if(isset($_POST['addpejabat']))
{
	$nama1 		= $_POST['nama1'];
	$jabatan1	= $_POST['jabatan1'];
	$nama2 		= $_POST['nama2'];
	$jabatan2	= $_POST['jabatan2'];
	$Simpan=mysql_query("insert into ttd values('','$IdPanjar','$nama1','$jabatan1','$nama2','$jabatan2')")or die(mysql_error());
	if($Simpan)
	{	
		echo "<script>alert('Sucsess')</script>";
		echo "<script>document.location='?menu=claim&aksi=edit&nmr=$IdPanjar&panjar=$Panjar'</script>";
	}
	else
	{
		echo "<script>alert('Gagal')</script>";
		echo "<script>document.location='?menu=claim&aksi=edit&nmr=$IdPanjar&panjar=$Panjar'</script>";
	}
	
}

if(isset($_POST['updatepejabat']))
{
	$nama1 		= $_POST['nama1'];
	$jabatan1	= $_POST['jabatan1'];
	$nama2 		= $_POST['nama2'];
	$jabatan2	= $_POST['jabatan2'];
	$update = mysql_query("update ttd set nama1='$nama1', nama2='$nama2', jabatan1='$jabatan1', jabatan2='$jabatan2'")or die(mysql_error());
	if($update)
	{
		echo "<script>alert('Update Sucsess')</script>";
		echo "<script>document.location='?menu=claim&aksi=edit&nmr=$IdPanjar&panjar=$Panjar'</script>";
	}
}

?>

<div id="editpejabat" class="modal fade">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					<h4 class="modal-title">Edit Pejabat Penanggung Jawab</h4>
				</div>
				<div class="modal-body">
				<form action="" method="POST">
					<form action="" method="post">
						<div class="form-group">
							<label class="control-label col-lg">Nama Pejabat</label>
							<input type="text" required class="form-control" name="nama1" value="test"/>
						</div>
					<form action="" method="post">
						<div class="form-group">
							<label class="control-label col-lg">Jabatan</label>
							<input type="text" required class="form-control" name="jabatan1" value="<?php echo $jabatans1;?>"/>
						</div>
					<form action="" method="post">
						<div class="form-group">
							<label class="control-label col-lg">Nama Pejabat</label>
							<input type="text" required class="form-control" name="nama2" value="<?php echo $namas2;?>"/>
						</div>
					<form action="" method="post">
						<div class="form-group">
							<label class="control-label col-lg">Jabatan</label>
							<input type="text" required class="form-control" name="jabatan2" value="<?php echo $jabatans2;?>"/>
						</div>
							<input type="submit" class="btn btn-primary" name="updatepejabat" value="Update"/>
					</form>
					</form>
				</div>
			</div>
		</div>
	</div>

<?php
	if(isset($_POST['Upload']))
	{
		$file		= $_FILES['FileRegulasi']['name'];
		//echo"<script>alert('Succsess')</script>";


		$direktori = '../image/FilesSpd/';
		$max_size  = 4000000; //Ukuran file maximal 4Mb
		$nama_file = $_FILES['FileRegulasi']['name'];
		$file_size = $_FILES['FileRegulasi']['size'];
		$nama_tmp  = $_FILES['FileRegulasi']['tmp_name'];
		$upload 	= (file_exists($direktori.$nama_file)) ? $direktori." copy of ".$nama_file : $direktori.$nama_file;//Memposisikan direktori penyimpanan dan file
		if((isset($nama_file)) && ($nama_file != ""))
		{
			if($file_size <= $max_size)
			{	
			  move_uploaded_file($nama_tmp, $upload);	
			 if($upload)
			 {				
				$simpanRegulasi = mysql_query("update panjardb set regulasi='$file' where id_panjar='$IdPanjar'")or die (mysql_error());
				if($simpanRegulasi)
				{
					echo "<script language=javascript>\n";
					echo "window.alert('File Regulasi berhasil di upload')";
					echo "</script>";
					echo "<script>document.location='?menu=claim&aksi=edit&nmr=$id_panjar&panjar=$uangpanjar'</script>";
				}
				   //echo "<script>document.location='?p=dafregulasi'</script>";
			}
			 //echo "File Berhasil diupload ke Direktori: ".$direktori.$nama_file."";
			 else{
				   echo "<script language=javascript>\n";
				   echo "window.alert('Maaf, $file GAGAL diupload')";
				   echo "</script>";	
			   }
		   }
		   else
		   {
			   echo "window.alert('Maaf, File $file GAGAL diupload, karena lebih dari $max_size ')";
		   }
		}
	   else
	   {
		//Jika ukuran file lebih besar dari yang ditentukan
			   echo "<script language=javascript>\n";
			   echo "window.alert('Tidak ada file ')";
			   echo "</script>";	
		
		//echo "File ".$nama_file." Gagal di Upload, karena terlalu besar, batas yang ditentukan adalah : ".$max_size." bait.";
	   }	
	}
?>