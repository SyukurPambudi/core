<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class jpgraph_lib
{
    public function barchart() {
        require_once ("jpgraph/src/jpgraph.php");           
        require_once ("jpgraph/src/jpgraph_pie.php");
        require_once ("jpgraph/src/jpgraph_pie3d.php");
	}
	
	public function ganttchart() {
		require_once ('jpgraph/jpgraph.php');
		require_once ('jpgraph/jpgraph_gantt.php');
		
		return new GanttGraph();
	}
}
?>