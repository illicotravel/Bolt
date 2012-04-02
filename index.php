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

function Filter($key = null) {
	return new Filter($key);
}

function Collection($base, $collection) {
	return new Collection($base, $collection);
}

function Entity($base, $collection, $datas = null, $Mongo = null) {
	return new Entity($base, $collection, $datas, $Mongo);
}	
			
$oFilter = Filter('emails.type')->equals('main');
$aUsers  = Collection('Test', 'profile')->search($oFilter);

var_dump(iterator_to_array($aUsers));
