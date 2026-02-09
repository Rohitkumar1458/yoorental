<?=$this->extend("admin/_layouts/master") ?>
<?=$this->section("content") ?>
    <div class="content-wrapper">
        <div class="card">
            <div class="card-header">
                <div class="d-flex justify-content-between">
                    <h4>User List</h4>
                    <a href="<?=base_url('admin/add_user')?>" class="btn btn-primary">Add User</a>
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
                    <th>Name</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php if(!empty($users)){
                $n = 1;
                foreach($users as $list){ 
                $status = '<span class="badge badge-opacity-danger">Inactive</span>';
                if($list->status){
                    $status = '<span class="badge badge-opacity-success">Active</span>';
                }
                ?>
                
                <tr>
                    <td><?=$n++;?></td>
                    <td><img src="<?=base_url('public/assets/upload/users/'.$list->image)?>" alt="image" width="60px" height="60px"></td>
                    <td><?=$list->name?></td>
                    <td><?=$list->email?></td>
                    <td><?=$list->phone?></td>
                    <td><?=$status?></td>
                    <td>
                        <a href="<?=base_url('admin/view_user/'.$list->user_id)?>" class="btn btn-primary btn-sm">View</a>
                        <a href="<?=base_url('admin/edit_user/'.$list->user_id)?>" class="btn btn-info btn-sm">Edit</a>
                        <a href="<?=base_url('admin/delete_user/'.$list->user_id)?>" class="btn btn-danger btn-sm">Delete</a>
                    </td>
                </tr>
                <?php } }else{
                    echo '<tr><td colspan="6" class="text-danger text-center">No record available</td></tr>';
                } ?>
            </tbody>
            </table>
            </div>
        </div>    
        
    </div>

<?=$this->endSection()?>