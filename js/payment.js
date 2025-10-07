/**
 * Payment JavaScript functionality
 * Handles client-side payment processing and UI interactions
 */

class PaymentManager {
    constructor() {
        this.apiBaseUrl = 'index.php?controller=payment';
        this.isProcessing = false;
        this.init();
    }
    
    init() {
        this.bindEvents();
        this.setupFormValidation();
    }
    
    bindEvents() {
        // Card number formatting
        const cardNumberInput = document.getElementById('card_number');
        if (cardNumberInput) {
            cardNumberInput.addEventListener('input', this.formatCardNumber.bind(this));
        }
        
        // Expiry date formatting
        const expiryInput = document.getElementById('expiry_date');
        if (expiryInput) {
            expiryInput.addEventListener('input', this.formatExpiryDate.bind(this));
        }
        
        // CVV formatting
        const cvvInput = document.getElementById('cvv');
        if (cvvInput) {
            cvvInput.addEventListener('input', this.formatCVV.bind(this));
        }
        
        // Form submission
        const paymentForm = document.getElementById('paymentForm');
        if (paymentForm) {
            paymentForm.addEventListener('submit', this.handlePaymentSubmission.bind(this));
        }
        
        // Refund buttons
        document.addEventListener('click', this.handleRefundClick.bind(this));
    }
    
    formatCardNumber(event) {
        let value = event.target.value.replace(/\s/g, '').replace(/[^0-9]/gi, '');
        let formattedValue = value.match(/.{1,4}/g)?.join(' ') || value;
        
        // Limit to 16 digits
        if (value.length > 16) {
            value = value.substring(0, 16);
            formattedValue = value.match(/.{1,4}/g)?.join(' ') || value;
        }
        
        event.target.value = formattedValue;
    }
    
    formatExpiryDate(event) {
        let value = event.target.value.replace(/\D/g, '');
        
        if (value.length >= 2) {
            const month = value.substring(0, 2);
            const year = value.substring(2, 4);
            
            // Validate month
            if (parseInt(month) > 12) {
                value = '12' + value.substring(2);
            }
            
            if (value.length >= 2) {
                value = month + '/' + year;
            }
        }
        
        event.target.value = value;
    }
    
    formatCVV(event) {
        event.target.value = event.target.value.replace(/[^0-9]/g, '');
        
        // Limit CVV length
        if (event.target.value.length > 4) {
            event.target.value = event.target.value.substring(0, 4);
        }
    }
    
    setupFormValidation() {
        const form = document.getElementById('paymentForm');
        if (!form) return;
        
        const inputs = form.querySelectorAll('input[required]');
        inputs.forEach(input => {
            input.addEventListener('blur', this.validateField.bind(this));
            input.addEventListener('input', this.clearFieldError.bind(this));
        });
    }
    
    validateField(event) {
        const field = event.target;
        const value = field.value.trim();
        
        this.clearFieldError(event);
        
        if (!value) {
            this.showFieldError(field, 'This field is required');
            return false;
        }
        
        // Specific validations
        switch (field.name) {
            case 'card_number':
                if (!this.validateCardNumber(value)) {
                    this.showFieldError(field, 'Please enter a valid card number');
                    return false;
                }
                break;
            case 'expiry_date':
                if (!this.validateExpiryDate(value)) {
                    this.showFieldError(field, 'Please enter a valid expiry date (MM/YY)');
                    return false;
                }
                break;
            case 'cvv':
                if (!this.validateCVV(value)) {
                    this.showFieldError(field, 'Please enter a valid CVV');
                    return false;
                }
                break;
            case 'zip':
                if (!this.validateZIP(value)) {
                    this.showFieldError(field, 'Please enter a valid ZIP code');
                    return false;
                }
                break;
        }
        
        return true;
    }
    
    validateCardNumber(cardNumber) {
        const cleanNumber = cardNumber.replace(/\s/g, '');
        return /^\d{13,19}$/.test(cleanNumber) && this.luhnCheck(cleanNumber);
    }
    
