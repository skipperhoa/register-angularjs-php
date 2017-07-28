<!DOCTYPE html>
<html ng-app="register">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Register</title>
	<script src="js/angular.min.js" type="text/javascript"></script>
	<script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.6.4/angular-sanitize.js"></script>
	<link rel="stylesheet" href="css/style.css"/>
	<script>	
	var app = angular.module('register',['ngSanitize']);// gọi module ngSanitize để dùng được ng-bind-html
	app.controller('registerController',['$scope','$http',function($scope,$http){// gọi registerController
		//hàm check use
		$scope.check_user = function(){
			var user = $scope.info.username;//lấy giá trị của username
			$scope.load_timkiem_user='<img src="img/loader.gif"/>';//đầu tiên load cái hình lader.gif thì chúng ta thay đôi giá trị trong ô textbox
			setTimeout(function () {//set thời gian để xử lý
				//các bạn dùng $http trong angularjs để chuyền một giá trị qua bên file php xử lý nhé
				//ở đây mình dùng get nhé các bạn, nếu bạn thích thì dùng post nhé, mà post thì đúng hơn nếu bạn bảo mật khi gửi nhé
				//cũng giống như trong ajax bạn tạo một data để gửi qua bên php nhận biến xử lý nhé
		       $http.get('http://localhost/php_angular/check-info.php?info_data='+user+'&info_id=1').then(function(response){
					$scope.kq = response.data;//nhận giá trị trừ php trả về angularjs theo kiểu json
					//console.log(response.data);//show cho chúng ta biết php trả về thông tin gì nhé
					$scope.load_timkiem_user=showkq($scope.kq.success);//check hàm kiểm tra
				},function(response){
				});
		    }, 500);
			
		}
		//hàm check email cũng giống check username
		$scope.check_mail = function(){
			var email = $scope.info.email;//lái tên email
			$scope.load_timkiem_email='<img src="img/loader.gif"/>';
			setTimeout(function () {
				//gởi giá trị sang file php để xử lý nhé
		       $http.get('http://localhost/php_angular/check-info.php?info_data='+email+'&info_id=2').then(function(response){
					$scope.kq = response.data;
					$scope.load_timkiem_email=showkq($scope.kq.success);
				},function(response){});
		    }, 500);
			
		}

		//hàm check password
		$scope.check_pass = function(){
			var pass = $scope.info.password;//lấy thông tin pass
		
				if(pass!="" && pass.length>=8)
					$scope.load_timkiem_pass='<img src="img/check.png"/>';
				else
					$scope.load_timkiem_pass='<img src="img/delete.png"/>';
		
		}

		//hàm gửi để thêm vào csdl nhé
		$scope.send =  function(){
			 $http.post('http://localhost/php_angular/register.php',{"info_user":$scope.info.username,"info_email":$scope.info.email,"info_pass":$scope.info.password},{'Content-Type': 'application/json'}).then(function(response){
					$scope.ketqua = response.data;//nhận giá trị trả về
					if($scope.ketqua.success==1){
						alert("thêm thành công!");
					}
					else{
						alert("thêm không thành công!");
					}
				},function(response){});
		    
		}

		//kiểm tra giá trị
		function showkq(value){
			
			if(value==0){
				return '<img src="img/check.png"/>';
			}
			else{
				return '<img src="img/delete.png"/>';
			}
		}

	}]);

	</script>
</head>
<body>
<header></header>
	<div class="dangky" ng-controller="registerController">
		<div class="form-dangky">
			<form method="post">
				<h2>Register</h2>
				<div class="col_1">
					<input type="text" name="username" ng-model="info.username" required ng-blur="check_user()"/>
					<label for="username">Username</label>
					<span ng-bind-html="load_timkiem_user" class="error"></span>	
				</div>
				<div class="col_1">
					<input type="email" name="email" ng-model="info.email" required ng-blur="check_mail()"/>
					<label for="email">Email</label>
					<span ng-bind-html="load_timkiem_email" class="error"></span>
				</div>
				<div class="col_1">
					<input type="password" name="password" ng-model="info.password" required ng-blur="check_pass()"/>
					<label for="password">Password</label>
					<span ng-bind-html="load_timkiem_pass" class="error"></span>
				</div>
				<h2 class="send" ng-click="send()">Send register</h2>
			</form>
		</div>
	</div>
</body>
</html>