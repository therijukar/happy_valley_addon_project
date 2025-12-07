<?php
use yii\helpers\Url;

$pendingBooking = Yii::$app->session->get('pending_booking');
$pendingBookingJson = $pendingBooking ? json_encode($pendingBooking) : 'null';
// Clear session after reading to prevent stale data
if($pendingBooking) Yii::$app->session->remove('pending_booking');

$this->title = 'Book Tickets - Happy Valley';
?>

<div class="d-flex justify-content-between align-items-center mb-4">
    <h4>Book Tickets</h4>
    <a href="<?= Url::to(['client/dashboard']) ?>" class="btn btn-outline-secondary btn-sm">My Tickets</a>
</div>

<div class="card shadow-sm">
    <div class="card-body">
        <form id="bookingForm">
            <!-- User Details -->
            <div class="mb-3">
                <label class="form-label">Name</label>
                <input type="text" class="form-control" name="name" placeholder="Enter Full Name" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Email</label>
                <input type="email" class="form-control" name="email" placeholder="Enter Email" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Phone</label>
                <input type="text" class="form-control" value="Verified User" id="userPhoneDisplay" readonly>
            </div>
            <div class="mb-3">
                <label class="form-label">Date</label>
                <input type="date" class="form-control" name="date" value="<?= date('Y-m-d') ?>" min="<?= date('Y-m-d') ?>" required>
            </div>

            <!-- Product Selection -->
            <div class="mb-3">
                <label class="form-label">Select Ticket Type</label>
                <select class="form-select" name="product" id="productSelect">
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

            <!-- Inputs for Normal Products -->
            <div id="normalInputs">
                <div class="mb-3">
                    <label class="form-label">Number of Persons</label>
                    <div class="input-group">
                        <button class="btn btn-outline-secondary" type="button" onclick="adjUnit(-1)">-</button>
                        <input type="number" class="form-control text-center" id="units" name="unit" value="1" min="1" readonly>
                        <button class="btn btn-outline-secondary" type="button" onclick="adjUnit(1)">+</button>
                    </div>
                </div>
            </div>

            <!-- Inputs for Water World -->
            <div id="waterInputs" style="display:none;">
                <div class="mb-3">
                    <label class="form-label" id="labelBelow10">Below 10 Years</label>
                    <div class="input-group">
                        <button class="btn btn-outline-secondary" type="button" onclick="adjBaby(-1)">-</button>
                        <input type="number" class="form-control text-center" id="belowtenyears" name="belowtenyears" value="0" min="0" readonly>
                        <button class="btn btn-outline-secondary" type="button" onclick="adjBaby(1)">+</button>
                    </div>
                </div>
                <div class="mb-3">
                    <label class="form-label" id="labelAbove10">Above 10 Years</label>
                    <div class="input-group">
                        <button class="btn btn-outline-secondary" type="button" onclick="adjAdult(-1)">-</button>
                        <input type="number" class="form-control text-center" id="abovetenyears" name="abovetenyears" value="1" min="0" readonly>
                        <button class="btn btn-outline-secondary" type="button" onclick="adjAdult(1)">+</button>
                    </div>
                </div>
            </div>

            <div class="alert alert-info d-flex justify-content-between align-items-center">
                <span>Total Amount:</span>
                <span class="fs-4 fw-bold">₹<span id="totalDisplay">0</span></span>
            </div>

            <button type="submit" class="btn btn-primary w-100 btn-lg" id="payBtn">Pay Now</button>
        </form>
    </div>
</div>

<script>
// Global adjust functions
window.adjUnit = function(delta) {
    let val = parseInt($('#units').val()) + delta;
    if(val >= 1) { $('#units').val(val); calculateTotal(); }
};
window.adjBaby = function(delta) {
    let val = parseInt($('#belowtenyears').val()) + delta;
    if(val >= 0) { $('#belowtenyears').val(val); calculateTotal(); }
};
window.adjAdult = function(delta) {
    let val = parseInt($('#abovetenyears').val()) + delta;
    if(val >= 0) { $('#abovetenyears').val(val); calculateTotal(); }
};

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
        let price = parseFloat($opt.data('price'));
        let units = parseInt($('#units').val());
        total = price * units;
        $('#normalInputs').show();
        $('#waterInputs').hide();
    } else if (mode === 'water') {
        let priceBaby = parseFloat($opt.data('price-baby'));
        let priceAdult = parseFloat($opt.data('price-adult'));
        let babies = parseInt($('#belowtenyears').val());
        let adults = parseInt($('#abovetenyears').val());
        total = (priceBaby * babies) + (priceAdult * adults);
        $('#normalInputs').hide();
        $('#waterInputs').show();
    }
    $('#totalDisplay').text(total);
}

