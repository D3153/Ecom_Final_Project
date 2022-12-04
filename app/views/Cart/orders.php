<html>
<head>
  <title><?= _("Order History")?></title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>
<style>
  body{
    background-color: lightpink;
  }
</style>
</head>
<body>
<header>
      <nav class="navbar navbar-expand-lg navbar-dark d-none d-lg-block" style="z-index: 2000;">
        <div class="container-fluid">
          <a class="navbar-brand nav-link" href="/User/home"><strong><?= _("Pink Bakery")?></strong></a>
            <div class="collapse navbar-collapse" id="navbarExample01">
              <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                   <li class="nav-item">
                      <a class="nav-link" href="/Product/shopAll"><?= _("Shop All")?></a>
                    </li>
                      <div class="dropdown">
                        <a class="nav-link" data-bs-toggle="dropdown"><?= _("Shop By Category")?></a>
                        <div class="dropdown-menu">
                          <a href="/Product/bread" class="dropdown-item"><?= _("Bread")?></a>
                          <a href="/Product/cookies" class="dropdown-item"><?= _("Cookies")?></a>
                          <a href="/Product/pies" class="dropdown-item"><?= _("Pies")?></a>
                          <a href="/Product/pastries" class="dropdown-item"><?= _("Pastries")?></a>
                          <a href="/Product/cakes" class="dropdown-item"><?= _("Cakes")?></a>
                      </div>
                    </div>
                    <li class="nav-item">
                      <a class="nav-link" href="/Product/customizeCake"><?= _("Customize Cake")?></a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" href="/User/contactUs"><?= _("Contact Us")?></a>
                    </li>	
                    <li class="nav-item">
                      <a class="nav-link" href="/User/myAccount"><?= _("My Account")?></a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" href="/Cart/cart"><?= _("Shopping Cart")?></a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" href="/User/logout" id="logout"><?= _("Logout")?></a>
                    </li>
                    <div class="dropdown">
                        <a class="nav-link" data-bs-toggle="dropdown"><?= _("Language")?></a>
                        <div class="dropdown-menu">
                          <a href="/?lang=en_CA" class="dropdown-item"><?= _("English")?></a>
                         <a href="/?lang=fr_CA" class="dropdown-item">Français</a>
                      </div>
                    </div>  
              </ul>
            </div>
        </div>
      </nav>
    </header>

  <div class="container">
