
<!DOCTYPE html>
<html lang="en">
<head> 
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard | Task Board</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <style>
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

        .list {
            flex: 1;
            background: white;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            padding: 15px;
        }

        .list h2 {
            font-size: 18px;
            color: #6a11cb;
            margin-bottom: 15px;
            text-align: center;
        }
        .card {
            background: #f9f9f9;
            border: 1px solid #ddd;
            border-radius: 6px;
            padding: 10px;
            margin-bottom: 10px;
            cursor: grab;
            transition: transform 0.2s ease, box-shadow 0.2s ease;
        }

        .card.dragging {
            opacity: 0.5;
            transform: rotate(3deg) scale(1.05);
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
        }

        .list.dragover {
            background: #e0f7fa;
            border: 2px dashed #4caf50;
        }

        header {
            background: white;
            padding: 15px 20px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        header h1 {
            margin: 0;
            font-size: 20px;
            color: #6a11cb;
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

        .dashboard {
               display: block;
            padding: 20px;
            /* overflow: scroll; */
        }

        .board {
            background: white;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            display: inline-block;
            float: left;
            width: 100%;
            max-width: 200px;
            margin-right: 20px;
            padding: 0px 15px;
        }

        .board h2 {
            font-size: 18px;
            color: #6a11cb;
            margin-bottom: 15px;
        }

        .card {
            background: #f9f9f9;
            border: 1px solid #ddd;
            border-radius: 6px;
            padding: 10px;
            margin-bottom: 10px;
            cursor: grab;
            transition: transform 0.2s ease, box-shadow 0.2s ease;
        }

        .card.dragging {
            opacity: 0.5;
            transform: rotate(3deg) scale(1.05);
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
        }

        .list.dragover {
            background: #e0f7fa;
            border: 2px dashed #4caf50;
        }

        .add-card {
            padding: 10px;
            background: linear-gradient(135deg, #6a11cb, #2575fc);
            color: white;
            border: none;
            border-radius: 8px;
            text-align: center;
            cursor: pointer;
            font-size: 14px;
            font-weight: bold;
            margin-top: auto;
            transition: 0.3s;
        }

        .add-card:hover {
            background: linear-gradient(135deg, #2575fc, #6a11cb);
        }

        @media (max-width: 768px) {
            .dashboard {
                flex-direction: column;
                gap: 15px;
            }

            .board {
                flex: 1;
            }
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

         

        /* Cards Layout */
        .board-cards {
            display: flex;
            gap: 15px;
            flex-wrap: wrap;
            padding: 20px;
        }

        .board-card, .add-list-card {
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

        .board-card:hover, .add-list-card:hover {
            transform: scale(1.05);
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
        }

        .board-card .title, .add-list-card .text {
            font-size: 14px;
            font-weight: bold;
            color: #333;
        }

        .add-list-card {
            background: linear-gradient(135deg, #ccaeed, #2575fc);
            color: white;
        }

        .add-list-card .icon {
            font-size: 36px;
            margin-bottom: 8px;
        }

        /* Modal Styles */
        /* .modal {
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
        } */

        .modal.active {
            display: flex;
        }

        .modal-content-list {
            background: white;
            width: 90%;
            max-width: 735px;
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

        /* .modal-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 15px;
        }

        .modal-header h3 {
            margin: 0;
            font-size: 18px;
            color: #333;
        } */

        .close-btn {
            font-size: 18px;
            font-weight: bold;
            color: #333;
            cursor: pointer;
            background: none;
            border: none;
        }

        /* .modal-body {
            display: flex;
            flex-direction: column;
            gap: 15px;
        }

        .modal-body input {
            width: 95%;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 6px;
            font-size: 14px;
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
        } */

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

        @media (max-width: 768px) {
            .board-cards {
                justify-content: center;
            }
        }

        .create-task-btn {
            width: 100%;
            padding: 10px 15px;
            font-size: 16px;
            font-weight: bold;
            color: white;
            background: linear-gradient(135deg, #6a11cb, #2575fc);
            border: none;
            border-radius: 6px;
            cursor: pointer;
            text-align: center;
            transition: background 0.3s, transform 0.2s;
            margin: 0 0 10px 0;
        }

        .create-task-btn:hover {
            background: linear-gradient(135deg, #2575fc, #6a11cb);
            transform: scale(1.05);
        }

        .create-task-btn {
            width: 100%;
            padding: 12px;
            font-size: 16px;
            font-weight: bold;
            color: white;
            background: linear-gradient(135deg, #6a11cb, #2575fc);
            border: none;
            border-radius: 6px;
            cursor: pointer;
            text-align: center;
            transition: background 0.3s, transform 0.2s;
        }

        .create-task-btn:hover {
            background: linear-gradient(135deg, #2575fc, #6a11cb);
            transform: scale(1.05);
        }

        .create-activity-btn{
            width: 33%;
            padding: 6px 6px;
            font-size: 14px;
            font-weight: bold;
            color: white;
            background: linear-gradient(135deg, #6a11cb, #2575fc);
            border: none;
            border-radius: 6px;
            cursor: pointer;
            text-align: center;
            transition: background 0.3s, transform 0.2s;
            margin: 0 0 10px 0;
        }
        /* Modal Styles */
        .modal-list {
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

        .modal-list.active {
            display: flex;
        }

        .modal-content-list createlist {
            background: white;
            width: 20%;
            max-width: 900px;
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

        .modal-header-list {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 15px;
        }

        .modal-header-list h3 {
            margin: 0;
            font-size: 20px;
            color: #333;
        }

        .close-btn {
            font-size: 20px;
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
        .modal-body textarea,
        .modal-body select {
            width: 95%;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 6px;
            font-size: 14px;
            font-weight: bold;
        }

        .modal-body {
            display: flex;
            flex-direction: column;
            font-size: 14px;
        }

        .modal-body input {
            margin-top: 5px;
            padding: 8px;
            font-size: 14px;
            border-radius: 6px;
            border: 1px solid #ddd;
            background: #f9f9f9;
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

        .save-btn {
            background: linear-gradient(135deg, #6a11cb, #2575fc);
            color: white;
        }

        .save-btn:hover {
            background: linear-gradient(135deg, #2575fc, #6a11cb);
        }

        /* Task List */
        .tasks {
            margin-top: 15px;
        }

        .task {
            background: #f9f9f9;
            border: 1px solid #ddd;
            border-radius: 6px;
            padding: 10px;
            margin-bottom: 10px;
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .modal-content {
                padding: 15px;
            }

            .modal-header h3 {
                font-size: 18px;
            }

            .modal-body input,
            .modal-body textarea,
            .modal-body select {
                font-size: 13px;
            }
        }

         .task-input-container {
            display: none;
            margin-top: 10px;
            display: flex;
            gap: 10px;
            margin: 10px 0 10px 0;
        }

        .task-input-container input {
            flex: 1;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 6px;
            font-size: 14px;
            min-width: 100px;
        }

        .task-input-container button {
            padding: 10px 15px;
            border: none;
            border-radius: 6px;
            font-size: 14px;
            cursor: pointer;
            background: #6a11cb;
            color: white;
            transition: background 0.3s;
        }

        .task-input-container button:hover {
            background: #2575fc;
        }

         .modal-header edit button {
            background: none;
            border: none;
            font-size: 20px;
            color: white;
            cursor: pointer;
        }

         /* Modal Header */
        .modal-header edit {
            background: #6a11cb;
            color: white;
            padding: 15px 20px;
            /* display: flex; */
            /* justify-content: space-between; */
            align-items: center;
        }

        .list-status {
            background: #e0e0f9;
            color: #6a11cb;
            padding: 5px 10px;
            border-radius: 5px;
            font-size: 14px;
            font-weight: bold;
            color: white;
        }
        /* Modal Content */
        /* .modal-content edit {
            display: flex;
            gap: 20px;
            padding: 20px;
        }

        .modal-left {
            flex: 2;
            min-width: 300px;
        }

        .modal-right {
            flex: 1;
            min-width: 250px;
            background: #f9f9f9;
            padding: 15px;
            border-radius: 8px;
            border: 1px solid #ddd;
            display: flex;
            flex-direction: column;
            gap: 20px;
        } */

        .task-title {
            font-size: 20px;
            font-weight: bold;
            color: #333;
            margin-bottom: 10px;
        }
        /* Button Layer */
        .button-layer {
            display: flex;
            gap: 10px;
            flex-wrap: wrap;
            margin-bottom: 20px;
        }

        .button-layer button {
            display: flex;
            align-items: center;
            gap: 5px;
            padding: 5px 15px;
            background: white;
            border: 1px solid #d0d7de;
            border-radius: 6px;
            font-size: 14px;
            color: #333;
            cursor: pointer;
        }

        .button-layer button:hover {
            background: #f4f4f9;
        }

        .button-layer button svg {
            width: 16px;
            height: 16px;
        }

        /* Members Section */
        .members-section {
            margin-bottom: 20px;
        }

        .members-section h4 {
            font-size: 16px;
            font-weight: bold;
            margin-bottom: 10px;
            color: #555;
        }

        .members {
            display: flex;
            align-items: center;
            position: relative;
        }

        .member {
            display: inline-flex;
            justify-content: center;
            align-items: center;
            background: #6a11cb;
            color: white;
            border-radius: 50%;
            width: 42px;
            height: 42px;
            font-size: 14px;
            font-weight: bold;
            cursor: pointer;
            border: 2px solid white;
            margin-left: -15px;
            z-index: 1;
        }

        .member:hover {
            background: #2575fc;
        }

        .add-member {
            display: inline-flex;
            justify-content: center;
            align-items: center;
            background: #f4f4f9;
            color: #6a11cb;
            border-radius: 50%;
            width: 42px;
            height: 42px;
            font-size: 20px;
            font-weight: bold;
            cursor: pointer;
            border: 2px dashed #6a11cb;
            margin-left: -15px;
            z-index: 0;
        }

        .add-member:hover {
            background: #e0e0f9;
        }
        /* Description Area */
        .description {
            margin-top: 20px;
        }

        .description textarea {
            width: 100%;
            height: 100px;
            font-size: 14px;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 6px;
            resize: vertical;
            font-family: 'Arial', sans-serif;
        }

        .description textarea:focus {
            outline: none;
            border-color: #6a11cb;
        }

        .description-actions {
            display: none;
            margin-top: 10px;
            gap: 10px;
        }

        .description-actions button {
            padding: 8px 15px;
            font-size: 14px;
            border-radius: 6px;
            cursor: pointer;
            border: none;
        }

        .description-actions .save-btn {
            background: #6a11cb;
            color: white;
        }

        .description-actions .cancel-btn {
            background: #ddd;
            color: #333;
        }

        .dummy-description {
            margin-top: 10px;
            font-size: 14px;
            color: #555;
            line-height: 1.5;
        }
       /* Activity Section */
        .activity-section {
            display: flex;
            flex-direction: column;
            gap: 10px;
        }

        .activity-section h4 {
            font-size: 16px;
            font-weight: bold;
            color: #555;
        }

        .activity-log-item {
            flex: 1;
            overflow-y: auto; */
            padding: 10px;
            background: white;
            border-radius: 6px;
            /* border: 1px solid #ddd; */
            word-wrap: break-word; /* Wrap long words to the next line */
            word-break: break-word;
            text-align: right;
            /* overflow-y: auto; */
        }

        .user-icon {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background-color: #6a11cb; /* Default user icon color */
            color: white;
            display: flex;
            justify-content: center;
            align-items: center;
            font-size: 14px;
            font-weight: bold;
            margin: 10px 0;
        }

        .activity-item {
            margin-bottom: 10px;
            font-size: 14px;
            color: #444;
            word-wrap: break-word; /* Wrap long words to the next line */
            word-break: break-word;
            overflow-y: auto;
        }

        .add-comment {
            display: flex;
            gap: 10px;
        }

        .add-comment input {
            flex: 1;
            padding: 8px;
            font-size: 14px;
            border-radius: 6px;
            border: 1px solid #ddd;
        }

        .add-comment button {
            background: #6a11cb;
            color: white;
            border: none;
            padding: 8px 12px;
            border-radius: 6px;
            cursor: pointer;
        }


        /* MODAL csss */
        .open-modal-btn {
            padding: 12px 24px;
            background: #6a11cb;
            color: white;
            border: none;
            border-radius: 8px;
            font-size: 16px;
            font-weight: bold;
            cursor: pointer;
            transition: background 0.3s;
        }

        .open-modal-btn:hover {
            background: #5b0fb8;
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
        }

        .modal.active {
            display: flex;
        }

        .modal-content {
            background: white;
            width: 90%;
            max-width: 800px;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.2);
        }

       
        .modal-header {
            background: #6a11cb;
            color: white;
            padding: 15px 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin: 0 0 10px 0px;
        }

        .modal-header .list-status {
            background: #e0e0f9;
            color: #6a11cb;
            padding: 5px 10px;
            border-radius: 5px;
            font-size: 14px;
            font-weight: bold;
        }

        .modal-header button {
            background: none;
            border: none;
            font-size: 20px;
            color: white;
            cursor: pointer;
        }

        
        .modal-body {
            display: grid;
            gap: 25px;
            justify-content: space-between;
            align-items: flex-start;
            flex-wrap: wrap;
            grid-template-columns: 60% auto;
            padding: 0px 20px 20px;
        }
        .modal-left {
            flex: 2; /* Take up more space for the left section */
            min-width: 60%; /* Ensure the left section always has enough width */
        }
       

        .modal-right {
            flex: 1;
            min-width: 35%;
            background: #f9f9f9;
            border-radius: 8px;
            box-shadow: inset 0 0 5px rgba(0, 0, 0, 0.1);
            display: flex;
            flex-direction: column;
            gap: 15px;

            /* Enable horizontal scroll */
            overflow-y: auto;
            overflow-x: hidden;/* Optional: only scroll horizontally */ /* Prevent wrapping if you want content to scroll horizontally */
        }


        .task-title {
            font-size: 20px;
            font-weight: bold;
            color: #333;
            margin-bottom: 15px;
        }

        
        .button-layer {
            display: flex;
            gap: 10px;
            margin-bottom: 20px;
        }

        .button-layer button {
            padding: 8px 15px;
            background: #f4f4f9;
            border: 1px solid #ddd;
            border-radius: 6px;
            font-size: 14px;
            color: #555;
            cursor: pointer;
            transition: background 0.3s;
        }

        .button-layer button:hover {
            background: #eaeaea;
        }

        
        .members-section {
            margin-bottom: 20px;
        }

        .members-section h4 {
            font-size: 16px;
            font-weight: bold;
            margin-bottom: 10px;
            color: #555;
        }

        .members {
            display: flex;
            align-items: center;
        }

        .member {
            background: #6a11cb;
            color: white;
            border-radius: 50%;
            width: 40px;
            height: 40px;
            display: flex;
            justify-content: center;
            align-items: center;
            font-size: 14px;
            font-weight: bold;
            margin-right: -10px;
            border: 2px solid white;
            cursor: pointer;
        }

        .member:hover {
            background: #5b0fb8;
        }

        .add-member {
            background: #f4f4f9;
            color: #6a11cb;
            border-radius: 50%;
            width: 40px;
            height: 40px;
            display: flex;
            justify-content: center;
            align-items: center;
            font-size: 20px;
            font-weight: bold;
            border: 2px dashed #6a11cb;
            cursor: pointer;
        }

        .add-member:hover {
            background: #eaeaea;
        }

       
        .description textarea {
            width: 100%;
            height: 80px;
            font-size: 14px;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 6px;
            resize: vertical;
        }

       
        .activity-section {
            display: flex;
            flex-direction: column;
            gap: 10px;
            height: 400px
        }

        .activity-log {
            background: white;
            padding: 10px;
            border-radius: 6px;
            border: 1px solid #ddd;
            font-size: 14px;
            color: #555;
        }

        .add-comment {
            display: flex;
            gap: 10px;
        }

        .add-comment input {
            flex: 1;
            padding: 8px;
            font-size: 14px;
            border: 1px solid #ddd;
            border-radius: 6px;
        }

        .add-comment-btn button {
            padding: 8px 15px;
            background: #6a11cb;
            color: white;
            border: none;
            border-radius: 6px;
            cursor: pointer;
        } 

        .datepicker {
            margin-top: 15px;
            padding: 15px;
            background: #f9f9f9;
            border: 1px solid #ddd;
            border-radius: 6px;
            display: flex;
            flex-direction: column;
            gap: 10px;
        }

        .datepicker label {
            font-size: 14px;
            color: #555;
        }

        .datepicker input {
            padding: 8px;
            border: 1px solid #ddd;
            border-radius: 6px;
            font-size: 14px;
        }

        .datepicker .save-btn {
            align-self: flex-start;
            padding: 8px 16px;
            background: #6a11cb;
            color: white;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            transition: background 0.3s;
        }

        .datepicker .save-btn:hover {
            background: #2575fc;
        }

        .hidden {
            display: none;
        }

        /* Modal Container */
        .modal-datepicker {
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

        .modal-datepicker.active {
            display: flex;
        }

        /* Modal Content */
        .modal-datepicker-content {
            background: white;
            width: 10%;
            max-width: 400px;
            border-radius: 10px;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.2);
            animation: fadeIn 0.3s ease;
            padding: 20px;
        }

        /* Animation */
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

        /* Header */
        .modal-datepicker-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 15px;
        }

        .datepicker-title {
            font-size: 18px;
            color: #333;
            margin: 0;
        }

        .btn-close-datepicker {
            background: none;
            border: none;
            font-size: 20px;
            color: #333;
            cursor: pointer;
        }

        /* Body */
        .modal-datepicker-body {
            display: flex;
            flex-direction: column;
            gap: 15px;
        }

        .datepicker-label {
            font-size: 14px;
            color: #555;
        }

        .datepicker-input {
            padding: 8px;
            border: 1px solid #ddd;
            border-radius: 6px;
            font-size: 14px;
            width: 100%;
        }

        /* Save Button */
        .btn-save-dates {
            padding: 8px 16px;
            background: #6a11cb;
            color: white;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            transition: background 0.3s;
        }

        .btn-save-dates:hover {
            background: #2575fc;
        }

        /* Hidden Class */
        .hidden {
            display: none;
        }

        /* General Styles */
        /* * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Arial', sans-serif;
        }

        body {
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            background: linear-gradient(135deg, #6a11cb, #2575fc);
        } */

        /* Custom Modal Background */
        /* Popover Trigger Button */
        .popover-btn {
            padding: 12px 25px;
            background: #6a11cb;
            color: white;
            border: none;
            border-radius: 8px;
            font-size: 16px;
            cursor: pointer;
            position: relative;
        }

        /* Popover Container */
        .custom-popover {
            display: none;
            position: absolute;
            top: 319px;
            left: 38%;
            transform: translateX(-50%);
            background: #ffffff;
            width: 10%;
            max-width: 400px;
            padding: 20px;
            border-radius: 20px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
            animation: fadeIn 0.3s ease;
            z-index: 1000;
        }

        .custom-popover.active {
            display: block;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(-10px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* Popover Header */
        .popover-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 15px;
        }

        .popover-header h3 {
            font-size: 18px;
            color: #333;
        }

        .popover-header button {
            background: none;
            border: none;
            font-size: 20px;
            color: #333;
            cursor: pointer;
            transition: color 0.3s;
        }

        .popover-header button:hover {
            color: #6a11cb;
        }

        /* Members Section */
        .members-section {
            display: flex;
            flex-direction: column;
            gap: 20px;
        }

        /* Member List Section */
        .member-list-section {
            display: flex;
            flex-direction: column;
            gap: 10px;
        }

        .member-list-section h4 {
            font-size: 16px;
            color: #6a11cb;
        }

        /* Scrollable Member List */
        .popover-members-list {
            max-height: 150px;
            overflow-y: auto;
            display: flex;
            flex-direction: column;
            gap: 10px;
            padding-right: 5px;
        }

        .popover-members-list::-webkit-scrollbar {
            width: 6px;
        }

        .popover-members-list::-webkit-scrollbar-thumb {
            background: #6a11cb;
            border-radius: 4px;
        }

        .popover-members-list::-webkit-scrollbar-track {
            background: #f4f4f9;
        }

        /* Member Item */
        .popover-member {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 10px 12px;
            border: 1px solid #ddd;
            border-radius: 8px;
            background: #f9f9f9;
            cursor: pointer;
            transition: background 0.3s, box-shadow 0.3s;
        }

        .popover-member:hover {
            background: #eaeaea;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .popover-member span {
            font-size: 14px;
            color: #333;
        }

        .popover-add-member {
            font-size: 13px;
            color: #6a11cb;
            cursor: pointer;
        }

        @media (max-width: 500px) {
            .custom-popover {
                width: 95%;
                padding: 15px;
            }

            .popover-header h3 {
                font-size: 16px;
            }

            .popover-member span {
                font-size: 12px;
            }
        }
        
        .activity-top-row {
            display: flex;
            align-items: center;
            gap: 13px;
            }

        .date {
            font-size: 10px;
            color: #333;
            }
    </style>
</head>
<body>
    <header>
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
                <div class="dropdown-menu" id="dropdownMenuBoard">
                    <a href="#">Account Settings</a>
                    <a href="#">Notifications</a>
                    <a href="logout.php">Logout</a>
                </div>
            </div>
         </div>
    </header>

    <main class="dashboard" data-board-id="<?php echo $response['boardId']; ?>">

        <?php foreach ($response['listData'] as $list) : ?>
            <div class="board" data-list-id="<?php echo $list['id']; ?>" data-list-position="<?php echo $list['position']; ?>">
                <h2><?php echo htmlspecialchars($list['title']); ?></h2>
                <?php if ($list['position'] == 1): ?>
                    <button class="create-task-btn" id="toggleTaskInput" onclick="OpenTaskModal()">+ Create Task</button>
                    <div class="task-input-container" style="display: none;" id="taskInputContainer">
                        <input type="text" id="taskTitleInput" placeholder="Enter task title" />
                        <button id="addTask" onclick="CreateTask()">Add</button>
                    </div>
                <?php endif; ?>
                  
                    <?php $i = 1; ?>
                    <?php foreach ($list['cards'] as $task): ?>
                        <div class="card" draggable="true"data-card-position-no="<?php echo $i; ?>" data-card-id="<?php echo $task['id']; ?>"><?php echo htmlspecialchars($task['title']); ?></div>
                        <?php $i++; ?>
                    <?php endforeach; ?>
            </div>
        <?php  endforeach; ?>
        
        <div class="add-list-card" onclick="openModal()">
            <div class="icon">+</div>
            <div class="text">Create New List</div>
        </div>
    </main>

    <div class="modal-list" id="createListModal">
        <div class="modal-content-list createlist">
            <div class="modal-header-list">
                <h3>Create New List</h3>
                <button class="close-btn" onclick="closeModal()">&times;</button>
            </div>
            <div class="modal-body">
                <input type="text" id="listName" placeholder="List Name" required />
            </div>
            <div class="modal-footer">
                <button class="cancel-btn" onclick="closeModal()">Cancel</button>
                <button class="create-btn" onclick="createList()">Create</button>
            </div>
        </div>
    </div>
    

    <div class="modal" id="task-modal">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                <div class="list-status">In Progress</div>
                <button id="closeModalButton">&times;</button>
            </div>

            <!-- Modal Body -->
            <div class="modal-body">
                <!-- Left Section -->
                <div class="modal-left">
                    <div class="task-title" id="task-title">TASK TITLE</div>
                    <div class="button-layer">
                        <button>
                            <img src="https://cdn-icons-png.flaticon.com/128/17120/17120297.png" alt="labels" width="20px" height="20px">
                            Labels
                        </button>

                        <button id="btn-open-datepicker">
                            <img src="https://cdn-icons-png.flaticon.com/128/4626/4626416.png" alt="dates" width="20px" height="20px">
                            Dates
                        </button>

                        <button onclick="document.getElementById('fileInput').click()">
                            <img src="https://cdn-icons-png.flaticon.com/128/1979/1979226.png" alt="attachment" width="20px" height="20px">
                            Attachment
                        </button>

                        <input type="file" id="fileInput" style="display: none;">

                    </div>
                    <div class="modal-datepicker hidden">
                        <div class="modal-datepicker-content">
                            <div class="modal-datepicker-header">
                                <h4 class="datepicker-title">Select Dates</h4>
                                <button class="btn-close-datepicker">&times;</button>
                            </div>
                            <div class="modal-datepicker-body" data-date-range-for-card="<?php echo $task['id']; ?>">
                                <label for="startDate" class="datepicker-label">Start Date:</label>
                                <input type="date" id="startDate" class="datepicker-input">
                                <label for="endDate" class="datepicker-label">End Date:</label>
                                <input type="date" id="endDate" class="datepicker-input">
                                <button class="btn-save-dates">Save Dates</button>
                            </div>
                        </div>
                    </div>

                    <div class="members-section">
                        <h4>Members</h4>
                        <div class="members" id="members-list">
                            <!-- <div class="member" title="Chetan Gupta">CG</div>
                            <div class="member" title="John Doe">JD</div>
                            <div class="member" title="Alice Smith">AS</div>
                            <div class="add-member" title="Add Member" onclick="openCustomMembersModal()">+</div> -->
                        </div>
                    </div>
                    <div class="description">
                        <textarea id="description-textarea" placeholder="Add a description..."></textarea>
                        <div class="description-actions" id="description-actions" style="display: none;">
                            <button class="save-btn" id ="save-btn">Save</button>
                            <button class="cancel-btn">Cancel</button>
                        </div>
                    </div>
                </div>

                <!-- Right Section -->
                <div class="modal-right">
                    <div class="activity-section">
                        <!-- <p> Comment & Activity </p> -->
                        <div class="add-comment">
                            <input type="text" id="text-activity" placeholder="Write a comment...">
                        </div>
                        <button class="create-activity-btn" id="toggleActivityInput" style="display: none;">Add</button>
                       <div class="activity-log" id="activity-log"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>

     <!-- Custom Modal -->
    <div class="custom-popover" id="custom-members-modal">
        <!-- Popover Header -->
        <div class="popover-header">
            <h3>Manage Members</h3>
            <button onclick="closeCustomPopover()">&times;</button>
        </div>

        <!-- Members Section -->
        <div class="members-section">
            <!-- Card Members -->
            <div class="member-list-section">
                <h4>Card Members</h4>
                <div class="popover-members-list" id="card-members">
                    <!-- <div class="popover-member" data-name="John Doe">
                        <span>John Doe</span>
                        <span class="popover-add-member" onclick="removeFromCardMembers(this)">Remove</span>
                    </div> -->
                </div>
            </div>

            <!-- Board Members -->
            <div class="member-list-section">
                <h4>Board Members</h4>
                <div class="popover-members-list" id="board-members">
                    
                    <!-- <div class="popover-member" data-name="David Lee">
                        <span>David Lee</span>
                        <span class="popover-add-member" onclick="moveToCardMembers(this)">Add</span>
                    </div>
                    <div class="popover-member" data-name="Emma Watson">
                        <span>Emma Watson</span>
                        <span class="popover-add-member" onclick="moveToCardMembers(this)">Add</span>
                    </div> -->
                </div>
            </div>
        </div>
    </div>

    <script>
    
            $(document).ready(function () {
                $('#toggleTaskInput').click(function () {
                $('#taskInputContainer').slideToggle(); // Toggle the input field with animation
                $('#taskTitleInput').focus(); // Focus on the input field if visible
                });
            });

             document.getElementById('text-activity').addEventListener('click', function () {
                const activityButton = document.getElementById('toggleActivityInput');
                activityButton.style.display = 'block';
            });

            function OpenTaskModal() {
            document.getElementById("taskInputContainer").classList.toggle("hidden")
            }

            function CreateTask() {
                    const title = $('#taskTitleInput').val().trim();
                    const boardId = $('.dashboard').attr('data-board-id');
                    const listId = $('.board').attr('data-list-id');
                    const listPosition = $('.board').attr('data-list-position');
                    if (!title) {
                        alert('Task Title is required.');
                        return;
                    }

                    $.ajax({
                        type: 'POST',
                        url: 'index.php?action=createCard&controller=card',
                        data: {
                            title: title,
                            listId: listId,
                            boardId: boardId,
                            listPosition: listPosition

                        },
                        success: function(response) {
                            if (response.success) {
                                alert(response.message);
                            }else{
                                alert(response.message);
                            }
                                
                        },
                        error: function(xhr, status, error) {
                            alert(error);
                        }

                        
                    })

                    // Close modal and reset fields
                    $('#createTaskModal').removeClass('active');
                    $('#taskTitle').val('');
                    $('#taskDescription').val('');
                    $('#taskStartDate').val('');
                    $('#taskEndDate').val('');
                    $('#taskPriority').val('');
                    $('#taskLabels').val('');
                    $('#taskAttachment').val('');
                
            }

            // Toggle dropdown
            function toggleDropdown() {
            $('#dropdownMenuBoard').toggleClass('active');
            }
         
            // Close dropdown if clicked outside
            $(document).on('click', function(event) {
            const dropdownMenu = $('#dropdownMenuBoard');
            const profile = $('.profile');

            if (!profile.has(event.target).length) {
                dropdownMenu.removeClass('active');
            }
            });


            let draggedCard = null;
            let sourceListId = null;

            // Drag-and-drop functionality
            const cards = document.querySelectorAll('.card');
            const lists = document.querySelectorAll('.board');

            cards.forEach(card => {
                card.addEventListener('dragstart', () => {
                    draggedCard = card;
                    sourceListId = card.closest('.board').getAttribute('data-list-id'); // Store source list ID
                    card.classList.add('dragging');
                });

                card.addEventListener('dragend', () => {
                    draggedCard = null;
                    sourceListId = null;
                    card.classList.remove('dragging');
                });
            });

            lists.forEach(list => {
                list.addEventListener('dragover', (e) => {
                    e.preventDefault();
                    list.classList.add('dragover');

                    const afterElement = getDragAfterElement(list, e.clientY);
                    if (afterElement) {
                        list.insertBefore(draggedCard, afterElement);
                    } else {
                        list.appendChild(draggedCard);
                    }
                });

                list.addEventListener('dragleave', () => {
                    list.classList.remove('dragover');
                });

                list.addEventListener('drop', () => {
                    list.classList.remove('dragover');

                    const targetListId = list.getAttribute('data-list-id'); // Get target list ID

                    if (draggedCard) {
                        // Recalculate positions for both source and target lists
                        const sourceList = document.querySelector(`.board[data-list-id="${sourceListId}"]`);
                        const targetList = list;

                        const sourceCardIds = Array.from(sourceList.querySelectorAll('.card')).map((card, index) => ({
                            cardId: card.getAttribute('data-card-id'),
                            position: index + 1
                        }));

                        const targetCardIds = Array.from(targetList.querySelectorAll('.card')).map((card, index) => ({
                            cardId: card.getAttribute('data-card-id'),
                            position: index + 1
                        }));

                        // Send AJAX request to update positions in the database
                        $.ajax({
                            type: "POST",
                            url: "index.php?action=updateCardPositions&controller=card",
                            data: {
                                sourceListId,
                                sourceCardIds,
                                targetListId,
                                targetCardIds,
                                movedCardId: draggedCard.getAttribute('data-card-id'),
                                boardId: $('.dashboard').attr('data-board-id')
                            },
                            success: function (response) {
                                if (response.success) {
                                    alert(response.message);
                                }else{
                                    alert(response.error);   
                                } 
                            },
                            error: function (xhr, status, error) {
                                alert(error);
                            }
                        });
                    }
                });
            });

        // Helper function to calculate where to place the dragged card
            function getDragAfterElement(list, y) {
                const draggableElements = [...list.querySelectorAll('.card:not(.dragging)')];

                return draggableElements.reduce((closest, child) => {
                    const box = child.getBoundingClientRect();
                    const offset = y - box.top - box.height / 2;

                    if (offset < 0 && offset > closest.offset) {
                        return { offset, element: child };
                    } else {
                        return closest;
                    }
                }, { offset: Number.NEGATIVE_INFINITY }).element;
            }

            // Open modal
            function openModal() {
            $('#createListModal').addClass('active');
            }

            // Close the modal
            function closeModal() {
            $('#createListModal').removeClass('active');
            }

            // Create a new list (placeholder functionality)
            function createList() {
                const listName = $('#listName').val();
                const boardId  = $('.dashboard').attr('data-board-id');
                if (listName.trim() === '') {
                    alert('List name is required!');
                }

                $.ajax({
                    type: 'POST',
                    url: 'index.php?action=createList&controller=list',
                    data: {
                        listName: listName,
                        listDescription: listName,
                        boardId: boardId
                    },
                    success: function(response) {
                        if (response.success) {
                            alert(response.message);
                        } else {
                            alert(response.message);
                        }
                    },
                    error: function(xhr, status, error) {
                        alert(error);
                    }
                });
                

                // alert(`List "${listName}" created successfully!`);
                closeModal();

            // Here, you can implement actual functionality to add the list to the UI or backend.
            } 

            // Declare required DOM elements
            const modal = document.getElementById('task-modal');
            const modalTitle = document.getElementById('task-title');
            const modalDesc = document.getElementById('task-desc');
            const saveBtn = document.getElementById('save-btn');
            const commentList = document.getElementById('comment-list');
            const newComment = document.getElementById('new-comment');
            const membersList = document.getElementById('members-list');
            const boardMembersDropdown = document.getElementById('board-members');
            const addActivityLog = document.getElementById('activity-log');
            const activitySubmitButton = document.getElementById('toggleActivityInput');
            let currentCardId = null;

            // Description textarea actions
            const descriptionTextarea = document.getElementById('description-textarea');
            const descriptionActions = document.getElementById('description-actions');

            descriptionTextarea.addEventListener('focus', () => {
                descriptionActions.style.display = 'block';
            });

            descriptionTextarea.addEventListener('blur', () => {
                if (descriptionTextarea.value.trim() === '') {
                    descriptionActions.style.display = 'none';
                }
            });

            // Open modal on card click
            document.querySelectorAll('.card').forEach(card => {
                card.addEventListener('click', () => {
                    currentCardId = card.getAttribute('data-card-id');
                    modal.style.display = 'flex';

                    // Fetch card data via AJAX
                    $.ajax({
                        type: 'GET',
                        url: 'index.php?action=getCardById&controller=card',
                        data: { cardid: currentCardId, boardId: $('.dashboard').attr('data-board-id') },
                        success: (response) => {
                            const data = JSON.parse(response);
                            // Populate members list
                            if(data.assignees){
                                const membersHTML = data.assignees
                                    .map(assignee => `
                                        <div class="member" title="${assignee.username}">
                                            <div class="inside">${assignee.username[0]}</div>
                                        </div>
                                    `)
                                    .join('');
                                membersList.innerHTML = membersHTML;
                            }

                            // Add "Add Member" button
                            const addMemberBtn = document.createElement('div');
                            addMemberBtn.className = 'add-member';
                            addMemberBtn.id = 'add-member-btn';
                            addMemberBtn.title = 'Add Member';
                            addMemberBtn.textContent = '+';
                            addMemberBtn.onclick = openCustomMembersModal; // Assign event handler for opening the dropdown

                            membersList.appendChild(addMemberBtn);

                            // Populate board members dropdown
                            if(data.boardMembers)
                            {
                                    const boardMembersHTML = data.boardMembers
                                    .map(member => `
                                        <div class="popover-member" data-name="${member.username}" data-member-id="${member.id}">
                                            <span>${member.username}</span>
                                            <span class="popover-add-member">Add</span>
                                        </div>
                                    `)
                                    .join('');
                                boardMembersDropdown.innerHTML = boardMembersHTML;
                            }
                        
                            if(data.comments)
                            {

                                const addActivityLogs = data.comments
                                .map(comment => {
                                    const date = new Date(comment.created_at);

                                    const formattedDate = date.toLocaleString('en-US', {
                                    year: 'numeric',
                                    month: 'short',
                                    day: 'numeric',
                                    hour: 'numeric',
                                    minute: '2-digit',
                                    hour12: true
                                    });

                                    return `
                                    <div class="activity-log-item">
                                        <div class="activity-top-row">
                                        <div class="user-icon">PP</div>
                                        <div class="date">${formattedDate}</div>
                                        </div>
                                        <div class="message">${comment.message}</div>
                                    </div>
                                    `;
                                })
                                .join('');

                                addActivityLog.innerHTML = addActivityLogs;
                            }
                            
                            // Populate modal details
                            document.querySelector('.task-title').textContent = data.title;
                            document.querySelector('.list-status').textContent = data.listDetails.title;
                            document.querySelector('.modal-datepicker-body').setAttribute('data-date-range-for-card', data.id);
                        },
                        error: (xhr, status, error) => {
                            console.error('Error fetching card data:', error);
                        }
                    });
                });
            });

            // Handle click on dynamically added "Add" buttons inside the board members dropdown
            boardMembersDropdown.addEventListener('click', (event) => {
                if (event.target.classList.contains('popover-add-member')) {
                    const memberElement = event.target.parentElement; // Get the parent div of the clicked button
                    const memberName = memberElement.dataset.name; // Get the member's name
                    const memberId = memberElement.dataset.memberId;
                    
                    // Add the member to the card members list
                    const newMember = document.createElement('div');
                    newMember.className = 'member';
                    newMember.title = memberName;

                    const insideDiv = document.createElement('div');
                    insideDiv.className = 'inside';
                    insideDiv.textContent = memberName[0]; // Use the first letter of the member's name

                    newMember.appendChild(insideDiv);
                    membersList.appendChild(newMember);

                    // Remove the member from the board members dropdown
                    memberElement.remove();
                }
            });

            // Open the custom members modal (placeholder function)
            function openCustomMembersModal() {
            boardMembersDropdown.style.display = 'block'; // Make the dropdown visible
            }

            // Close modal
            document.getElementById('closeModalButton').addEventListener('click', () => {
                modal.style.display = 'none';
            });

            // Save task changes
            saveBtn.addEventListener('click', () => {
                const updatedTitle = modalTitle.value;
                const updatedDesc = modalDesc.value;

                // Send AJAX request to update task in database
                $.ajax({
                    type: 'POST',
                    url: 'edit_task.php',
                    data: {
                        cardId: currentCardId,
                        title: updatedTitle,
                        description: updatedDesc
                    },
                    success: (response) => {
                        alert('Task updated successfully!');
                        const card = document.querySelector(`.card[data-card-id="${currentCardId}"]`);
                        card.setAttribute('data-card-title', updatedTitle);
                        card.setAttribute('data-card-desc', updatedDesc);
                        card.textContent = updatedTitle;
                        modal.style.display = 'none';
                    },
                    error: (xhr, status, error) => {
                        console.error('Error updating task:', error);
                    }
                });
            });

            // Add a comment
            toggleActivityInput.addEventListener('click', () => {
                const comment = document.getElementById('text-activity').trim();
                if (comment) {
                    $.ajax({
                        type: 'POST',
                        url: 'index.php?action=updateCardDate&controller=card',
                        data: {
                            cardId: ,
                            comment: comment
                        },
                        success: (response) => {
                            newComment.value = '';
                            fetchComments(currentCardId); // Reload comments
                        },
                        error: (xhr, status, error) => {
                            console.error('Error adding comment:', error);
                        }
                    });
                }
            });

              // Get references to elements
            const openDatepickerButton = document.querySelector("#btn-open-datepicker");
            const closeDatepickerButton = document.querySelector(".btn-close-datepicker");
            const datepickerModal = document.querySelector(".modal-datepicker");
            const saveDatesButton = document.querySelector(".btn-save-dates");

            // Open the datepicker modal
            openDatepickerButton.addEventListener("click", () => {
                datepickerModal.classList.add("active");
            });

            // Close the datepicker modal
            closeDatepickerButton.addEventListener("click", () => {
                datepickerModal.classList.remove("active");
            });

            // Close modal when clicking outside the modal content
            window.addEventListener("click", (event) => {
                if (event.target === datepickerModal) {
                    datepickerModal.classList.remove("active");
                }
            });

            // Save the selected dates
            saveDatesButton.addEventListener("click", () => {
                const startDate = document.getElementById("startDate").value;
                const endDate = document.getElementById("endDate").value;
                const cardId  = document.querySelector(".modal-datepicker-body").getAttribute('data-date-range-for-card');

                if (!startDate && !endDate) {
                    alert("Please select both start and end dates.");
                } else {
                    $.ajax({
                        type: 'POST',
                        url: 'index.php?action=updateCardDate&controller=card',
                        data: {
                            cardId: currentCardId,
                            startDate: startDate,
                            endDate: endDate
                        },
                        success: function(response) {
                            if (response.success) {
                                alert(response.message);
                            } else {
                                alert(response.error);
                            }
                            datepickerModal.classList.remove("active");
                        },
                        error: function(xhr, status, error) {
                            console.error('Error saving due date:', error);
                        }
                    });
                }
            });


            function openCustomMembersModal() {
            document.getElementById('custom-members-modal').classList.add('active');
            }

            // Close Custom Modal
            function closeCustomPopover() {
                document.getElementById('custom-members-modal').classList.remove('active');
            }

            // Filter Members
            // function filterCustomMembers() {
            //     const searchTerm = document.getElementById('custom-search').value.toLowerCase();
            //     const allMembers = document.querySelectorAll('.custom-member');

            //     allMembers.forEach(member => {
            //         const name = member.getAttribute('data-name').toLowerCase();
            //         if (name.includes(searchTerm)) {
            //             member.style.display = 'flex';
            //         } else {
            //             member.style.display = 'none';
            //         }
            //     });
            // }

            // Move Board Member to Card Members
            function moveToCardMembers(element) {
                const member = element.parentElement;
                const cardMembersList = document.getElementById('custom-card-members');
                member.querySelector('.custom-add-member').textContent = 'Remove';
                member.querySelector('.custom-add-member').setAttribute('onclick', 'removeFromCustomCardMembers(this)');
                cardMembersList.appendChild(member);
            }

            // Remove Member from Card Members
            function removeFromCustomCardMembers(element) {
                const member = element.parentElement;
                const boardMembersList = document.getElementById('custom-board-members');
                member.querySelector('.custom-add-member').textContent = 'Add';
                member.querySelector('.custom-add-member').setAttribute('onclick', 'moveToCustomCardMembers(this)');
                boardMembersList.appendChild(member);
            }
            
    </script>
</body>
</html>
