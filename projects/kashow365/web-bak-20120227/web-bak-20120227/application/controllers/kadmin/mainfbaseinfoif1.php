<?php
class MainFBaseInfoIF1 extends CI_Controller {

 function __construct()
 {
  parent::__construct();
  
  $this->load->helper('url');
  $this->load->helper('form');
  $this->load->helper(array('form', 'url'));
  $this->load->helper('file');
  
  require_once 'kadmin/businessentity/tools/formvalidation.php';
  require_once 'kadmin/businessentity/tools/common.php';
  require_once 'kadmin/businessentity/tools/file.class.php';
  
  $this->load->model('kadmin/kainfo/mainfbaseinfoif_model','MainFBaseInfoIFModel');
 }

 function index()
 {
 	// page pramas
 	parse_str($_SERVER['QUERY_STRING'],$_GET);
 	$order = '';
 	if( isset($_REQUEST['order']) )
 		$order = trim($_REQUEST['order']);
 	$by = '';
 	if( isset($_REQUEST['by']) )
 		$by = trim($_REQUEST['by']);
	$pageIndex = '1';
 	if( isset($_REQUEST['n']) )
 		$pageIndex = trim($_REQUEST['n']);
 	
 	/////////////////////////////////////////////////////
 	// where 
  	$where = 'infoType` = \'IndexFlashTop2\' ';
	#var_dump($where);
	// order by 
 	$orderby = '';
	if($order != '')
	{
		$orderby = ($by == '' or $by == 'a')  ?  $order.'` ASC ' : $order.'` DESC ';
	}
	else
	{
		$orderby = 'orderNum DESC ';
	}
 	if($by == ''){$by='d';}
	#var_dump($orderby);
	/////////////////////////////////////////////////////
	// select db
 	$rows = $this->MainFBaseInfoIFModel->GetEntityAll($where, $orderby);
	
 	// page To Index
 	$data = array(
		'title' => $this->config->item('AdminSystem_Title')
 		,'by' => $by
 		,'rows' => $rows
	);
	$this->load->view('kadmin/kainfo/mainfbaseinfoif1.php', $data);
 }

 
 
 /* Add & Eidt */
 /* Add */
 function add()
 {
 	// 恢复form数据
	$formdata = array(
		'id' => ''
		,'value1' => ''
		,'value2' => ''
		,'value3' => ''
		,'orderNum' => '0'
		,'uploadError' => ''
	);
	$this->RestoreFormDate($formdata);
 }
 
/* edit */
 function edit($id='')
 {
 	if($id == '')
 	{
 		// 进入操作信息提示页 
		$data = array(
			'title' => '操作失败'
			,'message' => '修改“首页Flash”出错：未传入编号'
			,'nexturl' => site_url("kadmin/mainfannount")
		);
		FormValidation::GotoOperMsgPage($data, $this);
		return;
 	}
 	
 	// DB操作
	$entity = $this->MainFBaseInfoIFModel->GetEntityById($id);
	
	if($entity == null)
	{
		$this->output->set_output('未找到实体');
		return;
	}
	
	// 恢复form数据
	$formdata = array(
		'id' => $entity['id']
		,'value1' => $entity['value1']
		,'value2' => $entity['value2']
		,'value3' => $entity['value3']
		,'orderNum' => $entity['orderNum']
		,'uploadError' => ''
	);
	$this->RestoreFormDate($formdata);
 }
 
