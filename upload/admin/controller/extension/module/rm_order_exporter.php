<?php

class ControllerExtensionModuleRmOrderExporter extends Controller {

    public function index() {
        $data = array();

        // 加载语言文件
        $this->language->load('extension/module/rm_order_exporter');

        // 设置文档标题
        $this->document->setTitle($this->language->get('heading_title'));

        // 读取语言文件设置模板变量
        $variables = array(
            'heading_title',
            'heading_title_version',
            'form_title',
            'order_ids',
            'order_type',
            'type_csv',
            'type_excel',
            'error_orderIds_empty',
            'error_permission',
        );
        foreach($variables as $variable) $data[$variable] = $this->language->get($variable);

        // 设置面包屑导航
        $data['breadcrumbs'] = array(
            array(
                'text'      => $this->language->get('text_home'),
                'href'      => $this->url->link('common/dashboard', 'token=' . $this->session->data['token'], true)
            ),
            array(
                'text'      => $this->language->get('text_extension'),
                'href'      => $this->url->link('extension/extension', 'token=' . $this->session->data['token'] . '&type=module', true)
            ),
            array(
                'text'      => $this->language->get('heading_title'),
                'href'      => $this->url->link('extension/module/rm_order_exporter', 'token=' . $this->session->data['token'], true)
            )
        );

        // Error Warning
        if (isset($this->error['warning'])) {
            $data['error_warning'] = $this->error['warning'];
        } else {
            $data['error_warning'] = '';
        }
        // Error ids 
        if (isset($this->error['orderIds'])) {
            $data['error_orderIds'] = $this->error['orderIds'];
        } else {
            $data['error_orderIds'] = '';
        }
        // Error type 
        if (isset($this->error['orderType'])) {
            $data['error_orderType'] = $this->error['orderType'];
        } else {
            $data['error_orderType'] = '';
        }

        // 设置form提交地址
        $data['action'] = $this->url->link('extension/module/rm_order_exporter/export', 'token=' . $this->session->data['token'], true);

        // 导入各个部分的模板
        $data['header'] = $this->load->controller('common/header');
        $data['column_left'] = $this->load->controller('common/column_left');
        $data['footer'] = $this->load->controller('common/footer');

        // 输出模板
        $this->response->setOutput($this->load->view('extension/module/rm_order_exporter.tpl', $data));
    }

    public function export() {
        $data = array();

        $id_string = $this->request->post['ids'];
        $type = $this->request->post['type'];

        if (empty($id_string)) {
            // TODO Add Error Notification
            //$this->error['warning'] = $this->language->get('error_orderIds_empty');
            $this->response->redirect($this->url->link('extension/module/rm_order_exporter', 'token=' . $this->session->data['token'], true));
        }

        $ids = $this->explode_ids($id_string);
        // CHECK ids
        //var_dump($ids);
        $orders = $this->load_orders($ids);
        // CHECK orders
        //var_dump($orders);
        // CHECK type
        //var_dump($type);
        if ($type == 'csv') {
            $this->export_csv($orders);
        } elseif ($type == 'excel') {
        } else {
            $this->response->redirect($this->url->link('extension/module/rm_order_exporter', 'token=' . $this->session->data['token'], true));
        }

    }

    private function load_orders($orderIdArray) {
        $this->load->model('sale/order');
        $orders = array();
        foreach ($orderIdArray as $orderId) {
            array_push($orders, $this->model_sale_order->getOrder($orderId));
        }
        return $orders;
    }

    private function explode_ids($ids_string) {
        $ids = explode(',', $ids_string);
        foreach ($ids as $key => $id) {
            # trim space for id
            $id = trim($id);
            # remove m-n element
            unset($ids[$key]);
            if (strpos($id, '-') != false) {
                # process m-n format
                # get m & n as $start & $end
                list($start, $end) = explode('-', $id);
                # $end is less than $start then swap them
                if ($end < $start) list($start, $end) = array($end, $start);
                # push m-n items to result
                for ($i = $start; $i <= $end; $i++) {
                    array_push($ids, (int)$i);
                }
            } else {
                # process m format
                array_push($ids, (int)$id);
            }
        }
        # sort ids
        sort($ids);
        return $ids;
    }

    protected function validate() {
        if (!$this->user->hasPermission('modify', 'extension/module/rm_order_exporter')) {
            $this->error['warning'] = $this->language->get('error_permission');
        }

        return !$this->error;
    }

    private function _header() {
        header('Cache-Control: max-age=0');
        header ('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
        header ('Last-Modified: '.gmdate('D, d M Y H:i:s').' GMT'); // always modified
        header ('Pragma: public'); // HTTP/1.0
        header('Content-Type: text/csv'); // setting in subclass
        header('Content-Disposition: attachment;filename="address-list-'.date('Y_m_d_H_i_s').'.csv"'); // setting in subclass
    }

    private function export_csv($data) {
        $output = "OrderNo, Name, Address, City, Province, Post, Country, Tel" . PHP_EOL;
        foreach($data as $item) {
            $output .= $item['order_id'].',';
            $output .= $item['shipping_firstname']. ' '. $item['shipping_lastname'].',';
            $output .= $item['shipping_address_1']. ' '. $item['shipping_address_2'].',';
            $output .= $item['shipping_city'].',';
            $output .= $item['shipping_zone'].',';
            $output .= $item['shipping_postcode'].',';
            $output .= $item['shipping_country'].',';
            $output .= $item['telephone'].',';
            $output .= PHP_EOL;
        }
        $this->_header();
        echo $output;
        exit;
    }

    public function install() {
    }

    public function uninstall() {
    }
}
