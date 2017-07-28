<?php
	
	$conn =  mysql_connect('localhost','skipperhoa','0975595084') or die("kết nối không thành công!");
  //select database
  mysql_select_db('basic_nodejs',$conn);
  mysql_query("set names 'utf8'");
  $data = json_decode(file_get_contents("php://input"));//láy tất cả các thông tin chuyển về kểu json 
  $ketqua = array();//tạo mảng lưu thông tin kiểm tra
  if($data->info_user!="" && $data->info_email!=""){
  		$sql = "INSERT INTO users(`USERNAME`,`PASSWORD`,`EMAIL`) VALUES('".$data->info_user."','".md5($data->info_pass)."','".$data->info_email."')";
  		$result = mysql_query($sql,$conn);
  		if(mysql_insert_id()>0){
  			$ketqua['success']=1;
  			echo json_encode($ketqua);
  		}
  		else{
  			$ketqua['success']=0;
  			echo json_encode($ketqua);
  		}
  }
