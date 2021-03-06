<?php
class ControllerMyCommunitymycommunity extends Controller {
    private $error = array();
    
    public function index() {
       if (!$this->customer->isLogged()) {
            $this->session->data['redirect'] = $this->url->link('mycommunity/mycommunity', '', true);

            $this->response->redirect($this->url->link('account/login', '', true));
        } 
        
        $json = array();
            
        $this->load->language('mycommunity/mycommunity');

        $this->load->model('mycommunity/mycommunity');
        
        $data['button_sharedbooks'] = $this->language->get('button_sharedbooks');
        $data['button_reading_club'] = $this->language->get('button_reading_club');
        $data['button_authors'] = $this->language->get('button_authors');
        $data['button_publishers'] = $this->language->get('button_publishers');
        $data['text_recommended'] = $this->language->get('text_recommended');
        $data['text_members'] = $this->language->get('text_members');
        $data['text_yours'] = $this->language->get('text_yours');
        $data['text_available_books'] = $this->language->get('text_available_books');
        $data['text_requested_books'] = $this->language->get('text_requested_books');
        $data['text_name_this_club'] = $this->language->get('text_name_this_club');
        $data['text_mycommunity'] = $this->language->get('text_mycommunity');
        $data['text_description'] = $this->language->get('text_description');
        $data['text_sharesomething'] = $this->language->get('text_sharesomething');    
        $data['text_shared_books'] = $this->language->get('text_shared_books');     
        $data['button_create_club'] = $this->language->get('button_create_club');
        $data['button_cancel'] = $this->language->get('button_cancel');
        $data['button_done'] = $this->language->get('button_done');
        $data['button_join'] = $this->language->get('button_join');
        $data['button_share_with_me'] = $this->language->get('button_share_with_me');
        $data['button_shared'] = $this->language->get('button_shared');
 

        $this->document->setTitle($this->language->get('heading_title'));

        $data['breadcrumbs'] = array();

        $data['breadcrumbs'][] = array(
            'text' => $this->language->get('text_home'),
            'href' => $this->url->link('common/home')
        );

        

        $data['breadcrumbs'][] = array(
            'text' => $this->language->get('text_mycommunity'),
            'href' => $this->url->link('mycommunity/mycommunity')
        );

        $data['breadcrumbs'][] = array(
            'text' => $this->language->get('text_shared_books'),
            'href' => $this->url->link('mycommunity/mycommunity')
        );

        $data['footer'] = $this->load->controller('common/footer');
        $data['header'] = $this->load->controller('common/header');
        $data['heading_title'] = $this->language->get('heading_title');
        
        $data['sharedbooks'] = $this->url->link('mycommunity/mycommunity', '', true);
        $data['readingclub'] = $this->url->link('mycommunity/mycommunity/readingclub', '', true);
        $data['authors'] = $this->url->link('mycommunity/mycommunity/author', '', true);
        $data['publishers'] = $this->url->link('mycommunity/mycommunity/publisher', '', true);
        
        $this->load->model('mycommunity/mycommunity');
        $this->load->model('mylibrary/mylibrary');

// Shared Books Tab

        $shared_books = $this->model_mycommunity_mycommunity->getSharedbooksFromMyLibrary();

        //$shared_books = $this->model_mycommunity_mycommunity->getSharedbooks();

        $data['shared_books'] = array();

        $data['shared_books']=array();

        foreach($shared_books as $shared_book)
        {
            if(!empty($shared_book)){

                if (is_file(DIR_IMAGE . $shared_book['image'])) {
				$image = $this->model_tool_image->resize($shared_book['image'], 228, 228);
			} else {
				$image = $this->model_tool_image->resize('no_image.png', 228, 228);
			}

          //  $product_id =  $this->model_mycommunity_mycommunity->getProductId($shared_book['isbn']);

            $data['shared_books'][]=array(

                'name'        => $shared_book['name'],
                'author'      => $shared_book['author'],
                'product_id'  => $shared_book['product_id'],
                'share_price' => $shared_book['share_price'],
                'image'       => $image,
                'href'       =>$this->url->link('mycommunity/mycommunity/productDetail&product_id='.$shared_book['product_id'],'',true)
            );

            } 

        
            
        } 

        //$booklink = "mycommunity/mycommunity/requested&isbn=";
        $data['share_with_me']   = $this->url->link('mycommunity/mycommunity/productDetail&product_id=' ,'',true);




        $data['recommended_image'] = $this->url->link('mycommunity/mycommunity/recommended&group_id=', '', true);

      //   $bookresults = $this->model_mycommunity_mycommunity->getrequestedbooks();  

<<<<<<< HEAD
=======

>>>>>>> a5d53604272d2093b0b926312755c3b2f6d179e0
        $data['recommended_image'] = $this->url->link('mycommunity/mycommunity/recommended&group_id=', '', true);
 
      //   $bookresults = $this->model_mycommunity_mycommunity->getrequestedbooks();  
 
<<<<<<< HEAD
      //   $data['text_requested_books'] = $this->url->link('mycommunity/mycommunity/getrequestedbooks' , '' , true);
=======


//      $data['text_requested_books'] = $this->url->link('mycommunity/mycommunity/getrequestedbooks' , '' , true);
>>>>>>> a5d53604272d2093b0b926312755c3b2f6d179e0


        $this->response->setOutput($this->load->view('mycommunity/mycommunity', $data));

    }

     public function productDetail()
	{

		$this->load->language('mycommunity/mycommunity');

		$this->document->setTitle($this->language->get('heading_title'));

		$this->load->language('product/product');

		$data['breadcrumbs'] = array();

		$data['breadcrumbs'][] = array(
            'text' => $this->language->get('text_home'),
            'href' => $this->url->link('common/home')
        );
 
        $data['breadcrumbs'][] = array(
            'text' => $this->language->get('text_mycommunity'),
            'href' => $this->url->link('mycommunity/mycommunity')
        );

        $data['breadcrumbs'][] = array(
            'text' => $this->language->get('text_shared_books'),
            'href' => $this->url->link('mycommunity/mycommunity')
        );

	 

		$this->load->model('catalog/manufacturer');

		if (isset($this->request->get['manufacturer_id'])) {
			$data['breadcrumbs'][] = array(
				'text' => $this->language->get('text_brand'),
				'href' => $this->url->link('product/manufacturer')
			);

			$url = '';

			if (isset($this->request->get['sort'])) {
				$url .= '&sort=' . $this->request->get['sort'];
			}

			if (isset($this->request->get['order'])) {
				$url .= '&order=' . $this->request->get['order'];
			}

			if (isset($this->request->get['page'])) {
				$url .= '&page=' . $this->request->get['page'];
			}

			if (isset($this->request->get['limit'])) {
				$url .= '&limit=' . $this->request->get['limit'];
			}

			$manufacturer_info = $this->model_catalog_manufacturer->getManufacturer($this->request->get['manufacturer_id']);

			if ($manufacturer_info) {
				$data['breadcrumbs'][] = array(
					'text' => $manufacturer_info['name'],
					'href' => $this->url->link('product/manufacturer/info', 'manufacturer_id=' . $this->request->get['manufacturer_id'] . $url)
				);
			}
		}

		if (isset($this->request->get['search']) || isset($this->request->get['tag'])) {
			$url = '';

			if (isset($this->request->get['search'])) {
				$url .= '&search=' . $this->request->get['search'];
			}

			if (isset($this->request->get['tag'])) {
				$url .= '&tag=' . $this->request->get['tag'];
			}

			if (isset($this->request->get['description'])) {
				$url .= '&description=' . $this->request->get['description'];
			}

			if (isset($this->request->get['category_id'])) {
				$url .= '&category_id=' . $this->request->get['category_id'];
			}

			if (isset($this->request->get['sub_category'])) {
				$url .= '&sub_category=' . $this->request->get['sub_category'];
			}

			if (isset($this->request->get['sort'])) {
				$url .= '&sort=' . $this->request->get['sort'];
			}

			if (isset($this->request->get['order'])) {
				$url .= '&order=' . $this->request->get['order'];
			}

			if (isset($this->request->get['page'])) {
				$url .= '&page=' . $this->request->get['page'];
			}

			if (isset($this->request->get['limit'])) {
				$url .= '&limit=' . $this->request->get['limit'];
			}

			$data['breadcrumbs'][] = array(
				'text' => $this->language->get('text_search'),
				'href' => $this->url->link('product/search', $url)
			);
		}

		if (isset($this->request->get['product_id'])) {
			$product_id = (int)$this->request->get['product_id'];
		} else {
			$product_id = 0;
		}

		$this->load->model('catalog/product');

		$product_info = $this->model_catalog_product->getProduct($product_id);

		if ($product_info) {
			$url = '';

			if (isset($this->request->get['path'])) {
				$url .= '&path=' . $this->request->get['path'];
			}

			if (isset($this->request->get['filter'])) {
				$url .= '&filter=' . $this->request->get['filter'];
			}

			if (isset($this->request->get['manufacturer_id'])) {
				$url .= '&manufacturer_id=' . $this->request->get['manufacturer_id'];
			}

			if (isset($this->request->get['search'])) {
				$url .= '&search=' . $this->request->get['search'];
			}

			if (isset($this->request->get['tag'])) {
				$url .= '&tag=' . $this->request->get['tag'];
			}

			if (isset($this->request->get['description'])) {
				$url .= '&description=' . $this->request->get['description'];
			}

			if (isset($this->request->get['category_id'])) {
				$url .= '&category_id=' . $this->request->get['category_id'];
			}

			if (isset($this->request->get['sub_category'])) {
				$url .= '&sub_category=' . $this->request->get['sub_category'];
			}

			if (isset($this->request->get['sort'])) {
				$url .= '&sort=' . $this->request->get['sort'];
			}

			if (isset($this->request->get['order'])) {
				$url .= '&order=' . $this->request->get['order'];
			}

			if (isset($this->request->get['page'])) {
				$url .= '&page=' . $this->request->get['page'];
			}

			if (isset($this->request->get['limit'])) {
				$url .= '&limit=' . $this->request->get['limit'];
			}

			$data['breadcrumbs'][] = array(
				'text' => $product_info['name'],
				'href' => $this->url->link('product/product', $url . '&product_id=' . $this->request->get['product_id'])
			);

			$this->document->setTitle($product_info['meta_title']);
			$this->document->setDescription($product_info['meta_description']);
			$this->document->setKeywords($product_info['meta_keyword']);
			$this->document->addLink($this->url->link('product/product', 'product_id=' . $this->request->get['product_id']), 'canonical');
			$this->document->addScript('catalog/view/javascript/jquery/magnific/jquery.magnific-popup.min.js');
			$this->document->addStyle('catalog/view/javascript/jquery/magnific/magnific-popup.css');
			$this->document->addScript('catalog/view/javascript/jquery/datetimepicker/moment.js');
			$this->document->addScript('catalog/view/javascript/jquery/datetimepicker/bootstrap-datetimepicker.min.js');
			$this->document->addStyle('catalog/view/javascript/jquery/datetimepicker/bootstrap-datetimepicker.min.css');

			$data['heading_title'] = $product_info['name'];

			$data['text_select'] = $this->language->get('text_select');
			$data['text_manufacturer'] = $this->language->get('text_manufacturer');
			$data['text_model'] = $this->language->get('text_model');
			$data['text_reward'] = $this->language->get('text_reward');
			$data['text_points'] = $this->language->get('text_points');
			$data['text_stock'] = $this->language->get('text_stock');
			$data['text_discount'] = $this->language->get('text_discount');
			$data['text_tax'] = $this->language->get('text_tax');
			$data['text_option'] = $this->language->get('text_option');
			$data['text_minimum'] = sprintf($this->language->get('text_minimum'), $product_info['minimum']);
			$data['text_write'] = $this->language->get('text_write');
			$data['text_login'] = sprintf($this->language->get('text_login'), $this->url->link('account/login', '', true), $this->url->link('account/register', '', true));
			$data['text_note'] = $this->language->get('text_note');
			$data['text_tags'] = $this->language->get('text_tags');
			$data['text_related'] = $this->language->get('text_related');
			$data['text_payment_recurring'] = $this->language->get('text_payment_recurring');
			$data['text_loading'] = $this->language->get('text_loading');

			$data['entry_qty'] = $this->language->get('entry_qty');
			$data['entry_name'] = $this->language->get('entry_name');
			$data['entry_review'] = $this->language->get('entry_review');
			$data['entry_rating'] = $this->language->get('entry_rating');
			$data['entry_good'] = $this->language->get('entry_good');
			$data['entry_bad'] = $this->language->get('entry_bad');

			$data['button_cart'] = $this->language->get('button_cart');
			$data['button_wishlist'] = $this->language->get('button_wishlist');
			$data['button_compare'] = $this->language->get('button_compare');
			$data['button_upload'] = $this->language->get('button_upload');
			$data['button_continue'] = $this->language->get('button_continue');

			$this->load->model('catalog/review');

			$data['tab_description'] = $this->language->get('tab_description');
			$data['tab_attribute'] = $this->language->get('tab_attribute');
			$data['tab_review'] = sprintf($this->language->get('tab_review'), $product_info['reviews']);

			$data['product_id'] = (int)$this->request->get['product_id'];
			$data['manufacturer'] = $product_info['manufacturer'];
			$data['manufacturers'] = $this->url->link('product/manufacturer/info', 'manufacturer_id=' . $product_info['manufacturer_id']);
			$data['model'] = $product_info['model'];
			$data['reward'] = $product_info['reward'];
			$data['points'] = $product_info['points'];
			$data['description'] = html_entity_decode($product_info['description'], ENT_QUOTES, 'UTF-8');

			if ($product_info['quantity'] <= 0) {
				$data['stock'] = $product_info['stock_status'];
			} elseif ($this->config->get('config_stock_display')) {
				$data['stock'] = $product_info['quantity'];
			} else {
				$data['stock'] = $this->language->get('text_instock');
			}

			$this->load->model('tool/image');

			if ($product_info['image']) {
				$data['popup'] = $this->model_tool_image->resize($product_info['image'], $this->config->get($this->config->get('config_theme') . '_image_popup_width'), $this->config->get($this->config->get('config_theme') . '_image_popup_height'));
			} else {
				$data['popup'] = '';
			}

			if ($product_info['image']) {
				$data['thumb'] = $this->model_tool_image->resize($product_info['image'], $this->config->get($this->config->get('config_theme') . '_image_thumb_width'), $this->config->get($this->config->get('config_theme') . '_image_thumb_height'));
			} else {
				$data['thumb'] = '';
			}

			$data['images'] = array();

			$results = $this->model_catalog_product->getProductImages($this->request->get['product_id']);

			foreach ($results as $result) {
				$data['images'][] = array(
					'popup' => $this->model_tool_image->resize($result['image'], $this->config->get($this->config->get('config_theme') . '_image_popup_width'), $this->config->get($this->config->get('config_theme') . '_image_popup_height')),
					'thumb' => $this->model_tool_image->resize($result['image'], $this->config->get($this->config->get('config_theme') . '_image_additional_width'), $this->config->get($this->config->get('config_theme') . '_image_additional_height'))
				);
			}

            
			$isbn = $this->model_catalog_product->getProductBestPrices($this->request->get['product_id']);

			foreach($isbn as $ISBN){

					$shared_prices = $this->model_catalog_product->sharedCustomers($ISBN);
					asort($shared_prices);

			}

            if($shared_prices){

					$lowest_customer_price = array_values($shared_prices)[0];

			}else{

					$lowest_customer_price = '';

			}
			
            $data['shared_prices'] = array();

			foreach($shared_prices as $key => $value){
				$data['shared_prices'][] =array(
					'customer_id'=>"_".$key,
					'share_price' =>$value['share_price']
					//'first_name'=>$customer_price['first_name'],
					//'last_name'=>$customer_price['last_name']
				);

			}
            
        
			if ($this->customer->isLogged() || !$this->config->get('config_customer_price')) {
				$data['price'] = $this->currency->format($this->tax->calculate($lowest_customer_price['share_price'], $product_info['tax_class_id'], $this->config->get('config_tax')), $this->session->data['currency']);
			} else {
				$data['price'] = false;
			}

			if ((float)$product_info['special']) {
				$data['special'] = $this->currency->format($this->tax->calculate($product_info['special'], $product_info['tax_class_id'], $this->config->get('config_tax')), $this->session->data['currency']);
			} else {
				$data['special'] = false;
			}

			if ($this->config->get('config_tax')) {
				$data['tax'] = $this->currency->format((float)$product_info['special'] ? $product_info['special'] : $product_info['price'], $this->session->data['currency']);
			} else {
				$data['tax'] = false;
			}

			$discounts = $this->model_catalog_product->getProductDiscounts($this->request->get['product_id']);

			$data['discounts'] = array();

			foreach ($discounts as $discount) {
				$data['discounts'][] = array(
					'quantity' => $discount['quantity'],
					'price'    => $this->currency->format($this->tax->calculate($discount['price'], $product_info['tax_class_id'], $this->config->get('config_tax')), $this->session->data['currency'])
				);
			}

 		
			$data['options'] = array();

			foreach ($this->model_catalog_product->getProductOptions($this->request->get['product_id']) as $option) {
				$product_option_value_data = array();

				foreach ($option['product_option_value'] as $option_value) {
					if (!$option_value['subtract'] || ($option_value['quantity'] > 0)) {
						if ((($this->config->get('config_customer_price') && $this->customer->isLogged()) || !$this->config->get('config_customer_price')) && (float)$option_value['price']) {
							$price = $this->currency->format($this->tax->calculate($option_value['price'], $product_info['tax_class_id'], $this->config->get('config_tax') ? 'P' : false), $this->session->data['currency']);
						} else {
							$price = false;
						}

						$product_option_value_data[] = array(
							'product_option_value_id' => $option_value['product_option_value_id'],
							'option_value_id'         => $option_value['option_value_id'],
							'name'                    => $option_value['name'],
							'image'                   => $this->model_tool_image->resize($option_value['image'], 50, 50),
							'price'                   => $price,
							'price_prefix'            => $option_value['price_prefix']
						);
					}
				}

				$data['options'][] = array(
					'product_option_id'    => $option['product_option_id'],
					'product_option_value' => $product_option_value_data,
					'option_id'            => $option['option_id'],
					'name'                 => $option['name'],
					'type'                 => $option['type'],
					'value'                => $option['value'],
					'required'             => $option['required']
				);
			}

			if ($product_info['minimum']) {
				$data['minimum'] = $product_info['minimum'];
			} else {
				$data['minimum'] = 1;
			}

			$data['review_status'] = $this->config->get('config_review_status');

			if ($this->config->get('config_review_guest') || $this->customer->isLogged()) {
				$data['review_guest'] = true;
			} else {
				$data['review_guest'] = false;
			}

			if ($this->customer->isLogged()) {
				$data['customer_name'] = $this->customer->getFirstName() . '&nbsp;' . $this->customer->getLastName();
			} else {
				$data['customer_name'] = '';
			}

			$data['reviews'] = sprintf($this->language->get('text_reviews'), (int)$product_info['reviews']);
			$data['rating'] = (int)$product_info['rating'];

			// Captcha
			if ($this->config->get($this->config->get('config_captcha') . '_status') && in_array('review', (array)$this->config->get('config_captcha_page'))) {
				$data['captcha'] = $this->load->controller('extension/captcha/' . $this->config->get('config_captcha'));
			} else {
				$data['captcha'] = '';
			}

			$data['share'] = $this->url->link('product/product', 'product_id=' . (int)$this->request->get['product_id']);

			$data['attribute_groups'] = $this->model_catalog_product->getProductAttributes($this->request->get['product_id']);

			$data['products'] = array();

			$results = $this->model_catalog_product->getProductRelated($this->request->get['product_id']);
			 

			foreach ($results as $result) {
				if ($result['image']) {
					$image = $this->model_tool_image->resize($result['image'], $this->config->get($this->config->get('config_theme') . '_image_related_width'), $this->config->get($this->config->get('config_theme') . '_image_related_height'));
				} else {
					$image = $this->model_tool_image->resize('placeholder.png', $this->config->get($this->config->get('config_theme') . '_image_related_width'), $this->config->get($this->config->get('config_theme') . '_image_related_height'));
				}

				if ($this->customer->isLogged() || !$this->config->get('config_customer_price')) {
					$price = $this->currency->format($this->tax->calculate($result['price'], $result['tax_class_id'], $this->config->get('config_tax')), $this->session->data['currency']);
				} else {
					$price = false;
				}

				if ((float)$result['special']) {
					$special = $this->currency->format($this->tax->calculate($result['special'], $result['tax_class_id'], $this->config->get('config_tax')), $this->session->data['currency']);
				} else {
					$special = false;
				}

				if ($this->config->get('config_tax')) {
					$tax = $this->currency->format((float)$result['special'] ? $result['special'] : $result['price'], $this->session->data['currency']);
				} else {
					$tax = false;
				}

				if ($this->config->get('config_review_status')) {
					$rating = (int)$result['rating'];
				} else {
					$rating = false;
				}

				$data['products'][] = array(
					'product_id'  => $result['product_id'],
					'thumb'       => $image,
					'name'        => $result['name'],
					'description' => utf8_substr(strip_tags(html_entity_decode($result['description'], ENT_QUOTES, 'UTF-8')), 0, $this->config->get($this->config->get('config_theme') . '_product_description_length')) . '..',
					'price'       => $price,
					'special'     => $special,
					'tax'         => $tax,
					'minimum'     => $result['minimum'] > 0 ? $result['minimum'] : 1,
					'rating'      => $rating,
					'href'        => $this->url->link('product/product', 'product_id=' . $result['product_id'])
				);
			}

			$data['tags'] = array();

			if ($product_info['tag']) {
				$tags = explode(',', $product_info['tag']);

				foreach ($tags as $tag) {
					$data['tags'][] = array(
						'tag'  => trim($tag),
						'href' => $this->url->link('product/search', 'tag=' . trim($tag))
					);
				}
			}

			$data['recurrings'] = $this->model_catalog_product->getProfiles($this->request->get['product_id']);

			$this->model_catalog_product->updateViewed($this->request->get['product_id']);

			$data['column_left'] = $this->load->controller('common/column_left');
			$data['column_right'] = $this->load->controller('common/column_right');
			$data['content_top'] = $this->load->controller('common/content_top');
			$data['content_bottom'] = $this->load->controller('common/content_bottom');
			$data['footer'] = $this->load->controller('common/footer');
			$data['header'] = $this->load->controller('common/header');

			$this->response->setOutput($this->load->view('mycommunity/product_detail', $data));
		 
        
        }else 
		{
			$url = '';

			if (isset($this->request->get['path'])) {
				$url .= '&path=' . $this->request->get['path'];
			}

			if (isset($this->request->get['filter'])) {
				$url .= '&filter=' . $this->request->get['filter'];
			}

			if (isset($this->request->get['manufacturer_id'])) {
				$url .= '&manufacturer_id=' . $this->request->get['manufacturer_id'];
			}

			if (isset($this->request->get['search'])) {
				$url .= '&search=' . $this->request->get['search'];
			}

			if (isset($this->request->get['tag'])) {
				$url .= '&tag=' . $this->request->get['tag'];
			}

			if (isset($this->request->get['description'])) {
				$url .= '&description=' . $this->request->get['description'];
			}

			if (isset($this->request->get['category_id'])) {
				$url .= '&category_id=' . $this->request->get['category_id'];
			}

			if (isset($this->request->get['sub_category'])) {
				$url .= '&sub_category=' . $this->request->get['sub_category'];
			}

			if (isset($this->request->get['sort'])) {
				$url .= '&sort=' . $this->request->get['sort'];
			}

			if (isset($this->request->get['order'])) {
				$url .= '&order=' . $this->request->get['order'];
			}

			if (isset($this->request->get['page'])) {
				$url .= '&page=' . $this->request->get['page'];
			}

			if (isset($this->request->get['limit'])) {
				$url .= '&limit=' . $this->request->get['limit'];
			}

			$data['breadcrumbs'][] = array(
				'text' => $this->language->get('text_error'),
				'href' => $this->url->link('product/product', $url . '&product_id=' . $product_id)
			);

			$this->document->setTitle($this->language->get('text_error'));

			$data['heading_title'] = $this->language->get('text_error');

			$data['text_error'] = $this->language->get('text_error');

			$data['button_continue'] = $this->language->get('button_continue');

			$data['continue'] = $this->url->link('common/home');

			$this->response->addHeader($this->request->server['SERVER_PROTOCOL'] . ' 404 Not Found');

			$data['column_left'] = $this->load->controller('common/column_left');
			$data['column_right'] = $this->load->controller('common/column_right');
			$data['content_top'] = $this->load->controller('common/content_top');
			$data['content_bottom'] = $this->load->controller('common/content_bottom');
			$data['footer'] = $this->load->controller('common/footer');
			$data['header'] = $this->load->controller('common/header');

			$this->response->setOutput($this->load->view('error/not_found', $data));
		}
	} 

