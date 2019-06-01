<div class="fixed-top">     
    <nav class="navbar navbar-expand-md nav_bg">
      <a class="navbar-brand" href="<?php echo URLROOT; ?>  ">VINYL</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExample04" aria-controls="navbarsExample04" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"><i class="fas fa-bars fa-1x"></i></span>
      </button>

      <div class="collapse navbar-collapse justify-content-end" id="navbarsExample04">
        <ul class="navbar-nav">                           
          <li class="nav-item">
            <a class="nav-link" href="<?php echo URLROOT; ?>"><span>HOME</span></a>
          </li>         
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false"><span>BOUTIQUE</span></a>
            <div class="dropdown-menu">
              <a class="dropdown-item" href="http://localhost/vinyl/boutique/types?type=LP"><span>LP</span></a>
              <a class="dropdown-item" href="http://localhost/vinyl/boutique/types?type=EP"><span>EP</span></a>
              <a class="dropdown-item" href="http://localhost/vinyl/boutique/types?type=7"><span>7"</span></a>
              <a class="dropdown-item" href="http://localhost/vinyl/boutique/types?type=10"><span>10"</span></a>
              <a class="dropdown-item" href="http://localhost/vinyl/boutique/types?type=12"><span>12"</span></a>
              <a class="dropdown-item" href="http://localhost/vinyl/boutique/types?type=45RPM"><span>45RPM</span></a>
              <a class="dropdown-item" href="http://localhost/vinyl/boutique/types?type=78RPM"><span>78RPM</span></a>
              <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="<?php echo URLROOT; ?>/boutique"><span>BOUTIQUE</span></a>            
            </div>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="http://localhost/vinyl#about"><span>ABOUT</span></a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="http://localhost/vinyl#contact"><span>CONTACT</span></a>
          </li>  
          <?php 
            if (!empty($_SESSION['user'])) {
              ?>
              <?php 
                if ($_SESSION['user']->permission == 'admin') {
                  ?>
                    <li class="nav-item">
                      <a class="nav-link" href="<?php echo URLROOT; ?>/admins/profile"><span><?php echo $_SESSION['user']->username; ?></span></a>
                    </li>
                  <?php
                } else {
                  ?>
                    <li class="nav-item">
                      <a class="nav-link" href="<?php echo URLROOT; ?>/admins/user"><span><?php echo $_SESSION['user']->username; ?></span></a>
                    </li>
                  <?php
                }
              ?>
                <li class="nav-item">
                    <a class="nav-link" href="<?php echo URLROOT; ?>/users/logout"><span>LOGOUT</span></a>
                </li>
              <?php
            } else {
              ?>
                <li class="nav-item dropdown">
                  <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false"><span>ACCOUNT</span></a>
                  <div class="dropdown-menu">
                    <a class="dropdown-item" href="<?php echo URLROOT; ?>/users/login"><span>LOGIN</span></a>
                    <a class="dropdown-item" href="<?php echo URLROOT; ?>/users/register"><span>REGISTER</span></a>                    
                  </div>
                </li>                 
              <?php
            }
          ?>
          <li class="nav-item" id="cart_icon">
            <a class="nav-link" href="#" data-toggle="modal" data-target="#shoppingcart"><span><i class="fas fa-shopping-basket"></i>&nbsp;<var id="cart_count"><?php 
            if (isset($_SESSION['cart_count'])) {
              echo $_SESSION['cart_count'];
            } else {
              echo '0';
            }

             ?></var></span></a>
          </li>         
        </ul>       
      </div>
    </nav>      
        
  </div>
    <div class="modal fade shopping_modal" id="shoppingcart" tabindex="-1" role="dialog" aria-labelledby="shoppingcartTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg shopping_dialog" role="document">
          <div class="modal-content shopping_content">            
            <div class="modal-body shoppingcart_body">
              <div class="row">
                <div class="col shopping_cart">
                  <div class="row">
                    <div class="col-sm-6">
                      <h1><i class="fas fa-shopping-cart">&nbsp;</i>Your cart</h1>
                    </div>
                    <div class="col-sm-6">
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col shopping_cart_table">
                  <table class="table table-hover table-dark table-responsive-sm">
                    <thead>
                      <tr>
                        <th scope="col">#</th>
                        <th scope="col">Item Name</th>
                        <th scope="col">Unit Price</th>
                        <th scope="col">Quantity</th>
                        <th scope="col">Price</th>
                        <th scope="col"></th>
                      </tr>
                    </thead>
                    <tbody id="cart_body">                     
                      <?php
                      if (isset($_SESSION['cart'])) {
                        $counter = 1; 
                        foreach ($_SESSION['cart'] as $value) {
                        ?>
                          <tr>
                            <th scope="row"><?php echo $counter; ?></th>
                            <td><?php echo $value['product_title']; ?></td>
                            <td><?php echo alternative_money($value['unit_price']); ?></td>
                            <td><?php echo $value['quantity']; ?></td>
                            <td><?php echo alternative_money($value['price']); ?></td>
                            <td class="p-3"><button type="button" class="btn btn-dark remove_btn" id="rmv_btn_<?php echo $value['id']; ?>">remove</button></td>
                          </tr>
                        <?php
                         $counter++; 
                        }                        
                      }
                       ?>                                         
                    </tbody>
                    <tfoot id="cart_foot">
                      <tr>
                        <th>Total:</th>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th id="total"><?php if (isset($_SESSION['cart_total'])) {                          
                          echo alternative_money($_SESSION['cart_total']);
                        }
                         ?></th>
                        <th></th>
                      </tr>
                    </tfoot>
                  </table>
                  <a href="http://localhost/vinyl/boutique/checkout"><button type="button" class="btn btn-secondary btn-lg">Checkout</button></a>        
                </div>
              </div>                
            </div>        
          </div>
        </div>
      </div>