    validateExpiryDate(expiry) {
        const regex = /^(0[1-9]|1[0-2])\/\d{2}$/;
        if (!regex.test(expiry)) return false;
        
        const [month, year] = expiry.split('/');
        const currentDate = new Date();
        const currentYear = currentDate.getFullYear() % 100;
        const currentMonth = currentDate.getMonth() + 1;
        
        const expYear = parseInt(year) + 2000;
        const expMonth = parseInt(month);
        
        if (expYear < currentDate.getFullYear() || 
            (expYear === currentDate.getFullYear() && expMonth < currentMonth)) {
            return false;
        }
        
        return true;
    }
    
    validateCVV(cvv) {
        return /^\d{3,4}$/.test(cvv);
    }
    
    validateZIP(zip) {
        return /^\d{5}(-\d{4})?$/.test(zip);
    }
    
    luhnCheck(cardNumber) {
        let sum = 0;
        let isEven = false;
        
        for (let i = cardNumber.length - 1; i >= 0; i--) {
            let digit = parseInt(cardNumber.charAt(i));
            
            if (isEven) {
                digit *= 2;
                if (digit > 9) {
                    digit -= 9;
                }
            }
            
            sum += digit;
            isEven = !isEven;
        }
        
        return sum % 10 === 0;
    }
    
    showFieldError(field, message) {
        this.clearFieldError({ target: field });
        
        const errorDiv = document.createElement('div');
        errorDiv.className = 'field-error';
        errorDiv.textContent = message;
        errorDiv.style.color = '#d63031';
        errorDiv.style.fontSize = '12px';
        errorDiv.style.marginTop = '5px';
        
        field.parentNode.appendChild(errorDiv);
        field.style.borderColor = '#d63031';
    }
    
    clearFieldError(event) {
        const field = event.target;
        const errorDiv = field.parentNode.querySelector('.field-error');
        
        if (errorDiv) {
            errorDiv.remove();
        }
        
        field.style.borderColor = '';
    }
    
    async handlePaymentSubmission(event) {
        event.preventDefault();
        
        if (this.isProcessing) return;
        
        const form = event.target;
        const formData = new FormData(form);
        
        // Validate all fields
        const isValid = this.validateForm(form);
        if (!isValid) {
            this.showError('Please correct the errors in the form');
            return;
        }
        
        this.setProcessingState(true);
        this.clearMessages();
        
        try {
            // Create payment intent
            const intentResponse = await this.createPaymentIntent(formData);
            
            if (!intentResponse.success) {
                throw new Error(intentResponse.error);
            }
            
            // Process payment
            formData.append('payment_id', intentResponse.payment_id);
            const paymentResponse = await this.processPayment(formData);
            
            if (paymentResponse.success) {
                this.showSuccess('Payment processed successfully!');
                setTimeout(() => {
                    window.location.href = `${this.apiBaseUrl}&action=showPaymentSuccess&payment_id=${intentResponse.payment_id}`;
                }, 2000);
            } else {
                throw new Error(paymentResponse.error);
            }
            
        } catch (error) {
            this.showError(error.message);
        } finally {
            this.setProcessingState(false);
        }
    }
    
    validateForm(form) {
        const requiredFields = form.querySelectorAll('input[required]');
        let isValid = true;
        
        requiredFields.forEach(field => {
            if (!this.validateField({ target: field })) {
                isValid = false;
            }
        });
        
        return isValid;
    }
    
