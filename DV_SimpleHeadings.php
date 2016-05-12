<?php

require_once 'DV_BlockViewBase.php';

class DV_SimpleHeadings extends DV_BlockViewBase
{
    public $json_obj = null;
    public $categories = array();
    
    private $talt = false;
    
    public function __construct($json_file)
    {
        $this->rndr_strs = array();
        $json_str = file_get_contents($json_file);
        $json_var = json_decode($json_str);
    
        $this->json_obj = $json_var;
        return;
    }
    
    public function render($ctg="")
    {
        $cat = array();
        foreach ($this->json_obj as $block) {
        	
            if (!is_array($block->category)) {
                $cat[] = $block->category;
            } else {
                $cat = $block->category;
            }
            
            foreach ($cat as $ct) {
                if (!in_array($ct, $this->categories)) {
                    $this->categories[] = $ct;
                }
            }

            if ($ctg != "") {
                    if (!in_array($ctg, $cat)) {
                    continue;
                }
            }

            /* TODO Tightly integrated, move integration out to caller */
            $hd_blk = "";
            $txt_blk = "";
            foreach ($block as $key => $elm) {
            	
                if ($key == "category") {
                    continue;
                } else if ($key == "title") {
                    /* Wrap up previous view box. */
                    $this->render_strs[] = $this->render_block($hd_blk, $txt_blk);
                    $txt_blk = "";
                    
                    /* Start new view box. */
                    $hd_blk = $this->render_heading($elm);
                } else {
                    if (($key == "tools") ||
                        ($key == "platforms")) {
                        $this->glue = ", ";
                    } else {
                        $this->glue = "<br />";
                    }
                    $txt_blk .= $this->render_text($key, $elm);
                }
            }
            
            /* Wrap up last view box. */
            $this->render_strs[] = $this->render_block($hd_blk, $txt_blk);
            $txt_blk = "";
        }

        return($this->render_strs);
    }
    
    public function render_heading($text)
    {
        $dobj = $text;
        $dobj = new DV_BlockDef("h1", array("panel-title"), $dobj);
        $dobj = new DV_BlockDef("div", array("panel-heading"), $dobj);
        
        $r_str = $dobj->render();
        return $r_str;
    }
    
    private function render_text($key, $text)
    {
        $r_out = array();
        $r_str = $this->render_obj(ucwords($key . ": "), "b", $this->lbl_class);
        $r_out[] = new DV_BlockDef("div", array("col-sm-2"), $r_str);
        $r_str = null;
        
        $glue = $this->get_glue_type($text);
        
        $r_str = $this->render_obj($text, "", $this->body_class, $glue);
        $r_out[] = new DV_BlockDef("div", array("col-sm-10"), $r_str);

        $r_str = new DV_BlockDef("div", array("row", "row-padded"), $r_out);
        $ret = $r_str->render() . "\n";
        return $ret;
    }
    
    private function get_glue_type($text)
    {
        /* If long lines, glue them by paragraph markers. */
        if (!is_array($text)) {
            return ("p");
        }
        
        foreach ($text as $tent) {
            if (strlen($tent) > 40) {
                return("p");
            }
        }
        
        return(", ");
    }
    
    private function add_proj($ctgs, $prj)
    {
        if (! is_array($ctgs)) {
            $ctgs_a = array($ctgs);
        } else {
            $ctgs_a = $ctgs;
        }
        
        foreach ($ctgs_a as $ctg) {
            if (!array_key_exists($ctg, $this->categories)) {
                $this->categories[] = $ctg;
                $this->categories[$ctg] = array();
            }
            
            $this->categories[$ctg][] = $prj;
        }
    }
    
    private function render_block($hd_blk, $txt_blk)
    {
    	if (($hd_blk == "") &&
    		($txt_blk == ""))
    	{
    		return "";
    	}
    	
    	$txt_view = new DV_BlockDef("div", array("panel-content"),
    			$txt_blk);
    	$blk_view = new DV_BlockDef("div", array("panel", "panel-default"),
    			$hd_blk . $txt_view->render());
    	
    	return $blk_view->render();
    }
    
}

function my_var_dump($var, $prompt="")
{
    echo "<div><b>{$prompt}: </b>";
    var_dump($var);
    echo "</div>";
}
/*
    <h3>Secure Tunnel For Virtual Data Pipeline</h3>
    <b>Product</b>
    Actifio Copy Data Storage
    <b>Tools</b>
    C++, OpenSSL, GNU Tool Chain, Visual Studio 2012
    <b>Platforms<b>
    Embedded Linux, SLES, RHEL, HPUX, AIX, Windows 2008R2, Windows 2012, Solaris
    <b>Summary</b>
    Sample text goes here describing the project
    <b>Accomplishments</b>
    Text with accomplishments goes here.
*/
