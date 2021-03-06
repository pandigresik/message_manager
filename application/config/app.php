<?php defined('BASEPATH') or exit('No direct script access allowed');
$config['appTitle'] = 'base app';
$config['appCopyright'] = 'solusikita';
$config['table'] = [
            'table_open' => '<table class="table text-center table-bordered" id="datatable">',
            'thead_open' => '<thead class="default">',
        ];        
$config['status'] = [
    'active' => 'A',
    'inactive' => 'I',
    'void' => 'V',
    'rejected' => 'R'
];

$config['jenisKelamin'] = [
    'pria' => 'M',
    'laki-laki' => 'M',
    'wanita' => 'F',
    'perempuan' => 'F',
];
/** don't forget to create folder with this value on folder language */
$config['localization'] = 'indonesia';
