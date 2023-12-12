<?php

use Master\Menu;
use Master\alokon;
use Master\distribusi;
use Master\user;

include 'autoload.php';
include 'Config/Database.php';

$menu = new Menu();
$alokon = new alokon($dataKoneksi);
$distribusi = new distribusi($dataKoneksi);
$user = new user($dataKoneksi);
// $mahasiswa->tambah();
$target = @$_GET['target'];
$act = @$_GET['act'];
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>UTS</title>
    <link href="assets/bootstrap/css/bootstrap.css" rel="stylesheet">
    <script src="assets/bootstrap/js/bootstrap.bundle.min.js"></script>
</head>

<body>
    <div class="container">
        <nav class="navbar navbar-expand-lg navbar-dark bg-info">
            <div class="container-fluid">
                <a class="navbar-brand" href="">CRUD OOP</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#MyMenu" aria- controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="MyMenu">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <?php
foreach ($menu->topMenu() as $r) {
    ?>
                            <li class="nav-item">
                                <a href="<?php echo $r['Link']; ?>" class="nav-link">
                                    <?php echo $r['Text']; ?>
                                </a>
                            </li>
                        <?php
}
?>
                    </ul>
                </div>
            </div>
        </nav>
        <br>
        <div class="content">
            <h5>Content <?php echo strtoupper($target); ?></h5>
            <?php
if (!isset($target) or $target == "home") {
    echo "Hai, Selamat Datang Di Beranda";
    // =========== start kontent alokon ======================
} elseif ($target == "alokon") {
    if ($act == "tambah_alokon") {
        echo $alokon->tambah();
    } elseif ($act == "simpan_alokon") {
        if ($alokon->simpan()) {
            echo "<script>
                            alert('data sukses disimpan');
                            window.location.href='?target=alokon';
                        </script>";
        } else {
            echo "<script>
                            alert('data gagal disimpan');
                            window.location.href='?target=alokon';
                        </script>";
        }
    } elseif ($act == "edit_alokon") {
        $id = $_GET['id'];
        echo $alokon->edit($id);
    } elseif ($act == "update_alokon") {
        if ($alokon->update()) {
            echo "<script>
                            alert('data sukses diubah');
                            window.location.href='?target=alokon';
                        </script>";
        } else {
            echo "<script>
                            alert('data gagal diubah');
                            window.location.href='?target=alokon';
                        </script>";
        }
    } elseif ($act == "delete_alokon") {
        $id = $_GET['id'];
        if ($alokon->delete($id)) {
            echo "<script>
                            alert('data sukses dihapus');
                            window.location.href='?target=alokon';
                        </script>";
        } else {
            echo "<script>
                        alert('data gagal dihapus');
                        window.location.href='?target=alokon';
                    </script>";
        }
    } else {
        echo $alokon->index();
    }

    // distribusi
} elseif ($target == "distribusi") {
    if ($act == "tambah_distribusi") {
        echo $distribusi->tambah();
    } elseif ($act == "simpan_distribusi") {
        if ($distribusi->simpan()) {
            echo "<script>
                        alert('data sukses disimpan');
                        window.location.href='?target=distribusi';
                    </script>";
        } else {
            echo "<script>
                        alert('data gagal disimpan');
                        window.location.href='?target=distribusi';
                    </script>";
        }
    } elseif ($act == "edit_distribusi") {
        $id = $_GET['id'];
        echo $distribusi->edit($id);
    } elseif ($act == "update_distribusi") {
        if ($distribusi->update()) {
            echo "<script>
                        alert('data sukses diubah');
                        window.location.href='?target=distribusi';
                    </script>";
        } else {
            echo "<script>
                        alert('data gagal diubah');
                        window.location.href='?target=distribusi';
                    </script>";
        }
    } elseif ($act == "delete_distribusi") {
        $id = $_GET['id'];
        if ($distribusi->delete($id)) {
            echo "<script>
                        alert('data sukses dihapus');
                        window.location.href='?target=distribusi';
                    </script>";
        } else {
            echo "<script>
                    alert('data gagal dihapus');
                    window.location.href='?target=distribusi';
                </script>";
        }
    } else {
        echo $distribusi->index();
    }

    // user
} elseif ($target == "user") {
    if ($act == "tambah_user") {
        echo $user->tambah();
    } elseif ($act == "simpan_user") {
        if ($user->simpan()) {
            echo "<script>
                        alert('data sukses disimpan');
                        window.location.href='?target=user';
                    </script>";
        } else {
            echo "<script>
                        alert('data gagal disimpan');
                        window.location.href='?target=user';
                    </script>";
        }
    } elseif ($act == "edit_user") {
        $id = $_GET['id'];
        echo $user->edit($id);
    } elseif ($act == "update_user") {
        if ($user->update()) {
            echo "<script>
                        alert('data sukses diubah');
                        window.location.href='?target=user';
                    </script>";
        } else {
            echo "<script>
                        alert('data gagal diubah');
                        window.location.href='?target=user';
                    </script>";
        }
    } elseif ($act == "delete_user") {
        $id = $_GET['id'];
        if ($user->delete($id)) {
            echo "<script>
                        alert('data sukses dihapus');
                        window.location.href='?target=user';
                    </script>";
        } else {
            echo "<script>
                    alert('data gagal dihapus');
                    window.location.href='?target=user';
                </script>";
        }
    } else {
        echo $user->index();
    }

    // no pengguna
} elseif ($target == 'pengguna') {

    echo "selamat datang di pengguna";
}
?>
    </div>
</div>
</body>
</html>