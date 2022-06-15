<?php
namespace Aham\EzForm\Templates;

class Template
{
    private const TEMPLATES_JSON_FILE_PATH = './src/templates/template.json';
    private $contentFile;

    public function __construct()
    {
        $this->contentFile = json_decode( file_get_contents(self::TEMPLATES_JSON_FILE_PATH), true );
    }

    public function getTemplates(): string
    {
         if( !$this->contentFile )
             return 'There is no template saved yet.';

         return implode(PHP_EOL, array_keys( $this->contentFile ) );




    }

}