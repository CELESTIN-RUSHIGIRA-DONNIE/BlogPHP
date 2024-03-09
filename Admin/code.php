<?php

include('security.php');
//$connection = mysqli_connect("localhost", "root","","blogphp");

//======================BEGIN CROUD OF ADMIN===================

if(isset($_POST['registerbtn']))
{

    $username = $_POST['username'];
    $email = $_POST['email'];
    $password1 = $_POST['password'];
    $password2 = $_POST['confirmpassword'];
    $usertype = $_POST['usertype'];

    $email_query = "SELECT * FROM register WHERE email='$email' ";
    $email_query_run = mysqli_query($connection, $email_query);


    if(mysqli_num_rows($email_query_run) > 0)
    {
        $_SESSION['status'] = "Email Already Taken. Please Try Another one.";
        $_SESSION['status_code'] = "error";
        header('Location: register.php');  
    }else{

        if($password1 === $password2){

            //$password = md5($password1);
            $query = "INSERT INTO register (username, email, password, usertype) VALUES ('$username', '$email', '$password1','$usertype')";
            $query_run = mysqli_query($connection, $query);
            if($query_run){
                //echo "Saved";
                $_SESSION['status'] = "admin profile added";
                $_SESSION['status_code'] = "success";
                header('Location: register.php');
            }
            else{
                //echo "not saved";
                $_SESSION['status']  = "Admin profile not added";
                $_SESSION['status_code'] = "error";
                header('Location: register.php');
            }
        }
        else
        {
            $_SESSION['status']  = "The two password does not much";
            $_SESSION['status_code'] = "warning";
            header('Location: register.php');
        }
    }

    
}

if(isset($_POST['update_btn']))
{

    $id = $_POST['edit_id'];
    $username = $_POST['edit_username'];
    $email = $_POST['edit_email'];
    $password = $_POST['edit_password'];
    $usertypeupdate = $_POST['update_usertype'];
    
    $query = "UPDATE register SET username='$username', email='$email', password='$password', usertype='$usertypeupdate' WHERE id='$id'";
    $query_run = mysqli_query($connection, $query);
    if($query_run)
    {
        $_SESSION['status'] = "Your Data is updated";
        $_SESSION['status_code'] = "success";
        header('Location: register.php');
    }
    else
    {
        $_SESSION['status'] = "Your Data is not update";
        $_SESSION['status_code'] = "error";
        header('Location: register.php');
    }

}
if(isset($_POST['delete_btn']))
{
    $id = $_POST['delete_id'];

    $query = "DELETE FROM register WHERE id='$id' ";
    $query_run = mysqli_query($connection, $query);

    if($query_run)
    {
        $_SESSION['status'] = "Your Data is Deleted";
        $_SESSION['status_code'] = "success";
        header('Location: register.php'); 
    }
    else
    {
        $_SESSION['status'] = "Your Data is NOT DELETED";       
        $_SESSION['status_code'] = "error";
        header('Location: register.php'); 
    }    
}

//======================END CROUD OF ADMIN===================

//======================BEGIN CROUD OF ABOUT US ===================
if(isset($_POST['about_save']))
{

    $title = $_POST['title'];
    $subtitle = $_POST['subtitle'];
    $description = $_POST['description'];
    $links = $_POST['links'];
    
    $query = "INSERT INTO abouts (title, subtitle, description, links) VALUES('$title', '$subtitle', '$description', '$links')";
    $query_run = mysqli_query($connection, $query);

    if($query_run)
    {
        $_SESSION['status'] = "About us Added";
        $_SESSION['status_code'] = "success";
        header('Location: abouts.php');
    }
    else{
        $_SESSION['status'] = "About is not Added";
        $_SESSION['status_code'] = "error";
        header('Location: abouts.php');
    }
}
if(isset($_POST['Update_abouts_btn']))
{
    $id = $_POST['edit_id'];
    $title = $_POST['edit_title'];
    $subtitle = $_POST['edit_subtitle'];
    $description = $_POST['edit_description'];
    $links = $_POST['edit_links'];

    $query = "UPDATE abouts SET title='$title', subtitle='$subtitle', description='$description', links='$links' WHERE id='$id'";
    $query_run = mysqli_query($connection, $query);
    if($query_run)
    {
        $_SESSION['status'] = "information updated";
        $_SESSION['status_code'] = "success";
        header('Location: abouts.php');
    }
    else
    {
        $_SESSION['status'] = "Your Data is not update";
        $_SESSION['status_code'] = "error";
        header('Location: abouts.php');
    }
    
}

