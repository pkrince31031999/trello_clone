
<!DOCTYPE html>
<html lang="en">
<head> 
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>KaaryaHub - Project Board</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- jQuery UI for draggable, droppable, sortable, tooltip -->
    <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.min.js"></script>
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.13.2/themes/ui-lightness/jquery-ui.css">
    <!-- Font Awesome for icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <!-- Summernote CSS -->
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.20/dist/summernote-bs4.min.css" rel="stylesheet">
    <!-- Summernote JS -->
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.20/dist/summernote-bs4.min.js"></script>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
            margin: 0;
            padding: 0;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            background-attachment: fixed;
            color: #333;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
            scroll-behavior: smooth;
            position: relative;
            overflow-x: hidden;
        }

        body::after {
            content: '';
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: 
                radial-gradient(circle at 20% 80%, rgba(120, 119, 198, 0.3) 0%, transparent 50%),
                radial-gradient(circle at 80% 20%, rgba(255, 119, 198, 0.3) 0%, transparent 50%),
                radial-gradient(circle at 40% 40%, rgba(120, 219, 255, 0.2) 0%, transparent 50%);
            pointer-events: none;
            z-index: -1;
            animation: backgroundShift 20s ease-in-out infinite;
        }

        @keyframes backgroundShift {
            0%, 100% { transform: translateX(0) translateY(0); }
            25% { transform: translateX(-10px) translateY(-5px); }
            50% { transform: translateX(5px) translateY(-10px); }
            75% { transform: translateX(-5px) translateY(5px); }
        }

        /* Advanced Animations */
        @keyframes cardSlideIn {
            from {
                opacity: 0;
                transform: translateY(20px) scale(0.95);
            }
            to {
                opacity: 1;
                transform: translateY(0) scale(1);
            }
        }

        @keyframes cardSlideOut {
            from {
                opacity: 1;
                transform: translateY(0) scale(1);
            }
            to {
                opacity: 0;
                transform: translateY(-20px) scale(0.95);
            }
        }

        @keyframes boardSlideIn {
            from {
                opacity: 0;
                transform: translateX(-30px) scale(0.95);
            }
            to {
                opacity: 1;
                transform: translateX(0) scale(1);
            }
        }

        @keyframes pulse {
            0%, 100% { transform: scale(1); }
            50% { transform: scale(1.05); }
        }

        @keyframes dropZonePulse {
            0%, 100% { 
                background: rgba(102, 126, 234, 0.1);
                border-color: rgba(102, 126, 234, 0.3);
            }
            50% { 
                background: rgba(102, 126, 234, 0.2);
                border-color: rgba(102, 126, 234, 0.5);
            }
        }

        @keyframes shimmer {
            0% { transform: translateX(-100%); }
            100% { transform: translateX(100%); }
        }

        @keyframes float {
            0%, 100% { transform: translateY(0px); }
            50% { transform: translateY(-10px); }
        }

        @keyframes spin {
            from { transform: rotate(0deg); }
            to { transform: rotate(360deg); }
        }

        @keyframes bounce {
            0%, 20%, 53%, 80%, 100% { transform: translate3d(0,0,0); }
            40%, 43% { transform: translate3d(0, -8px, 0); }
            70% { transform: translate3d(0, -4px, 0); }
            90% { transform: translate3d(0, -2px, 0); }
        }

        @keyframes ripple {
            to {
                transform: scale(4);
                opacity: 0;
            }
        }

        @keyframes animateIn {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes trello-comment-slide-out {
            from {
                opacity: 1;
                transform: translateX(0);
            }
            to {
                opacity: 0;
                transform: translateX(-20px);
            }
        }

        /* Dynamic Date Picker Styles */
        .trello-date-picker {
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            width: 320px;
            max-width: 90vw;
            background: white;
            border: 1px solid #e2e4e6;
            border-radius: 12px;
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.2);
            z-index: 10000;
            animation: modalSlideIn 0.3s ease-out;
        }

        .trello-date-picker-content {
            padding: 20px;
        }

        @keyframes modalSlideIn {
            from {
                opacity: 0;
                transform: translate(-50%, -60%);
            }
            to {
                opacity: 1;
                transform: translate(-50%, -50%);
            }
        }

        /* Modal backdrop */
        .trello-date-picker::before {
            content: '';
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(0, 0, 0, 0.5);
            z-index: -1;
        }

        .trello-date-picker-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 16px;
            padding-bottom: 12px;
            border-bottom: 1px solid #e2e4e6;
        }

        .trello-date-picker-header h4 {
            margin: 0;
            font-size: 16px;
            color: #172b4d;
        }

        .trello-close-date-picker {
            background: none;
            border: none;
            color: #5e6c84;
            cursor: pointer;
            padding: 4px;
            border-radius: 4px;
            transition: all 0.2s ease;
        }

        .trello-close-date-picker:hover {
            background: #e2e4e6;
        }

        .trello-date-input-group {
            margin-bottom: 16px;
        }

        .trello-date-input-group label {
            display: block;
            margin-bottom: 6px;
            font-size: 14px;
            font-weight: 500;
            color: #172b4d;
        }

        .trello-date-input,
        .trello-time-input {
            width: 100%;
            padding: 8px 12px;
            border: 1px solid #e2e4e6;
            border-radius: 4px;
            font-size: 14px;
            transition: all 0.2s ease;
        }

        .trello-date-input:focus,
        .trello-time-input:focus {
            outline: none;
            border-color: #0079bf;
            box-shadow: 0 0 0 2px rgba(0, 121, 191, 0.1);
        }

        .trello-quick-dates {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 8px;
            margin-bottom: 16px;
        }

        .trello-quick-date-btn {
            padding: 8px 12px;
            background: #e2e4e6;
            border: none;
            border-radius: 4px;
            color: #172b4d;
            font-size: 13px;
            cursor: pointer;
            transition: all 0.2s ease;
        }

        .trello-quick-date-btn:hover {
            background: #d6d8da;
        }

        .trello-date-actions {
            display: flex;
            gap: 8px;
            justify-content: flex-end;
        }

        .trello-save-date-btn,
        .trello-remove-date-btn {
            padding: 8px 16px;
            border: none;
            border-radius: 4px;
            font-size: 14px;
            cursor: pointer;
            transition: all 0.2s ease;
            display: flex;
            align-items: center;
            gap: 6px;
        }

        .trello-save-date-btn {
            background: #0079bf;
            color: white;
        }

        .trello-save-date-btn:hover {
            background: #005a8b;
        }

        .trello-remove-date-btn {
            background: #eb5a46;
            color: white;
        }

        .trello-remove-date-btn:hover {
            background: #d63031;
        }

        /* Dynamic Member Picker Styles */
        .trello-member-picker {
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            width: 400px;
            max-width: 90vw;
            max-height: 80vh;
            background: white;
            border: 1px solid #e2e4e6;
            border-radius: 12px;
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.2);
            z-index: 10000;
            animation: modalSlideIn 0.3s ease-out;
            overflow-y: auto;
        }

        .trello-member-picker-content {
            padding: 20px;
        }

        /* Modal backdrop for member picker */
        .trello-member-picker::before {
            content: '';
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(0, 0, 0, 0.5);
            z-index: -1;
        }

        .trello-member-picker-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 16px;
            padding-bottom: 12px;
            border-bottom: 1px solid #e2e4e6;
        }

        .trello-member-picker-header h4 {
            margin: 0;
            font-size: 16px;
            color: #172b4d;
        }

        .trello-close-member-picker {
            background: none;
            border: none;
            color: #5e6c84;
            cursor: pointer;
            padding: 4px;
            border-radius: 4px;
            transition: all 0.2s ease;
        }

        .trello-close-member-picker:hover {
            background: #e2e4e6;
        }

        .trello-member-search-group {
            position: relative;
            margin-bottom: 16px;
        }

        .trello-member-search-input {
            width: 100%;
            padding: 8px 12px 8px 36px;
            border: 1px solid #e2e4e6;
            border-radius: 4px;
            font-size: 14px;
            transition: all 0.2s ease;
        }

        .trello-member-search-input:focus {
            outline: none;
            border-color: #0079bf;
            box-shadow: 0 0 0 2px rgba(0, 121, 191, 0.1);
        }

        .trello-search-icon {
            position: absolute;
            left: 12px;
            top: 50%;
            transform: translateY(-50%);
            color: #5e6c84;
            font-size: 14px;
        }

        .trello-suggested-members {
            max-height: 200px;
            overflow-y: auto;
            margin-bottom: 16px;
        }

        .trello-suggested-member {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 8px;
            border-radius: 4px;
            transition: all 0.2s ease;
            cursor: pointer;
        }

        .trello-suggested-member:hover {
            background: #f4f5f7;
        }

        .trello-member-info {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .trello-member-avatar {
            width: 32px;
            height: 32px;
            border-radius: 50%;
            background: #dfe1e6;
            color: #172b4d;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 12px;
            font-weight: 500;
            position: relative;
        }

        .trello-member-avatar.online::after {
            content: '';
            position: absolute;
            bottom: 0;
            right: 0;
            width: 8px;
            height: 8px;
            background: #61bd4f;
            border: 2px solid white;
            border-radius: 50%;
        }

        .trello-member-details {
            flex: 1;
        }

        .trello-member-name {
            font-size: 14px;
            font-weight: 500;
            color: #172b4d;
            margin-bottom: 2px;
        }

        .trello-member-email {
            font-size: 12px;
            color: #5e6c84;
        }

        

        .trello-add-member-btn {
            width: auto;
            min-width: 28px;
            height: 28px;
            border: none;
            padding: 8px 12px;
            background: #0079bf;
            color: white;
            border-radius: 4px;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 14px;
            transition: all 0.2s ease;
            gap: 6px;
        }

        .trello-add-member-btn:hover {
            background: #005a8b;
        }

        .trello-member-actions {
            margin-top: 16px;
        }

        .trello-invite-member-btn {
            width: 100%;
            padding: 8px 16px;
            background: #e2e4e6;
            border: none;
            border-radius: 4px;
            color: #172b4d;
            font-size: 14px;
            cursor: pointer;
            transition: all 0.2s ease;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
        }

        .trello-invite-member-btn:hover {
            background: #d6d8da;
        }

        /* Enhanced Member Styles */
        .trello-member {
            position: relative;
        }

        .trello-member-initials {
            display: block;
            font-size: 12px;
            font-weight: 500;
        }

        .trello-remove-member-btn {
            position: absolute;
            top: -4px;
            right: -4px;
            width: 16px;
            height: 16px;
            border: none;
            background: #eb5a46;
            color: white;
            border-radius: 50%;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 8px;
            opacity: 0;
            transition: all 0.2s ease;
        }

        .trello-member:hover .trello-remove-member-btn {
            opacity: 1;
        }

        .trello-remove-member-btn:hover {
            background: #d63031;
        }

        /* Enhanced Comment Styles */
        .trello-comment-actions {
            display: flex;
            gap: 4px;
            opacity: 0;
            transition: opacity 0.2s ease;
        }

        .trello-comment-edit-btn,
        .trello-comment-delete-btn {
            width: 24px;
            height: 24px;
            border: none;
            background: #e2e4e6;
            color: #5e6c84;
            border-radius: 4px;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 10px;
            transition: all 0.2s ease;
        }

        .trello-comment-edit-btn:hover {
            background: #0079bf;
            color: white;
        }

        .trello-comment-delete-btn:hover {
            background: #eb5a46;
            color: white;
        }

        .trello-comment-new {
            animation: trello-comment-slide-in 0.3s ease-out;
        }

        @keyframes trello-comment-slide-in {
            from {
                opacity: 0;
                transform: translateX(-20px);
            }
            to {
                opacity: 1;
                transform: translateX(0);
            }
        }

        /* Enhanced Label Picker Styles */
        .trello-label-picker {
            position: absolute;
            top: 100%;
            left: 0;
            right: 0;
            background: white;
            border: 1px solid #e2e4e6;
            border-radius: 8px;
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.15);
            z-index: 1000;
            margin-top: 8px;
        }

        .trello-label-picker-content {
            padding: 16px;
        }

        .trello-label-picker-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 16px;
            padding-bottom: 12px;
            border-bottom: 1px solid #e2e4e6;
        }

        .trello-label-picker-header h4 {
            margin: 0;
            font-size: 16px;
            color: #172b4d;
        }

        .trello-close-label-picker {
            background: none;
            border: none;
            color: #5e6c84;
            cursor: pointer;
            padding: 4px;
            border-radius: 4px;
            transition: all 0.2s ease;
        }

        .trello-close-label-picker:hover {
            background: #e2e4e6;
        }

        .trello-label-search-group {
            position: relative;
            margin-bottom: 16px;
        }

        .trello-label-search-input {
            width: 100%;
            padding: 8px 12px 8px 36px;
            border: 1px solid #e2e4e6;
            border-radius: 4px;
            font-size: 14px;
            transition: all 0.2s ease;
        }

        .trello-label-search-input:focus {
            outline: none;
            border-color: #0079bf;
            box-shadow: 0 0 0 2px rgba(0, 121, 191, 0.1);
        }

        .trello-available-labels {
            max-height: 200px;
            overflow-y: auto;
            margin-bottom: 16px;
        }

        .trello-available-label {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 8px;
            border-radius: 4px;
            transition: all 0.2s ease;
            cursor: pointer;
        }

        .trello-available-label:hover {
            background: #f4f5f7;
        }

        .trello-label-info {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .trello-label-color {
            width: 20px;
            height: 20px;
            border-radius: 4px;
            display: inline-block;
        }

        .trello-label-color.red { background: #eb5a46; }
        .trello-label-color.orange { background: #ff9f1a; }
        .trello-label-color.yellow { background: #f2d600; }
        .trello-label-color.green { background: #61bd4f; }
        .trello-label-color.blue { background: #0079bf; }
        .trello-label-color.purple { background: #c377e0; }
        .trello-label-color.pink { background: #ff78cb; }
        .trello-label-color.sky { background: #00c2e0; }
        .trello-label-color.lime { background: #51e898; }
        .trello-label-color.grey { background: #838c91; }

        .trello-label-details {
            flex: 1;
        }

        .trello-label-name {
            font-size: 14px;
            font-weight: 500;
            color: #172b4d;
            margin-bottom: 2px;
        }

        .trello-label-description {
            font-size: 12px;
            color: #5e6c84;
        }

        .trello-label-actions {
            margin-top: 16px;
        }

        .trello-create-label-btn {
            width: 100%;
            padding: 8px 16px;
            background: #e2e4e6;
            border: none;
            border-radius: 4px;
            color: #172b4d;
            font-size: 14px;
            cursor: pointer;
            transition: all 0.2s ease;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
        }

        .trello-create-label-btn:hover {
            background: #d6d8da;
        }

        .trello-manage-labels-btn,
        .trello-import-labels-btn,
        .trello-export-labels-btn {
            width: 100%;
            padding: 8px 16px;
            background: #e2e4e6;
            border: none;
            border-radius: 4px;
            color: #172b4d;
            font-size: 14px;
            cursor: pointer;
            transition: all 0.2s ease;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            margin-top: 8px;
        }

        .trello-manage-labels-btn:hover {
            background: #0079bf;
            color: white;
        }

        .trello-import-labels-btn:hover {
            background: #61bd4f;
            color: white;
        }

        .trello-export-labels-btn:hover {
            background: #ff9f1a;
            color: white;
        }

        .trello-label-actions {
            display: flex;
            gap: 4px;
            opacity: 0;
            transition: all 0.2s ease;
        }

        .trello-available-label:hover .trello-label-actions {
            opacity: 1;
        }

        .trello-edit-label-btn,
        .trello-delete-label-btn {
            width: 24px;
            height: 24px;
            border: none;
            background: #e2e4e6;
            color: #5e6c84;
            border-radius: 4px;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 10px;
            transition: all 0.2s ease;
        }

        .trello-edit-label-btn:hover {
            background: #0079bf;
            color: white;
        }

        .trello-delete-label-btn:hover {
            background: #eb5a46;
            color: white;
        }

        .trello-label-name,
        .trello-label-description {
            cursor: pointer;
            transition: all 0.2s ease;
            padding: 2px 4px;
            border-radius: 4px;
        }

        .trello-label-name:hover,
        .trello-label-description:hover {
            background: #f4f5f7;
        }

        .trello-label-color {
            cursor: pointer;
            transition: all 0.2s ease;
            border: 2px solid transparent;
        }

        .trello-label-color:hover {
            border-color: #0079bf;
            transform: scale(1.1);
        }

        /* Enhanced Label Styles */
        .trello-label {
            position: relative;
            display: inline-flex;
            align-items: center;
            gap: 6px;
            margin-right: 8px;
            margin-bottom: 4px;
        }

        .trello-label-text {
            font-size: 12px;
            font-weight: 500;
            color: white;
        }

        .trello-remove-label-btn {
            width: 16px;
            height: 16px;
            border: none;
            background: rgba(255, 255, 255, 0.3);
            color: white;
            border-radius: 50%;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 8px;
            opacity: 0;
            transition: all 0.2s ease;
        }

        .trello-label:hover .trello-remove-label-btn {
            opacity: 1;
        }

        .trello-remove-label-btn:hover {
            background: rgba(255, 255, 255, 0.5);
        }

        /* Enhanced Checklist Styles */
        .trello-checklist-picker {
            position: absolute;
            top: 100%;
            left: 0;
            right: 0;
            background: white;
            border: 1px solid #e2e4e6;
            border-radius: 8px;
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.15);
            z-index: 1000;
            margin-top: 8px;
        }

        .trello-checklist-picker-content {
            padding: 16px;
        }

        .trello-checklist-picker-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 16px;
            padding-bottom: 12px;
            border-bottom: 1px solid #e2e4e6;
        }

        .trello-checklist-picker-header h4 {
            margin: 0;
            font-size: 16px;
            color: #172b4d;
        }

        .trello-close-checklist-picker {
            background: none;
            border: none;
            color: #5e6c84;
            cursor: pointer;
            padding: 4px;
            border-radius: 4px;
            transition: all 0.2s ease;
        }

        .trello-close-checklist-picker:hover {
            background: #e2e4e6;
        }

        .trello-checklist-actions {
            display: flex;
            gap: 8px;
            margin-bottom: 16px;
        }

        .trello-add-checklist-btn,
        .trello-clear-checklist-btn {
            flex: 1;
            padding: 8px 12px;
            border: none;
            border-radius: 4px;
            font-size: 14px;
            cursor: pointer;
            transition: all 0.2s ease;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 6px;
        }

        .trello-add-checklist-btn {
            background: #0079bf;
            color: white;
        }

        .trello-add-checklist-btn:hover {
            background: #005a8b;
        }

        .trello-clear-checklist-btn {
            background: #eb5a46;
            color: white;
        }

        .trello-clear-checklist-btn:hover {
            background: #d63031;
        }

        .trello-checklist-templates h5 {
            margin: 0 0 8px 0;
            font-size: 14px;
            color: #172b4d;
        }

        .trello-template-buttons {
            display: flex;
            flex-direction: column;
            gap: 6px;
        }

        .trello-template-btn {
            padding: 8px 12px;
            background: #e2e4e6;
            border: none;
            border-radius: 4px;
            color: #172b4d;
            font-size: 13px;
            cursor: pointer;
            transition: all 0.2s ease;
            text-align: left;
        }

        .trello-template-btn:hover {
            background: #d6d8da;
        }

        /* Enhanced Checklist Item Styles */
        .trello-checklist-item {
            position: relative;
            display: flex;
            align-items: center;
            gap: 8px;
            padding: 8px 0;
            border-bottom: 1px solid #e2e4e6;
        }

        .trello-checklist-item:last-child {
            border-bottom: none;
        }

        .trello-checklist-item input[type="checkbox"] {
            width: 16px;
            height: 16px;
            cursor: pointer;
        }

        .trello-checklist-item label {
            flex: 1;
            cursor: pointer;
            font-size: 14px;
            color: #172b4d;
            transition: all 0.2s ease;
        }

        .trello-checklist-item.completed label {
            text-decoration: line-through;
            color: #5e6c84;
        }

        .trello-remove-checklist-item {
            width: 20px;
            height: 20px;
            border: none;
            background: #e2e4e6;
            color: #5e6c84;
            border-radius: 4px;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 10px;
            opacity: 0;
            transition: all 0.2s ease;
        }

        .trello-checklist-item:hover .trello-remove-checklist-item {
            opacity: 1;
        }

        .trello-remove-checklist-item:hover {
            background: #eb5a46;
            color: white;
        }

        /* Enhanced Description Styles */
        .trello-description-editor {
            width: 100%;
        }

        .trello-description-textarea {
            width: 100%;
            padding: 12px;
            border: 1px solid #e2e4e6;
            border-radius: 4px;
            font-size: 14px;
            resize: vertical;
            min-height: 80px;
            font-family: inherit;
            transition: all 0.2s ease;
        }

        .trello-description-textarea:focus {
            outline: none;
            border-color: #0079bf;
            box-shadow: 0 0 0 2px rgba(0, 121, 191, 0.1);
        }

        .trello-description-actions {
            display: flex;
            gap: 8px;
            margin-top: 8px;
        }

        .trello-save-description-btn,
        .trello-cancel-description-btn {
            padding: 6px 12px;
            border: none;
            border-radius: 4px;
            font-size: 12px;
            cursor: pointer;
            transition: all 0.2s ease;
            display: flex;
            align-items: center;
            gap: 4px;
        }

        .trello-save-description-btn {
            background: #0079bf;
            color: white;
        }

        .trello-save-description-btn:hover {
            background: #005a8b;
        }

        .trello-cancel-description-btn {
            background: #e2e4e6;
            color: #5e6c84;
        }

        .trello-cancel-description-btn:hover {
            background: #d6d8da;
        }

        .trello-description-content {
            line-height: 1.5;
            color: #172b4d;
        }

        .trello-description-empty {
            color: #5e6c84;
            font-style: italic;
        }

        /* Enhanced Trello-like Checklist Styles */
        .trello-checklist-item {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 8px 0;
            border-bottom: 1px solid #e2e4e6;
            position: relative;
        }

        .trello-checklist-item:last-child {
            border-bottom: none;
        }

        .trello-checklist-item-content {
            display: flex;
            align-items: center;
            gap: 8px;
            flex: 1;
        }

        .trello-checklist-item input[type="checkbox"] {
            width: 16px;
            height: 16px;
            cursor: pointer;
            accent-color: #0079bf;
        }

        .trello-checklist-label {
            flex: 1;
            cursor: pointer;
            font-size: 14px;
            color: #172b4d;
            transition: all 0.2s ease;
            line-height: 1.4;
        }

        .trello-checklist-item.completed .trello-checklist-label {
            text-decoration: line-through;
            color: #5e6c84;
        }

        .trello-checklist-item-actions {
            display: flex;
            gap: 4px;
            opacity: 0;
            transition: all 0.2s ease;
        }

        .trello-checklist-item:hover .trello-checklist-item-actions {
            opacity: 1;
        }

        .trello-edit-checklist-item,
        .trello-remove-checklist-item {
            width: 24px;
            height: 24px;
            border: none;
            background: #e2e4e6;
            color: #5e6c84;
            border-radius: 4px;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 10px;
            transition: all 0.2s ease;
        }

        .trello-edit-checklist-item:hover {
            background: #0079bf;
            color: white;
        }

        .trello-remove-checklist-item:hover {
            background: #eb5a46;
            color: white;
        }

        /* Enhanced Trello-like Member Styles */
        .trello-member {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 8px 12px;
            background: #f4f5f7;
            border-radius: 8px;
            margin-bottom: 8px;
            position: relative;
            transition: all 0.2s ease;
        }

        .trello-member:hover {
            background: #e2e4e6;
            transform: translateY(-1px);
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
        }

        .trello-member-avatar {
            width: 32px;
            height: 32px;
            border-radius: 50%;
            background: #0079bf;
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 12px;
            font-weight: 600;
            position: relative;
        }

        .trello-member-avatar.online::after {
            content: '';
            position: absolute;
            bottom: 2px;
            right: 2px;
            width: 8px;
            height: 8px;
            background: #61bd4f;
            border: 2px solid white;
            border-radius: 50%;
        }

        .trello-member-info {
            flex: 1;
            min-width: 0;
        }

        .trello-member-name {
            font-size: 14px;
            font-weight: 500;
            color: #172b4d;
            margin-bottom: 2px;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .trello-member-email {
            font-size: 12px;
            color: #5e6c84;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .trello-member-actions {
            display: flex;
            gap: 4px;
            opacity: 0;
            transition: all 0.2s ease;
        }

        .trello-member:hover .trello-member-actions {
            opacity: 1;
        }

        .trello-remove-member-btn {
            background: #ff6b6b;
            border: none;
            color: white;
            padding: 4px 8px;
            border-radius: 4px;
            cursor: pointer;
            font-size: 12px;
            transition: all 0.2s ease;
        }

        .trello-remove-member-btn:hover {
            background: #ff5252;
            transform: scale(1.05);
        }

        .trello-member-menu-btn,
        .trello-remove-member-btn {
            width: 24px;
            height: 24px;
            border: none;
            background: #e2e4e6;
            color: #5e6c84;
            border-radius: 4px;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 10px;
            transition: all 0.2s ease;
        }

        .trello-member-menu-btn:hover {
            background: #0079bf;
            color: white;
        }

        .trello-remove-member-btn:hover {
            background: #eb5a46;
            color: white;
        }

        /* Member Menu Styles */
        .trello-member-menu {
            position: absolute;
            background: white;
            border: 1px solid #e2e4e6;
            border-radius: 8px;
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.15);
            z-index: 1000;
            min-width: 200px;
        }

        .trello-member-menu-content {
            padding: 8px 0;
        }

        .trello-menu-item {
            width: 100%;
            padding: 8px 16px;
            border: none;
            background: none;
            color: #172b4d;
            text-align: left;
            cursor: pointer;
            transition: all 0.2s ease;
            display: flex;
            align-items: center;
            gap: 8px;
            font-size: 14px;
        }

        .trello-menu-item:hover {
            background: #f4f5f7;
        }

        .trello-menu-item.danger {
            color: #eb5a46;
        }

        .trello-menu-item.danger:hover {
            background: #fdf2f2;
        }

        .trello-menu-divider {
            margin: 4px 0;
            border: none;
            border-top: 1px solid #e2e4e6;
        }

        /* Enhanced Label Styles */
        .trello-label {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 4px 8px;
            border-radius: 4px;
            font-size: 12px;
            font-weight: 500;
            color: white;
            margin-right: 8px;
            margin-bottom: 4px;
            position: relative;
            transition: all 0.2s ease;
        }

        .trello-label:hover {
            transform: translateY(-1px);
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.15);
        }

        .trello-label-text {
            flex: 1;
        }

        .trello-remove-label-btn {
            width: 16px;
            height: 16px;
            border: none;
            background: rgba(255, 255, 255, 0.3);
            color: white;
            border-radius: 50%;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 8px;
            opacity: 0;
            transition: all 0.2s ease;
        }

        .trello-label:hover .trello-remove-label-btn {
            opacity: 1;
        }

        .trello-remove-label-btn:hover {
            background: rgba(255, 255, 255, 0.5);
        }

        /* Label Color Classes */
        .trello-label.red { background: #eb5a46; }
        .trello-label.orange { background: #ff9f1a; }
        .trello-label.yellow { background: #f2d600; color: #172b4d; }
        .trello-label.green { background: #61bd4f; }
        .trello-label.blue { background: #0079bf; }
        .trello-label.purple { background: #c377e0; }
        .trello-label.pink { background: #ff78cb; }
        .trello-label.sky { background: #00c2e0; }
        .trello-label.lime { background: #51e898; color: #172b4d; }
        .trello-label.grey { background: #838c91; }

        /* Board Member Styles */
        .trello-board-members-section {
            margin: 16px 0;
        }

        .trello-section-title {
            display: flex;
            align-items: center;
            gap: 8px;
            margin: 0 0 12px 0;
            font-size: 14px;
            font-weight: 600;
            color: #172b4d;
        }

        .trello-section-title i {
            color: #0079bf;
        }

        .trello-board-members-list {
            max-height: 200px;
            overflow-y: auto;
            border: 1px solid #e2e4e6;
            border-radius: 8px;
            background: #f8f9fa;
        }

        .trello-board-member {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 12px;
            border-bottom: 1px solid #e2e4e6;
            transition: all 0.2s ease;
            background: white;
        }

        .trello-board-member:last-child {
            border-bottom: none;
        }

        .trello-board-member:hover {
            background: #f4f5f7;
            transform: translateX(2px);
        }

        .trello-board-member-info {
            display: flex;
            align-items: center;
            gap: 12px;
            flex: 1;
            min-width: 0;
        }

        .trello-board-member-avatar {
            width: 36px;
            height: 36px;
            border-radius: 50%;
            background: #0079bf;
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 14px;
            font-weight: 600;
            position: relative;
            flex-shrink: 0;
        }

        .trello-board-member-avatar.online::after {
            content: '';
            position: absolute;
            bottom: 2px;
            right: 2px;
            width: 10px;
            height: 10px;
            background: #61bd4f;
            border: 2px solid white;
            border-radius: 50%;
        }

        .trello-board-member-avatar.offline::after {
            content: '';
            position: absolute;
            bottom: 2px;
            right: 2px;
            width: 10px;
            height: 10px;
            background: #838c91;
            border: 2px solid white;
            border-radius: 50%;
        }

        .trello-board-member-details {
            flex: 1;
            min-width: 0;
        }

        .trello-board-member-name {
            font-size: 14px;
            font-weight: 500;
            color: #172b4d;
            margin-bottom: 2px;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .trello-board-member-email {
            font-size: 12px;
            color: #5e6c84;
            margin-bottom: 2px;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .trello-board-member-role {
            font-size: 11px;
            color: #0079bf;
            background: #e3f2fd;
            padding: 2px 6px;
            border-radius: 12px;
            display: inline-block;
            font-weight: 500;
        }

        .trello-board-member-actions {
            display: flex;
            gap: 4px;
            opacity: 0;
            transition: all 0.2s ease;
        }

        .trello-board-member:hover .trello-board-member-actions {
            opacity: 1;
        }

        .trello-add-to-card-btn,
        .trello-member-options-btn {
            width: 28px;
            height: 28px;
            border: none;
            background: #e2e4e6;
            color: #5e6c84;
            border-radius: 4px;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 12px;
            transition: all 0.2s ease;
        }

        .trello-add-to-card-btn:hover {
            background: #0079bf;
            color: white;
            transform: scale(1.1);
        }

        .trello-member-options-btn:hover {
            background: #5e6c84;
            color: white;
        }

        /* Member Options Menu */
        .trello-member-options-menu {
            position: absolute;
            background: white;
            border: 1px solid #e2e4e6;
            border-radius: 8px;
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.15);
            z-index: 1000;
            min-width: 180px;
        }

        .trello-member-options-content {
            padding: 8px 0;
        }

        .trello-option-item {
            width: 100%;
            padding: 8px 16px;
            border: none;
            background: none;
            color: #172b4d;
            text-align: left;
            cursor: pointer;
            transition: all 0.2s ease;
            display: flex;
            align-items: center;
            gap: 8px;
            font-size: 14px;
        }

        .trello-option-item:hover {
            background: #f4f5f7;
        }

        .trello-option-item.danger {
            color: #eb5a46;
        }

        .trello-option-item.danger:hover {
            background: #fdf2f2;
        }

        .trello-option-divider {
            margin: 4px 0;
            border: none;
            border-top: 1px solid #e2e4e6;
        }

        /* Enhanced Member Actions */
        .trello-member-actions {
            display: flex;
            gap: 4px;
            opacity: 0;
            transition: all 0.2s ease;
        }

        .trello-member:hover .trello-member-actions {
            opacity: 1;
        }

        .trello-manage-members-btn {
            padding: 8px 12px;
            background: #e2e4e6;
            border: none;
            border-radius: 4px;
            color: #5e6c84;
            font-size: 12px;
            cursor: pointer;
            transition: all 0.2s ease;
            display: flex;
            align-items: center;
            gap: 6px;
        }

        .trello-manage-members-btn:hover {
            background: #0079bf;
            color: white;
        }

        .trello-comment-edit-actions {
            display: flex;
            gap: 8px;
            margin-top: 8px;
        }

        .trello-comment-save-edit-btn,
        .trello-comment-cancel-edit-btn {
            padding: 4px 8px;
            border: none;
            border-radius: 4px;
            font-size: 12px;
            cursor: pointer;
            transition: all 0.2s ease;
            display: flex;
            align-items: center;
            gap: 4px;
        }

        .trello-comment-save-edit-btn {
            background: #0079bf;
            color: white;
        }

        .trello-comment-cancel-edit-btn {
            background: #e2e4e6;
            color: #5e6c84;
        }

        /* Responsive Enhancements for Dynamic Features */
        @media (max-width: 768px) {
            .trello-date-picker {
                width: 90%;
                max-width: 400px;
                max-height: 80vh;
                overflow-y: auto;
            }
            
            .trello-member-picker,
            .trello-label-picker,
            .trello-checklist-picker {
                position: fixed;
                top: 50%;
                left: 50%;
                transform: translate(-50%, -50%);
                width: 90%;
                max-width: 400px;
                max-height: 80vh;
                overflow-y: auto;
            }

            .trello-label-picker-content,
            .trello-checklist-picker-content {
                padding: 12px;
            }

            .trello-available-labels {
                max-height: 150px;
            }

            .trello-label-info {
                gap: 8px;
            }

            .trello-label-color {
                width: 16px;
                height: 16px;
            }

            .trello-label-name {
                font-size: 13px;
            }

            .trello-label-description {
                font-size: 11px;
            }

            .trello-checklist-actions {
                flex-direction: column;
                gap: 6px;
            }

            .trello-add-checklist-btn,
            .trello-clear-checklist-btn {
                width: 100%;
            }

            .trello-template-buttons {
                gap: 4px;
            }

            .trello-template-btn {
                font-size: 12px;
                padding: 6px 10px;
            }

            .trello-description-textarea {
                min-height: 60px;
                font-size: 13px;
            }

            .trello-description-actions {
                flex-direction: column;
                gap: 6px;
            }

            .trello-save-description-btn,
            .trello-cancel-description-btn {
                width: 100%;
                justify-content: center;
            }

            /* Enhanced Mobile Styles for Board Members */
            .trello-board-members-list {
                max-height: 150px;
            }

            .trello-board-member {
                padding: 8px;
                flex-direction: column;
                align-items: flex-start;
                gap: 8px;
            }

            .trello-board-member-info {
                width: 100%;
                gap: 8px;
            }

            .trello-board-member-avatar {
                width: 28px;
                height: 28px;
                font-size: 12px;
            }

            .trello-board-member-name {
                font-size: 13px;
            }

            .trello-board-member-email {
                font-size: 11px;
            }

            .trello-board-member-role {
                font-size: 10px;
                padding: 1px 4px;
            }

            .trello-board-member-actions {
                width: 100%;
                justify-content: flex-end;
                opacity: 1;
            }

            .trello-add-to-card-btn,
            .trello-member-options-btn {
                width: 24px;
                height: 24px;
                font-size: 10px;
            }

            .trello-member-options-menu {
                position: fixed;
                top: 50%;
                left: 50%;
                transform: translate(-50%, -50%);
                width: 90%;
                max-width: 300px;
            }

            .trello-option-item {
                padding: 12px 16px;
                font-size: 16px;
            }

            .trello-quick-dates {
                grid-template-columns: 1fr;
            }

            .trello-suggested-members {
                max-height: 150px;
            }

            .trello-member-info {
                gap: 8px;
            }

            .trello-member-avatar {
                width: 28px;
                height: 28px;
                font-size: 11px;
            }

            .trello-member-name {
                font-size: 13px;
            }

            .trello-member-email {
                font-size: 11px;
            }
        }

        @media (max-width: 480px) {
            .trello-date-picker-content,
            .trello-member-picker-content {
                padding: 12px;
            }

            .trello-date-actions,
            .trello-comment-edit-actions {
                flex-direction: column;
            }

            .trello-save-date-btn,
            .trello-remove-date-btn,
            .trello-comment-save-edit-btn,
            .trello-comment-cancel-edit-btn {
                width: 100%;
                justify-content: center;
            }
        }

        body::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><defs><pattern id="grain" width="100" height="100" patternUnits="userSpaceOnUse"><circle cx="50" cy="50" r="1" fill="rgba(255,255,255,0.1)"/></pattern></defs><rect width="100" height="100" fill="url(%23grain)"/></svg>');
            opacity: 0.1;
            pointer-events: none;
        }  

        .list {
            flex: 1;
            background: linear-gradient(135deg, #ffffff, #f8f9fa);
            border-radius: 12px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
            padding: 20px;
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }

        .list::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: linear-gradient(90deg, #6a11cb, #2575fc);
            transform: scaleX(0);
            transition: transform 0.3s ease;
        }

        .list:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 30px rgba(106, 17, 203, 0.12);
        }

        .list:hover::before {
            transform: scaleX(1);
        }

        .list h2 {
            font-size: 18px;
            color: #6a11cb;
            margin-bottom: 15px;
            text-align: center;
        }
        .card {
            background: linear-gradient(135deg, #ffffff, #f8f9fa);
            border: 1px solid #e1e5e9;
            border-radius: 8px;
            padding: 12px;
            margin-bottom: 12px;
            cursor: grab;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            position: relative;
            overflow: hidden;
        }

        .card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 3px;
            background: linear-gradient(90deg, #6a11cb, #2575fc);
            transform: scaleX(0);
            transition: transform 0.3s ease;
        }

        .card:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(106, 17, 203, 0.15);
            border-color: #6a11cb;
        }

        .card:hover::before {
            transform: scaleX(1);
        }

        .card.dragging {
            opacity: 0.9;
            transform: rotate(5deg) scale(1.05);
            box-shadow: 0 12px 35px rgba(106, 17, 203, 0.3);
            z-index: 1000;
        }

        .card.loading {
            opacity: 0.6;
            pointer-events: none;
        }

        .card.loading::after {
            content: '';
            position: absolute;
            top: 50%;
            left: 50%;
            width: 20px;
            height: 20px;
            margin: -10px 0 0 -10px;
            border: 2px solid #6a11cb;
            border-top: 2px solid transparent;
            border-radius: 50%;
            animation: spin 1s linear infinite;
        }

        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }

        .list.dragover {
            background: #e0f7fa;
            border: 2px dashed #4caf50;
        }

        /* Enhanced Header */
        header {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(25px);
            padding: 20px 30px;
            box-shadow: 
                0 8px 32px rgba(0, 0, 0, 0.1),
                0 2px 8px rgba(0, 0, 0, 0.05);
            display: flex;
            justify-content: space-between;
            align-items: center;
            position: sticky;
            top: 0;
            z-index: 1000;
            border-bottom: 1px solid rgba(255, 255, 255, 0.3);
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        header:hover {
            background: rgba(255, 255, 255, 0.98);
            box-shadow: 
                0 12px 40px rgba(0, 0, 0, 0.15),
                0 4px 12px rgba(0, 0, 0, 0.08);
            transform: translateY(-1px);
        }

        .header-left {
            display: flex;
            align-items: center;
            gap: 20px;
        }

        .logo {
            width: 180px;
            height: 70px;
            object-fit: contain;
            filter: drop-shadow(0 2px 8px rgba(0, 0, 0, 0.1));
            transition: all 0.3s ease;
        }

        .logo:hover {
            transform: scale(1.05);
            filter: drop-shadow(0 4px 12px rgba(0, 0, 0, 0.2));
        }

        .board-title {
            font-size: 24px;
            font-weight: 700;
            background: linear-gradient(135deg, #667eea, #764ba2);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            margin: 0;
            text-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .header-right {
            display: flex;
            align-items: center;
            gap: 15px;
        }

        .header-btn {
            padding: 12px 24px;
            background: linear-gradient(135deg, #667eea, #764ba2);
            color: white;
            border: none;
            border-radius: 12px;
            cursor: pointer;
            font-size: 14px;
            font-weight: 600;
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
            box-shadow: 0 4px 15px rgba(102, 126, 234, 0.3);
        }

        .header-btn::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
            transition: left 0.5s ease;
        }

        .header-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(102, 126, 234, 0.4);
        }

        .header-btn:hover::before {
            left: 100%;
        }

        .header-btn:active {
            transform: translateY(0);
        }

        .share-btn {
            display: flex;
            align-items: center;
            gap: 8px;
            padding: 12px 20px;
            background: rgba(255, 255, 255, 0.9);
            border: 2px solid rgba(102, 126, 234, 0.3);
            border-radius: 12px;
            color: #667eea;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            backdrop-filter: blur(10px);
        }

        .share-btn:hover {
            background: rgba(102, 126, 234, 0.1);
            border-color: #667eea;
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(102, 126, 234, 0.2);
        }

        .share-btn svg {
            width: 20px;
            height: 20px;
            transition: transform 0.3s ease;
        }

        .share-btn:hover svg {
            transform: rotate(15deg);
        }

        /* Enhanced Dashboard */
        .dashboard {
            display: flex;
            flex-direction: row;
            gap: 25px;
            padding: 30px;
            overflow-x: auto;
            min-height: calc(100vh - 100px);
            align-items: flex-start;
            scroll-behavior: smooth;
            position: relative;
            z-index: 1;
        }

        .dashboard::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: 
                linear-gradient(45deg, transparent 49%, rgba(255, 255, 255, 0.03) 50%, transparent 51%),
                linear-gradient(-45deg, transparent 49%, rgba(255, 255, 255, 0.03) 50%, transparent 51%);
            background-size: 20px 20px;
            pointer-events: none;
            z-index: 0;
            animation: subtlePattern 30s linear infinite;
        }

        @keyframes subtlePattern {
            0% { transform: translateX(0) translateY(0); }
            100% { transform: translateX(20px) translateY(20px); }
        }
        
        .dashboard::-webkit-scrollbar {
            height: 12px;
        }
        
        .dashboard::-webkit-scrollbar-track {
            background: rgba(255, 255, 255, 0.2);
            border-radius: 6px;
            backdrop-filter: blur(10px);
        }
        
        .dashboard::-webkit-scrollbar-thumb {
            background: linear-gradient(135deg, #667eea, #764ba2);
            border-radius: 6px;
            border: 2px solid rgba(255, 255, 255, 0.3);
        }
        
        .dashboard::-webkit-scrollbar-thumb:hover {
            background: linear-gradient(135deg, #764ba2, #667eea);
        }

        /* Enhanced Board - Trello-like */
        .board {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(25px);
            border-radius: 16px;
            box-shadow: 
                0 20px 60px rgba(0, 0, 0, 0.1),
                0 4px 12px rgba(0, 0, 0, 0.05);
            display: flex;
            flex-direction: column;
            width: 320px;
            min-width: 320px;
            max-width: 360px;
            padding: 20px;
            flex-shrink: 0;
            border: 1px solid rgba(255, 255, 255, 0.3);
            position: relative;
            overflow: hidden;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            user-select: none;
        }

        .board::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: linear-gradient(90deg, #667eea, #764ba2, #f093fb, #f5576c);
            border-radius: 16px 16px 0 0;
            opacity: 0;
            transition: opacity 0.3s ease;
        }

        .board:hover::before {
            opacity: 1;
        }

        .board:hover {
            transform: translateY(-4px);
            box-shadow: 0 25px 80px rgba(0, 0, 0, 0.15);
        }

        .board.dragover {
            background: rgba(102, 126, 234, 0.1);
            border: 2px dashed #667eea;
            transform: scale(1.02);
        }

        .board.dragover::after {
            content: 'Drop card here';
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            background: rgba(102, 126, 234, 0.9);
            color: white;
            padding: 8px 16px;
            border-radius: 8px;
            font-size: 14px;
            font-weight: 600;
            z-index: 10;
        }

        /* Board Header */
        .board-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 20px;
            position: relative;
        }

        .board-title {
            font-size: 20px;
            font-weight: 700;
            background: linear-gradient(135deg, #667eea, #764ba2);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            margin: 0;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .board-title:hover {
            transform: scale(1.05);
        }

        .board-menu {
            position: relative;
        }

        .board-menu-btn {
            width: 32px;
            height: 32px;
            border-radius: 8px;
            background: rgba(0, 0, 0, 0.1);
            border: none;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #666;
            transition: all 0.3s ease;
            opacity: 0;
        }

        .board:hover .board-menu-btn {
            opacity: 1;
        }

        .board-menu-btn:hover {
            background: rgba(0, 0, 0, 0.2);
            transform: scale(1.1);
        }

        /* Board Cards Container */
        .board-cards {
            flex: 1;
            min-height: 100px;
            position: relative;
        }

        .board-cards.dragover {
            background: rgba(102, 126, 234, 0.05);
            border-radius: 8px;
            border: 2px dashed rgba(102, 126, 234, 0.3);
        }

        /* Add Card Button */
        .add-card-btn {
            width: 100%;
            padding: 12px;
            background: rgba(0, 0, 0, 0.05);
            border: 2px dashed rgba(0, 0, 0, 0.2);
            border-radius: 8px;
            color: #666;
            font-size: 14px;
            font-weight: 500;
            cursor: pointer;
            transition: all 0.3s ease;
            margin-top: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
        }

        .add-card-btn:hover {
            background: rgba(102, 126, 234, 0.1);
            border-color: #667eea;
            color: #667eea;
            transform: translateY(-2px);
        }

        .add-card-btn:active {
            transform: translateY(0);
        }

        /* Add List Styles */
        .add-list-container {
            min-width: 280px;
            margin-left: 20px;
        }

        .add-list-btn {
            width: 100%;
            padding: 12px;
            background: rgba(0, 0, 0, 0.05);
            border: 2px dashed #fff;
            border-radius: 8px;
            color: #fff;
            font-size: 14px;
            font-weight: 500;
            cursor: pointer;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
        }

        .add-list-btn:hover {
            background: rgba(17, 109, 116, 0.1);
            border-color:rgb(13, 37, 148);
            color:#fff;
            transform: translateY(-2px);
        }

        .add-list-btn:active {
            transform: translateY(0);
        }

        .create-list-form {
            background: #f8f9fa;
            border-radius: 8px;
            padding: 12px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
            animation: slideDown 0.3s ease;
        }

        .create-list-form input {
            width: 100%;
            padding: 8px 12px;
            border: 2px solid #e1e5e9;
            border-radius: 6px;
            font-size: 14px;
            margin-bottom: 8px;
            transition: border-color 0.3s ease;
        }

        .create-list-form input:focus {
            outline: none;
            border-color: #667eea;
        }

        .create-list-actions {
            display: flex;
            gap: 8px;
            align-items: center;
        }

        .create-list-submit {
            background: #667eea;
            color: white;
            border: none;
            padding: 8px 16px;
            border-radius: 6px;
            font-size: 14px;
            font-weight: 500;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .create-list-submit:hover {
            background: #5a6fd8;
        }

        .create-list-cancel {
            background: transparent;
            border: none;
            color: #666;
            padding: 8px;
            border-radius: 6px;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .create-list-cancel:hover {
            background: rgba(0, 0, 0, 0.1);
            color: #333;
        }

        @keyframes slideDown {
            from {
                opacity: 0;
                transform: translateY(-10px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* Advanced Drag and Drop Animations */
        .card.drag-start {
            transform: rotate(5deg) scale(1.05);
            box-shadow: 0 20px 60px rgba(102, 126, 234, 0.4);
            z-index: 1000;
            opacity: 0.9;
        }

        .card.drag-over {
            transform: translateY(-8px) scale(1.02);
            box-shadow: 0 15px 50px rgba(102, 126, 234, 0.3);
        }

        .board.drag-over {
            background: rgba(102, 126, 234, 0.1);
            border: 2px dashed #667eea;
            transform: scale(1.02);
        }

        .board.drag-over::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(102, 126, 234, 0.05);
            border-radius: 16px;
            animation: pulse 1s infinite;
        }

        @keyframes pulse {
            0%, 100% { opacity: 0.5; }
            50% { opacity: 0.8; }
        }

        /* Card Drop Zones */
        .drop-zone {
            position: relative;
            min-height: 20px;
            border-radius: 8px;
            transition: all 0.3s ease;
        }

        .drop-zone.active {
            background: rgba(102, 126, 234, 0.1);
            border: 2px dashed #667eea;
            animation: dropZonePulse 1s infinite;
        }

        @keyframes dropZonePulse {
            0%, 100% { 
                background: rgba(102, 126, 234, 0.1);
                border-color: #667eea;
            }
            50% { 
                background: rgba(102, 126, 234, 0.2);
                border-color: #4c63d2;
            }
        }

        /* Card Animations */
        .card-enter {
            animation: cardSlideIn 0.3s ease-out;
        }

        .card-exit {
            animation: cardSlideOut 0.3s ease-in;
        }

        @keyframes cardSlideIn {
            from {
                opacity: 0;
                transform: translateY(-20px) scale(0.9);
            }
            to {
                opacity: 1;
                transform: translateY(0) scale(1);
            }
        }

        @keyframes cardSlideOut {
            from {
                opacity: 1;
                transform: translateY(0) scale(1);
            }
            to {
                opacity: 0;
                transform: translateY(20px) scale(0.9);
            }
        }

        /* Board Animations */
        .board-enter {
            animation: boardSlideIn 0.5s ease-out;
        }

        @keyframes boardSlideIn {
            from {
                opacity: 0;
                transform: translateX(-50px) scale(0.9);
            }
            to {
                opacity: 1;
                transform: translateX(0) scale(1);
            }
        }

        /* Interactive Hover Effects */
        .card:hover .card-title {
            color: #667eea;
        }

        .card:hover .card-meta {
            transform: translateY(-2px);
        }

        .card:hover .card-labels {
            transform: scale(1.05);
        }

        .card:hover .card-members {
            transform: scale(1.1);
        }

        /* Loading States */
        .card.loading {
            opacity: 0.6;
            pointer-events: none;
            position: relative;
        }

        .card.loading::after {
            content: '';
            position: absolute;
            top: 50%;
            left: 50%;
            width: 20px;
            height: 20px;
            margin: -10px 0 0 -10px;
            border: 2px solid #f3f3f3;
            border-top: 2px solid #667eea;
            border-radius: 50%;
            animation: spin 1s linear infinite;
        }

        .board.loading {
            opacity: 0.7;
            pointer-events: none;
        }

        .board.loading::after {
            content: '';
            position: absolute;
            top: 50%;
            left: 50%;
            width: 30px;
            height: 30px;
            margin: -15px 0 0 -15px;
            border: 3px solid #f3f3f3;
            border-top: 3px solid #667eea;
            border-radius: 50%;
            animation: spin 1s linear infinite;
        }

        /* Success Animations */
        .card.success {
            animation: cardSuccess 0.6s ease-out;
        }

        @keyframes cardSuccess {
            0% { transform: scale(1); }
            50% { transform: scale(1.05); background: rgba(97, 189, 79, 0.1); }
            100% { transform: scale(1); }
        }

        .board.success {
            animation: boardSuccess 0.6s ease-out;
        }

        @keyframes boardSuccess {
            0% { transform: scale(1); }
            50% { transform: scale(1.02); background: rgba(97, 189, 79, 0.1); }
            100% { transform: scale(1); }
        }

        /* Error Animations */
        .card.error {
            animation: cardError 0.6s ease-out;
        }

        @keyframes cardError {
            0% { transform: translateX(0); }
            25% { transform: translateX(-5px); background: rgba(235, 90, 70, 0.1); }
            75% { transform: translateX(5px); background: rgba(235, 90, 70, 0.1); }
            100% { transform: translateX(0); }
        }

        /* Smooth Transitions */
        .card, .board, .dashboard {
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        /* Focus States */
        .card:focus-within {
            outline: 2px solid #667eea;
            outline-offset: 2px;
        }

        .board:focus-within {
            outline: 2px solid #667eea;
            outline-offset: 2px;
        }

        /* Enhanced Modal Styles */
        .task-modal-enhanced {
            max-width: 800px;
            width: 90%;
            max-height: 90vh;
            overflow-y: auto;
            position: relative;
            background: white;
            border-radius: 16px;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.3);
        }

        .modal {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5);
            backdrop-filter: blur(5px);
            z-index: 1000;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }

        .modal-content {
            background: white;
            border-radius: 16px;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.3);
            max-width: 800px;
            width: 100%;
            max-height: 90vh;
            overflow-y: auto;
            position: relative;
        }

        .modal-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 20px;
            border-bottom: 1px solid rgba(0, 0, 0, 0.1);
            background: linear-gradient(135deg, #667eea, #764ba2);
            color: white;
        }

        .modal-header-left {
            display: flex;
            align-items: center;
            gap: 20px;
        }

        .modal-header-right {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .list-status {
            display: flex;
            align-items: center;
            gap: 8px;
            background: rgba(255, 255, 255, 0.2);
            padding: 8px 16px;
            border-radius: 20px;
            font-size: 14px;
            font-weight: 500;
        }

        .card-id {
            background: rgba(255, 255, 255, 0.2);
            padding: 4px 12px;
            border-radius: 12px;
            font-size: 12px;
            font-weight: 600;
        }

        .modal-action-btn {
            width: 36px;
            height: 36px;
            border-radius: 8px;
            background: rgba(255, 255, 255, 0.2);
            border: none;
            color: white;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.3s ease;
        }

        .modal-action-btn:hover {
            background: rgba(255, 255, 255, 0.3);
            transform: scale(1.1);
        }

        .close-btn {
            width: 36px;
            height: 36px;
            border-radius: 8px;
            background: rgba(255, 255, 255, 0.2);
            border: none;
            color: white;
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

        /* Task Title Section */
        .task-title-section {
            display: flex;
            align-items: center;
            gap: 12px;
            margin-bottom: 20px;
        }

        .task-title {
            flex: 1;
            font-size: 24px;
            font-weight: 700;
            color: #333;
            border: none;
            outline: none;
            background: transparent;
            padding: 8px 0;
            border-radius: 4px;
            transition: all 0.3s ease;
        }

        .task-title:focus {
            background: rgba(102, 126, 234, 0.1);
            padding: 8px 12px;
        }

        .edit-title-btn {
            width: 32px;
            height: 32px;
            border-radius: 6px;
            background: rgba(102, 126, 234, 0.1);
            border: none;
            color: #667eea;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.3s ease;
            opacity: 0;
        }

        .task-title-section:hover .edit-title-btn {
            opacity: 1;
        }

        .edit-title-btn:hover {
            background: rgba(102, 126, 234, 0.2);
            transform: scale(1.1);
        }

        /* Interactive Buttons */
        .interactive-btn {
            display: flex;
            align-items: center;
            gap: 8px;
            padding: 12px 16px;
            background: rgba(0, 0, 0, 0.05);
            border: 1px solid rgba(0, 0, 0, 0.1);
            border-radius: 8px;
            color: #666;
            cursor: pointer;
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
            font-size: 14px;
            font-weight: 500;
            min-height: 44px;
            justify-content: center;
        }

        .button-layer {
            display: flex;
            flex-wrap: wrap;
            gap: 12px;
            margin: 20px 0;
            padding: 16px;
            background: rgba(0, 0, 0, 0.02);
            border-radius: 12px;
            border: 1px solid rgba(0, 0, 0, 0.05);
        }

        .interactive-btn:hover {
            background: rgba(102, 126, 234, 0.1);
            border-color: #667eea;
            color: #667eea;
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(102, 126, 234, 0.2);
        }

        .interactive-btn.active {
            background: rgba(102, 126, 234, 0.1);
            border-color: #667eea;
            color: #667eea;
        }

        .btn-indicator {
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            height: 3px;
            background: #667eea;
            transform: scaleX(0);
            transition: transform 0.3s ease;
        }

        .interactive-btn.active .btn-indicator {
            transform: scaleX(1);
        }

        /* Enhanced Dynamic Panels */
        .dynamic-panel {
            background: rgba(255, 255, 255, 0.95);
            border: 1px solid rgba(0, 0, 0, 0.1);
            border-radius: 12px;
            padding: 20px;
            margin-top: 16px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
            animation: slideDown 0.3s ease;
        }

        @keyframes slideDown {
            from {
                opacity: 0;
                transform: translateY(-10px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* Member Search */
        .member-search {
            margin-bottom: 16px;
        }

        .member-search input {
            width: 100%;
            padding: 8px 12px;
            border: 1px solid rgba(0, 0, 0, 0.1);
            border-radius: 6px;
            font-size: 14px;
            transition: all 0.3s ease;
        }

        .member-search input:focus {
            outline: none;
            border-color: #667eea;
            box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
        }

        /* Enhanced Member Options */
        .member-option {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 12px;
            border-radius: 8px;
            cursor: pointer;
            transition: all 0.3s ease;
            border: 1px solid transparent;
        }

        .member-option:hover {
            background: rgba(102, 126, 234, 0.1);
            border-color: rgba(102, 126, 234, 0.2);
            transform: translateX(4px);
        }

        .member-info {
            display: flex;
            flex-direction: column;
            gap: 2px;
        }

        .member-name {
            font-weight: 600;
            color: #333;
            font-size: 14px;
        }

        .member-email {
            font-size: 12px;
            color: #666;
        }

        /* Checklist Styles */
        .checklist-container {
            display: flex;
            flex-direction: column;
            gap: 12px;
        }

        .checklist-item {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 8px 0;
            border-bottom: 1px solid rgba(0, 0, 0, 0.05);
        }

        .checklist-item input[type="checkbox"] {
            width: 18px;
            height: 18px;
            accent-color: #667eea;
        }

        .checklist-item label {
            flex: 1;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .checklist-item input[type="checkbox"]:checked + label {
            text-decoration: line-through;
            color: #666;
        }

        .remove-item {
            width: 24px;
            height: 24px;
            border-radius: 4px;
            background: rgba(235, 90, 70, 0.1);
            border: none;
            color: #eb5a46;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.3s ease;
            opacity: 0;
        }

        .checklist-item:hover .remove-item {
            opacity: 1;
        }

        .remove-item:hover {
            background: rgba(235, 90, 70, 0.2);
            transform: scale(1.1);
        }

        .add-checklist-item {
            display: flex;
            align-items: center;
            gap: 8px;
            padding: 8px 0;
        }

        .add-checklist-item input {
            flex: 1;
            padding: 8px 12px;
            border: 1px solid rgba(0, 0, 0, 0.1);
            border-radius: 6px;
            font-size: 14px;
        }

        .add-checklist-item button {
            width: 32px;
            height: 32px;
            border-radius: 6px;
            background: #667eea;
            border: none;
            color: white;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.3s ease;
        }

        .add-checklist-item button:hover {
            background: #5a6fd8;
            transform: scale(1.1);
        }

        /* Comments Styles */
        .comments-container {
            display: flex;
            flex-direction: column;
            gap: 16px;
        }

        .comment-item {
            display: flex;
            gap: 12px;
            padding: 12px 0;
            border-bottom: 1px solid rgba(0, 0, 0, 0.05);
        }

        .comment-avatar {
            width: 32px;
            height: 32px;
            border-radius: 50%;
            background: linear-gradient(135deg, #667eea, #764ba2);
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 12px;
            font-weight: 600;
            flex-shrink: 0;
        }

        .comment-content {
            flex: 1;
        }

        .comment-header {
            display: flex;
            align-items: center;
            gap: 8px;
            margin-bottom: 4px;
        }

        .comment-author {
            font-weight: 600;
            color: #333;
            font-size: 14px;
        }

        .comment-time {
            font-size: 12px;
            color: #666;
        }

        .comment-text {
            color: #555;
            line-height: 1.5;
            font-size: 14px;
        }

        .add-comment {
            display: flex;
            gap: 12px;
            padding: 12px 0;
        }

        .comment-input {
            flex: 1;
            display: flex;
            gap: 8px;
        }

        .comment-input textarea {
            flex: 1;
            padding: 8px 12px;
            border: 1px solid rgba(0, 0, 0, 0.1);
            border-radius: 6px;
            font-size: 14px;
            resize: vertical;
            min-height: 40px;
        }

        .comment-input button {
            width: 40px;
            height: 40px;
            border-radius: 6px;
            background: #667eea;
            border: none;
            color: white;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.3s ease;
        }

        .comment-input button:hover {
            background: #5a6fd8;
            transform: scale(1.1);
        }

        /* Responsive Design for Modal */
        @media (max-width: 768px) {
            .modal {
                padding: 10px;
            }

            .task-modal-enhanced {
                width: 100%;
                max-width: 100%;
                margin: 0;
            }

            .modal-header {
                flex-direction: column;
                gap: 12px;
                padding: 16px;
            }

            .modal-header-left {
                flex-direction: column;
                align-items: flex-start;
                gap: 8px;
            }

            .modal-header-right {
                flex-wrap: wrap;
                gap: 8px;
            }

            .task-title {
                font-size: 20px;
            }

            .button-layer {
                flex-direction: column;
                gap: 8px;
                padding: 12px;
            }

            .interactive-btn {
                justify-content: center;
                padding: 16px;
                width: 100%;
            }

            .dynamic-panel {
                padding: 16px;
                margin: 12px 0;
            }

            .member-option {
                padding: 16px;
            }

            .checklist-item {
                padding: 12px 0;
            }

            .comment-item {
                padding: 16px 0;
            }
        }

        @media (max-width: 480px) {
            .modal {
                padding: 0;
            }

            .task-modal-enhanced {
                width: 100%;
                height: 100vh;
                max-height: 100vh;
                margin: 0;
                border-radius: 0;
            }

            .modal-header {
                padding: 12px;
                flex-direction: column;
                gap: 8px;
            }

            .modal-header-right {
                width: 100%;
                justify-content: space-between;
            }

            .task-title {
                font-size: 18px;
            }

            .button-layer {
                padding: 8px;
                gap: 8px;
            }

            .interactive-btn {
                padding: 12px;
                font-size: 14px;
                min-height: 40px;
            }

            .dynamic-panel {
                padding: 12px;
                margin: 8px 0;
            }

            .member-option {
                padding: 12px;
            }

            .checklist-item {
                padding: 8px 0;
            }

            .comment-item {
                padding: 12px 0;
            }

            .modal-action-btn {
                width: 32px;
                height: 32px;
            }

            .close-btn {
                width: 32px;
                height: 32px;
            }
        }

        /* Enhanced Card Interactions */
        .card {
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .card:hover {
            transform: translateY(-4px) scale(1.02);
            box-shadow: 0 12px 40px rgba(102, 126, 234, 0.2);
        }

        .card:active {
            transform: translateY(-2px) scale(1.01);
        }

        /* Card Loading States */
        .card.loading {
            opacity: 0.6;
            pointer-events: none;
            position: relative;
        }

        .card.loading::after {
            content: '';
            position: absolute;
            top: 50%;
            left: 50%;
            width: 20px;
            height: 20px;
            margin: -10px 0 0 -10px;
            border: 2px solid #f3f3f3;
            border-top: 2px solid #667eea;
            border-radius: 50%;
            animation: spin 1s linear infinite;
        }

        /* Card Success States */
        .card.success {
            animation: cardSuccess 0.6s ease-out;
        }

        @keyframes cardSuccess {
            0% { transform: scale(1); }
            50% { transform: scale(1.05); background: rgba(97, 189, 79, 0.1); }
            100% { transform: scale(1); }
        }

        /* Card Error States */
        .card.error {
            animation: cardError 0.6s ease-out;
        }

        @keyframes cardError {
            0% { transform: translateX(0); }
            25% { transform: translateX(-5px); background: rgba(235, 90, 70, 0.1); }
            75% { transform: translateX(5px); background: rgba(235, 90, 70, 0.1); }
            100% { transform: translateX(0); }
        }

        /* Enhanced Card Actions */
        .card-actions {
            position: absolute;
            top: 8px;
            right: 8px;
            opacity: 0;
            transition: all 0.3s ease;
            display: flex;
            gap: 4px;
            z-index: 10;
        }

        .card:hover .card-actions {
            opacity: 1;
        }

        .card-action-btn {
            width: 28px;
            height: 28px;
            border-radius: 6px;
            background: rgba(255, 255, 255, 0.9);
            border: 1px solid rgba(0, 0, 0, 0.1);
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 12px;
            color: #666;
            transition: all 0.2s ease;
            backdrop-filter: blur(10px);
        }

        .card-action-btn:hover {
            background: rgba(102, 126, 234, 0.1);
            border-color: #667eea;
            color: #667eea;
            transform: scale(1.1);
        }

        /* Card Meta Enhancements */
        .card-meta {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-top: 12px;
            gap: 8px;
        }

        .card-due-date {
            display: flex;
            align-items: center;
            gap: 4px;
            font-size: 12px;
            color: #666;
            padding: 4px 8px;
            border-radius: 4px;
            background: rgba(0, 0, 0, 0.05);
            transition: all 0.2s ease;
        }

        .card-due-date.overdue {
            color: #eb5a46;
            background: rgba(235, 90, 70, 0.1);
            font-weight: 600;
        }

        .card-due-date.due-soon {
            color: #f2d600;
            background: rgba(242, 214, 0, 0.1);
            font-weight: 600;
        }

        .card-due-date:hover {
            transform: scale(1.05);
        }

        /* Card Labels Enhancement */
        .card-labels {
            display: flex;
            gap: 4px;
            margin-bottom: 8px;
            flex-wrap: wrap;
        }

        .card-label {
            height: 8px;
            border-radius: 4px;
            min-width: 40px;
            cursor: pointer;
            transition: all 0.2s ease;
        }

        .card-label:hover {
            transform: scale(1.1);
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.2);
        }

        /* Card Members Enhancement */
        .card-members {
            display: flex;
            gap: 2px;
            margin-left: auto;
            flex-wrap: wrap;
        }

        .card-member {
            width: 24px;
            height: 24px;
            border-radius: 50%;
            background: linear-gradient(135deg, #667eea, #764ba2);
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 10px;
            font-weight: 600;
            border: 2px solid white;
            cursor: pointer;
            transition: all 0.2s ease;
            position: relative;
        }

        .card-member:hover {
            transform: scale(1.2);
            z-index: 10;
        }

        .card-member::after {
            content: attr(data-tooltip);
            position: absolute;
            bottom: -30px;
            left: 50%;
            transform: translateX(-50%);
            background: rgba(0, 0, 0, 0.8);
            color: white;
            padding: 4px 8px;
            border-radius: 4px;
            font-size: 11px;
            white-space: nowrap;
            opacity: 0;
            pointer-events: none;
            transition: opacity 0.2s ease;
        }

        .card-member:hover::after {
            opacity: 1;
        }

        .board::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: linear-gradient(90deg, #667eea, #764ba2);
            transform: scaleX(0);
            transition: transform 0.3s ease;
        }

        .board:hover {
            transform: translateY(-4px);
            box-shadow: 0 25px 80px rgba(0, 0, 0, 0.15);
        }

        .board:hover::before {
            transform: scaleX(1);
        }

        .board h2 {
            font-size: 20px;
            font-weight: 700;
            background: linear-gradient(135deg, #667eea, #764ba2);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            margin-bottom: 20px;
            text-align: center;
            text-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        /* Enhanced Cards - Trello-like */
        .card {
            background: #ffffff;
            border-radius: 8px;
            padding: 12px;
            margin-bottom: 8px;
            cursor: pointer;
            transition: all 0.2s ease;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.12), 0 1px 2px rgba(0, 0, 0, 0.24);
            font-size: 14px;
            line-height: 1.4;
            position: relative;
            overflow: hidden;
            font-weight: 400;
            user-select: none;
            transform-origin: center;
            min-height: 40px;
            display: block;
            border: none;
        }

        .card:hover {
            background: #f8f9fa;
            box-shadow: 
                0 3px 6px rgba(0, 0, 0, 0.16), 
                0 3px 6px rgba(0, 0, 0, 0.23),
                0 0 0 1px rgba(102, 126, 234, 0.1);
            transform: translateY(-2px) scale(1.01);
        }

        .card:active {
            transform: translateY(0);
        }

        /* Card Title - Trello Style */
        .card-title {
            font-size: 14px;
            font-weight: 400;
            color: #172b4d;
            line-height: 1.4;
            word-wrap: break-word;
            margin: 0;
            padding: 0;
        }

        /* Card Labels - Trello Style */
        .card-labels {
            display: flex;
            flex-wrap: wrap;
            gap: 4px;
            margin: 4px 0;
        }

        .card-label {
            height: 8px;
            border-radius: 4px;
            min-width: 40px;
            display: inline-block;
        }

        .card-label.red { background: #eb5a46; }
        .card-label.orange { background: #ff9f1a; }
        .card-label.yellow { background: #f2d600; }
        .card-label.green { background: #61bd4f; }
        .card-label.blue { background: #0079bf; }
        .card-label.purple { background: #c377e0; }
        .card-label.pink { background: #ff78cb; }
        .card-label.sky { background: #00c2e0; }
        .card-label.lime { background: #51e898; }
        .card-label.grey { background: #838c91; }

        /* Card Badges - Trello Style */
        .card-badges {
            display: flex;
            align-items: center;
            gap: 6px;
            margin-top: 8px;
            flex-wrap: wrap;
        }

        .card-badge {
            display: flex;
            align-items: center;
            gap: 4px;
            font-size: 12px;
            color: #5e6c84;
            background: rgba(0, 0, 0, 0.08);
            padding: 2px 6px;
            border-radius: 3px;
            line-height: 1;
        }

        .card-badge i {
            font-size: 11px;
        }

        /* Card Members - Trello Style */
        .card-members {
            display: flex;
            align-items: center;
            gap: 2px;
            margin-top: 8px;
        }

        .card-member {
            width: 28px;
            height: 28px;
            border-radius: 50%;
            background: #dfe1e6;
            color: #172b4d;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 12px;
            font-weight: 500;
            border: 2px solid #fff;
            position: relative;
            cursor: pointer;
        }

        .card-member:not(:first-child) {
            margin-left: -4px;
        }

        .card-member:hover {
            z-index: 10;
            transform: scale(1.1);
        }

        /* Card Due Date - Trello Style */
        .card-due-date {
            display: flex;
            align-items: center;
            gap: 4px;
            font-size: 12px;
            padding: 2px 6px;
            border-radius: 3px;
            margin-top: 4px;
            width: fit-content;
        }

        .card-due-date.overdue {
            background: #eb5a46;
            color: white;
        }

        .card-due-date.due-soon {
            background: #f2d600;
            color: #172b4d;
        }

        .card-due-date.completed {
            background: #61bd4f;
            color: white;
        }

        /* Card Attachments - Trello Style */
        .card-attachments {
            display: flex;
            align-items: center;
            gap: 4px;
            font-size: 12px;
            color: #5e6c84;
            margin-top: 4px;
        }

        .card-attachment {
            display: flex;
            align-items: center;
            gap: 2px;
        }

        /* Card Comments - Trello Style */
        .card-comments {
            display: flex;
            align-items: center;
            gap: 4px;
            font-size: 12px;
            color: #5e6c84;
            margin-top: 4px;
        }

        .card-comment-count {
            display: flex;
            align-items: center;
            gap: 2px;
        }

        /* Card Actions - Hidden by default, shown on hover */
        .card-actions {
            position: absolute;
            top: 4px;
            right: 4px;
            opacity: 0;
            transition: opacity 0.2s ease;
            display: flex;
            gap: 4px;
        }

        .card:hover .card-actions {
            opacity: 1;
        }

        .card-action-btn {
            width: 24px;
            height: 24px;
            border: none;
            background: rgba(0, 0, 0, 0.1);
            border-radius: 3px;
            color: #5e6c84;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 12px;
            transition: all 0.2s ease;
        }

        .card-action-btn:hover {
            background: rgba(0, 0, 0, 0.2);
            color: #172b4d;
        }

        /* Card Content */
        .card-content {
            flex: 1;
            display: flex;
            flex-direction: column;
            gap: 8px;
        }

        .card-description {
            font-size: 13px;
            color: #666;
            line-height: 1.4;
            max-height: 60px;
            overflow: hidden;
            text-overflow: ellipsis;
            display: -webkit-box;
            -webkit-line-clamp: 3;
            -webkit-box-orient: vertical;
        }

        /* Card Meta Information */
        .card-meta {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-top: auto;
            gap: 8px;
            flex-wrap: wrap;
        }

        .card-stats {
            display: flex;
            align-items: center;
            gap: 8px;
            flex-wrap: wrap;
        }

        .card-priority {
            padding: 4px 8px;
            border-radius: 12px;
            font-size: 11px;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .card-priority.low {
            background: rgba(97, 189, 79, 0.1);
            color: #61bd4f;
        }

        .card-priority.medium {
            background: rgba(242, 214, 0, 0.1);
            color: #f2d600;
        }

        .card-priority.high {
            background: rgba(235, 90, 70, 0.1);
            color: #eb5a46;
        }

        .card-progress {
            width: 100%;
            height: 4px;
            background: rgba(0, 0, 0, 0.1);
            border-radius: 2px;
            overflow: hidden;
            margin: 4px 0;
        }

        .card-progress-bar {
            height: 100%;
            background: linear-gradient(90deg, #61bd4f, #5aac44);
            border-radius: 2px;
            transition: width 0.3s ease;
        }

        /* Card Attachments */
        .card-attachments {
            display: flex;
            align-items: center;
            gap: 4px;
            font-size: 12px;
            color: #666;
        }

        .card-attachment {
            display: flex;
            align-items: center;
            gap: 4px;
            padding: 2px 6px;
            background: rgba(0, 0, 0, 0.05);
            border-radius: 4px;
            cursor: pointer;
            transition: all 0.2s ease;
        }

        .card-attachment:hover {
            background: rgba(0, 0, 0, 0.1);
            transform: scale(1.05);
        }

        /* Card Comments */
        .card-comments {
            display: flex;
            align-items: center;
            gap: 4px;
            font-size: 12px;
            color: #666;
        }

        .card-comment-count {
            display: flex;
            align-items: center;
            gap: 4px;
            padding: 2px 6px;
            background: rgba(0, 0, 0, 0.05);
            border-radius: 4px;
            cursor: pointer;
            transition: all 0.2s ease;
        }

        .card-comment-count:hover {
            background: rgba(0, 0, 0, 0.1);
            transform: scale(1.05);
        }

        /* Enhanced Card Interactions */
        .card-hover {
            transform: translateY(-2px) scale(1.02);
            box-shadow: 0 8px 30px rgba(0, 0, 0, 0.15);
        }

        .card-actions.show {
            opacity: 1;
            visibility: visible;
        }

        .card-title-edit {
            width: 100%;
            border: none;
            background: transparent;
            font-size: inherit;
            font-weight: inherit;
            color: inherit;
            outline: 2px solid #667eea;
            border-radius: 4px;
            padding: 4px 8px;
        }

        /* Member Tooltip */
        .member-tooltip {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            border-radius: 12px;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.2);
            border: 1px solid rgba(102, 126, 234, 0.2);
            padding: 16px;
            min-width: 200px;
        }

        .member-tooltip-content {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .member-avatar-large {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background: linear-gradient(135deg, #667eea, #764ba2);
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 600;
            font-size: 16px;
        }

        .member-info .member-name {
            font-weight: 600;
            color: #333;
            margin-bottom: 4px;
        }

        .member-info .member-role {
            font-size: 12px;
            color: #666;
        }

        /* Card Animation Classes */
        .card-enter {
            animation: cardSlideIn 0.3s ease-out;
        }

        @keyframes cardSlideIn {
            from {
                opacity: 0;
                transform: translateY(20px) scale(0.95);
            }
            to {
                opacity: 1;
                transform: translateY(0) scale(1);
            }
        }

        .card-exit {
            animation: cardSlideOut 0.3s ease-in;
        }

        @keyframes cardSlideOut {
            from {
                opacity: 1;
                transform: translateY(0) scale(1);
            }
            to {
                opacity: 0;
                transform: translateY(-20px) scale(0.95);
            }
        }

        .card:active {
            cursor: grabbing;
        }

        /* Card Input Form Styles */
        .card-input-form {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            border: 2px solid rgba(102, 126, 234, 0.2);
            border-radius: 12px;
            margin-bottom: 12px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
            overflow: hidden;
        }

        .card-input-container {
            padding: 20px;
        }

        .card-input-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 20px;
            padding-bottom: 15px;
            border-bottom: 1px solid rgba(0, 0, 0, 0.1);
        }

        .card-input-header h4 {
            margin: 0;
            color: #333;
            font-size: 18px;
            font-weight: 600;
        }

        .close-card-input {
            background: none;
            border: none;
            color: #666;
            font-size: 18px;
            cursor: pointer;
            padding: 5px;
            border-radius: 4px;
            transition: all 0.2s ease;
        }

        .close-card-input:hover {
            background: rgba(0, 0, 0, 0.1);
            color: #333;
        }

        .card-form .form-group {
            margin-bottom: 16px;
        }

        .card-form .form-row {
            display: flex;
            gap: 16px;
        }

        .card-form .form-row .form-group {
            flex: 1;
        }

        .card-form label {
            display: block;
            margin-bottom: 6px;
            font-weight: 500;
            color: #333;
            font-size: 14px;
        }

        .card-form input,
        .card-form textarea,
        .card-form select {
            width: 100%;
            padding: 12px;
            border: 2px solid rgba(0, 0, 0, 0.1);
            border-radius: 8px;
            font-size: 14px;
            transition: all 0.2s ease;
            background: rgba(255, 255, 255, 0.9);
        }

        .card-form input:focus,
        .card-form textarea:focus,
        .card-form select:focus {
            outline: none;
            border-color: #667eea;
            box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
        }

        .card-form textarea {
            resize: vertical;
            min-height: 80px;
        }

        .form-actions {
            display: flex;
            gap: 12px;
            justify-content: flex-end;
            margin-top: 20px;
            padding-top: 15px;
            border-top: 1px solid rgba(0, 0, 0, 0.1);
        }

        .btn-cancel,
        .btn-submit {
            padding: 12px 20px;
            border: none;
            border-radius: 8px;
            font-size: 14px;
            font-weight: 500;
            cursor: pointer;
            transition: all 0.2s ease;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .btn-cancel {
            background: rgba(0, 0, 0, 0.1);
            color: #666;
        }

        .btn-cancel:hover {
            background: rgba(0, 0, 0, 0.15);
            color: #333;
        }

        .btn-submit {
            background: linear-gradient(135deg, #667eea, #764ba2);
            color: white;
            box-shadow: 0 4px 15px rgba(102, 126, 234, 0.3);
        }

        .btn-submit:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(102, 126, 234, 0.4);
        }

        .btn-submit:disabled {
            opacity: 0.6;
            cursor: not-allowed;
            transform: none;
        }

        /* Responsive Card Input Form */
        @media (max-width: 768px) {
            .card-input-container {
                padding: 16px;
            }

            .card-form .form-row {
                flex-direction: column;
                gap: 12px;
            }

            .form-actions {
                flex-direction: column;
            }

            .btn-cancel,
            .btn-submit {
                width: 100%;
                justify-content: center;
            }
        }

        /* Trello-like Modal Styles */
        .trello-modal {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: 2000;
            background: rgba(0, 0, 0, 0.5);
            backdrop-filter: blur(5px);
        }

        .trello-modal-overlay {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            cursor: pointer;
        }

        .trello-modal-content {
            position: relative;
            background: #f4f5f7;
            border-radius: 8px;
            margin: 48px auto;
            max-width: 768px;
            width: 90%;
            max-height: calc(100vh - 96px);
            overflow: hidden;
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.3);
            animation: trelloModalSlideIn 0.3s ease;
        }

        @keyframes trelloModalSlideIn {
            from {
                opacity: 0;
                transform: scale(0.9) translateY(-20px);
            }
            to {
                opacity: 1;
                transform: scale(1) translateY(0);
            }
        }

        .trello-modal-header {
            background: #fff;
            padding: 20px 24px;
            border-bottom: 1px solid #e2e4e6;
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
        }

        .trello-modal-title h2 {
            font-size: 20px;
            font-weight: 600;
            color: #172b4d;
            margin: 0;
            padding: 8px 12px;
            border: 2px solid transparent;
            border-radius: 4px;
            min-height: 32px;
            line-height: 1.2;
        }

        .trello-modal-title h2:focus {
            border-color: #0079bf;
            background: #fff;
            outline: none;
        }

        .trello-modal-subtitle {
            color: #5e6c84;
            font-size: 14px;
            margin-top: 4px;
            display: block;
        }

        .trello-close-btn {
            background: none;
            border: none;
            color: #5e6c84;
            font-size: 18px;
            cursor: pointer;
            padding: 8px;
            border-radius: 4px;
            transition: all 0.2s ease;
        }

        .trello-close-btn:hover {
            background: #e2e4e6;
            color: #172b4d;
        }

        .trello-modal-body {
            display: flex;
            min-height: 400px;
        }

        .trello-modal-main {
            flex: 1;
            padding: 24px;
            overflow-y: auto;
            max-height: calc(100vh - 200px);
        }

        .trello-modal-sidebar {
            width: 200px;
            background: #fff;
            border-left: 1px solid #e2e4e6;
            padding: 16px;
        }

        .trello-section {
            margin-bottom: 24px;
        }

        .trello-section-header {
            margin-bottom: 12px;
        }

        .trello-section-header h3 {
            font-size: 16px;
            font-weight: 600;
            color: #172b4d;
            margin: 0;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .trello-section-header i {
            color: #5e6c84;
        }

        /* Labels */
        .trello-labels-list {
            display: flex;
            flex-wrap: wrap;
            gap: 8px;
            margin-bottom: 12px;
        }

        .trello-label {
            padding: 4px 8px;
            border-radius: 4px;
            font-size: 12px;
            font-weight: 500;
            color: white;
            cursor: pointer;
            transition: all 0.2s ease;
        }

        .trello-label:hover {
            opacity: 0.8;
        }

        .trello-add-label-btn {
            background: #e2e4e6;
            border: none;
            color: #5e6c84;
            padding: 8px 12px;
            border-radius: 4px;
            cursor: pointer;
            font-size: 14px;
            transition: all 0.2s ease;
        }

        .trello-add-label-btn:hover {
            background: #d6d8da;
        }

        /* Members */
        .trello-members-list {
            display: flex;
            flex-wrap: wrap;
            gap: 8px;
            margin-bottom: 12px;
        }

        .trello-member {
            width: 32px;
            height: 32px;
            border-radius: 50%;
            background: #dfe1e6;
            color: #172b4d;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 12px;
            font-weight: 500;
            cursor: pointer;
            transition: all 0.2s ease;
        }

        .trello-member:hover {
            transform: scale(1.1);
        }

        .trello-add-member-btn {
            background: #e2e4e6;
            border: none;
            color: #5e6c84;
            padding: 8px 12px;
            border-radius: 4px;
            cursor: pointer;
            font-size: 14px;
            transition: all 0.2s ease;
        }

        .trello-add-member-btn:hover {
            background: #d6d8da;
        }

        /* Checklist */
        .trello-checklist-progress {
            display: flex;
            align-items: center;
            gap: 12px;
            margin-bottom: 16px;
        }

        .trello-progress-bar {
            flex: 1;
            height: 8px;
            background: #e2e4e6;
            border-radius: 4px;
            overflow: hidden;
        }

        .trello-progress-fill {
            height: 100%;
            background: #61bd4f;
            transition: width 0.3s ease;
        }

        .trello-progress-text {
            font-size: 12px;
            color: #5e6c84;
            font-weight: 500;
        }

        .trello-checklist-item {
            display: flex;
            align-items: center;
            gap: 8px;
            padding: 8px 0;
            border-bottom: 1px solid #e2e4e6;
        }

        .trello-checklist-item:last-child {
            border-bottom: none;
        }

        .trello-checklist-item input[type="checkbox"] {
            width: 16px;
            height: 16px;
            cursor: pointer;
        }

        .trello-checklist-item label {
            flex: 1;
            cursor: pointer;
            font-size: 14px;
            color: #172b4d;
        }

        .trello-checklist-item.completed label {
            text-decoration: line-through;
            color: #5e6c84;
        }

        .trello-add-checklist-item {
            display: flex;
            gap: 8px;
            margin-top: 12px;
        }

        .trello-add-checklist-item input {
            flex: 1;
            padding: 8px 12px;
            border: 1px solid #e2e4e6;
            border-radius: 4px;
            font-size: 14px;
        }

        .trello-add-checklist-item button {
            background: #0079bf;
            color: white;
            border: none;
            padding: 8px 16px;
            border-radius: 4px;
            cursor: pointer;
            font-size: 14px;
        }

        /* Due Date */
        .trello-due-date-display {
            margin-bottom: 12px;
        }

        .trello-due-date-badge {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 4px 8px;
            border-radius: 4px;
            font-size: 12px;
            font-weight: 500;
        }

        .trello-due-date-badge.overdue {
            background: #eb5a46;
            color: white;
        }

        .trello-due-date-badge.due-soon {
            background: #f2d600;
            color: #172b4d;
        }

        .trello-due-date-badge.completed {
            background: #61bd4f;
            color: white;
        }

        .trello-set-due-date-btn {
            background: #e2e4e6;
            border: none;
            color: #5e6c84;
            padding: 8px 12px;
            border-radius: 4px;
            cursor: pointer;
            font-size: 14px;
            transition: all 0.2s ease;
        }

        .trello-set-due-date-btn:hover {
            background: #d6d8da;
        }

        /* Attachments */
        .trello-attachments-list {
            margin-bottom: 12px;
        }

        .trello-attachment {
            display: flex;
            align-items: center;
            gap: 8px;
            padding: 8px;
            background: #fff;
            border: 1px solid #e2e4e6;
            border-radius: 4px;
            margin-bottom: 8px;
        }

        .trello-attachment-icon {
            width: 24px;
            height: 24px;
            background: #e2e4e6;
            border-radius: 4px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #5e6c84;
        }

        .trello-attachment-info {
            flex: 1;
        }

        .trello-attachment-name {
            font-size: 14px;
            color: #172b4d;
            font-weight: 500;
        }

        .trello-attachment-size {
            font-size: 12px;
            color: #5e6c84;
        }

        .trello-add-attachment-btn {
            background: #e2e4e6;
            border: none;
            color: #5e6c84;
            padding: 8px 12px;
            border-radius: 4px;
            cursor: pointer;
            font-size: 14px;
            transition: all 0.2s ease;
        }

        .trello-add-attachment-btn:hover {
            background: #d6d8da;
        }

        /* Description */
        .trello-description-display {
            background: #fff;
            border: 1px solid #e2e4e6;
            border-radius: 4px;
            padding: 12px;
            margin-bottom: 12px;
            min-height: 60px;
        }

        .trello-description-display.empty {
            color: #5e6c84;
            font-style: italic;
        }

        .trello-edit-description-btn {
            background: #e2e4e6;
            border: none;
            color: #5e6c84;
            padding: 8px 12px;
            border-radius: 4px;
            cursor: pointer;
            font-size: 14px;
            transition: all 0.2s ease;
        }

        .trello-edit-description-btn:hover {
            background: #d6d8da;
        }

        /* Comments */
        .trello-comments-list {
            margin-bottom: 16px;
        }

        .trello-comment {
            display: flex;
            gap: 12px;
            margin-bottom: 16px;
        }

        .trello-comment-avatar {
            width: 32px;
            height: 32px;
            border-radius: 50%;
            overflow: hidden;
        }

        .trello-comment-avatar img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .trello-comment-content {
            flex: 1;
        }

        .trello-comment-header {
            display: flex;
            align-items: center;
            gap: 8px;
            margin-bottom: 4px;
        }

        .trello-comment-author {
            font-weight: 600;
            color: #172b4d;
            font-size: 14px;
        }

        .trello-comment-time {
            color: #5e6c84;
            font-size: 12px;
        }

        .trello-comment-text {
            background: #fff;
            border: 1px solid #e2e4e6;
            border-radius: 4px;
            padding: 8px 12px;
            font-size: 14px;
            line-height: 1.4;
        }

        .trello-add-comment {
            display: flex;
            gap: 12px;
        }

        .trello-comment-input-container {
            flex: 1;
        }

        .trello-comment-input-container textarea {
            width: 100%;
            padding: 8px 12px;
            border: 1px solid #e2e4e6;
            border-radius: 4px;
            font-size: 14px;
            resize: vertical;
            min-height: 60px;
        }

        .trello-comment-actions {
            display: flex;
            gap: 8px;
            margin-top: 8px;
        }

        .trello-comment-save-btn {
            background: #0079bf;
            color: white;
            border: none;
            padding: 6px 12px;
            border-radius: 4px;
            cursor: pointer;
            font-size: 12px;
        }

        .trello-comment-cancel-btn {
            background: #e2e4e6;
            color: #5e6c84;
            border: none;
            padding: 6px 12px;
            border-radius: 4px;
            cursor: pointer;
            font-size: 12px;
        }

        /* Sidebar */
        .trello-sidebar-section {
            margin-bottom: 24px;
        }

        .trello-sidebar-section h4 {
            font-size: 12px;
            font-weight: 600;
            color: #5e6c84;
            text-transform: uppercase;
            margin: 0 0 8px 0;
        }

        .trello-sidebar-btn {
            display: flex;
            align-items: center;
            gap: 8px;
            width: 100%;
            padding: 8px 12px;
            background: none;
            border: none;
            color: #172b4d;
            text-align: left;
            cursor: pointer;
            border-radius: 4px;
            font-size: 14px;
            transition: all 0.2s ease;
            margin-bottom: 4px;
        }

        .trello-sidebar-btn:hover {
            background: #e2e4e6;
        }

        .trello-sidebar-btn i {
            width: 16px;
            color: #5e6c84;
        }

        .trello-archive-btn {
            color: #eb5a46;
        }

        .trello-delete-btn {
            color: #eb5a46;
        }

        /* Enhanced Responsive Modal */
        @media (max-width: 1200px) {
            .trello-modal-content {
                max-width: 90%;
                margin: 40px auto;
            }
        }

        @media (max-width: 768px) {
            .trello-modal-content {
                margin: 20px;
                width: calc(100% - 40px);
                max-height: calc(100vh - 40px);
                border-radius: 12px;
            }

            .trello-modal-body {
                flex-direction: column;
            }

            .trello-modal-sidebar {
                width: 100%;
                border-left: none;
                border-top: 1px solid #e2e4e6;
                padding: 16px;
            }

            .trello-modal-main {
                padding: 16px;
            }

            .trello-modal-header {
                padding: 16px 20px;
                flex-direction: column;
                align-items: flex-start;
                gap: 12px;
            }

            .trello-modal-title h2 {
                font-size: 18px;
                padding: 6px 10px;
            }

            .trello-section {
                margin-bottom: 20px;
            }

            .trello-section-header h3 {
                font-size: 14px;
            }
        }

        @media (max-width: 480px) {
            .trello-modal-content {
                margin: 10px;
                width: calc(100% - 20px);
                max-height: calc(100vh - 20px);
                border-radius: 8px;
            }

            .trello-modal-header {
                padding: 12px 16px;
            }

            .trello-modal-title h2 {
                font-size: 16px;
                padding: 4px 8px;
            }

            .trello-modal-main {
                padding: 12px;
            }

            .trello-modal-sidebar {
                padding: 12px;
            }

            .trello-section {
                margin-bottom: 16px;
            }

            .trello-labels-list,
            .trello-members-list {
                gap: 6px;
            }

            .trello-label {
                padding: 3px 6px;
                font-size: 11px;
            }

            .trello-member {
                width: 28px;
                height: 28px;
                font-size: 11px;
            }

            .trello-checklist-item {
                padding: 6px 0;
            }

            .trello-comment {
                gap: 8px;
                margin-bottom: 12px;
            }

            .trello-comment-avatar {
                width: 28px;
                height: 28px;
            }

            .trello-sidebar-btn {
                padding: 6px 10px;
                font-size: 13px;
            }
        }

        /* Advanced Responsive Design */
        @media (max-width: 1400px) {
            .dashboard {
                gap: 20px;
                padding: 20px;
            }
            
            .board {
                width: 300px;
                min-width: 300px;
                max-width: 320px;
            }
        }

        @media (max-width: 1200px) {
            .dashboard {
                gap: 18px;
                padding: 18px;
            }
            
            .board {
                width: 280px;
                min-width: 280px;
                max-width: 300px;
            }
        }

        @media (max-width: 1024px) {
            .dashboard {
                gap: 16px;
                padding: 16px;
            }
            
            .board {
                width: 260px;
                min-width: 260px;
                max-width: 280px;
            }
        }

        @media (max-width: 900px) {
            .dashboard {
                gap: 14px;
                padding: 14px;
            }
            
            .board {
                width: 240px;
                min-width: 240px;
                max-width: 260px;
            }
        }

        @media (max-width: 768px) {
            .dashboard {
                gap: 12px;
                padding: 12px;
            }
            
            .board {
                width: 220px;
                min-width: 220px;
                max-width: 240px;
            }
        }

        @media (max-width: 640px) {
            .dashboard {
                gap: 10px;
                padding: 10px;
            }
            
            .board {
                width: 200px;
                min-width: 200px;
                max-width: 220px;
            }
        }

        @media (max-width: 480px) {
            .dashboard {
                gap: 8px;
                padding: 8px;
            }
            
            .board {
                width: 180px;
                min-width: 180px;
                max-width: 200px;
            }
        }

        @media (max-width: 360px) {
            .dashboard {
                gap: 6px;
                padding: 6px;
            }
            
            .board {
                width: 160px;
                min-width: 160px;
                max-width: 180px;
            }
        }

        .card:hover {
            transform: translateY(-4px) scale(1.02);
            box-shadow: 0 12px 40px rgba(102, 126, 234, 0.2);
            border-color: #667eea;
        }

        /* Advanced Loading States */
        .loading-overlay {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(255, 255, 255, 0.9);
            backdrop-filter: blur(5px);
            display: flex;
            align-items: center;
            justify-content: center;
            z-index: 1000;
            border-radius: 8px;
        }

        .loading-spinner {
            width: 40px;
            height: 40px;
            border: 4px solid rgba(102, 126, 234, 0.2);
            border-top: 4px solid #667eea;
            border-radius: 50%;
            animation: spin 1s linear infinite;
        }

        .loading-shimmer {
            position: relative;
            overflow: hidden;
        }

        .loading-shimmer::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.4), transparent);
            animation: shimmer 1.5s infinite;
        }

        /* Micro-interactions */
        .interactive-element {
            transition: all 0.2s cubic-bezier(0.4, 0, 0.2, 1);
            cursor: pointer;
        }

        .interactive-element:hover {
            transform: translateY(-2px);
        }

        .interactive-element:active {
            transform: translateY(0) scale(0.98);
        }

        .ripple-effect {
            position: relative;
            overflow: hidden;
        }

        .ripple-effect::after {
            content: '';
            position: absolute;
            top: 50%;
            left: 50%;
            width: 0;
            height: 0;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.3);
            transform: translate(-50%, -50%);
            transition: width 0.6s, height 0.6s;
        }

        .ripple-effect:active::after {
            width: 300px;
            height: 300px;
        }

        /* Success/Error States */
        .success-state {
            background: linear-gradient(135deg, #61bd4f, #5aac44);
            color: white;
            animation: bounce 0.6s ease;
        }

        .error-state {
            background: linear-gradient(135deg, #eb5a46, #d63031);
            color: white;
            animation: pulse 0.5s ease;
        }

        .warning-state {
            background: linear-gradient(135deg, #f2d600, #e6c200);
            color: #172b4d;
            animation: pulse 0.5s ease;
        }

        /* Advanced Hover Effects */
        .card-enter {
            animation: cardSlideIn 0.3s ease-out;
        }

        .board-enter {
            animation: boardSlideIn 0.4s ease-out;
        }

        .drop-zone-active {
            animation: dropZonePulse 1s ease-in-out infinite;
        }

        /* Focus States */
        .focus-visible {
            outline: 2px solid #667eea;
            outline-offset: 2px;
        }

        /* Touch Optimizations */
        @media (hover: none) and (pointer: coarse) {
            .card:hover {
                transform: none;
            }
            
            .card:active {
                transform: scale(0.98);
            }
            
            .board:hover {
                transform: none;
            }
            
            .board:active {
                transform: scale(0.98);
            }
        }

        .card.dragging {
            opacity: 0.8;
            transform: rotate(3deg) scale(1.05);
            box-shadow: 0 20px 60px rgba(102, 126, 234, 0.3);
            z-index: 1000;
            border-color: #667eea;
            cursor: grabbing;
        }

        .card.dragging * {
            pointer-events: none;
        }

        /* Card Quick Actions */
        .card-actions {
            position: absolute;
            top: 8px;
            right: 8px;
            opacity: 0;
            transition: all 0.3s ease;
            display: flex;
            gap: 4px;
        }

        .card:hover .card-actions {
            opacity: 1;
        }

        .card-action-btn {
            width: 24px;
            height: 24px;
            border-radius: 4px;
            background: rgba(0, 0, 0, 0.1);
            border: none;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 12px;
            color: #666;
            transition: all 0.2s ease;
        }

        .card-action-btn:hover {
            background: rgba(0, 0, 0, 0.2);
            color: #333;
            transform: scale(1.1);
        }

        /* Card Labels */
        .card-labels {
            display: flex;
            gap: 4px;
            margin-bottom: 8px;
            flex-wrap: wrap;
        }

        .card-label {
            height: 8px;
            border-radius: 4px;
            min-width: 40px;
            cursor: pointer;
            transition: all 0.2s ease;
        }

        .card-label:hover {
            transform: scale(1.1);
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.2);
        }

        .card-label.red { background: #eb5a46; }
        .card-label.yellow { background: #f2d600; }
        .card-label.green { background: #61bd4f; }
        .card-label.blue { background: #0079bf; }
        .card-label.purple { background: #c377e0; }
        .card-label.orange { background: #ff9f1a; }
        .card-label.pink { background: #ff78cb; }
        .card-label.sky { background: #00c2e0; }

        /* Card Members */
        .card-members {
            display: flex;
            gap: 2px;
            margin-left: auto;
            flex-wrap: wrap;
        }

        .card-member {
            width: 28px;
            height: 28px;
            border-radius: 50%;
            background: linear-gradient(135deg, #667eea, #764ba2);
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 11px;
            font-weight: 600;
            border: 2px solid white;
            cursor: pointer;
            transition: all 0.2s ease;
            position: relative;
        }

        .card-member:hover {
            transform: scale(1.1);
            z-index: 10;
        }

        .card-member::after {
            content: attr(data-tooltip);
            position: absolute;
            bottom: -30px;
            left: 50%;
            transform: translateX(-50%);
            background: rgba(0, 0, 0, 0.8);
            color: white;
            padding: 4px 8px;
            border-radius: 4px;
            font-size: 11px;
            white-space: nowrap;
            opacity: 0;
            pointer-events: none;
            transition: opacity 0.2s ease;
        }

        .card-member:hover::after {
            opacity: 1;
        }

        /* Card Due Date */
        .card-due-date {
            display: flex;
            align-items: center;
            gap: 4px;
            font-size: 12px;
            color: #666;
            padding: 4px 8px;
            border-radius: 4px;
            background: rgba(0, 0, 0, 0.05);
            transition: all 0.2s ease;
        }

        .card-due-date.overdue {
            color: #eb5a46;
            background: rgba(235, 90, 70, 0.1);
            font-weight: 600;
        }

        .card-due-date.due-soon {
            color: #f2d600;
            background: rgba(242, 214, 0, 0.1);
            font-weight: 600;
        }

        .card-due-date:hover {
            transform: scale(1.05);
        }

        /* Card Attachments */
        .card-attachments {
            display: flex;
            align-items: center;
            gap: 4px;
            font-size: 12px;
            color: #666;
            margin-top: 8px;
        }

        .card-attachment {
            display: flex;
            align-items: center;
            gap: 4px;
            padding: 2px 6px;
            background: rgba(0, 0, 0, 0.05);
            border-radius: 4px;
            cursor: pointer;
            transition: all 0.2s ease;
        }

        .card-attachment:hover {
            background: rgba(0, 0, 0, 0.1);
            transform: scale(1.05);
        }

        /* Card Comments */
        .card-comments {
            display: flex;
            align-items: center;
            gap: 4px;
            font-size: 12px;
            color: #666;
            margin-top: 8px;
        }

        .card-comment-count {
            display: flex;
            align-items: center;
            gap: 4px;
            padding: 2px 6px;
            background: rgba(0, 0, 0, 0.05);
            border-radius: 4px;
            cursor: pointer;
            transition: all 0.2s ease;
        }

        .card-comment-count:hover {
            background: rgba(0, 0, 0, 0.1);
            transform: scale(1.05);
        }

        .card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 3px;
            background: linear-gradient(90deg, #667eea, #764ba2);
            transform: scaleX(0);
            transition: transform 0.3s ease;
        }

        .card:hover {
            transform: translateY(-4px);
            box-shadow: 0 12px 40px rgba(102, 126, 234, 0.2);
            border-color: #667eea;
            background: rgba(255, 255, 255, 1);
        }

        .card:hover::before {
            transform: scaleX(1);
        }

        .card.dragging {
            opacity: 0.8;
            transform: rotate(3deg) scale(1.05);
            box-shadow: 0 20px 60px rgba(102, 126, 234, 0.3);
            z-index: 1000;
            border-color: #667eea;
        }
        
        /* Card Features */
        .card-header {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            margin-bottom: 8px;
        }
        
        .card-title {
            font-weight: 600;
            color: #333;
            margin: 0;
            flex: 1;
            word-wrap: break-word;
        }
        
        .card-menu {
            opacity: 0;
            transition: opacity 0.2s ease;
            cursor: pointer;
            padding: 4px;
            border-radius: 4px;
        }
        
        .card:hover .card-menu {
            opacity: 1;
        }
        
        .card-menu:hover {
            background: #f5f5f5;
        }
        
        .card-meta {
            display: flex;
            align-items: center;
            gap: 8px;
            margin-top: 8px;
            flex-wrap: wrap;
        }
        
        .card-labels {
            display: flex;
            gap: 4px;
            flex-wrap: wrap;
        }
        
        .card-label {
            padding: 2px 6px;
            border-radius: 3px;
            font-size: 11px;
            font-weight: 500;
            color: white;
        }
        
        .card-label.red { background: #eb5a46; }
        .card-label.yellow { background: #f2d600; color: #333; }
        .card-label.green { background: #61bd4f; }
        .card-label.blue { background: #0079bf; }
        .card-label.purple { background: #c377e0; }
        
        .card-due-date {
            display: flex;
            align-items: center;
            gap: 4px;
            font-size: 12px;
            color: #666;
        }
        
        .card-due-date.overdue {
            color: #eb5a46;
            font-weight: 600;
        }
        
        .card-due-date.due-soon {
            color: #f2d600;
            font-weight: 600;
        }
        
        .card-members {
            display: flex;
            gap: 2px;
            margin-left: auto;
        }
        
        .card-member {
            width: 24px;
            height: 24px;
            border-radius: 50%;
            background: #6a11cb;
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 10px;
            font-weight: 600;
            border: 2px solid white;
        }
        
        .card-attachments {
            display: flex;
            align-items: center;
            gap: 4px;
            font-size: 12px;
            color: #666;
        }
        
        .card-comments {
            display: flex;
            align-items: center;
            gap: 4px;
            font-size: 12px;
            color: #666;
        }
        
        /* Card Loading States */
        .card.loading {
            opacity: 0.7;
            pointer-events: none;
        }
        
        .card.loading::after {
            content: '';
            position: absolute;
            top: 50%;
            left: 50%;
            width: 16px;
            height: 16px;
            margin: -8px 0 0 -8px;
            border: 2px solid #f3f3f3;
            border-top: 2px solid #6a11cb;
            border-radius: 50%;
            animation: spin 1s linear infinite;
        }
        
        /* Card Priority Indicators */
        .card.priority-high {
            border-left: 4px solid #eb5a46;
        }
        
        .card.priority-medium {
            border-left: 4px solid #f2d600;
        }
        
        .card.priority-low {
            border-left: 4px solid #61bd4f;
        }
        
        /* Card Status Indicators */
        .card.status-completed {
            opacity: 0.7;
            background: #f8f9fa;
        }
        
        .card.status-completed .card-title {
            text-decoration: line-through;
            color: #666;
        }

        .board.dragover {
            background: #f0f8ff;
            border: 2px dashed #4caf50;
            transform: scale(1.02);
        }

        /* Enhanced Add Card Button */
        .add-card {
            padding: 16px 20px;
            background: linear-gradient(135deg, #667eea, #764ba2);
            color: white;
            border: none;
            border-radius: 12px;
            text-align: center;
            cursor: pointer;
            font-size: 15px;
            font-weight: 600;
            margin-top: auto;
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
            box-shadow: 0 4px 15px rgba(102, 126, 234, 0.3);
        }

        .add-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
            transition: left 0.5s ease;
        }

        .add-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(102, 126, 234, 0.4);
        }

        .add-card:hover::before {
            left: 100%;
        }

        .add-card:active {
            transform: translateY(0);
        }

        /* Enhanced Responsive Design */
        @media (max-width: 1400px) {
            .dashboard {
                padding: 25px;
                gap: 20px;
            }
            
            .board {
                width: 300px;
                min-width: 300px;
            }
        }

        @media (max-width: 1200px) {
            .dashboard {
                padding: 20px;
                gap: 18px;
            }
            
            .board {
                width: 280px;
                min-width: 280px;
            }
            
            .board h2 {
                font-size: 18px;
            }
        }

        @media (max-width: 1024px) {
            .dashboard {
                padding: 15px;
                gap: 15px;
            }
            
            .board {
                width: 260px;
                min-width: 260px;
            }
            
            header {
                padding: 15px 20px;
            }
            
            .board-title {
                font-size: 20px;
            }
            
            .logo {
                width: 160px;
                height: 60px;
            }
        }

        @media (max-width: 768px) {
            .dashboard {
                flex-direction: column;
                gap: 20px;
                padding: 15px;
                overflow-x: visible;
            }

            .board {
                width: 100%;
                max-width: none;
                min-width: auto;
            }
            
            header {
                padding: 15px 20px;
                flex-wrap: wrap;
            }
            
            .header-left {
                gap: 15px;
            }
            
            .board-title {
                font-size: 18px;
            }
            
            .header-right {
                gap: 12px;
                flex-wrap: wrap;
            }
            
            .share-btn {
                padding: 10px 16px;
                font-size: 14px;
            }
            
            .share-btn svg {
                width: 18px;
                height: 18px;
            }
            
            .logo {
                width: 140px;
                height: 55px;
            }
            
            .header-btn {
                padding: 10px 20px;
                font-size: 13px;
            }
        }

        @media (max-width: 640px) {
            .dashboard {
                padding: 12px;
                gap: 15px;
            }
            
            .board {
                padding: 16px;
            }
            
            .board h2 {
                font-size: 16px;
                margin-bottom: 15px;
            }
            
            .card {
                padding: 14px;
                margin-bottom: 10px;
            }
            
            header {
                padding: 12px 15px;
            }
            
            .header-left {
                gap: 12px;
            }
            
            .board-title {
                font-size: 16px;
            }
            
            .logo {
                width: 120px;
                height: 50px;
            }
            
            .header-right {
                gap: 10px;
            }
            
            .share-btn {
                padding: 8px 14px;
                font-size: 13px;
            }
            
            .header-btn {
                padding: 8px 16px;
                font-size: 12px;
            }
        }

        @media (max-width: 480px) {
            .dashboard {
                padding: 10px;
                gap: 12px;
            }
            
            .board {
                padding: 14px;
            }
            
            .board h2 {
                font-size: 15px;
                margin-bottom: 12px;
            }
            
            .card {
                padding: 12px;
                margin-bottom: 8px;
                font-size: 13px;
            }
            
            header {
                padding: 10px 12px;
                flex-direction: column;
                gap: 10px;
                align-items: stretch;
            }
            
            .header-left {
                justify-content: center;
                gap: 10px;
            }
            
            .board-title {
                font-size: 14px;
            }
            
            .logo {
                width: 100px;
                height: 40px;
            }
            
            .header-right {
                justify-content: center;
                gap: 8px;
            }
            
            .share-btn {
                padding: 6px 12px;
                font-size: 12px;
            }
            
            .header-btn {
                padding: 6px 12px;
                font-size: 11px;
            }
            
            .add-card {
                padding: 12px 16px;
                font-size: 14px;
            }
        }

        @media (max-width: 360px) {
            .dashboard {
                padding: 8px;
                gap: 10px;
            }
            
            .board {
                padding: 12px;
            }
            
            .board h2 {
                font-size: 14px;
                margin-bottom: 10px;
            }
            
            .card {
                padding: 10px;
                margin-bottom: 6px;
                font-size: 12px;
            }
            
            header {
                padding: 8px 10px;
            }
            
            .board-title {
                font-size: 13px;
            }
            
            .logo {
                width: 80px;
                height: 35px;
            }
            
            .share-btn {
                padding: 5px 10px;
                font-size: 11px;
            }
            
            .header-btn {
                padding: 5px 10px;
                font-size: 10px;
            }
            
            .add-card {
                padding: 10px 14px;
                font-size: 13px;
            }
        }
    </style>
</head>
<body>
    <header>
        <div class="header-left">
            <img src="http://localhost/trello_clone/public/images/KaaryaHub_logo.png" alt="Logo" class="logo" />
            <h1 class="board-title">Project Board</h1>
        </div>
        <div class="header-right">
            <button class="share-btn" id="share-btn-Input">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" viewBox="0 0 24 24">
                    <path d="M15 12c2.7 0 4.99 1.75 5.82 4.15.1.29.18.58.18.85 0 .55-.45 1-1 1h-4v-2h3c-.66-1.26-2.01-2-3.5-2S12.66 14.74 12 16h3v2h-4c-.55 0-1-.45-1-1 0-.27.07-.56.18-.85C10.01 13.75 12.3 12 15 12zm-3-6c0-1.66 1.34-3 3-3s3 1.34 3 3-1.34 3-3 3-3-1.34-3-3zM6 8v2H4v2h2v2h2v-2h2v-2H8V8H6z"/>
                </svg>
                Share
            </button>
            <button class="header-btn" onclick="window.location.href='index.php?action=showDashboard&controller=user'">
                <i class="fas fa-home"></i>
                Dashboard
            </button>
            <button class="header-btn" onclick="window.location.href='index.php?controller=admin&action=showLogin'" style="background: #ff6b6b;">
                <i class="fas fa-shield-alt"></i>
                Admin
            </button>
        </div>
    </header>

    <main class="dashboard" data-board-id="<?php echo $response['boardId']; ?>">

        <?php foreach ($response['listData'] as $list) : ?>
            <div class="board board-enter" data-list-id="<?php echo $list['id']; ?>" data-list-position="<?php echo $list['position']; ?>">
                <div class="board-header">
                    <h2 class="board-title"><?php echo htmlspecialchars($list['title']); ?></h2>
                    <div class="board-menu">
                        <button class="board-menu-btn" onclick="toggleBoardMenu(this)">
                            <i class="fas fa-ellipsis-h"></i>
                        </button>
                    </div>
                </div>
                
                <div class="board-cards">
                    <!-- <?php if ($list['position'] == 1): ?>
                        <button class="create-task-btn" id="toggleTaskInput" onclick="OpenTaskModal()">
                            <i class="fas fa-plus"></i>
                            Create Task
                        </button>
                        <div class="task-input-container" id="taskInputContainer">
                            <input type="text" id="taskTitleInput" placeholder="Enter task title" />
                            <button id="addTask" onclick="CreateTask()">Add</button>
                        </div>
                    <?php endif; ?> -->
                      
                    <?php $i = 1; ?>
                    <?php foreach ($list['cards'] as $task): ?>
                        <div class="card card-enter" draggable="true" data-card-position-no="<?php echo $i; ?>" data-card-id="<?php echo $task['id']; ?>" onclick="openTrelloModal(<?php echo $task['id']; ?>)">
                            <!-- Card Actions (Hidden by default) -->
                            <div class="card-actions">
                                <button class="card-action-btn" onclick="event.stopPropagation(); editCard(<?php echo $task['id']; ?>)" title="Edit">
                                    <i class="fas fa-edit"></i>
                                </button>
                                <button class="card-action-btn" onclick="event.stopPropagation(); archiveCard(<?php echo $task['id']; ?>)" title="Archive">
                                    <i class="fas fa-archive"></i>
                                </button>
                                <button class="card-action-btn" onclick="event.stopPropagation(); deleteCard(<?php echo $task['id']; ?>)" title="Delete">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </div>

                <!-- Card Labels (Top) -->
                <div class="card-labels" id="card-labels-<?php echo $task['id']; ?>">
                    <!-- Labels will be populated dynamically -->
                </div>

                            <!-- Card Title -->
                            <div class="card-title"><?php echo htmlspecialchars($task['title']); ?></div>

                            <!-- Card Badges -->
                            <div class="card-badges">
                                <!-- Due Date Badge -->
                                <?php if (!empty($task['due_date'])): ?>
                                    <div class="card-badge card-due-date <?php echo (strtotime($task['due_date']) < time()) ? 'overdue' : ((strtotime($task['due_date']) < strtotime('+3 days')) ? 'due-soon' : ''); ?>">
                                        <i class="fas fa-clock"></i>
                                        <span><?php echo date('M j', strtotime($task['due_date'])); ?></span>
                                    </div>
                                <?php endif; ?>

                                <!-- Attachments Badge -->
                                <?php if (!empty($task['attachments'])): ?>
                                    <div class="card-badge">
                                        <i class="fas fa-paperclip"></i>
                                        <span><?php echo count(explode(',', $task['attachments'])); ?></span>
                                    </div>
                                <?php endif; ?>

                                <!-- Comments Badge -->
                                <?php if (!empty($task['comments'])): ?>
                                    <div class="card-badge">
                                        <i class="fas fa-comment"></i>
                                        <span><?php echo count(explode(',', $task['comments'])); ?></span>
                                    </div>
                                <?php endif; ?>

                                <!-- Checklist Badge -->
                                <?php if (!empty($task['checklist'])): ?>
                                    <div class="card-badge">
                                        <i class="fas fa-check-square"></i>
                                        <span><?php echo $task['checklist_completed']; ?>/<?php echo $task['checklist_total']; ?></span>
                                    </div>
                                <?php endif; ?>
                            </div>

                            <!-- Card Members (Bottom Right) -->
                            <?php if (!empty($task['members'])): ?>
                                <div class="card-members">
                                    <?php 
                                    $members = explode(',', $task['members']);
                                    $displayMembers = array_slice($members, 0, 3); // Show max 3 members
                                    foreach ($displayMembers as $member): 
                                    ?>
                                        <div class="card-member" data-tooltip="<?php echo htmlspecialchars(trim($member)); ?>">
                                            <?php echo strtoupper(substr(trim($member), 0, 1)); ?>
                                        </div>
                                    <?php endforeach; ?>
                                    <?php if (count($members) > 3): ?>
                                        <div class="card-member" data-tooltip="<?php echo count($members) - 3; ?> more members">
                                            +<?php echo count($members) - 3; ?>
                                        </div>
                                    <?php endif; ?>
                                </div>
                            <?php endif; ?>
                        </div>
                        <?php $i++; ?>
                    <?php endforeach; ?>
                </div>

                <!-- Add Card Button -->
                <button class="add-card-btn" onclick="addCardToList(<?php echo $list['id']; ?>)">
                    <i class="fas fa-plus"></i>
                    Add a card
                </button>
            </div>
        <?php endforeach; ?>
        
        <!-- Add List Button -->
        <div class="add-list-container">
            <button class="add-list-btn" onclick="showCreateListForm()">
                <i class="fas fa-plus"></i>
                Add another list
            </button>
            <div class="create-list-form" id="createListForm" style="display: none;">
                <input type="text" id="newListTitle" placeholder="Enter list title..." maxlength="100">
                <div class="create-list-actions">
                    <button class="create-list-submit" onclick="createNewList()">Add List</button>
                    <button class="create-list-cancel" onclick="hideCreateListForm()">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
            </div>
        </div>
    </main>

    <!-- Trello-like Card Modal -->
    <div id="trello-modal" class="trello-modal">
        <div class="trello-modal-overlay" onclick="closeTrelloModal()"></div>
        <div class="trello-modal-content">
            <!-- Modal Header -->
            <div class="trello-modal-header">
                <div class="trello-modal-header-left">
                    <div class="trello-modal-title">
                        <h2 id="trello-card-title" contenteditable="true">Card Title</h2>
                        <!-- <span class="trello-modal-subtitle">in list <strong id="trello-list-name">List Name</strong></span> -->
                    </div>
                </div>
                <div class="trello-modal-header-right">
                    <button class="trello-close-btn" onclick="closeTrelloModal()">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
            </div>

            <!-- Modal Body -->
            <div class="trello-modal-body">
                <div class="trello-modal-main">
                    <!-- Labels Section -->
                    <div class="trello-section">
                        <div class="trello-section-header">
                            <h3><i class="fas fa-tags"></i> Labels</h3>
                        </div>
                        <div class="trello-labels-container">
                            <div class="trello-labels-list" id="trello-labels-list">
                                <!-- Labels will be populated here -->
                            </div>
                            <button class="trello-add-label-btn" onclick="toggleLabelsPanel()">
                                <i class="fas fa-plus"></i> Add Label
                            </button>
                        </div>
                    </div>

                    <!-- Members Section -->
                    <div class="trello-section">
                        <div class="trello-section-header">
                            <h3><i class="fas fa-users"></i> Members</h3>
                        </div>
                        <div class="trello-members-container">
                            <div class="trello-members-list" id="trello-members-list">
                                <!-- Members will be populated here -->
                            </div>
                            <button class="trello-add-member-btn" onclick="toggleMembersPanel()">
                                <i class="fas fa-plus"></i> Add Member
                            </button>
                        </div>
                    </div>

                    <!-- Checklist Section -->
                    <div class="trello-section">
                        <div class="trello-section-header">
                            <h3><i class="fas fa-check-square"></i> Checklist</h3>
                        </div>
                        <div class="trello-checklist-container">
                            <div class="trello-checklist-progress">
                                <div class="trello-progress-bar">
                                    <div class="trello-progress-fill" id="trello-progress-fill"></div>
                                </div>
                                <span class="trello-progress-text" id="trello-progress-text">0%</span>
                            </div>
                            <div class="trello-checklist-items" id="trello-checklist-items">
                                <!-- Checklist items will be populated here -->
                            </div>
                            <div class="trello-add-checklist-item">
                                <input type="text" id="trello-new-checklist-item" placeholder="Add an item">
                                <button onclick="addTrelloChecklistItem()">Add</button>
                            </div>
                        </div>
                    </div>

                    <!-- Due Date Section -->
                    <div class="trello-section">
                        <div class="trello-section-header">
                            <h3><i class="fas fa-clock"></i> Due Date</h3>
                        </div>
                        <div class="trello-due-date-container">
                            <div class="trello-due-date-display" id="trello-due-date-display">
                                <!-- Due date will be displayed here -->
                            </div>
                            <button class="trello-set-due-date-btn" onclick="toggleDueDatePanel()">
                                <i class="fas fa-calendar"></i> Set Due Date
                            </button>
                        </div>
                    </div>

                    <!-- Attachments Section -->
                    <div class="trello-section">
                        <div class="trello-section-header">
                            <h3><i class="fas fa-paperclip"></i> Attachments</h3>
                        </div>
                        <div class="trello-attachments-container">
                            <div class="trello-attachments-list" id="trello-attachments-list">
                                <!-- Attachments will be populated here -->
                            </div>
                            <button class="trello-add-attachment-btn" onclick="document.getElementById('trello-file-input').click()">
                                <i class="fas fa-plus"></i> Add Attachment
                            </button>
                            <input type="file" id="trello-file-input" multiple style="display: none;" onchange="handleTrelloFileUpload(this)">
                        </div>
                    </div>

                    <!-- Description Section -->
                    <div class="trello-section">
                        <div class="trello-section-header">
                            <h3><i class="fas fa-align-left"></i> Description</h3>
                        </div>
                        <div class="trello-description-container">
                            <div class="trello-description-display" id="trello-description-display">
                                <!-- Description will be displayed here -->
                            </div>
                            <button class="trello-edit-description-btn" onclick="toggleDescriptionEdit()">
                                <i class="fas fa-edit"></i> Edit Description
                            </button>
                        </div>
                    </div>

                    <!-- Comments Section -->
                    <div class="trello-section">
                        <div class="trello-section-header">
                            <h3><i class="fas fa-comments"></i> Comments</h3>
                        </div>
                        <div class="trello-comments-container">
                            <div class="trello-comments-list" id="trello-comments-list">
                                <!-- Comments will be populated here -->
                            </div>
                            <div class="trello-add-comment">
                                <div class="trello-comment-avatar">
                                    <img src="https://via.placeholder.com/32x32/667eea/ffffff?text=U" alt="User">
                                </div>
                                <div class="trello-comment-input-container">
                                    <textarea id="trello-comment-input" placeholder="Write a comment..."></textarea>
                                    <div class="trello-comment-actions">
                                        <button class="trello-comment-save-btn" onclick="addTrelloComment()">Save</button>
                                        <button class="trello-comment-cancel-btn" onclick="cancelTrelloComment()">Cancel</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Modal Sidebar -->
                <div class="trello-modal-sidebar">
                    <div class="trello-sidebar-section">
                        <h4>Add to card</h4>
                        <button class="trello-sidebar-btn" onclick="toggleLabelsPanel()">
                            <i class="fas fa-tags"></i> Labels
                        </button>
                        <button class="trello-sidebar-btn" onclick="toggleMembersPanel()">
                            <i class="fas fa-users"></i> Members
                        </button>
                        <button class="trello-sidebar-btn" onclick="toggleChecklistPanel()">
                            <i class="fas fa-check-square"></i> Checklist
                        </button>
                        <button class="trello-sidebar-btn" onclick="toggleDueDatePanel()">
                            <i class="fas fa-clock"></i> Due Date
                        </button>
                        <button class="trello-sidebar-btn" onclick="document.getElementById('trello-file-input').click()">
                            <i class="fas fa-paperclip"></i> Attachment
                        </button>
                    </div>

                    <div class="trello-sidebar-section">
                        <h4>Actions</h4>
                        <button class="trello-sidebar-btn" onclick="moveTrelloCard()">
                            <i class="fas fa-arrows-alt"></i> Move
                        </button>
                        <button class="trello-sidebar-btn" onclick="copyTrelloCard()">
                            <i class="fas fa-copy"></i> Copy
                        </button>
                        <button class="trello-sidebar-btn" onclick="watchTrelloCard()">
                            <i class="fas fa-eye"></i> Watch
                        </button>
                        <button class="trello-sidebar-btn trello-archive-btn" onclick="archiveTrelloCard()">
                            <i class="fas fa-archive"></i> Archive
                        </button>
                        <button class="trello-sidebar-btn trello-delete-btn" onclick="deleteTrelloCard()">
                            <i class="fas fa-trash"></i> Delete
                        </button>
                    </div>
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

            // Initialize all enhanced features
            initializeAdvancedInteractions();
            initializeResponsiveEnhancements();
            initializePerformanceOptimizations();
            initializeCommentInteractions();
        });

        const textActivity = document.getElementById('text-activity');
        if (textActivity) {
            textActivity.addEventListener('click', function () {
                const activityButton = document.getElementById('toggleActivityInput');
                if (activityButton) {
                    activityButton.style.display = 'block';
                }
            });
        }

        function OpenTaskModal() {
            const container = document.getElementById("taskInputContainer");
            container.classList.toggle("show");
            if (container.classList.contains("show")) {
                document.getElementById("taskTitleInput").focus();
            }
        }

        // Trello-like Interactive Functions
        function toggleBoardMenu(button) {
            // Toggle board menu functionality
            console.log('Board menu toggled');
        }

        function editCard(cardId) {
            // Edit card functionality
            console.log('Edit card:', cardId);
            showMessage('Edit card functionality coming soon!', 'info');
        }

        function archiveCard(cardId) {
            // Archive card functionality
            console.log('Archive card:', cardId);
            showMessage('Archive card functionality coming soon!', 'info');
        }

        function deleteCard(cardId) {
            // Delete card functionality
            if (confirm('Are you sure you want to delete this card?')) {
                console.log('Delete card:', cardId);
                showMessage('Delete card functionality coming soon!', 'info');
            }
        }

        function addCardToList(listId) {
            // Create a dynamic card input form
            const listContainer = document.querySelector(`[data-list-id="${listId}"] .board-cards`);
            if (!listContainer) {
                showMessage('List not found!', 'error');
                return;
            }

            // Remove any existing card input
            const existingInput = listContainer.querySelector('.card-input-form');
            if (existingInput) {
                existingInput.remove();
            }

            // Create card input form
            const cardInputForm = document.createElement('div');
            cardInputForm.className = 'card-input-form';
            cardInputForm.innerHTML = `
                <div class="card-input-container">
                    <div class="card-input-header">
                        <h4>Add New Card</h4>
                        <button class="close-card-input" onclick="closeCardInput()">
                            <i class="fas fa-times"></i>
                        </button>
                    </div>
                    <form class="card-form" onsubmit="submitNewCard(event, ${listId})">
                        <div class="form-group">
                            <label for="card-title-${listId}">Card Title *</label>
                            <input type="text" id="card-title-${listId}" name="title" required 
                                   placeholder="Enter card title..." maxlength="100">
                        </div>
                        <div class="form-group">
                            <label for="card-description-${listId}">Description</label>
                            <textarea id="card-description-${listId}" name="description" 
                                      placeholder="Enter card description..." rows="3" maxlength="500"></textarea>
                        </div>
                        <div class="form-actions">
                            <button type="button" class="btn-cancel" onclick="closeCardInput()">
                                <i class="fas fa-times"></i> Cancel
                            </button>
                            <button type="submit" class="btn-submit">
                                <i class="fas fa-plus"></i> Add Card
                            </button>
                        </div>
                    </form>
                </div>
            `;

            // Add to list container
            listContainer.appendChild(cardInputForm);

            // Focus on title input
            setTimeout(() => {
                const titleInput = document.getElementById(`card-title-${listId}`);
                if (titleInput) {
                    titleInput.focus();
                }
            }, 100);

            // Add animation
            cardInputForm.style.opacity = '0';
            cardInputForm.style.transform = 'translateY(20px)';
            cardInputForm.style.transition = 'all 0.3s ease';
            
            setTimeout(() => {
                cardInputForm.style.opacity = '1';
                cardInputForm.style.transform = 'translateY(0)';
            }, 50);
        }

        function closeCardInput() {
            const cardInputForm = document.querySelector('.card-input-form');
            if (cardInputForm) {
                cardInputForm.style.opacity = '0';
                cardInputForm.style.transform = 'translateY(20px)';
                setTimeout(() => {
                    cardInputForm.remove();
                }, 300);
            }
        }

        function submitNewCard(event, listId) {
            event.preventDefault();
            
            const form = event.target;
            const formData = new FormData(form);
            
            // Get form values
            const cardData = {
                title: formData.get('title').trim(),
                description: formData.get('description').trim(),
                listId: listId,
                boardId: $('.dashboard').attr('data-board-id'),
                listPosition:$('.board').attr('data-list-position'),

            };

            // Validate required fields
            if (!cardData.title) {
                showMessage('Card title is required!', 'error');
                return;
            }

            // Show loading state
            const submitBtn = form.querySelector('.btn-submit');
            const originalText = submitBtn.innerHTML;
            submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Adding...';
            submitBtn.disabled = true;

            // Submit via AJAX
            $.ajax({
                type: 'POST',
                url: 'index.php?action=createCard&controller=card',
                data: cardData,
                success: function(response) {
                    const data = JSON.parse(response);
                    if (data.success == true) {
                        createNewCardElement(data.card, listId);
                        showMessage('Card created successfully!', 'success');
                        closeCardInput();
                    } else {
                        showMessage(data.message || 'Failed to create card', 'error');
                    }
                },
                error: function(xhr, status, error) {
                    console.error('Error creating card:', error);
                    showMessage('Error creating card. Please try again.', 'error');
                },
                complete: function() {
                    submitBtn.innerHTML = originalText;
                    submitBtn.disabled = false;
                }
            });
        }

        function createNewCardElement(cardData, listId) {
            const listContainer = document.querySelector(`[data-list-id="${listId}"] .board-cards`);
            if (!listContainer) return;

            const cardElement = document.createElement('div');
            cardElement.className = 'card card-enter';
            cardElement.draggable = true;
            cardElement.setAttribute('data-card-id', cardData.id);

            let cardHTML = `
                <div class="card-header">
                    <div class="card-title">${escapeHtml(cardData.title)}</div>
                    <div class="card-actions">
                        <button class="card-action-btn" onclick="editCard(${cardData.id})" title="Edit">
                            <i class="fas fa-edit"></i>
                        </button>
                        <button class="card-action-btn" onclick="archiveCard(${cardData.id})" title="Archive">
                            <i class="fas fa-archive"></i>
                        </button>
                        <button class="card-action-btn" onclick="deleteCard(${cardData.id})" title="Delete">
                            <i class="fas fa-trash"></i>
                        </button>
                    </div>
                </div>
                <div class="card-content">
            `;

            if (cardData.description) {
                cardHTML += `<div class="card-description">${escapeHtml(cardData.description)}</div>`;
            }

            if (cardData.labels) {
                cardHTML += `<div class="card-labels">`;
                cardData.labels.split(',').forEach(label => {
                    const trimmedLabel = label.trim();
                    if (trimmedLabel) {
                        cardHTML += `<span class="card-label ${trimmedLabel.toLowerCase().replace(/\s+/g, '-')}">${trimmedLabel}</span>`;
                    }
                });
                cardHTML += `</div>`;
            }

            cardHTML += `</div><div class="card-meta">`;

            if (cardData.priority) {
                cardHTML += `<div class="card-stats">
                    <div class="card-priority ${cardData.priority.toLowerCase()}">${cardData.priority.charAt(0).toUpperCase() + cardData.priority.slice(1)}</div>
                `;
            }

            if (cardData.due_date) {
                const dueDate = new Date(cardData.due_date);
                const now = new Date();
                const isOverdue = dueDate < now;
                const isDueSoon = dueDate < new Date(now.getTime() + 3 * 24 * 60 * 60 * 1000);
                const dateClass = isOverdue ? 'overdue' : (isDueSoon ? 'due-soon' : '');
                
                cardHTML += `<div class="card-due-date ${dateClass}">
                    <i class="fas fa-clock"></i>
                    ${dueDate.toLocaleDateString('en-US', { month: 'short', day: 'numeric' })}
                </div>`;
            }

            cardHTML += `</div>`;

            if (cardData.members) {
                cardHTML += `<div class="card-members">`;
                cardData.members.split(',').forEach(member => {
                    const trimmedMember = member.trim();
                    if (trimmedMember) {
                        const initials = trimmedMember.split('@')[0].charAt(0).toUpperCase();
                        cardHTML += `<div class="card-member" data-tooltip="${trimmedMember}">${initials}</div>`;
                    }
                });
                cardHTML += `</div>`;
            }

            cardHTML += `</div>`;

            cardElement.innerHTML = cardHTML;
            listContainer.appendChild(cardElement);

            // Animation
            setTimeout(() => {
                cardElement.style.opacity = '0';
                cardElement.style.transform = 'translateY(20px)';
                cardElement.style.transition = 'all 0.3s ease';
                
                setTimeout(() => {
                    cardElement.style.opacity = '1';
                    cardElement.style.transform = 'translateY(0)';
                }, 50);
            }, 100);

            initializeCardDragAndDrop(cardElement);
        }

        function escapeHtml(text) {
            const div = document.createElement('div');
            div.textContent = text;
            return div.innerHTML;
        }

        // Create List Functions
        function showCreateListForm() {
            const form = document.getElementById('createListForm');
            const input = document.getElementById('newListTitle');
            
            if (form && input) {
                form.style.display = 'block';
                input.focus();
                input.value = '';
            }
        }

        function hideCreateListForm() {
            const form = document.getElementById('createListForm');
            if (form) {
                form.style.display = 'none';
            }
        }

        function createNewList() {
            const input = document.getElementById('newListTitle');
            const listTitle = input.value.trim();
            
            if (!listTitle) {
                showMessage('Please enter a list title', 'error');
                return;
            }
            
            const boardId = document.querySelector('.dashboard').getAttribute('data-board-id');
            
            // Show loading state
            const submitBtn = document.querySelector('.create-list-submit');
            const originalText = submitBtn.textContent;
            submitBtn.textContent = 'Creating...';
            submitBtn.disabled = true;
            
            // Make AJAX request to create list
            $.ajax({
                type: 'POST',
                url: 'index.php?action=createList&controller=list',
                data: { boardId: boardId, Title: listTitle},
                success: function(response) {
                    const data = JSON.parse(response);
                    if (data.status == true) {
                        hideCreateListForm();
                        showMessage('List created successfully!', 'success');
                        window.location.reload();
                        setTimeout(() => {
                            submitBtn.textContent = originalText;
                            submitBtn.disabled = false;
                        }, 1500);
                            // closeCardInput();
                    } else {
                            showMessage(response.message || 'Failed to create card', 'error');
                            submitBtn.textContent = originalText;
                            submitBtn.disabled = false;
                    }
                },
                error: function(xhr, status, error) {
                    console.error('Error creating card:', error);
                    showMessage('Error creating card. Please try again.', 'error');
                }
                        

            });
            // fetch('index.php', {
            //     method: 'POST',
            //     headers: {
            //         'Content-Type': 'application/x-www-form-urlencoded',
            //     },
            //     body: `action=createList&controller=list&listName=${encodeURIComponent(listTitle)}&boardId=${boardId}`
            // })
            // .then(response => response.json())
            // .then(data => {
            //     if (data.success) {
            //         // Hide the form
            //         hideCreateListForm();
                    
            //         // Reload the page to show the new list
            //         window.location.reload();
            //     } else {
            //         showMessage(data.message || 'Failed to create list', 'error');
            //     }
            // })
            // .catch(error => {
            //     console.error('Error creating list:', error);
            //     showMessage('Error creating list. Please try again.', 'error');
            // })
            // .finally(() => {
            //     // Reset button state
            //     submitBtn.textContent = originalText;
            //     submitBtn.disabled = false;
            // });
        }

        // Handle Enter key in list title input
        document.addEventListener('DOMContentLoaded', function() {
            const listTitleInput = document.getElementById('newListTitle');
            if (listTitleInput) {
                listTitleInput.addEventListener('keypress', function(e) {
                    if (e.key === 'Enter') {
                        createNewList();
                    } else if (e.key === 'Escape') {
                        hideCreateListForm();
                    }
                });
            }
        });

        function initializeCardDragAndDrop(cardElement) {
            if (typeof $.fn.draggable !== 'undefined') {
                $(cardElement).draggable({
                    helper: 'clone',
                    opacity: 0.8,
                    revert: 'invalid',
                    start: function(event, ui) {
                        $(this).addClass('dragging');
                        $('.board, .board-cards').addClass('drop-zone-active');
                    },
                    stop: function(event, ui) {
                        $(this).removeClass('dragging');
                        $('.board, .board-cards').removeClass('drop-zone-active');
                    }
                });
            } else {
                cardElement.addEventListener('dragstart', function(e) {
                    this.classList.add('dragging');
                    document.querySelectorAll('.board, .board-cards').forEach(el => {
                        el.classList.add('drop-zone-active');
                    });
                });

                cardElement.addEventListener('dragend', function(e) {
                    this.classList.remove('dragging');
                    document.querySelectorAll('.board, .board-cards').forEach(el => {
                        el.classList.remove('drop-zone-active');
                    });
                });
            }
        }

        // Trello Modal Functions
        function openTrelloModal(cardId) {
            const modal = document.getElementById('trello-modal');
            modal.style.display = 'block';
            modal.setAttribute('data-card-id', cardId);
            document.body.style.overflow = 'hidden';
            $.ajax({
                        type: 'GET',
                        url: 'index.php?action=getCardById&controller=card',
                        data: { cardid: cardId, boardId: $('.dashboard').attr('data-board-id') },
                        success: function(response) {
                            const data = JSON.parse(response);
                            if (data.status == true) {
                                // console.log(data.card);
                                loadTrelloCardData(data.card);
                                    // createNewCardElement(response.card, listId);
                                    // showMessage('Card created successfully!', 'success');
                                    // closeCardInput();
                            } else {
                                    showMessage(response.message || 'Failed to create card', 'error');
                            }
                        },
                        error: function(xhr, status, error) {
                            console.error('Error creating card:', error);
                            showMessage('Error creating card. Please try again.', 'error');
                        }
                        // complete: function() {
                        //     submitBtn.innerHTML = originalText;
                        //     submitBtn.disabled = false;
                        // }

            });



            // Load card data
            //loadTrelloCardData(cardId);
            
            // Load card labels
            //loadCardLabels(cardId);
            
            // Animate modal
            setTimeout(() => {
                modal.querySelector('.trello-modal-content').style.transform = 'scale(1)';
                modal.querySelector('.trello-modal-content').style.opacity = '1';
            }, 10);
        }

        function closeTrelloModal() {
            const modal = document.getElementById('trello-modal');
            modal.querySelector('.trello-modal-content').style.transform = 'scale(0.9)';
            modal.querySelector('.trello-modal-content').style.opacity = '0';
            
            setTimeout(() => {
                modal.style.display = 'none';
                document.body.style.overflow = 'auto';
            }, 300);
        }

        function loadTrelloCardData(cardData) {
            // This would typically load data from the server
            // For now, we'll use sample data
            // console.log(cardData.card.id);
            const cards = {
                id: cardData.id,
                title: cardData.title,
                listName: 'To Do',
                description: cardData.description,
                //labels: ['red', 'blue', 'green'],
                members: cardData.boardMembers,
                dueDate: '2024-01-15',
                // attachments: [
                //     { name: 'document.pdf', size: '2.4 MB', type: 'pdf' },
                //     { name: 'image.jpg', size: '1.2 MB', type: 'image' }
                // ],
                // checklist: [
                //     { id: 1, text: 'Task 1', completed: true },
                //     { id: 2, text: 'Task 2', completed: false },
                //     { id: 3, text: 'Task 3', completed: false }
                // ],
                comments: cardData.comments
            };
                // console.log(cards);
            // Populate modal with data
            document.getElementById('trello-card-title').textContent = cards.title;
            //document.getElementById('trello-list-name').textContent = card.listDetails.title;
            
            // Populate labels
            // populateTrelloLabels(card.labels);
            
            // Populate members
            if(cards.members) {
                populateTrelloMembers(cards.members);
            }
            
            // Populate checklist
            //populateTrelloChecklist(card.checklist);
            
            // Populate due date
            //populateTrelloDueDate(card.dueDate);
            
            // Populate attachments
           // populateTrelloAttachments(card.attachments);
            
            // Populate description
            if(cards.description && typeof cards.description === 'object') {
                populateTrelloDescription(cards.description);
            }

            populateActionButtons(cards.id);
            // Populate comments
            populateTrelloComments(cards.comments);
        }

        function populateTrelloLabels(labels) {
            const container = document.getElementById('trello-labels-list');
            container.innerHTML = '';
            
            labels.forEach(label => {
                const labelElement = document.createElement('span');
                labelElement.className = `trello-label ${label}`;
                labelElement.textContent = label.charAt(0).toUpperCase() + label.slice(1);
                container.appendChild(labelElement);
            });
        }

        function populateTrelloMembers(members) {
            const container = document.getElementById('trello-members-list');
            container.innerHTML = '';
            
            members.forEach(member => {
                const memberElement = document.createElement('div');
                memberElement.className = 'trello-member';
                memberElement.textContent = member.username.charAt(0).toUpperCase();
                memberElement.title = member.username;
                container.appendChild(memberElement);
            });
        }

        function populateTrelloChecklist(checklist) {
            const container = document.getElementById('trello-checklist-items');
            container.innerHTML = '';
            
            let completedCount = 0;
            
            checklist.forEach(item => {
                const itemElement = document.createElement('div');
                itemElement.className = `trello-checklist-item ${item.completed ? 'completed' : ''}`;
                itemElement.innerHTML = `
                    <input type="checkbox" ${item.completed ? 'checked' : ''} onchange="toggleChecklistItem(${item.id})">
                    <label>${item.text}</label>
                `;
                container.appendChild(itemElement);
                
                if (item.completed) completedCount++;
            });
            
            // Update progress
            const progress = (completedCount / checklist.length) * 100;
            document.getElementById('trello-progress-fill').style.width = `${progress}%`;
            document.getElementById('trello-progress-text').textContent = `${Math.round(progress)}%`;
        }

        function populateTrelloDueDate(dueDate) {
            const container = document.getElementById('trello-due-date-display');
            if (dueDate) {
                const date = new Date(dueDate);
                const now = new Date();
                const isOverdue = date < now;
                const isDueSoon = date < new Date(now.getTime() + 3 * 24 * 60 * 60 * 1000);
                
                let badgeClass = '';
                if (isOverdue) badgeClass = 'overdue';
                else if (isDueSoon) badgeClass = 'due-soon';
                
                container.innerHTML = `
                    <div class="trello-due-date-badge ${badgeClass}">
                        <i class="fas fa-clock"></i>
                        <span>${date.toLocaleDateString('en-US', { month: 'short', day: 'numeric' })}</span>
                    </div>
                `;
            } else {
                container.innerHTML = '';
            }
        }

        function populateTrelloAttachments(attachments) {
            const container = document.getElementById('trello-attachments-list');
            container.innerHTML = '';
            
            attachments.forEach(attachment => {
                const attachmentElement = document.createElement('div');
                attachmentElement.className = 'trello-attachment';
                attachmentElement.innerHTML = `
                    <div class="trello-attachment-icon">
                        <i class="fas fa-file-${attachment.type === 'pdf' ? 'pdf' : 'image'}"></i>
                    </div>
                    <div class="trello-attachment-info">
                        <div class="trello-attachment-name">${attachment.name}</div>
                        <div class="trello-attachment-size">${attachment.size}</div>
                    </div>
                `;
                container.appendChild(attachmentElement);
            });
        }

        function populateTrelloDescription(description) {
            const container = document.getElementById('trello-description-display');
            if (description) {
                container.textContent = description;
                container.classList.remove('empty');
            } else {
                container.textContent = 'No description';
                container.classList.add('empty');
            }
        }

        function populateTrelloComments(comments) {
            const container = document.getElementById('trello-comments-list');
            container.innerHTML = '';
            
            comments.forEach(comment => {
                const commentElement = document.createElement('div');
                commentElement.className = 'trello-comment';
                commentElement.innerHTML = `
                    <div class="trello-comment-avatar">
                        
                    </div>
                    <div class="trello-comment-content">
                        <div class="trello-comment-header">
                            <span class="trello-comment-author">${comment.username}</span>
                            <span class="trello-comment-time">${comment.created_at}</span>
                        </div>
                        <div class="trello-comment-text">${comment.message}</div>
                    </div>
                `;
                container.appendChild(commentElement);
            });
        }

        function populateActionButtons(cardId) {
            alert(cardId);
            const container = document.querySelector('.trello-sidebar-section');
            container.innerHTML = '';
            
            const actionButton1 = `
                <button class="trello-edit-card-btn" onclick="editTrelloCard(${cardId})">
                    <i class="fas fa-edit"></i> Edit Card
                </button>
            `;
            container.appendChild(actionButton1);

            const actionButton2 = `
                <button class="trello-delete-card-btn" onclick="deleteTrelloCard(${cardId})">
                    <i class="fas fa-trash"></i> Delete Card
                </button>
            `;
            container.appendChild(actionButton2);
        }
        // Trello Modal Action Functions
        function toggleLabelsPanel() {
            const container = document.getElementById('trello-labels-list');
            if (!container) return;

            // Remove existing label picker if any
            const existingPicker = document.querySelector('.trello-label-picker');
            if (existingPicker) {
                existingPicker.remove();
                return;
            }

            // Create dynamic label picker
            const labelPicker = document.createElement('div');
            labelPicker.className = 'trello-label-picker';
            labelPicker.innerHTML = `
                <div class="trello-label-picker-content">
                    <div class="trello-label-picker-header">
                        <h4>Add Labels</h4>
                        <button class="trello-close-label-picker" onclick="toggleLabelsPanel()">
                            <i class="fas fa-times"></i>
                        </button>
                    </div>
                    <div class="trello-label-picker-body">
                        <div class="trello-label-search-group">
                            <input type="text" id="trello-label-search" class="trello-label-search-input" 
                                   placeholder="Search labels...">
                            <i class="fas fa-search trello-search-icon"></i>
                        </div>
                        <div class="trello-available-labels" id="trello-available-labels">
                            <!-- Available labels will be populated here -->
                        </div>
                        <div class="trello-label-actions">
                            <button class="trello-create-label-btn" onclick="createNewLabel()">
                                <i class="fas fa-plus"></i> Create New Label
                            </button>
                            <button class="trello-manage-labels-btn" onclick="manageLabels()">
                                <i class="fas fa-cog"></i> Manage Labels
                            </button>
                            <button class="trello-import-labels-btn" onclick="importLabels()">
                                <i class="fas fa-download"></i> Import Labels
                            </button>
                            <button class="trello-export-labels-btn" onclick="exportLabels()">
                                <i class="fas fa-upload"></i> Export Labels
                            </button>
                        </div>
                    </div>
                </div>
            `;

            container.appendChild(labelPicker);

            // Populate available labels
            populateAvailableLabels();

            // Focus on search input
            setTimeout(() => {
                const searchInput = document.getElementById('trello-label-search');
                if (searchInput) searchInput.focus();
            }, 100);

            // Add search functionality
            const searchInput = document.getElementById('trello-label-search');
            if (searchInput) {
                searchInput.addEventListener('input', function() {
                    filterAvailableLabels(this.value);
                });
            }
        }

        function populateAvailableLabels() {
            const container = document.getElementById('trello-available-labels');
            if (!container) return;

            // Get labels from localStorage or use default
            let availableLabels = JSON.parse(localStorage.getItem('trello-labels')) || [
                { id: 1, name: 'Bug', color: 'red', description: 'Something is broken', created: Date.now() },
                { id: 2, name: 'Feature', color: 'blue', description: 'New functionality', created: Date.now() },
                { id: 3, name: 'Urgent', color: 'orange', description: 'High priority', created: Date.now() },
                { id: 4, name: 'Review', color: 'yellow', description: 'Needs review', created: Date.now() },
                { id: 5, name: 'Done', color: 'green', description: 'Completed', created: Date.now() },
                { id: 6, name: 'Research', color: 'purple', description: 'Investigation needed', created: Date.now() },
                { id: 7, name: 'Design', color: 'pink', description: 'UI/UX work', created: Date.now() },
                { id: 8, name: 'Backend', color: 'sky', description: 'Server-side work', created: Date.now() }
            ];

            // Save to localStorage
            localStorage.setItem('trello-labels', JSON.stringify(availableLabels));

            container.innerHTML = '';
            availableLabels.forEach(label => {
                const labelElement = document.createElement('div');
                labelElement.className = 'trello-available-label';
                labelElement.innerHTML = `
                    <div class="trello-label-info">
                        <div class="trello-label-color ${label.color}" onclick="changeLabelColor(${label.id})" title="Change color"></div>
                        <div class="trello-label-details">
                            <div class="trello-label-name" onclick="editLabelName(${label.id})" title="Click to edit">${label.name}</div>
                            <div class="trello-label-description" onclick="editLabelDescription(${label.id})" title="Click to edit">${label.description}</div>
                        </div>
                    </div>
                    <div class="trello-label-actions">
                        <button class="trello-add-label-btn" onclick="addLabelToCard(${label.id}, '${label.name}', '${label.color}')" title="Add to card">
                            <i class="fas fa-plus"></i>
                        </button>
                        <button class="trello-edit-label-btn" onclick="editLabel(${label.id})" title="Edit label">
                            <i class="fas fa-edit"></i>
                        </button>
                        <button class="trello-delete-label-btn" onclick="deleteLabel(${label.id})" title="Delete label">
                            <i class="fas fa-trash"></i>
                        </button>
                    </div>
                `;
                container.appendChild(labelElement);
            });
        }

        function filterAvailableLabels(searchTerm) {
            const labels = document.querySelectorAll('.trello-available-label');
            const term = searchTerm.toLowerCase();

            labels.forEach(label => {
                const name = label.querySelector('.trello-label-name').textContent.toLowerCase();
                const description = label.querySelector('.trello-label-description').textContent.toLowerCase();
                
                if (name.includes(term) || description.includes(term)) {
                    label.style.display = 'flex';
                } else {
                    label.style.display = 'none';
                }
            });
        }

        function addLabelToCard(labelId, name, color) {
            const labelsList = document.getElementById('trello-labels-list');
            if (!labelsList) return;

            // Check if label already exists
            const existingLabel = labelsList.querySelector(`[data-label-id="${labelId}"]`);
            if (existingLabel) {
                showMessage('Label already added!', 'warning');
                return;
            }

            // Create label element
            const labelElement = document.createElement('span');
            labelElement.className = `trello-label ${color}`;
            labelElement.setAttribute('data-label-id', labelId);
            labelElement.setAttribute('data-label-name', name);
            labelElement.setAttribute('data-label-color', color);
            labelElement.innerHTML = `
                <span class="trello-label-text">${name}</span>
                <button class="trello-remove-label-btn" onclick="removeLabelFromCard(${labelId})" title="Remove label">
                    <i class="fas fa-times"></i>
                </button>
            `;

            // Add to labels list (before the picker)
            const picker = labelsList.querySelector('.trello-label-picker');
            if (picker) {
                labelsList.insertBefore(labelElement, picker);
            } else {
                labelsList.appendChild(labelElement);
            }

            // Save to localStorage
            saveCardLabels();

            // Update card display if modal is open
            updateCardLabelsDisplay();

            showMessage(`Label "${name}" added to card!`, 'success');
        }

        function saveCardLabels() {
            const labelsList = document.getElementById('trello-labels-list');
            if (!labelsList) return;

            const labels = [];
            const labelElements = labelsList.querySelectorAll('.trello-label');
            
            labelElements.forEach(label => {
                labels.push({
                    id: label.getAttribute('data-label-id'),
                    name: label.getAttribute('data-label-name'),
                    color: label.getAttribute('data-label-color')
                });
            });

            // Save to localStorage with card ID
            const cardId = getCurrentCardId();
            if (cardId) {
                localStorage.setItem(`card-labels-${cardId}`, JSON.stringify(labels));
            }
        }

        function loadCardLabels(cardId) {
            const labelsList = document.getElementById('trello-labels-list');
            if (!labelsList) return;

            // Clear existing labels
            const existingLabels = labelsList.querySelectorAll('.trello-label');
            existingLabels.forEach(label => label.remove());

            // Load from localStorage
            const savedLabels = localStorage.getItem(`card-labels-${cardId}`);
            if (savedLabels) {
                const labels = JSON.parse(savedLabels);
                labels.forEach(label => {
                    const labelElement = document.createElement('span');
                    labelElement.className = `trello-label ${label.color}`;
                    labelElement.setAttribute('data-label-id', label.id);
                    labelElement.setAttribute('data-label-name', label.name);
                    labelElement.setAttribute('data-label-color', label.color);
                    labelElement.innerHTML = `
                        <span class="trello-label-text">${label.name}</span>
                        <button class="trello-remove-label-btn" onclick="removeLabelFromCard(${label.id})" title="Remove label">
                            <i class="fas fa-times"></i>
                        </button>
                    `;
                    labelsList.appendChild(labelElement);
                });
            }
        }

        function getCurrentCardId() {
            // Get current card ID from modal or context
            const modal = document.getElementById('trello-modal');
            if (modal && modal.style.display !== 'none') {
                return modal.getAttribute('data-card-id') || 'default';
            }
            return 'default';
        }

        function updateCardLabelsDisplay() {
            const labelsList = document.getElementById('trello-labels-list');
            if (!labelsList) return;

            const labels = [];
            const labelElements = labelsList.querySelectorAll('.trello-label');
            
            labelElements.forEach(label => {
                labels.push({
                    id: label.getAttribute('data-label-id'),
                    name: label.getAttribute('data-label-name'),
                    color: label.getAttribute('data-label-color')
                });
            });

            // Update card display in board
            updateCardLabelsInBoard(labels);
        }

        function updateCardLabelsInBoard(labels) {
            // Find the current card in the board and update its labels
            const cardId = getCurrentCardId();
            if (cardId === 'default') return;

            const cardElement = document.querySelector(`[data-card-id="${cardId}"]`);
            if (!cardElement) return;

            // Update card labels display
            const cardLabelsContainer = cardElement.querySelector('.card-labels');
            if (cardLabelsContainer) {
                cardLabelsContainer.innerHTML = '';
                labels.forEach(label => {
                    const labelSpan = document.createElement('span');
                    labelSpan.className = `card-label ${label.color}`;
                    labelSpan.textContent = label.name;
                    cardLabelsContainer.appendChild(labelSpan);
                });
            }
        }

        function removeLabelFromCard(labelId) {
            const labelElement = document.querySelector(`[data-label-id="${labelId}"]`);
            if (labelElement) {
                const labelName = labelElement.getAttribute('data-label-name');
                labelElement.remove();
                
                // Save changes to localStorage
                saveCardLabels();
                
                // Update card display
                updateCardLabelsDisplay();
                
                showMessage(`Label "${labelName}" removed from card!`, 'info');
            }
        }

        function createNewLabel() {
            const name = prompt('Enter label name:');
            if (name && name.trim()) {
                const colors = ['red', 'orange', 'yellow', 'green', 'blue', 'purple', 'pink', 'sky', 'lime', 'grey'];
                const randomColor = colors[Math.floor(Math.random() * colors.length)];
                const labelId = Date.now(); // Generate unique ID
                
                // Add to localStorage
                const labels = JSON.parse(localStorage.getItem('trello-labels')) || [];
                const newLabel = {
                    id: labelId,
                    name: name.trim(),
                    color: randomColor,
                    description: 'Custom label',
                    created: Date.now()
                };
                labels.push(newLabel);
                localStorage.setItem('trello-labels', JSON.stringify(labels));
                
                // Refresh the labels list
                populateAvailableLabels();
                showMessage(`Label "${name.trim()}" created!`, 'success');
            }
        }

        function editLabel(labelId) {
            const labels = JSON.parse(localStorage.getItem('trello-labels')) || [];
            const label = labels.find(l => l.id === labelId);
            if (!label) return;

            const newName = prompt('Enter new label name:', label.name);
            if (newName && newName.trim() && newName.trim() !== label.name) {
                label.name = newName.trim();
                localStorage.setItem('trello-labels', JSON.stringify(labels));
                populateAvailableLabels();
                showMessage(`Label renamed to "${newName.trim()}"!`, 'success');
            }
        }

        function editLabelName(labelId) {
            const labels = JSON.parse(localStorage.getItem('trello-labels')) || [];
            const label = labels.find(l => l.id === labelId);
            if (!label) return;

            const newName = prompt('Enter new label name:', label.name);
            if (newName && newName.trim() && newName.trim() !== label.name) {
                label.name = newName.trim();
                localStorage.setItem('trello-labels', JSON.stringify(labels));
                populateAvailableLabels();
                showMessage(`Label renamed to "${newName.trim()}"!`, 'success');
            }
        }

        function editLabelDescription(labelId) {
            const labels = JSON.parse(localStorage.getItem('trello-labels')) || [];
            const label = labels.find(l => l.id === labelId);
            if (!label) return;

            const newDescription = prompt('Enter new description:', label.description);
            if (newDescription && newDescription.trim() !== label.description) {
                label.description = newDescription.trim();
                localStorage.setItem('trello-labels', JSON.stringify(labels));
                populateAvailableLabels();
                showMessage(`Label description updated!`, 'success');
            }
        }

        function changeLabelColor(labelId) {
            const colors = [
                { name: 'Red', value: 'red' },
                { name: 'Orange', value: 'orange' },
                { name: 'Yellow', value: 'yellow' },
                { name: 'Green', value: 'green' },
                { name: 'Blue', value: 'blue' },
                { name: 'Purple', value: 'purple' },
                { name: 'Pink', value: 'pink' },
                { name: 'Sky', value: 'sky' },
                { name: 'Lime', value: 'lime' },
                { name: 'Grey', value: 'grey' }
            ];

            const colorOptions = colors.map((color, index) => 
                `${index + 1}. ${color.name}`
            ).join('\n');

            const choice = prompt(`Choose a color:\n${colorOptions}\n\nEnter number (1-${colors.length}):`);
            const colorIndex = parseInt(choice) - 1;

            if (colorIndex >= 0 && colorIndex < colors.length) {
                const labels = JSON.parse(localStorage.getItem('trello-labels')) || [];
                const label = labels.find(l => l.id === labelId);
                if (label) {
                    label.color = colors[colorIndex].value;
                    localStorage.setItem('trello-labels', JSON.stringify(labels));
                    populateAvailableLabels();
                    showMessage(`Label color changed to ${colors[colorIndex].name}!`, 'success');
                }
            }
        }

        function deleteLabel(labelId) {
            const labels = JSON.parse(localStorage.getItem('trello-labels')) || [];
            const label = labels.find(l => l.id === labelId);
            if (!label) return;

            if (confirm(`Delete label "${label.name}"? This will remove it from all cards.`)) {
                const updatedLabels = labels.filter(l => l.id !== labelId);
                localStorage.setItem('trello-labels', JSON.stringify(updatedLabels));
                populateAvailableLabels();
                showMessage(`Label "${label.name}" deleted!`, 'success');
            }
        }

        function duplicateLabel(labelId) {
            const labels = JSON.parse(localStorage.getItem('trello-labels')) || [];
            const label = labels.find(l => l.id === labelId);
            if (!label) return;

            const newLabel = {
                id: Date.now(),
                name: `${label.name} Copy`,
                color: label.color,
                description: label.description,
                created: Date.now()
            };

            labels.push(newLabel);
            localStorage.setItem('trello-labels', JSON.stringify(labels));
            populateAvailableLabels();
            showMessage(`Label "${newLabel.name}" created!`, 'success');
        }

        function manageLabels() {
            const labels = JSON.parse(localStorage.getItem('trello-labels')) || [];
            const labelCount = labels.length;
            
            const message = `Label Management\n\nTotal Labels: ${labelCount}\n\nActions:\n1. View all labels\n2. Clear all labels\n3. Reset to defaults\n4. Sort by name\n5. Sort by color\n6. Sort by date\n\nEnter number (1-6):`;
            
            const choice = prompt(message);
            const choiceNum = parseInt(choice);
            
            switch(choiceNum) {
                case 1:
                    viewAllLabels();
                    break;
                case 2:
                    clearAllLabels();
                    break;
                case 3:
                    resetToDefaults();
                    break;
                case 4:
                    sortLabelsByName();
                    break;
                case 5:
                    sortLabelsByColor();
                    break;
                case 6:
                    sortLabelsByDate();
                    break;
                default:
                    showMessage('Invalid choice!', 'error');
            }
        }

        function viewAllLabels() {
            const labels = JSON.parse(localStorage.getItem('trello-labels')) || [];
            const labelList = labels.map((label, index) => 
                `${index + 1}. ${label.name} (${label.color}) - ${label.description}`
            ).join('\n');
            
            alert(`All Labels:\n\n${labelList}`);
        }

        function clearAllLabels() {
            if (confirm('Clear all labels? This cannot be undone.')) {
                localStorage.removeItem('trello-labels');
                populateAvailableLabels();
                showMessage('All labels cleared!', 'success');
            }
        }

        function resetToDefaults() {
            if (confirm('Reset to default labels? This will replace all current labels.')) {
                localStorage.removeItem('trello-labels');
                populateAvailableLabels();
                showMessage('Labels reset to defaults!', 'success');
            }
        }

        function sortLabelsByName() {
            const labels = JSON.parse(localStorage.getItem('trello-labels')) || [];
            labels.sort((a, b) => a.name.localeCompare(b.name));
            localStorage.setItem('trello-labels', JSON.stringify(labels));
            populateAvailableLabels();
            showMessage('Labels sorted by name!', 'success');
        }

        function sortLabelsByColor() {
            const labels = JSON.parse(localStorage.getItem('trello-labels')) || [];
            labels.sort((a, b) => a.color.localeCompare(b.color));
            localStorage.setItem('trello-labels', JSON.stringify(labels));
            populateAvailableLabels();
            showMessage('Labels sorted by color!', 'success');
        }

        function sortLabelsByDate() {
            const labels = JSON.parse(localStorage.getItem('trello-labels')) || [];
            labels.sort((a, b) => b.created - a.created);
            localStorage.setItem('trello-labels', JSON.stringify(labels));
            populateAvailableLabels();
            showMessage('Labels sorted by date!', 'success');
        }

        function importLabels() {
            const jsonData = prompt('Paste JSON data to import labels:');
            if (jsonData && jsonData.trim()) {
                try {
                    const importedLabels = JSON.parse(jsonData);
                    if (Array.isArray(importedLabels)) {
                        const labels = JSON.parse(localStorage.getItem('trello-labels')) || [];
                        const newLabels = importedLabels.map(label => ({
                            ...label,
                            id: Date.now() + Math.random(),
                            created: Date.now()
                        }));
                        labels.push(...newLabels);
                        localStorage.setItem('trello-labels', JSON.stringify(labels));
                        populateAvailableLabels();
                        showMessage(`${newLabels.length} labels imported!`, 'success');
                    } else {
                        showMessage('Invalid JSON format!', 'error');
                    }
                } catch (e) {
                    showMessage('Invalid JSON data!', 'error');
                }
            }
        }

        function exportLabels() {
            const labels = JSON.parse(localStorage.getItem('trello-labels')) || [];
            const jsonData = JSON.stringify(labels, null, 2);
            const textArea = document.createElement('textarea');
            textArea.value = jsonData;
            document.body.appendChild(textArea);
            textArea.select();
            document.execCommand('copy');
            document.body.removeChild(textArea);
            showMessage('Labels copied to clipboard!', 'success');
        }

        function toggleMembersPanel() {
            const container = document.getElementById('trello-members-list');
            if (!container) return;

            // Remove existing member picker if any
            const existingPicker = document.querySelector('.trello-member-picker');
            if (existingPicker) {
                existingPicker.remove();
                return;
            }

            // Create dynamic member picker
            const memberPicker = document.createElement('div');
            memberPicker.className = 'trello-member-picker';
            memberPicker.innerHTML = `
                <div class="trello-member-picker-content">
                    <div class="trello-member-picker-header">
                        <h4>Board Members</h4>
                        <button class="trello-close-member-picker" onclick="toggleMembersPanel()">
                            <i class="fas fa-times"></i>
                        </button>
                    </div>
                    <div class="trello-member-picker-body">
                        <div class="trello-member-search-group">
                            <input type="text" id="trello-member-search" class="trello-member-search-input" 
                                   placeholder="Search board members...">
                            <i class="fas fa-search trello-search-icon"></i>
                        </div>
                        <div class="trello-board-members-section">
                            <h5 class="trello-section-title">
                                <i class="fas fa-users"></i> Board Members
                            </h5>
                            <div class="trello-board-members-list" id="trello-board-members-list">
                                <!-- Board members will be populated here -->
                            </div>
                        </div>
                        <div class="trello-member-actions">
                            <button class="trello-invite-member-btn" onclick="inviteNewMember()">
                                <i class="fas fa-user-plus"></i> Invite to Board
                            </button>
                            <button class="trello-manage-members-btn" onclick="manageBoardMembers()">
                                <i class="fas fa-cog"></i> Manage Members
                            </button>
                        </div>
                    </div>
                </div>
            `;

            container.appendChild(memberPicker);

            // Add click-outside-to-close functionality
            const closeModal = (e) => {
                if (!memberPicker.contains(e.target)) {
                    toggleMembersPanel();
                    document.removeEventListener('click', closeModal);
                }
            };

            // Add event listener after a short delay to prevent immediate closing
            setTimeout(() => {
                document.addEventListener('click', closeModal);
                
                // Add ESC key to close
                const handleEscKey = (e) => {
                    if (e.key === 'Escape') {
                        toggleMembersPanel();
                        document.removeEventListener('keydown', handleEscKey);
                    }
                };
                document.addEventListener('keydown', handleEscKey);
            }, 100);

            // Populate board members
            populateBoardMembers();

            // Focus on search input
            setTimeout(() => {
                const searchInput = document.getElementById('trello-member-search');
                if (searchInput) searchInput.focus();
            }, 100);

            // Add search functionality
            const searchInput = document.getElementById('trello-member-search');
            if (searchInput) {
                searchInput.addEventListener('input', function() {
                    filterBoardMembers(this.value);
                });
            }
        }

        function populateBoardMembers() {
            const container = document.getElementById('trello-board-members-list');
            if (!container) return;

            // Board members data (in real app, this would come from server)
            const boardMembers = [
                { id: 1, name: 'John Doe', email: 'john@example.com', avatar: 'JD', role: 'Admin', online: true },
                { id: 2, name: 'Jane Smith', email: 'jane@example.com', avatar: 'JS', role: 'Member', online: true },
                { id: 3, name: 'Mike Johnson', email: 'mike@example.com', avatar: 'MJ', role: 'Member', online: false },
                { id: 4, name: 'Sarah Wilson', email: 'sarah@example.com', avatar: 'SW', role: 'Observer', online: true },
                { id: 5, name: 'David Brown', email: 'david@example.com', avatar: 'DB', role: 'Member', online: false },
                { id: 6, name: 'Lisa Davis', email: 'lisa@example.com', avatar: 'LD', role: 'Member', online: true }
            ];

            container.innerHTML = '';
            boardMembers.forEach(member => {
                const memberElement = document.createElement('div');
                memberElement.className = 'trello-board-member';
                memberElement.setAttribute('data-member-id', member.id);
                memberElement.setAttribute('data-member-name', member.name);
                memberElement.setAttribute('data-member-email', member.email);
                memberElement.innerHTML = `
                    <div class="trello-board-member-info">
                        <div class="trello-board-member-avatar ${member.online ? 'online' : 'offline'}">
                            ${member.avatar}
                        </div>
                        <div class="trello-board-member-details">
                            <div class="trello-board-member-name">${member.name}</div>
                            <div class="trello-board-member-email">${member.email}</div>
                            <div class="trello-board-member-role">${member.role}</div>
                        </div>
                    </div>
                    <div class="trello-board-member-actions">
                        <button class="trello-add-to-card-btn" onclick="addBoardMemberToCard(${member.id}, '${member.name}', '${member.email}', '${member.avatar}')" title="Add to card">
                            <i class="fas fa-plus"></i>
                        </button>
                        <button class="trello-member-options-btn" onclick="showMemberOptions(${member.id})" title="Options">
                            <i class="fas fa-ellipsis-v"></i>
                        </button>
                    </div>
                `;
                container.appendChild(memberElement);
            });
        }

        function filterBoardMembers(searchTerm) {
            const members = document.querySelectorAll('.trello-board-member');
            const term = searchTerm.toLowerCase();

            members.forEach(member => {
                const name = member.querySelector('.trello-board-member-name').textContent.toLowerCase();
                const email = member.querySelector('.trello-board-member-email').textContent.toLowerCase();
                const role = member.querySelector('.trello-board-member-role').textContent.toLowerCase();
                
                if (name.includes(term) || email.includes(term) || role.includes(term)) {
                    member.style.display = 'flex';
                } else {
                    member.style.display = 'none';
                }
            });
        }

        function addBoardMemberToCard(memberId, name, email, avatar) {
            // Check if member is already on the card
            const existingMember = document.querySelector(`[data-member-id="${memberId}"]`);
            if (existingMember && existingMember.closest('#trello-members-list')) {
                showMessage('Member already assigned to this card!', 'warning');
                return;
            }

            // Add member to card
            addMemberToCard(memberId, name, email, avatar);
            
            // Close the member picker
            const picker = document.querySelector('.trello-member-picker');
            if (picker) {
                picker.remove();
            }
        }

        function showMemberOptions(memberId) {
            const member = document.querySelector(`[data-member-id="${memberId}"]`);
            if (!member) return;

            // Remove existing options menu
            const existingMenu = document.querySelector('.trello-member-options-menu');
            if (existingMenu) {
                existingMenu.remove();
            }

            // Create options menu
            const menu = document.createElement('div');
            menu.className = 'trello-member-options-menu';
            menu.innerHTML = `
                <div class="trello-member-options-content">
                    <button onclick="viewMemberProfile(${memberId})" class="trello-option-item">
                        <i class="fas fa-user"></i> View Profile
                    </button>
                    <button onclick="sendMessageToMember(${memberId})" class="trello-option-item">
                        <i class="fas fa-envelope"></i> Send Message
                    </button>
                    <button onclick="changeMemberRole(${memberId})" class="trello-option-item">
                        <i class="fas fa-user-tag"></i> Change Role
                    </button>
                    <hr class="trello-option-divider">
                    <button onclick="removeFromBoard(${memberId})" class="trello-option-item danger">
                        <i class="fas fa-user-minus"></i> Remove from Board
                    </button>
                </div>
            `;

            // Position menu
            const memberRect = member.getBoundingClientRect();
            menu.style.position = 'absolute';
            menu.style.top = `${memberRect.bottom + 5}px`;
            menu.style.left = `${memberRect.left}px`;
            menu.style.zIndex = '1000';

            document.body.appendChild(menu);

            // Close menu when clicking outside
            setTimeout(() => {
                document.addEventListener('click', function closeMenu(e) {
                    if (!menu.contains(e.target) && !member.contains(e.target)) {
                        menu.remove();
                        document.removeEventListener('click', closeMenu);
                    }
                });
            }, 100);
        }

        function manageBoardMembers() {
            showMessage('Board member management coming soon!', 'info');
        }

        function removeFromBoard(memberId) {
            const member = document.querySelector(`[data-member-id="${memberId}"]`);
            if (!member) return;

            const name = member.getAttribute('data-member-name');
            if (confirm(`Remove ${name} from the board?`)) {
                member.remove();
                showMessage(`${name} removed from board!`, 'success');
            }
        }

        function filterSuggestedMembers(searchTerm) {
            const members = document.querySelectorAll('.trello-suggested-member');
            const term = searchTerm.toLowerCase();

            members.forEach(member => {
                const name = member.querySelector('.trello-member-name').textContent.toLowerCase();
                const email = member.querySelector('.trello-member-email').textContent.toLowerCase();
                
                if (name.includes(term) || email.includes(term)) {
                    member.style.display = 'flex';
                } else {
                    member.style.display = 'none';
                }
            });
        }

        function addMemberToCard(memberId, name, email, avatar) {
            const membersList = document.getElementById('trello-members-list');
            if (!membersList) return;

            // Check if member already exists
            const existingMember = membersList.querySelector(`[data-member-id="${memberId}"]`);
            if (existingMember) {
                showMessage('Member already added!', 'warning');
                return;
            }

            // Create member element
            const memberElement = document.createElement('div');
            memberElement.className = 'trello-member';
            memberElement.setAttribute('data-member-id', memberId);
            memberElement.setAttribute('data-member-name', name);
            memberElement.setAttribute('data-member-email', email);
            memberElement.innerHTML = `
                <div class="trello-member-avatar online">${avatar}</div>
                <div class="trello-member-info">
                    <div class="trello-member-name">${name}</div>
                    <div class="trello-member-email">${email}</div>
                </div>
                <div class="trello-member-actions">
                    <button class="trello-member-menu-btn" onclick="toggleMemberMenu(${memberId})" title="Member options">
                        <i class="fas fa-ellipsis-v"></i>
                    </button>
                    <button class="trello-remove-member-btn" onclick="removeMemberFromCard(${memberId})" title="Remove member">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
            `;

            // Add to members list (before the picker)
            const picker = membersList.querySelector('.trello-member-picker');
            if (picker) {
                membersList.insertBefore(memberElement, picker);
            } else {
                membersList.appendChild(memberElement);
            }

            // Update member count
            updateMemberCount();
            showMessage(`Member "${name}" added to card!`, 'success');
        }

        function removeMemberFromCard(memberId) {
            const memberElement = document.querySelector(`[data-member-id="${memberId}"]`);
            if (memberElement) {
                const memberName = memberElement.getAttribute('data-member-name');
                memberElement.remove();
                updateMemberCount();
                showMessage(`${memberName} removed from card!`, 'info');
            }
        }

        function toggleMemberMenu(memberId) {
            const member = document.querySelector(`[data-member-id="${memberId}"]`);
            if (!member) return;

            // Remove existing menu
            const existingMenu = document.querySelector('.trello-member-menu');
            if (existingMenu) {
                existingMenu.remove();
            }

            // Create member menu
            const menu = document.createElement('div');
            menu.className = 'trello-member-menu';
            menu.innerHTML = `
                <div class="trello-member-menu-content">
                    <button onclick="changeMemberRole(${memberId})" class="trello-menu-item">
                        <i class="fas fa-user-tag"></i> Change Role
                    </button>
                    <button onclick="sendMessageToMember(${memberId})" class="trello-menu-item">
                        <i class="fas fa-envelope"></i> Send Message
                    </button>
                    <button onclick="viewMemberProfile(${memberId})" class="trello-menu-item">
                        <i class="fas fa-user"></i> View Profile
                    </button>
                    <hr class="trello-menu-divider">
                    <button onclick="removeMemberFromCard(${memberId})" class="trello-menu-item danger">
                        <i class="fas fa-user-minus"></i> Remove from Card
                    </button>
                </div>
            `;

            // Position menu
            const memberRect = member.getBoundingClientRect();
            menu.style.position = 'absolute';
            menu.style.top = `${memberRect.bottom + 5}px`;
            menu.style.left = `${memberRect.left}px`;
            menu.style.zIndex = '1000';

            document.body.appendChild(menu);

            // Close menu when clicking outside
            setTimeout(() => {
                document.addEventListener('click', function closeMenu(e) {
                    if (!menu.contains(e.target) && !member.contains(e.target)) {
                        menu.remove();
                        document.removeEventListener('click', closeMenu);
                    }
                });
            }, 100);
        }

        function changeMemberRole(memberId) {
            const member = document.querySelector(`[data-member-id="${memberId}"]`);
            if (!member) return;

            const name = member.getAttribute('data-member-name');
            const roles = ['Member', 'Admin', 'Observer'];
            const currentRole = 'Member'; // Default role
            
            const roleSelect = document.createElement('select');
            roleSelect.className = 'trello-role-select';
            roles.forEach(role => {
                const option = document.createElement('option');
                option.value = role;
                option.textContent = role;
                if (role === currentRole) option.selected = true;
                roleSelect.appendChild(option);
            });

            if (confirm(`Change role for ${name}?`)) {
                const newRole = roleSelect.value;
                showMessage(`Role changed to ${newRole} for ${name}!`, 'success');
            }
        }

        function sendMessageToMember(memberId) {
            const member = document.querySelector(`[data-member-id="${memberId}"]`);
            if (!member) return;

            const name = member.getAttribute('data-member-name');
            const email = member.getAttribute('data-member-email');
            const message = prompt(`Send message to ${name} (${email}):`);
            
            if (message && message.trim()) {
                showMessage(`Message sent to ${name}!`, 'success');
            }
        }

        function viewMemberProfile(memberId) {
            const member = document.querySelector(`[data-member-id="${memberId}"]`);
            if (!member) return;

            const name = member.getAttribute('data-member-name');
            const email = member.getAttribute('data-member-email');
            
            showMessage(`Viewing profile for ${name} (${email})`, 'info');
        }

        function updateMemberCount() {
            const membersList = document.getElementById('trello-members-list');
            const memberCount = membersList ? membersList.children.length : 0;
            
            // Update member count in sidebar
            const memberButton = document.querySelector('.trello-sidebar-btn[onclick*="toggleMembersPanel"]');
            if (memberButton) {
                const buttonText = memberButton.querySelector('span');
                if (buttonText) {
                    buttonText.textContent = `Members (${memberCount})`;
                }
            }
        }

        function inviteNewMember() {
            const email = prompt('Enter email address to invite:');
            if (email && isValidEmail(email)) {
                showMessage(`Invitation sent to ${email}!`, 'success');
            } else if (email) {
                showMessage('Please enter a valid email address!', 'error');
            }
        }

        function isValidEmail(email) {
            const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            return emailRegex.test(email);
        }

        function toggleChecklistPanel() {
            const container = document.getElementById('trello-checklist-items');
            if (!container) return;

            // Remove existing checklist picker if any
            const existingPicker = document.querySelector('.trello-checklist-picker');
            if (existingPicker) {
                existingPicker.remove();
                return;
            }

            // Create dynamic checklist picker
            const checklistPicker = document.createElement('div');
            checklistPicker.className = 'trello-checklist-picker';
            checklistPicker.innerHTML = `
                <div class="trello-checklist-picker-content">
                    <div class="trello-checklist-picker-header">
                        <h4>Manage Checklist</h4>
                        <button class="trello-close-checklist-picker" onclick="toggleChecklistPanel()">
                            <i class="fas fa-times"></i>
                        </button>
                    </div>
                    <div class="trello-checklist-picker-body">
                        <div class="trello-checklist-actions">
                            <button class="trello-add-checklist-btn" onclick="addNewChecklist()">
                                <i class="fas fa-plus"></i> Add New Checklist
                            </button>
                            <button class="trello-clear-checklist-btn" onclick="clearAllChecklist()">
                                <i class="fas fa-trash"></i> Clear All
                            </button>
                        </div>
                        <div class="trello-checklist-templates">
                            <h5>Quick Templates:</h5>
                            <div class="trello-template-buttons">
                                <button class="trello-template-btn" onclick="loadChecklistTemplate('development')">
                                    Development Tasks
                                </button>
                                <button class="trello-template-btn" onclick="loadChecklistTemplate('review')">
                                    Review Process
                                </button>
                                <button class="trello-template-btn" onclick="loadChecklistTemplate('testing')">
                                    Testing Checklist
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            `;

            container.appendChild(checklistPicker);
        }

        function addNewChecklist() {
            alert("hiii");
            const input = document.getElementById('trello-new-checklist-item');
            if (!input) return;

            const text = input.value.trim();
            if (!text) {
                showMessage('Please enter a checklist item!', 'error');
                return;
            }

            const container = document.getElementById('trello-checklist-items');
            const itemElement = document.createElement('div');
            itemElement.className = 'trello-checklist-item';
            itemElement.innerHTML = `
                <input type="checkbox" onchange="toggleChecklistItem(${Date.now()})">
                <label>${escapeHtml(text)}</label>
                <button class="trello-remove-checklist-item" onclick="removeChecklistItem(this)" title="Remove item">
                    <i class="fas fa-times"></i>
                </button>
            `;
            
            container.appendChild(itemElement);
            input.value = '';
            
            // Update progress
            updateChecklistProgress();
            showMessage('Checklist item added!', 'success');
        }

        function removeChecklistItem(button) {
            const item = button.closest('.trello-checklist-item');
            if (item) {
                item.style.animation = 'trello-comment-slide-out 0.3s ease-out';
                setTimeout(() => {
                    item.remove();
                    updateChecklistProgress();
                    showMessage('Checklist item removed!', 'info');
                }, 300);
            }
        }

        function toggleChecklistItem(itemId) {
            const item = document.querySelector(`input[onchange="toggleChecklistItem(${itemId})"]`).closest('.trello-checklist-item');
            if (item) {
                const checkbox = item.querySelector('input[type="checkbox"]');
                const label = item.querySelector('label');
                
                if (checkbox.checked) {
                    item.classList.add('completed');
                    label.style.textDecoration = 'line-through';
                    label.style.color = '#5e6c84';
                } else {
                    item.classList.remove('completed');
                    label.style.textDecoration = 'none';
                    label.style.color = '#172b4d';
                }
                
                updateChecklistProgress();
                showMessage('Checklist item updated!', 'success');
            }
        }

        function updateChecklistProgress() {
            const items = document.querySelectorAll('.trello-checklist-item');
            const completedItems = document.querySelectorAll('.trello-checklist-item.completed');
            
            const progress = items.length > 0 ? (completedItems.length / items.length) * 100 : 0;
            
            const progressFill = document.getElementById('trello-progress-fill');
            const progressText = document.getElementById('trello-progress-text');
            
            if (progressFill) {
                progressFill.style.width = `${progress}%`;
            }
            
            if (progressText) {
                progressText.textContent = `${Math.round(progress)}%`;
            }
        }

        function clearAllChecklist() {
            if (confirm('Are you sure you want to clear all checklist items?')) {
                const container = document.getElementById('trello-checklist-items');
                container.innerHTML = '';
                updateChecklistProgress();
                showMessage('All checklist items cleared!', 'info');
            }
        }

        function loadChecklistTemplate(template) {
            const templates = {
                development: [
                    'Write code',
                    'Test functionality',
                    'Code review',
                    'Documentation',
                    'Deploy to staging'
                ],
                review: [
                    'Initial review',
                    'Check requirements',
                    'Test edge cases',
                    'Performance check',
                    'Final approval'
                ],
                testing: [
                    'Unit tests',
                    'Integration tests',
                    'UI testing',
                    'Performance testing',
                    'Security testing'
                ]
            };

            const items = templates[template] || [];
            const container = document.getElementById('trello-checklist-items');
            
            // Clear existing items
            container.innerHTML = '';
            
            // Add template items
            items.forEach((item, index) => {
                const itemElement = document.createElement('div');
                itemElement.className = 'trello-checklist-item';
                itemElement.innerHTML = `
                    <input type="checkbox" onchange="toggleChecklistItem(${Date.now() + index})">
                    <label>${item}</label>
                    <button class="trello-remove-checklist-item" onclick="removeChecklistItem(this)" title="Remove item">
                        <i class="fas fa-times"></i>
                    </button>
                `;
                container.appendChild(itemElement);
            });
            
            updateChecklistProgress();
            showMessage(`${template} template loaded!`, 'success');
        }

        function toggleDueDatePanel() {
            const container = document.getElementById('trello-due-date-display');
            if (!container) return;

            // Remove existing date picker if any
            const existingPicker = document.querySelector('.trello-date-picker');
            if (existingPicker) {
                existingPicker.remove();
                return;
            }

            // Create dynamic date picker
            const datePicker = document.createElement('div');
            datePicker.className = 'trello-date-picker';
            datePicker.innerHTML = `
                <div class="trello-date-picker-content">
                    <div class="trello-date-picker-header">
                        <h4>Set Due Date</h4>
                        <button class="trello-close-date-picker" onclick="toggleDueDatePanel()">
                            <i class="fas fa-times"></i>
                        </button>
                    </div>
                    <div class="trello-date-picker-body">
                        <div class="trello-date-input-group">
                            <label for="trello-due-date-input">Due Date</label>
                            <input type="date" id="trello-due-date-input" class="trello-date-input">
                        </div>
                        <div class="trello-date-input-group">
                            <label for="trello-due-time-input">Due Time</label>
                            <input type="time" id="trello-due-time-input" class="trello-time-input">
                        </div>
                        <div class="trello-quick-dates">
                            <button class="trello-quick-date-btn" onclick="setQuickDate('today')">Today</button>
                            <button class="trello-quick-date-btn" onclick="setQuickDate('tomorrow')">Tomorrow</button>
                            <button class="trello-quick-date-btn" onclick="setQuickDate('next-week')">Next Week</button>
                            <button class="trello-quick-date-btn" onclick="setQuickDate('next-month')">Next Month</button>
                        </div>
                        <div class="trello-date-actions">
                            <button class="trello-save-date-btn" onclick="saveDueDate()">
                                <i class="fas fa-check"></i> Save
                            </button>
                            <button class="trello-remove-date-btn" onclick="removeDueDate()">
                                <i class="fas fa-trash"></i> Remove
                            </button>
                        </div>
                    </div>
                </div>
            `;

            container.appendChild(datePicker);

            // Add click-outside-to-close functionality
            const closeModal = (e) => {
                if (!datePicker.contains(e.target)) {
                    toggleDueDatePanel();
                    document.removeEventListener('click', closeModal);
                }
            };

            // Add event listener after a short delay to prevent immediate closing
            setTimeout(() => {
                document.addEventListener('click', closeModal);
                
                // Add ESC key to close
                const handleEscKey = (e) => {
                    if (e.key === 'Escape') {
                        toggleDueDatePanel();
                        document.removeEventListener('keydown', handleEscKey);
                    }
                };
                document.addEventListener('keydown', handleEscKey);
            }, 100);

            // Set current date as default
            const today = new Date();
            const dateInput = document.getElementById('trello-due-date-input');
            if (dateInput) {
                dateInput.value = today.toISOString().split('T')[0];
            }

            // Focus on date input
            setTimeout(() => {
                if (dateInput) dateInput.focus();
            }, 100);
        }

        function setQuickDate(type) {
            const dateInput = document.getElementById('trello-due-date-input');
            const timeInput = document.getElementById('trello-due-time-input');
            if (!dateInput) return;

            const today = new Date();
            let targetDate = new Date(today);

            switch (type) {
                case 'today':
                    // Keep today
                    break;
                case 'tomorrow':
                    targetDate.setDate(today.getDate() + 1);
                    break;
                case 'next-week':
                    targetDate.setDate(today.getDate() + 7);
                    break;
                case 'next-month':
                    targetDate.setMonth(today.getMonth() + 1);
                    break;
            }

            dateInput.value = targetDate.toISOString().split('T')[0];
            
            // Set default time to 5 PM
            if (timeInput) {
                timeInput.value = '17:00';
            }

            showMessage(`Due date set to ${type}!`, 'success');
        }

        function saveDueDate() {
            const dateInput = document.getElementById('trello-due-date-input');
            const timeInput = document.getElementById('trello-due-time-input');
            
            if (!dateInput || !dateInput.value) {
                showMessage('Please select a date!', 'error');
                return;
            }

            const date = new Date(dateInput.value);
            const time = timeInput ? timeInput.value : '17:00';
            
            // Update the display
            populateTrelloDueDate(dateInput.value);
            
            // Close the picker
            toggleDueDatePanel();
            
            showMessage('Due date saved successfully!', 'success');
        }

        function removeDueDate() {
            const container = document.getElementById('trello-due-date-display');
            if (container) {
                container.innerHTML = '';
            }
            
            toggleDueDatePanel();
            showMessage('Due date removed!', 'info');
        }

        function toggleDescriptionEdit() {
            const container = document.getElementById('trello-description-display');
            if (!container) return;

            // Check if already in edit mode
            const existingEditor = container.querySelector('.trello-description-editor');
            if (existingEditor) {
                // Save and exit edit mode
                saveDescription();
                return;
            }

            // Get current description
            const currentText = container.textContent.trim();
            
            // Create editor
            const editor = document.createElement('div');
            editor.className = 'trello-description-editor';
            editor.innerHTML = `
                <textarea class="trello-description-textarea" placeholder="Add a more detailed description...">${currentText}</textarea>
                <div class="trello-description-actions">
                    <button class="trello-save-description-btn" onclick="saveDescription()">
                        <i class="fas fa-check"></i> Save
                    </button>
                    <button class="trello-cancel-description-btn" onclick="cancelDescriptionEdit()">
                        <i class="fas fa-times"></i> Cancel
                    </button>
                </div>
            `;

            // Replace content with editor
            container.innerHTML = '';
            container.appendChild(editor);

            // Focus on textarea
            const textarea = editor.querySelector('.trello-description-textarea');
            if (textarea) {
                textarea.focus();
                textarea.setSelectionRange(textarea.value.length, textarea.value.length);
            }
        }

        function saveDescription() {
            alert('prince');
            const container = document.getElementById('trello-description-display');
            const textarea = container.querySelector('.trello-description-textarea');
            
            if (!textarea) return;

            const newText = textarea.value.trim();
            
            // Update display
            if (newText) {
                container.innerHTML = `<div class="trello-description-content">${escapeHtml(newText)}</div>`;
                container.classList.remove('empty');
            } else {
                container.innerHTML = '<div class="trello-description-empty">No description</div>';
                container.classList.add('empty');
            }

            showMessage('Description saved!', 'success');
        }

        function cancelDescriptionEdit() {
            const container = document.getElementById('trello-description-display');
            const originalText = container.getAttribute('data-original-text') || '';
            
            if (originalText) {
                container.innerHTML = `<div class="trello-description-content">${escapeHtml(originalText)}</div>`;
                container.classList.remove('empty');
            } else {
                container.innerHTML = '<div class="trello-description-empty">No description</div>';
                container.classList.add('empty');
            }
        }

        function addTrelloChecklistItem() {
            const input = document.getElementById('trello-new-checklist-item');
            const text = input.value.trim();
            
            if (!text) {
                showMessage('Please enter a checklist item!', 'error');
                return;
            }

            const container = document.getElementById('trello-checklist-items');
            const itemId = Date.now();
            const itemElement = document.createElement('div');
            itemElement.className = 'trello-checklist-item';
            itemElement.setAttribute('data-item-id', itemId);
            itemElement.innerHTML = `
                <div class="trello-checklist-item-content">
                    <input type="checkbox" id="checklist-${itemId}" onchange="toggleTrelloChecklistItem(${itemId})">
                    <label for="checklist-${itemId}" class="trello-checklist-label">${escapeHtml(text)}</label>
                </div>
                <div class="trello-checklist-item-actions">
                    <button class="trello-edit-checklist-item" onclick="editTrelloChecklistItem(${itemId})" title="Edit item">
                        <i class="fas fa-edit"></i>
                    </button>
                    <button class="trello-remove-checklist-item" onclick="removeTrelloChecklistItem(${itemId})" title="Remove item">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
            `;
            
            container.appendChild(itemElement);
            input.value = '';
            
            // Update progress
            updateTrelloChecklistProgress();
            showMessage('Checklist item added!', 'success');
        }

        function toggleTrelloChecklistItem(itemId) {
            const item = document.querySelector(`[data-item-id="${itemId}"]`);
            if (!item) return;

            const checkbox = item.querySelector('input[type="checkbox"]');
            const label = item.querySelector('.trello-checklist-label');
            
            if (checkbox.checked) {
                item.classList.add('completed');
                label.style.textDecoration = 'line-through';
                label.style.color = '#5e6c84';
                showMessage('Item completed!', 'success');
            } else {
                item.classList.remove('completed');
                label.style.textDecoration = 'none';
                label.style.color = '#172b4d';
                showMessage('Item unchecked!', 'info');
            }
            
            updateTrelloChecklistProgress();
        }

        function editTrelloChecklistItem(itemId) {
            const item = document.querySelector(`[data-item-id="${itemId}"]`);
            if (!item) return;

            const label = item.querySelector('.trello-checklist-label');
            const currentText = label.textContent;
            
            // Create edit input
            const editInput = document.createElement('input');
            editInput.type = 'text';
            editInput.className = 'trello-checklist-edit-input';
            editInput.value = currentText;
            editInput.style.width = '100%';
            editInput.style.padding = '4px 8px';
            editInput.style.border = '1px solid #0079bf';
            editInput.style.borderRadius = '4px';
            
            // Replace label with input
            label.style.display = 'none';
            label.parentNode.insertBefore(editInput, label);
            editInput.focus();
            editInput.select();
            
            // Handle save
            const saveEdit = () => {
                const newText = editInput.value.trim();
                if (newText && newText !== currentText) {
                    label.textContent = newText;
                    showMessage('Checklist item updated!', 'success');
                }
                label.style.display = 'block';
                editInput.remove();
            };
            
            // Handle cancel
            const cancelEdit = () => {
                label.style.display = 'block';
                editInput.remove();
            };
            
            // Event listeners
            editInput.addEventListener('blur', saveEdit);
            editInput.addEventListener('keydown', (e) => {
                if (e.key === 'Enter') {
                    e.preventDefault();
                    saveEdit();
                } else if (e.key === 'Escape') {
                    e.preventDefault();
                    cancelEdit();
                }
            });
        }

        function removeTrelloChecklistItem(itemId) {
            const item = document.querySelector(`[data-item-id="${itemId}"]`);
            if (!item) return;

            if (confirm('Are you sure you want to remove this checklist item?')) {
                item.style.animation = 'trello-comment-slide-out 0.3s ease-out';
                setTimeout(() => {
                    item.remove();
                    updateTrelloChecklistProgress();
                    showMessage('Checklist item removed!', 'info');
                }, 300);
            }
        }

        function updateTrelloChecklistProgress() {
            const items = document.querySelectorAll('.trello-checklist-item');
            const completedItems = document.querySelectorAll('.trello-checklist-item.completed');
            
            const total = items.length;
            const completed = completedItems.length;
            const progress = total > 0 ? Math.round((completed / total) * 100) : 0;
            
            // Update progress bar
            const progressFill = document.getElementById('trello-progress-fill');
            const progressText = document.getElementById('trello-progress-text');
            
            if (progressFill) {
                progressFill.style.width = `${progress}%`;
                progressFill.style.backgroundColor = progress === 100 ? '#61bd4f' : '#0079bf';
            }
            
            if (progressText) {
                progressText.textContent = `${completed}/${total} (${progress}%)`;
            }
            
            // Update checklist title with progress
            const checklistTitle = document.querySelector('.trello-section-header h3');
            if (checklistTitle && total > 0) {
                checklistTitle.innerHTML = `<i class="fas fa-check-square"></i> Checklist (${completed}/${total})`;
            }
        }

        function addTrelloComment() {
            const input = document.getElementById('trello-comment-input');
            const text = input.value.trim();
            
            if (!text) {
                showMessage('Please enter a comment!', 'error');
                return;
            }

            // Show loading state
            const saveBtn = document.querySelector('.trello-comment-save-btn');
            const originalText = saveBtn.innerHTML;
            saveBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Adding...';
            saveBtn.disabled = true;

            // Simulate API call
            setTimeout(() => {
                const container = document.getElementById('trello-comments-list');
                const commentElement = document.createElement('div');
                commentElement.className = 'trello-comment trello-comment-new';
                commentElement.innerHTML = `
                    <div class="trello-comment-avatar">
                        <img src="https://via.placeholder.com/32x32/667eea/ffffff?text=U" alt="You">
                    </div>
                    <div class="trello-comment-content">
                        <div class="trello-comment-header">
                            <span class="trello-comment-author">You</span>
                            <span class="trello-comment-time">Just now</span>
                            <div class="trello-comment-actions">
                                <button class="trello-comment-edit-btn" onclick="editComment(this)" title="Edit comment">
                                    <i class="fas fa-edit"></i>
                                </button>
                                <button class="trello-comment-delete-btn" onclick="deleteComment(this)" title="Delete comment">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </div>
                        </div>
                        <div class="trello-comment-text">${escapeHtml(text)}</div>
                    </div>
                `;
                
                container.appendChild(commentElement);
                
                // Animate new comment
                setTimeout(() => {
                    commentElement.classList.add('trello-comment-animate');
                }, 100);

                // Clear input and reset button
                input.value = '';
                saveBtn.innerHTML = originalText;
                saveBtn.disabled = false;
                
                // Hide comment actions initially
                hideCommentActions();
                
                showMessage('Comment added successfully!', 'success');
            }, 1000);
        }

        function editComment(button) {
            alert('prince');
            const comment = button.closest('.trello-comment');
            const textElement = comment.querySelector('.trello-comment-text');
            const originalText = textElement.textContent;
            
            // Create edit input
            const editInput = document.createElement('textarea');
            editInput.className = 'trello-comment-edit-input';
            editInput.value = originalText;
            editInput.style.cssText = `
                width: 100%;
                padding: 8px 12px;
                border: 1px solid #e2e4e6;
                border-radius: 4px;
                font-size: 14px;
                resize: vertical;
                min-height: 60px;
            `;
            
            // Replace text with input
            textElement.innerHTML = '';
            textElement.appendChild(editInput);
            editInput.focus();
            editInput.select();
            
            // Add edit actions
            const editActions = document.createElement('div');
            editActions.className = 'trello-comment-edit-actions';
            editActions.innerHTML = `
                <button class="trello-comment-save-edit-btn" onclick="saveCommentEdit(this)">
                    <i class="fas fa-check"></i> Save
                </button>
                <button class="trello-comment-cancel-edit-btn" onclick="cancelCommentEdit(this, '${originalText}')">
                    <i class="fas fa-times"></i> Cancel
                </button>
            `;
            
            textElement.appendChild(editActions);
        }

        function saveCommentEdit(button) {
            const comment = button.closest('.trello-comment');
            const editInput = comment.querySelector('.trello-comment-edit-input');
            const newText = editInput.value.trim();
            
            if (!newText) {
                showMessage('Comment cannot be empty!', 'error');
                return;
            }
            
            const textElement = comment.querySelector('.trello-comment-text');
            textElement.innerHTML = escapeHtml(newText);
            
            showMessage('Comment updated!', 'success');
        }

        function cancelCommentEdit(button, originalText) {
            const comment = button.closest('.trello-comment');
            const textElement = comment.querySelector('.trello-comment-text');
            textElement.innerHTML = escapeHtml(originalText);
        }

        function deleteComment(button) {
            if (confirm('Are you sure you want to delete this comment?')) {
                const comment = button.closest('.trello-comment');
                comment.style.animation = 'trello-comment-slide-out 0.3s ease-out';
                
                setTimeout(() => {
                    comment.remove();
                    showMessage('Comment deleted!', 'info');
                }, 300);
            }
        }

        function hideCommentActions() {
            document.querySelectorAll('.trello-comment-actions').forEach(actions => {
                actions.style.opacity = '0';
            });
        }

        function showCommentActions() {
            document.querySelectorAll('.trello-comment-actions').forEach(actions => {
                actions.style.opacity = '1';
            });
        }

        // Add hover effects for comment actions
        function initializeCommentInteractions() {
            document.addEventListener('mouseover', function(e) {
                if (e.target.closest('.trello-comment')) {
                    const comment = e.target.closest('.trello-comment');
                    const actions = comment.querySelector('.trello-comment-actions');
                    if (actions) {
                        actions.style.opacity = '1';
                    }
                }
            });

            document.addEventListener('mouseout', function(e) {
                if (e.target.closest('.trello-comment')) {
                    const comment = e.target.closest('.trello-comment');
                    const actions = comment.querySelector('.trello-comment-actions');
                    if (actions) {
                        actions.style.opacity = '0';
                    }
                }
            });
        }

        function cancelTrelloComment() {
            document.getElementById('trello-comment-input').value = '';
        }

        function handleTrelloFileUpload(input) {
            const files = Array.from(input.files);
            if (files.length > 0) {
                showMessage(`${files.length} file(s) selected for upload!`, 'success');
            }
        }

        function moveTrelloCard() {
            showMessage('Move card functionality coming soon!', 'info');
        }

        function copyTrelloCard() {
            showMessage('Copy card functionality coming soon!', 'info');
        }

        function watchTrelloCard() {
            showMessage('Watch card functionality coming soon!', 'info');
        }

        function archiveTrelloCard() {
            
            if (confirm('Are you sure you want to archive this card?')) {
                $.ajax({
                url: 'index.php?action=archivedCard&controller=card',
                method: 'POST',
                data: {
                    cardId: cardId
                },
                success: function(response) {
                    if (response.success == true) {
                        showMessage('Card archived successfully!', 'success');
                    } else {
                        showMessage('Failed to archived card!', 'error');
                    }
                },
                error: function() {
                    showMessage('Error Occur while archived card!', 'error');
                }
                });
            }
            // showMessage('Archive card functionality coming soon!', 'info');
        }

        function deleteTrelloCard(cardId) {
            alert(cardId);
            if (confirm('Are you sure you want to delete this card?')) {
                $.ajax({
                url: 'index.php?action=deleteCard&controller=card',
                method: 'POST',
                data: {
                    cardId: cardId
                },
                success: function(response) {
                    const data = JSON.parse(response);
                    if (response.success == true) {
                        showMessage('Card deleted successfully!', 'success');
                    } else {
                        showMessage('Failed to delete card!', 'error');
                    }
                },
                error: function() {
                    showMessage('Error Occur while delete card!', 'error');
                }
                });
            }
            // showMessage('Delete card functionality coming soon!', 'info');
        }   
        

        // Enhanced UI Interactions
        function initializeAdvancedInteractions() {
            // Add ripple effects to buttons
            document.querySelectorAll('.btn, .card-action-btn, .trello-sidebar-btn').forEach(button => {
                button.classList.add('ripple-effect');
                button.addEventListener('click', function(e) {
                    const ripple = document.createElement('span');
                    const rect = this.getBoundingClientRect();
                    const size = Math.max(rect.width, rect.height);
                    const x = e.clientX - rect.left - size / 2;
                    const y = e.clientY - rect.top - size / 2;
                    
                    ripple.style.cssText = `
                        position: absolute;
                        width: ${size}px;
                        height: ${size}px;
                        left: ${x}px;
                        top: ${y}px;
                        background: rgba(255, 255, 255, 0.3);
                        border-radius: 50%;
                        transform: scale(0);
                        animation: ripple 0.6s linear;
                        pointer-events: none;
                    `;
                    
                    this.appendChild(ripple);
                    
                    setTimeout(() => {
                        ripple.remove();
                    }, 600);
                });
            });

            // Add loading states to forms
            document.querySelectorAll('form').forEach(form => {
                form.addEventListener('submit', function() {
                const submitBtn = this.querySelector('button[type="submit"]');
                if (submitBtn) {
                    submitBtn.classList.add('loading-shimmer');
                    submitBtn.disabled = true;
                }
                });
            });

            // Add focus management
            document.addEventListener('keydown', function(e) {
                if (e.key === 'Tab') {
                    document.body.classList.add('keyboard-navigation');
                }
            });

            document.addEventListener('mousedown', function() {
                document.body.classList.remove('keyboard-navigation');
            });

            // Add smooth scrolling
            document.querySelectorAll('a[href^="#"]').forEach(anchor => {
                anchor.addEventListener('click', function(e) {
                    e.preventDefault();
                    const target = document.querySelector(this.getAttribute('href'));
                    if (target) {
                        target.scrollIntoView({
                            behavior: 'smooth',
                            block: 'start'
                        });
                    }
                });
            });

            // Add intersection observer for animations
            const observer = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        entry.target.classList.add('animate-in');
                    }
                });
            }, {
                threshold: 0.1,
                rootMargin: '0px 0px -50px 0px'
            });

            document.querySelectorAll('.card, .board').forEach(el => {
                observer.observe(el);
            });
        }

        // Enhanced responsive handling
        function initializeResponsiveEnhancements() {
            let resizeTimeout;
            
            window.addEventListener('resize', function() {
                clearTimeout(resizeTimeout);
                resizeTimeout = setTimeout(function() {
                    // Recalculate layouts
                    document.querySelectorAll('.board').forEach(board => {
                        board.style.height = 'auto';
                    });
                    
                    // Update modal positioning
                    const modal = document.getElementById('trello-modal');
                    if (modal && modal.style.display === 'block') {
                        adjustModalForScreen();
                    }
                }, 250);
            });

            // Handle orientation changes
            window.addEventListener('orientationchange', function() {
                setTimeout(function() {
                    window.dispatchEvent(new Event('resize'));
                }, 100);
            });
        }

        // Performance optimizations
        function initializePerformanceOptimizations() {
            // Debounce scroll events
            let scrollTimeout;
            window.addEventListener('scroll', function() {
                clearTimeout(scrollTimeout);
                scrollTimeout = setTimeout(function() {
                    // Handle scroll-based animations
                    const scrolled = window.pageYOffset;
                    const parallax = document.querySelectorAll('.parallax');
                    parallax.forEach(el => {
                        const speed = el.dataset.speed || 0.5;
                        el.style.transform = `translateY(${scrolled * speed}px)`;
                    });
                }, 16);
            });

            // Lazy load images
            const imageObserver = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        const img = entry.target;
                        img.src = img.dataset.src;
                        img.classList.remove('lazy');
                        imageObserver.unobserve(img);
                    }
                });
            });

            document.querySelectorAll('img[data-src]').forEach(img => {
                imageObserver.observe(img);
            });
        }

        // Enhanced Modal Functions
        function toggleTitleEdit() {
            const title = document.getElementById('task-title');
            title.focus();
            title.select();
        }

        function toggleChecklist() {
            const panel = document.getElementById('checklist-panel');
            const btn = document.getElementById('btn-checklist');
            
            if (panel) {
                panel.style.display = panel.style.display === 'none' ? 'block' : 'none';
                btn.classList.toggle('active');
            }
        }

        function toggleComments() {
            const panel = document.getElementById('comments-panel');
            const btn = document.getElementById('btn-comments');
            
            if (panel) {
                panel.style.display = panel.style.display === 'none' ? 'block' : 'none';
                btn.classList.toggle('active');
            }
        }

        function addChecklistItem() {
            const input = document.getElementById('new-checklist-item');
            const text = input.value.trim();
            
            if (text) {
                const container = document.querySelector('.checklist-container');
                const itemId = 'check' + Date.now();
                
                const item = document.createElement('div');
                item.className = 'checklist-item';
                item.innerHTML = `
                    <input type="checkbox" id="${itemId}">
                    <label for="${itemId}">${text}</label>
                    <button class="remove-item" onclick="removeChecklistItem(this)">
                        <i class="fas fa-times"></i>
                    </button>
                `;
                
                container.insertBefore(item, container.lastElementChild);
                input.value = '';
                
                // Add animation
                item.style.opacity = '0';
                item.style.transform = 'translateY(-10px)';
                setTimeout(() => {
                    item.style.transition = 'all 0.3s ease';
                    item.style.opacity = '1';
                    item.style.transform = 'translateY(0)';
                }, 10);
            }
        }

        function removeChecklistItem(button) {
            const item = button.closest('.checklist-item');
            item.style.transition = 'all 0.3s ease';
            item.style.opacity = '0';
            item.style.transform = 'translateX(-20px)';
            setTimeout(() => {
                item.remove();
            }, 300);
        }

        function addComment() {
            const input = document.getElementById('new-comment');
            const text = input.value.trim();
            
            if (text) {
                const container = document.querySelector('.comments-container');
                
                const comment = document.createElement('div');
                comment.className = 'comment-item';
                comment.innerHTML = `
                    <div class="comment-avatar">You</div>
                    <div class="comment-content">
                        <div class="comment-header">
                            <span class="comment-author">You</span>
                            <span class="comment-time">Just now</span>
                        </div>
                        <div class="comment-text">${text}</div>
                    </div>
                `;
                
                container.insertBefore(comment, container.lastElementChild);
                input.value = '';
                
                // Add animation
                comment.style.opacity = '0';
                comment.style.transform = 'translateY(-10px)';
                setTimeout(() => {
                    comment.style.transition = 'all 0.3s ease';
                    comment.style.opacity = '1';
                    comment.style.transform = 'translateY(0)';
                }, 10);
            }
        }

        function shareCard() {
            showMessage('Share card functionality coming soon!', 'info');
        }

        function watchCard() {
            showMessage('Watch card functionality coming soon!', 'info');
        }

        function archiveCard(cardId) {
            if (confirm('Are you sure you want to archive this card?')) {
                $.ajax({
                url: 'index.php?action=archivedCard&controller=card',
                method: 'POST',
                data: {
                    cardId: cardId
                },
                success: function(response) {
                    if (response.success == true) {
                        showMessage('Card archived successfully!', 'success');
                    } else {
                        showMessage('Failed to archived card!', 'error');
                    }
                },
                error: function() {
                    showMessage('Error Occur while archived card!', 'error');
                }
                });
            }
        }

        // Enhanced Button Interactions
        function toggleLabelsPanel() {
            const panel = document.getElementById('labels-panel');
            const btn = document.getElementById('btn-labels');
            const membersPanel = document.getElementById('members-panel');
            const membersBtn = document.getElementById('btn-members');
            
            if (membersPanel) membersPanel.style.display = 'none';
            if (membersBtn) membersBtn.classList.remove('active');
            
            if (panel) {
                panel.style.display = panel.style.display === 'none' ? 'block' : 'none';
                btn.classList.toggle('active');
            }
        }

        function toggleMembersPanel() {
            const panel = document.getElementById('members-panel');
            const btn = document.getElementById('btn-members');
            const labelsPanel = document.getElementById('labels-panel');
            const labelsBtn = document.getElementById('btn-labels');
            
            if (labelsPanel) labelsPanel.style.display = 'none';
            if (labelsBtn) labelsBtn.classList.remove('active');
            
            if (panel) {
                panel.style.display = panel.style.display === 'none' ? 'block' : 'none';
                btn.classList.toggle('active');
            }
        }

        function toggleDatePicker() {
            const panel = document.getElementById('date-picker-panel');
            const btn = document.getElementById('btn-open-datepicker');
            
            if (panel) {
                panel.style.display = panel.style.display === 'none' ? 'block' : 'none';
                btn.classList.toggle('active');
            }
        }

        // Enhanced Member Search
        function searchMembers(query) {
            const members = document.querySelectorAll('.member-option');
            members.forEach(member => {
                const name = member.querySelector('.member-name').textContent.toLowerCase();
                const email = member.querySelector('.member-email').textContent.toLowerCase();
                const searchQuery = query.toLowerCase();
                
                if (name.includes(searchQuery) || email.includes(searchQuery)) {
                    member.style.display = 'flex';
                } else {
                    member.style.display = 'none';
                }
            });
        }

        // Enhanced Card Interactions
        function initializeCardInteractions() {
            // Add click handlers for cards
            document.addEventListener('click', function(e) {
                if (e.target.closest('.card')) {
                    const card = e.target.closest('.card');
                    if (!e.target.closest('.card-actions') && !e.target.closest('.card-action-btn')) {
                        openCardModal(card);
                    }
                }
            });

            // Add keyboard navigation
            document.addEventListener('keydown', function(e) {
                if (e.key === 'Enter' && e.target.closest('.card')) {
                    const card = e.target.closest('.card');
                    openCardModal(card);
                }
            });

            // Add touch support for mobile
            let touchStartTime = 0;
            document.addEventListener('touchstart', function(e) {
                if (e.target.closest('.card')) {
                    touchStartTime = Date.now();
                }
            });

            document.addEventListener('touchend', function(e) {
                if (e.target.closest('.card') && Date.now() - touchStartTime < 500) {
                    const card = e.target.closest('.card');
                    if (!e.target.closest('.card-actions') && !e.target.closest('.card-action-btn')) {
                        openCardModal(card);
                    }
                }
            });
        }

        function openCardModal(card) {
            const modal = document.getElementById('task-modal');
            const title = card.querySelector('.card-title');
            const cardId = card.dataset.cardId;
            
            // Populate card title
            if (title) {
                document.getElementById('task-title').textContent = title.textContent;
            }
            
            // Update card ID in modal
            const cardIdElement = document.querySelector('.card-id');
            if (cardIdElement && cardId) {
                cardIdElement.textContent = '#' + cardId;
            }
            
            // Update list status
            const listStatus = document.querySelector('.list-status span');
            const listTitle = card.closest('.board').querySelector('.board-title');
            if (listStatus && listTitle) {
                listStatus.textContent = listTitle.textContent;
            }
            
            // Populate card description
            const description = card.querySelector('.card-description');
            if (description) {
                // Update description in modal if there's a description field
                const modalDesc = document.getElementById('task-desc');
                if (modalDesc) {
                    modalDesc.value = description.textContent;
                }
            }
            
            // Populate due date
            const dueDate = card.querySelector('.card-due-date');
            if (dueDate) {
                const modalDueDate = document.getElementById('task-due-date');
                if (modalDueDate) {
                    // Extract date from due date text
                    const dateText = dueDate.textContent.trim();
                    if (dateText) {
                        // Convert date format if needed
                        modalDueDate.value = formatDateForInput(dateText);
                    }
                }
            }
            
            // Populate labels
            const labels = card.querySelectorAll('.card-label');
            if (labels.length > 0) {
                const selectedLabels = document.getElementById('selected-labels');
                if (selectedLabels) {
                    selectedLabels.innerHTML = '';
                    labels.forEach(label => {
                        const labelColor = label.className.split(' ').find(cls => cls !== 'card-label');
                        const labelElement = document.createElement('span');
                        labelElement.className = `selected-label ${labelColor}`;
                        labelElement.textContent = labelColor;
                        selectedLabels.appendChild(labelElement);
                    });
                }
            }
            
            // Populate members
            const members = card.querySelectorAll('.card-member');
            if (members.length > 0) {
                const selectedMembers = document.getElementById('selected-members');
                if (selectedMembers) {
                    selectedMembers.innerHTML = '';
                    members.forEach(member => {
                        const memberName = member.dataset.tooltip || member.textContent;
                        const memberElement = document.createElement('div');
                        memberElement.className = 'selected-member';
                        memberElement.innerHTML = `
                            <div class="member-avatar">${member.textContent}</div>
                            <span>${memberName}</span>
                            <button onclick="removeMember(this)">×</button>
                        `;
                        selectedMembers.appendChild(memberElement);
                    });
                }
            }
            
            // Populate priority
            const priority = card.querySelector('.card-priority');
            if (priority) {
                const priorityText = priority.textContent.toLowerCase();
                const priorityOptions = document.querySelectorAll('.priority-option');
                priorityOptions.forEach(option => {
                    option.classList.remove('active');
                    if (option.textContent.toLowerCase().includes(priorityText)) {
                        option.classList.add('active');
                    }
                });
            }
            
            // Show modal with animation
            modal.style.display = 'flex';
            document.body.style.overflow = 'hidden';
            
            // Add entrance animation
            modal.style.opacity = '0';
            modal.style.transform = 'scale(0.9)';
            setTimeout(() => {
                modal.style.transition = 'all 0.3s ease';
                modal.style.opacity = '1';
                modal.style.transform = 'scale(1)';
            }, 10);
        }

        function formatDateForInput(dateText) {
            // Convert date text to input format
            const date = new Date(dateText);
            if (!isNaN(date.getTime())) {
                return date.toISOString().split('T')[0];
            }
            return '';
        }

        function closeCardModal() {
            const modal = document.getElementById('task-modal');
            modal.style.transition = 'all 0.3s ease';
            modal.style.opacity = '0';
            modal.style.transform = 'scale(0.9)';
            
            setTimeout(() => {
                modal.style.display = 'none';
                document.body.style.overflow = 'auto';
            }, 300);
        }

        // Initialize enhanced interactions
        document.addEventListener('DOMContentLoaded', function() {
            initializeCardInteractions();
            initializeModalFunctionality();
            initializeButtonInteractions();
            
            // Add smooth scrolling to modal
            const modal = document.getElementById('task-modal');
            if (modal) {
                modal.addEventListener('click', function(e) {
                    if (e.target === modal) {
                        closeCardModal();
                    }
                });
            }
        });

        // Initialize Modal Functionality
        function initializeModalFunctionality() {
            // Close modal button
            const closeBtn = document.getElementById('closeModalButton');
            if (closeBtn) {
                closeBtn.addEventListener('click', closeCardModal);
            }

            // Initialize all interactive buttons
            const interactiveBtns = document.querySelectorAll('.interactive-btn');
            interactiveBtns.forEach(btn => {
                btn.addEventListener('click', function() {
                    // Remove active class from all buttons
                    interactiveBtns.forEach(b => b.classList.remove('active'));
                    // Add active class to clicked button
                    this.classList.add('active');
                });
            });

            // Initialize member search
            const memberSearch = document.getElementById('member-search');
            if (memberSearch) {
                memberSearch.addEventListener('input', function() {
                    searchMembers(this.value);
                });
            }

            // Initialize checklist functionality
            const newChecklistItem = document.getElementById('new-checklist-item');
            if (newChecklistItem) {
                newChecklistItem.addEventListener('keypress', function(e) {
                    if (e.key === 'Enter') {
                        addChecklistItem();
                    }
                });
            }

            // Initialize comment functionality
            const newComment = document.getElementById('new-comment');
            if (newComment) {
                newComment.addEventListener('keypress', function(e) {
                    if (e.key === 'Enter' && !e.shiftKey) {
                        e.preventDefault();
                        addComment();
                    }
                });
            }
        }

        // Initialize Button Interactions
        function initializeButtonInteractions() {
            // File input handling
            const fileInput = document.getElementById('fileInput');
            if (fileInput) {
                fileInput.addEventListener('change', function(e) {
                    const files = Array.from(e.target.files);
                    if (files.length > 0) {
                        showMessage(`Selected ${files.length} file(s)`, 'success');
                        // Handle file upload here
                    }
                });
            }

            // Title editing
            const taskTitle = document.getElementById('task-title');
            if (taskTitle) {
                taskTitle.addEventListener('blur', function() {
                    // Save title changes here
                    console.log('Title updated:', this.textContent);
                });
            }
        }

        // Enhanced Drag and Drop
        let draggedCard = null;
        let draggedOverBoard = null;
        let sourceListId = null;

        document.addEventListener('DOMContentLoaded', function() {
            initializeDragAndDrop();
            initializeAnimations();
            initializeInteractions();
        });

        function initializeDragAndDrop() {
            const cards = document.querySelectorAll('.card');
            const boards = document.querySelectorAll('.board');
            const boardCards = document.querySelectorAll('.board-cards');

            // Enhanced card drag events
            cards.forEach(card => {
                card.addEventListener('dragstart', handleDragStart);
                card.addEventListener('dragend', handleDragEnd);
                card.addEventListener('drag', handleDrag);
                card.addEventListener('dragenter', handleCardDragEnter);
                card.addEventListener('dragleave', handleCardDragLeave);
            });

            // Board drop zones
            boards.forEach(board => {
                board.addEventListener('dragover', handleDragOver);
                board.addEventListener('drop', handleDrop);
                board.addEventListener('dragenter', handleDragEnter);
                board.addEventListener('dragleave', handleDragLeave);
            });

            // Board cards containers
            boardCards.forEach(container => {
                container.addEventListener('dragover', handleDragOver);
                container.addEventListener('drop', handleDrop);
                container.addEventListener('dragenter', handleDragEnter);
                container.addEventListener('dragleave', handleDragLeave);
            });

            // Add sortable functionality within lists
            initializeSortableCards();
        }

        function initializeSortableCards() {
            const boardCards = document.querySelectorAll('.board-cards');
            
            boardCards.forEach(container => {
                container.addEventListener('dragover', function(e) {
                    e.preventDefault();
                    const afterElement = getDragAfterElement(container, e.clientY);
                    const dragging = document.querySelector('.dragging');
                    
                    if (afterElement == null) {
                        container.appendChild(dragging);
                    } else {
                        container.insertBefore(dragging, afterElement);
                    }
                });
            });
        }

        function getDragAfterElement(container, y) {
            const draggableElements = [...container.querySelectorAll('.card:not(.dragging)')];
            
            return draggableElements.reduce((closest, child) => {
                const box = child.getBoundingClientRect();
                const offset = y - box.top - box.height / 2;
                
                if (offset < 0 && offset > closest.offset) {
                    return { offset: offset, element: child };
                } else {
                    return closest;
                }
            }, { offset: Number.NEGATIVE_INFINITY }).element;
        }

        function handleDragStart(e) {
            draggedCard = this;
            sourceListId = this.closest('.board').getAttribute('data-list-id');
            this.classList.add('drag-start', 'dragging');
            e.dataTransfer.effectAllowed = 'move';
            e.dataTransfer.setData('text/html', this.outerHTML);
            
            // Add visual feedback
            this.style.opacity = '0.8';
            this.style.transform = 'rotate(5deg) scale(1.05)';
            this.style.zIndex = '1000';
            
            // Add drag ghost
            const ghost = this.cloneNode(true);
            ghost.style.opacity = '0.5';
            ghost.style.transform = 'rotate(5deg)';
            ghost.classList.add('drag-ghost');
            document.body.appendChild(ghost);
            e.dataTransfer.setDragImage(ghost, 0, 0);
            
            // Show drop zones
            document.querySelectorAll('.board, .board-cards').forEach(el => {
                el.classList.add('drop-zone-active');
            });
        }

        function handleDrag(e) {
            e.preventDefault();
            // Update drag position for visual feedback
            const cards = document.querySelectorAll('.card:not(.dragging)');
            cards.forEach(card => {
                const rect = card.getBoundingClientRect();
                const distance = Math.abs(e.clientY - rect.top - rect.height / 2);
                
                if (distance < 30) {
                    card.classList.add('drag-over');
                } else {
                    card.classList.remove('drag-over');
                }
            });
        }

        function handleCardDragEnter(e) {
            if (this !== draggedCard) {
                this.classList.add('card-drag-over');
            }
        }

        function handleCardDragLeave(e) {
            this.classList.remove('card-drag-over');
        }

        function handleDragEnd(e) {
            this.classList.remove('drag-start', 'dragging', 'card-drag-over');
            this.style.opacity = '1';
            this.style.transform = '';
            this.style.zIndex = '';
            draggedCard = null;
            sourceListId = null;
            
            // Remove drag ghost
            const ghost = document.querySelector('.drag-ghost');
            if (ghost) {
                ghost.remove();
            }
            
            // Remove all drag over classes
            document.querySelectorAll('.board, .board-cards, .card').forEach(el => {
                el.classList.remove('drag-over', 'drop-zone-active', 'card-drag-over');
            });
        }

        function handleDragOver(e) {
            e.preventDefault();
            e.dataTransfer.dropEffect = 'move';
        }

        function handleDragEnter(e) {
            e.preventDefault();
            this.classList.add('drag-over');
            draggedOverBoard = this;
        }

        function handleDragLeave(e) {
            if (!this.contains(e.relatedTarget)) {
                this.classList.remove('drag-over');
                draggedOverBoard = null;
            }
        }

        function handleDrop(e) {
            e.preventDefault();
            this.classList.remove('drag-over');
            
            if (draggedCard) {
                const targetContainer = this.classList.contains('board-cards') ? this : this.querySelector('.board-cards');
                const sourceContainer = draggedCard.closest('.board-cards');
                
                if (targetContainer && targetContainer !== sourceContainer) {
                    // Move card to new board
                    targetContainer.appendChild(draggedCard);
                    
                    // Add success animation
                    draggedCard.classList.add('success');
                    setTimeout(() => {
                        draggedCard.classList.remove('success');
                    }, 600);
                    
                    showMessage('Card moved successfully!', 'success');
                    
                    // Enhanced position update with comprehensive data
                    updateCardPositionsEnhanced(draggedCard, sourceContainer, targetContainer);
                }
            }
        }

        // function updateCardPosition(card, newContainer) {
        //     alert('updateCardPosition');
        //     const cardId = card.dataset.cardId;
        //     const newListId = newContainer.closest('.board').dataset.listId;
            
        //     // Send AJAX request to update card position
        //     $.ajax({
        //         type: 'POST',
        //         url: 'index.php?action=updateCardPositions&controller=card',
        //         data: { cardId: cardId, newListId: newListId, boardId: boardId},
        //         success: function(response) {
        //             const data = JSON.parse(response);
        //             if (data.status == true) {
        //                 showMessage('Card position updated successfully!', 'success');
        //             } else {
        //                 showMessage(data.message || 'Failed to update card position', 'error');
        //             }
        //         },
        //         error: function(xhr, status, error) {
        //             console.error('Error updating card position:', error);
        //             showMessage('Error updating card position', 'error');
        //         }
        //     });
        // }

        function updateCardPositionsEnhanced(movedCard, sourceContainer, targetContainer) {
            // Handle both jQuery objects and DOM elements
            const cardElement = movedCard.jquery ? movedCard[0] : movedCard;
            const sourceElement = sourceContainer.jquery ? sourceContainer[0] : sourceContainer;
            const targetElement = targetContainer.jquery ? targetContainer[0] : targetContainer;
            
            const cardId = cardElement.getAttribute('data-card-id');
            const targetListId = targetElement.closest('.board').getAttribute('data-list-id');
            const sourceListId = sourceElement.closest('.board').getAttribute('data-list-id');
            const boardId = document.querySelector('.dashboard').getAttribute('data-board-id');
            
            // Recalculate positions for both source and target lists
            const sourceList = document.querySelector(`.board[data-list-id="${sourceListId}"]`);
            const targetList = targetElement.closest('.board');

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
                    movedCardId: cardId,
                    boardId: boardId
                },
                success: function (response) {
                    if (response.success) {
                        alert(response.message);
                    } else {
                        alert(response.error);   
                    } 
                },
                error: function (xhr, status, error) {
                    alert(error);
                }
            });
        }

            // fetch('index.php', {
            //     method: 'POST',
            //     headers: {
            //         'Content-Type': 'application/x-www-form-urlencoded',
            //     },
            //     body: `action=moveCard&controller=card&cardId=${cardId}&newListId=${newListId}`
            // })
            // .then(response => response.json())
            // .then(data => {
            //     if (data.success) {
            //         console.log('Card position updated successfully');
            //     } else {
            //         console.error('Failed to update card position:', data.message);
            //         showMessage('Failed to update card position', 'error');
            //     }
            // })
            // .catch(error => {
            //     console.error('Error updating card position:', error);
            //     showMessage('Error updating card position', 'error');
            // });
        

        function initializeAnimations() {
            // Add entrance animations to cards and boards
            const cards = document.querySelectorAll('.card');
            const boards = document.querySelectorAll('.board');

            cards.forEach((card, index) => {
                card.style.animationDelay = `${index * 0.1}s`;
            });

            boards.forEach((board, index) => {
                board.style.animationDelay = `${index * 0.2}s`;
            });
        }

        function initializeInteractions() {
            // Add hover effects and interactions
            const cards = document.querySelectorAll('.card');
            const boards = document.querySelectorAll('.board');

            cards.forEach(card => {
                card.addEventListener('mouseenter', function() {
                    this.style.transform = 'translateY(-4px) scale(1.02)';
                });

                card.addEventListener('mouseleave', function() {
                    this.style.transform = 'translateY(0) scale(1)';
                });
            });

            boards.forEach(board => {
                board.addEventListener('mouseenter', function() {
                    this.style.transform = 'translateY(-4px)';
                });

                board.addEventListener('mouseleave', function() {
                    this.style.transform = 'translateY(0)';
                });
            });
        }

        // Enhanced Message System
        function showMessage(message, type = 'info') {
            // Remove existing messages
            const existingMessages = document.querySelectorAll('.toast-message');
            existingMessages.forEach(msg => msg.remove());

            // Create message element
            const messageEl = document.createElement('div');
            messageEl.className = `toast-message toast-${type}`;
            messageEl.innerHTML = `
                <div class="toast-content">
                    <i class="fas fa-${type === 'success' ? 'check-circle' : type === 'error' ? 'exclamation-circle' : 'info-circle'}"></i>
                    <span>${message}</span>
                </div>
                <button class="toast-close" onclick="this.parentElement.remove()">
                    <i class="fas fa-times"></i>
                </button>
            `;

            // Add styles
            messageEl.style.cssText = `
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
                font-family: 'Inter', sans-serif;
            `;

            document.body.appendChild(messageEl);

            // Auto remove after 5 seconds
            setTimeout(() => {
                if (messageEl.parentElement) {
                    messageEl.style.animation = 'slideOutRight 0.3s ease';
                    setTimeout(() => messageEl.remove(), 300);
                }
            }, 5000);
        }

        // Keyboard shortcuts
        document.addEventListener('keydown', function(e) {
            // Escape key to close modals
            if (e.key === 'Escape') {
                const modals = document.querySelectorAll('.modal');
                modals.forEach(modal => modal.style.display = 'none');
            }
            
            // Ctrl/Cmd + N for new card
            if ((e.ctrlKey || e.metaKey) && e.key === 'n') {
                e.preventDefault();
                OpenTaskModal();
            }
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
            
            .toast-message {
                font-family: 'Inter', sans-serif;
            }
            
            .toast-content {
                display: flex;
                align-items: center;
                gap: 8px;
                flex: 1;
            }
            
            .toast-close {
                background: none;
                border: none;
                color: white;
                cursor: pointer;
                padding: 4px;
                border-radius: 4px;
                transition: background 0.2s;
            }
            
            .toast-close:hover {
                background: rgba(255, 255, 255, 0.2);
            }
        `;
        document.head.appendChild(style);
    </script>

    <style>
        /* Enhanced Drag and Drop Styles */
        .card.dragging {
            opacity: 0.8;
            transform: rotate(5deg) scale(1.05);
            box-shadow: 0 20px 60px rgba(102, 126, 234, 0.4);
            z-index: 1000;
            border-color: #667eea;
            cursor: grabbing;
        }

        .card.dragging * {
            pointer-events: none;
        }

        .card.drag-over {
            transform: translateY(-8px) scale(1.02);
            box-shadow: 0 15px 50px rgba(102, 126, 234, 0.3);
            border-color: #667eea;
        }

        .card.card-drag-over {
            transform: translateY(-4px);
            border-color: #667eea;
            background: rgba(102, 126, 234, 0.05);
        }

        .board.drop-zone-active {
            background: rgba(102, 126, 234, 0.05);
            border: 2px dashed rgba(102, 126, 234, 0.3);
            border-radius: 16px;
        }

        .board-cards.drop-zone-active {
            background: rgba(102, 126, 234, 0.05);
            border: 2px dashed rgba(102, 126, 234, 0.3);
            border-radius: 8px;
            min-height: 100px;
        }

        .drag-ghost {
            position: absolute;
            top: -1000px;
            left: -1000px;
            pointer-events: none;
            z-index: 1001;
        }

        /* Enhanced Button Responsiveness */
        .interactive-btn {
            min-height: 44px;
            min-width: 44px;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            padding: 12px 16px;
            background: rgba(0, 0, 0, 0.05);
            border: 1px solid rgba(0, 0, 0, 0.1);
            border-radius: 8px;
            color: #666;
            cursor: pointer;
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
            font-size: 14px;
            font-weight: 500;
            touch-action: manipulation;
        }

        .interactive-btn:active {
            transform: scale(0.95);
        }

        .interactive-btn:focus {
            outline: 2px solid #667eea;
            outline-offset: 2px;
        }

        /* Mobile Touch Enhancements */
        @media (max-width: 768px) {
            .interactive-btn {
                min-height: 48px;
                padding: 16px;
                font-size: 16px;
            }

            .card {
                min-height: 80px;
                padding: 20px;
                gap: 12px;
            }

            .card-title {
                font-size: 18px;
                line-height: 1.3;
            }

            .card-description {
                font-size: 14px;
                max-height: 80px;
                -webkit-line-clamp: 4;
            }

            .card-meta {
                flex-direction: column;
                align-items: flex-start;
                gap: 12px;
            }

            .card-stats {
                width: 100%;
                justify-content: space-between;
            }

            .card-actions {
                opacity: 1;
                position: static;
                margin-top: 12px;
                justify-content: center;
                width: 100%;
            }

            .card-action-btn {
                width: 36px;
                height: 36px;
                font-size: 16px;
            }

            .card-labels {
                margin-bottom: 12px;
            }

            .card-members {
                margin-top: 8px;
            }
        }

        @media (max-width: 480px) {
            .interactive-btn {
                min-height: 52px;
                padding: 18px;
                font-size: 18px;
            }

            .button-layer {
                flex-direction: column;
                gap: 12px;
            }

            .card {
                min-height: 100px;
                padding: 24px;
                gap: 16px;
            }

            .card-title {
                font-size: 20px;
                line-height: 1.2;
            }

            .card-description {
                font-size: 15px;
                max-height: 100px;
                -webkit-line-clamp: 5;
            }

            .card-meta {
                gap: 16px;
            }

            .card-stats {
                flex-direction: column;
                align-items: flex-start;
                gap: 8px;
            }

            .card-priority {
                padding: 6px 12px;
                font-size: 12px;
            }

            .card-progress {
                height: 6px;
            }

            .card-attachment,
            .card-comment-count {
                padding: 4px 8px;
                font-size: 13px;
            }
        }

        /* Extra Small Screens */
        @media (max-width: 360px) {
            .card {
                padding: 20px;
                gap: 12px;
            }

            .card-title {
                font-size: 18px;
            }

            .card-description {
                font-size: 14px;
                max-height: 80px;
                -webkit-line-clamp: 4;
            }

            .card-meta {
                gap: 12px;
            }
        }

        /* Touch Device Optimizations */
        @media (hover: none) and (pointer: coarse) {
            .card:hover {
                transform: none;
            }

            .card:active {
                transform: scale(0.98);
            }

            .interactive-btn:hover {
                background: rgba(0, 0, 0, 0.05);
                transform: none;
            }

            .interactive-btn:active {
                background: rgba(102, 126, 234, 0.1);
                transform: scale(0.95);
            }
        }
    </style>

    <script>
        $(document).ready(function () {
            // Initialize all jQuery functionality
            initializeBoard();
            initializeResponsiveFeatures();
            initializeDynamicInteractions();
            initializeAjaxHandlers();
            initializeAnimations();
            loadAllCardLabels();
            
            // Task input toggle
            $('#toggleTaskInput').click(function () {
                const container = document.getElementById("taskInputContainer");
                container.classList.toggle("show");
                if (container.classList.contains("show")) {
                    document.getElementById("taskTitleInput").focus();
                }
            });
        });

        function loadAllCardLabels() {
            // Load labels for all cards on the board
            const cards = document.querySelectorAll('[data-card-id]');
            cards.forEach(card => {
                const cardId = card.getAttribute('data-card-id');
                if (cardId) {
                    loadCardLabelsForBoard(cardId);
                }
            });
        }

        function loadCardLabelsForBoard(cardId) {
            const cardElement = document.querySelector(`[data-card-id="${cardId}"]`);
            if (!cardElement) return;

            const cardLabelsContainer = cardElement.querySelector('.card-labels');
            if (!cardLabelsContainer) return;

            // Load from localStorage
            const savedLabels = localStorage.getItem(`card-labels-${cardId}`);
            if (savedLabels) {
                const labels = JSON.parse(savedLabels);
                cardLabelsContainer.innerHTML = '';
                labels.forEach(label => {
                    const labelSpan = document.createElement('span');
                    labelSpan.className = `card-label ${label.color}`;
                    labelSpan.textContent = label.name;
                    cardLabelsContainer.appendChild(labelSpan);
                });
            }
        }

        // Initialize Board with jQuery
        function initializeBoard() {
            // Enhanced card interactions
            $(document).on('click', '.card', function(e) {
                if (!$(e.target).closest('.card-actions, .card-action-btn').length) {
                    openCardModal($(this));
                }
            });

            // Card hover effects
            $('.card').hover(
                function() {
                    $(this).addClass('card-hover');
                    $(this).find('.card-actions').addClass('show');
                },
                function() {
                    $(this).removeClass('card-hover');
                    $(this).find('.card-actions').removeClass('show');
                }
            );

            // Card title editing
            $(document).on('dblclick', '.card-title', function() {
                const $title = $(this);
                const originalText = $title.text();
                
                $title.html(`<input type="text" value="${originalText}" class="card-title-edit">`);
                $title.find('.card-title-edit').focus().select();
                
                $title.find('.card-title-edit').on('blur keypress', function(e) {
                    if (e.type === 'keypress' && e.which !== 13) return;
                    
                    const newText = $(this).val().trim();
                    if (newText && newText !== originalText) {
                        $title.text(newText);
                        updateCardTitle($title.closest('.card'), newText);
                        showMessage('Card title updated', 'success');
                    } else {
                        $title.text(originalText);
                    }
                });
            });

            // Card priority changes
            $(document).on('click', '.card-priority', function() {
                const $priority = $(this);
                const currentPriority = $priority.text().toLowerCase();
                const priorities = ['low', 'medium', 'high'];
                const currentIndex = priorities.indexOf(currentPriority);
                const nextIndex = (currentIndex + 1) % priorities.length;
                const nextPriority = priorities[nextIndex];
                
                $priority.removeClass(currentPriority).addClass(nextPriority).text(nextPriority.charAt(0).toUpperCase() + nextPriority.slice(1));
                updateCardPriority($priority.closest('.card'), nextPriority);
                showMessage(`Priority changed to ${nextPriority}`, 'success');
            });

            // Card member interactions
            $(document).on('click', '.card-member', function() {
                const $member = $(this);
                const memberName = $member.data('tooltip');
                
                // Show member details tooltip
                showMemberTooltip($member, memberName);
            });

            // Card attachment interactions
            $(document).on('click', '.card-attachment', function() {
                const $attachment = $(this);
                const fileCount = $attachment.text().match(/\d+/)[0];
                showMessage(`${fileCount} attachments available`, 'info');
            });

            // Card comment interactions
            $(document).on('click', '.card-comment-count', function() {
                const $comment = $(this);
                const commentCount = $comment.text().match(/\d+/)[0];
                showMessage(`${commentCount} comments available`, 'info');
            });

            // Enhanced drag and drop with jQuery (with fallback)
            if (typeof $.fn.draggable !== 'undefined') {
                $('.card').draggable({
                    helper: 'clone',
                    opacity: 0.8,
                    revert: 'invalid',
                    start: function(event, ui) {
                        $(this).addClass('dragging');
                        $('.board, .board-cards').addClass('drop-zone-active');
                    },
                    stop: function(event, ui) {
                        $(this).removeClass('dragging');
                        $('.board, .board-cards').removeClass('drop-zone-active');
                    }
                });

                $('.board, .board-cards').droppable({
                    accept: '.card',
                    hoverClass: 'drag-over',
                    drop: function(event, ui) {
                        const card = ui.draggable;
                        const targetContainer = $(this);
                        const sourceContainer = card.closest('.board-cards');
                        
                        if (targetContainer[0] !== sourceContainer[0]) {
                            targetContainer.append(card);
                            updateCardPositionsEnhanced(card, sourceContainer, targetContainer);
                            showMessage('Card moved successfully!', 'success');
                        }
                    }
                });

                // Sortable cards within lists
                $('.board-cards').sortable({
                    connectWith: '.board-cards',
                    placeholder: 'card-placeholder',
                    helper: 'clone',
                    opacity: 0.8,
                    start: function(event, ui) {
                        ui.placeholder.height(ui.item.height());
                    },
                    update: function(event, ui) {
                        if (ui.sender) {
                            // Get source and target containers from the sortable event
                            const sourceContainer = ui.sender[0];
                            const targetContainer = this;
                            updateCardPositionsEnhanced(ui.item[0], sourceContainer, targetContainer);
                        }
                    }
                });
            } else {
                console.warn('jQuery UI not loaded, using fallback drag and drop');
                initializeFallbackDragAndDrop();
            }
        }

        // Fallback drag and drop implementation
        function initializeFallbackDragAndDrop() {
            let draggedCard = null;
            let sourceListId = null;
            
            $('.card').on('dragstart', function(e) {
                draggedCard = $(this);
                sourceListId = $(this).closest('.board').attr('data-list-id');
                $(this).addClass('dragging');
                $('.board, .board-cards').addClass('drop-zone-active');
            });
            
            $('.card').on('dragend', function(e) {
                $(this).removeClass('dragging');
                $('.board, .board-cards').removeClass('drop-zone-active');
                draggedCard = null;
                sourceListId = null;
            });
            
            $('.board, .board-cards').on('dragover', function(e) {
                e.preventDefault();
                $(this).addClass('drag-over');
            });
            
            $('.board, .board-cards').on('dragleave', function(e) {
                $(this).removeClass('drag-over');
            });
            
            $('.board, .board-cards').on('drop', function(e) {
                e.preventDefault();
                $(this).removeClass('drag-over');
                
                if (draggedCard && draggedCard.length) {
                    const targetContainer = $(this);
                    const sourceContainer = draggedCard.closest('.board-cards');
                    
                    if (targetContainer[0] !== sourceContainer[0]) {
                        targetContainer.append(draggedCard);
                        updateCardPositionsEnhanced(draggedCard[0], sourceContainer[0], targetContainer[0]);
                        showMessage('Card moved successfully!', 'success');
                    }
                }
            });
        }

        // Initialize Responsive Features
        function initializeResponsiveFeatures() {
            // Responsive button interactions
            $('.interactive-btn').on('click', function() {
                const $this = $(this);
                const panelId = $this.attr('onclick')?.match(/toggle(\w+)Panel/)?.[1];
                
                if (panelId) {
                    const panel = $('#' + panelId.toLowerCase() + '-panel');
                    const isVisible = panel.is(':visible');
                    
                    // Close all other panels
                    $('.dynamic-panel').not(panel).slideUp(300);
                    $('.interactive-btn').removeClass('active');
                    
                    // Toggle current panel
                    if (isVisible) {
                        panel.slideUp(300);
                    } else {
                        panel.slideDown(300);
                        $this.addClass('active');
                    }
                }
            });

            // Responsive modal handling
            $(window).on('resize', function() {
                adjustModalForScreen();
            });

            // Touch device optimizations
            if ('ontouchstart' in window) {
                $('.card').on('touchstart', function() {
                    $(this).addClass('touch-active');
                }).on('touchend', function() {
                    $(this).removeClass('touch-active');
                });
            }
        }

        // Initialize Dynamic Interactions
        function initializeDynamicInteractions() {
            // Dynamic member search
            $('#member-search').on('input', function() {
                const query = $(this).val().toLowerCase();
                $('.member-option').each(function() {
                    const name = $(this).find('.member-name').text().toLowerCase();
                    const email = $(this).find('.member-email').text().toLowerCase();
                    
                    if (name.includes(query) || email.includes(query)) {
                        $(this).show().addClass('search-match');
                    } else {
                        $(this).hide().removeClass('search-match');
                    }
                });
            });

            // Dynamic label management
            $('.label-option').on('click', function() {
                const color = $(this).data('color');
                const name = $(this).find('.label-name').text();
                addLabelToCard(color, name);
            });

            // Dynamic member management
            $('.member-option').on('click', function() {
                const name = $(this).find('.member-name').text();
                const email = $(this).find('.member-email').text();
                const avatar = $(this).find('.member-avatar').text();
                addMemberToCard(name, email, avatar);
            });

            // Dynamic checklist management
            $('#new-checklist-item').on('keypress', function(e) {
                if (e.which === 13) {
                    addChecklistItem();
                }
            });

            // Dynamic comment management
            $('#new-comment').on('keypress', function(e) {
                if (e.which === 13 && !e.shiftKey) {
                    e.preventDefault();
                    addComment();
                }
            });

            // Dynamic priority selection
            $('.priority-option').on('click', function() {
                $('.priority-option').removeClass('active');
                $(this).addClass('active');
                const priority = $(this).data('priority') || $(this).text().toLowerCase();
                updateCardPriority(priority);
            });
        }

        // Initialize AJAX Handlers
        function initializeAjaxHandlers() {
            // Auto-save functionality
            let saveTimeout;
            $('.task-title, #task-desc, #task-due-date').on('input', function() {
                clearTimeout(saveTimeout);
                saveTimeout = setTimeout(function() {
                    autoSaveCard();
                }, 2000);
            });

            // Real-time updates
            setInterval(function() {
                checkForUpdates();
            }, 30000); // Check every 30 seconds
        }

        // Initialize Animations
        function initializeAnimations() {
            // Card entrance animations
            $('.card').each(function(index) {
                $(this).css({
                    'opacity': '0',
                    'transform': 'translateY(20px)'
                }).delay(index * 100).animate({
                    'opacity': '1'
                }, 300).css('transform', 'translateY(0)');
            });

            // Board entrance animations
            $('.board').each(function(index) {
                $(this).css({
                    'opacity': '0',
                    'transform': 'translateX(-50px)'
                }).delay(index * 200).animate({
                    'opacity': '1'
                }, 400).css('transform', 'translateX(0)');
            });

            // Hover animations
            $('.card').hover(
                function() {
                    $(this).animate({
                        'transform': 'translateY(-4px) scale(1.02)'
                    }, 200);
                },
                function() {
                    $(this).animate({
                        'transform': 'translateY(0) scale(1)'
                    }, 200);
                }
            );
        }

        // Enhanced Modal Functions with jQuery
        function openCardModal(card) {
            const $card = $(card);
            const $modal = $('#task-modal');
            
            // Populate modal with card data
            const title = $card.find('.card-title').text();
            const cardId = $card.data('card-id');
            const listTitle = $card.closest('.board').find('.board-title').text();
            
            $('#task-title').text(title);
            $('.card-id').text('#' + cardId);
            $('.list-status span').text(listTitle);
            
            // Populate description
            const description = $card.find('.card-description').text();
            if (description) {
                $('#task-desc').val(description);
            }
            
            // Populate due date
            const dueDate = $card.find('.card-due-date').text().trim();
            if (dueDate) {
                $('#task-due-date').val(formatDateForInput(dueDate));
            }
            
            // Populate labels
            populateLabels($card);
            
            // Populate members
            populateMembers($card);
            
            // Populate priority
            populatePriority($card);
            
            // Show modal with animation
            $modal.fadeIn(300).css({
                'opacity': '0',
                'transform': 'scale(0.9)'
            }).animate({
                'opacity': '1'
            }, 300).css('transform', 'scale(1)');
            
            $('body').addClass('modal-open');
        }

        function closeCardModal() {
            const $modal = $('#task-modal');
            $modal.animate({
                'opacity': '0'
            }, 300).css('transform', 'scale(0.9)').fadeOut(300);
            $('body').removeClass('modal-open');
        }

        // Dynamic Content Management
        function addLabelToCard(color, name) {
            const $selectedLabels = $('#selected-labels');
            const labelHtml = `
                <span class="selected-label ${color}" data-color="${color}">
                    ${name}
                    <button onclick="removeLabel(this)">×</button>
                </span>
            `;
            $selectedLabels.append(labelHtml);
            showMessage(`Label "${name}" added`, 'success');
        }

        function addMemberToCard(name, email, avatar) {
            const $selectedMembers = $('#selected-members');
            const memberHtml = `
                <div class="selected-member" data-name="${name}">
                    <div class="member-avatar">${avatar}</div>
                    <span>${name}</span>
                    <button onclick="removeMember(this)">×</button>
                </div>
            `;
            $selectedMembers.append(memberHtml);
            showMessage(`Member "${name}" added`, 'success');
        }

        function addChecklistItem() {
            const $input = $('#new-checklist-item');
            const text = $input.val().trim();
            
            if (text) {
                const itemId = 'check' + Date.now();
                const itemHtml = `
                    <div class="checklist-item">
                        <input type="checkbox" id="${itemId}">
                        <label for="${itemId}">${text}</label>
                        <button class="remove-item" onclick="removeChecklistItem(this)">
                            <i class="fas fa-times"></i>
                        </button>
                    </div>
                `;
                
                $('.checklist-container').append(itemHtml);
                $input.val('');
                showMessage('Checklist item added', 'success');
            }
        }

        function addComment() {
            const $input = $('#new-comment');
            const text = $input.val().trim();
            
            if (text) {
                const commentHtml = `
                    <div class="comment-item">
                        <div class="comment-avatar">You</div>
                        <div class="comment-content">
                            <div class="comment-header">
                                <span class="comment-author">You</span>
                                <span class="comment-time">Just now</span>
                            </div>
                            <div class="comment-text">${text}</div>
                        </div>
                    </div>
                `;
                
                $('.comments-container').append(commentHtml);
                $input.val('');
                showMessage('Comment added', 'success');
            }
        }

        // AJAX Functions
        // function updateCardPosition(card, container) {
        //     const cardId = $(card).data('card-id');
        //     const newListId = container.closest('.board').data('list-id');
            
        //     $.ajax({
        //         url: 'index.php',
        //         method: 'POST',
        //         data: {
        //             action: 'moveCard',
        //             controller: 'card',
        //             cardId: cardId,
        //             newListId: newListId
        //         },
        //         success: function(response) {
        //             if (response.success) {
        //                 console.log('Card position updated successfully');
        //             } else {
        //                 showMessage('Failed to update card position', 'error');
        //             }
        //         },
        //         error: function() {
        //             showMessage('Error updating card position', 'error');
        //         }
        //     });
        // }

        // Card-specific AJAX functions
        function updateCardTitle(card, newTitle) {
            const cardId = $(card).data('card-id');
            
            $.ajax({
                url: 'index.php',
                method: 'POST',
                data: {
                    action: 'updateCardTitle',
                    controller: 'card',
                    cardId: cardId,
                    title: newTitle
                },
                success: function(response) {
                    if (response.success) {
                        console.log('Card title updated successfully');
                    } else {
                        showMessage('Failed to update card title', 'error');
                    }
                },
                error: function() {
                    showMessage('Error updating card title', 'error');
                }
            });
        }

        function updateCardPriority(card, priority) {
            const cardId = $(card).data('card-id');
            
            $.ajax({
                url: 'index.php',
                method: 'POST',
                data: {
                    action: 'updateCardPriority',
                    controller: 'card',
                    cardId: cardId,
                    priority: priority
                },
                success: function(response) {
                    if (response.success) {
                        console.log('Card priority updated successfully');
                    } else {
                        showMessage('Failed to update card priority', 'error');
                    }
                },
                error: function() {
                    showMessage('Error updating card priority', 'error');
                }
            });
        }

        function showMemberTooltip($member, memberName) {
            // Remove existing tooltips
            $('.member-tooltip').remove();
            
            const tooltip = $(`
                <div class="member-tooltip">
                    <div class="member-tooltip-content">
                        <div class="member-avatar-large">${memberName.charAt(0).toUpperCase()}</div>
                        <div class="member-info">
                            <div class="member-name">${memberName}</div>
                            <div class="member-role">Team Member</div>
                        </div>
                    </div>
                </div>
            `);
            
            $('body').append(tooltip);
            
            const memberOffset = $member.offset();
            const tooltipWidth = tooltip.outerWidth();
            const tooltipHeight = tooltip.outerHeight();
            
            tooltip.css({
                position: 'absolute',
                top: memberOffset.top - tooltipHeight - 10,
                left: memberOffset.left - (tooltipWidth / 2) + ($member.outerWidth() / 2),
                zIndex: 1000,
                opacity: 0,
                transform: 'translateY(10px)'
            });
            
            tooltip.animate({
                opacity: 1,
                transform: 'translateY(0)'
            }, 200);
            
            // Auto remove after 3 seconds
            setTimeout(() => {
                tooltip.animate({
                    opacity: 0,
                    transform: 'translateY(10px)'
                }, 200, function() {
                    tooltip.remove();
                });
            }, 3000);
        }

        function autoSaveCard() {
            const cardData = {
                title: $('#task-title').text(),
                description: $('#task-desc').val(),
                dueDate: $('#task-due-date').val(),
                labels: getSelectedLabels(),
                members: getSelectedMembers(),
                priority: getSelectedPriority()
            };
            
            $.ajax({
                url: 'index.php',
                method: 'POST',
                data: {
                    action: 'updateCard',
                    controller: 'card',
                    ...cardData
                },
                success: function(response) {
                    if (response.success) {
                        console.log('Card auto-saved');
                    }
                }
            });
        }

        function checkForUpdates() {
            $.ajax({
                url: 'index.php',
                method: 'GET',
                data: {
                    action: 'checkUpdates',
                    controller: 'board'
                },
                success: function(response) {
                    if (response.hasUpdates) {
                        showMessage('Board updated', 'info');
                        // Refresh board content
                        location.reload();
                    }
                }
            });
        }

        // Utility Functions
        function getSelectedLabels() {
            const labels = [];
            $('#selected-labels .selected-label').each(function() {
                labels.push($(this).data('color'));
            });
            return labels;
        }

        function getSelectedMembers() {
            const members = [];
            $('#selected-members .selected-member').each(function() {
                members.push($(this).data('name'));
            });
            return members;
        }

        function getSelectedPriority() {
            return $('.priority-option.active').data('priority') || 'medium';
        }

        function populateLabels($card) {
            const $selectedLabels = $('#selected-labels');
            $selectedLabels.empty();
            
            $card.find('.card-label').each(function() {
                const color = $(this).attr('class').split(' ').find(cls => cls !== 'card-label');
                addLabelToCard(color, color);
            });
        }

        function populateMembers($card) {
            const $selectedMembers = $('#selected-members');
            $selectedMembers.empty();
            
            $card.find('.card-member').each(function() {
                const name = $(this).data('tooltip') || $(this).text();
                const avatar = $(this).text();
                addMemberToCard(name, '', avatar);
            });
        }

        function populatePriority($card) {
            const priority = $card.find('.card-priority').text().toLowerCase();
            $('.priority-option').removeClass('active');
            $(`.priority-option:contains("${priority}")`).addClass('active');
        }

        function adjustModalForScreen() {
            const $modal = $('#task-modal');
            const windowWidth = $(window).width();
            
            if (windowWidth < 768) {
                $modal.css({
                    'width': '100%',
                    'height': '100vh',
                    'margin': '0',
                    'border-radius': '0'
                });
            } else {
                $modal.css({
                    'width': '90%',
                    'height': 'auto',
                    'margin': '20px',
                    'border-radius': '16px'
                });
            }
        }

        // Enhanced Message System with jQuery
        function showMessage(message, type = 'info') {
            $('.toast-message').remove();
            
            const messageHtml = `
                <div class="toast-message toast-${type}">
                    <div class="toast-content">
                        <i class="fas fa-${type === 'success' ? 'check-circle' : type === 'error' ? 'exclamation-circle' : 'info-circle'}"></i>
                        <span>${message}</span>
                    </div>
                    <button class="toast-close">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
            `;
            
            const $message = $(messageHtml);
            $('body').append($message);
            
            $message.css({
                'position': 'fixed',
                'top': '18px',
                'right': '365px',
                'background': type === 'success' ? '#10b981' : type === 'error' ? '#ef4444' : '#3b82f6',
                'color': 'white',
                'padding': '16px 20px',
                'border-radius': '12px',
                'box-shadow': '0 10px 40px rgba(0, 0, 0, 0.2)',
                'z-index': '3000',
                'max-width': '400px',
                'opacity': '0',
                'transform': 'translateX(100%)'
            });
            
            $message.animate({
                'opacity': '1',
                'transform': 'translateX(0)'
            }, 300);
            
            //Auto remove after 5 seconds
            setTimeout(function() {
                $message.animate({
                    'opacity': '0',
                    'transform': 'translateX(100%)'
                }, 300, function() {
                    $message.remove();
                });
            }, 5000);
            
            // Close button
            $message.find('.toast-close').on('click', function() {
                $message.animate({
                    'opacity': '0',
                    'transform': 'translateX(100%)'
                }, 300, function() {
                    $message.remove();
                });
            });
        }

        // Additional jQuery UI enhancements
        $(document).ready(function() {
            // Initialize tooltips (with fallback)
            if (typeof $.fn.tooltip !== 'undefined') {
                $('[data-tooltip]').tooltip();
            } else {
                // Fallback tooltip implementation
                $('[data-tooltip]').hover(
                    function() {
                        const tooltip = $(this).data('tooltip');
                        if (tooltip) {
                            $(this).attr('title', tooltip);
                        }
                    },
                    function() {
                        $(this).removeAttr('title');
                    }
                );
            }
            
            // Initialize datepicker (with fallback)
            if (typeof $.fn.datepicker !== 'undefined') {
                $('#task-due-date').datepicker({
                    dateFormat: 'yy-mm-dd',
                    showAnim: 'slideDown'
                });
            } else {
                // Fallback to HTML5 date input
                $('#task-due-date').attr('type', 'date');
            }
            
            // Initialize autocomplete for member search (with fallback)
            if (typeof $.fn.autocomplete !== 'undefined') {
                $('#member-search').autocomplete({
                    source: function(request, response) {
                        const members = [];
                        $('.member-option').each(function() {
                            const name = $(this).find('.member-name').text();
                            const email = $(this).find('.member-email').text();
                            if (name.toLowerCase().includes(request.term.toLowerCase()) || 
                                email.toLowerCase().includes(request.term.toLowerCase())) {
                                members.push({ label: name, value: name });
                            }
                        });
                        response(members);
                    },
                    select: function(event, ui) {
                        $(this).val(ui.item.value);
                        return false;
                    }
                });
            } else {
                // Fallback search functionality
                $('#member-search').on('input', function() {
                    const query = $(this).val().toLowerCase();
                    $('.member-option').each(function() {
                        const name = $(this).find('.member-name').text().toLowerCase();
                        const email = $(this).find('.member-email').text().toLowerCase();
                        
                        if (name.includes(query) || email.includes(query)) {
                            $(this).show();
                        } else {
                            $(this).hide();
                        }
                    });
                });
            }
        });
    </script>
</body>
</html>
    