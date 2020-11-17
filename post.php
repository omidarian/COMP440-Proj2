<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>

<?php
    session_start();
    require 'config.php';
    if(!$_SESSION["username"]){
        header('location:index.php');
    }
    if (!($bId = $_GET['blogid'])){
        header('location:blog.php');
    }

    $sql = "select * from blogs where blogid = $bId";
    $result = mysqli_fetch_array(mysqli_query($con, $sql),MYSQLI_ASSOC);
?>



<div class="container">
<div class="page-header form-horizontal">
        <div class="form-group" >
            <h4 class="col-sm-2" >User: <?php echo $_SESSION['username']?></h4>
            <form class="col-sm-20" method='post'>
                <input class="btn" type="submit" name="Back" value="Back"/>
                
                <?php
                    if(isset($_POST['Back']))
                    {
                        header('location:blog.php');
                        
                    }
                ?>

            </form> 
        </div>
    </div>



<div class="col-md-12 post">

    <div class="row">
        <div class="col-md-12">
            <h4>
                <strong><?php echo $result['subject']; ?></strong></h4>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12 post-header-line">
            <span class="glyphicon glyphicon-user"></span><?php echo $result['postuser']; ?> 
            | <span class="glyphicon glyphicon-calendar">
            </span><?php echo $result['pdate']; ?> 
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
            <?php echo $result['description']; ?>
            </p>
            <?php
                // check if the user is owner of this post  
                    if ($result['postuser'] == $_SESSION["username"]){
                ?>
                <!--  Edit and Delete bottun -->
                <div>
                    <p>
                    <form action="blogActions.php" method='post'>
                        <input type="hidden" name="blogid" value=<?php echo $bId?> >
                        <input class="btn" type="submit" name="delete" value="Delete"/>
                        <input class="btn" type="submit" name="edit" value="Edit"/>
                    </form>              
                    </p>
                </div>
                <!-- --------------------  -->
                <?php
                    }
                ?>

        <!-- comments ----------------------------------------------------------- -->
        <?php
            $sql = "select * from comments where blogid = $bId order by commentid desc";
            $resultComments = mysqli_query($con, $sql);
            $count = mysqli_num_rows($resultComments);
            if ($count < 1){
                echo '<span class="glyphicon glyphicon-comment"></span>No Comments</a>';    
            }else{
                echo '<span class="glyphicon glyphicon-comment"></span>' . $count .'Comments</a>';    
            }            
        ?>
            
        <div>
            <div class="row post-content">
                <div class="col-md-9">


                <?php
                // check self-comment 
                if ($result['postuser'] != $_SESSION["username"])
                {
                    // check for limit comment more than 3 a day
                    $currentDate = date("Y-m-d");
                    $author =  $_SESSION['username'];
                    $sql = "select count(*) as total from comments where author = '$author' and cdate='$currentDate'";
                    $result = mysqli_query($con, $sql);
                    $count = mysqli_fetch_assoc($result);
                    if ($count['total'] > 2){
                        
                ?>

                        <div class="row" style="  margin-left: 30px; border: 1px solid #4CAF50;   padding: 10px;   border-radius: 10px 50px;">
                            <h4 style="color:red;"> Sorry <?php echo $author ?>! User can only insert 3 comments a day.</h4>
                         </div> 

                <?php
                    }else{
                        // if edit commnets
                        if(isset($_GET['commentid'])){
                            $commentid = ($_GET['commentid']);
                            $sql = "select * from comments where commentid =  '$commentid'";
                            $result = mysqli_fetch_array(mysqli_query($con, $sql),MYSQLI_ASSOC);
                            $sentiment = $result['sentiment'];
                            $description = $result['description'];
                ?>                
                        <!-- edit comments ----------------------------------------------------------- -->
                        <div class="row" style="  margin-left: 30px; border: 1px solid #4CAF50;   padding: 10px;   border-radius: 10px 50px;">
                            <form action="commentActions.php" method='post'>
                                <input type="hidden" name="commentid" value=<?php echo $commentid?> >
                                <input type="hidden" name="blogid" value=<?php echo $bId?> >
                                <label for="sentiment" >Sentiment: </label> 
                                    <select name="sentiment" id="sentiment" >
                                        <?php if ($sentiment == "Positive"){
                                            echo "<option value='Positive' selected >Positive</option>";
                                            echo "<option value='Negative'>Negative</option>";
                                            }else{
                                                echo "<option value='Positive'>Positive</option>";
                                                echo "<option value='Negative' selected >Negative</option>";    
                                            } 
                                        ?>
                                    </select><br>
                                <label>Description: </label><br>
                                <textarea name="description" rows="3" cols="65" maxlength = "250"><?php echo $description?></textarea><br>
                                <input class="btn" type="submit"  name="update" value="Update"/>
                            </form>
                        </div>

                        <?php
                        }else{ 
                        ?>
                        <!-- new comments ----------------------------------------------------------- -->
                        <div class="row" style="  margin-left: 30px; border: 1px solid #4CAF50;   padding: 10px;   border-radius: 10px 50px;">
                            <form action="commentActions.php" method='post'>
                                <input type="hidden" name="blogid" value=<?php echo $bId?> >
                                <label for="sentiment" >Sentiment: </label>
                                    <select name="sentiment" id="sentiment" required>
                                        <option value="" disabled selected >Select your option</option>
                                        <option value="Positive">Positive</option>
                                        <option value="Negative">Negative</option>
                                    </select><br>
                                <label>Description: </label><br>
                                <textarea name="description" placeholder="Type your comment" rows="3" cols="65" maxlength = "250"></textarea><br>
                                <input class="btn" type="submit"  name="add" value="Add"/>
                            </form>
                        </div> 
 
                <?php
                        }
                    }
                }else{
                ?>                   
                    <div class="row" style="  margin-left: 30px; border: 1px solid #4CAF50;   padding: 10px;   border-radius: 10px 50px;">
                        <h4 style="color:red;"> <?php echo $result['postuser'] ?>, you can not comment on your post</h4>
                    </div> 
                <?php    
                }  
                ?>

                    <?php 
                        while($row = mysqli_fetch_array($resultComments))
                        {
                            $cId = $row['commentid'];

                    ?>
                    <div class="row">
                        
                        <div class="col-md-12 post">

                        <div class="col-md-12">
                        <h4>
                            <strong><?php echo $row['sentiment']; ?></strong></h4>
                        </div>
                            <div class="row">
                                <div class="col-md-12 post-header-line">
                                    <span class="glyphicon glyphicon-user"></span><?php echo $row['author']; ?> 
                                    | <span class="glyphicon glyphicon-calendar">
                                    </span><?php echo $row['cdate']; ?> 
                                </div>
                            </div>
                            <div class="row post-content">
                                <div class="col-md-9">
                                    <p>
                                    <?php echo $row['description']; ?>
                                    </p>
                                </div>

                                
                                <?php
                                // check if the user is owner of this comment  
                                    if ($row['author'] == $_SESSION["username"]){
                                ?>
                                <!--  Edit and Delete bottun -->
                                <div>
                                    <p>
                                    <form action="commentActions.php" method='post'>
                                        <input type="hidden" name="blogid" value=<?php echo $bId?> >
                                        <input type="hidden" name="commentid" value=<?php echo $cId?> >
                                        <input class="btn" type="submit" name="delete" value="Delete"/>
                                        <input class="btn" type="submit" name="edit" value="Edit"/>
                                    </form>              
                                    </p>
                                </div>
                                <!-- --------------------  -->
                                <?php
                                    }
                                ?>

                            </div>
                        </div>
                    </div>
<?php
                        }

?>
            

        </div>

    </div>
            </div>
            <p>
            <form action="blog.php" method='post'>
                <input class="btn" type="submit" value="Back"/> 
            </form>              
            </p>
        </div>
    </div>
</div>
</div>