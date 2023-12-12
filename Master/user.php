<?php

namespace Master;

use Config\Query_builder;

class user
{
    private $db;
    public function __construct($con)
    {
        $this->db = new Query_builder($con);
    }
    public function index()
    {
        $data = $this->db->table('user')->get()->resultArray();
        $res = '<a href="?target=user&act=tambah_user" class="btn btn-info btn-sm">Tambah user</a><br><br>
        <div class="table-responsive">
        <table class="table table-striped">
            <thead class="table-primary">
                <tr>
                    <th>No</th>
                    <th>id_user</th>
                    <th>Nama</th>
                    <th>username</th>
                    <th>password</th>
                    <th>Act</th>
                </tr>
            </thead>
            <tbody>';
        $no = 1;
        foreach ($data as $r) {
            $res .= '<tr>
                <td width="10">' . $no . '</td>
                <td>' . $r['id_user'] . '</td>
                <td>' . $r['fullname'] . '</td>
                <td>' . $r['username'] . '</td>
                <td>' . $r['password'] . '</td>
                <td width="150">
                    <a href="?target=user&act=edit_user&id=' . $r['id_user'] . '" class="btn btn-primary btn-sm">Edit</a>
                    <a href="?target=user&act=delete_user&id=' . $r['id_user'] . '" class="btn btn-danger btn-sm">Hapus</a>
                </td>';
            $no++;
        }
        $res .= '</tbody></table></div>';
        return $res;
    }
    public function tambah()
    {
        $res = '<a href="?target=user" class="btn btn-danger btn-sm">Kembali</a><br><br>';
        $res .= '<form method="post" action="?target=user&act=simpan_user">
            <div class="mb-3">
                <label for="password" class="form-label">Nama Kabid</label>
                <input type="text" class="form-control" id="password" name="password">
            </div>
            <div class="mb-3">
                <label for="fullname" class="form-label">fullname</label>
                <input type="text" class="form-control" id="fullname" name="fullname">
            </div>
            <div class="mb-3">
                <label for="username" class="form-label">username</label>
                <input type="text" class="form-control" id="username" name="username">
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">password</label>
                <input type="text" class="form-control" id="password" name="password">
            </div>

            <button type="submit" class="btn btn-primary">Simpan</button>
        </form>';

        return $res;
    }

    public function simpan()
    {
        $id_user = $_POST['id_user'];
        $fullname = $_POST['fullname'];
        $username = $_POST['username'];
        $password = $_POST['password'];

        $data = array(
            'id_user' => $id_user,
            'fullname' => $fullname,
            'username' => $username,
            'password' => $password,

        );
        return $this->db->table('user')->insert($data);
    }
    public function edit($id)
    {
        // get data user
        $r = $this->db->table('user')->where("id_user='$id'")->get()->rowArray();
        //cek radio

        $res = '<a href="?target=user" class="btn btn-danger btn-sm">Kembali</a><br><br>';
        $res .= '<form method="post" action="?target=user&act=update_user">
            <input type="hidden" class="form-control" id="param" name="param" value="' . $r['id_user'] . '">

            <div class="mb-3">
                <label for="id_user" class="form-label">Nama Kabid</label>
                <input type="text" class="form-control" id="id_user" name="id_user" value="' . $r['id_user'] . '">
            </div>
            <div class="mb-3">
                <label for="fullname" class="form-label">fullname</label>
                <input type="text" class="form-control" id="fullname" name="fullname" value="' . $r['fullname'] . '">
            </div>
            <div class="mb-3">
                <label for="username" class="form-label">username</label>
                <input type="text" class="form-control" id="username" name="username" value="' . $r['username'] . '">
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">password</label>
                <input type="text" class="form-control" id="password" name="password" value="' . $r['password'] . '">
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
        $id_user = $_POST['id_user'];
        $fullname = $_POST['fullname'];
        $username = $_POST['username'];
        $password = $_POST['password'];
       
        $data = array(
            'id_user' => $id_user,
            'fullname' => $fullname,
            'username' => $username,
            'password' => $password,
            
        );
        return $this->db->table('user')->where("id_user='$param'")->update($data);
    }

    public function delete($id)
    {
        return $this->db->table('user')->where("id_user='$id'")->delete();
    }
}
