<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>eCommerce Page with Cart Counter</title>
  <!-- Bootstrap 5 CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="<?=base_url('public/assets/css/style.css')?>" rel="stylesheet" >
  <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
  
</head>
<body>

  <!-- Navbar -->
  <nav class="navbar navbar-dark bg-dark mb-4">
    <div class="container-fluid d-flex justify-content-between">
      <span class="navbar-brand mb-0 h1">My eCommerce Store</span>
      <div class="cart-icon me-3">
        🛒
        <?php $cartCount = cart()->totalItems(); 
        $href = "javascript:void(0)";
        if($cartCount > 0){
          $href = base_url('/checkout'); 
        }
        ?>

        <a href="<?=$href ?>" id="checkout"><span class="cart-badge" id="cart-count"><?=$cartCount?></span></a>
      </div>
    </div>
  </nav>

 <!-- Product Grid -->
<?php /* <div class="container">
  <div class="row g-4">

    <!-- Product Card 1 -->
    <?php if(!empty($products)){
    foreach($products as $list){ ?>
    <div class="col-sm-6 col-md-4 col-lg-3">
      <div class="card h-100 text-center">
        <a href="<?=base_url('product/'.$list->url)?>" style="text-decoration:none;">
        <img src="<?= base_url('public/assets/upload/images/'.$list->image) ?>"
             class="img-fluid mx-auto d-block mt-3"
             alt="<?=$list->product_name?>"
             style="width: 120px; height: 120px; object-fit: contain;">
        </a>
        <div class="card-body d-flex flex-column">
          <h5 class="card-title"><?=$list->product_name?></h5>
          <p class="card-text text-success fw-bold">₹<?=$list->price?> <small class="text-muted">(<?=$list->unit.$list->measur?>)</small></p>
          <button class="btn btn-warning mt-auto add-to-cart" data-pro_id="<?=$list->pro_id?>">Add to Cart</button>
        </div>
      </div>
    </div>
    <?php } }else{
      echo '<p class="text-danger">Product not available</p>';
    } ?>

    

  </div>
</div> */ ?>

<?= $this->renderSection("content"); ?>



  <!-- Bootstrap JS Bundle -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

  <!-- JavaScript for Cart Count -->
  <script>
    var href = "<?=base_url('/checkout')?>";
    $(".add-to-cart").click(function(){
      var pro_id = $(this).attr('data-pro_id');
      
      // alert(pro_id);
      if(pro_id){
        $.ajax({
          type: 'post',
          url: "<?=base_url('/add_to_cart')?>",
          data: {pro_id: pro_id},
          dataType: 'json',
          success: function(res){
            console.log(res);
            if(res.result == 'success'){
              $("#cart-count").html(res.cartCount);
              $("#checkout").attr("href", href);
            }else{
              alert("Error:");
            }
          }
        });
      }else{
        return false;
      }
    });
  </script>
</body>
</html>
