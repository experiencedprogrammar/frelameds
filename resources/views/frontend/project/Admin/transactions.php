<?php 
include 'db.php' ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Transactions</title>
    <!-- Google Fonts: Poppins -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <!-- Bootstrap CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <!-- DataTables CSS -->
    <link href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css" rel="stylesheet">
    <!-- DataTables Buttons CSS -->
    <link href="https://cdn.datatables.net/buttons/2.4.1/css/buttons.bootstrap5.min.css" rel="stylesheet">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #0f172a;
            color: white;
            margin: 0;
            padding: 0;
        }
        .card {
            background: #1e293b;
        }
        .progress-bar {
            height: 8px;
        }
        .table {
            color: white;
            margin-top: 10px;
            background-color: #1e293b;
            border-color: #334155;
            font-size: 14px;
        }
        .table th, .table td {
            border-color: #334155;
            background-color: #1e293b;
            padding: 8px;
        }
        .table thead th {
            border-bottom: 2px solid #475569;
            font-weight: 600;
            color: #f8fafc;
        }
        .table tbody tr:hover {
            background-color: #334155;
            transition: background-color 0.3s ease;
        }
        .table tbody td {
            color: #e2e8f0;
        }
        .btn-danger {
            background-color: #dc3545;
            border-color: #dc3545;
            padding: 5px 10px;
            font-size: 12px;
        }
        .btn-danger:hover {
            background-color: #c82333;
            border-color: #bd2130;
        }
        .btn-danger i {
            margin-right: 5px;
        }
        .table-heading {
            font-size: 1.5rem;
            font-weight: 600;
            margin-top: 20px;
            margin-bottom: 10px;
            color: #f8fafc;
        }
        .search-bar {
            margin-bottom: 20px;
        }
        .search-bar input {
            width: 300px;
            padding: 8px;
            border-radius: 5px;
            border: 1px solid #475569;
            background-color: #1e293b;
            color: white;
            font-family: 'Poppins', sans-serif;
        }
        .search-bar input::placeholder {
            color: #94a3b8;
        }
        .search-bar button {
            margin-left: 10px;
            padding: 8px 15px;
            border-radius: 5px;
            border: none;
            background-color: #3b82f6;
            color: white;
            font-family: 'Poppins', sans-serif;
            cursor: pointer;
        }
        .search-bar button:hover {
            background-color: #2563eb;
        }
        .btn-success {
            background-color: #28a745;
            border-color: #28a745;
            padding: 5px 10px;
            font-size: 12px;
        }
        .btn-success:hover {
            background-color: #218838;
            border-color: #1e7e34;
        }
        .btn-warning {
            background-color: #ffc107;
            border-color: #ffc107;
            padding: 5px 10px;
            font-size: 12px;
        }
        .btn-warning:hover {
            background-color: #e0a800;
            border-color: #d39e00;
        }
        .filters {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }
        .filters label {
            margin-right: 10px;
        }
        .filters select {
            padding: 5px;
            border-radius: 5px;
            border: 1px solid #475569;
            background-color: #1e293b;
            color: white;
            font-family: 'Poppins', sans-serif;
        }
        .download-btn {
            padding: 8px 15px;
            border-radius: 5px;
            border: none;
            background-color: #3b82f6;
            color: white;
            font-family: 'Poppins', sans-serif;
            cursor: pointer;
        }
        .download-btn:hover {
            background-color: #2563eb;
        }
        .filters .search-bar {
            margin: 0;
            display: flex;
            align-items: center;
        }
        .filters .search-bar input {
            width: 200px;
        }
        .export-buttons {
            display: flex;
            align-items: center;
            gap: 10px;
        }
        .export-buttons button {
            padding: 8px 15px;
            border-radius: 5px;
            border: none;
            background-color: #3b82f6;
            color: white;
            font-family: 'Poppins', sans-serif;
            cursor: pointer;
            font-size: 12px;
        }
        .export-buttons button:hover {
            background-color: #2563eb;
        }
        .dt-buttons {
            margin-left: 10px;
        }
        
        /* Add these styles for outline badges */
        .badge-outline-danger {
            color: #dc3545;
            background-color: transparent;
            border: 1px solid #dc3545;
            padding: 4px 8px;
            border-radius: 50px;
            font-size: 12px;
            font-weight: 500;
        }
        
        .badge-outline-success {
            color: #28a745;
            background-color: transparent;
            border: 1px solid #28a745;
            padding: 4px 8px;
            border-radius: 50px;
            font-size: 12px;
            font-weight: 500;
        }
        
        .badge-outline-warning {
            color: #ffc107;
            background-color: transparent;
            border: 1px solid #ffc107;
            padding: 4px 8px;
            border-radius: 50px;
            font-size: 12px;
            font-weight: 500;
        }
        
        .badge-outline-info {
            color: #17a2b8;
            background-color: transparent;
            border: 1px solid #17a2b8;
            padding: 4px 8px;
            border-radius: 50px;
            font-size: 12px;
            font-weight: 500;
        }
    </style>
