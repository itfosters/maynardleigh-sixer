<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Admin extends ITFS_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model("workreports");
        $this->load->library('form_validation');
        //$data['id']=$this->input->post('id');
        $this->load->model('workreport/workreports');
        $this->load->helper('download');
    }

    public function index() {

        $info = $this->welcomes->getStatistic();
        $this->template->build('admin_index');
    }

    public function calender() {

        $datas['excel'] = true;
        //$this->template->set_breadcrumb("Work Reports ", "");
        $datas['property'] = single_array($this->users->calender(), 'id', 'name');
        $this->template->set_breadcrumb("Download calender ", "");
        $datas['headingtitle'] = "Download calender";
        $this->template->build('admin_calender', $datas);
    }

    function mydates() {
        $datas['property'] = single_array($this->users->calender(), 'id', 'name');
        $datas['property'][''] = "Select Resource";
        $datas['headingtitle'] = "work reports";
        ksort($datas['property']);

        $this->template->set_breadcrumb("Work Reports ", "");

        $this->template->build('admin_calender', $datas);
        //echo "<pre>";print_r($datas);die;
    }

    public function showAllDates() {

        $where['casting_id'] = $this->input->post('id');
        $where['start_date'] = $this->input->post('cal1');
        $where['end_date'] = $this->input->post('cal2');
        //echo "<pre>";print_r($where);die;
        $data['view'] = (array) $this->workreports->getAssignDateDetails($where);
        foreach ($data['view'] as $key => $record) {
            $record->start_date = date('jS F, Y', strtotime($record->start_date));
            $record->end_date = date('jS F, Y', strtotime($record->end_date));
            $current_result = (array) $this->workreports->getMoreInfoForResource($record->diagnose_id, $record->order_type);
            $record->moreinfo = $current_result;
        }
        $results = (array) $data['view'];
        //echo "<pre>";print_r($results);die;
        return $this->output->set_content_type('application/json')->set_output(json_encode($results));
    }

    function getreport() {


        $this->load->helper('csv');

        $where['casting_id'] = $this->input->post('id');
        $where['start_date'] = $this->input->post('cal1');
        $where['end_date'] = $this->input->post('cal2');
        //echo "<pre>";print_r($where);die;
        $users = $this->workreports->getAssignDateDownload($where);

        $result = array_to_csv($users, 'Excel.xls');

        //echo "ggggggggggg";die;
    }

    //for color excel
    function downloadExcelColor() {
        //load our new PHPExcel library
        //now for all resource booking dates
        //$dateandtime2017 = strtotime(date('2017-01-01'));
        $where = array('start_date' => '2017-01-01');
        $data['view'] = (array) $this->workreports->getAllLeadershipList($where);
        foreach ($data['view'] as $key => $record) {
            $record->start_date = date('Y-M-d', strtotime($record->start_date));
            $record->end_date = date('Y-M-d', strtotime($record->end_date));
            $current_result = (array) $this->workreports->getMoreInfoForResource($record->diagnose_id, $record->order_type);
            $record->moreinfo = $current_result;
        }
        $results = (array) $data['view'];
        //echo "<pre>QA";print_r($results);die;
        //$allInformation = $this->workreports->getAllLeadershipList($dateandtime2017);
        $allreportbyresource = array();
        $dateayyayvalue = array();
        foreach ($results as $daykey => $dayvalue) {
            $allreportbyresource[$dayvalue->resourceemail][] = $dayvalue;
            $dateayyayvalue[$dayvalue->start_date][] = $dayvalue;
        }
        //echo "<pre>Report";print_r($dateayyayvalue);die;
        $this->load->library('excel');
        //$this->load->library('excel');
        define('EOL', (PHP_SAPI == 'cli') ? PHP_EOL : '<br />');
        // Set document properties
        $this->excel->getProperties()->setCreator("Maynardleigh Assciates")
                ->setLastModifiedBy("Maynardleigh Assciates")
                ->setTitle("Life Strategies calender")
                ->setSubject("Life Strategies calender")
                ->setDescription("All resources Calender.")
                ->setKeywords("office 2007 openxml php")
                ->setCategory("resources");



        $this->excel->setActiveSheetIndex(0)
                ->setCellValue('A1', 'Month')
                ->setCellValue('B1', '');
        //->setCellValue('D1', 'Date');

        $this->excel->getActiveSheet()->getStyle('A1')->applyFromArray(array(
            'fill' => array(
                'type' => PHPExcel_Style_Fill::FILL_SOLID,
                'color' => array('rgb' => 'CCFF00')
            )
                )
        );
        $this->excel->getActiveSheet()->getStyle('B1')->applyFromArray(array(
            'fill' => array(
                'type' => PHPExcel_Style_Fill::FILL_SOLID,
                'color' => array('rgb' => '000000')
            )
                )
        );
        $this->excel->getActiveSheet()->getStyle('C1')->applyFromArray(array(
            'fill' => array(
                'type' => PHPExcel_Style_Fill::FILL_SOLID,
                'color' => array('rgb' => '000000')
            )
                )
        );
        $this->excel->getActiveSheet()->getStyle('D1')->applyFromArray(array(
            'fill' => array(
                'type' => PHPExcel_Style_Fill::FILL_SOLID,
                'color' => array('rgb' => '000000')
            )
                )
        );

        $styleArray = array(
            'font' => array(
                'bold' => true,
                'color' => array('rgb' => 'FFFFFF'),
                'size' => 7,
                'align' => 'center',
                'name' => 'Times New Roman'
        ));

        $this->excel->getActiveSheet()->getCell('C1')->setValue('Day');
        $this->excel->getActiveSheet()->getStyle('C1')->applyFromArray($styleArray);

        $this->excel->getActiveSheet()->getStyle('C1')->applyFromArray(array(
            'fill' => array(
                'type' => PHPExcel_Style_Fill::FILL_SOLID,
                'color' => array('rgb' => '000000')
            )
                )
        );

        $styleArray = array(
            'font' => array(
                'bold' => true,
                'color' => array('rgb' => 'FFFFFF'),
                'size' => 7,
                'align' => 'center',
                'name' => 'Times New Roman'
        ));

        $styleArrayNormal = array(
            'font' => array(
                'bold' => FALSE,
                'color' => array('rgb' => '000000'),
                'size' => 7,
                'align' => 'center',
                'name' => 'Times New Roman'
        ));
        $styleArrayNormalB = array(
            'font' => array(
                'bold' => true,
                'color' => array('rgb' => '000000'),
                'size' => 7,
                'align' => 'center',
                'name' => 'Times New Roman'
        ));

        $this->excel->getActiveSheet()->getCell('C1')->setValue('Day');
        $this->excel->getActiveSheet()->getStyle('C1')->applyFromArray($styleArray);
        $this->excel->getActiveSheet()->getCell('D1')->setValue('Date');
        $this->excel->getActiveSheet()->getStyle('D1')->applyFromArray($styleArray);


        //now getting resource list
        $this->load->model('user/users');
        $allResources = $this->users->getResources();

        $allresourcesColumnName = range('E', 'W');
        $resourcearraywithindex = array_combine($allresourcesColumnName, $allResources);

        //albhabatical order
        $alfabeticalorder = array();
        foreach ($resourcearraywithindex as $albhabetkey => $resourcevalue) {
            $alfabeticalorder[$resourcevalue->username] = $albhabetkey;
        }

        //echo "<pre>12345";print_r($allResources);
        //echo "<pre>123!!!45";print_r($allresourcesColumnName);echo "<hr>";
        //echo "<pre>12345!!!!!!";print_r($resourcearraywithindex);echo "<hr>";
        //echo "<pre>Alfabet";print_r($alfabeticalorder);die;
        //echo "<pre>";print_r($allresourcesColumnName);echo "<hr>";
        //echo "<pre>123456";print_r($allResources);die;
        foreach ($allResources as $key => $rvalue) {
            $this->excel->getActiveSheet()->getCell($allresourcesColumnName[$key] . "1")->setValue($rvalue->name);
            $this->excel->getActiveSheet()->getStyle($allresourcesColumnName[$key] . "1")->applyFromArray($styleArray);

            $this->excel->getActiveSheet()->getStyle($allresourcesColumnName[$key] . "1")->applyFromArray(array(
                'fill' => array(
                    'type' => PHPExcel_Style_Fill::FILL_SOLID,
                    'color' => array('rgb' => '000000')
                )
               )
            );
           // $this->excel->getActiveSheet()->freezePane($allresourcesColumnName[$key] . "1");
        }

        $this->excel->getActiveSheet()->freezePane('D2');

        //now getting array for month
        $months = array(1 => 'Jan', 2 => 'Feb', 3 => 'Mar', 4 => 'Apr', 5 => 'May', 6 => 'Jun', 7 => 'Jul', 8 => 'Aug', 9 => 'Sep', 10 => 'Oct', 11 => 'Nov', 12 => 'Dec');
        //echo "<pre>123";print_r($months);die;
        // for each day in the month
        //for($i = 1; $i <=  date('t'); $i++)
        foreach ($months as $monthkey => $monthvalue) {
            $alldays = cal_days_in_month(CAL_GREGORIAN, $monthkey, date('Y'));
            for ($i = 1; $i <= $alldays; $i++) {
                // add the date to the dates array
                $dayvalue = str_pad($i, 2, '0', STR_PAD_LEFT);

                $currentdate = date('Y') . "-" . $monthkey . "-" . $dayvalue;
                $day = date("D", strtotime($currentdate));
                $dates[$monthvalue][$dayvalue] = $dayvalue . "#" . $day;
            }
        }
        $columnvalue = 1;
        //echo "<pre>12345";print_r($dates);die;
        $arrayofresource = array('');
        foreach ($dates as $monthname => $datevalues) {
            $cellAMergecount = 1;
            $allstartvalue = $columnvalue - 1;
            // echo "<pre>1234";print_r($datevalue);die;
            foreach ($datevalues as $datesvalue) {
                $cellAMergecount++;
                //echo "<pre>".$columnvalue;print_r($datesvalue);die;
                $columnvalue++;
                $explodedvalue = explode("#", $datesvalue);
                $currentDateValue = date('Y') . "-" . $monthname . "-" . $explodedvalue[0];
                //echo "<pre>";print_r($currentDateValue);

                $this->excel->getActiveSheet()->getCell('C' . $columnvalue)->setValue($explodedvalue[1]);
                $this->excel->getActiveSheet()->getStyle('C' . $columnvalue)->applyFromArray($styleArrayNormal);
                $this->excel->getActiveSheet()->getCell('D' . $columnvalue)->setValue(intval($explodedvalue[0]));
                $this->excel->getActiveSheet()->getStyle('D' . $columnvalue)->applyFromArray($styleArrayNormalB);


                if ($explodedvalue[1] == 'Sat' || $explodedvalue[1] == 'Sun') {
                    $alldaysvalue = range("B", "X");
                    //all background coror
                    foreach ($alldaysvalue as $dayvaluecell) {
                        //echo "<pre>Cell";print_r($dayvaluecell);die;
                        $this->excel->getActiveSheet()->getStyle($dayvaluecell . $columnvalue)->applyFromArray(array(
                            'fill' => array(
                                'type' => PHPExcel_Style_Fill::FILL_SOLID,
                                'color' => array('rgb' => '00B0F0')
                            )
                                )
                        );
                    }
                }

                //writting dates
                if (array_key_exists($currentDateValue, $dateayyayvalue)) {
                    $alldataofresource = $dateayyayvalue[$currentDateValue];
                    foreach ($alldataofresource as $dateofresourcekey => $dateofresourcevalue) {
                        //echo "<pre>1234";print_r($dateofresourcevalue);die;
                        $cellvalueforwrite = $alfabeticalorder[$dateofresourcevalue->resourceemail] . $columnvalue;
                        //echo $cellvalueforwrite."<hr>";
                        $this->excel->getActiveSheet()->getCell($cellvalueforwrite)->setValue(isset($dateofresourcevalue->moreinfo['subname']) ? $dateofresourcevalue->moreinfo['subname'] . "-" . $dateofresourcevalue->moreinfo['location'] . " " . $dateofresourcevalue->clientsname : '');
                        $this->excel->getActiveSheet()
                                ->getColumnDimension($alfabeticalorder[$dateofresourcevalue->resourceemail])
                                //->setAutoSize(true);
                                ->setWidth(20);
                        
                        if($dateofresourcevalue->moreinfo['catalyst_call_flag']==1){
                            $CellBackgroundColor = '938953';
                        }else if($dateofresourcevalue->moreinfo['executive_call_flag']==1){
                            $CellBackgroundColor = 'd68068';
                        }else if($dateofresourcevalue->order_type == 1) {
                            $CellBackgroundColor = '674EA7';
                        } else {
                            $CellBackgroundColor = 'FFC000';
                        }


                        $this->excel->getActiveSheet()->getStyle($cellvalueforwrite)
                                ->applyFromArray(array(
                                    'fill' => array(
                                        'type' => PHPExcel_Style_Fill::FILL_SOLID,
                                        'color' => array('rgb' => $CellBackgroundColor),
                                    ),
                                    'font' => array(
                                        //'bold'  => true,
                                        //'color' => array('rgb' => '000000'),
                                        'size' => 8,
                                        'name' => 'Arial'
                                    )
                                        )
                                )->getAlignment()->setWrapText(true);
                    }
                }
            }

            //echo "A".($allstartvalue+2)."^^^A".($allstartvalue+$cellAMergecount);echo "<hr>";
            $this->excel->getActiveSheet()->mergeCells("A" . ($allstartvalue + 2) . ":A" . ($allstartvalue + $cellAMergecount));
            $this->excel->getActiveSheet()
                    ->getCell("A" . ($allstartvalue + 2))
                    ->setValue($monthname);
            $this->excel->getActiveSheet()
                    ->getStyle($this->excel->getActiveSheet()->calculateWorksheetDimension())
                    ->getAlignment()
                    ->setHorizontal(PHPExcel_Style_Alignment::VERTICAL_CENTER);

            $this->excel->getActiveSheet()->getRowDimension('1')->setRowHeight(40);



            $this->excel->getActiveSheet()->getStyle("A" . ($allstartvalue + 2))->applyFromArray(array(
                'fill' => array(
                    'type' => PHPExcel_Style_Fill::FILL_SOLID,
                    'color' => array('rgb' => 'B7E1CD')
                )
                    )
            );
        }
        //die;
        ///die;
        // Miscellaneous glyphs, UTF-8
        // Rename worksheet
        $this->excel->getActiveSheet()->setTitle(date('Y'));


        // Set active sheet index to the first sheet, so Excel opens this as the first sheet
        $this->excel->setActiveSheetIndex(0);
        //die("Perfect");
//$this->load->library('PHPExcel/iofactory');
// Redirect output to a client’s web browser (Excel2007)
// We'll be outputting an excel file

        
        
        
        
        
        
      
        
        
        
        
        
        
        
        
        

        $filename = 'Life_Strategies_calender_2017.xls'; //save our workbook as this file name
        //
        //
        //
        //
        ///delete code start
//        header('Content-Type: application/vnd.ms-excel'); //mime type
//        header('Content-Disposition: attachment;filename="'.$filename.'"'); //tell browser what's the file name
//        header('Cache-Control: max-age=0'); //no cache
//        $objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel5'); 
//        $objWriter->save('php://output');
//        die;
        ///delete code end
        //
        //
        //
        //
        //header('Content-Type: application/vnd.ms-excel'); //mime type
        //header('Content-Disposition: attachment;filename="'.$filename.'"'); //tell browser what's the file name
        //header('Cache-Control: max-age=0'); //no cache
        //save it to Excel5 format (excel 2003 .XLS file), change this to 'Excel2007' (and adjust the filename extension, also the header mime type)
        //if you want to save it as .XLSX Excel 2007 format

        $objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel5');
        //header('Content-Type: application/xlsx');
        //header('Content-Disposition: attachment;filename="'.$filename.'"');
        //header('Cache-Control: max-age=0');
        //ob_end_clean();
        $objWriter->save(PUBLIC_UPLOADPATH . "excelreport/" . $filename);
        $this->template->headingtitle = "Live Report ";
        $this->template->set_breadcrumb("DASHBOARD", site_url("/admin"));
        $this->template->set_breadcrumb("Live Report ", "");
        $liveURL = site_url() . "assests/itf_public/excelreport/" . $filename;
        $this->template->set_layout('contract_layout');
        $this->template->build('livereport', array('excelfilepath' => $liveURL));
    }

    function downloadExcel() {


        $this->load->helper('csv');

        $where['casting_id'] = $this->input->post('user_date');
        $where['start_date'] = $this->input->post('calender1');
        $where['end_date'] = $this->input->post('calender2');

        //echo "<pre>";print_r($where);die;
        //$headings = array('Resource', 'Product', 'Weightage', 'Subproducts', 'Client Name', 'Location', 'Start Date', 'End Date', 'Start time', 'End time', 'Status', 'Comment', 'Delete Comment');
        $headings = array('Start Date', 'End Date', 'Client', 'Product', 'Subproduct', 'Resource', 'Location', 'Weightage', 'Status', 'Comments', 'Order Delete comment');
        //$users=$this->workreports->getAssignDateDownload($where);
        //$users=$this->workreports->getAssignDateDownload($where);
        $users = (array) $this->workreports->getAssignDateDetails($where);
        //echo "<pre>1234";print_r($users);die;
        foreach ($users as &$record) {
            $current_result = $this->workreports->getMoreDownloadResource($record->diagnose_id, $record->order_type);
            $record->start_date = date('jS F, Y', strtotime($record->start_date));
            $record->end_date = date('jS F, Y', strtotime($record->end_date));
            //echo "<pre>1234";print_r($current_result);die;
            //$record[]=$current_result;
            $record->moreinformation = $current_result;
        }
        //echo "<pre>1234";print_r($users);die;
        $newalldata = array();
        //
        foreach ($users as $ukey => $udata) {
            //echo "<pre>";print_r($udata);die;
            $newalldata[$ukey]['start_date'] = $udata->start_date;
            $newalldata[$ukey]['end_date'] = $udata->end_date;

            $newalldata[$ukey]['clientsname'] = $udata->clientsname;
            $newalldata[$ukey]['name'] = isset($udata->moreinformation['name']) ? $udata->moreinformation['name'] : '';
            $newalldata[$ukey]['subname'] = isset($udata->moreinformation['subname']) ? $udata->moreinformation['subname'] : '';

            $newalldata[$ukey]['clientname'] = $udata->clientname;
            //$newalldata[$ukey]['weight'] = $udata['weight'];
            $newalldata[$ukey]['location'] = isset($udata->moreinformation['location']) ? $udata->moreinformation['location'] : '';
            $newalldata[$ukey]['weight'] = isset($udata->moreinformation['weight']) ? ($udata->moreinformation['weight'] * $udata->moreinformation['units']) / $udata->moreinformation['cunsulting_days'] : '';
            $newalldata[$ukey]['status'] = $udata->status;
            if ($newalldata[$ukey]['status'] == 1) {
                $newalldata[$ukey]['status'] = "Approved";
            } else if ($newalldata[$ukey]['status'] == 0) {
                $newalldata[$ukey]['status'] = "Awaiting";
            } else {
                $newalldata[$ukey]['status'] = "Rejected";
            }
            $newalldata[$ukey]['comment'] = $udata->comment;
            $newalldata[$ukey]['del_comment'] = $udata->del_comment;
            unset($newalldata[$ukey]->moreinformation);
        }
        //echo "<pre>";print_r($newalldata);die;
        $resorce = $this->workreports->calender_resource($where['casting_id']);
        if (!empty($resorce))
            $name = 'work_reports' . '_' . $resorce->name . '.xls';
        else
            $name = 'work_reports' . '_' . date('Y_m_d') . '.xls';
        //echo "<pre>".$name;die;
        $result = array_to_csv($newalldata, $name, $headings);
    }

}