if(isset($_POST['delete_abouts_btn']))
{
    $id = $_POST['delete_abouts_id'];

    $query = "DELETE FROM abouts WHERE id='$id' ";
    $query_run = mysqli_query($connection, $query);

    if($query_run)
    {
        $_SESSION['status'] = "Your Data is Deleted";
        $_SESSION['status_code'] = "success";
        header('Location: abouts.php'); 
    }
    else
    {
        $_SESSION['status'] = "Your Data is NOT DELETED";       
        $_SESSION['status_code'] = "error";
        header('Location: abouts.php'); 
    }
}
//======================END CROUD OF ABOUT US ===================

//======================BEGIN CROUD OF FACULTY==================

if(isset($_POST['save_faculty']))
{

    $name = $_POST['faculty_name'];
    $designation = $_POST['faculty_designation'];
    $description = $_POST['faculty_description'];
    $images = $_FILES["faculty_image"]['name'];

    /* 
    ====La premiere methode de limiter les extensions====
    $validate_img_extension = $_FILES["faculty_image"]['type']=="image/jpg" ||
    $_FILES["faculty_image"]['type']=="image/png" ||
    $_FILES["faculty_image"]['type']=="image/jpeg"
    ; 
    */

    //La deuxieme methode de limiter les extension.....
    $img_types = array('image/jpg', 'image/png', 'image/jpeg');
    $validate_img_extension = in_array($_FILES["faculty_image"]['type'], $img_types);

    if($validate_img_extension)
    {
        if(file_exists("upload/" . $_FILES["faculty_image"]["name"]))
        {
            $store = $_FILES["faculty_image"]["name"];
            $_SESSION['status']="Image already exists. '.$store.'";
            header('Location: faculty.php');
        }
        else
        {
            $query = "INSERT INTO faculty (name, designation, description, image) VALUES('$name', '$designation', '$description', '$images')";
            $query_run = mysqli_query($connection, $query);

            if($query_run)
            {
                move_uploaded_file($_FILES["faculty_image"]["tmp_name"], "upload/".$_FILES["faculty_image"]["name"]);
                $_SESSION['success'] = "Faculty Added";
                header('Location: faculty.php');
            }
            else{
                $_SESSION['status'] = "Faculty not Added";
                header('Location: faculty.php');
            }
        }

    }
    else
    {
        $_SESSION['status'] = "Only like, .png, .jpg or .Jpeg";
        header('Location: faculty.php');
    }
    
}
if(isset($_POST['faculty_update_btn']))
{
    $edit_id = $_POST['edit_id'];
    $edit_name = $_POST['edit_name'];
    $edit_designation = $_POST['edit_designation'];
    $edit_description = $_POST['edit_description'];

    $edit_faculty_image = $_FILES["faculty_image"]['name']; 

    $img_types = array('image/jpg', 'image/png', 'image/jpeg');
    $validate_img_extension = in_array($_FILES["faculty_image"]['type'], $img_types);

    if($validate_img_extension)
    {
        $facul_query = "SELECT * FROM faculty WHERE id='$edit_id'";
        $facul_query_run = mysqli_query($connection, $facul_query);
        foreach($facul_query_run as $fa_row)
        {
            if($edit_faculty_image == null)
            {
                //update with existing image
                $image_data = $fa_row['image'];
            }
            else
            {
                //update with image and delete the old image
                if($img_path = "upload/".$fa_row['image'])
                {
                    unlink($img_path);
                    $image_data = $edit_faculty_image;
                }
            }
        }

        $query = "UPDATE faculty SET name='$edit_name', designation='$edit_designation', description='$edit_description', image='$image_data' WHERE id='$edit_id'";
        $query_run = mysqli_query($connection, $query);
        
        if($query_run)
        {
            if($edit_faculty_image == null)
            {
                //update with existing image
                $_SESSION['success'] = "Faculty Upated with the existing image";
                header('Location: faculty.php');
            }
            else
            {
                //update with the new image and delete the old image
                move_uploaded_file($_FILES["faculty_image"]["tmp_name"],"upload/".$_FILES["faculty_image"]["name"]);
                $_SESSION['success'] = "Faculty Upated";
                header('Location: faculty.php');
            }
        }
        else
        {
            $_SESSION['status'] = "Faculty not updated";
            header('Location: faculty.php');
        }
    }
    else
    {
        $_SESSION['status'] = "Only like, .png, .jpg or .Jpeg";
        header('Location: faculty.php');
    }
}

