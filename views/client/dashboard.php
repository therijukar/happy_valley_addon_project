<?php
use yii\helpers\Url;
$this->title = 'My Tickets - Happy Valley';
?>

<style>
    .dashboard-header {
        background: #fff;
        border-radius: 16px;
        padding: 25px;
        margin-bottom: 30px;
        box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05);
        display: flex;
        justify-content: space-between;
        align-items: center;
        flex-wrap: wrap;
        gap: 15px;
    }
    
    .ticket-card {
        background: white;
        border-radius: 16px;
        position: relative;
        overflow: hidden;
        box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.05), 0 4px 6px -2px rgba(0, 0, 0, 0.025);
        transition: all 0.3s ease;
        border: 1px solid rgba(0,0,0,0.02);
    }
    .ticket-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
    }
    
    .ticket-top {
        background: linear-gradient(135deg, #BE151C, #991b1b);
        padding: 20px;
        color: white;
        position: relative;
    }
    .ticket-top h5 { margin: 0; font-weight: 700; letter-spacing: 0.5px; }
    .ticket-top small { opacity: 0.9; }
    
    .ticket-main {
        padding: 20px;
    }
    
    /* Punch Hole Effect */
    .ticket-divider {
        position: relative;
        height: 2px;
        border-top: 2px dashed #cbd5e1;
        margin: 0 15px;
    }
    .ticket-divider::before, .ticket-divider::after {
        content: '';
        position: absolute;
        width: 24px;
        height: 24px;
        background-color: var(--secondary-color);
        border-radius: 50%;
        top: -13px;
    }
    .ticket-divider::before { left: -27px; }
    .ticket-divider::after { right: -27px; }
    
    .ticket-stub {
        padding: 15px;
        background: #f8fafc;
        text-align: center;
    }
    
    .qr-box {
        background: white;
        padding: 8px;
        border-radius: 8px;
        border: 1px solid #e2e8f0;
        display: inline-block;
    }
    
    .pro-label {
        font-size: 11px;
        text-transform: uppercase;
        color: #64748b;
        font-weight: 600;
        letter-spacing: 0.5px;
        margin-bottom: 2px;
        display: block;
    }
    .pro-value {
        font-size: 15px;
        font-weight: 600;
        color: #0f172a;
        display: block;
    }
    
    /* Empty State */
    .empty-state-icon {
        width: 80px;
        height: 80px;
        background: #eff6ff;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 20px;
        color: #2563eb;
        font-size: 32px;
    }
</style>

<!-- Welcome Header -->
<div class="dashboard-header">
    <div>
        <h2 class="h3 fw-bold mb-1 text-dark">Hello, <span id="welcomeName">Guest</span>! 👋</h2>
        <p class="text-muted mb-0">Here are your upcoming adventures.</p>
    </div>
    <a href="<?= Url::to(['client/book']) ?>" class="btn btn-primary px-4 py-2 fw-medium rounded-pill shadow-sm">
        <i class="fas fa-plus me-2"></i>Book New Ticket
    </a>
    </a>
</div>

<!-- Wallet & Referral Section -->
<div class="row mb-4">
    <div class="col-md-6 mb-3 mb-md-0">
        <div class="p-4 bg-white rounded-3 shadow-sm h-100 border border-light">
            <div class="d-flex align-items-center mb-2">
                <div class="bg-primary bg-opacity-10 p-2 rounded-circle me-3 text-primary">
                    <i class="fas fa-wallet fa-lg"></i>
                </div>
                <h5 class="text-muted mb-0">Wallet Balance</h5>
            </div>
            <h2 class="text-primary fw-bold mb-0 ps-5">₹<span id="walletBalance">0.00</span></h2>
            <small class="text-muted ps-5 d-block mt-1">Use this for your next booking</small>
        </div>
    </div>
    <div class="col-md-6">
        <div class="p-4 bg-white rounded-3 shadow-sm h-100 border border-light">
            <div class="d-flex align-items-center mb-2">
                 <div class="bg-success bg-opacity-10 p-2 rounded-circle me-3 text-success">
                    <i class="fas fa-gift fa-lg"></i>
                </div>
                <h5 class="text-muted mb-0">Refer & Earn</h5>
            </div>
            <p class="small text-muted mb-2 ps-5">Share this link to earn bonus on their first booking!</p>
            <div class="input-group ps-5">
                <input type="text" class="form-control bg-light" id="referralCode" readonly value="Loading..." style="font-size: 0.9rem;">
                <button class="btn btn-outline-primary" type="button" onclick="copyReferral()">
                    <i class="fas fa-copy"></i>
                </button>
            </div>
        </div>
    </div>
</div>

<!-- Loading State -->
<div id="loading" class="text-center py-5">
    <div class="spinner-grow text-primary" role="status" style="width: 3rem; height: 3rem;"></div>
    <p class="mt-3 text-muted fw-medium">Fetching your tickets...</p>
</div>

<!-- Tickets Grid -->
<div id="tickets-container" class="row g-4"></div>

<!-- Empty State -->
<div id="no-tickets" class="text-center py-5" style="display:none;">
    <div class="empty-state-icon">
        <i class="fas fa-ticket-alt"></i>
    </div>
    <h4 class="fw-bold mb-2">No Active Tickets Found</h4>
    <p class="text-muted mb-4" style="max-width: 400px; margin: 0 auto;">It looks like you haven't booked any adventures yet. Start your journey today!</p>
    <a href="<?= Url::to(['client/book']) ?>" class="btn btn-primary btn-lg px-5 rounded-pill shadow-sm">
        Book Now
    </a>
</div>

<script>
$(document).ready(function() {
    // 1. Fetch User Profile for Welcome Message
    const userToken = localStorage.getItem('user_token');
    if(userToken) {
        $.ajax({
            url: "<?= Url::to(['api-booking/profile']) ?>",
            method: 'GET',
            headers: { 'Authorization': 'Bearer ' + userToken },
            success: function(res) {
                if(res.status === 'success' && res.user) {
                    if(res.user.full_name) $('#welcomeName').text(res.user.full_name);
                    else if (res.user.phone) $('#welcomeName').text(res.user.phone);
                    
                    // Wallet
                    if(res.user.wallet_balance !== undefined) {
                        $('#walletBalance').text(res.user.wallet_balance);
                    }
                    
                    // Referral
                    if(res.user.referral_code) {
                        // Construct Signup URL with ref param
                        // Assumes current host
                        var baseUrl = window.location.protocol + "//" + window.location.host + "<?= Url::to(['client/signup']) ?>";
                        var refLink = baseUrl + "?ref=" + res.user.referral_code;
                        $('#referralCode').val(refLink);
                    }
                }
            }
        });
    }

    // Copy Function
    window.copyReferral = function() {
        var copyText = document.getElementById("referralCode");
        copyText.select();
        copyText.setSelectionRange(0, 99999); 
        document.execCommand("copy");
        
        // Visual Feedback
        var btn = $(copyText).next('button');
        var original = btn.html();
        btn.html('<i class="fas fa-check"></i>');
        btn.removeClass('btn-outline-primary').addClass('btn-success');
        setTimeout(function() {
            btn.html(original);
            btn.removeClass('btn-success').addClass('btn-outline-primary');
        }, 2000);
    }

    // 2. Fetch Tickets
    $.ajax({
        url: "<?= Url::to(['api-booking/history']) ?>",
        method: 'POST', // or GET depending on controller
        headers: { 'Authorization': 'Bearer ' + userToken },
        success: function(data) {
            $('#loading').hide();
            if(data.status === 'success' && data.tickets.length > 0) {
                let html = '';
                data.tickets.forEach(function(ticket) {
                    // Determine Product Name fancily if possible, else generic
                    let prodName = "Entry Ticket";
                    if(ticket.product == '8') prodName = "Water World";
                    if(ticket.product == '9') prodName = "Combo Pack";

                    html += `
                    <div class="col-12 col-md-6 col-lg-4">
                        <div class="ticket-card">
                            <div class="ticket-top">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div>
                                        <h5>${prodName}</h5>
                                        <small class="d-block mt-1 opacity-75">Happy Valley Park</small>
                                    </div>
                                    <i class="fas fa-check-circle fa-lg opacity-75"></i>
                                </div>
                            </div>
                            <div class="ticket-main">
                                <div class="row g-3">
                                    <div class="col-6">
                                        <span class="pro-label">Date</span>
                                        <span class="pro-value">${ticket.date}</span>
                                    </div>
                                    <div class="col-6 text-end">
                                        <span class="pro-label">Ticket No</span>
                                        <span class="pro-value" style="font-family: monospace; letter-spacing: 1px;">#${ticket.ticket_no}</span>
                                    </div>
                                    <div class="col-6">
                                        <span class="pro-label">Admit</span>
                                        <span class="pro-value">1 Person</span>
                                    </div>
                                    <div class="col-6 text-end">
                                        <span class="pro-label">Amount</span>
                                        <span class="pro-value text-primary">₹${ticket.amount}</span>
                                    </div>
                                </div>
                            </div>
                            <div class="ticket-divider"></div>
                            <div class="ticket-stub">
                                <span class="pro-label mb-2">Scan at Entrance</span>
                                <div class="qr-box shadow-sm">
                                    <img src="${ticket.qr_code_url}" alt="QR" class="img-fluid" style="width: 100px; height: 100px;">
                                </div>
                            </div>
                        </div>
                    </div>
                    `;
                });
                $('#tickets-container').html(html);
            } else {
                $('#no-tickets').show();
            }
        },
        error: function() {
            $('#loading').hide();
            $('#no-tickets h4').text('Could not load tickets');
            $('#no-tickets').show();
        }
    });
});
</script>
<style>
    .ticket-card {
        background: white;
        border-radius: 16px;
        position: relative;
        overflow: hidden;
        border: 1px solid #e2e8f0;
        transition: transform 0.2s, box-shadow 0.2s;
    }
    .ticket-card:hover {
        transform: translateY(-2px);
        box-shadow: 0 10px 20px rgba(0,0,0,0.05);
    }
    .ticket-header {
        background: linear-gradient(135deg, #2563eb, #1d4ed8);
        color: white;
        padding: 1.5rem;
        position: relative;
    }
    .ticket-body {
        padding: 1.5rem;
    }
    .ticket-divider {
        border-top: 2px dashed #e2e8f0;
        margin: 0 1rem;
        position: relative;
    }
    .ticket-divider::before, .ticket-divider::after {
        content: '';
        position: absolute;
        width: 20px;
        height: 20px;
        background-color: var(--secondary-color); /* Match body bg */
        border-radius: 50%;
        top: -11px;
    }
    .ticket-divider::before { left: -20px; }
    .ticket-divider::after { right: -20px; }
    
    .qr-container {
        border: 2px solid #f1f5f9;
        border-radius: 12px;
        padding: 10px;
        display: inline-block;
    }
</style>

<div class="d-flex justify-content-between align-items-center mb-4">
    <h2 class="h4 fw-bold mb-0">Active Tickets</h2>
    <a href="<?= Url::to(['client/book']) ?>" class="btn btn-primary d-none d-md-block btn-sm">
        <i class="fas fa-plus"></i> New Booking
    </a>
</div>

<div id="loading" class="text-center py-5">
    <div class="spinner-border text-primary" role="status"></div>
    <p class="mt-2 text-muted fw-medium">Loading your tickets...</p>
</div>

<div id="tickets-container" class="row g-4"></div>

<div id="no-tickets" class="text-center py-5" style="display:none;">
    <div class="mb-3">
        <span class="fa-stack fa-2x">
            <i class="fas fa-circle fa-stack-2x text-light"></i>
            <i class="fas fa-ticket-alt fa-stack-1x text-secondary"></i>
        </span>
    </div>
    <h5 class="fw-bold text-dark">No Active Tickets</h5>
    <p class="text-muted mb-4">You haven't booked any adventures yet.</p>
    <a href="<?= Url::to(['client/book']) ?>" class="btn btn-primary px-4 py-2">
        Book Your First Ticket
    </a>
</div>

<script>
$(document).ready(function() {
    $.post("<?= Url::to(['api-booking/history']) ?>", function(data) {
        $('#loading').hide();
        if(data.status === 'success' && data.tickets.length > 0) {
            let html = '';
            data.tickets.forEach(function(ticket) {
                html += `
                <div class="col-12 col-md-6 col-lg-4">
                    <div class="ticket-card shadow-sm h-100">
                        <div class="ticket-header">
                            <div class="d-flex justify-content-between align-items-start">
                                <div>
                                    <h5 class="card-title fw-bold mb-1">Entry Ticket</h5>
                                    <small class="opacity-75">#${ticket.ticket_no}</small>
                                </div>
                                <span class="badge bg-white text-primary rounded-pill px-3">Active</span>
                            </div>
                        </div>
                        <div class="ticket-body text-center">
                            <div class="qr-container mb-3">
                                <img src="${ticket.qr_code_url}" alt="QR Code" class="img-fluid" style="height: 120px;">
                            </div>
                            <div class="row text-start mt-3">
                                <div class="col-6 mb-3">
                                    <small class="text-muted d-block text-uppercase" style="font-size: 0.7rem; letter-spacing: 0.5px;">Date</small>
                                    <span class="fw-bold">${ticket.date}</span>
                                </div>
                                <div class="col-6 mb-3">
                                     <small class="text-muted d-block text-uppercase" style="font-size: 0.7rem; letter-spacing: 0.5px;">Visitors</small>
                                    <span class="fw-bold">1 Person</span>
                                </div>
                                <div class="col-12">
                                     <small class="text-muted d-block text-uppercase" style="font-size: 0.7rem; letter-spacing: 0.5px;">Total Amount</small>
                                    <span class="fw-bold text-primary fs-5">₹${ticket.amount}</span>
                                </div>
                            </div>
                        </div>
                        <div class="ticket-divider"></div>
                        <div class="p-3 bg-light text-center">
                            <small class="text-muted">Show this at the entrance</small>
                        </div>
                    </div>
                </div>
                `;
            });
            $('#tickets-container').html(html);
        } else {
            $('#no-tickets').show();
        }
    }).fail(function(xhr) {
        // Auth is handled globally in layout
        $('#loading').hide();
        $('#no-tickets h5').text('Error loading tickets');
        $('#no-tickets p').text('Please check your internet connection.');
        $('#no-tickets').show();
    });
});
</script>
