<?php

require_once(__DIR__ . '/TmhCatalog.php');
require_once(__DIR__ . '/TmhDatabase.php');
require_once(__DIR__ . '/TmhJson.php');
require_once(__DIR__ . '/TmhLocale.php');

class TmhFactory
{
    public function catalog()
    {
        return new TmhCatalog($this->database(), $this->json());
    }

    public function database()
    {
        return new TmhDatabase($this->json());
    }

    public function json()
    {
        return new TmhJson();
    }

    public function locale()
    {
        return new TmhLocale($this->json());
    }
}
