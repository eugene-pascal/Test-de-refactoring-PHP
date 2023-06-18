<?php

class SimpleTemplate
{
    /**
     * @var string
     */
    protected $template = '';

    /**
     * @var string
     */
    protected $templatePath = '';

    /**
     * @var array
     */
    protected $data = array();

    /**
     * @var int
     */
    protected $langId = 37;

    public function __construct($template, $data) {
        $this->templatePath = realpath(__DIR__.'/../templates');
        $this->template = $template;
        $this->data = $data;
    }

    /**
     * @param $key
     * @param $value
     */
    public function set($key, $value) {
        $this->data[$key] = $value;
    }

    /**
     * @param $id
     * @return $this
     */
    public function setLang($id) {
        $this->langId = $id;
        return $this;
    }

    /**
     * @return int
     */
    public function getLang() {
        return $this->langId;
    }

    /**
     * @return string
     */
    public function output() {
        $fullPath = $this->templatePath.'/'.$this->template.'.php';
        if (!file_exists($fullPath)) {
            return 'Erreur lors du chargement du fichier modèle (' .$this->template. ').' . "\r\n";
        }
        ob_start();
        include($fullPath);
        $content = ob_get_clean();
        return $content;
    }
}
