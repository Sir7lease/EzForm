<?php
    namespace src\Tags;

    use src\Attributes\FieldAttributes;

    /**
     * This Class allows you to add a <label> to go with your field
     *
     * @author  Hammoumi Abdelaziz
     */
    abstract class LabelTag extends FieldAttributes implements FieldInterface
    {
        private string $labelName = 'totoTata';
        private string $attrFor = 'id_tmp';

        public function __construct()
        {
            //$this->attrFor = $t;
        }

        public function getLabel()
        {
            return $this->labelName;
        }

        public function setLabelName(string $labelName): string
        {
            return $this->labelName = $labelName;
        }
    }