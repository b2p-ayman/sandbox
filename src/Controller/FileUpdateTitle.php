<?php

namespace App\Controller;

use App\Entity\File;

class FileUpdateTitle
{
    public function __invoke(File $data): File
    {
        $data->setTitre($data->getTitre().' (Updated)');

        return $data;
    }
}
