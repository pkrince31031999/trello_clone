
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>KaaryaHub - Dashboard</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- Font Awesome for icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            color: #2d3748;
            line-height: 1.6;
        }

        /* Modern Header */
        header {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(20px);
            border-bottom: 1px solid rgba(255, 255, 255, 0.2);
            padding: 0 24px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
            position: sticky;
            top: 0;
            z-index: 1000;
            display: flex;
            justify-content: space-between;
            align-items: center;
            height: 70px;
        }

        .logo-container {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .logo-container img {
            height: 50px;
            width: auto;
            filter: drop-shadow(0 2px 4px rgba(0, 0, 0, 0.1));
        }

        .header-right {
            display: flex;
            align-items: center;
            gap: 20px;
        }

        .search-container {
            position: relative;
            display: none;
        }

        .search-input {
            padding: 10px 16px 10px 40px;
            border: 2px solid #e2e8f0;
            border-radius: 25px;
            background: #f8fafc;
            font-size: 14px;
            width: 300px;
            transition: all 0.3s ease;
        }

        .search-input:focus {
            outline: none;
            border-color: #667eea;
            background: white;
            box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
        }

        .search-icon {
            position: absolute;
            left: 14px;
            top: 50%;
            transform: translateY(-50%);
            color: #a0aec0;
            font-size: 16px;
        }

        .notification-btn {
            position: relative;
            background: none;
            border: none;
            color: #4a5568;
            font-size: 20px;
            cursor: pointer;
            padding: 8px;
            border-radius: 8px;
            transition: all 0.3s ease;
        }

        .notification-btn:hover {
            background: #f7fafc;
            color: #667eea;
        }

        .notification-badge {
            position: absolute;
            top: 4px;
            right: 4px;
            background: #e53e3e;
            color: white;
            border-radius: 50%;
            width: 18px;
            height: 18px;
            font-size: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 600;
        }

        /* Enhanced Profile Dropdown */
        .profile {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 8px 12px;
            border-radius: 12px;
            cursor: pointer;
            transition: all 0.3s ease;
            position: relative;
        }

        .profile:hover {
            background: #f7fafc;
        }

        .profile-avatar {
            width: 36px;
            height: 36px;
            border-radius: 50%;
            background: linear-gradient(135deg, #667eea, #764ba2);
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: 600;
            font-size: 14px;
            border: 2px solid white;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
        }

        .profile-info {
            display: flex;
            flex-direction: column;
        }

        .profile-info span:first-child {
            font-weight: 600;
            font-size: 14px;
            color: #2d3748;
        }

        .profile-info span:last-child {
            font-size: 12px;
            color: #718096;
        }

        .dropdown-arrow {
            color: #a0aec0;
            font-size: 12px;
            transition: transform 0.3s ease;
        }

        .profile:hover .dropdown-arrow {
            transform: rotate(180deg);
        }

        .dropdown {
            position: relative;
        }

        .dropdown-menu {
            position: absolute;
            top: 100%;
            right: 0;
            background: white;
            border-radius: 12px;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.15);
            border: 1px solid #e2e8f0;
            width: 220px;
            opacity: 0;
            transform: translateY(-10px) scale(0.95);
            transition: all 0.3s ease;
            overflow: hidden;
            z-index: 1000;
        }

        .dropdown-menu.active {
            opacity: 1;
            transform: translateY(0) scale(1);
        }

        .dropdown-menu a {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 12px 16px;
            color: #4a5568;
            text-decoration: none;
            font-weight: 500;
            border-bottom: 1px solid #f1f5f9;
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }

        .dropdown-menu a::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(102, 126, 234, 0.1), transparent);
            transition: left 0.5s ease;
        }

        .dropdown-menu a:hover {
            background: linear-gradient(135deg, #667eea, #764ba2);
            color: white;
            transform: translateX(4px);
        }

        .dropdown-menu a:hover::before {
            left: 100%;
        }

        .dropdown-menu a i {
            font-size: 16px;
            width: 20px;
            text-align: center;
        }

        .dropdown-menu a:last-child {
            border-bottom: none;
        }

        /* Main Content */
        main {
            flex: 1;
            padding: 30px 24px;
            max-width: 1400px;
            margin: 0 auto;
            width: 100%;
        }

        .dashboard-header {
            margin-bottom: 30px;
        }

        .dashboard-title {
            font-size: 32px;
            font-weight: 700;
            color: white;
            margin-bottom: 8px;
            text-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .dashboard-subtitle {
            font-size: 16px;
            color: rgba(255, 255, 255, 0.8);
            font-weight: 400;
        }

        /* Enhanced Board Cards */
        .board-cards {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
            gap: 20px;
            margin-bottom: 40px;
        }

        .add-board-card {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(20px);
            border: 2px dashed #cbd5e0;
            border-radius: 16px;
            padding: 30px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            cursor: pointer;
            transition: all 0.3s ease;
            min-height: 160px;
            position: relative;
            overflow: hidden;
        }

        .add-board-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(102, 126, 234, 0.1), transparent);
            transition: left 0.5s ease;
        }

        .add-board-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.15);
            border-color: #667eea;
            background: rgba(255, 255, 255, 1);
        }

        .add-board-card:hover::before {
            left: 100%;
        }

        .add-board-card .icon {
            font-size: 48px;
            color: #667eea;
            margin-bottom: 12px;
            transition: all 0.3s ease;
        }

        .add-board-card:hover .icon {
            transform: scale(1.1);
            color: #764ba2;
        }

        .add-board-card .text {
            font-size: 16px;
            font-weight: 600;
            color: #4a5568;
            text-align: center;
        }

        .board-card {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(20px);
            border-radius: 16px;
            overflow: hidden;
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.1);
            transition: all 0.3s ease;
            cursor: pointer;
            position: relative;
            min-height: 160px;
        }

        .board-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.2);
        }

        .board-card .board-image {
            height: 100px;
            background-size: cover;
            background-position: center;
            position: relative;
        }

        .board-card .board-image::after {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: linear-gradient(135deg, rgba(102, 126, 234, 0.8), rgba(118, 75, 162, 0.8));
            opacity: 0;
            transition: opacity 0.3s ease;
        }

        .board-card:hover .board-image::after {
            opacity: 1;
        }

        .board-card .board-title {
            padding: 20px;
            font-size: 16px;
            font-weight: 600;
            color: #2d3748;
            text-align: center;
            background: white;
        }

        /* Section Headers */
        .section-header {
            display: flex;
            align-items: center;
            gap: 12px;
            margin-bottom: 20px;
        }

        .section-header h2 {
            font-size: 24px;
            font-weight: 700;
            color: white;
            margin: 0;
        }

        .section-header .icon {
            font-size: 24px;
            color: rgba(255, 255, 255, 0.8);
        }

        /* Enhanced Modal */
        .modal {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.6);
            backdrop-filter: blur(8px);
            justify-content: center;
            align-items: center;
            z-index: 2000;
            animation: fadeIn 0.3s ease;
        }

        .modal.active {
            display: flex;
        }

        .modal-content {
            background: white;
            border-radius: 20px;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.3);
            width: 90%;
            max-width: 500px;
            animation: slideUp 0.3s ease;
            overflow: hidden;
        }

        .modal-header {
            background: linear-gradient(135deg, #667eea, #764ba2);
            color: white;
            padding: 24px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .modal-header h3 {
            font-size: 20px;
            font-weight: 600;
            margin: 0;
        }

        .close-btn {
            background: rgba(255, 255, 255, 0.2);
            border: none;
            color: white;
            font-size: 20px;
            width: 32px;
            height: 32px;
            border-radius: 50%;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.3s ease;
        }

        .close-btn:hover {
            background: rgba(255, 255, 255, 0.3);
            transform: scale(1.1);
        }

        .modal-body {
            padding: 24px;
            display: flex;
            flex-direction: column;
            gap: 20px;
        }

        .form-group {
            display: flex;
            flex-direction: column;
            gap: 8px;
        }

        .form-group label {
            font-weight: 600;
            color: #4a5568;
            font-size: 14px;
        }

        .form-group input,
        .form-group textarea {
            padding: 12px 16px;
            border: 2px solid #e2e8f0;
            border-radius: 12px;
            font-size: 14px;
            transition: all 0.3s ease;
            background: #f8fafc;
        }

        .form-group input:focus,
        .form-group textarea:focus {
            outline: none;
            border-color: #667eea;
            background: white;
            box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
        }

        .form-group textarea {
            resize: vertical;
            min-height: 80px;
        }

        .modal-footer {
            padding: 20px 24px;
            background: #f8fafc;
            display: flex;
            justify-content: flex-end;
            gap: 12px;
        }

        .btn {
            padding: 12px 24px;
            border: none;
            border-radius: 12px;
            font-size: 14px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }

        .btn::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
            transition: left 0.5s ease;
        }

        .btn:hover::before {
            left: 100%;
        }

        .cancel-btn {
            background: #e2e8f0;
            color: #4a5568;
        }

        .cancel-btn:hover {
            background: #cbd5e0;
            transform: translateY(-2px);
        }

        .create-btn {
            background: linear-gradient(135deg, #667eea, #764ba2);
            color: white;
        }

        .create-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(102, 126, 234, 0.3);
        }

        .create-btn:disabled {
            opacity: 0.6;
            cursor: not-allowed;
            transform: none;
        }

        /* Loading States */
        .loading {
            position: relative;
        }

        .loading::after {
            content: '';
            position: absolute;
            top: 50%;
            left: 50%;
            width: 20px;
            height: 20px;
            margin: -10px 0 0 -10px;
            border: 2px solid transparent;
            border-top: 2px solid currentColor;
            border-radius: 50%;
            animation: spin 1s linear infinite;
        }

        /* Animations */
        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }

        @keyframes slideUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }

        /* Responsive Design */
        @media (max-width: 1200px) {
            .board-cards {
                grid-template-columns: repeat(auto-fill, minmax(260px, 1fr));
            }
        }

        @media (max-width: 768px) {
            header {
                padding: 0 16px;
                height: 60px;
            }

            .logo-container img {
                height: 40px;
            }

            .header-right {
                gap: 12px;
            }

            .profile {
                padding: 6px 8px;
            }

            .profile-avatar {
                width: 32px;
                height: 32px;
                font-size: 12px;
            }

            .profile-info span:first-child {
                font-size: 13px;
            }

            .profile-info span:last-child {
                font-size: 11px;
            }

            .dropdown-menu {
                width: 200px;
                right: -10px;
            }

            main {
                padding: 20px 16px;
            }

            .dashboard-title {
                font-size: 24px;
            }

            .dashboard-subtitle {
                font-size: 14px;
            }

            .board-cards {
                grid-template-columns: repeat(auto-fill, minmax(240px, 1fr));
                gap: 16px;
            }

            .add-board-card {
                min-height: 140px;
                padding: 24px;
            }

            .add-board-card .icon {
                font-size: 40px;
            }

            .add-board-card .text {
                font-size: 14px;
            }

            .board-card {
                min-height: 140px;
            }

            .board-card .board-image {
                height: 80px;
            }

            .board-card .board-title {
                padding: 16px;
                font-size: 14px;
            }

            .modal-content {
                width: 95%;
                max-width: 400px;
            }

            .modal-header {
                padding: 20px;
            }

            .modal-body {
                padding: 20px;
                gap: 16px;
            }

            .modal-footer {
                padding: 16px 20px;
            }
        }

        @media (max-width: 480px) {
            header {
                padding: 0 12px;
                height: 56px;
            }

            .logo-container img {
                height: 36px;
            }

            .header-right {
                gap: 8px;
            }

            .notification-btn {
                font-size: 18px;
                padding: 6px;
            }

            .profile {
                padding: 4px 6px;
                gap: 8px;
            }

            .profile-avatar {
                width: 28px;
                height: 28px;
                font-size: 11px;
            }

            .profile-info span:first-child {
                font-size: 12px;
            }

            .profile-info span:last-child {
                display: none;
            }

            .dropdown-menu {
                width: 180px;
                right: -20px;
            }

            .dropdown-menu a {
                padding: 10px 14px;
                font-size: 13px;
            }

            main {
                padding: 16px 12px;
            }

            .dashboard-title {
                font-size: 20px;
            }

            .dashboard-subtitle {
                font-size: 13px;
            }

            .board-cards {
                grid-template-columns: 1fr;
                gap: 12px;
            }

            .add-board-card {
                min-height: 120px;
                padding: 20px;
            }

            .add-board-card .icon {
                font-size: 36px;
                margin-bottom: 8px;
            }

            .add-board-card .text {
                font-size: 13px;
            }

            .board-card {
                min-height: 120px;
            }

            .board-card .board-image {
                height: 70px;
            }

            .board-card .board-title {
                padding: 12px;
                font-size: 13px;
            }

            .modal-content {
                width: 98%;
                max-width: 350px;
                margin: 10px;
            }

            .modal-header {
                padding: 16px;
            }

            .modal-header h3 {
                font-size: 18px;
            }

            .modal-body {
                padding: 16px;
                gap: 12px;
            }

            .form-group input,
            .form-group textarea {
                padding: 10px 12px;
                font-size: 13px;
            }

            .modal-footer {
                padding: 12px 16px;
                flex-direction: column;
                gap: 8px;
            }

            .btn {
                padding: 10px 20px;
                font-size: 13px;
                width: 100%;
            }
        }

        @media (max-width: 360px) {
            .dashboard-title {
                font-size: 18px;
            }

            .add-board-card {
                min-height: 100px;
                padding: 16px;
            }

            .add-board-card .icon {
                font-size: 32px;
            }

            .board-card {
                min-height: 100px;
            }

            .board-card .board-image {
                height: 60px;
            }

            .board-card .board-title {
                padding: 10px;
                font-size: 12px;
            }
        }
    </style>
