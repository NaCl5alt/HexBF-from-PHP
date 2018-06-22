<?php
function judge($source,$p,$tmp,$output){
	for($i=0;$i<strlen($source);$i++){
		$val=$source[$i];
		/*
		print($source[$i].":".$tmp);
		print("<br>");
		*/
		switch ($val) {
			case ".":
				if($output=="") $output = chr($tmp);
				else $output=$output.chr($tmp);
				break;
			case "+":
				if($p==0) $tmp++;
				else $tmp=$tmp+16*$p;
				break;
			case "-":
				if($p==0) $tmp--;
				else $tmp=$tmp-16*$p;
				break;
			case "<":
				if($p)$p=0;
				else $p=1;
				break;
			case ">":
				if(!$p)$p=1;
				else $p=0;
				break;
			case "[":
				$i_t=$i+1;
				while($val!="]"||$tmp!=0){
					if($val=="]") $i=$i_t;
					else $i++;
					$val=$source[$i];
					/*
					print($source[$i].":".$tmp);
					print("<br>");
					*/
					switch ($val) {
						case ".":
							if($output=="") $output = chr($tmp);
							else $output=$output.chr($tmp);
							break;
						case "+":
							if($p==0) $tmp++;
							else $tmp=$tmp+16*$p;
							break;
						case "-":
							if($p==0) $tmp--;
							else $tmp=$tmp-16*$p;
							break;
						case "<":
							if($p)$p=0;
							else $p=1;
							break;
						case ">":
							if(!$p)$p=1;
							else $p=0;
							break;
						default:
							if($output=="") $output = $val;
							else $output=$output.$val;
							break;
					}
				}
				break;
			default:
				if($output=="") $output = $val;
				else $output=$output.$val;
				break;
		}
	}
	return $output;
}
$source=$_POST["source"];
$p=0;
$tmp=0;
$output="";
$output=judge($source,$p,$tmp,$output);
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
<?php print("$output")?>
</textarea>
<form method="post" action="index.html">
<input type="submit" value="戻る">
</form>
</body>
</html>