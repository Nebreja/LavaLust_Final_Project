<?php
// Database connection (replace with your connection settings)
$db = new PDO('mysql:host=localhost;dbname=nebreja_harlyn', 'root', '');

// Get search query if any
$search = isset($_GET['search']) ? $_GET['search'] : '';

// Pagination settings
$recordsPerPage = 5; // Number of records per page
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$offset = ($page - 1) * $recordsPerPage;

// Fetch records based on pagination and search
$query = "SELECT * FROM hpn_users 
          WHERE hpn_last_name LIKE :search 
          OR hpn_first_name LIKE :search 
          OR hpn_email LIKE :search 
          OR hpn_gender LIKE :search 
          OR hpn_address LIKE :search 
          LIMIT :offset, :recordsPerPage";
$stmt = $db->prepare($query);
$stmt->bindValue(':search', '%' . $search . '%');
$stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
$stmt->bindValue(':recordsPerPage', $recordsPerPage, PDO::PARAM_INT);
$stmt->execute();
$cret = $stmt->fetchAll();

// Total records for pagination
$queryTotal = "SELECT COUNT(*) FROM hpn_users 
               WHERE hpn_last_name LIKE :search 
               OR hpn_first_name LIKE :search 
               OR hpn_email LIKE :search 
               OR hpn_gender LIKE :search 
               OR hpn_address LIKE :search";
$stmtTotal = $db->prepare($queryTotal);
$stmtTotal->bindValue(':search', '%' . $search . '%');
$stmtTotal->execute();
$totalRecords = $stmtTotal->fetchColumn();
$totalPages = ceil($totalRecords / $recordsPerPage);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <title>Display Users</title>
    <style>
        body {
            background: linear-gradient(to right, #4facfe, #00f2fe); /* Light gray background for the body */
        }
        .container {
            background-color: #ffffff; /* White background for the container */
            padding: 30px;
            border-radius: 15px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); /* Soft shadow for elevation effect */
            max-width: 900px; /* Increased max-width for the container */
            margin: auto;
        }
        h2 {
            color: #007bff; /* Blue color for the heading */
        }
        .btn-primary {
            background-color: #007bff; /* Bootstrap primary color */
            border-color: #007bff;
        }
        .btn-primary:hover {
            background-color: #28a745; /* Change to success color on hover */
            border-color: #28a745; /* Success border color */
        }
        .btn-warning {
            background-color: #ffc107;
            border-color: #ffc107;
        }
        .btn-danger {
            background-color: #dc3545; /* Bootstrap danger color */
            border-color: #dc3545;
        }
        .btn {
            transition: background-color 0.3s, border-color 0.3s; /* Smooth transition for hover effects */
        }
        .table th {
            text-align: center;
        }
        .table td {
            text-align: center;
        }
    </style>
</head>
<body>
    <div class="container mt-5">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="text-center">Users List</h2>
            <a class="btn btn-primary" href="<?=site_url('create/insert');?>">Add User</a>
        </div>

        <!-- Search Form -->
        <form class="input-group mb-4" method="GET" action="">
            <input class="form-control" type="search" placeholder="Search" name="search" value="<?= isset($_GET['search']) ? $_GET['search'] : ''; ?>">
            <button class="btn btn-outline-success" type="submit">Search</button>
        </form>

        <!-- User Table -->
        <table class="table table-striped table-bordered">
            <thead class="table-dark">
                <tr>
                    <th>ID</th>
                    <th>Lastname</th>
                    <th>Firstname</th>
                    <th>Email</th>
                    <th>Gender</th>
                    <th>Address</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php if(!empty($cret)): ?>
                    <?php foreach($cret as $c): ?>
                        <tr>
                            <td><?=$c['id'];?></td>
                            <td><?=$c['hpn_last_name'];?></td>
                            <td><?=$c['hpn_first_name'];?></td>
                            <td><?=$c['hpn_email'];?></td>
                            <td><?=$c['hpn_gender'];?></td>
                            <td><?=$c['hpn_address'];?></td>
                            <td>
                                <a class="btn btn-sm btn-warning" href="<?=site_url('create/update/'.$c['id']);?>">Update</a>
                                <a class="btn btn-sm btn-danger" href="<?=site_url('create/delete/'.$c['id']);?>">Delete</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr><td colspan="7" class="text-center">No records found</td></tr>
                <?php endif; ?>
            </tbody>
        </table>

        <!-- Pagination -->
        <nav>
            <ul class="pagination justify-content-center">
                <?php if($page > 1): ?>
                    <li class="page-item">
                        <a class="page-link" href="?page=<?=($page-1);?>&search=<?=isset($_GET['search']) ? $_GET['search'] : '';?>">Previous</a>
                    </li>
                <?php endif; ?>

                <?php for($i = 1; $i <= $totalPages; $i++): ?>
                    <li class="page-item <?=($i == $page) ? 'active' : '';?>">
                        <a class="page-link" href="?page=<?=$i;?>&search=<?=isset($_GET['search']) ? $_GET['search'] : '';?>"><?=$i;?></a>
                    </li>
                <?php endfor; ?>

                <?php if($page < $totalPages): ?>
                    <li class="page-item">
                        <a class="page-link" href="?page=<?=($page+1);?>&search=<?=isset($_GET['search']) ? $_GET['search'] : '';?>">Next</a>
                    </li>
                <?php endif; ?>
            </ul>
        </nav>
    </div>
</body>
</html>
