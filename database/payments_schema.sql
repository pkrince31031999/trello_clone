-- Authorize.Net Payment Integration Database Schema
-- This file contains the SQL statements to create the payments table

-- Create payments table
CREATE TABLE IF NOT EXISTS payments (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    amount DECIMAL(10, 2) NOT NULL,
    currency VARCHAR(3) DEFAULT 'USD',
    status ENUM('pending', 'completed', 'failed', 'refunded', 'cancelled') DEFAULT 'pending',
    transaction_id VARCHAR(255) UNIQUE NOT NULL,
    authorize_net_transaction_id VARCHAR(255) NULL,
    payment_method VARCHAR(50) DEFAULT 'creditCard',
    description TEXT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    
    -- Indexes for better performance
    INDEX idx_user_id (user_id),
    INDEX idx_status (status),
    INDEX idx_transaction_id (transaction_id),
    INDEX idx_authorize_net_id (authorize_net_transaction_id),
    INDEX idx_created_at (created_at),
    
    -- Foreign key constraint (assuming users table exists)
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Create payment_logs table for audit trail
CREATE TABLE IF NOT EXISTS payment_logs (
    id INT AUTO_INCREMENT PRIMARY KEY,
    payment_id INT NOT NULL,
    action VARCHAR(50) NOT NULL,
    old_status VARCHAR(50) NULL,
    new_status VARCHAR(50) NULL,
    details TEXT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    
    INDEX idx_payment_id (payment_id),
    INDEX idx_action (action),
    INDEX idx_created_at (created_at),
    
    FOREIGN KEY (payment_id) REFERENCES payments(id) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Create payment_methods table for storing different payment methods
CREATE TABLE IF NOT EXISTS payment_methods (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    method_type ENUM('creditCard', 'bankAccount', 'paypal') NOT NULL,
    last_four VARCHAR(4) NULL,
    card_type VARCHAR(20) NULL,
    expiry_month TINYINT NULL,
    expiry_year SMALLINT NULL,
    is_default BOOLEAN DEFAULT FALSE,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    
    INDEX idx_user_id (user_id),
    INDEX idx_method_type (method_type),
    INDEX idx_is_default (is_default),
    
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Create subscription_plans table for recurring payments
CREATE TABLE IF NOT EXISTS subscription_plans (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    description TEXT NULL,
    amount DECIMAL(10, 2) NOT NULL,
    currency VARCHAR(3) DEFAULT 'USD',
    billing_cycle ENUM('monthly', 'yearly') NOT NULL,
    is_active BOOLEAN DEFAULT TRUE,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    
    INDEX idx_is_active (is_active),
    INDEX idx_billing_cycle (billing_cycle)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Create user_subscriptions table for tracking user subscriptions
CREATE TABLE IF NOT EXISTS user_subscriptions (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    plan_id INT NOT NULL,
    status ENUM('active', 'cancelled', 'expired', 'suspended') DEFAULT 'active',
    start_date DATE NOT NULL,
    end_date DATE NULL,
    next_billing_date DATE NULL,
    payment_method_id INT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    
    INDEX idx_user_id (user_id),
    INDEX idx_plan_id (plan_id),
    INDEX idx_status (status),
    INDEX idx_next_billing (next_billing_date),
    
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE,
    FOREIGN KEY (plan_id) REFERENCES subscription_plans(id) ON DELETE CASCADE,
    FOREIGN KEY (payment_method_id) REFERENCES payment_methods(id) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Insert sample subscription plans
INSERT INTO subscription_plans (name, description, amount, currency, billing_cycle, is_active) VALUES
('Basic Plan', 'Basic features for individual users', 9.99, 'USD', 'monthly', TRUE),
('Pro Plan', 'Advanced features for power users', 19.99, 'USD', 'monthly', TRUE),
('Enterprise Plan', 'Full features for teams', 49.99, 'USD', 'monthly', TRUE),
('Basic Annual', 'Basic plan with annual discount', 99.99, 'USD', 'yearly', TRUE),
('Pro Annual', 'Pro plan with annual discount', 199.99, 'USD', 'yearly', TRUE);

-- Create stored procedure for logging payment status changes
DELIMITER //
CREATE PROCEDURE LogPaymentStatusChange(
    IN p_payment_id INT,
    IN p_action VARCHAR(50),
    IN p_old_status VARCHAR(50),
    IN p_new_status VARCHAR(50),
    IN p_details TEXT
)
BEGIN
    INSERT INTO payment_logs (payment_id, action, old_status, new_status, details)
    VALUES (p_payment_id, p_action, p_old_status, p_new_status, p_details);
END //
DELIMITER ;

-- Create trigger to automatically log payment status changes
DELIMITER //
CREATE TRIGGER payment_status_change_trigger
    AFTER UPDATE ON payments
    FOR EACH ROW
BEGIN
    IF OLD.status != NEW.status THEN
        CALL LogPaymentStatusChange(
            NEW.id,
            'status_change',
            OLD.status,
            NEW.status,
            CONCAT('Status changed from ', OLD.status, ' to ', NEW.status)
        );
    END IF;
END //
DELIMITER ;

-- Create view for payment summary
CREATE VIEW payment_summary AS
SELECT 
    p.id,
    p.user_id,
    u.username,
    p.amount,
    p.currency,
    p.status,
    p.transaction_id,
    p.payment_method,
    p.description,
    p.created_at,
    p.updated_at
FROM payments p
LEFT JOIN users u ON p.user_id = u.id
ORDER BY p.created_at DESC;

-- Create view for monthly payment statistics
CREATE VIEW monthly_payment_stats AS
SELECT 
    DATE_FORMAT(created_at, '%Y-%m') as month,
    COUNT(*) as total_payments,
    SUM(CASE WHEN status = 'completed' THEN 1 ELSE 0 END) as successful_payments,
    SUM(CASE WHEN status = 'failed' THEN 1 ELSE 0 END) as failed_payments,
    SUM(CASE WHEN status = 'completed' THEN amount ELSE 0 END) as total_revenue,
    AVG(CASE WHEN status = 'completed' THEN amount ELSE NULL END) as average_payment
FROM payments
GROUP BY DATE_FORMAT(created_at, '%Y-%m')
ORDER BY month DESC;

