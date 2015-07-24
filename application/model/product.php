<?php
namespace application\model;

use system\core\model;
class productModel extends model
{
	/**
	 * 删除品牌下所有产品
	 * @param unknown $brand_id
	 * @return \system\core\Ambigous
	 */
	function deleteByBrand($brand_id)
	{
		return $this->where('bid=?',array($brand_id))->delete();
	}
}