if(isset($_POST['delete_faculty_btn']))
{ 
    $id = $_POST['delete_id'];

    $query = "DELETE FROM faculty WHERE id='$id' ";
    $query_run = mysqli_query($connection, $query);

    if($query_run)
    {
        $_SESSION['success'] = "Faculty data is deleted";
        header("Location: faculty.php");
    }
    else
    {
        $_SESSION['status'] = "Faculty data is not deleted";
        header("Location: faculty.php");
    }
}
//======= END CROUD OF FACULTY WITH IMAGE ======

//===== DELETE MULTIPLE ROW

if(isset($_POST['search_data']))
{
    $id = $_POST['id'];
    $visible = $_POST['visible'];

    $query = "UPDATE faculty SET visible='$visible' WHERE id='$id' ";
    $query_run =mysqli_query($connection, $query);
}

if(isset($_POST['delete_multiple_data']))
{
    $id = "1";

    $query = "DELETE FROM faculty WHERE visible='$id' ";
    $query_run = mysqli_query($connection, $query);

    if($query_run)
    {
        $_SESSION['success'] = "Your multiple data is deleted";
        header('Location: faculty.php');
    }
    else
    {
        $_SESSION['status'] = "Your multiple data not is deleted";
        header('Location: faculty.php');
    }
}
//==============================================================================

if(isset($_POST['dept_btn']))
{

    $dept_name = $_POST['dept_name'];
    $dept_description = $_POST['dept_description'];
    $dept_images = $_FILES["department_image"]['name'];

    /* 
    ====La premiere methode de limiter les extensions====
    $validate_img_extension = $_FILES["faculty_image"]['type']=="image/jpg" ||
    $_FILES["faculty_image"]['type']=="image/png" ||
    $_FILES["faculty_image"]['type']=="image/jpeg"
    ; 
    */

    //La deuxieme methode de limiter les extension.....
    $img_types = array('image/jpg', 'image/png', 'image/jpeg');
    $validate_img_extension = in_array($_FILES["department_image"]['type'], $img_types);

    if($validate_img_extension)
    {
        if(file_exists("upload/department/" . $_FILES["department_image"]["name"]))
        {
            $store = $_FILES["department_image"]["name"];
            $_SESSION['status']="Image already exists. '.$store.'";
            header('Location: department.php');
        }
        else
        {
            $query = "INSERT INTO departmentcategory (name, description, image) VALUES('$dept_name', '$dept_description', '$dept_images')";
            $query_run = mysqli_query($connection, $query);

            if($query_run)
            {
                move_uploaded_file($_FILES["department_image"]["tmp_name"], "upload/department/".$_FILES["department_image"]["name"]);
                $_SESSION['success'] = "Department category Added";
                header('Location: department.php');
            }
            else{
                $_SESSION['status'] = "Department category not Added";
                header('Location: department.php');
            }
        }

    }
    else
    {
        $_SESSION['status'] = "Only like, .png, .jpg or .Jpeg";
        header('Location: department.php');
    }
    
}
if(isset($_POST['dept_update_btn']))
{
    $edit_id = $_POST['edit_dept_id'];
    $edit_name = $_POST['edit_dept_name'];
    $edit_description = $_POST['edit_dept_description'];

    $edit_dept_image = $_FILES["dept_image"]['name']; 

    $img_types = array('image/jpg', 'image/png', 'image/jpeg');
    $validate_img_extension = in_array($_FILES["dept_image"]['type'], $img_types);

    if($validate_img_extension)
    {
        $facul_query = "SELECT * FROM departmentcategory WHERE id='$edit_id'";
        $facul_query_run = mysqli_query($connection, $facul_query);
        foreach($facul_query_run as $fa_row)
        {
            if($edit_dept_image == null)
            {
                //update with existing image
                $image_data = $fa_row['image'];
            }
            else
            {
                //update with image and delete the old image
                if($img_path = "upload/department/".$fa_row['image'])
                {
                    unlink($img_path);
                    $image_data = $edit_dept_image;
                }
            }
        }

        $query = "UPDATE departmentcategory SET name='$edit_name',  description='$edit_description', image='$image_data' WHERE id='$edit_id'";
        $query_run = mysqli_query($connection, $query);
        
        if($query_run)
        {
            if($edit_dept_image == null)
            {
                //update with existing image
                $_SESSION['success'] = "department Upated with the existing image";
                header('Location: department.php');
            }
            else
            {
                //update with the new image and delete the old image
                move_uploaded_file($_FILES["dept_image"]["tmp_name"],"upload/department/".$_FILES["dept_image"]["name"]);
                $_SESSION['success'] = "department Upated";
                header('Location: department.php');
            }
        }
        else
        {
            $_SESSION['status'] = "department not updated";
            header('Location: department.php');
        }
    }
    else
    {
        $_SESSION['status'] = "Only like, .png, .jpg or .Jpeg";
        header('Location: department.php');
    }
}

