<?php
namespace Modules\Frontend\Controllers;

use App\Controllers\BaseController;
use Modules\App\Models as App;
class Home extends BaseController
{

    protected $module = 'Modules\Frontend\Views';
    public function __construct()
    {
        parent::__construct();
        $this->M_Run = new App\Model_running_text();
        $this->M_Unit = new App\Model_unit();
    }

    function index()
    {
        if ($this->log) {
            return redirect()->to(site_url('home'));
        }
        $record['running'] = $this->M_Run->where(['status_aktif' => 1])->first();
        $record['unit'] = $this->M_Unit->first();
        $record['content'] = $this->module.'\index';
        $record['ribbon'] = ribbon('Home');
        $this->frontend($record);
    }

}
