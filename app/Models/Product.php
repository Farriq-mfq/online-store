<?php

namespace App\Models;

use CodeIgniter\Model;

class Product extends Model
{
    use \Tatter\Relations\Traits\ModelTrait;
    protected $DBGroup          = 'default';
    protected $table            = 'products';
    protected $primaryKey       = 'product_id';
    protected $useAutoIncrement = true;
    protected $insertID         = 0;
    protected $returnType       = 'object';
    protected $useSoftDeletes   = true;
    protected $protectFields    = true;
    protected $allowedFields    = ["title", "slug", "short_description", "description", "category_id", "content", "price", "weight", "featured", "new_label", "status", "brand_id", "stock", "sku"];
    protected $with = ["brands", "categories", "product_images", "product_discount"];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    // Validation
    protected $validationRules      = [];
    protected $validationMessages   = [];
    protected $skipValidation       = false;
    protected $cleanValidationRules = true;

    // Callbacks
    protected $allowCallbacks = true;
    protected $beforeInsert   = [];
    protected $afterInsert    = [];
    protected $beforeUpdate   = [];
    protected $afterUpdate    = [];
    protected $beforeFind     = [];
    protected $afterFind      = [];
    protected $beforeDelete   = [];
    protected $afterDelete    = [];


    public function addNew(array $data)
    {
        try {
            $productData = pick($data, ["title", "slug", "short_description", "description", "category_id", "content", "price", "weight", "featured", "new_label", "status", "brand_id", "stock", "sku"]);
            $insert = $this->insert($productData);
            $productTags = batch_convert(pick($data, ['tag_id']), ["product_id" => $insert]);
            $productTagsBuilder = $this->db->table("product_tags");
            $productTagsBuilder->insertBatch($productTags);
            $productImagesBuilder = $this->db->table("product_images");
            $productImage = array_merge(pick($data, ["product_image"])["product_image"], ["product_id" => $insert]);
            $productImagesBuilder->insert($productImage);
            return true;
        } catch (\Exception $e) {
            dd($e);
            return false;
        }
    }
    public function update_product(int $id, array $data)
    {
        try {
            $productBuilder = $this->db->table($this->table);
            $productData = pick($data, ["title", "slug", "short_description", "description", "category_id", "content", "price", "weight", "featured", "new_label", "status", "brand_id"]);
            $productBuilder->where("product_id", $id);
            $productBuilder->update($productData);
            return true;
        } catch (\Exception $e) {
            return false;
        }
    }
    public function active_inactive($id): bool
    {
        try {
            if ($this->find($id)->status) {
                $this->update($id, ['status' => false]);
            } else {
                $this->update($id, ['status' => true]);
            }
            return true;
        } catch (\Exception $e) {
            return false;
        }
    }
    public function featured_unfeatured($id): bool
    {
        try {
            if ($this->find($id)->featured) {
                $this->update($id, ['featured' => false]);
            } else {
                $this->update($id, ['featured' => true]);
            }
            return true;
        } catch (\Exception $e) {
            return false;
        }
    }
    public function new_label_remove_label($id): bool
    {
        try {
            if ($this->find($id)->new_label) {
                $this->update($id, ['new_label' => false]);
            } else {
                $this->update($id, ['new_label' => true]);
            }
            return true;
        } catch (\Exception $e) {
            return false;
        }
    }
    public function get_brand_a_z($perpage, $group, $q = "", $ct = "")
    {
        if (!empty($q)) {
            return $this->join("brands", "products.brand_id=brands.brand_id")->with("product_reviews")->select("*,brands.brand as 'brand_name'")->like("title", "" . $q . "")->orderBy("brand_name", "ASC")->paginate($perpage, $group);
        } else if (!empty($ct)) {
            return $this->join("brands", "products.brand_id=brands.brand_id")->with("product_reviews")->select("*,brands.brand as 'brand_name'")->where("category_id", $ct)->orderBy("brand_name", "ASC")->paginate($perpage, $group);
        } else {
            return $this->join("brands", "products.brand_id=brands.brand_id")->with("product_reviews")->select("*,brands.brand as 'brand_name'")->orderBy("brand_name", "ASC")->paginate($perpage, $group);
        }
    }
    public function get_brand_z_a($perpage, $group, $q = "", $ct = "")
    {
        if (!empty($q)) {
            return $this->join("brands", "products.brand_id=brands.brand_id")->with("product_reviews")->select("*,brands.brand as 'brand_name'")->like("title", "" . $q . "")->orderBy("brand_name", "DESC")->paginate($perpage, $group);
        } else if (!empty($ct)) {
            return $this->join("brands", "products.brand_id=brands.brand_id")->with("product_reviews")->select("*,brands.brand as 'brand_name'")->where("category_id", $ct)->orderBy("brand_name", "DESC")->paginate($perpage, $group);
        } else {
            return $this->join("brands", "products.brand_id=brands.brand_id")->with("product_reviews")->select("*,brands.brand as 'brand_name'")->orderBy("brand_name", "DESC")->paginate($perpage, $group);
        }
    }
    public function getratingHigh($perpage, $group, $q = "", $ct = "")
    {
        if (!empty($q)) {
            return $this->join("product_reviews", "product_reviews.product_id=products.product_id")->with("product_reviews")->select("products.*,AVG(product_reviews.rating) as 'avg_rating'")->like("title", "" . $q . "")->groupBy("product_reviews.product_id")->where("status", 1)->orderBy("avg_rating", "DESC")->paginate($perpage, $group);
        } else if (!empty($ct)) {
            return $this->join("product_reviews", "product_reviews.product_id=products.product_id")->with("product_reviews")->select("products.*,AVG(product_reviews.rating) as 'avg_rating'")->where("category_id", $ct)->where("status", 1)->groupBy("product_reviews.product_id")->orderBy("avg_rating", "DESC")->paginate($perpage, $group);
        } else {
            return $this->join("product_reviews", "product_reviews.product_id=products.product_id")->with("product_reviews")->select("products.*,AVG(product_reviews.rating) as 'avg_rating'")->groupBy("product_reviews.product_id")->where("status", 1)->orderBy("avg_rating", "DESC")->paginate($perpage, $group);
        }
    }
    public function getratinglow($perpage, $group, $q = "", $ct = "")
    {
        if (!empty($q)) {
            return $this->join("product_reviews", "product_reviews.product_id=products.product_id")->with("product_reviews")->select("products.*,AVG(product_reviews.rating) as 'avg_rating'")->like("title", "" . $q . "")->groupBy("product_reviews.product_id")->where("status", 1)->orderBy("avg_rating", "ASC")->paginate($perpage, $group);
        } else if (!empty($ct)) {
            return $this->join("product_reviews", "product_reviews.product_id=products.product_id")->with("product_reviews")->select("products.*,AVG(product_reviews.rating) as 'avg_rating'")->where("category_id", $ct)->where("status", 1)->groupBy("product_reviews.product_id")->orderBy("avg_rating", "ASC")->paginate($perpage, $group);
        } else {
            return $this->join("product_reviews", "product_reviews.product_id=products.product_id")->with("product_reviews")->select("products.*,AVG(product_reviews.rating) as 'avg_rating'")->groupBy("product_reviews.product_id")->where("status", 1)->orderBy("avg_rating", "ASC")->paginate($perpage, $group);
        }
    }

