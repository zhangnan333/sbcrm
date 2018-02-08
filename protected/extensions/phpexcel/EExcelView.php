<?php
	Yii::import('zii.widgets.grid.CGridView');
	
	/**
	* @author nir.shi
	*/	
	class EExcelView extends CGridView
	{
		//Document properties
		public $creator = 'usfine';
		public $title = null;
		public $subject = 'Subject';
		public $description = '';
		public $category = 'aa';
		
		//the PHPExcel object
		public $objPHPExcel = null;
		
		//config
		public $autoWidth = true;
		public $exportType = 'Excel5';
		public $disablePaging = true;
		public $filename = null; //export FileName
		public $stream = true; //stream to browser
		
		//mime types used for streaming
		public $mimeTypes = array(
			'Excel5'	=> array(
				'Content-type'=>'application/vnd.ms-excel',
				'extension'=>'xls',
			),
			'Excel2007'	=> array(
				'Content-type'=>'application/vnd.ms-excel',
				'extension'=>'xlsx',
			),
			'PDF'		=>array(
				'Content-type: application/pdf',
				'extension'=>'pdf',
			),
			'HTML'		=>array(
				'Content-type'=>'text/html',
				'extension'=>'html',
			),
			'CSV'		=>array(
				'Content-type'=>'application/csv',			
				'extension'=>'csv',
			)
		);
		
		public function init()
		{
			$this->title = $this->title ? $this->title : Yii::app()->getController()->getPageTitle();
			parent::init();
			//Autoload fix
			spl_autoload_unregister(array('YiiBase','autoload'));             
			Yii::import('application.extensions.phpexcel.Classes.PHPExcel', true);
			$this->objPHPExcel = new PHPExcel();
			spl_autoload_register(array('YiiBase','autoload'));  
			// Creating a workbook
			$this->objPHPExcel->getProperties()->setCreator($this->creator);
			$this->objPHPExcel->getProperties()->setTitle($this->title);
			$this->objPHPExcel->getProperties()->setSubject($this->subject);
			$this->objPHPExcel->getProperties()->setDescription($this->description);
			$this->objPHPExcel->getProperties()->setCategory($this->category);
		}
		
		public function renderHeader()
		{
			$a=0;
			foreach($this->columns as $n=>$column)
			{
				$a=$a+1;
                if($column->name!==null && $column->header===null)
                {
                    if($column->grid->dataProvider instanceof CActiveDataProvider)
                    	$head = $column->grid->dataProvider->model->getAttributeLabel($column->name);
                    else
                    	$head = $column->name;
                } else
                    $head =trim($column->header)!=='' ? $column->header : $column->grid->blankDisplay;

				$this->objPHPExcel->getActiveSheet()->setCellValue($this->columnName($a)."1" ,$head);
			}			
		}
		
		public function renderBody()
		{
			if($this->disablePaging) //if needed disable paging to export all data
				$this->enablePagination = false;

		    $data=$this->dataProvider->getData();
		    $n=count($data);

		    if($n>0)
		    {
		        for($row=0;$row<$n;++$row)
		            $this->renderRow($row);
		    }
		}
		
		public function renderRow($row)
		{
			$data=$this->dataProvider->getData();			

			$a=0;
			foreach($this->columns as $n=>$column)
			{
			    if($column->value!==null) 
			        $value=$this->evaluateExpression($column->value ,array('data'=>$data[$row]));
			    else if($column->name!==null) 
			        $value=$data[$row][$column->name];

			    $value=$value===null ? "" : $column->grid->getFormatter()->format($value,$column->type);

				$a++;
				$this->objPHPExcel->getActiveSheet()->setCellValue($this->columnName($a).($row+2) ,$value);				
			}				
		}
  				
		public function run()
		{
			$this->renderHeader();
			$this->renderBody();	
   			
   			//set auto width
   			if($this->autoWidth)
   				foreach($this->columns as $n=>$column)
   					$this->objPHPExcel->getActiveSheet()->getColumnDimension($this->columnName($n+1))->setAutoSize(true);
   			//create writer for saving
			$objWriter = PHPExcel_IOFactory::createWriter($this->objPHPExcel, $this->exportType);
			if(!$this->stream)
				$objWriter->save($this->filename);
			else //output to browser
			{
				if(!$this->filename)
					$this->filename = $this->title;
				ob_end_clean();
				header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
				header('Pragma: public');
				header('Content-type: '.$this->mimeTypes[$this->exportType]['Content-type']);
				header('Content-Disposition: attachment; filename="'.$this->filename.'.'.$this->mimeTypes[$this->exportType]['extension'].'"');
				header('Cache-Control: max-age=0');				
				$objWriter->save('php://output');			
				Yii::app()->end();
			}
		}

		/**
		* Returns the coresponding excel column.(Abdul Rehman from yii forum)
		* 
		* @param int $index
		* @return string
		*/
		public function columnName($index)
		{
			--$index;
			if($index >= 0 && $index < 26)
				return chr(ord('A') + $index);
			else if ($index > 25)
				return ($this->columnName($index / 26)).($this->columnName($index%26 + 1));
			else
				throw new Exception("Invalid Column # ".($index + 1));
		}		
		
	}
