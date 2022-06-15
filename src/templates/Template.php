<?php
namespace Aham\EzForm\Templates;

use Aham\EzForm\Form;
use Aham\EzForm\FormBuilder;

class Template extends FormBuilder
{
    private const TEMPLATES_JSON_FILE_PATH = './src/templates/template.json';
    private $contentFile = [];

    public function __construct()
    {
       $this->getContent();
    }

    public function getListTemplates(): string
    {
         if( !$this->contentFile )
             return 'There is no template saved yet.';

         return implode( '<br/>', array_keys( $this->contentFile ) ) . '<br/><br/>';
    }

    public function getTemplate(string $nameTemplate): Form
    {
        $this->getContent();
        return unserialize( $this->contentFile[ $nameTemplate ] );
    }

    public function renderTemplate(string $nameTemplate)
    {
        echo $this->buildForm($this->getTemplate($nameTemplate))->renderForm();
    }

    public function saveTemplate(string $nameTemplate, Form $form)
    {
        if( !$this->contentFile ) {
            file_put_contents(self::TEMPLATES_JSON_FILE_PATH, '{}');
            $this->getContent();
        }

        if( !array_key_exists( $nameTemplate, $this->contentFile ) ) {
            $this->contentFile[ $nameTemplate ] = serialize( $form );
            $this->putContent();
        }
    }

    public function removeTemplate(string $nameTemplate)
    {
        $this->getContent();
        unset($this->contentFile[$nameTemplate]);
        $this->putContent();
    }

    private function getContent(): void
    {
        $this->contentFile = json_decode( file_get_contents(self::TEMPLATES_JSON_FILE_PATH), true );
    }

    private function putContent(): void
    {
        file_put_contents( self::TEMPLATES_JSON_FILE_PATH, json_encode( $this->contentFile ) );
    }

}