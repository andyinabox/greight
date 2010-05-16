<?php


class sfWordnikRelatedTable extends PluginsfWordnikRelatedTable
{
    
    public static function getInstance()
    {
        return Doctrine_Core::getTable('sfWordnikRelated');
    }
}