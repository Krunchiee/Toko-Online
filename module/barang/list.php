<?php
$search = isset($_GET['search']) ? $_GET['search'] : false;
$search = isset($_GET['search']) ? $_GET['search'] : false;
$where = "";
$search_url = "";
if($search){
    $search_url = "&search=$search";
    $where = "WHERE barang.nama_barang LIKE '%$search%'";
}
?>
<div id="frame-tambah">
    <div id ="left">
        <form action="<?php echo BASE_URL."index.php"; ?>" method="GET">
        <input type="hidden" name="page" value="<?php echo $_GET["page"]; ?>"/>
        <input type="hidden" name="module" value="<?php echo $_GET["module"]; ?>"/>
        <input type="hidden" name="action" value="<?php echo $_GET["action"]; ?>"/>
        <input type="text" name="search" value="<?php echo $search; ?>"/>
        <input type="submit" value="search"/>
        </form>
    </div>
    <div id ="right">
        <a href="<?php echo BASE_URL."index.php?page=my_profile&module=barang&action=form";?>" class="tombol-action">+ Tambah Barang</a>
    </div>
</div>

<?php

    $queryBarang = mysqli_query($koneksi, "SELECT barang.*, kategori.kategori FROM barang JOIN kategori ON barang.kategori_id = kategori.kategori_id $where ORDER BY nama_barang");
    if(mysqli_num_rows($queryBarang)==0){
        echo "<h3>Saat Ini Belum Ada Barang</h3>";
    }else{
        echo "<table class='table-list'>";

        echo "<tr class='baris-title'>
            <th class='kolom-nomor'>No</th>
            <th class='kiri'>Barang</th>
            <td class='kiri'>Kategori</td>
            <th class='kiri'>Harga</th>
            <th class='tengah'>Status</th>
            <th class='tengah'>Action</th>
            </tr>";

        $no=1;
        while($row=mysqli_fetch_assoc($queryBarang)){

            echo "<tr>
                    <td class='kolom-nomor'>$no</td>
                    <td class='kiri'>$row[nama_barang]</td>
                    <td class='kiri'>$row[kategori]</td>
                    <td class='kiri'>".rupiah($row["harga"])."</td>
                    <td class='tengah'>$row[status]</td>
                    <td class='tengah'>
                        <a class='tombol-action' href='".BASE_URL."index.php?page=my_profile&module=barang&action=form&barang_id=$row[barang_id]' >Edit</a>
                        <a class='tombol-action' href='".BASE_URL."module/barang/action.php?button=Delete&barang_id=$row[barang_id]' >Hapus</a>

                    </td>
                </tr>";
            $no++;
        }

        echo "</table>";
    }
?>