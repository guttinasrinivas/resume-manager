<?php

namespace Views\Display;

class DV_BlockText {
    /* Tags for rendering */
    public $lbl_lvl = "b";
    public $body_lvl = "";
    
    /* CSS classes for headings */
    public $lbl_class = "";
    public $body_class = "";
    
    /* Actual text */
    public $lbl_text = "";
    public $body_text = array();
    
    public $render_strs = array();
    
    public function __construct()
    {
        return;
    }
    
    public function render()
    {
        $this->render_label();
        
        $this->render_text();
        
        return $this->render_strs;
    }
    
    public function render_label()
    {
        $r_lbl = "{$lbl_text}";
        
        if ($this->lbl_lvl != "") {
            $r_lbl = "<{$lbl_lvl}>{$lbl_text}</{$lbl_lvl}>";
        }
        
        if ($this->lbl_class != "") {
            $render = "<div class=\"{$lbl_class}\">{$r_lbl}</div>";
        }
        
        $this->render_strs[] = $render;
    }
    
    public function render_text()
    {
        $this->render_strs[] .= "<ul>";
        foreach ($this->body_text as $bt_line) {
            $this->render_strs[] .= "<tr><td>{$bt_line}</td></tr>";
        }
        $this->render_strs[] .= "</ul>";
    }
}

class DV_BlockViewBase {
    
    /* Text levels for mark up. */
    public $hdng_lvl = "h3";
    public $lbl_lvl = "b";
    public $body_lvl = "";
    
    /* CSS classes for headings */
    public $hdng_class = "";
    public $lbl_class = "";
    public $body_class = "";
    
    public $render_strs = array();
    
    protected $glue = "<br />";

    public function __construct()
    {
    }
    
    public function render_obj($text, $lvl="", $cls="", $glue=", ")
    {
        $gl_init = "";
        $gl_open = $this->glue;
        $gl_close = "";
        $gl_concl = "";
        if (is_array($this->glue)) {
            // TODO
        }
        
        $r_str = $text;
        if (is_array($text)) {
            $r_str = "";
            //$r_str .= "<ul>";
            $tlen = count($text);
            for ($ii = 0; $ii < $tlen; $ii++) {
                $tent = $text[$ii];
                
                if ($glue == "p") {
                    $r_str .= "<p>{$tent}</p>";
                } else if (($ii + 1) < $tlen ){
                    $r_str .= "{$tent}, ";
                } else {
                    $r_str .= "{$tent}";
                }
            }
            //$r_str .= "</ul>";
        }
        
        $rl_str = $r_str;
        if ($lvl != "") {
            $rl_str = "<{$lvl}>{$r_str}</{$lvl}>";
        }
        
        $rlc_str = $rl_str;
        if ($cls != "") {
            $rlc_str = "<div class=\"{$cls}\">{$rl_str}</div>";
        }
        
        //var_dump($rlc_str);
        return($rlc_str);
    }
}
