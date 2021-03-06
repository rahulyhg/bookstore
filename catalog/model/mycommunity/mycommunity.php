<?php
class ModelMyCommunityMycommunity extends Model {

 public function getRecommend($group_id)
 {
    $query = $this->db->query("SELECT*FROM readingclub WHERE group_id = '" .$group_id. "'");

    if ($query->num_rows) {
            return array(

                'group_id'                => $query->row['group_id'],
                'group_name'              => $query->row['group_name'],
                'group_image'             => $query->row['group_image'],
                'status'                  => $query->row['status']

                  
            );
        }
        else {
            return false;
             }
     
 }     

public function getRecommended() {

      //$group_data = array();

       $query = $this->db->query("SELECT * FROM readingclub where recommended= 'true' AND status='active' AND created_by!= '" . (int)$this->customer->getId() . "'");


      return $query ->rows;
       
 
}

public function memberstatus($group_id){

    $query = $this->db->query("SELECT * FROM group_members where group_id = '".(int)$group_id."' AND customer_id = '" . (int)$this->customer->getId() . "'");

    if($query->rows )
    {
        $query = $this->db->query("SELECT * FROM readingclub where group_id= '".$group_id."'");
        if($query->rows){

            return array(

                'group_id'                => $query->row['group_id'],
                'group_name'              => $query->row['group_name'],
                'group_image'             => $query->row['group_image'],
                'status'                  => "member"

            );
        } 
    }
    else{

        $query = $this->db->query("SELECT * FROM readingclub where group_id= '".$group_id."'");
        if($query->rows){

            return array(

                'group_id'                => $query->row['group_id'],
                'group_name'              => $query->row['group_name'],
                'group_image'             => $query->row['group_image'],
                'status'                  => "join"
                
            );
        } 

    }
}

public function groupmember(){

    $query = $this->db->query("SELECT group_id FROM group_members where customer_id = '" . (int)$this->customer->getId() . "'");

    $group_id = array();
    
    foreach($query->rows as $result)
    {
 
        $group_id[$result['group_id']]= $this->groupdetails($result['group_id']);
  
    }

    return $group_id;
     
}

public function groupdetails($group_id){

    $query = $this->db->query("SELECT * FROM readingclub where group_id= '".$group_id."'");
    
    if($query->rows)
        {
            return array(
                'group_id'                => $query->row['group_id'],
                'group_name'              => $query->row['group_name'],
                'group_image'             => $query->row['group_image'],
                'status'                  => "member"
            );   

         }else{
             return false;
         } 
} 

 public function addtomember($group_id)
  {
      $this->db->query("DELETE FROM group_members WHERE customer_id = '" . (int)$this->customer->getId() . "'AND group_id = '" . $group_id. "'");

     $this->db->query("INSERT INTO  group_members SET customer_id = '" . (int)$this->customer->getId() . "', group_id = '" . $group_id. "' ,date_added = NOW()");

    
  }

  public function getMember($group_id) {

    $query = $this->db->query("SELECT * FROM group_members where group_id = '".(int)$group_id."' AND customer_id = '" . (int)$this->customer->getId() . "'");

    if($query->rows )
    {
        $query = $this->db->query("SELECT * FROM readingclub where group_id= '".$group_id."'");
        if($query->rows){

            return array(

                'group_id'                => $query->row['group_id'],
                'group_name'              => $query->row['group_name'],
                'group_image'             => $query->row['group_image'],
                'created_by'              => $query->row['created_by'],
                'customer_image'          => $query->row['customer_image'],
                'status'                  => "member"

            );
        } 
    }
    else{

        $query = $this->db->query("SELECT * FROM readingclub where group_id= '".$group_id."'");
        if($query->rows){

            return array(

                'group_id'                => $query->row['group_id'],
                'group_name'              => $query->row['group_name'],
                'group_image'             => $query->row['group_image'],
                'created_by'              => $query->row['created_by'],
                'customer_image'          => $query->row['customer_image'],
                'status'                  => "join"
                
            );
        } 

 
}
  }

 public function deleteclub($group_id){

      $query = $this->db->query("DELETE FROM readingclub WHERE group_id = '" . $group_id. "' AND created_by='" . $created_by. "'");

 }

