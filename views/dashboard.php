
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard with Enhanced Header</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <style>
        /* Add New Board Card */
        .board-cards {
            display: flex;
            gap: 15px;
            flex-wrap: wrap;
            padding: 20px;
        }

        .add-board-card {
            width: 200px;
            height: 120px;
            background: white;
            border-radius: 8px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.15);
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            cursor: pointer;
            transition: transform 0.2s, box-shadow 0.2s;
        }

        .add-board-card:hover {
            transform: scale(1.05);
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
        }

        .add-board-card .icon {
            font-size: 36px;
            color: #6a11cb;
            margin-bottom: 8px;
        }

        .add-board-card .text {
            font-size: 14px;
            font-weight: bold;
            color: #333;
        }

        body {
            font-family: 'Arial', sans-serif;
            margin: 0;
            padding: 0;
            background: linear-gradient(135deg, #6a11cb, #2575fc);
            color: #333;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }

        header {
            background: white;
            padding: 0px 16px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            display: flex;
            justify-content: space-between;
            align-items: center;
            position: sticky;
            top: 0;
            z-index: 1000;
        }

        header h1 {
            margin: 0;
            font-size: 20px;
            color: #6a11cb;
        }

        .header-right {
            display: flex;
            align-items: center;
            gap: 20px;
        }

        .icon {
            width: 24px;
            height: 24px;
            cursor: pointer;
            transition: transform 0.2s;
        }

        .icon:hover {
            transform: scale(1.1);
        }

        .profile {
            display: flex;
            align-items: center;
            gap: 10px;
            cursor: pointer;
        }

        .profile img {
            width: 32px;
            height: 32px;
            border-radius: 50%;
            border: 2px solid #6a11cb;
        }

        .dropdown {
            position: relative;
        }

        .dropdown-menu {
            display: none;
            position: absolute;
            right: 0;
            top: 50px;
            background: white;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
            width: 200px;
            z-index: 1000;
        }

        .dropdown-menu.active {
            display: block;
        }

        .dropdown-menu a {
            display: block;
            padding: 10px 15px;
            color: #333;
            text-decoration: none;
            font-size: 14px;
            border-bottom: 1px solid #f0f0f0;
        }

        .dropdown-menu a:hover {
            background: #f9f9f9;
        }

        .dropdown-menu a:last-child {
            border-bottom: none;
        }

        header .btn {
            padding: 8px 16px;
            background: linear-gradient(135deg, #6a11cb, #2575fc);
            color: white;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            font-size: 14px;
            font-weight: bold;
            transition: 0.3s;
        }

        header .btn:hover {
            background: linear-gradient(135deg, #2575fc, #6a11cb);
        }

        @media (max-width: 768px) {
            header h1 {
                font-size: 18px;
            }

            .header-right {
                gap: 10px;
            }
        }

        body {
            font-family: 'Arial', sans-serif;
            margin: 0;
            padding: 0;
            background: #f4f4f9;
            color: #333;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }

        /* Recently Viewed Section */
        .recently-viewed {
            margin: 20px;
        }

        .recently-viewed h2 {
            font-size: 16px;
            color: #3751FF;
            font-weight: bold;
            display: flex;
            align-items: center;
            gap: 8px;
            margin-bottom: 15px;
        }

        .recently-viewed h2::before {
            content: '⏰';
            font-size: 18px;
        }

        .board-cards {
            display: flex;
            gap: 15px;
            flex-wrap: wrap;
        }

        .board-card {
            width: 200px;
            height: 120px;
            background: white;
            border-radius: 8px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.15);
            overflow: hidden;
            display: flex;
            flex-direction: column;
            transition: transform 0.2s, box-shadow 0.2s;
            cursor: pointer;
        }

        .board-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
        }

        .board-card .board-image {
            flex: 2;
            background-size: cover;
            background-position: center;
        }

        .board-card .board-title {
            flex: 1;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 14px;
            font-weight: bold;
            color: #333;
            padding: 0 10px;
            text-align: center;
        }

        .modal {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5);
            justify-content: center;
            align-items: center;
            z-index: 1000;
        }

        .modal.active {
            display: flex;
        }

        .modal-content {
            background: white;
            width: 90%;
            max-width: 400px;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
            animation: fadeIn 0.3s ease;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: scale(0.9);
            }
            to {
                opacity: 1;
                transform: scale(1);
            }
        }

        .modal-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 15px;
        }

        .modal-header h3 {
            margin: 0;
            font-size: 18px;
            color: #333;
        }

        .close-btn {
            font-size: 18px;
            font-weight: bold;
            color: #333;
            cursor: pointer;
            background: none;
            border: none;
        }

        .modal-body {
            display: flex;
            flex-direction: column;
            gap: 15px;
        }

        .modal-body input,
        .modal-body textarea {
            width: 94%;
            padding: 9px;
            border: 1px solid #ddd;
            border-radius: 6px;
            font-size: 14px;
        }

        .modal-body textarea {
            resize: none;
        }

        .modal-footer {
            display: flex;
            justify-content: flex-end;
            gap: 10px;
            margin-top: 15px;
        }

        .modal-footer button {
            padding: 10px 20px;
            border: none;
            border-radius: 6px;
            font-size: 14px;
            cursor: pointer;
            transition: background 0.2s;
        }

        .cancel-btn {
            background: #ddd;
            color: #333;
        }

        .cancel-btn:hover {
            background: #ccc;
        }

        .create-btn {
            background: linear-gradient(135deg, #6a11cb, #2575fc);
            color: white;
        }

        .create-btn:hover {
            background: linear-gradient(135deg, #2575fc, #6a11cb);
        }
    </style>
</head>
<body>
    <header>
        <!-- <a href="/" style="text-decoration: none; color: inherit;"><h1 style="display: inline-block; background: linear-gradient(135deg, #6a11cb, #2575fc); padding: 5px 10px; border-radius: 8px; color: white; font-weight: bold;">KaaryaHub</h1></a> -->
        <img src="http://localhost/trello_clone/public/images/KaaryaHub_logo.png" alt="Logo" style="width: 150px; height: 100px;" />
        <div class="header-right">
            <!-- Notifications -->
            <img src="https://img.icons8.com/material-outlined/24/000000/appointment-reminders.png" alt="Notifications" class="icon" title="Notifications">

            <!-- Profile Dropdown -->
            <div class="dropdown">
                <div class="profile" onclick="toggleDropdown()">
                    <img src="" alt="Profile Picture">
                    <span><?php echo $response['userdata']['username']; ?></span>
                </div>
                <div class="dropdown-menu" id="dropdownMenu">
                    <a href="#">Account Settings</a>
                    <a href="#">Notifications</a>
                    <a href="logout.php">Logout</a>
                </div>
            </div>
        </div>
    </header>

    <main>
        <!-- Your Dashboard Content Goes Here -->
        <!-- <p style="text-align: center; color: white; margin-top: 20px;">Welcome to your Trello-like Dashboard!</p> -->
        <div class="recently-viewed">
           <h2>Recently Viewed</h2>
            <div class="board-cards">
                <!-- Board 1 -->
                <div class="add-board-card" onclick="openModal()">
                    <div class="icon">+</div>
                    <div class="text">Add New Board</div>
                </div>
                <?php
                        if (count($response['boardData']) > 0) {
                            foreach ($response['boardData'] as $board) {
                                echo '<a href="index.php?action=showBoard&controller=board&id=' . $board['id'] . '">
                                        <div class="board-card">
                                            <div class="board-image" style="background-image: url(\'https://via.placeholder.com/200x100?text=' . $board['name'] . '\');"></div>
                                            <div class="board-title">' . $board['name'] . '</div>
                                        </div>
                                    </a>';
                            }
                        }
                ?>
                
            </div>
        </div>
    </main>

    <div class="modal" id="createBoardModal">
        <div class="modal-content">
            <div class="modal-header">
                <h3>Create New Board</h3>
                <button class="close-btn" onclick="closeModal()">&times;</button>
            </div>
            <div class="modal-body">
                <input type="text" id="boardName" placeholder="Board Name" required />
                <textarea id="boardDescription" rows="4" placeholder="Board Description"></textarea>
            </div>
            <div class="modal-footer">
                <button class="cancel-btn" onclick="closeModal()">Cancel</button>
                <button class="create-btn" onclick="createBoard()">Create</button>
            </div>
        </div>
    </div>


    
    <script>
        function toggleDropdown() {
            const dropdownMenu = document.getElementById('dropdownMenu');
            dropdownMenu.classList.toggle('active');
        }

        // Close dropdown if clicked outside
        document.addEventListener('click', (event) => {
            const dropdownMenu = document.getElementById('dropdownMenu');
            const profile = document.querySelector('.profile');

            if (!profile.contains(event.target)) {
                dropdownMenu.classList.remove('active');
            }
        });

        function openModal() {
            document.getElementById('createBoardModal').classList.add('active');
        }

        // Close the modal
        function closeModal() {
            document.getElementById('createBoardModal').classList.remove('active');
        }

        // Create a new board (placeholder functionality)
        function createBoard() {
            const boardName = document.getElementById('boardName').value;
            const boardDescription = document.getElementById('boardDescription').value;

            if (boardName.trim() === '') {
                alert('Board name is required!');
                return;
            }

            
            $.ajax({
            type: 'POST',
            url: 'index.php?action=createBoard&controller=board',
            data: {
                boardName: boardName,
                boardDescription: boardDescription
            },
            success: function(response) {
                if (response.success) {
                    alert(response.message);
                    window.location.href = 'index.php?action=showDashboard&controller=board';
                } else {
                    alert(response.error);
                }
            },
            error: function(xhr, status, error) {
                alert(error);
            }
            });
            // Clear input fields
            document.getElementById('boardName').value = '';
            document.getElementById('boardDescription').value = '';

            closeModal();

            // Here, you can implement actual functionality to add the board to the UI or backend.
        }
    </script>

</body>
</html>