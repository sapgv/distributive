<?php 
namespace backend\models\ftp;

use common\models\catalogs\Catalogs;
use backend\models\ftp\CatalogsFtp;


class Tree extends CatalogsFtp 
    {

        private $i_count;
        private $a_link;

        public function __construct($a_link) 
        {
            if(!is_array($a_link)) throw new Exception("First parameter should be an array. Instead, it was type '".gettype($a_link)."'");
            $this->i_count = 1;
            $this->a_link= $a_link;
        }

        public function traverse($i_id) 
        {
            $i_lft = $this->i_count;
            $this->i_count++;

            $a_kid = $this->get_children($i_id);
            if ($a_kid) 
            {
                foreach($a_kid as $a_child) 
                {
                    $this->traverse($a_child);
                }
            }
            $i_rgt=$this->i_count;
            $this->i_count++;
            $this->write($i_lft,$i_rgt,$i_id);
        }   

        private function get_children($i_id) 
        {
            return $this->a_link[$i_id];
        }

        private function write($i_lft,$i_rgt,$i_id) 
        {

            // fetch the source column
            $s_query = "SELECT * FROM `catalogs` WHERE `catalog_id`  = '".$i_id."'";
            if (!$i_result = mysql_query($s_query))
            {
                echo "<pre>$s_query</pre>\n";
                throw new Exception(mysql_error());  
            }
            $a_source = array();
            if (mysql_num_rows($i_result))
            {
                $a_source = mysql_fetch_assoc($i_result);
            }

            // root node?  label it unless already labeled in source table
            if (1 == $i_lft && empty($a_source['name']))
            {
                $a_source['name'] = 'ROOT';
                // return;
            }

            $catalog = Catalogs::findOne($i_id);

            if ( is_null($catalog)) {
                // return;
                $catalog = new Catalogs;
                $catalog->detachBehaviors();
                $catalog->name = $a_source['name'];
                $catalog->lft = $i_lft;
                $catalog->rgt = $i_rgt;
                $catalog->save(false);
            }
            else {
                // каталог нашли, обновим индексы
                $catalog->detachBehaviors();
                $catalog->name = $a_source['name'];
                $catalog->lft = $i_lft;
                $catalog->rgt = $i_rgt;
                $catalog->save(false);
            }
          
        }
    }

	
			
		



 ?>