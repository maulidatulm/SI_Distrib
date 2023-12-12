<?php

namespace Master;

use Config\Query_builder;

class distribusi
{
    private $db;
    public function __construct($con)
    {
        $this->db = new Query_builder($con);
    }
    public function index()
    {
        $data = $this->db->table('distribusi')->get()->resultArray();
        $res = '<a href="?target=distribusi&act=tambah_distribusi" class="btn btn-info btn-sm">Tambah distribusi</a><br><br>
        <div class="table-responsive">
        <table class="table table-striped">
            <thead class="table-primary">
                <tr>
                    <th>id_distribusi</th>
                    <th>id_pesanan</th>
                    <th>id_alokon</th>
                    <th>Tanggal</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>';
        $no = 1;
        foreach ($data as $r) {
            $res .= '<tr>
                <td width="100">' . $r['id_distribusi'] . '</td>
                <td>' . $r['id_pesanan'] . '</td>
                <td>' . $r['id_alokon'] . '</td>
                <td>' . $r['tgl_distribusi'] . '</td>
                <td width="150">
                    <a href="?target=distribusi&act=edit_distribusi&id=' . $r['id_distribusi'] . '" class="btn btn-primary btn-sm">Edit</a>
                    <a href="?target=distribusi&act=delete_distribusi&id=' . $r['id_distribusi'] . '" class="btn btn-danger btn-sm">Hapus</a>
                </td>';
            $no++;
        }
        $res .= '</tbody></table></div>';
        return $res;
    }
    public function tambah()
    {
        $res = '<a href="?target=distribusi" class="btn btn-danger btn-sm">Kembali</a><br><br>';
        $res .= '<form method="post" action="?target=distribusi&act=simpan_distribusi">
            <div class="mb-3">
                <label for="id_distribusi" class="form-label">id_distribusi</label>
                <input type="text" class="form-control" id="id_distribusi" name="id_distribusi">
            </div>
            <div class="mb-3">
                <label for="id_pesanan" class="form-label">id_pesanan</label>
                <input type="text" class="form-control" id="id_pesanan" name="id_pesanan">
            </div>
            <div class="mb-3">
                <label for="id_alokon" class="form-label">id_alokon</label>
                <input type="text" class="form-control" id="id_alokon" name="id_alokon">
            </div>
            <div class="mb-3">
                <label for="tgl_distribusi" class="form-label">tgl_distribusi</label>
                <input type="date" class="form-control" id="tgl_distribusi" name="tgl_distribusi">
            </div>

            <button type="submit" class="btn btn-primary">Simpan</button>
        </form>';

        return $res;
    }

    public function simpan()
    {
        $id_distribusi = $_POST['id_distribusi'];
        $id_pesanan = $_POST['id_pesanan'];
        $id_alokon = $_POST['id_alokon'];
        $tgl_distribusi = $_POST['tgl_distribusi'];

        $data = array(
            'id_distribusi' => $id_distribusi,
            'id_pesanan' => $id_pesanan,
            'id_alokon' => $id_alokon,
            'tgl_distribusi' => $tgl_distribusi,
        );
        return $this->db->table('distribusi')->insert($data);
    }
    public function edit($id)
    {
        // get data distribusi
        $r = $this->db->table('distribusi')->where("id_distribusi='$id'")->get()->rowArray();
        //cek radio

        $res = '<a href="?target=distribusi" class="btn btn-danger btn-sm">Kembali</a><br><br>';
        $res .= '<form method="post" action="?target=distribusi&act=update_distribusi">
            <input type="hidden" class="form-control" id="param" name="param" value="' . $r['id_distribusi'] . '">

            <div class="mb-3">
                <label for="id_distribusi" class="form-label">id_distribusi</label>
                <input type="text" class="form-control" id="id_distribusi" name="id_distribusi" value="' . $r['id_distribusi'] . '">
            </div>
            <div class="mb-3">
                <label for="id_pesanan" class="form-label">id_distribusi</label>
                <input type="text" class="form-control" id="id_pesanan" name="id_pesanan" value="' . $r['id_pesanan'] . '">
            </div>
            <div class="mb-3">
                <label for="id_alokon" class="form-label">id_alokon</label>
                <input type="text" class="form-control" id="id_alokon" name="id_alokon" value="' . $r['id_alokon'] . '">
            </div>
            <div class="mb-3">
                <label for="tgl_distribusi" class="form-label">tgl_distribusi</label>
                <input type="text" class="form-control" id="tgl_distribusi" name="tgl_distribusi" value="' . $r['tgl_distribusi'] . '">
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
        $id_distribusi = $_POST['id_distribusi'];
        $id_pesanan = $_POST['id_pesanan'];
        $id_alokon = $_POST['id_alokon'];
        $tgl_distribusi = $_POST['tgl_distribusi'];

        $data = array(
            'id_distribusi' => $id_distribusi,
            'id_pesanan' => $id_pesanan,
            'alamat' => $alamat,
            'id_alokon' => $id_alokon,
            'tgl_distribusi' => $tgl_distribusi,
        );
        return $this->db->table('distribusi')->where("id_distribusi='$param'")->update($data);
    }

    public function delete($id)
    {
        return $this->db->table('distribusi')->where("id_distribusi='$id'")->delete();
    }
}
