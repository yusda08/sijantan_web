<?php

namespace Modules\App\Controllers;

use App\Controllers\BaseController;
use Modules\App\Models as App;

class Running_text extends BaseController
{
    private $module = 'Modules\App\Views', $moduleUrl = 'App/running_text';

    public function __construct()
    {
        parent::__construct();
        $this->M_RunText = new App\Model_running_text();
    }

    function index()
    {
        $record['content'] = $this->module . '\running_text\index';
        $record['moduleUrl'] = $this->moduleUrl;
        $record['ribbon'] = ribbon('App', 'Running Text');
        $this->render($record);
    }

}
