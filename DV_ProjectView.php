<?php

namespace Views\Display;

require_once('DV_BlockViewBase.php');

class ProjectView {
    
    public $prj_cntr_class = "";    // Overall container for the block
    public $title_cntnr_class = ""; // Title container for the block
    public $title_class = "";       // Title class
    public $body_cntr_class = "";   // The content of the container, body of the data
    public $lbl_class = "";         // Class for Label for each ID from JSON
    public $cntnt_class = "";       // Content for each ID from JSON
    
    public $rndr_strs = array();
    
    
    private $first_block = true;
    private $rndr_str = "";
    
    public function decode($json_file)
    {
        $this->rndr_strs = array();
        $json_str = file_get_contents($json_file);
        $json_var = json_decode($json_str);
        foreach ($json_var as $json_obj)
        {
            $this->rndr_str = "";
            $this->show_project($json_obj);
            $this->rndr_str .= "</div>";
            $this->rndr_strs[] = $this->rndr_str;
        }
    }
    
    public function show_project($proj)
    {
        $this->rndr_str .= "<div class=\"" . $this->prj_cntr_class . "\">";
        
        foreach($proj as $hd => $val)
        {
            if ($hd === "title") {
                $this->show_new_project($val);
            } else {
                $this->rndr_str .= "<div class=\"" . $this->lbl_class . "\">";
                $this->rndr_str .= ucwords($hd) . "</div>";
                $this->rndr_str .= "<div class=\"" . $this->cntnt_class . "\">";
                $this->show_content($val);
                $this->rndr_str .= "</div>";
            }
        }
        
        $this->rndr_str .= "</div>";
    }
    
    private function show_new_project($cont)
    {
        $this->rndr_str .= "<div class=\"" . $this->title_cntnr_class . "\">";
        $this->rndr_str .= "<div class=\"" . $this->title_class . "\">" . ucwords(str_replace("_", " ", $cont)) . "</div>";
        $this->rndr_str .= "</div>";
        $this->rndr_str .= "<div class=\"" . $this->body_cntr_class . "\">";
    }
    
    private function show_content($cont)
    {
        $ctype = gettype($cont);
        if ($ctype == "string")
        {
            $this->rndr_str .= $cont;
        }
        else if ($ctype == "array")
        {
            $cctr = 0;
            foreach($cont as $cval)
            {
                $cctr++;
                $this->show_content($cval);
                if ($cctr < count($cont)) {
                    $this->rndr_str .= ", ";
                }
            }
        }
    }
}
?>