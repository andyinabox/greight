<?php


class sfWordnikExampleTable extends PluginsfWordnikExampleTable
{
    
    public static function getInstance()
    {
        return Doctrine_Core::getTable('sfWordnikExample');
    }
}