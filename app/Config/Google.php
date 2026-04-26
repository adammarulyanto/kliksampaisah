<?php

namespace App\Config;

use CodeIgniter\Config\BaseConfig;

class Google extends BaseConfig
{
    public $clientId = '928607275168-h419nbh38sck09ak84lbl1ifl6kr2j4n.apps.googleusercontent.com';
    public $clientSecret = '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';
    public $redirectUri = 'http://localhost:8080/auth/googleCallback';
}