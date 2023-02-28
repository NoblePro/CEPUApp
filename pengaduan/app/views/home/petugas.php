<?php setcookie('error', null, 0, '/'); ?>
<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Selamat Datang, <?= explode(' ', $data[0]['nama'])[0]; ?></title>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous">
	</script>
	<link rel="stylesheet" type="text/css" href="./jQuery MultiSelect Widget Demo_files/jquery-ui.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
	<style>
		textarea {
			width: 100% !important;
		}

		table,
		tr,
		td {
			border: 1px solid black;
			color: white !important;
		}
	</style>
	<script type="text/javascript">
		function tekan() {
			$("#print").hide();
			window.print();
			$("#print").show();
		}
	</script>
</head>

<body>
	<center>
		<h1 style="margin-top:40px; color:blue; margin-bottom:30px">CEPU App</h1>
		<div class="card" style="background-color:#00a92c; color:white">
			<div class="card-body">
				<h1 style="text-decoration:underline; margin-bottom: 20px">Daftar Laporan</h1>
				<?php
				if (empty($data[1])) {
					echo '<h1 style="text-decoration:underline; margin-bottom: 20px">Tidak Ada Laporan!</h1>';
				} else { ?>
					<table class="table table-striped">
						<tr style="text-align: center">
							<td>No</td>
							<td>Pengadu</td>
							<td>Gambar</td>
							<td>Pengaduan</td>
							<td>Tanggapan & Status</td>
							<td>Aksi</td>
						</tr>
						<?php
						$i = 1;
						foreach ($data[1] as $row) {
						?>
							<tr style="text-align: center">
								<td><?= $i; ?>.</td>
								<td><?= $row['nama'] . ' - ' . $row['nik']; ?></td>
								<td><img src="data:image/png;base64,<?= $row['foto']; ?>" class="img-thumbnail" style="width:100px"></td>
								<td><textarea class="form-control" aria-label="readonly input example" readonly><?= $row['laporan']; ?></textarea></td>
								<td>
									<?php if ($row['status'] != "belum") {
										foreach ($data[2] as $tanggapan) { 
											if ($tanggapan['id_peg'] == $row['id_laporan']) { ?>
												<textarea class="form-control" aria-label="readonly input example" readonly><?= $tanggapan['tanggapan']; ?></textarea>
									<?php }
										}
									}
									?>
									<?php if ($row['status'] == "belum") {
										echo '<br>Belum Diproses';
									} else if ($row['status'] == "proses") {
										echo 'Sedang Diproses';
									} else if ($row['status'] == "selesai") {
										echo 'Selesai';
									} ?>
								</td>
								<?php
								if ($row['status'] != "selesai") { ?>
									<td><a href="<?= BASEURL; ?>home/proses/<?= $row['id_laporan']; ?>" class="btn btn-outline-dark text-white">Proses</a></td>
								<?php } else { ?>
									<td><a class="btn btn-outline-dark text-white">Selesai</a></td>
								<?php } ?>
						<?php $i++;
						}
					} ?>
							</tr>
					</table>
			</div>
		</div>
		<div style="margin-bottom:60px; margin-top:30px">
			<a href="<?= BASEURL ?>login" class="btn btn-outline-info">LOGOUT</a>
		</div>
	</center>
</body>

</html>