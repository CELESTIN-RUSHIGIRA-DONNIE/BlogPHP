<?php

include('security.php');

include('includes/header.php'); 
include('includes/navbar.php'); 
?>
<div class="modal fade" id="addadminprofile" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add Admin Data</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="code.php" method="POST">

        <div class="modal-body">
          
            <div class="form-group">
                <label> Title</label>
                <input type="text" name="title" class="form-control" placeholder="Title">
            </div>
            <div class="form-group">
                <label>Subtitle</label>
                <input type="text" name="subtitle" class="form-control" placeholder="Subtitle">
            </div>
            <div class="form-group">
                <label>Description</label>
                <textarea type="text" name="description" class="form-control" placeholder="Description"></textarea>
            </div>
            <div class="form-group">
                <label>Links</label>
                <input type="text" name="links" class="form-control" placeholder="Link">
            </div>
            <input type="hidden" name="usertype" value="admin">

        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="submit" name="about_save" class="btn btn-primary">Save</button>
        </div>
      </form>

    </div>
  </div>
</div>

<div class="container-fluid">

<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary"> About us
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addadminprofile">
                Add About us
            </button>
        </h6>
    </div>
  <div class="card-body">

       <div class="table-responsive">

       <?php 
        $connection = mysqli_connect("localhost", "root", "", "blogphp");
        $query = "SELECT * FROM abouts";
        $query_run = mysqli_query($connection, $query);

       ?>

        <table class="table table-bordered" id="datatable" width="100%" cellspacing="0">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Title</th>
                    <th>Subtitle</th>
                    <th>Description</th>
                    <th>Links</th>
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
                      <td><?php echo $row['title']; ?></td>
                      <td><?php echo $row['subtitle']; ?></td>
                      <td><?php echo $row['description']; ?></td>
                      <td><?php echo $row['links']; ?></td>
                      <td> 
                        <form action="abouts_edit.php" method="post">
                          <input type="hidden" name="edit_abouts_id" value="<?php echo $row['id']; ?>">
                          <button type="submit" name="edit_abouts_btn" class="btn btn-success"> EDIT</button>
                        </form>
                      </td>
                      <td>
                        <form action="code.php" method="post">
                          <input type="hidden" name="delete_abouts_id" value="<?php echo $row['id']; ?>">
                          <button type="submit" name="delete_abouts_btn" class="btn btn-danger"> DELETE</button>
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
