<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="employee.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.css">
    <script type="text/javascript" charset="utf8" src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.js"></script>
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
        .servicecontainer, .dataservices {
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

        .servicecontainer h1, .dataservices h1 {
            text-align: center;
            margin-bottom: 20px;
            font-size: 20px; /* Adjust font size */
        }

        .servicecontainer form, .dataservices .table-container {
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

        .profilecontainer {
            width: calc(100% - 100px - 2 * 50px); 
            max-width: 1200px; 
            height: auto; 
            margin: 50px; 
            padding: 40px;
            background: rgb(84,119,255);
            background: linear-gradient(159deg, rgba(84,119,255,1) 0%, rgba(255,255,255,1) 100%);
            border-radius: 10px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.15);
            display: flex; 
            flex-direction: column; 
            align-items: center;
            justify-content: space-between;
            position: relative; 
        }
        /* Form styles */
        .profilecontainer form {
            display: flex;
            flex-direction: column;
            width: 100%;
        }
        
        /* Input styles */
        .profilecontainer input {
            background-color: #fff;
            margin: 8px 0;
            padding: 10px 15px;
            font-size: 14px;
            border-radius: 5px;
            width: 100%; /* Set width to 100% for full width */
            outline: none;
        }

        /* Button styles */
        .profilecontainer button {
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
            transition: background-color 0.2s ease-in-out; /* Add hover effect */
        }
        
        .profilecontainer button:hover {
            background-color: #4767d5; /* Change background color on hover */
        }
        
        /* H1 styles */
        h1 {
            text-align: center;
            margin-bottom: 20px;
            font-size: 20px; /* Adjust font size for H1 */
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
                <a href="#" onclick="showOrders()">
                    <i class="fa-solid fa-cart-shopping"></i>
                    <span>Orders</span>
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

    <div id="profilecontainer" class="profilecontainer">
        <form action="/update" method="post">
            <h1>Personal Info</h1>
            <div class="input-grid">
                <input type="text" name="last_name" placeholder="Last Name" value="<?= htmlspecialchars($customer_info['last_name']) ?>" required>
                <input type="text" name="phone_number" placeholder="Contact Number" value="<?= htmlspecialchars($customer_info['phone_number']) ?>" required>
                <input type="text" name="first_name" placeholder="First Name" value="<?= htmlspecialchars($customer_info['first_name']) ?>" required>
                <input type="text" name="address" placeholder="Address" value="<?= htmlspecialchars($customer_info['address']) ?>" required>
                <input type="email" name="email" placeholder="Email" value="<?= htmlspecialchars($customer_info['email']) ?>" required>
                <button type="submit">Update Profile</button>
            </div>
        </form>
    </div>

    <div id="servicecontainer" class="servicecontainer hidden">
        <form action="/service" method="post">
            <h1>Laundry Service Form</h1>
            <div class="input-grid">
                <select name="service_type" required>
                    <option value="" disabled selected>Select Service Type</option>
                    <option value="wash_and_fold">Wash and Fold</option>
                    <option value="dry_cleaning">Dry Cleaning</option>
                    <option value="wash_and_iron">Wash and Iron</option>
                    <option value="ironing_only">Ironing Only</option>
                    <option value="pickup_and_delivery">Pickup and Delivery</option>
                    <option value="express_laundry">Express Laundry</option>
                    <option value="stain_removal">Stain Removal</option>
                    <option value="commercial_laundry">Commercial Laundry</option>
                    <option value="curtains_and_drapery">Curtains and Drapery Cleaning</option>
                    <option value="bedding_and_linen">Bedding and Linen Cleaning</option>
                    <option value="shoe_cleaning">Shoe Cleaning</option>
                    <option value="alteration_and_repair">Alteration and Repair</option>
                    <option value="eco_friendly_laundry">Eco-Friendly Laundry</option>
                    <option value="self_service">Self-Service Laundry</option>
                </select>
                <input type="text" name="special_instructions" placeholder="Special Instructions" required>
            </div>
            <button type="submit" name="update" id="update-button">Update</button>
        </form>
    </div>


    <div id="dataservices" class="dataservices">
    <h1>Your Orders</h1>
    <div class="table-container">
        <table>
            <thead class="table-dark">
                <tr>
                    <th>Service Type</th>
                    <th>Kilo</th>
                    <th>Total Amount</th>
                    <th>Instructions</th>
                    <th>Paid/Not Paid</th>
                    <th>Status</th>
                    <th>Created At</th>
                </tr>
            </thead>
                <tbody>
                    <?php if (!empty($services)): ?>
                        <?php foreach ($services as $service): ?>
                            <tr>
                                <td><?= $service['service_type'] ?></td>
                                <td><?= $service['kilo'] ?></td>
                                <td><?= $service['total_amount'] ?></td>
                                <td><?= $service['special_instructions'] ?></td>
                                <td><?= $service['is_paid'] ?></td>
                                <td><?= $service['status'] ?></td>
                                <td><?= $service['created_at'] ?></td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="7">No services found.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </tbody>
        </table>
    </div>
</div>


    <script>
        document.getElementById('profilecontainer').classList.remove('hidden');

        function showProfile() {
            document.getElementById('profilecontainer').classList.remove('hidden');
            document.getElementById('servicecontainer').classList.add('hidden');
            document.getElementById('dataservices').classList.add('hidden');
        }

        function showService() {
            document.getElementById('profilecontainer').classList.add('hidden');
            document.getElementById('servicecontainer').classList.remove('hidden');
            document.getElementById('dataservices').classList.add('hidden');
        }

        function showOrders() {
            document.getElementById('profilecontainer').classList.add('hidden');
            document.getElementById('servicecontainer').classList.add('hidden');
            document.getElementById('dataservices').classList.remove('hidden');
        }

</script>
</body>
</html>
