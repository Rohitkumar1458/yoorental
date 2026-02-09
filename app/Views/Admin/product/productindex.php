<?=$this->extend("admin/_layouts/master") ?>
<?=$this->section("content") ?>
    <div class="content-wrapper">
        <div class="card">
            <div class="card-header">
                <div class="d-flex justify-content-between">
                    <h4>Product List</h4>
                    <a href="<?=base_url('admin/product-cu')?>" class="btn btn-primary">Add Product</a>
                </div>
                <?php if(session()->getFlashdata('message')){ ?>
                <div class="alert alert-<?=session()->getFlashdata('type')?>">
                    <?=session()->getFlashdata('message')?>
                </div>
                <?php } ?>
            </div>
            <div class="table-responsive">
            <table class="table table-bordered">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Photo</th>
                    <th>Product Name</th>
                    <th>Unit</th>
                    <th>Measure</th>
                    <th>Price</th>
                    <th>Is Front</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php if(!empty($products)){
                $n = 1;
                foreach($products as $list){ 
                $status = '<span class="badge badge-danger bg-danger text-light">Inactive</span>';
                if($list->status){
                    $status = '<span class="badge badge-opacity-success">Active</span>';
                }
                $isFront = '<span class="badge badge-danger bg-danger text-light">No</span>';
                if($list->is_front){
                    $isFront = '<span class="badge badge-opacity-success">Yes</span>';
                }
                ?>
                
                <tr>
                    <td><?=$n++;?></td>
                    <td><img src="<?=base_url('public/assets/upload/images/'.$list->image)?>" alt="image" width="100px" height="100px"></td>
                    <td><?=$list->product_name?></td>
                    <td><?=$list->unit?></td>
                    <td><?=$list->measur?></td>
                    <td><?=$list->price?></td>
                    <td><?=$isFront?></td>
                    <td><?=$status?></td>
                    <td>
                        <a href="<?=base_url('admin/view_user/'.$list->pro_id)?>" class="btn btn-primary btn-sm">View</a>
                        <a href="<?=base_url('admin/product-cu/'.$list->pro_id)?>" class="btn btn-info btn-sm">Edit</a>
                        <a href="<?=base_url('admin/delete_user/'.$list->pro_id)?>" class="btn btn-danger btn-sm">Delete</a>
                    </td>
                </tr>
                <?php } }else{
                    echo '<tr><td colspan="9" class="text-danger text-center">No record available</td></tr>';
                } ?>
            </tbody>
            </table>
            </div>
        </div>    
        
    </div>

<?=$this->endSection()?>