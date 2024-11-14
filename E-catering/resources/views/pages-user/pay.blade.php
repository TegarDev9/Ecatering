@extends('layouts.topbar')

 @section('content')
 <!-- breadcrumb -->
 <div class="container py-4 flex items-center gap-3">
     <span class="text-sm text-gray-400">
         <i class="fas fa-chevron-right"></i>
     </span>
     <p class="text-gray-600 font-medium">Checkout</p>
 </div>
 <!-- ./breadcrumb -->
 
 <!-- wrapper -->

 

 <div class="container">  
                    <!-- Replace "test" with your own sandbox Business account app client ID -->
                    <script src="https://www.paypal.com/sdk/js?client-id=Ad59Seev0o9FLVtKeIpk57cwzfoq4muwnHGuH5SMsl0sZO-tP277HSxJp4QUoaKpSyjqZIO4ijO46Tmk&currency=USD"></script>
                    <!-- Set up a container element for the button -->
                    <div id="paypal-button-container"></div>
                    <script>
                        paypal.Buttons({
                        // Sets up the transaction when a payment button is clicked
                        createOrder: (data, actions) => {
                            return actions.order.create({
                            purchase_units: [{
                                amount: {
                                value: '{{section::get('price')}}'
                                }
                            }]
                            });
                        },
                        // Finalize the transaction after payer approval
                        onApprove: (data, actions) => {
                            return actions.order.capture().then(function(orderData) {
                          
                             window.location.href='http://127.0.0.1:8000/pesanan';
                            });
                        }
                        }).render('#paypal-button-container');
                    </script>
                  
                </div>
            </div>
        </div>
 
 </form>
 </div>
 <!-- ./wrapper -->
 
 @endsection