 function doadd()
 {
 	// 获得form页面数据
	$formDBdata = array(
		'id' => $this->input->post('id')
		,'value1' => array_key_exists("userfile",$_FILES) ? $_FILES['userfile']['name'] : ''
		,'value2' => $this->input->post('value2')
		,'value3' => $this->input->post('value3')
		,'orderNum' => $this->input->post('orderNum')
		,'infoType' => $this->input->post('infoType')
	);
	$formdata = array(
		'id' => $this->input->post('id')
		,'value1' => array_key_exists("userfile",$_FILES) ? $_FILES['userfile']['name'] : ''
		,'value2' => $this->input->post('value2')
		,'value3' => $this->input->post('value3')
		,'orderNum' => $this->input->post('orderNum')
		,'infoType' => $this->input->post('infoType')
		,'uploadError' => ''
	);

 	// 启用CI的form库
	$this->load->helper(array('form', 'url'));
	$this->load->library('form_validation');
	
	// 控件校验
	$this->form_validation->set_rules('value2', '跳转URL ', 'trim|required|max_length[100]');
	$this->form_validation->set_rules('value3', '显示文本', 'trim|required|max_length[100]');
	$this->form_validation->set_rules('orderNum', '排序', 'required|numeric|max_length[6]');
	
	#var_dump($formdata['value1']);
	/////////////////////////////////////////////////////////////////////////////
	// 上传文件
	if($formdata['value1'] !='')
	{
		$uploadConfig['upload_path'] = $this->config->item('FilePathFlashIndex');;
	  	$uploadConfig['allowed_types'] = 'gif|jpg|png';
		$uploadConfig['max_size'] = $this->config->item('upload_maxSize');
		$uploadConfig['max_width']  = '1024';
		$uploadConfig['max_height']  = '768';
		$uploadConfig['encrypt_name']  = true;
		
		$this->load->library('upload', $uploadConfig);
		$this->upload->display_errors('<div class="message_row">', '</div>');
		if ( ! $this->upload->do_upload())
		{
		    $uploadError = array('error' => $this->upload->display_errors());
		    $formdata['uploadError'] = $uploadError['error'];
			// 出错恢复form数据并返回
			$this->RestoreFormDate($formdata);
			return;
		} 
		else
		{
		   $uploadedData = array('upload_data' => $this->upload->data());
		   $formDBdata['value1'] = $uploadedData["upload_data"]['file_name'];
		} 
	}
	else if($formdata['id'] == '')
	{
		    $formdata['uploadError'] = '未选择要上传的文件';
			// 出错恢复form数据并返回
			$this->RestoreFormDate($formdata);
			return;
	}
	
	///////////////////////////////////////////////////////
	// 检查页面数据
	if ($this->form_validation->run() == FALSE)// 有错
	{
		// DEL原图片
		KXFile::DeleteFile($this->config->item('UpPathFlashIndex'), $formDBdata['value1']);
			
		// 出错恢复form数据并返回
		$this->RestoreFormDate($formdata);
	}
	else// 无错可操作
	{
		// DB操作
		if($formdata['id'] == '')
		{	
 			$result = $this->MainFBaseInfoIFModel->Insert($formDBdata);
		}
		else
		{
			$nowTime=date("Y-m-d H:i:s");
			$entity = $this->MainFBaseInfoIFModel->GetEntityById($formDBdata['id']);
			$oldPicName = $entity['value1'];
			if($formDBdata['value1'] == '')
			{
				unset($formDBdata['value1']);
			}else 
			{
				$entity['value1'] = $formDBdata['value1'];
			}
			$entity['value2'] = $formDBdata['value2'];
			$entity['value3'] = $formDBdata['value3'];
			$entity['orderNum'] = $formDBdata['orderNum'];
			$entity['updateDateTime'] =  $nowTime;
			$result = $this->MainFBaseInfoIFModel->Update($entity);
			
			// 图片有修改则删除原图片
			if($oldPicName!=$entity['value1'])// DEL原图片 
			{
				KXFile::DeleteFile($this->config->item('UpPathFlashIndex'), $oldPicName);
			}
		}
			
		if($result=="1") // 操作成功
		{
			// 进入操作信息提示页  - 协带参数
			$data = array(
				'title' => '操作成功'
				,'message' => '“生活广场-FLASH”发布成功！'
				,'nexturl' => site_url("kadmin/mainfbaseinfoif1")
			);
			FormValidation::GotoOperMsgPage($data, $this);
		}
		else 
		{
			// 进入操作信息提示页 
			$data = array(
				'title' => '操作失败'
				,'message' => '“生活广场-FLASH”发布出错：' + $result
				,'nexturl' => site_url("kadmin/mainfbaseinfoif1/add")
			);
			FormValidation::GotoOperMsgPage($data, $this);
		}
	}
 }
 /* End Add & Eidt */
 
