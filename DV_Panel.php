<?php

namespace Views\Display;

class DV_Panel {
    
    public $mclass = array("nav", "navbar-nav");
    public $menu = array();

    public function add_menu($text, $link)
    {
        $ment_o = new DV_BlockDef("li", array(""), $text, $link);
        $this->menu[] = $ment_o->render();
    }
    
    public function render()
    {
        $robj = new DV_BlockDef("ul", $this->mclass, implode("\n", $this->menu));
        $rstr = $robj->render();
        //var_dump($rstr);
        return $rstr;
    }
    
/*
    <div class="panel panel-default">
        <div class="panel-heading">
            <div class="panel-title">Secure Tunnel For Virtual Data Pipeline</div>
        </div>
        <div class="panel-body">
            <div class="text-default text-right col-sm-2">Product</div>
            <div class="text-default col-sm-10">Actifio Copy Data Storage</div>
            <div class="text-default text-right col-sm-2">Tools</div>
            <div class="text-default col-sm-10">C++, OpenSSL, GNU Tool Chain, Visual Studio 2012</div>
            <div class="text-default text-right col-sm-2">Platforms</div>
            <div class="text-default col-sm-10">Embedded Linux, SLES, RHEL, HPUX, AIX, Windows 2008R2, Windows 2012, Solaris</div>
            <div class="text-default text-right col-sm-2">Summary</div>
            <div class="text-default col-sm-10">Sample text goes here describing the project</div>
            <div class="text-default text-right col-sm-2">Accomplishments</div>
            <div class="text-default col-sm-10">Text with accomplishments goes here.</div>
        </div>
    </div>
*/
}
