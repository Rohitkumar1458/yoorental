<?=$this->extend("_layout/master") ?>
<?=$this->section("content") ?>

<div class="container py-5">
  <h2 class="mb-4 text-center">Checkout Page</h2>
  <div class="row g-4">

    <!-- Buyer Details -->
    <div class="col-md-6">
      <div class="card p-4 shadow-sm">
        <h4 class="mb-3">Buyer Details</h4>
        <form action="<?=current_url() ?>" method="post" id="checkoutForm">
          <?=csrf_field()?>
          <div class="mb-3">
            <label for="name" class="form-label">Full Name</label>
            <input type="text" id="name" name="name" value="<?=set_value('name')?>" class="form-control" placeholder="John Doe" required>
          </div>
          <div class="mb-3">
            <label for="email" class="form-label">Email Address</label>
            <input type="email" id="email" name="email" value="<?=set_value('email')?>" class="form-control" placeholder="example@email.com" required>
          </div>
          <div class="mb-3">
            <label for="phone" class="form-label">Phone Number</label>
            <input type="tel" id="phone" name="phone" value="<?=set_value('phone')?>" class="form-control" placeholder="1234567890" required>
          </div>
          <div class="mb-3">
            <label for="address" class="form-label">Shipping Address</label>
            <textarea id="address" name="address" class="form-control" rows="3" placeholder="Your full address..." required></textarea>
          </div>
          <input type="submit" value="submit" name="submit" id="submitForm" style="display:none;">
          
        </form>
      </div>
    </div>

    <!-- Order Summary with Images -->
    <div class="col-md-6">
      <div class="card p-4 shadow-sm">
        <h4 class="mb-3">Order Summary</h4>
        <ul class="list-group mb-3">
          <?php $cartItems = cart()->Contents();
          if(!empty($cartItems)){
          foreach($cartItems as $item){ ?>

          <li class="list-group-item d-flex justify-content-between align-items-center">
            <div class="d-flex align-items-center">
              <img src="<?=base_url('public/assets/upload/images/'.$item['image'])?>" class="me-3 rounded" alt="Product 1" width="50px" height="50px">
              <div>
                <h6 class="mb-0"><?=$item['name']?></h6>
                <small class="text-muted">Rate: <?=$item['price']?></small>
                <small class="text-muted">Qty: <?=$item['qty']?></small>
              </div>
            </div>
            <strong>₹<?=$item['subtotal']?></strong>
          </li>
          <?php } } 
          $shiping = 0;
          $total = cart()->total();
          if($total > 500){
            $shiping = 50;
            $total = $total + $shiping;
          }
          
          ?>
          

          <!-- Shipping -->
          <li class="list-group-item d-flex justify-content-between">
            <span>Shipping</span>
            <strong>₹<?=$shiping?></strong>
          </li>

          <!-- Total -->
          <li class="list-group-item d-flex justify-content-between">
            <strong>Total</strong>
            <strong>₹<?=$total?></strong>
          </li>

        </ul>
        <button class="btn btn-primary w-100" id="place_order">Place Order</button>
      </div>
    </div>

  </div>
</div>

<script>
  $("#place_order").click(function(){
    $("#submitForm").click();
  });
</script>

<?=$this->endSection()?>