  public function deletepost($post_id){

      $query = $this->db->query("DELETE FROM readingclub_post WHERE post_id = '" . $post_id. "'");

 }

 public function updateclubimage($group_id){

      $image = "catalog/".$_FILES["image"]["name"];
      $this->db->query("UPDATE  readingclub SET  group_image = '" .$image. "' WHERE group_id = '" . $group_id. "'");
      

 }

 public function addtomyclub($club_name)
  {
     $this->db->query("DELETE FROM readingclub WHERE group_name = '" . $club_name. "'");

     $this->db->query("INSERT INTO readingclub SET created_by = '" . (int)$this->customer->getId() . "' , group_image = '', customer_image='catalog/usericon.png' , group_name = '" . $club_name. "',group_description = '" . $this->request->post['club_description']. "',privacy='".$this->request->post['status']."',location='".$this->request->post['location']."', date_added = NOW()");
    
  }

  public function getclub($group_id)
  {
       $query = $this->db->query("SELECT * FROM readingclub WHERE group_id = '". $group_id ."'");


          if($query->num_rows) {
		   	  return array(

                    'group_id'                 => $query->row['group_id'],
                    'group_name'               => $query->row['group_name'],
			        'group_description'        => $query->row['group_description'],
					'group_image'              => $query->row['group_image'],
                    'status'                   => $query->row['status']

						);
			  }
		  
	else {
return false;
	}
  }

 public function getclubs()
  {
      $group_id = array();
      $query = $this->db->query("SELECT group_id FROM readingclub WHERE created_by = '" . (int)$this->customer->getId() . "'  ");

      foreach($query->rows as $result)
      {
          $group_id[$result['group_id']]=$this->getclub($result['group_id']);
      }
      return  $group_id;
  } 

  public function getpost($post_id)
  {
     
     $query = $this->db->query("SELECT * from readingclub_post WHERE   post_id = '". $post_id ."' ORDER BY date_added DESC");
     if($query->num_rows) {
		   	  return array(

                    'customer_id'           => $query->row['customer_id'], 
                    'group_id'              => $query->row['group_id'], 
                    'post_id'               => $query->row['post_id'], 
                    'message'               => $query->row['message'],
			        'image'                 => $query->row['image'],
					'link'                  => $query->row['link'],
                   	'customer_image'        => $query->row['customer_image'],
                    'status'                => $query->row['status']

						);
			  }
		  
	else {
    return false;
	}

  }

  public function getposts($group_id){
      
      $post_id = array(); 
      $query = $this->db->query("SELECT post_id from readingclub_post WHERE  group_id = '". $group_id ."' ORDER BY date_added DESC");

      foreach($query->rows as $result)
      {
          $post_id[$result['post_id']] =$this->getpost($result['post_id']);
      }
      return  $post_id;

   }

   public function addtomypost($groupid)
  {

   $image = "catalog/".$_FILES["image"]["name"];
   $this->db->query("INSERT INTO readingclub_post SET  group_id = '". $groupid ."' , posted_by = 'customer' , customer_id = '" . (int)$this->customer->getId() . "', message = '" . $this->request->post['text_name']. "', image = '" .$image. "', customer_image='catalog/usericon.png', date_added = NOW()");

   //$this->db->query("UPDATE  readingclub_post SET status='member' WHERE customer_id = '" . (int)$this->customer->getId() . "' AND group_id = '" . $groupid. "'");
   
  }

 public function totallikes($post_id)
  {
      $query = $this->db->query("SELECT COUNT(*) AS cntLike FROM oc_like WHERE post_id='".$post_id."'");

       if ($query->row) {

       return $query->row['cntLike'];

       } else {

        return FALSE;
    }
} 
  

    public function addtolikedpost($post_id)
    {

    $query = $this->db->query("SELECT COUNT(*) AS cntpost FROM oc_like WHERE post_id='".$post_id."' and customer_id='".(int)$this->customer->getId()."'");

    foreach($query->rows as $result)
      {
         $count = $result['cntpost'];
      }
     if($count == 0){
    
            $query = $this->db->query("INSERT INTO oc_like SET  post_id = '". $post_id ."' , customer_id = '" . (int)$this->customer->getId() ."',date_added=NOW()");
     }
     $query = $this->db->query("SELECT COUNT(*) AS cntLike FROM oc_like WHERE post_id='".$post_id."'");

       if ($query->row) {

       return $query->row['cntLike'];
  }

  else{
      return 0;
  }

    }

