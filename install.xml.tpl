<?xml version="1.0" encoding="UTF-8"?>
<modification>
    <code><![CDATA[rmorderexporter]]></code>
    <name><![CDATA[RM Order Exporter]]></name>
    <version><![CDATA[1.0.0]]></version>
    <author><![CDATA[richard_ma]]></author>

    <file path="admin/controller/common/column_left.php">
        <operation>
            <search index="0"><![CDATA[if ($this->user->hasPermission('access', 'extension/extension')) {   ]]></search>
            <add position="before"><![CDATA[            if ($this->user->hasPermission('access', 'extension/module/rm_order_exporter')) {        
                $extension[] = array(
                'name'     => $this->language->get('rm_order_exporter_menu_title'),
                'href'     => $this->url->link('extension/module/rm_order_exporter', 'token=' . $this->session->data['token'], true),
                'children' => array()       
                );                  
                }   
            ]]></add>
        </operation>
    </file>

    <file path="admin/language/en-gb/common/column_left.php">
        <operation>
            <search index="0"><![CDATA[<?php]]></search>
            <add position="after"><![CDATA[$_['rm_order_exporter_menu_title'] = 'RM Order Exporter';]]></add>
        </operation>
    </file>
</modification>
