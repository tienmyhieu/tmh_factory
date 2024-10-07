<?php

class TmhCatalog
{
    private TmhDatabase $database;
    private TmhJson $json;

    public function __construct(TmhDatabase $database, TmhJson $json)
    {
        $this->database = $database;
        $this->json = $json;
    }

    public function catalog(string $primaryKey): array
    {
        return $this->database->entity($primaryKey, 'catalog');
    }
}