     public function author_totallikes($author_id)
  {
      $query = $this->db->query("SELECT COUNT(*) AS cntLike FROM oc_authorlike WHERE author_id='".$author_id."'");

       if ($query->row) {

       return $query->row['cntLike'];

       } else {

        return FALSE;
    }
} 

    public function author_addtolike($author_id){

    $query = $this->db->query("SELECT COUNT(*) AS cntpost FROM oc_authorlike WHERE author_id='".$author_id."' and customer_id='".(int)$this->customer->getId()."'");

    foreach($query->rows as $result)
      {
         $count = $result['cntpost'];
      }
     if($count == 0){
    
        $query = $this->db->query("INSERT INTO oc_authorlike SET  author_id = '". $author_id ."' , customer_id = '" . (int)$this->customer->getId() ."',date_added=NOW()");


     }
     $query = $this->db->query("SELECT COUNT(*) AS cntLike FROM oc_authorlike WHERE author_id='".$author_id."'");

       if ($query->row) {

       return $query->row['cntLike'];
       }

      else{

      return 0;
      }

      }

    public function getAuthorFromMaster($author_name) 
    
    {
 
		$query = $this->db->query("SELECT * FROM  authors_master WHERE author_name = '". $author_name . "'" );
		
		if ($query->num_rows) {
			return array(
				'author_id'                => $query->row['author_id'],
				'author_name'              => $query->row['author_name'],
				'author_image'             => $query->row['author_image'],
				'author_dob'               => $query->row['author_dob'],
                'author_occupation'        => $query->row['author_occupation'],  
                'author_nationality'       => $query->row['author_nationality'],  
                'author_education'         => $query->row['author_education'],
                'author_awards'            => $query->row['author_awards'],
                'author_references'        => $query->row['author_references'],
                'author_external_links'    => $query->row['author_external_links']
				
				 
			);
		}
		else {
			return false;
		}
 
 }


 public function getAuthor($author_id) {

       $query = $this->db->query("SELECT * FROM authors_master WHERE author_id = '".$author_id."'");

          if($query->num_rows) {
		   	  return array(

                'author_id'                => $query->row['author_id'],
				'author_name'              => $query->row['author_name'],
				'author_image'             => $query->row['author_image'],
				'author_dob'               => $query->row['author_dob'],
                'author_occupation'        => $query->row['author_occupation'],  
                'author_nationality'       => $query->row['author_nationality'],  
                'author_education'         => $query->row['author_education'],
                'author_awards'            => $query->row['author_awards'],
                'author_references'        => $query->row['author_references'],
                'author_external_links'    => $query->row['author_external_links']
				
					

						);
			  }
		  
	else {
return false;
	}
  
}

public function getAuthors($customer_id)
 {

     $author_id = array();
     $query = $this->db->query("SELECT author_id from oc_authorlike WHERE customer_id = '". (int)$this->customer->getId() ."'");

     foreach($query->rows as $result)
     {
         $author_id[$result['author_id']] = $this->getAuthor($result['author_id']);
     }

     return $author_id;
 } 

  public function publisher_totallikes($publisher_id)
  {
      $query = $this->db->query("SELECT COUNT(*) AS cntLike FROM oc_publisherlike WHERE publisher_id='".$publisher_id."'");

       if ($query->row) {

       return $query->row['cntLike'];

       } else {

        return FALSE;
    }
} 

    public function publisher_addtolike($publisher_id){

    $query = $this->db->query("SELECT COUNT(*) AS cntpost FROM oc_publisherlike WHERE publisher_id='".$publisher_id."' and customer_id='".(int)$this->customer->getId()."'");

    foreach($query->rows as $result)
      {
         $count = $result['cntpost'];
      }
     if($count == 0){
    
        $query = $this->db->query("INSERT INTO oc_publisherlike SET  publisher_id = '". $publisher_id ."' , customer_id = '" . (int)$this->customer->getId() ."',date_added=NOW()");


     }
     $query = $this->db->query("SELECT COUNT(*) AS cntLike FROM oc_publisherlike WHERE publisher_id='".$publisher_id."'");

       if ($query->row) {

       return $query->row['cntLike'];
       }

      else{

      return 0;
      }

      }



