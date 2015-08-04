<?php
namespace application\control;
use system\core\control;
use system\core\filter;
/**
 * 商品多属性和商品价格库存编号之间的映射关系控制器
 * @author jin12
 *
 */
class collectionControl extends control
{
	
	/**
	 * 根据商品pid，属性关系表，查询价格库存和编码
	 */
	function find()
	{
		$pid = filter::int($this->get->pid);
		$content = htmlspecialchars_decode($this->get->content);
		$content = json_decode($content);
		if(!empty($content))
		{
			$collectionModel = $this->model('collection');
			$result = $collectionModel->find($pid,$content);
			return json_encode(array('code'=>1,'result'=>'ok','body'=>$result));
		}
		return json_encode(array('code'=>0,'result'=>'failed'));
	}
}