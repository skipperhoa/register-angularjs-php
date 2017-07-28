<?php

	//tạo kết nối
  $conn =  mysql_connect('localhost','skipperhoa','0975595084') or die("kết nối không thành công!");
  //select database
  mysql_select_db('basic_nodejs',$conn);//gọi database
  mysql_query("set names 'utf8'");
  $data = array();//tạo mảng
  if(isset($_GET['info_data']) && $_GET['info_data']!=""){//kiểm tra có tồn tại hay không
  		if($_GET['info_id']==1 || $_GET['info_id']==2){//nếu là 1 và 2 mình dùng để kiểm tra user và email
  			$sql = "select * from users where USERNAME='".$_GET['info_data']."' or EMAIL='".$_GET['info_data']."'";
  			$result = mysql_query($sql,$conn);
  			if(mysql_num_rows($result)>0){//nếu user và email này có tồn tại rồi thì trả về 1 ngược lại 0
  				$data['success']=1;
          $data['info']=$_GET['info_data'];
  				 echo json_encode($data);//trả về kiểu json nhé các bạn
  			}else{
  				$data['success']=0;
  				 echo json_encode($data);
  			}
  		}
  }
  else{
  	$data['success']=0;
  	$data['info']=$_GET['info_data'];
  	echo json_encode($data);
  }
 