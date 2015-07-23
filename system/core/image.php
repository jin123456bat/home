<?php
namespace system\core;

/**
 * 图像的处理类
 *
 * @author 程晨
 *        
 */
class image
{

	/**
	 * 生成验证码 验证码保存在$_SESSION['code']中 目前只实现了数字
	 * 
	 * @param int $lenth
	 *        	验证码长度
	 * @param string $type
	 *        	验证码类型 num|chinese 字符和中文
	 */
	function code($width = 100, $heigh = 30, $lenth = 4, $type = 'num')
	{
		$image = imagecreatetruecolor($width, $heigh);
		
		$bgcolor = imagecolorallocate($image, 0, 0, 0); // 背景色
		$fontcolor = imagecolorallocate($image, 255, 255, 255); // 文字颜色
		
		for($i = 0;$i < $lenth;$i ++)
		{
			$linecolor = imagecolorallocate($image, rand(1, 255), rand(1, 255), rand(1, 255)); // 线条颜色
			imageline($image, rand(0, $width), rand(0, $heigh), rand(0, $width), rand(0, $heigh), $fontcolor);
		}
		
		for($i = 0;$i < 200;$i ++)
		{
			$pixelcolor = imagecolorallocate($image, rand(1, 255), rand(1, 255), rand(1, 255)); // 点
			imagesetpixel($image, rand(0, $width), rand(0, $heigh), $pixelcolor);
		}
		$rand_num = '';
		for($i = 0;$i < $lenth;$i ++)
		{
			switch($type)
			{
				case 'num':
					$rand_num .= rand(0, 9);
					break; // 生成随即字体
				case 'chinese':
					$rand_num = iconv('gb2312', 'utf-8', "桃李湖畔");
					break;
			}
		}
		switch($type)
		{
			case 'num':
				imagestring($image, 60, rand(3, $width - 30), rand(0, $heigh - 12), $rand_num, $fontcolor);
				break;
			case 'chinese':
				imagettftext($image, rand(5, $heigh / 2), rand(- 9, 9), rand(0, $width / 2), rand(0, $heigh / 2), $fontcolor, ROOT . '/include/code.ttf', $rand_num);
				break;
		}
		$_SESSION['code'] = $rand_num;
		header("Content-type: image/jpeg");
		imagejpeg($image);
		return $_SESSION['code'];
	}
}