</head>
<body>
    <div class="p-4">
        <h3 class="fs-3 fw-bold">Transactions</h3>

        <!-- Table -->
        <div class="row mt-2">
            <div class="col">
                <table class="table table-bordered" id="transactionTable">
                    <thead>
                        <tr>
                            <th>Id</th>
                            <th>Name</th>
                            <th>Code</th>
                            <th>Amount</th>
                            <th>Phone</th>
                            <th>Time</th>
                            <th>Status</th>
                            <th colspan="2">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                        $con= mysqli_connect("localhost","root","", "users");
                        $query= "SELECT *FROM transactions";
                        $query_run=mysqli_query($con,$query);
                        if(mysqli_num_rows($query_run) >0)
                        {
                          foreach($query_run as $row)
                          {
                          
                            ?>
                        <tr>
                             <td><?= $row['ID'];?></td>
                             <td><?= $row['MerchantRequestID'];?> </td>
                             <td><?= $row['MpesaReceiptNumber'];?> </td>
                             <td><?= $row['Amount'];?> </td>
                             <td><?= $row['PhoneNumber'];?> </td>
                             <td><?= $row['Time'];?> </td> 
                             <td><div class="badge badge-outline-success">Served</div></td> 
                             <td><a class="btn btn-sm btn-info" name="process" href="Reverse.html"><i class="fas fa-arrow-left mr-1"></i>Reverse</a></td>      
                             <td><a class='btn btn-sm btn-danger' href='delete_transaction.php?id=$row[id]'><i class="fas fa-trash-alt"></i>Delete</a></td>
                        </tr>   
                        <?php
        
    }
  }
  else{
    echo "No Records Found";
  }
  
  ?>      
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
    <!-- DataTables JS -->
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>
    <!-- DataTables Buttons JS -->
    <script src="https://cdn.datatables.net/buttons/2.4.1/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.bootstrap5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.print.min.js"></script>
    <!-- PDFMake and JSZip for PDF/Excel export -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/vfs_fonts.js"></script>
    <script>
        $(document).ready(function () {
            $('#transactionTable').DataTable({
                dom: '<"row"<"col-sm-12 col-md-6 text-start"f><"col-sm-12 col-md-6 text-end"B>>rtip',
                buttons: [
                    'copy', 'csv', 'excel', 'pdf', 'print'
                ],
                paging: true,
                pageLength: 10,
                lengthChange: false,
                searching: true,
                ordering: true,
                info: true,
                autoWidth: false
            });

            // Add space between DataTable buttons
            $('.dt-buttons').css('gap', '10px');

            // Make DataTable buttons smaller
            $('.dt-buttons button').css({
                'padding': '5px 10px',
                'font-size': '12px'
            });

            // Remove border radius from 'copy' and 'print' buttons
            $('.dt-buttons button:contains("Copy"), .dt-buttons button:contains("Print")').css({
                'border-radius': '0'
            });
        });
    </script>
</body>
</html>