 /* Update State */
 function doupdate()
 {
 	/////////////////////////////////////////////////////
	// select db
	// 获得首页Flash集合
	// where 
  	$where = 'infoType` = \'IndexFlashTop1\' ';
 	$rows = $this->MainFBaseInfoIFModel->GetEntityAll($where);
 	#var_dump($rowsGrade);
 	
 	$this->load->helper(array('form', 'url'));
	$this->load->library('form_validation');
	foreach ($rows as $row):
		$inputId='p'.$row['id'];
		$this->form_validation->set_rules($inputId, '排序', 'required|numeric|max_length[6]');
 	endforeach;

	 
	// 检查页面数据
	if ($this->form_validation->run() == FALSE)// 有错
	{
		// 恢复form数据
		$this->index();
	}
	else// 无错可操作
	{
	 	// DB操作
		$this->load->database();
		// start trans
    	$this->db->trans_start();
		foreach ($rows as $row):
			$inputId='p'.$row['id'];
			if(isset($_POST[$inputId]))
			{
				$entity['id'] = $row['id'];
				$entity['orderNum'] = $_POST[$inputId];
				$nowTime=date("Y-m-d H:i:s");
				$entity['updateDateTime'] = $nowTime;
				$result = $this->MainFBaseInfoIFModel->UpdateByOrderNum($entity);
			}
	 	endforeach;
	 
		// do trans
		if ($this->db->trans_status() === FALSE)
		{
			$this->db->trans_rollback();
			// 进入操作信息提示页 
			$data = array(
				'title' => '操作失败'
				,'message' => '修改“首页Flash”出错：' + $result
				,'nexturl' => site_url("kadmin/mainfbaseinfoif1")
			);
			FormValidation::GotoOperMsgPage($data, $this);
		}
		else 
		{
			$this->db->trans_commit();
			// 进入操作信息提示页  - 协带参数
			$data = array(
				'title' => '操作成功'
				,'message' => '修改“首页Flash”成功！'
				,'nexturl' => site_url("kadmin/mainfbaseinfoif1")
			);
			FormValidation::GotoOperMsgPage($data, $this);
		} 
	}
 }
 /* End Update State */
 

 /* del */
 function d($id='')
 {
 	if($id == '')
 	{
 		// 进入操作信息提示页 
		$data = array(
			'title' => '操作失败'
			,'message' => '删除“首页Flash”出错：未传入编号'
			,'nexturl' => site_url("kadmin/mainfbaseinfoif1")
		);
		FormValidation::GotoOperMsgPage($data, $this);
		return;
 	}
 	
 	// DB操作
	$entity = $this->MainFBaseInfoIFModel->Delete($id);
	
	// 进入操作信息提示页  - 协带参数
	$this->GotoOperMsgPage('“首页Flash”删除成功！');
 } 
 function ds($ids='')
 {
 	#var_dump($ids);
 	$idsArray = explode('-', $ids);
 	#var_dump($idsArray);
 	
 	if($ids == '')
 	{
 		// 进入操作信息提示页 
		$data = array(
			'title' => '操作失败'
			,'message' => '删除“首页Flash”出错：未传入编号'
			,'nexturl' => site_url("kadmin/mainfbaseinfoif1")
		);
		FormValidation::GotoOperMsgPage($data, $this);
		return;
 	}
 	
 	// DB操作
	$result = $this->MainFBaseInfoIFModel->Deletes($idsArray);
		
 	if($result=="1") // 操作成功
	{
		// 进入操作信息提示页  - 协带参数
		$this->GotoOperMsgPage('多个“首页Flash”删除成功！');
	}
	else 
	{
		// 进入操作信息提示页 
		$data = array(
			'title' => '操作失败'
			,'message' => '“首页Flash”发布出错：' + $result
			,'nexturl' => site_url("kadmin/mainfbaseinfoif1/add")
		);
		FormValidation::GotoOperMsgPage($data, $this);
	}
 }
 

 function GotoOperMsgPage($message)
 {
 	// 进入操作信息提示页 
	$data = array(
		'title' => '操作成功'
		,'message' => $message
		,'nexturl' => site_url("kadmin/mainfbaseinfoif1")
	);
	FormValidation::GotoOperMsgPage($data, $this);
 }
 /* del end */
 
  /* public */
 function RestoreFormDate($formdata)
 {
 	// 恢复form数据
	$data = array(
		'title' => $this->config->item('AdminSystem_Title')
		,'id' => $formdata['id']
		,'value1' => $formdata['value1']
		,'value2' => $formdata['value2']
		,'value3' => $formdata['value3']
		,'orderNum' => $formdata['orderNum']
		,'uploadError' => $formdata['uploadError']
	);
	$this->load->view('kadmin/kainfo/mainfbaseinfoif1add.php', $data);
	
 }
 /* End public */
}
?>