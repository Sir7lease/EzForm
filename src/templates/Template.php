<?php
namespace Aham\EzForm\Templates;

use Aham\EzForm\Form;
use Aham\EzForm\FormBuilder;
use Aham\EzForm\SortFields;
use PHPUnit\Util\Exception;
use function PHPUnit\Framework\isInstanceOf;

class Template extends SortFields
{
    private const TEMPLATES_JSON_FILE_PATH = __DIR__ . DIRECTORY_SEPARATOR .'template.json';
    protected ?array $contentFile = [];
    private string|Form $template;

    public function __construct()
    {

    }

    public function getListTemplates(): self
    {
        if ( !isset( $this->contentFile ) ) {
            echo "There is no template saved yet. Use saveTemplate() method to save a template." . PHP_EOL;
            exit;
        }
        echo implode( '<br/>', array_keys( $this->contentFile ) ) . '<br/><br/>';
        return $this;
    }

    /**
     * @param string $nameTemplate
     * @return Form|null
     */
    public function getTemplate(string $nameTemplate): ?Form
    {
        $this->getContent();
        if( !isset( $this->contentFile ) ) {
            echo "There is no template saved yet. Use saveTemplate() method to save a template.";
            exit;
        }

        if( !array_key_exists( $nameTemplate, $this->contentFile ) ) {
           echo "The template '$nameTemplate' doesn't exist. Use getListTemplates() method to see all the templates saved.";
            exit;
        }

        $this->template = @unserialize($this->contentFile[$nameTemplate]);
        if ( $this->template instanceof Form) {
            return $this->template;
        } else {
            echo "The template '$nameTemplate' is corrupted and therefore can't be used. You can delete the template with removeTemplate() method.";
            exit;
        }
    }

    /*public function renderTemplate(): ?string
    {
        if( !isset($this->template) ) {
            echo "You're trying to render a template before getting it. Use getTemplate() method before rendering";
            exit();
        }
        echo $this->buildForm($this->template)->renderForm();
    }*/

    /**
     * @param string $nameTemplate
     * @param Form $form
     * @return $this
     */
    public function saveTemplate(string $nameTemplate, Form $form): self
    {
        $fileinfo = 'no_file_info';
        $backtrace = debug_backtrace();
        if ( !empty( $backtrace[0] ) && is_array( $backtrace[0] ) ) {
            $fileinfo = $backtrace[0]['file'] . ":" . $backtrace[0]['line'];
        }

        if( !$this->contentFile ) {
            file_put_contents(self::TEMPLATES_JSON_FILE_PATH, '{}');
            $this->getContent();
        }

        if( !array_key_exists( $nameTemplate, $this->contentFile ) ) {
            $this->contentFile[ $nameTemplate ] = serialize( $form );

            if( $this->putContent() ) {
                echo <<<TEMPLATE_SAVED
                        Template '$nameTemplate' is saved now.
                        You can remove saveTemplate() method in $fileinfo".
                     TEMPLATE_SAVED;
            }
        } else {
            echo <<<TEMPLATE_SAVED
                        Template '$nameTemplate' already exist.
                        Remove saveTemplate() method in $fileinfo".
                     TEMPLATE_SAVED;
        }
        return $this;
    }

    /**
     * @param string $nameTemplate
     * @return $this
     */
    public function removeTemplate(string $nameTemplate): self
    {
        $this->getContent();
        unset($this->contentFile[$nameTemplate]);
        $this->putContent();
        return $this;
    }

    private function getContent(): void
    {
        $this->contentFile = json_decode( file_get_contents(self::TEMPLATES_JSON_FILE_PATH), true );
        print_r($this->contentFile);
    }

    private function putContent(): int|bool
    {
        return ( file_put_contents( self::TEMPLATES_JSON_FILE_PATH, json_encode( $this->contentFile ) ) )??false;
    }

}