    async createPaymentIntent(formData) {
        const response = await fetch(`${this.apiBaseUrl}&action=createPaymentIntent`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded',
            },
            body: new URLSearchParams({
                amount: formData.get('amount') || document.querySelector('input[name="amount"]')?.value,
                currency: 'USD',
                description: formData.get('description') || document.querySelector('input[name="description"]')?.value || 'Payment'
            })
        });
        
        return await response.json();
    }
    
    async processPayment(formData) {
        const response = await fetch(`${this.apiBaseUrl}&action=processPayment`, {
            method: 'POST',
            body: formData
        });
        
        return await response.json();
    }
    
    setProcessingState(processing) {
        this.isProcessing = processing;
        
        const submitBtn = document.getElementById('submitBtn');
        const loading = document.getElementById('loading');
        
        if (submitBtn) {
            submitBtn.disabled = processing;
            submitBtn.textContent = processing ? 'Processing...' : submitBtn.dataset.originalText || 'Pay';
        }
        
        if (loading) {
            loading.style.display = processing ? 'block' : 'none';
        }
    }
    
    showError(message) {
        const errorDiv = document.getElementById('errorMessage');
        if (errorDiv) {
            errorDiv.textContent = message;
            errorDiv.style.display = 'block';
        }
    }
    
    showSuccess(message) {
        const successDiv = document.getElementById('successMessage');
        if (successDiv) {
            successDiv.textContent = message;
            successDiv.style.display = 'block';
        }
    }
    
    clearMessages() {
        const errorDiv = document.getElementById('errorMessage');
        const successDiv = document.getElementById('successMessage');
        
        if (errorDiv) errorDiv.style.display = 'none';
        if (successDiv) successDiv.style.display = 'none';
    }
    
    async handleRefundClick(event) {
        if (event.target.classList.contains('btn-refund')) {
            event.preventDefault();
            
            const paymentId = event.target.dataset.paymentId || 
                            event.target.getAttribute('onclick')?.match(/refundPayment\((\d+)\)/)?.[1];
            
            if (paymentId) {
                await this.refundPayment(paymentId);
            }
        }
    }
    
    async refundPayment(paymentId) {
        if (!confirm('Are you sure you want to refund this payment? This action cannot be undone.')) {
            return;
        }
        
        try {
            const response = await fetch(`${this.apiBaseUrl}&action=refundPayment`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded',
                },
                body: `payment_id=${paymentId}`
            });
            
            const result = await response.json();
            
            if (result.success) {
                alert('Payment refunded successfully!');
                // Reload the page or update the UI
                if (typeof loadPayments === 'function') {
                    loadPayments();
                } else {
                    location.reload();
                }
            } else {
                alert('Refund failed: ' + result.error);
            }
        } catch (error) {
            alert('Failed to process refund. Please try again.');
        }
    }
}

// Initialize payment manager when DOM is loaded
document.addEventListener('DOMContentLoaded', function() {
    new PaymentManager();
});

// Utility functions for payment processing
const PaymentUtils = {
    formatCurrency: function(amount, currency = 'USD') {
        return new Intl.NumberFormat('en-US', {
            style: 'currency',
            currency: currency
        }).format(amount);
    },
    
    formatDate: function(dateString) {
        return new Date(dateString).toLocaleDateString('en-US', {
            year: 'numeric',
            month: 'long',
            day: 'numeric',
            hour: '2-digit',
            minute: '2-digit'
        });
    },
    
    getCardType: function(cardNumber) {
        const cleanNumber = cardNumber.replace(/\s/g, '');
        
        if (/^4/.test(cleanNumber)) return 'Visa';
        if (/^5[1-5]/.test(cleanNumber)) return 'Mastercard';
        if (/^3[47]/.test(cleanNumber)) return 'American Express';
        if (/^6/.test(cleanNumber)) return 'Discover';
        
        return 'Unknown';
    },
    
    maskCardNumber: function(cardNumber) {
        const cleanNumber = cardNumber.replace(/\s/g, '');
        if (cleanNumber.length < 8) return cardNumber;
        
        const firstFour = cleanNumber.substring(0, 4);
        const lastFour = cleanNumber.substring(cleanNumber.length - 4);
        const middle = '*'.repeat(cleanNumber.length - 8);
        
        return firstFour + middle + lastFour;
    }
};

// Export for use in other scripts
if (typeof module !== 'undefined' && module.exports) {
    module.exports = { PaymentManager, PaymentUtils };
}