    public function readingclub(){
            
      $this->load->language('mycommunity/mycommunity');

        $data['button_sharedbooks'] = $this->language->get('button_sharedbooks');
        $data['button_reading_club'] = $this->language->get('button_reading_club');
        $data['button_authors'] = $this->language->get('button_authors');
        $data['button_publishers'] = $this->language->get('button_publishers');
        $data['text_recommended'] = $this->language->get('text_recommended');
        $data['text_members'] = $this->language->get('text_members');
        $data['text_yours'] = $this->language->get('text_yours');
        $data['text_name_this_club'] = $this->language->get('text_name_this_club');
        $data['text_description'] = $this->language->get('text_description');
        $data['text_sharesomething'] = $this->language->get('text_sharesomething');  
        $data['text_mycommunity'] = $this->language->get('text_mycommunity');   
        $data['text_reading_club'] = $this->language->get('text_reading_club');   
        $data['button_create_club'] = $this->language->get('button_create_club');
        $data['button_cancel'] = $this->language->get('button_cancel');
        $data['button_done'] = $this->language->get('button_done');
        $data['button_join'] = $this->language->get('button_join');
        $data['button_member'] = $this->language->get('button_member');

      $this->document->setTitle($this->language->get('heading_title'));

      $this->load->model('mycommunity/mycommunity');

    //  $data['addmember']=$this->url->link('mycommunity/mycommunity/join','',true);

        $url='';

        $data['breadcrumbs'] = array();

        $data['breadcrumbs'][] = array(
            'text' => $this->language->get('text_home'),
            'href' => $this->url->link('common/home')
        );

        

        $data['breadcrumbs'][] = array(
            'text' => $this->language->get('text_mycommunity'),
            'href' => $this->url->link('mycommunity/mycommunity')
        );

        $data['breadcrumbs'][] = array( 
            'text' =>  $this->language->get('text_reading_club'),
            'href' => $this->url->link('mycommunity/mycommunity/readingclub')
        );

         
        $data['footer'] = $this->load->controller('common/footer');
        $data['header'] = $this->load->controller('common/header');
        $data['heading_title'] = $this->language->get('heading_title');
        
        $data['sharedbooks'] = $this->url->link('mycommunity/mycommunity', '', true);
        $data['readingclub'] = $this->url->link('mycommunity/mycommunity/readingclub', '', true);
        $data['authors'] = $this->url->link('mycommunity/mycommunity/author', '', true);
        $data['publishers'] = $this->url->link('mycommunity/mycommunity/publisher', '', true);

        $this->load->model('mycommunity/mycommunity');

// for recommended tab

        $recommended = $this->model_mycommunity_mycommunity->getRecommended();

        foreach($recommended as $result)
       {
          $recommended_groups[] = $this->model_mycommunity_mycommunity->memberstatus($result['group_id']);
       }

         
        
        foreach($recommended_groups as $recom)
        {
           
             if (is_file(DIR_IMAGE.$recom['group_image'])) {
				$image = $this->model_tool_image->resize($recom['group_image'], 189, 95);
			} else {
				$image = $this->model_tool_image->resize('no_image.png', 189, 95);
			}


            $data['groups'][] = array (

                    'group_id'    =>$recom['group_id'],
                    'group_name'  =>$recom['group_name'],
                    'group_image' =>$image,
                    'status'      =>$recom['status']
                    
                 
                    );
             
        }  

// for members tab

         $member_in_groups = $this->model_mycommunity_mycommunity->groupmember();

         $data['members'] = array();

         foreach($member_in_groups as $memberresult)
		 {
            
            if (is_file(DIR_IMAGE.$memberresult['group_image'])) {
				$image = $this->model_tool_image->resize($memberresult['group_image'], 189, 95);
			} else {
				$image = $this->model_tool_image->resize('no_image.png', 189, 95);
			}
              
			 $data['members'][] = array (

				 'group_id'    =>$memberresult['group_id'],
			     'group_name'  =>$memberresult['group_name'],
			     'group_image' =>$image,
                 'status'      =>$memberresult['status']

					);
			 
		 } 

  // yours tab      

         $customer_id = (int)$this->customer->getId();
		 $data['clubs'] = array();
		 $clubresults = $this->model_mycommunity_mycommunity->getclubs();
		 foreach($clubresults as $clubresult)
		 {
             
            if (is_file(DIR_IMAGE.$clubresult['group_image'])) {
				$image = $this->model_tool_image->resize($clubresult['group_image'], 189, 95);
			} else {
				$image = $this->model_tool_image->resize('no_image.png', 189, 95);
			}

			 $data['clubs'][] = array (

                 'group_id'          =>$clubresult['group_id'],
				 'group_name'        =>$clubresult['group_name'],
				 'group_image'       =>$image,
			     'group_description' =>$clubresult['group_description'],
                 'status'            =>$clubresult['status']
					);
			 
		 }   

      $data['create_club'] = $this->url->link('mycommunity/mycommunity/createclub', '', true);
    //  $data['recommended_image'] = $this->url->link('mycommunity/mycommunity/recommended&group_id=', '', true);

      $data['member_image'] = $this->url->link('mycommunity/mycommunity/recommended&group_id=', '', true);

      $data['club_image'] = $this->url->link('mycommunity/mycommunity/club_info&group_id=', '', true);
     
      $data['addmember']   = $this->url->link('mycommunity/mycommunity/join', '', true);

      $data['sharedbooks'] = $this->url->link('mycommunity/mycommunity', '', true);
      $data['readingclub'] = $this->url->link('mycommunity/mycommunity/readingclub', '', true);
      $data['authors'] = $this->url->link('mycommunity/mycommunity/author', '', true);
      $data['publishers'] = $this->url->link('mycommunity/mycommunity/publisher', '', true);

      $data['create_newclub'] = $this->url->link('mycommunity/mycommunity/create_newclub', '', true);
 
      $data['recommended_image'] = $this->url->link('mycommunity/mycommunity/recommended&group_id=', '', true);
      $data['active_tab'] = 'tab_default_1';

      $this->response->setOutput($this->load->view('mycommunity/readingclub', $data));


    }

        public function create_newclub(){

        $this->load->model('mycommunity/mycommunity');

        $this->load->language('mycommunity/mycommunity');

        $data['button_sharedbooks'] = $this->language->get('button_sharedbooks');
        $data['button_reading_club'] = $this->language->get('button_reading_club');
        $data['button_authors'] = $this->language->get('button_authors');
        $data['button_publishers'] = $this->language->get('button_publishers');
        $data['text_recommended'] = $this->language->get('text_recommended');
        $data['text_members'] = $this->language->get('text_members');
        $data['text_yours'] = $this->language->get('text_yours');
        $data['text_name_this_club'] = $this->language->get('text_name_this_club');
        $data['text_description'] = $this->language->get('text_description');
        $data['text_location'] = $this->language->get('text_location');
        $data['text_mycommunity'] = $this->language->get('text_mycommunity');
        $data['text_reading_club'] = $this->language->get('text_reading_club');
        $data['text_sharesomething'] = $this->language->get('text_sharesomething'); 
        $data['text_create_reading_club'] = $this->language->get('text_create_reading_club');     
        $data['text_reading_club'] = $this->language->get('text_reading_club');     
        $data['button_create_club'] = $this->language->get('button_create_club');
        $data['button_cancel'] = $this->language->get('button_cancel');
        $data['button_done'] = $this->language->get('button_done');
        $data['button_join'] = $this->language->get('button_join');


       $this->document->setTitle($this->language->get('heading_title'));


       $url='';

        $data['breadcrumbs'] = array();

        $data['breadcrumbs'][] = array(
            'text' => $this->language->get('text_home'),
            'href' => $this->url->link('common/home')
        );

        

        $data['breadcrumbs'][] = array(
            'text' => $this->language->get('text_mycommunity'),
            'href' => $this->url->link('mycommunity/mycommunity')
        );

        $data['breadcrumbs'][] = array(
            'text' =>  $this->language->get('text_reading_club'),
            'href' => $this->url->link('mycommunity/mycommunity/readingclub')
        );

        $data['breadcrumbs'][] = array( 
            'text' =>  $this->language->get('text_create_reading_club'),
            'href' => $this->url->link('mycommunity/mycommunity/create_newclub')
        );


        $data['footer'] = $this->load->controller('common/footer');
        $data['header'] = $this->load->controller('common/header');
        $data['heading_title'] = $this->language->get('heading_title');

        $data['sharedbooks'] = $this->url->link('mycommunity/mycommunity', '', true);
        $data['readingclub'] = $this->url->link('mycommunity/mycommunity/readingclub', '', true);
        $data['authors'] = $this->url->link('mycommunity/mycommunity/author', '', true);
        $data['publishers'] = $this->url->link('mycommunity/mycommunity/publisher', '', true);

        $data['create_club'] = $this->url->link('mycommunity/mycommunity/createclub', '', true);

        $data['cancel'] = $this->url->link('mycommunity/mycommunity/cancel', '', true);        

         $data['club_image'] = $this->url->link('mycommunity/mycommunity/club_info&group_id=', '', true);
     
       
        $this->response->setOutput($this->load->view('mycommunity/create_newclub', $data));

    }