if(isset($_POST['delete_dept_btn']))
{ 
    $id = $_POST['delete_id'];

    $query = "DELETE FROM departmentcategory WHERE id='$id' ";
    $query_run = mysqli_query($connection, $query);

    if($query_run)
    {
        $_SESSION['success'] = "department data is deleted";
        header("Location: department.php");
    }
    else
    {
        $_SESSION['status'] = "department data is not deleted";
        header("Location: department.php");
    }
}

//======================================================================

if(isset($_POST['dept_list_btn']))
{
    $dept_cate_id = $_POST['dept_cate_id'];
    $name = $_POST['name'];
    $description = $_POST['description'];
    $section =  $_POST['section'];

    $query = "INSERT INTO dept_categ_list(dept_cate_id,name,description,section) VALUES ('$dept_cate_id','$name', '$description', '$section')";
    $query_run = mysqli_query($connection, $query);

    if($query_run)
    {
        
        $_SESSION['status'] = "department List data is Added";
        $_SESSION['status_code'] = "success";
        header("Location: department_list.php");
    }
    else
    {
        $_SESSION['status'] = "department List data is not Added";
        $_SESSION['status_code'] = "error";
        header("Location: department_list.php");
    }

}

if(isset($_POST['dept_list_update_btn']))
{

    $updating_id = $_POST['updating_id'];
    $dept_cate_id = $_POST['dept_cate_id'];
    $name = $_POST['name'];
    $description = $_POST['description'];
    $section = $_POST['section'];
 
    $query = "UPDATE dept_categ_list SET dept_cate_id='$dept_cate_id', name='$name', description='$description', section='$section' WHERE id='$updating_id'";
    $query_run = mysqli_query($connection, $query);
    if($query_run)
    {
        $_SESSION['status'] = "Your Dept list is updated";
        $_SESSION['status_code'] = "success";
        header('Location: department_list.php');
    }
    else
    {
        $_SESSION['status'] = "Your Dept list is not update";
        $_SESSION['status_code'] = "error";
        header('Location: department_list.php');
    }

}

if(isset($_POST['delete_dept_list_btn']))
{
    $id = $_POST['delete_id'];

    $query = "DELETE FROM dept_categ_list WHERE id='$id' ";
    $query_run = mysqli_query($connection, $query);

    if($query_run)
    {
        $_SESSION['status'] = "Your Data is Deleted";
        $_SESSION['status_code'] = "success";
        header('Location: department_list.php'); 
    }
    else
    {
        $_SESSION['status'] = "Your Data is NOT DELETED"; 
        $_SESSION['status_code'] = "error";      
        header('Location: department_list.php'); 
    }
}

?>