 public function getPublisher($publisher_id) {

       $query = $this->db->query("SELECT * FROM publishers_master WHERE publisher_id = '".$publisher_id."'");

          if($query->num_rows) {
		   	  return array(

                    'publisher_id'              => $query->row['publisher_id'],
                    'publisher_name'            => $query->row['publisher_name'],
			        'publisher_image'           => $query->row['publisher_image'],
                    'publisher_description'     => $query->row['publisher_description'],
					'publisher_address'         => $query->row['publisher_address']
                   

						);
			  }
		  
	else {
return false;
	}
  
}

public function getPublishers($customer_id)
 {

     $publisher_id = array();
     $query = $this->db->query("SELECT publisher_id from oc_publisherlike WHERE customer_id = '". (int)$this->customer->getId() ."'");

     foreach($query->rows as $result)
     {
         $publisher_id[$result['publisher_id']] = $this->getPublisher($result['publisher_id']);
     }

     return $publisher_id;
 } 

 public function getPublisherFromMaster($publisher_name) 
 {
 
		$query = $this->db->query("SELECT * FROM  publishers_master WHERE publisher_name = '". $publisher_name . "'" );
		
		if ($query->num_rows) {
			return array(

				    'publisher_id'              => $query->row['publisher_id'],
                    'publisher_name'            => $query->row['publisher_name'],
			        'publisher_image'           => $query->row['publisher_image'],
                    'publisher_description'     => $query->row['publisher_description'],
					'publisher_address'         => $query->row['publisher_address']
                    

				 
			);
		}
		else {
			return false;
		}
 
 }

 public function getSharedbooksFromMyLibrary()
 { 

<<<<<<< HEAD
     $query = $this->db->query("SELECT isbn FROM mylibrary WHERE share_price > 0 AND status!='sold' GROUP BY isbn "); 
=======
     $query = $this->db->query("SELECT isbn FROM mylibrary WHERE share_price > 0 AND status != 'sold' GROUP BY isbn "); 
>>>>>>> a5d53604272d2093b0b926312755c3b2f6d179e0

     $shared = array();

     foreach($query->rows as $result) {
           
             $isbn = $result['isbn'];
             $shared[$result['isbn']]=$this->model_mycommunity_mycommunity->getSharedbooks($isbn);
  
          }

          return $shared;

 }    


 public function getSharedbooks($isbn)
 { 
    
          $query = $this->db->query("SELECT pd.name, p.image,p.model,p.author,p.share_price, p.product_id FROM oc_product_description pd INNER JOIN oc_product p ON pd.product_id = p.product_id WHERE p.model = '".$isbn."' AND p.status = 1 ");             
        

         if($query->num_rows){

             return array(

                 'name'           => $query->row['name'],
                 'image'          => $query->row['image'],
                 'model'          => $query->row['model'],
                 'author'         => $query->row['author'],
                 'share_price'    => $query->row['share_price'],
                 'product_id'     => $query->row['product_id']
                         
             );
         }else{

             return ;
         }

 } 

 public function getBestPrice($isbn)
 {

      $share_prices = $this->db->query("SELECT share_price FROM mylibrary where isbn = '".$isbn."'" );    

      if($share_prices->num_rows)
		{
			return array(

				 $share_prices->row['share_price']
			);
		}
		else {
			return false;
		}
      
 }

  

 public function requestedbooks($isbn){

       $query = $this->db->query("DELETE FROM requested_books WHERE customer_id = '" . (int)$this->customer->getId() . "'AND isbn = '" . $isbn. "'");
      
      $query = $this->db->query("INSERT INTO requested_books SET customer_id = '" . (int)$this->customer->getId() . "', isbn = $isbn , date_added = NOW()");


 }  


 public function getProductId($isbn){

     $product_id = array();

     $query = $this->db->query("SELECT product_id FROM oc_product WHERE model = '" .$isbn. "'" );

    return $product_id;

 }

