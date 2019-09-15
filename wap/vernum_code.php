<?php 
header("Content-Type:image/png");
session_start();
$width=70;
$height=25;
function ver_num($len)
{$charset="123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ";
	$str_ver="";
	for($i=1;$i<=$len;$i++)
		{
			$str_ver=$str_ver.$charset[rand(0,34)];	
		}
	return $str_ver;
}
$str=ver_num(4);		//4位验证码
$_SESSION['code']=$str;	
//创建图像
$img=imagecreate($width,$height);
//颜色列表
$bordercolor=imagecolorallocate($img,22,25,25);
$bgcolor=imagecolorallocate($img,255,255,160);
$pixcolor=imagecolorallocate($img,200,200,20);
$font_color=imagecolorallocate($img,rand(50,225),rand(50,125),rand(50,125));
$linecolor = $font_color;
//描画边框并填充背景
imagerectangle($img,0,0,$width-1,$height-1,$bordercolor);
imagefilledrectangle($img,0,0,$width,$height,$bgcolor);
//描绘杂点
for($i=0;$i<=500;$i++)
{
	imagesetpixel($img,rand(1,$width-1),rand(1,$height-1),$pixcolor);	
}
//画线
imageline($img,rand(1,29), rand(1,29),rand(1,99), rand(1,29),$linecolor);
imageline($img,rand(1,29), rand(1,29),rand(1,99), rand(1,29),$linecolor);
imageline($img,rand(1,29), rand(1,29),rand(1,99), rand(1,29),$linecolor);

//出字
for($i=0;$i<strlen($str);$i++)
{
	//imagettftext($img,18,rand(0,40),18*($i+1),23,$font_color,'../LFAXD.TTF',$str[$i]);
	imagestring($img,6,12*($i+1),3,$str[$i],$font_color);
}
imagepng($img);
imagedestroy($img);
?>