$(document).ready(function() {
    // Decode JWT to get phone number for display? 
    // Actually the API gets user from token, but we can't easily decode HS256 client side without library.
    // We can just show "Verified User" or leave it blank. 
    // Initial State: Verified User
    $('#userPhoneDisplay').val("Verified User");

    // Fetch Phone and Pricing from Server
    const token = localStorage.getItem('user_token');
    
    // Fetch Pricing - REMOVED (Handled by PHP)
    // $.ajax({ ... });

    if(token) {
        $.ajax({
            url: "<?= Url::to(['api-booking/profile']) ?>",
            method: 'GET',
            headers: { 'Authorization': 'Bearer ' + token },
            success: function(res) {
                if(res.status === 'success' && res.user.phone) {
                    $('#userPhoneDisplay').val(res.user.phone);
                } else {
                    console.log("Profile fetch failed:", res);
                }
            },
            error: function(xhr, status, error) {
                console.error("Profile API Error:", status, error);
                console.log(xhr.responseText);
            }
        });
    }

    // Pre-select product from URL
    const urlParams = new URLSearchParams(window.location.search);
    const preProduct = urlParams.get('product');
    
    // Inject Pending Data
    let pendingData = <?= $pendingBookingJson ?>;
    
    // Check sessionStorage if no server session data
    if (!pendingData) {
        try {
            const stored = sessionStorage.getItem('pending_booking');
            if (stored) {
                pendingData = JSON.parse(stored);
                // Clear it so it doesn't persist forever
                sessionStorage.removeItem('pending_booking');
            }
        } catch(e) { console.error(e); }
    }
    
    if (pendingData) {
        console.log("Restoring pending booking:", pendingData);
        if(pendingData.product) $('#productSelect').val(pendingData.product).trigger('change');
        if(pendingData.name) $('input[name="name"]').val(pendingData.name);
        if(pendingData.email) $('input[name="email"]').val(pendingData.email);
        if(pendingData.phone) $('#userPhoneDisplay').val(pendingData.phone); // Visual only
        if(pendingData.date) $('input[name="date"]').val(pendingData.date);
        
        // Handle counts from legacy 'no_of_units' if present
        if(pendingData.units) {
             $('#units').val(pendingData.units);
        }
        if(pendingData.below10) {
             $('#belowtenyears').val(pendingData.below10);
        }
        if(pendingData.above10) {
             $('#abovetenyears').val(pendingData.above10);
        }
        
        calculateTotal();
    } else if(preProduct) {
    } else if(preProduct) {
        // Handle select dropdown
        $('#productSelect').val(preProduct).trigger('change');
    }

    $('#productSelect').change(calculateTotal);
    calculateTotal(); // Initial calc

    $('#bookingForm').submit(function(e) {
        e.preventDefault();
        
        let amount = parseFloat($('#totalDisplay').text());
        if (amount <= 0) {
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
            abovetenyears: $('#abovetenyears').val()
        };

        $.post("<?= Url::to(['api-booking/create']) ?>", formData, function(res) {
            if(res.status === 'initiated') {
                var options = {
                    "key": res.key_id,
                    "amount": res.amount * 100, 
                    "currency": "INR",
                    "name": "Happy Valley Park",
                    "description": "Ticket Booking",
                    "order_id": res.order_id, 
                    "order_id": res.order_id, 
                    "handler": function (response){
                        // Verify Payment on Server
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
                    "theme": {
                        "color": "#3399cc"
                    }
                };
                var rzp1 = new Razorpay(options);
                rzp1.on('payment.failed', function (response){
                    alert("Payment Failed: " + response.error.description);
                    $btn.prop('disabled', false).text('Pay Now');
                });
                rzp1.open();
            } else {
                alert("Booking Failed: " + (res.message || 'Unknown error'));
                console.log(res);
                $btn.prop('disabled', false).text('Pay Now');
            }
        }).fail(function() {
            alert("Network Error");
            $btn.prop('disabled', false).text('Pay Now');
        });
    });
});
</script>