</head>
<body>
    <header>
        <div class="logo-container">
            <img src="http://localhost/trello_clone/public/images/KaaryaHub_logo.png" alt="KaaryaHub Logo" />
        </div>
        
        <div class="header-right">
            <!-- Search Container (Hidden by default) -->
            <div class="search-container" id="searchContainer">
                <i class="fas fa-search search-icon"></i>
                <input type="text" class="search-input" placeholder="Search boards..." id="searchInput">
            </div>
            
            <!-- Notifications -->
            <button class="notification-btn" onclick="toggleNotifications()" title="Notifications">
                <i class="fas fa-bell"></i>
                <span class="notification-badge" id="notificationBadge">3</span>
            </button>

            <!-- Profile Dropdown -->
            <div class="dropdown">
                <div class="profile" onclick="toggleDropdown()">
                    <div class="profile-avatar" id="profileAvatar">
                        <?php echo strtoupper(substr($response['userdata']['username'], 0, 2)); ?>
                    </div>
                    <div class="profile-info">
                        <span><?php echo $response['userdata']['username']; ?></span>
                        <span>Online</span>
                    </div>
                    <i class="fas fa-chevron-down dropdown-arrow"></i>
                </div>
                <div class="dropdown-menu" id="dropdownMenu">
                    <a href="#"><i class="fas fa-user"></i> Profile</a>
                    <a href="#"><i class="fas fa-cog"></i> Settings</a>
                    <a href="#"><i class="fas fa-bell"></i> Notifications</a>
                    <a href="#"><i class="fas fa-question-circle"></i> Help</a>
                    <a href="logout.php"><i class="fas fa-sign-out-alt"></i> Logout</a>
                </div>
            </div>
        </div>
    </header>

    <main>
        <!-- Dashboard Header -->
        <div class="dashboard-header">
            <h1 class="dashboard-title">Welcome back, <?php echo $response['userdata']['username']; ?>!</h1>
            <p class="dashboard-subtitle">Manage your boards and stay organized</p>
        </div>

        <!-- Recently Viewed Section -->
        <div class="section-header">
            <i class="fas fa-clock icon"></i>
            <h2>Your Boards</h2>
        </div>
        
        <div class="board-cards">
            <!-- Add New Board Card -->
            <div class="add-board-card" onclick="openModal()">
                <div class="icon">
                    <i class="fas fa-plus"></i>
                </div>
                <div class="text">Create New Board</div>
            </div>
            
            <?php
            if (count($response['boardData']) > 0) {
                foreach ($response['boardData'] as $board) {
                    $boardName = htmlspecialchars($board['name']);
                    $boardId = $board['id'];
                    $boardDescription = isset($board['description']) ? htmlspecialchars($board['description']) : '';
                    
                    echo '<a href="index.php?action=showBoard&controller=board&id=' . $boardId . '" class="board-link">
                            <div class="board-card">
                                <div class="board-image" style="background-image: url(\'https://via.placeholder.com/400x200/667eea/ffffff?text=' . urlencode($boardName) . '\');"></div>
                                <div class="board-title">' . $boardName . '</div>
                            </div>
                          </a>';
                }
            } else {
                echo '<div class="empty-state">
                        <i class="fas fa-clipboard-list" style="font-size: 48px; color: rgba(255, 255, 255, 0.6); margin-bottom: 16px;"></i>
                        <h3 style="color: white; margin-bottom: 8px;">No boards yet</h3>
                        <p style="color: rgba(255, 255, 255, 0.8);">Create your first board to get started!</p>
                      </div>';
            }
            ?>
        </div>
    </main>

    <!-- Enhanced Create Board Modal -->
    <div class="modal" id="createBoardModal">
        <div class="modal-content">
            <div class="modal-header">
                <h3><i class="fas fa-plus-circle" style="margin-right: 8px;"></i>Create New Board</h3>
                <button class="close-btn" onclick="closeModal()">
                    <i class="fas fa-times"></i>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label for="boardName">Board Name</label>
                    <input type="text" id="boardName" placeholder="Enter board name" required />
                </div>
                <div class="form-group">
                    <label for="boardDescription">Description (Optional)</label>
                    <textarea id="boardDescription" placeholder="Describe your board..." rows="3"></textarea>
                </div>
            </div>
            <div class="modal-footer">
                <button class="cancel-btn" onclick="closeModal()">
                    <i class="fas fa-times"></i> Cancel
                </button>
                <button class="create-btn" onclick="createBoard()" id="createBtn">
                    <i class="fas fa-plus"></i> Create Board
                </button>
            </div>
        </div>
    </div>


    
    <script>
        // Enhanced Dashboard Functionality
        let isLoading = false;

        // Enhanced Dropdown Toggle
        function toggleDropdown() {
            const dropdownMenu = document.getElementById('dropdownMenu');
            const arrow = document.querySelector('.dropdown-arrow');
            
            dropdownMenu.classList.toggle('active');
            arrow.style.transform = dropdownMenu.classList.contains('active') ? 'rotate(180deg)' : 'rotate(0deg)';
        }

        // Enhanced Notifications Toggle
        function toggleNotifications() {
            // Placeholder for notifications functionality
            console.log('Notifications clicked');
            // You can implement a notifications panel here
        }

        // Close dropdown if clicked outside
        document.addEventListener('click', (event) => {
            const dropdownMenu = document.getElementById('dropdownMenu');
            const profile = document.querySelector('.profile');

            if (!profile.contains(event.target)) {
                dropdownMenu.classList.remove('active');
                document.querySelector('.dropdown-arrow').style.transform = 'rotate(0deg)';
            }
        });

        // Enhanced Modal Functions
        function openModal() {
            const modal = document.getElementById('createBoardModal');
            modal.classList.add('active');
            
            // Focus on the first input
            setTimeout(() => {
                document.getElementById('boardName').focus();
            }, 300);
        }

        function closeModal() {
            const modal = document.getElementById('createBoardModal');
            modal.classList.remove('active');
            
            // Clear form
            document.getElementById('boardName').value = '';
            document.getElementById('boardDescription').value = '';
            
            // Reset button state
            const createBtn = document.getElementById('createBtn');
            createBtn.disabled = false;
            createBtn.classList.remove('loading');
            createBtn.innerHTML = '<i class="fas fa-plus"></i> Create Board';
        }

        // Enhanced Board Creation
        function createBoard() {
            if (isLoading) return;
            
            const boardName = document.getElementById('boardName').value.trim();
            const boardDescription = document.getElementById('boardDescription').value.trim();
            const createBtn = document.getElementById('createBtn');

            // Validation
            if (!boardName) {
                showNotification('Please enter a board name', 'error');
                document.getElementById('boardName').focus();
                return;
            }

            if (boardName.length < 3) {
                showNotification('Board name must be at least 3 characters', 'error');
                document.getElementById('boardName').focus();
                return;
            }

            // Set loading state
            setLoading(true);

            $.ajax({
                type: 'POST',
                url: 'index.php?action=createBoard&controller=board',
                data: {
                    boardName: boardName,
                    boardDescription: boardDescription
                },
                success: function(response) {
                    setLoading(false);
                    if (response.success) {
                        showNotification(response.message, 'success');
                        setTimeout(() => {
                            window.location.href = 'index.php?action=showDashboard&controller=board';
                        }, 1500);
                    } else {
                        showNotification(response.error || 'Failed to create board', 'error');
                    }
                },
                error: function(xhr, status, error) {
                    setLoading(false);
                    showNotification('Network error. Please try again.', 'error');
                }
            });
        }

        // Loading State Management
        function setLoading(loading) {
            const createBtn = document.getElementById('createBtn');
            isLoading = loading;
            
            if (loading) {
                createBtn.disabled = true;
                createBtn.classList.add('loading');
                createBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Creating...';
            } else {
                createBtn.disabled = false;
                createBtn.classList.remove('loading');
                createBtn.innerHTML = '<i class="fas fa-plus"></i> Create Board';
            }
        }

        // Enhanced Notification System
        function showNotification(message, type = 'info') {
            // Remove existing notifications
            const existingNotifications = document.querySelectorAll('.notification-toast');
            existingNotifications.forEach(notification => notification.remove());

            // Create notification element
            const notification = document.createElement('div');
            notification.className = `notification-toast notification-${type}`;
            notification.innerHTML = `
                <div class="notification-content">
                    <i class="fas fa-${type === 'success' ? 'check-circle' : type === 'error' ? 'exclamation-circle' : 'info-circle'}"></i>
                    <span>${message}</span>
                </div>
                <button class="notification-close" onclick="this.parentElement.remove()">
                    <i class="fas fa-times"></i>
                </button>
            `;

            // Add styles for notification
            notification.style.cssText = `
                position: fixed;
                top: 20px;
                right: 20px;
                background: ${type === 'success' ? '#10b981' : type === 'error' ? '#ef4444' : '#3b82f6'};
                color: white;
                padding: 16px 20px;
                border-radius: 12px;
                box-shadow: 0 10px 40px rgba(0, 0, 0, 0.2);
                z-index: 3000;
                display: flex;
                align-items: center;
                gap: 12px;
                max-width: 400px;
                animation: slideInRight 0.3s ease;
            `;

            document.body.appendChild(notification);

            // Auto remove after 5 seconds
            setTimeout(() => {
                if (notification.parentElement) {
                    notification.style.animation = 'slideOutRight 0.3s ease';
                    setTimeout(() => notification.remove(), 300);
                }
            }, 5000);
        }

        // Enhanced Search Functionality
        function initializeSearch() {
            const searchInput = document.getElementById('searchInput');
            if (searchInput) {
                searchInput.addEventListener('input', function() {
                    const query = this.value.toLowerCase();
                    const boardCards = document.querySelectorAll('.board-card');
                    
                    boardCards.forEach(card => {
                        const title = card.querySelector('.board-title').textContent.toLowerCase();
                        const cardContainer = card.closest('a');
                        
                        if (title.includes(query)) {
                            cardContainer.style.display = 'block';
                        } else {
                            cardContainer.style.display = 'none';
                        }
                    });
                });
            }
        }

        // Enhanced Form Validation
        function initializeFormValidation() {
            const boardNameInput = document.getElementById('boardName');
            const createBtn = document.getElementById('createBtn');

            if (boardNameInput) {
                boardNameInput.addEventListener('input', function() {
                    const value = this.value.trim();
                    const isValid = value.length >= 3;
                    
                    if (isValid) {
                        this.style.borderColor = '#10b981';
                    } else {
                        this.style.borderColor = '#e2e8f0';
                    }
                });
            }
        }

        // Keyboard Shortcuts
        function initializeKeyboardShortcuts() {
            document.addEventListener('keydown', function(e) {
                // Escape key to close modal
                if (e.key === 'Escape') {
                    const modal = document.getElementById('createBoardModal');
                    if (modal.classList.contains('active')) {
                        closeModal();
                    }
                }
                
                // Ctrl/Cmd + N to create new board
                if ((e.ctrlKey || e.metaKey) && e.key === 'n') {
                    e.preventDefault();
                    openModal();
                }
            });
        }

        // Initialize all functionality
        document.addEventListener('DOMContentLoaded', function() {
            initializeSearch();
            initializeFormValidation();
            initializeKeyboardShortcuts();
            
            // Add smooth animations to board cards
            const boardCards = document.querySelectorAll('.board-card, .add-board-card');
            boardCards.forEach((card, index) => {
                card.style.animationDelay = `${index * 0.1}s`;
                card.style.animation = 'fadeInUp 0.6s ease forwards';
            });
        });

        // Add CSS for animations
        const style = document.createElement('style');
        style.textContent = `
            @keyframes slideInRight {
                from { transform: translateX(100%); opacity: 0; }
                to { transform: translateX(0); opacity: 1; }
            }
            
            @keyframes slideOutRight {
                from { transform: translateX(0); opacity: 1; }
                to { transform: translateX(100%); opacity: 0; }
            }
            
            @keyframes fadeInUp {
                from { transform: translateY(20px); opacity: 0; }
                to { transform: translateY(0); opacity: 1; }
            }
            
            .notification-toast {
                font-family: 'Inter', sans-serif;
            }
            
            .notification-content {
                display: flex;
                align-items: center;
                gap: 8px;
                flex: 1;
            }
            
            .notification-close {
                background: none;
                border: none;
                color: white;
                cursor: pointer;
                padding: 4px;
                border-radius: 4px;
                transition: background 0.2s;
            }
            
            .notification-close:hover {
                background: rgba(255, 255, 255, 0.2);
            }
        `;
        document.head.appendChild(style);
    </script>

</body>
</html>