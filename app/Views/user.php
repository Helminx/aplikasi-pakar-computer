<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Account List</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <style>
        .btn-sm-rounded {
            border-radius: 50%;
            padding: 0.25rem 0.5rem;
            font-size: 0.75rem;
            line-height: 1;
            display: flex;
            align-items: center;
            justify-content: center;
        }
    </style>
</head>
<body>
    <div class="container-fluid">
        <!-- Page Heading -->
        <h1 class="h3 mb-2 text-gray-800">List Account Registered</h1>

        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3 d-flex justify-content-between align-items-center">
                <h6 class="m-0 font-weight-bold text-primary">All accounts registered on our website!</h6>
                <a href="<?= base_url('home/t_user') ?>" class="btn btn-outline-success btn-sm">
                    <i class="fa fa-plus"></i> Add New
                </a>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th scope="col">No</th>
                                <th scope="col">Username</th>
                                <th scope="col">Level</th>
                                <th scope="col">Gender</th>
                                <th scope="col">Password</th>
                                <th scope="col">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no = 1; foreach ($jel as $kin) { ?>
                                <?php if ($kin->level != 'admin') { // Hide rows with 'admin' level ?>
                                    <tr>
                                        <td><?= $no++ ?></td>
                                        <td><?= $kin->username ?></td>
                                        <td><?= $kin->level ?></td>
                                        <td><?= $kin->jk ?></td>
                                        <td><?= $kin->pw ?></td>
                                        <td>
                                            <button class="btn btn-sm btn-primary btn-sm-rounded editBtn" 
                                            data-toggle="modal" 
                                            data-target="#editModal" 
                                            data-id="<?= $kin->id_user ?>" 
                                            data-username="<?= $kin->username ?>" 
                                            data-level="<?= $kin->level ?>" 
                                            data-jk="<?= $kin->jk ?>" 
                                            data-pw="<?= $kin->pw ?>">
                                            <i class="fa fa-edit"></i>
                                        </button>
                                        <a href="<?= base_url('home/aksi_reset/' . $kin->id_user) ?>" class="btn btn-warning btn-sm rounded-circle">
                                            <i class="fa fa-redo"></i>
                                        </a>
                                    </td>
                                </tr>
                                <?php } ?>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Edit Modal -->
    <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form id="editForm" method="post" action="<?= base_url('home/aksi_e_user') ?>">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editModalLabel">Edit Account</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" name="id" id="edit-id">
                        <div class="form-group">
                            <label for="edit-username">Username</label>
                            <input type="text" class="form-control" id="edit-username" name="username" required>
                        </div>
                        <div class="form-group">
                            <label for="edit-level">Level</label>
                            <select class="form-control" name="level" id="edit-level">
                                <option value="user">user</option>
                                        <option value="admin">admin</option>
                                        <option value="kesiswaan">kesiswaan</option>
                                        <option value="bkk">bkk</option>
                                        <option value="super-admin">super admin</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="edit-jk">Gender</label>
                            <select class="form-control" name="jk" id="edit-jk">
                                <option value="cowo">cowo</option>
                                <option value="cewe">cewe</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="edit-pw">Password</label>
                            <input type="password" class="form-control" id="edit-pw" name="pw" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save changes</button>
                        <a href="<?= base_url('home/h_user/' . $kin->id_user) ?>" class="btn btn-outline-danger" id="deleteUserBtn">Delete</a>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>

    <script>
        $(document).ready(function() {
            // Edit button action
            $('.editBtn').on('click', function() {
                var id = $(this).data('id');
                var username = $(this).data('username');
                var level = $(this).data('level');
                var jk = $(this).data('jk');
                var pw = $(this).data('pw');

                $('#edit-id').val(id);
                $('#edit-username').val(username);
                $('#edit-level').val(level);
                $('#edit-jk').val(jk);
                $('#edit-pw').val(pw);
            });

            // Delete button action
            $('.deleteBtn').on('click', function() {
                var id = $('#edit-id').val();
                if (confirm("Are you sure you want to delete this account?")) {
                    $.ajax({
                        url: '<?= base_url("home/h_user") ?>',
                        type: 'POST',
                        data: {id: id},
                        success: function(response) {
                            alert("Account deleted successfully!");
                            location.reload();
                        },
                        error: function() {
                            alert("Error deleting account.");
                        }
                    });
                }
            });
        });
    </script>
</body>
</html>