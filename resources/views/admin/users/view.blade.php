{{-- Users Management Styles --}}
<style>
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }

    :root {
        --primary: #0088fe;
        --secondary: #3498db;
        --accent: #e74c3c;
        --light: #f5f7fa;
        --dark: #2c3e50;
        --success: #2ecc71;
        --warning: #f39c12;
        --info: #17a2b8;
    }

    body {
        background-color: #f0f4f8;
        color: #333;
        padding: 20px;
    }

    .users-management {
        background: white;
        border-radius: 5px;
        padding: 16px;
        box-shadow: 0 3px 8px rgba(0, 0, 0, 0.05);
        margin-bottom: 16px;
    }

    .users-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 16px;
        padding-bottom: 8px;
        border-bottom: 1px solid #eee;
    }

    .users-title {
        font-size: 1.4rem;
        color: var(--dark);
        font-weight: 600;
    }

    .action-buttons {
        display: flex;
        gap: 10px;
    }

    .btn {
        padding: 8px 16px;
        border-radius: 4px;
        border: none;
        cursor: pointer;
        font-weight: 500;
        font-size: 0.9rem;
        transition: all 0.3s;
        display: flex;
        align-items: center;
        gap: 5px;
    }

    .btn-primary {
        background-color: var(--primary);
        color: white;
    }

    .btn-primary:hover {
        background-color: #0066cc;
    }

    .btn-success {
        background-color: var(--success);
        color: white;
    }

    .btn-success:hover {
        background-color: #27ae60;
    }

    .btn-danger {
        background-color: var(--accent);
        color: white;
    }

    .btn-danger:hover {
        background-color: #c0392b;
    }

    .btn-warning {
        background-color: var(--warning);
        color: white;
    }

    .btn-warning:hover {
        background-color: #e67e22;
    }

    /* Table */
    .table-responsive {
        overflow-x: auto;
        margin-top: 20px;
    }

    table {
        width: 100%;
        border-collapse: collapse;
        font-size: 0.9rem;
    }

    th, td {
        padding: 12px 15px;
        text-align: left;
        border-bottom: 1px solid #eee;
    }

    th {
        background-color: #f8f9fa;
        font-weight: 600;
        color: #495057;
        position: sticky;
        top: 0;
    }

    tr:hover {
        background-color: #f8f9fa;
    }

    .status {
        padding: 5px 10px;
        border-radius: 10px;
        font-size: 0.8rem;
        font-weight: 500;
        display: inline-block;
    }

    .status-active {
        background-color: #d4edda;
        color: #155724;
    }

    .status-inactive {
        background-color: #f8d7da;
        color: #721c24;
    }

    .status-pending {
        background-color: #fff3cd;
        color: #856404;
    }

    .action-cell {
        display: flex;
        gap: 8px;
    }

    /* Search and filter */
    .users-tools {
        display: flex;
        justify-content: space-between;
        margin-bottom: 20px;
        align-items: center;
    }

    .search-box {
        display: flex;
        align-items: center;
        background: white;
        border-radius: 4px;
        padding: 8px 12px;
        border: 1px solid #ddd;
        width: 300px;
    }

    .search-box input {
        border: none;
        outline: none;
        padding: 5px;
        width: 100%;
        font-size: 0.9rem;
    }

    .filter-select {
        padding: 8px 12px;
        border-radius: 4px;
        border: 1px solid #ddd;
        background: white;
        font-size: 0.9rem;
    }

    @media (max-width: 768px) {
        .users-tools {
            flex-direction: column;
            align-items: stretch;
            gap: 10px;
        }
        
        .search-box {
            width: 100%;
        }
        
        .action-cell {
            flex-direction: column;
        }
    }
</style>

<!-- Users Management Section -->
<div class="users-management">
    <div class="users-header">
        <h2 class="users-title">Users Management</h2>
        <div class="action-buttons">
            <button class="btn btn-primary" onclick="openAddUserModal()">
                <i class="fas fa-plus"></i> Add User
            </button>
        </div>
    </div>

    <!-- Search and Filter Tools -->
    <div class="users-tools">
        <div class="search-box">
            <i class="fas fa-search"></i>
            <input type="text" placeholder="Search users..." id="searchInput">
        </div>
        <select class="filter-select" id="statusFilter">
            <option value="">All Statuses</option>
            <option value="active">Active</option>
            <option value="inactive">Inactive</option>
            <option value="pending">Pending</option>
        </select>
    </div>

    <div class="table-responsive">
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Role</th>
                    <th>Status</th>
                    <th>Registered</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($users as $user)
                <tr>
                    <td>USR-{{ str_pad($user->id, 3, '0', STR_PAD_LEFT) }}</td>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>User</td>
                    <td><span class="status status-active">Active</span></td>
                    <td>{{ $user->created_at->format('M d, Y') }}</td>
                    <td class="action-cell">
                        <button class="btn btn-warning" onclick="openEditUserModal({{ $user->id }})">
                            <i class="fas fa-edit"></i> Edit
                        </button>
                        <button class="btn btn-danger" onclick="confirmDeleteUser({{ $user->id }})">
                            <i class="fas fa-trash"></i> Delete
                        </button>
                    </td>
                </tr>
                @endforeach
                
                @if($users->count() == 0)
                <tr>
                    <td colspan="7" style="text-align: center;">No users found</td>
                </tr>
                @endif
            </tbody>
        </table>
    </div>
</div>

{{-- Scripts --}}
<script>
    function openAddUserModal() {
        document.getElementById('addUserModal').style.display = 'block';
    }

    function closeAddUserModal() {
        document.getElementById('addUserModal').style.display = 'none';
    }

    function openEditUserModal() {
        document.getElementById('editUserModal').style.display = 'block';
    }

    function closeEditUserModal() {
        document.getElementById('editUserModal').style.display = 'none';
    }

    function confirmDeleteUser() {
        if (confirm('Are you sure you want to delete this user?')) {
            alert('User deleted successfully!');
        }
    }

    // Search functionality
    document.getElementById('searchInput').addEventListener('keyup', function() {
        const searchText = this.value.toLowerCase();
        const rows = document.querySelectorAll('tbody tr');
        
        rows.forEach(row => {
            const name = row.cells[1].textContent.toLowerCase();
            const email = row.cells[2].textContent.toLowerCase();
            const role = row.cells[3].textContent.toLowerCase();
            
            if (name.includes(searchText) || email.includes(searchText) || role.includes(searchText)) {
                row.style.display = '';
            } else {
                row.style.display = 'none';
            }
        });
    });

    // Filter functionality
    document.getElementById('statusFilter').addEventListener('change', function() {
        const filterValue = this.value;
        const rows = document.querySelectorAll('tbody tr');
        
        rows.forEach(row => {
            const status = row.cells[4].textContent.toLowerCase();
            
            if (!filterValue || status.includes(filterValue)) {
                row.style.display = '';
            } else {
                row.style.display = 'none';
            }
        });
    });
</script>
