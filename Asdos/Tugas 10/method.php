<?php
require_once "koneksi.php";

class Mahasiswa {
    public function get_mahasiswa($id = 0) {
        global $koneksi;
        $query = "SELECT * FROM mahasiswa" . ($id ? " WHERE id=$id" : "");
        $result = $koneksi->query($query);
        $data = [];

        while ($row = mysqli_fetch_assoc($result)) {
            $data[] = $row;
        }

        echo json_encode([
            'status' => 1,
            'data' => $data
        ]);
    }

    public function insert_mahasiswa() {
        global $koneksi;
        $nama = $_POST['nama'];
        $nim = $_POST['nim'];
        $jurusan = $_POST['jurusan'];

        $query = "INSERT INTO mahasiswa(nama, nim, jurusan) VALUES('$nama','$nim','$jurusan')";
        $result = $koneksi->query($query);

        echo json_encode([
            'status' => $result ? 1 : 0,
            'message' => $result ? "Mahasiswa ditambahkan" : "Gagal menambahkan"
        ]);
    }

    public function update_mahasiswa($id) {
        global $koneksi;
        $nama = $_POST['nama'];
        $nim = $_POST['nim'];
        $jurusan = $_POST['jurusan'];

        $query = "UPDATE mahasiswa SET nama='$nama', nim='$nim', jurusan='$jurusan' WHERE id=$id";
        $result = $koneksi->query($query);

        echo json_encode([
            'status' => $result ? 1 : 0,
            'message' => $result ? "Mahasiswa diupdate" : "Gagal update"
        ]);
    }

    public function delete_mahasiswa($id) {
        global $koneksi;
        $query = "DELETE FROM mahasiswa WHERE id=$id";
        $result = $koneksi->query($query);

        echo json_encode([
            'status' => $result ? 1 : 0,
            'message' => $result ? "Data dihapus" : "Gagal hapus"
        ]);
    }
}
?>
