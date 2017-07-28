<?php
  
  //tạo kết nối
  $conn =  mysql_connect('localhost','skipperhoa','0975595084') or die("kết nối không thành công!");
  //select database
  mysql_select_db('basic_nodejs',$conn);
  mysql_query("set names 'utf8'");
  //câu lệnh select trong database
  $sql =  "select * from sinhvien";
  $result = mysql_query($sql,$conn);
  //tạo mảng chứa thông tin sinh viên
  $data['sv'] = array();

  while($rowsv = mysql_fetch_array($result)){
  	$sv = array();
  	$sv['idsv'] = $rowsv['idsv'];
  	$sv['masv'] = $rowsv['masv'];
  	$sv['tensv'] = $rowsv['tensv'];
  	$sv['gioitinh'] = $rowsv['gioitinh'];
  	//đưu mảng sv vào mảng data['sv']
  	array_push($data['sv'], $sv);
  };

  // echo '<pre>';
  // echo print_r($data);
  // echo '</pre>';
  // 
  // 
  echo json_encode($data);