<div class="row flex-lg-nowrap">
  <div class="col-12 col-lg-auto mb-3" style="width: 250px;">
    <div class="card p-3">
      <div class="e-navlist e-navlist--active-bg">
        <ul class="nav">
          <li class="nav-item"><a class="nav-link px-2" href="/User/messages" ><i class="fa fa-commenting-o" ></i><span> <?= _("View Messages")?></span></a></li>
          <li class="nav-item"><a class="nav-link px-2" href="/Cart/orders" ><i class="fa fa-shopping-bag"></i><span><?= _("Order History")?></span></a></li>
        </ul>
      </div>
    </div>
  </div>

  <div class="col" style="width:800px">
    <div class="row">
      <div class="col mb-3">
        <div class="card">
          <div class="card-body">
            <div class="e-profile">
              <div class="row">
        <div class="col-12 col-md-9 col-lg-7 col-xl-6" >
          <div class="card " style="border-radius: 20px; width: 1000px;">
            <div class="card-body p-5">
              <h1><center><?= _("Order History")?></center></h1>
                <form action='' enctype="multipart/form-data" method='post'>
                  <br>
                    <h2 class='text-center mb-5'><?= _("Paid Items")?></h2>
                              <div class='form-outline mb-4'>
                                <table width="100%" border="1" cellpadding="5" cellspacing="5">
                                <tr><th><?= _("Name")?></th><th><?= _("Image")?></th><th><?= _("Quantity")?></th><th><?= _("Price")?></th></tr>
                               
                  <?php 

                      foreach ($data ['order_history'] as $order_history) {
                        if($order_history->status == 'paid'){
                            echo "
                                    <tr>
                                          <td type=name id='prName'>$order_history->name</td>
                                          <td> <img src='/images/".$order_history->image."'style='max-width:200px;max-height:100px'/></td>
                                          <td type=name>$order_history->quantity</td>
                                          <td type=name>$order_history->unit_price</td>
                                          </td>
                                          </tr>

                                         ";
                           }
                           
                      }

                    ?>
                    </table>

                  
                               
                  <?php 
                      if(count($data['paidCakes']) >0){
                     echo"<table width= '100%' border='1' cellpadding='5' cellspacing='5'>
                                <tr><th>Image</th><th>Description</th><th>Layer</th><th>Serving</th><th>Flavor</th><th>Price</th></tr>";      
                      foreach ($data['paidCakes'] as $cakeOrder) {
                        if($cakeOrder->status=='paid'){
                            echo "
                                    <tr>
                                           <td> <img src='/images/".$cakeOrder->cake_image."'style='max-width:200px;max-height:100px'/></td>
                                          <td type=name>$cakeOrder->description</td>
                                          <td type=name>$cakeOrder->layer</td>
                                          <td type=name>$cakeOrder->serving</td>
                                          <td type=name>$cakeOrder->flavor</td>
                                          <td type=name>$cakeOrder->price</td>
                                          </tr>

                                         ";
                           }
                           
                      }
                    }

                    ?>
                    </table>

                    <br>

                    <h2 class='text-center mb-5'><?= _("Shipped Items")?></h2>
                              <div class='form-outline mb-4'>
                                <table width="100%" border="1" cellpadding="5" cellspacing="5">
                                <tr><th><?= _("Name")?></th><th><?= _("Image")?></th><th><?= _("Quantity")?></th><th><?= _("Price")?></th><th> </th><th> </th></tr>

                               
                  <?php 

                      foreach ($data['order_history'] as $order_history) {
                        if($order_history->status == 'shipped'){
                            echo "
                                    <tr>
                                          <td type=name id='prName'>$order_history->name</td>
                                          <td> <img src='/images/".$order_history->image."'style='max-width:200px;max-height:100px'/></td>
                                          <td type=name>$order_history->quantity</td>
                                          <td type=name>$order_history->unit_price</td>
                                           <td type=action>
                                            <button class='btn btn-primary  '><a class='nav-link' href='/Shipping/trackingforUser/$order_history->cart_id'>Tracking</a></button>
                                            </td>
                                            <td type=action>
                                            <button class='btn btn-success'><a class='nav-link' href='/Feedback/leaveFeedback/$order_history->cart_id'>Comment</a></button>
                                            </td>
                                          </tr>

                                         ";
                           }
                           
                      }

                    ?>
                    
                    
                  </table>
                  <?php 
                      if(count($data['shippedCakes']) >0){
                     echo"<table width= '100%' border='1' cellpadding='5' cellspacing='5'>
                                <tr><th>Image</th><th>Description</th><th>Layer</th><th>Serving</th><th>Flavor</th><th>Price</th><th></th></tr>";      

                      foreach ($data['shippedCakes'] as $cakeOrder) {
                        if($cakeOrder->status=='shipped'){
                            echo "
                                    <tr>
                                           <td> <img src='/images/".$cakeOrder->cake_image."'style='max-width:200px;max-height:100px'/></td>
                                          <td type=name>$cakeOrder->description</td>
                                          <td type=name>$cakeOrder->layer</td>
                                          <td type=name>$cakeOrder->serving</td>
                                          <td type=name>$cakeOrder->flavor</td>
                                          <td type=name>$cakeOrder->price</td>
                                          <td type=action>
                                            <button class='btn btn-primary'><a class='nav-link' href='/Shipping/trackingforUser/$cakeOrder->cart_id'>Tracking</a></button>
                                            </td>
                                          <td type=action>
                                            <button class='btn btn-success'><a class='nav-link' href='/Feedback/leaveFeedback/$cakeOrder->cart_id'>Comment</a></button>
                                            </td>
                                          </tr>

                                         ";
                           }
                           
                      }
                    }

                    ?>
                    </table>
                </div>
              
                </div>
              </form>

            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

</body>
</html>