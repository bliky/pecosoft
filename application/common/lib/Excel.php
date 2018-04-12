<?php

namespace app\common\lib;

class Excel
{
  protected $phpexcel;
  protected $wirter;
  protected $activeIndex = 0;
  protected $excelRootDir;
  protected $cols = [];
  protected $data = [];
  protected $excol = ['A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'K', 'L', 'M', 'N', 'O', 'P', 'Q', 'R', 'S', 'T', 'U', 'V', 'W', 'X', 'Y', 'Z'];

  
  public function __construct($cols = [], $data = [])
    {
      import('PHPExcel.PHPExcel');
      $this->phpexcel = new \PHPExcel();
      $this->writer = \PHPExcel_IOFactory::createWriter($this->phpexcel, 'Excel2007');
      $this->cols = $cols;
      $this->data = $data;
      $this->phpexcel->setActiveSheetIndex(0);

      $exportDir = dirname($_SERVER['SCRIPT_FILENAME']) . DIRECTORY_SEPARATOR . 'exportdata';
      create_dir($exportDir);
      $this->excelRootDir =  $exportDir . DIRECTORY_SEPARATOR . 'excel';
      create_dir($this->excelRootDir);
      $this->excelRootDir .= DIRECTORY_SEPARATOR;
    }

  protected function cellX ($x) {
    $x -= 1;
    $mx = $x % 26;
    $xx = $this->excol[$mx];
    $x = intval($x / 26);
    while ($x > 0) {
      $x -= 1;
      $mx = $x % 26;
      $xx = $this->excol[$mx] . $xx;
      $x = intval($x / 26);
    }
    return $xx;
  }

  protected function cell ($x, $y) {
    return $this->cellX($x) . $y;
  }

  protected function setCell ($x, $y, $v) {
    return $this->phpexcel->getActiveSheet()->setCellValue($this->cell($x, $y), $v);
  }

  protected function setWidth ($x, $w) {
    return $this->phpexcel->getActiveSheet()->getColumnDimension($this->cellX($x))->setWidth($w);
  }

  public function writeSheet ($sheetTitle) {
    $cols = $this->cols;
    $dataList = $this->data;
    $colLen = count($cols);
    $rowLen = count($dataList);

    if ($colLen == 0 || $rowLen == 0) return false;

    for ($i=0; $i<$colLen; $i++) {
      $col = $cols[$i];
      $x = $i+1;
      $this->setCell($x, 1, $col['title']);
      $this->setWidth($x, $col['width']);
    }

    for ($i=0; $i<$rowLen; $i++) {
      $y = $i + 2;
      $row = $this->data[$i];
      for ($j=0; $j<$colLen; $j++) {
        $col = $this->cols[$j];
        $field = $col['field'];
        $this->setCell($j+1, $y, $row[$field]);
      }
    }

    $this->phpexcel->getActiveSheet()->setTitle($sheetTitle);

    //return $this->phpexcel->setActiveSheetIndex(++$this->activeIndex);
  }

  public function save($filename)
  {
    $filename = $filename ? : date('YmdHis');
    $filename .= '.xlsx';
    $this->writer->save($this->excelRootDir . $filename);
    return '/exportdata/excel/' . $filename;
  }
}