        public function cancel(){


        $this->load->model('mycommunity/mycommunity'); 

        $this->load->language('mycommunity/mycommunity');

        $data['button_sharedbooks'] = $this->language->get('button_sharedbooks');
        $data['button_reading_club'] = $this->language->get('button_reading_club');
        $data['button_authors'] = $this->language->get('button_authors');
        $data['button_publishers'] = $this->language->get('button_publishers');
        $data['text_recommended'] = $this->language->get('text_recommended');
        $data['text_members'] = $this->language->get('text_members');
        $data['text_yours'] = $this->language->get('text_yours');
        $data['text_name_this_club'] = $this->language->get('text_name_this_club');
        $data['text_description'] = $this->language->get('text_description');
        $data['text_location'] = $this->language->get('text_location');
        $data['text_mycommunity'] = $this->language->get('text_mycommunity');
        $data['text_reading_club'] = $this->language->get('text_reading_club');
        $data['text_sharesomething'] = $this->language->get('text_sharesomething'); 
        $data['text_create_reading_club'] = $this->language->get('text_create_reading_club');     
        $data['text_reading_club'] = $this->language->get('text_reading_club');     
        $data['button_create_club'] = $this->language->get('button_create_club');
        $data['button_cancel'] = $this->language->get('button_cancel');
        $data['button_member'] = $this->language->get('button_member');
        $data['button_done'] = $this->language->get('button_done');
        $data['button_join'] = $this->language->get('button_join');


       $this->document->setTitle($this->language->get('heading_title'));


       $url='';

        $data['breadcrumbs'] = array();

        $data['breadcrumbs'][] = array(
            'text' => $this->language->get('text_home'),
            'href' => $this->url->link('common/home')
        );

        

        $data['breadcrumbs'][] = array(
            'text' => $this->language->get('text_mycommunity'),
            'href' => $this->url->link('mycommunity/mycommunity')
        );

        $data['breadcrumbs'][] = array(
            'text' =>  $this->language->get('text_reading_club'),
            'href' => $this->url->link('mycommunity/mycommunity/readingclub')
        );

        $data['footer'] = $this->load->controller('common/footer');
        $data['header'] = $this->load->controller('common/header');
        $data['heading_title'] = $this->language->get('heading_title');

        $data['sharedbooks'] = $this->url->link('mycommunity/mycommunity', '', true);
        $data['readingclub'] = $this->url->link('mycommunity/mycommunity/readingclub', '', true);
        $data['authors'] = $this->url->link('mycommunity/mycommunity/author', '', true);
        $data['publishers'] = $this->url->link('mycommunity/mycommunity/publisher', '', true);

// for recommended tab

        $recommended = $this->model_mycommunity_mycommunity->getRecommended();

        foreach($recommended as $result)
       {
          $recommended_groups[] = $this->model_mycommunity_mycommunity->memberstatus($result['group_id']);
       }

         
        
        foreach($recommended_groups as $recom)
        {
           
             if (is_file(DIR_IMAGE.$recom['group_image'])) {
				$image = $this->model_tool_image->resize($recom['group_image'], 189, 95);
			} else {
				$image = $this->model_tool_image->resize('no_image.png', 189, 95);
			}


            $data['groups'][] = array (

                    'group_id'    =>$recom['group_id'],
                    'group_name'  =>$recom['group_name'],
                    'group_image' =>$image,
                    'status'      =>$recom['status']
                    
                 
                    );
             
        }  

// for members tab

         $member_in_groups = $this->model_mycommunity_mycommunity->groupmember();

         $data['members'] = array();

         foreach($member_in_groups as $memberresult)
		 {
            
            if (is_file(DIR_IMAGE.$memberresult['group_image'])) {
				$image = $this->model_tool_image->resize($memberresult['group_image'], 189, 95);
			} else {
				$image = $this->model_tool_image->resize('no_image.png', 189, 95);
			}
              
			 $data['members'][] = array (

				 'group_id'    =>$memberresult['group_id'],
			     'group_name'  =>$memberresult['group_name'],
			     'group_image' =>$image,
                 'status'      =>$memberresult['status']

					);
			 
		 } 

  // yours tab      

   $customer_id = (int)$this->customer->getId();
		 $data['clubs'] = array();
		 $clubresults = $this->model_mycommunity_mycommunity->getclubs();
		 foreach($clubresults as $clubresult)
		 {
             
            if (is_file(DIR_IMAGE.$clubresult['group_image'])) {
				$image = $this->model_tool_image->resize($clubresult['group_image'], 189, 95);
			} else {
				$image = $this->model_tool_image->resize('no_image.png', 189, 95);
			}

			 $data['clubs'][] = array (

                 'group_id'          =>$clubresult['group_id'],
				 'group_name'        =>$clubresult['group_name'],
				 'group_image'       =>$image,
			     'group_description' =>$clubresult['group_description'],
                  'status'            =>$clubresult['status']
					);
			 
		 }   
   
      $data['create_club'] = $this->url->link('mycommunity/mycommunity/createclub', '', true);
      $data['recommended_image'] = $this->url->link('mycommunity/mycommunity/recommended&group_id=', '', true);

      $data['member_image'] = $this->url->link('mycommunity/mycommunity/recommended&group_id=', '', true);

      $data['club_image'] = $this->url->link('mycommunity/mycommunity/club_info&group_id=', '', true);

      $data['addmember']   = $this->url->link('mycommunity/mycommunity/join', '', true);

      $data['create_newclub'] = $this->url->link('mycommunity/mycommunity/create_newclub', '', true);

      $data['recommended_image'] = $this->url->link('mycommunity/mycommunity/recommended&group_id=', '', true);

      $data['club_image'] = $this->url->link('mycommunity/mycommunity/club_info&group_id=', '', true);
     
      $data['active_tab'] = 'tab_default_3';

      $this->response->setOutput($this->load->view('mycommunity/readingclub', $data));


    }
    
       public function join() {

       $group_id = $this->request->post['groupid'];

       $this->load->model('mycommunity/mycommunity');

	   $this->model_mycommunity_mycommunity->addtomember($group_id);

 	 

 	    $this->load->language('mycommunity/mycommunity');

         
        $data['button_sharedbooks'] = $this->language->get('button_sharedbooks');
        $data['button_reading_club'] = $this->language->get('button_reading_club');
        $data['button_authors'] = $this->language->get('button_authors');
        $data['button_publishers'] = $this->language->get('button_publishers');
        $data['text_recommended'] = $this->language->get('text_recommended');
        $data['text_members'] = $this->language->get('text_members');
        $data['text_yours'] = $this->language->get('text_yours');
        $data['text_name_this_club'] = $this->language->get('text_name_this_club');
        $data['text_description'] = $this->language->get('text_description');
        $data['text_sharesomething'] = $this->language->get('text_sharesomething');   
        $data['text_mycommunity'] = $this->language->get('text_mycommunity');  
        $data['text_reading_club'] = $this->language->get('text_reading_club');     
        $data['button_create_club'] = $this->language->get('button_create_club');
        $data['button_cancel'] = $this->language->get('button_cancel');
        $data['button_done'] = $this->language->get('button_done');
        $data['button_join'] = $this->language->get('button_join');
        $data['button_member'] = $this->language->get('button_member');

        $data['breadcrumbs'] = array();

        $data['breadcrumbs'][] = array(
            'text' => $this->language->get('text_home'),
            'href' => $this->url->link('common/home')
        );

        

        $data['breadcrumbs'][] = array(
            'text' =>$this->language->get('text_mycommunity'),
            'href' => $this->url->link('mycommunity/mycommunity')
        );

         $data['breadcrumbs'][] = array(
            'text' =>$this->language->get('text_mycommunity'),
            'href' => $this->url->link('mycommunity/mycommunity/readingclub')
        );

    
        $data['footer'] = $this->load->controller('common/footer');
        $data['header'] = $this->load->controller('common/header');
        $data['heading_title'] = $this->language->get('heading_title');

        $data['sharedbooks'] = $this->url->link('mycommunity/mycommunity', '', true);
        $data['readingclub'] = $this->url->link('mycommunity/mycommunity/readingclub', '', true);
        $data['authors'] = $this->url->link('mycommunity/mycommunity/author', '', true);
        $data['publishers'] = $this->url->link('mycommunity/mycommunity/publisher', '', true);
        
         $this->load->model('mycommunity/mycommunity');

       // for recommended tab

        $recommended = $this->model_mycommunity_mycommunity->getRecommended();

        foreach($recommended as $result)
       {
          $recommended_groups[] = $this->model_mycommunity_mycommunity->memberstatus($result['group_id']);
       }

         
        
        foreach($recommended_groups as $recom)
        {
           
             if (is_file(DIR_IMAGE.$recom['group_image'])) {
				$image = $this->model_tool_image->resize($recom['group_image'], 189, 95);
			} else {
				$image = $this->model_tool_image->resize('no_image.png', 189, 95);
			}


            $data['groups'][] = array (

                    'group_id'    =>$recom['group_id'],
                    'group_name'  =>$recom['group_name'],
                    'group_image' =>$image,
                    'status'      =>$recom['status']
                    
                 
                    );
             
        }  

// for members tab

         $member_in_groups = $this->model_mycommunity_mycommunity->groupmember();

         $data['members'] = array();

         foreach($member_in_groups as $memberresult)
		 {
            
            if (is_file(DIR_IMAGE.$memberresult['group_image'])) {
				$image = $this->model_tool_image->resize($memberresult['group_image'], 189, 95);
			} else {
				$image = $this->model_tool_image->resize('no_image.png', 189, 95);
			}
              
			 $data['members'][] = array (

				 'group_id'    =>$memberresult['group_id'],
			     'group_name'  =>$memberresult['group_name'],
			     'group_image' =>$image,
                 'status'      =>$memberresult['status']

					);
			 
		 } 

  // yours tab      

   $customer_id = (int)$this->customer->getId();
		 $data['clubs'] = array();
		 $clubresults = $this->model_mycommunity_mycommunity->getclubs();
		 foreach($clubresults as $clubresult)
		 {
             
            if (is_file(DIR_IMAGE.$clubresult['group_image'])) {
				$image = $this->model_tool_image->resize($clubresult['group_image'], 189, 95);
			} else {
				$image = $this->model_tool_image->resize('no_image.png', 189, 95);
			}

			 $data['clubs'][] = array (

                 'group_id'          =>$clubresult['group_id'],
				 'group_name'        =>$clubresult['group_name'],
				 'group_image'       =>$image,
			     'group_description' =>$clubresult['group_description'],
                  'status'            =>$clubresult['status']
					);
			 
		 }   
         

        $data['sharedbooks'] = $this->url->link('mycommunity/mycommunity', '', true);
        $data['readingclub'] = $this->url->link('mycommunity/mycommunity/readingclub', '', true);
        $data['authors'] = $this->url->link('mycommunity/mycommunity/author', '', true);
        $data['publishers'] = $this->url->link('mycommunity/mycommunity/publisher', '', true);

        $data['create_club'] = $this->url->link('mycommunity/mycommunity/createclub', '', true);

        $data['member_image'] = $this->url->link('mycommunity/mycommunity/recommended&group_id=', '', true);

        $data['recommended_image'] = $this->url->link('mycommunity/mycommunity/recommended&group_id=', '', true);

        $data['club_image'] = $this->url->link('mycommunity/mycommunity/club_info&group_id=', '', true);

        $data['addmember']   = $this->url->link('mycommunity/mycommunity/join', '', true);
   
        $data['active_tab'] = 'tab_default_2';
        
        $this->response->setOutput($this->load->view('mycommunity/readingclub', $data));

}


       public function join_communtiy() {
  
        
       $group_id = $this->request->get['group_id'];    
       $this->load->language('mycommunity/mycommunity');

       $this->document->setTitle($this->language->get('heading_title'));

       $this->load->model('mycommunity/mycommunity');

       $this->model_mycommunity_mycommunity->addtomember($group_id);

        $url='';

        $data['breadcrumbs'] = array();

        $data['breadcrumbs'][] = array(
            'text' => $this->language->get('text_home'),
            'href' => $this->url->link('common/home')
        );

         $data['breadcrumbs'][] = array(
            'text' => $this->language->get('text_mycommunity'),
            'href' => $this->url->link('mycommunity/mycommunity')
        );

        
        $data['breadcrumbs'][] = array(
            'text' => $this->language->get('text_reading_club'),
            'href' => $this->url->link('mycommunity/mycommunity/readingclub')
        );

       
        $data['breadcrumbs'][] = array(
            'text' =>  $this->language->get('text_recommended'),
            'href' => $this->url->link('mycommunity/mycommunity/readingclub')
        );

          $this->load->language('mycommunity/mycommunity');

        $data['button_sharedbooks'] = $this->language->get('button_sharedbooks');
        $data['button_reading_club'] = $this->language->get('button_reading_club');
        $data['button_authors'] = $this->language->get('button_authors');
        $data['button_publishers'] = $this->language->get('button_publishers');
        $data['text_recommended'] = $this->language->get('text_recommended');
        $data['text_members'] = $this->language->get('text_members');
        $data['text_yours'] = $this->language->get('text_yours');
        $data['text_name_this_club'] = $this->language->get('text_name_this_club');
        $data['text_description'] = $this->language->get('text_description');
        $data['text_sharesomething'] = $this->language->get('text_sharesomething');  
        $data['text_community'] = $this->language->get('text_community');  
        $data['button_create_club'] = $this->language->get('button_create_club');
        $data['button_cancel'] = $this->language->get('button_cancel');
        $data['button_done'] = $this->language->get('button_done');
        $data['button_join'] = $this->language->get('button_join');
        $data['button_member'] = $this->language->get('button_member');

        $data['footer'] = $this->load->controller('common/footer');
        $data['header'] = $this->load->controller('common/header');
        $data['heading_title'] = $this->language->get('heading_title');

        $data['sharedbooks'] = $this->url->link('mycommunity/mycommunity', '', true);
        $data['readingclub'] = $this->url->link('mycommunity/mycommunity/readingclub', '', true);
        $data['authors'] = $this->url->link('mycommunity/mycommunity/author', '', true);
        $data['publishers'] = $this->url->link('mycommunity/mycommunity/publisher', '', true);

        
       // for recommended tab

        $recommended = $this->model_mycommunity_mycommunity->getRecommended();

        foreach($recommended as $result)
       {
          $recommended_groups[] = $this->model_mycommunity_mycommunity->memberstatus($result['group_id']);
       }

         
        
        foreach($recommended_groups as $recom)
        {
           
             if (is_file(DIR_IMAGE.$recom['group_image'])) {
				$image = $this->model_tool_image->resize($recom['group_image'], 189, 95);
			} else {
				$image = $this->model_tool_image->resize('no_image.png', 189, 95);
			}


            $data['groups'][] = array (

                    'group_id'    =>$recom['group_id'],
                    'group_name'  =>$recom['group_name'],
                    'group_image' =>$image,
                    'status'      =>$recom['status']
                    
                 
                    );
             
        }  

// for members tab

         $member_in_groups = $this->model_mycommunity_mycommunity->groupmember();

         $data['members'] = array();

         foreach($member_in_groups as $memberresult)
		 {
            
            if (is_file(DIR_IMAGE.$memberresult['group_image'])) {
				$image = $this->model_tool_image->resize($memberresult['group_image'], 189, 95);
			} else {
				$image = $this->model_tool_image->resize('no_image.png', 189, 95);
			}
              
			 $data['members'][] = array (

				 'group_id'    =>$memberresult['group_id'],
			     'group_name'  =>$memberresult['group_name'],
			     'group_image' =>$image,
                 'status'      =>$memberresult['status']

					);
			 
		 } 

  // yours tab      

         $customer_id = (int)$this->customer->getId();
		 $data['clubs'] = array();
		 $clubresults = $this->model_mycommunity_mycommunity->getclubs();
		 foreach($clubresults as $clubresult)
		 {
             
            if (is_file(DIR_IMAGE.$clubresult['group_image'])) {
				$image = $this->model_tool_image->resize($clubresult['group_image'], 189, 95);
			} else {
				$image = $this->model_tool_image->resize('no_image.png', 189, 95);
			}

			 $data['clubs'][] = array (

                 'group_id'          =>$clubresult['group_id'],
				 'group_name'        =>$clubresult['group_name'],
				 'group_image'       =>$image,
			     'group_description' =>$clubresult['group_description'],
                  'status'            =>$clubresult['status']
					);
			 
		 }   

         // recommended tpl

        $rec = $this->model_mycommunity_mycommunity->getMember($group_id);

        if (is_file(DIR_IMAGE.$rec['group_image'])) {
				$image = $this->model_tool_image->resize($rec['group_image'], 189, 95);
			} else {
				$image = $this->model_tool_image->resize('no_image.png', 189, 95);
			}

        $data['group_info'] = array(
            
                    'group_id'              => $rec['group_id'],
                    'group_name'            => $rec['group_name'],
	                'group_image'           => $image,
                    'status'                =>$rec['status']
                    
                    
        );
        
        $this->load->model('mycommunity/mycommunity');
        $customer_id = (int)$this->customer->getId();
        $firstname = $this->customer->getFirstName();
        $lastname = $this->customer->getLastName();

   /*     $post = $this->model_mycommunity_mycommunity->getpost($customer_id);
        $data['post_info'] = $post; */

         $customer_id = (int)$this->customer->getId();
		 $data['post_info'] = array();
		 $postresults = $this->model_mycommunity_mycommunity->getposts($group_id);
		 foreach($postresults as $postresult)
		 {
 
             if (is_file(DIR_IMAGE.$postresult['image'])) {
				$image = $this->model_tool_image->resize($postresult['image'], 417, 417);
			} else {
				$image = $this->model_tool_image->resize('no_image.png', 417, 417);
			}

			 $data['post_info'][] = array (

                  'group_id'              =>$postresult['group_id'], 
                  'post_id'               =>$postresult['post_id'],
				  'customer_image'        =>$postresult['customer_image'],
				  'message'               =>$postresult['message'],
			      'image'                 =>$image,
                  'link'                  =>$postresult['link'],
                  'likes'                 =>$postresult['likes'],
                  'total_votes'           =>$postresult['total_votes'],
                  'status'                =>$postresult['status']
					);
			 
		 } 


        $data['first_name'] = $firstname;
        $data['last_name']  = $lastname;

        $data['club_image'] = $this->url->link('mycommunity/mycommunity/club_info&group_id=', '', true);

        $grouplink = "mycommunity/mycommunity/sharepost&group_id=";
        $data['share_post'] = $this->url->link($grouplink, '', true); 
     
        $data['join_community']   = $this->url->link('mycommunity/mycommunity/join_communtiy&group_id=', '', true);

        $this->response->setOutput($this->load->view('mycommunity/recommended', $data));

}


