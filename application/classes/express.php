<?php
namespace application\classes;
use system\core\random;
/**
 * 快递查询接口
 * @author jin12
 *
 */
class express
{
	/**
	 * 物流接口查询
	 * @param unknown $com 快递方代码  SF EMS
	 * @param unknown $waybills 快递单号
	 * @param string $order 排序方式 desc asc
	 */
	function query($com,$waybills,$order = 'desc')
	{
		$url = 'http://m.kuaidi100.com/query?type='.$com.'&postid='.$waybills.'&id=1&valicode=&temp='.random::number(10);
		$curl = curl_init();
		curl_setopt ($curl, CURLOPT_URL, $url);
		curl_setopt ($curl, CURLOPT_HEADER,0);
		curl_setopt ($curl, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt ($curl, CURLOPT_USERAGENT,$_SERVER['HTTP_USER_AGENT']);
		curl_setopt ($curl, CURLOPT_TIMEOUT,5);
		$get_content = curl_exec($curl);
		if($get_content === false)
		{
			echo curl_error($curl);
		}
		curl_close ($curl);
		return $get_content;
	}
	
	/**
	 * 生成虚拟物流信息
	 * @param unknown $shiptime 发货时间
	 * @param unknown $outship 是否出关
	 */
	function virtual($shiptime,$outship)
	{
		if($outship == 0)
		{
			$time = $_SERVER['REQUEST_TIME'] - $shiptime;
			$step = floor($time/24/3600)+1;
	
			if($step>6)
				$step = 6;
		}
		else
		{
			if($outship == 1)
				$step = 7;
		}
		
		$store = array('Verbania','Torino', 'Vercelli', 'Pavia', 'Novara', 'Venezia', 'Brescia', 'Como','Bologna');
		$person = array('Giovanni', 'Antonio', 'Piero', 'Francesco','Niccolo', 'Andrea', 'Matteo', 'Simone');
		$data = array(
			'您的订单已提交，系统已确认',
			'我们家驻'.$store[array_rand($store)].'集运仓拣货中',
			'拣货完毕，快递专员'.$person[array_rand($person)].'已取件，正在运往⽶米兰集运总仓',
			'米兰集运仓扫描成功，正在运往Linate国际机场',
			'快件已到达Linate国际机场，下⼀一站运往杭州萧山国际机场',
			'快件到达杭州萧⼭山国际机场，等待关检（出关）',
			'您的快件已顺利出关，交付国内快递',
		);
		
		$return = array();
		
		for($i=0;$i<$step;$i++)
		{
			$time = $shiptime + ($i-1)*24*3567;
			$return[] = array(
				'time' => date("Y-m-d H:i:s",$time),
				'context' => $data[$i]
			);
		}
		
		$return = array_reverse($return);
		return $return;
	}
}