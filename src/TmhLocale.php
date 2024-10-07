<?php

class TmhLocale
{
    private TmhJson $json;

    public function __construct(TmhJson $json)
    {
        $this->json = $json;
    }
}
