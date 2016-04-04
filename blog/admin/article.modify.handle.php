<?php
require_once('connect.php');
session_start();
if (isset($_SESSION['user'])) {
	if (!isset($_POST['title']) || empty($_POST['title'])
	||!isset($_POST['author']) || empty($_POST['author'])
	||!isset($_POST['tips']) || empty($_POST['tips'])
	||!isset($_FILES['mypic']) || empty($_FILES['mypic'])
	||!isset($_POST['content']) || empty( $_POST['content'])) {
		echo "<script>alert('信息没有写全，请写全');window.location.href='index.php';</script>";
	    return ;
	}
	$id = $_POST['id'];
	$type = $_POST['key'];
	$title = $_POST['title'];
	$author = $_POST['author'];
	$description = $_POST['tips'];
	$content = $_POST['content'];
	$time = date("Y/m/d");

		
	function uploadFile($fileInfo,$flay = true,$allowExt = array('jpeg','jpg','gif','png'),$Maxsize = 2097152,$uploadPath = 'web'){
		//判断错误号
		if ($fileInfo['error']>0) {
			switch ($fileInfo['error']) {
				case '1':
					$mes = "上传的文件超过了PHP文件中upload_max_filesize选择的值";
					break;
				case '2':
					$mes =  "超过了表单MAX_FILE_SIZE限制的大小";
					break;
				case '3':
					$mes =  "文件被部分上传";
					break;
				case '4':
					$mes =  "没有选择文件";
					break;
				case '6':
					$mes = "没有找到临时文件";
					break;
				case '7':
				case '8':
					$mes =  "系统错误";
					break;
			}
			exit($mes);
		}
		//检测上传文件的类型
		$ext = pathinfo($fileInfo['name'],PATHINFO_EXTENSION);
		if (!in_array($ext, $allowExt)) {
			exit('非法文件类型');
		}
		//检测上传文件是否符合大小
		if ($fileInfo['size']>$Maxsize) {
			exit('上传文件过');
		}
		//检测文件时否通过HTTP post方式上传的
		if (!is_uploaded_file($fileInfo['tmp_name'])) {
			exit('文件不是通过HTTP POST方式上传上来的');
		}
		//检测是否为真实的图片类型
		if ($flay) {
			if (!getimagesize($fileInfo['tmp_name'])) {
			    exit('不是真实的图片类型');
			}
		}
		if (!file_exists($uploadPath)){
			mkdir($uploadPath,0777,true);
			chmod($uploadPath, 0777);
		}
		$uniName = md5(uniqid(microtime(true),true)).'.'.$ext;
		$destination = $uploadPath.'/'.$uniName;
		
		if (!@move_uploaded_file($fileInfo['tmp_name'], $destination)) {
			exit('文件移动失败');
		}
		return  $destination;
	}
	$fileInfo = $_FILES['mypic'];
	$newName = uploadFile($fileInfo);

	switch ($type) {
		case 'web':
			$inset = "update web set title='$title',type='$type',author='$author',description='$description',pic='$newName',content='$content',timer='$time' where id=$id";
		    if (mysql_query($inset)) {
		    	echo "<script>alert('修改web成功');window.location.href='index.php';</script>";
		    } else {
		    	echo mysql_error();
		    	echo "<script>alert('修改web失败');window.location.href='index.php'</script>";		    	
		    }
			break;
		case 'jishu':
			$inset = "update jishu set title='$title',type='$type',author='$author',description='$description',pic='$newName',content='$content',timer='$time' where id=$id";
		    if (mysql_query($inset)) {
		    	echo "<script>alert('修改jishu成功');window.location.href='index.php';</script>";
		    } else {
		    	echo mysql_error();
		    	echo "<script>alert('修改jishu失败');window.location.href='index.php'</script>";		    	
		    }
			break;
		case 'anli':
			$inset = "update anli set title='$title',type='$type',author='$author',description='$description',pic='$newName',content='$content',timer='$time' where id=$id";
		    if (mysql_query($inset)) {
		    	echo "<script>alert('修改anli成功');window.location.href='index.php';</script>";
		    } else {
		    	echo mysql_error();
		    	echo "<script>alert('修改anli失败');window.location.href='index.php'</script>";		  	
		    }
			break;
		default:
			echo "<script>alert('数据库不存在');window.location.href='index.php'</script>";
			break;
	   }	
}else{
	  echo "<div id='check'>";
      echo "你没有权限修改文章，点击下方的链接进行验证<br>";
      echo "<a class='again'href='index.php'>点击验证</a>";
      echo "</div>";
}


?>