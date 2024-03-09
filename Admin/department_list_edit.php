<?php
include('security.php');

include('includes/header.php'); 
include('includes/navbar.php'); 
?>

<div class="container-fluid">   

<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Edit Admin profile</h6>
    </div>
  
    <div class="card-body">


<?php 

if(isset($_POST['edit_dept_list_btn']))
{       
    $id = $_POST['edit_dept_list_id'];
    
    $query = "SELECT * FROM dept_categ_list WHERE id ='$id' ";
    $query_run = mysqli_query($connection, $query);
   
    foreach($query_run as $rowediting)
    {

        ?> 
            <form action="code.php" method="POST" enctype="multipart/form-data">

                    <input type="hidden" name="updating_id" value="<?php echo $rowediting['id'] ?>">

                    <?php
                    $depart = " SELECT * FROM departmentcategory";
                    $dept_run = mysqli_query($connection, $depart);

                    if(mysqli_num_rows($dept_run) > 0)
                    {
                        ?>
                        <div class="form-group">
                            <label>Department List Cat </label>
                            <select name="dept_cate_id" id="" class="form-control" required>
                                <option value="">Choose your department Category</option>
                                    <?php
                                    foreach($dept_run as $row)
                                    {
                                    ?>
                                    <option value="<?php echo $row['id']; ?>"><?php echo $row['name']; ?></option>
                                    <?php
                                    }
                                    ?>
                            </select>
                        </div>
                        <?php
                    }
                    else
                    {
                        echo "No data Available";
                    }
                ?>

                <div class="form-group">
                    <label>Department List Name </label>
                    <input type="text" name="name" class="form-control" value="<?php echo $rowediting['name']; ?>"  required>
                </div>
                <div class="form-group">
                    <label>Description</label>
                    <input type="text" name="description" class="form-control" value="<?php echo $rowediting['description']; ?>" required>
                </div>
                <div class="form-group">
                    <label>Section</label>
                    <input type="text" name="section"  class="form-control" value="<?php echo $rowediting['section']; ?>" required>
                </div>
                    <a href="department_list.php" class="btn btn-danger">CANCEL</a>
                    <button type="submit"  class="btn btn-primary" name="dept_list_update_btn">Update</button>
            </form>
    <?php
    }
}
?>
     </div> 
    </div>
  </div>

</div>

<?php 

include('includes/scripts.php');
include('includes/footer.php'); 
?>
