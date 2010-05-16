<?php


class sfWordnikDefinitionTable extends PluginsfWordnikDefinitionTable
{
    
    public static function getInstance()
    {
        return Doctrine_Core::getTable('sfWordnikDefinition');
    }
}