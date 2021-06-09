<?php
namespace Modules\Frontend\Controllers;

use App\Controllers\BaseController;

class Home extends BaseController
{

    protected $module = 'Modules\Frontend\Views';
    public function __construct()
    {
        parent::__construct();

    }

    function index()
    {
        if ($this->log) {
            return redirect()->to(site_url('home'));
        }
        $record['content'] = $this->module.'\index';
        $record['ribbon'] = ribbon('Home');
        $this->frontend($record);
    }

}
