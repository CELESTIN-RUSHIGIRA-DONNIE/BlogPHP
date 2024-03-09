<?php

include('security.php');

include('includes/header.php'); 
include('includes/navbar.php');  
?>
<div class="modal fade" id="deptmodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add Department</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="code.php" method="POST" enctype="multipart/form-data">

        <div class="modal-body">
          
            <div class="form-group">
                <label>Name department</label>
                <input type="text" name="dept_name" class="form-control" placeholder="Enter name">
            </div>
            <div class="form-group">
                <label>Description</label>
                <input type="text" name="dept_description" class="form-control" placeholder="Enter Description">
            </div>
            <div class="form-group">
                <label>Image</label>
                <input type="file" name="department_image" id="department_image" class="form-control">
            </div>

        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="submit" name="dept_btn" class="btn btn-primary">Save</button>
        </div>
      </form>

    </div>
  </div>
</div>

<div class="container-fluid">

<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary"> Academics-Departments(category)
            <button type="button" class="btn btn-primary float-right" data-toggle="modal" data-target="#deptmodal">
                Add
            </button>
        </h6>
    </div>
  <div class="card-body">

    <?php 
      if(isset($_SESSION['success']) && $_SESSION['success'] != '')
      {
        echo '<h2> '.$_SESSION['success'].' </h2>';
        unset($_SESSION['success']);
      }
      if(isset($_SESSION['status']) && $_SESSION['status'] != '')
      {
        echo '<h2 class="bg-info"> '.$_SESSION['status'].' </h2>';
        unset($_SESSION['status']);
      }
    ?>

       <div class="table-responsive">

       <?php 
        $connection = mysqli_connect("localhost", "root", "", "blogphp");
        $query = "SELECT * FROM departmentcategory";
        $query_run = mysqli_query($connection, $query);

       ?>

        <table class="table table-bordered text-center" id="datatable"  width="100%" cellspacing="0">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>DEPARTMENT</th>
                    <th>DESCRIPTION</th>
                    <th>IMAGE</th>
                    <th>Edit</th>
                    <th>Delete</th>
                </tr>
            </thead>
            <tbody>           
              <?php 
                if(mysqli_num_rows($query_run) > 0)
                {
                  while($row = mysqli_fetch_assoc($query_run))
                  {
                    ?>
                  <tr>
                      <td><?php echo $row['id']; ?></td>
                      <td><?php echo $row['name']; ?></td>
                      <td><?php echo $row['description']; ?></td>
                      <td><?php echo '<img src = "upload/department/'.$row['image'].'" width="100px;" height="100px;" alt="Image">'?></td>
                      <td>
                        <form action="department_edit.php" method="post">
                          <input type="hidden" name="edit_dept_id" value="<?php echo $row['id']; ?>">
                          <button type="submit" name="edit_dept_btn" class="btn btn-success"> EDIT</button>
                        </form>
                      </td>
                      <td>
                        <form action="code.php" method="post">
                          <input type="hidden" name="delete_id" value="<?php echo $row['id']; ?>">
                          <button type="submit" name="delete_dept_btn" class="btn btn-danger"> DELETE</button>
                        </form>
                      </td>
                  </tr>
                <?php
                  }
                }
               else{
                    echo "No Record found";
                } 
                ?>
            </tbody>
        </table>
       </div> 
    </div>
  </div>

<!---<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addadminprofile">
       Add Admin Profile 
</button>

<?php 

include('includes/scripts.php');
include('includes/footer.php'); 
?>
