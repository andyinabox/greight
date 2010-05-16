<?php


class sfWordnikRelatedWordTable extends PluginsfWordnikRelatedWordTable
{
    
    public static function getInstance()
    {
        return Doctrine_Core::getTable('sfWordnikRelatedWord');
    }
}