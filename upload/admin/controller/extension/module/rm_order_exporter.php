<?php

class ControllerExtensionModuleRmOrderExporter extends Controller {

    public function index() {
        $data = array();

        $this->language->load('extension/module/rm_order_exporter');

        $this->document->setTitle($this->language->get('heading_title'));

        $variables = array(
            'heading_title',
            'heading_title_version'
        );
        foreach($variables as $variable) $data[$variable] = $this->language->get($variable);

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
                'href'      => $this->url->link('extension/module/excelport', 'token=' . $this->session->data['token'], 'SSL')
            )
        );

        $data['header'] = $this->load->controller('common/header');
        $data['column_left'] = $this->load->controller('common/column_left');
        $data['footer'] = $this->load->controller('common/footer');

        $this->response->setOutput($this->load->view('extension/module/rm_order_exporter.tpl', $data));
    }

    public function install() {
    }

    public function uninstall() {
    }
}
