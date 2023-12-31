<?php
session_start();

$con = mysqli_connect('localhost', 'root', 'Dmsgk0302!', 'mydb') or die('Database Connect Fail!!');

$uid = $_SESSION['sId'];


$nameSql = "select * from usertb where userId = '$uid';";
$nameRst = mysqli_query($con, $nameSql);
$userArr = mysqli_fetch_array($nameRst);

$idx = $_GET['idx'];
$sql = "select * from userBoardtb where boardIdx = '$idx'";
$result = mysqli_query($con, $sql);
$bdArr = mysqli_fetch_array($result);

$boardView = $bdArr['boardViews'];
$viewSql = "update userBoardtb set boardViews=boardViews+1 where boardIdx = '$idx'";
$viewRst = mysqli_query($con, $viewSql);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>글쓰기</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Noto+Sans+KR:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="./css/boardView.css">
   

</head>
<body>
    <header>
        <a href="index.html" id="logo">Euna</a>
        <nav>
            <ul>
                <li><a href="boardIndex.php">Board</a></li>
                <li><a href="index.html">Login</a></li>
            </ul>
        </nav>
    </header>
    <main class="wrap" id="view_wrap">
        <section>
            <h1><?php echo $bdArr['boardTitle']; ?></h1>
            <section id="board_wrap"> 
                <div class="board_head">
                    <label>작성자</label>
                    <p><?php echo $userArr['userName']; ?></p> 
                <label>작성일</label>
                <p><?php echo $bdArr['boardDate']; ?></p>
                </div>
                <div class="board_head">
                <label>조회수</label>
	            <p><?php echo $bdArr['boardViews']+1; ?></p>
	             <label>추천수</label>
	            <p><?php echo $bdArr['boardGood']; ?></p>
                </div>    
                <div id="board_detail">
                    <p><?php echo $bdArr['boardDetail']; ?></p>
                </div>
                <?php if($bdArr['boardFile'] != 0) {?>
	<div>
		<a href="Upload/<?php echo $bdArr['boardFile'];?>"download><?php echo $bdArr['boardFile']; ?></a>
	</div>
	<?php } ?>
            </section>
            <div id="view_btn">
	<p>
		<a href="boardIndex.php" class="form_btn" id="back_btn">목록</a>
	</p>
	<?php if($_SESSION['sId'] == $bdArr['userId']){ ?>
	<p>
		<a href="boardUpdate.php?idx=<?php echo $bdArr['boardIdx'] ?>" class="form_btn" id="up_btn">수정</a>
	</p>
	<p>
		<a href="boardDelete.php?idx=<?php echo $bdArr['boardIdx'] ?>" class="form_btn" id="del_btn">삭제</a>
	</p>

	<?php } 
    ?>
</div>
 
</script>
</section>
</main>
</body>
</html>