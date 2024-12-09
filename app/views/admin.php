
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="employee.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.css">
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <title>Document</title>
    <style>
        *{
            margin:0;
            padding: 0;
            border: none;
            outline: none;
            box-sizing: border-box;
            font-family: "Poppins", sans-serif;
        }
        body{
            display: flex;
        }
        .sidebar{
            position: sticky;
            top: 0;
            left: 0;
            bottom: 0;
            width: 110px;
            height: 100vh;
            padding: 0 1.7rem;
            color:#fff;
            overflow: hidden;
            white-space: nowrap;
            transition: all 0.5s linear;
            background:#5477ff;
        }
        .sidebar:hover{
            width: 298px;
            transition: 0.5s;
        }
        .logo{
            height: 80px;
            padding: 16px;

        }
        .menu{
            height: 88%;
            position: relative;
            list-style: none;
            padding: 0;
        }
        .menu li {
            padding: 1rem;
            margin: 8px 0;
            border-radius: 8px;
            transition: all 0.5s ease-in-out;
        }
        .menu li:hover, .active{
            background: #e0e0e058;
        }
        .menu a{
            color: #fff;
            font-size: 14px;
            text-decoration: none;
            display: flex;
            align-items: center;
            gap: 1.5rem;
        }
        .menu a span{
            overflow: hidden;
        }
        .menu a i{
            font-size: 1.2rem;
        }
        .logout{
            position: absolute;
            bottom: 0;
            left: 0;
            width: 100%;
        }
        .h1{
            text-align: center;
        }
        .servicecontainer, .dataservices, .customercontainer {
            width: calc(100% - 100px - 2 * 50px);
            max-width: 1200px;
            height: auto;
            margin: 50px;
            padding: 40px;
            background: rgb(84, 119, 255);
            background: linear-gradient(159deg, rgba(84, 119, 255, 1) 0%, rgba(255, 255, 255, 1) 100%);
            border-radius: 10px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.15);
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: space-between;
            position: relative;
        }

        .servicecontainer h1, .dataservices h1, .customercontainer h1 {
            text-align: center;
            margin-bottom: 20px;
            font-size: 20px; /* Adjust font size */
        }

        .servicecontainer form, .dataservices .table-container, .customercontainer .table-container {
            width: 100%; /* Stretch content to full width */
        }

        /* Input and Select styles for service container */
        .servicecontainer input, .servicecontainer select {
            background-color: #fff;
            margin: 8px 0;
            padding: 10px 15px;
            font-size: 14px;
            border-radius: 5px;
            width: 100%; /* Full width */
            outline: none;
        }

        /* Button styles for service container */
        .servicecontainer button {
            background-color: #5477ff;
            color: #fff;
            font-size: 14px;
            padding: 12px 30px;
            border: none;
            border-radius: 5px;
            font-weight: bold;
            letter-spacing: 1px;
            text-transform: uppercase;
            cursor: pointer;
            transition: background-color 0.2s ease-in-out;
        }

        .servicecontainer button:hover {
            background-color: #4767d5;
        }

        /* Table styles for dataservices container */
        .dataservices .table-container {
            overflow-x: auto;
            width: 100%;
            max-width: 100%;
        }

        .dataservices table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        .dataservices th, .dataservices td {
            border: 1px solid black;
            padding: 12px;
            text-align: left;
        }

        .dataservices th {
            background-color: #343a40;
            color: white;
            text-align: center;
        }

        .dataservices tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        /* Modal styles */
        .modal {
            display: none;
            position: fixed;
            z-index: 1000;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgba(0, 0, 0, 0.5);
        }

        /* Modal content */
        .modal-content {
            background-color: #fff;
            margin: 10% auto;
            padding: 20px;
            border-radius: 10px;
            width: 50%;
            max-width: 600px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.3);
            animation: fadeIn 0.3s ease-in-out;
        }

        /* Fade-in animation for modal */
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

        /* Close button */
        .close {
            float: right;
            font-size: 24px;
            color: #555;
            cursor: pointer;
            transition: color 0.2s ease-in-out;
        }

        .close:hover {
            color: #000;
        }

        /* Modal header */
        .modal-content h1 {
            text-align: center;
            margin-bottom: 20px;
            font-size: 24px;
            font-weight: bold;
            color: #5477ff;
        }

        /* Labels */
        .modal-content label {
            display: block;
            font-weight: bold;
            margin: 10px 0 5px;
            color: #333;
        }

        /* Input fields */
        .modal-content input[type="text"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            font-size: 14px;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-shadow: inset 0 1px 3px rgba(0, 0, 0, 0.1);
            transition: border-color 0.2s ease-in-out;
        }

        .modal-content input[type="text"]:focus {
            border-color: #5477ff;
        }

        /* Button styles */
        #proceed-button {
            width: 100%;
            padding: 12px;
            font-size: 16px;
            font-weight: bold;
            background-color: #5477ff;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease-in-out;
        }

        #proceed-button:hover {
            background-color: #4767d5;
        }

        .revenuecontainer  {
            width: calc(100% - 100px - 2 * 50px);
            max-width: 1200px;
            height: auto;
            margin: 50px;
            padding: 40px;
            background: #fff,
            border-radius: 10px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.15);
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: space-between;
            position: relative;
        }

        /* Header Styles */
        .revenue-header {
            text-align: center;
            margin-bottom: 20px;
        }

        .revenue-header h1 {
            font-size: 24px;
            font-weight: bold;
            color: #343a40;
        }

        .revenue-header p {
            font-size: 16px;
            color: #555;
            margin-top: 10px;
        }

        /* Chart Container */
        .chart-container {
            width: 100%;
            max-width: 900px;
            margin: 0 auto;
            padding: 20px;
            background: #fff;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }

        /* Ensure Chart takes up full width and is responsive */
        #dailyRevenueChart {
            width: 100% !important;
            height: 400px; /* Fixed height for chart */
            border-radius: 8px;
        }
        #dailyCustomerChart, #dailyServiceChart {
        width: 50%;
        height: 200px;
        border-radius: 8px;
    }

        .hidden {
        display: none;
        }

    </style>
