<?=$this->extend("admin/_layouts/master") ?>
<?=$this->section("content") ?>
    <div class="content-wrapper">
        <div class="card">
            <div class="card-header">
                <div class="d-flex justify-content-between">
                    <h4>Add Product</h4>
                </div>
            </div>
            <div class="card-body">
                <form action="<?=current_url()?>" method="post" enctype="multipart/form-data">
                    <?=csrf_field(); ?>
                    <div class="row">
                        <div class="col-md-8">
                            <div class="form-group">
                                <label for="">Product Name</label>
                                <input type="text" name="product_name" id="product_name" value="<?=set_value('product_name', $product->product_name ?? '')?>" class="form-control">
                                <span class="text-danger"><?=(isset($validation))?$validation->showError('product_name'):''?></span> 
                            </div>
                            <div class="form-group row">
                                <div class="col-md-10">
                                <label for="">Image</label>
                                <input type="file" name="image" id="image"  class="form-control">
                                <span class="text-danger"><?=(isset($validation))?$validation->showError('image'):''?></span> 
                                </div>
                                <?php if(isset($product)){ ?>
                                <div class="col-md-2">
                                    <img src="<?=base_url('public/assets/upload/images/'.$product->image)?>" alt="image" width="100px" height="100px">
                                </div>
                                <?php } ?>

                            </div>
                            <div class="form-group">
                                <label for="">Price</label>
                                <input type="number" name="price" id="price" value="<?=set_value('price', $product->price ?? '')?>" class="form-control">
                                <span class="text-danger"><?=(isset($validation))?$validation->showError('price'):''?></span> 

                            </div>
                            <div class="form-group">
                                <label for="">Unit</label>
                                <input type="number" name="unit" id="unit" value="<?=set_value('unit', $product->unit ?? '')?>" class="form-control">
                                <span class="text-danger"><?=(isset($validation))?$validation->showError('unit'):''?></span> 

                            </div>
                            <div class="form-group">
                                <label for="">Unit of Measur</label>
                                <select name="measur" id="measur" class="form-control">
                                    <option value="">Select One</option>

                                    <option value="KG" <?=(isset($product) && $product->measur == 'KG')?'selected':''?>>KG</option>
                                    <option value="g" <?=(isset($product) && $product->measur == 'g')?'selected':''?>>Gram</option>
                                    <option value="L" <?=(isset($product) && $product->measur == 'L')?'selected':''?>>Litter</option>
                                </select>
                                <span class="text-danger"><?=(isset($validation))?$validation->showError('measur'):''?></span> 

                            </div>
                            
                            <div class="form-group">
                                <label for="">Status</label>

                                <div class="form-check px-4">
                                    <input class="form-check-input" type="radio" name="status" value="1" id="status" checked>
                                    <label class="form-check-label" for="status">
                                        Active
                                    </label>
                                </div>
                                <div class="form-check px-4">
                                    <input class="form-check-input" type="radio" name="status" value="0" id="status2" <?=(isset($product) && $product->status < 1)?'checked':''?>>
                                    <label class="form-check-label" for="status2">
                                        Inactive
                                    </label>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="">Is Front</label>

                                <div class="form-check px-4">
                                    <input class="form-check-input" type="radio" name="is_front" value="1" id="is_front" checked>
                                    <label class="form-check-label" for="is_front">
                                        Yes
                                    </label>
                                </div>
                                <div class="form-check px-4">
                                    <input class="form-check-input" type="radio" name="is_front" value="0" id="is_front2" <?=(isset($product) && $product->is_front < 1)?'checked':''?>>
                                    <label class="form-check-label" for="is_front2">
                                        No
                                    </label>
                                </div>
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary">Submit</button>
                                <button type="reset" class="btn btn-warning">Reset</button>
                                <a href="<?=base_url('admin/products')?>" class="btn btn-info">Back</a>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>    
        
    </div>

<?=$this->endSection()?>