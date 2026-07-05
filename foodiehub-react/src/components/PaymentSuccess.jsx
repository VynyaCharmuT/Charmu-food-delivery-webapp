function PaymentSuccess({ show, onClose }) {

    if (!show) return null;

    return (

        <div className="payment-overlay">

            <div className="payment-modal glass-card text-center p-5">

                <div className="success-circle">

                    ✓

                </div>

                <h2 className="mt-4">

                    Payment Successful

                </h2>

                <p>

                    Your payment has been received.

                </p>

                <button

                    className="btn btn-warning mt-3"

                    onClick={onClose}

                >

                    Continue

                </button>

            </div>

        </div>

    );

}

export default PaymentSuccess;