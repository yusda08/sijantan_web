<?php
namespace Modules\Home\Controllers;

use App\Controllers\BaseController;

class Home extends BaseController
{

    protected $module = 'Modules\Home\Views';
    var $log;

//put your code here
    public function __construct()
    {
        parent::__construct();

    }

    function index()
    {
        $record['log'] = aksesLog();
        $record['content'] = $this->module.'\index';
        $record['ribbon'] = ribbon('Home');
        $this->render($record);
    }

    function setSessionTahun()
    {
        $tahun = $this->post('tahun');
        session()->push('is_logined', ['tahun'=> $tahun]);
        return redirect()->back();
    }

}
