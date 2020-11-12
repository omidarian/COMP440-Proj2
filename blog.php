<?php
    session_start();
    require 'config.php';
    if(!$_SESSION["username"]){
        header('location:index.php');
    }
?>


<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>

<!------ Include the above in your HEAD tag ---------->

<div class="container">
    <div class="page-header form-horizontal">
        <div class="form-group" >
            <h4 class="col-sm-2" >User: <?php echo $_SESSION['username']?></h4>
            <form class="col-sm-20" method='post'>
                <input class="btn" type="submit" name="NewPost" value="New Post"/> 
                <input class="btn" type="submit" name="Back" value="Back"/>
                <input class="btn" type="submit" name="Logout" value="Logout"/> 
                
                <?php
                    if(isset($_POST['NewPost']))
                    {
                        header('location:newPost.php');
                    }

                    if(isset($_POST['Logout'])){
                        unset($_SESSION['username']);
                        header('location:index.php');
                    }
                    if(isset($_POST['Back']))
                    {
                        header('location:welcome.php');
                        
                    }
                ?>

            </form> 
        </div>
    </div>
          

    
    <div class="row">
        <div class="col-md-9">
            <?php 
                $sql = "select * from blogs order by blogid desc";
                $result = mysqli_query($con, $sql);
                while($row = mysqli_fetch_array($result))
                {
                    $bId = $row['blogid'];
            ?>
                    <div class="row">
                        
                        <div class="col-md-12 post">
                            <div class="row">
                                <div class="col-md-12">
                                    <h4>
                                        <strong><?php echo $row['subject']; ?></strong></h4>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12 post-header-line">
                                    <span class="glyphicon glyphicon-user"></span><?php echo $row['postuser']; ?> 
                                    | <span class="glyphicon glyphicon-calendar">
                                    </span><?php echo $row['pdate']; ?> 
                                        <!-- tags -->
                                        | <span class="glyphicon glyphicon-tags">
                                        </span>Tags : 
                                        <?php  // tags
                                            $tagSql = "select * from blogstags where blogid = $bId";
                                            $tagResult = mysqli_query($con,$tagSql);
                                            while($tagRow = mysqli_fetch_array($tagResult)){
                                                echo "<span class='label label-info'>" . $tagRow['tag'] . "</span> ";
                                            }
                                        ?>
                                </div>
                            </div>
                            <div class="row post-content">
                                <div class="col-md-9">
                                    <p>
                                    <?php echo $row['description']; ?>
                                    </p>
                                    <p>
                                    <form action="post.php" method="get">
                                        <input type="hidden" name="blogid" value=<?php echo $bId?>>
                                        <input class="btn btn-read-more" type="submit" name="button1" value="Read more & Comment"/> 
                                    </form>              
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
<?php
                } 
?>
            

        </div>

    </div>
    <form action="welcome.php">
        <input class="btn" type="submit" value="Back"/> 
    </form>              
</div>

