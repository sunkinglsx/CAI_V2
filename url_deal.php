<?php
	//url����Ԥ����
	function url_deal($str)
	{
		$str=str_replace("'","",$str);	//������
		$str=str_replace(";","",$str);	//�ֺ�
		$str=str_replace(" ","",$str);//�ո�
		$str=str_replace("and","",$str);	//and
		$str=str_replace("or","",$str);	//or
		$str=str_replace("where","",$str);	//�ƻ�sql���ṹ
		$str=str_replace("|","",$str);	//|�ָ���
		$str=str_replace("exe","",$str);		//���˿�ִ��
		$str=str_replace("count","",$str);	//����ͳ��
		$str=str_replace("select","",$str);
		$str=str_replace("insert","",$str);
		$str=str_replace("update","",$str);
		$str=str_replace("(","",$str);
		$str=str_replace(")","",$str);
		if($str=="")
		{ echo "��������ϵͳ������ֹ";
			exit;
		}else 
			return $str; 
	}
?>