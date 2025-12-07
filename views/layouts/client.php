<?php
use yii\helpers\Html;
use yii\helpers\Url;

/* @var $this \yii\web\View */
/* @var $content string */
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no, viewport-fit=cover">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    
    <!-- Google Fonts: Inter -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    
    <!-- jQuery (Required for Bootstrap and custom scripts) -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <style>
        :root {
            --primary-color: #2563eb; /* Professional Blue */
            --secondary-color: #f8fafc;
            --text-color: #1e293b;
            --sidebar-width: 260px;
            --header-height: 60px;
            --bottom-nav-height: 70px;
        }

        body { 
            background-color: var(--secondary-color); 
            font-family: 'Inter', sans-serif; 
            color: var(--text-color);
            -webkit-font-smoothing: antialiased;
            padding-bottom: var(--bottom-nav-height); /* Mobile padding */
        }
        
        /* Hide Yii Debug Toolbar */
        #yii-debug-toolbar { display: none !important; }

        /* Desktop Sidebar - Hidden on Mobile */
        .sidebar {
            position: fixed;
            top: 0;
            left: 0;
            bottom: 0;
            width: var(--sidebar-width);
            background: white;
            border-right: 1px solid #e2e8f0;
            z-index: 1000;
            padding: 1.5rem;
            display: none;
        }

        /* Main Content Area */
        .main-content {
            width: 100%;
            padding: 20px;
            max-width: 800px; /* Centered content focus on mobile/tablet */
            margin: 0 auto;
        }

        /* App Header (Mobile) */
        .app-header {
            background: white;
            height: var(--header-height);
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0 1.5rem;
            box-shadow: 0 1px 3px rgba(0,0,0,0.05);
            position: sticky;
            top: 0;
            z-index: 900;
        }

        .brand-logo {
            font-weight: 700;
            font-size: 1.25rem;
            color: var(--primary-color);
            text-decoration: none;
            letter-spacing: -0.5px;
        }

        /* Bottom Nav (Mobile) */
        .bottom-nav {
            position: fixed;
            bottom: 0;
            left: 0;
            right: 0;
            background: white;
            height: var(--bottom-nav-height);
            display: flex;
            align-items: center;
            justify-content: space-around;
            box-shadow: 0 -1px 3px rgba(0,0,0,0.05);
            z-index: 1000;
            padding-bottom: env(safe-area-inset-bottom);
        }

        .nav-item-link {
            display: flex;
            flex-direction: column;
            align-items: center;
            text-decoration: none;
            color: #64748b;
            font-size: 0.75rem;
            font-weight: 500;
            transition: color 0.2s;
        }

        .nav-item-link i {
            font-size: 1.25rem;
            margin-bottom: 4px;
        }

        .nav-item-link.active {
            color: var(--primary-color);
        }

        /* Responsive */
        @media (min-width: 992px) {
            body { padding-bottom: 0; padding-left: var(--sidebar-width); }
            .sidebar { display: flex; flex-direction: column; }
            .bottom-nav { display: none; }
            .app-header { display: none; } /* Use sidebar header instead on desktop */
            .main-content { max-width: 1000px; padding: 40px; margin: 0; }
        }
        
        /* Utility */
        .btn-primary {
            background-color: var(--primary-color);
            border-color: var(--primary-color);
        }
        .btn-primary:active, .btn-primary:focus, .btn-primary:hover {
            background-color: #1d4ed8;
            border-color: #1d4ed8;
        }
    </style>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>

