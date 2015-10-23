<?php
namespace application\control;
use system\core\control;
use application\classes\jpush;
use application\classes\login;
use application\model\roleModel;
use system\core\view;
use application\message\json;
/**
 * 极光推送控制器
 * @author jin12
 *
 */
class jpushControl extends control
{
	function send()
	{
		$roleModel = $this->model('role');
		if(login::admin() && $roleModel->checkPower($this->session->role,'jpush',roleModel::POWER_INSERT))
		{
			$content = $this->post->content;
			
			$app_key = $this->model('system')->get('appkey','jpush');
			$master_secret = $this->model('system')->get('mastersecret','jpush');
			$jpush = new jpush($app_key, $master_secret);
			try {
				$result = $jpush->send($content);
			}
			catch (\Exception $e)
			{
				return new json(5,'发送失败',$result);
			}
			if($result->isOk)
			{
				if($this->model('jpush')->create($this->session->id,$content,$result->sendno,$result->msg_id))
				{
					return new json(json::OK);
				}
				return new json(4,'记录失败');
			}
			return new json(json::PARAMETER_ERROR,'推送失败',$result);
		}
		return new json(json::NO_POWER);
	}
	
	function admin()
	{
		$roleModel = $this->model('role');
		if(login::admin() && $roleModel->checkPower($this->session->role,'jpush',roleModel::POWER_ALL))
		{
			$this->view = new view(config('view'), 'admin/jpush.html');
			$this->view->assign('role',$roleModel->get($this->session->role));
			
			$systemModel = $this->model('system');
			$system = $systemModel->fetch('system');
			$system = $systemModel->toArray($system,'system');
			$this->view->assign('system',$system);
			
			$jpush = $this->model('jpush')->fetch('jpush.content,jpush.time,admin.username');
			$this->view->assign('jpush',$jpush);
			
			return $this->view->display();
		}
		else
		{
			$this->response->setCode(302);
			$this->response->addHeader('Location',$this->http->url('admin','index'));
		}
	}
}