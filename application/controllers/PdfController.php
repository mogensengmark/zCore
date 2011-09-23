<?php
/**
 * 
 * @author Mogens
 *
 */
class PdfController extends Zend_Controller_Action
{
	/**
	 * The default action - show the home page
	 */
    public function indexAction() 
    {
		// PDF file path
		$pdf_file_path = 'files/';
		// PDF target file name
		$pdf_file_target = $pdf_file_path . 'coordinates.pdf';
    	// PDF templete file name
    	$pdf_file_template = $pdf_file_path . 'aabentlandbrug_01.pdf';
		
		// Loads pdf class and generates a new file
    	$pdf = Zend_Pdf::load($pdf_file_template);
		// Reverts pages
    	$pdf->pages = array_reverse($pdf->pages);
    	// Sets first page to be template page
		$template = $pdf->pages[0];
		
    	// Amount fields on x-axis
		//$x_fields = range(1,10);
		$x_fields = range(1,12);
		// Amount fields on y-axis
		//$y_fields = range(1,15);
		$y_fields = range(1,15);
		// Holds entire list of coordinates
		$total_array = array();
		// Generates list of coordinates
		foreach($x_fields as $x_point) {
			foreach($y_fields as $y_point ) {
				$total_array[] = array('x' => $x_point, 'y' => $y_point);
			} 
		}
		
		// Mixes it all up
		shuffle($total_array);
		
		// Amount of pages to generate
		$amount_pages = ceil(count($total_array)/2); 
		// Koordintates
		$pdf_coordinates = array( 
							'left_x1' => 195, 
							'left_y1' => 170, 
							'left_x2' => 195, 
							'left_y2' => 125,
							'right_x1' => 625,
							'right_y1' => 170,
							'right_x2' => 625,
							'right_y2'=> 125		
							);
						
		// Generates pages
		for($i=0; $amount_pages>$i; $i++){
			// Selects 2 coordinates from the list
			if(count($total_array) >= 2 ) { 
				$selected_values = array_rand($total_array, 2); 
				// Shortkeying coordinate values
				$short_1 = $total_array[$selected_values[0]];
				$short_2 = $total_array[$selected_values[1]];
			} else {
				$selected_values = array_rand($total_array, 1); 
				
				// Shortkeying coordinate values
				
				//Zend_Debug::dump($selected_values);
				$short_1 = $total_array[$selected_values];
				$short_2 = array('x' => '-----', 'y' => '-----');
			}			
			// Generates new page
			$page_buffer = new Zend_Pdf_Page($template);
					
			// Define font			
			$page_buffer->setFont(Zend_Pdf_Font::fontWithName(Zend_Pdf_Font::FONT_HELVETICA), 30);
			// Draw text
			$page_buffer->drawText('X: ' . $short_1['x'], $pdf_coordinates['left_x1'], $pdf_coordinates['left_y1']);
			$page_buffer->drawText('Y: ' . $short_1['y'], $pdf_coordinates['left_x2'], $pdf_coordinates['left_y2']);
			$page_buffer->drawText('X: ' . $short_2['x'], $pdf_coordinates['right_x1'], $pdf_coordinates['right_y1']);
			$page_buffer->drawText('Y: ' . $short_2['y'], $pdf_coordinates['right_x2'], $pdf_coordinates['right_y2']);
			
			// Removing selected coordinates from total array in order to prevent them from being selected again
			unset($total_array[$selected_values[0]]);
			unset($total_array[$selected_values[1]]);
			
			
			// Append page to total view
			$pdf->pages[] = $page_buffer;
		}
			echo count($total_array);
		
		// Removes template page
		unset($pdf->pages[0]);
		
		// Saves pdf		
		$pdf->save($pdf_file_target);
		
		
    }
}


?>