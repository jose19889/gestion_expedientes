<?php

namespace Config;

use CodeIgniter\Config\BaseConfig;

class MigrationConfig extends BaseConfig
{
    public $backupPath   = WRITEPATH . 'backups/';
    public $maxBackups   = 10; // Límite de archivos para no llenar el disco
    public $compression  = true; // Siempre comprimir en ZIP
    public $fileNamePref = 'backup_db_';
}