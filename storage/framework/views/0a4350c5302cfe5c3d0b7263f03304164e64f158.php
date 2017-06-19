<html>
<head>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>

<style type="text/css">

table {
  max-width: 100%;
  background-color: transparent;
}
th {
  text-align: left;
}
.table {
  width: 100%;
  margin-bottom: 2px;
}
hr {
  
  border: 0;
  border-top: 2px dotted #eee;
}

body {
  font-family: "Helvetica Neue", Helvetica, Arial, sans-serif;
  font-size: 12px;
  line-height: 1.428571429;
  color: #333;
  background-color: #fff;
}



 @page  { margin: 50px 30px; }
 .header { position: fixed; left: 0px; top: 0px; right: 0px; height: 150px;  text-align: center; }
 .content {margin-top: 10px; }
 .footer { position: fixed; left: 0px; bottom: -180px; right: 0px; height: 50px;  }
 .footer .page:after { content: counter(page, upper-roman); }



</style>

</head>

<body>

  <div class="header">
     <table >

      <tr>


       
        <td style="width:150px">

            <?php if($organization->logo == null || $organization->logo == ''): ?>
            <?php else: ?>
            <img src="<?php echo e(public_path().'/uploads/logo/'.$organization->logo); ?>" alt="logo" width="80%" alt="no logo">
            <?php endif; ?>

    
        </td>

        <td>
        <strong>
          <?php echo e(strtoupper($organization->name)); ?><br>
          </strong>
          <?php echo e($organization->phone); ?><br>
          <?php echo e($organization->email); ?><br>
          <?php echo e($organization->address); ?>

       

        </td>
        

      </tr>


    </table>
   </div>

<br>

 
	<div class="content" style='margin-top:50px;'>

   <div align="center"><h3><strong>Advanced Payment Settings</strong></h3></div>
    <table class="table table-bordered" border='1' cellspacing='0' cellpadding='0'>

      <tr>
        <td><strong>#</strong></td>
        <td><strong>Month</strong></td>
        <td><strong>Advanced Payment (% of Total Amount)</strong></td>
      </tr>
      <tr>
        <td>1</td>
        <td>January</td>
        <td><?php echo e($deposit->jan); ?></td> 
      </tr>
      <tr>
        <td>2</td>
        <td>February</td>
        <td><?php echo e($deposit->feb); ?></td> 
      </tr>
      <tr>
        <td>3</td>
        <td>March</td>
        <td><?php echo e($deposit->mar); ?></td> 
      </tr>
      <tr>
        <td>4</td>
        <td>April</td>
        <td><?php echo e($deposit->apr); ?></td> 
      </tr>
      <tr>
        <td>5</td>
        <td>May</td>
        <td><?php echo e($deposit->may); ?></td> 
      </tr>
      <tr>
        <td>6</td>
        <td>June</td>
        <td><?php echo e($deposit->jun); ?></td> 
      </tr>
      <tr>
        <td>7</td>
        <td>July</td>
        <td><?php echo e($deposit->jul); ?></td> 
      </tr>
      <tr>
        <td>8</td>
        <td>August</td>
        <td><?php echo e($deposit->aug); ?></td> 
      </tr>
      <tr>
        <td>9</td>
        <td>September</td>
        <td><?php echo e($deposit->sep); ?></td> 
      </tr>
      <tr>
        <td>10</td>
        <td>October</td>
        <td><?php echo e($deposit->oct); ?></td> 
      </tr>
      <tr>
        <td>11</td>
        <td>November</td>
        <td><?php echo e($deposit->nov); ?></td> 
      </tr>
      <tr>
        <td>12</td>
        <td>December</td>
        <td><?php echo e($deposit->dec); ?></td> 
      </tr>
    </table>

<br><br>

   
</div>


</body>

</html>



