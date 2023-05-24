<?php
require_once '../../Modals/product.php';
require_once '../../Controllers/DbController.php';

class ProductConroller{
    protected $db;

    public function getCategories(){
        $this->db = new DbController();
        
        if($this->db->openconnection()){
            $query="select * from cattegory";
            return $this->db->select($query);
        }
        else{
            echo "ERROR IN DATABASE CONNECTION : ";
        return false;
        }
    }

    public function getAllproductswithimg(){
        $this->db = new DbController();
        if($this->db->openconnection()){
            $query= "select product.id,product.Name,price,quantity,description,cattegory.Name as 'category', image FROM product,cattegory where product.categroyid=cattegory.id;";
            return $this->db->select($query);
        }
        else{
            echo "ERROR IN DATABASE CONNECTION : ";
        return false;
        }
    }
    public function getAllproducts(){
        $this->db = new DbController();
        if($this->db->openconnection()){
            $query= "select product.id,product.Name,price,quantity,cattegory.Name as 'category' FROM product,cattegory where product.categroyid=cattegory.id;";
            return $this->db->select($query);
        }
        else{
            echo "ERROR IN DATABASE CONNECTION : ";
        return false;
        }
    }
    public function addproduct(product $product)
    {
        $this->db = new DbController();
        if($this->db->openconnection())
        {
            $query= "insert into product values ('','$product->name','$product->description','$product->price','$product->image','$product->quantity','$product->categoryId');";
            return $this->db->insert($query);
        }
        else
        {
            echo "ERROR IN DATABASE CONNECTION";
            return false;
        }
    }
    //insert into product values ('','demon soul','ewfws','250','../images/12-18-381.jfif','48','2');

    public function deleteproduct($proid){
        $this->db = new DbController();
        if($this->db->openconnection()){
            $query= "delete from product where id='$proid'";
            return $this->db->delete($query);
        }
        else{
            echo "ERROR IN DATABASE CONNECTION : ";
        return false;
        }
    }
    public function getCategoryProduct($id){
        $this->db = new DbController();
        if($this->db->openconnection()){
            $query= "select product.id,product.Name,price,quantity,description,cattegory.Name as 'category', image FROM product,cattegory where product.categroyid=cattegory.id and cattegory.id=$id;";
            return $this->db->select($query);
        }
        else{
            echo "ERROR IN DATABASE CONNECTION : ";
        return false;
        }
    }

    
}
?>