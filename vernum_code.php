<?php 
header("Content-Type:image/png");
session_start();
$width=80;
$height=25;
function ver_num($len)
{$charset="1234567890";
	$str_ver="";
	for($i=1;$i<=$len;$i++)
		{
			$str_ver=$str_ver.$charset[rand(0,9)];	
		}
	return $str_ver;
}
$str=ver_num(5);		//5λ��֤��
$_SESSION['code']=$str;	
//����ͼ��
$img=imagecreate($width,$height);
//��ɫ�б�
$bordercolor=imagecolorallocate($img,22,25,25);
$bgcolor=imagecolorallocate($img,255,250,240);
$pixcolor=imagecolorallocate($img,200,200,20);
//$font_color=imagecolorallocate($img,rand(50,225),rand(50,125),rand(50,125));
$font_color=imagecolorallocate($img,178,34,34);
$linecolor = $font_color;
//�軭�߿���䱳��
imagerectangle($img,0,0,$width-1,$height-1,$bordercolor);
imagefilledrectangle($img,0,0,$width,$height,$bgcolor);
//����ӵ�
for($i=0;$i<=200;$i++)
{
	imagesetpixel($img,rand(1,$width-1),rand(1,$height-1),$pixcolor);	
}
//����
imageline($img,rand(1,29), rand(1,29),rand(1,99), rand(1,29),$linecolor);
imageline($img,rand(1,29), rand(1,29),rand(1,99), rand(1,29),$linecolor);
//imageline($img,rand(1,29), rand(1,29),rand(1,99), rand(1,29),$linecolor);

//����
for($i=0;$i<strlen($str);$i++)
{
          imagestring($img,6,12*($i+1),5,$str[$i],$font_color);
	//imagettftext($img,20,rand(0,40),18*($i+1),23,$font_color,"lfaxd.ttf",$str[$i]);
}
imagepng($img);
imagedestroy($img);
?>
