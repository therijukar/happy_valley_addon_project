<?php
use yii\helpers\Url;
?>
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
<style>
    /* Premium Mobile-First Design */
    .mobile-app-view {
        background: #f4f7f6;
        min-height: 100vh;
        font-family: 'Inter', sans-serif;
        padding-bottom: 80px;
    }
    
    /* Header */
    .app-header {
        background: #ffffff;
        padding: 15px 20px;
        box-shadow: 0 2px 10px rgba(0,0,0,0.05);
        display: flex;
        align-items: center;
        justify-content: space-between;
        position: sticky;
        top: 0;
        z-index: 100;
    }
    .app-title {
        font-size: 18px;
        font-weight: 700;
        color: #333;
        margin: 0;
    }
    
    /* Scanner Area */
    .scanner-wrapper {
        position: relative;
        margin: 20px;
        background: #000;
        border-radius: 16px;
        overflow: hidden;
        box-shadow: 0 8px 24px rgba(0,0,0,0.15);
        min-height: 300px;
    }
    #qr-reader {
        width: 100%;
        height: 100%;
        border-radius: 16px;
    }
    #qr-reader video {
        object-fit: cover;
        border-radius: 16px;
    }
    
    /* Overlay for "Looking for code" */
    .scanner-overlay {
        position: absolute;
        top: 0; left: 0; right: 0; bottom: 0;
        pointer-events: none;
        border: 2px solid rgba(255,255,255,0.7);
        border-radius: 16px;
        box-sizing: border-box;
    }
    .scanner-overlay::after {
        content: '';
        position: absolute;
        top: 50%; left: 10%; right: 10%;
        height: 2px;
        background: rgba(255, 0, 0, 0.6);
        box-shadow: 0 0 8px rgba(255, 0, 0, 0.8);
        animation: scan-line 2s infinite;
    }
    @keyframes scan-line {
        0% { top: 10%; opacity: 0; }
        50% { opacity: 1; }
        100% { top: 90%; opacity: 0; }
    }

    /* Controls */
    .control-panel {
        padding: 0 20px;
    }
    .btn-action-lg {
        border-radius: 12px;
        font-weight: 600;
        padding: 12px 20px;
        letter-spacing: 0.5px;
        font-size: 16px;
        text-transform: uppercase;
        box-shadow: 0 4px 12px rgba(26, 179, 148, 0.3);
        transition: transform 0.2s;
        border: none;
    }
    .btn-action-lg:active {
        transform: scale(0.96);
    }
    .btn-primary-gradient {
        background: linear-gradient(135deg, #1ab394 0%, #1c84c6 100%);
        color: white;
    }
    .btn-danger-gradient {
        background: linear-gradient(135deg, #ed5565 0%, #d12a3e 100%);
        color: white;
        box-shadow: 0 4px 12px rgba(237, 85, 101, 0.3);
    }
    
    /* Result Card */
    .result-card {
        background: white;
        border-radius: 16px;
        padding: 24px;
        text-align: center;
        margin: 20px;
        box-shadow: 0 10px 30px rgba(0,0,0,0.1);
        display: none;
        animation: slideUp 0.3s ease-out;
    }
    .result-icon {
        font-size: 48px;
        margin-bottom: 10px;
        display: block;
    }
    .result-title { font-size: 20px; font-weight: 700; margin-bottom: 5px; }
    .result-desc { color: #666; font-size: 14px; margin-bottom: 20px; }
    
    /* Manual Input */
    .manual-input-box {
        margin: 20px;
        background: white;
        border-radius: 12px;
        padding: 5px;
        box-shadow: 0 2px 8px rgba(0,0,0,0.05);
        display: flex;
    }
    .manual-input-box input {
        border: none;
        padding: 12px;
        font-size: 16px;
        flex-grow: 1;
        outline: none;
        background: transparent;
    }
    .manual-input-box button {
        background: #f3f3f4;
        border: none;
        border-radius: 8px;
        margin: 4px;
        padding: 0 20px;
        font-weight: 600;
        color: #333;
    }

    /* History List */
    .history-section {
        margin: 30px 20px;
    }
    .history-title {
        font-size: 14px;
        font-weight: 600;
        color: #888;
        text-transform: uppercase;
        letter-spacing: 1px;
        margin-bottom: 15px;
        display: flex;
        justify-content: space-between;
    }
    .history-item {
        background: white;
        border-radius: 12px;
        padding: 15px;
        margin-bottom: 10px;
        display: flex;
        align-items: center;
        justify-content: space-between;
        box-shadow: 0 1px 3px rgba(0,0,0,0.05);
    }
    .h-time { font-size: 12px; color: #999; display: block; }
    .h-ticket { font-weight: 600; font-size: 16px; color: #333; }
    .h-name { font-size: 13px; color: #666; }
    .h-status { font-size: 12px; font-weight: 600; padding: 4px 10px; border-radius: 20px; }
    
    .status-success { background: rgba(26, 179, 148, 0.1); color: #1ab394; }
    .status-error { background: rgba(237, 85, 101, 0.1); color: #ed5565; }
    .status-warn { background: rgba(248, 172, 89, 0.1); color: #f8ac59; }

    @keyframes slideUp { from { transform: translateY(20px); opacity: 0; } to { transform: translateY(0); opacity: 1; } }
</style>

<div class="mobile-app-view">
    <div class="app-header">
        <h1 class="app-title">Happy Valley Scanner</h1>
        <span class="badge" id="session-count">0 Scanned</span>
    </div>

    <!-- Scanner Viewfinder -->
    <div class="scanner-wrapper">
        <div id="qr-reader"></div>
        <div class="scanner-overlay" id="overlay" style="display:none"></div>
    </div>
    
    <!-- Status Message within Scanner Area if needed (hidden default) -->
    <div class="text-center" style="margin-top:-10px;margin-bottom:20px">
        <span id="camera-status" class="badge badge-warning" style="display:none">Connecting Camera...</span>
    </div>

    <!-- Controls -->
    <div class="control-panel">
        <button id="startScanBtn" class="btn btn-primary-gradient btn-action-lg btn-block">
            <i class="fa fa-camera-retro"></i>&nbsp; TAP TO SCAN
        </button>
        <button id="stopScanBtn" class="btn btn-danger-gradient btn-action-lg btn-block" style="display:none">
            <i class="fa fa-stop"></i>&nbsp; STOP CAMERA
        </button>
    </div>
    
    <!-- Manual Entry -->
    <div class="manual-input-box">
        <input type="number" id="manualCode" placeholder="Type Ticket No..." inputmode="numeric">
        <button id="manualSubmit">Check</button>
    </div>

    <!-- History -->
    <div class="history-section">
        <div class="history-title">
            <span>Recent Activity</span>
            <small onclick="clearHistory()" style="color:#ed5565;cursor:pointer">Clear</small>
        </div>
        <div id="history-list">
            <!-- Items injected here -->
        </div>
    </div>
</div>

<!-- Details Pop-up Modal -->
<div class="modal fade" id="detailModal" tabindex="-1" role="dialog" aria-hidden="true" data-backdrop="static">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content" style="border-radius: 16px;">
            <div class="modal-header" style="border-bottom:none; padding-bottom:0;">
                <h4 class="modal-title" id="m-title" style="font-weight:700">Ticket Details</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body text-center" style="padding: 20px;">
                <div id="m-icon-area" style="font-size: 50px; margin-bottom: 15px;"></div>
                <div id="m-body" style="font-size: 16px; margin-bottom: 20px;"></div>
                <div id="m-footer"></div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/html5-qrcode@2.3.8/html5-qrcode.min.js"></script>
<script>
    var html5QrCode = null;
    var isScanning = false;
    var audioSuccess = new Audio('<?php echo Url::base(true) . "/web/assets/beep.mp3"; ?>'); 
    
    // Initialize
    $(document).ready(function() {
        loadHistory();
        $('#startScanBtn').click(startScanner);
        $('#stopScanBtn').click(stopScanner);
        $('#manualSubmit').click(function() {
            let code = $('#manualCode').val();
            if(code) processCode(code);
        });
    });

    // History Logic
    function loadHistory() {
        let history = JSON.parse(localStorage.getItem('scanHistory') || '[]');
        $('#history-list').empty();
        $('#session-count').text(history.length + ' Scanned');
        history.forEach(item => renderHistoryItem(item));
    }

    function addToHistory(ticket, name, status, type) {
        let item = {
            time: new Date().toLocaleTimeString([], {hour: '2-digit', minute:'2-digit'}),
            ticket: ticket,
            name: name,
            status: status,
            type: type // 'success', 'error', 'warn'
        };
        arr = JSON.parse(localStorage.getItem('scanHistory') || '[]');
        arr.unshift(item); // Add to start
        if(arr.length > 50) arr.pop();
        localStorage.setItem('scanHistory', JSON.stringify(arr));
        
        loadHistory(); // Re-render
    }

    function renderHistoryItem(item) {
        let hHtml = `
            <div class="history-item">
                <div>
                    <div class="h-ticket">#${item.ticket}</div>
                    <div class="h-name">${item.name}</div>
                    <span class="h-time">${item.time}</span>
                </div>
                <div class="h-status status-${item.type}">${item.status}</div>
            </div>
        `;
        $('#history-list').append(hHtml);
    }

    function clearHistory() {
        if(confirm('Clear history?')) {
            localStorage.removeItem('scanHistory');
            loadHistory();
        }
    }

    // Scanner Logic
    function startScanner() {
        $('#startScanBtn').hide();
        $('#stopScanBtn').show();
        $('#overlay').show();
        $('#camera-status').show().text('Starting...');

        html5QrCode = new Html5Qrcode('qr-reader');
        const config = { fps: 10, qrbox: { width: 250, height: 250 }, aspectRatio: 1.0 };
        
        html5QrCode.start({ facingMode: "environment" }, config, onScanSuccess)
        .then(() => {
            isScanning = true;
            $('#camera-status').hide();
        })
        .catch(err => {
            $('#camera-status').show().text('Camera Error. Please allow permission.');
            $('#startScanBtn').show();
            $('#stopScanBtn').hide();
        });
    }

    function stopScanner() {
        if(html5QrCode && isScanning) {
            html5QrCode.stop().then(() => {
                html5QrCode.clear();
                isScanning = false;
                $('#startScanBtn').show();
                $('#stopScanBtn').hide();
                $('#overlay').hide();
            });
        }
    }

    function onScanSuccess(decodedText, decodedResult) {
        if(isScanning) {
             // Audio beep
             // audioSuccess.play();
             processCode(decodedText);
             // Pause scanner instead of full stop to keep camera ready?
             // User flow: Scan -> Modal -> Approve -> Close -> Scan Next
             // If we stop camera, it takes time to restart.
             // If we don't stop, it might scan duplicate.
             // Best: Pause processing but keep camera stream if possible? 
             // Html5Qrcode doesn't support 'pause' easily without stop.
             stopScanner(); 
        }
    }

    function processCode(rawCode) {
        // 1. Clean Code
        let displayCode = rawCode;
        try {
             let jsonObj = JSON.parse(rawCode);
             if (jsonObj.ticket) displayCode = jsonObj.ticket;
             else if (jsonObj.ticket_no) displayCode = jsonObj.ticket_no;
        } catch(e) { }
        
        // 2. Prepare Modal
        $('#m-icon-area').html('<i class="fa fa-circle-o-notch fa-spin" style="color:#f8ac59"></i>');
        $('#m-title').text('Verifying...');
        $('#m-body').html('Checking Ticket <b>#' + displayCode + '</b>');
        $('#m-footer').empty();
        $('#detailModal').modal('show');

        $.ajax({
            url: '<?php echo Url::to(['booking/get-ticket-details']) ?>',
            type: 'POST',
            data: { code: rawCode },
            headers: { 'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content') },
            success: function(res) {
                if(res.success) {
                    // Use backend returned values if available
                    let tickName = res.customer_name || 'Guest';
                    let tickNo = res.ticket_no || displayCode;
                    
                    if(res.is_visited == 1) {
                        // Already Used
                        $('#m-icon-area').html('<i class="fa fa-exclamation-circle" style="color:#f8ac59"></i>');
                        $('#m-title').text('ALREADY USED');
                        $('#m-body').html(res.details); // Contains name/date
                        $('#m-footer').html('<button class="btn btn-primary btn-block btn-lg" data-dismiss="modal" onclick="startScanner()">Scan Next</button>');
                        
                        addToHistory(tickNo, tickName, 'Used', 'warn');
                    } else {
                        // Valid & Fresh
                        $('#m-icon-area').html('<i class="fa fa-ticket" style="color:#1ab394"></i>');
                        $('#m-title').text('VALID TICKET');
                        $('#m-body').html(res.details);
                        $('#m-footer').html(`
                            <button class="btn btn-success btn-lg btn-block" onclick="approveEntry(${res.booking_id}, '${tickNo}', '${tickName}')">
                                APPROVE ENTRY
                            </button>
                            <br>
                            <button class="btn btn-default" data-dismiss="modal" onclick="startScanner()">Cancel</button>
                        `);
                    }
                } else {
                    // Invalid
                    $('#m-icon-area').html('<i class="fa fa-times-circle" style="color:#ed5565"></i>');
                    $('#m-title').text('INVALID TICKET');
                    $('#m-body').text(res.message);
                    $('#m-footer').html('<button class="btn btn-primary btn-block" data-dismiss="modal" onclick="startScanner()">Scan Next</button>');
                    addToHistory(displayCode, 'Unknown', 'Invalid', 'error');
                }
            },
            error: function() {
                $('#m-body').text('Network Error');
            }
        });
    }

    function approveEntry(id, tickNo, tickName) {
        $('#m-footer').html('<button class="btn btn-success btn-lg btn-block disabled"><i class="fa fa-spinner fa-spin"></i> Approving...</button>');
        
        $.ajax({
            url: '<?php echo Url::to(['booking/mark-verified']) ?>',
            type: 'POST',
            data: { booking_id: id },
            headers: { 'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content') },
            success: function(res) {
                if(res.success) {
                    $('#m-icon-area').html('<i class="fa fa-check-circle" style="color:#1ab394; font-size:70px;"></i>');
                    $('#m-title').text('APPROVED!');
                    $('#m-body').html('<h3>Entry Authorized</h3><p>'+tickName+'</p>');
                    $('#m-footer').html('<button class="btn btn-primary btn-block btn-lg" data-dismiss="modal" onclick="startScanner()">Scan Next</button>');
                    
                    addToHistory(tickNo, tickName, 'Authorized', 'success');
                    
                    // Auto close after 2 seconds? Optional.
                    // setTimeout(function(){ $('#detailModal').modal('hide'); startScanner(); }, 2000);
                } else {
                    alert(res.message);
                }
            }
        });
    }
</script>
