<!-- Billing Section Start -->
<div class="container">
  <h2>Hospital Billing</h2>

  <form id="patient_billing" action="process_payment.php" method="POST">

    <label>Patient Name</label>
    <input type="text" id="name" name="name" required>

    <label>Phone Number</label>
    <input type="tel" id="phone" name="phone" required>

    <label>Appointment Date</label>
    <input type="date" id="appointment_date" name="appointment_date" required>

    <label>Consultation Charges (₹)</label>
    <input type="number" id="consultation" name="consultation" value="500" onchange="calculateBill()" required>

    <label>Tests Charges (₹)</label>
    <input type="number" id="tests" name="tests" value="0" onchange="calculateBill()">

    <label>Medicine Charges (₹)</label>
    <input type="number" id="medicines" name="medicines"  value="0" onchange="calculateBill()">

    <label><input type="checkbox" id="emergency_charge" name="emergency_charge" onchange="calculateBill()"> Emergency Service (+₹300)</label>

    <div class="total">Total Amount: ₹<span id="billAmount">500</span></div>

    <div class="payment-options" id="paymentOption">
      <label>Payment Method</label>
      <label><input type="radio" name="payment" value="cod" checked onclick="togglePayment()"> Cash</label>
      <label><input type="radio" name="payment" value="online" onclick="togglePayment()"> Online</label>
    </div>

    <div class="online-options" id="onlineOptions">
      <label><input type="radio" name="onlineMethod" value="upi"> UPI</label><br>
      <label><input type="radio" name="onlineMethod" value="card"> Card</label><br>
      <label><input type="radio" name="onlineMethod" value="netbanking"> Net Banking</label>
    </div>

    <button type="submit">Confirm Payment</button>
  </form>
</div>
<!-- Billing Section End -->

<style>
  .container {
    max-width: 700px;
    margin: 30px auto;
    background: #fff;
    padding: 25px;
    border-radius: 10px;
    box-shadow: 0 0 10px rgba(216, 123, 123, 0.1);
  }
  h2 {
    text-align: center;
    margin-bottom: 20px;
  }
  label {
    display: block;
    margin-top: 15px;
    font-weight: bold;
  }
  input, select {
    width: 100%;
    padding: 10px;
    margin-top: 5px;
    border-radius: 6px;
    border: 1px solid #ccc;
  }
  .total {
    font-size: 18px;
    margin-top: 15px;
    font-weight: bold;
  }
  .payment-options {
    margin-top: 15px;
  }
  .online-options {
    margin-left: 20px;
    margin-top: 10px;
    display: none;
  }
  button {
    margin-top: 25px;
    padding: 12px;
    background: #28a745;
    color: white;
    border: none;
    border-radius: 6px;
    font-size: 16px;
    cursor: pointer;
  }
  button:hover {
    background: #218838;
  }
</style>

<script>
  function calculateBill() {
    const consultation = parseInt(document.getElementById('consultation').value) || 0;
    const tests = parseInt(document.getElementById('tests').value) || 0;
    const medicines = parseInt(document.getElementById('medicines').value) || 0;
    const emergency = document.getElementById('emergency').checked ? 300 : 0;

    const total = consultation + tests + medicines + emergency;
    document.getElementById('billAmount').textContent = total;
  }

  function togglePayment() {
    const selected = document.querySelector('input[name="payment"]:checked').value;
    document.getElementById('onlineOptions').style.display = (selected === 'online') ? 'block' : 'none';
  }
</script>