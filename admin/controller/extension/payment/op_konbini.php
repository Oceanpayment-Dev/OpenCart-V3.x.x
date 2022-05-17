<?php 
class ControllerExtensionPaymentOPKonbini extends Controller {
	private $error = array(); 

	public function index() {
		$this->load->language('extension/payment/op_konbini');
		
		$this->document->setTitle($this->language->get('heading_title'));
		
		$this->load->model('setting/setting');
			
		if (($this->request->server['REQUEST_METHOD'] == 'POST') && ($this->validate())) {
			$this->load->model('setting/setting');
			
			$this->model_setting_setting->editSetting('payment_op_konbini', $this->request->post);
			
			$this->session->data['success'] = $this->language->get('text_success');
			
			$this->response->redirect($this->url->link('marketplace/extension', 'user_token=' . $this->session->data['user_token'].'&type=payment', 'SSL'));
		}

		$data['heading_title'] = $this->language->get('heading_title');

		$data['text_edit'] = $this->language->get('text_edit');
		$data['text_enabled'] = $this->language->get('text_enabled');
		$data['text_disabled'] = $this->language->get('text_disabled');
		$data['text_all_zones'] = $this->language->get('text_all_zones');
		$data['text_pay'] = $this->language->get('text_pay');
		$data['text_test'] = $this->language->get('text_test');	
		$data['text_pay_iframe'] = $this->language->get('text_pay_iframe');
		$data['text_pay_redirect'] = $this->language->get('text_pay_redirect');	
		$data['text_select_currency'] = $this->language->get('text_select_currency');
		$data['text_select_all'] = $this->language->get('text_select_all');
		$data['text_unselect_all'] = $this->language->get('text_unselect_all');
		$data['text_logs_true'] = $this->language->get('text_logs_true');
		$data['text_logs_false'] = $this->language->get('text_logs_false');
		
		$data['entry_account'] = $this->language->get('entry_account');
		$data['entry_terminal'] = $this->language->get('entry_terminal');
		$data['entry_securecode'] = $this->language->get('entry_securecode');
		$data['entry_currencies'] = $this->language->get('entry_currencies');
		$data['entry_currencies_value'] = $this->language->get('entry_currencies_value');
		$data['entry_countries'] = $this->language->get('entry_countries');
		$data['entry_transaction'] = $this->language->get('entry_transaction');
		$data['entry_pay_mode'] = $this->language->get('entry_pay_mode');
	
		$data['entry_default_order_status'] = $this->language->get('entry_default_order_status');	
		$data['entry_success_order_status']=$this->language->get('entry_success_order_status');
		$data['entry_failed_order_status']=$this->language->get('entry_failed_order_status');
		$data['entry_pending_order_status']=$this->language->get('entry_pending_order_status');
		
		$data['entry_geo_zone'] = $this->language->get('entry_geo_zone');
		$data['entry_status'] = $this->language->get('entry_status');
		$data['entry_sort_order'] = $this->language->get('entry_sort_order');

		$data['button_save'] = $this->language->get('button_save');
		$data['button_cancel'] = $this->language->get('button_cancel');
		
		$data['entry_location'] = $this->language->get('entry_location');
        $data['entry_locations'] = $this->language->get('entry_locations');
        $data['entry_entity'] = $this->language->get('entry_entity');
        $data['entry_entitys'] = $this->language->get('entry_entitys');
		$data['entry_logs'] = $this->language->get('entry_logs');

		$data['text_show'] = $this->language->get('text_show');
		$data['text_hide'] = $this->language->get('text_hide');

		$data['text_shows'] = $this->language->get('text_shows');
		$data['text_hides'] = $this->language->get('text_hides');



 		if (isset($this->error['warning'])) {
			$data['error_warning'] = $this->error['warning'];
		} else {
			$data['error_warning'] = '';
		}

 		if (isset($this->error['account'])) {
			$data['error_account'] = $this->error['account'];
		} else {
			$data['error_account'] = '';
		}

		if (isset($this->error['terminal'])) {
			$data['error_terminal'] = $this->error['terminal'];
		} else {
			$data['error_terminal'] = '';
		}		
		
 		if (isset($this->error['securecode'])) {
			$data['error_securecode'] = $this->error['securecode'];
		} else {
			$data['error_securecode'] = '';
		}

  		$data['breadcrumbs'] = array();

   		$data['breadcrumbs'][] = array(
   			'text' => $this->language->get('text_home'),
       		'href' => $this->url->link('common/dashboard', 'user_token=' . $this->session->data['user_token'], 'SSL'),
   		);

   		$data['breadcrumbs'][] = array(
       		'text' => $this->language->get('text_payment'),
   			'href' => $this->url->link('extension/extension', 'user_token=' . $this->session->data['user_token'], 'SSL'),
   		);

   		$data['breadcrumbs'][] = array(
       		'text' => $this->language->get('heading_title'),
   			'href' => $this->url->link('extension/payment/op_konbini', 'user_token=' . $this->session->data['user_token'], 'SSL'),
   		);

		$data['action'] = $this->url->link('extension/payment/op_konbini', 'user_token=' . $this->session->data['user_token'], 'SSL');

		$data['cancel'] = $this->url->link('marketplace/extension', 'user_token=' . $this->session->data['user_token'].'&type=payment', 'SSL');

		if (isset($this->request->post['payment_op_konbini_account'])) {
			$data['payment_op_konbini_account'] = $this->request->post['payment_op_konbini_account'];
		} else {
			$data['payment_op_konbini_account'] = $this->config->get('payment_op_konbini_account');
		}

		if (isset($this->request->post['payment_op_konbini_terminal'])) {
			$data['payment_op_konbini_terminal'] = $this->request->post['payment_op_konbini_terminal'];
		} else {
			$data['payment_op_konbini_terminal'] = $this->config->get('payment_op_konbini_terminal');
		}

		if (isset($this->request->post['payment_op_konbini_securecode'])) {
			$data['payment_op_konbini_securecode'] = $this->request->post['payment_op_konbini_securecode'];
		} else {
			$data['payment_op_konbini_securecode'] = $this->config->get('payment_op_konbini_securecode');
		}
		
		if (isset($this->request->post['payment_op_konbini_3d'])) {
			$data['payment_op_konbini_3d'] = $this->request->post['payment_op_konbini_3d'];
		} else {
			$data['payment_op_konbini_3d'] = $this->config->get('payment_op_konbini_3d');
		}

		if (isset($this->request->post['payment_op_konbini_3d_terminal'])) {
			$data['payment_op_konbini_3d_terminal'] = $this->request->post['payment_op_konbini_3d_terminal'];
		} else {
			$data['payment_op_konbini_3d_terminal'] = $this->config->get('payment_op_konbini_3d_terminal');
		}

		if (isset($this->request->post['payment_op_konbini_3d_securecode'])) {
			$data['payment_op_konbini_3d_securecode'] = $this->request->post['payment_op_konbini_3d_securecode'];
		} else {
			$data['payment_op_konbini_3d_securecode'] = $this->config->get('payment_op_konbini_3d_securecode');
		}
		
		$this->load->model('localisation/currency');
		$results = $this->model_localisation_currency->getCurrencies();
		foreach ($results as $result) {
			$data['currencies'][] = $result['code'];
		}


		if (isset($this->request->post['payment_op_konbini_currencies_value'])) {
			$data['payment_op_konbini_currencies_value'] = $this->request->post['payment_op_konbini_currencies_value'];
		} else {
			$data['payment_op_konbini_currencies_value'] = $this->config->get('payment_op_konbini_currencies_value');
		}
		
		
		
		$this->load->model('localisation/country');
		$data['countries'] = $this->model_localisation_country->getCountries();

		if (isset($this->request->post['payment_op_konbini_country_array'])) {
			$data['payment_op_konbini_country_array'] = $this->request->post['payment_op_konbini_country_array'];
		} elseif ($this->config->has('payment_op_konbini_country_array')) {
			$data['payment_op_konbini_country_array'] = $this->config->get('payment_op_konbini_country_array');
		} else {
			$data['payment_op_konbini_country_array'] = array();
		}
		
		
		$data['callback'] = HTTP_CATALOG . 'index.php?route=extension/payment/op_konbini/callback';

		
		if (isset($this->request->post['payment_op_konbini_transaction'])) {
			$data['payment_op_konbini_transaction'] = $this->request->post['payment_op_konbini_transaction'];
		} else {
			$data['payment_op_konbini_transaction'] = $this->config->get('payment_op_konbini_transaction');
		}
		
		if (isset($this->request->post['payment_op_konbini_pay_mode'])) {
			$data['payment_op_konbini_pay_mode'] = $this->request->post['payment_op_konbini_pay_mode'];
		} else {
			$data['payment_op_konbini_pay_mode'] = $this->config->get('payment_op_konbini_pay_mode');
		}
		if (isset($this->request->post['payment_op_konbini_logs'])) {
			$data['payment_op_konbini_logs'] = $this->request->post['payment_op_konbini_logs'];
		} else {
			$data['payment_op_konbini_logs'] = $this->config->get('payment_op_konbini_logs');
		}
		
		if (isset($this->request->post['payment_op_konbini_default_order_status_id'])) {
			$data['payment_op_konbini_default_order_status_id'] = $this->request->post['payment_op_konbini_default_order_status_id'];
		} else {
			$data['payment_op_konbini_default_order_status_id'] = $this->config->get('payment_op_konbini_default_order_status_id'); 
		} 
		/* add status */
		if (isset($this->request->post['payment_op_konbini_success_order_status_id'])) {
			$data['payment_op_konbini_success_order_status_id'] = $this->request->post['payment_op_konbini_success_order_status_id'];
		} else {
			$data['payment_op_konbini_success_order_status_id'] = $this->config->get('payment_op_konbini_success_order_status_id');
		}
		if (isset($this->request->post['payment_op_konbini_failed_order_status_id'])) {
			$data['payment_op_konbini_failed_order_status_id'] = $this->request->post['payment_op_konbini_failed_order_status_id'];
		} else {
			$data['payment_op_konbini_failed_order_status_id'] = $this->config->get('payment_op_konbini_failed_order_status_id');
		}
		if (isset($this->request->post['payment_op_konbini_pending_order_status_id'])) {
			$data['payment_op_konbini_pending_order_status_id'] = $this->request->post['payment_op_konbini_pending_order_status_id'];
		} else {
			$data['payment_op_konbini_pending_order_status_id'] = $this->config->get('payment_op_konbini_pending_order_status_id');
		}
		
		
		$this->load->model('localisation/order_status');
		
		$data['order_statuses'] = $this->model_localisation_order_status->getOrderStatuses();

		if (isset($this->request->post['payment_op_konbini_geo_zone_id'])) {
			$data['payment_op_konbini_geo_zone_id'] = $this->request->post['payment_op_konbini_geo_zone_id'];
		} else {
			$data['payment_op_konbini_geo_zone_id'] = $this->config->get('payment_op_konbini_geo_zone_id');
		}

		$this->load->model('localisation/geo_zone');
										
		$data['geo_zones'] = $this->model_localisation_geo_zone->getGeoZones();
		
		if (isset($this->request->post['payment_op_konbini_status'])) {
			$data['payment_op_konbini_status'] = $this->request->post['payment_op_konbini_status'];
		} else {
			$data['payment_op_konbini_status'] = $this->config->get('payment_op_konbini_status');
		}
		
		if (isset($this->request->post['payment_op_konbini_sort_order'])) {
			$data['payment_op_konbini_sort_order'] = $this->request->post['payment_op_konbini_sort_order'];
		} else {
			$data['payment_op_konbini_sort_order'] = $this->config->get('payment_op_konbini_sort_order');
		}
		
		if (isset($this->request->post['payment_op_konbini_location'])) {
          $data['payment_op_konbini_location'] = $this->request->post['payment_op_konbini_location'];
		  } else {
			  $data['payment_op_konbini_location'] = $this->config->get('payment_op_konbini_location');
		  }

		  if (isset($this->request->post['payment_op_konbini_locations'])) {
			  $data['payment_op_konbini_locations'] = $this->request->post['payment_op_konbini_locations'];
		  } else {
			  $data['payment_op_konbini_locations'] = $this->config->get('payment_op_konbini_locations');
		  }

		  if (isset($this->request->post['payment_op_konbini_entity'])) {
			  $data['payment_op_konbini_entity'] = $this->request->post['payment_op_konbini_entity'];
		  } else {
			  $data['payment_op_konbini_entity'] = $this->config->get('payment_op_konbini_entity');
		  }

		  if (isset($this->request->post['payment_op_konbini_entitys'])) {
			  $data['payment_op_konbini_entitys'] = $this->request->post['payment_op_konbini_entitys'];
		  } else {
			  $data['payment_op_konbini_entitys'] = $this->config->get('payment_op_konbini_entitys');
		  }

		

			
			
			$data['header'] = $this->load->controller('common/header');
			$data['column_left'] = $this->load->controller('common/column_left');
			$data['footer'] = $this->load->controller('common/footer');

			$this->response->setOutput($this->load->view('extension/payment/op_konbini', $data));
		}
		

	private function validate() {
		if (!$this->user->hasPermission('modify', 'extension/payment/op_konbini')) {
			$this->error['warning'] = $this->language->get('error_permission');
		}

		if (!$this->request->post['payment_op_konbini_account']) {
			$this->error['account'] = $this->language->get('error_account');
		}

		if (!$this->request->post['payment_op_konbini_terminal']) {
			$this->error['terminal'] = $this->language->get('error_terminal');
		}

		if (!$this->request->post['payment_op_konbini_securecode']) {
			$this->error['securecode'] = $this->language->get('error_securecode');
		}
		
		return !$this->error;
	}
}
?>