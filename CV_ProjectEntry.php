<?php

namespace Views\Controls;

class CV_ProjectEntry {
    
    public $height = 1;

    protected $type = "";
    protected $name = "";
    protected $id = "";
    protected $val = null;
    
    private $ctrl_open = "";
    private $ctrl_close = "";
    private $name_str = "";
    
    public function __construct($name, $type, $val=null, $id=null, $height=1) {
        $this->type = $type;
        $this->name = $name;
        
        if ($id == null) {
            $this->name_str = ucwords($this->name);
            $this->id = $this->type . "_" . str_replace(" ", "_", $this->name_str);
        } else {
            $this->id = $id;
        }
        
        if ($val != null) {
            $this->val = $val;
        }
        
        $this->height = $height;
    }
    
    public function render() {
        $ret_str = "";
        $ctrl_fmt_str = "\n<div class=\"form-group\">\n";
        
        // Start rendering the control
        // Let's start with open & close tags
        if ($this->type === "textarea") {
            
            if ($this->height > 20) {
                $this->height = 20;
            }
            
            if ($this->height < 1) {
                $this->height = 1;
            }
            
            $this->ctrl_open = "<textarea rows=\"" . $this->height . "\"";
            $this->ctrl_close = "></textarea>";
        } else {
            $this->ctrl_open = "<input type=" . $this->type;
            $this->ctrl_close = " />";
        }
        
        // Now the label
        $label_rndr = "<label for=\"" . $this->id ."\" class=\"control-label col-sm-2\">" . $this->name_str . ": </label>\n";
        
        // Next the control itself
        $ctrl_rndr = "<div class=\"col-sm-9\">\n";
        $ctrl_rndr .= $this->ctrl_open . " class=\"form-control\" id=\"" . $this->id . "\" name=\"" . $this->name . "\"" . $this->ctrl_close . "\n";
        $ctrl_rndr .= "</div></div>\n";
        return($ctrl_fmt_str . $label_rndr . $ctrl_rndr);
    }
}
