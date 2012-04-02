<?php namespace Bolt;

use Bolt\Core\Collection;
use Bolt\Core\Filter;
use Bolt\Core\Entity;

spl_autoload_register(function($sClassName) {
    if (strpos($sClassName, 'Bolt') === 0) {
        preg_match('#(.*)\\\([^\\\]+)$#', $sClassName, $aRegs);
        $aRegs[1] = str_replace('\\','/',$aRegs[1]);
        include __DIR__.'/'.$aRegs[1].'/'.$aRegs[2].'.php';
    }
});