         public function createclub()
         {
           
         $clubname = $this->request->post['club_name'];

         $this->load->model('mycommunity/mycommunity');

	     $this->model_mycommunity_mycommunity->addtomyclub($clubname);

         $customer_id = (int)$this->customer->getId();
		 $data['clubs'] = array();
		 $clubresults = $this->model_mycommunity_mycommunity->getclubs($customer_id);
		 foreach($clubresults as $clubresult)
		 {
 
        /*     if (is_file(DIR_IMAGE.$clubresult['group_image'])) {
				$image = $this->model_tool_image->resize($clubresult['group_image'], 189, 95);
			} else {
				$image = $this->model_tool_image->resize('no_image.png', 189, 95);
			} */


			 $data['clubs'][] = array (
                 

                  'group_id'          =>$clubresult['group_id'],
				  'group_name'        =>$clubresult['group_name'],
				  'group_image'       =>$clubresult['group_image'],
			      'group_description' =>$clubresult['group_description'],
                   'status'            =>$clubresult['status']
					);
			 
		 } 
         
        $this->load->language('mycommunity/mycommunity');

      
        $data['button_sharedbooks'] = $this->language->get('button_sharedbooks');
        $data['button_reading_club'] = $this->language->get('button_reading_club');
        $data['button_authors'] = $this->language->get('button_authors');
        $data['button_publishers'] = $this->language->get('button_publishers');
        $data['text_recommended'] = $this->language->get('text_recommended');
        $data['text_members'] = $this->language->get('text_members');
        $data['text_yours'] = $this->language->get('text_yours');
        $data['text_mycommunity'] = $this->language->get('text_mycommunity');
        $data['text_reading_club'] = $this->language->get('text_reading_club');
        $data['text_name_this_club'] = $this->language->get('text_name_this_club');
        $data['text_description'] = $this->language->get('text_description');
        $data['text_sharesomething'] = $this->language->get('text_sharesomething');    
        $data['button_create_club'] = $this->language->get('button_create_club');
        $data['button_cancel'] = $this->language->get('button_cancel');
        $data['button_done'] = $this->language->get('button_done');
        $data['button_join'] = $this->language->get('button_join');  
        $data['button_member'] = $this->language->get('button_member');  

       $this->document->setTitle($this->language->get('heading_title'));

        $url='';

        $data['breadcrumbs'] = array();

        $data['breadcrumbs'][] = array(
            'text' => $this->language->get('text_home'),
            'href' => $this->url->link('common/home')
        );

        

        $data['breadcrumbs'][] = array(
            'text' => $this->language->get('text_mycommunity'),
            'href' => $this->url->link('mycommunity/mycommunity')
        );

        $data['breadcrumbs'][] = array(
            'text' =>  $this->language->get('text_reading_club'),
            'href' => $this->url->link('mycommunity/mycommunity/readingclub')
        );

        $data['footer'] = $this->load->controller('common/footer');
        $data['header'] = $this->load->controller('common/header');
        $data['heading_title'] = $this->language->get('heading_title');

        $data['sharedbooks'] = $this->url->link('mycommunity/mycommunity', '', true);
        $data['readingclub'] = $this->url->link('mycommunity/mycommunity/readingclub', '', true);
        $data['authors'] = $this->url->link('mycommunity/mycommunity/author', '', true);
        $data['publishers'] = $this->url->link('mycommunity/mycommunity/publisher', '', true);
        
        $this->load->model('mycommunity/mycommunity');

       // for recommended tab

        $recommended = $this->model_mycommunity_mycommunity->getRecommended();

        foreach($recommended as $result)
       {
          $recommended_groups[] = $this->model_mycommunity_mycommunity->memberstatus($result['group_id']);
       }

         
        
        foreach($recommended_groups as $recom)
        {
           
             if (is_file(DIR_IMAGE.$recom['group_image'])) {
				$image = $this->model_tool_image->resize($recom['group_image'], 189, 95);
			} else {
				$image = $this->model_tool_image->resize('no_image.png', 189, 95);
			}


            $data['groups'][] = array (

                    'group_id'    =>$recom['group_id'],
                    'group_name'  =>$recom['group_name'],
                    'group_image' =>$image,
                    'status'      =>$recom['status']
                    
                 
                    );
             
        }  

// for members tab

         $member_in_groups = $this->model_mycommunity_mycommunity->groupmember();

         $data['members'] = array();

         foreach($member_in_groups as $memberresult)
		 {
            
            if (is_file(DIR_IMAGE.$memberresult['group_image'])) {
				$image = $this->model_tool_image->resize($memberresult['group_image'], 189, 95);
			} else {
				$image = $this->model_tool_image->resize('no_image.png', 189, 95);
			}
              
			 $data['members'][] = array (

				 'group_id'    =>$memberresult['group_id'],
			     'group_name'  =>$memberresult['group_name'],
			     'group_image' =>$image,
                 'status'      =>$memberresult['status']

					);
			 
		 } 

  // yours tab      

         $customer_id = (int)$this->customer->getId();
		 $data['clubs'] = array();
		 $clubresults = $this->model_mycommunity_mycommunity->getclubs();
		 foreach($clubresults as $clubresult)
		 {
             
            if (is_file(DIR_IMAGE.$clubresult['group_image'])) {
				$image = $this->model_tool_image->resize($clubresult['group_image'], 189, 95);
			} else {
				$image = $this->model_tool_image->resize('no_image.png', 189, 95);
			}

			 $data['clubs'][] = array (

                 'group_id'          =>$clubresult['group_id'],
				 'group_name'        =>$clubresult['group_name'],
				 'group_image'       =>$image,
			     'group_description' =>$clubresult['group_description'],
                  'status'            =>$clubresult['status']
					);
			 
		 }   
         $data['create_newclub'] = $this->url->link('mycommunity/mycommunity/create_newclub', '', true);

         $data['club_image'] = $this->url->link('mycommunity/mycommunity/club_info&group_id=', '', true);
     

         $data['active_tab'] = 'tab_default_3';

         $this->response->setOutput($this->load->view('mycommunity/readingclub', $data));

        }


        public function recommended(){


        $group_id = $this->request->get['group_id'];    
        $this->load->language('mycommunity/mycommunity');

        $this->document->setTitle($this->language->get('heading_title'));

        $this->load->model('mycommunity/mycommunity');

        $url='';

        $data['breadcrumbs'] = array();

        $data['breadcrumbs'][] = array(
            'text' => $this->language->get('text_home'),
            'href' => $this->url->link('common/home')
        );

        $data['breadcrumbs'][] = array(
            'text' => $this->language->get('text_mycommunity'),
            'href' => $this->url->link('mycommunity/mycommunity')
        );

         $data['breadcrumbs'][] = array(
            'text' => $this->language->get('text_reading_club'),
            'href' => $this->url->link('mycommunity/mycommunity/readingclub')
        );

        $data['breadcrumbs'][] = array(
            'text' =>  $this->language->get('text_recommended'),
            'href' => $this->url->link('mycommunity/mycommunity/readingclub')
        );

        $this->load->language('mycommunity/mycommunity');

        $data['button_sharedbooks'] = $this->language->get('button_sharedbooks');
        $data['button_reading_club'] = $this->language->get('button_reading_club');
        $data['button_authors'] = $this->language->get('button_authors');
        $data['button_publishers'] = $this->language->get('button_publishers');
        $data['text_recommended'] = $this->language->get('text_recommended');
        $data['text_members'] = $this->language->get('text_members');
        $data['text_yours'] = $this->language->get('text_yours');
        $data['text_name_this_club'] = $this->language->get('text_name_this_club');
        $data['text_description'] = $this->language->get('text_description');
        $data['text_sharesomething'] = $this->language->get('text_sharesomething');  
        $data['text_community'] = $this->language->get('text_community');  
        $data['button_create_club'] = $this->language->get('button_create_club');
        $data['button_cancel'] = $this->language->get('button_cancel');
        $data['button_done'] = $this->language->get('button_done');
        $data['button_join'] = $this->language->get('button_join');
        $data['button_member'] = $this->language->get('button_member');

        $data['footer'] = $this->load->controller('common/footer');
        $data['header'] = $this->load->controller('common/header');
        $data['heading_title'] = $this->language->get('heading_title');

        $data['sharedbooks'] = $this->url->link('mycommunity/mycommunity', '', true);
        $data['readingclub'] = $this->url->link('mycommunity/mycommunity/readingclub', '', true);
        $data['authors'] = $this->url->link('mycommunity/mycommunity/author', '', true);
        $data['publishers'] = $this->url->link('mycommunity/mycommunity/publisher', '', true);

        $this->load->model('mycommunity/mycommunity');
       // for recommended tab

      /*  $recommended = $this->model_mycommunity_mycommunity->getRecommended();

        foreach($recommended as $result)
       {
          $recommended_groups[] = $this->model_mycommunity_mycommunity->memberstatus($result['group_id']);
       }

         
        
        foreach($recommended_groups as $recom)
        {
           
             if (is_file(DIR_IMAGE.$recom['group_image'])) {
				$image = $this->model_tool_image->resize($recom['group_image'], 189, 95);
			} else {
				$image = $this->model_tool_image->resize('no_image.png', 189, 95);
			}


            $data['groups'][] = array (

                    'group_id'    =>$recom['group_id'],
                    'group_name'  =>$recom['group_name'],
                    'group_image' =>$image,
                    'status'      =>$recom['status']
                    
                 
                    );
             
        }  

// for members tab

         $member_in_groups = $this->model_mycommunity_mycommunity->groupmember();

         $data['members'] = array();

         foreach($member_in_groups as $memberresult)
		 {
            
            if (is_file(DIR_IMAGE.$memberresult['group_image'])) {
				$image = $this->model_tool_image->resize($memberresult['group_image'], 189, 95);
			} else {
				$image = $this->model_tool_image->resize('no_image.png', 189, 95);
			}
              
		  $data['members'][] = array (

				 'group_id'    =>$memberresult['group_id'],
			     'group_name'  =>$memberresult['group_name'],
			     'group_image' =>$image,
                 'status'      =>$memberresult['status']

					);
			 
		 } 

  // yours tab      

         $customer_id = (int)$this->customer->getId();
		 $data['clubs'] = array();
		 $clubresults = $this->model_mycommunity_mycommunity->getclubs();
		 foreach($clubresults as $clubresult)
		 {
             
            if (is_file(DIR_IMAGE.$clubresult['group_image'])) {
				$image = $this->model_tool_image->resize($clubresult['group_image'], 189, 95);
			} else {
				$image = $this->model_tool_image->resize('no_image.png', 189, 95);
			}

			 $data['clubs'][] = array (

                 'group_id'          =>$clubresult['group_id'],
				 'group_name'        =>$clubresult['group_name'],
				 'group_image'       =>$image,
			     'group_description' =>$clubresult['group_description'],
                  'status'            =>$clubresult['status']
					);
			 
		 }   */

// recommended tpl

        $rec = $this->model_mycommunity_mycommunity->getMember($group_id);

        if (is_file(DIR_IMAGE.$rec['group_image'])) {
				$image = $this->model_tool_image->resize($rec['group_image'], 189, 95);
			} else {
				$image = $this->model_tool_image->resize('no_image.png', 189, 95);
			}

         if (is_file(DIR_IMAGE.$rec['customer_image'])) {
				$customer_image = $this->model_tool_image->resize($rec['customer_image'], 50, 50);
			} else {
				$customer_image = '';
			}

        $data['group_info'] = array(
            
                    'group_id'              => $rec['group_id'],
                    'group_name'            => $rec['group_name'],
	                'group_image'           => $image,
                    'customer_image'        => $customer_image,
                    'status'                =>$rec['status']
                    
                    
        );
           
        $this->load->model('mycommunity/mycommunity');
        $customer_id = (int)$this->customer->getId();
        $firstname = $this->customer->getFirstName();
        $lastname = $this->customer->getLastName();

   /*     $post = $this->model_mycommunity_mycommunity->getpost($customer_id);
        $data['post_info'] = $post; */

         $customer_id = (int)$this->customer->getId();
		 $data['post_info'] = array();
		 $postresults = $this->model_mycommunity_mycommunity->getposts($group_id);
		 foreach($postresults as $postresult)
		 {

              if (is_file(DIR_IMAGE.$postresult['image'])) {
				$image = $this->model_tool_image->resize($postresult['image'], 417, 417);
			} else {
				$image = '';
			}

            if (is_file(DIR_IMAGE.$postresult['customer_image'])) {
				$customer_image = $this->model_tool_image->resize($postresult['customer_image'], 50, 50);
			} else {
				$customer_image = '';
			}

             $like_counts = $this->model_mycommunity_mycommunity->totallikes($postresult['post_id']);

            if(!empty($like_counts)){

                $totalLikes  = $like_counts;           
            }else{

                $totalLikes = '';
            }

		    $data['post_info'][] = array (

                  'group_id'              =>$postresult['group_id'], 
                  'post_id'               =>$postresult['post_id'],
                  'customer_id'           =>$postresult['customer_id'], 
				  'customer_image'        =>$customer_image,
				  'message'               =>$postresult['message'],
			      'image'                 =>$image,
			      'totalLikes'            =>$totalLikes,
                  'link'                  =>$postresult['link'],
                  'status'                =>$postresult['status']
					);
			 
		 } 

        $data['first_name'] = $firstname;
        $data['last_name']  = $lastname;

        $grouplink = "mycommunity/mycommunity/addtopost&group_id=";
        $data['share_post'] = $this->url->link($grouplink, '', true); 
    
        $data['add_to_member']   = $this->url->link('mycommunity/mycommunity/join', '', true);

        $data['join_community']   = $this->url->link('mycommunity/mycommunity/join_communtiy&group_id=', '', true);

        $data['recommended_image'] = $this->url->link('mycommunity/mycommunity/recommended&group_id=', '', true);

         $data['club_image'] = $this->url->link('mycommunity/mycommunity/club_info&group_id=', '', true);
     

        $data['upload_image'] = $this->url->link('mycommunity/mycommunity/uploadImage','',true);

        $data['deletepost'] = $this->url->link('mycommunity/mycommunity/deletepost&post_id=','',true);
        
        $this->response->setOutput($this->load->view('mycommunity/recommended', $data));
        
        }