<!-- Desktop Sidebar -->
<div class="sidebar">
    <a href="<?= Url::to(['/']) ?>" class="brand-logo mb-5">
        <i class="fas fa-mountain-sun me-2"></i> Happy Valley
    </a>
    
    <div class="nav flex-column gap-2 mb-auto">
        <a href="<?= Url::to(['client/dashboard']) ?>" class="btn text-start <?= Yii::$app->controller->action->id == 'dashboard' ? 'btn-primary text-white' : 'btn-light text-dark' ?>">
            <i class="fas fa-ticket-alt me-2"></i> My Tickets
        </a>
        <a href="<?= Url::to(['client/book']) ?>" class="btn text-start <?= Yii::$app->controller->action->id == 'book' ? 'btn-primary text-white' : 'btn-light text-dark' ?>">
            <i class="fas fa-plus-circle me-2"></i> Book New Ticket
        </a>
    </div>

    <div class="mt-auto">
        <div class="p-3 bg-light rounded mb-3">
            <small class="text-muted d-block mb-1">Logged in as</small>
            <span class="fw-bold" id="loggedInUserPhone">User</span>
        </div>
        <a href="#" id="logoutBtnDesk" class="btn btn-outline-danger w-100">
            <i class="fas fa-sign-out-alt me-2"></i> Logout
        </a>
    </div>
</div>

<!-- Mobile Header -->
<div class="app-header">
    <a href="<?= Url::to(['/']) ?>" class="brand-logo">Happy Valley</a>
    <a href="#" id="logoutBtnMob" class="text-secondary"><i class="fas fa-sign-out-alt"></i></a>
</div>

<!-- Main Content -->
<div class="main-content">
    <?= $content ?>
</div>

<!-- Mobile Bottom Nav -->
<div class="bottom-nav">
    <a href="<?= Url::to(['client/dashboard']) ?>" class="nav-item-link <?= Yii::$app->controller->action->id == 'dashboard' ? 'active' : '' ?>">
        <i class="fas fa-ticket-alt"></i>
        <span>My Tickets</span>
    </a>
    <a href="<?= Url::to(['client/book']) ?>" class="nav-item-link <?= Yii::$app->controller->action->id == 'book' ? 'active' : '' ?>">
        <i class="fas fa-plus-circle"></i>
        <span>Book</span>
    </a>
    <a href="tel:+919876543210" class="nav-item-link">
        <i class="fas fa-headset"></i>
        <span>Support</span>
    </a>
</div>

<!-- Razorpay -->
<script src="https://checkout.razorpay.com/v1/checkout.js"></script>

<script>
    // Auth & JWT Handling
    const token = localStorage.getItem('user_token');
    const currentPath = window.location.pathname;
    const loginPath = "<?= Url::to(['client/login']) ?>";

    if (!token && !currentPath.includes('login')) {
        window.location.href = loginPath + '?returnUrl=' + encodeURIComponent(window.location.href);
    }
    
    // JWT Payload decoder to get phone number if available (optional enhancement)
    function parseJwt (token) {
        var base64Url = token.split('.')[1];
        var base64 = base64Url.replace(/-/g, '+').replace(/_/g, '/');
        var jsonPayload = decodeURIComponent(window.atob(base64).split('').map(function(c) {
            return '%' + ('00' + c.charCodeAt(0).toString(16)).slice(-2);
        }).join(''));
        return JSON.parse(jsonPayload);
    }

    if(token) {
        // Fetch user profile to display phone number
        $.ajax({
            url: "<?= Url::to(['api-booking/profile']) ?>",
            method: 'GET',
            headers: { 'Authorization': 'Bearer ' + token },
            success: function(res) {
                if(res.status === 'success' && res.user && res.user.phone) {
                    $('#loggedInUserPhone').text(res.user.phone);
                }
            },
            error: function() {
                // If token invalid, maybe force logout or just show nothing
                console.log('Failed to fetch profile');
            }
        });
    }

    function logout(e) {
        e.preventDefault();
        if(confirm('Are you sure you want to logout?')) {
            localStorage.removeItem('user_token');
            window.location.href = loginPath;
        }
    }

    $('#logoutBtnDesk, #logoutBtnMob').click(logout);

    // Global Auth Header
    $.ajaxSetup({
        beforeSend: function(xhr) {
            if (token) xhr.setRequestHeader('Authorization', 'Bearer ' + token);
        }
    });
</script>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
