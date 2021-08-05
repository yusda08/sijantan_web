<?php

function ribbon($name_page = NULL, $name_page2 = NULL)
{
    $data = $name_page;
    if ($name_page2 != '') {
        $data .= '<small> / ' . $name_page2 . '</small>';
    }
    return $data;
}

function formatDatePhp($tanggal)
{
    $date = DateTime::createFromFormat('d/m/Y', $tanggal);
    return $date->format('Y-m-d');
}

function linkKml($nm_kml) {
    return base_url("assets/kml/$nm_kml");
}

function textCapital($kalimat)
{
    return ucwords(strtolower($kalimat));
}

function sprintfNumber($number, $length = 4)
{
    return sprintf("%'.0" . $length . "s", $number);
}

function statusWarning($status = null, $ket = null)
{
    $data = '
            <div class="alert alert-warning"><h4><i class="fas fa-exclamation-triangle"></i>' . $status . '</h4>
            ' . $ket . '
        </div>';
    echo $data;
}

function statusInfo($status = null, $ket = null)
{
    return '<div class="alert alert-info"><h4><i class="fas fa-info"></i> &nbsp;' . $status . '</h4>' . $ket . '</div>';
}

function localBase($asset){
    return 'http:://36.94.90.99/sijantan_old/'.$asset;
}

function numberFormat($value, $jml = NULL)
{
    return number_format($value, $jml, ',', '.');
}

function invalid($paramt)
{
    $validation = \Config\Services::validation();
    return ($validation->hasError($paramt)) ? 'is-invalid' : '';
}

function invalidFeedback($paramt)
{
    $validation = \Config\Services::validation();
    return "<div class='invalid-feedback'>{$validation->getError($paramt)}</div>";
}

function aksesLog()
{
    return session()->get('is_logined');
}

function getCsrfToken()
{
    if (!session()->csrf_token) {
        session()->csrf_token = hash('sha1', time());
    }
    return session()->csrf_token;
}

function cekCsrfToken($token, $ket = 'Data Token tidak ada, Silahkan Hubungi administrator')
{
    if ($token != getCsrfToken() or !getCsrfToken() or !$token) {
        throw \CodeIgniter\Exceptions\PageNotFoundException($ket);
    }
}

function getCsrf($type = 'hidden')
{
    echo "<input type='$type' class='form-control' id='token' name='token' value='" . getCsrfToken() . "'>";
}

function btnAction($action, $attrAction = '', $ket = '', $classAction = '')
{
    if ($action == 'update') {
        $class = 'warning';
        $icon = 'highlighter';
    } elseif ($action == 'delete') {
        $class = 'danger';
        $icon = 'trash';
    } elseif ($action == 'search') {
        $class = 'primary';
        $icon = 'search';
    } else {
        $class = 'primary';
        $icon = 'plus';
    }
    return "<button $attrAction class='btn btn-$class btn-sm $classAction'><i class='fas fa-$icon'></i> $ket</button>";
}

function btn_tambah($attr = '', $ket = '', $class = '', $icon = 'fa-plus')
{
//    $get  = getAksesMenu();
//    $attr .= $get['action'] == 1 ? '' : ' disabled ';
//    $attr .= $get['action'] == 1 ? '' : ' hidden ';
    return "<button class='btn btn-primary btn-flat $class' $attr><i class='fa $icon'></i> $ket</button>";
}

function btn_edit($attrEdt = '', $ketEdt = '', $classEdt = '', $icon = 'fa-highlighter')
{
//    $get  = getAksesMenu();
//    $classEdt .= $get['action'] == 1 ? '' : ' disabled ';
//    $classEdt .= $get['action'] == 1 ? '' : ' hidden ';
    return "<button class='btn btn-warning btn-flat btn-edit {$classEdt}' {$attrEdt}><i class='fas $icon'></i> $ketEdt</button>";
}

function btn_hapus($attrHps = '', $ketHps = '', $classHps = '', $icon = 'fa-trash')
{
//    $get  = getAksesMenu();
//    $attr = $get['action'] == 1 ? '' : 'disabled';
    return "<button class='btn btn-danger btn-flat $classHps' $attrHps><i class='fa $icon'></i> $ketHps</button>";
}

function rootApi()
{
    return "http://localhost/api_siskeudes/index.php/";
}

function count_allTable($table, $whereArray)
{
    $db = \Config\Database::connect();
    $query = $db->table($table)->where($whereArray);
    return $query->countAllResults();
}

function getAksesMenu()
{
    $db = \Config\Database::connect();
    $request = \Config\Services::request();
    $url = $request->uri->getSegment(1);
    $controller = $request->uri->getSegment(2);
    if ($controller) {
        $url .= '/' . $controller;
    }
    $akses = aksesLog();
    $builder =  $db->table('menu')->join('menu_role', 'id=id_menu')->where(['kd_level' => $akses['kd_level'], 'link' => $url]);
    return $builder->get()->getRowArray();
}