        public function addLikeCount() {
             
         $post_id = $this->request->post['post_id'];    

         $this->load->model('mycommunity/mycommunity');
         
         $this->load->language('mycommunity/mycommunity');
          
         $LikeCount = $this->model_mycommunity_mycommunity->addtolikedpost($post_id);

         $return_arr = array("likes"=>$LikeCount);

          echo json_encode($return_arr);
     
        }

        public function deletepost(){

        $post_id = $this->request->get['post_id']; 

        $group_id = $this->request->get['group_id']; 

        $this->load->model('mycommunity/mycommunity');
         
        $this->load->language('mycommunity/mycommunity');

        $this->model_mycommunity_mycommunity->deletepost($post_id);

        $this->response->redirect($this->url->link('mycommunity/mycommunity/recommended&group_id='.$group_id,'', true));

        }

       
    
       public function addtopost(){


       $this->load->model('mycommunity/mycommunity');
       
       $group_id = $this->request->get['group_id'];    
       $textname = $this->request->post['text_name'];

        $target_dir = "/home/aramesh/olaichuvadi.cviac.com/image/catalog/";
		$target_file_front = $target_dir . basename($_FILES["image"]["name"]);
		$uploadOk = 1;
	
		$imageFileType = pathinfo($target_file_front,PATHINFO_EXTENSION);
		// Check if image file is a actual image or fake image
		if(isset($_POST["submit"]) && $_FILES["image"]["name"] ) {
  		  $check = getimagesize($_FILES["image"]["tmp_name"]);
  		  if($check !== false) {
  	      //echo "File is an image - " . $check["mime"] . ".";
  	      $uploadOk = 1;
  		  } else {
  	 	    $data['upload_success'] = "File is not an image.";
   	  	   $uploadOk = 0;
   		  }
		}

	
			// Check file size
		/*	if ($_FILES["image"]["size"] > 500000) {
   			 $data['upload_success'] = "Sorry, your file is too large.";
   			 $uploadOk = 0;
			} */

			// Allow certain file formats
		/*	if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
			  && $imageFileType != "gif" ) {
  			  $data['upload_success'] = "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
  			  $uploadOk = 0;
			}*/

			// Check if $uploadOk is set to 0 by an error
			if ($uploadOk == 0) {
 	 		  $data['upload_success'] = "Sorry, your file was not uploaded.";
			// if everything is ok, try to upload file
			} else {
 	   		if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file_front)) 
                {
 	     	 // echo "The file ". basename( $_FILES["front_image"]["name"]). " has been uploaded.";
			$data['upload_success'] = "Your Book Images has been uploaded" ;

			 
 	  	 	} else {
        		$data['upload_success'] = "Sorry, there was an error uploading your file.";
  	 	 	}
		}


        $this->model_mycommunity_mycommunity->addtomypost($group_id);

        $this->response->redirect($this->url->link('mycommunity/mycommunity/recommended&group_id='.$group_id,'', true));

        //$this->recommended();          

       }

       public function club_info(){ 

       
         $group_id = $this->request->get['group_id'];    
         $this->load->language('mycommunity/mycommunity');

        $this->document->setTitle($this->language->get('heading_title'));

        $this->load->model('mycommunity/mycommunity');

        $url='';

        $data['breadcrumbs'] = array();

        $data['breadcrumbs'][] = array(
            'text' => $this->language->get('text_home'),
            'href' => $this->url->link('common/home')
        );

        $data['breadcrumbs'][] = array(
            'text' => $this->language->get('text_mycommunity'),
            'href' => $this->url->link('mycommunity/mycommunity')
        );

        $data['breadcrumbs'][] = array(
            'text' =>  $this->language->get('text_club'),
            'href' => $this->url->link('mycommunity/mycommunity/cancel')
        );

        $this->load->language('mycommunity/mycommunity');

        $data['button_sharedbooks'] = $this->language->get('button_sharedbooks');
        $data['button_reading_club'] = $this->language->get('button_reading_club');
        $data['button_authors'] = $this->language->get('button_authors');
        $data['button_publishers'] = $this->language->get('button_publishers');
        $data['text_recommended'] = $this->language->get('text_recommended');
        $data['text_members'] = $this->language->get('text_members');
        $data['text_yours'] = $this->language->get('text_yours');
        $data['text_name_this_club'] = $this->language->get('text_name_this_club');
        $data['text_club'] = $this->language->get('text_club');
        $data['text_description'] = $this->language->get('text_description');
        $data['text_sharesomething'] = $this->language->get('text_sharesomething');  
        $data['button_create_club'] = $this->language->get('button_create_club');
        $data['button_cancel'] = $this->language->get('button_cancel');
        $data['button_done'] = $this->language->get('button_done');
        $data['button_send'] = $this->language->get('button_send');
        $data['button_join'] = $this->language->get('button_join');
        $data['button_post'] = $this->language->get('button_post');
       	$data['type_text_search'] = $this->language->get('type_text_search');
        $data['text_invite_people'] = $this->language->get('text_invite_people');
        $data['text_enter_name'] = $this->language->get('text_enter_name');
        $data['text_enter_mailid'] = $this->language->get('text_enter_mailid');

        $data['footer'] = $this->load->controller('common/footer');
        $data['header'] = $this->load->controller('common/header');
        $data['heading_title'] = $this->language->get('heading_title');

        $data['sharedbooks'] = $this->url->link('mycommunity/mycommunity', '', true);
        $data['readingclub'] = $this->url->link('mycommunity/mycommunity/readingclub', '', true);
        $data['authors'] = $this->url->link('mycommunity/mycommunity/author', '', true);
        $data['publishers'] = $this->url->link('mycommunity/mycommunity/publisher', '', true);

        $this->load->model('mycommunity/mycommunity');
        $clubinfo = $this->model_mycommunity_mycommunity->getMember($group_id);

         if (is_file(DIR_IMAGE.$clubinfo['group_image'])) {
				$image = $this->model_tool_image->resize($clubinfo['group_image'], 189, 95);
			} else {
				$image = $this->model_tool_image->resize('no_image.png', 189, 95);
			}

        $data['club_info'] = array(
             
            
                    'group_id'              => $clubinfo['group_id'],
                    'group_name'            => $clubinfo['group_name'],
			        'group_image'           => $image,
                    'created_by'            => $clubinfo['created_by']
                    
        );

        
        $this->load->model('mycommunity/mycommunity');
        $rec = $this->model_mycommunity_mycommunity->getMember($group_id);

         if (is_file(DIR_IMAGE.$rec['group_image'])) {
				$image = $this->model_tool_image->resize($rec['group_image'], 189, 95);
			} else {
				$image = $this->model_tool_image->resize('no_image.png', 189, 95);
			}

            
         if (is_file(DIR_IMAGE.$rec['customer_image'])) {
				$customer_image = $this->model_tool_image->resize($rec['customer_image'], 50, 50);
			} else {
				$customer_image = '';
			}

        $data['group_info'] = array(
             
            
                    'group_id'              => $rec['group_id'],
                    'group_name'            => $rec['group_name'],
			        'group_image'           => $image,
                    'customer_image'        => $customer_image,
                    
        );
        
        $this->load->model('mycommunity/mycommunity');
        $customer_id = (int)$this->customer->getId();
        $firstname = $this->customer->getFirstName();
        $lastname = $this->customer->getLastName();

        $this->load->model('mycommunity/mycommunity');
        $customer_id = (int)$this->customer->getId();
        $firstname = $this->customer->getFirstName();
        $lastname = $this->customer->getLastName();
        $email = $this->customer->getEmail();

        $data['customer_id'] = $customer_id;
        $data['first_name'] = $firstname;
        $data['last_name']  = $lastname;
        $data['email']      = $email;

         $customer_id = (int)$this->customer->getId();
		 $data['post_info'] = array();
		 $postresults = $this->model_mycommunity_mycommunity->getClubposts($group_id);
		 foreach($postresults as $postresult)
		 {	

              if (is_file(DIR_IMAGE.$postresult['image'])) {
				$image = $this->model_tool_image->resize($postresult['image'], 417, 417);
			} else {
				$image = '';
			}

			
			 $data['post_info'][] = array (

                  'post_id'              =>$postresult['post_id'],
                  'customer_image'      =>$postresult['customer_image'],
				  'message'             =>$postresult['message'],
			      'image'               =>$image,
                  'link'                =>$postresult['link']
					);
			 
		 } 

         
         $data['invite_people'] = $this->url->link('mycommunity/mycommunity/invite_people&group_id=', '', true);   

         $grouplink = "mycommunity/mycommunity/club_share&group_id=";
         $data['club_share'] = $this->url->link($grouplink, '', true); 

         $data['editimage'] = $this->url->link('mycommunity/mycommunity/changeclub_image&group_id=' , '' , true);

         $data['deleteclub'] = $this->url->link('mycommunity/mycommunity/deleteclub&group_id=' , '' , true);
     
         $data['search_mail'] = $this->url->link('mycommunity/mycommunity/mailsearch&group_id=' , '' , true);

         $data['club_image'] = $this->url->link('mycommunity/mycommunity/club_info&group_id=', '', true);

         $data['upload_image'] = $this->url->link('mycommunity/mycommunity/uploadImage','',true);
         
         $this->response->setOutput($this->load->view('mycommunity/club_info', $data));

       }

       public function changeclub_image(){

        $group_id = $this->request->get['group_id'];    
 
       //uploadImage
		
 		$target_dir = "/home/aramesh/olaichuvadi.cviac.com/image/catalog/";
		$target_file_front = $target_dir . basename($_FILES["image"]["name"]);
		$uploadOk = 1;
	
		$imageFileType = pathinfo($target_file_front,PATHINFO_EXTENSION);
		// Check if image file is a actual image or fake image
		if(isset($_POST["submit"]) && $_FILES["image"]["name"] ) {
  		  $check = getimagesize($_FILES["image"]["tmp_name"]);
  		  if($check !== false) {
  	      //echo "File is an image - " . $check["mime"] . ".";
  	      $uploadOk = 1;
  		  } else {
  	 	    $data['upload_success'] = "File is not an image.";
   	  	   $uploadOk = 0;
   		  }
		}

	
			// Check file size
		/*	if ($_FILES["image"]["size"] > 500000) {
   			 $data['upload_success'] = "Sorry, your file is too large.";
   			 $uploadOk = 0;
			} */

			// Allow certain file formats
		/*	if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
			  && $imageFileType != "gif" ) {
  			  $data['upload_success'] = "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
  			  $uploadOk = 0;
			}*/

			// Check if $uploadOk is set to 0 by an error
			if ($uploadOk == 0) {
 	 		  $data['upload_success'] = "Sorry, your file was not uploaded.";
			// if everything is ok, try to upload file
			} else {
 	   		if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file_front)) 
                {
 	     	 // echo "The file ". basename( $_FILES["front_image"]["name"]). " has been uploaded.";
			$data['upload_success'] = "Your Book Images has been uploaded" ;

			 
 	  	 	} else {
        		$data['upload_success'] = "Sorry, there was an error uploading your file.";
  	 	 	}
		}

 
        $this->load->model('mycommunity/mycommunity');
        $this->model_mycommunity_mycommunity->updateclubimage($group_id);

         $this->load->language('mycommunity/mycommunity');

       $this->document->setTitle($this->language->get('heading_title'));

       $this->load->model('mycommunity/mycommunity');

       $url='';

        $data['breadcrumbs'] = array();

        $data['breadcrumbs'][] = array(
            'text' => $this->language->get('text_home'),
            'href' => $this->url->link('common/home')
        );

        $data['breadcrumbs'][] = array(
            'text' => $this->language->get('text_mycommunity'),
            'href' => $this->url->link('mycommunity/mycommunity')
        );

        $data['breadcrumbs'][] = array(
            'text' =>  $this->language->get('text_club'),
            'href' => $this->url->link('mycommunity/mycommunity/cancel')
        );

        $this->load->language('mycommunity/mycommunity');

        $data['button_sharedbooks'] = $this->language->get('button_sharedbooks');
        $data['button_reading_club'] = $this->language->get('button_reading_club');
        $data['button_authors'] = $this->language->get('button_authors');
        $data['button_publishers'] = $this->language->get('button_publishers');
        $data['text_recommended'] = $this->language->get('text_recommended');
        $data['text_members'] = $this->language->get('text_members');
        $data['text_yours'] = $this->language->get('text_yours');
        $data['text_name_this_club'] = $this->language->get('text_name_this_club');
        $data['text_club'] = $this->language->get('text_club');
        $data['text_description'] = $this->language->get('text_description');
        $data['text_sharesomething'] = $this->language->get('text_sharesomething');  
        $data['button_create_club'] = $this->language->get('button_create_club');
        $data['button_cancel'] = $this->language->get('button_cancel');
        $data['button_done'] = $this->language->get('button_done');
        $data['button_send'] = $this->language->get('button_send');
        $data['button_join'] = $this->language->get('button_join');
        $data['button_post'] = $this->language->get('button_post');
       	$data['type_text_search'] = $this->language->get('type_text_search');
        $data['text_invite_people'] = $this->language->get('text_invite_people');
        $data['text_enter_name'] = $this->language->get('text_enter_name');
        $data['text_enter_mailid'] = $this->language->get('text_enter_mailid');

        $data['footer'] = $this->load->controller('common/footer');
        $data['header'] = $this->load->controller('common/header');
        $data['heading_title'] = $this->language->get('heading_title');

        $data['sharedbooks'] = $this->url->link('mycommunity/mycommunity', '', true);
        $data['readingclub'] = $this->url->link('mycommunity/mycommunity/readingclub', '', true);
        $data['authors'] = $this->url->link('mycommunity/mycommunity/author', '', true);
        $data['publishers'] = $this->url->link('mycommunity/mycommunity/publisher', '', true);

        $this->load->model('mycommunity/mycommunity');
        $clubinfo = $this->model_mycommunity_mycommunity->getMember($group_id);

         if (is_file(DIR_IMAGE.$clubinfo['group_image'])) {
				$image = $this->model_tool_image->resize($clubinfo['group_image'], 189, 95);
			} else {
				$image = $this->model_tool_image->resize('no_image.png', 189, 95);
			}

        $data['club_info'] = array(
             
            
                    'group_id'              => $clubinfo['group_id'],
                    'group_name'            => $clubinfo['group_name'],
			        'group_image'           => $image,
                    'created_by'            => $clubinfo['created_by']
                    
        );

        
        $this->load->model('mycommunity/mycommunity');
        $rec = $this->model_mycommunity_mycommunity->getMember($group_id);

         if (is_file(DIR_IMAGE.$rec['group_image'])) {
				$image = $this->model_tool_image->resize($rec['group_image'], 189, 95);
			} else {
				$image = $this->model_tool_image->resize('no_image.png', 189, 95);
			}

        $data['group_info'] = array(
             
            
                    'group_id'              => $rec['group_id'],
                    'group_name'            => $rec['group_name'],
			        'group_image'           => $image
                    
        );
        
        $this->load->model('mycommunity/mycommunity');
        $customer_id = (int)$this->customer->getId();
        $firstname = $this->customer->getFirstName();
        $lastname = $this->customer->getLastName();

        $this->load->model('mycommunity/mycommunity');
        $customer_id = (int)$this->customer->getId();
        $firstname = $this->customer->getFirstName();
        $lastname = $this->customer->getLastName();
        $email = $this->customer->getEmail();

        $data['first_name'] = $firstname;
        $data['last_name']  = $lastname;
        $data['email']      = $email;

         $customer_id = (int)$this->customer->getId();
		 $data['post_info'] = array();
		 $postresults = $this->model_mycommunity_mycommunity->getClubposts($group_id);
		 foreach($postresults as $postresult)
		 {	

              if (is_file(DIR_IMAGE.$postresult['image'])) {
				$image = $this->model_tool_image->resize($postresult['image'], 417, 417);
			} else {
				$image = '';
			}

			
			 $data['post_info'][] = array (

                  'post_id'              =>$postresult['post_id'],
                  'customer_image'      =>$postresult['customer_image'],
				  'message'             =>$postresult['message'],
			      'image'               =>$image,
                  'link'                =>$postresult['link']
					);
			 
		 } 

         
         $data['invite_people'] = $this->url->link('mycommunity/mycommunity/invite_people&group_id=', '', true);   

         $grouplink = "mycommunity/mycommunity/club_share&group_id=";
         $data['club_share'] = $this->url->link($grouplink, '', true); 

         $data['editimage'] = $this->url->link('mycommunity/mycommunity/changeclub_image&group_id=' , '' , true);

         //$data['deleteclub'] = $this->deleteclub($this->request->get['group_id'],$clubinfo['created_by']);

         //$data['deleteclub'] = $this->deleteclub($this->request->get['group_id'],$clubinfo['created_by']);

         $data['deleteclub'] = $this->url->link('mycommunity/mycommunity/deleteclub&group_id=' , '' , true);
     
         $data['search_mail'] = $this->url->link('mycommunity/mycommunity/mailsearch&group_id=' , '' , true);

         $data['club_image'] = $this->url->link('mycommunity/mycommunity/club_info&group_id=', '', true);

         $data['upload_image'] = $this->url->link('mycommunity/mycommunity/uploadImage','',true);
     
        
        $this->response->setOutput($this->load->view('mycommunity/club_info', $data));



       }

        public function deleteclub(){

        $group_id = $this->request->get['group_id'];
        $created_by = $this->request->get['created_by']; 


        $this->load->model('mycommunity/mycommunity');
        $this->model_mycommunity_mycommunity->deleteclub($group_id);

        $this->load->language('mycommunity/mycommunity');

        $data['button_sharedbooks'] = $this->language->get('button_sharedbooks');
        $data['button_reading_club'] = $this->language->get('button_reading_club');
        $data['button_authors'] = $this->language->get('button_authors');
        $data['button_publishers'] = $this->language->get('button_publishers');
        $data['text_recommended'] = $this->language->get('text_recommended');
        $data['text_members'] = $this->language->get('text_members');
        $data['text_yours'] = $this->language->get('text_yours');
        $data['text_name_this_club'] = $this->language->get('text_name_this_club');
        $data['text_description'] = $this->language->get('text_description');
        $data['text_sharesomething'] = $this->language->get('text_sharesomething');  
        $data['text_mycommunity'] = $this->language->get('text_mycommunity');   
        $data['text_reading_club'] = $this->language->get('text_reading_club');   
        $data['button_create_club'] = $this->language->get('button_create_club');
        $data['button_cancel'] = $this->language->get('button_cancel');
        $data['button_done'] = $this->language->get('button_done');
        $data['button_join'] = $this->language->get('button_join');
        $data['button_member'] = $this->language->get('button_member');

      $this->document->setTitle($this->language->get('heading_title'));

      $this->load->model('mycommunity/mycommunity');

    //  $data['addmember']=$this->url->link('mycommunity/mycommunity/join','',true);

        $url='';

        $data['breadcrumbs'] = array();

        $data['breadcrumbs'][] = array(
            'text' => $this->language->get('text_home'),
            'href' => $this->url->link('common/home')
        );

        

        $data['breadcrumbs'][] = array(
            'text' => $this->language->get('text_mycommunity'),
            'href' => $this->url->link('mycommunity/mycommunity')
        );

        $data['breadcrumbs'][] = array( 
            'text' =>  $this->language->get('text_reading_club'),
            'href' => $this->url->link('mycommunity/mycommunity/readingclub')
        );

         
        $data['footer'] = $this->load->controller('common/footer');
        $data['header'] = $this->load->controller('common/header');
        $data['heading_title'] = $this->language->get('heading_title');
        
        $data['sharedbooks'] = $this->url->link('mycommunity/mycommunity', '', true);
        $data['readingclub'] = $this->url->link('mycommunity/mycommunity/readingclub', '', true);
        $data['authors'] = $this->url->link('mycommunity/mycommunity/author', '', true);
        $data['publishers'] = $this->url->link('mycommunity/mycommunity/publisher', '', true);

        $this->load->model('mycommunity/mycommunity');

// for recommended tab

        $recommended = $this->model_mycommunity_mycommunity->getRecommended();

        foreach($recommended as $result)
       {
          $recommended_groups[] = $this->model_mycommunity_mycommunity->memberstatus($result['group_id']);
       }

         
        
        foreach($recommended_groups as $recom)
        {
           
             if (is_file(DIR_IMAGE.$recom['group_image'])) {
				$image = $this->model_tool_image->resize($recom['group_image'], 189, 95);
			} else {
				$image = $this->model_tool_image->resize('no_image.png', 189, 95);
			}


            $data['groups'][] = array (

                    'group_id'    =>$recom['group_id'],
                    'group_name'  =>$recom['group_name'],
                    'group_image' =>$image,
                    'status'      =>$recom['status']
                    
                 
                    );
             
        }  

// for members tab

         $member_in_groups = $this->model_mycommunity_mycommunity->groupmember();

         $data['members'] = array();

         foreach($member_in_groups as $memberresult)
		 {
            
            if (is_file(DIR_IMAGE.$memberresult['group_image'])) {
				$image = $this->model_tool_image->resize($memberresult['group_image'], 189, 95);
			} else {
				$image = $this->model_tool_image->resize('no_image.png', 189, 95);
			}
              
			 $data['members'][] = array (

				 'group_id'    =>$memberresult['group_id'],
			     'group_name'  =>$memberresult['group_name'],
			     'group_image' =>$image,
                 'status'      =>$memberresult['status']

					);
			 
		 } 

  // yours tab      

         $customer_id = (int)$this->customer->getId();
		 $data['clubs'] = array();
		 $clubresults = $this->model_mycommunity_mycommunity->getclubs();
		 foreach($clubresults as $clubresult)
		 {
             
            if (is_file(DIR_IMAGE.$clubresult['group_image'])) {
				$image = $this->model_tool_image->resize($clubresult['group_image'], 189, 95);
			} else {
				$image = $this->model_tool_image->resize('no_image.png', 189, 95);
			}

			 $data['clubs'][] = array (

                 'group_id'          =>$clubresult['group_id'],
				 'group_name'        =>$clubresult['group_name'],
				 'group_image'       =>$image,
			     'group_description' =>$clubresult['group_description'],
                  'status'            =>$clubresult['status']
					);
			 
		 }   

       $data['deleteclub'] = $this->url->link('mycommunity/mycommunity/deleteclub&group_id=' , '' , true);  

      $data['create_club'] = $this->url->link('mycommunity/mycommunity/createclub', '', true);
    //  $data['recommended_image'] = $this->url->link('mycommunity/mycommunity/recommended&group_id=', '', true);

      $data['member_image'] = $this->url->link('mycommunity/mycommunity/recommended&group_id=', '', true);

      $data['club_image'] = $this->url->link('mycommunity/mycommunity/club_info&group_id=', '', true);
     
      $data['addmember']   = $this->url->link('mycommunity/mycommunity/join', '', true);

      $data['sharedbooks'] = $this->url->link('mycommunity/mycommunity', '', true);
      $data['readingclub'] = $this->url->link('mycommunity/mycommunity/readingclub', '', true);
      $data['authors'] = $this->url->link('mycommunity/mycommunity/author', '', true);
      $data['publishers'] = $this->url->link('mycommunity/mycommunity/publisher', '', true);

      $data['create_newclub'] = $this->url->link('mycommunity/mycommunity/create_newclub', '', true);
 
      $data['recommended_image'] = $this->url->link('mycommunity/mycommunity/recommended&group_id=', '', true);
      $data['active_tab'] = 'tab_default_3';

      $this->response->setOutput($this->load->view('mycommunity/readingclub', $data));

       }

       public function acceptinvite(){

        
       if (!$this->customer->isLogged()) {
            $this->session->data['redirect'] = $this->config->get('config_url') . 'index.php?route=mycommunity/mycommunity/acceptinvite&group_id=' . $this->request->get['group_id'] . "\n\n";

            $this->response->redirect($this->url->link('account/login', '', true));
       }

        $group_id = $this->request->get['group_id'];     

        $this->load->model('mycommunity/mycommunity');

        $this->load->language('mycommunity/mycommunity');

        $data['button_sharedbooks'] = $this->language->get('button_sharedbooks');
        $data['button_reading_club'] = $this->language->get('button_reading_club');
        $data['button_authors'] = $this->language->get('button_authors');
        $data['button_publishers'] = $this->language->get('button_publishers');
        $data['text_recommended'] = $this->language->get('text_recommended');
        $data['text_members'] = $this->language->get('text_members');
        $data['text_accept_invite'] = $this->language->get('text_accept_invite');
        $data['text_yours'] = $this->language->get('text_yours');
        $data['text_name_this_club'] = $this->language->get('text_name_this_club');
        $data['text_description'] = $this->language->get('text_description');
        $data['text_sharesomething'] = $this->language->get('text_sharesomething');  
        $data['text_mycommunity'] = $this->language->get('text_mycommunity');   
        $data['text_reading_club'] = $this->language->get('text_reading_club');   
        $data['button_create_club'] = $this->language->get('button_create_club');
        $data['button_cancel'] = $this->language->get('button_cancel');
        $data['button_done'] = $this->language->get('button_done');
        $data['button_join'] = $this->language->get('button_join');
        $data['button_member'] = $this->language->get('button_member');

      $this->document->setTitle($this->language->get('heading_title'));

      $this->load->model('mycommunity/mycommunity');

    //  $data['addmember']=$this->url->link('mycommunity/mycommunity/join','',true);

        $url='';

        $data['breadcrumbs'] = array();

        $data['breadcrumbs'][] = array(
            'text' => $this->language->get('text_home'),
            'href' => $this->url->link('common/home')
        );

        

        $data['breadcrumbs'][] = array(
            'text' => $this->language->get('text_mycommunity'),
            'href' => $this->url->link('mycommunity/mycommunity')
        );

        $data['breadcrumbs'][] = array( 
            'text' =>  $this->language->get('text_reading_club'),
            'href' => $this->url->link('mycommunity/mycommunity/readingclub')
        );

        $data['breadcrumbs'][] = array( 
            'text' =>  $this->language->get('text_accept_invite'),
            'href' => $this->url->link('mycommunity/mycommunity/cancel')
        );

         
        $data['footer'] = $this->load->controller('common/footer');
        $data['header'] = $this->load->controller('common/header');
        $data['heading_title'] = $this->language->get('heading_title');
        
        $data['sharedbooks'] = $this->url->link('mycommunity/mycommunity', '', true);
        $data['readingclub'] = $this->url->link('mycommunity/mycommunity/readingclub', '', true);
        $data['authors'] = $this->url->link('mycommunity/mycommunity/author', '', true);
        $data['publishers'] = $this->url->link('mycommunity/mycommunity/publisher', '', true);

        $clubinfo = $this->model_mycommunity_mycommunity->getMember($group_id);

         if (is_file(DIR_IMAGE.$clubinfo['group_image'])) {
				$image = $this->model_tool_image->resize($clubinfo['group_image'], 189, 95);
			} else {
				$image = $this->model_tool_image->resize('no_image.png', 189, 95);
			}

        $data['club_info'] = array(
             
            
                    'group_id'              => $clubinfo['group_id'],
                    'group_name'            => $clubinfo['group_name'],
			        'group_image'           => $image
                    
        );

       $data['deleteclub'] = $this->url->link('mycommunity/mycommunity/deleteclub&group_id=' , '' , true);  

      $data['create_club'] = $this->url->link('mycommunity/mycommunity/createclub', '', true);

      $data['member_image'] = $this->url->link('mycommunity/mycommunity/recommended&group_id=', '', true);

      $data['club_image'] = $this->url->link('mycommunity/mycommunity/club_info&group_id=', '', true);
     
      $data['addmember']   = $this->url->link('mycommunity/mycommunity/join', '', true);

      $data['sharedbooks'] = $this->url->link('mycommunity/mycommunity', '', true);
      $data['readingclub'] = $this->url->link('mycommunity/mycommunity/readingclub', '', true);
      $data['authors'] = $this->url->link('mycommunity/mycommunity/author', '', true);
      $data['publishers'] = $this->url->link('mycommunity/mycommunity/publisher', '', true);

      $data['create_newclub'] = $this->url->link('mycommunity/mycommunity/create_newclub', '', true);

       $data['acceptclub'] = $this->url->link('mycommunity/mycommunity/acceptclub&group_id=', '', true);

       $data['join_community']   = $this->url->link('mycommunity/mycommunity/join_communtiy&group_id=', '', true);
 
      $data['recommended_image'] = $this->url->link('mycommunity/mycommunity/recommended&group_id=', '', true);
      $data['active_tab'] = 'tab_default_3';

      $this->response->setOutput($this->load->view('mycommunity/acceptinvite', $data));


       }

       public function acceptclub(){

        $group_id = $this->request->get['group_id'];
        $this->load->model('mycommunity/mycommunity');
        
        $this->model_mycommunity_mycommunity->acceptinvite($group_id); 


      

       }

       public function mailsearch(){

       $group_id = $this->request->get['group_id'];    
            
       $this->load->language('mycommunity/mycommunity');

           if(isset($_POST['texts'])) {

            $texts = $_POST['texts'];
            foreach($texts as $firstname){

            $this->load->model('mycommunity/mycommunity');  
            $this->model_mycommunity_mycommunity->getMailid($firstname); 
      
            }
           }

       
        $data['sharedbooks'] = $this->url->link('mycommunity/mycommunity', '', true);
        $data['readingclub'] = $this->url->link('mycommunity/mycommunity/readingclub', '', true);
        $data['authors'] = $this->url->link('mycommunity/mycommunity/author', '', true);
        $data['publishers'] = $this->url->link('mycommunity/mycommunity/publisher', '', true);

     //   $this->response->setOutput($this->load->view('mycommunity/club_info', $data));

       }


       public function invite_people() 
       
       {

          $group_id = $this->request->get['group_id'];    

          if(isset($_POST['emails'])) {

            $emails = $_POST['emails'];
            foreach($emails as $email){

           $this->load->language('mycommunity/mycommunity');   
           $this->load->model('mycommunity/mycommunity');   
           $this->model_mycommunity_mycommunity->addinvite($email);

            }
         }

       

       $group_id = $this->request->get['group_id'];    
       $this->load->language('mycommunity/mycommunity');

       $this->document->setTitle($this->language->get('heading_title'));

       $this->load->model('mycommunity/mycommunity');

       $url='';

        $data['breadcrumbs'] = array();

        $data['breadcrumbs'][] = array(
            'text' => $this->language->get('text_home'),
            'href' => $this->url->link('common/home')
        );

        $data['breadcrumbs'][] = array(
            'text' => $this->language->get('text_mycommunity'),
            'href' => $this->url->link('mycommunity/mycommunity')
        );

        $data['breadcrumbs'][] = array(
            'text' =>  $this->language->get('text_club'),
            'href' => $this->url->link('mycommunity/mycommunity/cancel')
        );

        $this->load->language('mycommunity/mycommunity');

        $data['button_sharedbooks'] = $this->language->get('button_sharedbooks');
        $data['button_reading_club'] = $this->language->get('button_reading_club');
        $data['button_authors'] = $this->language->get('button_authors');
        $data['button_publishers'] = $this->language->get('button_publishers');
        $data['text_recommended'] = $this->language->get('text_recommended');
        $data['text_members'] = $this->language->get('text_members');
        $data['text_yours'] = $this->language->get('text_yours');
        $data['text_name_this_club'] = $this->language->get('text_name_this_club');
        $data['text_club'] = $this->language->get('text_club');
        $data['text_description'] = $this->language->get('text_description');
        $data['text_sharesomething'] = $this->language->get('text_sharesomething');  
        $data['button_create_club'] = $this->language->get('button_create_club');
        $data['button_cancel'] = $this->language->get('button_cancel');
        $data['button_done'] = $this->language->get('button_done');
        $data['button_send'] = $this->language->get('button_send');
        $data['button_join'] = $this->language->get('button_join');
        $data['button_post'] = $this->language->get('button_post');
       	$data['type_text_search'] = $this->language->get('type_text_search');
        $data['text_invite_people'] = $this->language->get('text_invite_people');
        $data['text_enter_name'] = $this->language->get('text_enter_name');
        $data['text_enter_mailid'] = $this->language->get('text_enter_mailid');

        $data['footer'] = $this->load->controller('common/footer');
        $data['header'] = $this->load->controller('common/header');
        $data['heading_title'] = $this->language->get('heading_title');

        $data['sharedbooks'] = $this->url->link('mycommunity/mycommunity', '', true);
        $data['readingclub'] = $this->url->link('mycommunity/mycommunity/readingclub', '', true);
        $data['authors'] = $this->url->link('mycommunity/mycommunity/author', '', true);
        $data['publishers'] = $this->url->link('mycommunity/mycommunity/publisher', '', true);

        $this->load->model('mycommunity/mycommunity');
        $clubinfo = $this->model_mycommunity_mycommunity->getMember($group_id);

         if (is_file(DIR_IMAGE.$clubinfo['group_image'])) {
				$image = $this->model_tool_image->resize($clubinfo['group_image'], 189, 95);
			} else {
				$image = $this->model_tool_image->resize('no_image.png', 189, 95);
			}

        $data['club_info'] = array(
             
            
                    'group_id'              => $clubinfo['group_id'],
                    'group_name'            => $clubinfo['group_name'],
			        'group_image'           => $image
                    
        );

        
        $this->load->model('mycommunity/mycommunity');
        $rec = $this->model_mycommunity_mycommunity->getMember($group_id);

         if (is_file(DIR_IMAGE.$rec['group_image'])) {
				$image = $this->model_tool_image->resize($rec['group_image'], 189, 95);
			} else {
				$image = $this->model_tool_image->resize('no_image.png', 189, 95);
			}

        $data['group_info'] = array(
             
            
                    'group_id'              => $rec['group_id'],
                    'group_name'            => $rec['group_name'],
			        'group_image'           => $image
                    
        );
        
        $this->load->model('mycommunity/mycommunity');
        $customer_id = (int)$this->customer->getId();
        $firstname = $this->customer->getFirstName();
        $lastname = $this->customer->getLastName();

        $this->load->model('mycommunity/mycommunity');
        $customer_id = (int)$this->customer->getId();
        $firstname = $this->customer->getFirstName();
        $lastname = $this->customer->getLastName();
        $email = $this->customer->getEmail();

        $data['first_name'] = $firstname;
        $data['last_name']  = $lastname;
        $data['email']      = $email;

         $customer_id = (int)$this->customer->getId();
		 $data['post_info'] = array();
		 $postresults = $this->model_mycommunity_mycommunity->getClubposts($group_id);
		 foreach($postresults as $postresult)
		 {	

              if (is_file(DIR_IMAGE.$postresult['image'])) {
				$image = $this->model_tool_image->resize($postresult['image'], 417, 417);
			} else {
				$image = '';
			}

			
			 $data['post_info'][] = array (

                  'post_id'              =>$postresult['post_id'],
                  'customer_image'      =>$postresult['customer_image'],
				  'message'             =>$postresult['message'],
			      'image'               =>$image,
                  'link'                =>$postresult['link']
					);
			 
		 } 

         
         $data['invite_people'] = $this->url->link('mycommunity/mycommunity/invite_people&group_id=', '', true);   

         $grouplink = "mycommunity/mycommunity/club_share&group_id=";
         $data['club_share'] = $this->url->link($grouplink, '', true); 

         $data['editimage'] = $this->url->link('mycommunity/mycommunity/changeclub_image&group_id=' , '' , true);

        $data['deleteclub'] = $this->url->link('mycommunity/mycommunity/deleteclub&group_id=' , '' , true);
     
         $data['search_mail'] = $this->url->link('mycommunity/mycommunity/mailsearch&group_id=' , '' , true);

         $data['club_image'] = $this->url->link('mycommunity/mycommunity/club_info&group_id=', '', true);

         $data['upload_image'] = $this->url->link('mycommunity/mycommunity/uploadImage','',true);
     
        
        $this->response->setOutput($this->load->view('mycommunity/club_info', $data));


        
      //   $this->response->setOutput($this->load->view('mycommunity/club_info', $data));

      }

       public function club_share(){

       $this->load->model('mycommunity/mycommunity');    

       $group_id = $this->request->get['group_id'];    
       $textname = $this->request->post['text_name'];

        //uploadImage
		
 		$target_dir = "/home/aramesh/olaichuvadi.cviac.com/image/catalog/";
		$target_file_front = $target_dir . basename($_FILES["image"]["name"]);
		$uploadOk = 1;
	
		$imageFileType = pathinfo($target_file_front,PATHINFO_EXTENSION);
		// Check if image file is a actual image or fake image
		if(isset($_POST["submit"]) && $_FILES["image"]["name"] ) {
  		  $check = getimagesize($_FILES["image"]["tmp_name"]);
  		  if($check !== false) {
  	      //echo "File is an image - " . $check["mime"] . ".";
  	      $uploadOk = 1;
  		  } else {
  	 	    $data['upload_success'] = "File is not an image.";
   	  	   $uploadOk = 0;
   		  }
		}

	
			// Check file size
		/*	if ($_FILES["image"]["size"] > 500000) {
   			 $data['upload_success'] = "Sorry, your file is too large.";
   			 $uploadOk = 0;
			} */

			// Allow certain file formats
		/*	if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
			  && $imageFileType != "gif" ) {
  			  $data['upload_success'] = "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
  			  $uploadOk = 0;
			}*/

			// Check if $uploadOk is set to 0 by an error
			if ($uploadOk == 0) {
 	 		  $data['upload_success'] = "Sorry, your file was not uploaded.";
			// if everything is ok, try to upload file
			} else {
 	   		if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file_front)) {
 	     	 // echo "The file ". basename( $_FILES["front_image"]["name"]). " has been uploaded.";
			$data['upload_success'] = "Your Book Images has been uploaded" ;

			 
 	  	 	} else {
        		$data['upload_success'] = "Sorry, there was an error uploading your file.";
  	 	 	}
		}

        $this->model_mycommunity_mycommunity->addtomypost($group_id);
      
      $this->response->redirect($this->url->link('mycommunity/mycommunity/club_info&group_id='.$group_id,'', true));
    
      
      }


       public function author()
       {

        $this->load->language('mycommunity/mycommunity');

       $this->document->setTitle($this->language->get('heading_title'));

      
       $url='';

        $data['breadcrumbs'] = array();

        $data['breadcrumbs'][] = array(
            'text' => $this->language->get('text_home'),
            'href' => $this->url->link('common/home')
        );

        $data['breadcrumbs'][] = array(
            'text' => $this->language->get('text_mycommunity'),
            'href' => $this->url->link('mycommunity/mycommunity')
        );

        $data['breadcrumbs'][] = array(
            'text' => $this->language->get('text_author'),
            'href' => $this->url->link('mycommunity/mycommunity/author')
        );

        $data['button_sharedbooks'] = $this->language->get('button_sharedbooks');
        $data['button_reading_club'] = $this->language->get('button_reading_club');
        $data['button_authors'] = $this->language->get('button_authors');
        $data['button_publishers'] = $this->language->get('button_publishers');
        $data['text_recommended'] = $this->language->get('text_recommended');
        $data['text_members'] = $this->language->get('text_members');
        $data['text_yours'] = $this->language->get('text_yours');
        $data['text_name_this_club'] = $this->language->get('text_name_this_club');
        $data['text_description'] = $this->language->get('text_description');
        $data['text_sharesomething'] = $this->language->get('text_sharesomething');
        $data['button_create_club'] = $this->language->get('button_create_club');
        $data['button_cancel'] = $this->language->get('button_cancel');
        $data['button_done'] = $this->language->get('button_done');
        $data['button_join'] = $this->language->get('button_join');
        $data['text_type_author_name'] = $this->language->get('text_type_author_name');
        $data['text_type_publisher_name'] = $this->language->get('text_type_publisher_name'); 
        $data['text_author_mastersearch'] = $this->language->get('text_author_mastersearch');  
        $data['text_search_byauthor'] = $this->language->get('text_search_byauthor');  
        $data['text_mycommunity'] = $this->language->get('text_mycommunity');  

        $data['footer'] = $this->load->controller('common/footer');
        $data['header'] = $this->load->controller('common/header');
        $data['heading_title'] = $this->language->get('heading_title');

        $data['sharedbooks'] = $this->url->link('mycommunity/mycommunity', '', true);
        $data['readingclub'] = $this->url->link('mycommunity/mycommunity/readingclub', '', true);
        $data['authors'] = $this->url->link('mycommunity/mycommunity/author', '', true);
        $data['publishers'] = $this->url->link('mycommunity/mycommunity/publisher', '', true);

        
		$this->load->model('mycommunity/mycommunity');
        
     //    $data['author_image'] = $this->url->link('mycommunity/mycommunity/author_info&author_id=', '', true);
       
         $customer_id = (int)$this->customer->getId();
         $data['authors'] = array();
         $authorresults = $this->model_mycommunity_mycommunity->getAuthors($customer_id);
         foreach($authorresults as $authorresult)
		 {

             if (is_file(DIR_IMAGE.$authorresult['author_image'])) {
				$image = $this->model_tool_image->resize($authorresult['author_image'], 228, 228);
			} else {
				$image = $this->model_tool_image->resize('no_image.png', 228, 228);
			}

			 $data['authors'][] = array (

				 'author_id'                       =>$authorresult['author_id'],
			     'author_name'                     =>$authorresult['author_name'],
			     'author_image'                    => $image
               
					);
			 
		 } 
          $data['author_image'] = $this->url->link('mycommunity/mycommunity/author_info&author_id=', '', true);

          

        $data['searchauthor'] = $this->url->link('mycommunity/mycommunity/authorresult' , '' , true);

        

        $this->response->setOutput($this->load->view('mycommunity/author_list', $data));
       }


      public function author_info(){

        $author_id = $this->request->get['author_id'];    
        $this->load->language('mycommunity/mycommunity');
 
        $this->document->setTitle($this->language->get('heading_title'));

        $this->load->model('mycommunity/mycommunity');

        $url='';

        $data['breadcrumbs'] = array();

        $data['breadcrumbs'][] = array(
            'text' => $this->language->get('text_home'),
            'href' => $this->url->link('common/home')
        );

        $data['breadcrumbs'][] = array(
            'text' => $this->language->get('text_mycommunity'),
            'href' => $this->url->link('mycommunity/mycommunity')
        );

        $data['breadcrumbs'][] = array(
            'text' =>  $this->language->get('text_author'),
            'href' => $this->url->link('mycommunity/mycommunity/author')
        );

          $this->load->language('mycommunity/mycommunity');

        $data['button_sharedbooks'] = $this->language->get('button_sharedbooks');
        $data['button_reading_club'] = $this->language->get('button_reading_club');
        $data['button_authors'] = $this->language->get('button_authors');
        $data['button_publishers'] = $this->language->get('button_publishers');
        $data['text_recommended'] = $this->language->get('text_recommended');
        $data['text_members'] = $this->language->get('text_members');
        $data['text_yours'] = $this->language->get('text_yours');
        $data['text_name_this_club'] = $this->language->get('text_name_this_club');
        $data['text_description'] = $this->language->get('text_description');
        $data['text_sharesomething'] = $this->language->get('text_sharesomething');  
        $data['text_born'] = $this->language->get('text_born');  
        $data['text_occupation'] = $this->language->get('text_occupation');  
        $data['text_nationality'] = $this->language->get('text_nationality');  
        $data['text_early_life'] = $this->language->get('text_early_life');
        $data['text_awards'] = $this->language->get('text_awards'); 
        $data['text_references'] = $this->language->get('text_references'); 
        $data['text_links'] = $this->language->get('text_links');  
        $data['button_create_club'] = $this->language->get('button_create_club');
        $data['button_cancel'] = $this->language->get('button_cancel');
        $data['button_done'] = $this->language->get('button_done');
        $data['button_join'] = $this->language->get('button_join');
        $data['button_like_page'] = $this->language->get('button_like_page');
        $data['button_view_books'] = $this->language->get('button_view_books');

        $data['footer'] = $this->load->controller('common/footer');
        $data['header'] = $this->load->controller('common/header');
        $data['heading_title'] = $this->language->get('heading_title');

        $data['sharedbooks'] = $this->url->link('mycommunity/mycommunity', '', true);
        $data['readingclub'] = $this->url->link('mycommunity/mycommunity/readingclub', '', true);
        $data['authors'] = $this->url->link('mycommunity/mycommunity/author', '', true);
        $data['publishers'] = $this->url->link('mycommunity/mycommunity/publisher', '', true);

        $this->load->model('mycommunity/mycommunity');
        $rect = $this->model_mycommunity_mycommunity->getAuthor($author_id);

         if (is_file(DIR_IMAGE.$rect['author_image'])) {
				$image = $this->model_tool_image->resize($rect['author_image'], 250, 250);
			} else {
				$image = $this->model_tool_image->resize('no_image.png', 250, 250);
			}

             $authorlike_counts = $this->model_mycommunity_mycommunity->author_totallikes($rect['author_id']);

            if(!empty($authorlike_counts)){

                $totalLikes  = $authorlike_counts;           
            }else{

                $totalLikes = '';
            } 

         $data['author_info'] = array(
             
                'author_id'                => $rect['author_id'],
				'author_name'              => $rect['author_name'],
				'author_image'             => $image,
                'totalLikes'               => $totalLikes,
				'author_dob'               => $rect['author_dob'],
                'author_occupation'        => $rect['author_occupation'],  
                'author_nationality'       => $rect['author_nationality'],  
                'author_education'         => $rect['author_education'],
                'author_awards'            => $rect['author_awards'],
                'author_references'        => $rect['author_references'],
                'author_external_links'    => $rect['author_external_links']
				
        );


        
        $this->load->model('mycommunity/mycommunity');
      
        $this->response->setOutput($this->load->view('mycommunity/author_info', $data));
        
        }

        

       public function authorresult()
       {


        $this->load->model('mycommunity/mycommunity');

		 $this->load->language('mycommunity/mycommunity');

		$this->document->setTitle($this->language->get('heading_title'));

		$url = '';
		 
		$data['breadcrumbs'] = array();

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('text_home'),
			'href' => $this->url->link('common/dashboard')
		);

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('heading_title'),
			'href' => $this->url->link('mycommunity/mycommunity')
		);

        $data['breadcrumbs'][] = array(
            'text' =>  $this->language->get('text_author'),
            'href' => $this->url->link('mycommunity/mycommunity/author')
        );

	  	 
  		$this->load->model('setting/store');

		$data['stores'] = $this->model_setting_store->getStores();

        $data['button_sharedbooks'] = $this->language->get('button_sharedbooks');
        $data['button_reading_club'] = $this->language->get('button_reading_club');
        $data['button_authors'] = $this->language->get('button_authors');
        $data['button_publishers'] = $this->language->get('button_publishers');
        $data['text_recommended'] = $this->language->get('text_recommended');
        $data['text_members'] = $this->language->get('text_members');
        $data['text_yours'] = $this->language->get('text_yours');
        $data['text_name_this_club'] = $this->language->get('text_name_this_club');
        $data['text_description'] = $this->language->get('text_description');
        $data['text_sharesomething'] = $this->language->get('text_sharesomething');
        $data['button_create_club'] = $this->language->get('button_create_club');
        $data['button_cancel'] = $this->language->get('button_cancel');
        $data['button_done'] = $this->language->get('button_done');
        $data['button_join'] = $this->language->get('button_join');
        $data['text_author_mastersearch'] = $this->language->get('text_author_mastersearch');
        $data['text_type_author_name'] = $this->language->get('text_type_author_name');
        $data['text_search_byauthor'] = $this->language->get('text_search_byauthor');  
        $data['text_mycommunity'] = $this->language->get('text_mycommunity'); 
        $data['text_search_by_author'] = $this->language->get('text_search_by_author'); 
		
 		$data['header'] = $this->load->controller('common/header');
		$data['column_left'] = $this->load->controller('common/column_left');
		$data['footer'] = $this->load->controller('common/footer');

        $data['sharedbooks'] = $this->url->link('mycommunity/mycommunity', '', true);
        $data['readingclub'] = $this->url->link('mycommunity/mycommunity/readingclub', '', true);
        $data['authors'] = $this->url->link('mycommunity/mycommunity/author', '', true);
        $data['publishers'] = $this->url->link('mycommunity/mycommunity/publisher', '', true);

		$this->load->model('mycommunity/mycommunity');

		$data['text_author_mastersearch'] = $this->language->get('text_author_mastersearch');

		if (isset($this->request->post['filter_name'])) {
			$author_mastersearch = $this->request->post['filter_name'];
		} else {
			$author_mastersearch = '';
		}
 
       $authors = $this->model_mycommunity_mycommunity->getAuthorFromMaster($author_mastersearch);
       
      // $data['authorresult'] = $authors;

        if (is_file(DIR_IMAGE.$authors['author_image'])) {
				$image = $this->model_tool_image->resize($authors['author_image'], 250, 250);
			} else {
				$image = $this->model_tool_image->resize('no_image.png', 250, 250);
			}

           $authorlike_counts = $this->model_mycommunity_mycommunity->author_totallikes($authors['author_id']);

            if(!empty($authorlike_counts)){

                $totalLikes  = $authorlike_counts;           
            }else{

                $totalLikes = '';
            } 


         $data['authorresult'] = array(
             
                'author_id'                => $authors['author_id'],
				'author_name'              => $authors['author_name'],
				'author_image'             => $image,
                'totalLikes'               => $totalLikes,
				'author_dob'               => $authors['author_dob'],
                'author_occupation'        => $authors['author_occupation'],  
                'author_nationality'       => $authors['author_nationality'],  
                'author_education'         => $authors['author_education'],
                'author_awards'            => $authors['author_awards'],
                'author_references'        => $authors['author_references'],
                'author_external_links'    => $authors['author_external_links']
				
        );


        $data['add_to_liked_author'] = $this->url->link('mycommunity/mycommunity/addToLikedauthor&author_id=', '', true);

        $data['searchauthor'] = $this->url->link('mycommunity/mycommunity/authorresult' , '' , true); 

        $data['author_image'] = $this->url->link('mycommunity/mycommunity/author_info&author_id=', '', true);

   //    $data['add_to_liked_author']   = $this->url->link('mycommunity/mycommunity/addToLikedauthor', '', true);


	    $this->response->setOutput($this->load->view('mycommunity/authorresult', $data));

    
       }

      

        public function author_addLikeCount() {
             
         $author_id = $this->request->post['author_id'];    

         $this->load->model('mycommunity/mycommunity');
         
         $this->load->language('mycommunity/mycommunity');
          
         $author_LikeCount = $this->model_mycommunity_mycommunity->author_addtolike($author_id);

         $return_arr = array("likes"=>$author_LikeCount);

          echo json_encode($return_arr);
     
        }


      public function publisher()
       {

       $this->load->language('mycommunity/mycommunity');

       $this->document->setTitle($this->language->get('heading_title'));
 
      
       $url='';

        $data['breadcrumbs'] = array();

        $data['breadcrumbs'][] = array(
            'text' => $this->language->get('text_home'),
            'href' => $this->url->link('common/home')
        );

        $data['breadcrumbs'][] = array(
            'text' => $this->language->get('text_mycommunity'),
            'href' => $this->url->link('mycommunity/mycommunity')
        );

        $data['breadcrumbs'][] = array(
            'text' => $this->language->get('text_publishers'),
            'href' => $this->url->link('mycommunity/mycommunity/publisher')
        );

        $data['button_sharedbooks'] = $this->language->get('button_sharedbooks');
        $data['button_reading_club'] = $this->language->get('button_reading_club');
        $data['button_authors'] = $this->language->get('button_authors');
        $data['button_publishers'] = $this->language->get('button_publishers');
        $data['text_recommended'] = $this->language->get('text_recommended');
        $data['text_members'] = $this->language->get('text_members');
        $data['text_yours'] = $this->language->get('text_yours');
        $data['text_name_this_club'] = $this->language->get('text_name_this_club');
        $data['text_description'] = $this->language->get('text_description');
        $data['text_sharesomething'] = $this->language->get('text_sharesomething');
        $data['button_create_club'] = $this->language->get('button_create_club');
        $data['button_cancel'] = $this->language->get('button_cancel');
        $data['button_done'] = $this->language->get('button_done');
        $data['button_join'] = $this->language->get('button_join');
        $data['text_type_author_name'] = $this->language->get('text_type_author_name');
        $data['text_type_publisher_name'] = $this->language->get('text_type_publisher_name'); 
        $data['text_author_mastersearch'] = $this->language->get('text_author_mastersearch');  
        $data['text_publisher_mastersearch'] = $this->language->get('text_publisher_mastersearch');  
        $data['text_search_bypublisher'] = $this->language->get('text_search_bypublisher');  


        $data['footer'] = $this->load->controller('common/footer');
        $data['header'] = $this->load->controller('common/header');
        $data['heading_title'] = $this->language->get('heading_title');

        $data['sharedbooks'] = $this->url->link('mycommunity/mycommunity', '', true);
        $data['readingclub'] = $this->url->link('mycommunity/mycommunity/readingclub', '', true);
        $data['authors'] = $this->url->link('mycommunity/mycommunity/author', '', true);
        $data['publishers'] = $this->url->link('mycommunity/mycommunity/publisher', '', true);

        
		$this->load->model('mycommunity/mycommunity');
    
       $customer_id = (int)$this->customer->getId();
         $data['publishers'] = array();
         $publisherresults = $this->model_mycommunity_mycommunity->getPublishers($customer_id);
         foreach($publisherresults as $publisherresult)
		 {
            
             if (is_file(DIR_IMAGE.$publisherresult['publisher_image'])) {
				$image = $this->model_tool_image->resize($publisherresult['publisher_image'], 228, 228);
			} else {
				$image = $this->model_tool_image->resize('no_image.png', 228, 228);
			}

			 $data['publishers'][] = array (

				 'publisher_id'           =>$publisherresult['publisher_id'],
			     'publisher_name'         =>$publisherresult['publisher_name'],
			     'publisher_image'        =>$image
                 
					);
			 
		 } 

        $data['publisher_image'] = $this->url->link('mycommunity/mycommunity/publisher_info&publisher_id=', '', true);

        $data['searchpublisher'] = $this->url->link('mycommunity/mycommunity/publisherresult' , '' , true);

        $this->response->setOutput($this->load->view('mycommunity/publisher_list', $data));
       }


      public function publisher_info(){

      $publisher_id = $this->request->get['publisher_id'];    
      $this->load->language('mycommunity/mycommunity');

      $this->document->setTitle($this->language->get('heading_title'));

      $this->load->model('mycommunity/mycommunity');

       $url='';

        $data['breadcrumbs'] = array();

        $data['breadcrumbs'][] = array(
            'text' => $this->language->get('text_home'),
            'href' => $this->url->link('common/home')
        );

        $data['breadcrumbs'][] = array(
            'text' => $this->language->get('text_mycommunity'),
            'href' => $this->url->link('mycommunity/mycommunity')
        );

        $data['breadcrumbs'][] = array(
            'text' =>  $this->language->get('text_publishers'),
            'href' => $this->url->link('mycommunity/mycommunity/publisher')
        );

          $this->load->language('mycommunity/mycommunity');

        $data['button_sharedbooks'] = $this->language->get('button_sharedbooks');
        $data['button_reading_club'] = $this->language->get('button_reading_club');
        $data['button_authors'] = $this->language->get('button_authors');
        $data['button_publishers'] = $this->language->get('button_publishers');
        $data['text_recommended'] = $this->language->get('text_recommended');
        $data['text_members'] = $this->language->get('text_members');
        $data['text_yours'] = $this->language->get('text_yours');
        $data['text_name_this_club'] = $this->language->get('text_name_this_club');
        $data['text_description'] = $this->language->get('text_description');
        $data['text_sharesomething'] = $this->language->get('text_sharesomething');  
        $data['text_type_publisher_name'] = $this->language->get('text_type_publisher_name'); 
        $data['text_address'] = $this->language->get('text_address'); 
        $data['button_create_club'] = $this->language->get('button_create_club');
        $data['button_cancel'] = $this->language->get('button_cancel');
        $data['button_done'] = $this->language->get('button_done');
        $data['button_join'] = $this->language->get('button_join');
        $data['button_like_page'] = $this->language->get('button_like_page');
        $data['button_view_books'] = $this->language->get('button_view_books');


        $data['footer'] = $this->load->controller('common/footer');
        $data['header'] = $this->load->controller('common/header');
        $data['heading_title'] = $this->language->get('heading_title');

        $data['sharedbooks'] = $this->url->link('mycommunity/mycommunity', '', true);
        $data['readingclub'] = $this->url->link('mycommunity/mycommunity/readingclub', '', true);
        $data['authors'] = $this->url->link('mycommunity/mycommunity/author', '', true);
        $data['publishers'] = $this->url->link('mycommunity/mycommunity/publisher', '', true);

        $this->load->model('mycommunity/mycommunity');
        $recta = $this->model_mycommunity_mycommunity->getPublisher($publisher_id);
     
        if (is_file(DIR_IMAGE.$recta['publisher_image'])) {
				$image = $this->model_tool_image->resize($recta['publisher_image'], 250, 250);
			} else {
				$image = $this->model_tool_image->resize('no_image.png', 250, 250);
			}

            $data['publisher_info'] = array(
             
                    'publisher_id'              => $recta['publisher_id'],
                    'publisher_name'            => $recta['publisher_name'],
			        'publisher_image'           => $image,
                    'publisher_description'     => $recta['publisher_description'],
					'publisher_address'         => $recta['publisher_address'],
                    'total_votes'               => $recta['total_votes'],
                    'likes'                     => $recta['likes']

        );


        
        $this->response->setOutput($this->load->view('mycommunity/publisher_info', $data));
        
        }

        

       public function publisherresult()
       {


        $this->load->model('mycommunity/mycommunity');

		 $this->load->language('mycommunity/mycommunity');

		$this->document->setTitle($this->language->get('heading_title'));

		$url = '';
		 
		$data['breadcrumbs'] = array();

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('text_home'),
			'href' => $this->url->link('common/dashboard')
		);

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('heading_title'),
			'href' => $this->url->link('mycommunity/mycommunity')
		);

         $data['breadcrumbs'][] = array(
            'text' =>  $this->language->get('text_publishers'),
            'href' => $this->url->link('mycommunity/mycommunity/publisher')
        );

	  	 
  		$this->load->model('setting/store');

		$data['stores'] = $this->model_setting_store->getStores();

        $data['button_sharedbooks'] = $this->language->get('button_sharedbooks');
        $data['button_reading_club'] = $this->language->get('button_reading_club');
        $data['button_authors'] = $this->language->get('button_authors');
        $data['button_publishers'] = $this->language->get('button_publishers');
        $data['text_recommended'] = $this->language->get('text_recommended');
        $data['text_members'] = $this->language->get('text_members');
        $data['text_yours'] = $this->language->get('text_yours');
        $data['text_name_this_club'] = $this->language->get('text_name_this_club');
        $data['text_description'] = $this->language->get('text_description');
        $data['text_sharesomething'] = $this->language->get('text_sharesomething');
        $data['button_create_club'] = $this->language->get('button_create_club');
        $data['button_cancel'] = $this->language->get('button_cancel');
        $data['button_done'] = $this->language->get('button_done');
        $data['button_join'] = $this->language->get('button_join');
        $data['text_author_mastersearch'] = $this->language->get('text_author_mastersearch');
        $data['text_type_author_name'] = $this->language->get('text_type_author_name');
        $data['text_type_publisher_name'] = $this->language->get('text_type_publisher_name'); 
        $data['text_mycommunity'] = $this->language->get('text_mycommunity'); 
        $data['text_search_by_publisher'] = $this->language->get('text_search_by_publisher'); 
		
 		$data['header'] = $this->load->controller('common/header');
		$data['column_left'] = $this->load->controller('common/column_left');
		$data['footer'] = $this->load->controller('common/footer');


        $data['sharedbooks'] = $this->url->link('mycommunity/mycommunity', '', true);
        $data['readingclub'] = $this->url->link('mycommunity/mycommunity/readingclub', '', true);
        $data['authors'] = $this->url->link('mycommunity/mycommunity/author', '', true);
        $data['publishers'] = $this->url->link('mycommunity/mycommunity/publisher', '', true);
 
		$this->load->model('mycommunity/mycommunity');

		$data['text_publisher_mastersearch'] = $this->language->get('text_publisher_mastersearch');

        
		if (isset($this->request->post['publisher_name'])) {
			$publisher_mastersearch = $this->request->post['publisher_name'];
		} else {
			$publisher_mastersearch = '';
		}
 
    
		$publishers = $this->model_mycommunity_mycommunity->getPublisherFromMaster($publisher_mastersearch);
    
        if (is_file(DIR_IMAGE.$publishers['publisher_image'])) {
				$image = $this->model_tool_image->resize($publishers['publisher_image'], 250, 250);
			} else {
				$image = $this->model_tool_image->resize('no_image.png', 250, 250);
			}

             $publisherlike_counts = $this->model_mycommunity_mycommunity->publisher_totallikes($publishers['publisher_id']);

            if(!empty($publisherlike_counts)){

                $totalLikes  = $publisherlike_counts;           
            }else{

                $totalLikes = '';
            } 


         $data['publisherresult'] = array(
             
                    'publisher_id'              => $publishers['publisher_id'],
                    'publisher_name'            => $publishers['publisher_name'],
			        'publisher_image'           => $image,
                    'totalLikes'                => $totalLikes,
                    'publisher_description'     => $publishers['publisher_description'],
					'publisher_address'         => $publishers['publisher_address']
                   

        );

        $data['publisher'] = $this->url->link('mycommunity/mycommunity/addToLikedpublisher&publisher_id=', '', true);

        $data['add_to_liked_publisher']   = $this->url->link('mycommunity/mycommunity/addToLikedpublisher', '', true);

        $data['searchpublisher'] = $this->url->link('mycommunity/mycommunity/publisherresult' , '' , true); 
	
	    $this->response->setOutput($this->load->view('mycommunity/publisherresult', $data));

        

       }

        public function publisher_addLikeCount() {
             
         $publisher_id = $this->request->post['publisher_id'];    

         $this->load->model('mycommunity/mycommunity');
         
         $this->load->language('mycommunity/mycommunity');
          
         $publisher_LikeCount = $this->model_mycommunity_mycommunity->publisher_addtolike($publisher_id);

         $return_arr = array("likes"=>$publisher_LikeCount);

          echo json_encode($return_arr);
     
        }
  
    
	    public function autocomplete() {

		$json = array();

		if (isset($this->request->get['filter_name']))  {
		$this->load->model('mycommunity/mycommunity');

			if (isset($this->request->get['filter_name'])) {
				$filter_name = $this->request->get['filter_name'];
			} else {
				$filter_name = '';
			}

            if (isset($this->request->get['limit'])) {
				$limit = $this->request->get['limit'];
			} else {
				$limit = 5;
			}

			$filter_data = array(
				'filter_name'  => $filter_name,
                'start'        => 0,
				'limit'        => $limit
				
		    );

		   $results = $this->model_mycommunity_mycommunity->getAllauthors($filter_data);
      //     $option_data = array();


			foreach ($results as $result) {
				
				$json[] = array(
					'author_id' => $result['author_id'],
					'name'       => strip_tags(html_entity_decode($result['author_name'], ENT_QUOTES, 'UTF-8')),
					//'model'      => $result['model'],
					//'option'     => $option_data,
					//'price'      => $result['price']
				);
			}
		}

		$this->response->addHeader('Content-Type: application/json');
		$this->response->setOutput(json_encode($json));
	}


     public function autocomplete_pub() {

		$json = array();

		if (isset($this->request->get['publisher_name']))  {
		$this->load->model('mycommunity/mycommunity');

			if (isset($this->request->get['publisher_name'])) {
				$filter_name = $this->request->get['publisher_name'];
			} else {
				$filter_name = '';
			}

            if (isset($this->request->get['limit'])) {
				$limit = $this->request->get['limit'];
			} else {
				$limit = 5;
			}

			$filter_data = array(
				'publisher_name'  => $filter_name,
                'start'        => 0,
				'limit'        => $limit
				
		    );

		   $results = $this->model_mycommunity_mycommunity->getAllpublishers($filter_data);
      //     $option_data = array();


			foreach ($results as $result) {
				
				$json[] = array(
					'publisher_id' => $result['publisher_id'],
					'name'       => strip_tags(html_entity_decode($result['publisher_name'], ENT_QUOTES, 'UTF-8')),
					//'model'      => $result['model'],
					//'option'     => $option_data,
					//'price'      => $result['price']
				);
			}
		}

		$this->response->addHeader('Content-Type: application/json');
		$this->response->setOutput(json_encode($json));
     }


   /* public function autocomplete_name() {

		$json = array();

		if (isset($this->request->get['filter_email']))  {
		$this->load->model('mycommunity/mycommunity');

			if (isset($this->request->get['filter_email'])) {
				$filter_name = $this->request->get['filter_email'];
			} else {
				$filter_name = '';
			}

            if (isset($this->request->get['limit'])) {
				$limit = $this->request->get['limit'];
			} else {
				$limit = 5;
			}

			$filter_data = array(
				'filter_email'  => $filter_name,
                'start'        => 0,
				'limit'        => $limit
				
		    );

		   $results = $this->model_mycommunity_mycommunity->getAllemail($filter_data);
      //     $option_data = array();


			foreach ($results as $result) {
				
				$json[] = array(
					'customer_id' => $result['customer_id'],
					'name'       => strip_tags(html_entity_decode($result['email'], ENT_QUOTES, 'UTF-8')),
					//'model'      => $result['model'],
					//'option'     => $option_data,
					//'price'      => $result['price']
				);
			}
		}

		$this->response->addHeader('Content-Type: application/json');
		$this->response->setOutput(json_encode($json));
     } */

}