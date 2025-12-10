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
</div>

</div>

<div class="row mb-4">
    <!-- Wallet Card -->
    <div class="col-md-6 mb-3 mb-md-0">
        <div class="card border-0 shadow-sm h-100" style="border-radius: 16px; overflow:hidden;">
            <div class="card-body p-4 position-relative" style="background: linear-gradient(135deg, #2b5876 0%, #4e4376 100%); color: white;">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h5 class="mb-0 fw-bold"><i class="fas fa-wallet me-2"></i>Wallet Balance</h5>
                    <span class="badge bg-white text-dark rounded-pill px-3 py-1">Credits</span>
                </div>
                <h2 class="display-4 fw-bold mb-0">₹<span id="walletBalance">0.00</span></h2>
                <small class="opacity-75">Use these credits for your next adventure!</small>
                
                <div class="mt-4 pt-3 border-top border-light" id="wallet-history" style="display:none">
                    <h6 class="text-uppercase fw-bold opacity-75 small">Recent Activity</h6>
                    <ul class="list-unstyled mb-0 small" id="wallet-txns">
                        <!-- Txns -->
                    </ul>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Referral Card -->
    <div class="col-md-6">
        <div class="card border-0 shadow-sm h-100" style="border-radius: 16px;">
            <div class="card-body p-4">
                <div class="d-flex align-items-center mb-3">
                    <div class="icon-box bg-success-light text-success rounded-circle me-3 d-flex align-items-center justify-content-center" style="width:40px; height:40px; background: #d1e7dd; color: #198754;">
                        <i class="fas fa-gift"></i>
                    </div>
                    <div>
                        <h5 class="mb-0 fw-bold">Refer & Earn</h5>
                        <small class="text-muted">Invite friends and earn bonus!</small>
                    </div>
                </div>
                
                <div class="bg-light p-3 rounded mb-3">
                    <label class="form-label small text-muted text-uppercase fw-bold mb-1">Your Referral Link</label>
                    <div class="input-group">
                        <input type="text" class="form-control border-0 bg-white" id="refLink" readonly value="Loading..." style="font-family: monospace;">
                        <button class="btn btn-primary" type="button" onclick="copyRef()">
                            <i class="fas fa-copy"></i>
                        </button>
                    </div>
                </div>
                
                <p class="small text-muted mb-0">
                    <i class="fas fa-info-circle me-1"></i>
                    Share this link with your friends. You'll get <span class="fw-bold text-success">Bonus Credits</span> when they book their first ticket!
                </p>
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
                    if (res.user.full_name) $('#welcomeName').text(res.user.full_name);
                    else if (res.user.phone) $('#welcomeName').text(res.user.phone);
                    
                    // Wallet
                    $('#walletBalance').text(parseFloat(res.user.wallet_balance || 0).toFixed(2));
                    
                    // Referral
                    if(res.user.referral_code) {
                        let link = window.location.origin + "<?= Url::to(['client/signup']) ?>?ref=" + res.user.referral_code;
                        $('#refLink').val(link);
                    }
                    
                    // Txns
                    if(res.user.transactions && res.user.transactions.length > 0) {
                        let html = '';
                        res.user.transactions.forEach(t => {
                            let color = t.type === 'credit' ? 'text-success' : 'text-white';
                            let sign = t.type === 'credit' ? '+' : '-';
                            html += `<li class="d-flex justify-content-between py-1">
                                <span>${t.description}</span>
                                <span class="${color} fw-bold">${sign}₹${t.amount}</span>
                            </li>`;
                        });
                        $('#wallet-txns').html(html);
                        $('#wallet-history').show();
                    }
                }
            }
        });
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
                    
                    let visited = (ticket.visited == 1);
                    
                    // Check Date Expiry
                    let today = new Date();
                    today.setHours(0,0,0,0);
                    let ticketDate = new Date(ticket.date);
                    // Reset hours for accurate comparison
                    ticketDate.setHours(0,0,0,0);
                    
                    let isExpired = ticketDate < today;
                    let isInactive = visited || isExpired;
                    
                    let cardClass = isInactive ? 'ticket-card saved opacity-75 grayscale' : 'ticket-card clickable-ticket';
                    let qrSection = '';
                    // Safe JSON for data attribute
                    let ticketJson = JSON.stringify(ticket).replace(/'/g, "&apos;").replace(/"/g, "&quot;");
                    let dataAttr = isInactive ? '' : `data-ticket="${ticketJson}"`;
                    
                    if(isInactive) {
                        let badgeText = visited ? 'REDEEMED' : 'EXPIRED';
                        let badgeColor = visited ? 'bg-danger' : 'bg-secondary';
                        
                        qrSection = `
                        <div class="ticket-stub position-relative">
                            <span class="pro-label mb-2">Status</span>
                            <div class="qr-box shadow-sm bg-light" style="filter: blur(4px); opacity: 0.5;">
                                <img src="${ticket.qr_code_url}" alt="QR" class="img-fluid" style="width: 100px; height: 100px;">
                            </div>
                            <div class="position-absolute top-50 start-50 translate-middle">
                                <span class="badge ${badgeColor} text-white border border-white border-2 shadow-sm rounded-pill px-3 py-2 fw-bold text-uppercase" style="font-size: 14px; letter-spacing: 1px; transform: rotate(-10deg);">
                                    ${badgeText}
                                </span>
                            </div>
                        </div>`;
                    } else {
                         qrSection = `
                        <div class="ticket-stub">
                            <span class="pro-label mb-2">Scan at Entrance</span>
                            <div class="qr-box shadow-sm">
                                <img src="${ticket.qr_code_url}" alt="QR" class="img-fluid" style="width: 100px; height: 100px;">
                            </div>
                        </div>`;
                    }

                    html += `
                    <div class="col-12 col-md-6 col-lg-4">
                        <div class="${cardClass}" ${dataAttr} style="cursor: ${isInactive ? 'default' : 'pointer'}">
                            <div class="ticket-top" style="${isInactive ? 'background: #64748b;' : ''}">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div>
                                        <h5>${prodName}</h5>
                                        <small class="d-block mt-1 opacity-75">Happy Valley Park</small>
                                    </div>
                                    <i class="fas ${visited ? 'fa-check-double' : (isExpired ? 'fa-history' : 'fa-check-circle')} fa-lg opacity-75"></i>
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
                            ${qrSection}
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
    
    // Event Delegation for Ticket Click
    $(document).on('click', '.clickable-ticket', function() {
        let ticketData = $(this).data('ticket');
        if(ticketData) {
            // If jQuery parsed it as object already, good. If string, parse it.
            let ticket = (typeof ticketData === 'string') ? JSON.parse(ticketData) : ticketData;
            openTicketModal(ticket);
        }
    });
});

function openTicketModal(ticket) {
    let prodName = "Entry Ticket";
    if(ticket.product == '8') prodName = "Water World";
    if(ticket.product == '9') prodName = "Combo Pack";
    
    $('#modalProdName').text(prodName);
    $('#modalTicketNo').text('#' + ticket.ticket_no);
    $('#modalDate').text(ticket.date);
    $('#modalQr').attr('src', ticket.qr_code_url);
    $('#modalAmount').text('₹' + ticket.amount);
    
    // Show Modal
    var myModal = new bootstrap.Modal(document.getElementById('ticketDetailModal'));
    myModal.show();
}
function copyRef() {
    let copyText = document.getElementById("refLink");
    copyText.select();
    copyText.setSelectionRange(0, 99999); 
    document.execCommand("copy");
    alert("Referral link copied!");
}
</script>

<!-- Ticket Detail Modal -->
<div class="modal fade" id="ticketDetailModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content border-0 shadow-lg" style="border-radius: 20px; overflow: hidden;">
      <div class="modal-header border-0 text-white" style="background: linear-gradient(135deg, #BE151C, #991b1b);">
        <h5 class="modal-title fw-bold" id="modalProdName">Entry Ticket</h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body text-center p-4" style="background: #fff;">
         <div class="mb-4">
             <div class="qr-box shadow p-2 rounded" style="display: inline-block;">
                <img id="modalQr" src="" alt="QR Code" class="img-fluid" style="width: 200px; height: 200px;">
             </div>
             <p class="text-muted small mt-2">Scan this QR code at the entrance</p>
         </div>
         
         <div class="ticket-divider mb-4"></div>
         
         <div class="row g-3 text-start">
             <div class="col-6">
                 <span class="pro-label">Ticket No</span>
                 <span class="pro-value text-primary fs-5" id="modalTicketNo" style="font-family: monospace;">#12345</span>
             </div>
             <div class="col-6 text-end">
                 <span class="pro-label">Date</span>
                 <span class="pro-value fs-5" id="modalDate">2023-10-10</span>
             </div>
             <div class="col-12 bg-light p-3 rounded d-flex justify-content-between align-items-center mt-3">
                 <div>
                     <span class="pro-label mb-1">Total Paid</span>
                     <span class="fw-bold text-dark d-block">via Online Payment</span>
                 </div>
                 <span class="pro-value text-success fs-4" id="modalAmount">₹500</span>
             </div>
         </div>
      </div>
      <div class="modal-footer border-0 bg-light justify-content-center p-3">
        <button type="button" class="btn btn-outline-secondary rounded-pill px-4" data-bs-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

