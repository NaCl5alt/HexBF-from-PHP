<?php
function judge($source){
	$tmp=0;
	$p=0;
	$n=array(0,0);
	$li=array(0,0,0,0,0,0,0,0,0);
	$flag=0;
	$output="";
	for($count=0;$count<strlen($source);$count++){
		$val=$source[$count];
		if($val=='['){
				$li[$flag]=$count;
				$flag++;
				if($flag==9){
					echo '<h1 style="color:red;">overflow</h1><br>';
					break;
				}
				//goto debug;
				continue;
		}
		switch ($val) {
			case '+':
				$n[$p]++;
				if($n[$p]>15){
					$n[$p]=0;
					if(!$p)$n[1]++;
				}
				break;
			case '-':
				$n[$p]--;
				if($n[$p]<0){
					$n[$p]=15;
					if(!$p)$n[1]--;
				}
				break;
			case '<':
				if($p)$p=0;
				else $p=1;
				break;
			case '>':
				if(!$p)$p=1;
				else $p=0;
				break;
			case '.':
				$tmp=$n[1]*16+$n[0];
				if($output=="") $output = chr($tmp);
				else $output=$output.chr($tmp);
				break;
			case ']':
				if($n[$p])$count=$li[$flag-1];
				else if($flag>0)$flag--;
				break;
			default:
				break;
		}
		/*
		debug:
		echo "count：".$count."<br>val：".$val."<br>p：".$p."<br>";
		echo "n：";
		print_r($n);
		echo "<br>flag：".$flag."<br>li：";
		print_r($li);
		echo "<br>tmp：".$tmp."<br>output：".$output."<br>";
		echo "-----------------------------------------------<br>";
		*/
	}
	return $output;
}
$output=judge($_POST["source"]);
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Output source</title>
</head>
<body>
<h1>Output source</h1>
<textarea cols="30" rows="15">
<?php echo $output;?>
</textarea>
<form method="post" action="index.html">
<input type="submit" value="戻る">
</form>
</body>
</html>