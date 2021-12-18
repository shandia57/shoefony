<?php 

namespace App\Service;

class Mailer
{
    private $projectDir;
    public function __construct(string $projectDir)
    {
        $this->projectDir = $projectDir;
    }
}