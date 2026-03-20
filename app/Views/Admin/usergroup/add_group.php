<?=$this->extend("admin/_layouts/master") ?>
<?=$this->section("content") ?>
<style>
  .form-check .form-check-input {
    margin-left: 5px;
  }

  .form-group {
    margin-bottom: 0.5rem;
  }
</style>
<div class="content-wrapper">
  <div class="page-header">
    <h3 class="page-title">
      <!-- <span class="page-title-icon bg-gradient-primary text-white me-2">
            <i class="mdi mdi-home"></i>
            </span> --> Add Group
    </h3>
    <nav aria-label="breadcrumb">
      <ul class="breadcrumb">
        <li class="breadcrumb-item active" aria-current="page">
          <a href="<?=base_url('admin/user-group')?>" class="btn btn-primary">Back</a>
        </li>
      </ul>
    </nav>
  </div>
  <?php if(session()->getFlashdata('message')){ ?>
  <div class="alert alert-<?=session()->getFlashdata('type')?>">
    <?=session()->getFlashdata('message')?>
  </div>
  <?php } ?>
  <div class="card">
    <div class="card-body">
      <!-- <h4 class="card-title">Basic form elements</h4>
                    <p class="card-description"> Basic form elements </p> -->
      <form class="forms-sample">
        <div class="form-group row">
          <label for="exampleInputUsername2" class="col-sm-2 col-form-label">Group Name</label>
          <div class="col-sm-10">
            <input type="text" class="form-control" id="exampleInputUsername2" placeholder="Username">
          </div>
        </div>
        <div class="form-group row">
          <label for="exampleInputUsername2" class="col-sm-2 col-form-label">Add Privilege</label>
          <div class="col-sm-10">
            <div class="form-check">
              <input type="checkbox" class="form-check-input" name="" id="all">
              <label for="all" class="form-check-label">All Privilege</label>
            </div>
          </div>
        </div>

        <div class="row">

          <div class="offset-md-2 col-md-10">

            <div class=" row">
              <div class="col-md-3">
                <div class="form-check">
                  <input class="form-check-input" type="checkbox" name="flexRadioDefault" id="flexRadioDefault1">
                  <label class="form-check-label" for="flexRadioDefault1">
                    User Group
                  </label>
                </div>
              </div>
              <div class="col-md-9">
                <div class="form-check">
                  <div class="form-check-inline">
                    <input class="form-check-input" type="checkbox" id="inlineCheckbox1" value="option1">
                    <label class="form-check-label" for="inlineCheckbox1">Add</label>
                  </div>
                  <div class="form-check-inline">
                    <input class="form-check-input" type="checkbox" id="inlineCheckbox2" value="option2">
                    <label class="form-check-label" for="inlineCheckbox2">Edit</label>
                  </div>
                  <div class="form-check-inline">
                    <input class="form-check-input" type="checkbox" id="inlineCheckbox3" value="option3">
                    <label class="form-check-label" for="inlineCheckbox3">Delete</label>
                  </div>
                </div>
              </div>
            </div>
            <div class=" row">
              <div class="col-md-3">
                <div class="form-check">
                  <input class="form-check-input" type="checkbox" name="flexRadioDefault" id="flexRadioDefault1">
                  <label class="form-check-label" for="flexRadioDefault1">
                    User Group
                  </label>
                </div>
              </div>
              <div class="col-md-9">
                <div class="form-check">
                  <div class="form-check-inline">
                    <input class="form-check-input" type="checkbox" id="inlineCheckbox1" value="option1">
                    <label class="form-check-label" for="inlineCheckbox1">Add</label>
                  </div>
                  <div class="form-check-inline">
                    <input class="form-check-input" type="checkbox" id="inlineCheckbox2" value="option2">
                    <label class="form-check-label" for="inlineCheckbox2">Edit</label>
                  </div>
                  <div class="form-check-inline">
                    <input class="form-check-input" type="checkbox" id="inlineCheckbox3" value="option3">
                    <label class="form-check-label" for="inlineCheckbox3">Delete</label>
                  </div>
                </div>
              </div>
            </div>

          </div>
        </div>

        <div class="form-group row">
          <label for="exampleInputUsername2" class="col-sm-2 col-form-label">Status</label>
          <div class="col-sm-10">
            <div class="form-check">
              <input class="form-check-input" type="radio" name="exampleRadios" id="exampleRadios1" value="option1"
                checked>
              <label class="form-check-label" for="exampleRadios1">
                Active
              </label>
            </div>
            <div class="form-check">
              <input class="form-check-input" type="radio" name="exampleRadios" id="exampleRadios2" value="option2">
              <label class="form-check-label" for="exampleRadios2">
                Inactive
              </label>
            </div>
          </div>
        </div>

        <button type="submit" class="btn btn-gradient-primary me-2">Submit</button>
        <a href="<?=base_url('admin/user-group') ?>" class="btn btn-light">Cancel</a>
      </form>
    </div>
  </div>

</div>

<?=$this->endSection()?>