 public function getProduct($product_id){

      $query = $this->db->query("SELECT * FROM oc_product WHERE product_id = '".(int)$product_id."'");

      if ($query->num_rows) {
			return array(

				    'product_id'                   => $query->row['product_id'],
                    'quantity'                     => $query->row['quantity']
			       			 
			);

		}
		else {
			return false;
		}

 }

 public function addTocart($book) {

        $query = $this->db->query("INSERT INTO oc_cart SET product_id = '".$book['product_id']."', quantity ='".$book['quantity']."', customer_id = '" . (int)$this->customer->getId() . "', date_added = NOW()");

 }

 public function addinvite($email){

        $this->load->language('mycommunity/mycommunity');   

        

        $query = $this->db->query("INSERT INTO addinvite SET customer_id = '" . (int)$this->customer->getId() . "', mail_id ='" .$email."' , group_id = '" . $this->request->get['group_id']. "', date_added = NOW()");

        $subject = sprintf($this->language->get('text_subject'), html_entity_decode($this->config->get('config_name'), ENT_QUOTES, 'UTF-8'));

        $data = array();

           $data['text_jane'] = $this->language->get('text_jane');
           $data['text_invite'] = $this->language->get('text_invite');
           $data['text_olai'] = $this->language->get('text_olai');
           $data['text_cviac'] = $this->language->get('text_cviac');
           $data['text_member'] = $this->language->get('text_member'); 


        if ($this->request->server['HTTPS']) {
			$server = $this->config->get('config_ssl');
		} else {
			$server = $this->config->get('config_url');
		}
        
     /*   $message = sprintf($this->language->get('text_welcome'), html_entity_decode($this->config->get('config_name'), ENT_QUOTES, 'UTF-8')) . "\n\n";*/
        $message = $this->config->get('config_url') . 'index.php?route=mycommunity/mycommunity/acceptinvite&group_id=' . $this->request->get['group_id'] . "\n\n";
       //$link = sprintf($this->language->get('text_link'), html_entity_decode($this->config->get('config_name'), ENT_QUOTES, 'UTF-8')) . "\n\n";

        $email=$email;
		$mail = new Mail();
		$mail->protocol = $this->config->get('config_mail_protocol');
		$mail->parameter = $this->config->get('config_mail_parameter');
		$mail->smtp_hostname = $this->config->get('config_mail_smtp_hostname');
		$mail->smtp_username = $this->config->get('config_mail_smtp_username');
		$mail->smtp_password = html_entity_decode($this->config->get('config_mail_smtp_password'), ENT_QUOTES, 'UTF-8');
		$mail->smtp_port = $this->config->get('config_mail_smtp_port'); 
		$mail->smtp_timeout = $this->config->get('config_mail_smtp_timeout');
        
		$mail->setTo($email);
		$mail->setFrom($this->config->get('config_email'));
		$mail->setSender(html_entity_decode($this->config->get('config_name'), ENT_QUOTES, 'UTF-8'));
		$mail->setSubject($subject);
    //  $mail->setHtml($this->load->view('mycommunity/invitemail',$data));
		$mail->setText($message);
    
		$mail->send();
       
        }

        public function getMailid($firstname){
        
         $book_data = array();

         $query = $this->db->query("SELECT email FROM oc_customer WHERE firstname = '".$firstname."'" );

         foreach($query->rows as $result) {

         $book_data[$result['email']]=$this->model_mycommunity_mycommunity->getEmail($result['email']);
         }
         return $book_data;
         
        }


