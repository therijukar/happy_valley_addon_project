<?php
use yii\helpers\Url;
$this->title = 'My Tickets - Happy Valley';
?>

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
