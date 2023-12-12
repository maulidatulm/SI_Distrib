<?php

namespace Master;

use Config\Query_builder;

class alokon
{
    private $db;
    public function __construct($con)
    {
        $this->db = new Query_builder($con);
    }
    public function index()
    {
        $data = $this->db->table('alokon')->get()->resultArray();
        $res = '<a href="?target=alokon&act=tambah_alokon" class="btn btn-info btn-sm">Tambah alokon</a><br><br>
        <div class="table-responsive">
        <table class="table table-striped">
            <thead class="table-primary">
                <tr>
                    <th>id_alokon</th>
                    <th>nama_alokon</th>
                    <th>stok</th>
                    <th>action</th>
                </tr>
            </thead>
            <tbody>';
        $no = 1;
        foreach ($data as $r) {
            $res .= '<tr>
                <td width="100">' . $r['id_alokon'] . '</td>
                <td>' . $r['nama_alokon'] . '</td>
                <td>' . $r['stok'] . '</td>
                <td width="150">
                    <a href="?target=alokon&act=edit_alokon&id=' . $r['id_alokon'] . '" class="btn btn-primary btn-sm">Edit</a>
                    <a href="?target=alokon&act=delete_alokon&id=' . $r['id_alokon'] . '" class="btn btn-danger btn-sm">Hapus</a>
                </td>';
            $no++;
        }
        $res .= '</tbody></table></div>';
        return $res;
    }
    public function tambah()
    {
        $res = '<a href="?target=alokon" class="btn btn-danger btn-sm">Kembali</a><br><br>';
        $res .= '<form method="post" action="?target=alokon&act=simpan_alokon">
            <div class="mb-3">
                <label for="id_alokon" class="form-label">id_alokon</label>
                <input type="text" class="form-control" id="id_alokon" name="id_alokon">
            </div>
            <div class="mb-3">
                <label for="nama_alokon" class="form-label">Nama</label>
                <input type="text" class="form-control" id="nama_alokon" name="nama_alokon">
            </div>
            <div class="mb-3">
                <label for="stok" class="form-label">stok</label>
                <input type="text" class="form-control" id="stok" name="stok">
            </div>

            <button type="submit" class="btn btn-primary">Simpan</button>
        </form>';

        return $res;
    }

    public function simpan()
    {
        $id_alokon = $_POST['id_alokon'];
        $nama_alokon = $_POST['nama_alokon'];
        $stok = $_POST['stok'];
        $data = array(
            'id_alokon' => $id_alokon,
            'nama_alokon' => $nama_alokon,
            'stok' => $stok,
        );
        return $this->db->table('alokon')->insert($data);
    }
    public function edit($id)
    {
        // get data alokon
        $r = $this->db->table('alokon')->where("id_alokon='$id'")->get()->rowArray();
        //cek radio

        $res = '<a href="?target=alokon" class="btn btn-danger btn-sm">Kembali</a><br><br>';
        $res .= '<form method="post" action="?target=alokon&act=update_alokon">
            <input type="hidden" class="form-control" id="param" name="param" value="' . $r['id_alokon'] . '">
            <div class="mb-3">
                <label for="id_alokon" class="form-label">ID</label>
                <input type="text" class="form-control" id="id_alokon" name="id_alokon" value="' . $r['id_alokon'] . '">
            </div>
            <div class="mb-3">
                <label for="nama_alokon" class="form-label">Nama alokon</label>
                <input type="text" class="form-control" id="nama_alokon" name="nama_alokon" value="' . $r['nama_alokon'] . '">
            </div>
            <div class="mb-3">
                <label for="stok" class="form-label">stok</label>
                <input type="text" class="form-control" id="stok" name="stok" value="' . $r['stok'] . '">
            </div>


            <button type="submit" class="btn btn-primary">Ubah</button>
        </form>';
        return $res;
    }

    public function cekRadio($val, $val2)
    {
        if ($val == $val2) {
            return "checked";
        }
        return "";
    }

    public function update()
    {
        $param = $_POST['param'];
        $id_alokon = $_POST['id_alokon'];
        $nama_alokon = $_POST['nama_alokon'];
        $stok = $_POST['stok'];

        $data = array(
            'id_alokon' => $id_alokon,
            'nama_alokon' => $nama_alokon,
            'stok' => $stok,
        );
        return $this->db->table('alokon')->where("id_alokon='$param'")->update($data);
    }

    public function delete($id)
    {
        return $this->db->table('alokon')->where("id_alokon='$id'")->delete();
    }
}