</head>
<body>
    <div class="sidebar">
        <div class="user-profile">
            <a href="">
                <img src="user-avatar.jpg" alt="" class="avatar">
            </a>
        </div>
        <ul class="menu">
            <li>
                <a href="#" onclick="showProfile()">
                    <i class="fa-solid fa-user"></i>
                    <span>Profile</span>
                </a>
            </li>
            <li>
                <a href="#" onclick="showService()">
                    <i class="fa-solid fa-cart-shopping"></i>
                    <span>Service</span>
                </a>
            </li>
            <li>
                <a href="#" onclick="showRevenue()">
                    <i class="fa-solid fa-file-invoice-dollar"></i>
                    <span>Revenue</span>
                </a>
            </li>
            <li class="logout">
                <a href="login.php">
                    <i class="fas fa-sign-out-alt"></i>
                    <span>Logout</span>
                </a>
            </li>
        </ul>
    </div> 

    <div id="customercontainer" class="customercontainer">
    <div>
        <button onclick="window.location.href='<?= base_url('print_customers') ?>'" class="btn btn-primary">
            Print Customer List
        </button>
    </div>

        <table class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th>Customer ID</th>
                    <th>Last Name</th>
                    <th>First Name</th>
                    <th>Phone Number</th>
                    <th>Address</th>
                    <th>Email</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($data['customers'])): ?>
                    <?php foreach ($data['customers'] as $customer): ?>
                        <tr>
                            <td><?= $customer['customer_id'] ?? 'N/A' ?></td>
                            <td><?= $customer['last_name'] ?? 'N/A' ?></td>
                            <td><?= $customer['first_name'] ?? 'N/A' ?></td>
                            <td><?= $customer['phone_number'] ?? 'N/A' ?></td>
                            <td><?= $customer['address'] ?? 'N/A' ?></td>
                            <td><?= $customer['email'] ?? 'N/A' ?></td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr><td colspan="6">No customers found.</td></tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>

    <div id="dataservices" class="dataservices hidden">
        <table class="table table-striped table-bordered">
            <thead class="table-dark">
                <tr>
                    <th>Service ID</th>
                    <th>Customer Name</th>
                    <th>Service Type</th>
                    <th>Instructions</th>
                    <th>Kilo</th>
                    <th>Total Amount</th>
                    <th>Paid / Not Paid</th>
                    <th>Status</th>
                    <th>Created At</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($services)): ?>
                    <?php foreach ($services as $service): ?>
                        <tr>
                            <td><?= htmlspecialchars($service['service_id']); ?></td>
                            <td><?= htmlspecialchars($service['customer_name']); ?></td>
                            <td><?= htmlspecialchars($service['service_type']); ?></td>
                            <td><?= htmlspecialchars($service['special_instructions']); ?></td>
                            <td><?= htmlspecialchars($service['kilo']); ?></td>
                            <td><?= htmlspecialchars($service['total_amount']); ?></td>
                            <td><?= htmlspecialchars($service['is_paid']); ?></td>
                            <td><?= htmlspecialchars($service['status']); ?></td>
                            <td><?= htmlspecialchars($service['created_at']); ?></td>
                            <td>
                                <button class="update-button" data-service-id="<?= htmlspecialchars($service['service_id']); ?>">Update</button>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="9">No services found.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>



        

    <div id="servicesDetailsModal" class="modal">
        <div class="modal-content">
            <span class="close">&times;</span>
            <h1>Update Service</h1>
            <form method="POST" action="/update_service">
                <label for="service-id">Service ID</label>
                <input type="text" id="service-id" name="service_id" readonly>

                <label for="customer-name">Customer Name</label>
                <input type="text" id="customer-name" readonly>

                <label for="service-type">Service Type</label>
                <input type="text" id="service-type" readonly>

                <label for="instructions">Instructions</label>
                <input type="text" id="instructions" readonly>

                <label for="kilo">Kilo</label>
                <input type="number" id="kilo" name="kilo">

                <label for="total-amount">Total Amount</label>
                <input type="number" id="total-amount" name="total_amount">

                <label for="paid-status">Paid / Not Paid</label>
                <select id="paid-status" name="paid_status">
                    <option value="Paid">Paid</option>
                    <option value="Not Paid">Not Paid</option>
                </select>

                <label for="status">Status</label>
                <select id="status" name="status">
                    <option value="Pending">Pending</option>
                    <option value="In Progress">In Progress</option>
                    <option value="Completed">Completed</option>
                </select>

                <button type="submit" id="proceed-button">Save Changes</button>
            </form>
        </div>
    </div>

    <div id="revenuecontainer" class="revenuecontainer hidden">
        <canvas id="dailyRevenueChart"></canvas>
    </div>

    


    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const dailyRevenueData = <?= json_encode($daily_revenue) ?>;

            // Extract dates and revenues
            const labels = dailyRevenueData.map(data => data.revenue_date);
            const revenue = dailyRevenueData.map(data => parseFloat(data.total_revenue));

            // Create the chart
            const ctx = document.getElementById('dailyRevenueChart').getContext('2d');
            new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: labels,
                    datasets: [{
                        label: 'Total Revenue (PHP)',
                        data: revenue,
                        backgroundColor: 'rgba(75, 192, 192, 0.2)',
                        borderColor: 'rgba(75, 192, 192, 1)',
                        borderWidth: 1
                    }]
                },
                options: {
                    responsive: true,
                    plugins: {
                        legend: {
                            position: 'top'
                        },
                        title: {
                            display: true,
                            text: 'Daily Revenue'
                        }
                    },
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });
        });

        

        document.addEventListener('DOMContentLoaded', function () {
            const modal = document.getElementById('servicesDetailsModal');
            const closeButton = document.querySelector('.close');
            const updateButtons = document.querySelectorAll('.update-button');

            updateButtons.forEach(button => {
            button.addEventListener('click', function () {
                const serviceId = this.getAttribute('data-service-id');
                const row = this.closest('tr');

                const customerName = row.children[1].textContent;
                const serviceType = row.children[2].textContent;
                const instructions = row.children[3].textContent;
                const kilo = row.children[4].textContent.trim();
                const totalAmount = row.children[5].textContent.trim();
                const isPaid = row.children[6].textContent.trim();
                const status = row.children[7].textContent.trim();

                document.getElementById('service-id').value = serviceId;
                document.getElementById('customer-name').value = customerName;
                document.getElementById('service-type').value = serviceType;
                document.getElementById('instructions').value = instructions;
                document.getElementById('kilo').value = kilo;
                document.getElementById('total-amount').value = totalAmount;
                document.getElementById('paid-status').value = isPaid === 'Paid' ? 'Paid' : 'Not Paid';
                document.getElementById('status').value = status;

                modal.style.display = 'block';
            });
        });


            closeButton.addEventListener('click', function () {
                modal.style.display = 'none';
            });

            window.addEventListener('click', function (event) {
                if (event.target === modal) {
                    modal.style.display = 'none';
                }
            });
        });


        document.getElementById('profilecontainer').classList.remove('hidden');

        function showProfile() {
            document.getElementById('customercontainer').classList.remove('hidden');
            document.getElementById('dataservices').classList.add('hidden');
            document.getElementById('revenuecontainer').classList.add('hidden');
        }
        function showService() {
            document.getElementById('customercontainer').classList.add('hidden');
            document.getElementById('dataservices').classList.remove('hidden');
            document.getElementById('revenuecontainer').classList.add('hidden');
        }
        function showRevenue() {
            document.getElementById('customercontainer').classList.add('hidden');
            document.getElementById('dataservices').classList.add('hidden');
            document.getElementById('revenuecontainer').classList.remove('hidden');
        }

    </script>
</body>
</html>
