<?php
use yii\helpers\Url;

$pendingBooking = Yii::$app->session->get('pending_booking');
$pendingBookingJson = $pendingBooking ? json_encode($pendingBooking) : 'null';
// Clear session after reading to prevent stale data
if($pendingBooking) Yii::$app->session->remove('pending_booking');

$this->title = 'Book Tickets - Happy Valley';
?>

<!-- Injected Styles from Homepage Ticket Design -->
<style type="text/css">
  .ticket-card-container {
      padding: 40px 0;
      background: #f3f3f4; /* Light bg to make card pop */
      min-height: 80vh;
  }
  
  .ticket-card {
    border-radius: 15px;
    box-shadow: 0 0 10px #00000033; /* Slightly softer shadow than raw #000 */
    padding: 30px 15px;
    background: #fff;
    max-width: 800px;
    margin: 0 auto;
  }

  .ticket-title {
    font-weight: 700;
    font-size: 28px;
    display: block;
    width: 100%;
    text-align: center;
    color: #BE151C;
    margin-bottom: 25px;
  }

  .ticket-form .form-group {
      margin-bottom: 15px;
  }

  .ticket-form .form-control {
    height: 50px;
    padding: 12px 18px;
    box-shadow: 0 0 8px #cccccc80;
    background: #fff;
    border: 1px solid #e5e6e7;
    border-radius: 4px;
    font-size: 16px; /* Large text for mobile */
  }
  
  /* Touch friendly adjustments */
  .ticket-form .form-control:focus {
    border-color: #BE151C;
    outline: none;
    box-shadow: 0 0 8px rgba(190, 21, 28, 0.3);
  }

  /* Button Styling */
  .btn-ticket-submit {
    display: block;
    width: 100%; /* Full width as requested */
    padding: 12px 25px;
    background: #BE151C;
    border-color: #BE151C;
    color: #fff;
    font-size: 20px;
    line-height: 1.5;
    border-radius: 8px; /* Requested corner radius */
    transition: all 0.3s;
    font-weight: 600;
  }

  .btn-ticket-submit:hover,
  .btn-ticket-submit:focus {
    color: #fff;
    background: #a01217;
    border-color: #a01217;
    box-shadow: 0 4px 12px rgba(190, 21, 28, 0.4);
  }
  
  .btn-ticket-submit:disabled {
      background: #ccc;
      border-color: #ccc;
      cursor: not-allowed;
  }

  /* Spacing */
  .row.custom-spacing > [class*='col-'] {
      padding-right: 12px;
      padding-left: 12px;
  }
  
  /* Readonly field styling override to match design look but indicate status */
  .form-control[readonly] {
      background-color: #f8f9fa;
      opacity: 1;
  }
  
  /* Input group adjustments for +/- buttons if used */
  .input-group-custom {
      display: flex;
      align-items: center;
  }
  .input-group-custom .btn {
      height: 50px;
      border-radius: 4px;
      border: 1px solid #e5e6e7;
      background: #f3f3f4;
  }
  .input-group-custom .form-control {
      text-align: center;
      margin: 0 -1px;
      z-index: 2;
  }

  /* Header override */
  .back-link {
      position: absolute;
      left: 20px;
      top: 20px;
      color: #666;
      font-size: 14px;
      text-decoration: none;
  }
  .back-link:hover { text-decoration: underline; color: #BE151C; }

</style>

<div class="ticket-card-container">
    <div class="container">
        
        <div class="ticket-card">
            <div style="position:relative;">
                 <a href="<?= Url::to(['client/dashboard']) ?>" class="back-link"><i class="fa fa-arrow-left"></i> My Tickets</a>
                 <h5 class="ticket-title">Book Tickets</h5>
            </div>

            <form id="bookingForm" class="ticket-form">
                <div class="row custom-spacing">
                    
                    <!-- Name -->
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label class="d-none">Name</label> <!-- Hidden label for cleaner look if mimicking modal -->
                             <input type="text" class="form-control" name="name" placeholder="Name" required>
                        </div>
                    </div>
                    
                    <!-- Email -->
                    <div class="col-lg-6">
                        <div class="form-group">
                            <input type="email" class="form-control" name="email" placeholder="Email" required>
                        </div>
                    </div>

                    <!-- Phone -->
                    <div class="col-lg-6">
                        <div class="form-group">
                             <!-- Using verified placeholder logic -->
                             <input type="text" class="form-control" id="userPhoneDisplay" placeholder="Phone" readonly>
                        </div>
                    </div>

                    <!-- Date -->
                    <div class="col-lg-6">
                        <div class="form-group">
                            <input type="text" class="form-control" name="date" id="dateInput" placeholder="Date" onfocus="(this.type='date')" onblur="(this.type='text')" min="<?= date('Y-m-d', strtotime('+1 day')) ?>" required>
                        </div>
                    </div>

                    <!-- Product Type (Ticket Type) - Dynamic Dropdown -->
                     <div class="col-lg-12">
                        <div class="form-group">
                            <select class="form-control" name="product" id="productSelect" style="height: 50px;">
                                <?php
                                $pricing = \app\models\Pricing::find()->all();
                                foreach ($pricing as $p) {
                                    $mode = ($p->product_code == 8 || $p->product_code == 9) ? 'water' : 'normal';
                                    $priceHtml = ($mode == 'normal') ? " (₹{$p->price})" : "";
                                    
                                    echo "<option value='{$p->product_code}' 
                                            data-mode='{$mode}' 
                                            data-price='{$p->price}' 
                                            data-price-baby='{$p->price_child}' 
                                            data-price-adult='{$p->price}'
                                          >
                                            {$p->name}{$priceHtml}
                                          </option>";
                                }
                                ?>
                            </select>
                        </div>
                    </div>

                    <!-- Dynamic Inputs Section -->
                    
                    <!-- Normal Inputs -->
                    <div class="col-lg-6 normal-inputs">
                         <div class="form-group">
                            <input type="number" class="form-control" id="units" name="unit" value="1" min="1" placeholder="No. of Tickets" onchange="calculateTotal()" onkeyup="calculateTotal()">
                         </div>
                    </div>
                    
                    <!-- Water World Inputs (Hidden by default) -->
                    <div class="col-lg-6 water-inputs" style="display:none;">
                         <div class="form-group">
                              <input type="number" class="form-control" id="belowtenyears" name="belowtenyears" value="0" min="0" placeholder="Below 10 Years" onchange="calculateTotal()" onkeyup="calculateTotal()">
                              <small class="text-muted" id="labelBelow10">Below 10 Years</small>
                         </div>
                    </div>
                     <div class="col-lg-6 water-inputs" style="display:none;">
                         <div class="form-group">
                              <input type="number" class="form-control" id="abovetenyears" name="abovetenyears" value="1" min="0" placeholder="Above 10 Years" onchange="calculateTotal()" onkeyup="calculateTotal()">
                               <small class="text-muted" id="labelAbove10">Above 10 Years</small>
                         </div>
                    </div>

                    <!-- Amount -->
                    <div class="col-lg-6">
                        <div class="form-group">
                            <input type="text" id="amountDisplay" class="form-control" placeholder="Amount" readonly>
                        </div>
                    </div>

                    <!-- Wallet Option -->
                    <div class="col-lg-12" id="wallet-section" style="display:none;">
                        <div class="form-group bg-light p-3 rounded border">
                            <div class="custom-control custom-checkbox d-flex align-items-center justify-content-between">
                                <div>
                                    <input type="checkbox" class="custom-control-input" id="useWallet" name="use_wallet" value="1" onchange="calculateTotal()">
                                    <label class="custom-control-label fw-bold mb-0" for="useWallet">Use Wallet Balance</label>
                                    <small class="d-block text-muted">Available: <span class="text-success fw-bold">₹<span id="walletBal">0.00</span></span></small>
                                </div>
                                <div class="text-end">
                                    <span class="d-block text-muted small">Wallet Deduction</span>
                                    <span class="fw-bold text-danger">-₹<span id="walletDeduct">0.00</span></span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Final Payable -->
                    <div class="col-lg-12 mt-2">
                        <div class="d-flex justify-content-between align-items-center p-3 rounded" style="background: #f8f9fa; border: 1px dashed #ccc;">
                            <span class="fs-5 fw-bold text-muted">Payable Amount</span>
                            <span class="fs-3 fw-bold text-primary" id="payableDisplay">₹0.00</span>
                        </div>
                    </div>

                    <!-- Ticket Label Field (To match homepage design) -->
                    <div class="col-lg-12 mt-3">
                        <div class="form-group">
                            <input type="text" value="Ticket" class="form-control" readonly>
                        </div>
                    </div>

                    <!-- Submit Button -->
                    <div class="col-lg-12 mt-3">
                         <button type="submit" class="btn btn-ticket-submit" id="payBtn">Submit</button>
                    </div>

                </div>
            </form>
        </div>
    </div>
</div>

<script>
// Logic preserved but updated for new selectors
function updateLabels() {
    let $opt = $('#productSelect option:selected');
    let mode = $opt.data('mode');
    if (mode === 'water') {
         let priceBaby = parseFloat($opt.data('price-baby'));
         let priceAdult = parseFloat($opt.data('price-adult'));
         $('#labelBelow10').text(`Below 10 Years (₹${priceBaby})`);
         $('#labelAbove10').text(`Above 10 Years (₹${priceAdult})`);
    }
}

    function calculateTotal() {
        let $opt = $('#productSelect option:selected');
        let mode = $opt.data('mode');
        let total = 0;
        
        updateLabels();
    
        if (mode === 'normal') {
            $('.normal-inputs').show();
            $('.water-inputs').hide();
            
            let price = parseFloat($opt.data('price'));
            let units = parseInt($('#units').val()) || 0;
            total = price * units;
            
        } else if (mode === 'water') {
            $('.normal-inputs').hide();
            $('.water-inputs').show();
            
            let priceBaby = parseFloat($opt.data('price-baby'));
            let priceAdult = parseFloat($opt.data('price-adult'));
            let babies = parseInt($('#belowtenyears').val()) || 0;
            let adults = parseInt($('#abovetenyears').val()) || 0;
            total = (priceBaby * babies) + (priceAdult * adults);
        }
        
        $('#amountDisplay').val('₹' + total);
        $('#amountDisplay').data('raw-total', total);

        // Wallet Calculation
        let walletBal = parseFloat($('#walletBal').text()) || 0;
        let useWallet = $('#useWallet').is(':checked');
        let walletDeduct = 0;
        let payable = total;

        if (useWallet && walletBal > 0) {
            if (walletBal >= total) {
                walletDeduct = total;
                payable = 0;
            } else {
                walletDeduct = walletBal;
                payable = total - walletBal;
            }
        }

        $('#walletDeduct').text(walletDeduct.toFixed(2));
        $('#payableDisplay').text('₹' + payable.toFixed(2));
        $('#payableDisplay').data('val', payable);
    }
    
    $(document).ready(function() {
        // Initial State: Verified User Visual
        $('#userPhoneDisplay').val("Verified User");
    
        // Fetch Profile & Wallet
        const token = localStorage.getItem('user_token');
        if(token) {
            $.ajax({
                url: "<?= Url::to(['api-booking/profile']) ?>",
                method: 'GET',
                headers: { 'Authorization': 'Bearer ' + token },
                success: function(res) {
                    if(res.status === 'success' && res.user) {
                        if(res.user.phone) $('#userPhoneDisplay').val(res.user.phone);
                        if(res.user.full_name) $('input[name="name"]').val(res.user.full_name);
                        if(res.user.email_id) {
                            $('input[name="email"]').val(res.user.email_id).prop('readonly', true);
                        }
                        // Wallet
                        let bal = parseFloat(res.user.wallet_balance || 0);
                        if(bal > 0) {
                            $('#walletBal').text(bal.toFixed(2));
                            $('#wallet-section').show();
                        }
                    }
                }
            });
        }
    
        // Handle Pending Data/Params
        const urlParams = new URLSearchParams(window.location.search);
        const preProduct = urlParams.get('product');
        let pendingData = <?= $pendingBookingJson ?>;
        
        if (!pendingData) {
            try {
                const stored = sessionStorage.getItem('pending_booking');
                if (stored) {
                    pendingData = JSON.parse(stored);
                    sessionStorage.removeItem('pending_booking');
                }
            } catch(e) {}
        }
        
        if (pendingData) {
            if(pendingData.product) $('#productSelect').val(pendingData.product).trigger('change');
            if(pendingData.name) $('input[name="name"]').val(pendingData.name);
            if(pendingData.email) $('input[name="email"]').val(pendingData.email);
            if(pendingData.phone) $('#userPhoneDisplay').val(pendingData.phone); 
            if(pendingData.date) $('input[name="date"]').val(pendingData.date);
            
            if(pendingData.units) $('#units').val(pendingData.units);
            if(pendingData.below10) $('#belowtenyears').val(pendingData.below10);
            if(pendingData.above10) $('#abovetenyears').val(pendingData.above10);
            
        } else if(preProduct) {
            $('#productSelect').val(preProduct).trigger('change');
        }
    
        $('#productSelect').change(calculateTotal);
        // Bind inputs
        $('#units, #belowtenyears, #abovetenyears').on('change keyup', calculateTotal);
        calculateTotal(); 
    
        // Form Submission
        $('#bookingForm').submit(function(e) {
            e.preventDefault();
            
            let amount = $('#amountDisplay').data('raw-total');
            if (!amount || amount <= 0) {
                alert("Amount must be greater than 0");
                return;
            }
    
            let $btn = $('#payBtn');
            $btn.prop('disabled', true).text('Processing...');
    
            let formData = {
                name: $('input[name="name"]').val(),
                email: $('input[name="email"]').val(),
                date: $('input[name="date"]').val(), 
                product: $('#productSelect').val(),
                amount: amount,
                unit: $('#units').val(),
                belowtenyears: $('#belowtenyears').val(),
                abovetenyears: $('#abovetenyears').val(),
                use_wallet: $('#useWallet').is(':checked') ? 1 : 0
            };
    
            $.post("<?= Url::to(['api-booking/create']) ?>", formData, function(res) {
                // SUCCESS (Full Wallet Payment)
                if(res.status === 'success') {
                     alert(res.message + "\nTicket #" + res.ticket_no);
                     window.location.href = "<?= Url::to(['client/dashboard']) ?>";
                     return;
                }

                // INITIATED (Partial/Online Payment)
                if(res.status === 'initiated') {
                    var options = {
                        "key": res.key_id,
                        "amount": res.amount * 100, 
                        "currency": "INR",
                        "name": "Happy Valley Park",
                        "description": "Ticket Booking",
                        "order_id": res.order_id, 
                        "handler": function (response){
                            $.post("<?= Url::to(['api-booking/verify']) ?>", {
                                razorpay_payment_id: response.razorpay_payment_id,
                                razorpay_order_id: response.razorpay_order_id,
                                razorpay_signature: response.razorpay_signature,
                                booking_id: res.booking_id
                            }, function(verifyData) {
                                if(verifyData.status === 'success') {
                                    alert("Booking Successful! Ticket #"+verifyData.ticket_no);
                                    window.location.href = "<?= Url::to(['client/dashboard']) ?>";
                                } else {
                                    alert("Payment Verification Failed: " + verifyData.message);
                                }
                            });
                        },
                        "prefill": {
                            "name": res.customer.name,
                            "email": res.customer.email,
                            "contact": res.customer.phone
                        },
                        "theme": { "color": "#BE151C" } 
                    };
                    var rzp1 = new Razorpay(options);
                    rzp1.on('payment.failed', function (response){
                        alert("Payment Failed: " + response.error.description);
                        $btn.prop('disabled', false).text('Submit');
                    });
                    rzp1.open();
                } else {
                    alert("Booking Failed: " + (res.message || 'Unknown error'));
                    $btn.prop('disabled', false).text('Submit');
                }
            }).fail(function() {
                alert("Network Error");
                $btn.prop('disabled', false).text('Submit');
            });
        });
    });
</script>
