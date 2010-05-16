<?php


class sfWordnikWordTable extends PluginsfWordnikWordTable
{
    
    public static function getInstance()
    {
        return Doctrine_Core::getTable('sfWordnikWord');
    }
}