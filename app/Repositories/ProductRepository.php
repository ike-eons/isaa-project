<?php

    namespace App\Repositories;

    use App\Models\Product;
    use App\Contracts\ProductContract;
    use App\Traits\UploadAble;
    use Illuminate\Http\UploadedFile;
    use Illuminate\Database\QueryException;
    use Illuminate\Database\Eloquent\ModelNotFoundException;
    use Doctrine\Instantiator\Exception\InvalidArgumentException;

    class ProductRepository extends BaseRepository implements ProductContract
    {
        
        public function __construct(Product $model)
        {
            parent::__construct($model);
            $this->model = $model;
        }       

        public function listProducts( string $order = 'id', string $sort = 'desc', array $columns = ['*'])
         {
            return $this->all($columns, $order, $sort);
         }
    
        public function findProductById(int $id)
        {
            try {
                return $this->findOneOrFail($id);

            } catch (ModelNotFoundException $e) {

                throw new ModelNotFoundException($e);
            }
        }

        public function createProduct(array $params)
        {
           try {
           
                $product = new Product($params);

                $product->save();

                return $product;

            } catch (QueryException $exception) {

                throw new InvalidArgumentException($exception->getMessage());
            
            }
        }

        public function updateProduct(array $params)
        {
            $product = $this->findProductById($params['id']);

            $product->update($params);

            return $product;

        }

        public function deleteProduct($id)
        {
            $product = $this->findProductById($id);
            
            $product->delete();

            return $product;
        }
    }