    public function getTagsProduct($idProduct)
    {
        return $this->where("status", 1)->without(['brands', "categories", "product_discount", "product_images"])->where('products.product_id', $idProduct)->select("products.product_id,products.status,product_tags.tag_id,tags.tag")->join("product_tags", "product_tags.product_id=products.product_id")->join("tags", "product_tags.tag_id=tags.tag_id")->findAll();
    }

    public function getreviews($idProduct)
    {
        return $this->where("status", 1)->without(['brands', "categories", "product_discount", "product_images"])->where('products.product_id', $idProduct)->select("products.product_id,products.status,product_reviews.rating,users.name,product_reviews.review,product_reviews.created_at")->join("product_reviews", "product_reviews.product_id=products.product_id")->join("users", "product_reviews.user_id=users.user_id")->findAll();
    }

    public function getProductRelated($productId)
    {
        $product = $this->with("product_tags")->find($productId);
        $tags = [];
        foreach ($product->product_tags as $tag) {
            $tags[] = $tag->tag_id;
        }
        if (count($tags)) {
            $related =  $this->where('status', 1)->join("product_tags", "product_tags.product_id=products.product_id")->whereIn("product_tags.tag_id", $tags)->where("products.product_id!=", $product->product_id)->groupBy('product_tags.tag_id')->findAll();
            return $related;
        } else {
            return [];
        }
    }
    public function getProductintersed()
    {
        $carts = $this->db->table('session_cart')->select("product_id")->where('user_id', auth_user_id())->get()->getResultObject();
        $categories = [];
        $brands = [];
        $pid =[];
        foreach ($carts as $cart) {
            $product = $this->find($cart->product_id);
            $pid []= $cart->product_id;
            $categories[]=$product->category_id;
            $brands[]=$product->brand_id;
        }
        if(count($categories) && count($brands)){
            return $this->whereNotIn("product_id",$pid)->whereIn("category_id",$categories)->orWhereIn('brand_id',$brands)->findAll() ;
        }else{
            return [];
        }
    }
}
