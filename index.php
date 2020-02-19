<?php
$subTitle = "login";
require_once('head.php');
$class_name = isset($_GET["class_name"])?$_GET["class_name"]:"";
$pro_name = isset($_GET["pro_name"])?$_GET["pro_name"]:""; 
?>
  
<h1 style="text-align:center;font-family: Helvetica Neue;">Welcome to GW Class Review</h1>
<h2 style="text-align:center;font-family: Helvetica Neue;">Search by professor name or class name</h2>
<br /><br />
<form style="text-align:center" class="form-inline" action="./index.php">
    <div class="form-group">
        <input name="pro_name" type="text" placeholder="Professor name" class="form-control" value="<?php echo $pro_name?>" />
        <input name="class_name" type="text" placeholder="Class name" class="form-control" value="<?php echo $class_name?>" />
        <button style="background-color:rgb(0,80,124)" type="submit" class="btn btn-primary">Search</button>
    </div>
</form>

<hr>
<!--<h3 class="title">professor list</h3>-->
<?php $arr = listProfessorByName();  ?>
<table class="table">
    <thead>
    <tr>
        <th>Professor Name</th>
        <th>Department</th>
<!--
        <th>Age</th>
        <th>Sex</th>
-->
        <th>Date Added</th>
      
    </tr>
    </thead>
    <tbody>
    <?php if($arr){  foreach($arr as $k => $v){ ?>
        <tr>
<!--            <td><?php echo $v["profID"] ;?></td>-->
            <td><a href="./professor.php?id=<?php echo $v["profID"]?>"><?php echo $v["profName"] ;?></a></td>
            <td><?php echo $v["department"] ;?></td>
<!--
            <td><?php echo $v["age"] ;?></td>
            <?php if ($v["sex"] == 1) { ?>
                <td>Male</td>
            <?php } else if ($v["sex"] == 2){ ?>
                <td>Female</td>
            <?php } else { ?>
                <td>Other</td>
            <?php } ?>
-->
            <td><?php echo $v["addDate"] ;?></td>

        </tr>

    <?php  } }?>
    </body>
</table>

<?php require_once('foot.php'); ?>