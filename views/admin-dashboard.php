<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - KaaryaHub</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
            background: #f8fafc;
            color: #2d3748;
            line-height: 1.6;
        }

        .admin-header {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 20px 0;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
        }

        .admin-header-content {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .admin-logo {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .admin-logo i {
            font-size: 24px;
        }

        .admin-title {
            font-size: 24px;
            font-weight: 700;
        }

        .admin-user {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .admin-user-info {
            text-align: right;
        }

        .admin-username {
            font-weight: 600;
            font-size: 16px;
        }

        .admin-role {
            font-size: 12px;
            opacity: 0.8;
        }

        .logout-btn {
            background: rgba(255, 255, 255, 0.2);
            border: 1px solid rgba(255, 255, 255, 0.3);
            color: white;
            padding: 8px 16px;
            border-radius: 8px;
            cursor: pointer;
            transition: all 0.3s ease;
            text-decoration: none;
            font-size: 14px;
        }

        .logout-btn:hover {
            background: rgba(255, 255, 255, 0.3);
            transform: translateY(-1px);
        }

        .admin-container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 40px 20px;
        }

        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 24px;
            margin-bottom: 40px;
        }

        .stat-card {
            background: white;
            border-radius: 16px;
            padding: 24px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
            border: 1px solid #e2e8f0;
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }

        .stat-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 8px 30px rgba(0, 0, 0, 0.12);
        }

        .stat-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: linear-gradient(135deg, #667eea, #764ba2);
        }

        .stat-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 16px;
        }

        .stat-title {
            font-size: 14px;
            font-weight: 600;
            color: #718096;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .stat-icon {
            width: 40px;
            height: 40px;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 18px;
            color: white;
        }

        .stat-icon.users { background: linear-gradient(135deg, #667eea, #764ba2); }
        .stat-icon.boards { background: linear-gradient(135deg, #f093fb, #f5576c); }
        .stat-icon.lists { background: linear-gradient(135deg, #4facfe, #00f2fe); }
        .stat-icon.cards { background: linear-gradient(135deg, #43e97b, #38f9d7); }

        .stat-value {
            font-size: 32px;
            font-weight: 700;
            color: #2d3748;
            margin-bottom: 8px;
        }

        .stat-change {
            font-size: 14px;
            color: #48bb78;
            font-weight: 500;
        }

        .admin-sections {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(400px, 1fr));
            gap: 24px;
        }

        .admin-section {
            background: white;
            border-radius: 16px;
            padding: 24px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
            border: 1px solid #e2e8f0;
        }

        .section-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
            padding-bottom: 16px;
            border-bottom: 2px solid #f7fafc;
        }

        .section-title {
            font-size: 18px;
            font-weight: 600;
            color: #2d3748;
        }

        .refresh-btn {
            background: #667eea;
            color: white;
            border: none;
            padding: 8px 16px;
            border-radius: 8px;
            cursor: pointer;
            font-size: 14px;
            transition: all 0.3s ease;
        }

        .refresh-btn:hover {
            background: #5a6fd8;
            transform: translateY(-1px);
        }

        .data-table {
            width: 100%;
            border-collapse: collapse;
        }

        .data-table th,
        .data-table td {
            padding: 12px;
            text-align: left;
            border-bottom: 1px solid #e2e8f0;
        }

        .data-table th {
            background: #f7fafc;
            font-weight: 600;
            color: #4a5568;
            font-size: 14px;
        }

        .data-table td {
            font-size: 14px;
            color: #2d3748;
        }

        .action-btn {
            background: #ff6b6b;
            color: white;
            border: none;
            padding: 6px 12px;
            border-radius: 6px;
            cursor: pointer;
            font-size: 12px;
            transition: all 0.3s ease;
        }

        .action-btn:hover {
            background: #ff5252;
            transform: scale(1.05);
        }

        .loading {
            text-align: center;
            padding: 40px;
            color: #718096;
        }

        .error-message {
            background: #fed7d7;
            color: #c53030;
            padding: 12px 16px;
            border-radius: 8px;
            margin: 20px 0;
        }

        .success-message {
            background: #c6f6d5;
            color: #2f855a;
            padding: 12px 16px;
            border-radius: 8px;
            margin: 20px 0;
        }

        @media (max-width: 768px) {
            .admin-container {
                padding: 20px 10px;
            }
            
            .admin-sections {
                grid-template-columns: 1fr;
            }
            
            .stats-grid {
                grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            }
        }
    </style>
</head>
<body>
    <div class="admin-header">
        <div class="admin-header-content">
            <div class="admin-logo">
                <i class="fas fa-shield-alt"></i>
                <span class="admin-title">Admin Dashboard</span>
            </div>
            <div class="admin-user">
                <div class="admin-user-info">
                    <div class="admin-username"><?php echo htmlspecialchars($_SESSION['admin_username'] ?? 'Admin'); ?></div>
                    <div class="admin-role">System Administrator</div>
                </div>
                <a href="index.php?controller=admin&action=logout" class="logout-btn">
                    <i class="fas fa-sign-out-alt"></i> Logout
                </a>
            </div>
        </div>
    </div>

    <div class="admin-container">
        <div class="stats-grid" id="statsGrid">
            <div class="stat-card">
                <div class="stat-header">
                    <div class="stat-title">Total Users</div>
                    <div class="stat-icon users">
                        <i class="fas fa-users"></i>
                    </div>
                </div>
                <div class="stat-value" id="userCount">-</div>
                <div class="stat-change">+12% from last month</div>
            </div>

            <div class="stat-card">
                <div class="stat-header">
                    <div class="stat-title">Total Boards</div>
                    <div class="stat-icon boards">
                        <i class="fas fa-columns"></i>
                    </div>
                </div>
                <div class="stat-value" id="boardCount">-</div>
                <div class="stat-change">+8% from last month</div>
            </div>

            <div class="stat-card">
                <div class="stat-header">
                    <div class="stat-title">Total Lists</div>
                    <div class="stat-icon lists">
                        <i class="fas fa-list"></i>
                    </div>
                </div>
                <div class="stat-value" id="listCount">-</div>
                <div class="stat-change">+15% from last month</div>
            </div>

            <div class="stat-card">
                <div class="stat-header">
                    <div class="stat-title">Total Cards</div>
                    <div class="stat-icon cards">
                        <i class="fas fa-sticky-note"></i>
                    </div>
                </div>
                <div class="stat-value" id="cardCount">-</div>
                <div class="stat-change">+22% from last month</div>
            </div>
        </div>

        <div class="admin-sections">
            <div class="admin-section">
                <div class="section-header">
                    <h3 class="section-title">Recent Users</h3>
                    <button class="refresh-btn" onclick="loadUsers()">
                        <i class="fas fa-sync-alt"></i> Refresh
                    </button>
                </div>
                <div id="usersTable">
                    <div class="loading">
                        <i class="fas fa-spinner fa-spin"></i> Loading users...
                    </div>
                </div>
            </div>

            <div class="admin-section">
                <div class="section-header">
                    <h3 class="section-title">Recent Boards</h3>
                    <button class="refresh-btn" onclick="loadBoards()">
                        <i class="fas fa-sync-alt"></i> Refresh
                    </button>
                </div>
                <div id="boardsTable">
                    <div class="loading">
                        <i class="fas fa-spinner fa-spin"></i> Loading boards...
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Load initial data
        document.addEventListener('DOMContentLoaded', function() {
            loadStats();
            loadUsers();
            loadBoards();
        });

        function loadStats() {
            fetch('index.php?controller=admin&action=getStats')
                .then(response => response.json())
                .then(data => {
                    document.getElementById('userCount').textContent = data.users || 0;
                    document.getElementById('boardCount').textContent = data.boards || 0;
                    document.getElementById('listCount').textContent = data.lists || 0;
                    document.getElementById('cardCount').textContent = data.cards || 0;
                })
                .catch(error => {
                    console.error('Error loading stats:', error);
                });
        }

        function loadUsers() {
            const container = document.getElementById('usersTable');
            container.innerHTML = '<div class="loading"><i class="fas fa-spinner fa-spin"></i> Loading users...</div>';
            
            fetch('index.php?controller=admin&action=getUsers')
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        displayUsers(data.data);
                    } else {
                        container.innerHTML = '<div class="error-message">Error loading users: ' + (data.message || 'Unknown error') + '</div>';
                    }
                })
                .catch(error => {
                    container.innerHTML = '<div class="error-message">Error loading users: ' + error.message + '</div>';
                });
        }

        function loadBoards() {
            const container = document.getElementById('boardsTable');
            container.innerHTML = '<div class="loading"><i class="fas fa-spinner fa-spin"></i> Loading boards...</div>';
            
            fetch('index.php?controller=admin&action=getBoards')
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        displayBoards(data.data);
                    } else {
                        container.innerHTML = '<div class="error-message">Error loading boards: ' + (data.message || 'Unknown error') + '</div>';
                    }
                })
                .catch(error => {
                    container.innerHTML = '<div class="error-message">Error loading boards: ' + error.message + '</div>';
                });
        }

        function displayUsers(users) {
            const container = document.getElementById('usersTable');
            
            if (!users || users.length === 0) {
                container.innerHTML = '<div class="loading">No users found</div>';
                return;
            }
            
            let html = `
                <table class="data-table">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
            `;
            
            users.forEach(user => {
                html += `
                    <tr>
                        <td>${user.id || '-'}</td>
                        <td>${user.name || '-'}</td>
                        <td>${user.email || '-'}</td>
                        <td>
                            <button class="action-btn" onclick="deleteUser(${user.id})">
                                <i class="fas fa-trash"></i> Delete
                            </button>
                        </td>
                    </tr>
                `;
            });
            
            html += '</tbody></table>';
            container.innerHTML = html;
        }

        function displayBoards(boards) {
            const container = document.getElementById('boardsTable');
            
            if (!boards || boards.length === 0) {
                container.innerHTML = '<div class="loading">No boards found</div>';
                return;
            }
            
            let html = `
                <table class="data-table">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Title</th>
                            <th>Description</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
            `;
            
            boards.forEach(board => {
                html += `
                    <tr>
                        <td>${board.id || '-'}</td>
                        <td>${board.title || '-'}</td>
                        <td>${board.description || '-'}</td>
                        <td>
                            <button class="action-btn" onclick="deleteBoard(${board.id})">
                                <i class="fas fa-trash"></i> Delete
                            </button>
                        </td>
                    </tr>
                `;
            });
            
            html += '</tbody></table>';
            container.innerHTML = html;
        }

        function deleteUser(userId) {
            if (confirm('Are you sure you want to delete this user?')) {
                fetch('index.php?controller=admin&action=deleteUser', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/x-www-form-urlencoded',
                    },
                    body: `userId=${userId}`
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        showMessage('User deleted successfully!', 'success');
                        loadUsers();
                        loadStats();
                    } else {
                        showMessage('Error deleting user: ' + (data.message || 'Unknown error'), 'error');
                    }
                })
                .catch(error => {
                    showMessage('Error deleting user: ' + error.message, 'error');
                });
            }
        }

        function deleteBoard(boardId) {
            if (confirm('Are you sure you want to delete this board?')) {
                fetch('index.php?controller=admin&action=deleteBoard', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/x-www-form-urlencoded',
                    },
                    body: `boardId=${boardId}`
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        showMessage('Board deleted successfully!', 'success');
                        loadBoards();
                        loadStats();
                    } else {
                        showMessage('Error deleting board: ' + (data.message || 'Unknown error'), 'error');
                    }
                })
                .catch(error => {
                    showMessage('Error deleting board: ' + error.message, 'error');
                });
            }
        }

        function showMessage(message, type) {
            const messageDiv = document.createElement('div');
            messageDiv.className = type === 'success' ? 'success-message' : 'error-message';
            messageDiv.textContent = message;
            
            document.body.insertBefore(messageDiv, document.body.firstChild);
            
            setTimeout(() => {
                messageDiv.remove();
            }, 5000);
        }
    </script>
</body>
</html>

