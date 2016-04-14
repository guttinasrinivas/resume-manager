<?php

namespace Views\Display;

class DV_SimpleHeadings extends DV_BlockViewBase
{
    public $json_obj = null;
    public function __construct($json_file)
    {
        $this->rndr_strs = array();
        $json_str = file_get_contents($json_file);
        $json_var = json_decode($json_str);
    
        $this->json_obj = $json_var;
        return;
    }
    
    public function render()
    {
        foreach ($this->json_obj as $block) {
            foreach ($block as $key => $elm) {
                if ($key == "title") {
                    $this->render_strs[] = "</table>";
                    $this->render_heading($elm);
                    $this->render_strs[] = "<table>";
                } else {
                    if (($key == "tools") ||
                        ($key == "platforms")) {
                        $this->glue = ", ";
                    } else {
                        $this->glue = "<br />";
                    }
                    $this->render_text($key, $elm);
                }
            }
        }

        return($this->render_strs);
    }
    
    public function render_heading($text)
    {
        $r_str = $this->render_obj($text, $this->hdng_lvl, $this->hdng_class);
        $this->render_strs[] = "<p>{$r_str}</p>\n";
    }
    
    private function render_text($key, $text)
    {
        $r_str = "<tr><td class=\"label\">";
        $r_str .= $this->render_obj(ucwords($key), $this->lbl_lvl, $this->lbl_class);
        $r_str .= ": ";
        $r_str .= "</td>";
        
        $r_str .= "<td class=\"text\">";
        $r_str .= $this->render_obj($text, $this->body_lvl, $this->body_class);
        $r_str .= "</td></tr>";
        $this->render_strs[] = "{$r_str}\n";
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
}
