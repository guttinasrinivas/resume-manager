<?php

namespace Views\Display;

/* TODO Move this out to a separate file. if it works. */
class DV_BlockDef
{
    public $rtype = "div";
    public $rclass = array();
    public $rval = null;
    public $rlink = "";
    
    public function __construct($rtype, $rclass, $rtobj, $rlink="")
    {
        $this->rtype = $rtype;
        $this->rclass = $rclass;
        $this->rval = $rtobj;
        $this->rlink = $rlink;
        
        return;
    }
    
    private function render_subobj($tso)
    {
        $text = "";
        if (method_exists($tso, "render"))
        {
            $text = $tso->render();
        }
        else if (is_string($tso))
        {
            $text = $tso;
        }
        else
        {
            var_dump($tso);
            die("Invalid object type!!!");
        }
        
        return $text;
    }
    
    public function render()
    {
        $tobj = $this->rval;
        $type= $this->rtype;
        $rclass = $this->rclass;
        $rlink = $this->rlink;
        $rstrs = array();
        $text = "";
        
        if (is_array($tobj))
        {
            foreach ($tobj as $tso)
            {
                $text .= $this->render_subobj($tso);
            }
        }
        else
        {
            $text = $this->render_subobj($tobj);
        }
        
        $rstrs[] = "<{$type} class=\"";
        $rstrs[] = implode(" ", $rclass);
        $rstrs[] = "\">";
        
        if ($rlink != "")
        {
            $rstrs[] = "<a href=\"{$rlink}\">{$text}</a>";
        }
        else
        {
            $rstrs[] = $text;
        }
        
        $rstrs[] = "</{$type}>";
        
        return implode("", $rstrs);
    }
}

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
        $this->render_strs[] .= "<div class=\"row-padded\">";
        foreach ($this->body_text as $bt_line) {
            $this->render_strs[] .= $bt_line;
        }
        $this->render_strs[] .= "</div>";
    }
}

class DV_BlockViewBase {
    
    /* Text levels for mark up. */
    public $hdng_lvl = "h1";
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
        
        $r_str = $text;
        if (is_array($text)) {
            $r_str = "";
            //$r_str .= "<ul>";
            $tlen = count($text);
            for ($ii = 0; $ii < $tlen; $ii++) {
                $tent = $text[$ii];
                
                if ($glue == "p") {
                    $r_str .= "<div>{$tent}</div>";
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
            $rl_str = "<{$lvl}>{$rl_str}</{$lvl}>";
        }
        
        $rlc_str = $rl_str;
        if ($cls != "") {
            $rlc_str = "<div class=\"{$cls}\">{$r_str}</div>";
        }
        
        //var_dump($rlc_str);
        return($rlc_str);
    }
}
