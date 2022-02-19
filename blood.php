<?php include 'header2.php';?>
<?php
	$tbl_name="bloods"; 
    $where = "";
    if(isset($_POST['searchBtn']))
    {
        
      $CITY_NO =$_POST['CITY_NO'];
      if($CITY_NO != "-1"){
        $where.=" AND `users`.`CITY_NO`= '$CITY_NO'";
      }
      $AREA_NO =$_POST['AREA_NO'];
      if($AREA_NO != "-1"){
        $where.=" AND `users`.`AREA_NO`= '$AREA_NO'";
      }
    }

     $sql = "SELECT * FROM $tbl_name  LEFT JOIN `users` ON `users`.`user_no`=$tbl_name.`user_no` LEFT JOIN `areas` ON `areas`.`AREA_NO`=`users`.`AREA_NO` LEFT JOIN `cities` ON `cities`.`CITY_NO`=`users`.`CITY_NO` WHERE 1 $where ORDER  BY $tbl_name.`BLOOD_NO` DESC";
    $result = mysqli_query($con,$sql);
?>
<div class="container" style="margin-top: 85px;">
      <div class="row">
        <div class="col d-flex flex-column justify-content-center" style="background: #fff;box-shadow: 0px 0 30px rgb(1 41 112 / 8%);margin: 50px 0px;padding:70px 50px">
        		<h3 style="text-align: center;padding-bottom: 20px;">Blood Bank</h3>

                <form method="post">
                  <div class="row">
                    <div class="col-md-5">
                      <select class="form-control" name="CITY_NO" id="CITY_NO">
                        <option value="-1">--Select City--</option>
                            <?php
                                $sql="SELECT * FROM `cities` WHERE `IS_DELETED`=0";
                                $query=mysqli_query($con,$sql);
                                while($row=mysqli_fetch_array($query)):
                            ?>
                                <option value="<?=$row['CITY_NO']?>"><?=$row['CITY_NAME']?></option>
                            <?php endwhile; ?>
                        </select>
                    </div>
                    <div class="col-md-5">
                      <select class="form-control" id="AREA_NO" name="AREA_NO" required="">
                            <option value="-1">--Select One--</option>
                        </select>
                    </div>
                    <div class="col">
                        <button type="submit" id="searchBtn" name="searchBtn" class="btn btn-primary">Search</button>
                    </div>
                  </div>
                </form><br><br><br>


                <?php while($row = mysqli_fetch_array($result)):?>
                    <div style="background: #f7f7f7;margin: 8px 0px;padding: 20px;border: 1px solid #eee">
                        <p style="color: #4154f1;margin-bottom: 6px;"><?=$row['user_full_name']?></p>
                        <p style="margin: 0px;font-size: 13px;"><?=$row['CITY_NAME']?>, <?=$row['AREA_NAME']?></p>
                        <p style="margin: 3px;"><?=$row['BLOOD_GROUP']?></p>
                        <p style="margin: 3px;"><?=$row['QUANTITY']?> Bag Available<br><span><?=$row['PRICE']?> BDT / Bag</span></p>
                        <p style="margin: 0px;">Contact No: <?=$row['user_contact']?></p>
                    </div>
                <?php endwhile;?>
        </div>
      </div>
</div>

<?php include 'footer.php';?>
<script type="text/javascript">
    $(document).ready(function(){
        
        $("#CITY_NO").on("change",function(){
            var CITY_NO = $(this).val();
            if(CITY_NO!= -1){
                $.post("admin/soft/ajax/get_area.php",{CITY_NO:CITY_NO},function(data){
                   $("#AREA_NO").html(data);
                });
            }else{
                $("#AREA_NO").html("<option value='-1'>--Select One--</option>");
            }
        });
    });
</script>