        public function getEmail($email){

        $this->load->language('mycommunity/mycommunity');

        $query = $this->db->query("INSERT INTO addinvite SET customer_id = '" . (int)$this->customer->getId() . "', group_id='".(int)$this->request->get['group_id']."', mail_id = '" . $email. "',date_added = NOW()");
      
        $subject = sprintf($this->language->get('text_subject'), html_entity_decode($this->config->get('config_name'), ENT_QUOTES, 'UTF-8'));

        $message = sprintf($this->language->get('text_welcome'), html_entity_decode($this->config->get('config_name'), ENT_QUOTES, 'UTF-8')) . "\n\n";
        
      //  $link = sprintf($this->language->get('text_link'), html_entity_decode($this->config->get('config_name'), ENT_QUOTES, 'UTF-8')) . "\n\n";

        $email=$email;
		$mail = new Mail();
		$mail->protocol = $this->config->get('config_mail_protocol');
		$mail->parameter = $this->config->get('config_mail_parameter');
		$mail->smtp_hostname = $this->config->get('config_mail_smtp_hostname');
		$mail->smtp_username = $this->config->get('config_mail_smtp_username');
		$mail->smtp_password = html_entity_decode($this->config->get('config_mail_smtp_password'), ENT_QUOTES, 'UTF-8');
		$mail->smtp_port = $this->config->get('config_mail_smtp_port'); 
		$mail->smtp_timeout = $this->config->get('config_mail_smtp_timeout');

		$mail->setTo($email);
		$mail->setFrom($this->config->get('config_email'));
		$mail->setSender(html_entity_decode($this->config->get('config_name'), ENT_QUOTES, 'UTF-8'));
		$mail->setSubject($subject);
		$mail->setText($message);
        
		$mail->send();


        }


        public function getClubpost($post_id)   {

        $query = $this->db->query("SELECT*FROM readingclub_post WHERE post_id = '" . $post_id. "' ORDER BY date_added DESC");

       if ($query->num_rows) {
			return array(
                    
                    'group_id'              => $query->row['group_id'], 
                    'post_id'               => $query->row['post_id'],
				    'message'               => $query->row['message'],
			        'image'                 => $query->row['image'],
					'link'                  => $query->row['link'],
                   	'customer_image'        => $query->row['customer_image']
				 
			);
		}
		else {
			return false;
		     }
     
         }

        public function getClubposts($group_id) {

	    $post_id = array();
	    $query = $this->db->query("SELECT post_id FROM readingclub_post WHERE customer_id = '". (int)$this->customer->getId() ."' AND group_id = '" . $group_id. "'  ORDER BY date_added DESC");

	    foreach($query->rows as $result)
	     {
		 $post_id[$result['post_id']] = $this->getClubpost($result['post_id']);
	     }

	     return $post_id;
         }

         public function getAllauthors($data = array()){

          $sql = "SELECT * FROM authors_master " ;

		  if (!empty($data['filter_name'])) {
			$sql .= " WHERE author_name LIKE '" . $this->db->escape($data['filter_name']) . "%'";
          }

            if (isset($data['start']) || isset($data['limit'])) {
			if ($data['start'] < 0) {
				$data['start'] = 0;
			}

			if ($data['limit'] < 1) {
				$data['limit'] = 20;
			}

			$sql .= " LIMIT " . (int)$data['start'] . "," . (int)$data['limit'];
	    	}

            $query = $this->db->query($sql);

		   return $query->rows;

            
		     }


        public function getAllpublishers($data = array()){

           $sql = "SELECT * FROM publishers_master " ;

		  if (!empty($data['publisher_name'])) {
			$sql .= " WHERE publisher_name LIKE '" . $this->db->escape($data['publisher_name']) . "%'";
          }

            if (isset($data['start']) || isset($data['limit'])) {
			if ($data['start'] < 0) {
				$data['start'] = 0;
			}

			if ($data['limit'] < 1) {
				$data['limit'] = 20;
			}

			$sql .= " LIMIT " . (int)$data['start'] . "," . (int)$data['limit'];
	    	}

            $query = $this->db->query($sql);

		   return $query->rows;

            
		     }     



          public function getAllemail($data = array()){

          $sql = "SELECT * FROM oc_customer " ;

		  if (!empty($data['filter_email'])) {
			$sql .= " WHERE email LIKE '" . $this->db->escape($data['filter_email']) . "%'";
          }

            if (isset($data['start']) || isset($data['limit'])) {
			if ($data['start'] < 0) {
				$data['start'] = 0;
			}

			if ($data['limit'] < 1) {
				$data['limit'] = 20;
			}

			$sql .= " LIMIT " . (int)$data['start'] . "," . (int)$data['limit'];
	    	}

            $query = $this->db->query($sql);

		   return $query->rows;

            
		     }

             public function acceptinvite($group_id){

              $this->db->query("UPDATE  addinvite SET  status = 'member' WHERE group_id = '" . $group_id. "'");
      
             }
        }