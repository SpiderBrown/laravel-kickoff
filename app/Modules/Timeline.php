<?php

namespace App\Modules;

class Timeline
{

    protected $type='custom';
    /**
     * Optional fa-icon
     */
    public $icon;
    /**
     * Recommented, also with title into
     */
    public $title;
    /**
     * Recommented
     */
    public $title_info;

    /**
     * Optional Valid Route name e.g 'home'
     * @value route name
     */
    public $title_route;
    /**
     * Optional Valid Link
     * @value full url link
     */
    public $title_link;

    /**
     * Simple text of HTML
     */
    public $content;
    /**
     * Optional for footer button
     */
    public $button_text;
    /**
     * Optional Color e.g btn-primary
     * string
     * can add multiple by giving space
     */
    public $button_class;
    /**
     * Optional for footer button
     */
    public $button_route;
    /**
     * Optional for footer button
     */
    public $button_link;

    /**
     * Default 'custom'
     */
    public function getType(){
        return $this->type;
    }
}
