<?php

class ControllerExtensionModuleRmOrderExporter extends Controller {

    public function index() {
        $data = array();

        // 加载语言文件
        $this->language->load('extension/module/rm_order_exporter');

        // 设置文档标题
        $this->document->setTitle($this->language->get('heading_title'));

        // 设置模板变量
        $variables = array(
            'heading_title',
            'heading_title_version',
            'form_title',
        );
        foreach($variables as $variable) $data[$variable] = $this->language->get($variable);

        // 设置面包屑导航
        $data['breadcrumbs'] = array(
            array(
                'text'      => $this->language->get('text_home'),
                'href'      => $this->url->link('common/home', 'token=' . $this->session->data['token'], 'SSL')
            ),
            array(
                'text'      => $this->language->get('text_module'),
                'href'      => $this->url->link('extension/module', 'token=' . $this->session->data['token'], 'SSL')
            ),
            array(
                'text'      => $this->language->get('heading_title'),
                'href'      => $this->url->link('extension/module/rm_order_exporter', 'token=' . $this->session->data['token'], 'SSL')
            )
        );

        // Error Warning
        if (isset($this->error['warning'])) {
            $data['error_warning'] = $this->error['warning'];
        } else {
            $data['error_warning'] = '';
        }

        // 设置form提交地址
        $data['action'] = $this->url->link('extension/module/rm_order_exporter', 'token=' . $this->session->data['token'], true);

        // 导入各个部分的模板
        $data['header'] = $this->load->controller('common/header');
        $data['column_left'] = $this->load->controller('common/column_left');
        $data['footer'] = $this->load->controller('common/footer');

        // 输出模板
        $this->response->setOutput($this->load->view('extension/module/rm_order_exporter.tpl', $data));
    }

    public function install() {
    }

    public function uninstall() {
    }
}
