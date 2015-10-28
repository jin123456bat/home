<?php
namespace application\control;

use system\core\control;
use application\model\orderlistModel;
use application\message\json;
/**
 * 统计接口
 * @author jin12
 *
 */
class statisticsControl extends control
{
	/**
	 * 会员统计
	 */
	function user()
	{
		$userModel = $this->model('user');
		$num = $userModel->select('count(id)');
		$num = $num[0]['count(id)'];
		return new json(array('num'=>$num));
	}
	
	/**
	 * 访问量
	 * @return \application\message\json
	 */
	function visitor()
	{
		$user_login_log = $this->model('user_login_log');
		
		
		
		$return = array();
		for($i=0;$i<12;$i++)
		{
			$month = date("m");
			$endYear = $startYear = date("Y");
			
			$month -= $i;
			
			$startMonth = $month;
			$endMonth = $month+1;
			
			
			if($startMonth<1)
			{
				$startYear -= 1;
				$startMonth += 12;
			}
			if($endMonth<1)
			{
				$endMonth += 12;
				$endYear -=1;
			}
			
			if ($endMonth>12)
			{
				$endMonth -= 12;
				$endYear += 1;
			}
			if($startMonth>12)
			{
				$startMonth -= 12;
				$startYear += 1;
			}
			
			$strTimeStart = $startYear.'-'.$startMonth.'-1 0:0:0';
			$strTimeEnd = $endYear.'-'.$endMonth.'-1 0:0:0';
			$start = strtotime($strTimeStart);
			$end = strtotime($strTimeEnd);
		
			$num = $user_login_log->where('time>? and time<?',array($start,$end))->select('count(id)');
			$return[] = array($startMonth.'/'.$startYear,$num[0]['count(id)']);
		}
		$return = array_reverse($return);
		return new json($return);
	}
	
	/**
	 * 财务报表
	 */
	function revenue()
	{
		$year = $this->get->year;
		$orderModel = $this->model('orderlist');
		if(empty($year))
		{
			$return = array();
			$yearTime = $orderModel->where('tradetime != ?',array(0))->select('min(tradetime)');
			$year = date("Y",$yearTime[0]['min(tradetime)']);
			$currentYear = date("Y");
			for(;$year<=$currentYear;$year++)
			{
				$return[] = $year;
			}
			return new json($return);
		}
		else
		{
			$total = array();
			//计算月收益
			$return = array();
			for ($month = 1;$month<13;$month++)
			{
				$strTimeStart = $year.'-'.$month.'-1 0:0:0';
				$strTimeEnd = $year.'-'.($month+1).'-1 0:0:0';
				if($month+1>12)
				{
					$strTimeEnd = ($year+1).'-1-1 0:0:0';
				}
				$starttimeStamp = strtotime($strTimeStart);
				$endtimeStamp = strtotime($strTimeEnd);
				//去除退款的
				$sum = $orderModel->where('tradetime != 0 and tradetime<? and tradetime>? and status!=7',array($endtimeStamp,$starttimeStamp))->select('sum(totalamount)');
				
				$return[] = array($month.'/'.$year,$sum[0]['sum(totalamount)']);
			}
			$total['table'] = $return;
			
			//计算年收益
			$starttimeStamp = strtotime($year.'-1-1 0:0:0');
			$endtimeStamp = strtotime(($year+1).'-1-1 0:0:0');
			//去除退款的
			$sum = $orderModel->where('tradetime != 0 and tradetime<? and tradetime>? and status!=7',array($endtimeStamp,$starttimeStamp))->select('sum(totalamount)');
			$total['revenue'] = $sum[0]['sum(totalamount)'];
			
			//计算税费
			$sum = $orderModel->where('tradetime != 0 and tradetime<? and tradetime>? and status!=7',array($endtimeStamp,$starttimeStamp))->select('sum(ordertaxamount)');
			$total['tax'] = $sum[0]['sum(ordertaxamount)'];
			
			//计算运费
			$sum = $orderModel->where('tradetime != 0 and tradetime<? and tradetime>? and status!=7',array($endtimeStamp,$starttimeStamp))->select('sum(feeamount)');
			$total['shipment'] = $sum[0]['sum(feeamount)'];
			
			$sum = $orderModel->where('tradetime<? and tradetime>?',array($endtimeStamp,$starttimeStamp))->select('count(id)');
			$total['order'] = $sum[0]['count(id)'];
			return new json($total);
		}
	}
	
	/**
	 * 客户来源
	 * @return \application\message\json
	 */
	function client()
	{
		switch ($this->get->type)
		{
			case 'order':
				$orderModel = $this->model('orderlist');
				$ios = $orderModel->where('client=?',array('ios'))->select('count(id)');
				$android = $orderModel->where('client=?',array('android'))->select('count(id)');
				$weixin = $orderModel->where('client=?',array('weixin'))->select('count(id)');
				$wap = $orderModel->where('client=?',array('wap'))->select('count(id)');
				$web = $orderModel->where('client=?',array('web'))->select('count(id)');
				$data = array(
					'ios' => $ios[0]['count(id)'],
					'android' => $android[0]['count(id)'],
					'weixin' => $weixin[0]['count(id)'],
					'wap' => $wap[0]['count(id)'],
					'web' => $web[0]['count(id)'],
				);
				return new json($data);
				break;
			case 'user':
				$userModel = $this->model('user');
				$ios = $userModel->where('client=?',array('ios'))->select('count(id)');
				$android = $userModel->where('client=?',array('android'))->select('count(id)');
				$weixin = $userModel->where('client=?',array('weixin'))->select('count(id)');
				$wap = $userModel->where('client=?',array('wap'))->select('count(id)');
				$web = $userModel->where('client=?',array('web'))->select('count(id)');
				$data = array(
					'ios' => $ios[0]['count(id)'],
					'android' => $android[0]['count(id)'],
					'weixin' => $weixin[0]['count(id)'],
					'wap' => $wap[0]['count(id)'],
					'web' => $web[0]['count(id)'],
				);
				return new json($data);
			default:break;
		}
	}
	
	/**
	 * 订单统计
	 * @return \application\message\json
	 */
	function order()
	{
		$orderModel = $this->model('orderlist');
		
		$profitStatus = array(
			orderlistModel::STATUS_COMPLETE,
			orderlistModel::STATUS_SHIPPED,
		);
		
		$profit = $orderModel->where('status in (?)',$profitStatus)->select('sum(ordertotalamount)');
		$num = $orderModel->select('count(id)');
		
		return new json(array(
			'profit'=>$profit[0]['sum(ordertotalamount)'],
			'ordernum' => $num[0]['count(id)']
		));
	}
	
	/**
	 * 流水中的统计
	 */
	function swift()
	{
		$uid = $this->session->id;
		$swfitModel = $this->model('swift');
		$drawal = $swfitModel->where('uid=? and note=?',array($uid,'提现'))->select('sum(money)');
		return new json(array('drawal'=>$drawal['sum(money)']));
	}
	
	function refund()
	{
		
	}
	
	/**
	 * 商品统计
	 * @return \application\message\json
	 */
	function product()
	{
		$productModel = $this->model('product');
		$num = $productModel->select('count(id)');
		
		return new json(array(
			'num'=>$num[0]['count(id)']
		));
	}
}